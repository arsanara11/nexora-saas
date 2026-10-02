<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Invoice;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FinanceController extends Controller
{
    public function index(Request $request): View
    {
        $company = $request->attributes->get('currentCompany');

        abort_unless($company, 403);

        /*
        |--------------------------------------------------------------------------
        | Revenue
        |--------------------------------------------------------------------------
        */

        $totalRevenue = Invoice::where(
            'company_id',
            $company->id
        )
            ->where('status', 'paid')
            ->sum('total');

        /*
        |--------------------------------------------------------------------------
        | Expenses
        |--------------------------------------------------------------------------
        */

        $totalExpenses = Expense::where(
            'company_id',
            $company->id
        )
            ->where('status', 'paid')
            ->sum('amount');

        /*
        |--------------------------------------------------------------------------
        | Net Profit
        |--------------------------------------------------------------------------
        */

        $netProfit = $totalRevenue - $totalExpenses;

        /*
        |--------------------------------------------------------------------------
        | Outstanding Invoices
        |--------------------------------------------------------------------------
        */

        $outstandingInvoices = Invoice::where(
            'company_id',
            $company->id
        )
            ->whereIn('status', [
                'issued',
                'overdue',
            ])
            ->sum('total');

        /*
        |--------------------------------------------------------------------------
        | Invoice Summary
        |--------------------------------------------------------------------------
        */

        $invoiceSummary = Invoice::where(
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
        | Recent Invoices
        |--------------------------------------------------------------------------
        */

        $recentInvoices = Invoice::with([
            'order.customer',
        ])
            ->where(
                'company_id',
                $company->id
            )
            ->latest()
            ->limit(8)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Recent Payments
        |--------------------------------------------------------------------------
        */

        $recentPayments = Payment::with([
            'invoice',
        ])
            ->where(
                'company_id',
                $company->id
            )
            ->latest()
            ->limit(8)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Recent Expenses
        |--------------------------------------------------------------------------
        */

        $recentExpenses = Expense::with([
            'user',
        ])
            ->where(
                'company_id',
                $company->id
            )
            ->latest('expense_date')
            ->limit(8)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Financial Overview - Last 6 Months
        |--------------------------------------------------------------------------
        */

        $startDate = Carbon::today()
            ->startOfMonth()
            ->subMonths(5);

        $endDate = Carbon::today()
            ->endOfMonth();

        /*
        |--------------------------------------------------------------------------
        | Revenue By Month
        |--------------------------------------------------------------------------
        */

        $revenueByMonth = Invoice::where(
            'company_id',
            $company->id
        )
            ->where('status', 'paid')
            ->whereNotNull('paid_at')
            ->whereBetween(
                'paid_at',
                [
                    $startDate,
                    $endDate,
                ]
            )
            ->selectRaw(
                'DATE_FORMAT(paid_at, "%Y-%m") as month, SUM(total) as total'
            )
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->keyBy('month');

        /*
        |--------------------------------------------------------------------------
        | Expenses By Month
        |--------------------------------------------------------------------------
        */

        $expensesByMonth = Expense::where(
            'company_id',
            $company->id
        )
            ->where('status', 'paid')
            ->whereBetween(
                'expense_date',
                [
                    $startDate->toDateString(),
                    $endDate->toDateString(),
                ]
            )
            ->selectRaw(
                'DATE_FORMAT(expense_date, "%Y-%m") as month, SUM(amount) as total'
            )
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->keyBy('month');

        /*
        |--------------------------------------------------------------------------
        | Fill All 6 Months
        |--------------------------------------------------------------------------
        */

        $financialOverview = collect();

        for ($i = 0; $i < 6; $i++) {
            $month = $startDate
                ->copy()
                ->addMonths($i);

            $monthKey = $month->format('Y-m');

            $revenue = isset($revenueByMonth[$monthKey])
                ? (float) $revenueByMonth[$monthKey]->total
                : 0;

            $expenses = isset($expensesByMonth[$monthKey])
                ? (float) $expensesByMonth[$monthKey]->total
                : 0;

            $financialOverview->push(
                (object) [
                    'month' => $monthKey,
                    'label' => $month->format('M Y'),
                    'revenue' => $revenue,
                    'expenses' => $expenses,
                    'profit' => $revenue - $expenses,
                ]
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Payment Summary
        |--------------------------------------------------------------------------
        */

        $paymentSummary = Payment::where(
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
        | Payment Method Summary
        |--------------------------------------------------------------------------
        */

        $paymentMethods = Payment::where(
            'company_id',
            $company->id
        )
            ->where('status', 'paid')
            ->selectRaw(
                'method, SUM(amount) as total'
            )
            ->groupBy('method')
            ->orderByDesc('total')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Expense Category Summary
        |--------------------------------------------------------------------------
        */

        $expenseCategories = Expense::where(
            'company_id',
            $company->id
        )
            ->where('status', 'paid')
            ->selectRaw(
                'category, SUM(amount) as total'
            )
            ->groupBy('category')
            ->orderByDesc('total')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Return Finance Dashboard
        |--------------------------------------------------------------------------
        */

        return view('finance.index', compact(
            'totalRevenue',
            'totalExpenses',
            'netProfit',
            'outstandingInvoices',
            'invoiceSummary',
            'recentInvoices',
            'recentPayments',
            'recentExpenses',
            'financialOverview',
            'paymentSummary',
            'paymentMethods',
            'expenseCategories'
        ));
    }
}