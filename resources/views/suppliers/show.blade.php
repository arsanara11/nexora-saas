<x-app-layout>

    <div class="space-y-8">

        {{-- Header --}}
        <div class="flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">

            <div>

                <div class="flex items-center gap-2 text-xs font-medium uppercase tracking-[0.16em] text-[#68707B]">

                    <a
                        href="{{ route('suppliers.index') }}"
                        class="transition hover:text-[#B5BBC4]"
                    >
                        Suppliers
                    </a>

                    <span class="text-[#343A43]">/</span>

                    <span>Details</span>

                </div>


                <div class="mt-3 flex items-center gap-4">

                    <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-[#191E26] text-lg font-semibold text-[#A99FFF]">
                        {{ strtoupper(substr($supplier->name, 0, 1)) }}
                    </div>


                    <div class="min-w-0">

                        <div class="flex flex-wrap items-center gap-3">

                            <h1 class="text-[30px] font-semibold tracking-[-0.035em] text-[#F5F5F2]">
                                {{ $supplier->name }}
                            </h1>


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

                        </div>


                        <p class="mt-1 text-sm text-[#68707B]">
                            {{ $supplier->code }}
                        </p>

                    </div>

                </div>

            </div>


            <div class="flex items-center gap-2">

                <a
                    href="{{ route('suppliers.edit', $supplier) }}"
                    class="inline-flex h-10 items-center gap-2 rounded-xl border border-[#2A3039] bg-[#12151A] px-4 text-sm font-medium text-[#B8BEC7] transition hover:border-[#454C59] hover:bg-[#171B22] hover:text-white"
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
                            d="M16.862 3.487a2.1 2.1 0 013 2.97L8.75 16.57l-4.25 1.06 1.06-4.25L16.862 3.487z"
                        />
                    </svg>

                    Edit
                </a>


                <a
                    href="{{ route('suppliers.index') }}"
                    class="inline-flex h-10 items-center justify-center rounded-xl border border-[#2A3039] px-4 text-sm font-medium text-[#7E8793] transition hover:bg-[#171B22] hover:text-[#F5F5F2]"
                >
                    Back
                </a>

            </div>

        </div>


        {{-- Overview --}}
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">

            <div class="rounded-2xl border border-[#242830] bg-[#12151A] px-5 py-4">

                <div class="text-xs font-medium uppercase tracking-[0.14em] text-[#68707B]">
                    Total Orders
                </div>

                <div class="mt-3 text-2xl font-semibold tracking-[-0.02em] text-[#F5F5F2]">
                    {{ $orderSummary['total'] }}
                </div>

                <div class="mt-1 text-xs text-[#59616C]">
                    Purchase orders
                </div>

            </div>


            <div class="rounded-2xl border border-[#242830] bg-[#12151A] px-5 py-4">

                <div class="text-xs font-medium uppercase tracking-[0.14em] text-[#68707B]">
                    Received
                </div>

                <div class="mt-3 text-2xl font-semibold tracking-[-0.02em] text-[#F5F5F2]">
                    {{ $orderSummary['received'] }}
                </div>

                <div class="mt-1 text-xs text-[#59616C]">
                    Completed purchases
                </div>

            </div>


            <div class="rounded-2xl border border-[#242830] bg-[#12151A] px-5 py-4">

                <div class="text-xs font-medium uppercase tracking-[0.14em] text-[#68707B]">
                    Pending
                </div>

                <div class="mt-3 text-2xl font-semibold tracking-[-0.02em] text-[#F5F5F2]">
                    {{ $orderSummary['pending'] }}
                </div>

                <div class="mt-1 text-xs text-[#59616C]">
                    Active purchase orders
                </div>

            </div>


            <div class="rounded-2xl border border-[#242830] bg-[#12151A] px-5 py-4">

                <div class="text-xs font-medium uppercase tracking-[0.14em] text-[#68707B]">
                    Total Spend
                </div>

                <div class="mt-3 truncate text-2xl font-semibold tracking-[-0.02em] text-[#F5F5F2]">
                    Rp {{ number_format((float) $orderSummary['total_spend'], 0, ',', '.') }}
                </div>

                <div class="mt-1 text-xs text-[#59616C]">
                    Excluding draft and cancelled
                </div>

            </div>

        </div>


        {{-- Main Grid --}}
        <div class="grid grid-cols-1 gap-6 xl:grid-cols-[360px_minmax(0,1fr)]">

            {{-- Supplier Information --}}
            <div class="rounded-2xl border border-[#242830] bg-[#12151A]">

                <div class="border-b border-[#242830] px-6 py-5">

                    <h2 class="text-sm font-semibold text-[#F5F5F2]">
                        Supplier Information
                    </h2>

                    <p class="mt-1 text-xs text-[#68707B]">
                        Business and contact details.
                    </p>

                </div>


                <div class="divide-y divide-[#1D2229]">

                    {{-- Contact Person --}}
                    <div class="px-6 py-5">

                        <div class="text-[10px] font-medium uppercase tracking-[0.14em] text-[#555D68]">
                            Contact Person
                        </div>

                        <div class="mt-2 text-sm text-[#C2C7CF]">
                            {{ $supplier->contact_person ?: 'Not provided' }}
                        </div>

                    </div>


                    {{-- Email --}}
                    <div class="px-6 py-5">

                        <div class="text-[10px] font-medium uppercase tracking-[0.14em] text-[#555D68]">
                            Email
                        </div>

                        @if ($supplier->email)

                            <a
                                href="mailto:{{ $supplier->email }}"
                                class="mt-2 block truncate text-sm text-[#B8B1FF] transition hover:text-[#D0CCFF]"
                            >
                                {{ $supplier->email }}
                            </a>

                        @else

                            <div class="mt-2 text-sm text-[#59616C]">
                                Not provided
                            </div>

                        @endif

                    </div>


                    {{-- Phone --}}
                    <div class="px-6 py-5">

                        <div class="text-[10px] font-medium uppercase tracking-[0.14em] text-[#555D68]">
                            Phone
                        </div>

                        @if ($supplier->phone)

                            <a
                                href="tel:{{ $supplier->phone }}"
                                class="mt-2 block text-sm text-[#C2C7CF] transition hover:text-white"
                            >
                                {{ $supplier->phone }}
                            </a>

                        @else

                            <div class="mt-2 text-sm text-[#59616C]">
                                Not provided
                            </div>

                        @endif

                    </div>


                    {{-- City --}}
                    <div class="px-6 py-5">

                        <div class="text-[10px] font-medium uppercase tracking-[0.14em] text-[#555D68]">
                            City
                        </div>

                        <div class="mt-2 text-sm text-[#C2C7CF]">
                            {{ $supplier->city ?: 'Not provided' }}
                        </div>

                    </div>


                    {{-- Address --}}
                    <div class="px-6 py-5">

                        <div class="text-[10px] font-medium uppercase tracking-[0.14em] text-[#555D68]">
                            Address
                        </div>

                        <div class="mt-2 text-sm leading-6 text-[#AEB4BD]">
                            {{ $supplier->address ?: 'Not provided' }}
                        </div>

                    </div>


                    {{-- Notes --}}
                    <div class="px-6 py-5">

                        <div class="text-[10px] font-medium uppercase tracking-[0.14em] text-[#555D68]">
                            Notes
                        </div>

                        <div class="mt-2 text-sm leading-6 text-[#AEB4BD]">
                            {{ $supplier->notes ?: 'No internal notes.' }}
                        </div>

                    </div>

                </div>

            </div>


            {{-- Purchase Order History --}}
            <div class="overflow-hidden rounded-2xl border border-[#242830] bg-[#12151A]">

                <div class="flex flex-col gap-3 border-b border-[#242830] px-6 py-5 sm:flex-row sm:items-center sm:justify-between">

                    <div>

                        <h2 class="text-sm font-semibold text-[#F5F5F2]">
                            Purchase Order History
                        </h2>

                        <p class="mt-1 text-xs text-[#68707B]">
                            Recent purchasing activity linked to this supplier.
                        </p>

                    </div>


                    <a
                        href="{{ route('purchasing.create') }}"
                        class="inline-flex h-9 items-center justify-center rounded-lg border border-[#2A3039] px-3 text-xs font-medium text-[#B8BEC7] transition hover:border-[#454C59] hover:bg-[#1B2028] hover:text-white"
                    >
                        New Purchase Order
                    </a>

                </div>


                @if ($purchaseOrders->isEmpty())

                    <div class="px-6 py-20 text-center">

                        <div class="mx-auto flex h-11 w-11 items-center justify-center rounded-xl border border-[#2A3039] bg-[#171B22] text-[#68707B]">

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
                                    d="M6 3h12a1 1 0 011 1v16a1 1 0 01-1 1H6a1 1 0 01-1-1V4a1 1 0 011-1zm3 5h6m-6 4h6m-6 4h4"
                                />
                            </svg>

                        </div>


                        <h3 class="mt-4 text-sm font-semibold text-[#F5F5F2]">
                            No purchase orders yet
                        </h3>


                        <p class="mx-auto mt-2 max-w-sm text-sm leading-6 text-[#68707B]">
                            Purchase orders created for this supplier will appear here.
                        </p>

                    </div>

                @else

                    {{-- Desktop Table --}}
                    <div class="hidden overflow-x-auto md:block">

                        <table class="w-full min-w-[720px]">

                            <thead>

                                <tr class="border-b border-[#1F242C]">

                                    <th class="px-6 py-4 text-left text-[11px] font-medium uppercase tracking-[0.14em] text-[#626A75]">
                                        Purchase Order
                                    </th>

                                    <th class="px-6 py-4 text-left text-[11px] font-medium uppercase tracking-[0.14em] text-[#626A75]">
                                        Warehouse
                                    </th>

                                    <th class="px-6 py-4 text-left text-[11px] font-medium uppercase tracking-[0.14em] text-[#626A75]">
                                        Status
                                    </th>

                                    <th class="px-6 py-4 text-left text-[11px] font-medium uppercase tracking-[0.14em] text-[#626A75]">
                                        Date
                                    </th>

                                    <th class="px-6 py-4 text-right text-[11px] font-medium uppercase tracking-[0.14em] text-[#626A75]">
                                        Total
                                    </th>

                                </tr>

                            </thead>


                            <tbody class="divide-y divide-[#1D2229]">

                                @foreach ($purchaseOrders as $purchaseOrder)

                                    <tr class="transition hover:bg-[#15191F]">

                                        {{-- PO --}}
                                        <td class="px-6 py-5">

                                            <a
                                                href="{{ route('purchasing.show', $purchaseOrder) }}"
                                                class="text-sm font-medium text-[#D7D9DD] transition hover:text-[#B8B1FF]"
                                            >
                                                {{ $purchaseOrder->po_number }}
                                            </a>

                                            <div class="mt-1 text-xs text-[#68707B]">
                                                {{ $purchaseOrder->user?->name ?? 'System' }}
                                            </div>

                                        </td>


                                        {{-- Warehouse --}}
                                        <td class="px-6 py-5">

                                            <div class="text-sm text-[#B8BEC7]">
                                                {{ $purchaseOrder->warehouse?->name ?? '—' }}
                                            </div>

                                        </td>


                                        {{-- Status --}}
                                        <td class="px-6 py-5">

                                            @php
                                                $statusClasses = match ($purchaseOrder->status) {
                                                    'draft' => 'border-[#303640] bg-[#171B22] text-[#8B919A]',
                                                    'pending' => 'border-amber-500/20 bg-amber-500/5 text-amber-300',
                                                    'approved' => 'border-blue-500/20 bg-blue-500/5 text-blue-300',
                                                    'ordered' => 'border-[#8B7CFF]/20 bg-[#8B7CFF]/5 text-[#B8B1FF]',
                                                    'received' => 'border-emerald-500/20 bg-emerald-500/5 text-emerald-300',
                                                    'cancelled' => 'border-red-500/20 bg-red-500/5 text-red-300',
                                                    default => 'border-[#303640] bg-[#171B22] text-[#8B919A]',
                                                };
                                            @endphp

                                            <span class="inline-flex rounded-full border px-2.5 py-1 text-[11px] font-medium {{ $statusClasses }}">
                                                {{ $purchaseOrder->status_label }}
                                            </span>

                                        </td>


                                        {{-- Date --}}
                                        <td class="px-6 py-5">

                                            <div class="text-sm text-[#B8BEC7]">
                                                {{ optional($purchaseOrder->ordered_at)->format('d M Y') ?? '—' }}
                                            </div>

                                        </td>


                                        {{-- Total --}}
                                        <td class="px-6 py-5 text-right">

                                            <div class="text-sm font-medium text-[#F1F1EE]">
                                                Rp {{ number_format((float) $purchaseOrder->total, 0, ',', '.') }}
                                            </div>

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>


                    {{-- Mobile --}}
                    <div class="divide-y divide-[#1D2229] md:hidden">

                        @foreach ($purchaseOrders as $purchaseOrder)

                            <a
                                href="{{ route('purchasing.show', $purchaseOrder) }}"
                                class="block px-5 py-5 transition hover:bg-[#15191F]"
                            >

                                <div class="flex items-start justify-between gap-4">

                                    <div>

                                        <div class="text-sm font-medium text-[#D7D9DD]">
                                            {{ $purchaseOrder->po_number }}
                                        </div>

                                        <div class="mt-1 text-xs text-[#68707B]">
                                            {{ optional($purchaseOrder->ordered_at)->format('d M Y') ?? '—' }}
                                        </div>

                                    </div>


                                    @php
                                        $statusClasses = match ($purchaseOrder->status) {
                                            'draft' => 'border-[#303640] bg-[#171B22] text-[#8B919A]',
                                            'pending' => 'border-amber-500/20 bg-amber-500/5 text-amber-300',
                                            'approved' => 'border-blue-500/20 bg-blue-500/5 text-blue-300',
                                            'ordered' => 'border-[#8B7CFF]/20 bg-[#8B7CFF]/5 text-[#B8B1FF]',
                                            'received' => 'border-emerald-500/20 bg-emerald-500/5 text-emerald-300',
                                            'cancelled' => 'border-red-500/20 bg-red-500/5 text-red-300',
                                            default => 'border-[#303640] bg-[#171B22] text-[#8B919A]',
                                        };
                                    @endphp

                                    <span class="inline-flex shrink-0 rounded-full border px-2.5 py-1 text-[11px] font-medium {{ $statusClasses }}">
                                        {{ $purchaseOrder->status_label }}
                                    </span>

                                </div>


                                <div class="mt-4 flex items-center justify-between">

                                    <div class="text-xs text-[#68707B]">
                                        {{ $purchaseOrder->warehouse?->name ?? 'No warehouse' }}
                                    </div>

                                    <div class="text-sm font-medium text-[#F1F1EE]">
                                        Rp {{ number_format((float) $purchaseOrder->total, 0, ',', '.') }}
                                    </div>

                                </div>

                            </a>

                        @endforeach

                    </div>


                    {{-- Pagination --}}
                    @if ($purchaseOrders->hasPages())

                        <div class="border-t border-[#242830] px-6 py-5">

                            {{ $purchaseOrders->links() }}

                        </div>

                    @endif

                @endif

            </div>

        </div>

    </div>

</x-app-layout>