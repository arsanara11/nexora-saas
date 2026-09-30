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
                <p class="text-xs font-medium uppercase tracking-[0.2em] text-[#8B7CFF]">
                    Organization
                </p>

                <h1 class="mt-2 text-2xl font-semibold tracking-tight text-[#F5F5F2]">
                    Add Team Member
                </h1>

                <p class="mt-1 text-sm text-[#8B919A]">
                    Create a new account and assign access to your organization.
                </p>
            </div>
        </div>

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="rounded-2xl border border-red-400/20 bg-red-400/10 p-5">
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

        {{-- Form --}}
        <form
            method="POST"
            action="{{ route('team.store') }}"
            class="overflow-hidden rounded-2xl border border-[#242830] bg-[#12151A]"
        >
            @csrf

            {{-- Account Information --}}
            <div class="border-b border-[#242830] px-6 py-6">
                <div>
                    <h2 class="text-base font-semibold text-[#F5F5F2]">
                        Account Information
                    </h2>

                    <p class="mt-1 text-sm text-[#8B919A]">
                        Basic information for the new team member.
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
                            value="{{ old('name') }}"
                            required
                            autofocus
                            placeholder="e.g. Alex Morgan"
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
                            value="{{ old('email') }}"
                            required
                            placeholder="alex@example.com"
                            class="w-full rounded-xl border border-[#242830] bg-[#0B0D10] px-4 py-3 text-sm text-[#F5F5F2] outline-none transition placeholder:text-[#555B64] focus:border-[#8B7CFF] focus:ring-1 focus:ring-[#8B7CFF]"
                        >
                    </div>

                </div>
            </div>

            {{-- Security --}}
            <div class="border-b border-[#242830] px-6 py-6">
                <div>
                    <h2 class="text-base font-semibold text-[#F5F5F2]">
                        Security
                    </h2>

                    <p class="mt-1 text-sm text-[#8B919A]">
                        Set the initial password for this account.
                    </p>
                </div>

                <div class="mt-6 grid grid-cols-1 gap-5 md:grid-cols-2">

                    {{-- Password --}}
                    <div>
                        <label
                            for="password"
                            class="mb-2 block text-sm font-medium text-[#D6D8DC]"
                        >
                            Password
                        </label>

                        <input
                            id="password"
                            name="password"
                            type="password"
                            required
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
                            Confirm Password
                        </label>

                        <input
                            id="password_confirmation"
                            name="password_confirmation"
                            type="password"
                            required
                            placeholder="Repeat the password"
                            class="w-full rounded-xl border border-[#242830] bg-[#0B0D10] px-4 py-3 text-sm text-[#F5F5F2] outline-none transition placeholder:text-[#555B64] focus:border-[#8B7CFF] focus:ring-1 focus:ring-[#8B7CFF]"
                        >
                    </div>

                </div>
            </div>

            {{-- Role --}}
            <div class="px-6 py-6">
                <div>
                    <h2 class="text-base font-semibold text-[#F5F5F2]">
                        Access Role
                    </h2>

                    <p class="mt-1 text-sm text-[#8B919A]">
                        Choose what level of access this member should have.
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
                        <option value="" class="bg-[#0B0D10]">
                            Select a role
                        </option>

                        @foreach ($roles as $role)
                            <option
                                value="{{ $role->id }}"
                                class="bg-[#0B0D10]"
                                @selected(old('role_id') == $role->id)
                            >
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>

                    @if ($roles->isEmpty())
                        <p class="mt-2 text-xs text-amber-300">
                            No roles are available for this organization yet.
                        </p>
                    @endif

                </div>
            </div>

            {{-- Actions --}}
            <div class="flex items-center justify-end gap-3 border-t border-[#242830] bg-[#0E1116] px-6 py-5">

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
                            d="M12 4v16m8-8H4"
                        />
                    </svg>

                    Add Member
                </button>

            </div>

        </form>

    </div>
</x-app-layout>