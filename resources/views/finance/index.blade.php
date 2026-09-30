<x-app-layout>

    <style>
        .nexora-finance {
            position: relative;
            isolation: isolate;
        }

        .nexora-finance::before,
        .nexora-finance::after {
            content: "";
            position: fixed;
            pointer-events: none;
            z-index: -1;
            border-radius: 9999px;
            filter: blur(80px);
            opacity: 0.22;
        }

        .nexora-finance::before {
            width: 520px;
            height: 520px;
            top: 110px;
            right: 3%;
            background: radial-gradient(
                circle,
                rgba(139, 124, 255, 0.42) 0%,
                rgba(139, 124, 255, 0) 70%
            );
        }

        .nexora-finance::after {
            width: 420px;
            height: 420px;
            left: 8%;
            bottom: 5%;
            background: radial-gradient(
                circle,
                rgba(76, 132, 255, 0.18) 0%,
                rgba(76, 132, 255, 0) 72%
            );
        }

        .nx-surface {
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(58, 64, 74, 0.72);
            background:
                linear-gradient(
                    145deg,
                    rgba(20, 24, 32, 0.96),
                    rgba(12, 15, 21, 0.92)
                );
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
                linear-gradient(
                    145deg,
                    rgba(22, 26, 34, 0.82),
                    rgba(12, 15, 21, 0.72)
                );
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
                radial-gradient(
                    rgba(255,255,255,0.028) 0.65px,
                    transparent 0.65px
                );
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
                linear-gradient(
                    145deg,
                    rgba(29, 25, 51, 0.88),
                    rgba(15, 19, 26, 0.92)
                );
        }

        .nx-activity-row {
            transition:
                transform 180ms ease,
                border-color 180ms ease,
                background 180ms ease,
                box-shadow 180ms ease;
        }

        .nx-activity-row:hover {
            transform: translateY(-2px);
            border-color: rgba(58, 64, 74, 0.95);
            background: rgba(255, 255, 255, 0.035);
            box-shadow: 0 14px 35px rgba(0, 0, 0, 0.18);
        }

        @media (prefers-reduced-motion: reduce) {
            .nx-kpi,
            .nx-action,
            .nx-activity-row {
                transition: none !important;
            }

            .nx-kpi:hover,
            .nx-action:hover,
            .nx-activity-row:hover {
                transform: none !important;
            }
        }
    </style>


    <div class="nexora-finance space-y-8">


        {{-- ============================================================ --}}
        {{-- HERO --}}
        {{-- ============================================================ --}}

        <section class="nx-surface nx-glow-purple rounded-[26px] p-6 sm:p-8">

            <div class="nx-noise absolute inset-0"></div>

            <div class="absolute -right-20 -top-24 h-72 w-72 rounded-full bg-[#8B7CFF]/10 blur-3xl"></div>

            <div class="absolute -bottom-24 left-16 h-56 w-56 rounded-full bg-[#4C84FF]/8 blur-3xl"></div>


            <div class="relative">

                <div class="flex flex-col gap-5 sm:flex-row sm:items-start sm:justify-between">

                    <div class="max-w-2xl">

                        <div class="flex flex-wrap items-center gap-2">

                            <span class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#9C91FF]">
                                Finance
                            </span>

                            <span class="nx-chip rounded-full px-2.5 py-1 text-[9px] uppercase tracking-[0.14em] text-[#7F8692]">
                                Financial workspace
                            </span>

                        </div>


                        <h1 class="mt-3 text-3xl font-semibold tracking-tight text-[#F5F5F2] sm:text-4xl">
                            Financial Overview
                        </h1>


                        <p class="mt-3 max-w-xl text-sm leading-6 text-[#8B919A]">
                            Monitor revenue, expenses, profit, and payment activity from one place.
                        </p>

                    </div>


                    <div class="shrink-0 text-left sm:text-right">

                        <p class="text-[10px] font-semibold uppercase tracking-[0.18em] text-[#666C75]">
                            Period
                        </p>

                        <p class="mt-2 text-sm font-medium text-[#D5D8DE]">
                            Last 6 Months
                        </p>

                    </div>

                </div>

            </div>

        </section>


        {{-- ============================================================ --}}
        {{-- KPI --}}
        {{-- ============================================================ --}}

        <section class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">


            {{-- Total Revenue --}}
            <div class="nx-surface nx-kpi rounded-[24px] p-5">

                <div class="pointer-events-none absolute -right-14 -top-14 h-36 w-36 rounded-full bg-[#8B7CFF]/8 blur-3xl"></div>


                <div class="relative flex items-start justify-between gap-4">

                    <div class="min-w-0">

                        <p class="text-[10px] font-semibold uppercase tracking-[0.16em] text-[#69707C]">
                            Total Revenue
                        </p>

                        <p class="mt-3 text-2xl font-semibold tracking-[-0.035em] text-white">
                            Rp {{ number_format($totalRevenue, 0, ',', '.') }}
                        </p>

                    </div>


                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl border border-[#8B7CFF]/15 bg-[#8B7CFF]/10 text-[#A99FFF] text-[24px]">
                        ↗
                    </div>

                </div>


                <div class="relative mt-4 flex items-center gap-2">

                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-300 shadow-[0_0_10px_rgba(110,231,183,0.5)]"></span>

                    <p class="text-xs text-[#707782]">
                        Paid invoices
                    </p>

                </div>

            </div>


            {{-- Total Expenses --}}
            <div class="nx-surface nx-kpi rounded-[24px] p-5">

                <div class="pointer-events-none absolute -right-14 -top-14 h-36 w-36 rounded-full bg-rose-400/6 blur-3xl"></div>


                <div class="relative flex items-start justify-between gap-4">

                    <div class="min-w-0">

                        <p class="text-[10px] font-semibold uppercase tracking-[0.16em] text-[#69707C]">
                            Total Expenses
                        </p>

                        <p class="mt-3 text-2xl font-semibold tracking-[-0.035em] text-white">
                            Rp {{ number_format($totalExpenses, 0, ',', '.') }}
                        </p>

                    </div>


                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl border border-rose-300/10 bg-rose-300/10 text-rose-300">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.7"
                            class="h-4 w-4"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M5 5l14 14"
                            />
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M19 10v9h-9"
                            />
                        </svg>

                    </div>

                </div>


                <div class="relative mt-4 flex items-center gap-2">

                    <span class="h-1.5 w-1.5 rounded-full bg-rose-300"></span>

                    <p class="text-xs text-[#707782]">
                        Paid expenses
                    </p>

                </div>

            </div>


            {{-- Net Profit --}}
            <div class="nx-surface nx-kpi rounded-[24px] p-5">

                <div class="pointer-events-none absolute -right-14 -top-14 h-36 w-36 rounded-full bg-violet-400/6 blur-3xl"></div>


                <div class="relative flex items-start justify-between gap-4">

                    <div class="min-w-0">

                        <p class="text-[10px] font-semibold uppercase tracking-[0.16em] text-[#69707C]">
                            Net Profit
                        </p>

                        <p class="mt-3 text-2xl font-semibold tracking-[-0.035em] {{ $netProfit >= 0 ? 'text-white' : 'text-rose-300' }}">
                            Rp {{ number_format($netProfit, 0, ',', '.') }}
                        </p>

                    </div>


                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl border border-violet-300/10 bg-violet-300/10 text-violet-300">
                        ◈
                    </div>

                </div>


                <div class="relative mt-4 flex items-center gap-2">

                    <span class="h-1.5 w-1.5 rounded-full bg-violet-300 shadow-[0_0_10px_rgba(196,181,253,0.45)]"></span>

                    <p class="text-xs text-[#707782]">
                        Revenue minus expenses
                    </p>

                </div>

            </div>


            {{-- Outstanding --}}
            <div class="nx-surface nx-kpi rounded-[24px] p-5">

                <div class="pointer-events-none absolute -right-14 -top-14 h-36 w-36 rounded-full bg-amber-300/6 blur-3xl"></div>


                <div class="relative flex items-start justify-between gap-4">

                    <div class="min-w-0">

                        <p class="text-[10px] font-semibold uppercase tracking-[0.16em] text-[#69707C]">
                            Outstanding
                        </p>

                        <p class="mt-3 text-2xl font-semibold tracking-[-0.035em] text-white">
                            Rp {{ number_format($outstandingInvoices, 0, ',', '.') }}
                        </p>

                    </div>


                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl border border-amber-300/10 bg-amber-300/10 text-amber-300">
                        !
                    </div>

                </div>


                <div class="relative mt-4 flex items-center justify-between gap-3">

                    <div class="flex items-center gap-2">

                        <span class="h-1.5 w-1.5 rounded-full bg-amber-300"></span>

                        <p class="text-xs text-[#707782]">
                            Unpaid invoices
                        </p>

                    </div>


                    <a
                        href="{{ route('finance.invoices.index') }}"
                        class="text-[10px] font-medium text-[#9C91FF] transition hover:text-white"
                    >
                        Review →
                    </a>

                </div>

            </div>

        </section>


        {{-- ============================================================ --}}
        {{-- ANALYTICS --}}
        {{-- ============================================================ --}}

        <section class="grid gap-5 xl:grid-cols-[minmax(0,1.68fr)_minmax(330px,0.72fr)]">


            {{-- Financial Performance --}}
            <div class="nx-surface nx-glow-purple rounded-[26px] p-1">

                <div class="relative overflow-hidden rounded-[22px] bg-[#0C1016]/82">

                    <div class="pointer-events-none absolute inset-x-0 top-0 h-44 bg-[radial-gradient(circle_at_42%_0%,rgba(139,124,255,0.14),transparent_62%)]"></div>

                    <div class="pointer-events-none absolute -right-24 top-12 h-64 w-64 rounded-full bg-[#6F61FF]/10 blur-3xl"></div>


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
                                    Financial Performance
                                </h2>

                                <p class="mt-1 max-w-xl text-xs leading-5 text-[#717984]">
                                    Revenue, expenses, and profit over the last six months.
                                </p>

                            </div>


                            <span class="rounded-xl border border-[#313747] bg-[#121825] px-3 py-2 text-[10px] uppercase tracking-[0.14em] text-[#9FA7B5]">
                                6 Months
                            </span>

                        </div>


                        <div class="flex flex-wrap items-center gap-x-5 gap-y-2">

                            <div class="flex items-center gap-2">

                                <span class="h-1.5 w-1.5 rounded-full bg-[#8B7CFF]"></span>

                                <span class="text-[10px] text-[#6C7480]">
                                    Revenue
                                </span>

                            </div>


                            <div class="flex items-center gap-2">

                                <span class="h-1.5 w-1.5 rounded-full bg-[#D88E8E]"></span>

                                <span class="text-[10px] text-[#6C7480]">
                                    Expenses
                                </span>

                            </div>


                            <div class="flex items-center gap-2">

                                <span class="h-1.5 w-1.5 rounded-full bg-[#9E91FF]"></span>

                                <span class="text-[10px] text-[#6C7480]">
                                    Profit
                                </span>

                            </div>

                        </div>


                        <div class="relative overflow-hidden rounded-[20px] border border-[#292F3A] bg-[linear-gradient(180deg,rgba(24,29,40,0.86),rgba(10,14,20,0.74))] p-3 shadow-[inset_0_1px_0_rgba(255,255,255,0.035),0_16px_45px_rgba(0,0,0,0.18)] sm:p-4">

                            <div class="pointer-events-none absolute inset-x-0 bottom-0 h-36 bg-[linear-gradient(180deg,transparent,rgba(139,124,255,0.035))]"></div>


                            <div class="relative h-[300px] sm:h-[350px]">

                                <canvas id="financialChart"></canvas>

                            </div>


                            <div class="relative mt-2 flex items-center justify-between px-1">

                                <div class="flex items-center gap-2 text-[10px] text-[#6C7480]">

                                    <span class="h-1.5 w-1.5 rounded-full bg-[#8B7CFF]"></span>

                                    <span>
                                        Financial performance
                                    </span>

                                </div>

                                <span class="text-[10px] text-[#555D68]">
                                    Monthly overview
                                </span>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- Invoice Status --}}
            <div class="nx-surface nx-glow-blue rounded-[26px] p-1">

                <div class="relative h-full overflow-hidden rounded-[22px] bg-[#0C1016]/82">

                    <div class="pointer-events-none absolute -right-20 -top-14 h-56 w-56 rounded-full bg-[#5A8DFF]/10 blur-3xl"></div>

                    <div class="pointer-events-none absolute left-0 bottom-0 h-40 w-40 rounded-full bg-[#8B7CFF]/6 blur-3xl"></div>


                    <div class="relative flex items-start justify-between gap-5 px-6 pb-5 pt-6">

                        <div>

                            <div class="flex items-center gap-2">

                                <span class="h-2 w-2 rounded-full bg-[#A99FFF] shadow-[0_0_14px_rgba(169,159,255,0.85)]"></span>

                                <p class="text-[10px] font-semibold uppercase tracking-[0.2em] text-[#858C98]">
                                    Billing
                                </p>

                            </div>

                            <h2 class="mt-2 text-xl font-semibold tracking-tight text-[#F5F5F2]">
                                Invoice Status
                            </h2>

                            <p class="mt-1 text-xs leading-5 text-[#717984]">
                                Current invoice distribution.
                            </p>

                        </div>


                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl border border-[#2B3444] bg-[#111826] text-[#AFC5F6]">
                            ◈
                        </div>

                    </div>


                    @php

                        $invoiceStatuses = [

                            'draft' => [
                                'label' => 'Draft',
                                'dot' => 'bg-[#707782]',
                            ],

                            'issued' => [
                                'label' => 'Issued',
                                'dot' => 'bg-[#76A8F8]',
                            ],

                            'paid' => [
                                'label' => 'Paid',
                                'dot' => 'bg-[#63D889]',
                            ],

                            'overdue' => [
                                'label' => 'Overdue',
                                'dot' => 'bg-[#D88E8E]',
                            ],

                            'cancelled' => [
                                'label' => 'Cancelled',
                                'dot' => 'bg-[#BBA8EA]',
                            ],

                        ];

                        $invoiceTotalCount = collect($invoiceSummary)->sum();

                    @endphp


                    <div class="relative px-6 pb-6">

                        <div class="relative overflow-hidden rounded-[20px] border border-[#292F3A] bg-[linear-gradient(180deg,rgba(24,29,40,0.84),rgba(10,14,20,0.74))] p-4 shadow-[inset_0_1px_0_rgba(255,255,255,0.035),0_16px_45px_rgba(0,0,0,0.16)] sm:p-5">

                            <div class="pointer-events-none absolute inset-x-0 top-0 h-28 bg-[radial-gradient(circle_at_50%_0%,rgba(118,159,255,0.12),transparent_72%)]"></div>


                            <div class="relative mx-auto h-[225px] max-w-[225px]">

                                <div class="absolute inset-[16%] rounded-full border border-white/[0.025] bg-[#080C12]/35 shadow-[inset_0_0_35px_rgba(0,0,0,0.38)]"></div>

                                <div class="absolute inset-[22%] rounded-full bg-[#7592FF]/7 blur-2xl"></div>

                                <canvas id="invoiceChart"></canvas>


                                <div class="pointer-events-none absolute inset-0 z-20 flex items-center justify-center">

                                    <div class="text-center">

                                        <p class="text-[27px] font-semibold tracking-[-0.045em] text-white">
                                            {{ number_format($invoiceTotalCount) }}
                                        </p>

                                        <p class="mt-1 text-[9px] font-medium uppercase tracking-[0.18em] text-[#747C88]">
                                            Total Invoices
                                        </p>

                                    </div>

                                </div>

                            </div>


                            <div class="mt-5 border-t border-[#242A34] pt-4">

                                <div class="grid grid-cols-2 gap-2">

                                    @foreach ($invoiceStatuses as $status => $config)

                                        <div class="flex items-center justify-between rounded-xl border border-[#202630] bg-white/[0.018] px-3 py-2.5">

                                            <div class="flex items-center gap-2.5">

                                                <span class="h-2 w-2 rounded-full {{ $config['dot'] }}"></span>

                                                <span class="text-[11px] text-[#7F8691]">
                                                    {{ $config['label'] }}
                                                </span>

                                            </div>


                                            <span class="text-xs font-semibold text-[#E2E5EA]">
                                                {{ $invoiceSummary[$status] ?? 0 }}
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
        {{-- PAYMENT METHODS + EXPENSE CATEGORIES --}}
        {{-- ============================================================ --}}

        <section class="grid gap-5 xl:grid-cols-2">


            {{-- Payment Methods --}}
            <div class="nx-surface rounded-[24px] overflow-hidden">

                <div class="relative border-b border-[#242830] px-6 py-5">

                    <div class="absolute right-0 top-0 h-24 w-24 rounded-full bg-[#8B7CFF]/8 blur-3xl"></div>


                    <div class="relative flex items-end justify-between gap-4">

                        <div>

                            <div class="flex items-center gap-2">

                                <span class="h-1.5 w-1.5 rounded-full bg-[#9C91FF] shadow-[0_0_9px_rgba(139,124,255,0.75)]"></span>

                                <p class="text-[10px] font-semibold uppercase tracking-[0.18em] text-[#707782]">
                                    Collections
                                </p>

                            </div>


                            <h2 class="mt-2 text-base font-semibold text-[#F5F5F2]">
                                Payment Methods
                            </h2>


                            <p class="mt-1 text-xs text-[#707782]">
                                Paid revenue grouped by payment method.
                            </p>

                        </div>


                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl border border-[#292F39] bg-[#0D1116] text-[#A99FFF]">
                            $
                        </div>

                    </div>

                </div>


                @if ($paymentMethods->count())

                    <div class="space-y-2 p-3">

                        @foreach ($paymentMethods as $payment)

                            <div class="nx-activity-row flex items-center justify-between gap-4 rounded-2xl border border-transparent bg-white/[0.018] px-4 py-3.5">

                                <div class="flex min-w-0 items-center gap-3.5">

                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl border border-[#292F39] bg-[#0D1116] text-xs font-semibold uppercase text-[#A99FFF]">

                                        {{ substr($payment->method ?? '—', 0, 1) }}

                                    </div>


                                    <div class="min-w-0">

                                        <p class="truncate text-sm font-medium capitalize text-[#F5F5F2]">
                                            {{ $payment->method ?? 'Unknown' }}
                                        </p>

                                        <p class="mt-1 truncate text-xs text-[#707782]">
                                            Paid transactions
                                        </p>

                                    </div>

                                </div>


                                <div class="shrink-0 text-right">

                                    <p class="text-sm font-semibold text-[#D7DAE0]">
                                        Rp {{ number_format($payment->total, 0, ',', '.') }}
                                    </p>

                                    <p class="mt-1 text-[9px] uppercase tracking-[0.12em] text-[#555D68]">
                                        Collected
                                    </p>

                                </div>

                            </div>

                        @endforeach

                    </div>

                @else

                    <div class="px-6 py-14 text-center">

                        <p class="text-sm text-[#707782]">
                            No payment data available.
                        </p>

                    </div>

                @endif

            </div>


            {{-- Expense Categories --}}
            <div class="nx-surface rounded-[24px] overflow-hidden">

                <div class="relative border-b border-[#242830] px-6 py-5">

                    <div class="absolute right-0 top-0 h-24 w-24 rounded-full bg-[#D88E8E]/7 blur-3xl"></div>


                    <div class="relative flex items-end justify-between gap-4">

                        <div>

                            <div class="flex items-center gap-2">

                                <span class="h-1.5 w-1.5 rounded-full bg-[#D88E8E] shadow-[0_0_9px_rgba(216,142,142,0.65)]"></span>

                                <p class="text-[10px] font-semibold uppercase tracking-[0.18em] text-[#707782]">
                                    Spending
                                </p>

                            </div>


                            <h2 class="mt-2 text-base font-semibold text-[#F5F5F2]">
                                Expense Categories
                            </h2>


                            <p class="mt-1 text-xs text-[#707782]">
                                Paid expenses grouped by category.
                            </p>

                        </div>


                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl border border-[#292F39] bg-[#0D1116] text-[#D88E8E]">

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.5"
                                class="h-5 w-5"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M4 7.5L12 4l8 3.5-8 3-8-3Z"
                                />
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M4 12l8 3 8-3"
                                />
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M4 16.5l8 3 8-3"
                                />
                            </svg>

                        </div>

                    </div>

                </div>


                @if ($expenseCategories->count())

                    <div class="space-y-2 p-3">

                        @foreach ($expenseCategories as $expense)

                            <div class="nx-activity-row flex items-center justify-between gap-4 rounded-2xl border border-transparent bg-white/[0.018] px-4 py-3.5">

                                <div class="flex min-w-0 items-center gap-3.5">

                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl border border-[#292F39] bg-[#0D1116] text-[#D88E8E]">

                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.5"
                                            class="h-5 w-5"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M5 7.5h14M5 12h14M5 16.5h9"
                                            />
                                            <circle
                                                cx="4"
                                                cy="7.5"
                                                r="0.8"
                                                fill="currentColor"
                                                stroke="none"
                                            />
                                            <circle
                                                cx="4"
                                                cy="12"
                                                r="0.8"
                                                fill="currentColor"
                                                stroke="none"
                                            />
                                            <circle
                                                cx="4"
                                                cy="16.5"
                                                r="0.8"
                                                fill="currentColor"
                                                stroke="none"
                                            />
                                        </svg>

                                    </div>


                                    <div class="min-w-0">

                                        <p class="truncate text-sm font-medium capitalize text-[#F5F5F2]">
                                            {{ $expense->category ?? 'Uncategorized' }}
                                        </p>

                                        <p class="mt-1 truncate text-xs text-[#707782]">
                                            Paid expenses
                                        </p>

                                    </div>

                                </div>


                                <div class="shrink-0 text-right">

                                    <p class="text-sm font-semibold text-[#D7DAE0]">
                                        Rp {{ number_format($expense->total, 0, ',', '.') }}
                                    </p>

                                    <p class="mt-1 text-[9px] uppercase tracking-[0.12em] text-[#555D68]">
                                        Spending
                                    </p>

                                </div>

                            </div>

                        @endforeach

                    </div>

                @else

                    <div class="px-6 py-14 text-center">

                        <p class="text-sm text-[#707782]">
                            No expense data available.
                        </p>

                    </div>

                @endif

            </div>

        </section>


        {{-- ============================================================ --}}
        {{-- RECENT INVOICES + RECENT PAYMENTS --}}
        {{-- ============================================================ --}}

        <section class="grid gap-5 xl:grid-cols-2">


            {{-- Recent Invoices --}}
            <div class="nx-surface rounded-[24px] overflow-hidden">

                <div class="relative border-b border-[#242830] px-6 py-5">

                    <div class="absolute right-0 top-0 h-24 w-24 rounded-full bg-[#8B7CFF]/8 blur-3xl"></div>


                    <div class="relative flex items-end justify-between gap-4">

                        <div>

                            <div class="flex items-center gap-2">

                                <span class="h-1.5 w-1.5 rounded-full bg-[#9C91FF] shadow-[0_0_9px_rgba(139,124,255,0.75)]"></span>

                                <p class="text-[10px] font-semibold uppercase tracking-[0.18em] text-[#707782]">
                                    Billing Activity
                                </p>

                            </div>


                            <h2 class="mt-2 text-base font-semibold text-[#F5F5F2]">
                                Recent Invoices
                            </h2>


                            <p class="mt-1 text-xs text-[#707782]">
                                Latest billing activity.
                            </p>

                        </div>


                        <a
                            href="{{ route('finance.invoices.index') }}"
                            class="nx-chip rounded-xl px-3 py-2 text-xs font-medium text-[#9C91FF] transition hover:border-[#8B7CFF]/40 hover:text-white"
                        >
                            View all →
                        </a>

                    </div>

                </div>


                @if ($recentInvoices->count())

                    <div class="space-y-2 p-3">

                        @foreach ($recentInvoices as $invoice)

                            @php

                                $invoiceStatusClass = match ($invoice->status) {

                                    'paid' =>
                                        'border-[#9FE2B5]/20 bg-[#14201A] text-[#9FE2B5]',

                                    'issued' =>
                                        'border-[#9EB6E8]/20 bg-[#151D29] text-[#AEC0E7]',

                                    'overdue' =>
                                        'border-[#D88E8E]/20 bg-[#211719] text-[#DFA0A0]',

                                    'cancelled' =>
                                        'border-[#BBA8EA]/20 bg-[#1C1827] text-[#C9B7EE]',

                                    default =>
                                        'border-[#292F39] bg-[#0D1116] text-[#8B919A]',

                                };

                            @endphp


                            <a
                                href="{{ route('finance.invoices.show', $invoice) }}"
                                class="nx-activity-row flex items-center justify-between gap-4 rounded-2xl border border-transparent bg-white/[0.018] px-4 py-3.5"
                            >

                                <div class="flex min-w-0 items-center gap-3.5">

                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl border border-[#292F39] bg-[#0D1116] text-[#A99FFF]">
                                        ◈
                                    </div>


                                    <div class="min-w-0">

                                        <p class="truncate text-sm font-medium text-[#F5F5F2]">
                                            {{ $invoice->invoice_number ?? 'INV-' . $invoice->id }}
                                        </p>

                                        <p class="mt-1 truncate text-xs text-[#707782]">
                                            {{ $invoice->order?->customer?->name ?? 'Unknown Customer' }}
                                        </p>

                                    </div>

                                </div>


                                <div class="shrink-0 text-right">

                                    <p class="text-sm font-semibold text-[#D7DAE0]">
                                        Rp {{ number_format($invoice->total, 0, ',', '.') }}
                                    </p>

                                    <span class="mt-1 inline-flex rounded-lg border px-2 py-1 text-[9px] font-semibold uppercase tracking-[0.12em] {{ $invoiceStatusClass }}">
                                        {{ ucfirst($invoice->status) }}
                                    </span>

                                </div>

                            </a>

                        @endforeach

                    </div>

                @else

                    <div class="px-6 py-14 text-center">

                        <p class="text-sm text-[#707782]">
                            No invoices yet.
                        </p>


                        <a
                            href="{{ route('finance.invoices.create') }}"
                            class="mt-4 inline-flex items-center rounded-xl border border-[#292F39] bg-[#0D1116] px-3.5 py-2 text-xs font-medium text-[#A99FFF] transition hover:border-[#8B7CFF]/35 hover:text-white"
                        >
                            Create Invoice →
                        </a>

                    </div>

                @endif

            </div>


            {{-- Recent Payments --}}
            <div class="nx-surface rounded-[24px] overflow-hidden">

                <div class="relative border-b border-[#242830] px-6 py-5">

                    <div class="absolute right-0 top-0 h-24 w-24 rounded-full bg-[#4C84FF]/7 blur-3xl"></div>


                    <div class="relative flex items-end justify-between gap-4">

                        <div>

                            <div class="flex items-center gap-2">

                                <span class="h-1.5 w-1.5 rounded-full bg-[#9FE2B5] shadow-[0_0_9px_rgba(99,216,137,0.7)]"></span>

                                <p class="text-[10px] font-semibold uppercase tracking-[0.18em] text-[#707782]">
                                    Cash Activity
                                </p>

                            </div>


                            <h2 class="mt-2 text-base font-semibold text-[#F5F5F2]">
                                Recent Payments
                            </h2>


                            <p class="mt-1 text-xs text-[#707782]">
                                Latest payment transactions.
                            </p>

                        </div>

                    </div>

                </div>


                @if ($recentPayments->count())

                    <div class="space-y-2 p-3">

                        @foreach ($recentPayments as $payment)

                            <div class="nx-activity-row flex items-center justify-between gap-4 rounded-2xl border border-transparent bg-white/[0.018] px-4 py-3.5">

                                <div class="flex min-w-0 items-center gap-3.5">

                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl border border-[#9FE2B5]/10 bg-[#0D1511] text-[#9FE2B5]">
                                        ↗
                                    </div>


                                    <div class="min-w-0">

                                        <p class="truncate text-sm font-medium text-[#F5F5F2]">
                                            {{ $payment->invoice?->invoice_number ?? 'Payment #' . $payment->id }}
                                        </p>

                                        <p class="mt-1 truncate text-xs text-[#707782]">
                                            {{ ucfirst($payment->method ?? 'Unknown method') }}
                                        </p>

                                    </div>

                                </div>


                                <div class="shrink-0 text-right">

                                    <p class="text-sm font-semibold text-[#9FE2B5]">
                                        + Rp {{ number_format($payment->amount, 0, ',', '.') }}
                                    </p>

                                    <p class="mt-1 text-[9px] uppercase tracking-[0.12em] text-[#626975]">
                                        {{ ucfirst($payment->status) }}
                                    </p>

                                </div>

                            </div>

                        @endforeach

                    </div>

                @else

                    <div class="px-6 py-14 text-center">

                        <p class="text-sm text-[#707782]">
                            No payments yet.
                        </p>

                    </div>

                @endif

            </div>

        </section>


        {{-- ============================================================ --}}
        {{-- RECENT EXPENSES --}}
        {{-- ============================================================ --}}

        <section class="nx-surface rounded-[24px] overflow-hidden">

            <div class="relative border-b border-[#242830] px-6 py-5">

                <div class="absolute right-0 top-0 h-24 w-24 rounded-full bg-[#D88E8E]/7 blur-3xl"></div>


                <div class="relative flex items-end justify-between gap-4">

                    <div>

                        <div class="flex items-center gap-2">

                            <span class="h-1.5 w-1.5 rounded-full bg-[#D88E8E] shadow-[0_0_9px_rgba(216,142,142,0.65)]"></span>

                            <p class="text-[10px] font-semibold uppercase tracking-[0.18em] text-[#707782]">
                                Expense Activity
                            </p>

                        </div>


                        <h2 class="mt-2 text-base font-semibold text-[#F5F5F2]">
                            Recent Expenses
                        </h2>


                        <p class="mt-1 text-xs text-[#707782]">
                            Latest recorded business expenses.
                        </p>

                    </div>


                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl border border-[#292F39] bg-[#0D1116] text-[#D88E8E]">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.5"
                            class="h-5 w-5"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M6 4.75A1.75 1.75 0 0 1 7.75 3h8.5A1.75 1.75 0 0 1 18 4.75v14.5A1.75 1.75 0 0 1 16.25 21h-8.5A1.75 1.75 0 0 1 6 19.25V4.75Z"
                            />
                            <path
                                stroke-linecap="round"
                                d="M9 8h6M9 12h6M9 16h3"
                            />
                        </svg>

                    </div>

                </div>

            </div>


            @if ($recentExpenses->count())

                <div class="space-y-2 p-3">

                    @foreach ($recentExpenses as $expense)

                        <div class="nx-activity-row flex items-center justify-between gap-4 rounded-2xl border border-transparent bg-white/[0.018] px-4 py-3.5">

                            <div class="flex min-w-0 items-center gap-3.5">

                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl border border-[#292F39] bg-[#0D1116] text-[#D88E8E]">

                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.5"
                                        class="h-5 w-5"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M6 4.75A1.75 1.75 0 0 1 7.75 3h8.5A1.75 1.75 0 0 1 18 4.75v14.5A1.75 1.75 0 0 1 16.25 21h-8.5A1.75 1.75 0 0 1 6 19.25V4.75Z"
                                        />
                                        <path
                                            stroke-linecap="round"
                                            d="M9 8h6M9 12h6M9 16h3"
                                        />
                                    </svg>

                                </div>


                                <div class="min-w-0">

                                    <div class="flex min-w-0 flex-wrap items-center gap-2">

                                        <p class="truncate text-sm font-medium text-[#F5F5F2]">
                                            {{ $expense->description ?? 'Expense' }}
                                        </p>

                                        <span class="rounded-lg border border-[#292F39] bg-[#0D1116] px-2 py-1 text-[9px] font-semibold uppercase tracking-[0.08em] text-[#858D99]">
                                            {{ $expense->category ?? 'Uncategorized' }}
                                        </span>

                                    </div>


                                    <div class="mt-1 flex flex-wrap items-center gap-2 text-[10px] text-[#666F7A]">

                                        <span>
                                            {{ $expense->expense_date
                                                ? \Carbon\Carbon::parse($expense->expense_date)->format('d M Y')
                                                : '—'
                                            }}
                                        </span>

                                        <span class="text-[#3E454F]">
                                            •
                                        </span>

                                        <span>
                                            {{ $expense->user?->name ?? 'System' }}
                                        </span>

                                    </div>

                                </div>

                            </div>


                            <div class="shrink-0 text-right">

                                <p class="text-sm font-semibold text-[#D88E8E]">
                                    Rp {{ number_format($expense->amount, 0, ',', '.') }}
                                </p>

                                <p class="mt-1 text-[9px] uppercase tracking-[0.12em] text-[#575F6B]">
                                    Expense
                                </p>

                            </div>

                        </div>

                    @endforeach

                </div>

            @else

                <div class="px-6 py-14 text-center">

                    <p class="text-sm text-[#707782]">
                        No expenses recorded yet.
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


                {{-- Sales Order --}}
                <a
                    href="{{ route('orders.create') }}"
                    class="nx-surface-soft nx-action rounded-2xl p-5"
                >

                    <div class="flex items-start justify-between gap-4">

                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#8B7CFF]/10 text-[#A99FFF]">
                            +
                        </div>

                        <span class="text-sm text-[#4D535D]">
                            ↗
                        </span>

                    </div>


                    <p class="mt-5 text-sm font-medium text-[#F5F5F2]">
                        Create Sales Order
                    </p>


                    <p class="mt-1 text-xs leading-5 text-[#707782]">
                        Record a new customer order.
                    </p>

                </a>


                {{-- Purchase Order --}}
                <a
                    href="{{ route('purchasing.create') }}"
                    class="nx-surface-soft nx-action rounded-2xl p-5"
                >

                    <div class="flex items-start justify-between gap-4">

                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#1D1828] text-[#BBA8EA]">
                            ◇
                        </div>

                        <span class="text-sm text-[#4D535D]">
                            ↗
                        </span>

                    </div>


                    <p class="mt-5 text-sm font-medium text-[#F5F5F2]">
                        Create Purchase Order
                    </p>


                    <p class="mt-1 text-xs leading-5 text-[#707782]">
                        Manage supplier purchasing.
                    </p>

                </a>


                {{-- Invoice --}}
                <a
                    href="{{ route('finance.invoices.index') }}"
                    class="nx-surface-soft nx-action rounded-2xl p-5"
                >

                    <div class="flex items-start justify-between gap-4">

                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#151D29] text-[#9EB6E8]">
                            □
                        </div>

                        <span class="text-sm text-[#4D535D]">
                            ↗
                        </span>

                    </div>


                    <p class="mt-5 text-sm font-medium text-[#F5F5F2]">
                        Manage Invoices
                    </p>


                    <p class="mt-1 text-xs leading-5 text-[#707782]">
                        Create and track customer invoices.
                    </p>

                </a>


                {{-- Customers --}}
                <a
                    href="{{ route('customers.index') }}"
                    class="nx-surface-soft nx-action rounded-2xl p-5"
                >

                    <div class="flex items-start justify-between gap-4">

                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#16201D] text-[#9FE2B5]">
                            ♙
                        </div>

                        <span class="text-sm text-[#4D535D]">
                            ↗
                        </span>

                    </div>


                    <p class="mt-5 text-sm font-medium text-[#F5F5F2]">
                        Manage Customers
                    </p>


                    <p class="mt-1 text-xs leading-5 text-[#707782]">
                        Review customer accounts.
                    </p>

                </a>

            </div>

        </section>

    </div>


    {{-- ================================================================ --}}
    {{-- CHART.JS --}}
    {{-- ================================================================ --}}

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <script>

        document.addEventListener('DOMContentLoaded', function () {


            /*
            |--------------------------------------------------------------------------
            | Financial Chart Data
            |--------------------------------------------------------------------------
            */

            const financialLabels = @json(
                $financialOverview->pluck('label')->values()
            );

            const revenueData = @json(
                $financialOverview->pluck('revenue')->values()
            );

            const expenseData = @json(
                $financialOverview->pluck('expenses')->values()
            );

            const profitData = @json(
                $financialOverview->pluck('profit')->values()
            );


            /*
            |--------------------------------------------------------------------------
            | Financial Performance
            |--------------------------------------------------------------------------
            */

            const financialCanvas =
                document.getElementById('financialChart');


            if (financialCanvas) {

                const ctx = financialCanvas.getContext('2d');


                const revenueGradient =
                    ctx.createLinearGradient(0, 0, 0, 350);

                revenueGradient.addColorStop(
                    0,
                    'rgba(139, 124, 255, 0.24)'
                );

                revenueGradient.addColorStop(
                    0.42,
                    'rgba(139, 124, 255, 0.08)'
                );

                revenueGradient.addColorStop(
                    1,
                    'rgba(139, 124, 255, 0.00)'
                );


                const expenseGradient =
                    ctx.createLinearGradient(0, 0, 0, 350);

                expenseGradient.addColorStop(
                    0,
                    'rgba(216, 142, 142, 0.10)'
                );

                expenseGradient.addColorStop(
                    0.5,
                    'rgba(216, 142, 142, 0.025)'
                );

                expenseGradient.addColorStop(
                    1,
                    'rgba(216, 142, 142, 0.00)'
                );


                const profitGradient =
                    ctx.createLinearGradient(0, 0, 0, 350);

                profitGradient.addColorStop(
                    0,
                    'rgba(158, 145, 255, 0.08)'
                );

                profitGradient.addColorStop(
                    0.55,
                    'rgba(158, 145, 255, 0.02)'
                );

                profitGradient.addColorStop(
                    1,
                    'rgba(158, 145, 255, 0.00)'
                );


                const revenuePointRadius =
                    revenueData.map(
                        (_, index) =>
                            index === revenueData.length - 1
                                ? 4.5
                                : 0
                    );


                const expensePointRadius =
                    expenseData.map(
                        (_, index) =>
                            index === expenseData.length - 1
                                ? 4.5
                                : 0
                    );


                const profitPointRadius =
                    profitData.map(
                        (_, index) =>
                            index === profitData.length - 1
                                ? 4.5
                                : 0
                    );


                new Chart(ctx, {

                    type: 'line',

                    data: {

                        labels: financialLabels,

                        datasets: [

                            {
                                label: 'Revenue',

                                data: revenueData,

                                borderColor: '#8B7CFF',

                                backgroundColor: revenueGradient,

                                borderWidth: 2.5,

                                pointBackgroundColor: '#A99FFF',

                                pointBorderColor: '#0E1319',

                                pointBorderWidth: 3,

                                pointRadius:
                                    revenuePointRadius,

                                pointHoverRadius: 6,

                                pointHoverBackgroundColor:
                                    '#F5F5F2',

                                pointHoverBorderColor:
                                    '#8B7CFF',

                                pointHoverBorderWidth: 3,

                                tension: 0.42,

                                fill: true,
                            },


                            {
                                label: 'Expenses',

                                data: expenseData,

                                borderColor: '#D88E8E',

                                backgroundColor: expenseGradient,

                                borderWidth: 2,

                                pointBackgroundColor: '#E3A2A2',

                                pointBorderColor: '#0E1319',

                                pointBorderWidth: 3,

                                pointRadius:
                                    expensePointRadius,

                                pointHoverRadius: 5.5,

                                pointHoverBackgroundColor:
                                    '#F5F5F2',

                                pointHoverBorderColor:
                                    '#D88E8E',

                                pointHoverBorderWidth: 3,

                                tension: 0.42,

                                fill: true,
                            },


                            {
                                label: 'Profit',

                                data: profitData,

                                borderColor: '#9E91FF',

                                backgroundColor: profitGradient,

                                borderWidth: 2,

                                pointBackgroundColor: '#B3A9FF',

                                pointBorderColor: '#0E1319',

                                pointBorderWidth: 3,

                                pointRadius:
                                    profitPointRadius,

                                pointHoverRadius: 5.5,

                                pointHoverBackgroundColor:
                                    '#F5F5F2',

                                pointHoverBorderColor:
                                    '#9E91FF',

                                pointHoverBorderWidth: 3,

                                tension: 0.42,

                                fill: true,
                            }

                        ]

                    },


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

                                displayColors: true,

                                cornerRadius: 12,

                                boxPadding: 5,

                                callbacks: {

                                    label: function (context) {

                                        return (
                                            context.dataset.label +
                                            ': Rp ' +
                                            new Intl.NumberFormat(
                                                'id-ID'
                                            ).format(context.raw)
                                        );

                                    }

                                }

                            }

                        },


                        scales: {

                            x: {

                                grid: {
                                    display: false,
                                    drawTicks: false,
                                },

                                ticks: {

                                    color: '#69717D',

                                    font: {
                                        size: 10,
                                    },

                                    padding: 10,

                                },

                                border: {
                                    display: false,
                                }

                            },


                            y: {

                                beginAtZero: true,

                                grid: {

                                    color:
                                        'rgba(255,255,255,0.045)',

                                    drawTicks: false,

                                },

                                ticks: {

                                    color: '#69717D',

                                    font: {
                                        size: 10,
                                    },

                                    padding: 10,

                                    callback: function (value) {

                                        return (
                                            'Rp ' +
                                            new Intl.NumberFormat(
                                                'id-ID',
                                                {
                                                    notation: 'compact',
                                                    maximumFractionDigits: 1
                                                }
                                            ).format(value)
                                        );

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
            | Invoice Status
            |--------------------------------------------------------------------------
            */

            const invoiceCanvas =
                document.getElementById('invoiceChart');


            if (invoiceCanvas) {

                new Chart(invoiceCanvas, {

                    type: 'doughnut',

                    data: {

                        labels: [
                            'Draft',
                            'Issued',
                            'Paid',
                            'Overdue',
                            'Cancelled'
                        ],

                        datasets: [{

                            data: [

                                {{ $invoiceSummary['draft'] ?? 0 }},

                                {{ $invoiceSummary['issued'] ?? 0 }},

                                {{ $invoiceSummary['paid'] ?? 0 }},

                                {{ $invoiceSummary['overdue'] ?? 0 }},

                                {{ $invoiceSummary['cancelled'] ?? 0 }}

                            ],

                            backgroundColor: [

                                '#69717D',
                                '#76A8F8',
                                '#63D889',
                                '#D88E8E',
                                '#BBA8EA'

                            ],

                            borderColor: '#0C1016',

                            borderWidth: 4,

                            hoverOffset: 7,

                            spacing: 2,

                        }]

                    },


                    options: {

                        responsive: true,

                        maintainAspectRatio: false,

                        cutout: '70%',

                        rotation: -90,


                        animation: {

                            animateRotate: true,

                            animateScale: true,

                            duration: 900,

                            easing: 'easeOutQuart',

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

                                padding: 12,

                                cornerRadius: 12,

                            }

                        }

                    }

                });

            }

        });

    </script>

</x-app-layout>