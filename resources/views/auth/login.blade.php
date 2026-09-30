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


            {{-- Login Card --}}
            <div class="rounded-2xl border border-[#242830] bg-[#12151A] p-8 shadow-2xl">

                <div class="mb-8">
                    <h1 class="text-2xl font-semibold tracking-tight">
                        Welcome back
                    </h1>

                    <p class="mt-2 text-sm text-[#8B919A]">
                        Sign in to your NEXORA workspace.
                    </p>
                </div>


                {{-- Session Status --}}
                <x-auth-session-status
                    class="mb-5"
                    :status="session('status')"
                />


                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    {{-- Email --}}
                    <div>
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
                            autofocus
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
                            autocomplete="current-password"
                            placeholder="••••••••"
                        />

                        <x-input-error
                            :messages="$errors->get('password')"
                            class="mt-2"
                        />
                    </div>


                    {{-- Remember Me --}}
                    <div class="mt-5 flex items-center">

                        <label
                            for="remember_me"
                            class="inline-flex items-center cursor-pointer"
                        >
                            <input
                                id="remember_me"
                                type="checkbox"
                                class="rounded border-[#242830] bg-[#0B0D10] text-[#8B7CFF] shadow-sm focus:ring-[#8B7CFF]"
                                name="remember"
                            >

                            <span class="ms-2 text-sm text-[#8B919A]">
                                {{ __('Remember me') }}
                            </span>
                        </label>

                    </div>


                    {{-- Actions --}}
                    <div class="mt-7">

                        <x-primary-button
                            class="w-full justify-center rounded-xl border-0 bg-[#8B7CFF] py-3 text-sm font-medium text-white transition hover:bg-[#7B6CF0] focus:bg-[#7B6CF0] active:bg-[#6F60E0]"
                        >
                            {{ __('Log in') }}
                        </x-primary-button>

                    </div>


                    {{-- Forgot Password --}}
                    @if (Route::has('password.request'))

                        <div class="mt-5 text-center">

                            <a
                                class="text-sm text-[#8B919A] transition hover:text-[#F5F5F2]"
                                href="{{ route('password.request') }}"
                            >
                                {{ __('Forgot your password?') }}
                            </a>

                        </div>

                    @endif

                </form>

            </div>


            {{-- Register --}}
            @if (Route::has('register'))

                <p class="mt-6 text-center text-sm text-[#8B919A]">

                    Don't have an account?

                    <a
                        href="{{ route('register') }}"
                        class="ml-1 text-[#F5F5F2] transition hover:text-[#8B7CFF]"
                    >
                        Create one
                    </a>

                </p>

            @endif


            {{-- Footer --}}
            <p class="mt-10 text-center text-xs text-[#555B65]">
                © {{ date('Y') }} NEXORA. All rights reserved.
            </p>

        </div>

    </div>

</x-guest-layout>