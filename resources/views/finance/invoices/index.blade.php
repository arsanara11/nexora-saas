<x-app-layout>

    <div class="space-y-6">

        {{-- Header --}}
        <div class="flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between">

            <div>

                <p class="text-xs font-medium uppercase tracking-[0.18em] text-[#8B7CFF]">
                    Finance
                </p>

                <h1 class="mt-2 text-2xl font-semibold tracking-tight text-white">
                    Invoices
                </h1>

                <p class="mt-1 text-sm text-[#8B919A]">
                    Create, manage, and track customer invoices.
                </p>

            </div>


            <a
                href="{{ route('finance.invoices.create') }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#8B7CFF] px-4 py-2.5 text-sm font-medium text-white transition hover:bg-[#7869EE]"
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

                Create Invoice

            </a>

        </div>


        {{-- Success Message --}}
        @if (session('success'))

            <div class="rounded-xl border border-emerald-400/15 bg-emerald-400/10 px-5 py-4">

                <div class="flex items-center gap-3">

                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-emerald-400/10 text-emerald-300">

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

                    </div>

                    <p class="text-sm font-medium text-emerald-300">
                        {{ session('success') }}
                    </p>

                </div>

            </div>

        @endif


        {{-- Error Message --}}
        @if ($errors->any())

            <div class="rounded-xl border border-red-400/15 bg-red-400/10 px-5 py-4">

                <div class="flex items-start gap-3">

                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-red-400/10 text-red-300">
                        !
                    </div>

                    <div>

                        <p class="text-sm font-medium text-red-300">
                            Something went wrong.
                        </p>

                        <ul class="mt-2 space-y-1 text-xs text-red-200/80">

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


        {{-- Summary --}}
        @php

            $invoiceCollection = $invoices->getCollection();

            $totalVisible = $invoiceCollection->count();

            $draftCount = $invoiceCollection
                ->where('status', 'draft')
                ->count();

            $issuedCount = $invoiceCollection
                ->where('status', 'issued')
                ->count();

            $paidCount = $invoiceCollection
                ->where('status', 'paid')
                ->count();

            $outstandingCount = $invoiceCollection
                ->whereIn(
                    'status',
                    [
                        'issued',
                        'overdue',
                    ]
                )
                ->count();

        @endphp


        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">

            {{-- Visible Invoices --}}
            <div class="rounded-xl border border-[#242830] bg-[#12151A] p-5">

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-xs font-medium uppercase tracking-wider text-[#707782]">
                            Visible Invoices
                        </p>

                        <p class="mt-3 text-2xl font-semibold tracking-tight text-white">
                            {{ $totalVisible }}
                        </p>

                    </div>

                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-[#1C1930] text-[#9C91FF]">
                        ◫
                    </div>

                </div>

                <p class="mt-3 text-xs text-[#707782]">
                    Current page
                </p>

            </div>


            {{-- Draft --}}
            <div class="rounded-xl border border-[#242830] bg-[#12151A] p-5">

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-xs font-medium uppercase tracking-wider text-[#707782]">
                            Draft
                        </p>

                        <p class="mt-3 text-2xl font-semibold tracking-tight text-white">
                            {{ $draftCount }}
                        </p>

                    </div>

                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-[#1A1D22] text-[#8B919A]">
                        ○
                    </div>

                </div>

                <p class="mt-3 text-xs text-[#707782]">
                    Not issued yet
                </p>

            </div>


            {{-- Issued --}}
            <div class="rounded-xl border border-[#242830] bg-[#12151A] p-5">

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-xs font-medium uppercase tracking-wider text-[#707782]">
                            Issued
                        </p>

                        <p class="mt-3 text-2xl font-semibold tracking-tight text-white">
                            {{ $issuedCount }}
                        </p>

                    </div>

                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-[#17202C] text-[#9EB6E8]">
                        ◉
                    </div>

                </div>

                <p class="mt-3 text-xs text-[#707782]">
                    Awaiting payment
                </p>

            </div>


            {{-- Outstanding --}}
            <div class="rounded-xl border border-[#242830] bg-[#12151A] p-5">

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-xs font-medium uppercase tracking-wider text-[#707782]">
                            Outstanding
                        </p>

                        <p class="mt-3 text-2xl font-semibold tracking-tight text-white">
                            {{ $outstandingCount }}
                        </p>

                    </div>

                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-[#241D16] text-[#D9C57A]">
                        !
                    </div>

                </div>

                <p class="mt-3 text-xs text-[#707782]">
                    Issued or overdue
                </p>

            </div>

        </div>


        {{-- Invoice Table --}}
        <div class="overflow-hidden rounded-2xl border border-[#242830] bg-[#12151A]">

            {{-- Toolbar --}}
            <div class="border-b border-[#242830] px-6 py-5">

                <form
                    method="GET"
                    action="{{ route('finance.invoices.index') }}"
                    class="flex flex-col gap-4 xl:flex-row xl:items-center xl:justify-between"
                >

                    <div class="relative w-full xl:max-w-md">

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
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Search invoice, order, or customer..."
                            class="w-full rounded-xl border border-[#242830] bg-[#0B0D10] py-2.5 pl-9 pr-3 text-sm text-[#F5F5F2] outline-none placeholder:text-[#666C75] focus:border-[#8B7CFF]"
                        >

                    </div>


                    <div class="flex flex-col gap-3 sm:flex-row">

                        <select
                            name="status"
                            class="rounded-xl border border-[#242830] bg-[#0B0D10] px-4 py-2.5 text-sm text-[#C5CAD2] outline-none focus:border-[#8B7CFF]"
                        >

                            <option value="">
                                All statuses
                            </option>

                            <option
                                value="draft"
                                @selected(request('status') === 'draft')
                            >
                                Draft
                            </option>

                            <option
                                value="issued"
                                @selected(request('status') === 'issued')
                            >
                                Issued
                            </option>

                            <option
                                value="paid"
                                @selected(request('status') === 'paid')
                            >
                                Paid
                            </option>

                            <option
                                value="overdue"
                                @selected(request('status') === 'overdue')
                            >
                                Overdue
                            </option>

                            <option
                                value="cancelled"
                                @selected(request('status') === 'cancelled')
                            >
                                Cancelled
                            </option>

                        </select>


                        <button
                            type="submit"
                            class="inline-flex items-center justify-center gap-2 rounded-xl border border-[#242830] bg-[#171B21] px-4 py-2.5 text-sm font-medium text-[#C5CAD2] transition hover:border-[#4037A5] hover:text-white"
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
                                    d="M3 4h18M6 10h12M10 16h4"
                                />
                            </svg>

                            Filter

                        </button>


                        @if (
                            request()->filled('search')
                            || request()->filled('status')
                        )

                            <a
                                href="{{ route('finance.invoices.index') }}"
                                class="inline-flex items-center justify-center rounded-xl border border-[#242830] px-4 py-2.5 text-sm text-[#8B919A] transition hover:text-white"
                            >
                                Clear
                            </a>

                        @endif

                    </div>

                </form>

            </div>


            @if ($invoices->count())

                <div class="overflow-x-auto">

                    <table class="w-full min-w-[950px]">

                        <thead>

                            <tr class="border-b border-[#242830] bg-[#0E1116]">

                                <th class="px-6 py-4 text-left text-xs font-medium uppercase tracking-wider text-[#666C75]">
                                    Invoice
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-medium uppercase tracking-wider text-[#666C75]">
                                    Customer
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-medium uppercase tracking-wider text-[#666C75]">
                                    Order
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-medium uppercase tracking-wider text-[#666C75]">
                                    Due
                                </th>

                                <th class="px-6 py-4 text-right text-xs font-medium uppercase tracking-wider text-[#666C75]">
                                    Total
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-medium uppercase tracking-wider text-[#666C75]">
                                    Status
                                </th>

                                <th class="px-6 py-4 text-right text-xs font-medium uppercase tracking-wider text-[#666C75]">
                                    Action
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y divide-[#242830]">

                            @foreach ($invoices as $invoice)

                                @php

                                    $statusConfig = match ($invoice->status) {

                                        'draft' => [
                                            'label' => 'Draft',
                                            'class' => 'border-[#6C7480]/20 bg-[#6C7480]/10 text-[#9AA1AD]',
                                        ],

                                        'issued' => [
                                            'label' => 'Issued',
                                            'class' => 'border-[#9EB6E8]/20 bg-[#9EB6E8]/10 text-[#9EB6E8]',
                                        ],

                                        'paid' => [
                                            'label' => 'Paid',
                                            'class' => 'border-emerald-400/15 bg-emerald-400/10 text-emerald-300',
                                        ],

                                        'overdue' => [
                                            'label' => 'Overdue',
                                            'class' => 'border-red-400/15 bg-red-400/10 text-red-300',
                                        ],

                                        'cancelled' => [
                                            'label' => 'Cancelled',
                                            'class' => 'border-[#BBA8EA]/20 bg-[#BBA8EA]/10 text-[#BBA8EA]',
                                        ],

                                        default => [
                                            'label' => ucfirst($invoice->status),
                                            'class' => 'border-[#242830] bg-[#171B21] text-[#8B919A]',
                                        ],

                                    };

                                @endphp


                                <tr class="transition hover:bg-[#0E1116]">

                                    {{-- Invoice --}}
                                    <td class="px-6 py-4">

                                        <a
                                            href="{{ route('finance.invoices.show', $invoice) }}"
                                            class="group"
                                        >

                                            <p class="text-sm font-medium text-white transition group-hover:text-[#A79EFF]">
                                                {{ $invoice->invoice_number }}
                                            </p>

                                            <p class="mt-1 text-xs text-[#707782]">
                                                {{ $invoice->issued_at?->format('d M Y') ?? 'Not issued' }}
                                            </p>

                                        </a>

                                    </td>


                                    {{-- Customer --}}
                                    <td class="px-6 py-4">

                                        <p class="max-w-[220px] truncate text-sm text-[#C5CAD2]">
                                            {{ $invoice->order?->customer?->name ?? 'Unknown Customer' }}
                                        </p>

                                    </td>


                                    {{-- Order --}}
                                    <td class="px-6 py-4">

                                        @if ($invoice->order)

                                            <p class="text-sm text-[#C5CAD2]">
                                                {{ $invoice->order->order_number ?? '#' . $invoice->order->id }}
                                            </p>

                                        @else

                                            <span class="text-sm text-[#666C75]">
                                                —
                                            </span>

                                        @endif

                                    </td>


                                    {{-- Due --}}
                                    <td class="px-6 py-4">

                                        <p class="text-sm text-[#AEB4BE]">
                                            {{ $invoice->due_at?->format('d M Y') ?? '—' }}
                                        </p>

                                        @if (
                                            $invoice->due_at
                                            && $invoice->due_at->isPast()
                                            && $invoice->status !== 'paid'
                                            && $invoice->status !== 'cancelled'
                                        )

                                            <p class="mt-1 text-[11px] text-red-300">
                                                Past due
                                            </p>

                                        @endif

                                    </td>


                                    {{-- Total --}}
                                    <td class="px-6 py-4 text-right">

                                        <p class="text-sm font-medium text-[#F5F5F2]">
                                            Rp {{ number_format($invoice->total, 0, ',', '.') }}
                                        </p>

                                    </td>


                                    {{-- Status --}}
                                    <td class="px-6 py-4">

                                        <span
                                            class="inline-flex items-center gap-2 rounded-lg border px-2.5 py-1 text-xs font-medium {{ $statusConfig['class'] }}"
                                        >

                                            @if ($invoice->status === 'paid')

                                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>

                                            @elseif ($invoice->status === 'issued')

                                                <span class="h-1.5 w-1.5 rounded-full bg-[#9EB6E8]"></span>

                                            @elseif ($invoice->status === 'overdue')

                                                <span class="h-1.5 w-1.5 rounded-full bg-red-400"></span>

                                            @elseif ($invoice->status === 'cancelled')

                                                <span class="h-1.5 w-1.5 rounded-full bg-[#BBA8EA]"></span>

                                            @else

                                                <span class="h-1.5 w-1.5 rounded-full bg-[#707782]"></span>

                                            @endif

                                            {{ $statusConfig['label'] }}

                                        </span>

                                    </td>


                                    {{-- Action --}}
                                    <td class="px-6 py-4 text-right">

                                        <a
                                            href="{{ route('finance.invoices.show', $invoice) }}"
                                            class="inline-flex items-center gap-2 rounded-lg border border-[#242830] px-3 py-2 text-xs font-medium text-[#AEB3BB] transition hover:border-[#8B7CFF]/40 hover:text-[#F5F5F2]"
                                        >

                                            View

                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-3.5 w-3.5"
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

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>


                {{-- Pagination --}}
                <div class="border-t border-[#242830] px-6 py-5">

                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                        <p class="text-xs text-[#707782]">

                            Showing

                            <span class="font-medium text-[#AEB4BE]">
                                {{ $invoices->firstItem() ?? 0 }}
                            </span>

                            to

                            <span class="font-medium text-[#AEB4BE]">
                                {{ $invoices->lastItem() ?? 0 }}
                            </span>

                            of

                            <span class="font-medium text-[#AEB4BE]">
                                {{ $invoices->total() }}
                            </span>

                            invoices

                        </p>


                        <div class="flex items-center gap-2">

                            @if ($invoices->onFirstPage())

                                <span class="rounded-lg border border-[#242830] px-3 py-2 text-xs text-[#4F5661]">
                                    Previous
                                </span>

                            @else

                                <a
                                    href="{{ $invoices->previousPageUrl() }}"
                                    class="rounded-lg border border-[#242830] px-3 py-2 text-xs text-[#AEB4BE] transition hover:border-[#4037A5] hover:text-white"
                                >
                                    Previous
                                </a>

                            @endif


                            @foreach (
                                $invoices->getUrlRange(
                                    max(
                                        1,
                                        $invoices->currentPage() - 2
                                    ),
                                    min(
                                        $invoices->lastPage(),
                                        $invoices->currentPage() + 2
                                    )
                                ) as $page => $url
                            )

                                @if ($page == $invoices->currentPage())

                                    <span class="rounded-lg border border-[#4037A5] bg-[#25204D] px-3 py-2 text-xs font-medium text-white">
                                        {{ $page }}
                                    </span>

                                @else

                                    <a
                                        href="{{ $url }}"
                                        class="rounded-lg border border-[#242830] px-3 py-2 text-xs text-[#AEB4BE] transition hover:border-[#4037A5] hover:text-white"
                                    >
                                        {{ $page }}
                                    </a>

                                @endif

                            @endforeach


                            @if ($invoices->hasMorePages())

                                <a
                                    href="{{ $invoices->nextPageUrl() }}"
                                    class="rounded-lg border border-[#242830] px-3 py-2 text-xs text-[#AEB4BE] transition hover:border-[#4037A5] hover:text-white"
                                >
                                    Next
                                </a>

                            @else

                                <span class="rounded-lg border border-[#242830] px-3 py-2 text-xs text-[#4F5661]">
                                    Next
                                </span>

                            @endif

                        </div>

                    </div>

                </div>

            @else

                {{-- Empty State --}}
                <div class="px-6 py-20 text-center">

                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl border border-[#242830] bg-[#0B0D10] text-[#666C75]">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-7 w-7"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.6"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M7 3h10a2 2 0 012 2v14a2 2 0 01-2 2H7a2 2 0 01-2-2V5a2 2 0 012-2z"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M8.5 8h7M8.5 12h7M8.5 16h4"
                            />

                        </svg>

                    </div>


                    @if (
                        request()->filled('search')
                        || request()->filled('status')
                    )

                        <h3 class="mt-5 text-sm font-semibold text-[#F5F5F2]">
                            No matching invoices
                        </h3>

                        <p class="mx-auto mt-1 max-w-md text-sm text-[#707782]">
                            Try changing the search term or status filter.
                        </p>

                        <a
                            href="{{ route('finance.invoices.index') }}"
                            class="mt-5 inline-flex items-center rounded-xl border border-[#242830] px-4 py-2.5 text-sm font-medium text-[#AEB4BE] transition hover:border-[#4037A5] hover:text-white"
                        >
                            Clear filters
                        </a>

                    @else

                        <h3 class="mt-5 text-sm font-semibold text-[#F5F5F2]">
                            No invoices yet
                        </h3>

                        <p class="mx-auto mt-1 max-w-md text-sm text-[#707782]">
                            Create your first invoice from an existing sales order.
                        </p>

                        <a
                            href="{{ route('finance.invoices.create') }}"
                            class="mt-5 inline-flex items-center gap-2 rounded-xl bg-[#8B7CFF] px-4 py-2.5 text-sm font-medium text-white transition hover:bg-[#7869EE]"
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

                            Create Invoice

                        </a>

                    @endif

                </div>

            @endif

        </div>


        {{-- Back to Finance --}}
        <div>

            <a
                href="{{ route('finance.index') }}"
                class="inline-flex items-center gap-2 text-sm text-[#707782] transition hover:text-white"
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

                Back to Financial Overview

            </a>

        </div>

    </div>

</x-app-layout>