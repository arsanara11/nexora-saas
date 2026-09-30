<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >

    <title>NEXORA — Business Operations Platform</title>

    <meta
        name="description"
        content="NEXORA is the operating system for modern business."
    >

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

</head>


<body>

    <div class="min-h-screen overflow-x-hidden bg-[#080B10] text-[#F5F5F2]">


        {{-- ========================================================= --}}
        {{-- NAVIGATION --}}
        {{-- ========================================================= --}}

        <header
            class="fixed inset-x-0 top-0 z-50 border-b border-[#242830]/70 bg-[#080B10]/85 backdrop-blur-xl"
        >

            <div
                class="mx-auto flex h-[78px] w-full max-w-[1440px] items-center justify-between px-6 lg:px-10"
            >


                {{-- Brand --}}
                <a
                    href="{{ url('/') }}"
                    class="group flex items-center gap-3"
                >

                    <div
                        class="flex h-10 w-10 items-center justify-center rounded-xl border border-[#343944] bg-[#10141B] shadow-[0_0_30px_rgba(139,124,255,0.08)]"
                    >

                        <svg
                            viewBox="0 0 48 48"
                            class="h-6 w-6"
                            fill="none"
                        >

                            <path
                                d="M10 31L20 17L28 29L38 13"
                                stroke="#F5F5F2"
                                stroke-width="2.4"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />

                            <path
                                d="M10 37L21 22L29 34L40 19"
                                stroke="#8B7CFF"
                                stroke-width="2.4"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />

                        </svg>

                    </div>


                    <div>

                        <div
                            class="text-[18px] font-semibold tracking-[0.28em] text-[#F5F5F2]"
                        >
                            NEXORA
                        </div>

                        <div
                            class="mt-0.5 text-[9px] uppercase tracking-[0.3em] text-[#666C75]"
                        >
                            Business OS
                        </div>

                    </div>

                </a>


                {{-- Right Navigation --}}
                <nav class="flex items-center gap-3">

                    @auth

                        <a
                            href="{{ route('dashboard') }}"
                            class="rounded-xl border border-[#242830] bg-[#12151A] px-5 py-2.5 text-sm font-medium text-[#F5F5F2] transition hover:border-[#8B7CFF] hover:text-[#A99FFF]"
                        >
                            Dashboard
                        </a>

                    @else

                        <a
                            href="{{ route('login') }}"
                            class="rounded-xl px-4 py-2.5 text-sm font-medium text-[#9AA1AD] transition hover:text-[#F5F5F2]"
                        >
                            Log in
                        </a>

                        <a
                            href="{{ route('register') }}"
                            class="rounded-xl border border-[#8B7CFF]/40 bg-[#8B7CFF]/10 px-5 py-2.5 text-sm font-medium text-[#F5F5F2] transition hover:border-[#8B7CFF] hover:bg-[#8B7CFF]/15"
                        >
                            Get Started
                        </a>

                    @endauth

                </nav>

            </div>

        </header>


        {{-- ========================================================= --}}
        {{-- HERO --}}
        {{-- ========================================================= --}}

        <main>


            <section
                class="relative isolate min-h-screen overflow-hidden"
            >


                {{-- Background Glow --}}
                <div
                    class="pointer-events-none absolute left-1/2 top-[14%] h-[520px] w-[520px] -translate-x-1/2 rounded-full bg-[#8B7CFF]/10 blur-[140px]"
                ></div>


                <div
                    class="pointer-events-none absolute -right-[160px] top-[28%] h-[420px] w-[420px] rounded-full bg-[#4254FF]/5 blur-[120px]"
                ></div>


                {{-- Grid Pattern --}}
                <div
                    class="pointer-events-none absolute inset-0 opacity-[0.035]"
                    style="
                        background-image:
                            linear-gradient(to right, #ffffff 1px, transparent 1px),
                            linear-gradient(to bottom, #ffffff 1px, transparent 1px);
                        background-size: 72px 72px;
                    "
                ></div>


                <div
                    class="relative mx-auto flex min-h-screen w-full max-w-[1440px] items-center px-6 pb-20 pt-[150px] lg:px-10"
                >

                    <div class="grid w-full grid-cols-1 items-center gap-16 lg:grid-cols-[1.05fr_0.95fr]">


                        {{-- Hero Copy --}}
                        <div class="max-w-[760px]">


                            <div
                                class="mb-7 inline-flex items-center gap-3 rounded-full border border-[#242830] bg-[#0E1116] px-4 py-2"
                            >

                                <span
                                    class="h-1.5 w-1.5 rounded-full bg-[#8B7CFF] shadow-[0_0_12px_rgba(139,124,255,0.9)]"
                                ></span>

                                <span
                                    class="text-[11px] font-medium uppercase tracking-[0.2em] text-[#8B919A]"
                                >
                                    Business Operations Platform
                                </span>

                            </div>


                            <p
                                class="mb-5 text-xs font-medium uppercase tracking-[0.3em] text-[#8B7CFF]"
                            >
                                NEXORA
                            </p>


                            <h1
                                class="max-w-[760px] text-5xl font-semibold leading-[1.02] tracking-[-0.045em] text-[#F5F5F2] sm:text-6xl lg:text-[76px]"
                            >
                                The operating system for
                                <span class="text-[#8B7CFF]">
                                    modern business.
                                </span>
                            </h1>


                            <p
                                class="mt-7 max-w-[650px] text-base leading-8 text-[#8B919A] sm:text-lg"
                            >
                                Run sales, inventory, finance, customers, purchasing,
                                and analytics from one connected workspace built for
                                businesses that move fast.
                            </p>


                            {{-- CTA --}}
                            <div
                                class="mt-9 flex flex-col gap-3 sm:flex-row"
                            >

                                @auth

                                    <a
                                        href="{{ route('dashboard') }}"
                                        class="inline-flex items-center justify-center rounded-xl bg-[#8B7CFF] px-7 py-3.5 text-sm font-semibold text-white shadow-[0_12px_40px_rgba(139,124,255,0.18)] transition hover:bg-[#796AF0]"
                                    >
                                        Open Dashboard
                                        <span class="ml-3">
                                            →
                                        </span>
                                    </a>

                                @else

                                    <a
                                        href="{{ route('register') }}"
                                        class="inline-flex items-center justify-center rounded-xl bg-[#8B7CFF] px-7 py-3.5 text-sm font-semibold text-white shadow-[0_12px_40px_rgba(139,124,255,0.18)] transition hover:bg-[#796AF0]"
                                    >
                                        Get Started
                                        <span class="ml-3">
                                            →
                                        </span>
                                    </a>


                                    <a
                                        href="{{ route('login') }}"
                                        class="inline-flex items-center justify-center rounded-xl border border-[#242830] bg-[#12151A] px-7 py-3.5 text-sm font-medium text-[#F5F5F2] transition hover:border-[#8B7CFF] hover:text-[#A99FFF]"
                                    >
                                        Sign In
                                    </a>

                                @endauth

                            </div>


                            {{-- Meta --}}
                            <div
                                class="mt-10 flex flex-wrap items-center gap-x-7 gap-y-3 text-xs text-[#666C75]"
                            >

                                <span class="flex items-center gap-2">
                                    <span class="text-[#8B7CFF]">
                                        ✓
                                    </span>
                                    Unified operations
                                </span>

                                <span class="flex items-center gap-2">
                                    <span class="text-[#8B7CFF]">
                                        ✓
                                    </span>
                                    Real-time visibility
                                </span>

                                <span class="flex items-center gap-2">
                                    <span class="text-[#8B7CFF]">
                                        ✓
                                    </span>
                                    Permission-based access
                                </span>

                            </div>

                        </div>


                        {{-- Hero Visual --}}
                        <div class="relative mx-auto w-full max-w-[620px]">


                            {{-- Glow --}}
                            <div
                                class="absolute inset-10 rounded-[40px] bg-[#8B7CFF]/10 blur-[100px]"
                            ></div>


                            {{-- Dashboard Mockup --}}
                            <div
                                class="relative overflow-hidden rounded-[24px] border border-[#2B303A] bg-[#101319] shadow-[0_40px_100px_rgba(0,0,0,0.5)]"
                            >


                                {{-- Fake Browser / App Bar --}}
                                <div
                                    class="flex h-12 items-center justify-between border-b border-[#242830] bg-[#0C0F14] px-4"
                                >

                                    <div class="flex items-center gap-2">

                                        <span class="h-2.5 w-2.5 rounded-full bg-[#363B45]"></span>
                                        <span class="h-2.5 w-2.5 rounded-full bg-[#363B45]"></span>
                                        <span class="h-2.5 w-2.5 rounded-full bg-[#363B45]"></span>

                                    </div>

                                    <span
                                        class="text-[10px] uppercase tracking-[0.2em] text-[#555B65]"
                                    >
                                        NEXORA / BUSINESS OS
                                    </span>

                                </div>


                                <div class="p-5">


                                    {{-- Mock Header --}}
                                    <div class="flex items-center justify-between">

                                        <div>

                                            <p
                                                class="text-[10px] uppercase tracking-[0.18em] text-[#666C75]"
                                            >
                                                Overview
                                            </p>

                                            <p
                                                class="mt-2 text-lg font-semibold text-[#F5F5F2]"
                                            >
                                                Business Dashboard
                                            </p>

                                        </div>


                                        <div
                                            class="rounded-lg border border-[#242830] bg-[#0B0D10] px-3 py-2 text-[9px] text-[#666C75]"
                                        >
                                            Last 30 days
                                        </div>

                                    </div>


                                    {{-- KPI Cards --}}
                                    <div
                                        class="mt-5 grid grid-cols-3 gap-3"
                                    >

                                        <div
                                            class="rounded-xl border border-[#242830] bg-[#0B0D10] p-4"
                                        >

                                            <p
                                                class="text-[9px] uppercase tracking-[0.15em] text-[#666C75]"
                                            >
                                                Revenue
                                            </p>

                                            <p
                                                class="mt-2 text-lg font-semibold text-[#F5F5F2]"
                                            >
                                                Rp 24.8M
                                            </p>

                                            <p
                                                class="mt-2 text-[9px] text-emerald-400"
                                            >
                                                +12.5%
                                            </p>

                                        </div>


                                        <div
                                            class="rounded-xl border border-[#242830] bg-[#0B0D10] p-4"
                                        >

                                            <p
                                                class="text-[9px] uppercase tracking-[0.15em] text-[#666C75]"
                                            >
                                                Orders
                                            </p>

                                            <p
                                                class="mt-2 text-lg font-semibold text-[#F5F5F2]"
                                            >
                                                1,284
                                            </p>

                                            <p
                                                class="mt-2 text-[9px] text-emerald-400"
                                            >
                                                +8.2%
                                            </p>

                                        </div>


                                        <div
                                            class="rounded-xl border border-[#242830] bg-[#0B0D10] p-4"
                                        >

                                            <p
                                                class="text-[9px] uppercase tracking-[0.15em] text-[#666C75]"
                                            >
                                                Products
                                            </p>

                                            <p
                                                class="mt-2 text-lg font-semibold text-[#F5F5F2]"
                                            >
                                                148
                                            </p>

                                            <p
                                                class="mt-2 text-[9px] text-[#8B919A]"
                                            >
                                                Active
                                            </p>

                                        </div>

                                    </div>


                                    {{-- Chart --}}
                                    <div
                                        class="mt-3 rounded-xl border border-[#242830] bg-[#0B0D10] p-5"
                                    >

                                        <div
                                            class="flex items-center justify-between"
                                        >

                                            <div>

                                                <p
                                                    class="text-[9px] uppercase tracking-[0.15em] text-[#666C75]"
                                                >
                                                    Revenue Overview
                                                </p>

                                                <p
                                                    class="mt-1 text-xs text-[#8B919A]"
                                                >
                                                    Financial performance
                                                </p>

                                            </div>

                                            <span
                                                class="text-[9px] text-[#8B7CFF]"
                                            >
                                                ● Live
                                            </span>

                                        </div>


                                        <div
                                            class="relative mt-6 h-[170px]"
                                        >

                                            {{-- Grid --}}
                                            <div
                                                class="absolute inset-0 flex flex-col justify-between"
                                            >

                                                <span class="h-px w-full bg-[#1B2028]"></span>
                                                <span class="h-px w-full bg-[#1B2028]"></span>
                                                <span class="h-px w-full bg-[#1B2028]"></span>
                                                <span class="h-px w-full bg-[#1B2028]"></span>
                                                <span class="h-px w-full bg-[#1B2028]"></span>

                                            </div>


                                            {{-- SVG Chart --}}
                                            <svg
                                                viewBox="0 0 520 170"
                                                class="absolute inset-0 h-full w-full"
                                                preserveAspectRatio="none"
                                            >

                                                <defs>

                                                    <linearGradient
                                                        id="chartFill"
                                                        x1="0"
                                                        x2="0"
                                                        y1="0"
                                                        y2="1"
                                                    >

                                                        <stop
                                                            offset="0%"
                                                            stop-color="#8B7CFF"
                                                            stop-opacity="0.24"
                                                        />

                                                        <stop
                                                            offset="100%"
                                                            stop-color="#8B7CFF"
                                                            stop-opacity="0"
                                                        />

                                                    </linearGradient>

                                                </defs>


                                                <path
                                                    d="M0 135 C45 128 55 115 100 120 C145 125 155 98 205 102 C250 107 266 74 305 82 C342 89 355 57 395 67 C428 74 454 38 520 28 L520 170 L0 170 Z"
                                                    fill="url(#chartFill)"
                                                />


                                                <path
                                                    d="M0 135 C45 128 55 115 100 120 C145 125 155 98 205 102 C250 107 266 74 305 82 C342 89 355 57 395 67 C428 74 454 38 520 28"
                                                    fill="none"
                                                    stroke="#8B7CFF"
                                                    stroke-width="3"
                                                    stroke-linecap="round"
                                                />

                                                <circle
                                                    cx="520"
                                                    cy="28"
                                                    r="5"
                                                    fill="#F5F5F2"
                                                />

                                                <circle
                                                    cx="520"
                                                    cy="28"
                                                    r="9"
                                                    fill="#8B7CFF"
                                                    opacity="0.18"
                                                />

                                            </svg>

                                        </div>

                                    </div>


                                    {{-- Bottom Mini Panels --}}
                                    <div
                                        class="mt-3 grid grid-cols-2 gap-3"
                                    >

                                        <div
                                            class="rounded-xl border border-[#242830] bg-[#0B0D10] p-4"
                                        >

                                            <p
                                                class="text-[9px] uppercase tracking-[0.15em] text-[#666C75]"
                                            >
                                                Inventory Health
                                            </p>

                                            <div
                                                class="mt-3 flex items-end justify-between"
                                            >

                                                <div>

                                                    <p
                                                        class="text-xl font-semibold text-[#F5F5F2]"
                                                    >
                                                        594
                                                    </p>

                                                    <p
                                                        class="mt-1 text-[9px] text-[#8B919A]"
                                                    >
                                                        Available units
                                                    </p>

                                                </div>


                                                <div
                                                    class="h-8 w-8 rounded-lg border border-emerald-500/20 bg-emerald-500/10"
                                                ></div>

                                            </div>

                                        </div>


                                        <div
                                            class="rounded-xl border border-[#242830] bg-[#0B0D10] p-4"
                                        >

                                            <p
                                                class="text-[9px] uppercase tracking-[0.15em] text-[#666C75]"
                                            >
                                                Analytics
                                            </p>

                                            <div
                                                class="mt-3 flex items-end justify-between"
                                            >

                                                <div>

                                                    <p
                                                        class="text-xl font-semibold text-[#F5F5F2]"
                                                    >
                                                        +18.4%
                                                    </p>

                                                    <p
                                                        class="mt-1 text-[9px] text-[#8B919A]"
                                                    >
                                                        Growth
                                                    </p>

                                                </div>


                                                <div
                                                    class="h-8 w-8 rounded-lg border border-[#8B7CFF]/20 bg-[#8B7CFF]/10"
                                                ></div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </section>


            {{-- ========================================================= --}}
            {{-- FEATURES --}}
            {{-- ========================================================= --}}

            <section
                class="border-y border-[#242830] bg-[#0B0E13]"
            >

                <div
                    class="mx-auto w-full max-w-[1440px] px-6 py-20 lg:px-10"
                >

                    <div class="max-w-[680px]">

                        <p
                            class="text-xs font-medium uppercase tracking-[0.25em] text-[#8B7CFF]"
                        >
                            One connected workspace
                        </p>

                        <h2
                            class="mt-4 text-3xl font-semibold tracking-tight text-[#F5F5F2] sm:text-4xl"
                        >
                            Everything your business needs.
                        </h2>

                        <p
                            class="mt-4 text-sm leading-7 text-[#8B919A] sm:text-base"
                        >
                            Replace disconnected workflows with one operational
                            system that keeps your team, data, and decisions connected.
                        </p>

                    </div>


                    <div
                        class="mt-12 grid grid-cols-1 gap-px overflow-hidden rounded-2xl border border-[#242830] bg-[#242830] md:grid-cols-2 lg:grid-cols-4"
                    >


                        {{-- Feature 1 --}}
                        <div
                            class="bg-[#101319] p-7 transition hover:bg-[#12161D]"
                        >

                            <div
                                class="flex h-11 w-11 items-center justify-center rounded-xl border border-[#8B7CFF]/20 bg-[#8B7CFF]/10 text-[#A99FFF]"
                            >
                                $
                            </div>

                            <h3
                                class="mt-6 text-base font-semibold text-[#F5F5F2]"
                            >
                                Sales
                            </h3>

                            <p
                                class="mt-2 text-sm leading-6 text-[#8B919A]"
                            >
                                Manage orders, customers, payments, and sales
                                workflows from one place.
                            </p>

                        </div>


                        {{-- Feature 2 --}}
                        <div
                            class="bg-[#101319] p-7 transition hover:bg-[#12161D]"
                        >

                            <div
                                class="flex h-11 w-11 items-center justify-center rounded-xl border border-[#8B7CFF]/20 bg-[#8B7CFF]/10 text-[#A99FFF]"
                            >
                                □
                            </div>

                            <h3
                                class="mt-6 text-base font-semibold text-[#F5F5F2]"
                            >
                                Inventory
                            </h3>

                            <p
                                class="mt-2 text-sm leading-6 text-[#8B919A]"
                            >
                                Track stock, reservations, warehouses, purchasing,
                                and stock movements in real time.
                            </p>

                        </div>


                        {{-- Feature 3 --}}
                        <div
                            class="bg-[#101319] p-7 transition hover:bg-[#12161D]"
                        >

                            <div
                                class="flex h-11 w-11 items-center justify-center rounded-xl border border-[#8B7CFF]/20 bg-[#8B7CFF]/10 text-[#A99FFF]"
                            >
                                ≋
                            </div>

                            <h3
                                class="mt-6 text-base font-semibold text-[#F5F5F2]"
                            >
                                Finance
                            </h3>

                            <p
                                class="mt-2 text-sm leading-6 text-[#8B919A]"
                            >
                                Connect invoices, expenses, payments, revenue,
                                and profitability.
                            </p>

                        </div>


                        {{-- Feature 4 --}}
                        <div
                            class="bg-[#101319] p-7 transition hover:bg-[#12161D]"
                        >

                            <div
                                class="flex h-11 w-11 items-center justify-center rounded-xl border border-[#8B7CFF]/20 bg-[#8B7CFF]/10 text-[#A99FFF]"
                            >
                                ◫
                            </div>

                            <h3
                                class="mt-6 text-base font-semibold text-[#F5F5F2]"
                            >
                                Analytics
                            </h3>

                            <p
                                class="mt-2 text-sm leading-6 text-[#8B919A]"
                            >
                                Turn operational data into clear performance
                                insights and business visibility.
                            </p>

                        </div>


                    </div>

                </div>

            </section>


            {{-- ========================================================= --}}
            {{-- CONTROL / SECURITY --}}
            {{-- ========================================================= --}}

            <section>

                <div
                    class="mx-auto grid w-full max-w-[1440px] grid-cols-1 gap-14 px-6 py-24 lg:grid-cols-2 lg:px-10"
                >


                    {{-- Left --}}
                    <div>

                        <p
                            class="text-xs font-medium uppercase tracking-[0.25em] text-[#8B7CFF]"
                        >
                            Built for control
                        </p>

                        <h2
                            class="mt-4 max-w-[620px] text-3xl font-semibold tracking-tight text-[#F5F5F2] sm:text-4xl"
                        >
                            One source of truth for your operation.
                        </h2>

                        <p
                            class="mt-5 max-w-[600px] text-sm leading-7 text-[#8B919A] sm:text-base"
                        >
                            NEXORA connects the operational layers of your business
                            so your team can see what is happening, act faster, and
                            maintain control as the business grows.
                        </p>


                        <div class="mt-9 space-y-5">


                            <div
                                class="flex items-start gap-4"
                            >

                                <div
                                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl border border-[#242830] bg-[#12151A] text-[#8B7CFF]"
                                >
                                    ✓
                                </div>

                                <div>

                                    <p
                                        class="text-sm font-semibold text-[#F5F5F2]"
                                    >
                                        Role-based permissions
                                    </p>

                                    <p
                                        class="mt-1 text-sm leading-6 text-[#8B919A]"
                                    >
                                        Give every team member the access they actually need.
                                    </p>

                                </div>

                            </div>


                            <div
                                class="flex items-start gap-4"
                            >

                                <div
                                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl border border-[#242830] bg-[#12151A] text-[#8B7CFF]"
                                >
                                    ◈
                                </div>

                                <div>

                                    <p
                                        class="text-sm font-semibold text-[#F5F5F2]"
                                    >
                                        Connected business data
                                    </p>

                                    <p
                                        class="mt-1 text-sm leading-6 text-[#8B919A]"
                                    >
                                        Sales, finance, customers, and inventory stay synchronized.
                                    </p>

                                </div>

                            </div>


                            <div
                                class="flex items-start gap-4"
                            >

                                <div
                                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl border border-[#242830] bg-[#12151A] text-[#8B7CFF]"
                                >
                                    ↗
                                </div>

                                <div>

                                    <p
                                        class="text-sm font-semibold text-[#F5F5F2]"
                                    >
                                        Actionable visibility
                                    </p>

                                    <p
                                        class="mt-1 text-sm leading-6 text-[#8B919A]"
                                    >
                                        Move from raw operational data to clear business insights.
                                    </p>

                                </div>

                            </div>


                        </div>

                    </div>


                    {{-- Right Card --}}
                    <div
                        class="relative overflow-hidden rounded-3xl border border-[#242830] bg-[#101319] p-8 sm:p-10"
                    >

                        <div
                            class="absolute -right-20 -top-20 h-52 w-52 rounded-full bg-[#8B7CFF]/10 blur-[80px]"
                        ></div>


                        <div class="relative">


                            <p
                                class="text-xs font-medium uppercase tracking-[0.2em] text-[#666C75]"
                            >
                                NEXORA SYSTEM
                            </p>


                            <div
                                class="mt-8 space-y-4"
                            >

                                <div
                                    class="flex items-center justify-between rounded-xl border border-[#242830] bg-[#0B0D10] px-5 py-4"
                                >

                                    <span
                                        class="text-sm text-[#8B919A]"
                                    >
                                        Sales
                                    </span>

                                    <span
                                        class="text-sm font-semibold text-[#F5F5F2]"
                                    >
                                        Connected
                                    </span>

                                </div>


                                <div
                                    class="flex items-center justify-between rounded-xl border border-[#242830] bg-[#0B0D10] px-5 py-4"
                                >

                                    <span
                                        class="text-sm text-[#8B919A]"
                                    >
                                        Inventory
                                    </span>

                                    <span
                                        class="text-sm font-semibold text-[#F5F5F2]"
                                    >
                                        Connected
                                    </span>

                                </div>


                                <div
                                    class="flex items-center justify-between rounded-xl border border-[#242830] bg-[#0B0D10] px-5 py-4"
                                >

                                    <span
                                        class="text-sm text-[#8B919A]"
                                    >
                                        Finance
                                    </span>

                                    <span
                                        class="text-sm font-semibold text-[#F5F5F2]"
                                    >
                                        Connected
                                    </span>

                                </div>


                                <div
                                    class="flex items-center justify-between rounded-xl border border-[#242830] bg-[#0B0D10] px-5 py-4"
                                >

                                    <span
                                        class="text-sm text-[#8B919A]"
                                    >
                                        Analytics
                                    </span>

                                    <span
                                        class="flex items-center gap-2 text-sm font-semibold text-emerald-400"
                                    >

                                        <span
                                            class="h-1.5 w-1.5 rounded-full bg-emerald-400"
                                        ></span>

                                        Live

                                    </span>

                                </div>

                            </div>


                            <div
                                class="mt-8 border-t border-[#242830] pt-7"
                            >

                                <p
                                    class="text-xs leading-6 text-[#666C75]"
                                >
                                    Designed as a unified operational layer for
                                    modern businesses.
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </section>


            {{-- ========================================================= --}}
            {{-- FINAL CTA --}}
            {{-- ========================================================= --}}

            <section
                class="border-t border-[#242830]"
            >

                <div
                    class="mx-auto w-full max-w-[1440px] px-6 py-24 text-center lg:px-10"
                >

                    <p
                        class="text-xs font-medium uppercase tracking-[0.25em] text-[#8B7CFF]"
                    >
                        Ready to operate differently?
                    </p>


                    <h2
                        class="mx-auto mt-5 max-w-[760px] text-4xl font-semibold tracking-tight text-[#F5F5F2] sm:text-5xl"
                    >
                        Your business.
                        <span class="text-[#8B7CFF]">
                            One system.
                        </span>
                    </h2>


                    <p
                        class="mx-auto mt-5 max-w-[600px] text-sm leading-7 text-[#8B919A] sm:text-base"
                    >
                        Bring your operation into one connected workspace with NEXORA.
                    </p>


                    <div
                        class="mt-8"
                    >

                        @auth

                            <a
                                href="{{ route('dashboard') }}"
                                class="inline-flex items-center justify-center rounded-xl bg-[#8B7CFF] px-8 py-3.5 text-sm font-semibold text-white shadow-[0_15px_50px_rgba(139,124,255,0.2)] transition hover:bg-[#796AF0]"
                            >
                                Go to Dashboard
                                <span class="ml-3">
                                    →
                                </span>
                            </a>

                        @else

                            <a
                                href="{{ route('register') }}"
                                class="inline-flex items-center justify-center rounded-xl bg-[#8B7CFF] px-8 py-3.5 text-sm font-semibold text-white shadow-[0_15px_50px_rgba(139,124,255,0.2)] transition hover:bg-[#796AF0]"
                            >
                                Get Started
                                <span class="ml-3">
                                    →
                                </span>
                            </a>

                        @endauth

                    </div>

                </div>

            </section>

        </main>


        {{-- ========================================================= --}}
        {{-- FOOTER --}}
        {{-- ========================================================= --}}

        <footer
            class="border-t border-[#242830]"
        >

            <div
                class="mx-auto flex w-full max-w-[1440px] flex-col gap-5 px-6 py-8 sm:flex-row sm:items-center sm:justify-between lg:px-10"
            >

                <div>

                    <div
                        class="text-sm font-semibold tracking-[0.22em] text-[#F5F5F2]"
                    >
                        NEXORA
                    </div>

                    <p
                        class="mt-2 text-xs text-[#666C75]"
                    >
                        The Operating System for Modern Business.
                    </p>

                </div>


                <div
                    class="text-xs text-[#555B65]"
                >
                    © {{ date('Y') }} NEXORA Corporation
                </div>

            </div>

        </footer>


    </div>

</body>

</html>