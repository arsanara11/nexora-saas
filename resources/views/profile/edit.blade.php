<x-app-layout>

    <div class="space-y-6">

        {{-- Header --}}
        <div>
            <p class="text-[11px] font-semibold uppercase tracking-[0.2em] text-[#8B7CFF]">
                Account
            </p>

            <h1 class="mt-2 text-2xl font-semibold tracking-tight text-white">
                Profile
            </h1>

            <p class="mt-1 text-sm text-[#747B87]">
                Manage your personal information, password, and account settings.
            </p>
        </div>


        {{-- Success Message --}}
        @if (session('status') === 'profile-updated')
            <div class="rounded-xl border border-emerald-500/20 bg-emerald-500/10 px-5 py-4">
                <div class="flex items-center gap-3">
                    <span class="text-emerald-400">
                        ✓
                    </span>

                    <p class="text-sm text-emerald-300">
                        Profile updated successfully.
                    </p>
                </div>
            </div>
        @endif


        @if (session('status') === 'avatar-removed')
            <div class="rounded-xl border border-emerald-500/20 bg-emerald-500/10 px-5 py-4">
                <div class="flex items-center gap-3">
                    <span class="text-emerald-400">
                        ✓
                    </span>

                    <p class="text-sm text-emerald-300">
                        Avatar removed successfully.
                    </p>
                </div>
            </div>
        @endif


        {{-- Profile Information --}}
        <div class="rounded-2xl border border-[#202630] bg-[#0D1117]">

            <div class="border-b border-[#202630] px-6 py-5">

                <div class="flex items-center justify-between">

                    <div>
                        <h2 class="text-sm font-semibold text-white">
                            Profile Information
                        </h2>

                        <p class="mt-1 text-xs text-[#747B87]">
                            Update your personal account information.
                        </p>
                    </div>

                    <div
                        class="flex h-9 w-9 items-center justify-center rounded-lg border border-[#2A3040] bg-[#11161E] text-[#9C91FF]"
                    >
                        ◉
                    </div>

                </div>

            </div>


            <form
                method="POST"
                action="{{ route('profile.update') }}"
                enctype="multipart/form-data"
                class="px-6 py-6"
            >

                @csrf
                @method('PATCH')


                {{-- Avatar --}}
                <div class="mb-8">

                    <label
                        for="avatar"
                        class="mb-3 block text-xs font-medium text-[#AAB0BA]"
                    >
                        Profile Avatar
                    </label>


                    <div class="flex flex-col gap-5 sm:flex-row sm:items-center">

                        {{-- Avatar Preview --}}
                        <div
                            class="flex h-24 w-24 shrink-0 items-center justify-center overflow-hidden rounded-full border border-[#303746] bg-[#11161E]"
                        >

                            @if ($user->avatar)

                                <img
                                    src="{{ asset('storage/' . $user->avatar) }}"
                                    alt="{{ $user->name }}"
                                    class="h-full w-full object-cover"
                                >

                            @else

                                <span class="text-2xl font-semibold text-[#9C91FF]">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </span>

                            @endif

                        </div>


                        {{-- Upload --}}
                        <div class="min-w-0 flex-1">

                            <input
                                id="avatar"
                                name="avatar"
                                type="file"
                                accept=".jpg,.jpeg,.png,.webp"
                                class="block w-full cursor-pointer rounded-lg border border-[#29303B] bg-[#11161E] text-sm text-[#AAB0BA] file:mr-4 file:border-0 file:bg-[#5148A8] file:px-4 file:py-3 file:text-sm file:font-medium file:text-white hover:file:bg-[#6057BE]"
                            >

                            <p class="mt-3 text-[11px] leading-5 text-[#666D78]">
                                JPG, JPEG, PNG, or WEBP. Maximum file size 2 MB.
                            </p>

                            @error('avatar')
                                <p class="mt-2 text-xs text-red-400">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                    </div>


                    {{-- Remove Avatar --}}
                    @if ($user->avatar)

                        <div class="mt-4">

                            <button
                                type="button"
                                onclick="document.getElementById('remove-avatar-form').submit()"
                                class="text-xs font-medium text-red-400 transition hover:text-red-300"
                            >
                                Remove current avatar
                            </button>

                        </div>

                    @endif

                </div>


                {{-- Name --}}
                <div class="mb-6">

                    <label
                        for="name"
                        class="mb-2 block text-xs font-medium text-[#AAB0BA]"
                    >
                        Name
                    </label>

                    <input
                        id="name"
                        name="name"
                        type="text"
                        value="{{ old('name', $user->name) }}"
                        required
                        autocomplete="name"
                        class="w-full rounded-xl border border-[#29303B] bg-[#11161E] px-4 py-3 text-sm text-white outline-none transition placeholder:text-[#666D78] focus:border-[#5B50D6] focus:ring-1 focus:ring-[#5B50D6]"
                    >

                    @error('name')
                        <p class="mt-2 text-xs text-red-400">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Email --}}
                <div>

                    <label
                        for="email"
                        class="mb-2 block text-xs font-medium text-[#AAB0BA]"
                    >
                        Email
                    </label>

                    <input
                        id="email"
                        name="email"
                        type="email"
                        value="{{ old('email', $user->email) }}"
                        required
                        autocomplete="username"
                        class="w-full rounded-xl border border-[#29303B] bg-[#11161E] px-4 py-3 text-sm text-white outline-none transition placeholder:text-[#666D78] focus:border-[#5B50D6] focus:ring-1 focus:ring-[#5B50D6]"
                    >

                    @error('email')
                        <p class="mt-2 text-xs text-red-400">
                            {{ $message }}
                        </p>
                    @enderror


                    {{-- Email Verification --}}
                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())

                        <div class="mt-4 rounded-xl border border-amber-500/20 bg-amber-500/10 p-4">

                            <p class="text-xs leading-5 text-amber-300">
                                Your email address is not verified.
                            </p>

                            <form
                                method="POST"
                                action="{{ route('verification.send') }}"
                                class="mt-3"
                            >

                                @csrf

                                <button
                                    type="submit"
                                    class="text-xs font-medium text-[#C5BEFF] transition hover:text-white"
                                >
                                    Resend verification email
                                </button>

                            </form>

                        </div>

                    @endif

                </div>


                {{-- Save --}}
                <div class="mt-8 flex justify-end">

                    <button
                        type="submit"
                        class="rounded-xl bg-[#5148A8] px-6 py-3 text-sm font-medium text-white transition hover:bg-[#6057BE]"
                    >
                        Save Changes
                    </button>

                </div>

            </form>

        </div>


        {{-- Password --}}
        <div class="rounded-2xl border border-[#202630] bg-[#0D1117]">

            <div class="border-b border-[#202630] px-6 py-5">

                <div>
                    <h2 class="text-sm font-semibold text-white">
                        Update Password
                    </h2>

                    <p class="mt-1 text-xs text-[#747B87]">
                        Use a strong password to keep your account secure.
                    </p>
                </div>

            </div>


            <form
                method="POST"
                action="{{ route('password.update') }}"
                class="space-y-6 px-6 py-6"
            >

                @csrf
                @method('PUT')


                {{-- Current Password --}}
                <div>

                    <label
                        for="current_password"
                        class="mb-2 block text-xs font-medium text-[#AAB0BA]"
                    >
                        Current Password
                    </label>

                    <input
                        id="current_password"
                        name="current_password"
                        type="password"
                        autocomplete="current-password"
                        class="w-full rounded-xl border border-[#29303B] bg-[#11161E] px-4 py-3 text-sm text-white outline-none transition focus:border-[#5B50D6] focus:ring-1 focus:ring-[#5B50D6]"
                    >

                    @error('current_password', 'updatePassword')
                        <p class="mt-2 text-xs text-red-400">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- New Password --}}
                <div>

                    <label
                        for="password"
                        class="mb-2 block text-xs font-medium text-[#AAB0BA]"
                    >
                        New Password
                    </label>

                    <input
                        id="password"
                        name="password"
                        type="password"
                        autocomplete="new-password"
                        class="w-full rounded-xl border border-[#29303B] bg-[#11161E] px-4 py-3 text-sm text-white outline-none transition focus:border-[#5B50D6] focus:ring-1 focus:ring-[#5B50D6]"
                    >

                    @error('password', 'updatePassword')
                        <p class="mt-2 text-xs text-red-400">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Confirm Password --}}
                <div>

                    <label
                        for="password_confirmation"
                        class="mb-2 block text-xs font-medium text-[#AAB0BA]"
                    >
                        Confirm New Password
                    </label>

                    <input
                        id="password_confirmation"
                        name="password_confirmation"
                        type="password"
                        autocomplete="new-password"
                        class="w-full rounded-xl border border-[#29303B] bg-[#11161E] px-4 py-3 text-sm text-white outline-none transition focus:border-[#5B50D6] focus:ring-1 focus:ring-[#5B50D6]"
                    >

                    @error('password_confirmation', 'updatePassword')
                        <p class="mt-2 text-xs text-red-400">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Save --}}
                <div class="flex justify-end">

                    <button
                        type="submit"
                        class="rounded-xl border border-[#4037A5] bg-[#25204D] px-6 py-3 text-sm font-medium text-white transition hover:bg-[#302965]"
                    >
                        Update Password
                    </button>

                </div>

            </form>

        </div>


        {{-- Delete Account --}}
        <div class="rounded-2xl border border-red-500/20 bg-[#0D1117]">

            <div class="border-b border-red-500/10 px-6 py-5">

                <div>
                    <h2 class="text-sm font-semibold text-white">
                        Delete Account
                    </h2>

                    <p class="mt-1 text-xs text-[#747B87]">
                        Permanently delete your account and all associated access.
                    </p>
                </div>

            </div>


            <form
                method="POST"
                action="{{ route('profile.destroy') }}"
                class="px-6 py-6"
            >

                @csrf
                @method('DELETE')


                <div class="rounded-xl border border-red-500/10 bg-red-500/5 p-4">

                    <p class="text-sm leading-6 text-[#B7BCC5]">
                        Once your account is deleted, all of your account data and access
                        will be permanently removed. This action cannot be undone.
                    </p>

                </div>


                {{-- Password --}}
                <div class="mt-5">

                    <label
                        for="delete_password"
                        class="mb-2 block text-xs font-medium text-[#AAB0BA]"
                    >
                        Current Password
                    </label>

                    <input
                        id="delete_password"
                        name="password"
                        type="password"
                        autocomplete="current-password"
                        class="w-full rounded-xl border border-[#29303B] bg-[#11161E] px-4 py-3 text-sm text-white outline-none transition focus:border-red-500/50 focus:ring-1 focus:ring-red-500/20"
                    >

                    @error('password', 'userDeletion')
                        <p class="mt-2 text-xs text-red-400">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Delete --}}
                <div class="mt-5 flex justify-end">

                    <button
                        type="submit"
                        class="rounded-xl border border-red-500/30 bg-red-500/10 px-6 py-3 text-sm font-medium text-red-400 transition hover:bg-red-500/20 hover:text-red-300"
                    >
                        Delete Account
                    </button>

                </div>

            </form>

        </div>

    </div>


    {{-- Remove Avatar Form --}}
    @if ($user->avatar)

        <form
            id="remove-avatar-form"
            method="POST"
            action="{{ route('profile.avatar.remove') }}"
            class="hidden"
        >
            @csrf
            @method('DELETE')
        </form>

    @endif

</x-app-layout>