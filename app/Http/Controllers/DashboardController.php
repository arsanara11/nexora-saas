<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Inventory;
use App\Models\Order;
use App\Models\StockMovement;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $company = auth()->user()->companies()->first();

        abort_unless($company, 403);

        /*
        |--------------------------------------------------------------------------
        | Orders
        |--------------------------------------------------------------------------
        */

        $orders = Order::where(
            'company_id',
            $company->id
        );

        $totalOrders = (clone $orders)->count();

        $totalSales = (clone $orders)
            ->where('status', 'completed')
            ->sum('total');


        /*
        |--------------------------------------------------------------------------
        | Customers
        |--------------------------------------------------------------------------
        */

        $totalCustomers = Customer::where(
            'company_id',
            $company->id
        )->count();


        /*
        |--------------------------------------------------------------------------
        | Low Stock
        |--------------------------------------------------------------------------
        */

        $inventoryItems = Inventory::with([
            'warehouse',
            'productVariant.product',
        ])
            ->whereHas('warehouse', function ($query) use ($company) {
                $query->where(
                    'company_id',
                    $company->id
                );
            })
            ->get();

        $lowStockItems = $inventoryItems
            ->filter(function ($inventory) {
                return $inventory->available_quantity
                    <= $inventory->reorder_level;
            })
            ->sortBy('available_quantity')
            ->values();


        /*
        |--------------------------------------------------------------------------
        | Recent Orders
        |--------------------------------------------------------------------------
        */

        $recentOrders = Order::with([
            'customer',
            'warehouse',
        ])
            ->where(
                'company_id',
                $company->id
            )
            ->latest()
            ->limit(6)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Recent Stock Movements
        |--------------------------------------------------------------------------
        */

        $recentStockMovements = StockMovement::with([
            'warehouse',
            'productVariant.product',
            'user',
        ])
            ->where(
                'company_id',
                $company->id
            )
            ->latest()
            ->limit(6)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Sales Overview - Last 30 Days
        |--------------------------------------------------------------------------
        */

        $startDate = Carbon::today()->subDays(29);
        $endDate = Carbon::today();

        $salesByDate = Order::where(
            'company_id',
            $company->id
        )
            ->where('status', 'completed')
            ->whereNotNull('ordered_at')
            ->whereBetween(
                'ordered_at',
                [
                    $startDate->copy()->startOfDay(),
                    $endDate->copy()->endOfDay(),
                ]
            )
            ->selectRaw(
                'DATE(ordered_at) as date, SUM(total) as total'
            )
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->keyBy('date');


        /*
        |--------------------------------------------------------------------------
        | Fill All 30 Days
        |--------------------------------------------------------------------------
        */

        $salesOverview = collect();

        for ($i = 0; $i < 30; $i++) {

            $date = $startDate
                ->copy()
                ->addDays($i);

            $dateKey = $date->format('Y-m-d');

            $salesOverview->push(
                (object) [
                    'date' => $dateKey,

                    'total' => isset($salesByDate[$dateKey])
                        ? (float) $salesByDate[$dateKey]->total
                        : 0,
                ]
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Order Status Summary
        |--------------------------------------------------------------------------
        */

        $orderStatusSummary = Order::where(
            'company_id',
            $company->id
        )
            ->selectRaw(
                'status, COUNT(*) as total'
            )
            ->groupBy('status')
            ->pluck('total', 'status');


        /*
        |--------------------------------------------------------------------------
        | Return Dashboard
        |--------------------------------------------------------------------------
        */

        return view('dashboard', compact(
            'totalOrders',
            'totalSales',
            'totalCustomers',
            'lowStockItems',
            'recentOrders',
            'recentStockMovements',
            'salesOverview',
            'orderStatusSummary'
        ));
    }
}