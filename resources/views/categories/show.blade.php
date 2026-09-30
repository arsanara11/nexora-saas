<x-app-layout>

    <div class="space-y-8">

        {{-- HEADER --}}
        <div class="flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between">

            <div>

                <p class="text-[10px] font-semibold uppercase tracking-[0.2em] text-[#727985]">
                    Product Management
                </p>

                <h1 class="mt-2 text-3xl font-semibold tracking-tight text-[#F5F5F2]">
                    Category Detail
                </h1>

                <p class="mt-2 max-w-2xl text-sm leading-6 text-[#8B919A]">
                    Detailed information and products assigned to this category.
                </p>

            </div>

            <div class="flex flex-wrap items-center gap-3">

                <a
                    href="{{ route('categories.edit', $category) }}"
                    class="inline-flex items-center justify-center gap-2 rounded-lg border border-[#242830] px-4 py-2.5 text-sm font-medium text-[#B9BEC6] transition hover:border-[#3A404A] hover:bg-[#151A21] hover:text-white"
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
                            d="M15.232 5.232l3.536 3.536M4 20h4l10.5-10.5a2.5 2.5 0 00-3.536-3.536L4.464 16.464A2 2 0 004 17.879V20z"
                        />
                    </svg>

                    Edit Category
                </a>

                <a
                    href="{{ route('categories.index') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-lg border border-[#242830] px-4 py-2.5 text-sm font-medium text-[#B9BEC6] transition hover:border-[#3A404A] hover:bg-[#151A21] hover:text-white"
                >
                    <span class="text-base">←</span>
                    Back to categories
                </a>

            </div>

        </div>


        {{-- CATEGORY HERO --}}
        <div class="overflow-hidden rounded-2xl border border-[#242830] bg-[#12151A]">

            <div class="flex flex-col gap-6 p-6 lg:flex-row lg:items-center lg:justify-between lg:p-7">

                <div class="flex items-start gap-5">

                    {{-- CATEGORY ICON --}}
                    <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-2xl border border-[#8B7CFF]/20 bg-[#8B7CFF]/10 text-[#8B7CFF]">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-8 w-8"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.6"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M4 6.5A2.5 2.5 0 016.5 4H10l2 2h5.5A2.5 2.5 0 0120 8.5v9A2.5 2.5 0 0117.5 20h-11A2.5 2.5 0 014 17.5v-11z"
                            />
                        </svg>

                    </div>


                    {{-- CATEGORY INFO --}}
                    <div class="min-w-0">

                        <p class="text-[10px] font-semibold uppercase tracking-[0.18em] text-[#727985]">
                            CATEGORY
                        </p>

                        <div class="mt-2 flex flex-wrap items-center gap-3">

                            <h2 class="text-2xl font-semibold tracking-tight text-[#F5F5F2]">
                                {{ $category->name }}
                            </h2>

                            @if ($category->is_active)

                                <span class="inline-flex items-center gap-2 rounded-lg border border-emerald-400/15 bg-emerald-400/10 px-2.5 py-1 text-xs font-medium text-emerald-300">
                                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>
                                    Active
                                </span>

                            @else

                                <span class="inline-flex items-center gap-2 rounded-lg border border-red-400/15 bg-red-400/10 px-2.5 py-1 text-xs font-medium text-red-300">
                                    <span class="h-1.5 w-1.5 rounded-full bg-red-400"></span>
                                    Inactive
                                </span>

                            @endif

                        </div>

                        <p class="mt-2 font-mono text-xs text-[#666C75]">
                            {{ $category->slug }}
                        </p>

                    </div>

                </div>


                {{-- PRODUCT COUNT --}}
                <div class="rounded-xl border border-[#242830] bg-[#0B0D10] px-5 py-4 lg:min-w-[180px]">

                    <p class="text-[10px] font-semibold uppercase tracking-[0.16em] text-[#666C75]">
                        PRODUCTS
                    </p>

                    <p class="mt-2 text-2xl font-semibold text-[#F5F5F2]">
                        {{ $productSummary['total'] }}
                    </p>

                    <p class="mt-1 text-xs text-[#747B87]">
                        Products in this category
                    </p>

                </div>

            </div>

        </div>


        {{-- SUMMARY CARDS --}}
        <div class="grid grid-cols-1 gap-4 md:grid-cols-3">

            {{-- Total --}}
            <div class="rounded-2xl border border-[#242830] bg-[#12151A] p-5">

                <div class="flex items-center justify-between">

                    <span class="text-sm text-[#8B919A]">
                        Total Products
                    </span>

                    <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-[#8B7CFF]/10 text-[#8B7CFF]">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.7"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z"
                            />
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M3.27 6.96L12 12l8.73-5.04M12 22.08V12"
                            />
                        </svg>

                    </div>

                </div>

                <p class="mt-4 text-3xl font-semibold text-[#F5F5F2]">
                    {{ $productSummary['total'] }}
                </p>

            </div>


            {{-- Active --}}
            <div class="rounded-2xl border border-[#242830] bg-[#12151A] p-5">

                <div class="flex items-center justify-between">

                    <span class="text-sm text-[#8B919A]">
                        Active Products
                    </span>

                    <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-emerald-400/10 text-emerald-300">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.7"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M5 13l4 4L19 7"
                            />
                        </svg>

                    </div>

                </div>

                <p class="mt-4 text-3xl font-semibold text-[#F5F5F2]">
                    {{ $productSummary['active'] }}
                </p>

            </div>


            {{-- Inactive --}}
            <div class="rounded-2xl border border-[#242830] bg-[#12151A] p-5">

                <div class="flex items-center justify-between">

                    <span class="text-sm text-[#8B919A]">
                        Inactive Products
                    </span>

                    <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-[#0B0D10] text-[#666C75]">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.7"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M6 6l12 12M18 6L6 18"
                            />
                        </svg>

                    </div>

                </div>

                <p class="mt-4 text-3xl font-semibold text-[#F5F5F2]">
                    {{ $productSummary['inactive'] }}
                </p>

            </div>

        </div>


        {{-- CATEGORY INFORMATION --}}
        <div class="overflow-hidden rounded-2xl border border-[#242830] bg-[#12151A]">

            <div class="border-b border-[#242830] px-6 py-5">

                <div class="flex items-start gap-4">

                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-[#8B7CFF]/10 text-[#8B7CFF]">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.7"
                        >
                            <circle
                                cx="12"
                                cy="12"
                                r="9"
                            />
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 10v6"
                            />
                            <path
                                stroke-linecap="round"
                                stroke-linecap="round"
                                d="M12 7.5h.01"
                            />
                        </svg>

                    </div>

                    <div>

                        <h2 class="text-base font-semibold text-[#F5F5F2]">
                            Category Information
                        </h2>

                        <p class="mt-1 text-sm text-[#747B87]">
                            Basic information for this category.
                        </p>

                    </div>

                </div>

            </div>


            <div class="grid grid-cols-1 lg:grid-cols-2">

                {{-- Name --}}
                <div class="border-b border-[#242830] px-6 py-5 lg:border-r">

                    <p class="text-[10px] font-semibold uppercase tracking-[0.15em] text-[#666C75]">
                        Category Name
                    </p>

                    <p class="mt-2 text-sm font-medium text-[#F5F5F2]">
                        {{ $category->name }}
                    </p>

                </div>


                {{-- Slug --}}
                <div class="border-b border-[#242830] px-6 py-5">

                    <p class="text-[10px] font-semibold uppercase tracking-[0.15em] text-[#666C75]">
                        Slug
                    </p>

                    <p class="mt-2 font-mono text-sm text-[#C8CBD1]">
                        {{ $category->slug }}
                    </p>

                </div>


                {{-- Status --}}
                <div class="border-b border-[#242830] px-6 py-5 lg:border-r">

                    <p class="text-[10px] font-semibold uppercase tracking-[0.15em] text-[#666C75]">
                        Status
                    </p>

                    <div class="mt-2">

                        @if ($category->is_active)

                            <span class="inline-flex items-center gap-2 rounded-lg border border-emerald-400/15 bg-emerald-400/10 px-2.5 py-1 text-xs font-medium text-emerald-300">
                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>
                                Active
                            </span>

                        @else

                            <span class="inline-flex items-center gap-2 rounded-lg border border-red-400/15 bg-red-400/10 px-2.5 py-1 text-xs font-medium text-red-300">
                                <span class="h-1.5 w-1.5 rounded-full bg-red-400"></span>
                                Inactive
                            </span>

                        @endif

                    </div>

                </div>


                {{-- Description --}}
                <div class="px-6 py-5">

                    <p class="text-[10px] font-semibold uppercase tracking-[0.15em] text-[#666C75]">
                        Description
                    </p>

                    <p class="mt-2 text-sm leading-6 text-[#B5BAC3]">
                        {{ $category->description ?: 'No description provided.' }}
                    </p>

                </div>

            </div>

        </div>


        {{-- PRODUCTS --}}
        <div class="overflow-hidden rounded-2xl border border-[#242830] bg-[#12151A]">

            <div class="flex flex-col gap-4 border-b border-[#242830] px-6 py-5 sm:flex-row sm:items-center sm:justify-between">

                <div>

                    <h2 class="text-base font-semibold text-[#F5F5F2]">
                        Products in this Category
                    </h2>

                    <p class="mt-1 text-sm text-[#747B87]">
                        Products currently assigned to {{ $category->name }}.
                    </p>

                </div>

                <a
                    href="{{ route('products.create') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-lg bg-[#F5F5F2] px-4 py-2.5 text-sm font-semibold text-[#080B10] transition hover:bg-white"
                >
                    <span class="text-base">+</span>
                    Add Product
                </a>

            </div>


            @if ($products->count() > 0)

                <div class="overflow-x-auto">

                    <table class="w-full min-w-[760px]">

                        <thead>

                            <tr class="border-b border-[#242830] bg-[#0E1116]">

                                <th class="px-6 py-4 text-left text-xs font-medium uppercase tracking-[0.12em] text-[#666C75]">
                                    Product
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-medium uppercase tracking-[0.12em] text-[#666C75]">
                                    Brand
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-medium uppercase tracking-[0.12em] text-[#666C75]">
                                    Description
                                </th>

                                <th class="px-6 py-4 text-right text-xs font-medium uppercase tracking-[0.12em] text-[#666C75]">
                                    Action
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y divide-[#242830]">

                            @foreach ($products as $product)

                                <tr class="transition hover:bg-[#0E1116]">

                                    {{-- Product --}}
                                    <td class="px-6 py-4">

                                        <div>

                                            <p class="text-sm font-medium text-[#F5F5F2]">
                                                {{ $product->name }}
                                            </p>

                                            <p class="mt-1 text-xs text-[#666C75]">
                                                Product #{{ $product->id }}
                                            </p>

                                        </div>

                                    </td>


                                    {{-- Brand --}}
                                    <td class="px-6 py-4">

                                        <span class="text-sm text-[#B5BAC3]">
                                            {{ $product->brand ?: '—' }}
                                        </span>

                                    </td>


                                    {{-- Description --}}
                                    <td class="max-w-md px-6 py-4">

                                        <p class="truncate text-sm text-[#8B919A]">
                                            {{ $product->description ?: 'No description.' }}
                                        </p>

                                    </td>


                                    {{-- Action --}}
                                    <td class="px-6 py-4 text-right">

                                        <a
                                            href="{{ route('products.show', $product) }}"
                                            class="inline-flex items-center gap-2 rounded-lg border border-[#242830] px-3 py-2 text-xs font-medium text-[#AEB3BB] transition hover:border-[#8B7CFF]/40 hover:text-[#F5F5F2]"
                                        >
                                            View
                                        </a>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>


                {{-- Pagination --}}
                <div class="border-t border-[#242830] px-6 py-5">

                    {{ $products->links() }}

                </div>

            @else

                <div class="px-6 py-16 text-center">

                    <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl border border-[#242830] bg-[#0B0D10] text-[#666C75]">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-7 w-7"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.5"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z"
                            />
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M3.27 6.96L12 12l8.73-5.04M12 22.08V12"
                            />

                        </svg>

                    </div>

                    <h3 class="mt-5 text-sm font-semibold text-[#F5F5F2]">
                        No products yet
                    </h3>

                    <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-[#747B87]">
                        There are currently no products assigned to this category.
                    </p>

                </div>

            @endif

        </div>

    </div>

</x-app-layout>