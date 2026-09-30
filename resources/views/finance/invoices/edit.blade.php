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
                        href="{{ route('finance.invoices.index') }}"
                        class="transition hover:text-white"
                    >
                        Invoices
                    </a>

                    <span class="text-[#4A4F57]">/</span>

                    <a
                        href="{{ route('finance.invoices.show', $invoice) }}"
                        class="transition hover:text-white"
                    >
                        {{ $invoice->invoice_number }}
                    </a>

                    <span class="text-[#4A4F57]">/</span>

                    <span class="text-white">Edit</span>
                </div>

                <div class="flex flex-wrap items-center gap-3">
                    <h1 class="text-2xl font-semibold tracking-tight text-white">
                        Edit Invoice
                    </h1>

                    @php
                        $statusStyles = [
                            'draft' => 'border-[#8B7CFF]/20 bg-[#8B7CFF]/10 text-[#C9C2FF]',
                            'issued' => 'border-blue-400/20 bg-blue-400/10 text-blue-300',
                            'overdue' => 'border-amber-400/20 bg-amber-400/10 text-amber-300',
                            'paid' => 'border-emerald-400/20 bg-emerald-400/10 text-emerald-300',
                            'cancelled' => 'border-red-400/20 bg-red-400/10 text-red-300',
                        ];

                        $statusClass = $statusStyles[$invoice->status]
                            ?? 'border-[#242830] bg-[#12151A] text-[#B8BDC5]';
                    @endphp

                    <span class="rounded-full border px-3 py-1 text-xs font-medium uppercase tracking-[0.08em] {{ $statusClass }}">
                        {{ ucfirst($invoice->status) }}
                    </span>
                </div>

                <p class="mt-1 text-sm text-[#8B919A]">
                    Update invoice information and financial details.
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-3">
                <a
                    href="{{ route('finance.invoices.show', $invoice) }}"
                    class="inline-flex items-center gap-2 rounded-xl border border-[#242830] bg-[#12151A] px-4 py-2.5 text-sm font-medium text-[#D8DCE2] transition hover:border-[#343943] hover:bg-[#171A20] hover:text-white"
                >
                    <span>←</span>
                    Back to Invoice
                </a>
            </div>
        </div>

        {{-- Errors --}}
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
            action="{{ route('finance.invoices.update', $invoice) }}"
            class="space-y-6"
        >
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 gap-6 xl:grid-cols-[minmax(0,1fr)_360px]">

                {{-- LEFT --}}
                <div class="space-y-6">

                    {{-- Invoice Info --}}
                    <section class="rounded-2xl border border-[#242830] bg-[#12151A] p-6">
                        <div class="mb-5">
                            <h2 class="text-sm font-semibold text-white">
                                Invoice Information
                            </h2>

                            <p class="mt-1 text-xs text-[#8B919A]">
                                Review the invoice and associated sales order.
                            </p>
                        </div>

                        <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                            {{-- Invoice Number --}}
                            <div>
                                <label
                                    class="mb-2 block text-xs font-medium uppercase tracking-[0.12em] text-[#8B919A]"
                                >
                                    Invoice Number
                                </label>

                                <input
                                    type="text"
                                    value="{{ $invoice->invoice_number }}"
                                    readonly
                                    class="w-full rounded-xl border border-[#2A2E35] bg-[#0B0D10] px-4 py-3 text-sm font-medium text-[#B8BDC5] outline-none"
                                >
                            </div>

                            {{-- Status --}}
                            <div>
                                <label
                                    for="status"
                                    class="mb-2 block text-xs font-medium uppercase tracking-[0.12em] text-[#8B919A]"
                                >
                                    Status
                                </label>

                                <select
                                    id="status"
                                    name="status"
                                    class="w-full rounded-xl border border-[#2A2E35] bg-[#0B0D10] px-4 py-3 text-sm text-white outline-none transition focus:border-[#8B7CFF] focus:ring-1 focus:ring-[#8B7CFF]"
                                >
                                    @foreach (['draft', 'issued', 'overdue'] as $status)
                                        <option
                                            value="{{ $status }}"
                                            @selected(old('status', $invoice->status) === $status)
                                        >
                                            {{ ucfirst($status) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- Sales Order --}}
                        <div class="mt-5">
                            <label
                                for="order_id"
                                class="mb-2 block text-xs font-medium uppercase tracking-[0.12em] text-[#8B919A]"
                            >
                                Sales Order
                            </label>

                            <select
                                id="order_id"
                                name="order_id"
                                required
                                class="w-full rounded-xl border border-[#2A2E35] bg-[#0B0D10] px-4 py-3 text-sm text-white outline-none transition focus:border-[#8B7CFF] focus:ring-1 focus:ring-[#8B7CFF]"
                            >
                                @foreach ($orders as $order)
                                    <option
                                        value="{{ $order->id }}"
                                        data-order-number="{{ $order->order_number }}"
                                        data-customer="{{ optional($order->customer)->name ?? 'Walk-in Customer' }}"
                                        data-subtotal="{{ (float) $order->subtotal }}"
                                        data-discount="{{ (float) ($order->discount ?? 0) }}"
                                        data-tax="{{ (float) ($order->tax ?? 0) }}"
                                        data-shipping="{{ (float) ($order->shipping_cost ?? 0) }}"
                                        data-total="{{ (float) $order->total }}"
                                        @selected(old('order_id', $invoice->order_id) == $order->id)
                                    >
                                        {{ $order->order_number }}
                                        —
                                        {{ optional($order->customer)->name ?? 'Walk-in Customer' }}
                                        —
                                        Rp {{ number_format((float) $order->total, 0, ',', '.') }}
                                    </option>
                                @endforeach
                            </select>

                            <p class="mt-2 text-xs text-[#6F757E]">
                                Select the sales order associated with this invoice.
                            </p>
                        </div>

                        {{-- Order Preview --}}
                        <div class="mt-5 rounded-xl border border-[#242830] bg-[#0B0D10] p-5">
                            <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">

                                <div>
                                    <div class="text-[10px] font-semibold uppercase tracking-[0.14em] text-[#6F757E]">
                                        Order
                                    </div>

                                    <div
                                        id="preview-order-number"
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
                                        Order Total
                                    </div>

                                    <div
                                        id="preview-order-total"
                                        class="mt-1 text-sm font-semibold text-[#C9C2FF]"
                                    >
                                        Rp 0
                                    </div>
                                </div>

                            </div>
                        </div>
                    </section>

                    {{-- Financial Details --}}
                    <section class="rounded-2xl border border-[#242830] bg-[#12151A] p-6">
                        <div class="mb-5">
                            <h2 class="text-sm font-semibold text-white">
                                Financial Details
                            </h2>

                            <p class="mt-1 text-xs text-[#8B919A]">
                                Modify the financial values for this invoice.
                            </p>
                        </div>

                        <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                            {{-- Subtotal --}}
                            <div>
                                <label
                                    for="subtotal"
                                    class="mb-2 block text-xs font-medium uppercase tracking-[0.12em] text-[#8B919A]"
                                >
                                    Subtotal
                                </label>

                                <div class="relative">
                                    <span class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-sm text-[#6F757E]">
                                        Rp
                                    </span>

                                    <input
                                        id="subtotal"
                                        type="number"
                                        step="0.01"
                                        min="0"
                                        name="subtotal"
                                        value="{{ old('subtotal', $invoice->subtotal) }}"
                                        readonly
                                        class="w-full rounded-xl border border-[#2A2E35] bg-[#0B0D10] py-3 pl-11 pr-4 text-sm text-white outline-none"
                                    >
                                </div>
                            </div>

                            {{-- Discount --}}
                            <div>
                                <label
                                    for="discount"
                                    class="mb-2 block text-xs font-medium uppercase tracking-[0.12em] text-[#8B919A]"
                                >
                                    Discount
                                </label>

                                <div class="relative">
                                    <span class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-sm text-[#6F757E]">
                                        Rp
                                    </span>

                                    <input
                                        id="discount"
                                        type="number"
                                        step="0.01"
                                        min="0"
                                        name="discount"
                                        value="{{ old('discount', $invoice->discount) }}"
                                        class="w-full rounded-xl border border-[#2A2E35] bg-[#0B0D10] py-3 pl-11 pr-4 text-sm text-white outline-none transition focus:border-[#8B7CFF] focus:ring-1 focus:ring-[#8B7CFF]"
                                    >
                                </div>
                            </div>

                            {{-- Tax --}}
                            <div>
                                <label
                                    for="tax"
                                    class="mb-2 block text-xs font-medium uppercase tracking-[0.12em] text-[#8B919A]"
                                >
                                    Tax
                                </label>

                                <div class="relative">
                                    <span class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-sm text-[#6F757E]">
                                        Rp
                                    </span>

                                    <input
                                        id="tax"
                                        type="number"
                                        step="0.01"
                                        min="0"
                                        name="tax"
                                        value="{{ old('tax', $invoice->tax) }}"
                                        class="w-full rounded-xl border border-[#2A2E35] bg-[#0B0D10] py-3 pl-11 pr-4 text-sm text-white outline-none transition focus:border-[#8B7CFF] focus:ring-1 focus:ring-[#8B7CFF]"
                                    >
                                </div>
                            </div>

                            {{-- Shipping --}}
                            <div>
                                <label
                                    for="shipping_cost"
                                    class="mb-2 block text-xs font-medium uppercase tracking-[0.12em] text-[#8B919A]"
                                >
                                    Shipping
                                </label>

                                <div class="relative">
                                    <span class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-sm text-[#6F757E]">
                                        Rp
                                    </span>

                                    <input
                                        id="shipping_cost"
                                        type="number"
                                        step="0.01"
                                        min="0"
                                        name="shipping_cost"
                                        value="{{ old('shipping_cost', $invoice->shipping_cost) }}"
                                        class="w-full rounded-xl border border-[#2A2E35] bg-[#0B0D10] py-3 pl-11 pr-4 text-sm text-white outline-none transition focus:border-[#8B7CFF] focus:ring-1 focus:ring-[#8B7CFF]"
                                    >
                                </div>
                            </div>

                        </div>

                        {{-- Due Date --}}
                        <div class="mt-5">
                            <label
                                for="due_at"
                                class="mb-2 block text-xs font-medium uppercase tracking-[0.12em] text-[#8B919A]"
                            >
                                Due Date
                            </label>

                            <input
                                id="due_at"
                                type="date"
                                name="due_at"
                                value="{{ old('due_at', $invoice->due_at?->format('Y-m-d')) }}"
                                class="w-full rounded-xl border border-[#2A2E35] bg-[#0B0D10] px-4 py-3 text-sm text-white outline-none transition focus:border-[#8B7CFF] focus:ring-1 focus:ring-[#8B7CFF]"
                            >
                        </div>

                        {{-- Notes --}}
                        <div class="mt-5">
                            <label
                                for="notes"
                                class="mb-2 block text-xs font-medium uppercase tracking-[0.12em] text-[#8B919A]"
                            >
                                Notes
                            </label>

                            <textarea
                                id="notes"
                                name="notes"
                                rows="5"
                                placeholder="Add any notes for this invoice..."
                                class="w-full resize-none rounded-xl border border-[#2A2E35] bg-[#0B0D10] px-4 py-3 text-sm text-white outline-none transition placeholder:text-[#555B64] focus:border-[#8B7CFF] focus:ring-1 focus:ring-[#8B7CFF]"
                            >{{ old('notes', $invoice->notes) }}</textarea>
                        </div>
                    </section>

                </div>

                {{-- RIGHT --}}
                <div class="space-y-6">

                    {{-- Summary --}}
                    <section class="rounded-2xl border border-[#242830] bg-[#12151A] p-6">
                        <div class="mb-5">
                            <h2 class="text-sm font-semibold text-white">
                                Invoice Summary
                            </h2>

                            <p class="mt-1 text-xs text-[#8B919A]">
                                Preview of the updated invoice amount.
                            </p>
                        </div>

                        <div class="space-y-3">

                            <div class="flex items-center justify-between gap-4">
                                <span class="text-sm text-[#8B919A]">
                                    Subtotal
                                </span>

                                <span
                                    id="summary-subtotal"
                                    class="text-sm font-medium text-white"
                                >
                                    Rp 0
                                </span>
                            </div>

                            <div class="flex items-center justify-between gap-4">
                                <span class="text-sm text-[#8B919A]">
                                    Discount
                                </span>

                                <span
                                    id="summary-discount"
                                    class="text-sm font-medium text-white"
                                >
                                    Rp 0
                                </span>
                            </div>

                            <div class="flex items-center justify-between gap-4">
                                <span class="text-sm text-[#8B919A]">
                                    Tax
                                </span>

                                <span
                                    id="summary-tax"
                                    class="text-sm font-medium text-white"
                                >
                                    Rp 0
                                </span>
                            </div>

                            <div class="flex items-center justify-between gap-4">
                                <span class="text-sm text-[#8B919A]">
                                    Shipping
                                </span>

                                <span
                                    id="summary-shipping"
                                    class="text-sm font-medium text-white"
                                >
                                    Rp 0
                                </span>
                            </div>

                            <div class="my-4 border-t border-[#242830]"></div>

                            <div class="flex items-end justify-between gap-4">
                                <span class="text-sm font-semibold text-white">
                                    Total
                                </span>

                                <span
                                    id="summary-total"
                                    class="text-2xl font-semibold tracking-tight text-[#C9C2FF]"
                                >
                                    Rp 0
                                </span>
                            </div>

                        </div>
                    </section>

                    {{-- Current Status --}}
                    <section class="rounded-2xl border border-[#242830] bg-[#12151A] p-6">
                        <div class="mb-4">
                            <h2 class="text-sm font-semibold text-white">
                                Current Status
                            </h2>

                            <p class="mt-1 text-xs text-[#8B919A]">
                                Status changes can also be managed from the invoice detail page.
                            </p>
                        </div>

                        <div class="flex items-center gap-3 rounded-xl border border-[#2A2E35] bg-[#0B0D10] px-4 py-3">
                            <span
                                id="status-dot"
                                class="h-2.5 w-2.5 rounded-full bg-[#8B7CFF]"
                            ></span>

                            <div>
                                <div
                                    id="status-label"
                                    class="text-sm font-medium text-white"
                                >
                                    {{ ucfirst($invoice->status) }}
                                </div>

                                <div class="text-xs text-[#6F757E]">
                                    Current invoice status
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
                            Save Changes
                        </button>

                        <a
                            href="{{ route('finance.invoices.show', $invoice) }}"
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
            const orderSelect = document.getElementById('order_id');

            const subtotalInput = document.getElementById('subtotal');
            const discountInput = document.getElementById('discount');
            const taxInput = document.getElementById('tax');
            const shippingInput = document.getElementById('shipping_cost');

            const previewOrderNumber = document.getElementById('preview-order-number');
            const previewCustomer = document.getElementById('preview-customer');
            const previewOrderTotal = document.getElementById('preview-order-total');

            const summarySubtotal = document.getElementById('summary-subtotal');
            const summaryDiscount = document.getElementById('summary-discount');
            const summaryTax = document.getElementById('summary-tax');
            const summaryShipping = document.getElementById('summary-shipping');
            const summaryTotal = document.getElementById('summary-total');

            const statusSelect = document.getElementById('status');
            const statusLabel = document.getElementById('status-label');
            const statusDot = document.getElementById('status-dot');

            const hasOldInput = {{ old('order_id') !== null ? 'true' : 'false' }};

            function numberValue(input) {
                const value = parseFloat(input.value);
                return Number.isFinite(value) ? value : 0;
            }

            function formatCurrency(value) {
                return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 0,
                }).format(value);
            }

            function calculateTotal() {
                const subtotal = numberValue(subtotalInput);
                const discount = numberValue(discountInput);
                const tax = numberValue(taxInput);
                const shipping = numberValue(shippingInput);

                const total = Math.max(
                    0,
                    subtotal - discount + tax + shipping
                );

                summarySubtotal.textContent = formatCurrency(subtotal);
                summaryDiscount.textContent = formatCurrency(discount);
                summaryTax.textContent = formatCurrency(tax);
                summaryShipping.textContent = formatCurrency(shipping);
                summaryTotal.textContent = formatCurrency(total);
            }

            function updateOrderPreview() {
                const option = orderSelect.options[orderSelect.selectedIndex];

                if (!option || !option.value) {
                    previewOrderNumber.textContent = '—';
                    previewCustomer.textContent = '—';
                    previewOrderTotal.textContent = formatCurrency(0);
                    return;
                }

                previewOrderNumber.textContent =
                    option.dataset.orderNumber || '—';

                previewCustomer.textContent =
                    option.dataset.customer || 'Walk-in Customer';

                previewOrderTotal.textContent =
                    formatCurrency(
                        parseFloat(option.dataset.total || '0')
                    );
            }

            function loadOrderFinancials() {
                const option = orderSelect.options[orderSelect.selectedIndex];

                if (!option || !option.value) {
                    subtotalInput.value = '0';
                    discountInput.value = '0';
                    taxInput.value = '0';
                    shippingInput.value = '0';

                    calculateTotal();
                    updateOrderPreview();

                    return;
                }

                subtotalInput.value =
                    parseFloat(option.dataset.subtotal || '0').toFixed(2);

                discountInput.value =
                    parseFloat(option.dataset.discount || '0').toFixed(2);

                taxInput.value =
                    parseFloat(option.dataset.tax || '0').toFixed(2);

                shippingInput.value =
                    parseFloat(option.dataset.shipping || '0').toFixed(2);

                updateOrderPreview();
                calculateTotal();
            }

            function updateStatusPreview() {
                const status = statusSelect.value;

                statusLabel.textContent =
                    status.charAt(0).toUpperCase() + status.slice(1);

                statusDot.className =
                    'h-2.5 w-2.5 rounded-full';

                if (status === 'draft') {
                    statusDot.classList.add('bg-[#8B7CFF]');
                } else if (status === 'issued') {
                    statusDot.classList.add('bg-blue-400');
                } else if (status === 'overdue') {
                    statusDot.classList.add('bg-amber-400');
                }
            }

            orderSelect.addEventListener('change', () => {
                loadOrderFinancials();
            });

            discountInput.addEventListener('input', calculateTotal);
            taxInput.addEventListener('input', calculateTotal);
            shippingInput.addEventListener('input', calculateTotal);

            statusSelect.addEventListener('change', updateStatusPreview);

            updateOrderPreview();

            if (hasOldInput) {
                calculateTotal();
            } else {
                calculateTotal();
            }

            updateStatusPreview();
        });
    </script>
</x-app-layout>