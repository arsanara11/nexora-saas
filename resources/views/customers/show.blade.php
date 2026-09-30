<x-app-layout>

    <div class="space-y-6">

        {{-- Header --}}
        <div class="flex items-start justify-between gap-4">

            <div>

                <a
                    href="{{ route('customers.index') }}"
                    class="text-sm text-[#8B919A] transition hover:text-white"
                >
                    ← Back to Customers
                </a>

                <div class="mt-6 flex items-center gap-4">

                    <div class="flex h-14 w-14 items-center justify-center rounded-full bg-[#1B1F27] text-lg font-semibold text-[#8B7CFF]">
                        {{ strtoupper(substr($customer->name, 0, 1)) }}
                    </div>

                    <div>

                        <p class="text-xs font-medium uppercase tracking-[0.18em] text-[#8B7CFF]">
                            Customer
                        </p>

                        <h1 class="mt-1 text-2xl font-semibold tracking-tight text-white">
                            {{ $customer->name }}
                        </h1>

                    </div>

                </div>

            </div>


            <div class="flex items-center gap-3">

                <a
                    href="{{ route('customers.edit', $customer) }}"
                    class="rounded-lg border border-[#2A2F38] px-4 py-2.5 text-sm font-medium text-[#C5CAD2] transition hover:bg-[#1A1E25] hover:text-white"
                >
                    Edit Customer
                </a>

            </div>

        </div>


        {{-- Success Message --}}
        @if (session('success'))

            <div class="rounded-lg border border-[#26352D] bg-[#111A15] px-4 py-3 text-sm text-[#9FE2B5]">
                {{ session('success') }}
            </div>

        @endif


        {{-- Customer Overview --}}
        <div class="grid gap-6 lg:grid-cols-3">

            {{-- Contact Information --}}
            <div class="rounded-xl border border-[#242830] bg-[#12151A] lg:col-span-2">

                <div class="border-b border-[#242830] px-6 py-5">

                    <h2 class="text-sm font-semibold text-white">
                        Customer Information
                    </h2>

                    <p class="mt-1 text-xs text-[#707782]">
                        Contact and profile information.
                    </p>

                </div>


                <div class="grid gap-6 px-6 py-6 md:grid-cols-2">

                    {{-- Email --}}
                    <div>

                        <p class="text-xs font-medium uppercase tracking-wider text-[#707782]">
                            Email
                        </p>

                        @if ($customer->email)

                            <p class="mt-2 text-sm text-[#C5CAD2]">
                                {{ $customer->email }}
                            </p>

                        @else

                            <p class="mt-2 text-sm text-[#555B65]">
                                Not provided
                            </p>

                        @endif

                    </div>


                    {{-- Phone --}}
                    <div>

                        <p class="text-xs font-medium uppercase tracking-wider text-[#707782]">
                            Phone
                        </p>

                        @if ($customer->phone)

                            <p class="mt-2 text-sm text-[#C5CAD2]">
                                {{ $customer->phone }}
                            </p>

                        @else

                            <p class="mt-2 text-sm text-[#555B65]">
                                Not provided
                            </p>

                        @endif

                    </div>


                    {{-- City --}}
                    <div>

                        <p class="text-xs font-medium uppercase tracking-wider text-[#707782]">
                            City
                        </p>

                        @if ($customer->city)

                            <p class="mt-2 text-sm text-[#C5CAD2]">
                                {{ $customer->city }}
                            </p>

                        @else

                            <p class="mt-2 text-sm text-[#555B65]">
                                Not provided
                            </p>

                        @endif

                    </div>


                    {{-- Status --}}
                    <div>

                        <p class="text-xs font-medium uppercase tracking-wider text-[#707782]">
                            Status
                        </p>

                        <div class="mt-2">

                            @if ($customer->is_active)

                                <span class="inline-flex items-center rounded-full border border-[#294333] bg-[#122019] px-2.5 py-1 text-xs font-medium text-[#9FE2B5]">
                                    <span class="mr-1.5 h-1.5 w-1.5 rounded-full bg-[#63D889]"></span>
                                    Active
                                </span>

                            @else

                                <span class="inline-flex items-center rounded-full border border-[#3A3E45] bg-[#1A1D22] px-2.5 py-1 text-xs font-medium text-[#8B919A]">
                                    <span class="mr-1.5 h-1.5 w-1.5 rounded-full bg-[#686F79]"></span>
                                    Inactive
                                </span>

                            @endif

                        </div>

                    </div>


                    {{-- Address --}}
                    <div class="md:col-span-2">

                        <p class="text-xs font-medium uppercase tracking-wider text-[#707782]">
                            Address
                        </p>

                        @if ($customer->address)

                            <p class="mt-2 whitespace-pre-line text-sm leading-6 text-[#C5CAD2]">
                                {{ $customer->address }}
                            </p>

                        @else

                            <p class="mt-2 text-sm text-[#555B65]">
                                Not provided
                            </p>

                        @endif

                    </div>


                    {{-- Notes --}}
                    <div class="md:col-span-2">

                        <p class="text-xs font-medium uppercase tracking-wider text-[#707782]">
                            Notes
                        </p>

                        @if ($customer->notes)

                            <p class="mt-2 whitespace-pre-line text-sm leading-6 text-[#C5CAD2]">
                                {{ $customer->notes }}
                            </p>

                        @else

                            <p class="mt-2 text-sm text-[#555B65]">
                                No notes
                            </p>

                        @endif

                    </div>

                </div>

            </div>


            {{-- Customer Summary --}}
            <div class="rounded-xl border border-[#242830] bg-[#12151A]">

                <div class="border-b border-[#242830] px-6 py-5">

                    <h2 class="text-sm font-semibold text-white">
                        Customer Summary
                    </h2>

                </div>


                <div class="space-y-5 px-6 py-6">

                    <div>

                        <p class="text-xs uppercase tracking-wider text-[#707782]">
                            Total Orders
                        </p>

                        <p class="mt-2 text-2xl font-semibold text-white">
                            {{ $customer->orders->count() }}
                        </p>

                    </div>


                    <div>

                        <p class="text-xs uppercase tracking-wider text-[#707782]">
                            Customer Since
                        </p>

                        <p class="mt-2 text-sm text-[#C5CAD2]">
                            {{ $customer->created_at?->format('d M Y') }}
                        </p>

                    </div>


                    <div>

                        <p class="text-xs uppercase tracking-wider text-[#707782]">
                            Last Updated
                        </p>

                        <p class="mt-2 text-sm text-[#C5CAD2]">
                            {{ $customer->updated_at?->format('d M Y') }}
                        </p>

                    </div>

                </div>

            </div>

        </div>


        {{-- Order History --}}
        <div class="overflow-hidden rounded-xl border border-[#242830] bg-[#12151A]">

            <div class="border-b border-[#242830] px-6 py-5">

                <h2 class="text-sm font-semibold text-white">
                    Order History
                </h2>

                <p class="mt-1 text-xs text-[#707782]">
                    Sales orders associated with this customer.
                </p>

            </div>


            @if ($customer->orders->count())

                <div class="overflow-x-auto">

                    <table class="min-w-full">

                        <thead>

                            <tr class="border-b border-[#242830] text-left">

                                <th class="px-6 py-4 text-xs font-medium uppercase tracking-wider text-[#707782]">
                                    Order
                                </th>

                                <th class="px-6 py-4 text-xs font-medium uppercase tracking-wider text-[#707782]">
                                    Date
                                </th>

                                <th class="px-6 py-4 text-xs font-medium uppercase tracking-wider text-[#707782]">
                                    Total
                                </th>

                                <th class="px-6 py-4 text-xs font-medium uppercase tracking-wider text-[#707782]">
                                    Status
                                </th>

                                <th class="px-6 py-4 text-right text-xs font-medium uppercase tracking-wider text-[#707782]">
                                    Action
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y divide-[#242830]">

                            @foreach ($customer->orders as $order)

                                <tr class="transition hover:bg-[#171B21]">

                                    <td class="whitespace-nowrap px-6 py-5">

                                        <span class="text-sm font-medium text-white">
                                            {{ $order->order_number }}
                                        </span>

                                    </td>


                                    <td class="whitespace-nowrap px-6 py-5">

                                        <span class="text-sm text-[#AEB4BE]">
                                            {{ $order->ordered_at?->format('d M Y') ?? $order->created_at?->format('d M Y') }}
                                        </span>

                                    </td>


                                    <td class="whitespace-nowrap px-6 py-5">

                                        <span class="text-sm text-[#C5CAD2]">
                                            Rp {{ number_format($order->total, 0, ',', '.') }}
                                        </span>

                                    </td>


                                    <td class="whitespace-nowrap px-6 py-5">

                                        @php
                                            $statusClasses = match ($order->status) {
                                                'pending' => 'border-[#51462A] bg-[#211D12] text-[#D9C57A]',
                                                'confirmed' => 'border-[#303A52] bg-[#151B29] text-[#9EB6E8]',
                                                'processing' => 'border-[#3C3155] bg-[#1D1628] text-[#BBA8EA]',
                                                'completed' => 'border-[#294333] bg-[#122019] text-[#9FE2B5]',
                                                'cancelled' => 'border-[#4A2C2C] bg-[#1C1313] text-[#D88E8E]',
                                                default => 'border-[#3A3E45] bg-[#1A1D22] text-[#8B919A]',
                                            };
                                        @endphp

                                        <span class="inline-flex rounded-full border px-2.5 py-1 text-xs font-medium {{ $statusClasses }}">
                                            {{ ucfirst($order->status) }}
                                        </span>

                                    </td>


                                    <td class="whitespace-nowrap px-6 py-5 text-right">

                                        <a
                                            href="{{ route('orders.show', $order) }}"
                                            class="text-sm font-medium text-[#8B7CFF] transition hover:text-white"
                                        >
                                            View
                                        </a>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="px-6 py-12 text-center">

                    <p class="text-sm text-[#707782]">
                        This customer has no sales orders yet.
                    </p>

                </div>

            @endif

        </div>


        {{-- Danger Zone --}}
        <div class="rounded-xl border border-[#3A2929] bg-[#121314]">

            <div class="border-b border-[#3A2929] px-6 py-5">

                <h2 class="text-sm font-semibold text-[#E0A0A0]">
                    Danger Zone
                </h2>

                <p class="mt-1 text-xs text-[#707782]">
                    Permanently remove this customer from NEXORA.
                </p>

            </div>


            <div class="flex items-center justify-between gap-6 px-6 py-5">

                <div>

                    <p class="text-sm font-medium text-white">
                        Delete Customer
                    </p>

                    <p class="mt-1 text-xs text-[#707782]">
                        Customers with existing orders cannot be deleted.
                    </p>

                </div>


                <form
                    action="{{ route('customers.destroy', $customer) }}"
                    method="POST"
                    onsubmit="return confirm('Are you sure you want to delete this customer?');"
                >

                    @csrf

                    @method('DELETE')

                    <button
                        type="submit"
                        class="rounded-lg border border-[#5A3030] px-4 py-2.5 text-sm font-medium text-[#D88E8E] transition hover:bg-[#251719] hover:text-[#F0B0B0]"
                    >
                        Delete Customer
                    </button>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>