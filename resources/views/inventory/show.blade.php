<x-app-layout>

    <div class="w-full max-w-[1500px]">

        {{-- Breadcrumb --}}
        <div class="mb-7 ml-1 flex items-center gap-2 text-sm">

            <a
                href="{{ route('inventory.index') }}"
                class="text-[#8B919A] transition hover:text-[#F5F5F2]"
            >
                Inventory Management
            </a>

            <span class="text-[#3A3F48]">
                ›
            </span>

            <span class="text-[#F5F5F2]">
                Inventory Detail
            </span>

        </div>


        {{-- Header --}}
        <div class="mb-8 flex items-center justify-between">

            <div>

                <h1 class="text-3xl font-semibold tracking-tight text-[#F5F5F2]">
                    Inventory Detail
                </h1>

                <p class="mt-2 text-sm text-[#8B919A]">
                    Stock information and inventory status.
                </p>

            </div>


            <div class="flex items-center gap-3">

                <a
                    href="{{ route('inventory.index') }}"
                    class="rounded-xl border border-[#242830] bg-[#12151A] px-5 py-3 text-sm font-medium text-[#F5F5F2] transition hover:border-[#8B7CFF] hover:text-[#8B7CFF]"
                >
                    ← Back to Inventory
                </a>

                <a
                    href="{{ route('inventory.edit', $inventory) }}"
                    class="rounded-xl bg-[#8B7CFF] px-5 py-3 text-sm font-medium text-white transition hover:opacity-90"
                >
                    Edit Inventory
                </a>

            </div>

        </div>


        {{-- Product Card --}}
        <div class="mb-5 w-full rounded-2xl border border-[#242830] bg-[#12151A]">

            <div class="flex min-h-[150px] items-center justify-between px-9 py-7">

                <div class="flex items-center gap-6">

                    {{-- Product Icon --}}
                    <div class="flex h-20 w-20 shrink-0 items-center justify-center rounded-xl border border-[#242830] bg-[#0B0D10]">

                        <svg
                            class="h-9 w-9 text-[#8B7CFF]"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.5"
                                d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0L5 6.27A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.5"
                                d="M3.27 6.96L12 12l8.73-5.04M12 22.08V12"
                            />
                        </svg>

                    </div>


                    {{-- Product Info --}}
                    <div>

                        <p class="text-xs font-medium uppercase tracking-[0.18em] text-[#8B919A]">
                            Product
                        </p>

                        <h2 class="mt-2 text-2xl font-semibold text-[#F5F5F2]">
                            {{ $inventory->productVariant->product->name ?? '—' }}
                        </h2>

                        <div class="mt-2 flex items-center gap-3 text-sm text-[#8B919A]">

                            <span>
                                {{ $inventory->productVariant->name ?? '—' }}
                            </span>

                            <span class="text-[#3A3F48]">
                                •
                            </span>

                            <span class="font-mono">
                                {{ $inventory->productVariant->sku ?? '—' }}
                            </span>

                        </div>

                    </div>

                </div>


                {{-- Status --}}
                @if($inventory->isLowStock())

                    <span class="flex shrink-0 items-center gap-2 rounded-full border border-red-500/30 bg-red-500/10 px-4 py-2 text-xs font-medium text-red-400">

                        <span class="h-1.5 w-1.5 rounded-full bg-red-400"></span>

                        Low Stock

                    </span>

                @else

                    <span class="flex shrink-0 items-center gap-2 rounded-full border border-emerald-500/30 bg-emerald-500/10 px-4 py-2 text-xs font-medium text-emerald-400">

                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>

                        Healthy

                    </span>

                @endif

            </div>

        </div>


        {{-- Stock Metrics --}}
        <div class="mb-5 grid grid-cols-4 gap-5">


            {{-- Warehouse --}}
            <div class="rounded-2xl border border-[#242830] bg-[#12151A] px-6 py-6">

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-[#8B7CFF]/10 text-[#8B7CFF]">

                    <svg
                        class="h-6 w-6"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.5"
                            d="M3 21h18M5 21V9l7-5 7 5v12M9 21v-6h6v6"
                        />
                    </svg>

                </div>

                <p class="mt-5 text-xs font-medium uppercase tracking-[0.15em] text-[#8B919A]">
                    Warehouse
                </p>

                <p class="mt-2 truncate text-base font-semibold text-[#F5F5F2]">
                    {{ $inventory->warehouse->name ?? '—' }}
                </p>

            </div>


            {{-- Total Stock --}}
            <div class="rounded-2xl border border-[#242830] bg-[#12151A] px-6 py-6">

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-[#8B7CFF]/10 text-[#8B7CFF]">

                    <svg
                        class="h-6 w-6"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.5"
                            d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0L5 6.27A2 2 0 003 8v8a2 2 0 002 1.73l7-4a2 2 0 002 0l7-4A2 2 0 0021 16z"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.5"
                            d="M3.27 6.96L12 12l8.73-5.04M12 22.08V12"
                        />
                    </svg>

                </div>

                <p class="mt-5 text-xs font-medium uppercase tracking-[0.15em] text-[#8B919A]">
                    Total Stock
                </p>

                <p class="mt-2 text-3xl font-semibold text-[#F5F5F2]">
                    {{ $inventory->quantity }}
                </p>

            </div>


            {{-- Reserved --}}
            <div class="rounded-2xl border border-[#242830] bg-[#12151A] px-6 py-6">

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-amber-500/10 text-amber-400">

                    <svg
                        class="h-6 w-6"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <circle
                            cx="12"
                            cy="12"
                            r="9"
                            stroke-width="1.5"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-width="1.5"
                            d="M12 7v5l3 2"
                        />
                    </svg>

                </div>

                <p class="mt-5 text-xs font-medium uppercase tracking-[0.15em] text-[#8B919A]">
                    Reserved
                </p>

                <p class="mt-2 text-3xl font-semibold text-[#F5F5F2]">
                    {{ $inventory->reserved_quantity }}
                </p>

            </div>


            {{-- Available --}}
            <div class="rounded-2xl border border-[#242830] bg-[#12151A] px-6 py-6">

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-[#8B7CFF]/10 text-[#8B7CFF]">

                    <svg
                        class="h-6 w-6"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.5"
                            d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 002 1.73l7-4"
                        />
                    </svg>

                </div>

                <p class="mt-5 text-xs font-medium uppercase tracking-[0.15em] text-[#8B919A]">
                    Available
                </p>

                <p class="mt-2 text-3xl font-semibold text-[#8B7CFF]">
                    {{ $inventory->available_quantity }}
                </p>

            </div>

        </div>


        {{-- Inventory Information --}}
        <div class="w-full overflow-hidden rounded-2xl border border-[#242830] bg-[#12151A]">

            {{-- Header --}}
            <div class="border-b border-[#242830] px-9 py-6">

                <div class="flex items-center gap-4">

                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#8B7CFF]/10 text-[#8B7CFF]">

                        <svg
                            class="h-5 w-5"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <circle
                                cx="12"
                                cy="12"
                                r="9"
                                stroke-width="1.5"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-width="1.5"
                                d="M12 11v5M12 8h.01"
                            />
                        </svg>

                    </div>

                    <div>

                        <h2 class="text-lg font-semibold text-[#F5F5F2]">
                            Inventory Information
                        </h2>

                        <p class="mt-1 text-sm text-[#8B919A]">
                            Detailed information for this stock record.
                        </p>

                    </div>

                </div>

            </div>


            {{-- Two Columns --}}
            <div class="grid grid-cols-2">

                {{-- LEFT --}}
                <div class="border-r border-[#242830] px-9">

                    <div class="flex items-center justify-between border-b border-[#242830] py-5">

                        <span class="text-sm text-[#8B919A]">
                            Product
                        </span>

                        <span class="text-right text-sm font-medium text-[#F5F5F2]">
                            {{ $inventory->productVariant->product->name ?? '—' }}
                        </span>

                    </div>


                    <div class="flex items-center justify-between border-b border-[#242830] py-5">

                        <span class="text-sm text-[#8B919A]">
                            Variant
                        </span>

                        <span class="text-right text-sm font-medium text-[#F5F5F2]">
                            {{ $inventory->productVariant->name ?? '—' }}
                        </span>

                    </div>


                    <div class="flex items-center justify-between border-b border-[#242830] py-5">

                        <span class="text-sm text-[#8B919A]">
                            SKU
                        </span>

                        <span class="text-right font-mono text-sm text-[#F5F5F2]">
                            {{ $inventory->productVariant->sku ?? '—' }}
                        </span>

                    </div>


                    <div class="flex items-center justify-between py-5">

                        <span class="text-sm text-[#8B919A]">
                            Warehouse
                        </span>

                        <span class="text-right text-sm font-medium text-[#F5F5F2]">
                            {{ $inventory->warehouse->name ?? '—' }}
                        </span>

                    </div>

                </div>


                {{-- RIGHT --}}
                <div class="px-9">

                    <div class="flex items-center justify-between border-b border-[#242830] py-5">

                        <span class="text-sm text-[#8B919A]">
                            Reorder Level
                        </span>

                        <span class="text-right text-sm font-medium text-[#F5F5F2]">
                            {{ $inventory->reorder_level }}
                        </span>

                    </div>


                    <div class="flex items-center justify-between border-b border-[#242830] py-5">

                        <span class="text-sm text-[#8B919A]">
                            Total Stock
                        </span>

                        <span class="text-right text-sm font-medium text-[#F5F5F2]">
                            {{ $inventory->quantity }}
                        </span>

                    </div>


                    <div class="flex items-center justify-between border-b border-[#242830] py-5">

                        <span class="text-sm text-[#8B919A]">
                            Reserved Quantity
                        </span>

                        <span class="text-right text-sm font-medium text-[#F5F5F2]">
                            {{ $inventory->reserved_quantity }}
                        </span>

                    </div>


                    <div class="flex items-center justify-between py-5">

                        <span class="text-sm text-[#8B919A]">
                            Available Quantity
                        </span>

                        <span class="text-right text-sm font-semibold text-[#8B7CFF]">
                            {{ $inventory->available_quantity }}
                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>