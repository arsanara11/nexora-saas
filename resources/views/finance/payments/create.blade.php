<x-app-layout>
    <div class="space-y-6">

        {{-- Header --}}
        <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
            <div>

                <div class="mb-2 flex items-center gap-2 text-xs font-medium uppercase tracking-[0.18em] text-[#8B919A]">

                    <a
                        href="{{ route('finance.index') }}"
                        class="transition hover:text-white"
                    >
                        Finance
                    </a>

                    <span class="text-[#4A4F57]">/</span>

                    <a
                        href="{{ route('finance.payments.index') }}"
                        class="transition hover:text-white"
                    >
                        Payments
                    </a>

                    <span class="text-[#4A4F57]">/</span>

                    <span class="text-white">
                        Create
                    </span>

                </div>

                <h1 class="text-2xl font-semibold tracking-tight text-white">
                    Create Payment
                </h1>

                <p class="mt-1 text-sm text-[#8B919A]">
                    Record a payment against an issued or overdue invoice.
                </p>

            </div>

            <a
                href="{{ route('finance.payments.index') }}"
                class="inline-flex w-fit items-center gap-2 rounded-xl border border-[#242830] bg-[#12151A] px-4 py-2.5 text-sm font-medium text-[#D8DCE2] transition hover:border-[#343943] hover:bg-[#171A20] hover:text-white"
            >
                <span>←</span>
                Back to Payments
            </a>

        </div>


        {{-- Validation Errors --}}
        @if ($errors->any())

            <div class="rounded-2xl border border-red-500/20 bg-red-500/10 px-5 py-4">

                <div class="mb-2 text-sm font-semibold text-red-300">
                    Please fix the following errors:
                </div>

                <ul class="space-y-1 text-sm text-red-200/90">

                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach

                </ul>

            </div>

        @endif


        <form
            method="POST"
            action="{{ route('finance.payments.store') }}"
            class="space-y-6"
        >
            @csrf


            <div class="grid grid-cols-1 gap-6 xl:grid-cols-[minmax(0,1fr)_360px]">

                {{-- LEFT --}}
                <div class="space-y-6">

                    {{-- Payment Information --}}
                    <section class="rounded-2xl border border-[#242830] bg-[#12151A] p-6">

                        <div class="mb-5">

                            <h2 class="text-sm font-semibold text-white">
                                Payment Information
                            </h2>

                            <p class="mt-1 text-xs text-[#8B919A]">
                                Select the invoice and enter the payment details.
                            </p>

                        </div>


                        <div class="space-y-5">

                            {{-- Invoice --}}
                            <div>

                                <label
                                    for="invoice_id"
                                    class="mb-2 block text-xs font-medium uppercase tracking-[0.12em] text-[#8B919A]"
                                >
                                    Invoice
                                </label>

                                <select
                                    id="invoice_id"
                                    name="invoice_id"
                                    required
                                    class="w-full rounded-xl border border-[#2A2E35] bg-[#0B0D10] px-4 py-3 text-sm text-white outline-none transition focus:border-[#8B7CFF] focus:ring-1 focus:ring-[#8B7CFF]"
                                >

                                    <option value="">
                                        Select an invoice
                                    </option>

                                    @foreach ($invoices as $invoice)

                                        @php
                                            $customerName = optional(
                                                optional($invoice->order)->customer
                                            )->name ?? 'Walk-in Customer';
                                        @endphp

                                        <option
                                            value="{{ $invoice->id }}"
                                            data-invoice-number="{{ $invoice->invoice_number }}"
                                            data-customer="{{ $customerName }}"
                                            data-total="{{ (float) $invoice->total }}"
                                            data-status="{{ $invoice->status }}"
                                            @selected(old('invoice_id') == $invoice->id)
                                        >
                                            {{ $invoice->invoice_number }}
                                            —
                                            {{ $customerName }}
                                            —
                                            Rp {{ number_format((float) $invoice->total, 0, ',', '.') }}
                                        </option>

                                    @endforeach

                                </select>


                                @if ($invoices->isEmpty())

                                    <div class="mt-3 rounded-xl border border-amber-400/20 bg-amber-400/10 px-4 py-3">

                                        <div class="text-sm font-medium text-amber-300">
                                            No available invoices
                                        </div>

                                        <p class="mt-1 text-xs leading-5 text-[#A9AEB6]">
                                            Only issued or overdue invoices can receive a payment.
                                        </p>

                                    </div>

                                @else

                                    <p class="mt-2 text-xs text-[#6F757E]">
                                        Only invoices with Issued or Overdue status are available.
                                    </p>

                                @endif

                            </div>


                            {{-- Invoice Preview --}}
                            <div
                                id="invoice-preview"
                                class="hidden rounded-xl border border-[#242830] bg-[#0B0D10] p-5"
                            >

                                <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">

                                    <div>

                                        <div class="text-[10px] font-semibold uppercase tracking-[0.14em] text-[#6F757E]">
                                            Invoice
                                        </div>

                                        <div
                                            id="preview-invoice-number"
                                            class="mt-1 text-sm font-medium text-white"
                                        >
                                            —
                                        </div>

                                    </div>


                                    <div>

                                        <div class="text-[10px] font-semibold uppercase tracking-[0.14em] text-[#6F757E]">
                                            Customer
                                        </div>

                                        <div
                                            id="preview-customer"
                                            class="mt-1 text-sm font-medium text-white"
                                        >
                                            —
                                        </div>

                                    </div>


                                    <div>

                                        <div class="text-[10px] font-semibold uppercase tracking-[0.14em] text-[#6F757E]">
                                            Invoice Total
                                        </div>

                                        <div
                                            id="preview-total"
                                            class="mt-1 text-sm font-semibold text-[#C9C2FF]"
                                        >
                                            Rp 0
                                        </div>

                                    </div>

                                </div>

                            </div>


                            {{-- Amount --}}
                            <div>

                                <label
                                    for="amount"
                                    class="mb-2 block text-xs font-medium uppercase tracking-[0.12em] text-[#8B919A]"
                                >
                                    Payment Amount
                                </label>

                                <div class="relative">

                                    <span class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-sm text-[#6F757E]">
                                        Rp
                                    </span>

                                    <input
                                        id="amount"
                                        type="number"
                                        name="amount"
                                        step="0.01"
                                        min="0.01"
                                        value="{{ old('amount') }}"
                                        required
                                        placeholder="0"
                                        class="w-full rounded-xl border border-[#2A2E35] bg-[#0B0D10] py-3 pl-11 pr-4 text-sm text-white outline-none transition placeholder:text-[#555B64] focus:border-[#8B7CFF] focus:ring-1 focus:ring-[#8B7CFF]"
                                    >

                                </div>

                                <p class="mt-2 text-xs text-[#6F757E]">
                                    Enter the amount received for this payment.
                                </p>

                            </div>


                            {{-- Method --}}
                            <div>

                                <label
                                    for="method"
                                    class="mb-2 block text-xs font-medium uppercase tracking-[0.12em] text-[#8B919A]"
                                >
                                    Payment Method
                                </label>

                                <select
                                    id="method"
                                    name="method"
                                    required
                                    class="w-full rounded-xl border border-[#2A2E35] bg-[#0B0D10] px-4 py-3 text-sm text-white outline-none transition focus:border-[#8B7CFF] focus:ring-1 focus:ring-[#8B7CFF]"
                                >

                                    <option value="">
                                        Select payment method
                                    </option>

                                    <option
                                        value="cash"
                                        @selected(old('method') === 'cash')
                                    >
                                        Cash
                                    </option>

                                    <option
                                        value="bank_transfer"
                                        @selected(old('method') === 'bank_transfer')
                                    >
                                        Bank Transfer
                                    </option>

                                    <option
                                        value="credit_card"
                                        @selected(old('method') === 'credit_card')
                                    >
                                        Credit Card
                                    </option>

                                    <option
                                        value="debit_card"
                                        @selected(old('method') === 'debit_card')
                                    >
                                        Debit Card
                                    </option>

                                    <option
                                        value="e_wallet"
                                        @selected(old('method') === 'e_wallet')
                                    >
                                        E-Wallet
                                    </option>

                                </select>

                            </div>


                            {{-- Status --}}
                            <div>

                                <label
                                    for="status"
                                    class="mb-2 block text-xs font-medium uppercase tracking-[0.12em] text-[#8B919A]"
                                >
                                    Payment Status
                                </label>

                                <select
                                    id="status"
                                    name="status"
                                    required
                                    class="w-full rounded-xl border border-[#2A2E35] bg-[#0B0D10] px-4 py-3 text-sm text-white outline-none transition focus:border-[#8B7CFF] focus:ring-1 focus:ring-[#8B7CFF]"
                                >

                                    <option
                                        value="pending"
                                        @selected(old('status', 'paid') === 'pending')
                                    >
                                        Pending
                                    </option>

                                    <option
                                        value="paid"
                                        @selected(old('status', 'paid') === 'paid')
                                    >
                                        Paid
                                    </option>

                                    <option
                                        value="failed"
                                        @selected(old('status') === 'failed')
                                    >
                                        Failed
                                    </option>

                                    <option
                                        value="refunded"
                                        @selected(old('status') === 'refunded')
                                    >
                                        Refunded
                                    </option>

                                </select>

                                <p class="mt-2 text-xs text-[#6F757E]">
                                    A Paid payment contributes toward the invoice balance.
                                </p>

                            </div>

                        </div>

                    </section>

                </div>


                {{-- RIGHT --}}
                <div class="space-y-6">

                    {{-- Payment Summary --}}
                    <section class="rounded-2xl border border-[#242830] bg-[#12151A] p-6">

                        <div class="mb-5">

                            <h2 class="text-sm font-semibold text-white">
                                Payment Summary
                            </h2>

                            <p class="mt-1 text-xs text-[#8B919A]">
                                Review the payment before recording it.
                            </p>

                        </div>


                        <div class="rounded-xl border border-[#242830] bg-[#0B0D10] p-5">

                            <div class="text-[10px] font-semibold uppercase tracking-[0.14em] text-[#6F757E]">
                                Payment Amount
                            </div>

                            <div
                                id="amount-preview"
                                class="mt-2 text-3xl font-semibold tracking-tight text-white"
                            >
                                Rp 0
                            </div>


                            <div class="mt-5 border-t border-[#242830] pt-4">

                                <div class="flex items-center justify-between gap-4">

                                    <span class="text-sm text-[#8B919A]">
                                        Invoice
                                    </span>

                                    <span
                                        id="summary-invoice"
                                        class="max-w-[180px] truncate text-right text-sm font-medium text-white"
                                    >
                                        —
                                    </span>

                                </div>


                                <div class="mt-3 flex items-center justify-between gap-4">

                                    <span class="text-sm text-[#8B919A]">
                                        Customer
                                    </span>

                                    <span
                                        id="summary-customer"
                                        class="max-w-[180px] truncate text-right text-sm font-medium text-white"
                                    >
                                        —
                                    </span>

                                </div>


                                <div class="mt-3 flex items-center justify-between gap-4">

                                    <span class="text-sm text-[#8B919A]">
                                        Method
                                    </span>

                                    <span
                                        id="summary-method"
                                        class="max-w-[180px] truncate text-right text-sm font-medium text-white"
                                    >
                                        —
                                    </span>

                                </div>


                                <div class="mt-3 flex items-center justify-between gap-4">

                                    <span class="text-sm text-[#8B919A]">
                                        Status
                                    </span>

                                    <span
                                        id="summary-status"
                                        class="rounded-full border border-emerald-400/20 bg-emerald-400/10 px-2.5 py-1 text-[10px] font-medium uppercase tracking-[0.08em] text-emerald-300"
                                    >
                                        Paid
                                    </span>

                                </div>

                            </div>

                        </div>

                    </section>


                    {{-- Status Guide --}}
                    <section class="rounded-2xl border border-[#242830] bg-[#12151A] p-6">

                        <div class="mb-4">

                            <h2 class="text-sm font-semibold text-white">
                                Payment Status
                            </h2>

                            <p class="mt-1 text-xs text-[#8B919A]">
                                Choose the state of the transaction.
                            </p>

                        </div>


                        <div class="space-y-3">

                            <div class="rounded-xl border border-emerald-400/15 bg-emerald-400/5 px-4 py-3">

                                <div class="text-sm font-medium text-emerald-300">
                                    Paid
                                </div>

                                <div class="mt-1 text-xs leading-5 text-[#8B919A]">
                                    Payment was successfully received.
                                </div>

                            </div>


                            <div class="rounded-xl border border-amber-400/15 bg-amber-400/5 px-4 py-3">

                                <div class="text-sm font-medium text-amber-300">
                                    Pending
                                </div>

                                <div class="mt-1 text-xs leading-5 text-[#8B919A]">
                                    Payment is recorded but still awaiting completion.
                                </div>

                            </div>


                            <div class="rounded-xl border border-red-400/15 bg-red-400/5 px-4 py-3">

                                <div class="text-sm font-medium text-red-300">
                                    Failed
                                </div>

                                <div class="mt-1 text-xs leading-5 text-[#8B919A]">
                                    Payment attempt was unsuccessful.
                                </div>

                            </div>


                            <div class="rounded-xl border border-blue-400/15 bg-blue-400/5 px-4 py-3">

                                <div class="text-sm font-medium text-blue-300">
                                    Refunded
                                </div>

                                <div class="mt-1 text-xs leading-5 text-[#8B919A]">
                                    Payment has been returned to the customer.
                                </div>

                            </div>

                        </div>

                    </section>


                    {{-- Actions --}}
                    <section class="rounded-2xl border border-[#242830] bg-[#12151A] p-6">

                        <button
                            type="submit"
                            class="w-full rounded-xl bg-white px-4 py-3 text-sm font-semibold text-[#0B0D10] transition hover:bg-[#E8E8E5]"
                        >
                            Create Payment
                        </button>

                        <a
                            href="{{ route('finance.payments.index') }}"
                            class="mt-3 block w-full rounded-xl border border-[#2A2E35] bg-[#0B0D10] px-4 py-3 text-center text-sm font-medium text-[#B8BDC5] transition hover:border-[#3A3F47] hover:text-white"
                        >
                            Cancel
                        </a>

                    </section>

                </div>

            </div>

        </form>

    </div>


    <script>
        document.addEventListener('DOMContentLoaded', () => {

            const invoiceSelect =
                document.getElementById('invoice_id');

            const amountInput =
                document.getElementById('amount');

            const methodSelect =
                document.getElementById('method');

            const statusSelect =
                document.getElementById('status');


            const invoicePreview =
                document.getElementById('invoice-preview');

            const previewInvoiceNumber =
                document.getElementById('preview-invoice-number');

            const previewCustomer =
                document.getElementById('preview-customer');

            const previewTotal =
                document.getElementById('preview-total');


            const amountPreview =
                document.getElementById('amount-preview');

            const summaryInvoice =
                document.getElementById('summary-invoice');

            const summaryCustomer =
                document.getElementById('summary-customer');

            const summaryMethod =
                document.getElementById('summary-method');

            const summaryStatus =
                document.getElementById('summary-status');


            function formatCurrency(value) {
                return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 0,
                }).format(value);
            }


            function getAmount() {

                const amount =
                    parseFloat(amountInput.value);

                return Number.isFinite(amount)
                    ? amount
                    : 0;
            }


            function updateInvoicePreview() {

                const option =
                    invoiceSelect.options[
                        invoiceSelect.selectedIndex
                    ];


                if (!option || !option.value) {

                    invoicePreview.classList.add('hidden');

                    previewInvoiceNumber.textContent = '—';
                    previewCustomer.textContent = '—';
                    previewTotal.textContent =
                        formatCurrency(0);

                    summaryInvoice.textContent = '—';
                    summaryCustomer.textContent = '—';

                    return;
                }


                const invoiceNumber =
                    option.dataset.invoiceNumber || '—';

                const customer =
                    option.dataset.customer || 'Walk-in Customer';

                const total =
                    parseFloat(
                        option.dataset.total || '0'
                    );


                previewInvoiceNumber.textContent =
                    invoiceNumber;

                previewCustomer.textContent =
                    customer;

                previewTotal.textContent =
                    formatCurrency(total);


                summaryInvoice.textContent =
                    invoiceNumber;

                summaryCustomer.textContent =
                    customer;


                invoicePreview.classList.remove(
                    'hidden'
                );
            }


            function updateSummary() {

                amountPreview.textContent =
                    formatCurrency(getAmount());


                const method =
                    methodSelect.value;

                if (!method) {

                    summaryMethod.textContent = '—';

                } else {

                    summaryMethod.textContent =
                        method
                            .split('_')
                            .map(
                                word =>
                                    word.charAt(0).toUpperCase()
                                    + word.slice(1)
                            )
                            .join(' ');
                }


                const status =
                    statusSelect.value || 'paid';


                summaryStatus.textContent =
                    status.charAt(0).toUpperCase()
                    + status.slice(1);


                summaryStatus.className =
                    'rounded-full border px-2.5 py-1 text-[10px] font-medium uppercase tracking-[0.08em]';


                if (status === 'paid') {

                    summaryStatus.classList.add(
                        'border-emerald-400/20',
                        'bg-emerald-400/10',
                        'text-emerald-300'
                    );

                } else if (status === 'pending') {

                    summaryStatus.classList.add(
                        'border-amber-400/20',
                        'bg-amber-400/10',
                        'text-amber-300'
                    );

                } else if (status === 'failed') {

                    summaryStatus.classList.add(
                        'border-red-400/20',
                        'bg-red-400/10',
                        'text-red-300'
                    );

                } else {

                    summaryStatus.classList.add(
                        'border-blue-400/20',
                        'bg-blue-400/10',
                        'text-blue-300'
                    );
                }
            }


            function updateAll() {

                updateInvoicePreview();
                updateSummary();

            }


            invoiceSelect.addEventListener(
                'change',
                updateAll
            );

            amountInput.addEventListener(
                'input',
                updateSummary
            );

            methodSelect.addEventListener(
                'change',
                updateSummary
            );

            statusSelect.addEventListener(
                'change',
                updateSummary
            );


            updateAll();

        });
    </script>

</x-app-layout>