<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\ProductVariant;
use App\Models\StockMovement;
use App\Models\Warehouse;
use App\Notifications\SystemNotification;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index()
    {
        $company = request()->attributes->get('currentCompany');

        abort_unless($company, 403);

        $inventories = Inventory::with([
            'warehouse',
            'productVariant.product',
        ])
            ->whereHas('warehouse', function ($query) use ($company) {
                $query->where(
                    'company_id',
                    $company->id
                );
            })
            ->whereHas('productVariant', function ($query) use ($company) {
                $query->where(
                    'company_id',
                    $company->id
                );
            })
            ->latest()
            ->get();

        $stockMovements = StockMovement::with([
            'warehouse',
            'productVariant.product',
            'user',
            'reference',
        ])
            ->where(
                'company_id',
                $company->id
            )
            ->latest()
            ->get();

        return view(
            'inventory.index',
            compact(
                'inventories',
                'stockMovements'
            )
        );
    }

    public function create()
    {
        $company = request()->attributes->get('currentCompany');

        abort_unless($company, 403);

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
            'inventory.create',
            compact(
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
            'warehouse_id' => [
                'required',
                'exists:warehouses,id',
            ],

            'product_variant_id' => [
                'required',
                'exists:product_variants,id',
            ],

            'quantity' => [
                'required',
                'integer',
                'min:0',
            ],

            'reserved_quantity' => [
                'required',
                'integer',
                'min:0',
            ],

            'reorder_level' => [
                'required',
                'integer',
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
            ->where(
                'is_active',
                true
            )
            ->firstOrFail();

        $variant = ProductVariant::with('product')
            ->where(
                'id',
                $validated['product_variant_id']
            )
            ->where(
                'company_id',
                $company->id
            )
            ->firstOrFail();

        $inventory = Inventory::where(
            'warehouse_id',
            $warehouse->id
        )
            ->where(
                'product_variant_id',
                $variant->id
            )
            ->first();

        if ($inventory) {
            $previousAvailableQuantity =
                (int) $inventory->quantity
                - (int) $inventory->reserved_quantity;

            $previousReorderLevel =
                (int) $inventory->reorder_level;

            $inventory->update([
                'quantity' =>
                    $inventory->quantity
                    + $validated['quantity'],

                'reserved_quantity' =>
                    $validated['reserved_quantity'],

                'reorder_level' =>
                    $validated['reorder_level'],
            ]);

            $inventory->refresh();

            $currentAvailableQuantity =
                (int) $inventory->quantity
                - (int) $inventory->reserved_quantity;

            $wasLowStock =
                $previousAvailableQuantity
                <= $previousReorderLevel;

            $isLowStock =
                $currentAvailableQuantity
                <= (int) $inventory->reorder_level;

            $isOutOfStock =
                $currentAvailableQuantity <= 0;

            /*
             * --------------------------------------------------------------------------
             * Low Stock Notification
             * --------------------------------------------------------------------------
             *
             * Send an alert whenever an inventory update results in low stock.
             * This intentionally does not require the inventory to have just
             * entered the low-stock state, so repeated updates remain visible
             * in the Notification Center.
             *
             */

            if ($isLowStock) {
                $productName =
                    $variant->product?->name
                    ?? $variant->name;

                if ($isOutOfStock) {
                    $title = 'Inventory Out of Stock';

                    $message =
                        "{$productName} is out of stock "
                        . "at {$warehouse->name}.";
                } else {
                    $title = 'Low Stock Alert';

                    $message =
                        "{$productName} is running low "
                        . "at {$warehouse->name}. "
                        . "Available stock: {$currentAvailableQuantity}.";
                }

                $request->user()->notify(
                    new SystemNotification(
                        $title,
                        $message,
                        'inventory',
                        '▣'
                    )
                );
            } elseif ($wasLowStock && ! $isLowStock) {
                /*
                 * --------------------------------------------------------------------------
                 * Stock Restored Notification
                 * --------------------------------------------------------------------------
                 */

                $productName =
                    $variant->product?->name
                    ?? $variant->name;

                $request->user()->notify(
                    new SystemNotification(
                        'Inventory Restored',
                        "{$productName} stock at {$warehouse->name} is back above the reorder level.",
                        'inventory',
                        '▣'
                    )
                );
            }
        } else {
            $inventory = Inventory::create([
                'warehouse_id' =>
                    $warehouse->id,

                'product_variant_id' =>
                    $variant->id,

                'quantity' =>
                    $validated['quantity'],

                'reserved_quantity' =>
                    $validated['reserved_quantity'],

                'reorder_level' =>
                    $validated['reorder_level'],
            ]);

            /*
             * --------------------------------------------------------------------------
             * Initial Inventory Notification
             * --------------------------------------------------------------------------
             */

            $availableQuantity =
                (int) $inventory->quantity
                - (int) $inventory->reserved_quantity;

            $isOutOfStock =
                $availableQuantity <= 0;

            $isLowStock =
                $availableQuantity
                <= (int) $inventory->reorder_level;

            if ($isLowStock) {
                $productName =
                    $variant->product?->name
                    ?? $variant->name;

                if ($isOutOfStock) {
                    $title = 'Inventory Out of Stock';

                    $message =
                        "{$productName} is out of stock "
                        . "at {$warehouse->name}.";
                } else {
                    $title = 'Low Stock Alert';

                    $message =
                        "{$productName} is running low "
                        . "at {$warehouse->name}. "
                        . "Available stock: {$availableQuantity}.";
                }

                $request->user()->notify(
                    new SystemNotification(
                        $title,
                        $message,
                        'inventory',
                        '▣'
                    )
                );
            }
        }

        return redirect()
            ->route('inventory.index')
            ->with(
                'success',
                'Inventory added successfully.'
            );
    }

    public function show(Inventory $inventory)
    {
        $company = request()->attributes->get('currentCompany');

        abort_unless($company, 403);

        $inventory->load([
            'warehouse',
            'productVariant.product',
        ]);

        abort_unless(
            $inventory->warehouse
            && $inventory->warehouse->company_id === $company->id,
            404
        );

        abort_unless(
            $inventory->productVariant
            && $inventory->productVariant->company_id === $company->id,
            404
        );

        return view(
            'inventory.show',
            compact('inventory')
        );
    }

    public function edit(Inventory $inventory)
    {
        $company = request()->attributes->get('currentCompany');

        abort_unless($company, 403);

        $inventory->load([
            'warehouse',
            'productVariant.product',
        ]);

        abort_unless(
            $inventory->warehouse
            && $inventory->warehouse->company_id === $company->id,
            404
        );

        abort_unless(
            $inventory->productVariant
            && $inventory->productVariant->company_id === $company->id,
            404
        );

        return view(
            'inventory.edit',
            compact('inventory')
        );
    }

    public function update(
        Request $request,
        Inventory $inventory
    ) {
        $company = request()->attributes->get('currentCompany');

        abort_unless($company, 403);

        $inventory->load([
            'warehouse',
            'productVariant.product',
        ]);

        abort_unless(
            $inventory->warehouse
            && $inventory->warehouse->company_id === $company->id,
            404
        );

        abort_unless(
            $inventory->productVariant
            && $inventory->productVariant->company_id === $company->id,
            404
        );

        $validated = $request->validate([
            'quantity' => [
                'required',
                'integer',
                'min:0',
            ],

            'reserved_quantity' => [
                'required',
                'integer',
                'min:0',
            ],

            'reorder_level' => [
                'required',
                'integer',
                'min:0',
            ],
        ]);

        $previousAvailableQuantity =
            (int) $inventory->quantity
            - (int) $inventory->reserved_quantity;

        $previousReorderLevel =
            (int) $inventory->reorder_level;

        $wasLowStock =
            $previousAvailableQuantity
            <= $previousReorderLevel;

        $inventory->update([
            'quantity' =>
                $validated['quantity'],

            'reserved_quantity' =>
                $validated['reserved_quantity'],

            'reorder_level' =>
                $validated['reorder_level'],
        ]);

        $inventory->refresh();

        $currentAvailableQuantity =
            (int) $inventory->quantity
            - (int) $inventory->reserved_quantity;

        $isLowStock =
            $currentAvailableQuantity
            <= (int) $inventory->reorder_level;

        $isOutOfStock =
            $currentAvailableQuantity <= 0;

        /*
         * --------------------------------------------------------------------------
         * Low Stock Notification
         * --------------------------------------------------------------------------
         *
         * Send a notification whenever the updated inventory is currently
         * at or below the reorder level.
         *
         */

        if ($isLowStock) {
            $productName =
                $inventory->productVariant->product?->name
                ?? $inventory->productVariant->name;

            if ($isOutOfStock) {
                $title = 'Inventory Out of Stock';

                $message =
                    "{$productName} is out of stock "
                    . "at {$inventory->warehouse->name}.";
            } else {
                $title = 'Low Stock Alert';

                $message =
                    "{$productName} is running low "
                    . "at {$inventory->warehouse->name}. "
                    . "Available stock: {$currentAvailableQuantity}.";
            }

            $request->user()->notify(
                new SystemNotification(
                    $title,
                    $message,
                    'inventory',
                    '▣'
                )
            );
        } elseif ($wasLowStock && ! $isLowStock) {
            /*
             * --------------------------------------------------------------------------
             * Stock Restored Notification
             * --------------------------------------------------------------------------
             */

            $productName =
                $inventory->productVariant->product?->name
                ?? $inventory->productVariant->name;

            $request->user()->notify(
                new SystemNotification(
                    'Inventory Restored',
                    "{$productName} stock at {$inventory->warehouse->name} is back above the reorder level.",
                    'inventory',
                    '▣'
                )
            );
        }

        return redirect()
            ->route(
                'inventory.show',
                $inventory
            )
            ->with(
                'success',
                'Inventory updated successfully.'
            );
    }
}