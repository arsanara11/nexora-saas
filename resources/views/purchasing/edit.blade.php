<x-app-layout>

    <div class="mb-8 flex items-center justify-between">
        <div>
            <p class="mb-2 text-xs font-medium uppercase tracking-[0.2em] text-[#8B7CFF]">
                Operations / Purchasing
            </p>

            <h1 class="text-2xl font-semibold tracking-tight text-[#F5F5F2]">
                Edit Purchase Order
            </h1>

            <p class="mt-1 text-sm text-[#8B919A]">
                Update purchase order {{ $purchaseOrder->po_number }}
            </p>
        </div>

        <a
            href="{{ route('purchasing.show', $purchaseOrder) }}"
            class="rounded-lg border border-[#242830] bg-[#12151A] px-4 py-2.5 text-sm font-medium text-[#F5F5F2] transition hover:bg-[#181C23]"
        >
            Back
        </a>
    </div>

    @if ($errors->any())
        <div class="mb-6 rounded-xl border border-red-500/20 bg-red-500/10 p-4">
            <p class="mb-2 text-sm font-medium text-red-400">
                Please fix the following errors:
            </p>

            <ul class="space-y-1 text-sm text-red-300">
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form
        action="{{ route('purchasing.update', $purchaseOrder) }}"
        method="POST"
        class="space-y-6"
    >
        @csrf
        @method('PUT')

        {{-- Purchase Order Information --}}
        <div class="rounded-2xl border border-[#242830] bg-[#12151A] p-6">

            <div class="mb-6">
                <h2 class="text-base font-semibold text-[#F5F5F2]">
                    Purchase Order Information
                </h2>

                <p class="mt-1 text-sm text-[#8B919A]">
                    Update the basic purchase order information.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                {{-- PO Number --}}
                <div>
                    <label class="mb-2 block text-sm font-medium text-[#D7D9DE]">
                        PO Number
                    </label>

                    <input
                        type="text"
                        value="{{ $purchaseOrder->po_number }}"
                        disabled
                        class="w-full rounded-lg border border-[#242830] bg-[#0B0D10] px-4 py-3 text-sm text-[#8B919A] outline-none"
                    >
                </div>

                {{-- Supplier --}}
                <div>
                    <label
                        for="supplier_id"
                        class="mb-2 block text-sm font-medium text-[#D7D9DE]"
                    >
                        Supplier
                    </label>

                    <select
                        name="supplier_id"
                        id="supplier_id"
                        required
                        class="w-full rounded-lg border border-[#242830] bg-[#0B0D10] px-4 py-3 text-sm text-[#F5F5F2] outline-none transition focus:border-[#8B7CFF]"
                    >
                        <option value="">Select supplier</option>

                        @foreach ($suppliers as $supplier)
                            <option
                                value="{{ $supplier->id }}"
                                {{ old('supplier_id', $purchaseOrder->supplier_id) == $supplier->id ? 'selected' : '' }}
                            >
                                {{ $supplier->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Warehouse --}}
                <div>
                    <label
                        for="warehouse_id"
                        class="mb-2 block text-sm font-medium text-[#D7D9DE]"
                    >
                        Warehouse
                    </label>

                    <select
                        name="warehouse_id"
                        id="warehouse_id"
                        required
                        class="w-full rounded-lg border border-[#242830] bg-[#0B0D10] px-4 py-3 text-sm text-[#F5F5F2] outline-none transition focus:border-[#8B7CFF]"
                    >
                        <option value="">Select warehouse</option>

                        @foreach ($warehouses as $warehouse)
                            <option
                                value="{{ $warehouse->id }}"
                                {{ old('warehouse_id', $purchaseOrder->warehouse_id) == $warehouse->id ? 'selected' : '' }}
                            >
                                {{ $warehouse->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Order Date --}}
                <div>
                    <label
                        for="order_date"
                        class="mb-2 block text-sm font-medium text-[#D7D9DE]"
                    >
                        Order Date
                    </label>

                    <input
                        type="date"
                        name="order_date"
                        id="order_date"
                        value="{{ old('order_date', optional($purchaseOrder->ordered_at)->format('Y-m-d')) }}"
                        required
                        class="w-full rounded-lg border border-[#242830] bg-[#0B0D10] px-4 py-3 text-sm text-[#F5F5F2] outline-none transition focus:border-[#8B7CFF]"
                    >
                </div>

                {{-- Expected Date --}}
                <div>
                    <label
                        for="expected_date"
                        class="mb-2 block text-sm font-medium text-[#D7D9DE]"
                    >
                        Expected Date
                    </label>

                    <input
                        type="date"
                        name="expected_date"
                        id="expected_date"
                        value="{{ old('expected_date', optional($purchaseOrder->expected_at)->format('Y-m-d')) }}"
                        class="w-full rounded-lg border border-[#242830] bg-[#0B0D10] px-4 py-3 text-sm text-[#F5F5F2] outline-none transition focus:border-[#8B7CFF]"
                    >
                </div>

            </div>

            {{-- Notes --}}
            <div class="mt-5">
                <label
                    for="notes"
                    class="mb-2 block text-sm font-medium text-[#D7D9DE]"
                >
                    Notes
                </label>

                <textarea
                    name="notes"
                    id="notes"
                    rows="4"
                    placeholder="Add notes about this purchase order..."
                    class="w-full resize-none rounded-lg border border-[#242830] bg-[#0B0D10] px-4 py-3 text-sm text-[#F5F5F2] placeholder-[#666D78] outline-none transition focus:border-[#8B7CFF]"
                >{{ old('notes', $purchaseOrder->notes) }}</textarea>
            </div>

        </div>

        {{-- Order Items --}}
        <div class="rounded-2xl border border-[#242830] bg-[#12151A] p-6">

            <div class="mb-6 flex items-center justify-between">
                <div>
                    <h2 class="text-base font-semibold text-[#F5F5F2]">
                        Order Items
                    </h2>

                    <p class="mt-1 text-sm text-[#8B919A]">
                        Manage the products included in this purchase order.
                    </p>
                </div>

                <button
                    type="button"
                    id="add-item"
                    class="rounded-lg border border-[#242830] bg-[#0B0D10] px-4 py-2.5 text-sm font-medium text-[#F5F5F2] transition hover:bg-[#181C23]"
                >
                    + Add Item
                </button>
            </div>

            <div id="items-container" class="space-y-4">

                @foreach ($purchaseOrder->items as $index => $item)

                    <div class="item-row rounded-xl border border-[#242830] bg-[#0B0D10] p-5">

                        <div class="grid grid-cols-1 gap-4 lg:grid-cols-[2fr_1fr_1fr_auto]">

                            {{-- Product --}}
                            <div>
                                <label class="mb-2 block text-sm font-medium text-[#D7D9DE]">
                                    Product
                                </label>

                                <select
                                    name="items[{{ $index }}][product_variant_id]"
                                    class="product-select w-full rounded-lg border border-[#242830] bg-[#12151A] px-4 py-3 text-sm text-[#F5F5F2] outline-none transition focus:border-[#8B7CFF]"
                                    required
                                >
                                    <option value="">Select product</option>

                                    @foreach ($variants as $variant)
                                        <option
                                            value="{{ $variant->id }}"
                                            data-price="{{ $variant->cost_price ?? $variant->price }}"
                                            {{ old("items.$index.product_variant_id", $item->product_variant_id) == $variant->id ? 'selected' : '' }}
                                        >
                                            {{ $variant->product->name ?? $variant->name }}
                                            @if ($variant->sku)
                                                — {{ $variant->sku }}
                                            @endif
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Quantity --}}
                            <div>
                                <label class="mb-2 block text-sm font-medium text-[#D7D9DE]">
                                    Quantity
                                </label>

                                <input
                                    type="number"
                                    name="items[{{ $index }}][quantity]"
                                    class="quantity-input w-full rounded-lg border border-[#242830] bg-[#12151A] px-4 py-3 text-sm text-[#F5F5F2] outline-none transition focus:border-[#8B7CFF]"
                                    value="{{ old("items.$index.quantity", $item->quantity) }}"
                                    min="1"
                                    required
                                >
                            </div>

                            {{-- Unit Cost --}}
                            <div>
                                <label class="mb-2 block text-sm font-medium text-[#D7D9DE]">
                                    Unit Cost
                                </label>

                                <input
                                    type="number"
                                    name="items[{{ $index }}][unit_cost]"
                                    class="unit-cost-input w-full rounded-lg border border-[#242830] bg-[#12151A] px-4 py-3 text-sm text-[#F5F5F2] outline-none transition focus:border-[#8B7CFF]"
                                    value="{{ old("items.$index.unit_cost", $item->unit_cost) }}"
                                    min="0"
                                    step="0.01"
                                    required
                                >
                            </div>

                            {{-- Remove --}}
                            <div class="flex items-end">
                                <button
                                    type="button"
                                    class="remove-item w-full rounded-lg border border-red-500/20 bg-red-500/10 px-4 py-3 text-sm font-medium text-red-400 transition hover:bg-red-500/20 lg:w-auto"
                                >
                                    Remove
                                </button>
                            </div>

                        </div>

                        <div class="mt-4 flex items-center justify-between border-t border-[#242830] pt-4">
                            <span class="text-sm text-[#8B919A]">
                                Item Subtotal
                            </span>

                            <span class="item-subtotal text-sm font-semibold text-[#F5F5F2]">
                                Rp 0
                            </span>
                        </div>

                    </div>

                @endforeach

            </div>

            {{-- Total --}}
            <div class="mt-6 flex items-center justify-between border-t border-[#242830] pt-5">

                <span class="text-sm font-medium text-[#8B919A]">
                    Purchase Order Total
                </span>

                <span
                    id="grand-total"
                    class="text-xl font-semibold text-[#F5F5F2]"
                >
                    Rp 0
                </span>

            </div>

        </div>

        {{-- Actions --}}
        <div class="flex items-center justify-end gap-3">

            <a
                href="{{ route('purchasing.show', $purchaseOrder) }}"
                class="rounded-lg border border-[#242830] bg-[#12151A] px-5 py-3 text-sm font-medium text-[#F5F5F2] transition hover:bg-[#181C23]"
            >
                Cancel
            </a>

            <button
                type="submit"
                class="rounded-lg bg-[#8B7CFF] px-5 py-3 text-sm font-semibold text-white transition hover:bg-[#7969F2]"
            >
                Update Purchase Order
            </button>

        </div>

    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const container = document.getElementById('items-container');
            const addButton = document.getElementById('add-item');
            const grandTotal = document.getElementById('grand-total');

            let itemIndex = {{ $purchaseOrder->items->count() }};

            function formatCurrency(value) {
                return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0
                }).format(value);
            }

            function updateTotals() {

                let total = 0;

                document.querySelectorAll('.item-row').forEach(row => {

                    const quantity =
                        parseFloat(
                            row.querySelector('.quantity-input')?.value
                        ) || 0;

                    const unitCost =
                        parseFloat(
                            row.querySelector('.unit-cost-input')?.value
                        ) || 0;

                    const subtotal = quantity * unitCost;

                    const subtotalElement =
                        row.querySelector('.item-subtotal');

                    if (subtotalElement) {
                        subtotalElement.textContent =
                            formatCurrency(subtotal);
                    }

                    total += subtotal;
                });

                grandTotal.textContent = formatCurrency(total);
            }

            function attachRowEvents(row) {

                const productSelect =
                    row.querySelector('.product-select');

                const unitCostInput =
                    row.querySelector('.unit-cost-input');

                const quantityInput =
                    row.querySelector('.quantity-input');

                productSelect.addEventListener('change', function () {

                    const selected =
                        this.options[this.selectedIndex];

                    const price =
                        selected.dataset.price;

                    if (price && !unitCostInput.value) {
                        unitCostInput.value = price;
                    }

                    updateTotals();
                });

                quantityInput.addEventListener(
                    'input',
                    updateTotals
                );

                unitCostInput.addEventListener(
                    'input',
                    updateTotals
                );

                const removeButton =
                    row.querySelector('.remove-item');

                removeButton.addEventListener('click', function () {

                    const rows =
                        document.querySelectorAll('.item-row');

                    if (rows.length <= 1) {
                        alert('At least one item is required.');
                        return;
                    }

                    row.remove();

                    updateTotals();
                });
            }

            document.querySelectorAll('.item-row').forEach(
                attachRowEvents
            );

            addButton.addEventListener('click', function () {

                const row = document.createElement('div');

                row.className =
                    'item-row rounded-xl border border-[#242830] bg-[#0B0D10] p-5';

                row.innerHTML = `
                    <div class="grid grid-cols-1 gap-4 lg:grid-cols-[2fr_1fr_1fr_auto]">

                        <div>
                            <label class="mb-2 block text-sm font-medium text-[#D7D9DE]">
                                Product
                            </label>

                            <select
                                name="items[${itemIndex}][product_variant_id]"
                                class="product-select w-full rounded-lg border border-[#242830] bg-[#12151A] px-4 py-3 text-sm text-[#F5F5F2] outline-none transition focus:border-[#8B7CFF]"
                                required
                            >
                                <option value="">Select product</option>

                                @foreach ($variants as $variant)
                                    <option
                                        value="{{ $variant->id }}"
                                        data-price="{{ $variant->cost_price ?? $variant->price }}"
                                    >
                                        {{ $variant->product->name ?? $variant->name }}
                                        @if ($variant->sku)
                                            — {{ $variant->sku }}
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-medium text-[#D7D9DE]">
                                Quantity
                            </label>

                            <input
                                type="number"
                                name="items[${itemIndex}][quantity]"
                                class="quantity-input w-full rounded-lg border border-[#242830] bg-[#12151A] px-4 py-3 text-sm text-[#F5F5F2] outline-none transition focus:border-[#8B7CFF]"
                                value="1"
                                min="1"
                                required
                            >
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-medium text-[#D7D9DE]">
                                Unit Cost
                            </label>

                            <input
                                type="number"
                                name="items[${itemIndex}][unit_cost]"
                                class="unit-cost-input w-full rounded-lg border border-[#242830] bg-[#12151A] px-4 py-3 text-sm text-[#F5F5F2] outline-none transition focus:border-[#8B7CFF]"
                                value="0"
                                min="0"
                                step="0.01"
                                required
                            >
                        </div>

                        <div class="flex items-end">
                            <button
                                type="button"
                                class="remove-item w-full rounded-lg border border-red-500/20 bg-red-500/10 px-4 py-3 text-sm font-medium text-red-400 transition hover:bg-red-500/20 lg:w-auto"
                            >
                                Remove
                            </button>
                        </div>

                    </div>

                    <div class="mt-4 flex items-center justify-between border-t border-[#242830] pt-4">
                        <span class="text-sm text-[#8B919A]">
                            Item Subtotal
                        </span>

                        <span class="item-subtotal text-sm font-semibold text-[#F5F5F2]">
                            Rp 0
                        </span>
                    </div>
                `;

                container.appendChild(row);

                attachRowEvents(row);

                itemIndex++;

                updateTotals();
            });

            updateTotals();
        });
    </script>

</x-app-layout>