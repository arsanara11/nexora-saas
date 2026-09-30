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
                            Configuration
                        </p>

                    </div>


                    <h1 class="mt-3 text-3xl font-semibold tracking-[-0.03em] text-white">
                        Company Settings
                    </h1>


                    <p class="mt-2 max-w-xl text-sm leading-6 text-[#8B919A]">
                        Manage your company profile and business preferences.
                    </p>

                </div>


                <div
                    class="hidden rounded-full border border-white/[0.06] bg-white/[0.02] px-3 py-2 text-[10px] font-medium uppercase tracking-[0.16em] text-[#707782] sm:block"
                >
                    Configuration workspace
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
                VALIDATION ERRORS
            ========================================================= --}}

            @if ($errors->any())

                <div
                    class="relative mt-6 overflow-hidden rounded-2xl border border-red-500/15 bg-red-500/[0.05] px-5 py-4 shadow-[0_16px_45px_rgba(0,0,0,0.14)]"
                >

                    <div class="absolute inset-y-0 left-0 w-1 bg-red-400/70"></div>

                    <div class="flex gap-3">

                        <span
                            class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-red-400/10 text-red-300"
                        >
                            !
                        </span>


                        <div>

                            <p class="text-sm font-medium text-red-300">
                                Please fix the following errors:
                            </p>


                            <ul class="mt-2 space-y-1 text-sm text-red-400/90">

                                @foreach ($errors->all() as $error)

                                    <li>
                                        {{ $error }}
                                    </li>

                                @endforeach

                            </ul>

                        </div>

                    </div>

                </div>

            @endif


            {{-- ========================================================
                COMPANY SETTINGS FORM
            ========================================================= --}}

            <form
                method="POST"
                action="{{ route('settings.update') }}"
                enctype="multipart/form-data"
                class="mt-6"
            >

                @csrf
                @method('PUT')


                {{-- ====================================================
                    COMPANY INFORMATION
                ===================================================== --}}

                <div
                    class="relative overflow-hidden rounded-[30px] border border-white/[0.055] bg-[#11151A]/95 shadow-[0_30px_80px_rgba(0,0,0,0.22)] backdrop-blur-xl"
                >

                    {{-- Section Header --}}
                    <div
                        class="relative flex flex-col gap-2 border-b border-white/[0.045] px-6 py-5 sm:px-7"
                    >

                        <div class="flex items-center gap-2">

                            <span class="h-1.5 w-1.5 rounded-full bg-[#8B7CFF]"></span>

                            <p class="text-[10px] font-semibold uppercase tracking-[0.18em] text-[#707782]">
                                Company profile
                            </p>

                        </div>


                        <h2 class="text-base font-semibold text-white">
                            Company Information
                        </h2>


                        <p class="text-xs text-[#666D78]">
                            Basic information about your business.
                        </p>

                    </div>


                    <div class="px-6 py-6 sm:px-7 lg:px-8">

                        <div class="grid gap-6 md:grid-cols-2">


                            {{-- =================================================
                                COMPANY LOGO
                            ================================================== --}}

                            <div class="md:col-span-2">

                                <label
                                    for="logo"
                                    class="mb-2 block text-[10px] font-semibold uppercase tracking-[0.15em] text-[#707782]"
                                >
                                    Company Logo
                                </label>


                                <div
                                    class="relative overflow-hidden rounded-[24px] border border-white/[0.05] bg-[#171B22] p-5"
                                >

                                    <div
                                        class="pointer-events-none absolute -right-16 -top-20 h-40 w-40 rounded-full bg-[#8B7CFF]/[0.05] blur-3xl"
                                    ></div>


                                    <div
                                        class="relative flex flex-col gap-5 sm:flex-row sm:items-center"
                                    >

                                        {{-- Current Logo --}}
                                        <div
                                            class="flex h-28 w-28 shrink-0 items-center justify-center overflow-hidden rounded-[22px] border border-white/[0.06] bg-[#090C11] shadow-[0_16px_35px_rgba(0,0,0,0.18)]"
                                        >

                                            @if ($company->logo)

                                                <img
                                                    src="{{ asset('storage/' . $company->logo) }}"
                                                    alt="{{ $company->name }}"
                                                    class="h-full w-full object-contain p-3"
                                                >

                                            @else

                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    class="h-9 w-9 text-[#555D69]"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke="currentColor"
                                                    stroke-width="1.5"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M3 21h18M5 21V5l7-3 7 3v16M9 9h1m4 0h1m-6 4h1m4 0h1m-6 4h1m4 0h1"
                                                    />
                                                </svg>

                                            @endif

                                        </div>


                                        {{-- Upload --}}
                                        <div class="min-w-0 flex-1">

                                            <p class="text-sm font-medium text-white">
                                                Brand identity
                                            </p>

                                            <p class="mt-1 text-xs leading-5 text-[#707782]">
                                                Upload the logo used across your NEXORA workspace.
                                            </p>


                                            <div class="mt-4">

                                                <input
                                                    id="logo"
                                                    name="logo"
                                                    type="file"
                                                    accept=".jpg,.jpeg,.png,.webp"
                                                    class="block w-full cursor-pointer rounded-xl border border-white/[0.06] bg-[#0D1117] text-xs text-[#AAB0BA] file:mr-4 file:border-0 file:bg-[#5148A8] file:px-4 file:py-3 file:text-xs file:font-medium file:text-white hover:file:bg-[#6057BE]"
                                                >

                                            </div>


                                            <p class="mt-2 text-[11px] text-[#626975]">
                                                JPG, JPEG, PNG, or WEBP. Maximum file size 2 MB.
                                            </p>

                                        </div>

                                    </div>

                                </div>

                            </div>


                            {{-- =================================================
                                COMPANY NAME
                            ================================================== --}}

                            <div class="md:col-span-2">

                                <label
                                    for="name"
                                    class="mb-2 block text-[10px] font-semibold uppercase tracking-[0.15em] text-[#707782]"
                                >
                                    Company Name
                                </label>

                                <input
                                    id="name"
                                    name="name"
                                    type="text"
                                    value="{{ old('name', $company->name) }}"
                                    required
                                    class="w-full rounded-xl border border-white/[0.06] bg-[#0B0D10] px-4 py-3 text-sm text-white outline-none transition placeholder:text-[#505762] focus:border-[#8B7CFF]/50 focus:ring-1 focus:ring-[#8B7CFF]/15"
                                    placeholder="Your company name"
                                >

                            </div>


                            {{-- =================================================
                                SLUG
                            ================================================== --}}

                            <div>

                                <label
                                    for="slug"
                                    class="mb-2 block text-[10px] font-semibold uppercase tracking-[0.15em] text-[#707782]"
                                >
                                    Company Slug
                                </label>

                                <input
                                    id="slug"
                                    name="slug"
                                    type="text"
                                    value="{{ old('slug', $company->slug) }}"
                                    required
                                    class="w-full rounded-xl border border-white/[0.06] bg-[#0B0D10] px-4 py-3 text-sm text-white outline-none transition placeholder:text-[#505762] focus:border-[#8B7CFF]/50 focus:ring-1 focus:ring-[#8B7CFF]/15"
                                    placeholder="company-slug"
                                >

                                <p class="mt-2 text-[11px] leading-5 text-[#626975]">
                                    Used as your company's unique identifier.
                                </p>

                            </div>


                            {{-- =================================================
                                EMAIL
                            ================================================== --}}

                            <div>

                                <label
                                    for="email"
                                    class="mb-2 block text-[10px] font-semibold uppercase tracking-[0.15em] text-[#707782]"
                                >
                                    Email
                                </label>

                                <input
                                    id="email"
                                    name="email"
                                    type="email"
                                    value="{{ old('email', $company->email) }}"
                                    class="w-full rounded-xl border border-white/[0.06] bg-[#0B0D10] px-4 py-3 text-sm text-white outline-none transition placeholder:text-[#505762] focus:border-[#8B7CFF]/50 focus:ring-1 focus:ring-[#8B7CFF]/15"
                                    placeholder="company@example.com"
                                >

                            </div>


                            {{-- =================================================
                                PHONE
                            ================================================== --}}

                            <div>

                                <label
                                    for="phone"
                                    class="mb-2 block text-[10px] font-semibold uppercase tracking-[0.15em] text-[#707782]"
                                >
                                    Phone
                                </label>

                                <input
                                    id="phone"
                                    name="phone"
                                    type="text"
                                    value="{{ old('phone', $company->phone) }}"
                                    class="w-full rounded-xl border border-white/[0.06] bg-[#0B0D10] px-4 py-3 text-sm text-white outline-none transition placeholder:text-[#505762] focus:border-[#8B7CFF]/50 focus:ring-1 focus:ring-[#8B7CFF]/15"
                                    placeholder="+62 812 3456 7890"
                                >

                            </div>


                            {{-- =================================================
                                TIMEZONE
                            ================================================== --}}

                            <div>

                                <label
                                    for="timezone"
                                    class="mb-2 block text-[10px] font-semibold uppercase tracking-[0.15em] text-[#707782]"
                                >
                                    Timezone
                                </label>

                                <select
                                    id="timezone"
                                    name="timezone"
                                    required
                                    class="w-full rounded-xl border border-white/[0.06] bg-[#0B0D10] px-4 py-3 text-sm text-white outline-none transition focus:border-[#8B7CFF]/50 focus:ring-1 focus:ring-[#8B7CFF]/15"
                                >

                                    @php

                                        $timezones = [
                                            'Asia/Jakarta' => 'Asia/Jakarta (WIB)',
                                            'Asia/Makassar' => 'Asia/Makassar (WITA)',
                                            'Asia/Jayapura' => 'Asia/Jayapura (WIT)',
                                            'Asia/Singapore' => 'Asia/Singapore',
                                            'Asia/Kuala_Lumpur' => 'Asia/Kuala Lumpur',
                                            'Asia/Tokyo' => 'Asia/Tokyo',
                                            'Australia/Sydney' => 'Australia/Sydney',
                                            'Europe/London' => 'Europe/London',
                                            'America/New_York' => 'America/New York',
                                            'America/Los_Angeles' => 'America/Los Angeles',
                                            'UTC' => 'UTC',
                                        ];

                                    @endphp


                                    @foreach ($timezones as $value => $label)

                                        <option
                                            value="{{ $value }}"
                                            @selected(old('timezone', $company->timezone) === $value)
                                        >
                                            {{ $label }}
                                        </option>

                                    @endforeach

                                </select>

                            </div>


                            {{-- =================================================
                                CURRENCY
                            ================================================== --}}

                            <div>

                                <label
                                    for="currency"
                                    class="mb-2 block text-[10px] font-semibold uppercase tracking-[0.15em] text-[#707782]"
                                >
                                    Currency
                                </label>

                                <select
                                    id="currency"
                                    name="currency"
                                    required
                                    class="w-full rounded-xl border border-white/[0.06] bg-[#0B0D10] px-4 py-3 text-sm text-white outline-none transition focus:border-[#8B7CFF]/50 focus:ring-1 focus:ring-[#8B7CFF]/15"
                                >

                                    @php

                                        $currencies = [
                                            'IDR' => 'IDR — Indonesian Rupiah',
                                            'USD' => 'USD — US Dollar',
                                            'SGD' => 'SGD — Singapore Dollar',
                                            'MYR' => 'MYR — Malaysian Ringgit',
                                            'JPY' => 'JPY — Japanese Yen',
                                            'AUD' => 'AUD — Australian Dollar',
                                            'EUR' => 'EUR — Euro',
                                            'GBP' => 'GBP — Pound Sterling',
                                        ];

                                    @endphp


                                    @foreach ($currencies as $value => $label)

                                        <option
                                            value="{{ $value }}"
                                            @selected(old('currency', $company->currency) === $value)
                                        >
                                            {{ $label }}
                                        </option>

                                    @endforeach

                                </select>

                            </div>


                            {{-- =================================================
                                ADDRESS
                            ================================================== --}}

                            <div class="md:col-span-2">

                                <label
                                    for="address"
                                    class="mb-2 block text-[10px] font-semibold uppercase tracking-[0.15em] text-[#707782]"
                                >
                                    Address
                                </label>

                                <textarea
                                    id="address"
                                    name="address"
                                    rows="4"
                                    class="w-full resize-none rounded-xl border border-white/[0.06] bg-[#0B0D10] px-4 py-3 text-sm leading-6 text-white outline-none transition placeholder:text-[#505762] focus:border-[#8B7CFF]/50 focus:ring-1 focus:ring-[#8B7CFF]/15"
                                    placeholder="Company address"
                                >{{ old('address', $company->address) }}</textarea>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- ========================================================
                    CURRENT CONFIGURATION
                ========================================================= --}}

                <div
                    class="relative mt-6 overflow-hidden rounded-[30px] border border-white/[0.055] bg-[#11151A]/95 shadow-[0_25px_70px_rgba(0,0,0,0.18)] backdrop-blur-xl"
                >

                    <div
                        class="relative border-b border-white/[0.045] px-6 py-5 sm:px-7"
                    >

                        <div class="flex items-center gap-2">

                            <span class="h-1.5 w-1.5 rounded-full bg-[#6F8CFF]"></span>

                            <p class="text-[10px] font-semibold uppercase tracking-[0.18em] text-[#707782]">
                                Workspace overview
                            </p>

                        </div>


                        <h2 class="mt-2 text-base font-semibold text-white">
                            Current Configuration
                        </h2>


                        <p class="mt-1 text-xs text-[#666D78]">
                            Active settings for this company.
                        </p>

                    </div>


                    <div class="grid gap-4 px-6 py-6 sm:px-7 md:grid-cols-3">


                        {{-- Company --}}
                        <div
                            class="group relative overflow-hidden rounded-[22px] border border-white/[0.05] bg-[#171B22] p-4 transition duration-200 hover:border-white/[0.09]"
                        >

                            <div
                                class="absolute -right-8 -top-8 h-20 w-20 rounded-full bg-[#8B7CFF]/[0.05] blur-2xl"
                            ></div>


                            <div class="relative">

                                <p class="text-[10px] font-semibold uppercase tracking-[0.16em] text-[#666D78]">
                                    Company
                                </p>

                                <p class="mt-2 truncate text-sm font-medium text-white">
                                    {{ $company->name }}
                                </p>

                            </div>

                        </div>


                        {{-- Currency --}}
                        <div
                            class="group relative overflow-hidden rounded-[22px] border border-white/[0.05] bg-[#171B22] p-4 transition duration-200 hover:border-white/[0.09]"
                        >

                            <div
                                class="absolute -right-8 -top-8 h-20 w-20 rounded-full bg-[#6F8CFF]/[0.05] blur-2xl"
                            ></div>


                            <div class="relative">

                                <p class="text-[10px] font-semibold uppercase tracking-[0.16em] text-[#666D78]">
                                    Currency
                                </p>

                                <p class="mt-2 text-sm font-medium text-white">
                                    {{ $company->currency }}
                                </p>

                            </div>

                        </div>


                        {{-- Timezone --}}
                        <div
                            class="group relative overflow-hidden rounded-[22px] border border-white/[0.05] bg-[#171B22] p-4 transition duration-200 hover:border-white/[0.09]"
                        >

                            <div
                                class="absolute -right-8 -top-8 h-20 w-20 rounded-full bg-[#63D889]/[0.04] blur-2xl"
                            ></div>


                            <div class="relative">

                                <p class="text-[10px] font-semibold uppercase tracking-[0.16em] text-[#666D78]">
                                    Timezone
                                </p>

                                <p class="mt-2 truncate text-sm font-medium text-white">
                                    {{ $company->timezone }}
                                </p>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- ========================================================
                    ACTIONS
                ========================================================= --}}

                <div
                    class="mt-6 flex flex-col-reverse gap-3 border-t border-white/[0.045] pt-6 sm:flex-row sm:items-center sm:justify-end"
                >

                    <a
                        href="{{ route('dashboard') }}"
                        class="inline-flex items-center justify-center rounded-2xl border border-white/[0.06] bg-white/[0.018] px-5 py-3 text-sm font-medium text-[#A7ADB7] transition duration-200 hover:border-white/[0.10] hover:bg-white/[0.035] hover:text-white"
                    >
                        Cancel
                    </a>


                    <button
                        type="submit"
                        class="group inline-flex items-center justify-center gap-2 rounded-2xl bg-[#8B7CFF] px-5 py-3 text-sm font-medium text-white shadow-[0_10px_30px_rgba(139,124,255,0.18)] transition duration-200 hover:-translate-y-0.5 hover:bg-[#7C6EF0] hover:shadow-[0_14px_34px_rgba(139,124,255,0.24)]"
                    >

                        Save Changes

                        <span class="transition-transform duration-200 group-hover:translate-x-0.5">
                            →
                        </span>

                    </button>

                </div>

            </form>

        </div>

    </div>

</x-app-layout>