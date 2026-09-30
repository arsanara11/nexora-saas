<x-guest-layout>

    <div class="min-h-screen bg-[#0B0D10] text-[#F5F5F2] flex items-center justify-center px-6 py-12">

        <div class="w-full max-w-md">

            {{-- Brand --}}
            <div class="text-center mb-10">
                <div class="text-2xl font-semibold tracking-[0.35em]">
                    NEXORA
                </div>

                <p class="mt-3 text-sm text-[#8B919A]">
                    The Operating System for Modern Business.
                </p>
            </div>


            {{-- Register Card --}}
            <div class="rounded-2xl border border-[#242830] bg-[#12151A] p-8 shadow-2xl">

                <div class="mb-8">
                    <h1 class="text-2xl font-semibold tracking-tight">
                        Create your account
                    </h1>

                    <p class="mt-2 text-sm text-[#8B919A]">
                        Start managing your business with NEXORA.
                    </p>
                </div>


                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    {{-- Name --}}
                    <div>
                        <x-input-label
                            for="name"
                            :value="__('Name')"
                            class="!text-[#8B919A]"
                        />

                        <x-text-input
                            id="name"
                            class="mt-2 block w-full rounded-xl border-[#242830] bg-[#0B0D10] text-[#F5F5F2] placeholder-[#555B65] focus:border-[#8B7CFF] focus:ring-[#8B7CFF]"
                            type="text"
                            name="name"
                            :value="old('name')"
                            required
                            autofocus
                            autocomplete="name"
                            placeholder="Your name"
                        />

                        <x-input-error
                            :messages="$errors->get('name')"
                            class="mt-2"
                        />
                    </div>


                    {{-- Email --}}
                    <div class="mt-5">
                        <x-input-label
                            for="email"
                            :value="__('Email')"
                            class="!text-[#8B919A]"
                        />

                        <x-text-input
                            id="email"
                            class="mt-2 block w-full rounded-xl border-[#242830] bg-[#0B0D10] text-[#F5F5F2] placeholder-[#555B65] focus:border-[#8B7CFF] focus:ring-[#8B7CFF]"
                            type="email"
                            name="email"
                            :value="old('email')"
                            required
                            autocomplete="username"
                            placeholder="you@company.com"
                        />

                        <x-input-error
                            :messages="$errors->get('email')"
                            class="mt-2"
                        />
                    </div>


                    {{-- Password --}}
                    <div class="mt-5">
                        <x-input-label
                            for="password"
                            :value="__('Password')"
                            class="!text-[#8B919A]"
                        />

                        <x-text-input
                            id="password"
                            class="mt-2 block w-full rounded-xl border-[#242830] bg-[#0B0D10] text-[#F5F5F2] placeholder-[#555B65] focus:border-[#8B7CFF] focus:ring-[#8B7CFF]"
                            type="password"
                            name="password"
                            required
                            autocomplete="new-password"
                            placeholder="Create a password"
                        />

                        <x-input-error
                            :messages="$errors->get('password')"
                            class="mt-2"
                        />
                    </div>


                    {{-- Confirm Password --}}
                    <div class="mt-5">
                        <x-input-label
                            for="password_confirmation"
                            :value="__('Confirm Password')"
                            class="!text-[#8B919A]"
                        />

                        <x-text-input
                            id="password_confirmation"
                            class="mt-2 block w-full rounded-xl border-[#242830] bg-[#0B0D10] text-[#F5F5F2] placeholder-[#555B65] focus:border-[#8B7CFF] focus:ring-[#8B7CFF]"
                            type="password"
                            name="password_confirmation"
                            required
                            autocomplete="new-password"
                            placeholder="Confirm your password"
                        />

                        <x-input-error
                            :messages="$errors->get('password_confirmation')"
                            class="mt-2"
                        />
                    </div>


                    {{-- Actions --}}
                    <div class="mt-7">

                        <x-primary-button
                            class="w-full justify-center rounded-xl border-0 bg-[#8B7CFF] py-3 text-sm font-medium text-white transition hover:bg-[#7B6CF0] focus:bg-[#7B6CF0] active:bg-[#6F60E0]"
                        >
                            {{ __('Create account') }}
                        </x-primary-button>

                    </div>

                </form>

            </div>


            {{-- Login --}}
            <p class="mt-6 text-center text-sm text-[#8B919A]">

                Already have an account?

                <a
                    href="{{ route('login') }}"
                    class="ml-1 text-[#F5F5F2] transition hover:text-[#8B7CFF]"
                >
                    Sign in
                </a>

            </p>


            {{-- Footer --}}
            <p class="mt-10 text-center text-xs text-[#555B65]">
                © {{ date('Y') }} NEXORA. All rights reserved.
            </p>

        </div>

    </div>

</x-guest-layout>