<x-app-layout>

    <div class="mx-auto w-full max-w-[1450px]">

        {{-- Breadcrumb --}}
        <div class="mb-7 flex items-center gap-2 px-1 text-sm">

            <a
                href="{{ route('finance.payments.index') }}"
                class="text-[#8B919A] transition hover:text-[#F5F5F2]"
            >
                Payments
            </a>

            <span class="text-[#3A3F48]">
                ›
            </span>

            <a
                href="{{ route('finance.payments.show', $payment) }}"
                class="text-[#8B919A] transition hover:text-[#F5F5F2]"
            >
                Payment Detail
            </a>

            <span class="text-[#3A3F48]">
                ›
            </span>

            <span class="text-[#F5F5F2]">
                Edit Payment
            </span>

        </div>


        {{-- Header --}}
        <div class="mb-8 flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">

            <div>

                <h1 class="text-3xl font-semibold tracking-tight text-[#F5F5F2]">
                    Edit Payment
                </h1>

                <p class="mt-2 text-sm text-[#8B919A]">
                    Update payment information and transaction status.
                </p>

            </div>


            <a
                href="{{ route('finance.payments.show', $payment) }}"
                class="inline-flex w-fit items-center rounded-xl border border-[#242830] bg-[#12151A] px-5 py-3 text-sm font-medium text-[#F5F5F2] transition hover:border-[#8B7CFF] hover:text-[#8B7CFF]"
            >
                ← Back to Payment
            </a>

        </div>


        {{-- Main Grid --}}
        <div class="grid grid-cols-1 gap-6 xl:grid-cols-[1.3fr_0.7fr]">


            {{-- LEFT --}}
            <div class="space-y-6">


                {{-- Payment Form --}}
                <div class="overflow-hidden rounded-2xl border border-[#242830] bg-[#12151A]">

                    <div class="border-b border-[#242830] px-8 py-7 lg:px-10">

                        <h2 class="text-lg font-semibold text-[#F5F5F2]">
                            Payment Information
                        </h2>

                        <p class="mt-2 text-sm text-[#8B919A]">
                            Modify the transaction details below.
                        </p>

                    </div>


                    <form
                        method="POST"
                        action="{{ route('finance.payments.update', $payment) }}"
                    >

                        @csrf
                        @method('PUT')


                        <div class="space-y-8 px-8 py-8 lg:px-10">


                            {{-- Invoice --}}
                            <div>

                                <label
                                    for="invoice"
                                    class="mb-2 block text-xs font-medium uppercase tracking-[0.14em] text-[#8B919A]"
                                >
                                    Invoice
                                </label>

                                <div
                                    class="rounded-xl border border-[#242830] bg-[#0B0D10] px-5 py-4"
                                >

                                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

                                        <div>

                                            @if ($payment->invoice)

                                                <a
                                                    href="{{ route('finance.invoices.show', $payment->invoice) }}"
                                                    class="text-base font-semibold text-[#A99FFF] transition hover:text-[#C2BBFF]"
                                                >
                                                    {{ $payment->invoice->invoice_number }}
                                                </a>

                                                <p class="mt-1 text-sm text-[#8B919A]">
                                                    {{ $payment->invoice->order?->customer?->name ?? 'No customer assigned' }}
                                                </p>

                                            @else

                                                <p class="text-sm text-[#8B919A]">
                                                    No invoice information available.
                                                </p>

                                            @endif

                                        </div>


                                        @if ($payment->invoice)

                                            @php
                                                $invoiceStatusClasses = match ($payment->invoice->status) {
                                                    'paid' => 'border-emerald-500/30 bg-emerald-500/10 text-emerald-400',
                                                    'issued' => 'border-[#8B7CFF]/30 bg-[#8B7CFF]/10 text-[#A99FFF]',
                                                    'overdue' => 'border-amber-500/30 bg-amber-500/10 text-amber-400',
                                                    'cancelled' => 'border-rose-500/30 bg-rose-500/10 text-rose-400',
                                                    default => 'border-[#242830] bg-[#12151A] text-[#8B919A]',
                                                };
                                            @endphp

                                            <span
                                                class="inline-flex w-fit rounded-full border px-3 py-1.5 text-[11px] font-semibold uppercase tracking-[0.12em] {{ $invoiceStatusClasses }}"
                                            >
                                                {{ ucfirst($payment->invoice->status) }}
                                            </span>

                                        @endif

                                    </div>

                                </div>

                                <p class="mt-2 text-xs text-[#666C75]">
                                    The invoice linked to this payment cannot be changed here.
                                </p>

                            </div>


                            {{-- Amount --}}
                            <div>

                                <label
                                    for="amount"
                                    class="mb-2 block text-xs font-medium uppercase tracking-[0.14em] text-[#8B919A]"
                                >
                                    Payment Amount
                                </label>

                                <div class="relative">

                                    <span class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-sm text-[#666C75]">
                                        Rp
                                    </span>

                                    <input
                                        id="amount"
                                        type="number"
                                        name="amount"
                                        min="0.01"
                                        step="0.01"
                                        value="{{ old('amount', $payment->amount) }}"
                                        required
                                        class="block w-full rounded-xl border border-[#242830] bg-[#0B0D10] py-3.5 pl-12 pr-4 text-sm text-[#F5F5F2] outline-none transition placeholder:text-[#555B65] focus:border-[#8B7CFF] focus:ring-1 focus:ring-[#8B7CFF]"
                                        placeholder="100000"
                                    />

                                </div>

                                @error('amount')

                                    <p class="mt-2 text-xs text-rose-400">
                                        {{ $message }}
                                    </p>

                                @enderror

                            </div>


                            {{-- Method --}}
                            <div>

                                <label
                                    for="method"
                                    class="mb-2 block text-xs font-medium uppercase tracking-[0.14em] text-[#8B919A]"
                                >
                                    Payment Method
                                </label>

                                <select
                                    id="method"
                                    name="method"
                                    required
                                    class="block w-full rounded-xl border border-[#242830] bg-[#0B0D10] px-4 py-3.5 text-sm text-[#F5F5F2] outline-none transition focus:border-[#8B7CFF] focus:ring-1 focus:ring-[#8B7CFF]"
                                >

                                    @php
                                        $methods = [
                                            'cash' => 'Cash',
                                            'bank_transfer' => 'Bank Transfer',
                                            'credit_card' => 'Credit Card',
                                            'debit_card' => 'Debit Card',
                                            'e_wallet' => 'E-Wallet',
                                        ];
                                    @endphp

                                    @foreach ($methods as $value => $label)

                                        <option
                                            value="{{ $value }}"
                                            @selected(old('method', $payment->method) === $value)
                                        >
                                            {{ $label }}
                                        </option>

                                    @endforeach

                                    @if (
                                        $payment->method &&
                                        !array_key_exists($payment->method, $methods)
                                    )

                                        <option
                                            value="{{ $payment->method }}"
                                            selected
                                        >
                                            {{ ucwords(str_replace('_', ' ', $payment->method)) }}
                                        </option>

                                    @endif

                                </select>

                                @error('method')

                                    <p class="mt-2 text-xs text-rose-400">
                                        {{ $message }}
                                    </p>

                                @enderror

                            </div>


                            {{-- Status --}}
                            <div>

                                <label
                                    for="status"
                                    class="mb-2 block text-xs font-medium uppercase tracking-[0.14em] text-[#8B919A]"
                                >
                                    Payment Status
                                </label>

                                <select
                                    id="status"
                                    name="status"
                                    required
                                    class="block w-full rounded-xl border border-[#242830] bg-[#0B0D10] px-4 py-3.5 text-sm text-[#F5F5F2] outline-none transition focus:border-[#8B7CFF] focus:ring-1 focus:ring-[#8B7CFF]"
                                >

                                    <option
                                        value="pending"
                                        @selected(old('status', $payment->status) === 'pending')
                                    >
                                        Pending
                                    </option>

                                    <option
                                        value="paid"
                                        @selected(old('status', $payment->status) === 'paid')
                                    >
                                        Paid
                                    </option>

                                    <option
                                        value="failed"
                                        @selected(old('status', $payment->status) === 'failed')
                                    >
                                        Failed
                                    </option>

                                    <option
                                        value="refunded"
                                        @selected(old('status', $payment->status) === 'refunded')
                                    >
                                        Refunded
                                    </option>

                                </select>

                                @error('status')

                                    <p class="mt-2 text-xs text-rose-400">
                                        {{ $message }}
                                    </p>

                                @enderror

                            </div>


                            {{-- Submit --}}
                            <div class="flex flex-col gap-3 border-t border-[#242830] pt-7 sm:flex-row sm:justify-end">

                                <a
                                    href="{{ route('finance.payments.show', $payment) }}"
                                    class="inline-flex items-center justify-center rounded-xl border border-[#242830] bg-[#0B0D10] px-6 py-3.5 text-sm font-medium text-[#F5F5F2] transition hover:border-[#8B7CFF] hover:text-[#8B7CFF]"
                                >
                                    Cancel
                                </a>


                                <button
                                    type="submit"
                                    class="inline-flex items-center justify-center rounded-xl bg-[#8B7CFF] px-7 py-3.5 text-sm font-medium text-white transition hover:bg-[#796AF0]"
                                >
                                    Save Changes
                                </button>

                            </div>

                        </div>

                    </form>

                </div>


                {{-- Status Guide --}}
                <div class="rounded-2xl border border-[#242830] bg-[#12151A] p-8 lg:p-10">

                    <div class="mb-6">

                        <h2 class="text-lg font-semibold text-[#F5F5F2]">
                            Payment Status Guide
                        </h2>

                        <p class="mt-2 text-sm text-[#8B919A]">
                            Understand how each status affects the transaction.
                        </p>

                    </div>


                    <div class="space-y-4">


                        {{-- Pending --}}
                        <div class="flex items-start gap-4 rounded-xl border border-[#242830] bg-[#0B0D10] p-5">

                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full border border-amber-500/30 bg-amber-500/10 text-sm text-amber-400">
                                •
                            </div>

                            <div>

                                <p class="text-sm font-semibold text-[#F5F5F2]">
                                    Pending
                                </p>

                                <p class="mt-1 text-xs leading-5 text-[#8B919A]">
                                    The payment has been recorded but has not been completed yet.
                                </p>

                            </div>

                        </div>


                        {{-- Paid --}}
                        <div class="flex items-start gap-4 rounded-xl border border-[#242830] bg-[#0B0D10] p-5">

                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full border border-emerald-500/30 bg-emerald-500/10 text-sm text-emerald-400">
                                ✓
                            </div>

                            <div>

                                <p class="text-sm font-semibold text-[#F5F5F2]">
                                    Paid
                                </p>

                                <p class="mt-1 text-xs leading-5 text-[#8B919A]">
                                    Marks the payment as successfully received. The related invoice may automatically become paid when its balance is fully covered.
                                </p>

                            </div>

                        </div>


                        {{-- Failed --}}
                        <div class="flex items-start gap-4 rounded-xl border border-[#242830] bg-[#0B0D10] p-5">

                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full border border-rose-500/30 bg-rose-500/10 text-sm text-rose-400">
                                !
                            </div>

                            <div>

                                <p class="text-sm font-semibold text-[#F5F5F2]">
                                    Failed
                                </p>

                                <p class="mt-1 text-xs leading-5 text-[#8B919A]">
                                    Indicates that the payment attempt was unsuccessful.
                                </p>

                            </div>

                        </div>


                        {{-- Refunded --}}
                        <div class="flex items-start gap-4 rounded-xl border border-[#242830] bg-[#0B0D10] p-5">

                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full border border-sky-500/30 bg-sky-500/10 text-sm text-sky-400">
                                ↺
                            </div>

                            <div>

                                <p class="text-sm font-semibold text-[#F5F5F2]">
                                    Refunded
                                </p>

                                <p class="mt-1 text-xs leading-5 text-[#8B919A]">
                                    Indicates that the recorded payment amount has been returned or reversed.
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- RIGHT --}}
            <div class="space-y-6">


                {{-- Current Payment --}}
                <div class="overflow-hidden rounded-2xl border border-[#242830] bg-[#12151A]">

                    <div class="border-b border-[#242830] px-8 py-7">

                        <p class="text-xs font-medium uppercase tracking-[0.16em] text-[#8B919A]">
                            Current Payment
                        </p>

                        <p class="mt-3 text-3xl font-semibold tracking-tight text-[#F5F5F2]">
                            Rp {{ number_format((float) $payment->amount, 0, ',', '.') }}
                        </p>

                    </div>


                    <div class="space-y-6 px-8 py-8">


                        {{-- Invoice --}}
                        <div>

                            <p class="text-xs uppercase tracking-[0.14em] text-[#666C75]">
                                Invoice
                            </p>

                            <p class="mt-2 text-sm font-semibold text-[#F5F5F2]">
                                {{ $payment->invoice?->invoice_number ?? '—' }}
                            </p>

                        </div>


                        {{-- Customer --}}
                        <div>

                            <p class="text-xs uppercase tracking-[0.14em] text-[#666C75]">
                                Customer
                            </p>

                            <p class="mt-2 text-sm font-medium text-[#F5F5F2]">
                                {{ $payment->invoice?->order?->customer?->name ?? '—' }}
                            </p>

                        </div>


                        {{-- Method --}}
                        <div>

                            <p class="text-xs uppercase tracking-[0.14em] text-[#666C75]">
                                Current Method
                            </p>

                            <p class="mt-2 text-sm font-medium text-[#F5F5F2]">
                                {{ ucwords(str_replace('_', ' ', $payment->method)) }}
                            </p>

                        </div>


                        {{-- Status --}}
                        <div>

                            <p class="text-xs uppercase tracking-[0.14em] text-[#666C75]">
                                Current Status
                            </p>

                            <p class="mt-2 text-sm font-medium text-[#F5F5F2]">
                                {{ ucfirst($payment->status) }}
                            </p>

                        </div>


                        {{-- Created --}}
                        <div class="border-t border-[#242830] pt-6">

                            <p class="text-xs uppercase tracking-[0.14em] text-[#666C75]">
                                Created
                            </p>

                            <p class="mt-2 text-sm text-[#8B919A]">
                                {{ $payment->created_at?->format('d M Y, H:i') ?? '—' }}
                            </p>

                        </div>


                        {{-- Paid At --}}
                        <div>

                            <p class="text-xs uppercase tracking-[0.14em] text-[#666C75]">
                                Paid At
                            </p>

                            <p class="mt-2 text-sm text-[#8B919A]">
                                {{ $payment->paid_at?->format('d M Y, H:i') ?? '—' }}
                            </p>

                        </div>

                    </div>

                </div>


                {{-- Warning --}}
                <div class="rounded-2xl border border-amber-500/20 bg-amber-500/[0.03] p-8">

                    <div class="flex items-start gap-4">

                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full border border-amber-500/20 bg-amber-500/10 text-sm text-amber-400">
                            !
                        </div>


                        <div>

                            <h2 class="text-base font-semibold text-[#F5F5F2]">
                                Important
                            </h2>

                            <p class="mt-2 text-sm leading-6 text-[#8B919A]">
                                Changing the payment status or amount can affect the status of the related invoice.
                            </p>

                        </div>

                    </div>

                </div>


                {{-- Danger Zone --}}
                <div class="rounded-2xl border border-rose-500/20 bg-rose-500/[0.03] p-8">

                    <div class="flex items-start gap-4">

                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full border border-rose-500/20 bg-rose-500/10 text-sm text-rose-400">
                            !
                        </div>


                        <div>

                            <h2 class="text-base font-semibold text-[#F5F5F2]">
                                Danger Zone
                            </h2>

                            <p class="mt-2 text-sm leading-6 text-[#8B919A]">
                                Deleting this payment will remove the transaction record and may change the related invoice status.
                            </p>

                        </div>

                    </div>


                    <form
                        method="POST"
                        action="{{ route('finance.payments.destroy', $payment) }}"
                        class="mt-7"
                        onsubmit="return confirm('Delete this payment? This action cannot be undone.');"
                    >

                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="w-full rounded-xl border border-rose-500/30 bg-rose-500/10 px-5 py-3.5 text-sm font-medium text-rose-400 transition hover:border-rose-500/50 hover:bg-rose-500/15"
                        >
                            Delete Payment
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>