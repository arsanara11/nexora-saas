<x-app-layout>
    <div class="space-y-6">

        {{-- Header --}}
        <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <div class="mb-2 flex items-center gap-2 text-xs font-medium uppercase tracking-[0.18em] text-[#8B919A]">
                    <a
                        href="{{ route('finance.index') }}"
                        class="transition hover:text-white"
                    >
                        Finance
                    </a>

                    <span class="text-[#4A4F57]">/</span>

                    <span class="text-white">
                        Payments
                    </span>
                </div>

                <h1 class="text-2xl font-semibold tracking-tight text-white">
                    Payments
                </h1>

                <p class="mt-1 text-sm text-[#8B919A]">
                    Track and manage payments received for your business invoices.
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-3">

                <a
                    href="{{ route('finance.index') }}"
                    class="inline-flex items-center gap-2 rounded-xl border border-[#242830] bg-[#12151A] px-4 py-2.5 text-sm font-medium text-[#D8DCE2] transition hover:border-[#343943] hover:bg-[#171A20] hover:text-white"
                >
                    <span>←</span>
                    Financial Overview
                </a>

                <a
                    href="{{ route('finance.payments.create') }}"
                    class="inline-flex items-center gap-2 rounded-xl bg-white px-4 py-2.5 text-sm font-semibold text-[#0B0D10] transition hover:bg-[#E8E8E5]"
                >
                    <span class="text-base leading-none">+</span>
                    Create Payment
                </a>

            </div>
        </div>


        {{-- Success --}}
        @if (session('success'))
            <div class="rounded-2xl border border-emerald-400/20 bg-emerald-400/10 px-5 py-4 text-sm text-emerald-300">
                {{ session('success') }}
            </div>
        @endif


        {{-- Summary Cards --}}
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">

            {{-- Total Payments --}}
            <div class="rounded-2xl border border-[#242830] bg-[#12151A] p-5">
                <div class="flex items-center justify-between gap-4">

                    <div>
                        <p class="text-xs font-medium uppercase tracking-[0.12em] text-[#8B919A]">
                            Total Payments
                        </p>

                        <p class="mt-2 text-2xl font-semibold tracking-tight text-white">
                            {{ $summary['total'] }}
                        </p>
                    </div>

                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#8B7CFF]/10 text-[#A99FFF]">
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
                                d="M3.5 7.5h17v9a2 2 0 01-2 2h-13a2 2 0 01-2-2v-9z"
                            />
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M3.5 9.5h17M7.5 14h3"
                            />
                        </svg>
                    </div>

                </div>

                <p class="mt-3 text-xs text-[#6F757E]">
                    All recorded payment transactions
                </p>
            </div>


            {{-- Paid --}}
            <div class="rounded-2xl border border-[#242830] bg-[#12151A] p-5">
                <div class="flex items-center justify-between gap-4">

                    <div>
                        <p class="text-xs font-medium uppercase tracking-[0.12em] text-[#8B919A]">
                            Paid
                        </p>

                        <p class="mt-2 text-2xl font-semibold tracking-tight text-white">
                            {{ $summary['paid'] }}
                        </p>
                    </div>

                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-400/10 text-emerald-300">
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
                                d="M5 12.5l4 4L19 6.5"
                            />
                        </svg>
                    </div>

                </div>

                <p class="mt-3 text-xs text-[#6F757E]">
                    Successful payments
                </p>
            </div>


            {{-- Pending --}}
            <div class="rounded-2xl border border-[#242830] bg-[#12151A] p-5">
                <div class="flex items-center justify-between gap-4">

                    <div>
                        <p class="text-xs font-medium uppercase tracking-[0.12em] text-[#8B919A]">
                            Pending
                        </p>

                        <p class="mt-2 text-2xl font-semibold tracking-tight text-white">
                            {{ $summary['pending'] }}
                        </p>
                    </div>

                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-amber-400/10 text-amber-300">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.7"
                        >
                            <circle
                                cx="12"
                                cy="12"
                                r="8.5"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 7.5v5l3 2"
                            />
                        </svg>
                    </div>

                </div>

                <p class="mt-3 text-xs text-[#6F757E]">
                    Waiting to be completed
                </p>
            </div>


            {{-- Paid Amount --}}
            <div class="rounded-2xl border border-[#242830] bg-[#12151A] p-5">
                <div class="flex items-center justify-between gap-4">

                    <div class="min-w-0">
                        <p class="text-xs font-medium uppercase tracking-[0.12em] text-[#8B919A]">
                            Paid Amount
                        </p>

                        <p class="mt-2 truncate text-2xl font-semibold tracking-tight text-white">
                            Rp {{ number_format((float) $summary['paid_amount'], 0, ',', '.') }}
                        </p>
                    </div>

                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-blue-400/10 text-blue-300">
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
                                d="M12 3.5v17M7.5 8.25C7.5 6.6 9.3 5.5 12 5.5s4.5 1.1 4.5 2.75c0 4-9 1.5-9 5.5 0 1.65 1.8 2.75 4.5 2.75s4.5-1.1 4.5-2.75"
                            />
                        </svg>
                    </div>

                </div>

                <p class="mt-3 text-xs text-[#6F757E]">
                    Total successful payment value
                </p>
            </div>

        </div>


        {{-- Filters --}}
        <section class="rounded-2xl border border-[#242830] bg-[#12151A] p-5">

            <form
                method="GET"
                action="{{ route('finance.payments.index') }}"
            >

                <div class="grid grid-cols-1 gap-4 lg:grid-cols-12">

                    {{-- Search --}}
                    <div class="lg:col-span-5">

                        <label
                            for="search"
                            class="mb-2 block text-xs font-medium uppercase tracking-[0.12em] text-[#8B919A]"
                        >
                            Search
                        </label>

                        <div class="relative">

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-[#666C75]"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M21 21l-4.35-4.35m2.35-5.65a8 8 0 11-16 0 8 8 0 0116 0z"
                                />
                            </svg>

                            <input
                                id="search"
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="Search invoice, method, or status..."
                                class="w-full rounded-xl border border-[#2A2E35] bg-[#0B0D10] py-3 pl-10 pr-4 text-sm text-white outline-none placeholder:text-[#555B64] transition focus:border-[#8B7CFF] focus:ring-1 focus:ring-[#8B7CFF]"
                            >

                        </div>

                    </div>


                    {{-- Method --}}
                    <div class="lg:col-span-3">

                        <label
                            for="method"
                            class="mb-2 block text-xs font-medium uppercase tracking-[0.12em] text-[#8B919A]"
                        >
                            Method
                        </label>

                        <select
                            id="method"
                            name="method"
                            class="w-full rounded-xl border border-[#2A2E35] bg-[#0B0D10] px-4 py-3 text-sm text-white outline-none transition focus:border-[#8B7CFF] focus:ring-1 focus:ring-[#8B7CFF]"
                        >

                            <option value="">
                                All Methods
                            </option>

                            @foreach ($methods as $method)
                                <option
                                    value="{{ $method }}"
                                    @selected(request('method') === $method)
                                >
                                    {{ ucfirst(str_replace('_', ' ', $method)) }}
                                </option>
                            @endforeach

                        </select>

                    </div>


                    {{-- Status --}}
                    <div class="lg:col-span-2">

                        <label
                            for="status"
                            class="mb-2 block text-xs font-medium uppercase tracking-[0.12em] text-[#8B919A]"
                        >
                            Status
                        </label>

                        <select
                            id="status"
                            name="status"
                            class="w-full rounded-xl border border-[#2A2E35] bg-[#0B0D10] px-4 py-3 text-sm text-white outline-none transition focus:border-[#8B7CFF] focus:ring-1 focus:ring-[#8B7CFF]"
                        >

                            <option value="">
                                All Statuses
                            </option>

                            <option
                                value="pending"
                                @selected(request('status') === 'pending')
                            >
                                Pending
                            </option>

                            <option
                                value="paid"
                                @selected(request('status') === 'paid')
                            >
                                Paid
                            </option>

                            <option
                                value="failed"
                                @selected(request('status') === 'failed')
                            >
                                Failed
                            </option>

                            <option
                                value="refunded"
                                @selected(request('status') === 'refunded')
                            >
                                Refunded
                            </option>

                        </select>

                    </div>


                    {{-- Actions --}}
                    <div class="flex items-end gap-2 lg:col-span-2">

                        <button
                            type="submit"
                            class="flex-1 rounded-xl bg-white px-4 py-3 text-sm font-semibold text-[#0B0D10] transition hover:bg-[#E8E8E5]"
                        >
                            Apply
                        </button>

                        <a
                            href="{{ route('finance.payments.index') }}"
                            class="rounded-xl border border-[#2A2E35] bg-[#0B0D10] px-4 py-3 text-sm font-medium text-[#B8BDC5] transition hover:border-[#3A3F47] hover:text-white"
                        >
                            Clear
                        </a>

                    </div>

                </div>

            </form>

        </section>


        {{-- Payment Table --}}
        <section class="overflow-hidden rounded-2xl border border-[#242830] bg-[#12151A]">

            <div class="flex flex-col gap-4 border-b border-[#242830] px-6 py-5 md:flex-row md:items-center md:justify-between">

                <div>
                    <h2 class="text-base font-semibold text-white">
                        Payment Records
                    </h2>

                    <p class="mt-1 text-sm text-[#8B919A]">
                        {{ $payments->total() }}
                        payment record{{ $payments->total() === 1 ? '' : 's' }}
                        found.
                    </p>
                </div>

                <div class="text-xs text-[#6F757E]">
                    Showing
                    <span class="font-medium text-[#B8BDC5]">
                        {{ $payments->firstItem() ?? 0 }}
                    </span>
                    –
                    <span class="font-medium text-[#B8BDC5]">
                        {{ $payments->lastItem() ?? 0 }}
                    </span>
                </div>

            </div>


            @if ($payments->count())

                <div class="overflow-x-auto">

                    <table class="w-full min-w-[900px]">

                        <thead>

                            <tr class="border-b border-[#242830] bg-[#0E1116]">

                                <th class="px-6 py-4 text-left text-xs font-medium uppercase tracking-[0.1em] text-[#666C75]">
                                    Invoice
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-medium uppercase tracking-[0.1em] text-[#666C75]">
                                    Date
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-medium uppercase tracking-[0.1em] text-[#666C75]">
                                    Method
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-medium uppercase tracking-[0.1em] text-[#666C75]">
                                    Status
                                </th>

                                <th class="px-6 py-4 text-right text-xs font-medium uppercase tracking-[0.1em] text-[#666C75]">
                                    Amount
                                </th>

                                <th class="px-6 py-4 text-right text-xs font-medium uppercase tracking-[0.1em] text-[#666C75]">
                                    Action
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y divide-[#1D2127]">

                            @foreach ($payments as $payment)

                                @php
                                    $statusClass = match ($payment->status) {
                                        'paid' => 'border-emerald-400/20 bg-emerald-400/10 text-emerald-300',
                                        'pending' => 'border-amber-400/20 bg-amber-400/10 text-amber-300',
                                        'failed' => 'border-red-400/20 bg-red-400/10 text-red-300',
                                        'refunded' => 'border-blue-400/20 bg-blue-400/10 text-blue-300',
                                        default => 'border-[#242830] bg-[#0B0D10] text-[#8B919A]',
                                    };
                                @endphp

                                <tr class="transition hover:bg-[#0E1116]">

                                    {{-- Invoice --}}
                                    <td class="px-6 py-4">

                                        @if ($payment->invoice)

                                            <a
                                                href="{{ route('finance.invoices.show', $payment->invoice) }}"
                                                class="font-medium text-white transition hover:text-[#C9C2FF]"
                                            >
                                                {{ $payment->invoice->invoice_number }}
                                            </a>

                                            @if ($payment->invoice->order?->customer)
                                                <div class="mt-1 text-xs text-[#6F757E]">
                                                    {{ $payment->invoice->order->customer->name }}
                                                </div>
                                            @endif

                                        @else

                                            <span class="text-sm text-[#6F757E]">
                                                Invoice unavailable
                                            </span>

                                        @endif

                                    </td>


                                    {{-- Date --}}
                                    <td class="px-6 py-4">

                                        @php
                                            $paymentDate = $payment->paid_at
                                                ?? $payment->created_at;
                                        @endphp

                                        <div class="text-sm text-[#D8DCE2]">
                                            {{ $paymentDate?->format('d M Y') ?? '—' }}
                                        </div>

                                        <div class="mt-1 text-xs text-[#6F757E]">
                                            {{ $paymentDate?->format('H:i') ?? '—' }}
                                        </div>

                                    </td>


                                    {{-- Method --}}
                                    <td class="px-6 py-4">

                                        <div class="text-sm font-medium text-white">
                                            {{ ucfirst(str_replace('_', ' ', $payment->method ?? '—')) }}
                                        </div>

                                    </td>


                                    {{-- Status --}}
                                    <td class="px-6 py-4">

                                        <span class="inline-flex rounded-full border px-2.5 py-1 text-[10px] font-medium uppercase tracking-[0.08em] {{ $statusClass }}">
                                            {{ ucfirst($payment->status) }}
                                        </span>

                                    </td>


                                    {{-- Amount --}}
                                    <td class="px-6 py-4 text-right">

                                        <div class="text-sm font-semibold text-white">
                                            Rp {{ number_format((float) $payment->amount, 0, ',', '.') }}
                                        </div>

                                    </td>


                                    {{-- Action --}}
                                    <td class="px-6 py-4 text-right">

                                        <a
                                            href="{{ route('finance.payments.show', $payment) }}"
                                            class="inline-flex items-center gap-2 rounded-lg border border-[#242830] px-3 py-2 text-xs font-medium text-[#B8BDC5] transition hover:border-[#8B7CFF]/40 hover:text-white"
                                        >
                                            View
                                        </a>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="px-6 py-16 text-center">

                    <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl border border-[#242830] bg-[#0B0D10] text-[#666C75]">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.7"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M3.5 7.5h17v9a2 2 0 01-2 2h-13a2 2 0 01-2-2v-9z"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M3.5 9.5h17M7.5 14h3"
                            />
                        </svg>

                    </div>

                    <h3 class="mt-5 text-sm font-semibold text-white">
                        No payments found
                    </h3>

                    <p class="mx-auto mt-2 max-w-md text-sm text-[#6F757E]">
                        No payment records match the current filters.
                    </p>

                    <a
                        href="{{ route('finance.payments.create') }}"
                        class="mt-5 inline-flex items-center gap-2 rounded-xl bg-white px-4 py-2.5 text-sm font-semibold text-[#0B0D10] transition hover:bg-[#E8E8E5]"
                    >
                        <span>+</span>
                        Create Payment
                    </a>

                </div>

            @endif


            {{-- Pagination --}}
            @if ($payments->hasPages())

                <div class="border-t border-[#242830] px-6 py-5">
                    {{ $payments->links() }}
                </div>

            @endif

        </section>

    </div>
</x-app-layout>