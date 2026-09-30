<x-app-layout>

    <div class="w-full max-w-[1500px]">

        {{-- Breadcrumb --}}
        <div class="mb-7 flex items-center gap-2 text-sm">
            <a
                href="{{ route('inventory.index') }}"
                class="text-[#8B7CFF] transition hover:opacity-80"
            >
                Inventory Management
            </a>

            <span class="text-[#555B66]">›</span>

            <span class="text-[#8B919A]">
                Add Inventory
            </span>
        </div>


        {{-- Header --}}
        <div class="mb-8 flex items-center justify-between">

            <div>
                <h1 class="text-2xl font-semibold tracking-tight text-[#F5F5F2]">
                    Add Inventory
                </h1>

                <p class="mt-1 text-sm text-[#8B919A]">
                    Add stock inventory to a warehouse.
                </p>
            </div>

            <a
                href="{{ route('inventory.index') }}"
                class="rounded-lg border border-[#242830] bg-[#12151A] px-5 py-2.5 text-sm text-[#C7CBD2] transition hover:border-[#343944] hover:text-white"
            >
                Back to Inventory
            </a>

        </div>


        {{-- Form --}}
        <form
            method="POST"
            action="{{ route('inventory.store') }}"
            class="w-full rounded-2xl border border-[#242830] bg-[#12151A]"
        >

            @csrf

            <div class="p-8">

                {{-- Section --}}
                <div class="mb-8">
                    <h2 class="text-base font-medium text-[#F5F5F2]">
                        Inventory Information
                    </h2>

                    <p class="mt-1 text-sm text-[#8B919A]">
                        Select the warehouse and product variant for this inventory.
                    </p>
                </div>


                {{-- Warehouse & Variant --}}
                <div class="grid grid-cols-2 gap-6">

                    {{-- Warehouse --}}
                    <div>
                        <label
                            for="warehouse_id"
                            class="mb-2 block text-sm font-medium text-[#C7CBD2]"
                        >
                            Warehouse
                        </label>

                        <select
                            id="warehouse_id"
                            name="warehouse_id"
                            class="w-full rounded-xl border border-[#242830] bg-[#0B0D10] px-4 py-3 text-sm text-[#F5F5F2] outline-none transition focus:border-[#8B7CFF]"
                        >
                            <option value="">
                                Select warehouse
                            </option>

                            @foreach ($warehouses as $warehouse)
                                <option
                                    value="{{ $warehouse->id }}"
                                    {{ old('warehouse_id') == $warehouse->id ? 'selected' : '' }}
                                >
                                    {{ $warehouse->name }}
                                </option>
                            @endforeach
                        </select>

                        @error('warehouse_id')
                            <p class="mt-2 text-xs text-red-400">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>


                    {{-- Product Variant --}}
                    <div>
                        <label
                            for="product_variant_id"
                            class="mb-2 block text-sm font-medium text-[#C7CBD2]"
                        >
                            Product Variant
                        </label>

                        <select
                            id="product_variant_id"
                            name="product_variant_id"
                            class="w-full rounded-xl border border-[#242830] bg-[#0B0D10] px-4 py-3 text-sm text-[#F5F5F2] outline-none transition focus:border-[#8B7CFF]"
                        >
                            <option value="">
                                Select product variant
                            </option>

                            @foreach ($variants as $variant)
                                <option
                                    value="{{ $variant->id }}"
                                    {{ old('product_variant_id') == $variant->id ? 'selected' : '' }}
                                >
                                    {{ $variant->product->name }} — {{ $variant->name }}
                                </option>
                            @endforeach
                        </select>

                        @error('product_variant_id')
                            <p class="mt-2 text-xs text-red-400">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                </div>


                {{-- Stock Information --}}
                <div class="mt-8 border-t border-[#242830] pt-8">

                    <div class="mb-6">
                        <h2 class="text-base font-medium text-[#F5F5F2]">
                            Stock Information
                        </h2>

                        <p class="mt-1 text-sm text-[#8B919A]">
                            Set the initial inventory quantities.
                        </p>
                    </div>


                    <div class="grid grid-cols-3 gap-6">

                        {{-- Quantity --}}
                        <div>
                            <label
                                for="quantity"
                                class="mb-2 block text-sm font-medium text-[#C7CBD2]"
                            >
                                Quantity
                            </label>

                            <input
                                type="number"
                                id="quantity"
                                name="quantity"
                                value="{{ old('quantity', 0) }}"
                                min="0"
                                class="w-full rounded-xl border border-[#242830] bg-[#0B0D10] px-4 py-3 text-sm text-[#F5F5F2] outline-none transition focus:border-[#8B7CFF]"
                            >

                            @error('quantity')
                                <p class="mt-2 text-xs text-red-400">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>


                        {{-- Reserved --}}
                        <div>
                            <label
                                for="reserved_quantity"
                                class="mb-2 block text-sm font-medium text-[#C7CBD2]"
                            >
                                Reserved Quantity
                            </label>

                            <input
                                type="number"
                                id="reserved_quantity"
                                name="reserved_quantity"
                                value="{{ old('reserved_quantity', 0) }}"
                                min="0"
                                class="w-full rounded-xl border border-[#242830] bg-[#0B0D10] px-4 py-3 text-sm text-[#F5F5F2] outline-none transition focus:border-[#8B7CFF]"
                            >

                            @error('reserved_quantity')
                                <p class="mt-2 text-xs text-red-400">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>


                        {{-- Reorder Level --}}
                        <div>
                            <label
                                for="reorder_level"
                                class="mb-2 block text-sm font-medium text-[#C7CBD2]"
                            >
                                Reorder Level
                            </label>

                            <input
                                type="number"
                                id="reorder_level"
                                name="reorder_level"
                                value="{{ old('reorder_level', 10) }}"
                                min="0"
                                class="w-full rounded-xl border border-[#242830] bg-[#0B0D10] px-4 py-3 text-sm text-[#F5F5F2] outline-none transition focus:border-[#8B7CFF]"
                            >

                            @error('reorder_level')
                                <p class="mt-2 text-xs text-red-400">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                    </div>

                </div>

            </div>


            {{-- Footer --}}
            <div class="flex items-center justify-end gap-3 border-t border-[#242830] px-8 py-5">

                <a
                    href="{{ route('inventory.index') }}"
                    class="rounded-lg px-5 py-2.5 text-sm text-[#8B919A] transition hover:text-white"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="rounded-lg bg-[#8B7CFF] px-6 py-2.5 text-sm font-medium text-white transition hover:opacity-90"
                >
                    Add Inventory
                </button>

            </div>

        </form>

    </div>

</x-app-layout>