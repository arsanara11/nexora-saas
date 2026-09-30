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
                HEADER
            ========================================================= --}}

            <div
                class="relative flex flex-col gap-5 border-b border-white/[0.045] pb-7 lg:flex-row lg:items-end lg:justify-between"
            >

                <div>

                    <div class="flex items-center gap-3">

                        <span
                            class="inline-flex h-2 w-2 rounded-full bg-[#8B7CFF] shadow-[0_0_14px_rgba(139,124,255,0.7)]"
                        ></span>

                        <p class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#A99FFF]">
                            Sales
                        </p>

                        <span class="text-[10px] text-[#4D535E]">
                            /
                        </span>

                        <p class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#707782]">
                            Order
                        </p>

                    </div>


                    <h1 class="mt-3 text-3xl font-semibold tracking-[-0.03em] text-white">
                        {{ $order->order_number }}
                    </h1>


                    <p class="mt-2 max-w-xl text-sm leading-6 text-[#8B919A]">
                        Sales order details and transaction information.
                    </p>

                </div>


                <div class="flex flex-wrap items-center gap-3">


                    @if ($order->status === 'pending')

                        <a
                            href="{{ route('orders.edit', $order) }}"
                            class="inline-flex items-center gap-2 rounded-2xl border border-white/[0.06] bg-white/[0.02] px-4 py-3 text-sm font-medium text-[#C2C7CF] transition duration-200 hover:-translate-y-0.5 hover:border-[#8B7CFF]/20 hover:bg-white/[0.04] hover:text-white"
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

                            Edit Order

                        </a>

                    @endif


                    <a
                        href="{{ route('orders.index') }}"
                        class="inline-flex items-center gap-2 rounded-2xl border border-white/[0.06] bg-white/[0.02] px-4 py-3 text-sm font-medium text-[#A7ADB7] transition duration-200 hover:-translate-y-0.5 hover:border-white/[0.10] hover:bg-white/[0.035] hover:text-white"
                    >

                        <span>
                            ←
                        </span>

                        Back to Orders

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

                    <div class="absolute inset-y-0 left-0 w-1 bg-[#63D889]/70"></div>

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
                ORDER INFORMATION
            ========================================================= --}}

            <div class="relative mt-6 grid gap-4 md:grid-cols-3">


                {{-- Customer --}}
                <div
                    class="group relative overflow-hidden rounded-[26px] border border-white/[0.055] bg-[#12151A]/90 p-5 shadow-[0_18px_55px_rgba(0,0,0,0.16)] backdrop-blur-sm transition duration-300 hover:-translate-y-0.5 hover:border-[#8B7CFF]/20"
                >

                    <div
                        class="absolute right-[-30px] top-[-35px] h-28 w-28 rounded-full bg-[#8B7CFF]/[0.08] blur-2xl transition duration-300 group-hover:bg-[#8B7CFF]/[0.12]"
                    ></div>


                    <div class="relative flex items-start justify-between gap-4">

                        <div class="min-w-0">

                            <p class="text-[10px] font-semibold uppercase tracking-[0.18em] text-[#707782]">
                                Customer
                            </p>


                            <p class="mt-3 truncate text-base font-medium text-white">
                                {{ $order->customer->name ?? 'Unknown Customer' }}
                            </p>


                            @if ($order->customer?->email)

                                <p class="mt-1 truncate text-xs text-[#6F7681]">
                                    {{ $order->customer->email }}
                                </p>

                            @else

                                <p class="mt-1 text-xs text-[#505761]">
                                    No email available
                                </p>

                            @endif

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
                                    d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2"
                                />

                                <circle
                                    cx="9"
                                    cy="7"
                                    r="4"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M22 21v-2a4 4 0 00-3-3.87m-1-8.13a4 4 0 010 7.75"
                                />
                            </svg>

                        </div>

                    </div>

                </div>


                {{-- Warehouse --}}
                <div
                    class="group relative overflow-hidden rounded-[26px] border border-white/[0.055] bg-[#12151A]/90 p-5 shadow-[0_18px_55px_rgba(0,0,0,0.16)] backdrop-blur-sm transition duration-300 hover:-translate-y-0.5 hover:border-[#6F8CFF]/20"
                >

                    <div
                        class="absolute right-[-30px] top-[-35px] h-28 w-28 rounded-full bg-[#6F8CFF]/[0.06] blur-2xl transition duration-300 group-hover:bg-[#6F8CFF]/[0.10]"
                    ></div>


                    <div class="relative flex items-start justify-between gap-4">

                        <div class="min-w-0">

                            <p class="text-[10px] font-semibold uppercase tracking-[0.18em] text-[#707782]">
                                Warehouse
                            </p>


                            <p class="mt-3 truncate text-base font-medium text-white">
                                {{ $order->warehouse->name ?? 'Unknown Warehouse' }}
                            </p>


                            @if ($order->warehouse?->code)

                                <p class="mt-1 text-xs text-[#6F7681]">
                                    {{ $order->warehouse->code }}
                                </p>

                            @else

                                <p class="mt-1 text-xs text-[#505761]">
                                    No warehouse code
                                </p>

                            @endif

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
                                    d="M3 21h18M5 21V6l7-3 7 3v15M9 10h1m4 0h1"
                                />
                            </svg>

                        </div>

                    </div>

                </div>


                {{-- Order Date --}}
                <div
                    class="group relative overflow-hidden rounded-[26px] border border-white/[0.055] bg-[#12151A]/90 p-5 shadow-[0_18px_55px_rgba(0,0,0,0.16)] backdrop-blur-sm transition duration-300 hover:-translate-y-0.5 hover:border-[#63D889]/20"
                >

                    <div
                        class="absolute right-[-30px] top-[-35px] h-28 w-28 rounded-full bg-[#63D889]/[0.05] blur-2xl transition duration-300 group-hover:bg-[#63D889]/[0.09]"
                    ></div>


                    <div class="relative flex items-start justify-between gap-4">

                        <div>

                            <p class="text-[10px] font-semibold uppercase tracking-[0.18em] text-[#707782]">
                                Order Date
                            </p>


                            <p class="mt-3 text-base font-medium text-white">
                                {{ $order->ordered_at?->format('d M Y') ?? '-' }}
                            </p>


                            <p class="mt-1 text-xs text-[#6F7681]">
                                {{ $order->ordered_at?->format('H:i') ?? 'No time recorded' }}
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
                                <circle
                                    cx="12"
                                    cy="12"
                                    r="8.5"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 7v5l3.5 2"
                                />
                            </svg>

                        </div>

                    </div>

                </div>

            </div>


            {{-- ========================================================
                STATUS
            ========================================================= --}}

            <div class="relative mt-6 grid gap-4 lg:grid-cols-2">


                {{-- Order Status --}}
                <div
                    class="relative overflow-hidden rounded-[30px] border border-white/[0.055] bg-[#11151A]/95 p-6 shadow-[0_25px_65px_rgba(0,0,0,0.18)] backdrop-blur-xl"
                >

                    <div class="absolute -right-20 -top-20 h-44 w-44 rounded-full bg-[#8B7CFF]/[0.04] blur-3xl"></div>


                    <div class="relative flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">

                        <div>

                            <p class="text-[10px] font-semibold uppercase tracking-[0.18em] text-[#707782]">
                                Order Status
                            </p>


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

                            @endphp


                            <span
                                class="mt-3 inline-flex items-center rounded-full border px-3 py-1.5 text-[11px] font-medium {{ $statusClasses }}"
                            >

                                @if ($order->status === 'completed')

                                    <span class="mr-2 h-1.5 w-1.5 rounded-full bg-emerald-400 shadow-[0_0_8px_rgba(52,211,153,0.7)]"></span>

                                @elseif ($order->status === 'cancelled')

                                    <span class="mr-2 h-1.5 w-1.5 rounded-full bg-red-400"></span>

                                @elseif ($order->status === 'processing')

                                    <span class="mr-2 h-1.5 w-1.5 rounded-full bg-violet-400"></span>

                                @elseif ($order->status === 'confirmed')

                                    <span class="mr-2 h-1.5 w-1.5 rounded-full bg-blue-400"></span>

                                @else

                                    <span class="mr-2 h-1.5 w-1.5 rounded-full bg-amber-400"></span>

                                @endif

                                {{ $statusLabel }}

                            </span>

                        </div>


                        @if ($order->status !== 'completed' && $order->status !== 'cancelled')

                            <form
                                action="{{ route('orders.status', $order) }}"
                                method="POST"
                                class="w-full sm:w-auto"
                            >

                                @csrf
                                @method('PATCH')


                                @if ($order->status === 'pending')

                                    <select
                                        name="status"
                                        onchange="this.form.submit()"
                                        class="w-full rounded-xl border border-white/[0.06] bg-[#0B0D10] px-3 py-2.5 text-xs text-[#F5F5F2] outline-none transition focus:border-[#8B7CFF]/50 focus:ring-1 focus:ring-[#8B7CFF]/15 sm:w-auto"
                                    >

                                        <option value="">
                                            Update
                                        </option>

                                        <option value="confirmed">
                                            Confirmed
                                        </option>

                                        <option value="cancelled">
                                            Cancelled
                                        </option>

                                    </select>


                                @elseif ($order->status === 'confirmed')

                                    <select
                                        name="status"
                                        onchange="this.form.submit()"
                                        class="w-full rounded-xl border border-white/[0.06] bg-[#0B0D10] px-3 py-2.5 text-xs text-[#F5F5F2] outline-none transition focus:border-[#8B7CFF]/50 focus:ring-1 focus:ring-[#8B7CFF]/15] sm:w-auto"
                                    >

                                        <option value="">
                                            Update
                                        </option>

                                        <option value="processing">
                                            Processing
                                        </option>

                                        <option value="cancelled">
                                            Cancelled
                                        </option>

                                    </select>


                                @elseif ($order->status === 'processing')

                                    <select
                                        name="status"
                                        onchange="this.form.submit()"
                                        class="w-full rounded-xl border border-white/[0.06] bg-[#0B0D10] px-3 py-2.5 text-xs text-[#F5F5F2] outline-none transition focus:border-[#8B7CFF]/50 focus:ring-1 focus:ring-[#8B7CFF]/15 sm:w-auto"
                                    >

                                        <option value="">
                                            Update
                                        </option>

                                        <option value="completed">
                                            Completed
                                        </option>

                                        <option value="cancelled">
                                            Cancelled
                                        </option>

                                    </select>

                                @endif

                            </form>

                        @endif

                    </div>

                </div>


                {{-- Payment Status --}}
                <div
                    class="relative overflow-hidden rounded-[30px] border border-white/[0.055] bg-[#11151A]/95 p-6 shadow-[0_25px_65px_rgba(0,0,0,0.18)] backdrop-blur-xl"
                >

                    <div class="absolute -right-20 -top-20 h-44 w-44 rounded-full bg-[#6F8CFF]/[0.04] blur-3xl"></div>


                    <div class="relative flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">

                        <div>

                            <p class="text-[10px] font-semibold uppercase tracking-[0.18em] text-[#707782]">
                                Payment Status
                            </p>


                            @php

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


                            <span
                                class="mt-3 inline-flex items-center rounded-full border px-3 py-1.5 text-[11px] font-medium {{ $paymentClasses }}"
                            >

                                @if ($order->payment_status === 'paid')

                                    <span class="mr-2 h-1.5 w-1.5 rounded-full bg-emerald-400 shadow-[0_0_8px_rgba(52,211,153,0.7)]"></span>

                                @elseif ($order->payment_status === 'failed')

                                    <span class="mr-2 h-1.5 w-1.5 rounded-full bg-red-400"></span>

                                @elseif ($order->payment_status === 'refunded')

                                    <span class="mr-2 h-1.5 w-1.5 rounded-full bg-orange-400"></span>

                                @else

                                    <span class="mr-2 h-1.5 w-1.5 rounded-full bg-amber-400"></span>

                                @endif

                                {{ $paymentLabel }}

                            </span>

                        </div>


                        @if ($order->payment_status !== 'refunded')

                            <form
                                action="{{ route('orders.payment.status', $order) }}"
                                method="POST"
                                class="w-full sm:w-auto"
                            >

                                @csrf
                                @method('PATCH')

                                <select
                                    name="payment_status"
                                    onchange="this.form.submit()"
                                    class="w-full rounded-xl border border-white/[0.06] bg-[#0B0D10] px-3 py-2.5 text-xs text-[#F5F5F2] outline-none transition focus:border-[#8B7CFF]/50 focus:ring-1 focus:ring-[#8B7CFF]/15 sm:w-auto"
                                >

                                    <option value="">
                                        Update
                                    </option>


                                    @if ($order->payment_status === 'pending')

                                        <option value="paid">
                                            Paid
                                        </option>

                                        <option value="failed">
                                            Failed
                                        </option>


                                    @elseif ($order->payment_status === 'paid')

                                        <option value="refunded">
                                            Refunded
                                        </option>


                                    @elseif ($order->payment_status === 'failed')

                                        <option value="pending">
                                            Pending
                                        </option>

                                        <option value="paid">
                                            Paid
                                        </option>

                                    @endif

                                </select>

                            </form>

                        @endif

                    </div>

                </div>

            </div>


            {{-- ========================================================
                ORDER ITEMS DIRECTORY
            ========================================================= --}}

            <div
                class="relative mt-6 overflow-hidden rounded-[30px] border border-white/[0.055] bg-[#11151A]/95 shadow-[0_30px_80px_rgba(0,0,0,0.22)] backdrop-blur-xl"
            >

                {{-- Directory Header --}}
                <div
                    class="relative flex flex-col gap-4 border-b border-white/[0.045] px-6 py-5 sm:flex-row sm:items-center sm:justify-between sm:px-7"
                >

                    <div>

                        <p class="text-[10px] font-semibold uppercase tracking-[0.18em] text-[#707782]">
                            Order directory
                        </p>

                        <h2 class="mt-2 text-base font-semibold text-white">
                            Order Items
                        </h2>

                        <p class="mt-1 text-xs text-[#666D78]">
                            {{ $order->items->count() }}
                            {{ $order->items->count() === 1 ? 'item' : 'items' }}
                            in this sales order.
                        </p>

                    </div>


                    <div
                        class="rounded-xl border border-white/[0.05] bg-white/[0.018] px-3 py-2 text-[10px] font-medium uppercase tracking-[0.14em] text-[#707782]"
                    >
                        Order details
                    </div>

                </div>


                <div class="overflow-x-auto">

                    <table class="min-w-full">

                        <thead>

                            <tr class="border-b border-white/[0.045] text-left">

                                <th
                                    class="whitespace-nowrap px-6 py-4 text-[10px] font-semibold uppercase tracking-[0.16em] text-[#666D78] sm:px-7"
                                >
                                    Product
                                </th>

                                <th
                                    class="whitespace-nowrap px-6 py-4 text-[10px] font-semibold uppercase tracking-[0.16em] text-[#666D78]"
                                >
                                    SKU
                                </th>

                                <th
                                    class="whitespace-nowrap px-6 py-4 text-right text-[10px] font-semibold uppercase tracking-[0.16em] text-[#666D78]"
                                >
                                    Qty
                                </th>

                                <th
                                    class="whitespace-nowrap px-6 py-4 text-right text-[10px] font-semibold uppercase tracking-[0.16em] text-[#666D78]"
                                >
                                    Unit Price
                                </th>

                                <th
                                    class="whitespace-nowrap px-6 py-4 text-right text-[10px] font-semibold uppercase tracking-[0.16em] text-[#666D78]"
                                >
                                    Discount
                                </th>

                                <th
                                    class="whitespace-nowrap px-6 py-4 text-right text-[10px] font-semibold uppercase tracking-[0.16em] text-[#666D78]"
                                >
                                    Total
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y divide-white/[0.035]">

                            @foreach ($order->items as $item)

                                <tr class="group transition duration-200 hover:bg-white/[0.018]">


                                    {{-- Product --}}
                                    <td class="whitespace-nowrap px-6 py-5 sm:px-7">

                                        <div class="flex items-center gap-4">

                                            <div
                                                class="relative flex h-11 w-11 shrink-0 items-center justify-center overflow-hidden rounded-2xl border border-[#8B7CFF]/10 bg-[#171B22] text-xs font-semibold text-[#A99FFF] transition duration-200 group-hover:border-[#8B7CFF]/25 group-hover:bg-[#8B7CFF]/[0.07]"
                                            >

                                                <span class="relative z-10">
                                                    {{ strtoupper(substr($item->product_name, 0, 1)) }}
                                                </span>

                                                <span
                                                    class="absolute inset-0 bg-[radial-gradient(circle_at_30%_20%,rgba(139,124,255,0.14),transparent_55%)]"
                                                ></span>

                                            </div>


                                            <div class="min-w-0">

                                                <p class="max-w-[280px] truncate text-sm font-medium text-[#F5F5F2]">
                                                    {{ $item->product_name }}
                                                </p>

                                                <p class="mt-1 text-xs text-[#6F7681]">
                                                    Line item
                                                </p>

                                            </div>

                                        </div>

                                    </td>


                                    {{-- SKU --}}
                                    <td class="whitespace-nowrap px-6 py-5">

                                        @if ($item->sku)

                                            <span class="rounded-lg border border-white/[0.04] bg-white/[0.015] px-2.5 py-1.5 font-mono text-xs text-[#9299A5]">
                                                {{ $item->sku }}
                                            </span>

                                        @else

                                            <span class="text-sm text-[#505761]">
                                                —
                                            </span>

                                        @endif

                                    </td>


                                    {{-- Quantity --}}
                                    <td class="whitespace-nowrap px-6 py-5 text-right">

                                        <span class="inline-flex min-w-8 items-center justify-center rounded-lg border border-white/[0.05] bg-white/[0.018] px-2.5 py-1 text-xs font-medium text-[#C5CAD2]">
                                            {{ $item->quantity }}
                                        </span>

                                    </td>


                                    {{-- Unit Price --}}
                                    <td class="whitespace-nowrap px-6 py-5 text-right">

                                        <span class="text-sm text-[#C5CAD2]">
                                            Rp {{ number_format((float) $item->unit_price, 0, ',', '.') }}
                                        </span>

                                    </td>


                                    {{-- Discount --}}
                                    <td class="whitespace-nowrap px-6 py-5 text-right">

                                        <span class="text-sm text-[#8B919A]">
                                            Rp {{ number_format((float) $item->discount, 0, ',', '.') }}
                                        </span>

                                    </td>


                                    {{-- Total --}}
                                    <td class="whitespace-nowrap px-6 py-5 text-right">

                                        <span class="text-sm font-medium text-white">
                                            Rp {{ number_format((float) $item->total, 0, ',', '.') }}
                                        </span>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>


            {{-- ========================================================
                NOTES + SUMMARY
            ========================================================= --}}

            <div class="relative mt-6 grid gap-4 lg:grid-cols-2">


                {{-- Notes --}}
                <div
                    class="relative overflow-hidden rounded-[30px] border border-white/[0.055] bg-[#11151A]/95 shadow-[0_25px_65px_rgba(0,0,0,0.18)] backdrop-blur-xl"
                >

                    <div class="absolute -right-20 -top-20 h-44 w-44 rounded-full bg-[#8B7CFF]/[0.035] blur-3xl"></div>


                    <div class="relative">

                        <div class="border-b border-white/[0.045] px-6 py-5 sm:px-7">

                            <p class="text-[10px] font-semibold uppercase tracking-[0.18em] text-[#707782]">
                                Order context
                            </p>

                            <h2 class="mt-2 text-base font-semibold text-white">
                                Notes
                            </h2>

                        </div>


                        <div class="min-h-[180px] p-6 sm:p-7">

                            @if ($order->notes)

                                <p class="whitespace-pre-line text-sm leading-7 text-[#B4BAC4]">
                                    {{ $order->notes }}
                                </p>

                            @else

                                <div class="flex h-full min-h-[120px] items-center">

                                    <p class="text-sm text-[#555C67]">
                                        No notes added to this order.
                                    </p>

                                </div>

                            @endif

                        </div>

                    </div>

                </div>


                {{-- Summary --}}
                <div
                    class="relative overflow-hidden rounded-[30px] border border-white/[0.055] bg-[#11151A]/95 shadow-[0_25px_65px_rgba(0,0,0,0.18)] backdrop-blur-xl"
                >

                    <div class="absolute -right-20 -top-20 h-44 w-44 rounded-full bg-[#6F8CFF]/[0.035] blur-3xl"></div>


                    <div class="relative">

                        <div class="border-b border-white/[0.045] px-6 py-5 sm:px-7">

                            <p class="text-[10px] font-semibold uppercase tracking-[0.18em] text-[#707782]">
                                Transaction
                            </p>

                            <h2 class="mt-2 text-base font-semibold text-white">
                                Order Summary
                            </h2>

                        </div>


                        <div class="space-y-4 p-6 sm:p-7">

                            <div class="flex items-center justify-between">

                                <span class="text-sm text-[#8B919A]">
                                    Subtotal
                                </span>

                                <span class="text-sm text-[#C5CAD2]">
                                    Rp {{ number_format((float) $order->subtotal, 0, ',', '.') }}
                                </span>

                            </div>


                            <div class="flex items-center justify-between">

                                <span class="text-sm text-[#8B919A]">
                                    Discount
                                </span>

                                <span class="text-sm text-[#C5CAD2]">
                                    Rp {{ number_format((float) $order->discount, 0, ',', '.') }}
                                </span>

                            </div>


                            <div class="flex items-center justify-between">

                                <span class="text-sm text-[#8B919A]">
                                    Tax
                                </span>

                                <span class="text-sm text-[#C5CAD2]">
                                    Rp {{ number_format((float) $order->tax, 0, ',', '.') }}
                                </span>

                            </div>


                            <div class="flex items-center justify-between">

                                <span class="text-sm text-[#8B919A]">
                                    Shipping
                                </span>

                                <span class="text-sm text-[#C5CAD2]">
                                    Rp {{ number_format((float) $order->shipping_cost, 0, ',', '.') }}
                                </span>

                            </div>


                            <div class="border-t border-white/[0.045] pt-5">

                                <div class="flex items-center justify-between">

                                    <span class="text-sm font-semibold text-[#F5F5F2]">
                                        Total
                                    </span>

                                    <span class="text-xl font-semibold tracking-[-0.02em] text-white">
                                        Rp {{ number_format((float) $order->total, 0, ',', '.') }}
                                    </span>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- ========================================================
                DELETE ZONE
            ========================================================= --}}

            @if ($order->status === 'pending')

                <div
                    class="relative mt-6 overflow-hidden rounded-[26px] border border-red-500/[0.12] bg-[#11151A]/95 p-6 shadow-[0_22px_55px_rgba(0,0,0,0.16)]"
                >

                    <div class="absolute -right-20 -top-20 h-40 w-40 rounded-full bg-red-500/[0.025] blur-3xl"></div>


                    <div class="relative flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">

                        <div>

                            <p class="text-[10px] font-semibold uppercase tracking-[0.18em] text-red-300/60">
                                Danger zone
                            </p>

                            <h2 class="mt-2 text-sm font-semibold text-[#F5F5F2]">
                                Delete Sales Order
                            </h2>

                            <p class="mt-1 max-w-xl text-xs leading-5 text-[#8B919A]">
                                This action permanently removes this pending order.
                            </p>

                        </div>


                        <form
                            action="{{ route('orders.destroy', $order) }}"
                            method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this sales order?');"
                        >

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="inline-flex items-center gap-2 rounded-xl border border-red-500/15 bg-red-500/[0.04] px-4 py-2.5 text-sm font-medium text-red-300 transition duration-200 hover:border-red-500/25 hover:bg-red-500/[0.08] hover:text-red-200"
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
                                        d="M3 6h18"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M8 6V4h8v2"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M19 6l-1 14H6L5 6"
                                    />
                                </svg>

                                Delete Order

                            </button>

                        </form>

                    </div>

                </div>

            @endif

        </div>

    </div>

</x-app-layout>