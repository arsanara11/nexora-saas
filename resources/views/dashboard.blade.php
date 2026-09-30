<x-app-layout>

    <style>
        .nexora-dashboard {
            position: relative;
            isolation: isolate;
        }

        .nexora-dashboard::before,
        .nexora-dashboard::after {
            content: "";
            position: fixed;
            pointer-events: none;
            z-index: -1;
            border-radius: 9999px;
            filter: blur(80px);
            opacity: 0.22;
        }

        .nexora-dashboard::before {
            width: 520px;
            height: 520px;
            top: 110px;
            right: 3%;
            background: radial-gradient(circle, rgba(139, 124, 255, 0.42) 0%, rgba(139, 124, 255, 0) 70%);
        }

        .nexora-dashboard::after {
            width: 420px;
            height: 420px;
            left: 8%;
            bottom: 5%;
            background: radial-gradient(circle, rgba(76, 132, 255, 0.18) 0%, rgba(76, 132, 255, 0) 72%);
        }

        .nx-surface {
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(58, 64, 74, 0.72);
            background:
                linear-gradient(145deg, rgba(20, 24, 32, 0.96), rgba(12, 15, 21, 0.92));
            box-shadow:
                0 24px 70px rgba(0, 0, 0, 0.24),
                inset 0 1px 0 rgba(255, 255, 255, 0.025);
            backdrop-filter: blur(18px);
        }

        .nx-surface-soft {
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(58, 64, 74, 0.58);
            background:
                linear-gradient(145deg, rgba(22, 26, 34, 0.82), rgba(12, 15, 21, 0.72));
            box-shadow:
                0 20px 55px rgba(0, 0, 0, 0.18),
                inset 0 1px 0 rgba(255, 255, 255, 0.02);
            backdrop-filter: blur(16px);
        }

        .nx-glow-purple {
            box-shadow:
                0 24px 70px rgba(0, 0, 0, 0.28),
                0 0 55px rgba(139, 124, 255, 0.10),
                inset 0 1px 0 rgba(255, 255, 255, 0.03);
        }

        .nx-glow-blue {
            box-shadow:
                0 24px 70px rgba(0, 0, 0, 0.28),
                0 0 55px rgba(76, 132, 255, 0.08),
                inset 0 1px 0 rgba(255, 255, 255, 0.03);
        }

        .nx-noise {
            background-image:
                radial-gradient(rgba(255,255,255,0.028) 0.65px, transparent 0.65px);
            background-size: 7px 7px;
            opacity: 0.09;
            mix-blend-mode: screen;
        }

        .nx-chip {
            border: 1px solid rgba(58, 64, 74, 0.65);
            background: rgba(9, 12, 17, 0.58);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.02);
            backdrop-filter: blur(12px);
        }

        .nx-kpi {
            transition:
                transform 180ms ease,
                border-color 180ms ease,
                box-shadow 180ms ease,
                background 180ms ease;
        }

        .nx-kpi:hover {
            transform: translateY(-3px);
            border-color: rgba(139, 124, 255, 0.35);
            box-shadow:
                0 18px 45px rgba(0, 0, 0, 0.26),
                0 0 34px rgba(139, 124, 255, 0.08);
        }

        .nx-action {
            transition:
                transform 180ms ease,
                border-color 180ms ease,
                background 180ms ease;
        }

        .nx-action:hover {
            transform: translateY(-2px);
            border-color: rgba(139, 124, 255, 0.34);
            background:
                linear-gradient(145deg, rgba(29, 25, 51, 0.88), rgba(15, 19, 26, 0.92));
        }

        .nx-fade-edge {
            position: absolute;
            inset: auto 0 0 0;
            height: 48%;
            background: linear-gradient(to top, rgba(8, 11, 16, 0.92), transparent);
            pointer-events: none;
        }

        @media (prefers-reduced-motion: reduce) {
            .nx-kpi,
            .nx-action {
                transition: none !important;
            }

            .nx-kpi:hover,
            .nx-action:hover {
                transform: none !important;
            }
        }
    </style>

    <div class="nexora-dashboard space-y-8">

        {{-- ============================================================ --}}
        {{-- HERO --}}
        {{-- ============================================================ --}}

        <section class="grid gap-5 xl:grid-cols-[minmax(0,1.55fr)_minmax(300px,0.75fr)]">

            {{-- Main hero --}}
            <div class="nx-surface nx-glow-purple rounded-[26px] p-6 sm:p-8">

                <div class="nx-noise absolute inset-0"></div>

                <div class="absolute -right-20 -top-24 h-72 w-72 rounded-full bg-[#8B7CFF]/10 blur-3xl"></div>
                <div class="absolute -bottom-24 left-16 h-56 w-56 rounded-full bg-[#4C84FF]/8 blur-3xl"></div>

                <div class="relative">

                    <div class="flex flex-col gap-5 sm:flex-row sm:items-start sm:justify-between">

                        <div class="max-w-2xl">

                            <div class="flex flex-wrap items-center gap-2">
                                <span class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#9C91FF]">
                                    Overview
                                </span>

                                <span class="nx-chip rounded-full px-2.5 py-1 text-[9px] uppercase tracking-[0.14em] text-[#7F8692]">
                                    Live workspace
                                </span>
                            </div>

                            <h1 class="mt-3 text-3xl font-semibold tracking-tight text-[#F5F5F2] sm:text-4xl">
                                Business Dashboard
                            </h1>

                            <p class="mt-3 max-w-xl text-sm leading-6 text-[#8B919A]">
                                Monitor your business performance, sales activity, customer operations, and inventory health from one place.
                            </p>

                        </div>

                        <div class="shrink-0 text-left sm:text-right">

                            <p class="text-[10px] font-semibold uppercase tracking-[0.18em] text-[#666C75]">
                                Today
                            </p>

                            <p class="mt-2 text-sm font-medium text-[#D5D8DE]">
                                {{ now()->format('d M Y') }}
                            </p>

                        </div>

                    </div>


                    <div class="mt-8 grid gap-4 sm:grid-cols-3">

                        {{-- Sales pulse --}}
                        <div class="rounded-2xl border border-[#343946] bg-white/[0.025] p-4 shadow-[inset_0_1px_0_rgba(255,255,255,0.03)]">
                            <div class="flex items-center justify-between">
                                <span class="text-[10px] font-semibold uppercase tracking-[0.15em] text-[#707782]">
                                    Revenue pulse
                                </span>

                                <span class="flex h-8 w-8 items-center justify-center rounded-xl bg-[#8B7CFF]/10 text-[#A99FFF]">
                                    ↗
                                </span>
                            </div>

                            <p class="mt-4 text-2xl font-semibold tracking-tight text-[#F5F5F2]">
                                Rp {{ number_format($totalSales, 0, ',', '.') }}
                            </p>

                            <p class="mt-1 text-xs text-[#6F7680]">
                                Completed sales
                            </p>
                        </div>


                        {{-- Orders --}}
                        <div class="rounded-2xl border border-[#343946] bg-white/[0.02] p-4 shadow-[inset_0_1px_0_rgba(255,255,255,0.02)]">
                            <div class="flex items-center justify-between">
                                <span class="text-[10px] font-semibold uppercase tracking-[0.15em] text-[#707782]">
                                    Sales flow
                                </span>

                                <span class="flex h-8 w-8 items-center justify-center rounded-xl bg-[#151D29] text-[#9EB6E8]">
                                    ◈
                                </span>
                            </div>

                            <p class="mt-4 text-2xl font-semibold tracking-tight text-[#F5F5F2]">
                                {{ number_format($totalOrders) }}
                            </p>

                            <p class="mt-1 text-xs text-[#6F7680]">
                                Total sales orders
                            </p>
                        </div>


                        {{-- Customers --}}
                        <div class="rounded-2xl border border-[#343946] bg-white/[0.02] p-4 shadow-[inset_0_1px_0_rgba(255,255,255,0.02)]">
                            <div class="flex items-center justify-between">
                                <span class="text-[10px] font-semibold uppercase tracking-[0.15em] text-[#707782]">
                                    Customer base
                                </span>

                                <span class="flex h-8 w-8 items-center justify-center rounded-xl bg-[#16201D] text-[#9FE2B5]">
                                    ♙
                                </span>
                            </div>

                            <p class="mt-4 text-2xl font-semibold tracking-tight text-[#F5F5F2]">
                                {{ number_format($totalCustomers) }}
                            </p>

                            <p class="mt-1 text-xs text-[#6F7680]">
                                Customer accounts
                            </p>
                        </div>

                    </div>

                </div>

            </div>


            {{-- Low stock hero --}}
            <div class="nx-surface-soft nx-glow-blue rounded-[26px] p-6">

                <div class="absolute -right-12 -top-16 h-44 w-44 rounded-full bg-[#D9C57A]/8 blur-3xl"></div>

                <div class="relative flex h-full flex-col justify-between">

                    <div>

                        <div class="flex items-center justify-between">

                            <div>
                                <p class="text-[10px] font-semibold uppercase tracking-[0.18em] text-[#707782]">
                                    Attention
                                </p>

                                <h2 class="mt-2 text-lg font-semibold text-[#F5F5F2]">
                                    Inventory Watch
                                </h2>
                            </div>

                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#241D16] text-[#D9C57A]">
                                !
                            </div>

                        </div>

                        <div class="mt-7 flex items-end justify-between gap-4">

                            <div>
                                <p class="text-5xl font-semibold tracking-tight text-[#F5F5F2]">
                                    {{ $lowStockItems->count() }}
                                </p>

                                <p class="mt-2 text-sm text-[#8B919A]">
                                    item{{ $lowStockItems->count() === 1 ? '' : 's' }} require attention
                                </p>
                            </div>

                            <span class="nx-chip rounded-full px-3 py-1.5 text-[10px] font-medium text-[#D9A66F]">
                                Stock alert
                            </span>

                        </div>

                    </div>

                    <div class="mt-8">

                        <a
                            href="{{ route('inventory.index') }}"
                            class="group inline-flex w-full items-center justify-between rounded-2xl border border-[#303640] bg-[#0B0D10]/60 px-4 py-3 text-sm text-[#C2C7CF] transition hover:border-[#8B7CFF]/35 hover:text-white"
                        >
                            <span>Review inventory</span>

                            <span class="text-[#6F7680] transition group-hover:translate-x-0.5 group-hover:text-[#A99FFF]">
                                →
                            </span>
                        </a>

                    </div>

                </div>

            </div>

        </section>


        {{-- ============================================================ --}}
        {{-- ANALYTICS --}}
        {{-- ============================================================ --}}

        <section class="grid gap-5 xl:grid-cols-[minmax(0,1.68fr)_minmax(330px,0.72fr)]">

            {{-- Sales Overview --}}
            <div class="nx-surface nx-glow-purple rounded-[26px] p-1">

                <div class="relative overflow-hidden rounded-[22px] bg-[#0C1016]/82">

                    <div class="pointer-events-none absolute inset-x-0 top-0 h-44 bg-[radial-gradient(circle_at_42%_0%,rgba(139,124,255,0.14),transparent_62%)]"></div>
                    <div class="pointer-events-none absolute -right-24 top-12 h-64 w-64 rounded-full bg-[#6F61FF]/10 blur-3xl"></div>
                    <div class="pointer-events-none absolute left-16 top-32 h-40 w-40 rounded-full bg-[#5F86FF]/6 blur-3xl"></div>

                    <div class="relative flex flex-col gap-5 px-6 pb-5 pt-6 sm:px-7">

                        <div class="flex items-start justify-between gap-5">

                            <div>

                                <div class="flex items-center gap-2">
                                    <span class="h-2 w-2 rounded-full bg-[#A99FFF] shadow-[0_0_14px_rgba(169,159,255,0.95)]"></span>

                                    <p class="text-[10px] font-semibold uppercase tracking-[0.2em] text-[#858C98]">
                                        Performance
                                    </p>
                                </div>

                                <h2 class="mt-2 text-xl font-semibold tracking-tight text-[#F5F5F2]">
                                    Sales Overview
                                </h2>

                                <p class="mt-1 max-w-xl text-xs leading-5 text-[#717984]">
                                    Completed sales performance over time.
                                </p>

                            </div>

                            <div class="flex items-center gap-2">

                                <div class="hidden rounded-xl border border-[#2B3140] bg-white/[0.025] px-3 py-2 sm:block">
                                    <p class="text-[9px] uppercase tracking-[0.15em] text-[#626A76]">
                                        Completed sales
                                    </p>
                                    <p class="mt-1 text-sm font-semibold text-[#F5F5F2]">
                                        Rp {{ number_format($totalSales, 0, ',', '.') }}
                                    </p>
                                </div>

                                <span class="rounded-xl border border-[#313747] bg-[#121825] px-3 py-2 text-[10px] uppercase tracking-[0.14em] text-[#9FA7B5] shadow-[inset_0_1px_0_rgba(255,255,255,0.04)]">
                                    Last 30 days
                                </span>

                            </div>

                        </div>


                        <div class="relative overflow-hidden rounded-[20px] border border-[#292F3A] bg-[linear-gradient(180deg,rgba(24,29,40,0.86),rgba(10,14,20,0.74))] p-3 shadow-[inset_0_1px_0_rgba(255,255,255,0.035),0_16px_45px_rgba(0,0,0,0.18)] sm:p-4">

                            <div class="pointer-events-none absolute inset-x-0 bottom-0 h-36 bg-[linear-gradient(180deg,transparent,rgba(139,124,255,0.035))]"></div>

                            <div class="relative h-[300px] sm:h-[330px]">
                                <canvas id="salesChart"></canvas>
                            </div>

                            <div class="relative mt-2 flex items-center justify-between px-1">
                                <div class="flex items-center gap-2 text-[10px] text-[#6C7480]">
                                    <span class="h-1.5 w-1.5 rounded-full bg-[#8B7CFF]"></span>
                                    <span>Sales</span>
                                </div>

                                <span class="text-[10px] text-[#555D68]">
                                    Daily completed sales
                                </span>
                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- Order Status --}}
            <div class="nx-surface nx-glow-blue rounded-[26px] p-1">

                <div class="relative h-full overflow-hidden rounded-[22px] bg-[#0C1016]/82">

                    <div class="pointer-events-none absolute -right-20 -top-14 h-56 w-56 rounded-full bg-[#5A8DFF]/10 blur-3xl"></div>
                    <div class="pointer-events-none absolute left-0 bottom-0 h-40 w-40 rounded-full bg-[#8B7CFF]/6 blur-3xl"></div>

                    <div class="relative flex items-start justify-between gap-5 px-6 pb-5 pt-6">

                        <div>

                            <div class="flex items-center gap-2">
                                <span class="h-2 w-2 rounded-full bg-[#9EB6E8] shadow-[0_0_14px_rgba(158,182,232,0.85)]"></span>

                                <p class="text-[10px] font-semibold uppercase tracking-[0.2em] text-[#858C98]">
                                    Operations
                                </p>
                            </div>

                            <h2 class="mt-2 text-xl font-semibold tracking-tight text-[#F5F5F2]">
                                Order Status
                            </h2>

                            <p class="mt-1 text-xs leading-5 text-[#717984]">
                                Current order distribution.
                            </p>

                        </div>

                        <div class="flex h-10 w-10 items-center justify-center rounded-xl border border-[#2B3444] bg-[#111826] text-[#AFC5F6] shadow-[inset_0_1px_0_rgba(255,255,255,0.04),0_0_28px_rgba(76,132,255,0.08)]">
                            ◈
                        </div>

                    </div>


                    <div class="relative px-6 pb-6">

                        <div class="relative overflow-hidden rounded-[20px] border border-[#292F3A] bg-[linear-gradient(180deg,rgba(24,29,40,0.84),rgba(10,14,20,0.74))] p-4 shadow-[inset_0_1px_0_rgba(255,255,255,0.035),0_16px_45px_rgba(0,0,0,0.16)] sm:p-5">

                            <div class="pointer-events-none absolute inset-x-0 top-0 h-28 bg-[radial-gradient(circle_at_50%_0%,rgba(118,159,255,0.12),transparent_72%)]"></div>

                            <div class="relative mx-auto h-[235px] max-w-[235px]">
                                <div class="absolute inset-[16%] rounded-full border border-white/[0.025] bg-[#080C12]/35 shadow-[inset_0_0_35px_rgba(0,0,0,0.38)]"></div>
                                <div class="absolute inset-[22%] rounded-full bg-[#7592FF]/7 blur-2xl"></div>
                                <canvas id="orderStatusChart"></canvas>
                            </div>


                            <div class="mt-5 border-t border-[#242A34] pt-4">

                                <div class="grid grid-cols-2 gap-2">

                                    @php
                                        $statusConfig = [
                                            'pending' => [
                                                'label' => 'Pending',
                                                'dot' => 'bg-[#D9C57A]',
                                            ],
                                            'confirmed' => [
                                                'label' => 'Confirmed',
                                                'dot' => 'bg-[#9EB6E8]',
                                            ],
                                            'processing' => [
                                                'label' => 'Processing',
                                                'dot' => 'bg-[#BBA8EA]',
                                            ],
                                            'completed' => [
                                                'label' => 'Completed',
                                                'dot' => 'bg-[#63D889]',
                                            ],
                                            'cancelled' => [
                                                'label' => 'Cancelled',
                                                'dot' => 'bg-[#D88E8E]',
                                            ],
                                        ];
                                    @endphp

                                    @foreach ($statusConfig as $status => $config)

                                        <div class="flex items-center justify-between rounded-xl border border-[#202630] bg-white/[0.018] px-3 py-2.5 shadow-[inset_0_1px_0_rgba(255,255,255,0.018)]">

                                            <div class="flex items-center gap-2.5">
                                                <span class="h-2 w-2 rounded-full {{ $config['dot'] }} shadow-[0_0_8px_rgba(255,255,255,0.08)]"></span>

                                                <span class="text-[11px] text-[#7F8691]">
                                                    {{ $config['label'] }}
                                                </span>
                                            </div>

                                            <span class="text-xs font-semibold text-[#E2E5EA]">
                                                {{ $orderStatusSummary[$status] ?? 0 }}
                                            </span>

                                        </div>

                                    @endforeach

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>


        {{-- ============================================================ --}}
        {{-- ACTIVITY GRID --}}
        {{-- ============================================================ --}}

        <section class="grid gap-5 xl:grid-cols-2">

            {{-- Recent Orders --}}
            <div class="nx-surface rounded-[24px] overflow-hidden">

                <div class="relative border-b border-[#242830] px-6 py-5">
                    <div class="absolute right-0 top-0 h-24 w-24 rounded-full bg-[#8B7CFF]/8 blur-3xl"></div>

                    <div class="relative flex items-end justify-between gap-4">
                        <div>
                            <div class="flex items-center gap-2">
                                <span class="h-1.5 w-1.5 rounded-full bg-[#9C91FF] shadow-[0_0_9px_rgba(139,124,255,0.75)]"></span>
                                <p class="text-[10px] font-semibold uppercase tracking-[0.18em] text-[#707782]">
                                    Sales activity
                                </p>
                            </div>

                            <h2 class="mt-2 text-base font-semibold text-[#F5F5F2]">
                                Recent Orders
                            </h2>

                            <p class="mt-1 text-xs text-[#707782]">
                                Latest customer transactions.
                            </p>
                        </div>

                        <a
                            href="{{ route('orders.index') }}"
                            class="nx-chip rounded-xl px-3 py-2 text-xs font-medium text-[#9C91FF] transition hover:border-[#8B7CFF]/40 hover:text-white"
                        >
                            View all →
                        </a>
                    </div>
                </div>

                @if ($recentOrders->count())

                    <div class="space-y-2 p-3">

                        @foreach ($recentOrders as $order)

                            @php
                                $orderStatusClass = match ($order->status) {
                                    'pending' => 'border-[#D9C57A]/20 bg-[#211D13] text-[#E2CB7E]',
                                    'confirmed' => 'border-[#9EB6E8]/20 bg-[#151D29] text-[#AEC0E7]',
                                    'processing' => 'border-[#BBA8EA]/20 bg-[#1C1827] text-[#C9B7EE]',
                                    'completed' => 'border-[#9FE2B5]/20 bg-[#14201A] text-[#9FE2B5]',
                                    'cancelled' => 'border-[#D88E8E]/20 bg-[#211719] text-[#DFA0A0]',
                                    default => 'border-[#292F39] bg-[#0D1116] text-[#8B919A]',
                                };
                            @endphp

                            <a
                                href="{{ route('orders.show', $order) }}"
                                class="group flex items-center justify-between gap-4 rounded-2xl border border-transparent bg-white/[0.018] px-4 py-3.5 transition duration-200 hover:-translate-y-0.5 hover:border-[#353B47] hover:bg-white/[0.035] hover:shadow-[0_14px_35px_rgba(0,0,0,0.18)]"
                            >

                                <div class="flex min-w-0 items-center gap-3.5">

                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl border border-[#292F39] bg-[#0D1116] text-[#A99FFF] shadow-[inset_0_1px_0_rgba(255,255,255,0.025)] transition group-hover:border-[#8B7CFF]/30 group-hover:bg-[#8B7CFF]/8">
                                        ◈
                                    </div>

                                    <div class="min-w-0">
                                        <p class="truncate text-sm font-medium text-[#F5F5F2]">
                                            {{ $order->order_number }}
                                        </p>

                                        <p class="mt-1 truncate text-xs text-[#707782]">
                                            {{ $order->customer?->name ?? 'Walk-in Customer' }}
                                            ·
                                            {{ $order->warehouse?->name ?? '—' }}
                                        </p>
                                    </div>
                                </div>

                                <div class="shrink-0 text-right">
                                    <p class="text-sm font-semibold text-[#D7DAE0]">
                                        Rp {{ number_format($order->total, 0, ',', '.') }}
                                    </p>

                                    <span class="mt-1 inline-flex rounded-lg border px-2 py-1 text-[9px] font-semibold uppercase tracking-[0.12em] {{ $orderStatusClass }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </div>

                            </a>

                        @endforeach

                    </div>

                @else

                    <div class="px-6 py-14 text-center">
                        <p class="text-sm text-[#707782]">
                            No orders yet.
                        </p>
                    </div>

                @endif

            </div>


            {{-- Recent Stock Movements --}}
            <div class="nx-surface rounded-[24px] overflow-hidden">

                <div class="relative border-b border-[#242830] px-6 py-5">
                    <div class="absolute right-0 top-0 h-24 w-24 rounded-full bg-[#4C84FF]/7 blur-3xl"></div>

                    <div class="relative flex items-end justify-between gap-4">
                        <div>
                            <div class="flex items-center gap-2">
                                <span class="h-1.5 w-1.5 rounded-full bg-[#9EB6E8] shadow-[0_0_9px_rgba(158,182,232,0.7)]"></span>
                                <p class="text-[10px] font-semibold uppercase tracking-[0.18em] text-[#707782]">
                                    Inventory activity
                                </p>
                            </div>

                            <h2 class="mt-2 text-base font-semibold text-[#F5F5F2]">
                                Recent Stock Movements
                            </h2>

                            <p class="mt-1 text-xs text-[#707782]">
                                Latest inventory changes.
                            </p>
                        </div>

                        <a
                            href="{{ route('inventory.index') }}"
                            class="nx-chip rounded-xl px-3 py-2 text-xs font-medium text-[#9EB6E8] transition hover:border-[#9EB6E8]/35 hover:text-white"
                        >
                            View inventory →
                        </a>
                    </div>
                </div>

                @if ($recentStockMovements->count())

                    <div class="space-y-2 p-3">

                        @foreach ($recentStockMovements as $movement)

                            @php
                                $movementPositive = in_array($movement->type, ['purchase', 'return']);
                                $movementAccent = $movementPositive
                                    ? 'text-[#9FE2B5] border-[#9FE2B5]/15 bg-[#122019]'
                                    : ($movement->type === 'sale'
                                        ? 'text-[#D88E8E] border-[#D88E8E]/15 bg-[#211719]'
                                        : 'text-[#D1D5DB] border-[#353B47] bg-[#0D1116]');
                            @endphp

                            <div class="flex items-center justify-between gap-4 rounded-2xl border border-transparent bg-white/[0.018] px-4 py-3.5 transition duration-200 hover:border-[#353B47] hover:bg-white/[0.03]">

                                <div class="flex min-w-0 items-center gap-3.5">

                                    <div class="relative flex h-10 w-10 shrink-0 items-center justify-center rounded-xl border border-[#292F39] bg-[#0D1116] text-[#AEB5C0]">
                                        ↕
                                        <span class="absolute -right-0.5 -top-0.5 h-2 w-2 rounded-full bg-[#8B7CFF] shadow-[0_0_7px_rgba(139,124,255,0.55)]"></span>
                                    </div>

                                    <div class="min-w-0">
                                        <p class="truncate text-sm font-medium text-[#F5F5F2]">
                                            {{ $movement->productVariant?->product?->name ?? 'Unknown Product' }}
                                        </p>

                                        <p class="mt-1 truncate text-xs text-[#707782]">
                                            {{ $movement->productVariant?->name ?? '—' }}
                                            ·
                                            {{ $movement->warehouse?->name ?? '—' }}
                                        </p>
                                    </div>
                                </div>

                                <div class="shrink-0 text-right">
                                    <span class="inline-flex rounded-lg border px-2.5 py-1 text-[10px] font-semibold {{ $movementAccent }}">
                                        {{ $movementPositive ? '+' : '-' }}{{ number_format($movement->quantity) }}
                                    </span>

                                    <p class="mt-1 text-[10px] uppercase tracking-[0.13em] text-[#626975]">
                                        {{ $movement->type_label }}
                                    </p>
                                </div>

                            </div>

                        @endforeach

                    </div>

                @else

                    <div class="px-6 py-14 text-center">
                        <p class="text-sm text-[#707782]">
                            No stock movements yet.
                        </p>
                    </div>

                @endif

            </div>

        </section>


        {{-- ============================================================ --}}
        {{-- LOW STOCK DETAILS --}}
        {{-- ============================================================ --}}

        <section class="nx-surface rounded-[24px] overflow-hidden">

            <div class="relative border-b border-[#242830] px-6 py-5">
                <div class="absolute -right-12 -top-16 h-40 w-40 rounded-full bg-[#D9A66F]/7 blur-3xl"></div>

                <div class="relative flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                    <div>
                        <div class="flex items-center gap-2">
                            <span class="h-1.5 w-1.5 rounded-full bg-[#D9C57A] shadow-[0_0_9px_rgba(217,197,122,0.7)]"></span>

                            <p class="text-[10px] font-semibold uppercase tracking-[0.18em] text-[#707782]">
                                Inventory health
                            </p>
                        </div>

                        <div class="mt-2 flex items-end gap-3">
                            <h2 class="text-base font-semibold text-[#F5F5F2]">
                                Low Stock Alerts
                            </h2>

                            <span class="rounded-lg border border-[#D9C57A]/15 bg-[#1B1811] px-2 py-1 text-[9px] font-semibold uppercase tracking-[0.12em] text-[#D9C57A]">
                                {{ $lowStockItems->count() }} attention
                            </span>
                        </div>

                        <p class="mt-1 text-xs text-[#707782]">
                            Items approaching or below their reorder level.
                        </p>
                    </div>

                    <a
                        href="{{ route('inventory.index') }}"
                        class="inline-flex items-center justify-center rounded-xl border border-[#292F39] bg-[#0D1116] px-3.5 py-2 text-xs font-medium text-[#D9C57A] transition hover:border-[#D9C57A]/25 hover:text-white"
                    >
                        Review inventory →
                    </a>

                </div>
            </div>


            @if ($lowStockItems->count())

                <div class="space-y-2 p-3">

                    @foreach ($lowStockItems->take(8) as $inventory)

                        @php
                            $available = max(0, (int) $inventory->available_quantity);
                            $reorder = max(0, (int) $inventory->reorder_level);
                            $stockPercent = $reorder > 0
                                ? min(100, (int) round(($available / $reorder) * 100))
                                : 0;
                        @endphp

                        <a
                            href="{{ route('inventory.show', $inventory) }}"
                            class="group grid gap-4 rounded-2xl border border-transparent bg-white/[0.018] px-4 py-4 transition duration-200 hover:-translate-y-0.5 hover:border-[#3A404A] hover:bg-white/[0.03] hover:shadow-[0_14px_35px_rgba(0,0,0,0.18)] md:grid-cols-[minmax(0,1.25fr)_minmax(180px,0.9fr)_110px] md:items-center"
                        >

                            <div class="flex min-w-0 items-center gap-3.5">
                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl border border-[#3A3124] bg-[#1B1611] text-[#D9A66F]">
                                    !
                                </div>

                                <div class="min-w-0">
                                    <p class="truncate text-sm font-medium text-[#F5F5F2]">
                                        {{ $inventory->productVariant?->product?->name ?? 'Unknown Product' }}
                                    </p>

                                    <p class="mt-1 truncate text-xs text-[#707782]">
                                        {{ $inventory->productVariant?->name ?? '—' }}
                                        ·
                                        {{ $inventory->warehouse?->name ?? '—' }}
                                    </p>
                                </div>
                            </div>

                            <div>
                                <div class="flex items-center justify-between text-[10px] uppercase tracking-[0.12em]">
                                    <span class="text-[#626975]">Available</span>
                                    <span class="font-medium text-[#D9A66F]">{{ $available }} / {{ $reorder }}</span>
                                </div>

                                <div class="mt-2 h-1.5 overflow-hidden rounded-full bg-[#0A0D12]">
                                    <div
                                        class="h-full rounded-full bg-gradient-to-r from-[#D9A66F] via-[#E3C07B] to-[#E99A74] transition-all"
                                        style="width: {{ $stockPercent }}%"
                                    ></div>
                                </div>
                            </div>

                            <div class="flex items-center justify-between gap-3 md:justify-end">
                                <span class="inline-flex rounded-lg border border-[#4A3425] bg-[#211811] px-2.5 py-1 text-xs font-semibold text-[#D9A66F]">
                                    {{ $available }}
                                </span>

                                <span class="text-sm text-[#4D535D] transition group-hover:translate-x-0.5 group-hover:text-[#A99FFF]">
                                    →
                                </span>
                            </div>

                        </a>

                    @endforeach

                </div>

            @else

                <div class="px-6 py-14 text-center">
                    <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl border border-emerald-400/15 bg-emerald-400/8 text-lg text-[#9FE2B5] shadow-[0_0_30px_rgba(99,216,137,0.08)]">
                        ✓
                    </div>

                    <p class="mt-5 text-sm font-medium text-[#F5F5F2]">
                        Inventory looks healthy
                    </p>

                    <p class="mt-1 text-xs text-[#707782]">
                        No products are currently below their reorder level.
                    </p>
                </div>

            @endif

        </section>


        {{-- ============================================================ --}}
        {{-- QUICK ACTIONS --}}
        {{-- ============================================================ --}}

        <section>

            <div class="mb-4 flex items-end justify-between gap-4">

                <div>
                    <p class="text-[10px] font-semibold uppercase tracking-[0.18em] text-[#707782]">
                        Actions
                    </p>

                    <h2 class="mt-2 text-base font-semibold text-[#F5F5F2]">
                        Quick Actions
                    </h2>
                </div>

                <span class="hidden text-xs text-[#5F6671] sm:block">
                    Frequent workflows
                </span>

            </div>


            <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">

                <a
                    href="{{ route('orders.create') }}"
                    class="nx-surface-soft nx-action rounded-2xl p-5"
                >

                    <div class="flex items-start justify-between gap-4">

                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#8B7CFF]/10 text-[#A99FFF]">
                            +
                        </div>

                        <span class="text-sm text-[#4D535D]">↗</span>

                    </div>

                    <p class="mt-5 text-sm font-medium text-[#F5F5F2]">
                        Create Sales Order
                    </p>

                    <p class="mt-1 text-xs leading-5 text-[#707782]">
                        Record a new customer order.
                    </p>

                </a>


                <a
                    href="{{ route('customers.create') }}"
                    class="nx-surface-soft nx-action rounded-2xl p-5"
                >

                    <div class="flex items-start justify-between gap-4">

                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#16201D] text-[#9FE2B5]">
                            ♙
                        </div>

                        <span class="text-sm text-[#4D535D]">↗</span>

                    </div>

                    <p class="mt-5 text-sm font-medium text-[#F5F5F2]">
                        Add Customer
                    </p>

                    <p class="mt-1 text-xs leading-5 text-[#707782]">
                        Add a new customer account.
                    </p>

                </a>


                <a
                    href="{{ route('products.create') }}"
                    class="nx-surface-soft nx-action rounded-2xl p-5"
                >

                    <div class="flex items-start justify-between gap-4">

                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#151D29] text-[#9EB6E8]">
                            □
                        </div>

                        <span class="text-sm text-[#4D535D]">↗</span>

                    </div>

                    <p class="mt-5 text-sm font-medium text-[#F5F5F2]">
                        Add Product
                    </p>

                    <p class="mt-1 text-xs leading-5 text-[#707782]">
                        Create a new product.
                    </p>

                </a>


                <a
                    href="{{ route('purchasing.create') }}"
                    class="nx-surface-soft nx-action rounded-2xl p-5"
                >

                    <div class="flex items-start justify-between gap-4">

                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#1D1828] text-[#BBA8EA]">
                            ◇
                        </div>

                        <span class="text-sm text-[#4D535D]">↗</span>

                    </div>

                    <p class="mt-5 text-sm font-medium text-[#F5F5F2]">
                        Create Purchase Order
                    </p>

                    <p class="mt-1 text-xs leading-5 text-[#707782]">
                        Replenish business inventory.
                    </p>

                </a>

            </div>

        </section>

    </div>

    {{-- CHART.JS --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <script>

        document.addEventListener('DOMContentLoaded', function () {

            /*
            |--------------------------------------------------------------------------
            | Sales Chart Data
            |--------------------------------------------------------------------------
            */

            const salesLabels = @json(
                $salesOverview->map(function ($sale) {
                    return \Carbon\Carbon::parse($sale->date)->format('d M');
                })->values()
            );

            const salesData = @json(
                $salesOverview->map(function ($sale) {
                    return (float) $sale->total;
                })->values()
            );


            /*
            |--------------------------------------------------------------------------
            | Sales Overview
            |--------------------------------------------------------------------------
            | Hybrid visualization inspired by modern analytics dashboards:
            | soft volume bars + luminous line + gradient area + highlighted endpoint.
            */

            const salesCanvas = document.getElementById('salesChart');

            if (salesCanvas) {

                const salesEffectsPlugin = {
                    id: 'nexoraSalesEffects',

                    afterDraw(chart) {
                        const meta = chart.getDatasetMeta(1);
                        const chartArea = chart.chartArea;

                        if (!meta?.data?.length || !chartArea) {
                            return;
                        }

                        const lastPoint = meta.data[meta.data.length - 1];

                        if (!lastPoint) {
                            return;
                        }

                        const { ctx } = chart;

                        ctx.save();

                        const glow = ctx.createRadialGradient(
                            lastPoint.x,
                            lastPoint.y,
                            0,
                            lastPoint.x,
                            lastPoint.y,
                            24
                        );

                        glow.addColorStop(0, 'rgba(169,159,255,0.34)');
                        glow.addColorStop(0.4, 'rgba(139,124,255,0.15)');
                        glow.addColorStop(1, 'rgba(139,124,255,0)');

                        ctx.fillStyle = glow;
                        ctx.beginPath();
                        ctx.arc(lastPoint.x, lastPoint.y, 24, 0, Math.PI * 2);
                        ctx.fill();

                        ctx.fillStyle = '#F5F5F2';
                        ctx.shadowColor = 'rgba(139,124,255,0.82)';
                        ctx.shadowBlur = 14;
                        ctx.beginPath();
                        ctx.arc(lastPoint.x, lastPoint.y, 4.5, 0, Math.PI * 2);
                        ctx.fill();

                        ctx.shadowBlur = 0;
                        ctx.strokeStyle = 'rgba(139,124,255,0.42)';
                        ctx.lineWidth = 1;
                        ctx.beginPath();
                        ctx.arc(lastPoint.x, lastPoint.y, 10, 0, Math.PI * 2);
                        ctx.stroke();

                        ctx.restore();
                    }
                };


                new Chart(salesCanvas, {

                    type: 'bar',

                    data: {

                        labels: salesLabels,

                        datasets: [
                            {
                                type: 'bar',
                                label: 'Daily sales volume',
                                data: salesData,
                                borderRadius: 8,
                                borderSkipped: false,
                                barPercentage: 0.62,
                                categoryPercentage: 0.72,
                                backgroundColor: function (context) {
                                    const chart = context.chart;
                                    const { ctx, chartArea } = chart;

                                    if (!chartArea) {
                                        return 'rgba(98, 84, 188, 0.12)';
                                    }

                                    const gradient = ctx.createLinearGradient(
                                        0,
                                        chartArea.top,
                                        0,
                                        chartArea.bottom
                                    );

                                    gradient.addColorStop(0, 'rgba(121, 110, 230, 0.30)');
                                    gradient.addColorStop(0.58, 'rgba(121, 110, 230, 0.11)');
                                    gradient.addColorStop(1, 'rgba(121, 110, 230, 0.025)');

                                    return gradient;
                                },
                                borderColor: 'rgba(139,124,255,0.10)',
                                borderWidth: 1,
                            },
                            {
                                type: 'line',
                                label: 'Sales',
                                data: salesData,
                                borderColor: '#A79DFF',
                                borderWidth: 2.4,
                                pointBackgroundColor: '#CFC9FF',
                                pointBorderColor: '#10141B',
                                pointBorderWidth: 2,
                                pointRadius: 0,
                                pointHoverRadius: 5,
                                pointHoverBackgroundColor: '#F5F5F2',
                                pointHoverBorderColor: '#9C91FF',
                                tension: 0.4,
                                fill: true,
                                backgroundColor: function (context) {
                                    const chart = context.chart;
                                    const { ctx, chartArea } = chart;

                                    if (!chartArea) {
                                        return 'rgba(139,124,255,0.08)';
                                    }

                                    const gradient = ctx.createLinearGradient(
                                        0,
                                        chartArea.top,
                                        0,
                                        chartArea.bottom
                                    );

                                    gradient.addColorStop(0, 'rgba(139,124,255,0.26)');
                                    gradient.addColorStop(0.30, 'rgba(139,124,255,0.12)');
                                    gradient.addColorStop(0.72, 'rgba(139,124,255,0.035)');
                                    gradient.addColorStop(1, 'rgba(139,124,255,0)');

                                    return gradient;
                                },
                            }
                        ]

                    },

                    plugins: [salesEffectsPlugin],

                    options: {
                        responsive: true,
                        maintainAspectRatio: false,

                        interaction: {
                            intersect: false,
                            mode: 'index',
                        },

                        plugins: {

                            legend: {
                                display: false,
                            },

                            tooltip: {
                                backgroundColor: '#080C12',
                                borderColor: '#343B4A',
                                borderWidth: 1,
                                titleColor: '#F5F5F2',
                                bodyColor: '#C5CAD2',
                                padding: 13,
                                displayColors: false,
                                callbacks: {
                                    label: function (context) {
                                        return 'Rp ' + new Intl.NumberFormat('id-ID').format(context.raw);
                                    }
                                }
                            }

                        },

                        scales: {

                            x: {
                                grid: {
                                    display: false,
                                },
                                ticks: {
                                    color: '#68717D',
                                    font: {
                                        size: 10,
                                    },
                                    maxRotation: 45,
                                    minRotation: 45,
                                    padding: 8,
                                },
                                border: {
                                    display: false,
                                }
                            },

                            y: {
                                beginAtZero: true,
                                grid: {
                                    color: 'rgba(255,255,255,0.045)',
                                    drawTicks: false,
                                },
                                ticks: {
                                    color: '#68717D',
                                    font: {
                                        size: 10,
                                    },
                                    padding: 8,
                                    callback: function (value) {
                                        return 'Rp ' + new Intl.NumberFormat('id-ID', {
                                            notation: 'compact',
                                            maximumFractionDigits: 1
                                        }).format(value);
                                    }
                                },
                                border: {
                                    display: false,
                                }
                            }

                        }

                    }

                });

            }


            /*
            |--------------------------------------------------------------------------
            | Order Status Chart
            |--------------------------------------------------------------------------
            | Doughnut retained, but restyled with rounded segments, gradients,
            | soft glow, a center metric, and a subtle inner depth layer.
            */

            const statusData = {
                pending: {{ $orderStatusSummary['pending'] ?? 0 }},
                confirmed: {{ $orderStatusSummary['confirmed'] ?? 0 }},
                processing: {{ $orderStatusSummary['processing'] ?? 0 }},
                completed: {{ $orderStatusSummary['completed'] ?? 0 }},
                cancelled: {{ $orderStatusSummary['cancelled'] ?? 0 }},
            };


            const statusCanvas = document.getElementById('orderStatusChart');

            if (statusCanvas) {

                const orderStatusPlugin = {
                    id: 'nexoraOrderStatus',

                    beforeDatasetsDraw(chart) {
                        const { ctx, chartArea } = chart;

                        if (!chartArea) {
                            return;
                        }

                        const centerX = (chartArea.left + chartArea.right) / 2;
                        const centerY = (chartArea.top + chartArea.bottom) / 2;

                        ctx.save();

                        const outerGlow = ctx.createRadialGradient(
                            centerX,
                            centerY,
                            28,
                            centerX,
                            centerY,
                            100
                        );

                        outerGlow.addColorStop(0, 'rgba(110,112,255,0.05)');
                        outerGlow.addColorStop(0.7, 'rgba(110,112,255,0.025)');
                        outerGlow.addColorStop(1, 'rgba(110,112,255,0)');

                        ctx.fillStyle = outerGlow;
                        ctx.beginPath();
                        ctx.arc(centerX, centerY, 100, 0, Math.PI * 2);
                        ctx.fill();

                        ctx.restore();
                    },

                    afterDraw(chart) {
                        const { ctx, chartArea } = chart;

                        if (!chartArea) {
                            return;
                        }

                        const centerX = (chartArea.left + chartArea.right) / 2;
                        const centerY = (chartArea.top + chartArea.bottom) / 2;

                        const total = Object.values(statusData)
                            .reduce((sum, value) => sum + Number(value || 0), 0);

                        const completed = Number(statusData.completed || 0);
                        const completionRate = total > 0
                            ? Math.round((completed / total) * 100)
                            : 0;

                        ctx.save();
                        ctx.textAlign = 'center';
                        ctx.textBaseline = 'middle';

                        ctx.fillStyle = '#F5F5F2';
                        ctx.font = '600 31px Inter, sans-serif';
                        ctx.fillText(String(total), centerX, centerY - 10);

                        ctx.fillStyle = '#858D99';
                        ctx.font = '500 10px Inter, sans-serif';
                        ctx.fillText('TOTAL ORDERS', centerX, centerY + 11);

                        ctx.fillStyle = '#A99FFF';
                        ctx.font = '600 10px Inter, sans-serif';
                        ctx.fillText(completionRate + '% completed', centerX, centerY + 28);

                        ctx.restore();
                    }
                };


                new Chart(statusCanvas, {

                    type: 'doughnut',

                    data: {

                        labels: [
                            'Pending',
                            'Confirmed',
                            'Processing',
                            'Completed',
                            'Cancelled'
                        ],

                        datasets: [
                            {
                                data: [
                                    statusData.pending,
                                    statusData.confirmed,
                                    statusData.processing,
                                    statusData.completed,
                                    statusData.cancelled
                                ],

                                borderColor: '#0B0F15',
                                borderWidth: 4,
                                spacing: 4,
                                borderRadius: 11,

                                backgroundColor: function (context) {
                                    const chart = context.chart;
                                    const { ctx } = chart;
                                    const index = context.dataIndex;

                                    const palettes = [
                                        ['#8A6C28', '#E8D37D'],
                                        ['#667DAF', '#B7CBFF'],
                                        ['#8D6BC0', '#D6C7FF'],
                                        ['#2A9C63', '#74E8A4'],
                                        ['#A45D68', '#EE9BA4']
                                    ];

                                    const palette = palettes[index] || ['#5C6570', '#9EA6B1'];

                                    const gradient = ctx.createLinearGradient(0, 0, 180, 180);
                                    gradient.addColorStop(0, palette[0]);
                                    gradient.addColorStop(1, palette[1]);

                                    return gradient;
                                },
                            }
                        ]

                    },

                    plugins: [orderStatusPlugin],

                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        cutout: '70%',
                        rotation: -90,

                        plugins: {
                            legend: {
                                display: false,
                            },

                            tooltip: {
                                backgroundColor: '#080C12',
                                borderColor: '#343B4A',
                                borderWidth: 1,
                                titleColor: '#F5F5F2',
                                bodyColor: '#C5CAD2',
                                padding: 12,
                            }
                        }
                    }

                });

            }

        });

    </script>

</x-app-layout>