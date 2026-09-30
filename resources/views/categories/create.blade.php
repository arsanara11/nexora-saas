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
                    Create Category
                </h1>

                <p class="mt-2 max-w-2xl text-sm leading-6 text-[#8B919A]">
                    Add a new product category to your business workspace.
                </p>

            </div>


            <a
                href="{{ route('categories.index') }}"
                class="inline-flex items-center justify-center gap-2 rounded-lg border border-[#242830] px-4 py-2.5 text-sm font-medium text-[#B9BEC6] transition hover:border-[#3A404A] hover:bg-[#151A21] hover:text-white"
            >

                <span class="text-base">
                    ←
                </span>

                Back to categories

            </a>

        </div>



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
        {{-- FORM --}}
        {{-- ============================================================ --}}

        <form
            method="POST"
            action="{{ route('categories.store') }}"
            class="space-y-6"
        >

            @csrf


            {{-- ======================================================== --}}
            {{-- CATEGORY INFORMATION --}}
            {{-- ======================================================== --}}

            <div class="rounded-2xl border border-[#242830] bg-[#12151A]">

                <div class="border-b border-[#242830] px-6 py-5">

                    <h2 class="text-sm font-semibold text-[#F5F5F2]">
                        Category Information
                    </h2>

                    <p class="mt-1 text-xs text-[#747B87]">
                        Define the name, URL slug, and description for this category.
                    </p>

                </div>


                <div class="space-y-6 p-6">


                    {{-- Name --}}
                    <div>

                        <label
                            for="name"
                            class="mb-2 block text-xs font-medium uppercase tracking-[0.12em] text-[#8B919A]"
                        >
                            Category Name
                        </label>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="e.g. Electronics"
                            required
                            autofocus
                            class="w-full rounded-lg border border-[#242830] bg-[#0B0D10] px-4 py-3 text-sm text-[#F5F5F2] outline-none transition placeholder:text-[#555C67] focus:border-[#8B7CFF] focus:ring-1 focus:ring-[#8B7CFF]"
                        >

                        <p class="mt-2 text-xs text-[#666C75]">
                            Use a clear and recognizable category name.
                        </p>

                    </div>


                    {{-- Slug --}}
                    <div>

                        <label
                            for="slug"
                            class="mb-2 block text-xs font-medium uppercase tracking-[0.12em] text-[#8B919A]"
                        >
                            Slug
                        </label>

                        <input
                            type="text"
                            id="slug"
                            name="slug"
                            value="{{ old('slug') }}"
                            placeholder="electronics"
                            class="w-full rounded-lg border border-[#242830] bg-[#0B0D10] px-4 py-3 font-mono text-sm text-[#F5F5F2] outline-none transition placeholder:text-[#555C67] focus:border-[#8B7CFF] focus:ring-1 focus:ring-[#8B7CFF]"
                        >

                        <p class="mt-2 text-xs text-[#666C75]">
                            Leave empty to generate the slug automatically from the category name.
                        </p>

                    </div>


                    {{-- Description --}}
                    <div>

                        <label
                            for="description"
                            class="mb-2 block text-xs font-medium uppercase tracking-[0.12em] text-[#8B919A]"
                        >
                            Description
                        </label>

                        <textarea
                            id="description"
                            name="description"
                            rows="5"
                            placeholder="Describe what products belong to this category..."
                            class="w-full resize-none rounded-lg border border-[#242830] bg-[#0B0D10] px-4 py-3 text-sm leading-6 text-[#F5F5F2] outline-none transition placeholder:text-[#555C67] focus:border-[#8B7CFF] focus:ring-1 focus:ring-[#8B7CFF]"
                        >{{ old('description') }}</textarea>

                        <p class="mt-2 text-xs text-[#666C75]">
                            Description is optional.
                        </p>

                    </div>

                </div>

            </div>



            {{-- ============================================================ --}}
            {{-- STATUS --}}
            {{-- ============================================================ --}}

            <div class="rounded-2xl border border-[#242830] bg-[#12151A]">

                <div class="border-b border-[#242830] px-6 py-5">

                    <h2 class="text-sm font-semibold text-[#F5F5F2]">
                        Category Status
                    </h2>

                    <p class="mt-1 text-xs text-[#747B87]">
                        Choose whether this category should be available immediately.
                    </p>

                </div>


                <div class="p-6">

                    <label class="flex cursor-pointer items-start gap-4">

                        <input
                            type="checkbox"
                            name="is_active"
                            value="1"
                            @checked(old('is_active', true))
                            class="mt-1 h-4 w-4 rounded border-[#3A404A] bg-[#0B0D10] text-[#8B7CFF] focus:ring-[#8B7CFF]"
                        >

                        <span>

                            <span class="block text-sm font-medium text-[#F5F5F2]">
                                Active category
                            </span>

                            <span class="mt-1 block text-xs leading-5 text-[#747B87]">
                                Active categories can be used for product organization.
                            </span>

                        </span>

                    </label>

                </div>

            </div>



            {{-- ============================================================ --}}
            {{-- ACTIONS --}}
            {{-- ============================================================ --}}

            <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

                <a
                    href="{{ route('categories.index') }}"
                    class="inline-flex items-center justify-center rounded-lg border border-[#242830] px-5 py-3 text-sm font-medium text-[#9AA1AD] transition hover:border-[#3A404A] hover:bg-[#171C23] hover:text-white"
                >
                    Cancel
                </a>


                <button
                    type="submit"
                    class="inline-flex items-center justify-center gap-2 rounded-lg bg-[#F5F5F2] px-5 py-3 text-sm font-semibold text-[#080B10] transition hover:bg-white"
                >

                    <span>
                        +
                    </span>

                    Create Category

                </button>

            </div>

        </form>

    </div>

</x-app-layout>