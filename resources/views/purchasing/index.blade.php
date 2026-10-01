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
                            Operations / Purchasing
                        </p>

                    </div>

                    <h1 class="mt-3 text-3xl font-semibold tracking-[-0.03em] text-white">
                        Purchasing
                    </h1>

                    <p class="mt-2 max-w-xl text-sm leading-6 text-[#8B919A]">
                        Manage purchase orders and supplier transactions.
                    </p>

                </div>


                <div class="flex flex-wrap items-center gap-3">

                    <div
                        class="hidden rounded-full border border-white/[0.06] bg-white/[0.02] px-3 py-2 text-[10px] font-medium uppercase tracking-[0.16em] text-[#707782] sm:block"
                    >
                        Procurement workspace
                    </div>


                    {{-- Manage Suppliers --}}
                    <a
                        href="{{ route('suppliers.index') }}"
                        class="group inline-flex items-center justify-center gap-2 rounded-2xl border border-white/[0.07] bg-white/[0.025] px-4 py-3 text-sm font-medium text-[#AEB4BE] transition duration-200 hover:-translate-y-0.5 hover:border-sky-400/20 hover:bg-sky-400/[0.06] hover:text-white"
                    >

                        <span
                            class="flex h-5 w-5 items-center justify-center rounded-md border border-white/[0.08] bg-white/[0.03] text-sky-300 transition duration-200 group-hover:border-sky-400/20 group-hover:bg-sky-400/[0.08]"
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
                                    d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"
                                />
                                <circle
                                    cx="9"
                                    cy="7"
                                    r="4"
                                />
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M22 21v-2a4 4 0 0 0-3-3.87"
                                />
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M16 3.13a4 4 0 0 1 0 7.75"
                                />
                            </svg>
                        </span>

                        Manage Suppliers

                        <span
                            class="text-xs text-[#626A75] transition duration-200 group-hover:translate-x-0.5 group-hover:text-sky-300"
                        >
                            →
                        </span>

                    </a>


                    <a
                        href="{{ route('purchasing.create') }}"
                        class="group inline-flex items-center justify-center gap-2 rounded-2xl bg-[#F5F5F2] px-5 py-3 text-sm font-semibold text-[#080B10] transition duration-200 hover:-translate-y-0.5 hover:bg-white"
                    >

                        <span class="text-base transition-transform duration-200 group-hover:rotate-90">
                            +
                        </span>

                        Create Purchase Order

                    </a>

                </div>

            </div>



            {{-- ========================================================
                FLASH MESSAGES
            ======================================================== --}}

            @if (session('success'))

                <div
                    class="relative mt-6 overflow-hidden rounded-[24px] border border-emerald-400/15 bg-emerald-400/[0.045] px-5 py-4 backdrop-blur-xl"
                >

                    <div
                        class="pointer-events-none absolute right-0 top-0 h-24 w-24 rounded-full bg-emerald-400/10 blur-2xl"
                    ></div>

                    <div class="relative flex items-start gap-3">

                        <div
                            class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl border border-emerald-400/15 bg-emerald-400/10 text-emerald-300"
                        >
                            ✓
                        </div>

                        <div>

                            <p class="text-sm font-medium text-emerald-300">
                                Purchase order updated
                            </p>

                            <p class="mt-1 text-xs leading-5 text-emerald-200/60">
                                {{ session('success') }}
                            </p>

                        </div>

                    </div>

                </div>

            @endif


            @if (session('error'))

                <div
                    class="relative mt-6 overflow-hidden rounded-[24px] border border-red-400/15 bg-red-400/[0.045] px-5 py-4 backdrop-blur-xl"
                >

                    <div
                        class="pointer-events-none absolute right-0 top-0 h-24 w-24 rounded-full bg-red-400/10 blur-2xl"
                    ></div>

                    <div class="relative flex items-start gap-3">

                        <div
                            class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl border border-red-400/15 bg-red-400/10 text-red-300"
                        >
                            !
                        </div>

                        <div>

                            <p class="text-sm font-medium text-red-300">
                                Purchase order action failed
                            </p>

                            <p class="mt-1 text-xs leading-5 text-red-200/60">
                                {{ session('error') }}
                            </p>

                        </div>

                    </div>

                </div>

            @endif



            {{-- ========================================================
                OVERVIEW
            ======================================================== --}}

            <div class="relative mt-6 grid gap-4 md:grid-cols-3">

                {{-- Purchase Orders --}}
                <div
                    class="group relative overflow-hidden rounded-[26px] border border-white/[0.055] bg-[#12151A]/90 p-5 shadow-[0_18px_55px_rgba(0,0,0,0.16)] backdrop-blur-sm transition duration-300 hover:-translate-y-0.5 hover:border-[#8B7CFF]/20"
                >

                    <div
                        class="absolute right-[-30px] top-[-35px] h-28 w-28 rounded-full bg-[#8B7CFF]/[0.08] blur-2xl transition duration-300 group-hover:bg-[#8B7CFF]/[0.12]"
                    ></div>

                    <div class="relative flex items-start justify-between gap-4">

                        <div>

                            <p class="text-[10px] font-semibold uppercase tracking-[0.18em] text-[#707782]">
                                Purchase Orders
                            </p>

                            <p class="mt-3 text-3xl font-semibold tracking-tight text-white">
                                {{ number_format($purchaseOrders->count()) }}
                            </p>

                            <p class="mt-2 text-xs text-[#666D78]">
                                Purchase orders in this view.
                            </p>

                        </div>

                        <div
                            class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl border border-[#8B7CFF]/15 bg-[#8B7CFF]/[0.07] text-[#A99FFF]"
                        >
                            ◈
                        </div>

                    </div>

                </div>


                {{-- Suppliers --}}
                <div
                    class="group relative overflow-hidden rounded-[26px] border border-white/[0.055] bg-[#12151A]/90 p-5 shadow-[0_18px_55px_rgba(0,0,0,0.16)] backdrop-blur-sm transition duration-300 hover:-translate-y-0.5 hover:border-sky-400/20"
                >

                    <div
                        class="absolute right-[-30px] top-[-35px] h-28 w-28 rounded-full bg-sky-400/[0.06] blur-2xl transition duration-300 group-hover:bg-sky-400/[0.10]"
                    ></div>

                    <div class="relative flex items-start justify-between gap-4">

                        <div>

                            <p class="text-[10px] font-semibold uppercase tracking-[0.18em] text-[#707782]">
                                Supplier Operations
                            </p>

                            <p class="mt-3 text-2xl font-semibold tracking-tight text-white">
                                Supplier Flow
                            </p>

                            <p class="mt-2 text-xs text-[#666D78]">
                                Manage supplier-linked purchase activity.
                            </p>

                        </div>

                        <div
                            class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl border border-sky-400/15 bg-sky-400/[0.06] text-sky-300"
                        >
                            ↗
                        </div>

                    </div>

                </div>


                {{-- Procurement --}}
                <div
                    class="group relative overflow-hidden rounded-[26px] border border-white/[0.055] bg-[#12151A]/90 p-5 shadow-[0_18px_55px_rgba(0,0,0,0.16)] backdrop-blur-sm transition duration-300 hover:-translate-y-0.5 hover:border-emerald-400/20"
                >

                    <div
                        class="absolute right-[-30px] top-[-35px] h-28 w-28 rounded-full bg-emerald-400/[0.06] blur-2xl transition duration-300 group-hover:bg-emerald-400/[0.10]"
                    ></div>

                    <div class="relative flex items-start justify-between gap-4">

                        <div>

                            <p class="text-[10px] font-semibold uppercase tracking-[0.18em] text-[#707782]">
                                Procurement
                            </p>

                            <p class="mt-3 text-2xl font-semibold tracking-tight text-white">
                                Operations
                            </p>

                            <p class="mt-2 text-xs text-[#666D78]">
                                Centralized purchasing workflow.
                            </p>

                        </div>

                        <div
                            class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl border border-emerald-400/15 bg-emerald-400/[0.06] text-emerald-300"
                        >
                            ✓
                        </div>

                    </div>

                </div>

            </div>



            {{-- ========================================================
                PURCHASE ORDER DIRECTORY
            ======================================================== --}}

            <div
                class="relative mt-6 overflow-hidden rounded-[30px] border border-white/[0.055] bg-[#11151A]/95 shadow-[0_30px_80px_rgba(0,0,0,0.22)] backdrop-blur-xl"
            >

                <div
                    class="pointer-events-none absolute right-[-60px] top-[-80px] h-64 w-64 rounded-full bg-[#8B7CFF]/[0.05] blur-3xl"
                ></div>


                {{-- Directory Header --}}
                <div
                    class="relative flex flex-col gap-3 border-b border-white/[0.045] px-6 py-5 sm:px-7 lg:flex-row lg:items-center lg:justify-between"
                >

                    <div>

                        <p class="text-[10px] font-semibold uppercase tracking-[0.18em] text-[#707782]">
                            Procurement Activity
                        </p>

                        <h2 class="mt-2 text-base font-semibold text-white">
                            All Purchase Orders
                        </h2>

                        <p class="mt-1 text-xs text-[#666D78]">
                            {{ $purchaseOrders->count() }}
                            {{ Str::plural('purchase order', $purchaseOrders->count()) }}
                            recorded in this workspace.
                        </p>

                    </div>

                    <div
                        class="hidden rounded-xl border border-white/[0.05] bg-white/[0.018] px-3 py-2 text-[10px] font-medium uppercase tracking-[0.14em] text-[#707782] sm:block"
                    >
                        Procurement Ledger
                    </div>

                </div>


                @if ($purchaseOrders->count())

                    {{-- ====================================================
                        DESKTOP DIRECTORY
                    ==================================================== --}}

                    <div class="relative overflow-x-auto p-4 sm:p-5">

                        <div
                            class="min-w-[1180px] overflow-hidden rounded-[24px] border border-white/[0.045] bg-[#0D1116]/70"
                        >

                            {{-- =================================================
                                COLUMN HEADER
                                EXPECTED / TOTAL / STATUS BALANCED
                            ================================================== --}}

                            <div
                                class="grid grid-cols-[1.15fr_1.55fr_1.35fr_0.95fr_0.95fr_1fr_0.95fr_0.75fr] items-center border-b border-white/[0.045] bg-[#10141A]/80 px-7"
                            >

                                {{-- PO Number --}}
                                <div class="min-w-0 py-4">
                                    <span
                                        class="block text-left text-[10px] font-semibold uppercase tracking-[0.16em] text-[#666D78]"
                                    >
                                        PO Number
                                    </span>
                                </div>


                                {{-- Supplier --}}
                                <div class="min-w-0 py-4">
                                    <span
                                        class="block text-left text-[10px] font-semibold uppercase tracking-[0.16em] text-[#666D78]"
                                    >
                                        Supplier
                                    </span>
                                </div>


                                {{-- Warehouse --}}
                                <div class="min-w-0 py-4">
                                    <span
                                        class="block text-left text-[10px] font-semibold uppercase tracking-[0.16em] text-[#666D78]"
                                    >
                                        Warehouse
                                    </span>
                                </div>


                                {{-- Order Date --}}
                                <div class="min-w-0 py-4">
                                    <span
                                        class="block text-left text-[10px] font-semibold uppercase tracking-[0.16em] text-[#666D78]"
                                    >
                                        Order Date
                                    </span>
                                </div>


                                {{-- Expected --}}
                                <div class="min-w-0 py-4">
                                    <span
                                        class="block text-left text-[10px] font-semibold uppercase tracking-[0.16em] text-[#666D78]"
                                    >
                                        Expected
                                    </span>
                                </div>


                                {{-- Total --}}
                                <div class="min-w-0 py-4">
                                    <span
                                        class="block text-left text-[10px] font-semibold uppercase tracking-[0.16em] text-[#666D78]"
                                    >
                                        Total
                                    </span>
                                </div>


                                {{-- Status --}}
                                <div class="min-w-0 py-4">
                                    <span
                                        class="block text-left text-[10px] font-semibold uppercase tracking-[0.16em] text-[#666D78]"
                                    >
                                        Status
                                    </span>
                                </div>


                                {{-- Action --}}
                                <div class="min-w-0 py-4">
                                    <span
                                        class="block text-left text-[10px] font-semibold uppercase tracking-[0.16em] text-[#666D78]"
                                    >
                                        Action
                                    </span>
                                </div>

                            </div>



                            {{-- =================================================
                                PURCHASE ORDER ROWS
                            ================================================== --}}

                            <div class="space-y-3 p-3">

                                @foreach ($purchaseOrders as $purchaseOrder)

                                    @php

                                        $statusClasses = match ($purchaseOrder->status) {

                                            'draft'
                                                => 'border-[#59616D]/30 bg-[#59616D]/[0.08] text-[#B7BDC7] shadow-[0_0_18px_rgba(110,118,130,0.08)]',

                                            'pending'
                                                => 'border-amber-400/20 bg-amber-400/[0.09] text-amber-300 shadow-[0_0_20px_rgba(251,191,36,0.12)]',

                                            'approved'
                                                => 'border-sky-400/20 bg-sky-400/[0.09] text-sky-300 shadow-[0_0_20px_rgba(56,189,248,0.13)]',

                                            'ordered'
                                                => 'border-violet-400/20 bg-violet-400/[0.09] text-violet-300 shadow-[0_0_22px_rgba(167,139,250,0.14)]',

                                            'received'
                                                => 'border-emerald-400/20 bg-emerald-400/[0.09] text-emerald-300 shadow-[0_0_22px_rgba(52,211,153,0.15)]',

                                            'cancelled'
                                                => 'border-rose-400/20 bg-rose-400/[0.09] text-rose-300 shadow-[0_0_20px_rgba(251,113,133,0.13)]',

                                            default
                                                => 'border-white/[0.08] bg-white/[0.035] text-[#AEB3BB] shadow-[0_0_16px_rgba(255,255,255,0.04)]',
                                        };


                                        $statusDot = match ($purchaseOrder->status) {

                                            'draft'
                                                => 'bg-[#9AA1AC] shadow-[0_0_7px_rgba(154,161,172,0.7)]',

                                            'pending'
                                                => 'bg-amber-300 shadow-[0_0_8px_rgba(252,211,77,0.9)]',

                                            'approved'
                                                => 'bg-sky-300 shadow-[0_0_8px_rgba(125,211,252,0.9)]',

                                            'ordered'
                                                => 'bg-violet-300 shadow-[0_0_8px_rgba(196,181,253,0.95)]',

                                            'received'
                                                => 'bg-emerald-300 shadow-[0_0_8px_rgba(110,231,183,0.95)]',

                                            'cancelled'
                                                => 'bg-rose-300 shadow-[0_0_8px_rgba(253,164,175,0.95)]',

                                            default
                                                => 'bg-[#8B919A] shadow-[0_0_7px_rgba(139,145,154,0.6)]',
                                        };

                                    @endphp


                                    <div
                                        class="group grid grid-cols-[1.15fr_1.55fr_1.35fr_0.95fr_0.95fr_1fr_0.95fr_0.75fr] items-center rounded-[22px] border border-white/[0.055] bg-[#171B21] px-7 py-4 transition duration-200 hover:border-white/[0.09] hover:bg-[#1A1E25]"
                                    >

                                        {{-- =================================================
                                            PO NUMBER
                                        ================================================== --}}

                                        <div class="min-w-0">
                                            <a
                                                href="{{ route('purchasing.show', $purchaseOrder) }}"
                                                class="group/po inline-flex max-w-full items-center gap-2 rounded-xl border border-transparent px-2 py-1 font-mono text-sm font-medium text-[#A99FFF] transition duration-200 hover:border-[#8B7CFF]/15 hover:bg-[#8B7CFF]/[0.05] hover:text-white"
                                            >

                                                <span
                                                    class="h-1.5 w-1.5 shrink-0 rounded-full bg-[#8B7CFF] shadow-[0_0_7px_rgba(139,124,255,0.8)]"
                                                ></span>

                                                <span class="truncate">
                                                    {{ $purchaseOrder->po_number }}
                                                </span>

                                            </a>
                                        </div>



                                        {{-- =================================================
                                            SUPPLIER
                                        ================================================== --}}

                                        <div class="min-w-0">
                                            <p class="truncate text-sm font-semibold text-[#F5F5F2]">
                                                {{ $purchaseOrder->supplier->name ?? 'Unknown Supplier' }}
                                            </p>

                                            @if ($purchaseOrder->supplier->code ?? null)

                                                <p class="mt-1 truncate font-mono text-[10px] text-[#666D78]">
                                                    {{ $purchaseOrder->supplier->code }}
                                                </p>

                                            @endif
                                        </div>



                                        {{-- =================================================
                                            WAREHOUSE
                                        ================================================== --}}

                                        <div class="min-w-0">

                                            <div class="flex min-w-0 items-center gap-2">

                                                <span class="shrink-0 text-[#626A75]">
                                                    ▦
                                                </span>

                                                <p class="truncate text-sm text-[#C5CAD2]">
                                                    {{ $purchaseOrder->warehouse->name ?? 'Unknown Warehouse' }}
                                                </p>

                                            </div>

                                            @if ($purchaseOrder->warehouse->code ?? null)

                                                <p class="mt-1 pl-5 font-mono text-[10px] text-[#666D78]">
                                                    {{ $purchaseOrder->warehouse->code }}
                                                </p>

                                            @endif

                                        </div>



                                        {{-- =================================================
                                            ORDER DATE
                                        ================================================== --}}

                                        <div class="min-w-0 whitespace-nowrap">

                                            <p class="text-sm text-[#D0D4DA]">
                                                {{ $purchaseOrder->ordered_at?->format('d M Y') ?? '—' }}
                                            </p>

                                        </div>



                                        {{-- =================================================
                                            EXPECTED
                                        ================================================== --}}

                                        <div class="min-w-0 whitespace-nowrap">

                                            <p class="text-sm text-[#D0D4DA]">
                                                {{ $purchaseOrder->expected_at?->format('d M Y') ?? '—' }}
                                            </p>

                                        </div>



                                        {{-- =================================================
                                            TOTAL
                                            SAME LEFT ANCHOR AS HEADER
                                        ================================================== --}}

                                        <div class="min-w-0">

                                            <p class="whitespace-nowrap text-left text-sm font-semibold text-[#F5F5F2]">
                                                Rp {{ number_format($purchaseOrder->total, 0, ',', '.') }}
                                            </p>

                                        </div>



                                        {{-- =================================================
                                            STATUS
                                            SAME LEFT ANCHOR AS HEADER
                                        ================================================== --}}

                                        <div class="min-w-0">

                                            <span
                                                class="inline-flex items-center gap-2 rounded-full border px-3 py-1.5 text-[11px] font-medium transition duration-200 hover:brightness-110 {{ $statusClasses }}"
                                            >

                                                <span
                                                    class="h-1.5 w-1.5 shrink-0 rounded-full {{ $statusDot }}"
                                                ></span>

                                                @switch($purchaseOrder->status)

                                                    @case('draft')
                                                        Draft
                                                        @break

                                                    @case('pending')
                                                        Pending
                                                        @break

                                                    @case('approved')
                                                        Approved
                                                        @break

                                                    @case('ordered')
                                                        Ordered
                                                        @break

                                                    @case('received')
                                                        Received
                                                        @break

                                                    @case('cancelled')
                                                        Cancelled
                                                        @break

                                                    @default
                                                        {{ $purchaseOrder->status_label }}

                                                @endswitch

                                            </span>

                                        </div>



                                        {{-- =================================================
                                            ACTION
                                            SAME LEFT ANCHOR AS HEADER
                                        ================================================== --}}

                                        <div class="min-w-0">

                                            <a
                                                href="{{ route('purchasing.show', $purchaseOrder) }}"
                                                class="inline-flex items-center gap-1.5 rounded-xl border border-white/[0.06] bg-white/[0.018] px-3 py-2 text-xs font-medium text-[#9C91FF] transition duration-200 hover:border-[#8B7CFF]/20 hover:bg-[#8B7CFF]/[0.07] hover:text-white"
                                            >

                                                View

                                                <span
                                                    class="transition-transform duration-200 group-hover:translate-x-0.5"
                                                >
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

                    <div class="p-4 sm:p-5">

                        <div
                            class="rounded-[24px] border border-white/[0.045] bg-[#0D1116]/70 px-6 py-20 text-center"
                        >

                            <div
                                class="mx-auto flex h-16 w-16 items-center justify-center rounded-[22px] border border-[#8B7CFF]/10 bg-[#171B22] text-xl text-[#A99FFF] shadow-[0_18px_45px_rgba(0,0,0,0.18)]"
                            >
                                ◈
                            </div>

                            <h3 class="mt-5 text-sm font-semibold text-white">
                                No purchase orders found
                            </h3>

                            <p class="mx-auto mt-2 max-w-sm text-sm leading-6 text-[#707782]">
                                Purchase orders created for this business will appear here.
                            </p>

                            <a
                                href="{{ route('purchasing.create') }}"
                                class="mt-5 inline-flex items-center gap-2 rounded-xl border border-white/[0.06] bg-white/[0.018] px-4 py-2.5 text-xs font-medium text-[#AEB3BB] transition duration-200 hover:border-[#8B7CFF]/20 hover:bg-[#8B7CFF]/[0.07] hover:text-white"
                            >

                                <span>+</span>

                                Create Purchase Order

                            </a>

                        </div>

                    </div>

                @endif

            </div>

        </div>

    </div>

</x-app-layout>