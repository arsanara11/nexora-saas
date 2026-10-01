<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Payment;
use App\Notifications\SystemNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PaymentController extends Controller
{
    /**
     * Display a listing of payments.
     */
    public function index(Request $request): View
    {
        $company = $request->attributes->get('currentCompany');

        abort_unless($company, 403);

        $query = Payment::with(['invoice'])
            ->where('company_id', $company->id)
            ->latest();

        // Search
        if ($request->filled('search')) {
            $search = trim(
                $request->string('search')->toString()
            );

            $query->where(function ($q) use ($search) {
                $q->where('method', 'like', "%{$search}%")
                    ->orWhere('status', 'like', "%{$search}%")
                    ->orWhereHas('invoice', function ($invoiceQuery) use ($search) {
                        $invoiceQuery->where(
                            'invoice_number',
                            'like',
                            "%{$search}%"
                        );
                    });
            });
        }

        // Status filter
        if ($request->filled('status')) {
            $query->where(
                'status',
                $request->string('status')->toString()
            );
        }

        // Payment method filter
        if ($request->filled('method')) {
            $query->where(
                'method',
                $request->string('method')->toString()
            );
        }

        $payments = $query
            ->paginate(12)
            ->withQueryString();

        $methods = Payment::where(
            'company_id',
            $company->id
        )
            ->whereNotNull('method')
            ->where('method', '!=', '')
            ->distinct()
            ->orderBy('method')
            ->pluck('method');

        $summary = [
            'total' => Payment::where(
                'company_id',
                $company->id
            )->count(),

            'paid' => Payment::where(
                'company_id',
                $company->id
            )
                ->where('status', 'paid')
                ->count(),

            'pending' => Payment::where(
                'company_id',
                $company->id
            )
                ->where('status', 'pending')
                ->count(),

            'failed' => Payment::where(
                'company_id',
                $company->id
            )
                ->where('status', 'failed')
                ->count(),

            'refunded' => Payment::where(
                'company_id',
                $company->id
            )
                ->where('status', 'refunded')
                ->count(),

            'paid_amount' => Payment::where(
                'company_id',
                $company->id
            )
                ->where('status', 'paid')
                ->sum('amount'),

            'total_amount' => Payment::where(
                'company_id',
                $company->id
            )->sum('amount'),
        ];

        return view(
            'finance.payments.index',
            compact(
                'payments',
                'methods',
                'summary'
            )
        );
    }

    /**
     * Show the form for creating a new payment.
     */
    public function create(Request $request): View
    {
        $company = $request->attributes->get('currentCompany');

        abort_unless($company, 403);

        $invoices = Invoice::with(['order.customer'])
            ->where('company_id', $company->id)
            ->whereIn('status', ['issued', 'overdue'])
            ->latest()
            ->get();

        return view(
            'finance.payments.create',
            compact('invoices')
        );
    }

    /**
     * Store a newly created payment.
     */
    public function store(Request $request): RedirectResponse
    {
        $user = $request->user();

        $company = $request->attributes->get('currentCompany');

        abort_unless($company, 403);

        $validated = $request->validate([
            'invoice_id' => [
                'required',
                'integer',
                'exists:invoices,id',
            ],

            'amount' => [
                'required',
                'numeric',
                'min:0.01',
            ],

            'method' => [
                'required',
                'string',
                'max:100',
            ],

            'status' => [
                'required',
                'in:pending,paid,failed,refunded',
            ],
        ]);

        $payment = DB::transaction(function () use (
            $validated,
            $company
        ) {
            /*
             * The invoice is explicitly scoped to the
             * current company before the payment is created.
             */
            $invoice = Invoice::where(
                'company_id',
                $company->id
            )
                ->lockForUpdate()
                ->findOrFail($validated['invoice_id']);

            $payment = Payment::create([
                'company_id' => $company->id,
                'invoice_id' => $invoice->id,
                'amount' => $validated['amount'],
                'method' => $validated['method'],
                'status' => $validated['status'],
                'paid_at' => $validated['status'] === 'paid'
                    ? now()
                    : null,
            ]);

            /*
             * Automatically mark invoice as paid
             * when successful payments cover the total.
             */
            if ($payment->status === 'paid') {
                $paidAmount = Payment::where(
                    'invoice_id',
                    $invoice->id
                )
                    ->where('status', 'paid')
                    ->sum('amount');

                if ($paidAmount >= (float) $invoice->total) {
                    $invoice->update([
                        'status' => 'paid',
                        'paid_at' => now(),
                    ]);
                }
            }

            return $payment;
        });

        $user->notify(
            new SystemNotification(
                'Payment Created',
                "Payment of Rp "
                    . number_format(
                        (float) $payment->amount,
                        0,
                        ',',
                        '.'
                    )
                    . " was recorded for invoice "
                    . ($payment->invoice->invoice_number ?? '#')
                    . '.',
                'finance',
                '₋'
            )
        );

        return redirect()
            ->route(
                'finance.payments.show',
                $payment
            )
            ->with(
                'success',
                'Payment created successfully.'
            );
    }

    /**
     * Display the specified payment.
     */
    public function show(
        Request $request,
        Payment $payment
    ): View {
        $company = $request->attributes->get('currentCompany');

        abort_unless($company, 403);

        abort_unless(
            $payment->company_id === $company->id,
            404
        );

        $payment->load([
            'invoice.order.customer',
        ]);

        return view(
            'finance.payments.show',
            compact('payment')
        );
    }

    /**
     * Show the form for editing the specified payment.
     */
    public function edit(
        Request $request,
        Payment $payment
    ): View {
        $company = $request->attributes->get('currentCompany');

        abort_unless($company, 403);

        abort_unless(
            $payment->company_id === $company->id,
            404
        );

        $payment->load([
            'invoice.order.customer',
        ]);

        return view(
            'finance.payments.edit',
            compact('payment')
        );
    }

    /**
     * Update the specified payment.
     */
    public function update(
        Request $request,
        Payment $payment
    ): RedirectResponse {
        $user = $request->user();

        $company = $request->attributes->get('currentCompany');

        abort_unless($company, 403);

        abort_unless(
            $payment->company_id === $company->id,
            404
        );

        $validated = $request->validate([
            'amount' => [
                'required',
                'numeric',
                'min:0.01',
            ],

            'method' => [
                'required',
                'string',
                'max:100',
            ],

            'status' => [
                'required',
                'in:pending,paid,failed,refunded',
            ],
        ]);

        $oldStatus = $payment->status;
        $oldAmount = (float) $payment->amount;

        DB::transaction(function () use (
            $payment,
            $validated,
            $company
        ) {
            $payment->update([
                'amount' => $validated['amount'],
                'method' => $validated['method'],
                'status' => $validated['status'],
                'paid_at' => $validated['status'] === 'paid'
                    ? ($payment->paid_at ?? now())
                    : null,
            ]);

            /*
             * Explicitly scope the invoice to the
             * current company.
             */
            $invoice = Invoice::where(
                'company_id',
                $company->id
            )
                ->lockForUpdate()
                ->find($payment->invoice_id);

            if (! $invoice) {
                return;
            }

            $paidAmount = Payment::where(
                'invoice_id',
                $invoice->id
            )
                ->where('status', 'paid')
                ->sum('amount');

            if ($paidAmount >= (float) $invoice->total) {
                $invoice->update([
                    'status' => 'paid',
                    'paid_at' => now(),
                ]);
            } elseif (
                in_array(
                    $invoice->status,
                    ['paid', 'overdue'],
                    true
                )
                && $paidAmount < (float) $invoice->total
            ) {
                $invoice->update([
                    'status' => 'issued',
                    'paid_at' => null,
                ]);
            }
        });

        $user->notify(
            new SystemNotification(
                'Payment Updated',
                'Payment record was updated successfully.',
                'finance',
                '✎'
            )
        );

        if ($oldStatus !== $payment->status) {
            $user->notify(
                new SystemNotification(
                    'Payment Status Updated',
                    'Payment status changed from '
                        . ucfirst($oldStatus)
                        . ' to '
                        . ucfirst($payment->status)
                        . '.',
                    'finance',
                    '◫'
                )
            );
        }

        if ($oldAmount !== (float) $payment->amount) {
            $user->notify(
                new SystemNotification(
                    'Payment Amount Updated',
                    'Payment amount changed from Rp '
                        . number_format(
                            $oldAmount,
                            0,
                            ',',
                            '.'
                        )
                        . ' to Rp '
                        . number_format(
                            (float) $payment->amount,
                            0,
                            ',',
                            '.'
                        )
                        . '.',
                    'finance',
                    '₋'
                )
            );
        }

        return redirect()
            ->route(
                'finance.payments.show',
                $payment
            )
            ->with(
                'success',
                'Payment updated successfully.'
            );
    }

    /**
     * Remove the specified payment.
     */
    public function destroy(
        Request $request,
        Payment $payment
    ): RedirectResponse {
        $user = $request->user();

        $company = $request->attributes->get('currentCompany');

        abort_unless($company, 403);

        abort_unless(
            $payment->company_id === $company->id,
            404
        );

        $amount = (float) $payment->amount;
        $invoiceId = $payment->invoice_id;

        DB::transaction(function () use (
            $payment,
            $company,
            $invoiceId
        ) {
            $payment->delete();

            /*
             * Recalculate the related invoice only
             * inside the current company.
             */
            $invoice = Invoice::where(
                'company_id',
                $company->id
            )->find($invoiceId);

            if (! $invoice) {
                return;
            }

            $paidAmount = Payment::where(
                'invoice_id',
                $invoice->id
            )
                ->where('status', 'paid')
                ->sum('amount');

            if ($paidAmount < (float) $invoice->total) {
                $invoice->update([
                    'status' => 'issued',
                    'paid_at' => null,
                ]);
            }
        });

        $user->notify(
            new SystemNotification(
                'Payment Deleted',
                'Payment of Rp '
                    . number_format(
                        $amount,
                        0,
                        ',',
                        '.'
                    )
                    . ' was deleted.',
                'finance',
                '×'
            )
        );

        return redirect()
            ->route('finance.payments.index')
            ->with(
                'success',
                'Payment deleted successfully.'
            );
    }
}