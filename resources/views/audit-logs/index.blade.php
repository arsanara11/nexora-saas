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

                        <p
                            class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#A99FFF]"
                        >
                            Security
                        </p>

                        <span class="text-[10px] text-[#4D535E]">
                            /
                        </span>

                        <p
                            class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#707782]"
                        >
                            Audit Log
                        </p>

                    </div>


                    <h1 class="mt-3 text-3xl font-semibold tracking-[-0.03em] text-white">
                        Audit Log
                    </h1>


                    <p class="mt-2 max-w-xl text-sm leading-6 text-[#8B919A]">
                        Track important activity and changes across your workspace.
                    </p>

                </div>


                <div class="flex items-center gap-3">

                    <div
                        class="hidden rounded-full border border-white/[0.06] bg-white/[0.02] px-3 py-2 text-[10px] font-medium uppercase tracking-[0.16em] text-[#707782] sm:block"
                    >
                        Security workspace
                    </div>

                </div>

            </div>


            {{-- ========================================================
                SUMMARY
            ========================================================= --}}

            <div class="relative mt-6 grid gap-4 md:grid-cols-3">


                {{-- Total Events --}}
                <div
                    class="group relative overflow-hidden rounded-[26px] border border-white/[0.055] bg-[#12151A]/90 p-5 shadow-[0_18px_55px_rgba(0,0,0,0.16)] backdrop-blur-sm transition duration-300 hover:-translate-y-0.5 hover:border-[#8B7CFF]/20"
                >

                    <div
                        class="absolute right-[-30px] top-[-35px] h-28 w-28 rounded-full bg-[#8B7CFF]/[0.08] blur-2xl transition duration-300 group-hover:bg-[#8B7CFF]/[0.12]"
                    ></div>


                    <div class="relative flex items-start justify-between gap-4">

                        <div>

                            <p class="text-[10px] font-semibold uppercase tracking-[0.18em] text-[#707782]">
                                Total Events
                            </p>

                            <p class="mt-3 text-3xl font-semibold tracking-tight text-white">
                                {{ number_format($summary['total']) }}
                            </p>

                            <p class="mt-2 text-xs text-[#666D78]">
                                All recorded activities.
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
                                    d="M9 5h6M9 3h6a2 2 0 012 2v1h1a2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V8a2 2 0 012-2h1V5a2 2 0 012-2z"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M8 11h8M8 15h5"
                                />
                            </svg>

                        </div>

                    </div>

                </div>


                {{-- Today --}}
                <div
                    class="group relative overflow-hidden rounded-[26px] border border-white/[0.055] bg-[#12151A]/90 p-5 shadow-[0_18px_55px_rgba(0,0,0,0.16)] backdrop-blur-sm transition duration-300 hover:-translate-y-0.5 hover:border-[#63D889]/20"
                >

                    <div
                        class="absolute right-[-30px] top-[-35px] h-28 w-28 rounded-full bg-[#63D889]/[0.06] blur-2xl transition duration-300 group-hover:bg-[#63D889]/[0.10]"
                    ></div>


                    <div class="relative flex items-start justify-between gap-4">

                        <div>

                            <p class="text-[10px] font-semibold uppercase tracking-[0.18em] text-[#707782]">
                                Today
                            </p>

                            <p class="mt-3 text-3xl font-semibold tracking-tight text-white">
                                {{ number_format($summary['today']) }}
                            </p>

                            <p class="mt-2 text-xs text-[#666D78]">
                                Events recorded today.
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


                {{-- Active Users --}}
                <div
                    class="group relative overflow-hidden rounded-[26px] border border-white/[0.055] bg-[#12151A]/90 p-5 shadow-[0_18px_55px_rgba(0,0,0,0.16)] backdrop-blur-sm transition duration-300 hover:-translate-y-0.5 hover:border-[#6F8CFF]/20"
                >

                    <div
                        class="absolute right-[-30px] top-[-35px] h-28 w-28 rounded-full bg-[#6F8CFF]/[0.06] blur-2xl transition duration-300 group-hover:bg-[#6F8CFF]/[0.10]"
                    ></div>


                    <div class="relative flex items-start justify-between gap-4">

                        <div>

                            <p class="text-[10px] font-semibold uppercase tracking-[0.18em] text-[#707782]">
                                Active Users
                            </p>

                            <p class="mt-3 text-3xl font-semibold tracking-tight text-white">
                                {{ number_format($summary['users']) }}
                            </p>

                            <p class="mt-2 text-xs text-[#666D78]">
                                Users recorded in audit logs.
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

            </div>


            {{-- ========================================================
                FILTER SURFACE
            ========================================================= --}}

            <div
                class="relative mt-6 overflow-hidden rounded-[30px] border border-white/[0.055] bg-[#11151A]/95 shadow-[0_25px_65px_rgba(0,0,0,0.18)] backdrop-blur-xl"
            >

                <div
                    class="flex flex-col gap-2 border-b border-white/[0.045] px-6 py-5 sm:px-7"
                >

                    <div class="flex items-center gap-2">

                        <span class="h-1.5 w-1.5 rounded-full bg-[#8B7CFF]"></span>

                        <p class="text-[10px] font-semibold uppercase tracking-[0.18em] text-[#707782]">
                            Activity explorer
                        </p>

                    </div>


                    <h2 class="text-base font-semibold text-white">
                        Search & Filters
                    </h2>


                    <p class="text-xs text-[#666D78]">
                        Search and filter recorded system activity.
                    </p>

                </div>


                <form
                    method="GET"
                    action="{{ route('audit-logs.index') }}"
                    class="px-6 py-6 sm:px-7"
                >

                    <div class="grid gap-4 xl:grid-cols-[2fr_1fr_1fr_1fr_auto]">


                        {{-- Search --}}
                        <div>

                            <label
                                for="search"
                                class="mb-2 block text-[10px] font-semibold uppercase tracking-[0.15em] text-[#707782]"
                            >
                                Search
                            </label>

                            <input
                                type="text"
                                id="search"
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="Search user, action, entity, or IP..."
                                class="w-full rounded-xl border border-white/[0.06] bg-[#0B0D10] px-4 py-3 text-sm text-[#F5F5F2] placeholder-[#505762] outline-none transition focus:border-[#8B7CFF]/50 focus:ring-1 focus:ring-[#8B7CFF]/15"
                            >

                        </div>


                        {{-- Action --}}
                        <div>

                            <label
                                for="action"
                                class="mb-2 block text-[10px] font-semibold uppercase tracking-[0.15em] text-[#707782]"
                            >
                                Action
                            </label>

                            <select
                                id="action"
                                name="action"
                                class="w-full rounded-xl border border-white/[0.06] bg-[#0B0D10] px-4 py-3 text-sm text-[#F5F5F2] outline-none transition focus:border-[#8B7CFF]/50 focus:ring-1 focus:ring-[#8B7CFF]/15"
                            >

                                <option
                                    value=""
                                    class="bg-[#0B0D10]"
                                >
                                    All actions
                                </option>

                                @foreach ($actions as $action)

                                    <option
                                        value="{{ $action }}"
                                        class="bg-[#0B0D10]"
                                        @selected(request('action') === $action)
                                    >
                                        {{ $action }}
                                    </option>

                                @endforeach

                            </select>

                        </div>


                        {{-- Date From --}}
                        <div>

                            <label
                                for="date_from"
                                class="mb-2 block text-[10px] font-semibold uppercase tracking-[0.15em] text-[#707782]"
                            >
                                From
                            </label>

                            <input
                                type="date"
                                id="date_from"
                                name="date_from"
                                value="{{ request('date_from') }}"
                                class="w-full rounded-xl border border-white/[0.06] bg-[#0B0D10] px-4 py-3 text-sm text-[#F5F5F2] outline-none transition focus:border-[#8B7CFF]/50 focus:ring-1 focus:ring-[#8B7CFF]/15"
                            >

                        </div>


                        {{-- Date To --}}
                        <div>

                            <label
                                for="date_to"
                                class="mb-2 block text-[10px] font-semibold uppercase tracking-[0.15em] text-[#707782]"
                            >
                                To
                            </label>

                            <input
                                type="date"
                                id="date_to"
                                name="date_to"
                                value="{{ request('date_to') }}"
                                class="w-full rounded-xl border border-white/[0.06] bg-[#0B0D10] px-4 py-3 text-sm text-[#F5F5F2] outline-none transition focus:border-[#8B7CFF]/50 focus:ring-1 focus:ring-[#8B7CFF]/15"
                            >

                        </div>


                        {{-- Filter Buttons --}}
                        <div class="flex items-end gap-2">

                            <button
                                type="submit"
                                class="flex-1 rounded-xl bg-[#F5F5F2] px-4 py-3 text-sm font-semibold text-[#080B10] transition hover:bg-white"
                            >
                                Filter
                            </button>


                            <a
                                href="{{ route('audit-logs.index') }}"
                                class="rounded-xl border border-white/[0.06] bg-white/[0.018] px-4 py-3 text-sm font-medium text-[#9299A5] transition hover:border-white/[0.10] hover:bg-white/[0.035] hover:text-white"
                            >
                                Reset
                            </a>

                        </div>

                    </div>

                </form>

            </div>


            {{-- ========================================================
                AUDIT DIRECTORY
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
                            Security directory
                        </p>

                        <h2 class="mt-2 text-base font-semibold text-white">
                            Activity History
                        </h2>

                        <p class="mt-1 text-xs text-[#666D78]">
                            Showing {{ $logs->firstItem() ?? 0 }}
                            to {{ $logs->lastItem() ?? 0 }}
                            of {{ $logs->total() }} events
                        </p>

                    </div>


                    <div class="flex flex-wrap items-center gap-2 sm:justify-end">

                        @if (request()->hasAny([
                            'search',
                            'action',
                            'date_from',
                            'date_to',
                        ]))

                            <div
                                class="inline-flex items-center gap-2 rounded-xl border border-[#8B7CFF]/10 bg-[#8B7CFF]/[0.04] px-3 py-2 text-[10px] font-medium uppercase tracking-[0.14em] text-[#9389E8]"
                            >

                                <span
                                    class="h-1.5 w-1.5 rounded-full bg-[#8B7CFF] shadow-[0_0_8px_rgba(139,124,255,0.7)]"
                                ></span>

                                Filters active

                            </div>

                        @endif


                        <div
                            class="rounded-xl border border-white/[0.05] bg-white/[0.018] px-3 py-2 text-[10px] font-medium uppercase tracking-[0.14em] text-[#707782]"
                        >
                            {{ $summary['entities'] }} entity types
                        </div>


                        <a
                            href="{{ route('audit-logs.export', request()->except('page')) }}"
                            class="inline-flex items-center gap-2 rounded-xl border border-white/[0.05] bg-white/[0.018] px-3.5 py-2 text-xs font-medium text-[#A6ADB7] transition duration-200 hover:border-[#8B7CFF]/20 hover:bg-[#8B7CFF]/[0.06] hover:text-white"
                        >

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-4 w-4 text-[#A99FFF]"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 3v12m0 0l-4-4m4 4l4-4M5 21h14"
                                />
                            </svg>

                            Export CSV

                        </a>

                    </div>

                </div>


                @if ($logs->count())

                    {{-- Table --}}
                    <div class="overflow-x-auto">

                        <table class="min-w-full">

                            <thead>

                                <tr class="border-b border-white/[0.045] text-left">

                                    <th
                                        class="whitespace-nowrap px-6 py-4 text-[10px] font-semibold uppercase tracking-[0.16em] text-[#666D78] sm:px-7"
                                    >
                                        User
                                    </th>

                                    <th
                                        class="whitespace-nowrap px-6 py-4 text-[10px] font-semibold uppercase tracking-[0.16em] text-[#666D78]"
                                    >
                                        Action
                                    </th>

                                    <th
                                        class="whitespace-nowrap px-6 py-4 text-[10px] font-semibold uppercase tracking-[0.16em] text-[#666D78]"
                                    >
                                        Entity
                                    </th>

                                    <th
                                        class="whitespace-nowrap px-6 py-4 text-[10px] font-semibold uppercase tracking-[0.16em] text-[#666D78]"
                                    >
                                        IP Address
                                    </th>

                                    <th
                                        class="whitespace-nowrap px-6 py-4 text-[10px] font-semibold uppercase tracking-[0.16em] text-[#666D78]"
                                    >
                                        Timestamp
                                    </th>

                                    <th
                                        class="whitespace-nowrap px-6 py-4 text-right text-[10px] font-semibold uppercase tracking-[0.16em] text-[#666D78]"
                                    >
                                        Details
                                    </th>

                                </tr>

                            </thead>


                            <tbody class="divide-y divide-white/[0.035]">

                                @foreach ($logs as $log)

                                    @php

                                        $action = strtoupper((string) $log->action);

                                        $actionClass = match (true) {

                                            str_contains($action, 'CREATE') ||
                                            str_contains($action, 'CREATED') =>
                                                'border-emerald-500/20 bg-emerald-500/10 text-emerald-300',

                                            str_contains($action, 'UPDATE') ||
                                            str_contains($action, 'UPDATED') =>
                                                'border-blue-500/20 bg-blue-500/10 text-blue-300',

                                            str_contains($action, 'DELETE') ||
                                            str_contains($action, 'DELETED') =>
                                                'border-red-500/20 bg-red-500/10 text-red-300',

                                            default =>
                                                'border-white/[0.06] bg-white/[0.025] text-[#A6ADB8]',

                                        };

                                        $entityName = class_basename($log->auditable_type);

                                    @endphp


                                    <tr class="group transition duration-200 hover:bg-white/[0.018]">

                                        {{-- User --}}
                                        <td class="whitespace-nowrap px-6 py-5 sm:px-7">

                                            <div class="flex items-center gap-4">

                                                <div
                                                    class="relative flex h-11 w-11 shrink-0 items-center justify-center overflow-hidden rounded-2xl border border-[#8B7CFF]/10 bg-[#171B22] text-sm font-semibold text-[#A99FFF] transition duration-200 group-hover:border-[#8B7CFF]/25 group-hover:bg-[#8B7CFF]/[0.07]"
                                                >

                                                    <span class="relative z-10">

                                                        @if ($log->user)
                                                            {{ strtoupper(substr($log->user->name, 0, 1)) }}
                                                        @else
                                                            ?
                                                        @endif

                                                    </span>


                                                    <span
                                                        class="absolute inset-0 bg-[radial-gradient(circle_at_30%_20%,rgba(139,124,255,0.14),transparent_55%)]"
                                                    ></span>

                                                </div>


                                                <div class="min-w-0">

                                                    <p class="max-w-[220px] truncate text-sm font-medium text-[#F5F5F2]">
                                                        {{ $log->user?->name ?? 'System' }}
                                                    </p>

                                                    <p class="mt-1 max-w-[250px] truncate text-xs text-[#6F7681]">
                                                        {{ $log->user?->email ?? 'System generated event' }}
                                                    </p>

                                                </div>

                                            </div>

                                        </td>


                                        {{-- Action --}}
                                        <td class="whitespace-nowrap px-6 py-5">

                                            <span
                                                class="inline-flex items-center rounded-xl border px-3 py-1.5 text-[10px] font-semibold uppercase tracking-[0.12em] {{ $actionClass }}"
                                            >
                                                {{ $log->action }}
                                            </span>

                                        </td>


                                        {{-- Entity --}}
                                        <td class="whitespace-nowrap px-6 py-5">

                                            <div>

                                                <p class="text-sm font-medium text-[#DDE0E4]">
                                                    {{ $entityName }}
                                                </p>

                                                <p class="mt-1 text-xs text-[#686F7A]">
                                                    ID #{{ $log->auditable_id }}
                                                </p>

                                            </div>

                                        </td>


                                        {{-- IP Address --}}
                                        <td class="whitespace-nowrap px-6 py-5">

                                            <span class="rounded-lg border border-white/[0.04] bg-white/[0.015] px-2.5 py-1.5 font-mono text-xs text-[#9299A5]">
                                                {{ $log->ip_address ?? '—' }}
                                            </span>

                                        </td>


                                        {{-- Timestamp --}}
                                        <td class="whitespace-nowrap px-6 py-5">

                                            <p class="text-sm text-[#C6CAD0]">
                                                {{ $log->created_at?->format('d M Y') }}
                                            </p>

                                            <p class="mt-1 text-xs text-[#626974]">
                                                {{ $log->created_at?->format('H:i:s') }}
                                            </p>

                                        </td>


                                        {{-- Details --}}
                                        <td class="whitespace-nowrap px-6 py-5 text-right">

                                            <button
                                                type="button"
                                                onclick="openAuditDetail({{ $log->id }})"
                                                class="inline-flex items-center gap-2 rounded-xl border border-white/[0.05] bg-white/[0.018] px-3 py-2 text-xs font-medium text-[#9C91FF] transition duration-200 hover:border-[#8B7CFF]/20 hover:bg-[#8B7CFF]/[0.07] hover:text-white"
                                            >

                                                View

                                                <span class="transition-transform duration-200 group-hover:translate-x-0.5">
                                                    →
                                                </span>

                                            </button>

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>


                    {{-- Pagination --}}
                    @if ($logs->hasPages())

                        <div class="border-t border-white/[0.045] px-6 py-5 sm:px-7">

                            {{ $logs->onEachSide(1)->links() }}

                        </div>

                    @endif

                @else

                    {{-- Empty State --}}
                    <div
                        class="flex min-h-[380px] flex-col items-center justify-center px-6 text-center sm:px-8"
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


                        <h3 class="mt-5 text-sm font-semibold text-white">
                            No audit events found
                        </h3>


                        <p class="mt-2 max-w-md text-sm leading-6 text-[#707782]">
                            There are no activity records matching the current filters.
                        </p>


                        @if (request()->hasAny([
                            'search',
                            'action',
                            'date_from',
                            'date_to',
                        ]))

                            <a
                                href="{{ route('audit-logs.index') }}"
                                class="mt-6 inline-flex items-center gap-2 rounded-2xl border border-white/[0.06] bg-white/[0.018] px-5 py-3 text-sm font-medium text-[#AEB3BB] transition hover:border-[#8B7CFF]/20 hover:bg-[#8B7CFF]/[0.05] hover:text-white"
                            >
                                Clear Filters
                            </a>

                        @endif

                    </div>

                @endif

            </div>


            {{-- ========================================================
                SECURITY NOTE
            ========================================================= --}}

            <div
                class="relative mt-6 overflow-hidden rounded-[26px] border border-[#2E3150] bg-[#11131D] p-5 shadow-[0_20px_55px_rgba(0,0,0,0.16)]"
            >

                <div class="absolute right-[-30px] top-[-30px] h-28 w-28 rounded-full bg-[#8B7CFF]/[0.05] blur-2xl"></div>


                <div class="relative flex gap-4">

                    <div
                        class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl border border-[#403A72] bg-[#211E38] text-[#A99FFF]"
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
                                d="M12 3l7 4v5c0 4.5-2.9 7.9-7 9-4.1-1.1-7-4.5-7-9V7l7-4z"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M9 12l2 2 4-4"
                            />
                        </svg>

                    </div>


                    <div class="min-w-0">

                        <p class="text-[10px] font-semibold uppercase tracking-[0.18em] text-[#77708F]">
                            Security
                        </p>

                        <h3 class="mt-1 text-sm font-semibold text-[#E9E8F3]">
                            Audit trail protection
                        </h3>

                        <p class="mt-1 text-xs leading-5 text-[#858A98]">
                            Audit events are scoped to the current company workspace and provide
                            visibility into important system activity. Sensitive values are masked
                            in the activity detail view.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- ================================================================
        AUDIT DETAIL MODAL
    ================================================================= --}}

    <div
        id="auditDetailModal"
        class="fixed inset-0 z-[100] hidden"
        aria-hidden="true"
    >

        {{-- Backdrop --}}
        <div
            class="absolute inset-0 bg-black/75 backdrop-blur-sm"
            onclick="closeAuditDetail()"
        ></div>


        {{-- Modal --}}
        <div class="relative flex min-h-full items-center justify-center p-4 sm:p-6">

            <div
                id="auditDetailPanel"
                class="w-full max-w-4xl overflow-hidden rounded-[30px] border border-white/[0.06] bg-[#11151A] shadow-[0_35px_100px_rgba(0,0,0,0.45)]"
                role="dialog"
                aria-modal="true"
                aria-labelledby="auditDetailTitle"
            >

                {{-- Modal Header --}}
                <div
                    class="flex items-start justify-between gap-5 border-b border-white/[0.045] px-6 py-5 sm:px-7"
                >

                    <div class="min-w-0">

                        <div class="mb-2 flex items-center gap-2">

                            <span class="h-1.5 w-1.5 rounded-full bg-[#8B7CFF]"></span>

                            <p class="text-[10px] font-semibold uppercase tracking-[0.18em] text-[#707782]">
                                Audit Event
                            </p>

                        </div>


                        <h2
                            id="auditDetailTitle"
                            class="truncate text-lg font-semibold text-[#F5F5F2]"
                        >
                            Audit Event
                        </h2>


                        <p
                            id="auditDetailSubtitle"
                            class="mt-1 text-xs text-[#747B87]"
                        >
                            Activity detail
                        </p>

                    </div>


                    <button
                        type="button"
                        onclick="closeAuditDetail()"
                        class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl border border-white/[0.06] bg-white/[0.02] text-[#878E99] transition hover:border-white/[0.10] hover:bg-white/[0.05] hover:text-white"
                        aria-label="Close"
                    >
                        ×
                    </button>

                </div>


                {{-- Modal Content --}}
                <div class="max-h-[75vh] overflow-y-auto px-6 py-6 sm:px-7">

                    {{-- Metadata --}}
                    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">


                        <div class="rounded-[22px] border border-white/[0.05] bg-[#171B22] p-4">

                            <p class="text-[10px] font-semibold uppercase tracking-[0.15em] text-[#686F7A]">
                                User
                            </p>

                            <p
                                id="auditMetaUser"
                                class="mt-2 truncate text-sm font-medium text-[#E1E4E7]"
                            >
                                —
                            </p>

                        </div>


                        <div class="rounded-[22px] border border-white/[0.05] bg-[#171B22] p-4">

                            <p class="text-[10px] font-semibold uppercase tracking-[0.15em] text-[#686F7A]">
                                Entity
                            </p>

                            <p
                                id="auditMetaEntity"
                                class="mt-2 text-sm font-medium text-[#E1E4E7]"
                            >
                                —
                            </p>

                        </div>


                        <div class="rounded-[22px] border border-white/[0.05] bg-[#171B22] p-4">

                            <p class="text-[10px] font-semibold uppercase tracking-[0.15em] text-[#686F7A]">
                                IP Address
                            </p>

                            <p
                                id="auditMetaIp"
                                class="mt-2 font-mono text-sm text-[#B5BBC4]"
                            >
                                —
                            </p>

                        </div>


                        <div class="rounded-[22px] border border-white/[0.05] bg-[#171B22] p-4">

                            <p class="text-[10px] font-semibold uppercase tracking-[0.15em] text-[#686F7A]">
                                Timestamp
                            </p>

                            <p
                                id="auditMetaTimestamp"
                                class="mt-2 text-sm text-[#B5BBC4]"
                            >
                                —
                            </p>

                        </div>

                    </div>


                    {{-- User Agent --}}
                    <div class="mt-4 rounded-[22px] border border-white/[0.05] bg-[#171B22] p-4">

                        <p class="text-[10px] font-semibold uppercase tracking-[0.15em] text-[#686F7A]">
                            User Agent
                        </p>

                        <p
                            id="auditMetaUserAgent"
                            class="mt-2 break-all text-xs leading-5 text-[#8F96A1]"
                        >
                            —
                        </p>

                    </div>


                    {{-- Changes --}}
                    <div class="mt-6">

                        <div class="mb-4 flex items-center justify-between gap-4">

                            <div>

                                <p class="text-[10px] font-semibold uppercase tracking-[0.18em] text-[#707782]">
                                    Change History
                                </p>

                                <h3 class="mt-2 text-sm font-semibold text-white">
                                    Change Details
                                </h3>

                                <p class="mt-1 text-xs text-[#6F7682]">
                                    Compare recorded values before and after the event.
                                </p>

                            </div>


                            <span
                                id="auditActionBadge"
                                class="inline-flex shrink-0 items-center rounded-xl border px-3 py-1.5 text-[10px] font-semibold uppercase tracking-[0.12em]"
                            >
                                —
                            </span>

                        </div>


                        <div class="overflow-hidden rounded-[22px] border border-white/[0.05]">

                            <div class="overflow-x-auto">

                                <table class="w-full min-w-[720px]">

                                    <thead>

                                        <tr class="border-b border-white/[0.045]">

                                            <th
                                                class="w-[24%] px-4 py-3 text-left text-[10px] font-semibold uppercase tracking-[0.14em] text-[#666D78]"
                                            >
                                                Field
                                            </th>

                                            <th
                                                class="w-[38%] px-4 py-3 text-left text-[10px] font-semibold uppercase tracking-[0.14em] text-[#666D78]"
                                            >
                                                Old Value
                                            </th>

                                            <th
                                                class="w-[38%] px-4 py-3 text-left text-[10px] font-semibold uppercase tracking-[0.14em] text-[#666D78]"
                                            >
                                                New Value
                                            </th>

                                        </tr>

                                    </thead>


                                    <tbody
                                        id="auditChangesBody"
                                        class="divide-y divide-white/[0.035]"
                                    ></tbody>

                                </table>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- Modal Footer --}}
                <div
                    class="flex flex-col gap-3 border-t border-white/[0.045] px-6 py-4 sm:flex-row sm:items-center sm:justify-between sm:px-7"
                >

                    <p class="text-xs text-[#666D78]">

                        Audit event ID:

                        <span
                            id="auditFooterId"
                            class="font-mono text-[#949BA6]"
                        >
                            —
                        </span>

                    </p>


                    <button
                        type="button"
                        onclick="closeAuditDetail()"
                        class="rounded-xl border border-white/[0.06] bg-white/[0.02] px-4 py-2.5 text-sm font-medium text-[#B4BAC4] transition hover:border-white/[0.10] hover:bg-white/[0.045] hover:text-white"
                    >
                        Close
                    </button>

                </div>

            </div>

        </div>

    </div>


    {{-- ================================================================
        AUDIT LOG DATA + JAVASCRIPT
    ================================================================= --}}

    <script>

        window.nexoraAuditLogs = @js(

            $logs->getCollection()->map(function ($log) {

                return [

                    'id' => $log->id,

                    'action' => $log->action,

                    'auditable_type' => class_basename(
                        $log->auditable_type
                    ),

                    'auditable_id' => $log->auditable_id,

                    'old_values' => $log->old_values ?? [],

                    'new_values' => $log->new_values ?? [],

                    'ip_address' => $log->ip_address,

                    'user_agent' => $log->user_agent,

                    'created_at' => $log->created_at?->format(
                        'd M Y, H:i:s'
                    ),

                    'user_name' => $log->user?->name ?? 'System',

                    'user_email' => $log->user?->email
                        ?? 'System generated event',

                ];

            })->values()

        );


        function auditIsSensitiveKey(key) {

            const sensitiveKeys = [

                'password',
                'password_confirmation',
                'remember_token',
                'token',
                'secret',
                'api_key',
                'apikey',
                'access_token',
                'refresh_token',
                'authorization',
                'client_secret',

            ];


            const normalizedKey = String(key)
                .toLowerCase()
                .replace(/[\s\-_]/g, '');


            return sensitiveKeys.some(function (sensitiveKey) {

                const normalizedSensitiveKey = sensitiveKey
                    .toLowerCase()
                    .replace(/[\s\-_]/g, '');


                return normalizedKey === normalizedSensitiveKey
                    ||
                    normalizedKey.includes(
                        normalizedSensitiveKey
                    );

            });

        }


        function auditFormatValue(value, key = '') {

            if (auditIsSensitiveKey(key)) {

                return '•••••••• MASKED ••••••••';

            }


            if (
                value === null
                ||
                value === undefined
                ||
                value === ''
            ) {

                return '—';

            }


            if (typeof value === 'boolean') {

                return value ? 'true' : 'false';

            }


            if (typeof value === 'object') {

                try {

                    return JSON.stringify(
                        value,
                        null,
                        2
                    );

                } catch (error) {

                    return String(value);

                }

            }


            return String(value);

        }


        function auditFormatFieldName(field) {

            return String(field)

                .replace(/_/g, ' ')

                .replace(/\b\w/g, function (letter) {

                    return letter.toUpperCase();

                });

        }


        function getAuditActionClass(action) {

            const normalizedAction =
                String(action || '').toUpperCase();


            if (
                normalizedAction.includes('CREATE')
                ||
                normalizedAction.includes('CREATED')
            ) {

                return 'border-emerald-500/20 bg-emerald-500/10 text-emerald-300';

            }


            if (
                normalizedAction.includes('UPDATE')
                ||
                normalizedAction.includes('UPDATED')
            ) {

                return 'border-blue-500/20 bg-blue-500/10 text-blue-300';

            }


            if (
                normalizedAction.includes('DELETE')
                ||
                normalizedAction.includes('DELETED')
            ) {

                return 'border-red-500/20 bg-red-500/10 text-red-300';

            }


            return 'border-white/[0.06] bg-white/[0.025] text-[#A6ADB8]';

        }


        function openAuditDetail(id) {

            const logs =
                window.nexoraAuditLogs || [];


            const log = logs.find(function (item) {

                return Number(item.id) === Number(id);

            });


            if (!log) {

                return;

            }


            document.getElementById(
                'auditDetailTitle'
            ).textContent =
                log.action
                +
                ' · '
                +
                log.auditable_type;


            document.getElementById(
                'auditDetailSubtitle'
            ).textContent =
                'Record #'
                +
                log.auditable_id;


            document.getElementById(
                'auditMetaUser'
            ).textContent =
                log.user_name
                +
                ' · '
                +
                log.user_email;


            document.getElementById(
                'auditMetaEntity'
            ).textContent =
                log.auditable_type
                +
                ' · #'
                +
                log.auditable_id;


            document.getElementById(
                'auditMetaIp'
            ).textContent =
                log.ip_address || '—';


            document.getElementById(
                'auditMetaTimestamp'
            ).textContent =
                log.created_at || '—';


            document.getElementById(
                'auditMetaUserAgent'
            ).textContent =
                log.user_agent || '—';


            document.getElementById(
                'auditFooterId'
            ).textContent =
                '#'
                +
                log.id;


            const actionBadge =
                document.getElementById(
                    'auditActionBadge'
                );


            actionBadge.textContent =
                log.action || '—';


            actionBadge.className =
                'inline-flex shrink-0 items-center rounded-xl border px-3 py-1.5 text-[10px] font-semibold uppercase tracking-[0.12em] '
                +
                getAuditActionClass(
                    log.action
                );


            const oldValues =
                log.old_values || {};


            const newValues =
                log.new_values || {};


            const fieldNames = Array.from(

                new Set([

                    ...Object.keys(oldValues),

                    ...Object.keys(newValues),

                ])

            );


            const body =
                document.getElementById(
                    'auditChangesBody'
                );


            body.innerHTML = '';


            if (!fieldNames.length) {

                const emptyRow =
                    document.createElement('tr');


                const emptyCell =
                    document.createElement('td');


                emptyCell.colSpan = 3;


                emptyCell.className =
                    'px-4 py-8 text-center text-sm text-[#68707B]';


                emptyCell.textContent =
                    'No field-level change details are available for this event.';


                emptyRow.appendChild(
                    emptyCell
                );


                body.appendChild(
                    emptyRow
                );

            } else {

                fieldNames.forEach(
                    function (field) {

                        const row =
                            document.createElement('tr');


                        row.className =
                            'transition hover:bg-white/[0.018]';


                        const fieldCell =
                            document.createElement('td');


                        fieldCell.className =
                            'align-top px-4 py-4 text-xs font-medium text-[#B7BDC7]';


                        fieldCell.textContent =
                            auditFormatFieldName(
                                field
                            );


                        const oldCell =
                            document.createElement('td');


                        oldCell.className =
                            'align-top px-4 py-4';


                        const oldValue =
                            document.createElement('pre');


                        oldValue.className =
                            'max-h-48 overflow-auto whitespace-pre-wrap break-words rounded-xl border border-white/[0.05] bg-[#0C0F13] p-3 font-mono text-[11px] leading-5 text-[#8F96A1]';


                        oldValue.textContent =
                            auditFormatValue(
                                oldValues[field],
                                field
                            );


                        const newCell =
                            document.createElement('td');


                        newCell.className =
                            'align-top px-4 py-4';


                        const newValue =
                            document.createElement('pre');


                        newValue.className =
                            'max-h-48 overflow-auto whitespace-pre-wrap break-words rounded-xl border border-[#8B7CFF]/10 bg-[#11151A] p-3 font-mono text-[11px] leading-5 text-[#C0C6CE]';


                        newValue.textContent =
                            auditFormatValue(
                                newValues[field],
                                field
                            );


                        oldCell.appendChild(
                            oldValue
                        );


                        newCell.appendChild(
                            newValue
                        );


                        row.appendChild(
                            fieldCell
                        );


                        row.appendChild(
                            oldCell
                        );


                        row.appendChild(
                            newCell
                        );


                        body.appendChild(
                            row
                        );

                    }
                );

            }


            const modal =
                document.getElementById(
                    'auditDetailModal'
                );


            modal.classList.remove('hidden');


            modal.setAttribute(
                'aria-hidden',
                'false'
            );


            document.body.classList.add(
                'overflow-hidden'
            );

        }


        function closeAuditDetail() {

            const modal =
                document.getElementById(
                    'auditDetailModal'
                );


            modal.classList.add('hidden');


            modal.setAttribute(
                'aria-hidden',
                'true'
            );


            document.body.classList.remove(
                'overflow-hidden'
            );

        }


        document.addEventListener(
            'keydown',
            function (event) {

                if (event.key === 'Escape') {

                    closeAuditDetail();

                }

            }
        );

    </script>

</x-app-layout>