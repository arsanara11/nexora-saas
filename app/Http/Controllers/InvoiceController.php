<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Order;
use App\Notifications\SystemNotification;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class InvoiceController extends Controller
{
    public function index(Request $request): View
    {
        $company = $request->user()->companies()->first();

        abort_unless($company, 403);

        $query = Invoice::with([
            'order.customer',
        ])
            ->where('company_id', $company->id)
            ->latest();

        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {
            $search = trim($request->input('search'));

            $query->where(function ($q) use ($search) {
                $q->where(
                    'invoice_number',
                    'like',
                    "%{$search}%"
                )
                    ->orWhereHas('order', function ($orderQuery) use ($search) {
                        $orderQuery
                            ->where(
                                'order_number',
                                'like',
                                "%{$search}%"
                            )
                            ->orWhereHas(
                                'customer',
                                function ($customerQuery) use ($search) {
                                    $customerQuery->where(
                                        'name',
                                        'like',
                                        "%{$search}%"
                                    );
                                }
                            );
                    });
            });
        }

        /*
        |--------------------------------------------------------------------------
        | Status Filter
        |--------------------------------------------------------------------------
        */

        if ($request->filled('status')) {
            $status = $request->input('status');

            if (in_array(
                $status,
                [
                    'draft',
                    'issued',
                    'paid',
                    'overdue',
                    'cancelled',
                ],
                true
            )) {
                $query->where('status', $status);
            }
        }

        $invoices = $query
            ->paginate(12)
            ->withQueryString();

        return view(
            'finance.invoices.index',
            compact('invoices')
        );
    }


    public function create(Request $request): View
    {
        $company = $request->user()->companies()->first();

        abort_unless($company, 403);

        $orders = Order::with('customer')
            ->where(
                'company_id',
                $company->id
            )
            ->whereNotIn(
                'id',
                function ($query) use ($company) {
                    $query
                        ->select('order_id')
                        ->from('invoices')
                        ->where(
                            'company_id',
                            $company->id
                        )
                        ->whereNotNull('order_id');
                }
            )
            ->latest()
            ->get();

        return view(
            'finance.invoices.create',
            compact('orders')
        );
    }


    public function store(Request $request): RedirectResponse
    {
        $company = $request->user()->companies()->first();

        abort_unless($company, 403);

        $validated = $request->validate([
            'order_id' => [
                'required',
                Rule::exists('orders', 'id')->where(
                    fn ($query) => $query->where(
                        'company_id',
                        $company->id
                    )
                ),
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

            'due_at' => [
                'nullable',
                'date',
            ],

            'notes' => [
                'nullable',
                'string',
                'max:5000',
            ],
        ]);

        $invoice = DB::transaction(
            function () use (
                $validated,
                $company,
                $request
            ) {
                $order = Order::with('customer')
                    ->where(
                        'company_id',
                        $company->id
                    )
                    ->lockForUpdate()
                    ->findOrFail(
                        $validated['order_id']
                    );

                $existingInvoice = Invoice::where(
                    'company_id',
                    $company->id
                )
                    ->where(
                        'order_id',
                        $order->id
                    )
                    ->lockForUpdate()
                    ->first();

                if ($existingInvoice) {
                    abort(
                        422,
                        'This order already has an invoice.'
                    );
                }

                $subtotal = (float) (
                    $order->subtotal ?? 0
                );

                $discount = (float) (
                    $validated['discount']
                    ?? $order->discount
                    ?? 0
                );

                $tax = (float) (
                    $validated['tax']
                    ?? $order->tax
                    ?? 0
                );

                $shippingCost = (float) (
                    $validated['shipping_cost']
                    ?? $order->shipping_cost
                    ?? 0
                );

                $total = max(
                    0,
                    $subtotal
                    - $discount
                    + $tax
                    + $shippingCost
                );

                $invoice = Invoice::create([
                    'company_id' => $company->id,
                    'order_id' => $order->id,
                    'invoice_number' => $this->generateInvoiceNumber(
                        $company->id
                    ),
                    'status' => 'draft',
                    'subtotal' => $subtotal,
                    'discount' => $discount,
                    'tax' => $tax,
                    'shipping_cost' => $shippingCost,
                    'total' => $total,
                    'due_at' => $validated['due_at'] ?? null,
                    'issued_at' => null,
                    'paid_at' => null,
                    'notes' => $validated['notes'] ?? null,
                ]);

                $request->user()->notify(
                    new SystemNotification(
                        title: 'Invoice Created',
                        message: sprintf(
                            'Invoice %s was created for order %s.',
                            $invoice->invoice_number,
                            $order->order_number
                                ?? ('#' . $order->id)
                        ),
                        type: 'finance',
                        icon: '◫'
                    )
                );

                return $invoice;
            }
        );

        return redirect()
            ->route(
                'finance.invoices.show',
                $invoice
            )
            ->with(
                'success',
                'Invoice created successfully.'
            );
    }


    public function show(
        Request $request,
        Invoice $invoice
    ): View {
        $company = $request->user()
            ->companies()
            ->first();

        abort_unless($company, 403);

        abort_unless(
            $invoice->company_id === $company->id,
            404
        );

        $invoice->load([
            'order.customer',
            'payments',
        ]);

        return view(
            'finance.invoices.show',
            compact('invoice')
        );
    }


    public function edit(
        Request $request,
        Invoice $invoice
    ): View {
        $company = $request->user()
            ->companies()
            ->first();

        abort_unless($company, 403);

        abort_unless(
            $invoice->company_id === $company->id,
            404
        );

        abort_unless(
            in_array(
                $invoice->status,
                [
                    'draft',
                    'issued',
                    'overdue',
                ],
                true
            ),
            422,
            'This invoice cannot be edited in its current status.'
        );

        $invoice->load('order.customer');

        $orders = Order::with('customer')
            ->where(
                'company_id',
                $company->id
            )
            ->where(function ($query) use ($invoice) {
                $query
                    ->whereNotIn(
                        'id',
                        function ($subQuery) {
                            $subQuery
                                ->select('order_id')
                                ->from('invoices')
                                ->whereNotNull('order_id');
                        }
                    )
                    ->orWhere(
                        'id',
                        $invoice->order_id
                    );
            })
            ->latest()
            ->get();

        return view(
            'finance.invoices.edit',
            compact(
                'invoice',
                'orders'
            )
        );
    }


    public function update(
        Request $request,
        Invoice $invoice
    ): RedirectResponse {
        $company = $request->user()
            ->companies()
            ->first();

        abort_unless($company, 403);

        abort_unless(
            $invoice->company_id === $company->id,
            404
        );

        abort_unless(
            in_array(
                $invoice->status,
                [
                    'draft',
                    'issued',
                    'overdue',
                ],
                true
            ),
            422,
            'This invoice cannot be edited in its current status.'
        );

        $validated = $request->validate([
            'order_id' => [
                'required',
                Rule::exists('orders', 'id')->where(
                    fn ($query) => $query->where(
                        'company_id',
                        $company->id
                    )
                ),
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

            'due_at' => [
                'nullable',
                'date',
            ],

            'notes' => [
                'nullable',
                'string',
                'max:5000',
            ],
        ]);

        DB::transaction(
            function () use (
                $validated,
                $company,
                $invoice,
                $request
            ) {
                $order = Order::with('customer')
                    ->where(
                        'company_id',
                        $company->id
                    )
                    ->lockForUpdate()
                    ->findOrFail(
                        $validated['order_id']
                    );

                $duplicate = Invoice::where(
                    'company_id',
                    $company->id
                )
                    ->where(
                        'order_id',
                        $order->id
                    )
                    ->where(
                        'id',
                        '!=',
                        $invoice->id
                    )
                    ->lockForUpdate()
                    ->first();

                if ($duplicate) {
                    abort(
                        422,
                        'This order already has another invoice.'
                    );
                }

                $subtotal = (float) (
                    $order->subtotal ?? 0
                );

                $discount = (float) (
                    $validated['discount']
                    ?? $order->discount
                    ?? 0
                );

                $tax = (float) (
                    $validated['tax']
                    ?? $order->tax
                    ?? 0
                );

                $shippingCost = (float) (
                    $validated['shipping_cost']
                    ?? $order->shipping_cost
                    ?? 0
                );

                $total = max(
                    0,
                    $subtotal
                    - $discount
                    + $tax
                    + $shippingCost
                );

                $oldOrderId = $invoice->order_id;

                $invoice->update([
                    'order_id' => $order->id,
                    'subtotal' => $subtotal,
                    'discount' => $discount,
                    'tax' => $tax,
                    'shipping_cost' => $shippingCost,
                    'total' => $total,
                    'due_at' => $validated['due_at'] ?? null,
                    'notes' => $validated['notes'] ?? null,
                ]);

                $message = sprintf(
                    'Invoice %s was updated.',
                    $invoice->invoice_number
                );

                if (
                    (int) $oldOrderId
                    !== (int) $invoice->order_id
                ) {
                    $message = sprintf(
                        'Invoice %s was moved to order %s.',
                        $invoice->invoice_number,
                        $order->order_number
                            ?? ('#' . $order->id)
                    );
                }

                $request->user()->notify(
                    new SystemNotification(
                        title: 'Invoice Updated',
                        message: $message,
                        type: 'finance',
                        icon: '◫'
                    )
                );
            }
        );

        return redirect()
            ->route(
                'finance.invoices.show',
                $invoice
            )
            ->with(
                'success',
                'Invoice updated successfully.'
            );
    }


    public function updateStatus(
        Request $request,
        Invoice $invoice
    ): RedirectResponse {
        $company = $request->user()
            ->companies()
            ->first();

        abort_unless($company, 403);

        abort_unless(
            $invoice->company_id === $company->id,
            404
        );

        $validated = $request->validate([
            'status' => [
                'required',
                Rule::in([
                    'draft',
                    'issued',
                    'paid',
                    'overdue',
                    'cancelled',
                ]),
            ],
        ]);

        $oldStatus = $invoice->status;
        $newStatus = $validated['status'];

        if ($oldStatus === $newStatus) {
            return back();
        }

        $allowedTransitions = [
            'draft' => [
                'draft',
                'issued',
                'cancelled',
            ],

            'issued' => [
                'issued',
                'paid',
                'overdue',
                'cancelled',
            ],

            'paid' => [
                'paid',
            ],

            'overdue' => [
                'overdue',
                'paid',
                'cancelled',
            ],

            'cancelled' => [
                'cancelled',
            ],
        ];

        abort_unless(
            in_array(
                $newStatus,
                $allowedTransitions[$oldStatus] ?? [],
                true
            ),
            422,
            'Invalid invoice status transition.'
        );

        DB::transaction(
            function () use (
                $invoice,
                $newStatus,
                $request
            ) {
                $now = Carbon::now();

                $updateData = [
                    'status' => $newStatus,
                ];

                if ($newStatus === 'issued') {
                    if (! $invoice->issued_at) {
                        $updateData['issued_at'] = $now;
                    }

                    $updateData['paid_at'] = null;
                }

                if ($newStatus === 'paid') {
                    if (! $invoice->issued_at) {
                        $updateData['issued_at'] = $now;
                    }

                    if (! $invoice->paid_at) {
                        $updateData['paid_at'] = $now;
                    }
                }

                if (
                    $newStatus === 'draft'
                    || $newStatus === 'overdue'
                    || $newStatus === 'cancelled'
                ) {
                    $updateData['paid_at'] = null;
                }

                if ($newStatus === 'draft') {
                    $updateData['issued_at'] = null;
                }

                $invoice->update($updateData);

                $notificationTitle = match ($newStatus) {
                    'issued' => 'Invoice Issued',
                    'paid' => 'Invoice Paid',
                    'overdue' => 'Invoice Overdue',
                    'cancelled' => 'Invoice Cancelled',
                    'draft' => 'Invoice Moved to Draft',
                    default => 'Invoice Status Updated',
                };

                $notificationIcon = match ($newStatus) {
                    'issued' => '◉',
                    'paid' => '✓',
                    'overdue' => '!',
                    'cancelled' => '×',
                    default => '◫',
                };

                $request->user()->notify(
                    new SystemNotification(
                        title: $notificationTitle,
                        message: sprintf(
                            'Invoice %s is now %s.',
                            $invoice->invoice_number,
                            Str::headline($newStatus)
                        ),
                        type: 'finance',
                        icon: $notificationIcon
                    )
                );
            }
        );

        return back()->with(
            'success',
            'Invoice status updated successfully.'
        );
    }


    public function destroy(
        Request $request,
        Invoice $invoice
    ): RedirectResponse {
        $company = $request->user()
            ->companies()
            ->first();

        abort_unless($company, 403);

        abort_unless(
            $invoice->company_id === $company->id,
            404
        );

        abort_unless(
            $invoice->status === 'draft',
            422,
            'Only draft invoices can be deleted.'
        );

        $invoiceNumber = $invoice->invoice_number;

        DB::transaction(
            function () use (
                $invoice,
                $request,
                $invoiceNumber
            ) {
                $invoice->payments()->delete();

                $invoice->delete();

                $request->user()->notify(
                    new SystemNotification(
                        title: 'Invoice Deleted',
                        message: sprintf(
                            'Invoice %s was deleted.',
                            $invoiceNumber
                        ),
                        type: 'finance',
                        icon: '×'
                    )
                );
            }
        );

        return redirect()
            ->route('finance.invoices.index')
            ->with(
                'success',
                'Invoice deleted successfully.'
            );
    }


    private function generateInvoiceNumber(
        int $companyId
    ): string {
        $prefix = 'INV-' . Carbon::now()->format('Ym');

        $lastInvoice = Invoice::where(
            'company_id',
            $companyId
        )
            ->where(
                'invoice_number',
                'like',
                $prefix . '-%'
            )
            ->orderByDesc('id')
            ->first();

        $nextNumber = 1;

        if ($lastInvoice) {
            $parts = explode(
                '-',
                $lastInvoice->invoice_number
            );

            $lastNumber = end($parts);

            if (is_numeric($lastNumber)) {
                $nextNumber = ((int) $lastNumber) + 1;
            }
        }

        do {
            $invoiceNumber = sprintf(
                '%s-%04d',
                $prefix,
                $nextNumber
            );

            $exists = Invoice::where(
                'company_id',
                $companyId
            )
                ->where(
                    'invoice_number',
                    $invoiceNumber
                )
                ->exists();

            if ($exists) {
                $nextNumber++;
            }
        } while ($exists);

        return $invoiceNumber;
    }
}