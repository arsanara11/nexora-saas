<x-app-layout>

    <div
        class="relative isolate overflow-hidden rounded-[48px] border border-white/[0.045] bg-[#0B0D10] px-6 py-7 text-[#F5F5F2] shadow-[0_35px_90px_rgba(0,0,0,0.22)] sm:px-8 sm:py-8 lg:px-10 lg:py-9"
    >

        {{-- Ambient background --}}
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
                            Access Control
                        </p>

                    </div>


                    <h1 class="mt-3 text-3xl font-semibold tracking-[-0.03em] text-white">
                        Roles & Permissions
                    </h1>


                    <p class="mt-2 max-w-xl text-sm leading-6 text-[#8B919A]">
                        Manage roles and control what each role can access.
                    </p>

                </div>


                <div class="flex items-center gap-3">

                    <div
                        class="hidden rounded-full border border-white/[0.06] bg-white/[0.02] px-3 py-2 text-[10px] font-medium uppercase tracking-[0.16em] text-[#707782] sm:block"
                    >
                        Access workspace
                    </div>


                    <a
                        href="{{ route('roles.create') }}"
                        class="group inline-flex items-center gap-2 rounded-2xl bg-[#8B7CFF] px-5 py-3 text-sm font-medium text-white shadow-[0_10px_30px_rgba(139,124,255,0.18)] transition duration-200 hover:-translate-y-0.5 hover:bg-[#7C6EF0] hover:shadow-[0_14px_34px_rgba(139,124,255,0.24)]"
                    >

                        <span class="text-base leading-none transition-transform duration-200 group-hover:rotate-90">
                            +
                        </span>

                        Create Role

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
                ERROR MESSAGE
            ========================================================= --}}

            @if (session('error'))

                <div
                    class="relative mt-6 overflow-hidden rounded-2xl border border-red-500/15 bg-red-500/[0.05] px-5 py-4 text-sm text-red-300 shadow-[0_16px_45px_rgba(0,0,0,0.14)]"
                >

                    <div class="absolute inset-y-0 left-0 w-1 bg-red-400/70"></div>

                    <div class="flex items-center gap-3">

                        <span
                            class="flex h-7 w-7 items-center justify-center rounded-full bg-red-400/10 text-red-300"
                        >
                            !
                        </span>

                        <span>
                            {{ session('error') }}
                        </span>

                    </div>

                </div>

            @endif


            {{-- ========================================================
                STATS
            ========================================================= --}}

            <div class="relative mt-6 grid gap-4 md:grid-cols-3">


                {{-- Total Roles --}}
                <div
                    class="group relative overflow-hidden rounded-[26px] border border-white/[0.055] bg-[#12151A]/90 p-5 shadow-[0_18px_55px_rgba(0,0,0,0.16)] backdrop-blur-sm transition duration-300 hover:-translate-y-0.5 hover:border-[#8B7CFF]/20"
                >

                    <div
                        class="absolute right-[-30px] top-[-35px] h-28 w-28 rounded-full bg-[#8B7CFF]/[0.08] blur-2xl transition duration-300 group-hover:bg-[#8B7CFF]/[0.12]"
                    ></div>


                    <div class="relative flex items-start justify-between gap-4">

                        <div>

                            <p class="text-[10px] font-semibold uppercase tracking-[0.18em] text-[#707782]">
                                Total Roles
                            </p>

                            <p class="mt-3 text-3xl font-semibold tracking-tight text-white">
                                {{ number_format($roles->count()) }}
                            </p>

                            <p class="mt-2 text-xs text-[#666D78]">
                                Roles configured in this workspace.
                            </p>

                        </div>


                        <div
                            class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl border border-[#8B7CFF]/15 bg-[#8B7CFF]/[0.07] text-[#A99FFF]"
                        >

                            <svg
                                class="h-5 w-5"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
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
                                    d="M22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"
                                />
                            </svg>

                        </div>

                    </div>

                </div>


                {{-- Permissions --}}
                <div
                    class="group relative overflow-hidden rounded-[26px] border border-white/[0.055] bg-[#12151A]/90 p-5 shadow-[0_18px_55px_rgba(0,0,0,0.16)] backdrop-blur-sm transition duration-300 hover:-translate-y-0.5 hover:border-[#6F8CFF]/20"
                >

                    <div
                        class="absolute right-[-30px] top-[-35px] h-28 w-28 rounded-full bg-[#6F8CFF]/[0.06] blur-2xl transition duration-300 group-hover:bg-[#6F8CFF]/[0.10]"
                    ></div>


                    <div class="relative flex items-start justify-between gap-4">

                        <div>

                            <p class="text-[10px] font-semibold uppercase tracking-[0.18em] text-[#707782]">
                                Available Permissions
                            </p>

                            <p class="mt-3 text-3xl font-semibold tracking-tight text-white">
                                10
                            </p>

                            <p class="mt-2 text-xs text-[#666D78]">
                                Permissions available to assign.
                            </p>

                        </div>


                        <div
                            class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl border border-[#6F8CFF]/15 bg-[#6F8CFF]/[0.06] text-[#9EB6E8]"
                        >

                            <svg
                                class="h-5 w-5"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M9 12h6"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 9v6"
                                />

                                <rect
                                    x="3"
                                    y="3"
                                    width="18"
                                    height="18"
                                    rx="3"
                                />

                            </svg>

                        </div>

                    </div>

                </div>


                {{-- Protected Role --}}
                <div
                    class="group relative overflow-hidden rounded-[26px] border border-white/[0.055] bg-[#12151A]/90 p-5 shadow-[0_18px_55px_rgba(0,0,0,0.16)] backdrop-blur-sm transition duration-300 hover:-translate-y-0.5 hover:border-amber-400/20"
                >

                    <div
                        class="absolute right-[-30px] top-[-35px] h-28 w-28 rounded-full bg-amber-400/[0.04] blur-2xl transition duration-300 group-hover:bg-amber-400/[0.07]"
                    ></div>


                    <div class="relative flex items-start justify-between gap-4">

                        <div>

                            <p class="text-[10px] font-semibold uppercase tracking-[0.18em] text-[#707782]">
                                Protected Role
                            </p>

                            <p class="mt-3 text-3xl font-semibold tracking-tight text-white">
                                Owner
                            </p>

                            <p class="mt-2 text-xs text-[#666D78]">
                                System-protected administrator role.
                            </p>

                        </div>


                        <div
                            class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl border border-amber-400/15 bg-amber-400/[0.06] text-amber-300"
                        >

                            <svg
                                class="h-5 w-5"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >
                                <rect
                                    x="4"
                                    y="10"
                                    width="16"
                                    height="11"
                                    rx="2"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M8 10V7a4 4 0 0 1 8 0v3"
                                />

                            </svg>

                        </div>

                    </div>

                </div>

            </div>


            {{-- ========================================================
                ROLES DIRECTORY
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
                            Access directory
                        </p>

                        <h2 class="mt-2 text-base font-semibold text-white">
                            Organization Roles
                        </h2>

                        <p class="mt-1 text-xs text-[#666D78]">
                            {{ $roles->count() }}
                            {{ $roles->count() === 1 ? 'role' : 'roles' }}
                            configured for this workspace.
                        </p>

                    </div>


                    <div
                        class="rounded-xl border border-white/[0.05] bg-white/[0.018] px-3 py-2 text-[10px] font-medium uppercase tracking-[0.14em] text-[#707782]"
                    >
                        Live directory
                    </div>

                </div>


                @if ($roles->count())

                    {{-- Table --}}
                    <div class="overflow-x-auto">

                        <table class="min-w-full">

                            <thead>

                                <tr class="border-b border-white/[0.045] text-left">

                                    <th
                                        class="whitespace-nowrap px-6 py-4 text-[10px] font-semibold uppercase tracking-[0.16em] text-[#666D78] sm:px-7"
                                    >
                                        Role
                                    </th>

                                    <th
                                        class="whitespace-nowrap px-6 py-4 text-[10px] font-semibold uppercase tracking-[0.16em] text-[#666D78]"
                                    >
                                        Description
                                    </th>

                                    <th
                                        class="whitespace-nowrap px-6 py-4 text-[10px] font-semibold uppercase tracking-[0.16em] text-[#666D78]"
                                    >
                                        Permissions
                                    </th>

                                    <th
                                        class="whitespace-nowrap px-6 py-4 text-right text-[10px] font-semibold uppercase tracking-[0.16em] text-[#666D78]"
                                    >
                                        Action
                                    </th>

                                </tr>

                            </thead>


                            <tbody class="divide-y divide-white/[0.035]">

                                @foreach ($roles as $role)

                                    <tr class="group transition duration-200 hover:bg-white/[0.018]">

                                        {{-- Role --}}
                                        <td class="whitespace-nowrap px-6 py-5 sm:px-7">

                                            <div class="flex items-center gap-4">

                                                <div
                                                    class="relative flex h-11 w-11 shrink-0 items-center justify-center overflow-hidden rounded-2xl border border-[#8B7CFF]/10 bg-[#171B22] text-sm font-semibold text-[#A99FFF] transition duration-200 group-hover:border-[#8B7CFF]/25 group-hover:bg-[#8B7CFF]/[0.07]"
                                                >

                                                    <span class="relative z-10">
                                                        {{ strtoupper(substr($role->name, 0, 1)) }}
                                                    </span>

                                                    <span
                                                        class="absolute inset-0 bg-[radial-gradient(circle_at_30%_20%,rgba(139,124,255,0.14),transparent_55%)]"
                                                    ></span>

                                                </div>


                                                <div class="min-w-0">

                                                    <p class="max-w-[220px] truncate text-sm font-medium text-[#F5F5F2]">
                                                        {{ $role->name }}
                                                    </p>

                                                    <p class="mt-1 max-w-[220px] truncate text-xs text-[#6F7681]">
                                                        {{ $role->slug }}
                                                    </p>

                                                </div>

                                            </div>

                                        </td>


                                        {{-- Description --}}
                                        <td class="max-w-[420px] px-6 py-5">

                                            <p class="text-sm leading-6 text-[#AEB3BB]">
                                                {{ $role->description ?: 'No description provided.' }}
                                            </p>

                                        </td>


                                        {{-- Permissions --}}
                                        <td class="whitespace-nowrap px-6 py-5">

                                            <span
                                                class="inline-flex items-center rounded-full border border-[#8B7CFF]/15 bg-[#8B7CFF]/[0.07] px-3 py-1.5 text-[11px] font-medium text-[#A99FFF]"
                                            >

                                                {{ $role->permissions_count }}

                                                {{ $role->permissions_count === 1 ? 'permission' : 'permissions' }}

                                            </span>

                                        </td>


                                        {{-- Action --}}
                                        <td class="whitespace-nowrap px-6 py-5 text-right">

                                            <div class="flex items-center justify-end gap-2">

                                                <a
                                                    href="{{ route('roles.edit', $role) }}"
                                                    class="inline-flex items-center gap-2 rounded-xl border border-white/[0.05] bg-white/[0.018] px-3 py-2 text-xs font-medium text-[#9C91FF] transition duration-200 hover:border-[#8B7CFF]/20 hover:bg-[#8B7CFF]/[0.07] hover:text-white"
                                                >

                                                    <svg
                                                        class="h-3.5 w-3.5"
                                                        viewBox="0 0 24 24"
                                                        fill="none"
                                                        stroke="currentColor"
                                                        stroke-width="1.8"
                                                    >
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            d="M12 20h9"
                                                        />

                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4Z"
                                                        />

                                                    </svg>

                                                    Edit

                                                </a>


                                                @if ($role->name !== 'Owner')

                                                    <form
                                                        method="POST"
                                                        action="{{ route('roles.destroy', $role) }}"
                                                        onsubmit="return confirm('Delete this role?');"
                                                    >

                                                        @csrf
                                                        @method('DELETE')

                                                        <button
                                                            type="submit"
                                                            class="inline-flex items-center gap-2 rounded-xl border border-red-400/10 bg-red-400/[0.04] px-3 py-2 text-xs font-medium text-red-300 transition duration-200 hover:border-red-400/20 hover:bg-red-400/[0.08]"
                                                        >

                                                            <svg
                                                                class="h-3.5 w-3.5"
                                                                viewBox="0 0 24 24"
                                                                fill="none"
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

                                                            Delete

                                                        </button>

                                                    </form>

                                                @else

                                                    <span
                                                        class="inline-flex items-center gap-2 rounded-full border border-amber-400/10 bg-amber-400/[0.05] px-3 py-1.5 text-[11px] font-medium text-amber-300"
                                                    >

                                                        <span
                                                            class="h-1.5 w-1.5 rounded-full bg-amber-300 shadow-[0_0_8px_rgba(252,211,77,0.45)]"
                                                        ></span>

                                                        Protected

                                                    </span>

                                                @endif

                                            </div>

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                @else

                    {{-- Empty State --}}
                    <div
                        class="flex min-h-[380px] flex-col items-center justify-center px-6 text-center sm:px-8"
                    >

                        <div
                            class="flex h-16 w-16 items-center justify-center rounded-[22px] border border-[#8B7CFF]/10 bg-[#171B22] text-[#A99FFF] shadow-[0_18px_45px_rgba(0,0,0,0.18)]"
                        >

                            <svg
                                class="h-7 w-7"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
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
                                    d="M22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"
                                />
                            </svg>

                        </div>


                        <h3 class="mt-5 text-sm font-semibold text-white">
                            No roles yet
                        </h3>


                        <p class="mt-2 max-w-sm text-sm leading-6 text-[#707782]">
                            Create your first role and define the permissions available to it.
                        </p>


                        <a
                            href="{{ route('roles.create') }}"
                            class="group mt-6 inline-flex items-center gap-2 rounded-2xl bg-[#8B7CFF] px-5 py-3 text-sm font-medium text-white shadow-[0_10px_30px_rgba(139,124,255,0.18)] transition duration-200 hover:-translate-y-0.5 hover:bg-[#7C6EF0]"
                        >

                            <span class="text-base leading-none transition-transform duration-200 group-hover:rotate-90">
                                +
                            </span>

                            Create Role

                        </a>

                    </div>

                @endif

            </div>

        </div>

    </div>

</x-app-layout>