<x-app-layout>

    <div class="mx-auto max-w-4xl space-y-6">

        {{-- Header --}}
        <div>

            <a
                href="{{ route('team.index') }}"
                class="inline-flex items-center gap-2 text-sm text-[#8B919A] transition hover:text-[#F5F5F2]"
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
                        d="M15 19l-7-7 7-7"
                    />
                </svg>

                Back to Team
            </a>


            <div class="mt-5">

                <div class="flex items-center gap-3">

                    <span
                        class="h-2 w-2 rounded-full bg-[#8B7CFF] shadow-[0_0_12px_rgba(139,124,255,0.65)]"
                    ></span>

                    <p class="text-xs font-medium uppercase tracking-[0.2em] text-[#8B7CFF]">
                        Organization
                    </p>

                </div>


                <h1 class="mt-3 text-2xl font-semibold tracking-tight text-[#F5F5F2]">
                    Edit Team Member
                </h1>


                <p class="mt-1 text-sm text-[#8B919A]">
                    Update account information, password, role, and account status.
                </p>

            </div>

        </div>


        {{-- Validation Errors --}}
        @if ($errors->any())

            <div
                class="rounded-2xl border border-red-400/20 bg-red-400/[0.07] p-5"
            >

                <div class="flex gap-3">

                    <div class="mt-0.5 shrink-0 text-red-400">

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
                                d="M12 9v3.5m0 3h.01M10.3 3.8L2.6 17a2 2 0 001.73 3h15.34a2 2 0 001.73-3L13.7 3.8a2 2 0 00-3.4 0z"
                            />
                        </svg>

                    </div>


                    <div>

                        <p class="text-sm font-medium text-red-300">
                            Please check the following:
                        </p>


                        <ul class="mt-2 space-y-1 text-sm text-red-300/80">

                            @foreach ($errors->all() as $error)

                                <li>
                                    • {{ $error }}
                                </li>

                            @endforeach

                        </ul>

                    </div>

                </div>

            </div>

        @endif


        {{-- Success Message --}}
        @if (session('success'))

            <div
                class="rounded-2xl border border-[#294333] bg-[#122019] px-5 py-4"
            >

                <div class="flex items-center gap-3">

                    <div
                        class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-[#63D889]/10 text-[#9FE2B5]"
                    >
                        ✓
                    </div>


                    <p class="text-sm text-[#9FE2B5]">
                        {{ session('success') }}
                    </p>

                </div>

            </div>

        @endif


        {{-- Main Form --}}
        <form
            method="POST"
            action="{{ route('team.update', $member) }}"
            class="overflow-hidden rounded-[28px] border border-[#242830] bg-[#12151A] shadow-[0_25px_70px_rgba(0,0,0,0.18)]"
        >

            @csrf
            @method('PUT')


            {{-- Account Information --}}
            <div class="border-b border-[#242830] px-6 py-7 sm:px-7">

                <div>

                    <p class="text-[10px] font-semibold uppercase tracking-[0.18em] text-[#707782]">
                        Member profile
                    </p>

                    <h2 class="mt-2 text-base font-semibold text-[#F5F5F2]">
                        Account Information
                    </h2>

                    <p class="mt-1 text-sm text-[#8B919A]">
                        Update the member's basic account information.
                    </p>

                </div>


                <div class="mt-6 grid grid-cols-1 gap-5 md:grid-cols-2">

                    {{-- Name --}}
                    <div>

                        <label
                            for="name"
                            class="mb-2 block text-sm font-medium text-[#D6D8DC]"
                        >
                            Full Name
                        </label>


                        <input
                            id="name"
                            name="name"
                            type="text"
                            value="{{ old('name', $member->name) }}"
                            required
                            class="w-full rounded-xl border border-[#242830] bg-[#0B0D10] px-4 py-3 text-sm text-[#F5F5F2] outline-none transition placeholder:text-[#555B64] focus:border-[#8B7CFF] focus:ring-1 focus:ring-[#8B7CFF]"
                        >

                    </div>


                    {{-- Email --}}
                    <div>

                        <label
                            for="email"
                            class="mb-2 block text-sm font-medium text-[#D6D8DC]"
                        >
                            Email Address
                        </label>


                        <input
                            id="email"
                            name="email"
                            type="email"
                            value="{{ old('email', $member->email) }}"
                            required
                            class="w-full rounded-xl border border-[#242830] bg-[#0B0D10] px-4 py-3 text-sm text-[#F5F5F2] outline-none transition placeholder:text-[#555B64] focus:border-[#8B7CFF] focus:ring-1 focus:ring-[#8B7CFF]"
                        >

                    </div>

                </div>

            </div>


            {{-- Password --}}
            <div class="border-b border-[#242830] px-6 py-7 sm:px-7">

                <div>

                    <p class="text-[10px] font-semibold uppercase tracking-[0.18em] text-[#707782]">
                        Security
                    </p>

                    <h2 class="mt-2 text-base font-semibold text-[#F5F5F2]">
                        Change Password
                    </h2>

                    <p class="mt-1 text-sm text-[#8B919A]">
                        Leave these fields empty if the password should remain unchanged.
                    </p>

                </div>


                <div class="mt-6 grid grid-cols-1 gap-5 md:grid-cols-2">

                    {{-- Password --}}
                    <div>

                        <label
                            for="password"
                            class="mb-2 block text-sm font-medium text-[#D6D8DC]"
                        >
                            New Password
                        </label>


                        <input
                            id="password"
                            name="password"
                            type="password"
                            placeholder="Minimum 8 characters"
                            class="w-full rounded-xl border border-[#242830] bg-[#0B0D10] px-4 py-3 text-sm text-[#F5F5F2] outline-none transition placeholder:text-[#555B64] focus:border-[#8B7CFF] focus:ring-1 focus:ring-[#8B7CFF]"
                        >

                    </div>


                    {{-- Confirm Password --}}
                    <div>

                        <label
                            for="password_confirmation"
                            class="mb-2 block text-sm font-medium text-[#D6D8DC]"
                        >
                            Confirm New Password
                        </label>


                        <input
                            id="password_confirmation"
                            name="password_confirmation"
                            type="password"
                            placeholder="Repeat the new password"
                            class="w-full rounded-xl border border-[#242830] bg-[#0B0D10] px-4 py-3 text-sm text-[#F5F5F2] outline-none transition placeholder:text-[#555B64] focus:border-[#8B7CFF] focus:ring-1 focus:ring-[#8B7CFF]"
                        >

                    </div>

                </div>

            </div>


            {{-- Role --}}
            <div class="border-b border-[#242830] px-6 py-7 sm:px-7">

                <div>

                    <p class="text-[10px] font-semibold uppercase tracking-[0.18em] text-[#707782]">
                        Access control
                    </p>

                    <h2 class="mt-2 text-base font-semibold text-[#F5F5F2]">
                        Access Role
                    </h2>

                    <p class="mt-1 text-sm text-[#8B919A]">
                        Change the level of access assigned to this member.
                    </p>

                </div>


                <div class="mt-6">

                    <label
                        for="role_id"
                        class="mb-2 block text-sm font-medium text-[#D6D8DC]"
                    >
                        Role
                    </label>


                    <select
                        id="role_id"
                        name="role_id"
                        required
                        class="w-full rounded-xl border border-[#242830] bg-[#0B0D10] px-4 py-3 text-sm text-[#F5F5F2] outline-none transition focus:border-[#8B7CFF] focus:ring-1 focus:ring-[#8B7CFF]"
                    >

                        <option value="">
                            Select a role
                        </option>


                        @foreach ($roles as $role)

                            <option
                                value="{{ $role->id }}"
                                @selected(
                                    old(
                                        'role_id',
                                        $currentRole?->id
                                    ) == $role->id
                                )
                            >
                                {{ $role->name }}
                            </option>

                        @endforeach

                    </select>

                </div>

            </div>


            {{-- Save Actions --}}
            <div
                class="flex items-center justify-end gap-3 bg-[#0E1116] px-6 py-5 sm:px-7"
            >

                <a
                    href="{{ route('team.index') }}"
                    class="rounded-xl border border-[#242830] px-4 py-2.5 text-sm font-medium text-[#AEB3BB] transition hover:border-[#3A404A] hover:text-[#F5F5F2]"
                >
                    Cancel
                </a>


                <button
                    type="submit"
                    class="inline-flex items-center gap-2 rounded-xl bg-[#8B7CFF] px-5 py-2.5 text-sm font-medium text-white transition hover:bg-[#7869EE]"
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
                            d="M5 13l4 4L19 7"
                        />

                    </svg>

                    Save Changes

                </button>

            </div>

        </form>


        {{-- Account Status --}}
        <div
            class="overflow-hidden rounded-[28px] border border-[#242830] bg-[#12151A] shadow-[0_25px_70px_rgba(0,0,0,0.14)]"
        >

            <div class="px-6 py-7 sm:px-7">

                <div class="flex flex-col gap-6 sm:flex-row sm:items-center sm:justify-between">

                    <div class="flex items-start gap-4">

                        {{-- Status Icon --}}
                        <div
                            class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl
                            {{ $member->is_active
                                ? 'border border-[#294333] bg-[#122019] text-[#9FE2B5]'
                                : 'border border-[#3A3E45] bg-[#1A1D22] text-[#8B919A]'
                            }}"
                        >

                            @if ($member->is_active)

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

                            @else

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
                                        d="M18 6L6 18M6 6l12 12"
                                    />
                                </svg>

                            @endif

                        </div>


                        <div>

                            <p class="text-[10px] font-semibold uppercase tracking-[0.18em] text-[#707782]">
                                Account status
                            </p>


                            <div class="mt-2 flex items-center gap-3">

                                @if ($member->is_active)

                                    <span class="text-base font-semibold text-[#F5F5F2]">
                                        Active
                                    </span>

                                    <span
                                        class="inline-flex items-center gap-2 rounded-full border border-[#294333] bg-[#122019] px-2.5 py-1 text-[10px] font-medium text-[#9FE2B5]"
                                    >
                                        <span
                                            class="h-1.5 w-1.5 rounded-full bg-[#63D889] shadow-[0_0_7px_rgba(99,216,137,0.75)]"
                                        ></span>

                                        Enabled
                                    </span>

                                @else

                                    <span class="text-base font-semibold text-[#F5F5F2]">
                                        Inactive
                                    </span>

                                    <span
                                        class="inline-flex items-center gap-2 rounded-full border border-[#3A3E45] bg-[#1A1D22] px-2.5 py-1 text-[10px] font-medium text-[#8B919A]"
                                    >
                                        <span class="h-1.5 w-1.5 rounded-full bg-[#686F79]"></span>

                                        Disabled
                                    </span>

                                @endif

                            </div>


                            <p class="mt-2 max-w-xl text-sm leading-6 text-[#777E89]">

                                @if ($member->is_active)

                                    This member can currently sign in and access the NEXORA workspace according to their assigned role.

                                @else

                                    This member cannot sign in while the account is inactive. Their account data and role remain preserved.

                                @endif

                            </p>

                        </div>

                    </div>


                    {{-- Status Action --}}
                    @if ($member->id !== auth()->id())

                        <form
                            method="POST"
                            action="{{ route('team.toggle-status', $member) }}"
                            class="shrink-0"
                        >

                            @csrf
                            @method('PATCH')


                            @if ($member->is_active)

                                <button
                                    type="submit"
                                    class="inline-flex items-center gap-2 rounded-xl border border-[#5A3035] bg-[#1D1316] px-4 py-2.5 text-sm font-medium text-[#E79A9A] transition duration-200 hover:border-[#7A3D44] hover:bg-[#28171A] hover:text-[#F2B0B0]"
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
                                            d="M18 6L6 18M6 6l12 12"
                                        />

                                    </svg>

                                    Deactivate Account

                                </button>

                            @else

                                <button
                                    type="submit"
                                    class="inline-flex items-center gap-2 rounded-xl border border-[#294333] bg-[#122019] px-4 py-2.5 text-sm font-medium text-[#9FE2B5] transition duration-200 hover:border-[#376047] hover:bg-[#16271D] hover:text-white"
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
                                            d="M5 13l4 4L19 7"
                                        />

                                    </svg>

                                    Activate Account

                                </button>

                            @endif

                        </form>

                    @else

                        <div
                            class="rounded-xl border border-white/[0.05] bg-white/[0.018] px-4 py-2.5 text-xs text-[#686F79]"
                        >
                            Your own account
                        </div>

                    @endif

                </div>

            </div>

        </div>


        {{-- Member Identity --}}
        <div
            class="flex items-center justify-between rounded-[24px] border border-white/[0.045] bg-[#0E1116] px-6 py-5 sm:px-7"
        >

            <div class="flex items-center gap-4">

                <div
                    class="flex h-11 w-11 items-center justify-center rounded-2xl border border-[#8B7CFF]/10 bg-[#171B22] text-sm font-semibold text-[#A99FFF]"
                >
                    {{ strtoupper(substr($member->name, 0, 1)) }}
                </div>


                <div>

                    <p class="text-sm font-medium text-[#F5F5F2]">
                        {{ $member->name }}
                    </p>

                    <p class="mt-1 text-xs text-[#686F79]">
                        Member #{{ $member->id }}
                    </p>

                </div>

            </div>


            <a
                href="{{ route('team.index') }}"
                class="text-xs font-medium text-[#707782] transition hover:text-white"
            >
                View Directory →
            </a>

        </div>

    </div>

</x-app-layout>

