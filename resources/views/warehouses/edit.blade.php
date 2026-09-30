<x-app-layout>

    <div class="mx-auto max-w-4xl space-y-8">

        {{-- Header --}}
        <div>

            <div class="flex items-center gap-2 text-xs font-medium uppercase tracking-[0.16em] text-[#68707B]">

                <a
                    href="{{ route('warehouses.index') }}"
                    class="transition hover:text-[#B5BBC4]"
                >
                    Warehouses
                </a>

                <span class="text-[#343A43]">/</span>

                <span>Edit Warehouse</span>

            </div>


            <h1 class="mt-2 text-[30px] font-semibold tracking-[-0.035em] text-[#F5F5F2]">
                Edit Warehouse
            </h1>


            <p class="mt-2 max-w-xl text-sm leading-6 text-[#7E8793]">
                Update warehouse information, location, and operational status.
            </p>

        </div>


        {{-- Validation Errors --}}
        @if ($errors->any())

            <div class="rounded-2xl border border-red-500/20 bg-red-500/5 px-5 py-4">

                <div class="text-sm font-medium text-red-300">
                    Please review the following:
                </div>


                <ul class="mt-2 space-y-1 text-sm text-red-300/80">

                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

            </div>

        @endif


        {{-- Form --}}
        <form
            method="POST"
            action="{{ route('warehouses.update', $warehouse) }}"
            class="space-y-6"
        >

            @csrf
            @method('PUT')


            {{-- Warehouse Information --}}
            <div class="overflow-hidden rounded-2xl border border-[#242830] bg-[#12151A]">

                <div class="border-b border-[#242830] px-6 py-5">

                    <h2 class="text-sm font-semibold text-[#F5F5F2]">
                        Warehouse Information
                    </h2>

                    <p class="mt-1 text-xs text-[#68707B]">
                        Core information used to identify this warehouse.
                    </p>

                </div>


                <div class="grid gap-6 px-6 py-6 sm:grid-cols-2">

                    {{-- Name --}}
                    <div class="sm:col-span-2">

                        <label
                            for="name"
                            class="mb-2 block text-xs font-medium uppercase tracking-[0.12em] text-[#7E8793]"
                        >
                            Warehouse Name
                        </label>


                        <input
                            id="name"
                            name="name"
                            type="text"
                            value="{{ old('name', $warehouse->name) }}"
                            required
                            autofocus
                            class="h-11 w-full rounded-xl border border-[#2A3039] bg-[#0E1116] px-4 text-sm text-[#F5F5F2] outline-none transition placeholder:text-[#555D68] focus:border-[#5B53A6] focus:ring-1 focus:ring-[#5B53A6]"
                        >


                        @error('name')
                            <p class="mt-2 text-xs text-red-300">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Code --}}
                    <div>

                        <label
                            for="code"
                            class="mb-2 block text-xs font-medium uppercase tracking-[0.12em] text-[#7E8793]"
                        >
                            Warehouse Code
                        </label>


                        <input
                            id="code"
                            name="code"
                            type="text"
                            value="{{ old('code', $warehouse->code) }}"
                            required
                            class="h-11 w-full rounded-xl border border-[#2A3039] bg-[#0E1116] px-4 text-sm uppercase text-[#F5F5F2] outline-none transition placeholder:text-[#555D68] focus:border-[#5B53A6] focus:ring-1 focus:ring-[#5B53A6]"
                        >


                        @error('code')
                            <p class="mt-2 text-xs text-red-300">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Phone --}}
                    <div>

                        <label
                            for="phone"
                            class="mb-2 block text-xs font-medium uppercase tracking-[0.12em] text-[#7E8793]"
                        >
                            Phone
                        </label>


                        <input
                            id="phone"
                            name="phone"
                            type="text"
                            value="{{ old('phone', $warehouse->phone) }}"
                            class="h-11 w-full rounded-xl border border-[#2A3039] bg-[#0E1116] px-4 text-sm text-[#F5F5F2] outline-none transition placeholder:text-[#555D68] focus:border-[#5B53A6] focus:ring-1 focus:ring-[#5B53A6]"
                        >


                        @error('phone')
                            <p class="mt-2 text-xs text-red-300">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                </div>

            </div>


            {{-- Location --}}
            <div class="overflow-hidden rounded-2xl border border-[#242830] bg-[#12151A]">

                <div class="border-b border-[#242830] px-6 py-5">

                    <h2 class="text-sm font-semibold text-[#F5F5F2]">
                        Location
                    </h2>

                    <p class="mt-1 text-xs text-[#68707B]">
                        Warehouse address and city.
                    </p>

                </div>


                <div class="grid gap-6 px-6 py-6 sm:grid-cols-2">

                    {{-- Address --}}
                    <div class="sm:col-span-2">

                        <label
                            for="address"
                            class="mb-2 block text-xs font-medium uppercase tracking-[0.12em] text-[#7E8793]"
                        >
                            Address
                        </label>


                        <textarea
                            id="address"
                            name="address"
                            rows="4"
                            class="w-full resize-none rounded-xl border border-[#2A3039] bg-[#0E1116] px-4 py-3 text-sm leading-6 text-[#F5F5F2] outline-none transition placeholder:text-[#555D68] focus:border-[#5B53A6] focus:ring-1 focus:ring-[#5B53A6]"
                        >{{ old('address', $warehouse->address) }}</textarea>


                        @error('address')
                            <p class="mt-2 text-xs text-red-300">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- City --}}
                    <div>

                        <label
                            for="city"
                            class="mb-2 block text-xs font-medium uppercase tracking-[0.12em] text-[#7E8793]"
                        >
                            City
                        </label>


                        <input
                            id="city"
                            name="city"
                            type="text"
                            value="{{ old('city', $warehouse->city) }}"
                            class="h-11 w-full rounded-xl border border-[#2A3039] bg-[#0E1116] px-4 text-sm text-[#F5F5F2] outline-none transition placeholder:text-[#555D68] focus:border-[#5B53A6] focus:ring-1 focus:ring-[#5B53A6]"
                        >


                        @error('city')
                            <p class="mt-2 text-xs text-red-300">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                </div>

            </div>


            {{-- Operational Status --}}
            <div class="overflow-hidden rounded-2xl border border-[#242830] bg-[#12151A]">

                <div class="border-b border-[#242830] px-6 py-5">

                    <h2 class="text-sm font-semibold text-[#F5F5F2]">
                        Operational Status
                    </h2>

                    <p class="mt-1 text-xs text-[#68707B]">
                        Control whether this warehouse is currently available for operations.
                    </p>

                </div>


                <div class="px-6 py-6">

                    <div class="flex items-start justify-between gap-6 rounded-xl border border-[#242830] bg-[#0E1116] px-4 py-4">

                        <div>

                            <div class="text-sm font-medium text-[#F1F1EE]">
                                Active warehouse
                            </div>

                            <p class="mt-1 max-w-lg text-xs leading-5 text-[#68707B]">
                                Active warehouses can be selected for inventory, sales, and purchasing operations.
                            </p>

                        </div>


                        <label class="relative inline-flex shrink-0 cursor-pointer items-center">

                            <input
                                type="checkbox"
                                name="is_active"
                                value="1"
                                class="peer sr-only"
                                @checked(old('is_active', $warehouse->is_active))
                            >


                            <div class="h-6 w-11 rounded-full border border-[#303640] bg-[#242A33] transition peer-checked:border-[#7569D8] peer-checked:bg-[#5E55A7] peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-[#5E55A7]/30"></div>


                            <div class="absolute left-1 top-1 h-4 w-4 rounded-full bg-[#9299A4] transition peer-checked:translate-x-5 peer-checked:bg-white"></div>

                        </label>

                    </div>

                </div>

            </div>


            {{-- Actions --}}
            <div class="flex flex-col-reverse gap-3 border-t border-[#242830] pt-6 sm:flex-row sm:items-center sm:justify-between">

                <a
                    href="{{ route('warehouses.index') }}"
                    class="inline-flex h-11 items-center justify-center rounded-xl border border-[#2A3039] px-5 text-sm font-medium text-[#7E8793] transition hover:bg-[#171B22] hover:text-[#F5F5F2]"
                >
                    Cancel
                </a>


                <button
                    type="submit"
                    class="inline-flex h-11 items-center justify-center gap-2 rounded-xl bg-[#F5F5F2] px-6 text-sm font-semibold text-[#0B0D10] transition hover:bg-white"
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

                    Save Changes

                </button>

            </div>

        </form>

    </div>

</x-app-layout>