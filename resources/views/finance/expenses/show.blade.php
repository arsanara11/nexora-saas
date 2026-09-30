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
                        href="{{ route('finance.expenses.index') }}"
                        class="transition hover:text-white"
                    >
                        Expenses
                    </a>

                    <span class="text-[#4A4F57]">/</span>

                    <span class="text-white">
                        Expense #{{ $expense->id }}
                    </span>
                </div>

                <div class="flex flex-wrap items-center gap-3">
                    <h1 class="text-2xl font-semibold tracking-tight text-white">
                        Expense #{{ $expense->id }}
                    </h1>

                    @php
                        $statusStyles = [
                            'pending' => 'border-amber-400/20 bg-amber-400/10 text-amber-300',
                            'paid' => 'border-emerald-400/20 bg-emerald-400/10 text-emerald-300',
                            'cancelled' => 'border-red-400/20 bg-red-400/10 text-red-300',
                        ];

                        $statusClass = $statusStyles[$expense->status]
                            ?? 'border-[#242830] bg-[#0B0D10] text-[#8B919A]';
                    @endphp

                    <span class="rounded-full border px-3 py-1 text-xs font-medium uppercase tracking-[0.08em] {{ $statusClass }}">
                        {{ ucfirst($expense->status) }}
                    </span>
                </div>

                <p class="mt-1 text-sm text-[#8B919A]">
                    Expense details and payment information.
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-3">
                <a
                    href="{{ route('finance.expenses.index') }}"
                    class="inline-flex items-center gap-2 rounded-xl border border-[#242830] bg-[#12151A] px-4 py-2.5 text-sm font-medium text-[#D8DCE2] transition hover:border-[#343943] hover:bg-[#171A20] hover:text-white"
                >
                    <span>←</span>
                    Back to Expenses
                </a>

                <a
                    href="{{ route('finance.expenses.edit', $expense) }}"
                    class="inline-flex items-center gap-2 rounded-xl bg-white px-4 py-2.5 text-sm font-semibold text-[#0B0D10] transition hover:bg-[#E8E8E5]"
                >
                    Edit Expense
                </a>
            </div>
        </div>

        {{-- Success --}}
        @if (session('success'))
            <div class="rounded-2xl border border-emerald-400/20 bg-emerald-400/10 px-5 py-4 text-sm text-emerald-300">
                {{ session('success') }}
            </div>
        @endif

        {{-- Main --}}
        <div class="grid grid-cols-1 gap-6 xl:grid-cols-[minmax(0,1fr)_360px]">

            {{-- Left --}}
            <div class="space-y-6">

                {{-- Expense Information --}}
                <section class="rounded-2xl border border-[#242830] bg-[#12151A] p-6">

                    <div class="mb-5">
                        <h2 class="text-sm font-semibold text-white">
                            Expense Information
                        </h2>

                        <p class="mt-1 text-xs text-[#8B919A]">
                            Complete information about this expense record.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">

                        {{-- Category --}}
                        <div>
                            <div class="text-[10px] font-semibold uppercase tracking-[0.14em] text-[#6F757E]">
                                Category
                            </div>

                            <div class="mt-1 text-sm font-medium text-white">
                                {{ $expense->category }}
                            </div>
                        </div>

                        {{-- Date --}}
                        <div>
                            <div class="text-[10px] font-semibold uppercase tracking-[0.14em] text-[#6F757E]">
                                Expense Date
                            </div>

                            <div class="mt-1 text-sm font-medium text-white">
                                {{ \Carbon\Carbon::parse($expense->expense_date)->format('d M Y') }}
                            </div>
                        </div>

                        {{-- Recorded By --}}
                        <div>
                            <div class="text-[10px] font-semibold uppercase tracking-[0.14em] text-[#6F757E]">
                                Recorded By
                            </div>

                            <div class="mt-1 text-sm font-medium text-white">
                                {{ $expense->user->name ?? 'Unknown User' }}
                            </div>

                            @if ($expense->user?->email)
                                <div class="mt-1 text-xs text-[#6F757E]">
                                    {{ $expense->user->email }}
                                </div>
                            @endif
                        </div>

                        {{-- Status --}}
                        <div>
                            <div class="text-[10px] font-semibold uppercase tracking-[0.14em] text-[#6F757E]">
                                Status
                            </div>

                            <div class="mt-2">
                                <span class="inline-flex rounded-full border px-2.5 py-1 text-[10px] font-medium uppercase tracking-[0.08em] {{ $statusClass }}">
                                    {{ ucfirst($expense->status) }}
                                </span>
                            </div>
                        </div>

                    </div>
                </section>

                {{-- Amount --}}
                <section class="rounded-2xl border border-[#242830] bg-[#12151A] p-6">

                    <div class="mb-5">
                        <h2 class="text-sm font-semibold text-white">
                            Expense Amount
                        </h2>

                        <p class="mt-1 text-xs text-[#8B919A]">
                            Financial value recorded for this expense.
                        </p>
                    </div>

                    <div class="rounded-xl border border-[#242830] bg-[#0B0D10] p-6">
                        <div class="text-xs font-medium uppercase tracking-[0.14em] text-[#8B919A]">
                            Total Expense
                        </div>

                        <div class="mt-2 text-3xl font-semibold tracking-tight text-white">
                            Rp {{ number_format((float) $expense->amount, 0, ',', '.') }}
                        </div>

                        <div class="mt-5 border-t border-[#242830] pt-4">
                            <div class="flex items-center justify-between gap-4">
                                <span class="text-sm text-[#8B919A]">
                                    Expense Date
                                </span>

                                <span class="text-sm font-medium text-white">
                                    {{ \Carbon\Carbon::parse($expense->expense_date)->format('d M Y') }}
                                </span>
                            </div>

                            <div class="mt-3 flex items-center justify-between gap-4">
                                <span class="text-sm text-[#8B919A]">
                                    Category
                                </span>

                                <span class="text-right text-sm font-medium text-white">
                                    {{ $expense->category }}
                                </span>
                            </div>
                        </div>
                    </div>

                </section>

            </div>

            {{-- Right --}}
            <div class="space-y-6">

                {{-- Summary --}}
                <section class="rounded-2xl border border-[#242830] bg-[#12151A] p-6">

                    <div class="mb-5">
                        <h2 class="text-sm font-semibold text-white">
                            Expense Summary
                        </h2>

                        <p class="mt-1 text-xs text-[#8B919A]">
                            Current state of this expense.
                        </p>
                    </div>

                    <div class="space-y-4">

                        <div>
                            <div class="text-xs uppercase tracking-[0.12em] text-[#6F757E]">
                                Amount
                            </div>

                            <div class="mt-1 text-xl font-semibold text-[#C9C2FF]">
                                Rp {{ number_format((float) $expense->amount, 0, ',', '.') }}
                            </div>
                        </div>

                        <div class="border-t border-[#242830] pt-4">
                            <div class="text-xs uppercase tracking-[0.12em] text-[#6F757E]">
                                Category
                            </div>

                            <div class="mt-1 text-sm font-medium text-white">
                                {{ $expense->category }}
                            </div>
                        </div>

                        <div class="border-t border-[#242830] pt-4">
                            <div class="text-xs uppercase tracking-[0.12em] text-[#6F757E]">
                                Status
                            </div>

                            <div class="mt-2">
                                <span class="inline-flex rounded-full border px-2.5 py-1 text-[10px] font-medium uppercase tracking-[0.08em] {{ $statusClass }}">
                                    {{ ucfirst($expense->status) }}
                                </span>
                            </div>
                        </div>

                    </div>

                </section>

                {{-- Status Actions --}}
                <section class="rounded-2xl border border-[#242830] bg-[#12151A] p-6">

                    <div class="mb-5">
                        <h2 class="text-sm font-semibold text-white">
                            Manage Expense
                        </h2>

                        <p class="mt-1 text-xs text-[#8B919A]">
                            Edit or remove this expense record.
                        </p>
                    </div>

                    <div class="space-y-3">

                        <a
                            href="{{ route('finance.expenses.edit', $expense) }}"
                            class="block w-full rounded-xl bg-white px-4 py-3 text-center text-sm font-semibold text-[#0B0D10] transition hover:bg-[#E8E8E5]"
                        >
                            Edit Expense
                        </a>

                        @if ($expense->status !== 'paid')
                            <form
                                method="POST"
                                action="{{ route('finance.expenses.update', $expense) }}"
                            >
                                @csrf
                                @method('PUT')

                                <input
                                    type="hidden"
                                    name="category"
                                    value="{{ $expense->category }}"
                                >

                                <input
                                    type="hidden"
                                    name="amount"
                                    value="{{ $expense->amount }}"
                                >

                                <input
                                    type="hidden"
                                    name="expense_date"
                                    value="{{ \Carbon\Carbon::parse($expense->expense_date)->format('Y-m-d') }}"
                                >

                                <input
                                    type="hidden"
                                    name="status"
                                    value="paid"
                                >

                                <button
                                    type="submit"
                                    class="w-full rounded-xl border border-emerald-400/20 bg-emerald-400/10 px-4 py-3 text-sm font-medium text-emerald-300 transition hover:bg-emerald-400/15"
                                >
                                    Mark as Paid
                                </button>
                            </form>
                        @endif

                    </div>

                </section>

                {{-- Delete --}}
                <section class="rounded-2xl border border-red-400/20 bg-[#12151A] p-6">

                    <div class="mb-4">
                        <h2 class="text-sm font-semibold text-white">
                            Danger Zone
                        </h2>

                        <p class="mt-1 text-xs leading-5 text-[#8B919A]">
                            Permanently remove this expense record.
                        </p>
                    </div>

                    <form
                        method="POST"
                        action="{{ route('finance.expenses.destroy', $expense) }}"
                        onsubmit="return confirm('Delete this expense? This action cannot be undone.');"
                    >
                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="w-full rounded-xl border border-red-400/20 bg-red-400/10 px-4 py-3 text-sm font-medium text-red-300 transition hover:bg-red-400/15"
                        >
                            Delete Expense
                        </button>
                    </form>

                </section>

            </div>
        </div>
    </div>
</x-app-layout>