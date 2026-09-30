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

    <title>{{ config('app.name', 'NEXORA') }}</title>

    <link
        rel="preconnect"
        href="https://fonts.bunny.net"
    >

    <link
        href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap"
        rel="stylesheet"
    >

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

    <style>
        :root {
            --nexora-bg: #080B10;
            --nexora-surface: rgba(18, 21, 26, 0.72);
            --nexora-surface-strong: rgba(16, 20, 27, 0.88);
            --nexora-border: rgba(115, 124, 145, 0.18);
            --nexora-border-strong: rgba(139, 124, 255, 0.22);
            --nexora-purple: #8B7CFF;
            --nexora-text: #F5F5F2;
            --nexora-muted: #8B919A;
        }

        html {
            background: var(--nexora-bg);
            color-scheme: dark;
        }

        body.nexora-spatial {
            position: relative;
            min-height: 100vh;
            overflow-x: hidden;
            background:
                radial-gradient(circle at 88% 4%, rgba(139, 124, 255, 0.13), transparent 28%),
                radial-gradient(circle at 16% 88%, rgba(59, 96, 255, 0.08), transparent 34%),
                radial-gradient(circle at 52% 40%, rgba(255, 255, 255, 0.018), transparent 38%),
                var(--nexora-bg);
        }

        body.nexora-spatial::before {
            content: '';
            position: fixed;
            inset: -18vh -12vw auto auto;
            width: 48vw;
            height: 48vw;
            pointer-events: none;
            border-radius: 999px;
            background: radial-gradient(circle, rgba(139, 124, 255, 0.10), transparent 66%);
            filter: blur(42px);
            opacity: 0.9;
            z-index: 0;
        }

        body.nexora-spatial::after {
            content: '';
            position: fixed;
            left: -18vw;
            bottom: -24vh;
            width: 46vw;
            height: 46vw;
            pointer-events: none;
            border-radius: 999px;
            background: radial-gradient(circle, rgba(44, 93, 214, 0.08), transparent 68%);
            filter: blur(52px);
            z-index: 0;
        }

        .nexora-sidebar {
            background:
                linear-gradient(180deg, rgba(12, 16, 22, 0.94), rgba(7, 10, 15, 0.98));
            border-right-color: rgba(120, 128, 148, 0.13) !important;
            box-shadow: 22px 0 60px rgba(0, 0, 0, 0.22);
            backdrop-filter: blur(22px);
            -webkit-backdrop-filter: blur(22px);
        }

        .nexora-sidebar > div:first-child {
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.015), transparent);
        }

        .nexora-sidebar nav {
            scrollbar-width: thin;
            scrollbar-color: rgba(139, 124, 255, 0.24) transparent;
        }

        .nexora-sidebar nav::-webkit-scrollbar {
            width: 6px;
        }

        .nexora-sidebar nav::-webkit-scrollbar-thumb {
            border-radius: 999px;
            background: rgba(139, 124, 255, 0.22);
        }

        .nexora-sidebar a {
            position: relative;
            border-color: transparent;
            transition: transform 180ms ease, background 180ms ease, border-color 180ms ease, box-shadow 180ms ease;
        }

        .nexora-sidebar a:hover {
            transform: translateX(2px);
        }

        .nexora-sidebar a[class*="bg-[#25204D]"] {
            background:
                linear-gradient(135deg, rgba(139, 124, 255, 0.25), rgba(72, 58, 156, 0.16) 52%, rgba(20, 25, 36, 0.42)) !important;
            border-color: rgba(139, 124, 255, 0.34) !important;
            box-shadow:
                inset 0 1px 0 rgba(255, 255, 255, 0.04),
                0 10px 26px rgba(57, 44, 128, 0.16);
        }

        .nexora-sidebar a[class*="bg-[#25204D]"]::before {
            content: '';
            position: absolute;
            left: 0;
            top: 9px;
            bottom: 9px;
            width: 2px;
            border-radius: 999px;
            background: linear-gradient(180deg, rgba(174, 164, 255, 0.95), rgba(139, 124, 255, 0.3));
            box-shadow: 0 0 16px rgba(139, 124, 255, 0.55);
        }

        .nexora-topbar {
            background: linear-gradient(180deg, rgba(8, 12, 18, 0.82), rgba(8, 11, 16, 0.72)) !important;
            border-bottom-color: rgba(120, 128, 148, 0.14) !important;
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.16);
        }

        .nexora-topbar::after {
            content: '';
            position: absolute;
            left: 25%;
            right: 8%;
            bottom: -1px;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(139, 124, 255, 0.18), transparent);
            pointer-events: none;
        }

        #globalSearchBox {
            height: 44px;
            border-color: rgba(122, 131, 151, 0.20) !important;
            background:
                linear-gradient(135deg, rgba(22, 27, 36, 0.76), rgba(12, 16, 22, 0.72)) !important;
            box-shadow:
                inset 0 1px 0 rgba(255, 255, 255, 0.035),
                0 12px 30px rgba(0, 0, 0, 0.16);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
        }

        #globalSearchBox:focus-within {
            border-color: rgba(139, 124, 255, 0.55) !important;
            box-shadow:
                0 0 0 1px rgba(139, 124, 255, 0.12),
                0 12px 32px rgba(0, 0, 0, 0.22),
                0 0 30px rgba(139, 124, 255, 0.08);
        }

        #globalSearchShortcut {
            border: 1px solid rgba(139, 124, 255, 0.08);
            background: rgba(139, 124, 255, 0.08) !important;
        }

        #globalSearchResults,
        #userMenu {
            border-color: rgba(122, 131, 151, 0.18) !important;
            background:
                linear-gradient(145deg, rgba(18, 23, 31, 0.94), rgba(10, 14, 20, 0.94)) !important;
            box-shadow:
                0 30px 90px rgba(0, 0, 0, 0.46),
                inset 0 1px 0 rgba(255, 255, 255, 0.035);
            backdrop-filter: blur(22px);
            -webkit-backdrop-filter: blur(22px);
        }

        .nexora-main {
            position: relative;
            isolation: isolate;
            background: transparent !important;
        }

        .nexora-main::before {
            content: '';
            position: fixed;
            right: 0;
            top: 72px;
            width: 46vw;
            height: 58vh;
            pointer-events: none;
            background: radial-gradient(circle at 75% 15%, rgba(139, 124, 255, 0.055), transparent 54%);
            filter: blur(30px);
            z-index: -1;
        }

        .nexora-main [class*="rounded-2xl"][class*="bg-[#12151A]"] {
            border-color: var(--nexora-border) !important;
            background:
                linear-gradient(145deg, rgba(21, 26, 34, 0.82), rgba(12, 16, 22, 0.72)) !important;
            box-shadow:
                0 22px 55px rgba(0, 0, 0, 0.20),
                inset 0 1px 0 rgba(255, 255, 255, 0.026);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            transition: transform 180ms ease, border-color 180ms ease, box-shadow 180ms ease;
        }

        .nexora-main [class*="rounded-2xl"][class*="bg-[#12151A]"]:hover {
            border-color: rgba(139, 124, 255, 0.18) !important;
            box-shadow:
                0 26px 70px rgba(0, 0, 0, 0.24),
                0 0 34px rgba(139, 124, 255, 0.035),
                inset 0 1px 0 rgba(255, 255, 255, 0.028);
        }

        .nexora-main [class*="border-[#242830]"] {
            border-color: var(--nexora-border) !important;
        }

        .nexora-main [class*="bg-[#0B0D10]"] {
            background:
                linear-gradient(145deg, rgba(10, 14, 19, 0.92), rgba(7, 10, 15, 0.82)) !important;
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.018);
        }

        .nexora-main [class*="bg-[#151A21]"],
        .nexora-main [class*="bg-[#171C23]"],
        .nexora-main [class*="bg-[#0E1116"]] {
            background-color: rgba(17, 22, 30, 0.76) !important;
        }

        .nexora-main a,
        .nexora-main button {
            transition-property: transform, background-color, border-color, box-shadow, color, opacity;
            transition-duration: 180ms;
        }

        .nexora-main a[class*="bg-[#F5F5F2]"],
        .nexora-main button[class*="bg-[#F5F5F2]"] {
            box-shadow:
                0 10px 24px rgba(0, 0, 0, 0.18),
                inset 0 1px 0 rgba(255, 255, 255, 0.7);
        }

        .nexora-main a[class*="bg-[#F5F5F2]"]:hover,
        .nexora-main button[class*="bg-[#F5F5F2]"]:hover {
            transform: translateY(-1px);
            box-shadow:
                0 15px 30px rgba(0, 0, 0, 0.24),
                inset 0 1px 0 rgba(255, 255, 255, 0.75);
        }

        .nexora-main input,
        .nexora-main select,
        .nexora-main textarea {
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.016);
        }

        .nexora-main [class*="ring-[#8B7CFF]"] {
            box-shadow: 0 0 0 1px rgba(139, 124, 255, 0.12), 0 0 22px rgba(139, 124, 255, 0.045) !important;
        }

        @media (max-width: 1024px) {
            .nexora-main::before {
                width: 72vw;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            .nexora-sidebar a,
            .nexora-main [class*="rounded-2xl"][class*="bg-[#12151A]"],
            .nexora-main a,
            .nexora-main button {
                transition: none !important;
            }
        }
    </style>

</head>


<body class="nexora-spatial bg-[#080B10] font-sans text-[#F5F5F2] antialiased">

@php

    $currentCompany = Auth::user()->companies()->first();

@endphp


<div class="flex min-h-screen">


    {{-- ============================================================ --}}
    {{-- SIDEBAR --}}
    {{-- ============================================================ --}}

    <aside
        class="nexora-sidebar fixed inset-y-0 left-0 z-40 flex w-[246px] flex-col border-r border-[#202630] bg-[#090C11]"
    >


        {{-- ======================================================== --}}
        {{-- COMPANY BRAND --}}
        {{-- ======================================================== --}}

        <div
            class="flex h-[72px] items-center border-b border-[#202630] px-8"
        >

            <div class="flex min-w-0 items-center gap-3">


                {{-- Company Logo --}}
                @if ($currentCompany?->logo)

                    <div
                        class="flex h-10 w-10 shrink-0 items-center justify-center overflow-hidden rounded-xl border border-[#2A3039] bg-[#11151B]"
                    >

                        <img
                            src="{{ asset('storage/' . $currentCompany->logo) }}"
                            alt="{{ $currentCompany->name }}"
                            class="h-full w-full object-contain"
                        >

                    </div>

                @else

                    <div
                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-[#11151B] text-sm font-semibold tracking-[0.12em] text-[#A99FFF]"
                    >
                        N
                    </div>

                @endif


                {{-- Company Name --}}
                <div class="min-w-0">

                    <p
                        class="truncate text-[14px] font-semibold leading-tight text-[#F5F5F2]"
                    >
                        {{ $currentCompany?->name ?? 'NEXORA Corporation' }}
                    </p>

                    <p
                        class="mt-1 truncate text-[9px] uppercase leading-tight tracking-[0.18em] text-[#727985]"
                    >
                        Business OS
                    </p>

                </div>

            </div>

        </div>



        {{-- ======================================================== --}}
        {{-- NAVIGATION --}}
        {{-- ======================================================== --}}

        <nav class="flex-1 overflow-y-auto px-4 py-7">


            {{-- ==================================================== --}}
            {{-- WORKSPACE --}}
            {{-- ==================================================== --}}

            <p
                class="mb-3 px-3 text-[10px] font-semibold uppercase tracking-[0.18em] text-[#747B87]"
            >
                Workspace
            </p>


            {{-- Dashboard --}}
            @if (Auth::user()->hasPermission('View Dashboard'))

                <a
                    href="{{ route('dashboard') }}"
                    class="mb-1 flex items-center rounded-lg px-4 py-3 text-sm transition
                    {{ request()->routeIs('dashboard')
                        ? 'border border-[#4037A5] bg-[#25204D] font-medium text-white'
                        : 'text-[#9AA1AD] hover:bg-[#141820] hover:text-white'
                    }}"
                >

                    <span
                        class="mr-3 {{ request()->routeIs('dashboard') ? 'text-[#9C91FF]' : '' }}"
                    >
                        ⌂
                    </span>

                    Dashboard

                </a>

            @endif



            {{-- Sales --}}
            @if (Auth::user()->hasPermission('Manage Sales'))

                <a
                    href="{{ route('orders.index') }}"
                    class="mb-1 flex items-center rounded-lg px-4 py-3 text-sm transition
                    {{ request()->routeIs('orders.*')
                        ? 'border border-[#4037A5] bg-[#25204D] font-medium text-white'
                        : 'text-[#9AA1AD] hover:bg-[#141820] hover:text-white'
                    }}"
                >

                    <span
                        class="mr-3 {{ request()->routeIs('orders.*') ? 'text-[#9C91FF]' : '' }}"
                    >
                        ◈
                    </span>

                    Sales

                </a>

            @endif



            {{-- Customers --}}
            @if (Auth::user()->hasPermission('Manage Customers'))

                <a
                    href="{{ route('customers.index') }}"
                    class="mb-1 flex items-center rounded-lg px-4 py-3 text-sm transition
                    {{ request()->routeIs('customers.*')
                        ? 'border border-[#4037A5] bg-[#25204D] font-medium text-white'
                        : 'text-[#9AA1AD] hover:bg-[#141820] hover:text-white'
                    }}"
                >

                    <span
                        class="mr-3 {{ request()->routeIs('customers.*') ? 'text-[#9C91FF]' : '' }}"
                    >
                        ♙
                    </span>

                    Customers

                </a>

            @endif



            {{-- Products --}}
            @if (Auth::user()->hasPermission('Manage Products'))

                <a
                    href="{{ route('products.index') }}"
                    class="mb-1 flex items-center rounded-lg px-4 py-3 text-sm transition
                    {{ request()->routeIs('products.*')
                        ? 'border border-[#4037A5] bg-[#25204D] font-medium text-white'
                        : 'text-[#9AA1AD] hover:bg-[#141820] hover:text-white'
                    }}"
                >

                    <span
                        class="mr-3 {{ request()->routeIs('products.*') ? 'text-[#9C91FF]' : '' }}"
                    >
                        □
                    </span>

                    Products

                </a>

            @endif



            {{-- Inventory --}}
            @if (Auth::user()->hasPermission('Manage Inventory'))

                <a
                    href="{{ route('inventory.index') }}"
                    class="mb-1 flex items-center rounded-lg px-4 py-3 text-sm transition
                    {{ request()->routeIs('inventory.*')
                        ? 'border border-[#4037A5] bg-[#25204D] font-medium text-white'
                        : 'text-[#9AA1AD] hover:bg-[#141820] hover:text-white'
                    }}"
                >

                    <span
                        class="mr-3 {{ request()->routeIs('inventory.*') ? 'text-[#9C91FF]' : '' }}"
                    >
                        ▣
                    </span>

                    Inventory

                </a>



                {{-- Warehouses --}}
                <a
                    href="{{ route('warehouses.index') }}"
                    class="mb-1 flex items-center rounded-lg px-4 py-3 text-sm transition
                    {{ request()->routeIs('warehouses.*')
                        ? 'border border-[#4037A5] bg-[#25204D] font-medium text-white'
                        : 'text-[#9AA1AD] hover:bg-[#141820] hover:text-white'
                    }}"
                >

                    <span
                        class="mr-3 {{ request()->routeIs('warehouses.*') ? 'text-[#9C91FF]' : '' }}"
                    >
                        ▱
                    </span>

                    Warehouses

                </a>



                {{-- Stock Movements --}}
                <a
                    href="{{ route('stock-movements.index') }}"
                    class="mb-1 flex items-center rounded-lg px-4 py-3 text-sm transition
                    {{ request()->routeIs('stock-movements.*')
                        ? 'border border-[#4037A5] bg-[#25204D] font-medium text-white'
                        : 'text-[#9AA1AD] hover:bg-[#141820] hover:text-white'
                    }}"
                >

                    <span
                        class="mr-3 {{ request()->routeIs('stock-movements.*') ? 'text-[#9C91FF]' : '' }}"
                    >
                        ↕
                    </span>

                    Stock Movements

                </a>

            @endif



            {{-- ==================================================== --}}
            {{-- MANAGEMENT --}}
            {{-- ==================================================== --}}

            <p
                class="mb-3 mt-8 px-3 text-[10px] font-semibold uppercase tracking-[0.18em] text-[#747B87]"
            >
                Management
            </p>



            {{-- Purchasing --}}
            @if (Auth::user()->hasPermission('Manage Purchasing'))

                <a
                    href="{{ route('purchasing.index') }}"
                    class="mb-1 flex items-center rounded-lg px-4 py-3 text-sm transition
                    {{ request()->routeIs('purchasing.*')
                        ? 'border border-[#4037A5] bg-[#25204D] font-medium text-white'
                        : 'text-[#9AA1AD] hover:bg-[#141820] hover:text-white'
                    }}"
                >

                    <span
                        class="mr-3 {{ request()->routeIs('purchasing.*') ? 'text-[#9C91FF]' : '' }}"
                    >
                        ◇
                    </span>

                    Purchasing

                </a>

            @endif



            {{-- Finance --}}
            @if (Auth::user()->hasPermission('Manage Finance'))

                <a
                    href="{{ route('finance.index') }}"
                    class="mb-1 flex items-center rounded-lg px-4 py-3 text-sm transition
                    {{ request()->routeIs('finance.*')
                        ? 'border border-[#4037A5] bg-[#25204D] font-medium text-white'
                        : 'text-[#9AA1AD] hover:bg-[#141820] hover:text-white'
                    }}"
                >

                    <span
                        class="mr-3 {{ request()->routeIs('finance.*') ? 'text-[#9C91FF]' : '' }}"
                    >
                        ◫
                    </span>

                    Finance

                </a>

            @endif



            {{-- Analytics --}}
            @if (Auth::user()->hasPermission('View Analytics'))

                <a
                    href="{{ route('analytics.index') }}"
                    class="mb-1 flex items-center rounded-lg px-4 py-3 text-sm transition
                    {{ request()->routeIs('analytics.*')
                        ? 'border border-[#4037A5] bg-[#25204D] font-medium text-white'
                        : 'text-[#9AA1AD] hover:bg-[#141820] hover:text-white'
                    }}"
                >

                    <span
                        class="mr-3 {{ request()->routeIs('analytics.*') ? 'text-[#9C91FF]' : '' }}"
                    >
                        ▥
                    </span>

                    Analytics

                </a>

            @endif



            {{-- Team --}}
            @if (Auth::user()->hasPermission('Manage Team'))

                <a
                    href="{{ route('team.index') }}"
                    class="mb-1 flex items-center rounded-lg px-4 py-3 text-sm transition
                    {{ request()->routeIs('team.*')
                        ? 'border border-[#4037A5] bg-[#25204D] font-medium text-white'
                        : 'text-[#9AA1AD] hover:bg-[#141820] hover:text-white'
                    }}"
                >

                    <span
                        class="mr-3 {{ request()->routeIs('team.*') ? 'text-[#9C91FF]' : '' }}"
                    >
                        ♙
                    </span>

                    Team

                </a>

            @endif



            {{-- ==================================================== --}}
            {{-- SECURITY --}}
            {{-- ==================================================== --}}

            @if (Auth::user()->hasPermission('Manage Settings'))

                <p
                    class="mb-3 mt-8 px-3 text-[10px] font-semibold uppercase tracking-[0.18em] text-[#747B87]"
                >
                    Security
                </p>



                {{-- Audit Log --}}
                <a
                    href="{{ route('audit-logs.index') }}"
                    class="mb-1 flex items-center rounded-lg px-4 py-3 text-sm transition
                    {{ request()->routeIs('audit-logs.*')
                        ? 'border border-[#4037A5] bg-[#25204D] font-medium text-white'
                        : 'text-[#9AA1AD] hover:bg-[#141820] hover:text-white'
                    }}"
                >

                    <span
                        class="mr-3 {{ request()->routeIs('audit-logs.*') ? 'text-[#9C91FF]' : '' }}"
                    >
                        ◈
                    </span>

                    Audit Log

                </a>

            @endif



            {{-- ==================================================== --}}
            {{-- CONFIGURATION --}}
            {{-- ==================================================== --}}

            @if (Auth::user()->hasPermission('Manage Settings'))

                <p
                    class="mb-3 mt-8 px-3 text-[10px] font-semibold uppercase tracking-[0.18em] text-[#747B87]"
                >
                    Configuration
                </p>



                {{-- Settings --}}
                <a
                    href="{{ route('settings.index') }}"
                    class="mb-1 flex items-center rounded-lg px-4 py-3 text-sm transition
                    {{ request()->routeIs('settings.*')
                        ? 'border border-[#4037A5] bg-[#25204D] font-medium text-white'
                        : 'text-[#9AA1AD] hover:bg-[#141820] hover:text-white'
                    }}"
                >

                    <span
                        class="mr-3 {{ request()->routeIs('settings.*') ? 'text-[#9C91FF]' : '' }}"
                    >
                        ⚙
                    </span>

                    Settings

                </a>

            @endif

        </nav>



        {{-- ======================================================== --}}
        {{-- SIDEBAR USER --}}
        {{-- ======================================================== --}}

        <div class="border-t border-[#202630] px-5 py-5">

            <div class="flex items-center gap-3">

                <div
                    class="flex h-9 w-9 shrink-0 items-center justify-center overflow-hidden rounded-full bg-[#5148A8] text-sm font-medium"
                >

                    @if (Auth::user()->avatar)

                        <img
                            src="{{ asset('storage/' . Auth::user()->avatar) }}"
                            alt="{{ Auth::user()->name }}"
                            class="h-full w-full object-cover"
                        >

                    @else

                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}

                    @endif

                </div>


                <div class="min-w-0">

                    <p class="truncate text-xs font-medium text-white">
                        {{ Auth::user()->name }}
                    </p>

                    <p class="truncate text-[11px] text-[#747B87]">
                        {{ Auth::user()->email }}
                    </p>

                </div>

            </div>



            {{-- Logout --}}
            <form
                method="POST"
                action="{{ route('logout') }}"
                class="mt-4"
            >

                @csrf

                <button
                    type="submit"
                    class="flex w-full items-center gap-3 rounded-lg px-2 py-2 text-sm text-[#8D949F] transition hover:bg-[#141820] hover:text-white"
                >

                    <span>
                        ↪
                    </span>

                    Logout

                </button>

            </form>

        </div>

    </aside>



    {{-- ============================================================ --}}
    {{-- MAIN --}}
    {{-- ============================================================ --}}

    <div class="ml-[246px] flex min-h-screen min-w-0 flex-1 flex-col">


        {{-- ======================================================== --}}
        {{-- TOPBAR --}}
        {{-- ======================================================== --}}

        <header
            class="nexora-topbar relative z-50 flex h-[72px] shrink-0 items-center justify-between border-b border-[#202630] bg-[#090C11] px-8"
        >


            {{-- ==================================================== --}}
            {{-- GLOBAL SEARCH --}}
            {{-- ==================================================== --}}

            <div
                id="globalSearchWrapper"
                class="relative w-[465px]"
            >

                <div
                    id="globalSearchBox"
                    class="flex h-10 w-full items-center rounded-lg border border-[#29303B] bg-[#11161E] px-4 transition"
                >

                    <span
                        class="mr-3 shrink-0 text-[#727985]"
                    >
                        ⌕
                    </span>


                    <input
                        id="globalSearchInput"
                        type="text"
                        autocomplete="off"
                        spellcheck="false"
                        placeholder="Search anything..."
                        class="w-full border-0 bg-transparent text-sm text-white outline-none placeholder:text-[#666D78]"
                    >


                    <button
                        id="globalSearchShortcut"
                        type="button"
                        class="shrink-0 rounded bg-[#1D2430] px-2 py-1 text-[10px] text-[#777F8C] transition hover:text-[#A0A6B0]"
                    >
                        ⌘ K
                    </button>

                </div>



                {{-- Search Results --}}
                <div
                    id="globalSearchResults"
                    class="absolute left-0 right-0 top-[52px] hidden overflow-hidden rounded-2xl border border-[#292F39] bg-[#11151B] shadow-[0_25px_70px_rgba(0,0,0,0.45)]"
                >

                    <div
                        id="globalSearchContent"
                        class="max-h-[520px] overflow-y-auto"
                    >

                        {{-- Dynamic content --}}

                    </div>

                </div>

            </div>



            {{-- ==================================================== --}}
            {{-- TOPBAR RIGHT --}}
            {{-- ==================================================== --}}

            <div class="flex items-center gap-6">


                {{-- Notifications --}}
                <a
                    href="{{ route('notifications.index') }}"
                    class="relative text-xl text-[#A0A6B0] transition hover:text-white"
                    aria-label="Notifications"
                >

                    ♧

                    @php

                        $unreadNotifications = Auth::user()
                            ->unreadNotifications()
                            ->count();

                    @endphp


                    @if ($unreadNotifications > 0)

                        <span
                            class="absolute -right-1 -top-1 flex min-h-[16px] min-w-[16px] items-center justify-center rounded-full bg-[#8B7CFF] px-1 text-[8px] font-semibold text-white"
                        >
                            {{ $unreadNotifications > 9 ? '9+' : $unreadNotifications }}
                        </span>

                    @endif

                </a>



                {{-- User Menu --}}
                <div class="relative">

                    <button
                        type="button"
                        id="userMenuButton"
                        class="flex items-center gap-3 rounded-xl px-2 py-1.5 transition hover:bg-[#11161E]"
                    >

                        <div
                            class="flex h-9 w-9 items-center justify-center overflow-hidden rounded-full bg-[#303749] text-sm font-medium text-white"
                        >

                            @if (Auth::user()->avatar)

                                <img
                                    src="{{ asset('storage/' . Auth::user()->avatar) }}"
                                    alt="{{ Auth::user()->name }}"
                                    class="h-full w-full object-cover"
                                >

                            @else

                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}

                            @endif

                        </div>



                        <div class="hidden text-left sm:block">

                            <p class="text-xs font-medium text-white">
                                {{ Auth::user()->name }}
                            </p>

                            <p class="text-[11px] text-[#747B87]">
                                {{ Auth::user()->roles()->first()?->name ?? 'User' }}
                            </p>

                        </div>


                        <span class="ml-1 text-xs text-[#7B828D]">
                            ⌄
                        </span>

                    </button>



                    {{-- User Dropdown --}}
                    <div
                        id="userMenu"
                        class="absolute right-0 top-[52px] hidden w-[230px] overflow-hidden rounded-2xl border border-[#292F39] bg-[#11151B] shadow-[0_25px_70px_rgba(0,0,0,0.45)]"
                    >

                        <div class="border-b border-[#242830] px-5 py-4">

                            <p class="truncate text-sm font-medium text-[#F5F5F2]">
                                {{ Auth::user()->name }}
                            </p>

                            <p class="mt-1 truncate text-xs text-[#727985]">
                                {{ Auth::user()->email }}
                            </p>

                        </div>


                        <div class="p-2">


                            {{-- Profile --}}
                            <a
                                href="{{ route('profile.edit') }}"
                                class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm text-[#9AA1AD] transition hover:bg-[#181D25] hover:text-white"
                            >

                                <span class="text-[#8B7CFF]">
                                    ○
                                </span>

                                Profile

                            </a>



                            {{-- Settings --}}
                            @if (Auth::user()->hasPermission('Manage Settings'))

                                <a
                                    href="{{ route('settings.index') }}"
                                    class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm text-[#9AA1AD] transition hover:bg-[#181D25] hover:text-white"
                                >

                                    <span class="text-[#8B7CFF]">
                                        ⚙
                                    </span>

                                    Settings

                                </a>

                            @endif



                            {{-- Audit Log --}}
                            @if (Auth::user()->hasPermission('Manage Settings'))

                                <a
                                    href="{{ route('audit-logs.index') }}"
                                    class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm text-[#9AA1AD] transition hover:bg-[#181D25] hover:text-white"
                                >

                                    <span class="text-[#8B7CFF]">
                                        ◈
                                    </span>

                                    Audit Log

                                </a>

                            @endif

                        </div>



                        {{-- Logout --}}
                        <div class="border-t border-[#242830] p-2">

                            <form
                                method="POST"
                                action="{{ route('logout') }}"
                            >

                                @csrf

                                <button
                                    type="submit"
                                    class="flex w-full items-center gap-3 rounded-xl px-3 py-3 text-sm text-[#9AA1AD] transition hover:bg-[#181D25] hover:text-white"
                                >

                                    <span>
                                        ↪
                                    </span>

                                    Logout

                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </header>



        {{-- ======================================================== --}}
        {{-- CONTENT --}}
        {{-- ======================================================== --}}

        <main class="nexora-main min-w-0 flex-1 px-8 pt-5 pb-8">

            <div class="mx-auto w-full max-w-[1500px]">

                {{ $slot }}

            </div>

        </main>

    </div>

</div>



{{-- ================================================================ --}}
{{-- GLOBAL SEARCH JAVASCRIPT --}}
{{-- ================================================================ --}}

<script>

document.addEventListener('DOMContentLoaded', function () {

    const searchWrapper = document.getElementById('globalSearchWrapper');

    const searchBox = document.getElementById('globalSearchBox');

    const searchInput = document.getElementById('globalSearchInput');

    const searchShortcut = document.getElementById('globalSearchShortcut');

    const searchResults = document.getElementById('globalSearchResults');

    const searchContent = document.getElementById('globalSearchContent');

    const userMenuButton = document.getElementById('userMenuButton');

    const userMenu = document.getElementById('userMenu');

    let searchTimeout = null;



    /*
    |--------------------------------------------------------------------------
    | Search Helpers
    |--------------------------------------------------------------------------
    */

    function openSearchResults() {

        searchResults.classList.remove('hidden');

    }



    function closeSearchResults() {

        searchResults.classList.add('hidden');

    }



    function setSearchLoading() {

        searchContent.innerHTML = `

            <div class="px-6 py-7">

                <div class="flex items-center gap-4">

                    <div class="flex h-10 w-10 items-center justify-center rounded-xl border border-[#242830] bg-[#0B0D10]">

                        <svg
                            class="h-4 w-4 animate-spin text-[#8B7CFF]"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                        >

                            <circle
                                class="opacity-25"
                                cx="12"
                                cy="12"
                                r="10"
                                stroke="currentColor"
                                stroke-width="3"
                            ></circle>

                            <path
                                class="opacity-75"
                                fill="currentColor"
                                d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"
                            ></path>

                        </svg>

                    </div>



                    <div>

                        <p class="text-sm font-medium text-[#F5F5F2]">
                            Searching NEXORA
                        </p>

                        <p class="mt-1 text-xs text-[#666C75]">
                            Looking across your business data...
                        </p>

                    </div>

                </div>

            </div>

        `;

    }



    function setSearchEmpty(query) {

        searchContent.innerHTML = `

            <div class="px-6 py-8 text-center">

                <div class="mx-auto flex h-11 w-11 items-center justify-center rounded-xl border border-[#242830] bg-[#0B0D10] text-[#666C75]">
                    ⌕
                </div>

                <p class="mt-4 text-sm font-medium text-[#F5F5F2]">
                    No results found
                </p>

                <p class="mt-1 text-xs text-[#666C75]">
                    No matching records for "${escapeHtml(query)}".
                </p>

            </div>

        `;

    }



    function setSearchError() {

        searchContent.innerHTML = `

            <div class="px-6 py-8 text-center">

                <div class="mx-auto flex h-11 w-11 items-center justify-center rounded-xl border border-rose-500/20 bg-rose-500/10 text-rose-400">
                    !
                </div>

                <p class="mt-4 text-sm font-medium text-[#F5F5F2]">
                    Search unavailable
                </p>

                <p class="mt-1 text-xs text-[#666C75]">
                    Something went wrong while searching.
                </p>

            </div>

        `;

    }



    function escapeHtml(value) {

        const div = document.createElement('div');

        div.textContent = value;

        return div.innerHTML;

    }



    function renderResults(results) {

        if (!results.length) {

            setSearchEmpty(searchInput.value.trim());

            return;

        }



        searchContent.innerHTML = `

            <div class="border-b border-[#242830] px-5 py-4">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-[10px] font-semibold uppercase tracking-[0.18em] text-[#666C75]">
                            Search Results
                        </p>

                        <p class="mt-1 text-xs text-[#8B919A]">

                            ${results.length}

                            ${results.length === 1 ? 'result' : 'results'}

                            found

                        </p>

                    </div>



                    <span class="rounded-lg bg-[#1A2029] px-2 py-1 text-[9px] text-[#666C75]">
                        ENTER
                    </span>

                </div>

            </div>



            <div class="p-2">

                ${results.map((result, index) => `

                    <a
                        href="${escapeHtml(result.url)}"
                        class="global-search-result group flex items-center gap-4 rounded-xl px-4 py-3 transition hover:bg-[#181D25]"
                        data-index="${index}"
                    >

                        <div
                            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl border border-[#242830] bg-[#0B0D10] text-sm text-[#A99FFF] transition group-hover:border-[#8B7CFF]/40 group-hover:bg-[#8B7CFF]/10"
                        >

                            ${escapeHtml(result.icon || '◈')}

                        </div>



                        <div class="min-w-0 flex-1">

                            <div class="flex items-center gap-2">

                                <p class="truncate text-sm font-medium text-[#F5F5F2]">
                                    ${escapeHtml(result.title)}
                                </p>

                            </div>



                            <p class="mt-1 truncate text-xs text-[#747B87]">
                                ${escapeHtml(result.subtitle || '')}
                            </p>

                        </div>



                        <div class="shrink-0 text-right">

                            <span
                                class="rounded-md border border-[#242830] bg-[#0D1116] px-2 py-1 text-[9px] uppercase tracking-[0.12em] text-[#666C75]"
                            >
                                ${escapeHtml(result.type)}
                            </span>

                        </div>



                        <span
                            class="text-sm text-[#4D535D] transition group-hover:translate-x-0.5 group-hover:text-[#A99FFF]"
                        >
                            →
                        </span>

                    </a>

                `).join('')}

            </div>

        `;

    }



    async function performSearch(query) {

        if (query.length < 2) {

            searchContent.innerHTML = '';

            closeSearchResults();

            return;

        }



        openSearchResults();

        setSearchLoading();



        try {

            const url = new URL(
                @json(route('global.search')),
                window.location.origin
            );



            url.searchParams.set('q', query);



            const response = await fetch(url, {

                method: 'GET',

                headers: {

                    'Accept': 'application/json',

                    'X-Requested-With': 'XMLHttpRequest',

                },

            });



            if (!response.ok) {

                throw new Error('Search request failed.');

            }



            const data = await response.json();



            renderResults(data.results || []);

        } catch (error) {

            console.error(error);

            setSearchError();

        }

    }



    /*
    |--------------------------------------------------------------------------
    | Search Input
    |--------------------------------------------------------------------------
    */

    searchInput.addEventListener('focus', function () {

        searchBox.classList.add('border-[#8B7CFF]/70');



        const query = searchInput.value.trim();



        if (query.length >= 2) {

            openSearchResults();

        }

    });



    searchInput.addEventListener('blur', function () {

        searchBox.classList.remove('border-[#8B7CFF]/70');

    });



    searchInput.addEventListener('input', function () {

        const query = searchInput.value.trim();



        clearTimeout(searchTimeout);



        if (query.length < 2) {

            closeSearchResults();

            searchContent.innerHTML = '';

            return;

        }



        openSearchResults();

        setSearchLoading();



        searchTimeout = setTimeout(function () {

            performSearch(query);

        }, 250);

    });



    searchInput.addEventListener('keydown', function (event) {

        if (event.key === 'Escape') {

            closeSearchResults();

            searchInput.blur();

            return;

        }



        if (event.key === 'Enter') {

            const firstResult = searchContent.querySelector(
                '.global-search-result'
            );



            if (firstResult) {

                firstResult.click();

            }

        }

    });



    /*
    |--------------------------------------------------------------------------
    | Shortcut Ctrl + K / Cmd + K
    |--------------------------------------------------------------------------
    */

    document.addEventListener('keydown', function (event) {

        if (
            (event.ctrlKey || event.metaKey)
            &&
            event.key.toLowerCase() === 'k'
        ) {

            event.preventDefault();

            searchInput.focus();

            searchInput.select();

        }

    });



    searchShortcut.addEventListener('click', function () {

        searchInput.focus();

        searchInput.select();

    });



    /*
    |--------------------------------------------------------------------------
    | Close Search When Clicking Outside
    |--------------------------------------------------------------------------
    */

    document.addEventListener('click', function (event) {

        if (!searchWrapper.contains(event.target)) {

            closeSearchResults();

        }

    });



    /*
    |--------------------------------------------------------------------------
    | User Dropdown
    |--------------------------------------------------------------------------
    */

    userMenuButton.addEventListener('click', function (event) {

        event.stopPropagation();

        userMenu.classList.toggle('hidden');

    });



    document.addEventListener('click', function (event) {

        if (
            !userMenu.contains(event.target)
            &&
            !userMenuButton.contains(event.target)
        ) {

            userMenu.classList.add('hidden');

        }

    });

});

</script>


</body>

</html>