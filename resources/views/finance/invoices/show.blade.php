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

                    <a
                        href="{{ route('finance.invoices.index') }}"
                        class="transition hover:text-white"
                    >
                        Invoices
                    </a>

                    <span class="text-[#4A4F57]">/</span>

                    <span class="text-white">
                        {{ $invoice->invoice_number }}
                    </span>
                </div>

                <div class="flex flex-wrap items-center gap-3">
                    <h1 class="text-2xl font-semibold tracking-tight text-white">
                        {{ $invoice->invoice_number }}
                    </h1>

                    @php
                        $statusStyles = [
                            'draft' => 'border-[#8B7CFF]/20 bg-[#8B7CFF]/10 text-[#C9C2FF]',
                            'issued' => 'border-blue-400/20 bg-blue-400/10 text-blue-300',
                            'overdue' => 'border-amber-400/20 bg-amber-400/10 text-amber-300',
                            'paid' => 'border-emerald-400/20 bg-emerald-400/10 text-emerald-300',
                            'cancelled' => 'border-red-400/20 bg-red-400/10 text-red-300',
                        ];

                        $statusClass = $statusStyles[$invoice->status] ?? 'border-[#242830] bg-[#12151A] text-[#B8BDC5]';
                    @endphp

                    <span class="rounded-full border px-3 py-1 text-xs font-medium uppercase tracking-[0.08em] {{ $statusClass }}">
                        {{ ucfirst($invoice->status) }}
                    </span>
                </div>

                <p class="mt-1 text-sm text-[#8B919A]">
                    Invoice details, financial summary, and payment history.
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-3">
                <a
                    href="{{ route('finance.invoices.index') }}"
                    class="inline-flex items-center gap-2 rounded-xl border border-[#242830] bg-[#12151A] px-4 py-2.5 text-sm font-medium text-[#D8DCE2] transition hover:border-[#343943] hover:bg-[#171A20] hover:text-white"
                >
                    <span>←</span>
                    Back to Invoices
                </a>

                @if (in_array($invoice->status, ['draft', 'issued', 'overdue']))
                    <a
                        href="{{ route('finance.invoices.edit', $invoice) }}"
                        class="inline-flex items-center gap-2 rounded-xl bg-white px-4 py-2.5 text-sm font-semibold text-[#0B0D10] transition hover:bg-[#E8E8E5]"
                    >
                        Edit Invoice
                    </a>
                @endif
            </div>
        </div>

        {{-- Flash Messages --}}
        @if (session('success'))
            <div class="rounded-2xl border border-emerald-400/20 bg-emerald-400/10 px-5 py-4 text-sm text-emerald-300">
                {{ session('success') }}
            </div>
        @endif

        {{-- Main --}}
        <div class="grid grid-cols-1 gap-6 xl:grid-cols-[minmax(0,1fr)_360px]">

            {{-- Left --}}
            <div class="space-y-6">

                {{-- Invoice Information --}}
                <section class="rounded-2xl border border-[#242830] bg-[#12151A] p-6">
                    <div class="mb-5 flex items-center justify-between gap-4">
                        <div>
                            <h2 class="text-sm font-semibold text-white">
                                Invoice Information
                            </h2>

                            <p class="mt-1 text-xs text-[#8B919A]">
                                Basic information about this invoice.
                            </p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">

                        <div>
                            <div class="text-[10px] font-semibold uppercase tracking-[0.14em] text-[#6F757E]">
                                Invoice Number
                            </div>

                            <div class="mt-1 text-sm font-medium text-white">
                                {{ $invoice->invoice_number }}
                            </div>
                        </div>

                        <div>
                            <div class="text-[10px] font-semibold uppercase tracking-[0.14em] text-[#6F757E]">
                                Sales Order
                            </div>

                            <div class="mt-1 text-sm font-medium text-white">
                                {{ optional($invoice->order)->order_number ?? '—' }}
                            </div>
                        </div>

                        <div>
                            <div class="text-[10px] font-semibold uppercase tracking-[0.14em] text-[#6F757E]">
                                Customer
                            </div>

                            <div class="mt-1 text-sm font-medium text-white">
                                {{ optional(optional($invoice->order)->customer)->name ?? 'Walk-in Customer' }}
                            </div>
                        </div>

                        <div>
                            <div class="text-[10px] font-semibold uppercase tracking-[0.14em] text-[#6F757E]">
                                Issued At
                            </div>

                            <div class="mt-1 text-sm font-medium text-white">
                                {{ $invoice->issued_at ? $invoice->issued_at->format('d M Y, H:i') : '—' }}
                            </div>
                        </div>

                        <div>
                            <div class="text-[10px] font-semibold uppercase tracking-[0.14em] text-[#6F757E]">
                                Due Date
                            </div>

                            <div class="mt-1 text-sm font-medium text-white">
                                {{ $invoice->due_at ? $invoice->due_at->format('d M Y') : '—' }}
                            </div>
                        </div>

                        <div>
                            <div class="text-[10px] font-semibold uppercase tracking-[0.14em] text-[#6F757E]">
                                Paid At
                            </div>

                            <div class="mt-1 text-sm font-medium text-white">
                                {{ $invoice->paid_at ? $invoice->paid_at->format('d M Y, H:i') : '—' }}
                            </div>
                        </div>

                    </div>
                </section>

                {{-- Financial Breakdown --}}
                <section class="rounded-2xl border border-[#242830] bg-[#12151A] p-6">
                    <div class="mb-5">
                        <h2 class="text-sm font-semibold text-white">
                            Financial Breakdown
                        </h2>

                        <p class="mt-1 text-xs text-[#8B919A]">
                            Complete calculation for this invoice.
                        </p>
                    </div>

                    <div class="space-y-4">

                        <div class="flex items-center justify-between gap-6">
                            <span class="text-sm text-[#8B919A]">
                                Subtotal
                            </span>

                            <span class="text-sm font-medium text-white">
                                Rp {{ number_format((float) $invoice->subtotal, 0, ',', '.') }}
                            </span>
                        </div>

                        <div class="flex items-center justify-between gap-6">
                            <span class="text-sm text-[#8B919A]">
                                Discount
                            </span>

                            <span class="text-sm font-medium text-white">
                                Rp {{ number_format((float) $invoice->discount, 0, ',', '.') }}
                            </span>
                        </div>

                        <div class="flex items-center justify-between gap-6">
                            <span class="text-sm text-[#8B919A]">
                                Tax
                            </span>

                            <span class="text-sm font-medium text-white">
                                Rp {{ number_format((float) $invoice->tax, 0, ',', '.') }}
                            </span>
                        </div>

                        <div class="flex items-center justify-between gap-6">
                            <span class="text-sm text-[#8B919A]">
                                Shipping
                            </span>

                            <span class="text-sm font-medium text-white">
                                Rp {{ number_format((float) $invoice->shipping_cost, 0, ',', '.') }}
                            </span>
                        </div>

                        <div class="border-t border-[#242830] pt-4">
                            <div class="flex items-end justify-between gap-6">
                                <span class="text-sm font-semibold text-white">
                                    Total
                                </span>

                                <span class="text-2xl font-semibold tracking-tight text-[#C9C2FF]">
                                    Rp {{ number_format((float) $invoice->total, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>

                    </div>
                </section>

                {{-- Notes --}}
                @if ($invoice->notes)
                    <section class="rounded-2xl border border-[#242830] bg-[#12151A] p-6">
                        <div class="mb-4">
                            <h2 class="text-sm font-semibold text-white">
                                Notes
                            </h2>
                        </div>

                        <div class="rounded-xl border border-[#242830] bg-[#0B0D10] px-4 py-4 text-sm leading-6 text-[#B8BDC5]">
                            {!! nl2br(e($invoice->notes)) !!}
                        </div>
                    </section>
                @endif

                {{-- Payments --}}
                <section class="rounded-2xl border border-[#242830] bg-[#12151A] p-6">
                    <div class="mb-5">
                        <h2 class="text-sm font-semibold text-white">
                            Payment History
                        </h2>

                        <p class="mt-1 text-xs text-[#8B919A]">
                            Payments associated with this invoice.
                        </p>
                    </div>

                    @if ($invoice->payments->count())
                        <div class="overflow-x-auto">
                            <table class="w-full min-w-[650px]">
                                <thead>
                                    <tr class="border-b border-[#242830]">
                                        <th class="pb-3 text-left text-[10px] font-semibold uppercase tracking-[0.14em] text-[#6F757E]">
                                            Date
                                        </th>

                                        <th class="pb-3 text-left text-[10px] font-semibold uppercase tracking-[0.14em] text-[#6F757E]">
                                            Method
                                        </th>

                                        <th class="pb-3 text-left text-[10px] font-semibold uppercase tracking-[0.14em] text-[#6F757E]">
                                            Status
                                        </th>

                                        <th class="pb-3 text-right text-[10px] font-semibold uppercase tracking-[0.14em] text-[#6F757E]">
                                            Amount
                                        </th>
                                    </tr>
                                </thead>

                                <tbody class="divide-y divide-[#1D2127]">
                                    @foreach ($invoice->payments as $payment)
                                        @php
                                            $paymentStatus = data_get($payment, 'status', 'unknown');

                                            $paymentStatusClass = match ($paymentStatus) {
                                                'paid' => 'border-emerald-400/20 bg-emerald-400/10 text-emerald-300',
                                                'pending' => 'border-amber-400/20 bg-amber-400/10 text-amber-300',
                                                'failed' => 'border-red-400/20 bg-red-400/10 text-red-300',
                                                'refunded' => 'border-blue-400/20 bg-blue-400/10 text-blue-300',
                                                default => 'border-[#242830] bg-[#0B0D10] text-[#8B919A]',
                                            };
                                        @endphp

                                        <tr>
                                            <td class="py-4 text-sm text-[#B8BDC5]">
                                                @php
                                                    $paymentDate = data_get($payment, 'paid_at')
                                                        ?? data_get($payment, 'created_at');
                                                @endphp

                                                {{ $paymentDate ? \Carbon\Carbon::parse($paymentDate)->format('d M Y, H:i') : '—' }}
                                            </td>

                                            <td class="py-4 text-sm text-white">
                                                {{ ucfirst(str_replace('_', ' ', data_get($payment, 'method', '—'))) }}
                                            </td>

                                            <td class="py-4">
                                                <span class="inline-flex rounded-full border px-2.5 py-1 text-[10px] font-medium uppercase tracking-[0.08em] {{ $paymentStatusClass }}">
                                                    {{ ucfirst($paymentStatus) }}
                                                </span>
                                            </td>

                                            <td class="py-4 text-right text-sm font-medium text-white">
                                                Rp {{ number_format((float) data_get($payment, 'amount', 0), 0, ',', '.') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="rounded-xl border border-dashed border-[#2A2E35] bg-[#0B0D10] px-5 py-8 text-center">
                            <div class="text-sm font-medium text-[#B8BDC5]">
                                No payments recorded
                            </div>

                            <p class="mt-1 text-xs text-[#6F757E]">
                                Payment history will appear here once a payment is recorded.
                            </p>
                        </div>
                    @endif
                </section>

            </div>

            {{-- Right --}}
            <div class="space-y-6">

                {{-- Total Card --}}
                <section class="rounded-2xl border border-[#242830] bg-[#12151A] p-6">
                    <div class="text-xs font-medium uppercase tracking-[0.14em] text-[#8B919A]">
                        Invoice Total
                    </div>

                    <div class="mt-2 text-3xl font-semibold tracking-tight text-white">
                        Rp {{ number_format((float) $invoice->total, 0, ',', '.') }}
                    </div>

                    <div class="mt-4 flex items-center justify-between border-t border-[#242830] pt-4">
                        <span class="text-sm text-[#8B919A]">
                            Status
                        </span>

                        <span class="text-sm font-medium capitalize text-white">
                            {{ $invoice->status }}
                        </span>
                    </div>
                </section>

                {{-- Status Actions --}}
                <section class="rounded-2xl border border-[#242830] bg-[#12151A] p-6">
                    <div class="mb-5">
                        <h2 class="text-sm font-semibold text-white">
                            Status Actions
                        </h2>

                        <p class="mt-1 text-xs text-[#8B919A]">
                            Update the current invoice status.
                        </p>
                    </div>

                    <div class="space-y-3">

                        @if ($invoice->status === 'draft')
                            <form
                                method="POST"
                                action="{{ route('finance.invoices.status', $invoice) }}"
                            >
                                @csrf
                                @method('PATCH')

                                <input
                                    type="hidden"
                                    name="status"
                                    value="issued"
                                >

                                <button
                                    type="submit"
                                    class="w-full rounded-xl bg-white px-4 py-3 text-sm font-semibold text-[#0B0D10] transition hover:bg-[#E8E8E5]"
                                >
                                    Issue Invoice
                                </button>
                            </form>

                            <form
                                method="POST"
                                action="{{ route('finance.invoices.status', $invoice) }}"
                            >
                                @csrf
                                @method('PATCH')

                                <input
                                    type="hidden"
                                    name="status"
                                    value="cancelled"
                                >

                                <button
                                    type="submit"
                                    class="w-full rounded-xl border border-red-400/20 bg-red-400/10 px-4 py-3 text-sm font-medium text-red-300 transition hover:bg-red-400/15"
                                >
                                    Cancel Invoice
                                </button>
                            </form>
                        @endif

                        @if ($invoice->status === 'issued')
                            <form
                                method="POST"
                                action="{{ route('finance.invoices.status', $invoice) }}"
                            >
                                @csrf
                                @method('PATCH')

                                <input
                                    type="hidden"
                                    name="status"
                                    value="paid"
                                >

                                <button
                                    type="submit"
                                    class="w-full rounded-xl bg-emerald-400 px-4 py-3 text-sm font-semibold text-[#07110B] transition hover:bg-emerald-300"
                                >
                                    Mark as Paid
                                </button>
                            </form>

                            <form
                                method="POST"
                                action="{{ route('finance.invoices.status', $invoice) }}"
                            >
                                @csrf
                                @method('PATCH')

                                <input
                                    type="hidden"
                                    name="status"
                                    value="overdue"
                                >

                                <button
                                    type="submit"
                                    class="w-full rounded-xl border border-amber-400/20 bg-amber-400/10 px-4 py-3 text-sm font-medium text-amber-300 transition hover:bg-amber-400/15"
                                >
                                    Mark as Overdue
                                </button>
                            </form>

                            <form
                                method="POST"
                                action="{{ route('finance.invoices.status', $invoice) }}"
                            >
                                @csrf
                                @method('PATCH')

                                <input
                                    type="hidden"
                                    name="status"
                                    value="cancelled"
                                >

                                <button
                                    type="submit"
                                    class="w-full rounded-xl border border-red-400/20 bg-red-400/10 px-4 py-3 text-sm font-medium text-red-300 transition hover:bg-red-400/15"
                                >
                                    Cancel Invoice
                                </button>
                            </form>
                        @endif

                        @if ($invoice->status === 'overdue')
                            <form
                                method="POST"
                                action="{{ route('finance.invoices.status', $invoice) }}"
                            >
                                @csrf
                                @method('PATCH')

                                <input
                                    type="hidden"
                                    name="status"
                                    value="paid"
                                >

                                <button
                                    type="submit"
                                    class="w-full rounded-xl bg-emerald-400 px-4 py-3 text-sm font-semibold text-[#07110B] transition hover:bg-emerald-300"
                                >
                                    Mark as Paid
                                </button>
                            </form>

                            <form
                                method="POST"
                                action="{{ route('finance.invoices.status', $invoice) }}"
                            >
                                @csrf
                                @method('PATCH')

                                <input
                                    type="hidden"
                                    name="status"
                                    value="cancelled"
                                >

                                <button
                                    type="submit"
                                    class="w-full rounded-xl border border-red-400/20 bg-red-400/10 px-4 py-3 text-sm font-medium text-red-300 transition hover:bg-red-400/15"
                                >
                                    Cancel Invoice
                                </button>
                            </form>
                        @endif

                        @if ($invoice->status === 'paid')
                            <div class="rounded-xl border border-emerald-400/20 bg-emerald-400/10 px-4 py-4 text-center">
                                <div class="text-sm font-semibold text-emerald-300">
                                    Invoice Paid
                                </div>

                                <p class="mt-1 text-xs text-emerald-200/70">
                                    This invoice has already been marked as paid.
                                </p>
                            </div>
                        @endif

                        @if ($invoice->status === 'cancelled')
                            <div class="rounded-xl border border-red-400/20 bg-red-400/10 px-4 py-4 text-center">
                                <div class="text-sm font-semibold text-red-300">
                                    Invoice Cancelled
                                </div>

                                <p class="mt-1 text-xs text-red-200/70">
                                    No further status changes are available.
                                </p>
                            </div>
                        @endif

                    </div>
                </section>

                {{-- Delete --}}
                @if ($invoice->status === 'draft')
                    <section class="rounded-2xl border border-red-400/20 bg-[#12151A] p-6">
                        <div class="mb-4">
                            <h2 class="text-sm font-semibold text-white">
                                Danger Zone
                            </h2>

                            <p class="mt-1 text-xs leading-5 text-[#8B919A]">
                                Draft invoices can be permanently deleted.
                            </p>
                        </div>

                        <form
                            method="POST"
                            action="{{ route('finance.invoices.destroy', $invoice) }}"
                            onsubmit="return confirm('Delete this draft invoice? This action cannot be undone.');"
                        >
                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="w-full rounded-xl border border-red-400/20 bg-red-400/10 px-4 py-3 text-sm font-medium text-red-300 transition hover:bg-red-400/15"
                            >
                                Delete Invoice
                            </button>
                        </form>
                    </section>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>