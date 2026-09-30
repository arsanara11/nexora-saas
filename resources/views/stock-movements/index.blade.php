<x-app-layout>

    <div
        class="relative isolate overflow-hidden rounded-[48px] border border-white/[0.045] bg-[#0B0D10] px-6 py-7 text-[#F5F5F2] shadow-[0_35px_90px_rgba(0,0,0,0.22)] sm:px-8 sm:py-8 lg:px-10 lg:py-9"
    >

        {{-- ============================================================
            AMBIENT BACKGROUND
        ============================================================ --}}

        <div class="pointer-events-none absolute inset-0 -z-10 overflow-hidden">

            <div
                class="absolute -left-32 -top-40 h-[420px] w-[420px] rounded-full bg-[#8B7CFF]/[0.08] blur-[110px]"
            ></div>

            <div
                class="absolute right-[-120px] top-[18%] h-[360px] w-[360px] rounded-full bg-[#4E6BFF]/[0.05] blur-[100px]"
            ></div>

            <div
                class="absolute bottom-[-180px] left-[35%] h-[420px] w-[420px] rounded-full bg-[#8B7CFF]/[0.04] blur-[120px]"
            ></div>

            <div
                class="absolute inset-0 bg-[radial-gradient(circle_at_top_left,rgba(139,124,255,0.05),transparent_28%),radial-gradient(circle_at_bottom_right,rgba(77,105,255,0.035),transparent_30%)]"
            ></div>

        </div>


        <div class="relative z-10">


            {{-- ========================================================
                HEADER
            ======================================================== --}}

            <div
                class="relative flex flex-col gap-5 border-b border-white/[0.045] pb-7 lg:flex-row lg:items-end lg:justify-between"
            >

                <div>

                    <div class="flex items-center gap-3">

                        <span
                            class="inline-flex h-2 w-2 rounded-full bg-[#8B7CFF] shadow-[0_0_14px_rgba(139,124,255,0.7)]"
                        ></span>

                        <p class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#A99FFF]">
                            Inventory Management
                        </p>

                    </div>

                    <h1 class="mt-3 text-3xl font-semibold tracking-[-0.03em] text-white">
                        Stock Movements
                    </h1>

                    <p class="mt-2 max-w-xl text-sm leading-6 text-[#8B919A]">
                        Track every stock movement across warehouses and inventory.
                    </p>

                </div>


                <div class="flex flex-wrap items-center gap-3">

                    <div
                        class="hidden rounded-full border border-white/[0.06] bg-white/[0.02] px-3 py-2 text-[10px] font-medium uppercase tracking-[0.16em] text-[#707782] sm:block"
                    >
                        Inventory workspace
                    </div>

                    <a
                        href="{{ route('inventory.index') }}"
                        class="inline-flex items-center gap-2 rounded-2xl border border-white/[0.06] bg-white/[0.02] px-4 py-3 text-sm font-medium text-[#B9BEC6] transition duration-200 hover:-translate-y-0.5 hover:border-[#8B7CFF]/20 hover:bg-[#8B7CFF]/[0.05] hover:text-white"
                    >
                        <span class="text-base leading-none">
                            ←
                        </span>

                        Inventory
                    </a>

                    <a
                        href="{{ route('warehouses.index') }}"
                        class="inline-flex items-center gap-2 rounded-2xl border border-white/[0.06] bg-white/[0.02] px-4 py-3 text-sm font-medium text-[#B9BEC6] transition duration-200 hover:-translate-y-0.5 hover:border-[#8B7CFF]/20 hover:bg-[#8B7CFF]/[0.05] hover:text-white"
                    >
                        Warehouses
                    </a>

                </div>

            </div>



            {{-- ========================================================
                SUMMARY CARDS
            ======================================================== --}}

            <div class="relative mt-6 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">


                {{-- Total Movements --}}

                <div
                    class="group relative overflow-hidden rounded-[26px] border border-white/[0.055] bg-[#12151A]/90 p-5 shadow-[0_18px_55px_rgba(0,0,0,0.16)] backdrop-blur-sm transition duration-300 hover:-translate-y-0.5 hover:border-[#8B7CFF]/20"
                >

                    <div
                        class="absolute right-[-30px] top-[-35px] h-28 w-28 rounded-full bg-[#8B7CFF]/[0.08] blur-2xl transition duration-300 group-hover:bg-[#8B7CFF]/[0.12]"
                    ></div>

                    <div class="relative flex items-start justify-between gap-4">

                        <div>

                            <p class="text-[10px] font-semibold uppercase tracking-[0.18em] text-[#707782]">
                                Total Movements
                            </p>

                            <p class="mt-3 text-3xl font-semibold tracking-tight text-white">
                                {{ number_format($summary['total']) }}
                            </p>

                            <p class="mt-2 text-xs text-[#666D78]">
                                All recorded stock activity.
                            </p>

                        </div>

                        <div
                            class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl border border-[#8B7CFF]/15 bg-[#8B7CFF]/[0.07] text-[#A99FFF]"
                        >
                            ◈
                        </div>

                    </div>

                </div>



                {{-- Purchases --}}

                <div
                    class="group relative overflow-hidden rounded-[26px] border border-white/[0.055] bg-[#12151A]/90 p-5 shadow-[0_18px_55px_rgba(0,0,0,0.16)] backdrop-blur-sm transition duration-300 hover:-translate-y-0.5 hover:border-[#63D889]/20"
                >

                    <div
                        class="absolute right-[-30px] top-[-35px] h-28 w-28 rounded-full bg-[#63D889]/[0.06] blur-2xl transition duration-300 group-hover:bg-[#63D889]/[0.10]"
                    ></div>

                    <div class="relative flex items-start justify-between gap-4">

                        <div>

                            <p class="text-[10px] font-semibold uppercase tracking-[0.18em] text-[#707782]">
                                Purchases
                            </p>

                            <p class="mt-3 text-3xl font-semibold tracking-tight text-white">
                                {{ number_format($summary['purchase']) }}
                            </p>

                            <p class="mt-2 text-xs text-[#666D78]">
                                Stock received from purchasing.
                            </p>

                        </div>

                        <div
                            class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl border border-[#63D889]/15 bg-[#63D889]/[0.06] text-[#9FE2B5]"
                        >
                            ↑
                        </div>

                    </div>

                </div>



                {{-- Sales --}}

                <div
                    class="group relative overflow-hidden rounded-[26px] border border-white/[0.055] bg-[#12151A]/90 p-5 shadow-[0_18px_55px_rgba(0,0,0,0.16)] backdrop-blur-sm transition duration-300 hover:-translate-y-0.5 hover:border-[#F07178]/20"
                >

                    <div
                        class="absolute right-[-30px] top-[-35px] h-28 w-28 rounded-full bg-[#F07178]/[0.06] blur-2xl transition duration-300 group-hover:bg-[#F07178]/[0.10]"
                    ></div>

                    <div class="relative flex items-start justify-between gap-4">

                        <div>

                            <p class="text-[10px] font-semibold uppercase tracking-[0.18em] text-[#707782]">
                                Sales
                            </p>

                            <p class="mt-3 text-3xl font-semibold tracking-tight text-white">
                                {{ number_format($summary['sale']) }}
                            </p>

                            <p class="mt-2 text-xs text-[#666D78]">
                                Stock consumed by sales.
                            </p>

                        </div>

                        <div
                            class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl border border-[#F07178]/15 bg-[#F07178]/[0.06] text-[#F49A9F]"
                        >
                            ↓
                        </div>

                    </div>

                </div>



                {{-- Adjustments --}}

                <div
                    class="group relative overflow-hidden rounded-[26px] border border-white/[0.055] bg-[#12151A]/90 p-5 shadow-[0_18px_55px_rgba(0,0,0,0.16)] backdrop-blur-sm transition duration-300 hover:-translate-y-0.5 hover:border-[#E7A93B]/20"
                >

                    <div
                        class="absolute right-[-30px] top-[-35px] h-28 w-28 rounded-full bg-[#E7A93B]/[0.06] blur-2xl transition duration-300 group-hover:bg-[#E7A93B]/[0.10]"
                    ></div>

                    <div class="relative flex items-start justify-between gap-4">

                        <div>

                            <p class="text-[10px] font-semibold uppercase tracking-[0.18em] text-[#707782]">
                                Adjustments
                            </p>

                            <p class="mt-3 text-3xl font-semibold tracking-tight text-white">
                                {{ number_format($summary['adjustment']) }}
                            </p>

                            <p class="mt-2 text-xs text-[#666D78]">
                                Manual inventory adjustments.
                            </p>

                        </div>

                        <div
                            class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl border border-[#E7A93B]/15 bg-[#E7A93B]/[0.06] text-[#E7B95C]"
                        >
                            ±
                        </div>

                    </div>

                </div>

            </div>



            {{-- ========================================================
                FILTER PANEL
            ======================================================== --}}

            <div
                class="relative mt-6 overflow-hidden rounded-[30px] border border-white/[0.055] bg-[#11151A]/95 shadow-[0_30px_80px_rgba(0,0,0,0.18)] backdrop-blur-xl"
            >

                <div
                    class="pointer-events-none absolute right-[-60px] top-[-80px] h-56 w-56 rounded-full bg-[#8B7CFF]/[0.05] blur-3xl"
                ></div>


                <div
                    class="relative flex flex-col gap-4 border-b border-white/[0.045] px-6 py-5 sm:px-7 lg:flex-row lg:items-center lg:justify-between"
                >

                    <div>

                        <p class="text-[10px] font-semibold uppercase tracking-[0.18em] text-[#707782]">
                            Movement directory
                        </p>

                        <h2 class="mt-2 text-base font-semibold text-white">
                            Movement History
                        </h2>

                        <p class="mt-1 text-xs text-[#666D78]">
                            Search and filter stock activity across your workspace.
                        </p>

                    </div>

                    <div
                        class="rounded-xl border border-white/[0.05] bg-white/[0.018] px-3 py-2 text-[10px] font-medium uppercase tracking-[0.14em] text-[#707782]"
                    >
                        Live activity
                    </div>

                </div>


                <form
                    method="GET"
                    action="{{ route('stock-movements.index') }}"
                    class="relative p-6 sm:p-7"
                >

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-6">


                        {{-- Search --}}

                        <div class="xl:col-span-2">

                            <label
                                for="search"
                                class="mb-2 block text-[10px] font-semibold uppercase tracking-[0.14em] text-[#8B919A]"
                            >
                                Search
                            </label>

                            <div class="relative">

                                <span
                                    class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-[#666C75]"
                                >
                                    ⌕
                                </span>

                                <input
                                    type="text"
                                    id="search"
                                    name="search"
                                    value="{{ request('search') }}"
                                    placeholder="Product, SKU, warehouse, user..."
                                    class="w-full rounded-xl border border-white/[0.06] bg-[#0A0D12] py-3 pl-10 pr-4 text-sm text-[#F5F5F2] outline-none transition placeholder:text-[#555C67] focus:border-[#8B7CFF]/50 focus:bg-[#0D1117] focus:ring-1 focus:ring-[#8B7CFF]/20"
                                >

                            </div>

                        </div>


                        {{-- Type --}}

                        <div>

                            <label
                                for="type"
                                class="mb-2 block text-[10px] font-semibold uppercase tracking-[0.14em] text-[#8B919A]"
                            >
                                Type
                            </label>

                            <select
                                id="type"
                                name="type"
                                class="w-full rounded-xl border border-white/[0.06] bg-[#0A0D12] px-4 py-3 text-sm text-[#F5F5F2] outline-none transition focus:border-[#8B7CFF]/50 focus:bg-[#0D1117] focus:ring-1 focus:ring-[#8B7CFF]/20"
                            >

                                <option value="">
                                    All types
                                </option>

                                <option
                                    value="purchase"
                                    @selected(request('type') === 'purchase')
                                >
                                    Purchase
                                </option>

                                <option
                                    value="sale"
                                    @selected(request('type') === 'sale')
                                >
                                    Sale
                                </option>

                                <option
                                    value="adjustment"
                                    @selected(request('type') === 'adjustment')
                                >
                                    Adjustment
                                </option>

                                <option
                                    value="transfer"
                                    @selected(request('type') === 'transfer')
                                >
                                    Transfer
                                </option>

                                <option
                                    value="return"
                                    @selected(request('type') === 'return')
                                >
                                    Return
                                </option>

                            </select>

                        </div>


                        {{-- Warehouse --}}

                        <div>

                            <label
                                for="warehouse_id"
                                class="mb-2 block text-[10px] font-semibold uppercase tracking-[0.14em] text-[#8B919A]"
                            >
                                Warehouse
                            </label>

                            <select
                                id="warehouse_id"
                                name="warehouse_id"
                                class="w-full rounded-xl border border-white/[0.06] bg-[#0A0D12] px-4 py-3 text-sm text-[#F5F5F2] outline-none transition focus:border-[#8B7CFF]/50 focus:bg-[#0D1117] focus:ring-1 focus:ring-[#8B7CFF]/20"
                            >

                                <option value="">
                                    All warehouses
                                </option>

                                @foreach ($warehouses as $warehouse)

                                    <option
                                        value="{{ $warehouse->id }}"
                                        @selected((string) request('warehouse_id') === (string) $warehouse->id)
                                    >
                                        {{ $warehouse->name }}
                                    </option>

                                @endforeach

                            </select>

                        </div>


                        {{-- Date From --}}

                        <div>

                            <label
                                for="date_from"
                                class="mb-2 block text-[10px] font-semibold uppercase tracking-[0.14em] text-[#8B919A]"
                            >
                                From
                            </label>

                            <input
                                type="date"
                                id="date_from"
                                name="date_from"
                                value="{{ request('date_from') }}"
                                class="w-full rounded-xl border border-white/[0.06] bg-[#0A0D12] px-4 py-3 text-sm text-[#F5F5F2] outline-none transition focus:border-[#8B7CFF]/50 focus:bg-[#0D1117] focus:ring-1 focus:ring-[#8B7CFF]/20"
                            >

                        </div>


                        {{-- Date To --}}

                        <div>

                            <label
                                for="date_to"
                                class="mb-2 block text-[10px] font-semibold uppercase tracking-[0.14em] text-[#8B919A]"
                            >
                                To
                            </label>

                            <input
                                type="date"
                                id="date_to"
                                name="date_to"
                                value="{{ request('date_to') }}"
                                class="w-full rounded-xl border border-white/[0.06] bg-[#0A0D12] px-4 py-3 text-sm text-[#F5F5F2] outline-none transition focus:border-[#8B7CFF]/50 focus:bg-[#0D1117] focus:ring-1 focus:ring-[#8B7CFF]/20"
                            >

                        </div>

                    </div>


                    {{-- Filter Footer --}}

                    <div
                        class="mt-5 flex flex-col gap-4 border-t border-white/[0.045] pt-5 sm:flex-row sm:items-center sm:justify-between"
                    >

                        <div class="text-xs text-[#666C75]">

                            @if (request()->hasAny([
                                'search',
                                'type',
                                'warehouse_id',
                                'date_from',
                                'date_to',
                            ]))

                                <span class="inline-flex items-center gap-2">

                                    <span
                                        class="h-1.5 w-1.5 rounded-full bg-[#8B7CFF] shadow-[0_0_8px_rgba(139,124,255,0.7)]"
                                    ></span>

                                    Filters are currently applied.

                                </span>

                            @else

                                <span class="inline-flex items-center gap-2">

                                    <span class="h-1.5 w-1.5 rounded-full bg-[#4B5563]"></span>

                                    Showing all stock movements.

                                </span>

                            @endif

                        </div>


                        <div class="flex flex-col gap-2 sm:flex-row">

                            <a
                                href="{{ route('stock-movements.index') }}"
                                class="inline-flex items-center justify-center rounded-xl border border-white/[0.06] px-4 py-2.5 text-sm font-medium text-[#9AA1AD] transition hover:border-white/[0.10] hover:bg-white/[0.025] hover:text-white"
                            >
                                Reset
                            </a>

                            <button
                                type="submit"
                                class="inline-flex items-center justify-center rounded-xl bg-[#F5F5F2] px-5 py-2.5 text-sm font-semibold text-[#080B10] transition hover:-translate-y-0.5 hover:bg-white"
                            >
                                Apply Filters
                            </button>

                        </div>

                    </div>

                </form>

            </div>



            {{-- ========================================================
                MOVEMENT DIRECTORY
            ======================================================== --}}

            <div
                class="relative mt-6 overflow-hidden rounded-[30px] border border-white/[0.055] bg-[#11151A]/95 shadow-[0_30px_80px_rgba(0,0,0,0.22)] backdrop-blur-xl"
            >

                {{-- Directory Header --}}

                <div
                    class="relative flex flex-col gap-3 border-b border-white/[0.045] px-6 py-5 sm:px-7 lg:flex-row lg:items-center lg:justify-between"
                >

                    <div>

                        <p class="text-[10px] font-semibold uppercase tracking-[0.18em] text-[#707782]">
                            Inventory Activity
                        </p>

                        <h2 class="mt-2 text-base font-semibold text-white">
                            All Stock Movements
                        </h2>

                        <p class="mt-1 text-xs text-[#666D78]">
                            {{ $movements->total() }}
                            {{ Str::plural('movement', $movements->total()) }}
                            recorded in this workspace.
                        </p>

                    </div>

                    <div
                        class="hidden rounded-xl border border-white/[0.05] bg-white/[0.018] px-3 py-2 text-[10px] font-medium uppercase tracking-[0.14em] text-[#707782] sm:block"
                    >
                        Live directory
                    </div>

                </div>


                @if ($movements->count())


                    {{-- ====================================================
                        DESKTOP DIRECTORY
                    ==================================================== --}}

                    <div class="relative overflow-x-auto px-3 py-3 sm:px-4 sm:py-4">

                        <div class="min-w-[1050px]">


                            {{-- =================================================
                                COLUMN HEADER

                                Grid ini SAMA PERSIS dengan grid setiap row.
                            ================================================== --}}

                            <div
                                class="grid grid-cols-[1.05fr_1.6fr_1.35fr_1fr_0.8fr_1.25fr_0.65fr] items-center px-4"
                            >

                                <div class="py-4 text-left text-[10px] font-semibold uppercase tracking-[0.16em] text-[#666D78]">
                                    Date
                                </div>

                                <div class="py-4 text-left text-[10px] font-semibold uppercase tracking-[0.16em] text-[#666D78]">
                                    Product
                                </div>

                                <div class="py-4 text-left text-[10px] font-semibold uppercase tracking-[0.16em] text-[#666D78]">
                                    Warehouse
                                </div>

                                <div class="py-4 text-left text-[10px] font-semibold uppercase tracking-[0.16em] text-[#666D78]">
                                    Type
                                </div>

                                <div class="py-4 text-left text-[10px] font-semibold uppercase tracking-[0.16em] text-[#666D78]">
                                    Quantity
                                </div>

                                <div class="py-4 text-left text-[10px] font-semibold uppercase tracking-[0.16em] text-[#666D78]">
                                    User
                                </div>

                                <div class="py-4 text-right text-[10px] font-semibold uppercase tracking-[0.16em] text-[#666D78]">
                                    Action
                                </div>

                            </div>



                            {{-- =================================================
                                MOVEMENT ROWS

                                Dikasih gap vertikal + horizontal dari border
                                luar supaya tidak menyatu.
                            ================================================== --}}

                            <div class="space-y-3 px-1 py-1">

                                @foreach ($movements as $movement)

                                    @php

                                        $typeClasses = match ($movement->type) {
                                            'purchase' => 'border-[#294333] bg-[#122019] text-[#9FE2B5]',
                                            'sale' => 'border-[#4A292C] bg-[#211517] text-[#F49A9F]',
                                            'adjustment' => 'border-[#4A3920] bg-[#211B11] text-[#E7B95C]',
                                            'transfer' => 'border-[#263B4D] bg-[#111C26] text-[#9EBFE0]',
                                            'return' => 'border-[#392D4E] bg-[#191522] text-[#B9A8E8]',
                                            default => 'border-white/[0.06] bg-white/[0.025] text-[#AEB3BB]',
                                        };

                                        $isIncoming = in_array(
                                            $movement->type,
                                            ['purchase', 'return']
                                        );

                                    @endphp


                                    <div
                                        class="group grid grid-cols-[1.05fr_1.6fr_1.35fr_1fr_0.8fr_1.25fr_0.65fr] items-center rounded-[26px] border border-white/[0.055] bg-[#171B21] px-6 py-4 transition duration-200 hover:border-white/[0.09] hover:bg-[#1A1E25]"
                                    >


                                        {{-- Date --}}

                                        <div class="min-w-0 pr-4">

                                            <p class="text-sm font-medium text-[#D9DCE1]">
                                                {{ $movement->created_at?->format('d M Y') }}
                                            </p>

                                            <p class="mt-1 text-xs text-[#666D78]">
                                                {{ $movement->created_at?->format('H:i') }}
                                            </p>

                                        </div>



                                        {{-- Product --}}

                                        <div class="min-w-0 pr-6">

                                            <p class="truncate text-sm font-semibold text-[#F5F5F2]">
                                                {{ $movement->productVariant?->product?->name ?? 'Unknown Product' }}
                                            </p>

                                            <div class="mt-1 flex min-w-0 items-center gap-2">

                                                <span class="truncate text-xs text-[#747B87]">
                                                    {{ $movement->productVariant?->name ?? 'Default' }}
                                                </span>

                                                @if ($movement->productVariant?->sku)

                                                    <span class="shrink-0 text-[#444A53]">
                                                        •
                                                    </span>

                                                    <span class="shrink-0 font-mono text-[10px] text-[#666D78]">
                                                        {{ $movement->productVariant->sku }}
                                                    </span>

                                                @endif

                                            </div>

                                        </div>



                                        {{-- Warehouse --}}

                                        <div class="min-w-0 pr-5">

                                            <div class="flex min-w-0 items-center gap-2">

                                                <span class="shrink-0 text-[#626A75]">
                                                    ▦
                                                </span>

                                                <p class="truncate text-sm text-[#C5CAD2]">
                                                    {{ $movement->warehouse?->name ?? '—' }}
                                                </p>

                                            </div>

                                            @if ($movement->warehouse?->code)

                                                <p class="mt-1 truncate pl-5 font-mono text-[10px] text-[#666D78]">
                                                    {{ $movement->warehouse->code }}
                                                </p>

                                            @endif

                                        </div>



                                        {{-- Type --}}

                                        <div class="min-w-0">

                                            <span
                                                class="inline-flex items-center gap-2 rounded-full border px-3 py-1.5 text-[11px] font-medium {{ $typeClasses }}"
                                            >

                                                <span class="h-1.5 w-1.5 shrink-0 rounded-full bg-current"></span>

                                                {{ $movement->type_label }}

                                            </span>

                                        </div>



                                        {{-- Quantity --}}

                                        <div class="min-w-0">

                                            <span
                                                class="text-sm font-semibold {{ $isIncoming ? 'text-[#9FE2B5]' : 'text-[#F49A9F]' }}"
                                            >
                                                {{ $isIncoming ? '+' : '-' }}{{ number_format(abs((int) $movement->quantity)) }}
                                            </span>

                                        </div>



                                        {{-- User --}}

                                        <div class="min-w-0 pr-5">

                                            @if ($movement->user)

                                                <div class="flex min-w-0 items-center gap-3">

                                                    <div
                                                        class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl border border-white/[0.06] bg-[#11151A] text-[10px] font-semibold text-[#AEB3BB]"
                                                    >
                                                        {{ strtoupper(substr($movement->user->name, 0, 1)) }}
                                                    </div>

                                                    <div class="min-w-0">

                                                        <p class="truncate text-sm font-medium text-[#C5CAD2]">
                                                            {{ $movement->user->name }}
                                                        </p>

                                                        <p class="truncate text-[10px] text-[#666D78]">
                                                            {{ $movement->user->email }}
                                                        </p>

                                                    </div>

                                                </div>

                                            @else

                                                <span class="inline-flex items-center gap-2 text-xs text-[#666C75]">

                                                    <span class="h-1.5 w-1.5 rounded-full bg-[#4B5563]"></span>

                                                    System

                                                </span>

                                            @endif

                                        </div>



                                        {{-- Action --}}

                                        <div class="text-right">

                                            <a
                                                href="{{ route('stock-movements.show', $movement) }}"
                                                class="inline-flex items-center gap-1.5 rounded-xl border border-white/[0.06] bg-white/[0.018] px-3 py-2 text-xs font-medium text-[#9C91FF] transition duration-200 hover:border-[#8B7CFF]/20 hover:bg-[#8B7CFF]/[0.07] hover:text-white"
                                            >
                                                View

                                                <span class="transition-transform duration-200 group-hover:translate-x-0.5">
                                                    →
                                                </span>
                                            </a>

                                        </div>

                                    </div>

                                @endforeach

                            </div>

                        </div>

                    </div>


                @else


                    {{-- ====================================================
                        EMPTY STATE
                    ==================================================== --}}

                    <div class="px-6 py-20 text-center sm:px-8">

                        <div
                            class="mx-auto flex h-16 w-16 items-center justify-center rounded-[22px] border border-[#8B7CFF]/10 bg-[#171B22] text-xl text-[#A99FFF] shadow-[0_18px_45px_rgba(0,0,0,0.18)]"
                        >
                            ◈
                        </div>

                        <h3 class="mt-5 text-sm font-semibold text-white">
                            No stock movements found
                        </h3>

                        <p class="mx-auto mt-2 max-w-sm text-sm leading-6 text-[#707782]">
                            Try changing the search or filter criteria to find another movement record.
                        </p>

                    </div>

                @endif



                {{-- ====================================================
                    PAGINATION
                ==================================================== --}}

                @if ($movements->hasPages())

                    <div class="relative border-t border-white/[0.045] px-6 py-5 sm:px-7">

                        {{ $movements->links() }}

                    </div>

                @endif

            </div>

        </div>

    </div>

</x-app-layout>