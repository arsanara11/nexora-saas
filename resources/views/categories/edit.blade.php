<x-app-layout>

    <div class="space-y-8">

        {{-- HEADER --}}
        <div class="flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between">

            <div>

                <p class="text-[10px] font-semibold uppercase tracking-[0.2em] text-[#727985]">
                    Product Management
                </p>

                <h1 class="mt-2 text-3xl font-semibold tracking-tight text-[#F5F5F2]">
                    Edit Category
                </h1>

                <p class="mt-2 max-w-2xl text-sm leading-6 text-[#8B919A]">
                    Update the information and status of this product category.
                </p>

            </div>

            <a
                href="{{ route('categories.show', $category) }}"
                class="inline-flex items-center justify-center gap-2 rounded-lg border border-[#242830] px-4 py-2.5 text-sm font-medium text-[#B9BEC6] transition hover:border-[#3A404A] hover:bg-[#151A21] hover:text-white"
            >
                <span class="text-base">←</span>
                Back to category
            </a>

        </div>


        {{-- VALIDATION ERRORS --}}
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


        {{-- FORM --}}
        <form
            method="POST"
            action="{{ route('categories.update', $category) }}"
            class="space-y-6"
        >

            @csrf
            @method('PUT')


            {{-- CATEGORY INFORMATION --}}
            <div class="rounded-2xl border border-[#242830] bg-[#12151A]">

                <div class="border-b border-[#242830] px-6 py-5">

                    <h2 class="text-sm font-semibold text-[#F5F5F2]">
                        Category Information
                    </h2>

                    <p class="mt-1 text-xs text-[#747B87]">
                        Update the name, URL slug, and description for this category.
                    </p>

                </div>


                <div class="space-y-6 p-6">

                    {{-- CATEGORY NAME --}}
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
                            value="{{ old('name', $category->name) }}"
                            placeholder="e.g. Electronics"
                            required
                            autofocus
                            class="w-full rounded-lg border border-[#242830] bg-[#0B0D10] px-4 py-3 text-sm text-[#F5F5F2] outline-none transition placeholder:text-[#555C67] focus:border-[#8B7CFF] focus:ring-1 focus:ring-[#8B7CFF]"
                        >

                        <p class="mt-2 text-xs text-[#666C75]">
                            Use a clear and recognizable category name.
                        </p>

                        @error('name')

                            <p class="mt-2 text-xs text-rose-300">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- SLUG --}}
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
                            value="{{ old('slug', $category->slug) }}"
                            placeholder="electronics"
                            class="w-full rounded-lg border border-[#242830] bg-[#0B0D10] px-4 py-3 font-mono text-sm text-[#F5F5F2] outline-none transition placeholder:text-[#555C67] focus:border-[#8B7CFF] focus:ring-1 focus:ring-[#8B7CFF]"
                        >

                        <p class="mt-2 text-xs text-[#666C75]">
                            Keep the slug lowercase and URL-friendly.
                        </p>

                        @error('slug')

                            <p class="mt-2 text-xs text-rose-300">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- DESCRIPTION --}}
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
                        >{{ old('description', $category->description) }}</textarea>

                        <p class="mt-2 text-xs text-[#666C75]">
                            Description is optional.
                        </p>

                        @error('description')

                            <p class="mt-2 text-xs text-rose-300">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>

                </div>

            </div>


            {{-- STATUS --}}
            <div class="rounded-2xl border border-[#242830] bg-[#12151A]">

                <div class="border-b border-[#242830] px-6 py-5">

                    <h2 class="text-sm font-semibold text-[#F5F5F2]">
                        Category Status
                    </h2>

                    <p class="mt-1 text-xs text-[#747B87]">
                        Choose whether this category should remain available.
                    </p>

                </div>


                <div class="p-6">

                    <label class="flex cursor-pointer items-start gap-4">

                        <input
                            type="checkbox"
                            name="is_active"
                            value="1"
                            @checked(old('is_active', $category->is_active))
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


            {{-- CURRENT CATEGORY --}}
            <div class="rounded-2xl border border-[#242830] bg-[#12151A]">

                <div class="border-b border-[#242830] px-6 py-5">

                    <h2 class="text-sm font-semibold text-[#F5F5F2]">
                        Current Category
                    </h2>

                    <p class="mt-1 text-xs text-[#747B87]">
                        Reference information for this category record.
                    </p>

                </div>


                <div class="grid grid-cols-1 md:grid-cols-3">

                    <div class="border-b border-[#242830] px-6 py-5 md:border-r">

                        <p class="text-[10px] font-semibold uppercase tracking-[0.14em] text-[#666C75]">
                            Category ID
                        </p>

                        <p class="mt-2 font-mono text-sm text-[#C8CBD1]">
                            #{{ $category->id }}
                        </p>

                    </div>


                    <div class="border-b border-[#242830] px-6 py-5 md:border-r">

                        <p class="text-[10px] font-semibold uppercase tracking-[0.14em] text-[#666C75]">
                            Products
                        </p>

                        <p class="mt-2 text-sm font-medium text-[#F5F5F2]">
                            {{ $category->products()->count() }}
                        </p>

                    </div>


                    <div class="px-6 py-5">

                        <p class="text-[10px] font-semibold uppercase tracking-[0.14em] text-[#666C75]">
                            Created
                        </p>

                        <p class="mt-2 text-sm text-[#C8CBD1]">
                            {{ $category->created_at?->format('d M Y, H:i') ?? '—' }}
                        </p>

                    </div>

                </div>

            </div>


            {{-- ACTIONS --}}
            <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

                <a
                    href="{{ route('categories.show', $category) }}"
                    class="inline-flex items-center justify-center rounded-lg border border-[#242830] px-5 py-3 text-sm font-medium text-[#9AA1AD] transition hover:border-[#3A404A] hover:bg-[#171C23] hover:text-white"
                >
                    Cancel
                </a>


                <button
                    type="submit"
                    class="inline-flex items-center justify-center gap-2 rounded-lg bg-[#F5F5F2] px-5 py-3 text-sm font-semibold text-[#080B10] transition hover:bg-white"
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
                            d="M5 12l4 4L19 6"
                        />
                    </svg>

                    Update Category
                </button>

            </div>

        </form>

    </div>

</x-app-layout>