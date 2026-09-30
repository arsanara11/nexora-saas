<x-app-layout>

    <div class="space-y-8">

        {{-- Header --}}
        <div class="flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">

            <div>

                <div class="flex items-center gap-2 text-xs font-medium uppercase tracking-[0.16em] text-[#68707B]">

                    <a
                        href="{{ route('warehouses.index') }}"
                        class="transition hover:text-[#B5BBC4]"
                    >
                        Warehouses
                    </a>

                    <span class="text-[#343A43]">/</span>

                    <span>Details</span>

                </div>


                <div class="mt-3 flex items-center gap-4">

                    <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-[#191E26] text-lg font-semibold text-[#A99FFF]">
                        {{ strtoupper(substr($warehouse->name, 0, 1)) }}
                    </div>


                    <div class="min-w-0">

                        <div class="flex flex-wrap items-center gap-3">

                            <h1 class="text-[30px] font-semibold tracking-[-0.035em] text-[#F5F5F2]">
                                {{ $warehouse->name }}
                            </h1>


                            @if ($warehouse->is_active)

                                <span class="inline-flex items-center gap-2 text-xs font-medium text-emerald-300">
                                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>
                                    Active
                                </span>

                            @else

                                <span class="inline-flex items-center gap-2 text-xs font-medium text-[#737C88]">
                                    <span class="h-1.5 w-1.5 rounded-full bg-[#59616D]"></span>
                                    Inactive
                                </span>

                            @endif

                        </div>


                        <p class="mt-1 text-sm text-[#68707B]">
                            {{ $warehouse->code }}
                        </p>

                    </div>

                </div>

            </div>


            <div class="flex items-center gap-2">

                <a
                    href="{{ route('warehouses.edit', $warehouse) }}"
                    class="inline-flex h-10 items-center gap-2 rounded-xl border border-[#2A3039] bg-[#12151A] px-4 text-sm font-medium text-[#B8BEC7] transition hover:border-[#454C59] hover:bg-[#171B22] hover:text-white"
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
                            d="M16.862 3.487a2.1 2.1 0 013 2.97L8.75 16.57l-4.25 1.06 1.06-4.25L16.862 3.487z"
                        />
                    </svg>

                    Edit

                </a>


                <a
                    href="{{ route('warehouses.index') }}"
                    class="inline-flex h-10 items-center justify-center rounded-xl border border-[#2A3039] px-4 text-sm font-medium text-[#7E8793] transition hover:bg-[#171B22] hover:text-[#F5F5F2]"
                >
                    Back
                </a>

            </div>

        </div>


        {{-- Overview --}}
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">

            {{-- Inventory Items --}}
            <div class="rounded-2xl border border-[#242830] bg-[#12151A] px-5 py-4">

                <div class="text-xs font-medium uppercase tracking-[0.14em] text-[#68707B]">
                    Inventory Items
                </div>

                <div class="mt-3 text-2xl font-semibold tracking-[-0.02em] text-[#F5F5F2]">
                    {{ $orderSummary['inventory_items'] }}
                </div>

                <div class="mt-1 text-xs text-[#59616C]">
                    Product variants
                </div>

            </div>


            {{-- Available Stock --}}
            <div class="rounded-2xl border border-[#242830] bg-[#12151A] px-5 py-4">

                <div class="text-xs font-medium uppercase tracking-[0.14em] text-[#68707B]">
                    Available Stock
                </div>

                <div class="mt-3 text-2xl font-semibold tracking-[-0.02em] text-[#F5F5F2]">
                    {{ number_format($stockSummary['available_quantity']) }}
                </div>

                <div class="mt-1 text-xs text-[#59616C]">
                    Units available
                </div>

            </div>


            {{-- Sales Orders --}}
            <div class="rounded-2xl border border-[#242830] bg-[#12151A] px-5 py-4">

                <div class="text-xs font-medium uppercase tracking-[0.14em] text-[#68707B]">
                    Sales Orders
                </div>

                <div class="mt-3 text-2xl font-semibold tracking-[-0.02em] text-[#F5F5F2]">
                    {{ $orderSummary['sales_orders'] }}
                </div>

                <div class="mt-1 text-xs text-[#59616C]">
                    Orders linked to warehouse
                </div>

            </div>


            {{-- Purchase Orders --}}
            <div class="rounded-2xl border border-[#242830] bg-[#12151A] px-5 py-4">

                <div class="text-xs font-medium uppercase tracking-[0.14em] text-[#68707B]">
                    Purchase Orders
                </div>

                <div class="mt-3 text-2xl font-semibold tracking-[-0.02em] text-[#F5F5F2]">
                    {{ $orderSummary['purchase_orders'] }}
                </div>

                <div class="mt-1 text-xs text-[#59616C]">
                    Inbound purchasing activity
                </div>

            </div>

        </div>


        {{-- Main Content --}}
        <div class="grid grid-cols-1 gap-6 xl:grid-cols-[360px_minmax(0,1fr)]">

            {{-- Warehouse Information --}}
            <div class="rounded-2xl border border-[#242830] bg-[#12151A]">

                <div class="border-b border-[#242830] px-6 py-5">

                    <h2 class="text-sm font-semibold text-[#F5F5F2]">
                        Warehouse Information
                    </h2>

                    <p class="mt-1 text-xs text-[#68707B]">
                        Location and operational details.
                    </p>

                </div>


                <div class="divide-y divide-[#1D2229]">

                    {{-- Code --}}
                    <div class="px-6 py-5">

                        <div class="text-[10px] font-medium uppercase tracking-[0.14em] text-[#555D68]">
                            Warehouse Code
                        </div>

                        <div class="mt-2 text-sm text-[#C2C7CF]">
                            {{ $warehouse->code }}
                        </div>

                    </div>


                    {{-- Phone --}}
                    <div class="px-6 py-5">

                        <div class="text-[10px] font-medium uppercase tracking-[0.14em] text-[#555D68]">
                            Phone
                        </div>

                        @if ($warehouse->phone)

                            <a
                                href="tel:{{ $warehouse->phone }}"
                                class="mt-2 block text-sm text-[#B8BEC7] transition hover:text-white"
                            >
                                {{ $warehouse->phone }}
                            </a>

                        @else

                            <div class="mt-2 text-sm text-[#59616C]">
                                Not provided
                            </div>

                        @endif

                    </div>


                    {{-- City --}}
                    <div class="px-6 py-5">

                        <div class="text-[10px] font-medium uppercase tracking-[0.14em] text-[#555D68]">
                            City
                        </div>

                        <div class="mt-2 text-sm text-[#C2C7CF]">
                            {{ $warehouse->city ?: 'Not provided' }}
                        </div>

                    </div>


                    {{-- Address --}}
                    <div class="px-6 py-5">

                        <div class="text-[10px] font-medium uppercase tracking-[0.14em] text-[#555D68]">
                            Address
                        </div>

                        <div class="mt-2 text-sm leading-6 text-[#AEB4BD]">
                            {{ $warehouse->address ?: 'Not provided' }}
                        </div>

                    </div>


                    {{-- Available --}}
                    <div class="px-6 py-5">

                        <div class="text-[10px] font-medium uppercase tracking-[0.14em] text-[#555D68]">
                            Available Stock
                        </div>

                        <div class="mt-2 text-sm text-[#C2C7CF]">
                            {{ number_format($stockSummary['available_quantity']) }} units
                        </div>

                        @if ($stockSummary['reserved_quantity'] > 0)

                            <div class="mt-1 text-xs text-[#68707B]">
                                {{ number_format($stockSummary['reserved_quantity']) }} reserved
                            </div>

                        @endif

                    </div>

                </div>

            </div>


            {{-- Inventory --}}
            <div class="overflow-hidden rounded-2xl border border-[#242830] bg-[#12151A]">

                <div class="flex flex-col gap-3 border-b border-[#242830] px-6 py-5 sm:flex-row sm:items-center sm:justify-between">

                    <div>

                        <h2 class="text-sm font-semibold text-[#F5F5F2]">
                            Current Inventory
                        </h2>

                        <p class="mt-1 text-xs text-[#68707B]">
                            Product stock currently assigned to this warehouse.
                        </p>

                    </div>


                    <a
                        href="{{ route('inventory.create') }}"
                        class="inline-flex h-9 items-center justify-center rounded-lg border border-[#2A3039] px-3 text-xs font-medium text-[#B8BEC7] transition hover:border-[#454C59] hover:bg-[#1B2028] hover:text-white"
                    >
                        Add Inventory
                    </a>

                </div>


                @if ($inventoryItems->isEmpty())

                    <div class="px-6 py-20 text-center">

                        <div class="mx-auto flex h-11 w-11 items-center justify-center rounded-xl border border-[#2A3039] bg-[#171B22] text-[#68707B]">

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1.7"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M20 7l-8-4-8 4m16 0-8 4m8-4v10l-8 4m0-10L4 7m8 4v10"
                                />
                            </svg>

                        </div>

                        <h3 class="mt-4 text-sm font-semibold text-[#F5F5F2]">
                            No inventory recorded
                        </h3>

                        <p class="mx-auto mt-2 max-w-sm text-sm leading-6 text-[#68707B]">
                            Inventory items assigned to this warehouse will appear here.
                        </p>

                    </div>

                @else

                    {{-- Desktop --}}
                    <div class="hidden overflow-x-auto md:block">

                        <table class="w-full min-w-[650px]">

                            <thead>

                                <tr class="border-b border-[#1F242C]">

                                    <th class="px-6 py-4 text-left text-[11px] font-medium uppercase tracking-[0.14em] text-[#626A75]">
                                        Product
                                    </th>

                                    <th class="px-6 py-4 text-left text-[11px] font-medium uppercase tracking-[0.14em] text-[#626A75]">
                                        Quantity
                                    </th>

                                    <th class="px-6 py-4 text-left text-[11px] font-medium uppercase tracking-[0.14em] text-[#626A75]">
                                        Reserved
                                    </th>

                                    <th class="px-6 py-4 text-left text-[11px] font-medium uppercase tracking-[0.14em] text-[#626A75]">
                                        Available
                                    </th>

                                    <th class="px-6 py-4 text-left text-[11px] font-medium uppercase tracking-[0.14em] text-[#626A75]">
                                        Reorder
                                    </th>

                                </tr>

                            </thead>


                            <tbody class="divide-y divide-[#1D2229]">

                                @foreach ($inventoryItems as $inventory)

                                    @php
                                        $quantity = (int) $inventory->quantity;
                                        $reserved = (int) $inventory->reserved_quantity;
                                        $available = $quantity - $reserved;
                                        $reorderLevel = (int) $inventory->reorder_level;
                                    @endphp

                                    <tr class="transition hover:bg-[#15191F]">

                                        {{-- Product --}}
                                        <td class="px-6 py-5">

                                            <div class="flex items-center gap-3">

                                                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-[#191E26] text-xs font-semibold text-[#A99FFF]">
                                                    {{ strtoupper(substr($inventory->productVariant->product?->name ?? $inventory->productVariant->name, 0, 1)) }}
                                                </div>

                                                <div class="min-w-0">

                                                    <div class="truncate text-sm font-medium text-[#F1F1EE]">
                                                        {{ $inventory->productVariant->product?->name ?? $inventory->productVariant->name }}
                                                    </div>

                                                    <div class="mt-1 text-xs text-[#68707B]">
                                                        {{ $inventory->productVariant->name }}
                                                        @if ($inventory->productVariant->sku)
                                                            · {{ $inventory->productVariant->sku }}
                                                        @endif
                                                    </div>

                                                </div>

                                            </div>

                                        </td>


                                        {{-- Quantity --}}
                                        <td class="px-6 py-5">

                                            <span class="text-sm text-[#C2C7CF]">
                                                {{ number_format($quantity) }}
                                            </span>

                                        </td>


                                        {{-- Reserved --}}
                                        <td class="px-6 py-5">

                                            <span class="text-sm text-[#8B919A]">
                                                {{ number_format($reserved) }}
                                            </span>

                                        </td>


                                        {{-- Available --}}
                                        <td class="px-6 py-5">

                                            @if ($available <= 0)

                                                <span class="text-sm font-medium text-red-300">
                                                    {{ number_format($available) }}
                                                </span>

                                            @elseif ($available <= $reorderLevel)

                                                <span class="text-sm font-medium text-amber-300">
                                                    {{ number_format($available) }}
                                                </span>

                                            @else

                                                <span class="text-sm font-medium text-emerald-300">
                                                    {{ number_format($available) }}
                                                </span>

                                            @endif

                                        </td>


                                        {{-- Reorder --}}
                                        <td class="px-6 py-5">

                                            <span class="text-sm text-[#8B919A]">
                                                {{ number_format($reorderLevel) }}
                                            </span>

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>


                    {{-- Mobile --}}
                    <div class="divide-y divide-[#1D2229] md:hidden">

                        @foreach ($inventoryItems as $inventory)

                            @php
                                $quantity = (int) $inventory->quantity;
                                $reserved = (int) $inventory->reserved_quantity;
                                $available = $quantity - $reserved;
                                $reorderLevel = (int) $inventory->reorder_level;
                            @endphp

                            <a
                                href="{{ route('inventory.show', $inventory) }}"
                                class="block px-5 py-5 transition hover:bg-[#15191F]"
                            >

                                <div class="flex items-start justify-between gap-4">

                                    <div class="flex min-w-0 items-center gap-3">

                                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-[#191E26] text-xs font-semibold text-[#A99FFF]">
                                            {{ strtoupper(substr($inventory->productVariant->product?->name ?? $inventory->productVariant->name, 0, 1)) }}
                                        </div>


                                        <div class="min-w-0">

                                            <div class="truncate text-sm font-medium text-[#F1F1EE]">
                                                {{ $inventory->productVariant->product?->name ?? $inventory->productVariant->name }}
                                            </div>

                                            <div class="mt-1 text-xs text-[#68707B]">
                                                {{ $inventory->productVariant->name }}
                                            </div>

                                        </div>

                                    </div>


                                    @if ($available <= 0)

                                        <span class="shrink-0 text-xs font-medium text-red-300">
                                            Out of stock
                                        </span>

                                    @elseif ($available <= $reorderLevel)

                                        <span class="shrink-0 text-xs font-medium text-amber-300">
                                            Low stock
                                        </span>

                                    @else

                                        <span class="shrink-0 text-xs font-medium text-emerald-300">
                                            Healthy
                                        </span>

                                    @endif

                                </div>


                                <div class="mt-4 grid grid-cols-3 gap-3">

                                    <div>

                                        <div class="text-[10px] font-medium uppercase tracking-[0.12em] text-[#555D68]">
                                            Quantity
                                        </div>

                                        <div class="mt-1 text-sm text-[#C2C7CF]">
                                            {{ number_format($quantity) }}
                                        </div>

                                    </div>


                                    <div>

                                        <div class="text-[10px] font-medium uppercase tracking-[0.12em] text-[#555D68]">
                                            Reserved
                                        </div>

                                        <div class="mt-1 text-sm text-[#C2C7CF]">
                                            {{ number_format($reserved) }}
                                        </div>

                                    </div>


                                    <div>

                                        <div class="text-[10px] font-medium uppercase tracking-[0.12em] text-[#555D68]">
                                            Available
                                        </div>

                                        <div class="mt-1 text-sm font-medium text-[#C2C7CF]">
                                            {{ number_format($available) }}
                                        </div>

                                    </div>

                                </div>

                            </a>

                        @endforeach

                    </div>

                @endif

            </div>

        </div>


        {{-- Operational Activity --}}
        <div class="overflow-hidden rounded-2xl border border-[#242830] bg-[#12151A]">

            <div class="border-b border-[#242830] px-6 py-5">

                <h2 class="text-sm font-semibold text-[#F5F5F2]">
                    Operational Activity
                </h2>

                <p class="mt-1 text-xs text-[#68707B]">
                    Activity connected to this warehouse.
                </p>

            </div>


            <div class="grid grid-cols-1 divide-y divide-[#1D2229] sm:grid-cols-3 sm:divide-x sm:divide-y-0">

                <div class="px-6 py-5">

                    <div class="text-[10px] font-medium uppercase tracking-[0.14em] text-[#555D68]">
                        Sales Orders
                    </div>

                    <div class="mt-2 text-lg font-semibold text-[#F5F5F2]">
                        {{ $orderSummary['sales_orders'] }}
                    </div>

                </div>


                <div class="px-6 py-5">

                    <div class="text-[10px] font-medium uppercase tracking-[0.14em] text-[#555D68]">
                        Purchase Orders
                    </div>

                    <div class="mt-2 text-lg font-semibold text-[#F5F5F2]">
                        {{ $orderSummary['purchase_orders'] }}
                    </div>

                </div>


                <div class="px-6 py-5">

                    <div class="text-[10px] font-medium uppercase tracking-[0.14em] text-[#555D68]">
                        Stock Movements
                    </div>

                    <div class="mt-2 text-lg font-semibold text-[#F5F5F2]">
                        {{ $orderSummary['stock_movements'] }}
                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>