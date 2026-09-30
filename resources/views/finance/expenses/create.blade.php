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
                        Create
                    </span>
                </div>

                <h1 class="text-2xl font-semibold tracking-tight text-white">
                    Create Expense
                </h1>

                <p class="mt-1 text-sm text-[#8B919A]">
                    Record a business expense for your organization.
                </p>
            </div>

            <a
                href="{{ route('finance.expenses.index') }}"
                class="inline-flex w-fit items-center gap-2 rounded-xl border border-[#242830] bg-[#12151A] px-4 py-2.5 text-sm font-medium text-[#D8DCE2] transition hover:border-[#343943] hover:bg-[#171A20] hover:text-white"
            >
                <span>←</span>
                Back to Expenses
            </a>
        </div>

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="rounded-2xl border border-red-500/20 bg-red-500/10 px-5 py-4">
                <div class="mb-2 text-sm font-semibold text-red-300">
                    Please fix the following errors:
                </div>

                <ul class="space-y-1 text-sm text-red-200/90">
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form
            method="POST"
            action="{{ route('finance.expenses.store') }}"
            class="space-y-6"
        >
            @csrf

            <div class="grid grid-cols-1 gap-6 xl:grid-cols-[minmax(0,1fr)_360px]">

                {{-- LEFT --}}
                <div class="space-y-6">

                    {{-- Expense Information --}}
                    <section class="rounded-2xl border border-[#242830] bg-[#12151A] p-6">

                        <div class="mb-5">
                            <h2 class="text-sm font-semibold text-white">
                                Expense Information
                            </h2>

                            <p class="mt-1 text-xs text-[#8B919A]">
                                Enter the basic information for this expense.
                            </p>
                        </div>

                        <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                            {{-- Category --}}
                            <div>
                                <label
                                    for="category"
                                    class="mb-2 block text-xs font-medium uppercase tracking-[0.12em] text-[#8B919A]"
                                >
                                    Category
                                </label>

                                <input
                                    id="category"
                                    type="text"
                                    name="category"
                                    list="expense-categories"
                                    value="{{ old('category') }}"
                                    required
                                    placeholder="e.g. Utilities"
                                    class="w-full rounded-xl border border-[#2A2E35] bg-[#0B0D10] px-4 py-3 text-sm text-white outline-none transition placeholder:text-[#555B64] focus:border-[#8B7CFF] focus:ring-1 focus:ring-[#8B7CFF]"
                                >

                                @if ($categories->count())
                                    <datalist id="expense-categories">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category }}"></option>
                                        @endforeach
                                    </datalist>
                                @endif

                                <p class="mt-2 text-xs text-[#6F757E]">
                                    Select an existing category or enter a new one.
                                </p>
                            </div>

                            {{-- Amount --}}
                            <div>
                                <label
                                    for="amount"
                                    class="mb-2 block text-xs font-medium uppercase tracking-[0.12em] text-[#8B919A]"
                                >
                                    Amount
                                </label>

                                <div class="relative">
                                    <span class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-sm text-[#6F757E]">
                                        Rp
                                    </span>

                                    <input
                                        id="amount"
                                        type="number"
                                        name="amount"
                                        step="0.01"
                                        min="0"
                                        value="{{ old('amount', 0) }}"
                                        required
                                        placeholder="0"
                                        class="w-full rounded-xl border border-[#2A2E35] bg-[#0B0D10] py-3 pl-11 pr-4 text-sm text-white outline-none transition placeholder:text-[#555B64] focus:border-[#8B7CFF] focus:ring-1 focus:ring-[#8B7CFF]"
                                    >
                                </div>
                            </div>

                            {{-- Description --}}
                            <div class="md:col-span-2">
                                <label
                                    for="description"
                                    class="mb-2 block text-xs font-medium uppercase tracking-[0.12em] text-[#8B919A]"
                                >
                                    Description
                                </label>

                                <textarea
                                    id="description"
                                    name="description"
                                    rows="4"
                                    required
                                    maxlength="255"
                                    placeholder="e.g. Monthly electricity bill for the office"
                                    class="w-full resize-none rounded-xl border border-[#2A2E35] bg-[#0B0D10] px-4 py-3 text-sm text-white outline-none transition placeholder:text-[#555B64] focus:border-[#8B7CFF] focus:ring-1 focus:ring-[#8B7CFF]"
                                >{{ old('description') }}</textarea>

                                <p class="mt-2 text-xs text-[#6F757E]">
                                    Briefly describe what this expense was for.
                                </p>
                            </div>

                            {{-- Date --}}
                            <div>
                                <label
                                    for="expense_date"
                                    class="mb-2 block text-xs font-medium uppercase tracking-[0.12em] text-[#8B919A]"
                                >
                                    Expense Date
                                </label>

                                <input
                                    id="expense_date"
                                    type="date"
                                    name="expense_date"
                                    value="{{ old('expense_date', now()->format('Y-m-d')) }}"
                                    required
                                    class="w-full rounded-xl border border-[#2A2E35] bg-[#0B0D10] px-4 py-3 text-sm text-white outline-none transition focus:border-[#8B7CFF] focus:ring-1 focus:ring-[#8B7CFF]"
                                >
                            </div>

                            {{-- Status --}}
                            <div>
                                <label
                                    for="status"
                                    class="mb-2 block text-xs font-medium uppercase tracking-[0.12em] text-[#8B919A]"
                                >
                                    Status
                                </label>

                                <select
                                    id="status"
                                    name="status"
                                    required
                                    class="w-full rounded-xl border border-[#2A2E35] bg-[#0B0D10] px-4 py-3 text-sm text-white outline-none transition focus:border-[#8B7CFF] focus:ring-1 focus:ring-[#8B7CFF]"
                                >
                                    <option
                                        value="pending"
                                        @selected(old('status', 'pending') === 'pending')
                                    >
                                        Pending
                                    </option>

                                    <option
                                        value="paid"
                                        @selected(old('status') === 'paid')
                                    >
                                        Paid
                                    </option>

                                    <option
                                        value="cancelled"
                                        @selected(old('status') === 'cancelled')
                                    >
                                        Cancelled
                                    </option>
                                </select>
                            </div>

                        </div>

                    </section>

                </div>

                {{-- RIGHT --}}
                <div class="space-y-6">

                    {{-- Preview --}}
                    <section class="rounded-2xl border border-[#242830] bg-[#12151A] p-6">

                        <div class="mb-5">
                            <h2 class="text-sm font-semibold text-white">
                                Expense Summary
                            </h2>

                            <p class="mt-1 text-xs text-[#8B919A]">
                                Review the expense before saving it.
                            </p>
                        </div>

                        <div class="rounded-xl border border-[#242830] bg-[#0B0D10] p-5">

                            <div class="text-[10px] font-semibold uppercase tracking-[0.14em] text-[#6F757E]">
                                Amount
                            </div>

                            <div
                                id="amount-preview"
                                class="mt-2 text-3xl font-semibold tracking-tight text-white"
                            >
                                Rp 0
                            </div>

                            <div class="mt-5 border-t border-[#242830] pt-4">

                                <div class="flex items-center justify-between gap-4">
                                    <span class="text-sm text-[#8B919A]">
                                        Category
                                    </span>

                                    <span
                                        id="category-preview"
                                        class="max-w-[180px] truncate text-right text-sm font-medium text-white"
                                    >
                                        —
                                    </span>
                                </div>

                                <div class="mt-3 flex items-center justify-between gap-4">
                                    <span class="text-sm text-[#8B919A]">
                                        Description
                                    </span>

                                    <span
                                        id="description-preview"
                                        class="max-w-[180px] truncate text-right text-sm font-medium text-white"
                                    >
                                        —
                                    </span>
                                </div>

                                <div class="mt-3 flex items-center justify-between gap-4">
                                    <span class="text-sm text-[#8B919A]">
                                        Date
                                    </span>

                                    <span
                                        id="date-preview"
                                        class="text-right text-sm font-medium text-white"
                                    >
                                        —
                                    </span>
                                </div>

                                <div class="mt-3 flex items-center justify-between gap-4">
                                    <span class="text-sm text-[#8B919A]">
                                        Status
                                    </span>

                                    <span
                                        id="status-preview"
                                        class="rounded-full border border-amber-400/20 bg-amber-400/10 px-2.5 py-1 text-[10px] font-medium uppercase tracking-[0.08em] text-amber-300"
                                    >
                                        Pending
                                    </span>
                                </div>

                            </div>
                        </div>

                    </section>

                    {{-- Status Info --}}
                    <section class="rounded-2xl border border-[#242830] bg-[#12151A] p-6">

                        <div class="mb-4">
                            <h2 class="text-sm font-semibold text-white">
                                Status Guide
                            </h2>

                            <p class="mt-1 text-xs text-[#8B919A]">
                                Choose the state that matches this expense.
                            </p>
                        </div>

                        <div class="space-y-3">

                            <div class="rounded-xl border border-amber-400/15 bg-amber-400/5 px-4 py-3">
                                <div class="text-sm font-medium text-amber-300">
                                    Pending
                                </div>

                                <div class="mt-1 text-xs leading-5 text-[#8B919A]">
                                    Expense has been recorded but is not yet paid.
                                </div>
                            </div>

                            <div class="rounded-xl border border-emerald-400/15 bg-emerald-400/5 px-4 py-3">
                                <div class="text-sm font-medium text-emerald-300">
                                    Paid
                                </div>

                                <div class="mt-1 text-xs leading-5 text-[#8B919A]">
                                    Expense has already been paid.
                                </div>
                            </div>

                            <div class="rounded-xl border border-red-400/15 bg-red-400/5 px-4 py-3">
                                <div class="text-sm font-medium text-red-300">
                                    Cancelled
                                </div>

                                <div class="mt-1 text-xs leading-5 text-[#8B919A]">
                                    Expense has been cancelled and should not count as paid.
                                </div>
                            </div>

                        </div>

                    </section>

                    {{-- Actions --}}
                    <section class="rounded-2xl border border-[#242830] bg-[#12151A] p-6">

                        <button
                            type="submit"
                            class="w-full rounded-xl bg-white px-4 py-3 text-sm font-semibold text-[#0B0D10] transition hover:bg-[#E8E8E5]"
                        >
                            Create Expense
                        </button>

                        <a
                            href="{{ route('finance.expenses.index') }}"
                            class="mt-3 block w-full rounded-xl border border-[#2A2E35] bg-[#0B0D10] px-4 py-3 text-center text-sm font-medium text-[#B8BDC5] transition hover:border-[#3A3F47] hover:text-white"
                        >
                            Cancel
                        </a>

                    </section>

                </div>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const amountInput = document.getElementById('amount');
            const categoryInput = document.getElementById('category');
            const descriptionInput = document.getElementById('description');
            const dateInput = document.getElementById('expense_date');
            const statusInput = document.getElementById('status');

            const amountPreview = document.getElementById('amount-preview');
            const categoryPreview = document.getElementById('category-preview');
            const descriptionPreview = document.getElementById('description-preview');
            const datePreview = document.getElementById('date-preview');
            const statusPreview = document.getElementById('status-preview');

            function getAmount() {
                const amount = parseFloat(amountInput.value);

                return Number.isFinite(amount)
                    ? amount
                    : 0;
            }

            function formatCurrency(value) {
                return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 0,
                }).format(value);
            }

            function formatDate(value) {
                if (!value) {
                    return '—';
                }

                const date = new Date(value + 'T00:00:00');

                if (Number.isNaN(date.getTime())) {
                    return value;
                }

                return new Intl.DateTimeFormat('id-ID', {
                    day: '2-digit',
                    month: 'short',
                    year: 'numeric',
                }).format(date);
            }

            function updatePreview() {
                amountPreview.textContent =
                    formatCurrency(getAmount());

                categoryPreview.textContent =
                    categoryInput.value.trim() || '—';

                descriptionPreview.textContent =
                    descriptionInput.value.trim() || '—';

                datePreview.textContent =
                    formatDate(dateInput.value);

                const status = statusInput.value || 'pending';

                statusPreview.textContent =
                    status.charAt(0).toUpperCase() + status.slice(1);

                statusPreview.className =
                    'rounded-full border px-2.5 py-1 text-[10px] font-medium uppercase tracking-[0.08em]';

                if (status === 'pending') {
                    statusPreview.classList.add(
                        'border-amber-400/20',
                        'bg-amber-400/10',
                        'text-amber-300'
                    );
                } else if (status === 'paid') {
                    statusPreview.classList.add(
                        'border-emerald-400/20',
                        'bg-emerald-400/10',
                        'text-emerald-300'
                    );
                } else {
                    statusPreview.classList.add(
                        'border-red-400/20',
                        'bg-red-400/10',
                        'text-red-300'
                    );
                }
            }

            amountInput.addEventListener(
                'input',
                updatePreview
            );

            categoryInput.addEventListener(
                'input',
                updatePreview
            );

            descriptionInput.addEventListener(
                'input',
                updatePreview
            );

            dateInput.addEventListener(
                'change',
                updatePreview
            );

            statusInput.addEventListener(
                'change',
                updatePreview
            );

            updatePreview();
        });
    </script>
</x-app-layout>