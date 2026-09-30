<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Expense;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GlobalSearchController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $company = $request->user()->companies()->first();

        abort_unless($company, 403);

        $search = trim($request->string('q')->toString());

        if ($search === '' || mb_strlen($search) < 2) {
            return response()->json([
                'results' => [],
            ]);
        }

        $term = '%' . $search . '%';

        $results = [];


        /*
        |--------------------------------------------------------------------------
        | Products
        |--------------------------------------------------------------------------
        */

        if ($request->user()->hasPermission('Manage Products')) {

            $products = Product::query()
                ->where('company_id', $company->id)
                ->where(function ($query) use ($term) {

                    $query
                        ->where('name', 'like', $term)
                        ->orWhere('brand', 'like', $term);

                })
                ->latest()
                ->limit(5)
                ->get();

            foreach ($products as $product) {

                $results[] = [
                    'type' => 'Product',
                    'title' => $product->name,
                    'subtitle' => $product->brand
                        ?: 'Product',
                    'icon' => '□',
                    'url' => route('products.show', $product),
                ];

            }

        }


        /*
        |--------------------------------------------------------------------------
        | Customers
        |--------------------------------------------------------------------------
        */

        if ($request->user()->hasPermission('Manage Customers')) {

            $customers = Customer::query()
                ->where('company_id', $company->id)
                ->where(function ($query) use ($term) {

                    $query
                        ->where('name', 'like', $term)
                        ->orWhere('email', 'like', $term)
                        ->orWhere('phone', 'like', $term);

                })
                ->latest()
                ->limit(5)
                ->get();

            foreach ($customers as $customer) {

                $results[] = [
                    'type' => 'Customer',
                    'title' => $customer->name,
                    'subtitle' => $customer->email
                        ?: ($customer->phone ?: 'Customer'),
                    'icon' => '♙',
                    'url' => route('customers.show', $customer),
                ];

            }

        }


        /*
        |--------------------------------------------------------------------------
        | Orders
        |--------------------------------------------------------------------------
        */

        if ($request->user()->hasPermission('Manage Sales')) {

            $orders = Order::query()
                ->with('customer')
                ->where('company_id', $company->id)
                ->where(function ($query) use ($term) {

                    $query
                        ->where('order_number', 'like', $term)
                        ->orWhere('status', 'like', $term)
                        ->orWhereHas('customer', function ($customerQuery) use ($term) {

                            $customerQuery
                                ->where('name', 'like', $term)
                                ->orWhere('email', 'like', $term);

                        });

                })
                ->latest()
                ->limit(5)
                ->get();

            foreach ($orders as $order) {

                $results[] = [
                    'type' => 'Order',
                    'title' => $order->order_number,
                    'subtitle' => $order->customer?->name
                        ?: ucfirst((string) $order->status),
                    'icon' => '◈',
                    'url' => route('orders.show', $order),
                ];

            }

        }


        /*
        |--------------------------------------------------------------------------
        | Invoices
        |--------------------------------------------------------------------------
        */

        if ($request->user()->hasPermission('Manage Finance')) {

            $invoices = Invoice::query()
                ->with('order.customer')
                ->where('company_id', $company->id)
                ->where(function ($query) use ($term) {

                    $query
                        ->where('invoice_number', 'like', $term)
                        ->orWhere('status', 'like', $term)
                        ->orWhereHas('order.customer', function ($customerQuery) use ($term) {

                            $customerQuery
                                ->where('name', 'like', $term)
                                ->orWhere('email', 'like', $term);

                        });

                })
                ->latest()
                ->limit(5)
                ->get();

            foreach ($invoices as $invoice) {

                $results[] = [
                    'type' => 'Invoice',
                    'title' => $invoice->invoice_number,
                    'subtitle' => $invoice->order?->customer?->name
                        ?: ucfirst((string) $invoice->status),
                    'icon' => '◫',
                    'url' => route('finance.invoices.show', $invoice),
                ];

            }

        }


        /*
        |--------------------------------------------------------------------------
        | Payments
        |--------------------------------------------------------------------------
        */

        if ($request->user()->hasPermission('Manage Finance')) {

            $payments = Payment::query()
                ->with('invoice')
                ->where('company_id', $company->id)
                ->where(function ($query) use ($term) {

                    $query
                        ->where('method', 'like', $term)
                        ->orWhere('status', 'like', $term)
                        ->orWhereHas('invoice', function ($invoiceQuery) use ($term) {

                            $invoiceQuery
                                ->where('invoice_number', 'like', $term);

                        });

                })
                ->latest()
                ->limit(5)
                ->get();

            foreach ($payments as $payment) {

                $results[] = [
                    'type' => 'Payment',
                    'title' => 'Rp ' . number_format(
                        (float) $payment->amount,
                        0,
                        ',',
                        '.'
                    ),
                    'subtitle' => $payment->invoice?->invoice_number
                        ?: ucwords(
                            str_replace('_', ' ', $payment->method)
                        ),
                    'icon' => '₋',
                    'url' => route('finance.payments.show', $payment),
                ];

            }

        }


        /*
        |--------------------------------------------------------------------------
        | Expenses
        |--------------------------------------------------------------------------
        */

        if ($request->user()->hasPermission('Manage Finance')) {

            $expenses = Expense::query()
                ->where('company_id', $company->id)
                ->where(function ($query) use ($term) {

                    $query
                        ->where('description', 'like', $term)
                        ->orWhere('category', 'like', $term)
                        ->orWhere('status', 'like', $term);

                })
                ->latest()
                ->limit(5)
                ->get();

            foreach ($expenses as $expense) {

                $results[] = [
                    'type' => 'Expense',
                    'title' => $expense->description,
                    'subtitle' => $expense->category
                        ?: ucfirst((string) $expense->status),
                    'icon' => '−',
                    'url' => route('finance.expenses.show', $expense),
                ];

            }

        }


        return response()->json([
            'results' => array_slice($results, 0, 12),
        ]);
    }
}