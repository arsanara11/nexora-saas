<?php

namespace App\Http\Controllers;

use App\Models\StockMovement;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StockMovementController extends Controller
{
    public function index(Request $request): View
    {
        $company = $request->attributes->get('currentCompany');

        abort_unless($company, 403);

        /*
         * --------------------------------------------------------------------------
         * Summary
         * --------------------------------------------------------------------------
         */

        $baseQuery = StockMovement::query()
            ->where('company_id', $company->id);

        $summary = [
            'total' => (clone $baseQuery)->count(),

            'purchase' => (clone $baseQuery)
                ->where('type', 'purchase')
                ->count(),

            'sale' => (clone $baseQuery)
                ->where('type', 'sale')
                ->count(),

            'adjustment' => (clone $baseQuery)
                ->where('type', 'adjustment')
                ->count(),
        ];

        /*
         * --------------------------------------------------------------------------
         * Main Query
         * --------------------------------------------------------------------------
         */

        $query = StockMovement::query()
            ->where('company_id', $company->id)
            ->with([
                'warehouse',
                'productVariant.product',
                'user',
                'reference',
            ])
            ->latest();

        /*
         * --------------------------------------------------------------------------
         * Search
         * --------------------------------------------------------------------------
         */

        if ($request->filled('search')) {
            $search = trim(
                $request->string('search')->toString()
            );

            $query->where(function ($q) use ($search) {
                $q->where(
                    'type',
                    'like',
                    "%{$search}%"
                )
                    ->orWhere(
                        'notes',
                        'like',
                        "%{$search}%"
                    )
                    ->orWhere(
                        'reference_type',
                        'like',
                        "%{$search}%"
                    )
                    ->orWhere(
                        'reference_id',
                        'like',
                        "%{$search}%"
                    )
                    ->orWhereHas(
                        'warehouse',
                        function ($warehouseQuery) use ($search) {
                            $warehouseQuery
                                ->where('name', 'like', "%{$search}%")
                                ->orWhere('code', 'like', "%{$search}%");
                        }
                    )
                    ->orWhereHas(
                        'productVariant',
                        function ($variantQuery) use ($search) {
                            $variantQuery
                                ->where('sku', 'like', "%{$search}%")
                                ->orWhere('name', 'like', "%{$search}%")
                                ->orWhereHas(
                                    'product',
                                    function ($productQuery) use ($search) {
                                        $productQuery
                                            ->where(
                                                'name',
                                                'like',
                                                "%{$search}%"
                                            )
                                            ->orWhere(
                                                'brand',
                                                'like',
                                                "%{$search}%"
                                            );
                                    }
                                );
                        }
                    )
                    ->orWhereHas(
                        'user',
                        function ($userQuery) use ($search) {
                            $userQuery
                                ->where(
                                    'name',
                                    'like',
                                    "%{$search}%"
                                )
                                ->orWhere(
                                    'email',
                                    'like',
                                    "%{$search}%"
                                );
                        }
                    );
            });
        }

        /*
         * --------------------------------------------------------------------------
         * Type Filter
         * --------------------------------------------------------------------------
         */

        if ($request->filled('type')) {
            $query->where(
                'type',
                $request->string('type')->toString()
            );
        }

        /*
         * --------------------------------------------------------------------------
         * Warehouse Filter
         * --------------------------------------------------------------------------
         */

        if ($request->filled('warehouse_id')) {
            $warehouseId = $request->integer(
                'warehouse_id'
            );

            $warehouseBelongsToCompany = Warehouse::query()
                ->whereKey($warehouseId)
                ->where(
                    'company_id',
                    $company->id
                )
                ->exists();

            abort_unless(
                $warehouseBelongsToCompany,
                404
            );

            $query->where(
                'warehouse_id',
                $warehouseId
            );
        }

        /*
         * --------------------------------------------------------------------------
         * Date Filter
         * --------------------------------------------------------------------------
         */

        if ($request->filled('date_from')) {
            $query->whereDate(
                'created_at',
                '>=',
                $request->string('date_from')->toString()
            );
        }

        if ($request->filled('date_to')) {
            $query->whereDate(
                'created_at',
                '<=',
                $request->string('date_to')->toString()
            );
        }

        /*
         * --------------------------------------------------------------------------
         * Result
         * --------------------------------------------------------------------------
         */

        $movements = $query
            ->paginate(20)
            ->withQueryString();

        /*
         * --------------------------------------------------------------------------
         * Warehouses
         * --------------------------------------------------------------------------
         */

        $warehouses = Warehouse::query()
            ->where(
                'company_id',
                $company->id
            )
            ->orderBy('name')
            ->get();

        return view(
            'stock-movements.index',
            compact(
                'movements',
                'warehouses',
                'summary'
            )
        );
    }

    public function show(
        Request $request,
        StockMovement $stockMovement
    ): View {
        $company = $request->attributes->get('currentCompany');

        abort_unless($company, 403);

        abort_unless(
            $stockMovement->company_id === $company->id,
            404
        );

        $stockMovement->load([
            'warehouse',
            'productVariant.product',
            'user',
            'reference',
        ]);

        abort_unless(
            $stockMovement->warehouse
            && $stockMovement->warehouse->company_id === $company->id,
            404
        );

        abort_unless(
            $stockMovement->productVariant
            && $stockMovement->productVariant->company_id === $company->id,
            404
        );

        return view(
            'stock-movements.show',
            compact('stockMovement')
        );
    }
}