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


        {{-- Header --}}
        <div class="relative flex flex-col gap-5 border-b border-white/[0.045] pb-7 lg:flex-row lg:items-end lg:justify-between">

            <div>

                <div class="flex items-center gap-3">

                    <span
                        class="inline-flex h-2 w-2 rounded-full bg-[#8B7CFF] shadow-[0_0_14px_rgba(139,124,255,0.7)]"
                    ></span>

                    <p class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#A99FFF]">
                        Team
                    </p>

                </div>

                <h1 class="mt-3 text-3xl font-semibold tracking-[-0.03em] text-white">
                    Team Management
                </h1>

                <p class="mt-2 max-w-xl text-sm leading-6 text-[#8B919A]">
                    Manage your company members, roles, and access.
                </p>

            </div>


            <div class="flex items-center gap-3">

                <div
                    class="hidden rounded-full border border-white/[0.06] bg-white/[0.02] px-3 py-2 text-[10px] font-medium uppercase tracking-[0.16em] text-[#707782] sm:block"
                >
                    Team workspace
                </div>


                {{-- Manage Roles --}}
                <a
                    href="{{ route('roles.index') }}"
                    class="inline-flex items-center gap-2 rounded-2xl border border-white/[0.06] bg-white/[0.02] px-4 py-3 text-sm font-medium text-[#C4C8CF] transition duration-200 hover:-translate-y-0.5 hover:border-[#8B7CFF]/20 hover:bg-white/[0.04] hover:text-white"
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
                            d="M12 3l2.2 4.5L19 9.2l-4.5 2.2L12 16l-2.5-4.6L5 9.2l4.8-1.7L12 3z"
                        />
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M19 16l.9 1.9L22 18.7l-2.1.8L19 21l-.9-1.5-2.1-.8L18.1 18 19 16z"
                        />
                    </svg>

                    Manage Roles

                </a>


                {{-- Add Member --}}
                <a
                    href="{{ route('team.create') }}"
                    class="group inline-flex items-center gap-2 rounded-2xl bg-[#8B7CFF] px-5 py-3 text-sm font-medium text-white shadow-[0_10px_30px_rgba(139,124,255,0.18)] transition duration-200 hover:-translate-y-0.5 hover:bg-[#7C6EF0] hover:shadow-[0_14px_34px_rgba(139,124,255,0.24)]"
                >
                    <span class="text-base leading-none transition-transform duration-200 group-hover:rotate-90">
                        +
                    </span>

                    Add Member
                </a>

            </div>

        </div>


        {{-- Success Message --}}
        @if (session('success'))

            <div
                class="relative mt-6 overflow-hidden rounded-2xl border border-[#294333]/80 bg-[#111A15]/90 px-5 py-4 text-sm text-[#9FE2B5] shadow-[0_16px_45px_rgba(0,0,0,0.14)]"
            >

                <div class="absolute inset-y-0 left-0 w-1 bg-[#63D889]/70"></div>

                <div class="flex items-center gap-3">

                    <span class="flex h-7 w-7 items-center justify-center rounded-full bg-[#63D889]/10 text-[#9FE2B5]">
                        ✓
                    </span>

                    <span>
                        {{ session('success') }}
                    </span>

                </div>

            </div>

        @endif


        {{-- Stats --}}
        <div class="relative mt-6 grid gap-4 md:grid-cols-3">

            {{-- Total Members --}}
            <div
                class="group relative overflow-hidden rounded-[26px] border border-white/[0.055] bg-[#12151A]/90 p-5 shadow-[0_18px_55px_rgba(0,0,0,0.16)] backdrop-blur-sm transition duration-300 hover:-translate-y-0.5 hover:border-[#8B7CFF]/20"
            >

                <div class="absolute right-[-30px] top-[-35px] h-28 w-28 rounded-full bg-[#8B7CFF]/[0.08] blur-2xl transition duration-300 group-hover:bg-[#8B7CFF]/[0.12]"></div>

                <div class="relative flex items-start justify-between gap-4">

                    <div>

                        <p class="text-[10px] font-semibold uppercase tracking-[0.18em] text-[#707782]">
                            Total Members
                        </p>

                        <p class="mt-3 text-3xl font-semibold tracking-tight text-white">
                            {{ number_format($members->count()) }}
                        </p>

                        <p class="mt-2 text-xs text-[#666D78]">
                            Members in this workspace.
                        </p>

                    </div>


                    <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl border border-[#8B7CFF]/15 bg-[#8B7CFF]/[0.07] text-[#A99FFF]">

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


            {{-- Active Members --}}
            <div
                class="group relative overflow-hidden rounded-[26px] border border-white/[0.055] bg-[#12151A]/90 p-5 shadow-[0_18px_55px_rgba(0,0,0,0.16)] backdrop-blur-sm transition duration-300 hover:-translate-y-0.5 hover:border-[#63D889]/20"
            >

                <div class="absolute right-[-30px] top-[-35px] h-28 w-28 rounded-full bg-[#63D889]/[0.06] blur-2xl transition duration-300 group-hover:bg-[#63D889]/[0.10]"></div>

                <div class="relative flex items-start justify-between gap-4">

                    <div>

                        <p class="text-[10px] font-semibold uppercase tracking-[0.18em] text-[#707782]">
                            Active Members
                        </p>

                        <p class="mt-3 text-3xl font-semibold tracking-tight text-white">
                            {{ number_format($members->where('is_active', true)->count()) }}
                        </p>

                        <p class="mt-2 text-xs text-[#666D78]">
                            Members currently active.
                        </p>

                    </div>


                    <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl border border-[#63D889]/15 bg-[#63D889]/[0.06] text-[#9FE2B5]">

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


            {{-- Roles --}}
            <div
                class="group relative overflow-hidden rounded-[26px] border border-white/[0.055] bg-[#12151A]/90 p-5 shadow-[0_18px_55px_rgba(0,0,0,0.16)] backdrop-blur-sm transition duration-300 hover:-translate-y-0.5 hover:border-[#6F8CFF]/20"
            >

                <div class="absolute right-[-30px] top-[-35px] h-28 w-28 rounded-full bg-[#6F8CFF]/[0.06] blur-2xl transition duration-300 group-hover:bg-[#6F8CFF]/[0.10]"></div>

                <div class="relative flex items-start justify-between gap-4">

                    <div>

                        <p class="text-[10px] font-semibold uppercase tracking-[0.18em] text-[#707782]">
                            Active Roles
                        </p>

                        <p class="mt-3 text-3xl font-semibold tracking-tight text-white">
                            {{ number_format($roles->count()) }}
                        </p>

                        <p class="mt-2 text-xs text-[#666D78]">
                            Roles configured for members.
                        </p>

                    </div>


                    <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl border border-[#6F8CFF]/15 bg-[#6F8CFF]/[0.06] text-[#9EB6E8]">

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
                                d="M12 15l-3.5 2 1-4-3-2.5 4-.25L12 6l1.5 4.25 4 .25-3 2.5 1 4L12 15z"
                            />
                        </svg>

                    </div>

                </div>

            </div>

        </div>


        {{-- Team Table Surface --}}
        <div
            class="relative mt-6 overflow-hidden rounded-[30px] border border-white/[0.055] bg-[#11151A]/95 shadow-[0_30px_80px_rgba(0,0,0,0.22)] backdrop-blur-xl"
        >

            {{-- Directory Header --}}
            <div class="relative flex flex-col gap-4 border-b border-white/[0.045] px-6 py-5 sm:flex-row sm:items-center sm:justify-between sm:px-7">

                <div>

                    <p class="text-[10px] font-semibold uppercase tracking-[0.18em] text-[#707782]">
                        Team directory
                    </p>

                    <h2 class="mt-2 text-base font-semibold text-white">
                        All Members
                    </h2>

                    <p class="mt-1 text-xs text-[#666D78]">
                        {{ $members->count() }}
                        {{ Str::plural('member', $members->count()) }}
                    </p>

                </div>


                <div class="rounded-xl border border-white/[0.05] bg-white/[0.018] px-3 py-2 text-[10px] font-medium uppercase tracking-[0.14em] text-[#707782]">
                    Live directory
                </div>

            </div>


            @if ($members->count())

                <div class="overflow-x-auto">

                    <table class="min-w-full">

                        <thead>

                            <tr class="border-b border-white/[0.045] text-left">

                                <th class="px-6 py-4 text-[10px] font-semibold uppercase tracking-[0.16em] text-[#666D78] sm:px-7">
                                    Member
                                </th>

                                <th class="px-6 py-4 text-[10px] font-semibold uppercase tracking-[0.16em] text-[#666D78]">
                                    Contact
                                </th>

                                <th class="px-6 py-4 text-[10px] font-semibold uppercase tracking-[0.16em] text-[#666D78]">
                                    Role
                                </th>

                                <th class="px-6 py-4 text-[10px] font-semibold uppercase tracking-[0.16em] text-[#666D78]">
                                    Status
                                </th>

                                <th class="px-6 py-4 text-right text-[10px] font-semibold uppercase tracking-[0.16em] text-[#666D78]">
                                    Action
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y divide-white/[0.035]">

                            @foreach ($members as $member)

                                <tr class="group transition duration-200 hover:bg-white/[0.018]">

                                    {{-- Member --}}
                                    <td class="whitespace-nowrap px-6 py-5 sm:px-7">

                                        <div class="flex items-center gap-4">

                                            <div class="relative flex h-11 w-11 shrink-0 items-center justify-center overflow-hidden rounded-2xl border border-[#8B7CFF]/10 bg-[#171B22] text-sm font-semibold text-[#A99FFF] transition duration-200 group-hover:border-[#8B7CFF]/25 group-hover:bg-[#8B7CFF]/[0.07]">

                                                <span class="relative z-10">
                                                    {{ strtoupper(substr($member->name, 0, 1)) }}
                                                </span>

                                                <span class="absolute inset-0 bg-[radial-gradient(circle_at_30%_20%,rgba(139,124,255,0.14),transparent_55%)]"></span>

                                            </div>


                                            <div class="min-w-0">

                                                <p class="max-w-[240px] truncate text-sm font-medium text-[#F5F5F2]">
                                                    {{ $member->name }}
                                                </p>

                                                <p class="mt-1 text-xs text-[#6F7681]">
                                                    Member #{{ $member->id }}
                                                </p>

                                            </div>

                                        </div>

                                    </td>


                                    {{-- Contact --}}
                                    <td class="whitespace-nowrap px-6 py-5">

                                        <div class="flex items-center gap-2">

                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-4 w-4 text-[#565D67]"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor"
                                                stroke-width="1.8"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M3 8l9 6 9-6"
                                                />

                                                <rect
                                                    x="3"
                                                    y="5"
                                                    width="18"
                                                    height="14"
                                                    rx="2"
                                                />
                                            </svg>

                                            <span class="text-sm text-[#C5CAD2]">
                                                {{ $member->email }}
                                            </span>

                                        </div>

                                    </td>


                                    {{-- Role --}}
                                    <td class="px-6 py-5">

                                        @if ($member->roles->count())

                                            <div class="flex flex-wrap gap-2">

                                                @foreach ($member->roles as $role)

                                                    <span class="inline-flex items-center rounded-xl border border-[#8B7CFF]/15 bg-[#8B7CFF]/[0.07] px-3 py-1.5 text-[11px] font-medium text-[#A99FFF]">
                                                        {{ $role->name }}
                                                    </span>

                                                @endforeach

                                            </div>

                                        @else

                                            <span class="text-sm text-[#505761]">
                                                No role assigned
                                            </span>

                                        @endif

                                    </td>


                                    {{-- Status --}}
                                    <td class="whitespace-nowrap px-6 py-5">

                                        @if ($member->is_active)

                                            <span class="inline-flex items-center rounded-full border border-[#294333] bg-[#122019] px-3 py-1.5 text-[11px] font-medium text-[#9FE2B5] shadow-[0_0_20px_rgba(99,216,137,0.05)]">

                                                <span class="mr-2 h-1.5 w-1.5 rounded-full bg-[#63D889] shadow-[0_0_8px_rgba(99,216,137,0.75)]"></span>

                                                Active

                                            </span>

                                        @else

                                            <span class="inline-flex items-center rounded-full border border-[#3A3E45] bg-[#1A1D22] px-3 py-1.5 text-[11px] font-medium text-[#8B919A]">

                                                <span class="mr-2 h-1.5 w-1.5 rounded-full bg-[#686F79]"></span>

                                                Inactive

                                            </span>

                                        @endif

                                    </td>


                                    {{-- Action --}}
                                    <td class="whitespace-nowrap px-6 py-5 text-right">

                                        <a
                                            href="{{ route('team.edit', $member) }}"
                                            class="inline-flex items-center gap-2 rounded-xl border border-white/[0.05] bg-white/[0.018] px-3 py-2 text-xs font-medium text-[#9C91FF] transition duration-200 hover:border-[#8B7CFF]/20 hover:bg-[#8B7CFF]/[0.07] hover:text-white"
                                        >

                                            Manage

                                            <span class="transition-transform duration-200 group-hover:translate-x-0.5">
                                                →
                                            </span>

                                        </a>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                {{-- Empty State --}}
                <div class="px-6 py-20 text-center sm:px-8">

                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-[22px] border border-[#8B7CFF]/10 bg-[#171B22] text-[#A99FFF] shadow-[0_18px_45px_rgba(0,0,0,0.18)]">

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


                    <h3 class="mt-5 text-sm font-semibold text-white">
                        No team members yet
                    </h3>


                    <p class="mx-auto mt-2 max-w-sm text-sm leading-6 text-[#707782]">
                        Start building your organization by adding your first team member.
                    </p>


                    <a
                        href="{{ route('team.create') }}"
                        class="group mt-6 inline-flex items-center gap-2 rounded-2xl bg-[#8B7CFF] px-5 py-3 text-sm font-medium text-white shadow-[0_10px_30px_rgba(139,124,255,0.18)] transition duration-200 hover:-translate-y-0.5 hover:bg-[#7C6EF0]"
                    >
                        <span class="text-base leading-none transition-transform duration-200 group-hover:rotate-90">
                            +
                        </span>

                        Add Member
                    </a>

                </div>

            @endif

        </div>

    </div>

</x-app-layout>