<x-app-layout>

    <div class="min-h-screen bg-[#0B0D10] px-8 py-8 text-[#F5F5F2]">

        {{-- Header --}}
        <div class="mb-8 flex items-center justify-between">

            <div>

                <a
                    href="{{ route('products.index') }}"
                    class="mb-4 inline-flex items-center text-sm text-[#8B919A] transition hover:text-[#F5F5F2]"
                >
                    ← Back to Products
                </a>

                <p class="text-sm text-[#8B919A]">
                    Catalog / Product Detail
                </p>

                <h1 class="mt-2 text-3xl font-semibold tracking-tight">
                    {{ $product->name }}
                </h1>

                @if ($product->brand)
                    <p class="mt-2 text-sm text-[#8B919A]">
                        {{ $product->brand }}
                    </p>
                @endif

            </div>


            {{-- Header Actions --}}
            <div class="flex items-center gap-3">

                {{-- Edit Product --}}
                <a
                    href="{{ route('products.edit', $product) }}"
                    class="rounded-xl border border-[#242830] bg-[#12151A] px-5 py-3 text-sm font-medium text-[#F5F5F2] transition hover:border-[#8B7CFF] hover:text-[#8B7CFF]"
                >
                    Edit Product
                </a>


                {{-- Product Status --}}
                @if (($product->status ?? 'inactive') === 'active')

                    <span
                        class="inline-flex rounded-full border border-[#3A4A40] bg-[#152019] px-4 py-2 text-sm text-[#9BC7A8]"
                    >
                        Active
                    </span>

                @else

                    <span
                        class="inline-flex rounded-full border border-[#242830] bg-[#12151A] px-4 py-2 text-sm text-[#8B919A]"
                    >
                        Inactive
                    </span>

                @endif

            </div>

        </div>


        {{-- Product Information + Image --}}
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">


            {{-- Product Information --}}
            <div class="rounded-2xl border border-[#242830] bg-[#12151A] lg:col-span-2">

                <div class="border-b border-[#242830] px-6 py-5">

                    <h2 class="font-medium">
                        Product Information
                    </h2>

                    <p class="mt-1 text-sm text-[#8B919A]">
                        Basic information about this product.
                    </p>

                </div>


                <div class="grid grid-cols-1 gap-6 p-6 sm:grid-cols-2">


                    {{-- Product Name --}}
                    <div>

                        <p class="text-xs uppercase tracking-wider text-[#8B919A]">
                            Product Name
                        </p>

                        <p class="mt-2 text-sm font-medium">
                            {{ $product->name }}
                        </p>

                    </div>


                    {{-- Brand --}}
                    <div>

                        <p class="text-xs uppercase tracking-wider text-[#8B919A]">
                            Brand
                        </p>

                        <p class="mt-2 text-sm">
                            {{ $product->brand ?? '—' }}
                        </p>

                    </div>


                    {{-- Category --}}
                    <div>

                        <p class="text-xs uppercase tracking-wider text-[#8B919A]">
                            Category
                        </p>

                        <p class="mt-2 text-sm">
                            {{ $product->category->name ?? 'Uncategorized' }}
                        </p>

                    </div>


                    {{-- Status --}}
                    <div>

                        <p class="text-xs uppercase tracking-wider text-[#8B919A]">
                            Status
                        </p>

                        <p class="mt-2 text-sm">
                            {{ ucfirst($product->status ?? 'Inactive') }}
                        </p>

                    </div>


                    {{-- Description --}}
                    <div class="sm:col-span-2">

                        <p class="text-xs uppercase tracking-wider text-[#8B919A]">
                            Description
                        </p>

                        <p class="mt-2 text-sm leading-6 text-[#B7BCC5]">
                            {{ $product->description ?? 'No description available.' }}
                        </p>

                    </div>

                </div>

            </div>


            {{-- Product Image --}}
            <div class="rounded-2xl border border-[#242830] bg-[#12151A]">

                <div class="border-b border-[#242830] px-6 py-5">

                    <h2 class="font-medium">
                        Product Image
                    </h2>

                </div>


                <div class="p-6">

                    @if ($product->image)

                        <img
                            src="{{ asset('storage/' . $product->image) }}"
                            alt="{{ $product->name }}"
                            class="aspect-square w-full rounded-xl border border-[#242830] object-cover"
                        >

                    @else

                        <div
                            class="flex aspect-square w-full items-center justify-center rounded-xl border border-[#242830] bg-[#0B0D10]"
                        >

                            <span class="text-sm text-[#8B919A]">
                                No image available
                            </span>

                        </div>

                    @endif

                </div>

            </div>

        </div>


        {{-- Product Variants --}}
        <div class="mt-6 overflow-hidden rounded-2xl border border-[#242830] bg-[#12151A]">


            {{-- Section Header --}}
            <div class="border-b border-[#242830] px-6 py-5">

                <h2 class="font-medium">
                    Product Variants
                </h2>

                <p class="mt-1 text-sm text-[#8B919A]">
                    SKU, pricing, and inventory information.
                </p>

            </div>


            {{-- Table --}}
            <div class="overflow-x-auto">

                <table class="w-full text-left">


                    {{-- Table Header --}}
                    <thead
                        class="border-b border-[#242830] text-xs uppercase tracking-wider text-[#8B919A]"
                    >

                        <tr>

                            <th class="px-6 py-4 font-medium">
                                Variant
                            </th>

                            <th class="px-6 py-4 font-medium">
                                SKU
                            </th>

                            <th class="px-6 py-4 font-medium">
                                Price
                            </th>

                            <th class="px-6 py-4 font-medium">
                                Cost Price
                            </th>

                            <th class="px-6 py-4 font-medium">
                                Status
                            </th>

                        </tr>

                    </thead>


                    {{-- Table Body --}}
                    <tbody class="divide-y divide-[#242830]">

                        @forelse ($product->variants as $variant)

                            <tr class="transition hover:bg-white/[0.02]">


                                {{-- Variant --}}
                                <td class="px-6 py-5 text-sm">
                                    {{ $variant->name }}
                                </td>


                                {{-- SKU --}}
                                <td class="px-6 py-5 font-mono text-sm text-[#8B919A]">
                                    {{ $variant->sku }}
                                </td>


                                {{-- Price --}}
                                <td class="px-6 py-5 text-sm">
                                    Rp {{ number_format($variant->price, 0, ',', '.') }}
                                </td>


                                {{-- Cost Price --}}
                                <td class="px-6 py-5 text-sm">

                                    @if ($variant->cost_price !== null)

                                        Rp {{ number_format($variant->cost_price, 0, ',', '.') }}

                                    @else

                                        —

                                    @endif

                                </td>


                                {{-- Variant Status --}}
                                <td class="px-6 py-5">

                                    @if ($variant->is_active)

                                        <span
                                            class="inline-flex rounded-full border border-[#3A4A40] bg-[#152019] px-3 py-1 text-xs text-[#9BC7A8]"
                                        >
                                            Active
                                        </span>

                                    @else

                                        <span
                                            class="inline-flex rounded-full border border-[#242830] px-3 py-1 text-xs text-[#8B919A]"
                                        >
                                            Inactive
                                        </span>

                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="5"
                                    class="px-6 py-12 text-center text-sm text-[#8B919A]"
                                >
                                    No variants available.
                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        {{-- Bottom Actions --}}
        <div class="mt-6 flex items-center justify-between">


            {{-- Delete Product --}}
            <form
                method="POST"
                action="{{ route('products.destroy', $product) }}"
                onsubmit="return confirm('Are you sure you want to delete this product?');"
            >

                @csrf
                @method('DELETE')

                <button
                    type="submit"
                    class="rounded-xl border border-red-500/20 px-5 py-3 text-sm font-medium text-red-400 transition hover:border-red-500/40 hover:bg-red-500/5"
                >
                    Delete Product
                </button>

            </form>


            {{-- Back to Products --}}
            <a
                href="{{ route('products.index') }}"
                class="rounded-xl border border-[#242830] px-5 py-3 text-sm font-medium text-[#8B919A] transition hover:border-[#3A3F48] hover:text-[#F5F5F2]"
            >
                Back to Products
            </a>

        </div>

    </div>

</x-app-layout>