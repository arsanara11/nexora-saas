<x-app-layout>

    <div class="space-y-6">

        {{-- Header --}}
        <div class="flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between">

            <div>

                <p class="text-xs font-medium uppercase tracking-[0.18em] text-[#8B7CFF]">
                    Finance
                </p>

                <h1 class="mt-2 text-2xl font-semibold tracking-tight text-white">
                    Create Invoice
                </h1>

                <p class="mt-1 text-sm text-[#8B919A]">
                    Create a new customer invoice from an existing sales order.
                </p>

            </div>


            <a
                href="{{ route('finance.invoices.index') }}"
                class="inline-flex items-center gap-2 rounded-xl border border-[#242830] bg-[#12151A] px-4 py-2.5 text-sm font-medium text-[#AEB4BE] transition hover:border-[#4037A5] hover:text-white"
            >

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-4 w-4"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="1.8"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M15 19l-7-7 7-7"
                    />
                </svg>

                Back to Invoices

            </a>

        </div>


        {{-- Validation Errors --}}
        @if ($errors->any())

            <div class="rounded-xl border border-red-400/15 bg-red-400/10 px-5 py-4">

                <div class="flex items-start gap-3">

                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-red-400/10 text-red-300">
                        !
                    </div>

                    <div>

                        <p class="text-sm font-medium text-red-300">
                            Please check the form.
                        </p>

                        <ul class="mt-2 space-y-1 text-xs text-red-200/80">

                            @foreach ($errors->all() as $error)

                                <li>
                                    {{ $error }}
                                </li>

                            @endforeach

                        </ul>

                    </div>

                </div>

            </div>

        @endif


        {{-- Main Form --}}
        <form
            method="POST"
            action="{{ route('finance.invoices.store') }}"
            class="space-y-6"
        >

            @csrf


            {{-- Invoice Details --}}
            <div class="rounded-2xl border border-[#242830] bg-[#12151A]">

                <div class="border-b border-[#242830] px-6 py-5">

                    <h2 class="text-sm font-semibold text-white">
                        Invoice Details
                    </h2>

                    <p class="mt-1 text-xs text-[#707782]">
                        Select a sales order to generate the invoice.
                    </p>

                </div>


                <div class="grid gap-6 p-6 lg:grid-cols-2">

                    {{-- Order --}}
                    <div class="lg:col-span-2">

                        <label
                            for="order_id"
                            class="mb-2 block text-xs font-medium uppercase tracking-wider text-[#8B919A]"
                        >
                            Sales Order
                        </label>

                        <select
                            id="order_id"
                            name="order_id"
                            required
                            class="w-full rounded-xl border border-[#242830] bg-[#0B0D10] px-4 py-3 text-sm text-[#F5F5F2] outline-none transition focus:border-[#8B7CFF]"
                        >

                            <option value="">
                                Select a sales order
                            </option>

                            @foreach ($orders as $order)

                                <option
                                    value="{{ $order->id }}"
                                    @selected(old('order_id') == $order->id)
                                    data-subtotal="{{ $order->subtotal ?? 0 }}"
                                    data-discount="{{ $order->discount ?? 0 }}"
                                    data-tax="{{ $order->tax ?? 0 }}"
                                    data-shipping="{{ $order->shipping_cost ?? 0 }}"
                                    data-customer="{{ $order->customer?->name ?? 'Unknown Customer' }}"
                                    data-order-number="{{ $order->order_number ?? '#' . $order->id }}"
                                >

                                    {{ $order->order_number ?? '#' . $order->id }}
                                    — {{ $order->customer?->name ?? 'Unknown Customer' }}

                                </option>

                            @endforeach

                        </select>

                        <p class="mt-2 text-xs text-[#666C75]">
                            Only sales orders that do not already have an invoice are shown.
                        </p>

                    </div>


                    {{-- Customer Preview --}}
                    <div>

                        <label
                            class="mb-2 block text-xs font-medium uppercase tracking-wider text-[#8B919A]"
                        >
                            Customer
                        </label>

                        <div
                            id="customerPreview"
                            class="flex min-h-[48px] items-center rounded-xl border border-[#242830] bg-[#0B0D10] px-4 text-sm text-[#666C75]"
                        >
                            Select a sales order first.
                        </div>

                    </div>


                    {{-- Order Preview --}}
                    <div>

                        <label
                            class="mb-2 block text-xs font-medium uppercase tracking-wider text-[#8B919A]"
                        >
                            Order Reference
                        </label>

                        <div
                            id="orderPreview"
                            class="flex min-h-[48px] items-center rounded-xl border border-[#242830] bg-[#0B0D10] px-4 text-sm text-[#666C75]"
                        >
                            —
                        </div>

                    </div>

                </div>

            </div>


            {{-- Financial Details --}}
            <div class="rounded-2xl border border-[#242830] bg-[#12151A]">

                <div class="border-b border-[#242830] px-6 py-5">

                    <h2 class="text-sm font-semibold text-white">
                        Financial Details
                    </h2>

                    <p class="mt-1 text-xs text-[#707782]">
                        Adjust invoice charges before creating the document.
                    </p>

                </div>


                <div class="grid gap-6 p-6 sm:grid-cols-2 lg:grid-cols-4">

                    {{-- Subtotal --}}
                    <div>

                        <label
                            class="mb-2 block text-xs font-medium uppercase tracking-wider text-[#8B919A]"
                        >
                            Subtotal
                        </label>

                        <div
                            id="subtotalDisplay"
                            class="flex min-h-[48px] items-center rounded-xl border border-[#242830] bg-[#0B0D10] px-4 text-sm font-medium text-white"
                        >
                            Rp 0
                        </div>

                    </div>


                    {{-- Discount --}}
                    <div>

                        <label
                            for="discount"
                            class="mb-2 block text-xs font-medium uppercase tracking-wider text-[#8B919A]"
                        >
                            Discount
                        </label>

                        <div class="relative">

                            <span class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-xs text-[#666C75]">
                                Rp
                            </span>

                            <input
                                id="discount"
                                type="number"
                                name="discount"
                                value="{{ old('discount', 0) }}"
                                min="0"
                                step="0.01"
                                class="w-full rounded-xl border border-[#242830] bg-[#0B0D10] py-3 pl-10 pr-4 text-sm text-[#F5F5F2] outline-none transition focus:border-[#8B7CFF]"
                            >

                        </div>

                    </div>


                    {{-- Tax --}}
                    <div>

                        <label
                            for="tax"
                            class="mb-2 block text-xs font-medium uppercase tracking-wider text-[#8B919A]"
                        >
                            Tax
                        </label>

                        <div class="relative">

                            <span class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-xs text-[#666C75]">
                                Rp
                            </span>

                            <input
                                id="tax"
                                type="number"
                                name="tax"
                                value="{{ old('tax', 0) }}"
                                min="0"
                                step="0.01"
                                class="w-full rounded-xl border border-[#242830] bg-[#0B0D10] py-3 pl-10 pr-4 text-sm text-[#F5F5F2] outline-none transition focus:border-[#8B7CFF]"
                            >

                        </div>

                    </div>


                    {{-- Shipping --}}
                    <div>

                        <label
                            for="shipping_cost"
                            class="mb-2 block text-xs font-medium uppercase tracking-wider text-[#8B919A]"
                        >
                            Shipping
                        </label>

                        <div class="relative">

                            <span class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-xs text-[#666C75]">
                                Rp
                            </span>

                            <input
                                id="shipping_cost"
                                type="number"
                                name="shipping_cost"
                                value="{{ old('shipping_cost', 0) }}"
                                min="0"
                                step="0.01"
                                class="w-full rounded-xl border border-[#242830] bg-[#0B0D10] py-3 pl-10 pr-4 text-sm text-[#F5F5F2] outline-none transition focus:border-[#8B7CFF]"
                            >

                        </div>

                    </div>

                </div>


                {{-- Total --}}
                <div class="border-t border-[#242830] px-6 py-6">

                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                        <div>

                            <p class="text-xs font-medium uppercase tracking-wider text-[#707782]">
                                Invoice Total
                            </p>

                            <p class="mt-1 text-xs text-[#666C75]">
                                Subtotal − discount + tax + shipping
                            </p>

                        </div>


                        <p
                            id="totalDisplay"
                            class="text-2xl font-semibold tracking-tight text-white"
                        >
                            Rp 0
                        </p>

                    </div>

                </div>

            </div>


            {{-- Payment Terms --}}
            <div class="rounded-2xl border border-[#242830] bg-[#12151A]">

                <div class="border-b border-[#242830] px-6 py-5">

                    <h2 class="text-sm font-semibold text-white">
                        Payment Terms
                    </h2>

                    <p class="mt-1 text-xs text-[#707782]">
                        Set the invoice due date and internal notes.
                    </p>

                </div>


                <div class="grid gap-6 p-6 lg:grid-cols-2">

                    {{-- Due Date --}}
                    <div>

                        <label
                            for="due_at"
                            class="mb-2 block text-xs font-medium uppercase tracking-wider text-[#8B919A]"
                        >
                            Due Date
                        </label>

                        <input
                            id="due_at"
                            type="date"
                            name="due_at"
                            value="{{ old('due_at') }}"
                            class="w-full rounded-xl border border-[#242830] bg-[#0B0D10] px-4 py-3 text-sm text-[#F5F5F2] outline-none transition focus:border-[#8B7CFF]"
                        >

                    </div>


                    {{-- Notes --}}
                    <div class="lg:row-span-2">

                        <label
                            for="notes"
                            class="mb-2 block text-xs font-medium uppercase tracking-wider text-[#8B919A]"
                        >
                            Notes
                        </label>

                        <textarea
                            id="notes"
                            name="notes"
                            rows="6"
                            maxlength="5000"
                            placeholder="Add internal notes for this invoice..."
                            class="w-full resize-none rounded-xl border border-[#242830] bg-[#0B0D10] px-4 py-3 text-sm text-[#F5F5F2] outline-none transition placeholder:text-[#666C75] focus:border-[#8B7CFF]"
                        >{{ old('notes') }}</textarea>

                    </div>

                </div>

            </div>


            {{-- Actions --}}
            <div class="flex flex-col-reverse gap-3 sm:flex-row sm:items-center sm:justify-end">

                <a
                    href="{{ route('finance.invoices.index') }}"
                    class="inline-flex items-center justify-center rounded-xl border border-[#242830] px-5 py-3 text-sm font-medium text-[#AEB4BE] transition hover:border-[#4037A5] hover:text-white"
                >
                    Cancel
                </a>


                <button
                    type="submit"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#8B7CFF] px-5 py-3 text-sm font-medium text-white transition hover:bg-[#7869EE]"
                >

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-4 w-4"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M5 13l4 4L19 7"
                        />
                    </svg>

                    Create Invoice

                </button>

            </div>

        </form>

    </div>


    {{-- Invoice Calculation --}}
    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const orderSelect = document.getElementById('order_id');

            const customerPreview = document.getElementById(
                'customerPreview'
            );

            const orderPreview = document.getElementById(
                'orderPreview'
            );

            const subtotalDisplay = document.getElementById(
                'subtotalDisplay'
            );

            const discountInput = document.getElementById(
                'discount'
            );

            const taxInput = document.getElementById(
                'tax'
            );

            const shippingInput = document.getElementById(
                'shipping_cost'
            );

            const totalDisplay = document.getElementById(
                'totalDisplay'
            );


            const formatter = new Intl.NumberFormat(
                'id-ID'
            );


            function money(value) {

                return 'Rp ' + formatter.format(
                    Math.max(0, Number(value) || 0)
                );

            }


            function updateInvoicePreview() {

                const selectedOption =
                    orderSelect.options[
                        orderSelect.selectedIndex
                    ];


                if (
                    !selectedOption
                    || !selectedOption.value
                ) {

                    customerPreview.textContent =
                        'Select a sales order first.';

                    customerPreview.classList.remove(
                        'text-[#C5CAD2]'
                    );

                    customerPreview.classList.add(
                        'text-[#666C75]'
                    );

                    orderPreview.textContent = '—';

                    subtotalDisplay.textContent =
                        'Rp 0';

                    totalDisplay.textContent =
                        'Rp 0';

                    return;

                }


                const subtotal = Number(
                    selectedOption.dataset.subtotal
                ) || 0;

                const orderDiscount = Number(
                    selectedOption.dataset.discount
                ) || 0;

                const orderTax = Number(
                    selectedOption.dataset.tax
                ) || 0;

                const orderShipping = Number(
                    selectedOption.dataset.shipping
                ) || 0;


                const customer =
                    selectedOption.dataset.customer
                    || 'Unknown Customer';


                const orderNumber =
                    selectedOption.dataset.orderNumber
                    || selectedOption.value;


                customerPreview.textContent =
                    customer;

                customerPreview.classList.remove(
                    'text-[#666C75]'
                );

                customerPreview.classList.add(
                    'text-[#C5CAD2]'
                );


                orderPreview.textContent =
                    orderNumber;


                subtotalDisplay.textContent =
                    money(subtotal);


                /*
                |--------------------------------------------------------------------------
                | Prefill order financial values
                |--------------------------------------------------------------------------
                */

                discountInput.value =
                    oldValueExists('discount')
                        ? discountInput.value
                        : orderDiscount;

                taxInput.value =
                    oldValueExists('tax')
                        ? taxInput.value
                        : orderTax;

                shippingInput.value =
                    oldValueExists('shipping_cost')
                        ? shippingInput.value
                        : orderShipping;


                calculateTotal();

            }


            function oldValueExists(field) {

                const input =
                    document.getElementById(field);

                return input.dataset.initialized === 'true';

            }


            function calculateTotal() {

                const selectedOption =
                    orderSelect.options[
                        orderSelect.selectedIndex
                    ];


                const subtotal = selectedOption
                    ? Number(
                        selectedOption.dataset.subtotal
                    ) || 0
                    : 0;


                const discount = Number(
                    discountInput.value
                ) || 0;

                const tax = Number(
                    taxInput.value
                ) || 0;

                const shipping = Number(
                    shippingInput.value
                ) || 0;


                const total = Math.max(
                    0,
                    subtotal
                    - discount
                    + tax
                    + shipping
                );


                subtotalDisplay.textContent =
                    money(subtotal);

                totalDisplay.textContent =
                    money(total);

            }


            discountInput.addEventListener(
                'input',
                function () {
                    this.dataset.initialized = 'true';
                    calculateTotal();
                }
            );


            taxInput.addEventListener(
                'input',
                function () {
                    this.dataset.initialized = 'true';
                    calculateTotal();
                }
            );


            shippingInput.addEventListener(
                'input',
                function () {
                    this.dataset.initialized = 'true';
                    calculateTotal();
                }
            );


            orderSelect.addEventListener(
                'change',
                function () {

                    if (!discountInput.dataset.initialized) {
                        discountInput.dataset.initialized = 'false';
                    }

                    if (!taxInput.dataset.initialized) {
                        taxInput.dataset.initialized = 'false';
                    }

                    if (!shippingInput.dataset.initialized) {
                        shippingInput.dataset.initialized = 'false';
                    }

                    updateInvoicePreview();

                }
            );


            updateInvoicePreview();

        });

    </script>

</x-app-layout>