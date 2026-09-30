<x-app-layout>

    <style>

        .nexora-analytics {
            color: #F5F5F2;
        }

        .nx-surface {
            position: relative;
            overflow: hidden;
            border: 1px solid #242830;
            background: rgba(14, 19, 25, 0.95);
            box-shadow: 0 24px 80px rgba(0, 0, 0, 0.30);
            backdrop-filter: blur(18px);
        }

        .nx-surface-soft {
            position: relative;
            overflow: hidden;
            border: 1px solid #242830;
            background: rgba(15, 20, 26, 0.94);
            box-shadow: 0 20px 65px rgba(0, 0, 0, 0.26);
            backdrop-filter: blur(18px);
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
            border-color: rgba(139, 124, 255, 0.30);
            box-shadow:
                0 22px 70px rgba(0, 0, 0, 0.30),
                0 0 34px rgba(139, 124, 255, 0.06);
        }

        .nx-item {
            border: 1px solid #242830;
            background: rgba(10, 15, 20, 0.88);
            transition:
                border-color 180ms ease,
                background 180ms ease,
                transform 180ms ease,
                box-shadow 180ms ease;
        }

        .nx-item:hover {
            border-color: #343B47;
            background: rgba(13, 18, 24, 0.96);
            transform: translateY(-1px);
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.18);
        }

        .nx-noise {
            opacity: 0.16;
            background-image:
                radial-gradient(
                    rgba(255,255,255,0.10) 0.7px,
                    transparent 0.7px
                );
            background-size: 5px 5px;
            mask-image: linear-gradient(
                to bottom,
                black,
                transparent 85%
            );
            pointer-events: none;
        }

        .nx-chip {
            border: 1px solid rgba(58, 64, 74, 0.65);
            background: rgba(9, 12, 17, 0.58);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.02);
            backdrop-filter: blur(12px);
        }

        @media (prefers-reduced-motion: reduce) {

            .nx-kpi,
            .nx-item {
                transition: none !important;
            }

            .nx-kpi:hover,
            .nx-item:hover {
                transform: none !important;
            }

        }

    </style>


    <div class="nexora-analytics space-y-8">


        {{-- ============================================================
            HERO
        ============================================================ --}}

        <section class="relative overflow-hidden rounded-[26px] border border-[#242830] bg-[#0E1319]/95 shadow-[0_30px_100px_rgba(0,0,0,0.34)] backdrop-blur-xl">

            <div class="nx-noise absolute inset-0"></div>

            <div class="pointer-events-none absolute -right-24 -top-28 h-96 w-96 rounded-full bg-[#8B7CFF]/10 blur-3xl"></div>

            <div class="pointer-events-none absolute -bottom-28 left-20 h-80 w-80 rounded-full bg-[#3156C8]/7 blur-3xl"></div>

            <div class="relative px-6 py-7 sm:px-8 sm:py-8">

                <div class="flex flex-col gap-6 xl:flex-row xl:items-end xl:justify-between">

                    <div>

                        <div class="flex items-center gap-2">

                            <span class="h-1.5 w-1.5 rounded-full bg-[#8B7CFF] shadow-[0_0_14px_rgba(139,124,255,0.85)]"></span>

                            <p class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#737A86]">
                                Analytics
                            </p>

                        </div>

                        <h1 class="mt-3 text-3xl font-semibold tracking-[-0.03em] text-white sm:text-4xl">
                            Business Analytics
                        </h1>

                        <p class="mt-2 max-w-2xl text-sm leading-6 text-[#8B919A]">
                            Understand sales, customers, products, and inventory performance.
                        </p>

                    </div>


                    <div class="nx-chip rounded-xl px-4 py-3">

                        <p class="text-[9px] font-semibold uppercase tracking-[0.18em] text-[#626A76]">
                            Analysis Period
                        </p>

                        <div class="mt-1 flex items-center gap-2">

                            <span class="h-1.5 w-1.5 rounded-full bg-[#8B7CFF]"></span>

                            <p class="text-sm font-medium text-[#D9DCE1]">
                                Last 30 Days
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </section>



        {{-- ============================================================
            KPI CARDS
        ============================================================ --}}

        <section class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">


            {{-- Revenue --}}

            <div class="nx-surface nx-kpi rounded-2xl p-5">

                <div class="pointer-events-none absolute -right-14 -top-14 h-36 w-36 rounded-full bg-[#8B7CFF]/8 blur-3xl"></div>

                <div class="relative flex items-start justify-between">

                    <div>

                        <p class="text-[10px] font-semibold uppercase tracking-[0.15em] text-[#707782]">
                            Revenue
                        </p>

                        <p class="mt-3 text-2xl font-semibold tracking-tight text-[#F5F5F2]">
                            Rp {{ number_format($totalRevenue, 0, ',', '.') }}
                        </p>

                    </div>


                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl border border-[#8B7CFF]/15 bg-[#1C1930] text-[#9C91FF]">

                        <svg
                            class="h-5 w-5"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.7"
                        >
                            <path d="M4 18V6" stroke-linecap="round" />
                            <path d="M4 18h16" stroke-linecap="round" />
                            <path
                                d="M7 14.5l3.5-3.5 3 2 4.5-5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                            <path
                                d="M15.5 8h2.5v2.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                        </svg>

                    </div>

                </div>

                <div class="relative mt-4 flex items-center justify-between">

                    <p class="text-xs text-[#707782]">
                        Completed sales
                    </p>

                    <span class="h-1.5 w-10 rounded-full bg-gradient-to-r from-[#8B7CFF]/70 to-transparent"></span>

                </div>

            </div>



            {{-- Orders --}}

            <div class="nx-surface nx-kpi rounded-2xl p-5">

                <div class="pointer-events-none absolute -right-14 -top-14 h-36 w-36 rounded-full bg-sky-400/5 blur-3xl"></div>

                <div class="relative flex items-start justify-between">

                    <div>

                        <p class="text-[10px] font-semibold uppercase tracking-[0.15em] text-[#707782]">
                            Completed Orders
                        </p>

                        <p class="mt-3 text-2xl font-semibold tracking-tight text-[#F5F5F2]">
                            {{ number_format($totalOrders, 0, ',', '.') }}
                        </p>

                    </div>


                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl border border-sky-300/10 bg-[#151D29] text-[#9EB6E8]">

                        <svg
                            class="h-5 w-5"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.7"
                        >
                            <rect
                                x="4"
                                y="5"
                                width="16"
                                height="14"
                                rx="2.5"
                            />

                            <path
                                d="M8 9h8M8 13h5"
                                stroke-linecap="round"
                            />

                            <path
                                d="M15.5 16.5h.01"
                                stroke-linecap="round"
                            />
                        </svg>

                    </div>

                </div>

                <div class="relative mt-4 flex items-center justify-between">

                    <p class="text-xs text-[#707782]">
                        Successfully completed
                    </p>

                    <span class="h-1.5 w-10 rounded-full bg-gradient-to-r from-[#9EB6E8]/60 to-transparent"></span>

                </div>

            </div>



            {{-- Average Order --}}

            <div class="nx-surface nx-kpi rounded-2xl p-5">

                <div class="pointer-events-none absolute -right-14 -top-14 h-36 w-36 rounded-full bg-violet-400/5 blur-3xl"></div>

                <div class="relative flex items-start justify-between">

                    <div>

                        <p class="text-[10px] font-semibold uppercase tracking-[0.15em] text-[#707782]">
                            Average Order
                        </p>

                        <p class="mt-3 text-2xl font-semibold tracking-tight text-[#F5F5F2]">
                            Rp {{ number_format($averageOrderValue, 0, ',', '.') }}
                        </p>

                    </div>


                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl border border-violet-300/10 bg-violet-300/10 text-violet-300">

                        <svg
                            class="h-5 w-5"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.7"
                        >
                            <path d="M5 18V9" stroke-linecap="round" />
                            <path d="M12 18V5" stroke-linecap="round" />
                            <path d="M19 18v-6" stroke-linecap="round" />
                        </svg>

                    </div>

                </div>

                <div class="relative mt-4 flex items-center justify-between">

                    <p class="text-xs text-[#707782]">
                        Average completed order
                    </p>

                    <span class="h-1.5 w-10 rounded-full bg-gradient-to-r from-violet-300/60 to-transparent"></span>

                </div>

            </div>



            {{-- Cancelled --}}

            <div class="nx-surface nx-kpi rounded-2xl p-5">

                <div class="pointer-events-none absolute -right-14 -top-14 h-36 w-36 rounded-full bg-rose-400/5 blur-3xl"></div>

                <div class="relative flex items-start justify-between">

                    <div>

                        <p class="text-[10px] font-semibold uppercase tracking-[0.15em] text-[#707782]">
                            Cancelled Orders
                        </p>

                        <p class="mt-3 text-2xl font-semibold tracking-tight text-[#F5F5F2]">
                            {{ number_format($cancelledOrders, 0, ',', '.') }}
                        </p>

                    </div>


                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl border border-rose-300/10 bg-rose-300/10 text-rose-300">

                        <svg
                            class="h-5 w-5"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.7"
                        >
                            <circle
                                cx="12"
                                cy="12"
                                r="8.25"
                            />

                            <path
                                d="M9 9l6 6M15 9l-6 6"
                                stroke-linecap="round"
                            />
                        </svg>

                    </div>

                </div>

                <div class="relative mt-4 flex items-center justify-between">

                    <p class="text-xs text-[#707782]">
                        Cancelled sales orders
                    </p>

                    <span class="h-1.5 w-10 rounded-full bg-gradient-to-r from-rose-300/60 to-transparent"></span>

                </div>

            </div>

        </section>



        {{-- ============================================================
            SALES TREND + ORDER STATUS
        ============================================================ --}}

        <section class="grid gap-6 xl:grid-cols-3">


            {{-- Sales Performance --}}

            <div class="nx-surface rounded-[26px] xl:col-span-2">

                <div class="pointer-events-none absolute -right-28 -top-28 h-96 w-96 rounded-full bg-[#8B7CFF]/8 blur-3xl"></div>

                <div class="pointer-events-none absolute left-[26%] bottom-[-120px] h-80 w-80 rounded-full bg-[#5364F6]/5 blur-3xl"></div>


                <div class="relative flex flex-col gap-4 border-b border-[#242830] px-6 py-5 sm:flex-row sm:items-end sm:justify-between">

                    <div>

                        <div class="flex items-center gap-2">

                            <span class="h-1.5 w-1.5 rounded-full bg-[#8B7CFF] shadow-[0_0_12px_rgba(139,124,255,0.7)]"></span>

                            <p class="text-[9px] font-semibold uppercase tracking-[0.18em] text-[#626A76]">
                                Performance
                            </p>

                        </div>

                        <h2 class="mt-2 text-base font-semibold text-white">
                            Sales Performance
                        </h2>

                        <p class="mt-1 text-xs leading-5 text-[#707782]">
                            Daily completed sales for the last 30 days.
                        </p>

                    </div>


                    <span class="nx-chip inline-flex w-fit items-center rounded-xl px-3 py-1.5 text-[10px] font-medium uppercase tracking-[0.13em] text-[#7D8591]">
                        30 Days
                    </span>

                </div>


                <div class="relative flex flex-wrap items-center gap-x-5 gap-y-2 px-6 pt-5">

                    <div class="flex items-center gap-2">

                        <span class="h-2 w-2 rounded-full bg-[#8B7CFF] shadow-[0_0_9px_rgba(139,124,255,0.65)]"></span>

                        <span class="text-[10px] text-[#808792]">
                            Sales
                        </span>

                    </div>

                </div>


                <div class="relative px-6 pb-7 pt-2">

                    <div class="relative h-[350px]">

                        <canvas id="salesTrendChart"></canvas>

                    </div>

                </div>

            </div>



            {{-- Order Status --}}

            <div class="nx-surface rounded-[26px]">

                <div class="pointer-events-none absolute -right-24 -top-24 h-80 w-80 rounded-full bg-[#6557FF]/10 blur-3xl"></div>

                <div class="pointer-events-none absolute -left-20 bottom-[-90px] h-64 w-64 rounded-full bg-[#3156C8]/6 blur-3xl"></div>


                <div class="relative border-b border-[#242830] px-6 py-5">

                    <div class="flex items-center justify-between gap-4">

                        <div>

                            <p class="text-[9px] font-semibold uppercase tracking-[0.18em] text-[#626A76]">
                                Orders
                            </p>

                            <h2 class="mt-2 text-base font-semibold text-white">
                                Order Status
                            </h2>

                            <p class="mt-1 text-xs leading-5 text-[#707782]">
                                Current order distribution.
                            </p>

                        </div>


                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl border border-[#8B7CFF]/15 bg-[#8B7CFF]/10 text-[#A99FFF]">

                            <svg
                                class="h-4 w-4"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.6"
                            >
                                <circle
                                    cx="12"
                                    cy="12"
                                    r="8.5"
                                />

                                <path
                                    d="M8.5 12.5l2.2 2.2 4.8-5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />
                            </svg>

                        </div>

                    </div>

                </div>


                @php

                    $orderStatuses = [

                        'pending' => [
                            'label' => 'Pending',
                            'dot' => 'bg-[#D9C57A]',
                            'glow' => 'shadow-[0_0_8px_rgba(217,197,122,0.35)]',
                        ],

                        'confirmed' => [
                            'label' => 'Confirmed',
                            'dot' => 'bg-[#9EB6E8]',
                            'glow' => 'shadow-[0_0_9px_rgba(158,182,232,0.45)]',
                        ],

                        'processing' => [
                            'label' => 'Processing',
                            'dot' => 'bg-[#BBA8EA]',
                            'glow' => 'shadow-[0_0_9px_rgba(187,168,234,0.45)]',
                        ],

                        'completed' => [
                            'label' => 'Completed',
                            'dot' => 'bg-[#63D889]',
                            'glow' => 'shadow-[0_0_10px_rgba(99,216,137,0.5)]',
                        ],

                        'cancelled' => [
                            'label' => 'Cancelled',
                            'dot' => 'bg-[#D88E8E]',
                            'glow' => 'shadow-[0_0_9px_rgba(216,142,142,0.45)]',
                        ],

                    ];

                    $orderTotalCount = collect($orderStatusSummary)->sum();

                @endphp


                <div class="relative px-6 py-6">

                    <div class="relative mx-auto h-[220px] w-[220px]">

                        <div class="pointer-events-none absolute inset-8 rounded-full bg-[#6557FF]/10 blur-3xl"></div>

                        <div class="absolute inset-2 rounded-full border border-[#8B7CFF]/5"></div>

                        <canvas
                            id="orderStatusChart"
                            class="relative z-10"
                        ></canvas>


                        <div class="pointer-events-none absolute inset-0 z-20 flex items-center justify-center">

                            <div class="text-center">

                                <p class="text-[27px] font-semibold tracking-[-0.045em] text-white">
                                    {{ number_format($orderTotalCount) }}
                                </p>

                                <p class="mt-1 text-[9px] font-medium uppercase tracking-[0.18em] text-[#747C88]">
                                    Total Orders
                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="mt-6 space-y-2">

                        @foreach ($orderStatuses as $status => $config)

                            <div class="nx-item flex items-center justify-between rounded-xl px-3 py-2.5">

                                <div class="flex items-center gap-3">

                                    <span
                                        class="h-2 w-2 rounded-full {{ $config['dot'] }} {{ $config['glow'] }}"
                                    ></span>

                                    <span class="text-xs text-[#8B919A]">
                                        {{ $config['label'] }}
                                    </span>

                                </div>

                                <span class="text-xs font-medium text-white">
                                    {{ $orderStatusSummary[$status] ?? 0 }}
                                </span>

                            </div>

                        @endforeach

                    </div>

                </div>

            </div>

        </section>



        {{-- ============================================================
            PRODUCT + CATEGORY ANALYTICS
        ============================================================ --}}

        <section class="grid gap-6 xl:grid-cols-2">


            {{-- ========================================================
                TOP SELLING PRODUCTS
            ======================================================== --}}

            <div class="nx-surface rounded-[26px]">

                <div class="pointer-events-none absolute -left-20 top-0 h-56 w-56 rounded-full bg-violet-400/6 blur-3xl"></div>


                <div class="relative flex items-center justify-between border-b border-[#242830] px-6 py-5">

                    <div>

                        <p class="text-[9px] font-semibold uppercase tracking-[0.18em] text-[#626A76]">
                            Product Performance
                        </p>

                        <h2 class="mt-2 text-base font-semibold text-white">
                            Top Selling Products
                        </h2>

                        <p class="mt-1 text-xs text-[#707782]">
                            Products ranked by units sold.
                        </p>

                    </div>


                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl border border-violet-300/10 bg-violet-300/8 text-violet-300">

                        <svg
                            class="h-4 w-4"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.6"
                        >
                            <path
                                d="M5 18V6"
                                stroke-linecap="round"
                            />

                            <path
                                d="M5 18h14"
                                stroke-linecap="round"
                            />

                            <path
                                d="M8 15l3-4 3 2 3-5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                        </svg>

                    </div>

                </div>


                @if ($topProducts->count())

                    <div class="relative space-y-3 p-6">

                        @foreach ($topProducts as $index => $product)

                            <div class="nx-item group flex items-center gap-4 rounded-2xl p-4">

                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl border border-[#292F39] bg-[#0B1016] text-[10px] font-semibold tracking-[0.08em] text-[#7D8591]">
                                    {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                                </div>


                                <div class="min-w-0 flex-1">

                                    <p class="truncate text-sm font-medium text-[#F5F5F2]">
                                        {{ $product->product_name }}
                                    </p>

                                    <div class="mt-2 flex items-center gap-2">

                                        <span class="text-[11px] text-[#666F7A]">
                                            {{ number_format($product->total_quantity, 0, ',', '.') }} units
                                        </span>

                                        <span class="text-[#3E454F]">
                                            •
                                        </span>

                                        <span class="text-[11px] text-[#666F7A]">
                                            {{ number_format($product->total_sales, 0, ',', '.') }} sales
                                        </span>

                                    </div>

                                </div>


                                <div class="shrink-0 text-right">

                                    <p class="text-sm font-semibold text-[#D9DCE1]">
                                        Rp {{ number_format($product->total_sales, 0, ',', '.') }}
                                    </p>

                                    <p class="mt-1 text-[10px] uppercase tracking-[0.12em] text-[#555D68]">
                                        Revenue
                                    </p>

                                </div>

                            </div>

                        @endforeach

                    </div>

                @else

                    <div class="relative px-6 py-16 text-center">

                        <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-2xl border border-[#242830] bg-[#0B1016] text-[#555C67]">

                            <svg
                                class="h-5 w-5"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.6"
                            >
                                <rect
                                    x="5"
                                    y="5"
                                    width="14"
                                    height="14"
                                    rx="2.5"
                                />
                            </svg>

                        </div>

                        <p class="mt-4 text-sm font-medium text-white">
                            No completed product sales yet
                        </p>

                    </div>

                @endif

            </div>



            {{-- ========================================================
                SALES BY CATEGORY
            ======================================================== --}}

            <div class="nx-surface rounded-[26px]">

                <div class="pointer-events-none absolute -right-20 top-0 h-56 w-56 rounded-full bg-[#8B7CFF]/7 blur-3xl"></div>


                <div class="relative border-b border-[#242830] px-6 py-5">

                    <p class="text-[9px] font-semibold uppercase tracking-[0.18em] text-[#626A76]">
                        Revenue Distribution
                    </p>

                    <h2 class="mt-2 text-base font-semibold text-white">
                        Sales by Category
                    </h2>

                    <p class="mt-1 text-xs text-[#707782]">
                        Revenue distribution across product categories.
                    </p>

                </div>


                <div class="relative p-6">

                    <div class="rounded-2xl border border-[#242830] bg-[#0A0F14] p-5">

                        <div class="flex items-center justify-between">

                            <div>

                                <p class="text-[9px] font-semibold uppercase tracking-[0.14em] text-[#626A76]">
                                    Category Revenue
                                </p>

                                <p class="mt-1 text-sm font-medium text-white">
                                    Revenue distribution
                                </p>

                            </div>

                            <span class="h-1.5 w-10 rounded-full bg-gradient-to-r from-[#8B7CFF]/70 to-transparent"></span>

                        </div>


                        <div class="relative mt-5 h-[300px]">

                            <canvas id="categoryChart"></canvas>

                        </div>

                    </div>

                </div>

            </div>

        </section>



        {{-- ============================================================
            CUSTOMER + INVENTORY
        ============================================================ --}}

        <section class="grid gap-6 xl:grid-cols-2">


            {{-- ========================================================
                CUSTOMER PERFORMANCE
            ======================================================== --}}

            <div class="nx-surface rounded-[26px]">

                <div class="pointer-events-none absolute -left-20 top-0 h-56 w-56 rounded-full bg-[#8B7CFF]/6 blur-3xl"></div>


                <div class="relative flex items-center justify-between border-b border-[#242830] px-6 py-5">

                    <div>

                        <p class="text-[9px] font-semibold uppercase tracking-[0.18em] text-[#626A76]">
                            Customer Value
                        </p>

                        <h2 class="mt-2 text-base font-semibold text-white">
                            Customer Performance
                        </h2>

                        <p class="mt-1 text-xs text-[#707782]">
                            Customers ranked by completed purchase value.
                        </p>

                    </div>


                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl border border-[#8B7CFF]/10 bg-[#8B7CFF]/8 text-[#A99FFF]">

                        <svg
                            class="h-4 w-4"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.6"
                        >
                            <circle
                                cx="12"
                                cy="8"
                                r="3"
                            />

                            <path
                                d="M6.5 19c.5-3.1 2.5-5 5.5-5s5 1.9 5.5 5"
                                stroke-linecap="round"
                            />
                        </svg>

                    </div>

                </div>


                @if ($customerPerformance->count())

                    <div class="relative space-y-3 p-6">

                        @foreach ($customerPerformance as $index => $customer)

                            <div class="nx-item group flex items-center gap-4 rounded-2xl p-4">


                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full border border-[#8B7CFF]/10 bg-[#17132D] text-xs font-semibold text-[#A99FFF]">

                                    {{ strtoupper(substr($customer->name, 0, 1)) }}

                                </div>


                                <div class="min-w-0 flex-1">

                                    <p class="truncate text-sm font-medium text-[#F5F5F2]">
                                        {{ $customer->name }}
                                    </p>

                                    <p class="mt-1 text-[11px] text-[#666F7A]">
                                        {{ number_format($customer->total_orders, 0, ',', '.') }} completed orders
                                    </p>

                                </div>


                                <div class="shrink-0 text-right">

                                    <p class="text-sm font-semibold text-[#D9DCE1]">
                                        Rp {{ number_format($customer->total_spent, 0, ',', '.') }}
                                    </p>

                                    <p class="mt-1 text-[10px] uppercase tracking-[0.12em] text-[#555D68]">
                                        Total Spent
                                    </p>

                                </div>

                            </div>

                        @endforeach

                    </div>

                @else

                    <div class="relative px-6 py-16 text-center">

                        <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-2xl border border-[#242830] bg-[#0B1016] text-[#555C67]">

                            <svg
                                class="h-5 w-5"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.6"
                            >
                                <circle
                                    cx="12"
                                    cy="8"
                                    r="3"
                                />

                                <path
                                    d="M6.5 19c.5-3.1 2.5-5 5.5-5s5 1.9 5.5 5"
                                    stroke-linecap="round"
                                />
                            </svg>

                        </div>

                        <p class="mt-4 text-sm font-medium text-white">
                            No completed customer transactions yet
                        </p>

                    </div>

                @endif

            </div>



            {{-- ========================================================
                INVENTORY HEALTH
            ======================================================== --}}

            @php

                $availableStockUnits = max(
                    0,
                    $totalStockUnits - $totalReservedUnits
                );

                $stockBase = max(
                    1,
                    $totalStockUnits
                );

                $reservedPercentage = min(
                    100,
                    max(
                        0,
                        ($totalReservedUnits / $stockBase) * 100
                    )
                );

                $availablePercentage = min(
                    100,
                    max(
                        0,
                        ($availableStockUnits / $stockBase) * 100
                    )
                );

            @endphp


            <div class="nx-surface rounded-[26px]">

                <div class="pointer-events-none absolute -right-20 top-0 h-56 w-56 rounded-full bg-emerald-400/5 blur-3xl"></div>


                <div class="relative border-b border-[#242830] px-6 py-5">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-[9px] font-semibold uppercase tracking-[0.18em] text-[#626A76]">
                                Inventory
                            </p>

                            <h2 class="mt-2 text-base font-semibold text-white">
                                Inventory Health
                            </h2>

                            <p class="mt-1 text-xs text-[#707782]">
                                Current inventory condition across warehouses.
                            </p>

                        </div>


                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl border border-emerald-300/10 bg-emerald-300/8 text-emerald-300">

                            <svg
                                class="h-4 w-4"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.6"
                            >
                                <rect
                                    x="4.5"
                                    y="5"
                                    width="15"
                                    height="14"
                                    rx="2.5"
                                />

                                <path
                                    d="M8 9h8M8 13h8M8 17h4"
                                    stroke-linecap="round"
                                />
                            </svg>

                        </div>

                    </div>

                </div>


                <div class="relative p-6">


                    {{-- Main inventory cards --}}

                    <div class="grid grid-cols-2 gap-3">


                        {{-- Total Units --}}

                        <div class="nx-item rounded-2xl p-4">

                            <p class="text-[9px] font-semibold uppercase tracking-[0.14em] text-[#626A76]">
                                Total Units
                            </p>

                            <p class="mt-2 text-2xl font-semibold tracking-[-0.03em] text-white">
                                {{ number_format($totalStockUnits, 0, ',', '.') }}
                            </p>

                            <p class="mt-1 text-[11px] text-[#666F7A]">
                                Physical stock
                            </p>

                        </div>


                        {{-- Reserved --}}

                        <div class="nx-item rounded-2xl p-4">

                            <p class="text-[9px] font-semibold uppercase tracking-[0.14em] text-[#626A76]">
                                Reserved
                            </p>

                            <p class="mt-2 text-2xl font-semibold tracking-[-0.03em] text-[#A99FFF]">
                                {{ number_format($totalReservedUnits, 0, ',', '.') }}
                            </p>

                            <p class="mt-1 text-[11px] text-[#666F7A]">
                                Reserved units
                            </p>

                        </div>


                        {{-- Low Stock --}}

                        <div class="nx-item rounded-2xl border-amber-300/10 p-4">

                            <p class="text-[9px] font-semibold uppercase tracking-[0.14em] text-[#626A76]">
                                Low Stock
                            </p>

                            <p class="mt-2 text-2xl font-semibold tracking-[-0.03em] text-amber-300">
                                {{ number_format($lowStockCount, 0, ',', '.') }}
                            </p>

                            <p class="mt-1 text-[11px] text-[#666F7A]">
                                Reorder required
                            </p>

                        </div>


                        {{-- Out of Stock --}}

                        <div class="nx-item rounded-2xl border-rose-300/10 p-4">

                            <p class="text-[9px] font-semibold uppercase tracking-[0.14em] text-[#626A76]">
                                Out of Stock
                            </p>

                            <p class="mt-2 text-2xl font-semibold tracking-[-0.03em] text-rose-300">
                                {{ number_format($outOfStockCount, 0, ',', '.') }}
                            </p>

                            <p class="mt-1 text-[11px] text-[#666F7A]">
                                No available stock
                            </p>

                        </div>

                    </div>


                    {{-- Availability visualization --}}

                    <div class="mt-6 rounded-2xl border border-[#242830] bg-[#0A0F14] p-5">

                        <div class="flex items-center justify-between">

                            <div>

                                <p class="text-[9px] font-semibold uppercase tracking-[0.14em] text-[#626A76]">
                                    Stock Allocation
                                </p>

                                <p class="mt-1 text-sm font-medium text-white">
                                    Physical vs reserved
                                </p>

                            </div>

                            <span class="text-[10px] text-[#666F7A]">
                                {{ number_format($availableStockUnits, 0, ',', '.') }} available
                            </span>

                        </div>


                        <div class="mt-5">

                            <div class="h-2 overflow-hidden rounded-full bg-[#171C23]">

                                <div
                                    class="h-full rounded-full bg-gradient-to-r from-[#8B7CFF] to-[#6E61E5]"
                                    style="width: {{ $availablePercentage }}%;"
                                ></div>

                            </div>

                        </div>


                        <div class="mt-4 flex items-center justify-between text-[10px]">

                            <div class="flex items-center gap-2">

                                <span class="h-1.5 w-1.5 rounded-full bg-[#8B7CFF]"></span>

                                <span class="text-[#707782]">
                                    Available
                                </span>

                            </div>


                            <span class="font-medium text-[#AEB4BE]">
                                {{ number_format($availableStockUnits, 0, ',', '.') }}
                            </span>

                        </div>


                        <div class="mt-2 flex items-center justify-between text-[10px]">

                            <div class="flex items-center gap-2">

                                <span class="h-1.5 w-1.5 rounded-full bg-[#59616D]"></span>

                                <span class="text-[#707782]">
                                    Reserved
                                </span>

                            </div>


                            <span class="font-medium text-[#AEB4BE]">
                                {{ number_format($totalReservedUnits, 0, ',', '.') }}
                            </span>

                        </div>

                    </div>


                    {{-- Stock Movement --}}

                    <div class="mt-6 border-t border-[#242830] pt-6">

                        <div class="flex items-center justify-between">

                            <div>

                                <p class="text-[9px] font-semibold uppercase tracking-[0.14em] text-[#626A76]">
                                    Activity
                                </p>

                                <p class="mt-1 text-sm font-medium text-white">
                                    Stock Movement · 30 Days
                                </p>

                            </div>

                        </div>


                        @if ($stockMovementSummary->count())

                            <div class="mt-4 space-y-3">

                                @foreach ($stockMovementSummary as $movement)

                                    <div class="nx-item group flex items-center justify-between rounded-2xl px-4 py-3">

                                        <div class="flex items-center gap-3">

                                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl border border-[#292F39] bg-[#0B1016] text-[10px] font-semibold uppercase text-[#8B919A]">

                                                {{ strtoupper(substr($movement->type, 0, 1)) }}

                                            </div>

                                            <span class="text-sm capitalize text-[#C5CAD2]">
                                                {{ str_replace('_', ' ', $movement->type) }}
                                            </span>

                                        </div>

                                        <span class="text-sm font-semibold text-white">
                                            {{ number_format($movement->total, 0, ',', '.') }}
                                        </span>

                                    </div>

                                @endforeach

                            </div>

                        @else

                            <div class="nx-item mt-4 rounded-2xl px-4 py-4">

                                <p class="text-sm text-[#707782]">
                                    No stock movement recorded during this period.
                                </p>

                            </div>

                        @endif

                    </div>

                </div>

            </div>

        </section>



        {{-- ============================================================
            BUSINESS SUMMARY
        ============================================================ --}}

        <section class="grid gap-6 xl:grid-cols-3">


            {{-- Customers --}}

            <div class="nx-surface-soft nx-kpi rounded-[24px] p-6">

                <div class="pointer-events-none absolute -right-12 -top-12 h-32 w-32 rounded-full bg-[#8B7CFF]/6 blur-3xl"></div>


                <div class="relative flex items-start justify-between">

                    <div>

                        <p class="text-[9px] font-semibold uppercase tracking-[0.16em] text-[#626A76]">
                            Customers
                        </p>

                        <p class="mt-3 text-3xl font-semibold tracking-[-0.04em] text-white">
                            {{ number_format($totalCustomers, 0, ',', '.') }}
                        </p>

                    </div>


                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl border border-[#8B7CFF]/10 bg-[#8B7CFF]/8 text-[#A99FFF]">

                        <svg
                            class="h-5 w-5"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.7"
                        >
                            <circle
                                cx="12"
                                cy="8"
                                r="3"
                            />

                            <path
                                d="M6.5 19c.5-3.1 2.5-5 5.5-5s5 1.9 5.5 5"
                                stroke-linecap="round"
                            />
                        </svg>

                    </div>

                </div>


                <div class="relative mt-5 flex items-center justify-between border-t border-[#242830] pt-4">

                    <span class="text-xs text-[#707782]">
                        Active customers
                    </span>

                    <span class="text-xs font-semibold text-emerald-300">
                        {{ number_format($activeCustomers, 0, ',', '.') }}
                    </span>

                </div>

            </div>



            {{-- Products --}}

            <div class="nx-surface-soft nx-kpi rounded-[24px] p-6">

                <div class="pointer-events-none absolute -right-12 -top-12 h-32 w-32 rounded-full bg-sky-400/5 blur-3xl"></div>


                <div class="relative flex items-start justify-between">

                    <div>

                        <p class="text-[9px] font-semibold uppercase tracking-[0.16em] text-[#626A76]">
                            Active Products
                        </p>

                        <p class="mt-3 text-3xl font-semibold tracking-[-0.04em] text-white">
                            {{ number_format($totalProducts, 0, ',', '.') }}
                        </p>

                    </div>


                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl border border-sky-300/10 bg-sky-300/8 text-sky-300">

                        <svg
                            class="h-5 w-5"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.7"
                        >
                            <path
                                d="M5 7.5L12 4l7 3.5v9L12 20l-7-3.5v-9Z"
                                stroke-linejoin="round"
                            />

                            <path
                                d="M5 7.5L12 11l7-3.5M12 11v9"
                                stroke-linejoin="round"
                            />
                        </svg>

                    </div>

                </div>


                <div class="relative mt-5 border-t border-[#242830] pt-4">

                    <span class="text-xs text-[#707782]">
                        Active product variants
                    </span>

                </div>

            </div>



            {{-- Available Stock --}}

            <div class="nx-surface-soft nx-kpi rounded-[24px] p-6">

                <div class="pointer-events-none absolute -right-12 -top-12 h-32 w-32 rounded-full bg-emerald-400/5 blur-3xl"></div>


                <div class="relative flex items-start justify-between">

                    <div>

                        <p class="text-[9px] font-semibold uppercase tracking-[0.16em] text-[#626A76]">
                            Available Stock
                        </p>

                        <p class="mt-3 text-3xl font-semibold tracking-[-0.04em] text-white">
                            {{ number_format($availableStockUnits, 0, ',', '.') }}
                        </p>

                    </div>


                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl border border-emerald-300/10 bg-emerald-300/8 text-emerald-300">

                        <svg
                            class="h-5 w-5"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.7"
                        >
                            <circle
                                cx="12"
                                cy="12"
                                r="8"
                            />

                            <path
                                d="M8.5 12l2.3 2.3 4.8-5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                        </svg>

                    </div>

                </div>


                <div class="relative mt-5 border-t border-[#242830] pt-4">

                    <span class="text-xs text-[#707782]">
                        Physical stock minus reservations
                    </span>

                </div>

            </div>

        </section>



        {{-- ============================================================
            RECENT COMPLETED SALES
        ============================================================ --}}

        <section class="nx-surface rounded-[26px]">

            <div class="pointer-events-none absolute left-[35%] top-[-80px] h-56 w-56 rounded-full bg-[#8B7CFF]/5 blur-3xl"></div>


            <div class="relative flex items-center justify-between border-b border-[#242830] px-6 py-5">

                <div>

                    <p class="text-[9px] font-semibold uppercase tracking-[0.18em] text-[#626A76]">
                        Sales Activity
                    </p>

                    <h2 class="mt-2 text-base font-semibold text-white">
                        Recent Completed Sales
                    </h2>

                    <p class="mt-1 text-xs text-[#707782]">
                        Latest successfully completed orders.
                    </p>

                </div>


                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl border border-emerald-300/10 bg-emerald-300/8 text-emerald-300">

                    <svg
                        class="h-4 w-4"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.6"
                    >
                        <path
                            d="M5 12.5l4 4L19 7"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                    </svg>

                </div>

            </div>


            @if ($recentSales->count())

                <div class="relative space-y-3 p-6">

                    @foreach ($recentSales as $order)

                        <div class="nx-item group flex flex-col gap-4 rounded-2xl p-4 md:flex-row md:items-center md:justify-between">

                            <div class="flex min-w-0 items-center gap-4">

                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl border border-emerald-300/10 bg-[#0B1210] text-emerald-300 transition group-hover:border-emerald-300/20">

                                    <svg
                                        class="h-4 w-4"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.6"
                                    >
                                        <rect
                                            x="4"
                                            y="5"
                                            width="16"
                                            height="14"
                                            rx="2.5"
                                        />

                                        <path
                                            d="M8 9h8M8 13h5"
                                            stroke-linecap="round"
                                        />
                                    </svg>

                                </div>


                                <div class="min-w-0">

                                    <p class="truncate text-sm font-medium text-[#F5F5F2]">
                                        {{ $order->order_number }}
                                    </p>

                                    <div class="mt-1 flex flex-wrap items-center gap-2 text-[11px] text-[#666F7A]">

                                        <span>
                                            {{ $order->customer?->name ?? '—' }}
                                        </span>

                                        <span class="text-[#3E454F]">
                                            •
                                        </span>

                                        <span>
                                            {{ $order->warehouse?->name ?? '—' }}
                                        </span>

                                        <span class="text-[#3E454F]">
                                            •
                                        </span>

                                        <span>
                                            {{ $order->ordered_at
                                                ? $order->ordered_at->format('d M Y, H:i')
                                                : '—'
                                            }}
                                        </span>

                                    </div>

                                </div>

                            </div>


                            <div class="shrink-0 text-left md:text-right">

                                <p class="text-sm font-semibold text-emerald-300">
                                    Rp {{ number_format($order->total, 0, ',', '.') }}
                                </p>

                                <span class="mt-1 inline-flex items-center gap-2 text-[10px] font-medium uppercase tracking-[0.12em] text-[#59616D]">

                                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-300"></span>

                                    Completed

                                </span>

                            </div>

                        </div>

                    @endforeach

                </div>

            @else

                <div class="relative p-6">

                    <div class="nx-item rounded-2xl px-6 py-12 text-center">

                        <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-2xl border border-[#242830] bg-[#0B1016] text-[#555C67]">

                            <svg
                                class="h-5 w-5"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.6"
                            >
                                <path
                                    d="M5 12.5l4 4L19 7"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />
                            </svg>

                        </div>

                        <p class="mt-4 text-sm font-medium text-white">
                            No completed sales yet
                        </p>

                    </div>

                </div>

            @endif

        </section>

    </div>



    {{-- ================================================================
        CHART.JS
    ================================================================= --}}

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <script>

        document.addEventListener('DOMContentLoaded', function () {


            /*
            |--------------------------------------------------------------------------
            | Sales Trend
            |--------------------------------------------------------------------------
            */

            const salesLabels = @json(
                $salesTrend->pluck('label')->values()
            );

            const salesData = @json(
                $salesTrend->pluck('total')->values()
            );


            const salesCanvas = document.getElementById('salesTrendChart');


            if (salesCanvas) {

                const salesContext = salesCanvas.getContext('2d');


                const salesGradient = salesContext.createLinearGradient(
                    0,
                    0,
                    0,
                    350
                );


                salesGradient.addColorStop(
                    0,
                    'rgba(139, 124, 255, 0.25)'
                );

                salesGradient.addColorStop(
                    0.45,
                    'rgba(139, 124, 255, 0.08)'
                );

                salesGradient.addColorStop(
                    1,
                    'rgba(139, 124, 255, 0)'
                );


                const salesPointRadius = salesData.map(
                    (_, index) => index === salesData.length - 1 ? 4.5 : 0
                );


                new Chart(salesContext, {

                    type: 'line',

                    data: {

                        labels: salesLabels,

                        datasets: [

                            {

                                label: 'Sales',

                                data: salesData,

                                borderColor: '#8B7CFF',

                                backgroundColor: salesGradient,

                                borderWidth: 2.5,

                                pointBackgroundColor: '#A99FFF',

                                pointBorderColor: '#0E1319',

                                pointBorderWidth: 3,

                                pointRadius: salesPointRadius,

                                pointHoverRadius: 6,

                                pointHoverBackgroundColor: '#F5F5F2',

                                pointHoverBorderColor: '#8B7CFF',

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

                                backgroundColor: '#0A0E13',

                                borderColor: '#2B313A',

                                borderWidth: 1,

                                titleColor: '#F5F5F2',

                                bodyColor: '#C5CAD2',

                                padding: 13,

                                displayColors: false,

                                cornerRadius: 12,

                                callbacks: {

                                    label: function (context) {

                                        return 'Sales: Rp '
                                            + new Intl.NumberFormat(
                                                'id-ID'
                                            ).format(context.raw);

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

                                    maxTicksLimit: 10,

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

                                    color: '#69717D',

                                    font: {

                                        size: 10,

                                    },

                                    padding: 10,

                                    callback: function (value) {

                                        return 'Rp '
                                            + new Intl.NumberFormat(
                                                'id-ID',
                                                {
                                                    notation: 'compact',
                                                    maximumFractionDigits: 1
                                                }
                                            ).format(value);

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
            | Order Status
            |--------------------------------------------------------------------------
            */

            const orderStatusCanvas = document.getElementById(
                'orderStatusChart'
            );


            if (orderStatusCanvas) {

                new Chart(orderStatusCanvas, {

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

                                    {{ $orderStatusSummary['pending'] ?? 0 }},

                                    {{ $orderStatusSummary['confirmed'] ?? 0 }},

                                    {{ $orderStatusSummary['processing'] ?? 0 }},

                                    {{ $orderStatusSummary['completed'] ?? 0 }},

                                    {{ $orderStatusSummary['cancelled'] ?? 0 }}

                                ],

                                backgroundColor: [

                                    '#D9C57A',
                                    '#9EB6E8',
                                    '#BBA8EA',
                                    '#63D889',
                                    '#D88E8E'

                                ],

                                borderColor: '#0E1319',

                                borderWidth: 4,

                                hoverOffset: 7,

                                spacing: 2,

                            }

                        ]

                    },


                    options: {

                        responsive: true,

                        maintainAspectRatio: false,

                        cutout: '72%',


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

                                backgroundColor: '#0A0E13',

                                borderColor: '#2B313A',

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



            /*
            |--------------------------------------------------------------------------
            | Sales By Category
            |--------------------------------------------------------------------------
            */

            const categoryLabels = @json(

                $salesByCategory->pluck('name')->map(

                    fn ($name) => $name ?: 'Uncategorized'

                )->values()

            );


            const categoryData = @json(
                $salesByCategory->pluck('total')->values()
            );


            const categoryCanvas = document.getElementById(
                'categoryChart'
            );


            if (categoryCanvas) {

                const categoryContext = categoryCanvas.getContext('2d');


                const categoryGradient = categoryContext.createLinearGradient(
                    0,
                    0,
                    0,
                    300
                );


                categoryGradient.addColorStop(
                    0,
                    '#9B91FF'
                );

                categoryGradient.addColorStop(
                    1,
                    '#6457C8'
                );


                new Chart(categoryContext, {

                    type: 'bar',

                    data: {

                        labels: categoryLabels,

                        datasets: [

                            {

                                label: 'Sales',

                                data: categoryData,

                                backgroundColor: categoryGradient,

                                borderRadius: 8,

                                borderSkipped: false,

                                maxBarThickness: 42,

                            }

                        ]

                    },


                    options: {

                        responsive: true,

                        maintainAspectRatio: false,


                        plugins: {

                            legend: {

                                display: false,

                            },


                            tooltip: {

                                backgroundColor: '#0A0E13',

                                borderColor: '#2B313A',

                                borderWidth: 1,

                                titleColor: '#F5F5F2',

                                bodyColor: '#C5CAD2',

                                padding: 12,

                                cornerRadius: 12,

                                callbacks: {

                                    label: function (context) {

                                        return 'Sales: Rp '
                                            + new Intl.NumberFormat(
                                                'id-ID'
                                            ).format(context.raw);

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

                                    color: '#707782',

                                    font: {

                                        size: 10,

                                    },

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

                                    color: '#707782',

                                    font: {

                                        size: 10,

                                    },

                                    padding: 8,

                                    callback: function (value) {

                                        return 'Rp '
                                            + new Intl.NumberFormat(
                                                'id-ID',
                                                {
                                                    notation: 'compact',
                                                    maximumFractionDigits: 1
                                                }
                                            ).format(value);

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

        });

    </script>

</x-app-layout>