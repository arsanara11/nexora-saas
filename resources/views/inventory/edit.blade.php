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
                Edit Inventory
            </span>
        </div>


        {{-- Header --}}
        <div class="mb-8 flex items-center justify-between">

            <div>
                <h1 class="text-2xl font-semibold tracking-tight text-[#F5F5F2]">
                    Edit Inventory
                </h1>

                <p class="mt-1 text-sm text-[#8B919A]">
                    Update inventory stock information.
                </p>
            </div>

            <a
                href="{{ route('inventory.show', $inventory) }}"
                class="rounded-lg border border-[#242830] bg-[#12151A] px-5 py-2.5 text-sm text-[#C7CBD2] transition hover:border-[#343944] hover:text-white"
            >
                Back to Detail
            </a>

        </div>


        {{-- Form --}}
        <form
            method="POST"
            action="{{ route('inventory.update', $inventory) }}"
            class="w-full rounded-2xl border border-[#242830] bg-[#12151A]"
        >

            @csrf
            @method('PUT')

            <div class="p-8">

                {{-- Inventory Information --}}
                <div class="mb-8">
                    <h2 class="text-base font-medium text-[#F5F5F2]">
                        Inventory Information
                    </h2>

                    <p class="mt-1 text-sm text-[#8B919A]">
                        Review the warehouse and product assigned to this inventory.
                    </p>
                </div>


                {{-- Warehouse & Product --}}
                <div class="grid grid-cols-2 gap-6">

                    {{-- Warehouse --}}
                    <div>
                        <label
                            class="mb-2 block text-sm font-medium text-[#C7CBD2]"
                        >
                            Warehouse
                        </label>

                        <div class="rounded-xl border border-[#242830] bg-[#0B0D10] px-4 py-3 text-sm text-[#8B919A]">
                            {{ $inventory->warehouse->name }}
                        </div>
                    </div>


                    {{-- Product Variant --}}
                    <div>
                        <label
                            class="mb-2 block text-sm font-medium text-[#C7CBD2]"
                        >
                            Product Variant
                        </label>

                        <div class="rounded-xl border border-[#242830] bg-[#0B0D10] px-4 py-3 text-sm text-[#8B919A]">
                            {{ $inventory->productVariant->product->name }}
                            — {{ $inventory->productVariant->name }}
                        </div>
                    </div>

                </div>


                {{-- Stock Information --}}
                <div class="mt-8 border-t border-[#242830] pt-8">

                    <div class="mb-6">
                        <h2 class="text-base font-medium text-[#F5F5F2]">
                            Stock Information
                        </h2>

                        <p class="mt-1 text-sm text-[#8B919A]">
                            Update the current inventory quantities.
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
                                value="{{ old('quantity', $inventory->quantity) }}"
                                min="0"
                                class="w-full rounded-xl border border-[#242830] bg-[#0B0D10] px-4 py-3 text-sm text-[#F5F5F2] outline-none transition focus:border-[#8B7CFF]"
                            >

                            @error('quantity')
                                <p class="mt-2 text-xs text-red-400">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>


                        {{-- Reserved Quantity --}}
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
                                value="{{ old('reserved_quantity', $inventory->reserved_quantity) }}"
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
                                value="{{ old('reorder_level', $inventory->reorder_level) }}"
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
                    href="{{ route('inventory.show', $inventory) }}"
                    class="rounded-lg px-5 py-2.5 text-sm text-[#8B919A] transition hover:text-white"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="rounded-lg bg-[#8B7CFF] px-6 py-2.5 text-sm font-medium text-white transition hover:opacity-90"
                >
                    Save Changes
                </button>

            </div>

        </form>

    </div>

</x-app-layout>