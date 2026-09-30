<x-app-layout>
    <div class="min-h-screen bg-[#0B0D10] px-8 py-8 text-[#F5F5F2]">

        {{-- Header --}}
        <div class="mb-8">
            <a
                href="{{ route('products.show', $product) }}"
                class="inline-flex items-center text-sm text-[#8B919A] transition hover:text-[#F5F5F2]"
            >
                ← Back to Product
            </a>

            <p class="mt-5 text-sm text-[#8B919A]">
                Catalog / Products / Edit
            </p>

            <h1 class="mt-2 text-3xl font-semibold tracking-tight">
                Edit Product
            </h1>

            <p class="mt-2 text-sm text-[#8B919A]">
                Update product information and pricing.
            </p>
        </div>


        {{-- Form --}}
        <form
            method="POST"
            action="{{ route('products.update', $product) }}"
            class="space-y-6"
        >
            @csrf
            @method('PUT')


            {{-- Product Information --}}
            <div class="overflow-hidden rounded-2xl border border-[#242830] bg-[#12151A]">

                <div class="border-b border-[#242830] px-6 py-5">
                    <h2 class="font-medium">
                        Product Information
                    </h2>

                    <p class="mt-1 text-sm text-[#8B919A]">
                        Basic information about your product.
                    </p>
                </div>


                <div class="grid grid-cols-1 gap-6 p-6 md:grid-cols-2">

                    {{-- Product Name --}}
                    <div>
                        <label
                            for="name"
                            class="text-sm font-medium"
                        >
                            Product Name
                        </label>

                        <input
                            id="name"
                            name="name"
                            type="text"
                            value="{{ old('name', $product->name) }}"
                            required
                            class="mt-2 block w-full rounded-xl border border-[#242830] bg-[#0B0D10] px-4 py-3 text-sm text-[#F5F5F2] outline-none transition placeholder:text-[#555B65] focus:border-[#8B7CFF] focus:ring-1 focus:ring-[#8B7CFF]"
                        >

                        @error('name')
                            <p class="mt-2 text-xs text-red-400">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>


                    {{-- Brand --}}
                    <div>
                        <label
                            for="brand"
                            class="text-sm font-medium"
                        >
                            Brand
                        </label>

                        <input
                            id="brand"
                            name="brand"
                            type="text"
                            value="{{ old('brand', $product->brand) }}"
                            class="mt-2 block w-full rounded-xl border border-[#242830] bg-[#0B0D10] px-4 py-3 text-sm text-[#F5F5F2] outline-none transition placeholder:text-[#555B65] focus:border-[#8B7CFF] focus:ring-1 focus:ring-[#8B7CFF]"
                        >

                        @error('brand')
                            <p class="mt-2 text-xs text-red-400">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>


                    {{-- Category --}}
                    <div>
                        <label
                            for="category_id"
                            class="text-sm font-medium"
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
                                    @selected(old('category_id', $product->category_id) == $category->id)
                                >
                                    {{ $category->name }}
                                </option>

                            @endforeach
                        </select>

                        @error('category_id')
                            <p class="mt-2 text-xs text-red-400">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>


                    {{-- Status --}}
                    <div>
                        <label
                            for="status"
                            class="text-sm font-medium"
                        >
                            Status
                        </label>

                        <select
                            id="status"
                            name="status"
                            class="mt-2 block w-full rounded-xl border border-[#242830] bg-[#0B0D10] px-4 py-3 text-sm text-[#F5F5F2] outline-none transition focus:border-[#8B7CFF] focus:ring-1 focus:ring-[#8B7CFF]"
                        >
                            <option
                                value="active"
                                @selected(old('status', $product->status) === 'active')
                            >
                                Active
                            </option>

                            <option
                                value="inactive"
                                @selected(old('status', $product->status) === 'inactive')
                            >
                                Inactive
                            </option>
                        </select>

                        @error('status')
                            <p class="mt-2 text-xs text-red-400">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>


                    {{-- Description --}}
                    <div class="md:col-span-2">

                        <label
                            for="description"
                            class="text-sm font-medium"
                        >
                            Description
                        </label>

                        <textarea
                            id="description"
                            name="description"
                            rows="5"
                            class="mt-2 block w-full rounded-xl border border-[#242830] bg-[#0B0D10] px-4 py-3 text-sm text-[#F5F5F2] outline-none transition placeholder:text-[#555B65] focus:border-[#8B7CFF] focus:ring-1 focus:ring-[#8B7CFF]"
                        >{{ old('description', $product->description) }}</textarea>

                        @error('description')
                            <p class="mt-2 text-xs text-red-400">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                </div>

            </div>


            {{-- Variant Information --}}
            <div class="overflow-hidden rounded-2xl border border-[#242830] bg-[#12151A]">

                <div class="border-b border-[#242830] px-6 py-5">

                    <h2 class="font-medium">
                        Variant Information
                    </h2>

                    <p class="mt-1 text-sm text-[#8B919A]">
                        Update SKU and pricing information.
                    </p>

                </div>


                <div class="grid grid-cols-1 gap-6 p-6 md:grid-cols-2">

                    {{-- SKU --}}
                    <div>

                        <label
                            for="sku"
                            class="text-sm font-medium"
                        >
                            SKU
                        </label>

                        <input
                            id="sku"
                            name="sku"
                            type="text"
                            value="{{ old('sku', $variant?->sku) }}"
                            required
                            class="mt-2 block w-full rounded-xl border border-[#242830] bg-[#0B0D10] px-4 py-3 font-mono text-sm text-[#F5F5F2] outline-none transition focus:border-[#8B7CFF] focus:ring-1 focus:ring-[#8B7CFF]"
                        >

                        @error('sku')
                            <p class="mt-2 text-xs text-red-400">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Variant Name --}}
                    <div>

                        <label
                            for="variant_name"
                            class="text-sm font-medium"
                        >
                            Variant Name
                        </label>

                        <input
                            id="variant_name"
                            name="variant_name"
                            type="text"
                            value="{{ old('variant_name', $variant?->name) }}"
                            required
                            class="mt-2 block w-full rounded-xl border border-[#242830] bg-[#0B0D10] px-4 py-3 text-sm text-[#F5F5F2] outline-none transition focus:border-[#8B7CFF] focus:ring-1 focus:ring-[#8B7CFF]"
                        >

                        @error('variant_name')
                            <p class="mt-2 text-xs text-red-400">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Price --}}
                    <div>

                        <label
                            for="price"
                            class="text-sm font-medium"
                        >
                            Selling Price
                        </label>

                        <div class="relative mt-2">

                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-sm text-[#8B919A]">
                                Rp
                            </span>

                            <input
                                id="price"
                                name="price"
                                type="number"
                                min="0"
                                step="0.01"
                                value="{{ old('price', $variant?->price) }}"
                                required
                                class="block w-full rounded-xl border border-[#242830] bg-[#0B0D10] py-3 pl-11 pr-4 text-sm text-[#F5F5F2] outline-none transition focus:border-[#8B7CFF] focus:ring-1 focus:ring-[#8B7CFF]"
                            >

                        </div>

                        @error('price')
                            <p class="mt-2 text-xs text-red-400">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Cost Price --}}
                    <div>

                        <label
                            for="cost_price"
                            class="text-sm font-medium"
                        >
                            Cost Price
                        </label>

                        <div class="relative mt-2">

                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-sm text-[#8B919A]">
                                Rp
                            </span>

                            <input
                                id="cost_price"
                                name="cost_price"
                                type="number"
                                min="0"
                                step="0.01"
                                value="{{ old('cost_price', $variant?->cost_price) }}"
                                class="block w-full rounded-xl border border-[#242830] bg-[#0B0D10] py-3 pl-11 pr-4 text-sm text-[#F5F5F2] outline-none transition focus:border-[#8B7CFF] focus:ring-1 focus:ring-[#8B7CFF]"
                            >

                        </div>

                        @error('cost_price')
                            <p class="mt-2 text-xs text-red-400">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Variant Status --}}
                    <div class="md:col-span-2">

                        <label class="flex cursor-pointer items-center gap-3">

                            <input
                                type="checkbox"
                                name="is_active"
                                value="1"
                                @checked(old('is_active', $variant?->is_active))
                                class="h-4 w-4 rounded border-[#242830] bg-[#0B0D10] text-[#8B7CFF] focus:ring-[#8B7CFF]"
                            >

                            <span>
                                <span class="block text-sm font-medium">
                                    Active Variant
                                </span>

                                <span class="mt-1 block text-xs text-[#8B919A]">
                                    Allow this variant to be used in sales and inventory.
                                </span>
                            </span>

                        </label>

                    </div>

                </div>

            </div>


            {{-- Actions --}}
            <div class="flex items-center justify-end gap-3">

                <a
                    href="{{ route('products.show', $product) }}"
                    class="rounded-xl border border-[#242830] px-5 py-3 text-sm font-medium text-[#8B919A] transition hover:border-[#3A3F48] hover:text-[#F5F5F2]"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="rounded-xl bg-[#8B7CFF] px-6 py-3 text-sm font-medium text-white transition hover:opacity-90"
                >
                    Save Changes
                </button>

            </div>

        </form>

    </div>
</x-app-layout>