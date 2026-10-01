<x-app-layout>

    <div class="space-y-8">

        {{-- Header --}}
        <div class="flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">

            <div>
                <div class="flex items-center gap-2 text-xs font-medium uppercase tracking-[0.16em] text-[#68707B]">
                    <span>Purchasing</span>
                    <span class="text-[#343A43]">/</span>
                    <span>Suppliers</span>
                </div>

                <h1 class="mt-2 text-[30px] font-semibold tracking-[-0.035em] text-[#F5F5F2]">
                    Suppliers
                </h1>

                <p class="mt-2 max-w-xl text-sm leading-6 text-[#7E8793]">
                    Manage supplier relationships and purchasing contacts from one place.
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-3">

                {{-- Back to Purchasing --}}
                <a
                    href="{{ route('purchasing.index') }}"
                    class="inline-flex h-11 items-center justify-center gap-2 rounded-xl border border-[#2A3039] bg-[#12151A] px-4 text-sm font-medium text-[#AEB4BD] transition hover:border-[#454C59] hover:bg-[#171B22] hover:text-white"
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

                    Purchasing
                </a>

                <a
                    href="{{ route('suppliers.create') }}"
                    class="inline-flex h-11 items-center justify-center gap-2 rounded-xl bg-[#F5F5F2] px-5 text-sm font-semibold text-[#0B0D10] transition hover:bg-white"
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
                            d="M12 5v14M5 12h14"
                        />
                    </svg>

                    Add Supplier
                </a>

            </div>

        </div>


        {{-- Flash Messages --}}
        @if (session('success'))
            <div class="rounded-xl border border-emerald-500/15 bg-emerald-500/5 px-4 py-3 text-sm text-emerald-300">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="rounded-xl border border-red-500/15 bg-red-500/5 px-4 py-3 text-sm text-red-300">
                {{ session('error') }}
            </div>
        @endif


        {{-- Overview --}}
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">

            <div class="rounded-2xl border border-[#242830] bg-[#12151A] px-5 py-4">

                <div class="flex items-center justify-between">
                    <span class="text-xs font-medium uppercase tracking-[0.14em] text-[#68707B]">
                        Total
                    </span>

                    <span class="text-xs text-[#535B66]">
                        Suppliers
                    </span>
                </div>

                <div class="mt-3 text-2xl font-semibold tracking-[-0.02em] text-[#F5F5F2]">
                    {{ $summary['total'] }}
                </div>

            </div>


            <div class="rounded-2xl border border-[#242830] bg-[#12151A] px-5 py-4">

                <div class="flex items-center justify-between">
                    <span class="text-xs font-medium uppercase tracking-[0.14em] text-[#68707B]">
                        Active
                    </span>

                    <span class="flex items-center gap-2 text-xs text-[#68707B]">
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>
                        Available
                    </span>
                </div>

                <div class="mt-3 text-2xl font-semibold tracking-[-0.02em] text-[#F5F5F2]">
                    {{ $summary['active'] }}
                </div>

            </div>


            <div class="rounded-2xl border border-[#242830] bg-[#12151A] px-5 py-4">

                <div class="flex items-center justify-between">
                    <span class="text-xs font-medium uppercase tracking-[0.14em] text-[#68707B]">
                        With Orders
                    </span>

                    <span class="text-xs text-[#535B66]">
                        Purchasing
                    </span>
                </div>

                <div class="mt-3 text-2xl font-semibold tracking-[-0.02em] text-[#F5F5F2]">
                    {{ $summary['with_orders'] }}
                </div>

            </div>

        </div>


        {{-- Main Panel --}}
        <div class="overflow-hidden rounded-2xl border border-[#242830] bg-[#12151A]">

            {{-- Toolbar --}}
            <div class="border-b border-[#242830] px-5 py-5 sm:px-6">

                <form
                    method="GET"
                    action="{{ route('suppliers.index') }}"
                    class="flex flex-col gap-3 xl:flex-row"
                >

                    {{-- Search --}}
                    <div class="relative min-w-0 flex-1">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="pointer-events-none absolute left-4 top-1/2 h-4 w-4 -translate-y-1/2 text-[#555D68]"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="m21 21-4.35-4.35m1.35-5.65a7 7 0 11-14 0 7 7 0 0114 0z"
                            />
                        </svg>

                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Search suppliers..."
                            class="h-11 w-full rounded-xl border border-[#2A3039] bg-[#0E1116] pl-11 pr-4 text-sm text-[#F5F5F2] outline-none transition placeholder:text-[#555D68] focus:border-[#5B53A6] focus:ring-1 focus:ring-[#5B53A6]"
                        >

                    </div>


                    {{-- Status --}}
                    <div class="w-full xl:w-44">

                        <select
                            name="status"
                            class="h-11 w-full rounded-xl border border-[#2A3039] bg-[#0E1116] px-4 text-sm text-[#C2C7CF] outline-none transition focus:border-[#5B53A6] focus:ring-1 focus:ring-[#5B53A6]"
                        >

                            <option value="">
                                All status
                            </option>

                            <option
                                value="active"
                                @selected(request('status') === 'active')
                            >
                                Active
                            </option>

                            <option
                                value="inactive"
                                @selected(request('status') === 'inactive')
                            >
                                Inactive
                            </option>

                        </select>

                    </div>


                    {{-- Filter --}}
                    <button
                        type="submit"
                        class="inline-flex h-11 items-center justify-center gap-2 rounded-xl border border-[#303640] bg-[#171B22] px-5 text-sm font-medium text-[#C2C7CF] transition hover:border-[#454C59] hover:bg-[#1D222A] hover:text-white"
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
                                d="M3 6h18M6 12h12m3 6H9"
                            />
                        </svg>

                        Filter
                    </button>


                    @if (request()->hasAny(['search', 'status']))

                        <a
                            href="{{ route('suppliers.index') }}"
                            class="inline-flex h-11 items-center justify-center rounded-xl border border-[#2A3039] px-5 text-sm font-medium text-[#7E8793] transition hover:bg-[#171B22] hover:text-[#F5F5F2]"
                        >
                            Reset
                        </a>

                    @endif

                </form>

            </div>


            {{-- Table Header --}}
            <div class="flex flex-col gap-3 border-b border-[#242830] px-5 py-5 sm:flex-row sm:items-center sm:justify-between sm:px-6">

                <div>

                    <h2 class="text-sm font-semibold text-[#F5F5F2]">
                        Supplier Directory
                    </h2>

                    <p class="mt-1 text-xs text-[#68707B]">
                        {{ $suppliers->total() }} supplier{{ $suppliers->total() === 1 ? '' : 's' }}
                    </p>

                </div>


                @if (request()->hasAny(['search', 'status']))

                    <div class="flex items-center gap-2 text-xs text-[#7E8793]">
                        <span class="h-1.5 w-1.5 rounded-full bg-[#8B7CFF]"></span>
                        Filtered results
                    </div>

                @endif

            </div>


            @if ($suppliers->isEmpty())

                {{-- Empty State --}}
                <div class="px-6 py-24 text-center">

                    <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-2xl border border-[#2A3039] bg-[#171B22] text-[#6E7682]">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.7"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M16 21v-2a4 4 0 00-4-4H7a4 4 0 00-4 4v2m15-10a4 4 0 100-8 4 4 0 000 8zM9.5 11a4 4 0 100-8 4 4 0 000 8z"
                            />
                        </svg>

                    </div>

                    <h3 class="mt-5 text-sm font-semibold text-[#F5F5F2]">
                        No suppliers found
                    </h3>

                    <p class="mx-auto mt-2 max-w-sm text-sm leading-6 text-[#69717D]">
                        Try adjusting your search or add a new supplier to your directory.
                    </p>

                    <a
                        href="{{ route('suppliers.create') }}"
                        class="mt-6 inline-flex h-10 items-center gap-2 rounded-xl bg-[#F5F5F2] px-4 text-sm font-semibold text-[#0B0D10] transition hover:bg-white"
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
                                d="M12 5v14M5 12h14"
                            />
                        </svg>

                        Add Supplier
                    </a>

                </div>

            @else

                {{-- Desktop --}}
                <div class="hidden overflow-x-auto md:block">

                    <table class="w-full">

                        <thead>

                            <tr class="border-b border-[#1F242C]">

                                <th class="px-6 py-4 text-left text-[11px] font-medium uppercase tracking-[0.14em] text-[#626A75]">
                                    Supplier
                                </th>

                                <th class="px-6 py-4 text-left text-[11px] font-medium uppercase tracking-[0.14em] text-[#626A75]">
                                    Contact
                                </th>

                                <th class="px-6 py-4 text-left text-[11px] font-medium uppercase tracking-[0.14em] text-[#626A75]">
                                    Location
                                </th>

                                <th class="px-6 py-4 text-left text-[11px] font-medium uppercase tracking-[0.14em] text-[#626A75]">
                                    Orders
                                </th>

                                <th class="px-6 py-4 text-left text-[11px] font-medium uppercase tracking-[0.14em] text-[#626A75]">
                                    Status
                                </th>

                                <th class="w-16 px-6 py-4"></th>

                            </tr>

                        </thead>


                        <tbody class="divide-y divide-[#1D2229]">

                            @foreach ($suppliers as $supplier)

                                <tr class="group transition hover:bg-[#15191F]">

                                    {{-- Supplier --}}
                                    <td class="px-6 py-5">

                                        <div class="flex items-center gap-3.5">

                                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-[#191E26] text-sm font-semibold text-[#A99FFF]">
                                                {{ strtoupper(substr($supplier->name, 0, 1)) }}
                                            </div>

                                            <div class="min-w-0">

                                                <div class="truncate text-sm font-medium text-[#F1F1EE]">
                                                    {{ $supplier->name }}
                                                </div>

                                                <div class="mt-1 text-xs text-[#68707B]">
                                                    {{ $supplier->code }}
                                                </div>

                                            </div>

                                        </div>

                                    </td>


                                    {{-- Contact --}}
                                    <td class="px-6 py-5">

                                        <div class="min-w-0">

                                            @if ($supplier->email)

                                                <div class="max-w-[230px] truncate text-sm text-[#B8BEC7]">
                                                    {{ $supplier->email }}
                                                </div>

                                            @else

                                                <div class="text-sm text-[#555D68]">
                                                    No email
                                                </div>

                                            @endif

                                            @if ($supplier->phone)

                                                <div class="mt-1 text-xs text-[#68707B]">
                                                    {{ $supplier->phone }}
                                                </div>

                                            @endif

                                        </div>

                                    </td>


                                    {{-- Location --}}
                                    <td class="px-6 py-5">

                                        <span class="text-sm text-[#B8BEC7]">
                                            {{ $supplier->city ?: '—' }}
                                        </span>

                                    </td>


                                    {{-- Orders --}}
                                    <td class="px-6 py-5">

                                        <span class="text-sm font-medium text-[#C8CDD4]">
                                            {{ $supplier->purchase_orders_count }}
                                        </span>

                                    </td>


                                    {{-- Status --}}
                                    <td class="px-6 py-5">

                                        @if ($supplier->is_active)

                                            <span class="inline-flex items-center gap-2 text-xs font-medium text-emerald-300">
                                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>
                                                Active
                                            </span>

                                        @else

                                            <span class="inline-flex items-center gap-2 text-xs font-medium text-[#737C88]">
                                                <span class="h-1.5 w-1.5 rounded-full bg-[#59616D]"></span>
                                                Inactive
                                            </span>

                                        @endif

                                    </td>


                                    {{-- Actions --}}
                                    <td class="px-6 py-5">

                                        <div class="flex justify-end">

                                            <details class="relative">

                                                <summary
                                                    class="flex h-9 w-9 cursor-pointer list-none items-center justify-center rounded-lg text-[#707985] transition hover:bg-[#1B2028] hover:text-[#F5F5F2]"
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
                                                            d="M6 12h.01M12 12h.01M18 12h.01"
                                                        />
                                                    </svg>

                                                </summary>


                                                <div class="absolute right-0 z-20 mt-2 w-40 overflow-hidden rounded-xl border border-[#2A3039] bg-[#15191F] p-1.5 shadow-2xl shadow-black/30">

                                                    {{-- View Supplier --}}
                                                    <a
                                                        href="{{ route('suppliers.show', $supplier) }}"
                                                        class="flex items-center rounded-lg px-3 py-2 text-sm text-[#C2C7CF] transition hover:bg-[#1D222A] hover:text-white"
                                                    >
                                                        View supplier
                                                    </a>


                                                    {{-- Edit Supplier --}}
                                                    <a
                                                        href="{{ route('suppliers.edit', $supplier) }}"
                                                        class="flex items-center rounded-lg px-3 py-2 text-sm text-[#C2C7CF] transition hover:bg-[#1D222A] hover:text-white"
                                                    >
                                                        Edit supplier
                                                    </a>


                                                    {{-- Toggle Status --}}
                                                    <form
                                                        method="POST"
                                                        action="{{ route('suppliers.toggle-status', $supplier) }}"
                                                    >
                                                        @csrf
                                                        @method('PATCH')

                                                        <button
                                                            type="submit"
                                                            class="flex w-full items-center rounded-lg px-3 py-2 text-left text-sm text-[#C2C7CF] transition hover:bg-[#1D222A] hover:text-white"
                                                        >
                                                            {{ $supplier->is_active ? 'Disable supplier' : 'Enable supplier' }}
                                                        </button>

                                                    </form>


                                                    <div class="my-1 border-t border-[#242830]"></div>


                                                    {{-- Delete --}}
                                                    <form
                                                        method="POST"
                                                        action="{{ route('suppliers.destroy', $supplier) }}"
                                                        onsubmit="return confirm('Delete this supplier? This action cannot be undone.')"
                                                    >
                                                        @csrf
                                                        @method('DELETE')

                                                        <button
                                                            type="submit"
                                                            class="flex w-full items-center rounded-lg px-3 py-2 text-left text-sm text-red-300 transition hover:bg-red-500/10"
                                                        >
                                                            Delete supplier
                                                        </button>

                                                    </form>

                                                </div>

                                            </details>

                                        </div>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>


                {{-- Mobile --}}
                <div class="divide-y divide-[#1D2229] md:hidden">

                    @foreach ($suppliers as $supplier)

                        <div class="px-5 py-5">

                            <div class="flex items-start justify-between gap-4">

                                <div class="flex min-w-0 items-center gap-3">

                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-[#191E26] text-sm font-semibold text-[#A99FFF]">
                                        {{ strtoupper(substr($supplier->name, 0, 1)) }}
                                    </div>

                                    <div class="min-w-0">

                                        <div class="truncate text-sm font-medium text-[#F1F1EE]">
                                            {{ $supplier->name }}
                                        </div>

                                        <div class="mt-1 text-xs text-[#68707B]">
                                            {{ $supplier->code }}
                                        </div>

                                    </div>

                                </div>


                                @if ($supplier->is_active)

                                    <span class="shrink-0 text-xs font-medium text-emerald-300">
                                        Active
                                    </span>

                                @else

                                    <span class="shrink-0 text-xs font-medium text-[#737C88]">
                                        Inactive
                                    </span>

                                @endif

                            </div>


                            <div class="mt-5 space-y-3">

                                <div>

                                    <div class="text-[10px] font-medium uppercase tracking-[0.14em] text-[#555D68]">
                                        Contact
                                    </div>

                                    <div class="mt-1 truncate text-sm text-[#B8BEC7]">
                                        {{ $supplier->email ?: 'No email' }}
                                    </div>

                                    @if ($supplier->phone)

                                        <div class="mt-1 text-xs text-[#68707B]">
                                            {{ $supplier->phone }}
                                        </div>

                                    @endif

                                </div>


                                <div class="grid grid-cols-2 gap-4">

                                    <div>

                                        <div class="text-[10px] font-medium uppercase tracking-[0.14em] text-[#555D68]">
                                            Location
                                        </div>

                                        <div class="mt-1 text-sm text-[#B8BEC7]">
                                            {{ $supplier->city ?: '—' }}
                                        </div>

                                    </div>


                                    <div>

                                        <div class="text-[10px] font-medium uppercase tracking-[0.14em] text-[#555D68]">
                                            Orders
                                        </div>

                                        <div class="mt-1 text-sm text-[#B8BEC7]">
                                            {{ $supplier->purchase_orders_count }}
                                        </div>

                                    </div>

                                </div>


                                @if ($supplier->contact_person)

                                    <div>

                                        <div class="text-[10px] font-medium uppercase tracking-[0.14em] text-[#555D68]">
                                            Contact person
                                        </div>

                                        <div class="mt-1 text-sm text-[#B8BEC7]">
                                            {{ $supplier->contact_person }}
                                        </div>

                                    </div>

                                @endif

                            </div>


                            <div class="mt-5 flex items-center gap-2">

                                <a
                                    href="{{ route('suppliers.show', $supplier) }}"
                                    class="inline-flex h-9 items-center rounded-lg border border-[#2A3039] px-3 text-xs font-medium text-[#AEB4BD] transition hover:bg-[#1B2028] hover:text-white"
                                >
                                    View
                                </a>


                                <a
                                    href="{{ route('suppliers.edit', $supplier) }}"
                                    class="inline-flex h-9 items-center rounded-lg border border-[#2A3039] px-3 text-xs font-medium text-[#AEB4BD] transition hover:bg-[#1B2028] hover:text-white"
                                >
                                    Edit
                                </a>


                                <form
                                    method="POST"
                                    action="{{ route('suppliers.toggle-status', $supplier) }}"
                                >
                                    @csrf
                                    @method('PATCH')

                                    <button
                                        type="submit"
                                        class="inline-flex h-9 items-center rounded-lg border border-[#2A3039] px-3 text-xs font-medium text-[#AEB4BD] transition hover:bg-[#1B2028] hover:text-white"
                                    >
                                        {{ $supplier->is_active ? 'Disable' : 'Enable' }}
                                    </button>

                                </form>


                                <form
                                    method="POST"
                                    action="{{ route('suppliers.destroy', $supplier) }}"
                                    onsubmit="return confirm('Delete this supplier? This action cannot be undone.')"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="inline-flex h-9 items-center rounded-lg border border-red-500/20 px-3 text-xs font-medium text-red-300 transition hover:bg-red-500/10"
                                    >
                                        Delete
                                    </button>

                                </form>

                            </div>

                        </div>

                    @endforeach

                </div>

            @endif


            {{-- Pagination --}}
            @if ($suppliers->hasPages())

                <div class="border-t border-[#242830] px-5 py-5 sm:px-6">

                    {{ $suppliers->links() }}

                </div>

            @endif

        </div>

    </div>

</x-app-layout>