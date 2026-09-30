<x-app-layout>
    <div class="min-h-screen bg-[#0B0D10] text-[#F5F5F2] px-8 py-8">

        {{-- Header --}}
        <div class="mb-8">
            <a
                href="{{ route('products.index') }}"
                class="text-sm text-[#8B919A] transition hover:text-[#F5F5F2]"
            >
                ← Back to Products
            </a>

            <div class="mt-6">
                <p class="mb-2 text-sm text-[#8B919A]">
                    Catalog
                </p>

                <h1 class="text-3xl font-semibold tracking-tight">
                    Add Product
                </h1>

                <p class="mt-2 text-sm text-[#8B919A]">
                    Create a new product for your business catalog.
                </p>
            </div>
        </div>


        {{-- Form --}}
        <div class="max-w-4xl">

            <div class="rounded-2xl border border-[#242830] bg-[#12151A] p-8">

                <form
                    method="POST"
                    action="{{ route('products.store') }}"
                >
                    @csrf

                    {{-- Basic Information --}}
                    <div>
                        <h2 class="text-lg font-medium">
                            Basic Information
                        </h2>

                        <p class="mt-1 text-sm text-[#8B919A]">
                            Enter the main information about this product.
                        </p>
                    </div>


                    <div class="mt-6 grid grid-cols-1 gap-6 md:grid-cols-2">

                        {{-- Product Name --}}
                        <div class="md:col-span-2">

                            <label
                                for="name"
                                class="text-sm font-medium text-[#8B919A]"
                            >
                                Product Name
                            </label>

                            <input
                                id="name"
                                type="text"
                                name="name"
                                value="{{ old('name') }}"
                                placeholder="e.g. Essential Oversized Shirt"
                                class="mt-2 block w-full rounded-xl border border-[#242830] bg-[#0B0D10] px-4 py-3 text-sm text-[#F5F5F2] placeholder-[#555B65] outline-none transition focus:border-[#8B7CFF] focus:ring-1 focus:ring-[#8B7CFF]"
                            >

                        </div>


                        {{-- Category --}}
                        <div>

                            <label
                                for="category_id"
                                class="text-sm font-medium text-[#8B919A]"
                            >
                                Category
                            </label>

                            <select
                                id="category_id"
                                name="category_id"
                                class="mt-2 block w-full rounded-xl border border-[#242830] bg-[#0B0D10] px-4 py-3 text-sm text-[#F5F5F2] outline-none transition focus:border-[#8B7CFF] focus:ring-1 focus:ring-[#8B7CFF]"
                            >
                                <option value="">
                                    Select category
                                </option>

                                @foreach ($categories as $category)
                                    <option
                                        value="{{ $category->id }}"
                                        @selected(old('category_id') == $category->id)
                                    >
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>

                        </div>


                        {{-- Brand --}}
                        <div>

                            <label
                                for="brand"
                                class="text-sm font-medium text-[#8B919A]"
                            >
                                Brand
                            </label>

                            <input
                                id="brand"
                                type="text"
                                name="brand"
                                value="{{ old('brand') }}"
                                placeholder="e.g. NEXORA"
                                class="mt-2 block w-full rounded-xl border border-[#242830] bg-[#0B0D10] px-4 py-3 text-sm text-[#F5F5F2] placeholder-[#555B65] outline-none transition focus:border-[#8B7CFF] focus:ring-1 focus:ring-[#8B7CFF]"
                            >

                        </div>


                        {{-- Description --}}
                        <div class="md:col-span-2">

                            <label
                                for="description"
                                class="text-sm font-medium text-[#8B919A]"
                            >
                                Description
                            </label>

                            <textarea
                                id="description"
                                name="description"
                                rows="4"
                                placeholder="Describe your product..."
                                class="mt-2 block w-full resize-none rounded-xl border border-[#242830] bg-[#0B0D10] px-4 py-3 text-sm text-[#F5F5F2] placeholder-[#555B65] outline-none transition focus:border-[#8B7CFF] focus:ring-1 focus:ring-[#8B7CFF]"
                            >{{ old('description') }}</textarea>

                        </div>

                    </div>


                    {{-- Product Variant --}}
                    <div class="mt-10 border-t border-[#242830] pt-8">

                        <div>
                            <h2 class="text-lg font-medium">
                                Product Variant
                            </h2>

                            <p class="mt-1 text-sm text-[#8B919A]">
                                Add the first variant, including SKU and pricing.
                            </p>
                        </div>


                        <div class="mt-6 grid grid-cols-1 gap-6 md:grid-cols-2">

                            {{-- SKU --}}
                            <div>

                                <label
                                    for="sku"
                                    class="text-sm font-medium text-[#8B919A]"
                                >
                                    SKU
                                </label>

                                <input
                                    id="sku"
                                    type="text"
                                    name="sku"
                                    value="{{ old('sku') }}"
                                    placeholder="e.g. NOIR-001"
                                    class="mt-2 block w-full rounded-xl border border-[#242830] bg-[#0B0D10] px-4 py-3 text-sm text-[#F5F5F2] placeholder-[#555B65] outline-none transition focus:border-[#8B7CFF] focus:ring-1 focus:ring-[#8B7CFF]"
                                >

                            </div>


                            {{-- Variant Name --}}
                            <div>

                                <label
                                    for="variant_name"
                                    class="text-sm font-medium text-[#8B919A]"
                                >
                                    Variant Name
                                </label>

                                <input
                                    id="variant_name"
                                    type="text"
                                    name="variant_name"
                                    value="{{ old('variant_name') }}"
                                    placeholder="e.g. Black / Large"
                                    class="mt-2 block w-full rounded-xl border border-[#242830] bg-[#0B0D10] px-4 py-3 text-sm text-[#F5F5F2] placeholder-[#555B65] outline-none transition focus:border-[#8B7CFF] focus:ring-1 focus:ring-[#8B7CFF]"
                                >

                            </div>


                            {{-- Price --}}
                            <div>

                                <label
                                    for="price"
                                    class="text-sm font-medium text-[#8B919A]"
                                >
                                    Selling Price
                                </label>

                                <div class="relative mt-2">

                                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-sm text-[#8B919A]">
                                        Rp
                                    </span>

                                    <input
                                        id="price"
                                        type="number"
                                        name="price"
                                        value="{{ old('price') }}"
                                        min="0"
                                        step="0.01"
                                        placeholder="349000"
                                        class="block w-full rounded-xl border border-[#242830] bg-[#0B0D10] py-3 pl-11 pr-4 text-sm text-[#F5F5F2] placeholder-[#555B65] outline-none transition focus:border-[#8B7CFF] focus:ring-1 focus:ring-[#8B7CFF]"
                                    >

                                </div>

                            </div>


                            {{-- Cost Price --}}
                            <div>

                                <label
                                    for="cost_price"
                                    class="text-sm font-medium text-[#8B919A]"
                                >
                                    Cost Price
                                </label>

                                <div class="relative mt-2">

                                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-sm text-[#8B919A]">
                                        Rp
                                    </span>

                                    <input
                                        id="cost_price"
                                        type="number"
                                        name="cost_price"
                                        value="{{ old('cost_price') }}"
                                        min="0"
                                        step="0.01"
                                        placeholder="200000"
                                        class="block w-full rounded-xl border border-[#242830] bg-[#0B0D10] py-3 pl-11 pr-4 text-sm text-[#F5F5F2] placeholder-[#555B65] outline-none transition focus:border-[#8B7CFF] focus:ring-1 focus:ring-[#8B7CFF]"
                                    >

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- Status --}}
                    <div class="mt-10 border-t border-[#242830] pt-8">

                        <div>
                            <h2 class="text-lg font-medium">
                                Product Status
                            </h2>

                            <p class="mt-1 text-sm text-[#8B919A]">
                                Choose whether this product is currently active.
                            </p>
                        </div>


                        <div class="mt-5">

                            <label class="inline-flex cursor-pointer items-center gap-3">

                                <input
                                    type="checkbox"
                                    name="is_active"
                                    value="1"
                                    checked
                                    class="h-4 w-4 rounded border-[#242830] bg-[#0B0D10] text-[#8B7CFF] focus:ring-[#8B7CFF]"
                                >

                                <span class="text-sm text-[#F5F5F2]">
                                    Product is active
                                </span>

                            </label>

                        </div>

                    </div>


                    {{-- Actions --}}
                    <div class="mt-10 flex items-center justify-end gap-3 border-t border-[#242830] pt-6">

                        <a
                            href="{{ route('products.index') }}"
                            class="rounded-xl border border-[#242830] px-5 py-3 text-sm font-medium text-[#8B919A] transition hover:border-[#383D47] hover:text-[#F5F5F2]"
                        >
                            Cancel
                        </a>

                        <button
                            type="submit"
                            class="rounded-xl bg-[#8B7CFF] px-5 py-3 text-sm font-medium text-white transition hover:opacity-90"
                        >
                            Create Product
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>
</x-app-layout>