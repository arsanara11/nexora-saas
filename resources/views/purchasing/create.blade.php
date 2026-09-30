<x-app-layout>

    <div class="min-h-screen bg-[#0B0D10] px-8 py-8 text-[#F5F5F2]">

        {{-- Header --}}
        <div class="mb-8">

            <p class="text-sm text-[#8B919A]">
                Operations / Purchasing / Create
            </p>

            <div class="mt-2">

                <h1 class="text-3xl font-semibold tracking-tight">
                    Create Purchase Order
                </h1>

                <p class="mt-2 text-sm text-[#8B919A]">
                    Create a new purchase order for your supplier.
                </p>

            </div>

        </div>


        {{-- Validation Errors --}}
        @if ($errors->any())

            <div class="mb-6 rounded-xl border border-red-500/20 bg-red-500/10 px-5 py-4">

                <p class="text-sm font-medium text-red-400">
                    Please fix the following errors:
                </p>

                <ul class="mt-2 list-disc space-y-1 pl-5 text-sm text-red-400">

                    @foreach ($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        @endif


        {{-- Form --}}
        <form
            method="POST"
            action="{{ route('purchasing.store') }}"
            class="space-y-6"
        >

            @csrf


            {{-- Purchase Order Information --}}
            <div class="overflow-hidden rounded-2xl border border-[#242830] bg-[#12151A]">

                <div class="border-b border-[#242830] px-6 py-5">

                    <h2 class="font-medium">
                        Purchase Order Information
                    </h2>

                    <p class="mt-1 text-sm text-[#8B919A]">
                        Basic information for this purchase order.
                    </p>

                </div>


                <div class="grid grid-cols-1 gap-6 px-6 py-6 md:grid-cols-2">


                    {{-- Supplier --}}
                    <div>

                        <label
                            for="supplier_id"
                            class="mb-2 block text-sm font-medium text-[#C5CAD2]"
                        >
                            Supplier
                        </label>

                        <select
                            id="supplier_id"
                            name="supplier_id"
                            required
                            class="w-full rounded-xl border border-[#2A3039] bg-[#0B0D10] px-4 py-3 text-sm text-[#F5F5F2] outline-none transition focus:border-[#8B7CFF]"
                        >

                            <option value="" class="bg-[#0B0D10]">
                                Select supplier
                            </option>

                            @foreach ($suppliers as $supplier)

                                <option
                                    value="{{ $supplier->id }}"
                                    class="bg-[#0B0D10]"
                                    {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}
                                >
                                    {{ $supplier->name }}

                                    @if ($supplier->code)
                                        — {{ $supplier->code }}
                                    @endif

                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- Warehouse --}}
                    <div>

                        <label
                            for="warehouse_id"
                            class="mb-2 block text-sm font-medium text-[#C5CAD2]"
                        >
                            Warehouse
                        </label>

                        <select
                            id="warehouse_id"
                            name="warehouse_id"
                            required
                            class="w-full rounded-xl border border-[#2A3039] bg-[#0B0D10] px-4 py-3 text-sm text-[#F5F5F2] outline-none transition focus:border-[#8B7CFF]"
                        >

                            <option value="" class="bg-[#0B0D10]">
                                Select warehouse
                            </option>

                            @foreach ($warehouses as $warehouse)

                                <option
                                    value="{{ $warehouse->id }}"
                                    class="bg-[#0B0D10]"
                                    {{ old('warehouse_id') == $warehouse->id ? 'selected' : '' }}
                                >
                                    {{ $warehouse->name }}

                                    @if ($warehouse->code)
                                        — {{ $warehouse->code }}
                                    @endif

                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- Order Date --}}
                    <div>

                        <label
                            for="order_date"
                            class="mb-2 block text-sm font-medium text-[#C5CAD2]"
                        >
                            Order Date
                        </label>

                        <input
                            type="date"
                            id="order_date"
                            name="order_date"
                            value="{{ old('order_date', now()->format('Y-m-d')) }}"
                            required
                            class="w-full rounded-xl border border-[#2A3039] bg-[#0B0D10] px-4 py-3 text-sm text-[#F5F5F2] outline-none transition focus:border-[#8B7CFF]"
                        >

                    </div>


                    {{-- Expected Date --}}
                    <div>

                        <label
                            for="expected_date"
                            class="mb-2 block text-sm font-medium text-[#C5CAD2]"
                        >
                            Expected Delivery Date
                        </label>

                        <input
                            type="date"
                            id="expected_date"
                            name="expected_date"
                            value="{{ old('expected_date') }}"
                            class="w-full rounded-xl border border-[#2A3039] bg-[#0B0D10] px-4 py-3 text-sm text-[#F5F5F2] outline-none transition focus:border-[#8B7CFF]"
                        >

                    </div>


                    {{-- Notes --}}
                    <div class="md:col-span-2">

                        <label
                            for="notes"
                            class="mb-2 block text-sm font-medium text-[#C5CAD2]"
                        >
                            Notes
                        </label>

                        <input
                            type="text"
                            id="notes"
                            name="notes"
                            value="{{ old('notes') }}"
                            placeholder="Optional notes"
                            class="w-full rounded-xl border border-[#2A3039] bg-[#0B0D10] px-4 py-3 text-sm text-[#F5F5F2] outline-none placeholder:text-[#666D78] transition focus:border-[#8B7CFF]"
                        >

                    </div>

                </div>

            </div>


            {{-- Products --}}
            <div class="overflow-hidden rounded-2xl border border-[#242830] bg-[#12151A]">

                <div class="border-b border-[#242830] px-6 py-5">

                    <div class="flex items-center justify-between">

                        <div>

                            <h2 class="font-medium">
                                Order Items
                            </h2>

                            <p class="mt-1 text-sm text-[#8B919A]">
                                Add the products and quantities you want to purchase.
                            </p>

                        </div>


                        <button
                            type="button"
                            id="add-item"
                            class="rounded-xl border border-[#2A3039] bg-[#0B0D10] px-4 py-2.5 text-sm font-medium text-[#F5F5F2] transition hover:border-[#8B7CFF] hover:text-[#8B7CFF]"
                        >
                            + Add Item
                        </button>

                    </div>

                </div>


                <div class="overflow-x-auto">

                    <table class="w-full min-w-[850px] text-left">

                        <thead
                            class="border-b border-[#242830] text-xs uppercase tracking-wider text-[#8B919A]"
                        >

                            <tr>

                                <th class="px-6 py-4 font-medium">
                                    Product Variant
                                </th>

                                <th class="px-6 py-4 font-medium">
                                    Quantity
                                </th>

                                <th class="px-6 py-4 font-medium">
                                    Unit Cost
                                </th>

                                <th class="px-6 py-4 text-right font-medium">
                                    Subtotal
                                </th>

                                <th class="w-16 px-6 py-4">
                                </th>

                            </tr>

                        </thead>


                        <tbody
                            id="items-container"
                            class="divide-y divide-[#242830]"
                        >

                            {{-- First Item --}}
                            <tr class="item-row">

                                <td class="px-6 py-5">

                                    <select
                                        name="product_variant_id[]"
                                        required
                                        class="product-select w-full rounded-xl border border-[#2A3039] bg-[#0B0D10] px-4 py-3 text-sm text-[#F5F5F2] outline-none transition focus:border-[#8B7CFF]"
                                    >

                                        <option value="" class="bg-[#0B0D10]">
                                            Select product
                                        </option>

                                        @foreach ($variants as $variant)

                                            <option
                                                value="{{ $variant->id }}"
                                                data-price="{{ $variant->cost_price ?? 0 }}"
                                                class="bg-[#0B0D10]"
                                            >
                                                {{ $variant->product->name ?? 'Unknown Product' }}
                                                — {{ $variant->name }}

                                                @if ($variant->sku)
                                                    ({{ $variant->sku }})
                                                @endif

                                            </option>

                                        @endforeach

                                    </select>

                                </td>


                                <td class="px-6 py-5">

                                    <input
                                        type="number"
                                        name="quantity[]"
                                        value="1"
                                        min="1"
                                        required
                                        class="quantity-input w-full rounded-xl border border-[#2A3039] bg-[#0B0D10] px-4 py-3 text-sm text-[#F5F5F2] outline-none transition focus:border-[#8B7CFF]"
                                    >

                                </td>


                                <td class="px-6 py-5">

                                    <input
                                        type="number"
                                        name="unit_cost[]"
                                        value="0"
                                        min="0"
                                        step="0.01"
                                        required
                                        class="cost-input w-full rounded-xl border border-[#2A3039] bg-[#0B0D10] px-4 py-3 text-sm text-[#F5F5F2] outline-none transition focus:border-[#8B7CFF]"
                                    >

                                </td>


                                <td class="px-6 py-5 text-right">

                                    <span class="subtotal text-sm font-medium text-[#F5F5F2]">
                                        Rp 0
                                    </span>

                                </td>


                                <td class="px-6 py-5 text-right">

                                    <button
                                        type="button"
                                        class="remove-item text-sm text-[#8B919A] transition hover:text-red-400"
                                        disabled
                                    >
                                        Remove
                                    </button>

                                </td>

                            </tr>

                        </tbody>

                    </table>

                </div>


                {{-- Total --}}
                <div class="border-t border-[#242830] px-6 py-5">

                    <div class="flex items-center justify-end gap-8">

                        <span class="text-sm text-[#8B919A]">
                            Total
                        </span>

                        <span
                            id="grand-total"
                            class="text-lg font-semibold text-[#F5F5F2]"
                        >
                            Rp 0
                        </span>

                    </div>

                </div>

            </div>


            {{-- Footer --}}
            <div class="flex items-center justify-between">

                <a
                    href="{{ route('purchasing.index') }}"
                    class="rounded-xl border border-[#2A3039] bg-[#12151A] px-5 py-3 text-sm font-medium text-[#C5CAD2] transition hover:border-[#8B7CFF] hover:text-white"
                >
                    Cancel
                </a>


                <button
                    type="submit"
                    class="rounded-xl bg-[#8B7CFF] px-6 py-3 text-sm font-medium text-white transition hover:opacity-90"
                >
                    Create Purchase Order
                </button>

            </div>

        </form>

    </div>


    {{-- JavaScript --}}
    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const container = document.getElementById('items-container');
            const addButton = document.getElementById('add-item');
            const grandTotal = document.getElementById('grand-total');


            function formatCurrency(value) {

                return 'Rp ' + Number(value).toLocaleString('id-ID', {
                    maximumFractionDigits: 0
                });

            }


            function updateRow(row) {

                const quantity = row.querySelector('.quantity-input');
                const cost = row.querySelector('.cost-input');
                const subtotal = row.querySelector('.subtotal');

                const qty = Number(quantity.value) || 0;
                const unitCost = Number(cost.value) || 0;

                const total = qty * unitCost;

                subtotal.textContent = formatCurrency(total);

                updateGrandTotal();

            }


            function updateGrandTotal() {

                let total = 0;

                container.querySelectorAll('.item-row').forEach(function (row) {

                    const quantity = row.querySelector('.quantity-input');
                    const cost = row.querySelector('.cost-input');

                    const qty = Number(quantity.value) || 0;
                    const unitCost = Number(cost.value) || 0;

                    total += qty * unitCost;

                });

                grandTotal.textContent = formatCurrency(total);

            }


            function attachRowEvents(row) {

                const productSelect = row.querySelector('.product-select');
                const quantity = row.querySelector('.quantity-input');
                const cost = row.querySelector('.cost-input');
                const removeButton = row.querySelector('.remove-item');


                productSelect.addEventListener('change', function () {

                    const selectedOption =
                        productSelect.options[productSelect.selectedIndex];

                    const price =
                        selectedOption.getAttribute('data-price');

                    if (price !== null) {
                        cost.value = price || 0;
                    }

                    updateRow(row);

                });


                quantity.addEventListener('input', function () {
                    updateRow(row);
                });


                cost.addEventListener('input', function () {
                    updateRow(row);
                });


                removeButton.addEventListener('click', function () {

                    row.remove();

                    updateGrandTotal();

                    updateRemoveButtons();

                });

            }


            function updateRemoveButtons() {

                const rows = container.querySelectorAll('.item-row');

                rows.forEach(function (row) {

                    const button = row.querySelector('.remove-item');

                    button.disabled = rows.length === 1;

                });

            }


            addButton.addEventListener('click', function () {

                const firstRow = container.querySelector('.item-row');

                const newRow = firstRow.cloneNode(true);

                newRow.querySelector('.product-select').value = '';

                newRow.querySelector('.quantity-input').value = 1;

                newRow.querySelector('.cost-input').value = 0;

                newRow.querySelector('.subtotal').textContent = 'Rp 0';

                container.appendChild(newRow);

                attachRowEvents(newRow);

                updateRemoveButtons();

                updateGrandTotal();

            });


            const firstRow = container.querySelector('.item-row');

            attachRowEvents(firstRow);

            updateGrandTotal();

        });

    </script>

</x-app-layout>