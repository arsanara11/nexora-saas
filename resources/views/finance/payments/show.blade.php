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

            <span class="text-[#F5F5F2]">
                Payment Detail
            </span>

        </div>


        {{-- Header --}}
        <div class="mb-8 flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">

            <div>

                <h1 class="text-3xl font-semibold tracking-tight text-[#F5F5F2]">
                    Payment Detail
                </h1>

                <p class="mt-2 text-sm text-[#8B919A]">
                    Review payment information and transaction status.
                </p>

            </div>


            <div class="flex flex-wrap items-center gap-3">

                <a
                    href="{{ route('finance.payments.index') }}"
                    class="rounded-xl border border-[#242830] bg-[#12151A] px-5 py-3 text-sm font-medium text-[#F5F5F2] transition hover:border-[#8B7CFF] hover:text-[#8B7CFF]"
                >
                    ← Back to Payments
                </a>

                <a
                    href="{{ route('finance.payments.edit', $payment) }}"
                    class="rounded-xl bg-[#8B7CFF] px-5 py-3 text-sm font-medium text-white transition hover:bg-[#796AF0]"
                >
                    Edit Payment
                </a>

            </div>

        </div>


        {{-- Main Grid --}}
        <div class="grid grid-cols-1 gap-6 xl:grid-cols-[1.35fr_0.65fr]">


            {{-- LEFT COLUMN --}}
            <div class="space-y-6">


                {{-- Payment Overview --}}
                <div class="overflow-hidden rounded-2xl border border-[#242830] bg-[#12151A]">

                    <div class="border-b border-[#242830] px-8 py-8 lg:px-10">

                        <p class="text-xs font-medium uppercase tracking-[0.18em] text-[#8B919A]">
                            Payment Overview
                        </p>


                        <div class="mt-5 flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">

                            <div>

                                <p class="text-sm text-[#666C75]">
                                    Payment Amount
                                </p>

                                <p class="mt-2 text-4xl font-semibold tracking-tight text-[#F5F5F2]">
                                    Rp {{ number_format((float) $payment->amount, 0, ',', '.') }}
                                </p>

                            </div>


                            @php
                                $statusClasses = match ($payment->status) {
                                    'paid' => 'border-emerald-500/30 bg-emerald-500/10 text-emerald-400',
                                    'pending' => 'border-amber-500/30 bg-amber-500/10 text-amber-400',
                                    'failed' => 'border-rose-500/30 bg-rose-500/10 text-rose-400',
                                    'refunded' => 'border-sky-500/30 bg-sky-500/10 text-sky-400',
                                    default => 'border-[#242830] bg-[#0B0D10] text-[#8B919A]',
                                };
                            @endphp


                            <span
                                class="inline-flex w-fit rounded-full border px-4 py-2 text-xs font-semibold uppercase tracking-[0.12em] {{ $statusClasses }}"
                            >
                                {{ ucfirst($payment->status) }}
                            </span>

                        </div>

                    </div>


                    <div class="grid grid-cols-1 divide-y divide-[#242830] md:grid-cols-2 md:divide-x md:divide-y-0">

                        <div class="px-8 py-7 lg:px-10">

                            <p class="text-xs uppercase tracking-[0.14em] text-[#666C75]">
                                Payment Method
                            </p>

                            <p class="mt-3 text-base font-medium text-[#F5F5F2]">
                                {{ ucwords(str_replace('_', ' ', $payment->method)) }}
                            </p>

                        </div>


                        <div class="px-8 py-7 lg:px-10">

                            <p class="text-xs uppercase tracking-[0.14em] text-[#666C75]">
                                Payment Date
                            </p>

                            <p class="mt-3 text-base font-medium text-[#F5F5F2]">
                                {{ $payment->created_at?->format('d M Y, H:i') ?? '—' }}
                            </p>

                        </div>

                    </div>

                </div>


                {{-- Invoice Information --}}
                <div class="overflow-hidden rounded-2xl border border-[#242830] bg-[#12151A]">

                    <div class="border-b border-[#242830] px-8 py-7 lg:px-10">

                        <h2 class="text-lg font-semibold text-[#F5F5F2]">
                            Invoice Information
                        </h2>

                        <p class="mt-2 text-sm text-[#8B919A]">
                            Invoice associated with this payment.
                        </p>

                    </div>


                    <div class="grid grid-cols-1 gap-x-12 gap-y-8 px-8 py-8 md:grid-cols-2 lg:px-10">

                        <div>

                            <p class="text-xs uppercase tracking-[0.14em] text-[#666C75]">
                                Invoice Number
                            </p>


                            @if ($payment->invoice)

                                <a
                                    href="{{ route('finance.invoices.show', $payment->invoice) }}"
                                    class="mt-3 inline-block text-base font-semibold text-[#A99FFF] transition hover:text-[#C2BBFF]"
                                >
                                    {{ $payment->invoice->invoice_number }}
                                </a>

                            @else

                                <p class="mt-3 text-base text-[#F5F5F2]">
                                    —
                                </p>

                            @endif

                        </div>


                        <div>

                            <p class="text-xs uppercase tracking-[0.14em] text-[#666C75]">
                                Invoice Total
                            </p>

                            <p class="mt-3 text-base font-semibold text-[#F5F5F2]">

                                @if ($payment->invoice)

                                    Rp {{ number_format((float) $payment->invoice->total, 0, ',', '.') }}

                                @else

                                    —

                                @endif

                            </p>

                        </div>


                        <div>

                            <p class="text-xs uppercase tracking-[0.14em] text-[#666C75]">
                                Customer
                            </p>

                            <p class="mt-3 text-base font-medium text-[#F5F5F2]">
                                {{ $payment->invoice?->order?->customer?->name ?? '—' }}
                            </p>

                        </div>


                        <div>

                            <p class="text-xs uppercase tracking-[0.14em] text-[#666C75]">
                                Invoice Status
                            </p>

                            <p class="mt-3 text-base font-medium text-[#F5F5F2]">
                                {{ $payment->invoice ? ucfirst($payment->invoice->status) : '—' }}
                            </p>

                        </div>

                    </div>

                </div>


                {{-- Payment Timeline --}}
                <div class="overflow-hidden rounded-2xl border border-[#242830] bg-[#12151A]">

                    {{-- Timeline Header --}}
                    <div class="border-b border-[#242830] px-8 py-7 lg:px-10">

                        <h2 class="text-lg font-semibold text-[#F5F5F2]">
                            Transaction Timeline
                        </h2>

                        <p class="mt-2 text-sm text-[#8B919A]">
                            Important timestamps for this payment.
                        </p>

                    </div>


                    {{-- Timeline Content --}}
                    <div class="px-8 py-8 lg:px-10">

                        <div class="relative">


                            {{-- Vertical Connector --}}
                            <div
                                class="absolute bottom-10 left-[19px] top-10 w-px bg-[#2A2F38]"
                            ></div>


                            {{-- Payment Created --}}
                            <div class="relative flex items-start gap-4 pb-8">

                                {{-- Icon --}}
                                <div class="relative z-10 flex h-10 w-10 shrink-0 items-center justify-center rounded-full border border-[#8B7CFF]/40 bg-[#12151A] text-sm font-medium text-[#A99FFF]">
                                    +
                                </div>


                                {{-- Content --}}
                                <div class="min-w-0 flex-1 pt-1">

                                    <p class="text-sm font-semibold text-[#F5F5F2]">
                                        Payment Created
                                    </p>

                                    <p class="mt-1 text-sm text-[#8B919A]">
                                        {{ $payment->created_at?->format('d M Y, H:i') ?? '—' }}
                                    </p>

                                </div>

                            </div>


                            {{-- Current Payment Status --}}
                            <div class="relative flex items-start gap-4">

                                {{-- Icon --}}
                                <div class="relative z-10 flex h-10 w-10 shrink-0 items-center justify-center rounded-full border border-emerald-500/30 bg-[#12151A] text-sm font-medium text-emerald-400">
                                    ✓
                                </div>


                                {{-- Content --}}
                                <div class="min-w-0 flex-1 pt-1">

                                    <p class="text-sm font-semibold text-[#F5F5F2]">
                                        Payment Status
                                    </p>

                                    <p class="mt-1 text-sm text-[#8B919A]">
                                        Current state: {{ ucfirst($payment->status) }}
                                    </p>


                                    @if ($payment->paid_at)

                                        <p class="mt-1 text-xs text-[#666C75]">
                                            Paid at {{ $payment->paid_at->format('d M Y, H:i') }}
                                        </p>

                                    @endif

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- RIGHT COLUMN --}}
            <div class="space-y-6">


                {{-- Payment Summary --}}
                <div class="overflow-hidden rounded-2xl border border-[#242830] bg-[#12151A]">

                    <div class="border-b border-[#242830] px-8 py-7">

                        <h2 class="text-lg font-semibold text-[#F5F5F2]">
                            Payment Summary
                        </h2>

                        <p class="mt-2 text-sm text-[#8B919A]">
                            Key transaction details.
                        </p>

                    </div>


                    <div class="space-y-6 px-8 py-8">

                        <div class="flex items-center justify-between gap-6">

                            <span class="text-sm text-[#8B919A]">
                                Amount
                            </span>

                            <span class="text-right text-sm font-semibold text-[#F5F5F2]">
                                Rp {{ number_format((float) $payment->amount, 0, ',', '.') }}
                            </span>

                        </div>


                        <div class="flex items-center justify-between gap-6">

                            <span class="text-sm text-[#8B919A]">
                                Method
                            </span>

                            <span class="text-right text-sm font-semibold text-[#F5F5F2]">
                                {{ ucwords(str_replace('_', ' ', $payment->method)) }}
                            </span>

                        </div>


                        <div class="flex items-center justify-between gap-6">

                            <span class="text-sm text-[#8B919A]">
                                Status
                            </span>

                            <span class="text-right text-sm font-semibold text-[#F5F5F2]">
                                {{ ucfirst($payment->status) }}
                            </span>

                        </div>


                        <div class="flex items-center justify-between gap-6">

                            <span class="text-sm text-[#8B919A]">
                                Paid At
                            </span>

                            <span class="text-right text-sm font-semibold text-[#F5F5F2]">
                                {{ $payment->paid_at?->format('d M Y, H:i') ?? '—' }}
                            </span>

                        </div>


                        <div class="border-t border-[#242830] pt-6">

                            <p class="text-xs uppercase tracking-[0.14em] text-[#666C75]">
                                Payment ID
                            </p>

                            <p class="mt-3 font-mono text-sm text-[#8B919A]">
                                #{{ $payment->id }}
                            </p>

                        </div>

                    </div>

                </div>


                {{-- Related Invoice --}}
                <div class="rounded-2xl border border-[#242830] bg-[#12151A] p-8">

                    <p class="text-xs font-medium uppercase tracking-[0.16em] text-[#8B919A]">
                        Related Invoice
                    </p>


                    @if ($payment->invoice)

                        <p class="mt-4 text-xl font-semibold tracking-tight text-[#F5F5F2]">
                            {{ $payment->invoice->invoice_number }}
                        </p>

                        <p class="mt-2 text-sm text-[#8B919A]">
                            {{ $payment->invoice->order?->customer?->name ?? 'No customer assigned' }}
                        </p>


                        <a
                            href="{{ route('finance.invoices.show', $payment->invoice) }}"
                            class="mt-6 inline-flex items-center text-sm font-medium text-[#A99FFF] transition hover:text-[#C2BBFF]"
                        >
                            View Invoice →
                        </a>

                    @else

                        <p class="mt-4 text-sm text-[#8B919A]">
                            No invoice information available.
                        </p>

                    @endif

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