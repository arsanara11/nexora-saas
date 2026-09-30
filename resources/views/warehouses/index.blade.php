<x-app-layout>

    <div
        class="relative isolate overflow-hidden rounded-[48px] border border-white/[0.045] bg-[#080B10] px-6 py-7 text-[#F5F5F2] shadow-[0_35px_90px_rgba(0,0,0,0.22)] sm:px-8 sm:py-8 lg:px-10 lg:py-9"
    >

        {{-- ============================================================
            AMBIENT BACKGROUND
        ============================================================= --}}

        <div class="pointer-events-none absolute inset-0 -z-10 overflow-hidden">

            <div
                class="absolute -left-24 top-0 h-80 w-80 rounded-full bg-[#8B7CFF]/[0.065] blur-3xl"
            ></div>

            <div
                class="absolute right-[-80px] top-20 h-96 w-96 rounded-full bg-[#4A7CFF]/[0.04] blur-3xl"
            ></div>

            <div
                class="absolute bottom-[-140px] left-1/3 h-80 w-80 rounded-full bg-[#55B8FF]/[0.025] blur-3xl"
            ></div>

            <div
                class="absolute inset-0 bg-[radial-gradient(circle_at_top_left,rgba(139,124,255,0.045),transparent_28%),radial-gradient(circle_at_bottom_right,rgba(77,105,255,0.03),transparent_30%)]"
            ></div>

        </div>


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

                        <p
                            class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#777F8B]"
                        >
                            Inventory / Warehouses
                        </p>

                    </div>


                    <h1 class="text-3xl font-semibold tracking-[-0.03em] text-white">
                        Warehouses
                    </h1>


                    <p class="mt-2 max-w-xl text-sm leading-6 text-[#818895]">
                        Manage storage locations and monitor warehouse activity across your operations.
                    </p>

                </div>


                <div class="flex flex-wrap items-center gap-3">

                    <div
                        class="hidden items-center gap-2 rounded-xl border border-white/[0.06] bg-white/[0.025] px-3.5 py-2.5 text-xs text-[#737B87] sm:flex"
                    >

                        <span
                            class="h-1.5 w-1.5 rounded-full bg-emerald-400 shadow-[0_0_10px_rgba(52,211,153,0.7)]"
                        ></span>

                        Operations synced

                    </div>


                    <a
                        href="{{ route('warehouses.create') }}"
                        class="group inline-flex items-center gap-2 rounded-2xl bg-[#8B7CFF] px-5 py-3 text-sm font-medium text-white shadow-[0_10px_30px_rgba(139,124,255,0.18)] transition duration-200 hover:-translate-y-0.5 hover:bg-[#7C6EF0] hover:shadow-[0_14px_34px_rgba(139,124,255,0.24)]"
                    >

                        <span
                            class="text-base leading-none transition-transform duration-200 group-hover:rotate-90"
                        >
                            +
                        </span>

                        Add Warehouse

                    </a>

                </div>

            </div>


            {{-- ========================================================
                FLASH MESSAGES
            ========================================================= --}}

            @if (session('success'))

                <div
                    class="relative overflow-hidden rounded-2xl border border-emerald-400/[0.12] bg-emerald-400/[0.05] px-5 py-4 shadow-[0_18px_45px_rgba(0,0,0,0.16)] backdrop-blur-xl"
                >

                    <div
                        class="pointer-events-none absolute -right-10 -top-10 h-28 w-28 rounded-full bg-emerald-400/[0.07] blur-2xl"
                    ></div>


                    <div class="relative flex items-start gap-3">

                        <div
                            class="mt-0.5 flex h-8 w-8 shrink-0 items-center justify-center rounded-xl border border-emerald-400/[0.14] bg-emerald-400/[0.08] text-emerald-300"
                        >
                            ✓
                        </div>


                        <div>

                            <p
                                class="text-[10px] font-semibold uppercase tracking-[0.16em] text-emerald-300/75"
                            >
                                Update complete
                            </p>

                            <p class="mt-1 text-sm text-[#B9DCC2]">
                                {{ session('success') }}
                            </p>

                        </div>

                    </div>

                </div>

            @endif


            @if (session('error'))

                <div
                    class="relative overflow-hidden rounded-2xl border border-red-400/[0.12] bg-red-400/[0.045] px-5 py-4 shadow-[0_18px_45px_rgba(0,0,0,0.16)] backdrop-blur-xl"
                >

                    <div
                        class="pointer-events-none absolute -right-10 -top-10 h-28 w-28 rounded-full bg-red-400/[0.06] blur-2xl"
                    ></div>


                    <div class="relative flex items-start gap-3">

                        <div
                            class="mt-0.5 flex h-8 w-8 shrink-0 items-center justify-center rounded-xl border border-red-400/[0.14] bg-red-400/[0.07] text-red-300"
                        >
                            !
                        </div>


                        <div>

                            <p
                                class="text-[10px] font-semibold uppercase tracking-[0.16em] text-red-300/75"
                            >
                                Action blocked
                            </p>

                            <p class="mt-1 text-sm text-[#E4B0B0]">
                                {{ session('error') }}
                            </p>

                        </div>

                    </div>

                </div>

            @endif


            {{-- ========================================================
                SUMMARY
            ========================================================= --}}

            <section class="grid grid-cols-1 gap-4 sm:grid-cols-3">


                {{-- Total --}}
                <div
                    class="group relative overflow-hidden rounded-[26px] border border-white/[0.055] bg-[#12151A]/90 px-5 py-5 shadow-[0_18px_55px_rgba(0,0,0,0.16)] backdrop-blur-sm transition duration-300 hover:-translate-y-0.5 hover:border-[#8B7CFF]/20"
                >

                    <div
                        class="pointer-events-none absolute -right-10 -top-10 h-28 w-28 rounded-full bg-[#8B7CFF]/[0.08] blur-2xl transition duration-300 group-hover:bg-[#8B7CFF]/[0.12]"
                    ></div>


                    <div class="relative">

                        <div class="flex items-center justify-between">

                            <span class="text-[10px] font-semibold uppercase tracking-[0.16em] text-[#6E7682]">
                                Total
                            </span>

                            <span class="text-[10px] uppercase tracking-[0.12em] text-[#565E69]">
                                Warehouses
                            </span>

                        </div>


                        <div class="mt-4 flex items-end justify-between gap-4">

                            <div>

                                <div class="text-3xl font-semibold tracking-tight text-white">
                                    {{ $summary['total'] }}
                                </div>

                                <p class="mt-2 text-xs text-[#777F8B]">
                                    Storage locations
                                </p>

                            </div>


                            <div
                                class="flex h-11 w-11 items-center justify-center rounded-2xl border border-[#8B7CFF]/15 bg-[#8B7CFF]/[0.07] text-[#A99FFF]"
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
                                        d="M3 21h18M5 21V7l7-4 7 4v14M8 10h2m4 0h2M8 14h2m4 0h2M8 18h2m4 0h2"
                                    />
                                </svg>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- Active --}}
                <div
                    class="group relative overflow-hidden rounded-[26px] border border-white/[0.055] bg-[#12151A]/90 px-5 py-5 shadow-[0_18px_55px_rgba(0,0,0,0.16)] backdrop-blur-sm transition duration-300 hover:-translate-y-0.5 hover:border-emerald-400/20"
                >

                    <div
                        class="pointer-events-none absolute -right-10 -top-10 h-28 w-28 rounded-full bg-emerald-400/[0.06] blur-2xl transition duration-300 group-hover:bg-emerald-400/[0.10]"
                    ></div>


                    <div class="relative">

                        <div class="flex items-center justify-between">

                            <span class="text-[10px] font-semibold uppercase tracking-[0.16em] text-[#6E7682]">
                                Active
                            </span>

                            <span class="flex items-center gap-2 text-[10px] text-[#707782]">

                                <span
                                    class="h-1.5 w-1.5 rounded-full bg-emerald-400 shadow-[0_0_8px_rgba(52,211,153,0.75)]"
                                ></span>

                                Operational

                            </span>

                        </div>


                        <div class="mt-4 flex items-end justify-between gap-4">

                            <div>

                                <div class="text-3xl font-semibold tracking-tight text-white">
                                    {{ $summary['active'] }}
                                </div>

                                <p class="mt-2 text-xs text-[#777F8B]">
                                    Currently operational
                                </p>

                            </div>


                            <div
                                class="flex h-11 w-11 items-center justify-center rounded-2xl border border-emerald-400/15 bg-emerald-400/[0.06] text-emerald-300"
                            >

                                <span
                                    class="h-2.5 w-2.5 rounded-full bg-emerald-400 shadow-[0_0_14px_rgba(52,211,153,0.75)]"
                                ></span>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- With Inventory --}}
                <div
                    class="group relative overflow-hidden rounded-[26px] border border-white/[0.055] bg-[#12151A]/90 px-5 py-5 shadow-[0_18px_55px_rgba(0,0,0,0.16)] backdrop-blur-sm transition duration-300 hover:-translate-y-0.5 hover:border-[#55B8FF]/20"
                >

                    <div
                        class="pointer-events-none absolute -right-10 -top-10 h-28 w-28 rounded-full bg-[#55B8FF]/[0.06] blur-2xl transition duration-300 group-hover:bg-[#55B8FF]/[0.10]"
                    ></div>


                    <div class="relative">

                        <div class="flex items-center justify-between">

                            <span class="text-[10px] font-semibold uppercase tracking-[0.16em] text-[#6E7682]">
                                With Inventory
                            </span>

                            <span class="text-[10px] uppercase tracking-[0.12em] text-[#565E69]">
                                Stock
                            </span>

                        </div>


                        <div class="mt-4 flex items-end justify-between gap-4">

                            <div>

                                <div class="text-3xl font-semibold tracking-tight text-white">
                                    {{ $summary['with_inventory'] }}
                                </div>

                                <p class="mt-2 text-xs text-[#777F8B]">
                                    Locations holding stock
                                </p>

                            </div>


                            <div
                                class="flex h-11 w-11 items-center justify-center rounded-2xl border border-[#55B8FF]/15 bg-[#55B8FF]/[0.06] text-[#91D2FF]"
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
                                        d="M21 8.5V15a2 2 0 0 1-1 1.73l-7 4a2 2 0 0 1-2 0l-7-4A2 2 0 0 1 3 15V8.5l9-5 9 5Z"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="m3 8 9 5 9-5"
                                    />

                                </svg>

                            </div>

                        </div>

                    </div>

                </div>

            </section>


            {{-- ========================================================
                MAIN WAREHOUSE DIRECTORY
            ========================================================= --}}

            <section
                class="relative overflow-hidden rounded-[30px] border border-white/[0.055] bg-[#11151A]/95 shadow-[0_30px_80px_rgba(0,0,0,0.22)] backdrop-blur-xl"
            >

                <div
                    class="pointer-events-none absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(139,124,255,0.04),transparent_30%),radial-gradient(circle_at_bottom_left,rgba(85,184,255,0.025),transparent_28%)]"
                ></div>


                {{-- ====================================================
                    TOOLBAR
                ===================================================== --}}

                <div
                    class="relative border-b border-white/[0.045] px-5 py-5 sm:px-6"
                >

                    <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">

                        <div>

                            <p class="text-[10px] font-semibold uppercase tracking-[0.18em] text-[#707782]">
                                Warehouse directory
                            </p>


                            <h2 class="mt-2 text-base font-semibold text-white">
                                All Warehouses
                            </h2>


                            <p class="mt-1 text-xs text-[#666D78]">
                                {{ $warehouses->total() }}
                                {{ $warehouses->total() === 1 ? 'warehouse' : 'warehouses' }}
                                configured for this workspace.
                            </p>

                        </div>


                        <form
                            method="GET"
                            action="{{ route('warehouses.index') }}"
                            class="flex w-full flex-col gap-3 sm:flex-row lg:w-auto"
                        >

                            {{-- Search --}}
                            <div class="relative min-w-0 sm:w-64">

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="pointer-events-none absolute left-3.5 top-1/2 h-4 w-4 -translate-y-1/2 text-[#555D68]"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="m21 21-4.35-4.35m1.35-5.65a7 7 0 11-14 0 7 7 0 0114 0z"
                                    />
                                </svg>


                                <input
                                    type="text"
                                    name="search"
                                    value="{{ request('search') }}"
                                    placeholder="Search warehouses..."
                                    class="h-10 w-full rounded-xl border border-white/[0.06] bg-[#0B0D10] pl-10 pr-4 text-sm text-white outline-none transition placeholder:text-[#505762] focus:border-[#8B7CFF]/40 focus:ring-1 focus:ring-[#8B7CFF]/10"
                                >

                            </div>


                            {{-- Status --}}
                            <select
                                name="status"
                                class="h-10 rounded-xl border border-white/[0.06] bg-[#0B0D10] px-3 text-sm text-[#BFC4CC] outline-none transition focus:border-[#8B7CFF]/40 focus:ring-1 focus:ring-[#8B7CFF]/10"
                            >

                                <option value="">
                                    All status
                                </option>

                                <option
                                    value="active"
                                    @selected(request('status') === 'active')
                                >
                                    Active
                                </option>

                                <option
                                    value="inactive"
                                    @selected(request('status') === 'inactive')
                                >
                                    Inactive
                                </option>

                            </select>


                            <button
                                type="submit"
                                class="inline-flex h-10 items-center justify-center rounded-xl bg-[#F5F5F2] px-4 text-sm font-semibold text-[#080B10] transition hover:bg-white"
                            >
                                Filter
                            </button>


                            @if (request()->hasAny(['search', 'status']))

                                <a
                                    href="{{ route('warehouses.index') }}"
                                    class="inline-flex h-10 items-center justify-center rounded-xl border border-white/[0.06] bg-white/[0.02] px-4 text-sm font-medium text-[#9299A5] transition hover:border-white/[0.10] hover:bg-white/[0.04] hover:text-white"
                                >
                                    Reset
                                </a>

                            @endif

                        </form>

                    </div>

                </div>


                @if ($warehouses->count())

                    {{-- =================================================
                        DESKTOP
                        Header + every row use EXACT SAME grid.
                    ================================================== --}}

                    <div class="hidden md:block overflow-x-auto">

                        <div class="min-w-[1120px]">

                            {{-- Header --}}
                            <div
                                class="grid grid-cols-[minmax(250px,1.45fr)_minmax(180px,1fr)_150px_minmax(170px,1fr)_150px_70px] gap-4 border-b border-white/[0.045] px-5 py-4 sm:px-6"
                            >

                                <div class="text-[10px] font-semibold uppercase tracking-[0.16em] text-[#6E7682]">
                                    Warehouse
                                </div>

                                <div class="text-[10px] font-semibold uppercase tracking-[0.16em] text-[#6E7682]">
                                    Location
                                </div>

                                <div class="text-[10px] font-semibold uppercase tracking-[0.16em] text-[#6E7682]">
                                    Inventory
                                </div>

                                <div class="text-[10px] font-semibold uppercase tracking-[0.16em] text-[#6E7682]">
                                    Activity
                                </div>

                                <div class="text-[10px] font-semibold uppercase tracking-[0.16em] text-[#6E7682]">
                                    Status
                                </div>

                                <div></div>

                            </div>


                            {{-- Rows --}}
                            <div class="space-y-3 p-4 sm:p-5">

                                @foreach ($warehouses as $warehouse)

                                    <div
                                        class="group relative overflow-hidden rounded-2xl border border-white/[0.045] bg-[#151A21] px-5 py-5 transition duration-200 hover:border-[#8B7CFF]/15 hover:bg-[#181E27]"
                                    >

                                        <div
                                            class="pointer-events-none absolute -right-16 -top-20 h-36 w-36 rounded-full bg-[#8B7CFF]/[0.025] blur-3xl transition duration-300 group-hover:bg-[#8B7CFF]/[0.05]"
                                        ></div>


                                        {{-- SAME GRID AS HEADER --}}
                                        <div
                                            class="relative grid min-w-0 grid-cols-[minmax(250px,1.45fr)_minmax(180px,1fr)_150px_minmax(170px,1fr)_150px_70px] items-center gap-4"
                                        >

                                            {{-- Warehouse --}}
                                            <div class="min-w-0">

                                                <div class="flex items-center gap-4">

                                                    <div
                                                        class="relative flex h-11 w-11 shrink-0 items-center justify-center overflow-hidden rounded-2xl border border-[#8B7CFF]/10 bg-[#0D1116] text-sm font-semibold text-[#A99FFF] transition duration-200 group-hover:border-[#8B7CFF]/25"
                                                    >

                                                        <span class="relative z-10">
                                                            {{ strtoupper(substr($warehouse->name, 0, 1)) }}
                                                        </span>

                                                        <span
                                                            class="absolute inset-0 bg-[radial-gradient(circle_at_30%_20%,rgba(139,124,255,0.14),transparent_55%)]"
                                                        ></span>

                                                    </div>


                                                    <div class="min-w-0">

                                                        <p class="truncate text-sm font-semibold text-[#F1F1EE]">
                                                            {{ $warehouse->name }}
                                                        </p>

                                                        <p class="mt-1 truncate font-mono text-[10px] uppercase tracking-[0.12em] text-[#626A75]">
                                                            {{ $warehouse->code }}
                                                        </p>

                                                    </div>

                                                </div>

                                            </div>


                                            {{-- Location --}}
                                            <div class="min-w-0">

                                                <p class="truncate text-sm text-[#B8BEC7]">
                                                    {{ $warehouse->city ?: '—' }}
                                                </p>


                                                @if ($warehouse->address)

                                                    <p class="mt-1 max-w-[220px] truncate text-xs text-[#68707B]">
                                                        {{ $warehouse->address }}
                                                    </p>

                                                @else

                                                    <p class="mt-1 text-xs text-[#4F5661]">
                                                        No address
                                                    </p>

                                                @endif

                                            </div>


                                            {{-- Inventory --}}
                                            <div>

                                                <div class="flex items-center gap-2">

                                                    <span
                                                        class="inline-flex min-w-9 items-center justify-center rounded-xl border border-[#55B8FF]/15 bg-[#55B8FF]/[0.06] px-2.5 py-1.5 text-xs font-semibold text-[#91D2FF]"
                                                    >
                                                        {{ $warehouse->inventories_count }}
                                                    </span>

                                                    <span class="text-xs text-[#68707B]">
                                                        items
                                                    </span>

                                                </div>

                                            </div>


                                            {{-- Activity --}}
                                            <div>

                                                <p class="text-sm text-[#B8BEC7]">
                                                    {{ $warehouse->orders_count }}
                                                    order{{ $warehouse->orders_count === 1 ? '' : 's' }}
                                                </p>

                                                <p class="mt-1 text-xs text-[#68707B]">
                                                    {{ $warehouse->purchase_orders_count }}
                                                    PO{{ $warehouse->purchase_orders_count === 1 ? '' : 's' }}
                                                </p>

                                            </div>


                                            {{-- Status --}}
                                            <div>

                                                @if ($warehouse->is_active)

                                                    <span
                                                        class="inline-flex items-center gap-2 rounded-full border border-emerald-400/15 bg-emerald-400/[0.07] px-3 py-1.5 text-xs font-medium text-emerald-300"
                                                    >

                                                        <span
                                                            class="h-1.5 w-1.5 rounded-full bg-emerald-400 shadow-[0_0_8px_rgba(52,211,153,0.8)]"
                                                        ></span>

                                                        Active

                                                    </span>

                                                @else

                                                    <span
                                                        class="inline-flex items-center gap-2 rounded-full border border-white/[0.06] bg-white/[0.025] px-3 py-1.5 text-xs font-medium text-[#7D858F]"
                                                    >

                                                        <span
                                                            class="h-1.5 w-1.5 rounded-full bg-[#69717C]"
                                                        ></span>

                                                        Inactive

                                                    </span>

                                                @endif

                                            </div>


                                            {{-- Actions --}}
                                            <div class="flex justify-end">

                                                <details class="relative">

                                                    <summary
                                                        class="flex h-9 w-9 cursor-pointer list-none items-center justify-center rounded-xl border border-transparent text-[#68717D] transition hover:border-white/[0.06] hover:bg-white/[0.04] hover:text-[#F5F5F2]"
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
                                                                d="M6 12h.01M12 12h.01M18 12h.01"
                                                            />
                                                        </svg>

                                                    </summary>


                                                    <div
                                                        class="absolute right-0 z-30 mt-2 w-48 overflow-hidden rounded-2xl border border-white/[0.08] bg-[#11151B] p-1.5 shadow-[0_25px_70px_rgba(0,0,0,0.45)] backdrop-blur-xl"
                                                    >

                                                        <a
                                                            href="{{ route('warehouses.show', $warehouse) }}"
                                                            class="flex items-center justify-between rounded-xl px-3 py-2.5 text-sm text-[#C2C7CF] transition hover:bg-white/[0.04] hover:text-white"
                                                        >

                                                            View warehouse

                                                            <span class="text-xs text-[#555D68]">
                                                                →
                                                            </span>

                                                        </a>


                                                        <a
                                                            href="{{ route('warehouses.edit', $warehouse) }}"
                                                            class="flex items-center justify-between rounded-xl px-3 py-2.5 text-sm text-[#C2C7CF] transition hover:bg-white/[0.04] hover:text-white"
                                                        >

                                                            Edit warehouse

                                                            <span class="text-xs text-[#555D68]">
                                                                →
                                                            </span>

                                                        </a>


                                                        <form
                                                            method="POST"
                                                            action="{{ route('warehouses.toggle-status', $warehouse) }}"
                                                        >

                                                            @csrf
                                                            @method('PATCH')

                                                            <button
                                                                type="submit"
                                                                class="flex w-full items-center justify-between rounded-xl px-3 py-2.5 text-left text-sm text-[#C2C7CF] transition hover:bg-white/[0.04] hover:text-white"
                                                            >

                                                                {{ $warehouse->is_active ? 'Disable warehouse' : 'Enable warehouse' }}

                                                                <span class="text-xs text-[#555D68]">
                                                                    ↔
                                                                </span>

                                                            </button>

                                                        </form>


                                                        <div class="my-1.5 border-t border-white/[0.06]"></div>


                                                        <form
                                                            method="POST"
                                                            action="{{ route('warehouses.destroy', $warehouse) }}"
                                                            onsubmit="return confirm('Delete this warehouse? This action cannot be undone.')"
                                                        >

                                                            @csrf
                                                            @method('DELETE')

                                                            <button
                                                                type="submit"
                                                                class="flex w-full items-center justify-between rounded-xl px-3 py-2.5 text-left text-sm text-red-300 transition hover:bg-red-500/10"
                                                            >

                                                                Delete warehouse

                                                                <span class="text-xs text-red-300/50">
                                                                    ×
                                                                </span>

                                                            </button>

                                                        </form>

                                                    </div>

                                                </details>

                                            </div>

                                        </div>

                                    </div>

                                @endforeach

                            </div>

                        </div>

                    </div>


                    {{-- =================================================
                        MOBILE
                    ================================================== --}}

                    <div class="space-y-3 p-4 md:hidden">

                        @foreach ($warehouses as $warehouse)

                            <div
                                class="group relative overflow-hidden rounded-2xl border border-white/[0.045] bg-[#151A21] p-5 transition duration-200 hover:border-[#8B7CFF]/15 hover:bg-[#181E27]"
                            >

                                <div
                                    class="pointer-events-none absolute -right-12 -top-12 h-28 w-28 rounded-full bg-[#8B7CFF]/[0.03] blur-2xl"
                                ></div>


                                <div class="relative">

                                    <div class="flex items-start justify-between gap-4">

                                        <div class="flex min-w-0 items-center gap-4">

                                            <div
                                                class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl border border-[#8B7CFF]/10 bg-[#0D1116] text-sm font-semibold text-[#A99FFF]"
                                            >

                                                {{ strtoupper(substr($warehouse->name, 0, 1)) }}

                                            </div>


                                            <div class="min-w-0">

                                                <p class="truncate text-sm font-semibold text-[#F1F1EE]">
                                                    {{ $warehouse->name }}
                                                </p>

                                                <p class="mt-1 truncate font-mono text-[10px] uppercase tracking-[0.12em] text-[#626A75]">
                                                    {{ $warehouse->code }}
                                                </p>

                                            </div>

                                        </div>


                                        @if ($warehouse->is_active)

                                            <span
                                                class="inline-flex shrink-0 items-center gap-2 rounded-full border border-emerald-400/15 bg-emerald-400/[0.07] px-2.5 py-1 text-[10px] font-medium text-emerald-300"
                                            >

                                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>

                                                Active

                                            </span>

                                        @else

                                            <span
                                                class="inline-flex shrink-0 items-center gap-2 rounded-full border border-white/[0.06] bg-white/[0.025] px-2.5 py-1 text-[10px] font-medium text-[#7D858F]"
                                            >

                                                <span class="h-1.5 w-1.5 rounded-full bg-[#69717C]"></span>

                                                Inactive

                                            </span>

                                        @endif

                                    </div>


                                    <div class="mt-6 grid grid-cols-2 gap-3">

                                        <div class="rounded-xl border border-white/[0.06] bg-white/[0.02] px-4 py-3">

                                            <p class="text-[9px] font-semibold uppercase tracking-[0.14em] text-[#555D68]">
                                                Location
                                            </p>

                                            <p class="mt-1.5 truncate text-sm text-[#B8BEC7]">
                                                {{ $warehouse->city ?: '—' }}
                                            </p>

                                        </div>


                                        <div class="rounded-xl border border-white/[0.06] bg-white/[0.02] px-4 py-3">

                                            <p class="text-[9px] font-semibold uppercase tracking-[0.14em] text-[#555D68]">
                                                Inventory
                                            </p>

                                            <p class="mt-1.5 text-sm text-[#B8BEC7]">
                                                {{ $warehouse->inventories_count }} items
                                            </p>

                                        </div>


                                        <div class="rounded-xl border border-white/[0.06] bg-white/[0.02] px-4 py-3">

                                            <p class="text-[9px] font-semibold uppercase tracking-[0.14em] text-[#555D68]">
                                                Orders
                                            </p>

                                            <p class="mt-1.5 text-sm text-[#B8BEC7]">
                                                {{ $warehouse->orders_count }}
                                            </p>

                                        </div>


                                        <div class="rounded-xl border border-white/[0.06] bg-white/[0.02] px-4 py-3">

                                            <p class="text-[9px] font-semibold uppercase tracking-[0.14em] text-[#555D68]">
                                                Purchase Orders
                                            </p>

                                            <p class="mt-1.5 text-sm text-[#B8BEC7]">
                                                {{ $warehouse->purchase_orders_count }}
                                            </p>

                                        </div>

                                    </div>


                                    @if ($warehouse->phone || $warehouse->address)

                                        <div
                                            class="mt-4 rounded-xl border border-white/[0.06] bg-black/[0.14] px-4 py-3.5"
                                        >

                                            @if ($warehouse->phone)

                                                <div class="text-xs text-[#B8BEC7]">
                                                    {{ $warehouse->phone }}
                                                </div>

                                            @endif


                                            @if ($warehouse->address)

                                                <div
                                                    class="{{ $warehouse->phone ? 'mt-1' : '' }} text-xs leading-5 text-[#68707B]"
                                                >
                                                    {{ $warehouse->address }}
                                                </div>

                                            @endif

                                        </div>

                                    @endif


                                    <div class="mt-5 flex flex-wrap items-center gap-2">

                                        <a
                                            href="{{ route('warehouses.show', $warehouse) }}"
                                            class="inline-flex h-9 items-center gap-2 rounded-xl border border-white/[0.07] bg-white/[0.02] px-3.5 text-xs font-medium text-[#AEB4BD] transition hover:border-[#8B7CFF]/25 hover:bg-[#8B7CFF]/[0.06] hover:text-white"
                                        >

                                            View

                                            <span class="text-[#5E6671]">
                                                →
                                            </span>

                                        </a>


                                        <a
                                            href="{{ route('warehouses.edit', $warehouse) }}"
                                            class="inline-flex h-9 items-center rounded-xl border border-white/[0.07] bg-white/[0.02] px-3.5 text-xs font-medium text-[#AEB4BD] transition hover:border-white/[0.12] hover:bg-white/[0.04] hover:text-white"
                                        >
                                            Edit
                                        </a>


                                        <form
                                            method="POST"
                                            action="{{ route('warehouses.toggle-status', $warehouse) }}"
                                        >

                                            @csrf
                                            @method('PATCH')

                                            <button
                                                type="submit"
                                                class="inline-flex h-9 items-center rounded-xl border border-white/[0.07] bg-white/[0.02] px-3.5 text-xs font-medium text-[#AEB4BD] transition hover:border-white/[0.12] hover:bg-white/[0.04] hover:text-white"
                                            >
                                                {{ $warehouse->is_active ? 'Disable' : 'Enable' }}
                                            </button>

                                        </form>


                                        <form
                                            method="POST"
                                            action="{{ route('warehouses.destroy', $warehouse) }}"
                                            onsubmit="return confirm('Delete this warehouse? This action cannot be undone.')"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="inline-flex h-9 items-center rounded-xl border border-red-500/15 bg-red-500/[0.03] px-3.5 text-xs font-medium text-red-300 transition hover:border-red-500/25 hover:bg-red-500/10"
                                            >
                                                Delete
                                            </button>

                                        </form>

                                    </div>

                                </div>

                            </div>

                        @endforeach

                    </div>

                @endif


                {{-- ========================================================
                    EMPTY STATE
                ========================================================= --}}

                @if ($warehouses->count() === 0)

                    <div class="relative px-6 py-24 text-center">

                        <div
                            class="mx-auto flex h-16 w-16 items-center justify-center rounded-[22px] border border-white/[0.07] bg-white/[0.02] text-[#656D78] shadow-[0_18px_45px_rgba(0,0,0,0.18)]"
                        >

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
                                    d="M3 21h18M5 21V7l7-4 7 4v14M8 10h2m4 0h2M8 14h2m4 0h2M8 18h2m4 0h2"
                                />
                            </svg>

                        </div>


                        <div class="mt-5 flex items-center justify-center gap-2">

                            <span class="h-1.5 w-1.5 rounded-full bg-[#8B7CFF]"></span>

                            <p class="text-[10px] font-semibold uppercase tracking-[0.18em] text-[#6E7682]">
                                Warehouse workspace
                            </p>

                        </div>


                        <h3 class="mt-2 text-sm font-semibold text-white">
                            No warehouses found
                        </h3>


                        <p class="mx-auto mt-2 max-w-sm text-sm leading-6 text-[#69717D]">
                            Try adjusting your search or add a warehouse to your operations.
                        </p>


                        <a
                            href="{{ route('warehouses.create') }}"
                            class="mt-6 inline-flex items-center gap-2 rounded-2xl bg-[#8B7CFF] px-5 py-3 text-sm font-medium text-white shadow-[0_10px_30px_rgba(139,124,255,0.18)] transition hover:-translate-y-0.5 hover:bg-[#7C6EF0]"
                        >

                            <span>
                                +
                            </span>

                            Add Warehouse

                        </a>

                    </div>

                @endif


                {{-- ========================================================
                    PAGINATION
                ========================================================= --}}

                @if ($warehouses->hasPages())

                    <div class="relative border-t border-white/[0.055] px-5 py-5 sm:px-6">

                        {{ $warehouses->onEachSide(1)->links() }}

                    </div>

                @endif

            </section>

        </div>

    </div>

</x-app-layout>