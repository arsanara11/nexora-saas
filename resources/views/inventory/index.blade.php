<x-app-layout>

    <div class="relative min-h-screen overflow-hidden rounded-[48px] bg-[#080B10] px-8 py-8 text-[#F5F5F2]">

        {{-- Ambient background --}}
        <div class="pointer-events-none absolute inset-0 overflow-hidden">

            <div class="absolute -left-24 top-0 h-72 w-72 rounded-full bg-[#8B7CFF]/[0.07] blur-3xl"></div>

            <div class="absolute right-0 top-24 h-96 w-96 rounded-full bg-[#4A7CFF]/[0.045] blur-3xl"></div>

            <div class="absolute bottom-[-120px] left-1/3 h-80 w-80 rounded-full bg-[#56C2FF]/[0.03] blur-3xl"></div>

        </div>


        @php

            $totalStock = $inventories->sum('quantity');

            $totalReserved = $inventories->sum('reserved_quantity');

            $totalAvailable = $inventories->sum('available_quantity');

            $lowStockCount = $inventories->filter(function ($inventory) {
                return $inventory->isLowStock();
            })->count();

        @endphp


        <div class="relative z-10 space-y-8">


            {{-- ========================================================
                HEADER
            ========================================================= --}}

            <div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">

                <div>

                    <div class="mb-3 flex items-center gap-2">

                        <span
                            class="h-1.5 w-1.5 rounded-full bg-[#8B7CFF] shadow-[0_0_12px_rgba(139,124,255,0.8)]"
                        ></span>

                        <p class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#777F8B]">
                            Operations / Inventory
                        </p>

                    </div>


                    <h1 class="text-3xl font-semibold tracking-[-0.03em] text-white">
                        Inventory
                    </h1>


                    <p class="mt-2 max-w-xl text-sm leading-6 text-[#818895]">
                        Monitor stock levels, availability, and movement history across your business operations.
                    </p>

                </div>


                <div class="flex flex-wrap items-center gap-3">

                    <div class="hidden items-center gap-2 rounded-xl border border-white/[0.06] bg-white/[0.025] px-3.5 py-2.5 text-xs text-[#737B87] sm:flex">

                        <span
                            class="h-1.5 w-1.5 rounded-full bg-emerald-400 shadow-[0_0_10px_rgba(52,211,153,0.7)]"
                        ></span>

                        Inventory synced

                    </div>


                    <a
                        href="{{ route('inventory.create') }}"
                        class="group inline-flex items-center gap-2 rounded-xl border border-[#8B7CFF]/30 bg-[#8B7CFF]/10 px-5 py-3 text-sm font-medium text-white shadow-[0_12px_30px_rgba(139,124,255,0.10)] transition hover:border-[#8B7CFF]/55 hover:bg-[#8B7CFF]/15 hover:shadow-[0_16px_40px_rgba(139,124,255,0.16)]"
                    >

                        <span class="flex h-5 w-5 items-center justify-center rounded-md bg-[#8B7CFF] text-sm leading-none text-white shadow-[0_0_16px_rgba(139,124,255,0.35)]">
                            +
                        </span>

                        Add Inventory

                        <span class="text-xs text-[#B6ADFF] transition group-hover:translate-x-0.5">
                            →
                        </span>

                    </a>

                </div>

            </div>


            {{-- ========================================================
                SUCCESS MESSAGE
            ========================================================= --}}

            @if (session('success'))

                <div class="relative overflow-hidden rounded-2xl border border-emerald-400/[0.12] bg-emerald-400/[0.05] px-5 py-4 shadow-[0_18px_45px_rgba(0,0,0,0.16)] backdrop-blur-xl">

                    <div class="pointer-events-none absolute -right-10 -top-10 h-28 w-28 rounded-full bg-emerald-400/[0.07] blur-2xl"></div>


                    <div class="relative flex items-start gap-3">

                        <div class="mt-0.5 flex h-8 w-8 shrink-0 items-center justify-center rounded-xl border border-emerald-400/[0.14] bg-emerald-400/[0.08] text-emerald-300">
                            ✓
                        </div>


                        <div>

                            <p class="text-[10px] font-semibold uppercase tracking-[0.16em] text-emerald-300/75">
                                Update complete
                            </p>

                            <p class="mt-1 text-sm text-[#B9DCC2]">
                                {{ session('success') }}
                            </p>

                        </div>

                    </div>

                </div>

            @endif


            {{-- ========================================================
                SUMMARY CARDS
            ========================================================= --}}

            <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">


                {{-- Total Stock --}}
                <div class="group relative overflow-hidden rounded-[26px] border border-white/[0.055] bg-[#12151A]/90 p-5 shadow-[0_18px_55px_rgba(0,0,0,0.16)] backdrop-blur-sm transition duration-300 hover:-translate-y-0.5 hover:border-[#8B7CFF]/20">

                    <div class="absolute right-[-30px] top-[-35px] h-28 w-28 rounded-full bg-[#8B7CFF]/[0.08] blur-2xl transition duration-300 group-hover:bg-[#8B7CFF]/[0.12]"></div>


                    <div class="relative flex items-start justify-between gap-4">

                        <div>

                            <p class="text-[10px] font-semibold uppercase tracking-[0.18em] text-[#707782]">
                                Total Stock
                            </p>

                            <p class="mt-3 text-3xl font-semibold tracking-tight text-white">
                                {{ number_format($totalStock) }}
                            </p>

                            <p class="mt-2 text-xs text-[#666D78]">
                                Total physical inventory units.
                            </p>

                        </div>


                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl border border-[#8B7CFF]/15 bg-[#8B7CFF]/[0.07] text-[#A99FFF]">

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M4 7h16M4 7l2-3h12l2 3M6 7v13h12V7"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M9 11h6M9 15h6"
                                />
                            </svg>

                        </div>

                    </div>

                </div>


                {{-- Available --}}
                <div class="group relative overflow-hidden rounded-[26px] border border-white/[0.055] bg-[#12151A]/90 p-5 shadow-[0_18px_55px_rgba(0,0,0,0.16)] backdrop-blur-sm transition duration-300 hover:-translate-y-0.5 hover:border-emerald-400/20">

                    <div class="absolute right-[-30px] top-[-35px] h-28 w-28 rounded-full bg-emerald-400/[0.06] blur-2xl transition duration-300 group-hover:bg-emerald-400/[0.10]"></div>


                    <div class="relative flex items-start justify-between gap-4">

                        <div>

                            <p class="text-[10px] font-semibold uppercase tracking-[0.18em] text-[#707782]">
                                Available
                            </p>

                            <p class="mt-3 text-3xl font-semibold tracking-tight text-white">
                                {{ number_format($totalAvailable) }}
                            </p>

                            <p class="mt-2 text-xs text-[#666D78]">
                                Units currently available.
                            </p>

                        </div>


                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl border border-emerald-400/15 bg-emerald-400/[0.06] text-emerald-300">

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M5 13l4 4L19 7"
                                />
                            </svg>

                        </div>

                    </div>

                </div>


                {{-- Reserved --}}
                <div class="group relative overflow-hidden rounded-[26px] border border-white/[0.055] bg-[#12151A]/90 p-5 shadow-[0_18px_55px_rgba(0,0,0,0.16)] backdrop-blur-sm transition duration-300 hover:-translate-y-0.5 hover:border-[#6F8CFF]/20">

                    <div class="absolute right-[-30px] top-[-35px] h-28 w-28 rounded-full bg-[#6F8CFF]/[0.06] blur-2xl transition duration-300 group-hover:bg-[#6F8CFF]/[0.10]"></div>


                    <div class="relative flex items-start justify-between gap-4">

                        <div>

                            <p class="text-[10px] font-semibold uppercase tracking-[0.18em] text-[#707782]">
                                Reserved
                            </p>

                            <p class="mt-3 text-3xl font-semibold tracking-tight text-white">
                                {{ number_format($totalReserved) }}
                            </p>

                            <p class="mt-2 text-xs text-[#666D78]">
                                Units reserved for orders.
                            </p>

                        </div>


                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl border border-[#6F8CFF]/15 bg-[#6F8CFF]/[0.06] text-[#9EB6E8]">

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >
                                <rect
                                    x="4"
                                    y="4"
                                    width="16"
                                    height="16"
                                    rx="3"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M8 12h8"
                                />
                            </svg>

                        </div>

                    </div>

                </div>


                {{-- Low Stock --}}
                <div class="group relative overflow-hidden rounded-[26px] border border-white/[0.055] bg-[#12151A]/90 p-5 shadow-[0_18px_55px_rgba(0,0,0,0.16)] backdrop-blur-sm transition duration-300 hover:-translate-y-0.5 hover:border-amber-400/20">

                    <div class="absolute right-[-30px] top-[-35px] h-28 w-28 rounded-full bg-amber-400/[0.04] blur-2xl transition duration-300 group-hover:bg-amber-400/[0.07]"></div>


                    <div class="relative flex items-start justify-between gap-4">

                        <div>

                            <p class="text-[10px] font-semibold uppercase tracking-[0.18em] text-[#707782]">
                                Low Stock
                            </p>

                            <p class="mt-3 text-3xl font-semibold tracking-tight text-white">
                                {{ number_format($lowStockCount) }}
                            </p>

                            <p class="mt-2 text-xs text-[#666D78]">
                                Items requiring attention.
                            </p>

                        </div>


                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl border border-amber-400/15 bg-amber-400/[0.06] text-amber-300">

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 3l9 17H3L12 3z"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 9v4"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 16h.01"
                                />
                            </svg>

                        </div>

                    </div>

                </div>

            </div>


            {{-- ========================================================
                STOCK OVERVIEW
            ========================================================= --}}

            <section
                class="relative overflow-hidden rounded-[24px] border border-white/[0.07] bg-white/[0.02] shadow-[0_24px_70px_rgba(0,0,0,0.22)] backdrop-blur-xl"
            >

                <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(139,124,255,0.06),transparent_32%),radial-gradient(circle_at_bottom_left,rgba(74,124,255,0.035),transparent_30%)]"></div>


                {{-- Section Header --}}
                <div class="relative flex flex-col gap-5 border-b border-white/[0.06] px-6 py-6 lg:flex-row lg:items-center lg:justify-between">

                    <div>

                        <div class="flex items-center gap-2">

                            <span
                                class="h-2 w-2 rounded-full bg-[#8B7CFF] shadow-[0_0_12px_rgba(139,124,255,0.7)]"
                            ></span>

                            <p class="text-[10px] font-semibold uppercase tracking-[0.19em] text-[#6E7682]">
                                Inventory overview
                            </p>

                        </div>


                        <h2 class="mt-2 text-base font-semibold text-white">
                            Stock Overview
                        </h2>


                        <p class="mt-1 text-sm text-[#747C88]">
                            Current inventory across all warehouses.
                        </p>

                    </div>


                    <div class="flex items-center gap-3">

                        <div class="rounded-xl border border-white/[0.06] bg-black/20 px-3.5 py-2.5 text-xs text-[#7B838E]">
                            {{ $inventories->count() }} Records
                        </div>


                        <a
                            href="{{ route('inventory.create') }}"
                            class="inline-flex items-center gap-2 rounded-xl border border-white/[0.07] bg-white/[0.04] px-3.5 py-2.5 text-xs font-medium text-[#D6D8DD] transition hover:border-[#8B7CFF]/30 hover:bg-[#8B7CFF]/[0.08] hover:text-white"
                        >
                            + New Record
                        </a>

                    </div>

                </div>


                {{-- ====================================================
                    Inventory Table

                    IMPORTANT:
                    border-separate + border-spacing-y-3 creates the
                    Dashboard-style gap between each record.
                ===================================================== --}}

                <div class="relative overflow-x-auto px-4 py-2 sm:px-5">

                    <table class="w-full min-w-[1150px] border-separate border-spacing-x-0 border-spacing-y-3 text-left">

                        <thead>

                            <tr>

                                <th class="px-6 py-2 text-[10px] font-semibold uppercase tracking-[0.16em] text-[#6E7682]">
                                    Product
                                </th>

                                <th class="px-6 py-2 text-[10px] font-semibold uppercase tracking-[0.16em] text-[#6E7682]">
                                    Variant
                                </th>

                                <th class="px-6 py-2 text-[10px] font-semibold uppercase tracking-[0.16em] text-[#6E7682]">
                                    SKU
                                </th>

                                <th class="px-6 py-2 text-[10px] font-semibold uppercase tracking-[0.16em] text-[#6E7682]">
                                    Warehouse
                                </th>

                                <th class="px-6 py-2 text-[10px] font-semibold uppercase tracking-[0.16em] text-[#6E7682]">
                                    Stock
                                </th>

                                <th class="px-6 py-2 text-[10px] font-semibold uppercase tracking-[0.16em] text-[#6E7682]">
                                    Available
                                </th>

                                <th class="px-6 py-2 text-[10px] font-semibold uppercase tracking-[0.16em] text-[#6E7682]">
                                    Status
                                </th>

                                <th class="px-6 py-2 text-right text-[10px] font-semibold uppercase tracking-[0.16em] text-[#6E7682]">
                                    Action
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @forelse ($inventories as $inventory)

                                @php

                                    $available = $inventory->available_quantity;

                                    $isLow = $inventory->isLowStock();

                                @endphp


                                <tr class="group">

                                    {{-- Product --}}
                                    <td
                                        class="rounded-l-2xl border-y border-l border-white/[0.045] bg-[#151A21] px-6 py-5 transition duration-200 group-hover:border-[#8B7CFF]/15 group-hover:bg-[#181E27]"
                                    >

                                        <div class="flex items-center gap-3.5">

                                            <div
                                                class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl border border-[#8B7CFF]/15 bg-[#8B7CFF]/[0.06] text-sm text-[#A99FFF] transition group-hover:border-[#8B7CFF]/30 group-hover:bg-[#8B7CFF]/[0.10]"
                                            >
                                                ▣
                                            </div>


                                            <div class="min-w-0">

                                                <p class="truncate text-sm font-semibold text-white">
                                                    {{ $inventory->productVariant->product->name ?? 'Unknown Product' }}
                                                </p>

                                                <p class="mt-1 text-[10px] uppercase tracking-[0.12em] text-[#555D68]">
                                                    Inventory record
                                                </p>

                                            </div>

                                        </div>

                                    </td>


                                    {{-- Variant --}}
                                    <td
                                        class="border-y border-white/[0.045] bg-[#151A21] px-6 py-5 transition duration-200 group-hover:border-[#8B7CFF]/15 group-hover:bg-[#181E27]"
                                    >

                                        <p class="text-sm text-[#AEB4BE]">
                                            {{ $inventory->productVariant->name ?? '—' }}
                                        </p>

                                    </td>


                                    {{-- SKU --}}
                                    <td
                                        class="border-y border-white/[0.045] bg-[#151A21] px-6 py-5 transition duration-200 group-hover:border-[#8B7CFF]/15 group-hover:bg-[#181E27]"
                                    >

                                        <span class="font-mono text-xs text-[#7B838E]">
                                            {{ $inventory->productVariant->sku ?? '—' }}
                                        </span>

                                    </td>


                                    {{-- Warehouse --}}
                                    <td
                                        class="border-y border-white/[0.045] bg-[#151A21] px-6 py-5 transition duration-200 group-hover:border-[#8B7CFF]/15 group-hover:bg-[#181E27]"
                                    >

                                        <div class="flex items-center gap-2">

                                            <span class="h-1.5 w-1.5 rounded-full bg-[#64748B]"></span>

                                            <span class="text-sm text-[#AEB4BE]">
                                                {{ $inventory->warehouse->name ?? '—' }}
                                            </span>

                                        </div>

                                    </td>


                                    {{-- Stock --}}
                                    <td
                                        class="border-y border-white/[0.045] bg-[#151A21] px-6 py-5 transition duration-200 group-hover:border-[#8B7CFF]/15 group-hover:bg-[#181E27]"
                                    >

                                        <div>

                                            <p class="text-sm font-semibold text-[#F0F0EC]">
                                                {{ number_format($inventory->quantity) }}
                                            </p>

                                            <p class="mt-1 text-[10px] uppercase tracking-[0.12em] text-[#555D68]">
                                                Total stock
                                            </p>

                                        </div>

                                    </td>


                                    {{-- Available --}}
                                    <td
                                        class="border-y border-white/[0.045] bg-[#151A21] px-6 py-5 transition duration-200 group-hover:border-[#8B7CFF]/15 group-hover:bg-[#181E27]"
                                    >

                                        <div>

                                            <p class="text-sm font-semibold {{ $isLow ? 'text-[#E0B47D]' : 'text-[#B8D9C0]' }}">
                                                {{ number_format($available) }}
                                            </p>

                                            <p class="mt-1 text-[10px] uppercase tracking-[0.12em] text-[#555D68]">
                                                After reservations
                                            </p>

                                        </div>

                                    </td>


                                    {{-- Status --}}
                                    <td
                                        class="border-y border-white/[0.045] bg-[#151A21] px-6 py-5 transition duration-200 group-hover:border-[#8B7CFF]/15 group-hover:bg-[#181E27]"
                                    >

                                        @if ($isLow)

                                            <span class="inline-flex items-center gap-2 rounded-full border border-[#D9A66F]/20 bg-[#D9A66F]/[0.07] px-3 py-1.5 text-xs font-medium text-[#E0B47D]">

                                                <span class="h-1.5 w-1.5 rounded-full bg-[#D9A66F] shadow-[0_0_8px_rgba(217,166,111,0.75)]"></span>

                                                Low Stock

                                            </span>

                                        @else

                                            <span class="inline-flex items-center gap-2 rounded-full border border-emerald-400/15 bg-emerald-400/[0.07] px-3 py-1.5 text-xs font-medium text-emerald-300">

                                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-400 shadow-[0_0_8px_rgba(52,211,153,0.8)]"></span>

                                                Healthy

                                            </span>

                                        @endif

                                    </td>


                                    {{-- Action --}}
                                    <td
                                        class="rounded-r-2xl border-y border-r border-white/[0.045] bg-[#151A21] px-6 py-5 text-right transition duration-200 group-hover:border-[#8B7CFF]/15 group-hover:bg-[#181E27]"
                                    >

                                        <a
                                            href="{{ route('inventory.show', $inventory) }}"
                                            class="group/view inline-flex items-center gap-2 rounded-xl border border-white/[0.06] bg-white/[0.02] px-3.5 py-2 text-xs font-medium text-[#8E96A1] transition hover:border-[#8B7CFF]/30 hover:bg-[#8B7CFF]/[0.07] hover:text-white"
                                        >

                                            View

                                            <span class="text-[#626A75] transition group-hover/view:translate-x-0.5 group-hover/view:text-[#A99FFF]">
                                                →
                                            </span>

                                        </a>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td
                                        colspan="8"
                                        class="px-6 py-20 text-center"
                                    >

                                        <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl border border-white/[0.07] bg-white/[0.02] text-[#656D78]">
                                            ▣
                                        </div>

                                        <p class="mt-5 text-sm font-medium text-[#E8E9E6]">
                                            No inventory records found
                                        </p>

                                        <p class="mx-auto mt-2 max-w-sm text-sm text-[#69717C]">
                                            Add your first inventory record to begin tracking stock across warehouses.
                                        </p>

                                        <a
                                            href="{{ route('inventory.create') }}"
                                            class="mt-5 inline-flex items-center gap-2 rounded-xl border border-[#8B7CFF]/25 bg-[#8B7CFF]/[0.08] px-4 py-2.5 text-xs font-medium text-[#B7B0FF] transition hover:border-[#8B7CFF]/40 hover:bg-[#8B7CFF]/[0.13] hover:text-white"
                                        >
                                            + Add first inventory
                                        </a>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </section>


            {{-- ========================================================
                STOCK MOVEMENT HISTORY
            ========================================================= --}}

            <section
                class="relative overflow-hidden rounded-[24px] border border-white/[0.07] bg-white/[0.02] shadow-[0_24px_70px_rgba(0,0,0,0.22)] backdrop-blur-xl"
            >

                <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(circle_at_top_left,rgba(86,194,255,0.035),transparent_30%),radial-gradient(circle_at_bottom_right,rgba(139,124,255,0.04),transparent_30%)]"></div>


                {{-- Section Header --}}
                <div class="relative flex flex-col gap-5 border-b border-white/[0.06] px-6 py-6 lg:flex-row lg:items-center lg:justify-between">

                    <div>

                        <div class="flex items-center gap-2">

                            <span class="h-2 w-2 rounded-full bg-[#55B8FF] shadow-[0_0_12px_rgba(85,184,255,0.7)]"></span>

                            <p class="text-[10px] font-semibold uppercase tracking-[0.19em] text-[#6E7682]">
                                Movement history
                            </p>

                        </div>


                        <h2 class="mt-2 text-base font-semibold text-white">
                            Stock Movement History
                        </h2>


                        <p class="mt-1 text-sm text-[#747C88]">
                            Track every stock movement across your business.
                        </p>

                    </div>


                    <div class="rounded-xl border border-white/[0.06] bg-black/20 px-3.5 py-2.5 text-xs text-[#7B838E]">
                        {{ $stockMovements->count() }} Movements
                    </div>

                </div>


                {{-- ====================================================
                    Movement Table

                    Same Dashboard-style row separation.
                ===================================================== --}}

                <div class="relative overflow-x-auto px-4 py-2 sm:px-5">

                    <table class="w-full min-w-[1200px] border-separate border-spacing-x-0 border-spacing-y-3 text-left">

                        <thead>

                            <tr>

                                <th class="px-6 py-2 text-[10px] font-semibold uppercase tracking-[0.16em] text-[#6E7682]">
                                    Date
                                </th>

                                <th class="px-6 py-2 text-[10px] font-semibold uppercase tracking-[0.16em] text-[#6E7682]">
                                    Product
                                </th>

                                <th class="px-6 py-2 text-[10px] font-semibold uppercase tracking-[0.16em] text-[#6E7682]">
                                    Variant
                                </th>

                                <th class="px-6 py-2 text-[10px] font-semibold uppercase tracking-[0.16em] text-[#6E7682]">
                                    Warehouse
                                </th>

                                <th class="px-6 py-2 text-[10px] font-semibold uppercase tracking-[0.16em] text-[#6E7682]">
                                    Type
                                </th>

                                <th class="px-6 py-2 text-[10px] font-semibold uppercase tracking-[0.16em] text-[#6E7682]">
                                    Quantity
                                </th>

                                <th class="px-6 py-2 text-[10px] font-semibold uppercase tracking-[0.16em] text-[#6E7682]">
                                    Reference
                                </th>

                                <th class="px-6 py-2 text-[10px] font-semibold uppercase tracking-[0.16em] text-[#6E7682]">
                                    User
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @forelse ($stockMovements as $movement)

                                <tr class="group">

                                    {{-- Date --}}
                                    <td
                                        class="rounded-l-2xl border-y border-l border-white/[0.045] bg-[#151A21] px-6 py-5 transition duration-200 group-hover:border-[#55B8FF]/15 group-hover:bg-[#181E27]"
                                    >

                                        <div>

                                            <p class="text-sm font-medium text-white">
                                                {{ $movement->created_at?->format('d M Y') }}
                                            </p>

                                            <p class="mt-1 text-[10px] uppercase tracking-[0.12em] text-[#565E69]">
                                                {{ $movement->created_at?->format('H:i') }}
                                            </p>

                                        </div>

                                    </td>


                                    {{-- Product --}}
                                    <td
                                        class="border-y border-white/[0.045] bg-[#151A21] px-6 py-5 transition duration-200 group-hover:border-[#55B8FF]/15 group-hover:bg-[#181E27]"
                                    >

                                        <div class="flex items-center gap-3">

                                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl border border-[#55B8FF]/15 bg-[#55B8FF]/[0.05] text-xs text-[#91D2FF]">
                                                ↕
                                            </div>


                                            <div class="min-w-0">

                                                <p class="truncate text-sm font-semibold text-white">
                                                    {{ $movement->productVariant->product->name ?? 'Unknown Product' }}
                                                </p>

                                            </div>

                                        </div>

                                    </td>


                                    {{-- Variant --}}
                                    <td
                                        class="border-y border-white/[0.045] bg-[#151A21] px-6 py-5 transition duration-200 group-hover:border-[#55B8FF]/15 group-hover:bg-[#181E27]"
                                    >

                                        <p class="text-sm text-[#AEB4BE]">
                                            {{ $movement->productVariant->name ?? '—' }}
                                        </p>

                                        <p class="mt-1 font-mono text-[10px] text-[#626A75]">
                                            {{ $movement->productVariant->sku ?? '—' }}
                                        </p>

                                    </td>


                                    {{-- Warehouse --}}
                                    <td
                                        class="border-y border-white/[0.045] bg-[#151A21] px-6 py-5 transition duration-200 group-hover:border-[#55B8FF]/15 group-hover:bg-[#181E27]"
                                    >

                                        <span class="text-sm text-[#AEB4BE]">
                                            {{ $movement->warehouse->name ?? '—' }}
                                        </span>

                                    </td>


                                    {{-- Type --}}
                                    <td
                                        class="border-y border-white/[0.045] bg-[#151A21] px-6 py-5 transition duration-200 group-hover:border-[#55B8FF]/15 group-hover:bg-[#181E27]"
                                    >

                                        @if ($movement->type === 'purchase')

                                            <span class="inline-flex items-center gap-2 rounded-full border border-[#8B7CFF]/20 bg-[#8B7CFF]/[0.07] px-3 py-1.5 text-xs font-medium text-[#A99FFF]">

                                                <span class="h-1.5 w-1.5 rounded-full bg-[#8B7CFF]"></span>

                                                Purchase

                                            </span>

                                        @elseif ($movement->type === 'sale')

                                            <span class="inline-flex items-center gap-2 rounded-full border border-red-400/15 bg-red-400/[0.06] px-3 py-1.5 text-xs font-medium text-[#F29A9A]">

                                                <span class="h-1.5 w-1.5 rounded-full bg-[#F29A9A]"></span>

                                                Sale

                                            </span>

                                        @elseif ($movement->type === 'adjustment')

                                            <span class="inline-flex items-center gap-2 rounded-full border border-[#D9C57A]/15 bg-[#D9C57A]/[0.06] px-3 py-1.5 text-xs font-medium text-[#E6C47A]">

                                                <span class="h-1.5 w-1.5 rounded-full bg-[#E6C47A]"></span>

                                                Adjustment

                                            </span>

                                        @elseif ($movement->type === 'transfer')

                                            <span class="inline-flex items-center gap-2 rounded-full border border-[#55B8FF]/15 bg-[#55B8FF]/[0.06] px-3 py-1.5 text-xs font-medium text-[#91D2FF]">

                                                <span class="h-1.5 w-1.5 rounded-full bg-[#55B8FF]"></span>

                                                Transfer

                                            </span>

                                        @else

                                            <span class="inline-flex items-center gap-2 rounded-full border border-white/[0.06] bg-white/[0.025] px-3 py-1.5 text-xs font-medium text-[#AEB4BE]">

                                                <span class="h-1.5 w-1.5 rounded-full bg-[#69717C]"></span>

                                                {{ $movement->type_label }}

                                            </span>

                                        @endif

                                    </td>


                                    {{-- Quantity --}}
                                    <td
                                        class="border-y border-white/[0.045] bg-[#151A21] px-6 py-5 transition duration-200 group-hover:border-[#55B8FF]/15 group-hover:bg-[#181E27]"
                                    >

                                        <div>

                                            <span class="inline-flex items-center rounded-lg border border-emerald-400/12 bg-emerald-400/[0.05] px-2.5 py-1 text-xs font-semibold text-[#B8D9C0]">
                                                +{{ number_format($movement->quantity) }}
                                            </span>

                                            <p class="mt-1 text-[10px] uppercase tracking-[0.12em] text-[#555D68]">
                                                Units moved
                                            </p>

                                        </div>

                                    </td>


                                    {{-- Reference --}}
                                    <td
                                        class="border-y border-white/[0.045] bg-[#151A21] px-6 py-5 transition duration-200 group-hover:border-[#55B8FF]/15 group-hover:bg-[#181E27]"
                                    >

                                        @if ($movement->reference)

                                            @if ($movement->reference_type === \App\Models\PurchaseOrder::class)

                                                <a
                                                    href="{{ route('purchasing.show', $movement->reference_id) }}"
                                                    class="inline-flex items-center gap-2 rounded-lg border border-white/[0.06] bg-white/[0.02] px-2.5 py-1.5 font-mono text-xs font-medium text-[#A99FFF] transition hover:border-[#8B7CFF]/30 hover:bg-[#8B7CFF]/[0.07] hover:text-white"
                                                >

                                                    {{ $movement->reference->po_number }}

                                                    <span class="font-sans text-[#626A75]">
                                                        →
                                                    </span>

                                                </a>

                                            @else

                                                <span class="font-mono text-xs text-[#7B838E]">
                                                    #{{ $movement->reference_id }}
                                                </span>

                                            @endif

                                        @else

                                            <span class="text-sm text-[#565E69]">
                                                —
                                            </span>

                                        @endif

                                    </td>


                                    {{-- User --}}
                                    <td
                                        class="rounded-r-2xl border-y border-r border-white/[0.045] bg-[#151A21] px-6 py-5 transition duration-200 group-hover:border-[#55B8FF]/15 group-hover:bg-[#181E27]"
                                    >

                                        <div class="flex items-center gap-2.5">

                                            <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full border border-white/[0.06] bg-white/[0.025] text-[10px] font-semibold text-[#8F97A3]">
                                                {{ $movement->user ? strtoupper(substr($movement->user->name, 0, 1)) : 'S' }}
                                            </div>

                                            <p class="text-sm text-[#AEB4BE]">
                                                {{ $movement->user->name ?? 'System' }}
                                            </p>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td
                                        colspan="8"
                                        class="px-6 py-20 text-center"
                                    >

                                        <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl border border-white/[0.07] bg-white/[0.02] text-[#656D78]">
                                            ↕
                                        </div>

                                        <p class="mt-5 text-sm font-medium text-[#E8E9E6]">
                                            No stock movements recorded yet
                                        </p>

                                        <p class="mt-2 text-sm text-[#69717C]">
                                            Stock movements will appear here when inventory changes.
                                        </p>

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