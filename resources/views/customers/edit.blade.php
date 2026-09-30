<x-app-layout>

    <div class="mx-auto max-w-4xl space-y-6">

        {{-- Header --}}
        <div>
            <a
                href="{{ route('customers.show', $customer) }}"
                class="text-sm text-[#8B919A] transition hover:text-white"
            >
                ← Back to Customer
            </a>

            <p class="mt-6 text-xs font-medium uppercase tracking-[0.18em] text-[#8B7CFF]">
                Customers
            </p>

            <h1 class="mt-2 text-2xl font-semibold tracking-tight text-white">
                Edit Customer
            </h1>

            <p class="mt-1 text-sm text-[#8B919A]">
                Update customer information and account status.
            </p>
        </div>


        {{-- Validation Errors --}}
        @if ($errors->any())

            <div class="rounded-xl border border-[#4A2C2C] bg-[#1C1313] px-5 py-4">

                <p class="text-sm font-medium text-[#F3A6A6]">
                    Please fix the following errors:
                </p>

                <ul class="mt-2 space-y-1 text-sm text-[#D88E8E]">

                    @foreach ($errors->all() as $error)

                        <li>
                            • {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        @endif


        {{-- Form --}}
        <form
            action="{{ route('customers.update', $customer) }}"
            method="POST"
            class="overflow-hidden rounded-xl border border-[#242830] bg-[#12151A]"
        >

            @csrf

            @method('PUT')


            {{-- Customer Information --}}
            <div class="border-b border-[#242830] px-6 py-5">

                <h2 class="text-sm font-semibold text-white">
                    Customer Information
                </h2>

                <p class="mt-1 text-xs text-[#707782]">
                    Update the customer's basic information.
                </p>

            </div>


            <div class="space-y-6 px-6 py-6">

                {{-- Name --}}
                <div>

                    <label
                        for="name"
                        class="mb-2 block text-sm font-medium text-[#C5CAD2]"
                    >
                        Customer Name
                        <span class="text-[#8B7CFF]">*</span>
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name', $customer->name) }}"
                        required
                        class="w-full rounded-lg border border-[#2A2F38] bg-[#0D1015] px-4 py-3 text-sm text-white outline-none transition placeholder:text-[#555B65] focus:border-[#8B7CFF] focus:ring-1 focus:ring-[#8B7CFF]"
                    >

                </div>


                {{-- Email + Phone --}}
                <div class="grid gap-6 md:grid-cols-2">

                    <div>

                        <label
                            for="email"
                            class="mb-2 block text-sm font-medium text-[#C5CAD2]"
                        >
                            Email
                        </label>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email', $customer->email) }}"
                            placeholder="customer@example.com"
                            class="w-full rounded-lg border border-[#2A2F38] bg-[#0D1015] px-4 py-3 text-sm text-white outline-none transition placeholder:text-[#555B65] focus:border-[#8B7CFF] focus:ring-1 focus:ring-[#8B7CFF]"
                        >

                    </div>


                    <div>

                        <label
                            for="phone"
                            class="mb-2 block text-sm font-medium text-[#C5CAD2]"
                        >
                            Phone
                        </label>

                        <input
                            type="text"
                            id="phone"
                            name="phone"
                            value="{{ old('phone', $customer->phone) }}"
                            placeholder="+62 812 3456 7890"
                            class="w-full rounded-lg border border-[#2A2F38] bg-[#0D1015] px-4 py-3 text-sm text-white outline-none transition placeholder:text-[#555B65] focus:border-[#8B7CFF] focus:ring-1 focus:ring-[#8B7CFF]"
                        >

                    </div>

                </div>


                {{-- City --}}
                <div>

                    <label
                        for="city"
                        class="mb-2 block text-sm font-medium text-[#C5CAD2]"
                    >
                        City
                    </label>

                    <input
                        type="text"
                        id="city"
                        name="city"
                        value="{{ old('city', $customer->city) }}"
                        placeholder="e.g. Jakarta"
                        class="w-full rounded-lg border border-[#2A2F38] bg-[#0D1015] px-4 py-3 text-sm text-white outline-none transition placeholder:text-[#555B65] focus:border-[#8B7CFF] focus:ring-1 focus:ring-[#8B7CFF]"
                    >

                </div>


                {{-- Address --}}
                <div>

                    <label
                        for="address"
                        class="mb-2 block text-sm font-medium text-[#C5CAD2]"
                    >
                        Address
                    </label>

                    <textarea
                        id="address"
                        name="address"
                        rows="3"
                        placeholder="Customer address"
                        class="w-full resize-none rounded-lg border border-[#2A2F38] bg-[#0D1015] px-4 py-3 text-sm text-white outline-none transition placeholder:text-[#555B65] focus:border-[#8B7CFF] focus:ring-1 focus:ring-[#8B7CFF]"
                    >{{ old('address', $customer->address) }}</textarea>

                </div>


                {{-- Notes --}}
                <div>

                    <label
                        for="notes"
                        class="mb-2 block text-sm font-medium text-[#C5CAD2]"
                    >
                        Notes
                    </label>

                    <textarea
                        id="notes"
                        name="notes"
                        rows="4"
                        placeholder="Additional notes about this customer"
                        class="w-full resize-none rounded-lg border border-[#2A2F38] bg-[#0D1015] px-4 py-3 text-sm text-white outline-none transition placeholder:text-[#555B65] focus:border-[#8B7CFF] focus:ring-1 focus:ring-[#8B7CFF]"
                    >{{ old('notes', $customer->notes) }}</textarea>

                </div>


                {{-- Active Status --}}
                <div class="rounded-lg border border-[#242830] bg-[#0D1015] p-4">

                    <label class="flex cursor-pointer items-start gap-3">

                        <input
                            type="checkbox"
                            name="is_active"
                            value="1"
                            {{ old('is_active', $customer->is_active) ? 'checked' : '' }}
                            class="mt-1 h-4 w-4 rounded border-[#3A3F48] bg-[#12151A] text-[#8B7CFF] focus:ring-[#8B7CFF] focus:ring-offset-0"
                        >

                        <span>

                            <span class="block text-sm font-medium text-white">
                                Active customer
                            </span>

                            <span class="mt-1 block text-xs text-[#707782]">
                                Active customers can be selected for new sales orders.
                            </span>

                        </span>

                    </label>

                </div>

            </div>


            {{-- Actions --}}
            <div class="flex items-center justify-end gap-3 border-t border-[#242830] px-6 py-5">

                <a
                    href="{{ route('customers.show', $customer) }}"
                    class="rounded-lg border border-[#2A2F38] px-4 py-2.5 text-sm font-medium text-[#AEB4BE] transition hover:bg-[#1A1E25] hover:text-white"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="rounded-lg bg-[#8B7CFF] px-5 py-2.5 text-sm font-medium text-white transition hover:bg-[#7C6EF0]"
                >
                    Save Changes
                </button>

            </div>

        </form>

    </div>

</x-app-layout>