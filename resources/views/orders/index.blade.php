<x-app-layout>

    <div
        class="relative isolate overflow-hidden rounded-[48px] border border-white/[0.045] bg-[#0B0D10] px-6 py-7 text-[#F5F5F2] shadow-[0_35px_90px_rgba(0,0,0,0.22)] sm:px-8 sm:py-8 lg:px-10 lg:py-9"
    >

        {{-- ============================================================
            AMBIENT BACKGROUND
        ============================================================= --}}

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
                PAGE HEADER
            ========================================================= --}}

            <div
                class="relative flex flex-col gap-5 border-b border-white/[0.045] pb-7 lg:flex-row lg:items-end lg:justify-between"
            >

                <div>

                    <div class="flex items-center gap-3">

                        <span
                            class="inline-flex h-2 w-2 rounded-full bg-[#8B7CFF] shadow-[0_0_14px_rgba(139,124,255,0.7)]"
                        ></span>

                        <p
                            class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#A99FFF]"
                        >
                            Sales
                        </p>

                    </div>


                    <h1
                        class="mt-3 text-3xl font-semibold tracking-[-0.03em] text-white"
                    >
                        Sales Orders
                    </h1>


                    <p
                        class="mt-2 max-w-xl text-sm leading-6 text-[#8B919A]"
                    >
                        Manage customer orders, payment status, and sales activity.
                    </p>

                </div>


                <div class="flex items-center gap-3">

                    <div
                        class="hidden rounded-full border border-white/[0.06] bg-white/[0.02] px-3 py-2 text-[10px] font-medium uppercase tracking-[0.16em] text-[#707782] sm:block"
                    >
                        Sales workspace
                    </div>


                    <a
                        href="{{ route('orders.create') }}"
                        class="group inline-flex items-center gap-2 rounded-2xl bg-[#8B7CFF] px-5 py-3 text-sm font-medium text-white shadow-[0_10px_30px_rgba(139,124,255,0.18)] transition duration-200 hover:-translate-y-0.5 hover:bg-[#7C6EF0] hover:shadow-[0_14px_34px_rgba(139,124,255,0.24)]"
                    >

                        <span
                            class="text-base leading-none transition-transform duration-200 group-hover:rotate-90"
                        >
                            +
                        </span>

                        Create Sales Order

                    </a>

                </div>

            </div>


            {{-- ========================================================
                SUCCESS MESSAGE
            ========================================================= --}}

            @if (session('success'))

                <div
                    class="relative mt-6 overflow-hidden rounded-2xl border border-[#294333]/80 bg-[#111A15]/90 px-5 py-4 text-sm text-[#9FE2B5] shadow-[0_16px_45px_rgba(0,0,0,0.14)]"
                >

                    <div
                        class="absolute inset-y-0 left-0 w-1 bg-[#63D889]/70"
                    ></div>

                    <div class="flex items-center gap-3">

                        <span
                            class="flex h-7 w-7 items-center justify-center rounded-full bg-[#63D889]/10 text-[#9FE2B5]"
                        >
                            ✓
                        </span>

                        <span>
                            {{ session('success') }}
                        </span>

                    </div>

                </div>

            @endif


            {{-- ========================================================
                SUMMARY CARDS
            ========================================================= --}}

            <div class="relative mt-6 grid gap-4 md:grid-cols-3">


                {{-- ====================================================
                    TOTAL ORDERS
                ===================================================== --}}

                <div
                    class="group relative overflow-hidden rounded-[26px] border border-white/[0.055] bg-[#12151A]/90 p-5 shadow-[0_18px_55px_rgba(0,0,0,0.16)] backdrop-blur-sm transition duration-300 hover:-translate-y-0.5 hover:border-[#8B7CFF]/20"
                >

                    <div
                        class="absolute right-[-30px] top-[-35px] h-28 w-28 rounded-full bg-[#8B7CFF]/[0.08] blur-2xl transition duration-300 group-hover:bg-[#8B7CFF]/[0.12]"
                    ></div>


                    <div class="relative flex items-start justify-between gap-4">

                        <div>

                            <p
                                class="text-[10px] font-semibold uppercase tracking-[0.18em] text-[#707782]"
                            >
                                Total Orders
                            </p>

                            <p
                                class="mt-3 text-3xl font-semibold tracking-tight text-white"
                            >
                                {{ number_format($orders->count()) }}
                            </p>

                            <p
                                class="mt-2 text-xs text-[#666D78]"
                            >
                                Sales orders recorded.
                            </p>

                        </div>


                        <div
                            class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl border border-[#8B7CFF]/15 bg-[#8B7CFF]/[0.07] text-[#A99FFF]"
                        >

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
                                    d="M4 6h16M4 12h16M4 18h10"
                                />

                                <circle
                                    cx="18"
                                    cy="18"
                                    r="3"
                                />

                            </svg>

                        </div>

                    </div>

                </div>


                {{-- ====================================================
                    COMPLETED ORDERS
                ===================================================== --}}

                <div
                    class="group relative overflow-hidden rounded-[26px] border border-white/[0.055] bg-[#12151A]/90 p-5 shadow-[0_18px_55px_rgba(0,0,0,0.16)] backdrop-blur-sm transition duration-300 hover:-translate-y-0.5 hover:border-[#63D889]/20"
                >

                    <div
                        class="absolute right-[-30px] top-[-35px] h-28 w-28 rounded-full bg-[#63D889]/[0.06] blur-2xl transition duration-300 group-hover:bg-[#63D889]/[0.10]"
                    ></div>


                    <div class="relative flex items-start justify-between gap-4">

                        <div>

                            <p
                                class="text-[10px] font-semibold uppercase tracking-[0.18em] text-[#707782]"
                            >
                                Completed Orders
                            </p>

                            <p
                                class="mt-3 text-3xl font-semibold tracking-tight text-white"
                            >
                                {{ number_format($orders->where('status', 'completed')->count()) }}
                            </p>

                            <p
                                class="mt-2 text-xs text-[#666D78]"
                            >
                                Orders completed successfully.
                            </p>

                        </div>


                        <div
                            class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl border border-[#63D889]/15 bg-[#63D889]/[0.06] text-[#9FE2B5]"
                        >

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


                {{-- ====================================================
                    SALES VALUE
                ===================================================== --}}

                <div
                    class="group relative overflow-hidden rounded-[26px] border border-white/[0.055] bg-[#12151A]/90 p-5 shadow-[0_18px_55px_rgba(0,0,0,0.16)] backdrop-blur-sm transition duration-300 hover:-translate-y-0.5 hover:border-[#6F8CFF]/20"
                >

                    <div
                        class="absolute right-[-30px] top-[-35px] h-28 w-28 rounded-full bg-[#6F8CFF]/[0.06] blur-2xl transition duration-300 group-hover:bg-[#6F8CFF]/[0.10]"
                    ></div>


                    <div class="relative flex items-start justify-between gap-4">

                        <div class="min-w-0">

                            <p
                                class="text-[10px] font-semibold uppercase tracking-[0.18em] text-[#707782]"
                            >
                                Sales Value
                            </p>

                            <p
                                class="mt-3 truncate text-2xl font-semibold tracking-tight text-white"
                            >
                                Rp {{ number_format((float) $orders->sum('total'), 0, ',', '.') }}
                            </p>

                            <p
                                class="mt-2 text-xs text-[#666D78]"
                            >
                                Combined value of recorded orders.
                            </p>

                        </div>


                        <div
                            class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl border border-[#6F8CFF]/15 bg-[#6F8CFF]/[0.06] text-[#9EB6E8]"
                        >

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
                                    d="M12 3v18"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M17 7.5c0-1.4-1.8-2.5-4-2.5s-4 1.1-4 2.5 1.8 2.5 4 2.5 4 1.1 4 2.5-1.8 2.5-4 2.5-4 1.1-4 2.5 1.8 2.5 4 2.5 4-1.1 4-2.5"
                                />

                            </svg>

                        </div>

                    </div>

                </div>

            </div>


            {{-- ========================================================
                SALES DIRECTORY
            ========================================================= --}}

            <div
                class="relative mt-6 overflow-hidden rounded-[30px] border border-white/[0.055] bg-[#11151A]/95 shadow-[0_30px_80px_rgba(0,0,0,0.22)] backdrop-blur-xl"
            >

                {{-- ====================================================
                    DIRECTORY HEADER
                ===================================================== --}}

                <div
                    class="relative flex flex-col gap-4 border-b border-white/[0.045] px-6 py-5 sm:flex-row sm:items-center sm:justify-between sm:px-7"
                >

                    <div>

                        <p
                            class="text-[10px] font-semibold uppercase tracking-[0.18em] text-[#707782]"
                        >
                            Sales Directory
                        </p>

                        <h2
                            class="mt-2 text-xl font-semibold tracking-tight text-white"
                        >
                            All Orders
                        </h2>

                        <p
                            class="mt-1 text-sm text-[#666D78]"
                        >
                            {{ $orders->count() }}
                            {{ $orders->count() === 1 ? 'order' : 'orders' }}
                            recorded in this workspace.
                        </p>

                    </div>


                    <div
                        class="rounded-xl border border-white/[0.05] bg-white/[0.018] px-4 py-2.5 text-[10px] font-medium uppercase tracking-[0.16em] text-[#707782]"
                    >
                        Live Directory
                    </div>

                </div>


                @if ($orders->isEmpty())

                    {{-- =================================================
                        EMPTY STATE
                    ================================================== --}}

                    <div
                        class="flex min-h-[360px] flex-col items-center justify-center px-6 text-center"
                    >

                        <div
                            class="flex h-16 w-16 items-center justify-center rounded-[22px] border border-[#8B7CFF]/10 bg-[#171B22] text-[#A99FFF] shadow-[0_18px_45px_rgba(0,0,0,0.18)]"
                        >

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-7 w-7"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M7 4h10l2 4v10a2 2 0 01-2 2H7a2 2 0 01-2-2V8l2-4z"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M5 8h14M9 12h6"
                                />

                            </svg>

                        </div>


                        <h3
                            class="mt-5 text-sm font-semibold text-white"
                        >
                            No sales orders yet
                        </h3>


                        <p
                            class="mx-auto mt-2 max-w-sm text-sm leading-6 text-[#707782]"
                        >
                            Create your first sales order to start tracking customer purchases.
                        </p>


                        <a
                            href="{{ route('orders.create') }}"
                            class="group mt-6 inline-flex items-center gap-2 rounded-2xl bg-[#8B7CFF] px-5 py-3 text-sm font-medium text-white shadow-[0_10px_30px_rgba(139,124,255,0.18)] transition duration-200 hover:-translate-y-0.5 hover:bg-[#7C6EF0]"
                        >

                            <span
                                class="text-base leading-none transition-transform duration-200 group-hover:rotate-90"
                            >
                                +
                            </span>

                            Create Sales Order

                        </a>

                    </div>

                @else


                    {{-- =================================================
                        COLUMN HEADER
                    ================================================== --}}

                    <div class="px-4 py-4 sm:px-6">

                        <div
                            class="grid grid-cols-[minmax(0,1.35fr)_minmax(0,1.15fr)_minmax(0,1.35fr)_minmax(75px,0.8fr)_minmax(100px,1fr)_minmax(105px,1fr)_minmax(90px,0.9fr)_minmax(65px,0.65fr)] items-center gap-x-3 border-b border-white/[0.045] px-4 pb-4"
                        >

                            <div
                                class="text-[10px] font-semibold uppercase tracking-[0.18em] text-[#707782]"
                            >
                                Order
                            </div>


                            <div
                                class="text-[10px] font-semibold uppercase tracking-[0.18em] text-[#707782]"
                            >
                                Customer
                            </div>


                            <div
                                class="text-[10px] font-semibold uppercase tracking-[0.18em] text-[#707782]"
                            >
                                Warehouse
                            </div>


                            <div
                                class="text-[10px] font-semibold uppercase tracking-[0.18em] text-[#707782]"
                            >
                                Date
                            </div>


                            <div
                                class="text-[10px] font-semibold uppercase tracking-[0.18em] text-[#707782]"
                            >
                                Total
                            </div>


                            <div
                                class="text-[10px] font-semibold uppercase tracking-[0.18em] text-[#707782]"
                            >
                                Order Status
                            </div>


                            <div
                                class="text-[10px] font-semibold uppercase tracking-[0.18em] text-[#707782]"
                            >
                                Payment
                            </div>


                            <div
                                class="text-right text-[10px] font-semibold uppercase tracking-[0.18em] text-[#707782]"
                            >
                                Action
                            </div>

                        </div>


                        {{-- =================================================
                            ORDER LIST
                        ================================================== --}}

                        <div class="mt-3 space-y-3">

                            @foreach ($orders as $order)

                                @php

                                    $statusClasses = match ($order->status) {

                                        'pending' =>
                                            'border-amber-500/20 bg-amber-500/10 text-amber-300',

                                        'confirmed' =>
                                            'border-blue-500/20 bg-blue-500/10 text-blue-300',

                                        'processing' =>
                                            'border-violet-500/20 bg-violet-500/10 text-violet-300',

                                        'completed' =>
                                            'border-emerald-500/20 bg-emerald-500/10 text-emerald-300',

                                        'cancelled' =>
                                            'border-red-500/20 bg-red-500/10 text-red-300',

                                        default =>
                                            'border-white/[0.06] bg-white/[0.025] text-[#8B919A]',

                                    };


                                    $statusLabel = match ($order->status) {

                                        'pending' => 'Pending',

                                        'confirmed' => 'Confirmed',

                                        'processing' => 'Processing',

                                        'completed' => 'Completed',

                                        'cancelled' => 'Cancelled',

                                        default => ucfirst($order->status),

                                    };


                                    $paymentClasses = match ($order->payment_status) {

                                        'pending' =>
                                            'border-amber-500/20 bg-amber-500/10 text-amber-300',

                                        'paid' =>
                                            'border-emerald-500/20 bg-emerald-500/10 text-emerald-300',

                                        'failed' =>
                                            'border-red-500/20 bg-red-500/10 text-red-300',

                                        'refunded' =>
                                            'border-orange-500/20 bg-orange-500/10 text-orange-300',

                                        default =>
                                            'border-white/[0.06] bg-white/[0.025] text-[#8B919A]',

                                    };


                                    $paymentLabel = match ($order->payment_status) {

                                        'pending' => 'Pending',

                                        'paid' => 'Paid',

                                        'failed' => 'Failed',

                                        'refunded' => 'Refunded',

                                        default => ucfirst($order->payment_status),

                                    };

                                @endphp


                                {{-- =================================================
                                    ORDER CARD
                                ================================================== --}}

                                <div
                                    class="group relative overflow-hidden rounded-[22px] border border-white/[0.055] bg-[#171B22] px-4 py-4 transition duration-300 hover:border-[#8B7CFF]/20 hover:bg-[#191D25]"
                                >

                                    <div
                                        class="pointer-events-none absolute left-[-80px] top-[-100px] h-48 w-48 rounded-full bg-[#8B7CFF]/[0.035] blur-[70px] opacity-0 transition duration-300 group-hover:opacity-100"
                                    ></div>


                                    <div
                                        class="relative grid grid-cols-[minmax(0,1.35fr)_minmax(0,1.15fr)_minmax(0,1.35fr)_minmax(75px,0.8fr)_minmax(100px,1fr)_minmax(105px,1fr)_minmax(90px,0.9fr)_minmax(65px,0.65fr)] items-center gap-x-3"
                                    >


                                        {{-- =================================================
                                            ORDER
                                        ================================================== --}}

                                        <div
                                            class="flex min-w-0 items-center gap-3"
                                        >

                                            <div
                                                class="relative flex h-11 w-11 shrink-0 items-center justify-center overflow-hidden rounded-[16px] border border-[#8B7CFF]/10 bg-[#0D1117] text-xs font-semibold text-[#A99FFF] transition duration-300 group-hover:border-[#8B7CFF]/25 group-hover:bg-[#8B7CFF]/[0.07]"
                                            >

                                                <span class="relative z-10">
                                                    #
                                                </span>

                                                <span
                                                    class="absolute inset-0 bg-[radial-gradient(circle_at_30%_20%,rgba(139,124,255,0.14),transparent_55%)]"
                                                ></span>

                                            </div>


                                            <div class="min-w-0">

                                                <a
                                                    href="{{ route('orders.show', $order) }}"
                                                    class="block truncate text-sm font-semibold text-[#F5F5F2] transition duration-200 hover:text-[#A99FFF]"
                                                >
                                                    {{ $order->order_number }}
                                                </a>


                                                <p
                                                    class="mt-1 text-xs text-[#6F7681]"
                                                >
                                                    {{ $order->items->count() }}
                                                    {{ $order->items->count() === 1 ? 'item' : 'items' }}
                                                </p>

                                            </div>

                                        </div>


                                        {{-- =================================================
                                            CUSTOMER
                                        ================================================== --}}

                                        <div class="min-w-0">

                                            <p
                                                class="truncate text-sm font-semibold text-[#C5CAD2]"
                                            >
                                                {{ $order->customer->name ?? 'Unknown Customer' }}
                                            </p>

                                        </div>


                                        {{-- =================================================
                                            WAREHOUSE
                                        ================================================== --}}

                                        <div class="min-w-0">

                                            <div
                                                class="flex min-w-0 items-center gap-2"
                                            >

                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    class="h-4 w-4 shrink-0 text-[#565D67]"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke="currentColor"
                                                    stroke-width="1.8"
                                                >

                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M3 21h18M5 21V6l7-3 7 3v15M9 10h1m4 0h1m-6 4h1m4 0h1"
                                                    />

                                                </svg>


                                                <span
                                                    class="truncate text-sm text-[#C5CAD2]"
                                                >
                                                    {{ $order->warehouse->name ?? 'Unknown Warehouse' }}
                                                </span>

                                            </div>

                                        </div>


                                        {{-- =================================================
                                            DATE
                                        ================================================== --}}

                                        <div class="min-w-0">

                                            <p
                                                class="truncate whitespace-nowrap text-sm text-[#C5CAD2]"
                                            >
                                                {{ $order->ordered_at?->format('d M Y') ?? '-' }}
                                            </p>


                                            <p
                                                class="mt-0.5 text-xs text-[#626975]"
                                            >
                                                {{ $order->ordered_at?->format('H:i') ?? '' }}
                                            </p>

                                        </div>


                                        {{-- =================================================
                                            TOTAL
                                        ================================================== --}}

                                        <div class="min-w-0">

                                            <p
                                                class="truncate whitespace-nowrap text-sm font-semibold text-white"
                                            >
                                                Rp {{ number_format((float) $order->total, 0, ',', '.') }}
                                            </p>

                                        </div>


                                        {{-- =================================================
                                            ORDER STATUS
                                        ================================================== --}}

                                        <div class="min-w-0">

                                            <span
                                                class="inline-flex max-w-full items-center rounded-full border px-2.5 py-1.5 text-[10px] font-medium {{ $statusClasses }}"
                                            >

                                                @if ($order->status === 'completed')

                                                    <span
                                                        class="mr-2 h-1.5 w-1.5 shrink-0 rounded-full bg-emerald-400 shadow-[0_0_8px_rgba(52,211,153,0.7)]"
                                                    ></span>

                                                @elseif ($order->status === 'cancelled')

                                                    <span
                                                        class="mr-2 h-1.5 w-1.5 shrink-0 rounded-full bg-red-400"
                                                    ></span>

                                                @elseif ($order->status === 'processing')

                                                    <span
                                                        class="mr-2 h-1.5 w-1.5 shrink-0 rounded-full bg-violet-400"
                                                    ></span>

                                                @elseif ($order->status === 'confirmed')

                                                    <span
                                                        class="mr-2 h-1.5 w-1.5 shrink-0 rounded-full bg-blue-400"
                                                    ></span>

                                                @else

                                                    <span
                                                        class="mr-2 h-1.5 w-1.5 shrink-0 rounded-full bg-amber-400"
                                                    ></span>

                                                @endif


                                                <span class="truncate">
                                                    {{ $statusLabel }}
                                                </span>

                                            </span>

                                        </div>


                                        {{-- =================================================
                                            PAYMENT
                                        ================================================== --}}

                                        <div class="min-w-0">

                                            <span
                                                class="inline-flex max-w-full items-center rounded-full border px-2.5 py-1.5 text-[10px] font-medium {{ $paymentClasses }}"
                                            >

                                                @if ($order->payment_status === 'paid')

                                                    <span
                                                        class="mr-2 h-1.5 w-1.5 shrink-0 rounded-full bg-emerald-400 shadow-[0_0_8px_rgba(52,211,153,0.7)]"
                                                    ></span>

                                                @elseif ($order->payment_status === 'failed')

                                                    <span
                                                        class="mr-2 h-1.5 w-1.5 shrink-0 rounded-full bg-red-400"
                                                    ></span>

                                                @elseif ($order->payment_status === 'refunded')

                                                    <span
                                                        class="mr-2 h-1.5 w-1.5 shrink-0 rounded-full bg-orange-400"
                                                    ></span>

                                                @else

                                                    <span
                                                        class="mr-2 h-1.5 w-1.5 shrink-0 rounded-full bg-amber-400"
                                                    ></span>

                                                @endif


                                                <span class="truncate">
                                                    {{ $paymentLabel }}
                                                </span>

                                            </span>

                                        </div>


                                        {{-- =================================================
                                            ACTION
                                        ================================================== --}}

                                        <div
                                            class="flex justify-end"
                                        >

                                            <a
                                                href="{{ route('orders.show', $order) }}"
                                                class="inline-flex items-center gap-1.5 rounded-xl border border-white/[0.06] bg-white/[0.018] px-3 py-2 text-[10px] font-medium uppercase tracking-[0.1em] text-[#9C91FF] transition duration-200 hover:border-[#8B7CFF]/25 hover:bg-[#8B7CFF]/[0.08] hover:text-white"
                                            >

                                                View

                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    class="h-3.5 w-3.5 shrink-0 transition-transform duration-200 group-hover:translate-x-0.5"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke="currentColor"
                                                    stroke-width="1.8"
                                                >

                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M9 5l7 7-7 7"
                                                    />

                                                </svg>

                                            </a>

                                        </div>

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    </div>

                @endif

            </div>

        </div>

    </div>

</x-app-layout>