<x-app-layout>

    <div class="space-y-6">

        {{-- Header --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">

            <div>
                <p class="text-xs font-medium uppercase tracking-[0.2em] text-[#8B7CFF]">
                    Sales
                </p>

                <h1 class="mt-2 text-2xl font-semibold tracking-tight text-[#F5F5F2]">
                    Edit Sales Order
                </h1>

                <p class="mt-1 text-sm text-[#8B919A]">
                    {{ $order->order_number }}
                </p>
            </div>

            <a
                href="{{ route('orders.show', $order) }}"
                class="inline-flex items-center justify-center rounded-lg border border-[#242830] px-4 py-2.5 text-sm font-medium text-[#D9DCE1] transition hover:border-[#3A3F49] hover:bg-[#171B22] hover:text-white"
            >
                ← Back to Order
            </a>

        </div>


        {{-- Validation Errors --}}
        @if ($errors->any())

            <div class="rounded-xl border border-red-500/20 bg-red-500/10 px-5 py-4">

                <p class="text-sm font-medium text-red-400">
                    Please fix the following errors:
                </p>

                <ul class="mt-2 space-y-1 text-sm text-red-300">

                    @foreach ($errors->all() as $error)

                        <li>
                            • {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        @endif


        <form
            action="{{ route('orders.update', $order) }}"
            method="POST"
            class="space-y-6"
        >

            @csrf
            @method('PUT')


            {{-- Order Information --}}
            <div class="rounded-2xl border border-[#242830] bg-[#12151A]">

                <div class="border-b border-[#242830] px-6 py-5">

                    <h2 class="text-sm font-semibold text-[#F5F5F2]">
                        Order Information
                    </h2>

                    <p class="mt-1 text-xs text-[#8B919A]">
                        Update the customer, warehouse, and order date.
                    </p>

                </div>


                <div class="grid gap-6 p-6 md:grid-cols-3">

                    {{-- Customer --}}
                    <div>

                        <label
                            for="customer_id"
                            class="mb-2 block text-xs font-medium uppercase tracking-[0.12em] text-[#8B919A]"
                        >
                            Customer
                        </label>

                        <select
                            id="customer_id"
                            name="customer_id"
                            required
                            class="w-full rounded-lg border border-[#242830] bg-[#0B0D10] px-4 py-3 text-sm text-[#F5F5F2] outline-none transition focus:border-[#8B7CFF] focus:ring-1 focus:ring-[#8B7CFF]"
                        >

                            <option value="">
                                Select customer
                            </option>

                            @foreach ($customers as $customer)

                                <option
                                    value="{{ $customer->id }}"
                                    @selected(old('customer_id', $order->customer_id) == $customer->id)
                                >
                                    {{ $customer->name }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- Warehouse --}}
                    <div>

                        <label
                            for="warehouse_id"
                            class="mb-2 block text-xs font-medium uppercase tracking-[0.12em] text-[#8B919A]"
                        >
                            Warehouse
                        </label>

                        <select
                            id="warehouse_id"
                            name="warehouse_id"
                            required
                            class="w-full rounded-lg border border-[#242830] bg-[#0B0D10] px-4 py-3 text-sm text-[#F5F5F2] outline-none transition focus:border-[#8B7CFF] focus:ring-1 focus:ring-[#8B7CFF]"
                        >

                            <option value="">
                                Select warehouse
                            </option>

                            @foreach ($warehouses as $warehouse)

                                <option
                                    value="{{ $warehouse->id }}"
                                    @selected(old('warehouse_id', $order->warehouse_id) == $warehouse->id)
                                >
                                    {{ $warehouse->name }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- Order Date --}}
                    <div>

                        <label
                            for="ordered_at"
                            class="mb-2 block text-xs font-medium uppercase tracking-[0.12em] text-[#8B919A]"
                        >
                            Order Date
                        </label>

                        <input
                            type="datetime-local"
                            id="ordered_at"
                            name="ordered_at"
                            value="{{ old('ordered_at', $order->ordered_at?->format('Y-m-d\TH:i')) }}"
                            required
                            class="w-full rounded-lg border border-[#242830] bg-[#0B0D10] px-4 py-3 text-sm text-[#F5F5F2] outline-none transition focus:border-[#8B7CFF] focus:ring-1 focus:ring-[#8B7CFF]"
                        >

                    </div>

                </div>

            </div>


            {{-- Order Items --}}
            <div class="rounded-2xl border border-[#242830] bg-[#12151A]">

                <div class="flex flex-col gap-4 border-b border-[#242830] px-6 py-5 sm:flex-row sm:items-center sm:justify-between">

                    <div>

                        <h2 class="text-sm font-semibold text-[#F5F5F2]">
                            Order Items
                        </h2>

                        <p class="mt-1 text-xs text-[#8B919A]">
                            Update products, quantities, prices, and discounts.
                        </p>

                    </div>

                    <button
                        type="button"
                        id="add-item"
                        class="inline-flex items-center justify-center rounded-lg border border-[#242830] px-4 py-2 text-sm font-medium text-[#F5F5F2] transition hover:border-[#3A3F49] hover:bg-[#171B22]"
                    >
                        + Add Item
                    </button>

                </div>


                <div
                    id="items-container"
                    class="space-y-4 p-6"
                >

                    @foreach ($order->items as $index => $item)

                        <div
                            class="item-row rounded-xl border border-[#242830] bg-[#0B0D10] p-5"
                        >

                            <div class="grid gap-4 md:grid-cols-12">

                                {{-- Product --}}
                                <div class="md:col-span-5">

                                    <label class="mb-2 block text-xs font-medium uppercase tracking-[0.12em] text-[#8B919A]">
                                        Product / Variant
                                    </label>

                                    <select
                                        name="items[{{ $index }}][product_variant_id]"
                                        class="variant-select w-full rounded-lg border border-[#242830] bg-[#12151A] px-4 py-3 text-sm text-[#F5F5F2] outline-none transition focus:border-[#8B7CFF] focus:ring-1 focus:ring-[#8B7CFF]"
                                        required
                                    >

                                        <option value="">
                                            Select product
                                        </option>

                                        @foreach ($variants as $variant)

                                            <option
                                                value="{{ $variant->id }}"
                                                data-price="{{ $variant->price }}"
                                                @selected($item->product_variant_id == $variant->id)
                                            >
                                                {{ $variant->product->name ?? $variant->name }}
                                                — {{ $variant->name }}
                                                — Rp {{ number_format((float) $variant->price, 0, ',', '.') }}
                                            </option>

                                        @endforeach

                                    </select>

                                </div>


                                {{-- Quantity --}}
                                <div class="md:col-span-2">

                                    <label class="mb-2 block text-xs font-medium uppercase tracking-[0.12em] text-[#8B919A]">
                                        Quantity
                                    </label>

                                    <input
                                        type="number"
                                        name="items[{{ $index }}][quantity]"
                                        class="quantity-input w-full rounded-lg border border-[#242830] bg-[#12151A] px-4 py-3 text-sm text-[#F5F5F2] outline-none transition focus:border-[#8B7CFF] focus:ring-1 focus:ring-[#8B7CFF]"
                                        value="{{ old("items.$index.quantity", $item->quantity) }}"
                                        min="1"
                                        required
                                    >

                                </div>


                                {{-- Unit Price --}}
                                <div class="md:col-span-2">

                                    <label class="mb-2 block text-xs font-medium uppercase tracking-[0.12em] text-[#8B919A]">
                                        Unit Price
                                    </label>

                                    <input
                                        type="number"
                                        name="items[{{ $index }}][unit_price]"
                                        class="price-input w-full rounded-lg border border-[#242830] bg-[#12151A] px-4 py-3 text-sm text-[#F5F5F2] outline-none transition focus:border-[#8B7CFF] focus:ring-1 focus:ring-[#8B7CFF]"
                                        value="{{ old("items.$index.unit_price", $item->unit_price) }}"
                                        min="0"
                                        step="0.01"
                                        required
                                    >

                                </div>


                                {{-- Discount --}}
                                <div class="md:col-span-2">

                                    <label class="mb-2 block text-xs font-medium uppercase tracking-[0.12em] text-[#8B919A]">
                                        Discount
                                    </label>

                                    <input
                                        type="number"
                                        name="items[{{ $index }}][discount]"
                                        class="item-discount-input w-full rounded-lg border border-[#242830] bg-[#12151A] px-4 py-3 text-sm text-[#F5F5F2] outline-none transition focus:border-[#8B7CFF] focus:ring-1 focus:ring-[#8B7CFF]"
                                        value="{{ old("items.$index.discount", $item->discount) }}"
                                        min="0"
                                        step="0.01"
                                    >

                                </div>


                                {{-- Remove --}}
                                <div class="flex items-end md:col-span-1">

                                    <button
                                        type="button"
                                        class="remove-item w-full rounded-lg border border-red-500/20 px-3 py-3 text-xs font-medium text-red-400 transition hover:bg-red-500/10"
                                    >
                                        Remove
                                    </button>

                                </div>

                            </div>


                            {{-- Item Total --}}
                            <div class="mt-4 flex items-center justify-between border-t border-[#242830] pt-4">

                                <span class="text-xs uppercase tracking-[0.12em] text-[#8B919A]">
                                    Item Total
                                </span>

                                <span class="item-total text-sm font-semibold text-[#F5F5F2]">
                                    Rp 0
                                </span>

                            </div>

                        </div>

                    @endforeach

                </div>

            </div>


            {{-- Pricing --}}
            <div class="grid gap-6 lg:grid-cols-2">

                {{-- Additional Charges --}}
                <div class="rounded-2xl border border-[#242830] bg-[#12151A]">

                    <div class="border-b border-[#242830] px-6 py-5">

                        <h2 class="text-sm font-semibold text-[#F5F5F2]">
                            Additional Charges
                        </h2>

                        <p class="mt-1 text-xs text-[#8B919A]">
                            Update order-level discount, tax, and shipping.
                        </p>

                    </div>


                    <div class="space-y-5 p-6">

                        {{-- Order Discount --}}
                        <div>

                            <label
                                for="discount"
                                class="mb-2 block text-xs font-medium uppercase tracking-[0.12em] text-[#8B919A]"
                            >
                                Order Discount
                            </label>

                            <input
                                type="number"
                                id="discount"
                                name="discount"
                                value="{{ old('discount', $order->discount) }}"
                                min="0"
                                step="0.01"
                                class="w-full rounded-lg border border-[#242830] bg-[#0B0D10] px-4 py-3 text-sm text-[#F5F5F2] outline-none transition focus:border-[#8B7CFF] focus:ring-1 focus:ring-[#8B7CFF]"
                            >

                        </div>


                        {{-- Tax --}}
                        <div>

                            <label
                                for="tax"
                                class="mb-2 block text-xs font-medium uppercase tracking-[0.12em] text-[#8B919A]"
                            >
                                Tax
                            </label>

                            <input
                                type="number"
                                id="tax"
                                name="tax"
                                value="{{ old('tax', $order->tax) }}"
                                min="0"
                                step="0.01"
                                class="w-full rounded-lg border border-[#242830] bg-[#0B0D10] px-4 py-3 text-sm text-[#F5F5F2] outline-none transition focus:border-[#8B7CFF] focus:ring-1 focus:ring-[#8B7CFF]"
                            >

                        </div>


                        {{-- Shipping --}}
                        <div>

                            <label
                                for="shipping_cost"
                                class="mb-2 block text-xs font-medium uppercase tracking-[0.12em] text-[#8B919A]"
                            >
                                Shipping Cost
                            </label>

                            <input
                                type="number"
                                id="shipping_cost"
                                name="shipping_cost"
                                value="{{ old('shipping_cost', $order->shipping_cost) }}"
                                min="0"
                                step="0.01"
                                class="w-full rounded-lg border border-[#242830] bg-[#0B0D10] px-4 py-3 text-sm text-[#F5F5F2] outline-none transition focus:border-[#8B7CFF] focus:ring-1 focus:ring-[#8B7CFF]"
                            >

                        </div>

                    </div>

                </div>


                {{-- Summary --}}
                <div class="rounded-2xl border border-[#242830] bg-[#12151A]">

                    <div class="border-b border-[#242830] px-6 py-5">

                        <h2 class="text-sm font-semibold text-[#F5F5F2]">
                            Order Summary
                        </h2>

                    </div>


                    <div class="space-y-4 p-6">

                        <div class="flex items-center justify-between">

                            <span class="text-sm text-[#8B919A]">
                                Subtotal
                            </span>

                            <span
                                id="summary-subtotal"
                                class="text-sm font-medium text-[#D9DCE1]"
                            >
                                Rp 0
                            </span>

                        </div>


                        <div class="flex items-center justify-between">

                            <span class="text-sm text-[#8B919A]">
                                Discount
                            </span>

                            <span
                                id="summary-discount"
                                class="text-sm font-medium text-[#D9DCE1]"
                            >
                                Rp 0
                            </span>

                        </div>


                        <div class="flex items-center justify-between">

                            <span class="text-sm text-[#8B919A]">
                                Tax
                            </span>

                            <span
                                id="summary-tax"
                                class="text-sm font-medium text-[#D9DCE1]"
                            >
                                Rp 0
                            </span>

                        </div>


                        <div class="flex items-center justify-between">

                            <span class="text-sm text-[#8B919A]">
                                Shipping
                            </span>

                            <span
                                id="summary-shipping"
                                class="text-sm font-medium text-[#D9DCE1]"
                            >
                                Rp 0
                            </span>

                        </div>


                        <div class="border-t border-[#242830] pt-5">

                            <div class="flex items-center justify-between">

                                <span class="text-sm font-semibold text-[#F5F5F2]">
                                    Total
                                </span>

                                <span
                                    id="summary-total"
                                    class="text-xl font-semibold text-[#F5F5F2]"
                                >
                                    Rp 0
                                </span>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- Notes --}}
            <div class="rounded-2xl border border-[#242830] bg-[#12151A]">

                <div class="border-b border-[#242830] px-6 py-5">

                    <h2 class="text-sm font-semibold text-[#F5F5F2]">
                        Notes
                    </h2>

                </div>


                <div class="p-6">

                    <textarea
                        name="notes"
                        rows="4"
                        placeholder="Add order notes..."
                        class="w-full resize-none rounded-lg border border-[#242830] bg-[#0B0D10] px-4 py-3 text-sm text-[#F5F5F2] placeholder-[#555C67] outline-none transition focus:border-[#8B7CFF] focus:ring-1 focus:ring-[#8B7CFF]"
                    >{{ old('notes', $order->notes) }}</textarea>

                </div>

            </div>


            {{-- Actions --}}
            <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

                <a
                    href="{{ route('orders.show', $order) }}"
                    class="inline-flex items-center justify-center rounded-lg border border-[#242830] px-5 py-3 text-sm font-medium text-[#D9DCE1] transition hover:border-[#3A3F49] hover:bg-[#171B22] hover:text-white"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="inline-flex items-center justify-center rounded-lg bg-[#F5F5F2] px-5 py-3 text-sm font-semibold text-[#080B10] transition hover:bg-white"
                >
                    Save Changes
                </button>

            </div>

        </form>

    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const itemsContainer =
                document.getElementById('items-container');

            const addItemButton =
                document.getElementById('add-item');

            const discountInput =
                document.getElementById('discount');

            const taxInput =
                document.getElementById('tax');

            const shippingInput =
                document.getElementById('shipping_cost');


            let itemIndex =
                {{ $order->items->count() }};


            function formatCurrency(value) {

                return 'Rp ' + new Intl.NumberFormat('id-ID', {
                    maximumFractionDigits: 0
                }).format(value);

            }


            function updateItemTotal(row) {

                const quantityInput =
                    row.querySelector('.quantity-input');

                const priceInput =
                    row.querySelector('.price-input');

                const itemDiscountInput =
                    row.querySelector('.item-discount-input');

                const itemTotal =
                    row.querySelector('.item-total');


                const quantity =
                    parseFloat(quantityInput.value) || 0;

                const price =
                    parseFloat(priceInput.value) || 0;

                const discount =
                    parseFloat(itemDiscountInput.value) || 0;


                const total =
                    Math.max(
                        0,
                        (quantity * price) - discount
                    );


                itemTotal.textContent =
                    formatCurrency(total);

            }


            function updateSummary() {

                let subtotal = 0;


                document
                    .querySelectorAll('.item-row')
                    .forEach(function (row) {

                        const quantity =
                            parseFloat(
                                row.querySelector(
                                    '.quantity-input'
                                ).value
                            ) || 0;


                        const price =
                            parseFloat(
                                row.querySelector(
                                    '.price-input'
                                ).value
                            ) || 0;


                        const discount =
                            parseFloat(
                                row.querySelector(
                                    '.item-discount-input'
                                ).value
                            ) || 0;


                        subtotal += Math.max(
                            0,
                            (quantity * price) - discount
                        );

                    });


                const discount =
                    parseFloat(discountInput.value) || 0;

                const tax =
                    parseFloat(taxInput.value) || 0;

                const shipping =
                    parseFloat(shippingInput.value) || 0;


                const total =
                    Math.max(
                        0,
                        subtotal
                        - discount
                        + tax
                        + shipping
                    );


                document.getElementById(
                    'summary-subtotal'
                ).textContent =
                    formatCurrency(subtotal);


                document.getElementById(
                    'summary-discount'
                ).textContent =
                    formatCurrency(discount);


                document.getElementById(
                    'summary-tax'
                ).textContent =
                    formatCurrency(tax);


                document.getElementById(
                    'summary-shipping'
                ).textContent =
                    formatCurrency(shipping);


                document.getElementById(
                    'summary-total'
                ).textContent =
                    formatCurrency(total);

            }


            function setupRow(row) {

                const variantSelect =
                    row.querySelector('.variant-select');

                const priceInput =
                    row.querySelector('.price-input');

                const quantityInput =
                    row.querySelector('.quantity-input');

                const itemDiscountInput =
                    row.querySelector('.item-discount-input');

                const removeButton =
                    row.querySelector('.remove-item');


                variantSelect.addEventListener(
                    'change',
                    function () {

                        const selectedOption =
                            variantSelect.options[
                                variantSelect.selectedIndex
                            ];


                        if (
                            selectedOption &&
                            selectedOption.dataset.price
                        ) {

                            priceInput.value =
                                selectedOption.dataset.price;

                        }


                        updateItemTotal(row);
                        updateSummary();

                    }
                );


                quantityInput.addEventListener(
                    'input',
                    function () {

                        updateItemTotal(row);
                        updateSummary();

                    }
                );


                priceInput.addEventListener(
                    'input',
                    function () {

                        updateItemTotal(row);
                        updateSummary();

                    }
                );


                itemDiscountInput.addEventListener(
                    'input',
                    function () {

                        updateItemTotal(row);
                        updateSummary();

                    }
                );


                removeButton.addEventListener(
                    'click',
                    function () {

                        const rows =
                            document.querySelectorAll(
                                '.item-row'
                            );


                        if (rows.length <= 1) {

                            return;

                        }


                        row.remove();

                        updateRemoveButtons();
                        updateSummary();

                    }
                );


                updateItemTotal(row);

            }


            function updateRemoveButtons() {

                const rows =
                    document.querySelectorAll('.item-row');


                rows.forEach(function (row) {

                    const removeButton =
                        row.querySelector('.remove-item');


                    if (rows.length > 1) {

                        removeButton.classList.remove(
                            'hidden'
                        );

                    } else {

                        removeButton.classList.add(
                            'hidden'
                        );

                    }

                });

            }


            addItemButton.addEventListener(
                'click',
                function () {

                    const firstRow =
                        document.querySelector('.item-row');


                    const newRow =
                        firstRow.cloneNode(true);


                    newRow
                        .querySelector('.variant-select')
                        .name =
                        `items[${itemIndex}][product_variant_id]`;


                    newRow
                        .querySelector('.quantity-input')
                        .name =
                        `items[${itemIndex}][quantity]`;


                    newRow
                        .querySelector('.price-input')
                        .name =
                        `items[${itemIndex}][unit_price]`;


                    newRow
                        .querySelector('.item-discount-input')
                        .name =
                        `items[${itemIndex}][discount]`;


                    newRow
                        .querySelector('.variant-select')
                        .value = '';


                    newRow
                        .querySelector('.quantity-input')
                        .value = 1;


                    newRow
                        .querySelector('.price-input')
                        .value = 0;


                    newRow
                        .querySelector('.item-discount-input')
                        .value = 0;


                    newRow
                        .querySelector('.item-total')
                        .textContent =
                        'Rp 0';


                    itemsContainer.appendChild(newRow);


                    setupRow(newRow);

                    updateRemoveButtons();

                    itemIndex++;

                    updateSummary();

                }
            );


            discountInput.addEventListener(
                'input',
                updateSummary
            );


            taxInput.addEventListener(
                'input',
                updateSummary
            );


            shippingInput.addEventListener(
                'input',
                updateSummary
            );


            document
                .querySelectorAll('.item-row')
                .forEach(function (row) {

                    setupRow(row);

                });


            updateRemoveButtons();
            updateSummary();

        });
    </script>

</x-app-layout>