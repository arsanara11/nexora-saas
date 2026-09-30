<x-app-layout>

    <div class="space-y-8">

        {{-- ============================================================ --}}
        {{-- HEADER --}}
        {{-- ============================================================ --}}

        <div class="flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between">

            <div>

                <p class="text-[10px] font-semibold uppercase tracking-[0.2em] text-[#727985]">
                    Product Management
                </p>

                <h1 class="mt-2 text-3xl font-semibold tracking-tight text-[#F5F5F2]">
                    Categories
                </h1>

                <p class="mt-2 max-w-2xl text-sm leading-6 text-[#8B919A]">
                    Organize products into clear categories for easier management.
                </p>

            </div>


            <div class="flex items-center gap-3">

                <a
                    href="{{ route('products.index') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-lg border border-[#242830] px-4 py-2.5 text-sm font-medium text-[#B9BEC6] transition hover:border-[#3A404A] hover:bg-[#151A21] hover:text-white"
                >
                    <span class="text-base">
                        ←
                    </span>

                    Products
                </a>


                <a
                    href="{{ route('categories.create') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-lg bg-[#F5F5F2] px-4 py-2.5 text-sm font-semibold text-[#080B10] transition hover:bg-white"
                >
                    <span class="text-lg leading-none">
                        +
                    </span>

                    Add Category
                </a>

            </div>

        </div>



        {{-- ============================================================ --}}
        {{-- FLASH MESSAGES --}}
        {{-- ============================================================ --}}

        @if (session('success'))

            <div class="flex items-center gap-3 rounded-xl border border-emerald-400/15 bg-emerald-400/10 px-4 py-3 text-sm text-emerald-300">

                <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-lg bg-emerald-400/10">
                    ✓
                </span>

                <span>
                    {{ session('success') }}
                </span>

            </div>

        @endif


        @if (session('error'))

            <div class="flex items-center gap-3 rounded-xl border border-rose-400/15 bg-rose-400/10 px-4 py-3 text-sm text-rose-300">

                <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-lg bg-rose-400/10">
                    !
                </span>

                <span>
                    {{ session('error') }}
                </span>

            </div>

        @endif



        {{-- ============================================================ --}}
        {{-- VALIDATION ERRORS --}}
        {{-- ============================================================ --}}

        @if ($errors->any())

            <div class="rounded-xl border border-rose-400/15 bg-rose-400/10 px-5 py-4">

                <p class="text-sm font-medium text-rose-300">
                    Please review the following errors:
                </p>

                <ul class="mt-2 space-y-1 text-xs text-rose-200/80">

                    @foreach ($errors->all() as $error)

                        <li>
                            • {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        @endif



        {{-- ============================================================ --}}
        {{-- SUMMARY CARDS --}}
        {{-- ============================================================ --}}

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">


            {{-- Total --}}
            <div class="rounded-2xl border border-[#242830] bg-[#12151A] px-5 py-5">

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-[10px] font-semibold uppercase tracking-[0.16em] text-[#727985]">
                            Total Categories
                        </p>

                        <p class="mt-3 text-3xl font-semibold text-[#F5F5F2]">
                            {{ number_format($summary['total']) }}
                        </p>

                    </div>


                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#8B7CFF]/10 text-[#A99FFF]">
                        ≡
                    </div>

                </div>

                <p class="mt-3 text-xs text-[#666C75]">
                    All categories in your workspace
                </p>

            </div>



            {{-- Active --}}
            <div class="rounded-2xl border border-[#242830] bg-[#12151A] px-5 py-5">

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-[10px] font-semibold uppercase tracking-[0.16em] text-[#727985]">
                            Active
                        </p>

                        <p class="mt-3 text-3xl font-semibold text-[#F5F5F2]">
                            {{ number_format($summary['active']) }}
                        </p>

                    </div>


                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-400/10 text-emerald-300">
                        ✓
                    </div>

                </div>

                <p class="mt-3 text-xs text-[#666C75]">
                    Currently available categories
                </p>

            </div>



            {{-- Inactive --}}
            <div class="rounded-2xl border border-[#242830] bg-[#12151A] px-5 py-5">

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-[10px] font-semibold uppercase tracking-[0.16em] text-[#727985]">
                            Inactive
                        </p>

                        <p class="mt-3 text-3xl font-semibold text-[#F5F5F2]">
                            {{ number_format($summary['inactive']) }}
                        </p>

                    </div>


                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-amber-400/10 text-amber-300">
                        —
                    </div>

                </div>

                <p class="mt-3 text-xs text-[#666C75]">
                    Categories currently disabled
                </p>

            </div>



            {{-- With Products --}}
            <div class="rounded-2xl border border-[#242830] bg-[#12151A] px-5 py-5">

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-[10px] font-semibold uppercase tracking-[0.16em] text-[#727985]">
                            With Products
                        </p>

                        <p class="mt-3 text-3xl font-semibold text-[#F5F5F2]">
                            {{ number_format($summary['with_products']) }}
                        </p>

                    </div>


                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-sky-400/10 text-sky-300">
                        □
                    </div>

                </div>

                <p class="mt-3 text-xs text-[#666C75]">
                    Categories already in use
                </p>

            </div>

        </div>



        {{-- ============================================================ --}}
        {{-- FILTERS --}}
        {{-- ============================================================ --}}

        <div class="rounded-2xl border border-[#242830] bg-[#12151A]">

            <div class="border-b border-[#242830] px-6 py-5">

                <h2 class="text-sm font-semibold text-[#F5F5F2]">
                    Category Directory
                </h2>

                <p class="mt-1 text-xs text-[#747B87]">
                    Search and filter your product categories.
                </p>

            </div>


            <form
                method="GET"
                action="{{ route('categories.index') }}"
                class="p-6"
            >

                <div class="grid grid-cols-1 gap-4 md:grid-cols-[1fr_220px_auto]">

                    {{-- Search --}}
                    <div>

                        <label
                            for="search"
                            class="mb-2 block text-xs font-medium uppercase tracking-[0.12em] text-[#8B919A]"
                        >
                            Search
                        </label>


                        <div class="relative">

                            <span class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-[#666C75]">
                                ⌕
                            </span>


                            <input
                                type="text"
                                id="search"
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="Search category or slug..."
                                class="w-full rounded-lg border border-[#242830] bg-[#0B0D10] py-3 pl-10 pr-4 text-sm text-[#F5F5F2] outline-none transition placeholder:text-[#555C67] focus:border-[#8B7CFF] focus:ring-1 focus:ring-[#8B7CFF]"
                            >

                        </div>

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
                            class="w-full rounded-lg border border-[#242830] bg-[#0B0D10] px-4 py-3 text-sm text-[#F5F5F2] outline-none transition focus:border-[#8B7CFF] focus:ring-1 focus:ring-[#8B7CFF]"
                        >

                            <option value="">
                                All statuses
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



                    {{-- Actions --}}
                    <div class="flex items-end gap-2">

                        <a
                            href="{{ route('categories.index') }}"
                            class="inline-flex h-[46px] items-center justify-center rounded-lg border border-[#242830] px-4 text-sm font-medium text-[#9AA1AD] transition hover:border-[#3A404A] hover:bg-[#171C23] hover:text-white"
                        >
                            Reset
                        </a>


                        <button
                            type="submit"
                            class="inline-flex h-[46px] items-center justify-center rounded-lg bg-[#F5F5F2] px-5 text-sm font-semibold text-[#080B10] transition hover:bg-white"
                        >
                            Filter
                        </button>

                    </div>

                </div>

            </form>

        </div>



        {{-- ============================================================ --}}
        {{-- TABLE --}}
        {{-- ============================================================ --}}

        <div class="overflow-hidden rounded-2xl border border-[#242830] bg-[#12151A]">

            <div class="overflow-x-auto">

                <table class="w-full min-w-[900px]">

                    <thead>

                        <tr class="border-b border-[#242830] bg-[#0E1116]">

                            <th class="px-6 py-4 text-left text-[10px] font-semibold uppercase tracking-[0.14em] text-[#666C75]">
                                Category
                            </th>

                            <th class="px-6 py-4 text-left text-[10px] font-semibold uppercase tracking-[0.14em] text-[#666C75]">
                                Slug
                            </th>

                            <th class="px-6 py-4 text-left text-[10px] font-semibold uppercase tracking-[0.14em] text-[#666C75]">
                                Description
                            </th>

                            <th class="px-6 py-4 text-center text-[10px] font-semibold uppercase tracking-[0.14em] text-[#666C75]">
                                Products
                            </th>

                            <th class="px-6 py-4 text-left text-[10px] font-semibold uppercase tracking-[0.14em] text-[#666C75]">
                                Status
                            </th>

                            <th class="px-6 py-4 text-right text-[10px] font-semibold uppercase tracking-[0.14em] text-[#666C75]">
                                Action
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-[#242830]">

                        @forelse ($categories as $category)

                            <tr class="transition hover:bg-[#0E1116]">


                                {{-- Category --}}
                                <td class="px-6 py-5">

                                    <div class="flex items-center gap-3">

                                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-[#8B7CFF]/10 text-[#A99FFF]">
                                            #
                                        </div>


                                        <div class="min-w-0">

                                            <p class="truncate text-sm font-medium text-[#F5F5F2]">
                                                {{ $category->name }}
                                            </p>

                                            <p class="mt-1 text-xs text-[#666C75]">
                                                Category #{{ $category->id }}
                                            </p>

                                        </div>

                                    </div>

                                </td>



                                {{-- Slug --}}
                                <td class="px-6 py-5">

                                    <span class="rounded-md border border-[#242830] bg-[#0B0D10] px-2.5 py-1 font-mono text-xs text-[#AEB3BB]">
                                        {{ $category->slug }}
                                    </span>

                                </td>



                                {{-- Description --}}
                                <td class="px-6 py-5">

                                    <p class="max-w-[280px] truncate text-sm text-[#8B919A]">
                                        {{ $category->description ?: 'No description' }}
                                    </p>

                                </td>



                                {{-- Products --}}
                                <td class="px-6 py-5 text-center">

                                    <span class="inline-flex min-w-[36px] items-center justify-center rounded-lg border border-[#242830] bg-[#0B0D10] px-2.5 py-1 text-xs font-semibold text-[#D9DCE1]">
                                        {{ $category->products_count }}
                                    </span>

                                </td>



                                {{-- Status --}}
                                <td class="px-6 py-5">

                                    @if ($category->is_active)

                                        <span class="inline-flex items-center gap-2 rounded-lg border border-emerald-400/15 bg-emerald-400/10 px-2.5 py-1 text-xs font-medium text-emerald-300">

                                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>

                                            Active

                                        </span>

                                    @else

                                        <span class="inline-flex items-center gap-2 rounded-lg border border-[#303640] bg-[#181D24] px-2.5 py-1 text-xs font-medium text-[#8B919A]">

                                            <span class="h-1.5 w-1.5 rounded-full bg-[#666C75]"></span>

                                            Inactive

                                        </span>

                                    @endif

                                </td>



                                {{-- Action --}}
                                <td class="px-6 py-5 text-right">

                                    <div class="relative inline-block text-left">

                                        <details class="group">

                                            <summary
                                                class="flex h-9 w-9 cursor-pointer list-none items-center justify-center rounded-lg border border-[#242830] text-[#8B919A] transition hover:border-[#3A404A] hover:bg-[#171C23] hover:text-white"
                                            >
                                                •••
                                            </summary>


                                            <div
                                                class="absolute right-0 z-30 mt-2 w-[190px] overflow-hidden rounded-xl border border-[#292F39] bg-[#11151B] p-1 shadow-[0_20px_50px_rgba(0,0,0,0.45)]"
                                            >

                                                {{-- View --}}
                                                <a
                                                    href="{{ route('categories.show', $category) }}"
                                                    class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm text-[#AEB3BB] transition hover:bg-[#181D25] hover:text-white"
                                                >

                                                    <span class="text-[#8B7CFF]">
                                                        →
                                                    </span>

                                                    View category

                                                </a>


                                                {{-- Edit --}}
                                                <a
                                                    href="{{ route('categories.edit', $category) }}"
                                                    class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm text-[#AEB3BB] transition hover:bg-[#181D25] hover:text-white"
                                                >

                                                    <span class="text-[#8B7CFF]">
                                                        ✎
                                                    </span>

                                                    Edit category

                                                </a>


                                                {{-- Toggle --}}
                                                <form
                                                    method="POST"
                                                    action="{{ route('categories.toggle-status', $category) }}"
                                                >

                                                    @csrf

                                                    @method('PATCH')

                                                    <button
                                                        type="submit"
                                                        class="flex w-full items-center gap-3 rounded-lg px-3 py-2.5 text-left text-sm text-[#AEB3BB] transition hover:bg-[#181D25] hover:text-white"
                                                    >

                                                        <span class="{{ $category->is_active ? 'text-amber-300' : 'text-emerald-300' }}">
                                                            {{ $category->is_active ? '—' : '✓' }}
                                                        </span>

                                                        {{ $category->is_active ? 'Disable category' : 'Enable category' }}

                                                    </button>

                                                </form>


                                                {{-- Delete --}}
                                                <div class="my-1 border-t border-[#242830]"></div>

                                                <form
                                                    method="POST"
                                                    action="{{ route('categories.destroy', $category) }}"
                                                    onsubmit="return confirm('Delete this category? Categories used by products cannot be deleted.');"
                                                >

                                                    @csrf

                                                    @method('DELETE')

                                                    <button
                                                        type="submit"
                                                        class="flex w-full items-center gap-3 rounded-lg px-3 py-2.5 text-left text-sm text-rose-300 transition hover:bg-rose-500/10 hover:text-rose-200"
                                                    >

                                                        <span>
                                                            ×
                                                        </span>

                                                        Delete category

                                                    </button>

                                                </form>

                                            </div>

                                        </details>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="6"
                                    class="px-6 py-16 text-center"
                                >

                                    <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-xl border border-[#242830] bg-[#0B0D10] text-[#555C67]">
                                        #
                                    </div>

                                    <p class="mt-4 text-sm font-medium text-[#F5F5F2]">
                                        No categories found
                                    </p>

                                    <p class="mt-1 text-xs text-[#666C75]">
                                        Create a category or adjust your filters.
                                    </p>


                                    <a
                                        href="{{ route('categories.create') }}"
                                        class="mt-5 inline-flex items-center gap-2 rounded-lg border border-[#242830] px-4 py-2.5 text-sm font-medium text-[#AEB3BB] transition hover:border-[#8B7CFF]/40 hover:bg-[#171C23] hover:text-white"
                                    >
                                        <span>
                                            +
                                        </span>

                                        Create category

                                    </a>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- ======================================================== --}}
            {{-- PAGINATION --}}
            {{-- ======================================================== --}}

            @if ($categories->hasPages())

                <div class="border-t border-[#242830] px-6 py-4">

                    {{ $categories->links() }}

                </div>

            @endif

        </div>

    </div>

</x-app-layout>