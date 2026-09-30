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
                PAGE HEADER
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
                            Customers
                        </p>

                    </div>


                    <h1
                        class="mt-3 text-3xl font-semibold tracking-[-0.03em] text-white"
                    >
                        Customer Management
                    </h1>


                    <p
                        class="mt-2 max-w-xl text-sm leading-6 text-[#8B919A]"
                    >
                        Manage your customer database and relationships.
                    </p>

                </div>


                <div class="flex items-center gap-3">

                    <div
                        class="hidden rounded-full border border-white/[0.06] bg-white/[0.02] px-3 py-2 text-[10px] font-medium uppercase tracking-[0.16em] text-[#707782] sm:block"
                    >
                        Customer workspace
                    </div>


                    <a
                        href="{{ route('customers.create') }}"
                        class="group inline-flex items-center gap-2 rounded-2xl bg-[#8B7CFF] px-5 py-3 text-sm font-medium text-white shadow-[0_10px_30px_rgba(139,124,255,0.18)] transition duration-200 hover:-translate-y-0.5 hover:bg-[#7C6EF0] hover:shadow-[0_14px_34px_rgba(139,124,255,0.24)]"
                    >

                        <span
                            class="text-base leading-none transition-transform duration-200 group-hover:rotate-90"
                        >
                            +
                        </span>

                        Add Customer

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

                    <div
                        class="absolute inset-y-0 left-0 w-1 bg-[#63D889]/70"
                    ></div>


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
                STATS
            ========================================================= --}}

            <div class="relative mt-6 grid gap-4 md:grid-cols-3">


                {{-- ====================================================
                    TOTAL CUSTOMERS
                ===================================================== --}}

                <div
                    class="group relative overflow-hidden rounded-[26px] border border-white/[0.055] bg-[#12151A]/90 p-5 shadow-[0_18px_55px_rgba(0,0,0,0.16)] backdrop-blur-sm transition duration-300 hover:-translate-y-0.5 hover:border-[#8B7CFF]/20"
                >

                    <div
                        class="absolute right-[-30px] top-[-35px] h-28 w-28 rounded-full bg-[#8B7CFF]/[0.08] blur-2xl transition duration-300 group-hover:bg-[#8B7CFF]/[0.12]"
                    ></div>


                    <div class="relative flex items-start justify-between gap-4">

                        <div>

                            <p
                                class="text-[10px] font-semibold uppercase tracking-[0.18em] text-[#707782]"
                            >
                                Total Customers
                            </p>


                            <p
                                class="mt-3 text-3xl font-semibold tracking-tight text-white"
                            >
                                {{ number_format($customers->count()) }}
                            </p>


                            <p
                                class="mt-2 text-xs text-[#666D78]"
                            >
                                Customer accounts in this workspace.
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
                                    d="M22 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"
                                />

                            </svg>

                        </div>

                    </div>

                </div>


                {{-- ====================================================
                    ACTIVE CUSTOMERS
                ===================================================== --}}

                <div
                    class="group relative overflow-hidden rounded-[26px] border border-white/[0.055] bg-[#12151A]/90 p-5 shadow-[0_18px_55px_rgba(0,0,0,0.16)] backdrop-blur-sm transition duration-300 hover:-translate-y-0.5 hover:border-[#63D889]/20"
                >

                    <div
                        class="absolute right-[-30px] top-[-35px] h-28 w-28 rounded-full bg-[#63D889]/[0.06] blur-2xl transition duration-300 group-hover:bg-[#63D889]/[0.10]"
                    ></div>


                    <div class="relative flex items-start justify-between gap-4">

                        <div>

                            <p
                                class="text-[10px] font-semibold uppercase tracking-[0.18em] text-[#707782]"
                            >
                                Active Customers
                            </p>


                            <p
                                class="mt-3 text-3xl font-semibold tracking-tight text-white"
                            >
                                {{ number_format($customers->where('is_active', true)->count()) }}
                            </p>


                            <p
                                class="mt-2 text-xs text-[#666D78]"
                            >
                                Accounts currently marked active.
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

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M5 13l4 4L19 7"
                                />

                            </svg>

                        </div>

                    </div>

                </div>


                {{-- ====================================================
                    CUSTOMERS WITH ORDERS
                ===================================================== --}}

                <div
                    class="group relative overflow-hidden rounded-[26px] border border-white/[0.055] bg-[#12151A]/90 p-5 shadow-[0_18px_55px_rgba(0,0,0,0.16)] backdrop-blur-sm transition duration-300 hover:-translate-y-0.5 hover:border-[#6F8CFF]/20"
                >

                    <div
                        class="absolute right-[-30px] top-[-35px] h-28 w-28 rounded-full bg-[#6F8CFF]/[0.06] blur-2xl transition duration-300 group-hover:bg-[#6F8CFF]/[0.10]"
                    ></div>


                    <div class="relative flex items-start justify-between gap-4">

                        <div>

                            <p
                                class="text-[10px] font-semibold uppercase tracking-[0.18em] text-[#707782]"
                            >
                                With Orders
                            </p>


                            <p
                                class="mt-3 text-3xl font-semibold tracking-tight text-white"
                            >
                                {{ number_format($customers->where('orders_count', '>', 0)->count()) }}
                            </p>


                            <p
                                class="mt-2 text-xs text-[#666D78]"
                            >
                                Customers with recorded sales activity.
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
                                    d="M3 6h18M3 12h18M3 18h18"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M7 3v18"
                                />

                            </svg>

                        </div>

                    </div>

                </div>

            </div>


            {{-- ========================================================
                CUSTOMER DIRECTORY
            ========================================================= --}}

            <div
                class="relative mt-6 overflow-hidden rounded-[30px] border border-white/[0.055] bg-[#11151A]/95 shadow-[0_30px_80px_rgba(0,0,0,0.22)] backdrop-blur-xl"
            >


                {{-- ====================================================
                    DIRECTORY HEADER
                ===================================================== --}}

                <div
                    class="relative flex flex-col gap-4 border-b border-white/[0.045] px-6 py-5 sm:flex-row sm:items-center sm:justify-between sm:px-7"
                >

                    <div>

                        <p
                            class="text-[10px] font-semibold uppercase tracking-[0.18em] text-[#707782]"
                        >
                            Customer Directory
                        </p>


                        <h2
                            class="mt-2 text-xl font-semibold tracking-tight text-white"
                        >
                            All Customers
                        </h2>


                        <p
                            class="mt-1 text-sm text-[#666D78]"
                        >
                            {{ $customers->count() }}
                            {{ Str::plural('customer', $customers->count()) }}
                            recorded in this workspace.
                        </p>

                    </div>


                    <div
                        class="rounded-xl border border-white/[0.05] bg-white/[0.018] px-4 py-2.5 text-[10px] font-medium uppercase tracking-[0.16em] text-[#707782]"
                    >
                        Live Directory
                    </div>

                </div>


                @if ($customers->count())


                    {{-- =================================================
                        CUSTOMER LIST
                    ================================================== --}}

                    <div class="px-4 py-4 sm:px-6">


                        {{-- =================================================
                            COLUMN HEADERS
                        ================================================== --}}

                        <div
                            class="grid grid-cols-[minmax(0,1.4fr)_minmax(0,1.05fr)_minmax(0,1.1fr)_minmax(70px,0.65fr)_minmax(90px,0.85fr)_minmax(65px,0.55fr)] items-center gap-x-3 border-b border-white/[0.045] px-4 pb-4"
                        >

                            <div
                                class="text-[10px] font-semibold uppercase tracking-[0.18em] text-[#707782]"
                            >
                                Customer
                            </div>


                            <div
                                class="text-[10px] font-semibold uppercase tracking-[0.18em] text-[#707782]"
                            >
                                Contact
                            </div>


                            <div
                                class="text-[10px] font-semibold uppercase tracking-[0.18em] text-[#707782]"
                            >
                                Location
                            </div>


                            <div
                                class="text-[10px] font-semibold uppercase tracking-[0.18em] text-[#707782]"
                            >
                                Orders
                            </div>


                            <div
                                class="text-[10px] font-semibold uppercase tracking-[0.18em] text-[#707782]"
                            >
                                Status
                            </div>


                            <div
                                class="text-right text-[10px] font-semibold uppercase tracking-[0.18em] text-[#707782]"
                            >
                                Action
                            </div>

                        </div>


                        {{-- =================================================
                            CUSTOMER CARDS
                        ================================================== --}}

                        <div class="mt-3 space-y-3">

                            @foreach ($customers as $customer)


                                <div
                                    class="group relative overflow-hidden rounded-[22px] border border-white/[0.055] bg-[#171B22] px-4 py-4 transition duration-300 hover:border-[#8B7CFF]/20 hover:bg-[#191D25]"
                                >

                                    <div
                                        class="pointer-events-none absolute left-[-80px] top-[-100px] h-48 w-48 rounded-full bg-[#8B7CFF]/[0.035] blur-[70px] opacity-0 transition duration-300 group-hover:opacity-100"
                                    ></div>


                                    <div
                                        class="relative grid grid-cols-[minmax(0,1.4fr)_minmax(0,1.05fr)_minmax(0,1.1fr)_minmax(70px,0.65fr)_minmax(90px,0.85fr)_minmax(65px,0.55fr)] items-center gap-x-3"
                                    >


                                        {{-- =============================================
                                            CUSTOMER
                                        ============================================== --}}

                                        <div
                                            class="flex min-w-0 items-center gap-3"
                                        >

                                            <div
                                                class="relative flex h-11 w-11 shrink-0 items-center justify-center overflow-hidden rounded-[16px] border border-[#8B7CFF]/10 bg-[#0D1117] text-sm font-semibold text-[#A99FFF] transition duration-300 group-hover:border-[#8B7CFF]/25 group-hover:bg-[#8B7CFF]/[0.07]"
                                            >

                                                <span class="relative z-10">
                                                    {{ strtoupper(substr($customer->name, 0, 1)) }}
                                                </span>


                                                <span
                                                    class="absolute inset-0 bg-[radial-gradient(circle_at_30%_20%,rgba(139,124,255,0.14),transparent_55%)]"
                                                ></span>

                                            </div>


                                            <div class="min-w-0">

                                                <a
                                                    href="{{ route('customers.show', $customer) }}"
                                                    class="block truncate text-sm font-semibold text-[#F5F5F2] transition duration-200 hover:text-[#A99FFF]"
                                                >
                                                    {{ $customer->name }}
                                                </a>


                                                @if ($customer->email)

                                                    <p
                                                        class="mt-1 truncate text-xs text-[#6F7681]"
                                                    >
                                                        {{ $customer->email }}
                                                    </p>

                                                @else

                                                    <p
                                                        class="mt-1 text-xs text-[#505761]"
                                                    >
                                                        No email provided
                                                    </p>

                                                @endif

                                            </div>

                                        </div>


                                        {{-- =============================================
                                            CONTACT
                                        ============================================== --}}

                                        <div class="min-w-0">

                                            @if ($customer->phone)

                                                <p
                                                    class="truncate text-sm text-[#C5CAD2]"
                                                >
                                                    {{ $customer->phone }}
                                                </p>

                                            @else

                                                <span
                                                    class="text-sm text-[#505761]"
                                                >
                                                    —
                                                </span>

                                            @endif

                                        </div>


                                        {{-- =============================================
                                            LOCATION
                                        ============================================== --}}

                                        <div class="min-w-0">

                                            @if ($customer->city)

                                                <div
                                                    class="flex min-w-0 items-center gap-2"
                                                >

                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        class="h-4 w-4 shrink-0 text-[#565D67]"
                                                        fill="none"
                                                        viewBox="0 0 24 24"
                                                        stroke="currentColor"
                                                        stroke-width="1.8"
                                                    >

                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            d="M12 21s7-5.3 7-12a7 7 0 10-14 0c0 6.7 7 12 7 12z"
                                                        />

                                                        <circle
                                                            cx="12"
                                                            cy="9"
                                                            r="2.3"
                                                        />

                                                    </svg>


                                                    <p
                                                        class="truncate text-sm text-[#C5CAD2]"
                                                    >
                                                        {{ $customer->city }}
                                                    </p>

                                                </div>

                                            @else

                                                <span
                                                    class="text-sm text-[#505761]"
                                                >
                                                    —
                                                </span>

                                            @endif

                                        </div>


                                        {{-- =============================================
                                            ORDERS
                                        ============================================== --}}

                                        <div class="min-w-0">

                                            <span
                                                class="inline-flex min-w-[34px] items-center justify-center rounded-lg border border-white/[0.05] bg-white/[0.018] px-2.5 py-1 text-xs font-medium text-[#C5CAD2]"
                                            >
                                                {{ $customer->orders_count }}
                                            </span>

                                        </div>


                                        {{-- =============================================
                                            STATUS
                                        ============================================== --}}

                                        <div class="min-w-0">

                                            @if ($customer->is_active)

                                                <span
                                                    class="inline-flex max-w-full items-center rounded-full border border-[#294333] bg-[#122019] px-3 py-1.5 text-[10px] font-medium text-[#9FE2B5]"
                                                >

                                                    <span
                                                        class="mr-2 h-1.5 w-1.5 shrink-0 rounded-full bg-[#63D889] shadow-[0_0_8px_rgba(99,216,137,0.75)]"
                                                    ></span>

                                                    <span class="truncate">
                                                        Active
                                                    </span>

                                                </span>

                                            @else

                                                <span
                                                    class="inline-flex max-w-full items-center rounded-full border border-[#3A3E45] bg-[#1A1D22] px-3 py-1.5 text-[10px] font-medium text-[#8B919A]"
                                                >

                                                    <span
                                                        class="mr-2 h-1.5 w-1.5 shrink-0 rounded-full bg-[#686F79]"
                                                    ></span>

                                                    <span class="truncate">
                                                        Inactive
                                                    </span>

                                                </span>

                                            @endif

                                        </div>


                                        {{-- =============================================
                                            ACTION
                                        ============================================== --}}

                                        <div
                                            class="flex justify-end"
                                        >

                                            <a
                                                href="{{ route('customers.show', $customer) }}"
                                                class="inline-flex items-center gap-1.5 rounded-xl border border-white/[0.06] bg-white/[0.018] px-3 py-2 text-[10px] font-medium uppercase tracking-[0.1em] text-[#9C91FF] transition duration-200 hover:border-[#8B7CFF]/25 hover:bg-[#8B7CFF]/[0.08] hover:text-white"
                                            >

                                                View


                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    class="h-3.5 w-3.5 shrink-0 transition-transform duration-200 group-hover:translate-x-0.5"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke="currentColor"
                                                    stroke-width="1.8"
                                                >

                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M9 5l7 7-7 7"
                                                    />

                                                </svg>

                                            </a>

                                        </div>

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    </div>


                @else


                    {{-- =================================================
                        EMPTY STATE
                    ================================================== --}}

                    <div
                        class="flex min-h-[360px] flex-col items-center justify-center px-6 text-center"
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
                                    d="M22 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"
                                />

                            </svg>

                        </div>


                        <h3
                            class="mt-5 text-sm font-semibold text-white"
                        >
                            No customers yet
                        </h3>


                        <p
                            class="mx-auto mt-2 max-w-sm text-sm leading-6 text-[#707782]"
                        >
                            Start building your customer database by adding your first customer.
                        </p>


                        <a
                            href="{{ route('customers.create') }}"
                            class="group mt-6 inline-flex items-center gap-2 rounded-2xl bg-[#8B7CFF] px-5 py-3 text-sm font-medium text-white shadow-[0_10px_30px_rgba(139,124,255,0.18)] transition duration-200 hover:-translate-y-0.5 hover:bg-[#7C6EF0]"
                        >

                            <span
                                class="text-base leading-none transition-transform duration-200 group-hover:rotate-90"
                            >
                                +
                            </span>

                            Add Customer

                        </a>

                    </div>

                @endif

            </div>

        </div>

    </div>

</x-app-layout>