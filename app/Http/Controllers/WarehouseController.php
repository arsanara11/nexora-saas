<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Validation\Rule;

class WarehouseController extends Controller
{
    public function index(Request $request): View
    {
        $company = $request->user()->companies()->first();

        abort_unless($company, 403);

        $query = Warehouse::query()
            ->where('company_id', $company->id)
            ->withCount([
                'inventories',
                'orders',
                'purchaseOrders',
                'stockMovements',
            ])
            ->latest();

        if ($request->filled('search')) {
            $search = trim(
                $request->string('search')->toString()
            );

            $query->where(function ($q) use ($search) {
                $q->where(
                    'name',
                    'like',
                    "%{$search}%"
                )
                    ->orWhere(
                        'code',
                        'like',
                        "%{$search}%"
                    )
                    ->orWhere(
                        'city',
                        'like',
                        "%{$search}%"
                    )
                    ->orWhere(
                        'phone',
                        'like',
                        "%{$search}%"
                    )
                    ->orWhere(
                        'address',
                        'like',
                        "%{$search}%"
                    );
            });
        }

        if ($request->filled('status')) {
            $query->where(
                'is_active',
                $request->string('status')->toString() === 'active'
            );
        }

        $warehouses = $query
            ->paginate(15)
            ->withQueryString();

        $summary = [
            'total' => Warehouse::where(
                'company_id',
                $company->id
            )->count(),

            'active' => Warehouse::where(
                'company_id',
                $company->id
            )
                ->where(
                    'is_active',
                    true
                )
                ->count(),

            'inactive' => Warehouse::where(
                'company_id',
                $company->id
            )
                ->where(
                    'is_active',
                    false
                )
                ->count(),

            'with_inventory' => Warehouse::where(
                'company_id',
                $company->id
            )
                ->has('inventories')
                ->count(),
        ];

        return view(
            'warehouses.index',
            compact(
                'warehouses',
                'summary'
            )
        );
    }


    public function create(): View
    {
        return view('warehouses.create');
    }


    public function store(Request $request): RedirectResponse
    {
        $company = $request->user()->companies()->first();

        abort_unless($company, 403);

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'code' => [
                'required',
                'string',
                'max:100',
                Rule::unique(
                    'warehouses',
                    'code'
                )->where(
                    fn ($query) => $query->where(
                        'company_id',
                        $company->id
                    )
                ),
            ],

            'address' => [
                'nullable',
                'string',
                'max:1000',
            ],

            'city' => [
                'nullable',
                'string',
                'max:100',
            ],

            'phone' => [
                'nullable',
                'string',
                'max:50',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],
        ]);

        $validated['company_id'] = $company->id;

        $validated['is_active'] = $request->boolean(
            'is_active',
            true
        );

        $warehouse = Warehouse::create(
            $validated
        );

        return redirect()
            ->route('warehouses.index')
            ->with(
                'success',
                "Warehouse {$warehouse->name} created successfully."
            );
    }


    public function show(
        Request $request,
        Warehouse $warehouse
    ): View {
        $company = $request->user()->companies()->first();

        abort_unless($company, 403);

        abort_unless(
            $warehouse->company_id === $company->id,
            404
        );

        $warehouse->load([
            'inventories.productVariant.product',
            'orders',
            'purchaseOrders.supplier',
            'stockMovements.productVariant.product',
            'stockMovements.user',
        ]);

        $inventoryItems = $warehouse->inventories
            ->sortByDesc('quantity')
            ->values();

        $orderSummary = [
            'sales_orders' => $warehouse->orders->count(),

            'purchase_orders' =>
                $warehouse->purchaseOrders->count(),

            'stock_movements' =>
                $warehouse->stockMovements->count(),

            'inventory_items' =>
                $warehouse->inventories->count(),
        ];

        $stockSummary = [
            'total_quantity' =>
                $warehouse->inventories->sum(
                    fn ($inventory) =>
                        (int) $inventory->quantity
                ),

            'reserved_quantity' =>
                $warehouse->inventories->sum(
                    fn ($inventory) =>
                        (int) $inventory->reserved_quantity
                ),

            'available_quantity' =>
                $warehouse->inventories->sum(
                    fn ($inventory) =>
                        (int) $inventory->quantity
                        - (int) $inventory->reserved_quantity
                ),
        ];

        return view(
            'warehouses.show',
            compact(
                'warehouse',
                'inventoryItems',
                'orderSummary',
                'stockSummary'
            )
        );
    }


    public function edit(Warehouse $warehouse): View
    {
        $company = request()->user()->companies()->first();

        abort_unless($company, 403);

        abort_unless(
            $warehouse->company_id === $company->id,
            404
        );

        return view(
            'warehouses.edit',
            compact('warehouse')
        );
    }


    public function update(
        Request $request,
        Warehouse $warehouse
    ): RedirectResponse {
        $company = $request->user()->companies()->first();

        abort_unless($company, 403);

        abort_unless(
            $warehouse->company_id === $company->id,
            404
        );

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'code' => [
                'required',
                'string',
                'max:100',
                Rule::unique(
                    'warehouses',
                    'code'
                )
                    ->where(
                        fn ($query) => $query->where(
                            'company_id',
                            $company->id
                        )
                    )
                    ->ignore(
                        $warehouse->id
                    ),
            ],

            'address' => [
                'nullable',
                'string',
                'max:1000',
            ],

            'city' => [
                'nullable',
                'string',
                'max:100',
            ],

            'phone' => [
                'nullable',
                'string',
                'max:50',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],
        ]);

        $validated['is_active'] = $request->boolean(
            'is_active'
        );

        $warehouse->update(
            $validated
        );

        return redirect()
            ->route('warehouses.index')
            ->with(
                'success',
                "Warehouse {$warehouse->name} updated successfully."
            );
    }


    public function toggleStatus(
        Request $request,
        Warehouse $warehouse
    ): RedirectResponse {
        $company = $request->user()->companies()->first();

        abort_unless($company, 403);

        abort_unless(
            $warehouse->company_id === $company->id,
            404
        );

        $warehouse->update([
            'is_active' => ! $warehouse->is_active,
        ]);

        return redirect()
            ->back()
            ->with(
                'success',
                "Warehouse {$warehouse->name} status updated."
            );
    }


    public function destroy(
        Request $request,
        Warehouse $warehouse
    ): RedirectResponse {
        $company = $request->user()->companies()->first();

        abort_unless($company, 403);

        abort_unless(
            $warehouse->company_id === $company->id,
            404
        );

        $hasInventory = $warehouse
            ->inventories()
            ->exists();

        $hasOrders = $warehouse
            ->orders()
            ->exists();

        $hasPurchaseOrders = $warehouse
            ->purchaseOrders()
            ->exists();

        $hasStockMovements = $warehouse
            ->stockMovements()
            ->exists();

        if (
            $hasInventory ||
            $hasOrders ||
            $hasPurchaseOrders ||
            $hasStockMovements
        ) {
            return redirect()
                ->route('warehouses.index')
                ->with(
                    'error',
                    'This warehouse cannot be deleted because it is already used by operational records.'
                );
        }

        $warehouseName = $warehouse->name;

        $warehouse->delete();

        return redirect()
            ->route('warehouses.index')
            ->with(
                'success',
                "Warehouse {$warehouseName} deleted successfully."
            );
    }
}