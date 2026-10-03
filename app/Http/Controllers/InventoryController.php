<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\ProductVariant;
use App\Models\StockMovement;
use App\Models\Warehouse;
use App\Notifications\SystemNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class InventoryController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Index
    |--------------------------------------------------------------------------
    */

    public function index(Request $request): View
    {
        $company = $request->attributes->get('currentCompany');

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

    /*
    |--------------------------------------------------------------------------
    | Create
    |--------------------------------------------------------------------------
    */

    public function create(Request $request): View
    {
        $company = $request->attributes->get('currentCompany');

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

    /*
    |--------------------------------------------------------------------------
    | Store
    |--------------------------------------------------------------------------
    */

    public function store(
        Request $request
    ): RedirectResponse {
        $company = $request->attributes->get('currentCompany');

        abort_unless($company, 403);

        $validated = $request->validate([
            'warehouse_id' => [
                'required',
                'integer',
                Rule::exists('warehouses', 'id')
                    ->where(
                        fn ($query) => $query->where(
                            'company_id',
                            $company->id
                        )
                        ->where(
                            'is_active',
                            true
                        )
                    ),
            ],

            'product_variant_id' => [
                'required',
                'integer',
                Rule::exists('product_variants', 'id')
                    ->where(
                        fn ($query) => $query->where(
                            'company_id',
                            $company->id
                        )
                        ->where(
                            'is_active',
                            true
                        )
                    ),
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
                'lte:quantity',
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
            ->where(
                'is_active',
                true
            )
            ->firstOrFail();

        DB::transaction(function () use (
            $request,
            $validated,
            $warehouse,
            $variant
        ) {
            $inventory = Inventory::where(
                'warehouse_id',
                $warehouse->id
            )
                ->where(
                    'product_variant_id',
                    $variant->id
                )
                ->lockForUpdate()
                ->first();

            if ($inventory) {
                $previousAvailableQuantity =
                    (int) $inventory->quantity
                    - (int) $inventory->reserved_quantity;

                $previousReorderLevel =
                    (int) $inventory->reorder_level;

                $inventory->update([
                    'quantity' =>
                        (int) $inventory->quantity
                        + (int) $validated['quantity'],

                    'reserved_quantity' =>
                        (int) $validated['reserved_quantity'],

                    'reorder_level' =>
                        (int) $validated['reorder_level'],
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
                |--------------------------------------------------------------------------
                | Low Stock Notification
                |--------------------------------------------------------------------------
                |
                | Send an alert whenever an inventory update results in
                | low stock. Repeated low-stock updates remain visible
                | in the Notification Center.
                |
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
                    |--------------------------------------------------------------------------
                    | Stock Restored Notification
                    |--------------------------------------------------------------------------
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
                        (int) $validated['quantity'],

                    'reserved_quantity' =>
                        (int) $validated['reserved_quantity'],

                    'reorder_level' =>
                        (int) $validated['reorder_level'],
                ]);

                /*
                |--------------------------------------------------------------------------
                | Initial Inventory Notification
                |--------------------------------------------------------------------------
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
        });

        return redirect()
            ->route('inventory.index')
            ->with(
                'success',
                'Inventory added successfully.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | Show
    |--------------------------------------------------------------------------
    */

    public function show(
        Request $request,
        Inventory $inventory
    ): View {
        $company = $request->attributes->get('currentCompany');

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

    /*
    |--------------------------------------------------------------------------
    | Edit
    |--------------------------------------------------------------------------
    */

    public function edit(
        Request $request,
        Inventory $inventory
    ): View {
        $company = $request->attributes->get('currentCompany');

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

    /*
    |--------------------------------------------------------------------------
    | Update
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        Inventory $inventory
    ): RedirectResponse {
        $company = $request->attributes->get('currentCompany');

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
                'lte:quantity',
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
                (int) $validated['quantity'],

            'reserved_quantity' =>
                (int) $validated['reserved_quantity'],

            'reorder_level' =>
                (int) $validated['reorder_level'],
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
        |--------------------------------------------------------------------------
        | Low Stock Notification
        |--------------------------------------------------------------------------
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
            |--------------------------------------------------------------------------
            | Stock Restored Notification
            |--------------------------------------------------------------------------
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