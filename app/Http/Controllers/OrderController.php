<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Inventory;
use App\Models\Order;
use App\Models\ProductVariant;
use App\Models\StockMovement;
use App\Models\Warehouse;
use App\Notifications\SystemNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function index()
    {
        $company = auth()->user()->companies()->first();

        abort_unless($company, 403);

        $orders = Order::with([
            'customer',
            'warehouse',
            'items',
        ])
            ->where('company_id', $company->id)
            ->latest()
            ->get();

        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $company = auth()->user()->companies()->first();

        abort_unless($company, 403);

        $customers = Customer::where('company_id', $company->id)
            ->orderBy('name')
            ->get();

        $warehouses = Warehouse::where('company_id', $company->id)
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        $variants = ProductVariant::with('product')
            ->where('company_id', $company->id)
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('orders.create', compact(
            'customers',
            'warehouses',
            'variants'
        ));
    }

    public function store(Request $request)
    {
        $company = auth()->user()->companies()->first();

        abort_unless($company, 403);

        $validated = $request->validate([
            'customer_id' => [
                'nullable',
                'exists:customers,id',
            ],

            'warehouse_id' => [
                'required',
                'exists:warehouses,id',
            ],

            'ordered_at' => [
                'required',
                'date',
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

            'items.*.unit_price' => [
                'required',
                'numeric',
                'min:0',
            ],

            'items.*.discount' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'discount' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'tax' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'shipping_cost' => [
                'nullable',
                'numeric',
                'min:0',
            ],
        ]);

        $warehouse = Warehouse::where(
            'id',
            $validated['warehouse_id']
        )
            ->where(
                'company_id',
                $company->id
            )
            ->firstOrFail();

        if (!empty($validated['customer_id'])) {
            Customer::where(
                'id',
                $validated['customer_id']
            )
                ->where(
                    'company_id',
                    $company->id
                )
                ->firstOrFail();
        }

        $order = DB::transaction(function () use (
            $validated,
            $company,
            $warehouse
        ) {
            $subtotal = 0;
            $itemDiscountTotal = 0;
            $items = [];

            foreach ($validated['items'] as $itemData) {
                $variant = ProductVariant::with('product')
                    ->where(
                        'id',
                        $itemData['product_variant_id']
                    )
                    ->where(
                        'company_id',
                        $company->id
                    )
                    ->firstOrFail();

                $quantity = (int) $itemData['quantity'];

                $unitPrice = (float) $itemData['unit_price'];

                $itemDiscount = isset($itemData['discount'])
                    ? (float) $itemData['discount']
                    : 0;

                $lineSubtotal = $quantity * $unitPrice;

                $lineTotal = max(
                    0,
                    $lineSubtotal - $itemDiscount
                );

                $subtotal += $lineSubtotal;

                $itemDiscountTotal += $itemDiscount;

                $items[] = [
                    'product_variant_id' => $variant->id,
                    'product_name' => $variant->product?->name
                        ?? $variant->name,
                    'sku' => $variant->sku,
                    'quantity' => $quantity,
                    'unit_price' => $unitPrice,
                    'discount' => $itemDiscount,
                    'total' => $lineTotal,
                ];
            }

            $orderDiscount = (float) (
                $validated['discount'] ?? 0
            );

            $tax = (float) (
                $validated['tax'] ?? 0
            );

            $shippingCost = (float) (
                $validated['shipping_cost'] ?? 0
            );

            $total = max(
                0,
                $subtotal
                    - $itemDiscountTotal
                    - $orderDiscount
                    + $tax
                    + $shippingCost
            );

            $order = Order::create([
                'company_id' => $company->id,
                'customer_id' => $validated['customer_id'] ?? null,
                'warehouse_id' => $warehouse->id,
                'order_number' => $this->generateOrderNumber(),
                'status' => 'pending',
                'payment_status' => 'pending',
                'subtotal' => $subtotal,
                'discount' => $itemDiscountTotal + $orderDiscount,
                'tax' => $tax,
                'shipping_cost' => $shippingCost,
                'total' => $total,
                'notes' => $validated['notes'] ?? null,
                'ordered_at' => $validated['ordered_at'],
            ]);

            foreach ($items as $item) {
                $order->items()->create($item);
            }

            return $order;
        });

        /*
        |--------------------------------------------------------------------------
        | Sales Notification
        |--------------------------------------------------------------------------
        */

        $request->user()->notify(
            new SystemNotification(
                'Sales Order Created',
                "Sales order {$order->order_number} was created successfully.",
                'sales',
                '◈'
            )
        );

        return redirect()
            ->route('orders.show', $order)
            ->with(
                'success',
                'Sales order created successfully.'
            );
    }

    public function show(Order $order)
    {
        $company = auth()->user()->companies()->first();

        abort_unless($company, 403);

        abort_unless(
            $order->company_id === $company->id,
            404
        );

        $order->load([
            'customer',
            'warehouse',
            'items.productVariant.product',
            'invoice',
        ]);

        return view('orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        $company = auth()->user()->companies()->first();

        abort_unless($company, 403);

        abort_unless(
            $order->company_id === $company->id,
            404
        );

        $order->load([
            'customer',
            'warehouse',
            'items.productVariant.product',
        ]);

        $customers = Customer::where(
            'company_id',
            $company->id
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

        return view('orders.edit', compact(
            'order',
            'customers',
            'warehouses',
            'variants'
        ));
    }

    public function update(
        Request $request,
        Order $order
    ) {
        $company = auth()->user()->companies()->first();

        abort_unless($company, 403);

        abort_unless(
            $order->company_id === $company->id,
            404
        );

        abort_unless(
            $order->status === 'pending',
            422,
            'Only pending orders can be edited.'
        );

        $validated = $request->validate([
            'customer_id' => [
                'nullable',
                'exists:customers,id',
            ],

            'warehouse_id' => [
                'required',
                'exists:warehouses,id',
            ],

            'ordered_at' => [
                'required',
                'date',
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

            'items.*.unit_price' => [
                'required',
                'numeric',
                'min:0',
            ],

            'items.*.discount' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'discount' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'tax' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'shipping_cost' => [
                'nullable',
                'numeric',
                'min:0',
            ],
        ]);

        $warehouse = Warehouse::where(
            'id',
            $validated['warehouse_id']
        )
            ->where(
                'company_id',
                $company->id
            )
            ->firstOrFail();

        if (!empty($validated['customer_id'])) {
            Customer::where(
                'id',
                $validated['customer_id']
            )
                ->where(
                    'company_id',
                    $company->id
                )
                ->firstOrFail();
        }

        DB::transaction(function () use (
            $validated,
            $order,
            $company,
            $warehouse
        ) {
            $subtotal = 0;
            $itemDiscountTotal = 0;
            $items = [];

            foreach ($validated['items'] as $itemData) {
                $variant = ProductVariant::with('product')
                    ->where(
                        'id',
                        $itemData['product_variant_id']
                    )
                    ->where(
                        'company_id',
                        $company->id
                    )
                    ->firstOrFail();

                $quantity = (int) $itemData['quantity'];

                $unitPrice = (float) $itemData['unit_price'];

                $itemDiscount = isset($itemData['discount'])
                    ? (float) $itemData['discount']
                    : 0;

                $lineSubtotal = $quantity * $unitPrice;

                $lineTotal = max(
                    0,
                    $lineSubtotal - $itemDiscount
                );

                $subtotal += $lineSubtotal;

                $itemDiscountTotal += $itemDiscount;

                $items[] = [
                    'product_variant_id' => $variant->id,
                    'product_name' => $variant->product?->name
                        ?? $variant->name,
                    'sku' => $variant->sku,
                    'quantity' => $quantity,
                    'unit_price' => $unitPrice,
                    'discount' => $itemDiscount,
                    'total' => $lineTotal,
                ];
            }

            $orderDiscount = (float) (
                $validated['discount'] ?? 0
            );

            $tax = (float) (
                $validated['tax'] ?? 0
            );

            $shippingCost = (float) (
                $validated['shipping_cost'] ?? 0
            );

            $total = max(
                0,
                $subtotal
                    - $itemDiscountTotal
                    - $orderDiscount
                    + $tax
                    + $shippingCost
            );

            $order->update([
                'customer_id' => $validated['customer_id'] ?? null,
                'warehouse_id' => $warehouse->id,
                'subtotal' => $subtotal,
                'discount' => $itemDiscountTotal + $orderDiscount,
                'tax' => $tax,
                'shipping_cost' => $shippingCost,
                'total' => $total,
                'notes' => $validated['notes'] ?? null,
                'ordered_at' => $validated['ordered_at'],
            ]);

            $order->items()->delete();

            foreach ($items as $item) {
                $order->items()->create($item);
            }
        });

        $request->user()->notify(
            new SystemNotification(
                'Sales Order Updated',
                "Sales order {$order->order_number} was updated successfully.",
                'sales',
                '◈'
            )
        );

        return redirect()
            ->route('orders.show', $order)
            ->with(
                'success',
                'Sales order updated successfully.'
            );
    }

    public function updateStatus(
        Request $request,
        Order $order
    ) {
        $company = auth()->user()->companies()->first();

        abort_unless($company, 403);

        abort_unless(
            $order->company_id === $company->id,
            404
        );

        $validated = $request->validate([
            'status' => [
                'required',
                'in:pending,confirmed,processing,completed,cancelled',
            ],
        ]);

        $newStatus = $validated['status'];

        $currentStatus = $order->status;

        DB::transaction(function () use (
            $order,
            $newStatus
        ) {
            $order->load('items');

            $currentStatus = $order->status;

            $allowedTransitions = [
                'pending' => [
                    'pending',
                    'confirmed',
                    'cancelled',
                ],

                'confirmed' => [
                    'confirmed',
                    'processing',
                    'cancelled',
                ],

                'processing' => [
                    'processing',
                    'completed',
                    'cancelled',
                ],

                'completed' => [
                    'completed',
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
                422,
                'Invalid order status transition.'
            );

            /*
            |--------------------------------------------------------------------------
            | PENDING -> CONFIRMED
            |--------------------------------------------------------------------------
            | Reserve stock.
            | Physical quantity does not change.
            |--------------------------------------------------------------------------
            */

            if (
                $currentStatus === 'pending' &&
                $newStatus === 'confirmed'
            ) {
                foreach ($order->items as $item) {
                    $inventory = Inventory::where(
                        'warehouse_id',
                        $order->warehouse_id
                    )
                        ->where(
                            'product_variant_id',
                            $item->product_variant_id
                        )
                        ->lockForUpdate()
                        ->first();

                    abort_if(
                        !$inventory,
                        422,
                        'Inventory not found for '
                        . $item->sku
                    );

                    $availableQuantity =
                        (int) $inventory->quantity
                        - (int) $inventory->reserved_quantity;

                    abort_if(
                        $availableQuantity < (int) $item->quantity,
                        422,
                        'Insufficient available stock for '
                        . $item->sku
                    );

                    $inventory->reserved_quantity =
                        (int) $inventory->reserved_quantity
                        + (int) $item->quantity;

                    $inventory->save();
                }
            }

            /*
            |--------------------------------------------------------------------------
            | CONFIRMED -> CANCELLED
            |--------------------------------------------------------------------------
            | Release reserved stock.
            | Physical quantity does not change.
            |--------------------------------------------------------------------------
            */

            if (
                $currentStatus === 'confirmed' &&
                $newStatus === 'cancelled'
            ) {
                foreach ($order->items as $item) {
                    $inventory = Inventory::where(
                        'warehouse_id',
                        $order->warehouse_id
                    )
                        ->where(
                            'product_variant_id',
                            $item->product_variant_id
                        )
                        ->lockForUpdate()
                        ->first();

                    if (!$inventory) {
                        continue;
                    }

                    $inventory->reserved_quantity = max(
                        0,
                        (int) $inventory->reserved_quantity
                        - (int) $item->quantity
                    );

                    $inventory->save();
                }
            }

            /*
            |--------------------------------------------------------------------------
            | PROCESSING -> COMPLETED
            |--------------------------------------------------------------------------
            | Deduct physical stock.
            | Release reservation.
            | Create stock movement.
            |--------------------------------------------------------------------------
            */

            if (
                $currentStatus === 'processing' &&
                $newStatus === 'completed'
            ) {
                foreach ($order->items as $item) {
                    $inventory = Inventory::where(
                        'warehouse_id',
                        $order->warehouse_id
                    )
                        ->where(
                            'product_variant_id',
                            $item->product_variant_id
                        )
                        ->lockForUpdate()
                        ->first();

                    abort_if(
                        !$inventory,
                        422,
                        'Inventory not found for '
                        . $item->sku
                    );

                    abort_if(
                        (int) $inventory->quantity < (int) $item->quantity,
                        422,
                        'Insufficient physical stock for '
                        . $item->sku
                    );

                    $inventory->quantity =
                        (int) $inventory->quantity
                        - (int) $item->quantity;

                    $inventory->reserved_quantity = max(
                        0,
                        (int) $inventory->reserved_quantity
                        - (int) $item->quantity
                    );

                    $inventory->save();

                    StockMovement::create([
                        'company_id' => $order->company_id,
                        'warehouse_id' => $order->warehouse_id,
                        'product_variant_id' => $item->product_variant_id,
                        'user_id' => auth()->id(),
                        'type' => 'sale',
                        'quantity' => $item->quantity,
                        'reference_type' => Order::class,
                        'reference_id' => $order->id,
                        'notes' =>
                            'Stock deducted from sales order '
                            . $order->order_number,
                    ]);
                }
            }

            /*
            |--------------------------------------------------------------------------
            | PROCESSING -> CANCELLED
            |--------------------------------------------------------------------------
            | Release reserved stock.
            | Physical quantity does not change.
            |--------------------------------------------------------------------------
            */

            if (
                $currentStatus === 'processing' &&
                $newStatus === 'cancelled'
            ) {
                foreach ($order->items as $item) {
                    $inventory = Inventory::where(
                        'warehouse_id',
                        $order->warehouse_id
                    )
                        ->where(
                            'product_variant_id',
                            $item->product_variant_id
                        )
                        ->lockForUpdate()
                        ->first();

                    if (!$inventory) {
                        continue;
                    }

                    $inventory->reserved_quantity = max(
                        0,
                        (int) $inventory->reserved_quantity
                        - (int) $item->quantity
                    );

                    $inventory->save();
                }
            }

            $order->update([
                'status' => $newStatus,
            ]);
        });

        /*
        |--------------------------------------------------------------------------
        | Status Notification
        |--------------------------------------------------------------------------
        */

        if ($currentStatus !== $newStatus) {
            $oldStatusLabel = Str::headline($currentStatus);
            $newStatusLabel = Str::headline($newStatus);

            $request->user()->notify(
                new SystemNotification(
                    'Order Status Updated',
                    "Sales order {$order->order_number} changed from {$oldStatusLabel} to {$newStatusLabel}.",
                    'sales',
                    '◈'
                )
            );
        }

        return redirect()
            ->route('orders.show', $order)
            ->with(
                'success',
                'Order status updated successfully.'
            );
    }

    public function updatePaymentStatus(
        Request $request,
        Order $order
    ) {
        $company = auth()->user()->companies()->first();

        abort_unless($company, 403);

        abort_unless(
            $order->company_id === $company->id,
            404
        );

        $validated = $request->validate([
            'payment_status' => [
                'required',
                'in:pending,paid,failed,refunded',
            ],
        ]);

        $newStatus = $validated['payment_status'];

        $currentStatus = $order->payment_status;

        $allowedTransitions = [
            'pending' => [
                'pending',
                'paid',
                'failed',
            ],

            'paid' => [
                'paid',
                'refunded',
            ],

            'failed' => [
                'failed',
                'pending',
                'paid',
            ],

            'refunded' => [
                'refunded',
            ],
        ];

        abort_unless(
            in_array(
                $newStatus,
                $allowedTransitions[$currentStatus] ?? [],
                true
            ),
            422,
            'Invalid payment status transition.'
        );

        $order->update([
            'payment_status' => $newStatus,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Payment Notification
        |--------------------------------------------------------------------------
        */

        if ($currentStatus !== $newStatus) {
            $oldStatusLabel = Str::headline($currentStatus);
            $newStatusLabel = Str::headline($newStatus);

            $request->user()->notify(
                new SystemNotification(
                    'Payment Status Updated',
                    "Payment for {$order->order_number} changed from {$oldStatusLabel} to {$newStatusLabel}.",
                    'sales',
                    '◉'
                )
            );
        }

        return redirect()
            ->route('orders.show', $order)
            ->with(
                'success',
                'Payment status updated successfully.'
            );
    }

    public function destroy(Order $order)
    {
        $company = auth()->user()->companies()->first();

        abort_unless($company, 403);

        abort_unless(
            $order->company_id === $company->id,
            404
        );

        abort_unless(
            $order->status === 'pending',
            422,
            'Only pending orders can be deleted.'
        );

        DB::transaction(function () use ($order) {
            $order->items()->delete();

            $order->delete();
        });

        $request = request();

        $request->user()->notify(
            new SystemNotification(
                'Sales Order Deleted',
                "Sales order {$order->order_number} was deleted.",
                'sales',
                '×'
            )
        );

        return redirect()
            ->route('orders.index')
            ->with(
                'success',
                'Sales order deleted successfully.'
            );
    }

    private function generateOrderNumber(): string
    {
        do {
            $number =
                'SO-'
                . now()->format('Ymd')
                . '-'
                . strtoupper(
                    Str::random(6)
                );
        } while (
            Order::where(
                'order_number',
                $number
            )->exists()
        );

        return $number;
    }
}