<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Inventory;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductVariant;
use App\Models\StockMovement;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    public function index(Request $request)
    {
        $company = $request->attributes->get('currentCompany');

        abort_unless($company, 403);

        /*
        |--------------------------------------------------------------------------
        | Date Range
        |--------------------------------------------------------------------------
        */

        $startDate = Carbon::today()
            ->subDays(29)
            ->startOfDay();

        $endDate = Carbon::today()
            ->endOfDay();

        /*
        |--------------------------------------------------------------------------
        | Sales Summary
        |--------------------------------------------------------------------------
        */

        $completedOrders = Order::where(
            'company_id',
            $company->id
        )
            ->where('status', 'completed');

        $totalRevenue = (clone $completedOrders)
            ->sum('total');

        $totalOrders = (clone $completedOrders)
            ->count();

        $averageOrderValue = $totalOrders > 0
            ? $totalRevenue / $totalOrders
            : 0;

        $cancelledOrders = Order::where(
            'company_id',
            $company->id
        )
            ->where('status', 'cancelled')
            ->count();

        /*
        |--------------------------------------------------------------------------
        | Sales Trend - Last 30 Days
        |--------------------------------------------------------------------------
        */

        $salesByDate = Order::where(
            'company_id',
            $company->id
        )
            ->where('status', 'completed')
            ->whereNotNull('ordered_at')
            ->whereBetween(
                'ordered_at',
                [
                    $startDate,
                    $endDate,
                ]
            )
            ->selectRaw(
                'DATE(ordered_at) as date, SUM(total) as total'
            )
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->keyBy('date');

        $salesTrend = collect();

        for ($i = 0; $i < 30; $i++) {
            $date = $startDate
                ->copy()
                ->addDays($i);

            $dateKey = $date->format('Y-m-d');

            $salesTrend->push(
                (object) [
                    'date' => $dateKey,
                    'label' => $date->format('d M'),
                    'total' => isset($salesByDate[$dateKey])
                        ? (float) $salesByDate[$dateKey]->total
                        : 0,
                ]
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Order Status
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
        | Top Selling Products
        |--------------------------------------------------------------------------
        */

        $topProducts = OrderItem::query()
            ->select(
                'order_items.product_variant_id',
                'order_items.product_name',
                DB::raw(
                    'SUM(order_items.quantity) as total_quantity'
                ),
                DB::raw(
                    'SUM(order_items.total) as total_sales'
                )
            )
            ->join(
                'orders',
                'orders.id',
                '=',
                'order_items.order_id'
            )
            ->where(
                'orders.company_id',
                $company->id
            )
            ->where(
                'orders.status',
                'completed'
            )
            ->groupBy(
                'order_items.product_variant_id',
                'order_items.product_name'
            )
            ->orderByDesc('total_quantity')
            ->limit(8)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Sales By Category
        |--------------------------------------------------------------------------
        */

        $salesByCategory = OrderItem::query()
            ->select(
                'categories.name',
                DB::raw(
                    'SUM(order_items.total) as total'
                )
            )
            ->join(
                'orders',
                'orders.id',
                '=',
                'order_items.order_id'
            )
            ->join(
                'product_variants',
                'product_variants.id',
                '=',
                'order_items.product_variant_id'
            )
            ->join(
                'products',
                'products.id',
                '=',
                'product_variants.product_id'
            )
            ->leftJoin(
                'categories',
                'categories.id',
                '=',
                'products.category_id'
            )
            ->where(
                'orders.company_id',
                $company->id
            )
            ->where(
                'orders.status',
                'completed'
            )
            ->groupBy('categories.name')
            ->orderByDesc('total')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Customer Performance
        |--------------------------------------------------------------------------
        */

        $customerPerformance = Order::query()
            ->select(
                'customers.id',
                'customers.name',
                DB::raw(
                    'COUNT(orders.id) as total_orders'
                ),
                DB::raw(
                    'SUM(orders.total) as total_spent'
                )
            )
            ->join(
                'customers',
                'customers.id',
                '=',
                'orders.customer_id'
            )
            ->where(
                'orders.company_id',
                $company->id
            )
            ->where(
                'orders.status',
                'completed'
            )
            ->groupBy(
                'customers.id',
                'customers.name'
            )
            ->orderByDesc('total_spent')
            ->limit(8)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Inventory Overview
        |--------------------------------------------------------------------------
        */

        $inventories = Inventory::with([
            'warehouse',
            'productVariant.product',
        ])
            ->whereHas(
                'warehouse',
                function ($query) use ($company) {
                    $query->where(
                        'company_id',
                        $company->id
                    );
                }
            )
            ->get();

        $totalStockUnits = $inventories->sum(
            'quantity'
        );

        $totalReservedUnits = $inventories->sum(
            'reserved_quantity'
        );

        $lowStockCount = $inventories
            ->filter(
                function ($inventory) {
                    return $inventory->available_quantity
                        <= $inventory->reorder_level;
                }
            )
            ->count();

        $outOfStockCount = $inventories
            ->filter(
                function ($inventory) {
                    return $inventory->available_quantity <= 0;
                }
            )
            ->count();

        /*
        |--------------------------------------------------------------------------
        | Stock Movement Summary
        |--------------------------------------------------------------------------
        */

        $stockMovementSummary = StockMovement::where(
            'company_id',
            $company->id
        )
            ->whereBetween(
                'created_at',
                [
                    $startDate,
                    $endDate,
                ]
            )
            ->selectRaw(
                'type, SUM(quantity) as total'
            )
            ->groupBy('type')
            ->orderByDesc('total')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Customer Summary
        |--------------------------------------------------------------------------
        */

        $totalCustomers = Customer::where(
            'company_id',
            $company->id
        )->count();

        $activeCustomers = Customer::where(
            'company_id',
            $company->id
        )
            ->where('is_active', true)
            ->count();

        /*
        |--------------------------------------------------------------------------
        | Product Summary
        |--------------------------------------------------------------------------
        */

        $totalProducts = ProductVariant::where(
            'company_id',
            $company->id
        )
            ->where('is_active', true)
            ->count();

        /*
        |--------------------------------------------------------------------------
        | Recent Sales
        |--------------------------------------------------------------------------
        */

        $recentSales = Order::with([
            'customer',
            'warehouse',
        ])
            ->where(
                'company_id',
                $company->id
            )
            ->where(
                'status',
                'completed'
            )
            ->latest('ordered_at')
            ->limit(8)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Return Analytics Dashboard
        |--------------------------------------------------------------------------
        */

        return view(
            'analytics.index',
            compact(
                'totalRevenue',
                'totalOrders',
                'averageOrderValue',
                'cancelledOrders',
                'salesTrend',
                'orderStatusSummary',
                'topProducts',
                'salesByCategory',
                'customerPerformance',
                'totalStockUnits',
                'totalReservedUnits',
                'lowStockCount',
                'outOfStockCount',
                'stockMovementSummary',
                'totalCustomers',
                'activeCustomers',
                'totalProducts',
                'recentSales'
            )
        );
    }
}