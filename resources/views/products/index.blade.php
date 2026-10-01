<x-app-layout>

    <div class="relative min-h-screen overflow-hidden rounded-[48px] bg-[#080B10] px-8 py-8 text-[#F5F5F2]">

        {{-- ============================================================
            AMBIENT BACKGROUND
        ============================================================= --}}

        <div class="pointer-events-none absolute inset-0 overflow-hidden">

            <div class="absolute -left-24 top-0 h-72 w-72 rounded-full bg-[#8B7CFF]/[0.07] blur-3xl"></div>

            <div class="absolute right-0 top-20 h-96 w-96 rounded-full bg-[#4A7CFF]/[0.045] blur-3xl"></div>

            <div class="absolute bottom-0 left-1/3 h-72 w-72 rounded-full bg-[#8B7CFF]/[0.035] blur-3xl"></div>

        </div>


        <div class="relative z-10 space-y-8">


            {{-- ========================================================
                HEADER
            ========================================================= --}}

            <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">

                <div>

                    <div class="mb-3 flex items-center gap-2">

                        <span
                            class="h-1.5 w-1.5 rounded-full bg-[#8B7CFF] shadow-[0_0_12px_rgba(139,124,255,0.8)]"
                        ></span>

                        <p class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#777F8B]">
                            Catalog
                        </p>

                    </div>


                    <h1 class="text-3xl font-semibold tracking-[-0.03em] text-white">
                        Products
                    </h1>


                    <p class="mt-2 max-w-xl text-sm leading-6 text-[#818895]">
                        Manage your products, variants, pricing, and catalog structure from one workspace.
                    </p>

                </div>


                <div class="flex flex-nowrap items-center gap-3">

                    {{-- Sync Status --}}
                    <div
                        class="hidden items-center gap-2 rounded-xl border border-white/[0.06] bg-white/[0.025] px-3.5 py-2.5 text-xs text-[#737B87] sm:flex"
                    >

                        <span
                            class="h-1.5 w-1.5 rounded-full bg-emerald-400 shadow-[0_0_10px_rgba(52,211,153,0.7)]"
                        ></span>

                        Catalog synced

                    </div>


                    {{-- Manage Categories --}}
                    <a
                        href="{{ route('categories.index') }}"
                        class="group inline-flex items-center gap-2 rounded-xl border border-white/[0.07] bg-white/[0.025] px-4 py-2.5 text-sm font-medium text-[#AEB4BE] transition hover:border-[#5E8BFF]/30 hover:bg-[#5E8BFF]/[0.07] hover:text-white"
                    >

                        <span
                            class="flex h-5 w-5 items-center justify-center rounded-md border border-white/[0.08] bg-white/[0.03] text-[#8FAAFF] transition group-hover:border-[#5E8BFF]/20 group-hover:bg-[#5E8BFF]/10"
                        >

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-3.5 w-3.5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1.6"
                            >

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M4 6.5A2.5 2.5 0 0 1 6.5 4H10l2 2h5.5A2.5 2.5 0 0 1 20 8.5v9a2.5 2.5 0 0 1-2.5 2.5h-11A2.5 2.5 0 0 1 4 17.5v-11Z"
                                />

                            </svg>

                        </span>


                        Manage Categories


                        <span
                            class="text-xs text-[#626A75] transition group-hover:translate-x-0.5 group-hover:text-[#9EB8FF]"
                        >
                            →
                        </span>

                    </a>


                    {{-- Add Product --}}
                    <a
                        href="{{ route('products.create') }}"
                        class="group inline-flex items-center gap-2 rounded-xl border border-[#8B7CFF]/30 bg-[#8B7CFF]/10 px-5 py-3 text-sm font-medium text-white shadow-[0_12px_30px_rgba(139,124,255,0.10)] transition hover:border-[#8B7CFF]/55 hover:bg-[#8B7CFF]/15 hover:shadow-[0_16px_40px_rgba(139,124,255,0.16)]"
                    >

                        <span
                            class="flex h-5 w-5 items-center justify-center rounded-md bg-[#8B7CFF] text-sm leading-none text-white shadow-[0_0_16px_rgba(139,124,255,0.35)]"
                        >
                            +
                        </span>


                        Add Product


                        <span class="text-xs text-[#B6ADFF] transition group-hover:translate-x-0.5">
                            →
                        </span>

                    </a>

                </div>

            </div>


            {{-- ========================================================
                STATS
            ========================================================= --}}

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">


                {{-- Total Products --}}
                <div
                    class="group relative overflow-hidden rounded-2xl border border-white/[0.07] bg-white/[0.025] p-5 shadow-[0_18px_50px_rgba(0,0,0,0.16)] backdrop-blur-xl transition duration-300 hover:-translate-y-0.5 hover:border-white/[0.11] hover:bg-white/[0.035]"
                >

                    <div
                        class="pointer-events-none absolute -right-8 -top-8 h-24 w-24 rounded-full bg-[#8B7CFF]/10 blur-2xl transition group-hover:bg-[#8B7CFF]/16"
                    ></div>


                    <div class="relative flex items-start justify-between gap-4">

                        <div>

                            <p class="text-[10px] font-semibold uppercase tracking-[0.16em] text-[#6E7682]">
                                Total Products
                            </p>

                            <p class="mt-3 text-3xl font-semibold tracking-tight text-white">
                                {{ $products->count() }}
                            </p>

                            <p class="mt-2 text-xs text-[#777F8B]">
                                Catalog items
                            </p>

                        </div>


                        <div
                            class="flex h-11 w-11 items-center justify-center rounded-xl border border-[#8B7CFF]/20 bg-[#8B7CFF]/10 text-[#A99FFF] shadow-[inset_0_1px_0_rgba(255,255,255,0.04)]"
                        >

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1.6"
                            >

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M21 8.5V15a2 2 0 0 1-1 1.73l-7 4a2 2 0 0 1-2 0l-7-4A2 2 0 0 1 3 15V8.5a2 2 0 0 1 1-1.73l7-4a2 2 0 0 1 2 0l7 4A2 2 0 0 1 21 8.5Z"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="m3.27 6.96 8.73 5.05 8.73-5.05M12 22V12"
                                />

                            </svg>

                        </div>

                    </div>

                </div>


                {{-- Categories --}}
                <div
                    class="group relative overflow-hidden rounded-2xl border border-white/[0.07] bg-white/[0.025] p-5 shadow-[0_18px_50px_rgba(0,0,0,0.16)] backdrop-blur-xl transition duration-300 hover:-translate-y-0.5 hover:border-white/[0.11] hover:bg-white/[0.035]"
                >

                    <div
                        class="pointer-events-none absolute -right-8 -top-8 h-24 w-24 rounded-full bg-[#5E8BFF]/10 blur-2xl"
                    ></div>


                    <div class="relative flex items-start justify-between gap-4">

                        <div>

                            <p class="text-[10px] font-semibold uppercase tracking-[0.16em] text-[#6E7682]">
                                Categories
                            </p>

                            <p class="mt-3 text-3xl font-semibold tracking-tight text-white">
                                {{ $products->pluck('category_id')->filter()->unique()->count() }}
                            </p>

                            <p class="mt-2 text-xs text-[#777F8B]">
                                Product groupings
                            </p>

                        </div>


                        <div
                            class="flex h-11 w-11 items-center justify-center rounded-xl border border-[#5E8BFF]/20 bg-[#5E8BFF]/10 text-[#9EB8FF]"
                        >

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1.6"
                            >

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M4 6.5A2.5 2.5 0 0 1 6.5 4H10l2 2h5.5A2.5 2.5 0 0 1 20 8.5v9a2.5 2.5 0 0 1-2.5 2.5h-11A2.5 2.5 0 0 1 4 17.5v-11Z"
                                />

                            </svg>

                        </div>

                    </div>

                </div>


                {{-- Active Products --}}
                <div
                    class="group relative overflow-hidden rounded-2xl border border-white/[0.07] bg-white/[0.025] p-5 shadow-[0_18px_50px_rgba(0,0,0,0.16)] backdrop-blur-xl transition duration-300 hover:-translate-y-0.5 hover:border-white/[0.11] hover:bg-white/[0.035]"
                >

                    <div
                        class="pointer-events-none absolute -right-8 -top-8 h-24 w-24 rounded-full bg-emerald-400/10 blur-2xl"
                    ></div>


                    <div class="relative flex items-start justify-between gap-4">

                        <div>

                            <p class="text-[10px] font-semibold uppercase tracking-[0.16em] text-[#6E7682]">
                                Active Products
                            </p>

                            <p class="mt-3 text-3xl font-semibold tracking-tight text-white">
                                {{ $products->where('status', 'active')->count() }}
                            </p>

                            <p class="mt-2 text-xs text-[#777F8B]">
                                Currently available
                            </p>

                        </div>


                        <div
                            class="flex h-11 w-11 items-center justify-center rounded-xl border border-emerald-400/15 bg-emerald-400/[0.07] text-emerald-300"
                        >

                            <span
                                class="h-2.5 w-2.5 rounded-full bg-emerald-400 shadow-[0_0_14px_rgba(52,211,153,0.75)]"
                            ></span>

                        </div>

                    </div>

                </div>


                {{-- Variants --}}
                <div
                    class="group relative overflow-hidden rounded-2xl border border-white/[0.07] bg-white/[0.025] p-5 shadow-[0_18px_50px_rgba(0,0,0,0.16)] backdrop-blur-xl transition duration-300 hover:-translate-y-0.5 hover:border-white/[0.11] hover:bg-white/[0.035]"
                >

                    <div
                        class="pointer-events-none absolute -right-8 -top-8 h-24 w-24 rounded-full bg-[#55B8FF]/10 blur-2xl"
                    ></div>


                    <div class="relative flex items-start justify-between gap-4">

                        <div>

                            <p class="text-[10px] font-semibold uppercase tracking-[0.16em] text-[#6E7682]">
                                Variants
                            </p>

                            <p class="mt-3 text-3xl font-semibold tracking-tight text-white">
                                {{ $products->sum(fn ($product) => $product->variants->count()) }}
                            </p>

                            <p class="mt-2 text-xs text-[#777F8B]">
                                Product options
                            </p>

                        </div>


                        <div
                            class="flex h-11 w-11 items-center justify-center rounded-xl border border-[#55B8FF]/20 bg-[#55B8FF]/10 text-[#91D2FF]"
                        >

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1.6"
                            >

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M8 7h8M7 12h10M8 17h8"
                                />

                                <rect
                                    x="4"
                                    y="4"
                                    width="16"
                                    height="16"
                                    rx="3"
                                />

                            </svg>

                        </div>

                    </div>

                </div>

            </div>


            {{-- ========================================================
                CATALOG SURFACE
            ========================================================= --}}

            <section
                class="relative overflow-hidden rounded-[24px] border border-white/[0.07] bg-white/[0.02] shadow-[0_24px_70px_rgba(0,0,0,0.22)] backdrop-blur-xl"
            >

                <div
                    class="pointer-events-none absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(139,124,255,0.06),transparent_32%),radial-gradient(circle_at_bottom_left,rgba(74,124,255,0.035),transparent_30%)]"
                ></div>


                {{-- Surface Header --}}
                <div
                    class="relative flex flex-col gap-5 border-b border-white/[0.06] px-6 py-6 lg:flex-row lg:items-center lg:justify-between"
                >

                    <div>

                        <div class="flex items-center gap-2">

                            <span
                                class="h-2 w-2 rounded-full bg-[#8B7CFF] shadow-[0_0_12px_rgba(139,124,255,0.7)]"
                            ></span>

                            <p class="text-[10px] font-semibold uppercase tracking-[0.19em] text-[#6E7682]">
                                Catalog overview
                            </p>

                        </div>


                        <h2 class="mt-2 text-base font-semibold text-white">
                            Product Catalog
                        </h2>


                        <p class="mt-1 text-sm text-[#747C88]">
                            All products currently available in your business catalog.
                        </p>

                    </div>


                    <div class="flex items-center gap-3">

                        <div
                            class="rounded-xl border border-white/[0.06] bg-black/20 px-3.5 py-2.5 text-xs text-[#7B838E]"
                        >
                            {{ $products->count() }} items
                        </div>


                        <a
                            href="{{ route('products.create') }}"
                            class="inline-flex items-center gap-2 rounded-xl border border-white/[0.07] bg-white/[0.04] px-3.5 py-2.5 text-xs font-medium text-[#D6D8DD] transition hover:border-[#8B7CFF]/30 hover:bg-[#8B7CFF]/[0.08] hover:text-white"
                        >
                            + New Product
                        </a>

                    </div>

                </div>


                {{-- ====================================================
                    PRODUCT TABLE

                    The outer horizontal padding creates a small visual
                    gap between every product row and the outer surface.
                    Column widths remain locked for alignment.
                ===================================================== --}}

                <div class="relative overflow-x-auto px-3 pb-3">

                    <table
                        class="w-full min-w-[1040px] border-separate border-spacing-x-0 border-spacing-y-3 table-fixed text-left"
                    >

                        <colgroup>

                            <col class="w-[34%]">

                            <col class="w-[14%]">

                            <col class="w-[14%]">

                            <col class="w-[15%]">

                            <col class="w-[13%]">

                            <col class="w-[10%]">

                        </colgroup>


                        {{-- =================================================
                            HEADER
                        ================================================== --}}

                        <thead>

                            <tr>

                                <th
                                    class="px-6 pb-1 text-[10px] font-semibold uppercase tracking-[0.16em] text-[#6E7682]"
                                >
                                    Product
                                </th>


                                <th
                                    class="px-6 pb-1 text-[10px] font-semibold uppercase tracking-[0.16em] text-[#6E7682]"
                                >
                                    Category
                                </th>


                                <th
                                    class="px-6 pb-1 text-[10px] font-semibold uppercase tracking-[0.16em] text-[#6E7682]"
                                >
                                    SKU
                                </th>


                                <th
                                    class="px-6 pb-1 text-[10px] font-semibold uppercase tracking-[0.16em] text-[#6E7682]"
                                >
                                    Price
                                </th>


                                <th
                                    class="px-6 pb-1 text-[10px] font-semibold uppercase tracking-[0.16em] text-[#6E7682]"
                                >
                                    Status
                                </th>


                                <th
                                    class="px-6 pb-1 text-right text-[10px] font-semibold uppercase tracking-[0.16em] text-[#6E7682]"
                                >
                                    Action
                                </th>

                            </tr>

                        </thead>


                        {{-- =================================================
                            BODY
                        ================================================== --}}

                        <tbody>

                            @forelse ($products as $product)

                                @php

                                    $variant = $product->variants->first();

                                @endphp


                                <tr class="group">


                                    {{-- =================================================
                                        PRODUCT
                                    ================================================== --}}

                                    <td
                                        class="rounded-l-2xl border-y border-l border-white/[0.045] bg-[#141920] px-6 py-5 transition duration-200 group-hover:border-[#8B7CFF]/15 group-hover:bg-[#181E27]"
                                    >

                                        <div class="flex min-w-0 items-center gap-4">


                                            @if ($product->image)

                                                <div class="relative shrink-0">

                                                    <div
                                                        class="absolute -inset-1 rounded-2xl bg-[#8B7CFF]/0 blur-md transition group-hover:bg-[#8B7CFF]/10"
                                                    ></div>


                                                    <img
                                                        src="{{ asset('storage/' . $product->image) }}"
                                                        alt="{{ $product->name }}"
                                                        class="relative h-14 w-14 rounded-2xl border border-white/[0.08] object-cover shadow-[0_8px_25px_rgba(0,0,0,0.22)]"
                                                    >

                                                </div>

                                            @else

                                                <div
                                                    class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl border border-white/[0.07] bg-black/20 text-[10px] font-medium uppercase tracking-[0.12em] text-[#606873]"
                                                >
                                                    N/A
                                                </div>

                                            @endif


                                            <div class="min-w-0 max-w-full">

                                                <p
                                                    class="truncate text-sm font-semibold text-white"
                                                >
                                                    {{ $product->name }}
                                                </p>


                                                @if ($product->brand)

                                                    <p
                                                        class="mt-1 truncate text-xs text-[#717985]"
                                                    >
                                                        {{ $product->brand }}
                                                    </p>

                                                @else

                                                    <p
                                                        class="mt-1 truncate text-xs text-[#545B65]"
                                                    >
                                                        No brand specified
                                                    </p>

                                                @endif

                                            </div>

                                        </div>

                                    </td>


                                    {{-- =================================================
                                        CATEGORY
                                    ================================================== --}}

                                    <td
                                        class="border-y border-white/[0.045] bg-[#141920] px-6 py-5 transition duration-200 group-hover:border-[#8B7CFF]/15 group-hover:bg-[#181E27]"
                                    >

                                        <span
                                            class="inline-flex max-w-full items-center truncate rounded-xl border border-white/[0.06] bg-white/[0.025] px-2.5 py-1.5 text-xs text-[#949BA6]"
                                        >
                                            {{ $product->category->name ?? 'Uncategorized' }}
                                        </span>

                                    </td>


                                    {{-- =================================================
                                        SKU
                                    ================================================== --}}

                                    <td
                                        class="border-y border-white/[0.045] bg-[#141920] px-6 py-5 transition duration-200 group-hover:border-[#8B7CFF]/15 group-hover:bg-[#181E27]"
                                    >

                                        <span class="block truncate font-mono text-xs text-[#7B838E]">
                                            {{ $variant->sku ?? '—' }}
                                        </span>

                                    </td>


                                    {{-- =================================================
                                        PRICE
                                    ================================================== --}}

                                    <td
                                        class="border-y border-white/[0.045] bg-[#141920] px-6 py-5 transition duration-200 group-hover:border-[#8B7CFF]/15 group-hover:bg-[#181E27]"
                                    >

                                        @if ($variant)

                                            <div>

                                                <p class="whitespace-nowrap text-sm font-semibold text-[#F0F0EC]">
                                                    Rp {{ number_format($variant->price, 0, ',', '.') }}
                                                </p>


                                                <p class="mt-1 text-[10px] uppercase tracking-[0.12em] text-[#565E69]">
                                                    Current price
                                                </p>

                                            </div>

                                        @else

                                            <span class="text-sm text-[#555D68]">
                                                —
                                            </span>

                                        @endif

                                    </td>


                                    {{-- =================================================
                                        STATUS
                                    ================================================== --}}

                                    <td
                                        class="border-y border-white/[0.045] bg-[#141920] px-6 py-5 transition duration-200 group-hover:border-[#8B7CFF]/15 group-hover:bg-[#181E27]"
                                    >

                                        @if ($product->status === 'active')

                                            <span
                                                class="inline-flex items-center gap-2 whitespace-nowrap rounded-full border border-emerald-400/15 bg-emerald-400/[0.07] px-3 py-1.5 text-xs font-medium text-emerald-300"
                                            >

                                                <span
                                                    class="h-1.5 w-1.5 shrink-0 rounded-full bg-emerald-400 shadow-[0_0_8px_rgba(52,211,153,0.8)]"
                                                ></span>

                                                Active

                                            </span>

                                        @else

                                            <span
                                                class="inline-flex items-center gap-2 whitespace-nowrap rounded-full border border-white/[0.06] bg-white/[0.025] px-3 py-1.5 text-xs font-medium text-[#7D858F]"
                                            >

                                                <span
                                                    class="h-1.5 w-1.5 shrink-0 rounded-full bg-[#69717C]"
                                                ></span>

                                                {{ ucfirst($product->status ?? 'Inactive') }}

                                            </span>

                                        @endif

                                    </td>


                                    {{-- =================================================
                                        ACTION
                                    ================================================== --}}

                                    <td
                                        class="rounded-r-2xl border-y border-r border-white/[0.045] bg-[#141920] px-6 py-5 text-right transition duration-200 group-hover:border-[#8B7CFF]/15 group-hover:bg-[#181E27]"
                                    >

                                        <a
                                            href="{{ route('products.show', $product) }}"
                                            class="group/view inline-flex items-center gap-2 rounded-xl border border-white/[0.06] bg-white/[0.02] px-3.5 py-2 text-xs font-medium text-[#8E96A1] transition hover:border-[#8B7CFF]/30 hover:bg-[#8B7CFF]/[0.07] hover:text-white"
                                        >

                                            View

                                            <span
                                                class="text-[#626A75] transition group-hover/view:translate-x-0.5 group-hover/view:text-[#A99FFF]"
                                            >
                                                →
                                            </span>

                                        </a>

                                    </td>

                                </tr>


                            @empty

                                {{-- =================================================
                                    EMPTY STATE
                                ================================================== --}}

                                <tr>

                                    <td
                                        colspan="6"
                                        class="px-6 py-20 text-center"
                                    >

                                        <div
                                            class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl border border-white/[0.07] bg-white/[0.02] text-[#656D78]"
                                        >

                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-6 w-6"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor"
                                                stroke-width="1.5"
                                            >

                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M21 8.5V15a2 2 0 0 1-1 1.73l-7 4a2 2 0 0 1-2 0l-7-4A2 2 0 0 1 3 15V8.5a2 2 0 0 1 1-1.73l7-4a2 2 0 0 1 2 0l7 4A2 2 0 0 1 21 8.5Z"
                                                />

                                            </svg>

                                        </div>


                                        <p class="mt-5 text-sm font-medium text-[#E8E9E6]">
                                            No products yet
                                        </p>


                                        <p class="mt-2 text-sm text-[#69717C]">
                                            Add your first product to start building the catalog.
                                        </p>


                                        <a
                                            href="{{ route('products.create') }}"
                                            class="mt-5 inline-flex items-center gap-2 rounded-xl border border-[#8B7CFF]/25 bg-[#8B7CFF]/[0.08] px-4 py-2.5 text-xs font-medium text-[#B7B0FF] transition hover:border-[#8B7CFF]/40 hover:bg-[#8B7CFF]/[0.13] hover:text-white"
                                        >
                                            + Add first product
                                        </a>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </section>

        </div>

    </div>

</x-app-layout>