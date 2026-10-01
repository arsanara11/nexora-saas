<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\ProductVariant;
use App\Models\PurchaseOrder;
use App\Models\StockMovement;
use App\Models\Supplier;
use App\Models\Warehouse;
use App\Notifications\SystemNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PurchaseOrderController extends Controller
{
    public function index()
    {
        $company = request()->attributes->get('currentCompany');

        abort_unless($company, 403);

        $purchaseOrders = PurchaseOrder::with([
            'supplier',
            'warehouse',
            'user',
            'items.productVariant.product',
        ])
            ->where('company_id', $company->id)
            ->latest()
            ->get();

        return view(
            'purchasing.index',
            compact('purchaseOrders')
        );
    }

    public function create()
    {
        $company = request()->attributes->get('currentCompany');

        abort_unless($company, 403);

        $suppliers = Supplier::where(
            'company_id',
            $company->id
        )
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        $warehouses = Warehouse::where(
            'company_id',
            $company->id
        )
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        $variants = ProductVariant::with('product')
            ->where('company_id', $company->id)
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        return view(
            'purchasing.create',
            compact(
                'suppliers',
                'warehouses',
                'variants'
            )
        );
    }

    public function store(Request $request)
    {
        $company = request()->attributes->get('currentCompany');

        abort_unless($company, 403);

        $validated = $request->validate([
            'supplier_id' => [
                'required',
                'exists:suppliers,id',
            ],

            'warehouse_id' => [
                'required',
                'exists:warehouses,id',
            ],

            'order_date' => [
                'required',
                'date',
            ],

            'expected_date' => [
                'nullable',
                'date',
                'after_or_equal:order_date',
            ],

            'shipping_cost' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'notes' => [
                'nullable',
                'string',
            ],

            'product_variant_id' => [
                'required',
                'array',
                'min:1',
            ],

            'product_variant_id.*' => [
                'required',
                'exists:product_variants,id',
            ],

            'quantity' => [
                'required',
                'array',
                'min:1',
            ],

            'quantity.*' => [
                'required',
                'integer',
                'min:1',
            ],

            'unit_cost' => [
                'required',
                'array',
                'min:1',
            ],

            'unit_cost.*' => [
                'required',
                'numeric',
                'min:0',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Validate Supplier Ownership
        |--------------------------------------------------------------------------
        */

        $supplier = Supplier::where(
            'id',
            $validated['supplier_id']
        )
            ->where(
                'company_id',
                $company->id
            )
            ->firstOrFail();

        /*
        |--------------------------------------------------------------------------
        | Validate Warehouse Ownership
        |--------------------------------------------------------------------------
        */

        $warehouse = Warehouse::where(
            'id',
            $validated['warehouse_id']
        )
            ->where(
                'company_id',
                $company->id
            )
            ->firstOrFail();

        /*
        |--------------------------------------------------------------------------
        | Validate Product Variant Ownership
        |--------------------------------------------------------------------------
        */

        $variantIds = $validated['product_variant_id'];

        $variants = ProductVariant::with('product')
            ->where(
                'company_id',
                $company->id
            )
            ->whereIn(
                'id',
                $variantIds
            )
            ->get()
            ->keyBy('id');

        abort_if(
            $variants->count() !== count(array_unique($variantIds)),
            422,
            'One or more selected product variants are invalid.'
        );

        /*
        |--------------------------------------------------------------------------
        | Calculate Subtotal
        |--------------------------------------------------------------------------
        */

        $subtotal = 0;

        foreach (
            $variantIds as $index => $variantId
        ) {
            $quantity = (int) $validated['quantity'][$index];

            $unitCost = (float) $validated['unit_cost'][$index];

            $subtotal += $quantity * $unitCost;
        }

        $shippingCost = (float) (
            $validated['shipping_cost'] ?? 0
        );

        /*
        |--------------------------------------------------------------------------
        | Create Purchase Order
        |--------------------------------------------------------------------------
        */

        $purchaseOrder = DB::transaction(
            function () use (
                $company,
                $validated,
                $warehouse,
                $supplier,
                $variants,
                $subtotal,
                $shippingCost
            ) {
                $purchaseOrder = PurchaseOrder::create([
                    'company_id' => $company->id,
                    'supplier_id' => $supplier->id,
                    'warehouse_id' => $warehouse->id,
                    'user_id' => auth()->id(),
                    'po_number' => $this->generatePoNumber(
                        $company->id
                    ),
                    'status' => 'draft',
                    'subtotal' => $subtotal,
                    'tax' => 0,
                    'shipping_cost' => $shippingCost,
                    'total' => $subtotal + $shippingCost,
                    'notes' => $validated['notes'] ?? null,
                    'ordered_at' => $validated['order_date'],
                    'expected_at' => $validated['expected_date'] ?? null,
                ]);

                foreach (
                    $validated['product_variant_id']
                    as $index => $variantId
                ) {
                    $variant = $variants[$variantId];

                    $quantity = (int) $validated['quantity'][$index];

                    $unitCost = (float) $validated['unit_cost'][$index];

                    $purchaseOrder->items()->create([
                        'product_variant_id' => $variant->id,
                        'product_name' => $variant->product?->name
                            ?? $variant->name,
                        'sku' => $variant->sku,
                        'quantity' => $quantity,
                        'received_quantity' => 0,
                        'unit_cost' => $unitCost,
                        'total' => $quantity * $unitCost,
                    ]);
                }

                return $purchaseOrder;
            }
        );

        /*
        |--------------------------------------------------------------------------
        | Purchase Order Created Notification
        |--------------------------------------------------------------------------
        */

        $request->user()->notify(
            new SystemNotification(
                'Purchase Order Created',
                "Purchase order {$purchaseOrder->po_number} was created successfully.",
                'purchasing',
                '◇'
            )
        );

        return redirect()
            ->route(
                'purchasing.show',
                $purchaseOrder
            )
            ->with(
                'success',
                'Purchase order created successfully.'
            );
    }

    public function show(PurchaseOrder $purchaseOrder)
    {
        $company = request()->attributes->get('currentCompany');

        abort_unless($company, 403);

        abort_unless(
            $purchaseOrder->company_id === $company->id,
            404
        );

        $purchaseOrder->load([
            'supplier',
            'warehouse',
            'user',
            'items.productVariant.product',
        ]);

        return view(
            'purchasing.show',
            compact('purchaseOrder')
        );
    }

    public function edit(PurchaseOrder $purchaseOrder)
    {
        $company = request()->attributes->get('currentCompany');

        abort_unless($company, 403);

        abort_unless(
            $purchaseOrder->company_id === $company->id,
            404
        );

        abort_unless(
            $purchaseOrder->status === 'draft',
            403
        );

        $purchaseOrder->load(
            'items.productVariant.product'
        );

        $suppliers = Supplier::where(
            'company_id',
            $company->id
        )
            ->where(
                'is_active',
                true
            )
            ->orderBy('name')
            ->get();

        $warehouses = Warehouse::where(
            'company_id',
            $company->id
        )
            ->where(
                'is_active',
                true
            )
            ->orderBy('name')
            ->get();

        $variants = ProductVariant::with('product')
            ->where(
                'company_id',
                $company->id
            )
            ->where(
                'is_active',
                true
            )
            ->orderBy('name')
            ->get();

        return view(
            'purchasing.edit',
            compact(
                'purchaseOrder',
                'suppliers',
                'warehouses',
                'variants'
            )
        );
    }

    public function update(
        Request $request,
        PurchaseOrder $purchaseOrder
    ) {
        $company = request()->attributes->get('currentCompany');

        abort_unless($company, 403);

        abort_unless(
            $purchaseOrder->company_id === $company->id,
            404
        );

        abort_unless(
            $purchaseOrder->status === 'draft',
            403
        );

        $validated = $request->validate([
            'supplier_id' => [
                'required',
                'exists:suppliers,id',
            ],

            'warehouse_id' => [
                'required',
                'exists:warehouses,id',
            ],

            'order_date' => [
                'required',
                'date',
            ],

            'expected_date' => [
                'nullable',
                'date',
                'after_or_equal:order_date',
            ],

            'shipping_cost' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'notes' => [
                'nullable',
                'string',
            ],

            'items' => [
                'required',
                'array',
                'min:1',
            ],

            'items.*.product_variant_id' => [
                'required',
                'exists:product_variants,id',
            ],

            'items.*.quantity' => [
                'required',
                'integer',
                'min:1',
            ],

            'items.*.unit_cost' => [
                'required',
                'numeric',
                'min:0',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Validate Supplier Ownership
        |--------------------------------------------------------------------------
        */

        $supplier = Supplier::where(
            'id',
            $validated['supplier_id']
        )
            ->where(
                'company_id',
                $company->id
            )
            ->firstOrFail();

        /*
        |--------------------------------------------------------------------------
        | Validate Warehouse Ownership
        |--------------------------------------------------------------------------
        */

        $warehouse = Warehouse::where(
            'id',
            $validated['warehouse_id']
        )
            ->where(
                'company_id',
                $company->id
            )
            ->firstOrFail();

        /*
        |--------------------------------------------------------------------------
        | Validate Product Variant Ownership
        |--------------------------------------------------------------------------
        */

        $variantIds = collect(
            $validated['items']
        )
            ->pluck('product_variant_id')
            ->unique()
            ->values();

        $variants = ProductVariant::with('product')
            ->where(
                'company_id',
                $company->id
            )
            ->whereIn(
                'id',
                $variantIds
            )
            ->get()
            ->keyBy('id');

        abort_if(
            $variants->count() !== $variantIds->count(),
            422,
            'One or more selected product variants are invalid.'
        );

        /*
        |--------------------------------------------------------------------------
        | Calculate Subtotal
        |--------------------------------------------------------------------------
        */

        $subtotal = 0;

        foreach ($validated['items'] as $item) {
            $subtotal +=
                (int) $item['quantity']
                * (float) $item['unit_cost'];
        }

        $shippingCost = (float) (
            $validated['shipping_cost'] ?? 0
        );

        /*
        |--------------------------------------------------------------------------
        | Update Purchase Order
        |--------------------------------------------------------------------------
        */

        DB::transaction(
            function () use (
                $purchaseOrder,
                $validated,
                $supplier,
                $warehouse,
                $variants,
                $subtotal,
                $shippingCost
            ) {
                $purchaseOrder->update([
                    'supplier_id' => $supplier->id,
                    'warehouse_id' => $warehouse->id,
                    'subtotal' => $subtotal,
                    'tax' => 0,
                    'shipping_cost' => $shippingCost,
                    'total' => $subtotal + $shippingCost,
                    'notes' => $validated['notes'] ?? null,
                    'ordered_at' => $validated['order_date'],
                    'expected_at' => $validated['expected_date'] ?? null,
                ]);

                $purchaseOrder->items()->delete();

                foreach ($validated['items'] as $item) {
                    $variant = $variants[
                        $item['product_variant_id']
                    ];

                    $quantity = (int) $item['quantity'];

                    $unitCost = (float) $item['unit_cost'];

                    $purchaseOrder->items()->create([
                        'product_variant_id' => $variant->id,
                        'product_name' => $variant->product?->name
                            ?? $variant->name,
                        'sku' => $variant->sku,
                        'quantity' => $quantity,
                        'received_quantity' => 0,
                        'unit_cost' => $unitCost,
                        'total' => $quantity * $unitCost,
                    ]);
                }
            }
        );

        /*
        |--------------------------------------------------------------------------
        | Purchase Order Updated Notification
        |--------------------------------------------------------------------------
        */

        $request->user()->notify(
            new SystemNotification(
                'Purchase Order Updated',
                "Purchase order {$purchaseOrder->po_number} was updated successfully.",
                'purchasing',
                '◇'
            )
        );

        return redirect()
            ->route(
                'purchasing.show',
                $purchaseOrder
            )
            ->with(
                'success',
                'Purchase order updated successfully.'
            );
    }

    public function updateStatus(
        Request $request,
        PurchaseOrder $purchaseOrder
    ) {
        $company = request()->attributes->get('currentCompany');

        abort_unless($company, 403);

        abort_unless(
            $purchaseOrder->company_id === $company->id,
            404
        );

        $validated = $request->validate([
            'status' => [
                'required',
                'in:draft,pending,approved,ordered,received,cancelled',
            ],
        ]);

        $newStatus = $validated['status'];

        $currentStatus = $purchaseOrder->status;

        $allowedTransitions = [
            'draft' => [
                'draft',
                'pending',
                'cancelled',
            ],

            'pending' => [
                'pending',
                'approved',
                'cancelled',
            ],

            'approved' => [
                'approved',
                'ordered',
                'cancelled',
            ],

            'ordered' => [
                'ordered',
                'received',
                'cancelled',
            ],

            'received' => [
                'received',
            ],

            'cancelled' => [
                'cancelled',
            ],
        ];

        abort_unless(
            in_array(
                $newStatus,
                $allowedTransitions[$currentStatus] ?? [],
                true
            ),
            422
        );

        DB::transaction(
            function () use (
                $purchaseOrder,
                $newStatus,
                $currentStatus
            ) {
                /*
                |--------------------------------------------------------------------------
                | ORDERED -> RECEIVED
                |--------------------------------------------------------------------------
                | 1. Add stock to inventory
                | 2. Update received quantity
                | 3. Create stock movement history
                |--------------------------------------------------------------------------
                */

                if (
                    $currentStatus === 'ordered' &&
                    $newStatus === 'received'
                ) {
                    $purchaseOrder->load(
                        'items'
                    );

                    /*
                    |--------------------------------------------------------------------------
                    | Validate Warehouse Ownership
                    |--------------------------------------------------------------------------
                    */

                    $warehouse = Warehouse::where(
                        'id',
                        $purchaseOrder->warehouse_id
                    )
                        ->where(
                            'company_id',
                            $purchaseOrder->company_id
                        )
                        ->firstOrFail();

                    /*
                    |--------------------------------------------------------------------------
                    | Validate Product Variant Ownership
                    |--------------------------------------------------------------------------
                    */

                    $variantIds = $purchaseOrder->items
                        ->pluck('product_variant_id')
                        ->unique();

                    $validVariantCount = ProductVariant::where(
                        'company_id',
                        $purchaseOrder->company_id
                    )
                        ->whereIn(
                            'id',
                            $variantIds
                        )
                        ->count();

                    abort_if(
                        $validVariantCount !== $variantIds->count(),
                        422,
                        'One or more purchase order variants are invalid.'
                    );

                    foreach (
                        $purchaseOrder->items as $item
                    ) {
                        $inventory = Inventory::firstOrNew([
                            'warehouse_id' =>
                                $warehouse->id,

                            'product_variant_id' =>
                                $item->product_variant_id,
                        ]);

                        $inventory->quantity =
                            (int) $inventory->quantity
                            + (int) $item->quantity;

                        if (
                            $inventory->reserved_quantity === null
                        ) {
                            $inventory->reserved_quantity = 0;
                        }

                        if (
                            $inventory->reorder_level === null
                        ) {
                            $inventory->reorder_level = 0;
                        }

                        $inventory->save();

                        $item->update([
                            'received_quantity' =>
                                $item->quantity,
                        ]);

                        StockMovement::create([
                            'company_id' =>
                                $purchaseOrder->company_id,

                            'warehouse_id' =>
                                $warehouse->id,

                            'product_variant_id' =>
                                $item->product_variant_id,

                            'user_id' =>
                                auth()->id(),

                            'type' =>
                                'purchase',

                            'quantity' =>
                                $item->quantity,

                            'reference_type' =>
                                PurchaseOrder::class,

                            'reference_id' =>
                                $purchaseOrder->id,

                            'notes' =>
                                'Stock received from purchase order '
                                . $purchaseOrder->po_number,
                        ]);
                    }
                }

                $purchaseOrder->update([
                    'status' => $newStatus,
                ]);

                if ($newStatus === 'approved') {
                    $purchaseOrder->update([
                        'approved_at' => now(),
                    ]);
                }

                if ($newStatus === 'received') {
                    $purchaseOrder->update([
                        'received_at' => now(),
                    ]);
                }
            }
        );

        /*
        |--------------------------------------------------------------------------
        | Purchase Order Status Notification
        |--------------------------------------------------------------------------
        */

        if ($currentStatus !== $newStatus) {
            $oldStatusLabel = Str::headline(
                $currentStatus
            );

            $newStatusLabel = Str::headline(
                $newStatus
            );

            if ($newStatus === 'approved') {
                $title = 'Purchase Order Approved';

                $message =
                    "Purchase order {$purchaseOrder->po_number} "
                    . "has been approved.";

                $icon = '✓';
            } elseif ($newStatus === 'ordered') {
                $title = 'Purchase Order Ordered';

                $message =
                    "Purchase order {$purchaseOrder->po_number} "
                    . "has been marked as ordered.";

                $icon = '◇';
            } elseif ($newStatus === 'received') {
                $title = 'Purchase Order Received';

                $message =
                    "Purchase order {$purchaseOrder->po_number} "
                    . "has been received and stock was added to inventory.";

                $icon = '▣';
            } elseif ($newStatus === 'cancelled') {
                $title = 'Purchase Order Cancelled';

                $message =
                    "Purchase order {$purchaseOrder->po_number} "
                    . "has been cancelled.";

                $icon = '×';
            } else {
                $title = 'Purchase Order Status Updated';

                $message =
                    "Purchase order {$purchaseOrder->po_number} "
                    . "changed from {$oldStatusLabel} "
                    . "to {$newStatusLabel}.";

                $icon = '◇';
            }

            $request->user()->notify(
                new SystemNotification(
                    $title,
                    $message,
                    'purchasing',
                    $icon
                )
            );
        }

        return redirect()
            ->route(
                'purchasing.show',
                $purchaseOrder
            )
            ->with(
                'success',
                'Purchase order status updated successfully.'
            );
    }

    public function destroy(
        PurchaseOrder $purchaseOrder
    ) {
        $company = request()->attributes->get('currentCompany');

        abort_unless($company, 403);

        abort_unless(
            $purchaseOrder->company_id === $company->id,
            404
        );

        abort_unless(
            $purchaseOrder->status === 'draft',
            403
        );

        $poNumber = $purchaseOrder->po_number;

        $purchaseOrder->delete();

        /*
        |--------------------------------------------------------------------------
        | Purchase Order Deleted Notification
        |--------------------------------------------------------------------------
        */

        request()->user()->notify(
            new SystemNotification(
                'Purchase Order Deleted',
                "Purchase order {$poNumber} was deleted.",
                'purchasing',
                '×'
            )
        );

        return redirect()
            ->route('purchasing.index')
            ->with(
                'success',
                'Purchase order deleted successfully.'
            );
    }

    private function generatePoNumber(
        int $companyId
    ): string {
        do {
            $number =
                'PO-'
                . now()->format('Ymd')
                . '-'
                . strtoupper(
                    Str::random(6)
                );
        } while (
            PurchaseOrder::where(
                'company_id',
                $companyId
            )
                ->where(
                    'po_number',
                    $number
                )
                ->exists()
        );

        return $number;
    }
}