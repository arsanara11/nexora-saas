<x-app-layout>

    <div class="space-y-8">

        {{-- ============================================================ --}}
        {{-- HEADER --}}
        {{-- ============================================================ --}}

        <div class="flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between">

            <div>

                <p class="text-[10px] font-semibold uppercase tracking-[0.2em] text-[#727985]">
                    Inventory Management
                </p>

                <h1 class="mt-2 text-3xl font-semibold tracking-tight text-[#F5F5F2]">
                    Stock Movement Detail
                </h1>

                <p class="mt-2 text-sm leading-6 text-[#8B919A]">
                    Detailed information about this inventory movement.
                </p>

            </div>


            <div>

                <a
                    href="{{ route('stock-movements.index') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-lg border border-[#242830] px-4 py-2.5 text-sm font-medium text-[#B9BEC6] transition hover:border-[#3A404A] hover:bg-[#151A21] hover:text-white"
                >

                    <span class="text-base">
                        ←
                    </span>

                    Back to movements

                </a>

            </div>

        </div>



        {{-- ============================================================ --}}
        {{-- MOVEMENT SUMMARY --}}
        {{-- ============================================================ --}}

        <div class="rounded-2xl border border-[#242830] bg-[#12151A]">

            <div class="flex flex-col gap-6 px-7 py-7 lg:flex-row lg:items-center lg:justify-between">

                <div class="flex min-w-0 items-center gap-5">

                    <div
                        class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl
                        {{ $stockMovement->quantity > 0
                            ? 'bg-emerald-400/10 text-emerald-300'
                            : ($stockMovement->quantity < 0
                                ? 'bg-rose-400/10 text-rose-300'
                                : 'bg-[#8B7CFF]/10 text-[#A99FFF]')
                        }}"
                    >

                        @if ($stockMovement->quantity > 0)

                            ↑

                        @elseif ($stockMovement->quantity < 0)

                            ↓

                        @else

                            ±

                        @endif

                    </div>


                    <div class="min-w-0">

                        <p class="text-[10px] font-semibold uppercase tracking-[0.16em] text-[#727985]">
                            {{ $stockMovement->type_label }}
                        </p>

                        <h2 class="mt-1 truncate text-xl font-semibold text-[#F5F5F2]">
                            {{ $stockMovement->productVariant?->product?->name ?? 'Unknown Product' }}
                        </h2>

                        <div class="mt-2 flex flex-wrap items-center gap-2 text-xs text-[#747B87]">

                            <span>
                                {{ $stockMovement->productVariant?->name ?? 'Default' }}
                            </span>

                            @if ($stockMovement->productVariant?->sku)

                                <span class="text-[#444A53]">
                                    •
                                </span>

                                <span class="font-mono text-[#666C75]">
                                    {{ $stockMovement->productVariant->sku }}
                                </span>

                            @endif

                        </div>

                    </div>

                </div>


                <div class="text-left lg:text-right">

                    <p class="text-[10px] font-semibold uppercase tracking-[0.16em] text-[#727985]">
                        Quantity
                    </p>

                    @if ($stockMovement->quantity > 0)

                        <p class="mt-2 text-3xl font-semibold text-emerald-300">
                            +{{ number_format($stockMovement->quantity) }}
                        </p>

                    @elseif ($stockMovement->quantity < 0)

                        <p class="mt-2 text-3xl font-semibold text-rose-300">
                            {{ number_format($stockMovement->quantity) }}
                        </p>

                    @else

                        <p class="mt-2 text-3xl font-semibold text-[#F5F5F2]">
                            0
                        </p>

                    @endif

                    <p class="mt-1 text-xs text-[#666C75]">
                        units

                    </p>

                </div>

            </div>

        </div>



        {{-- ============================================================ --}}
        {{-- INFORMATION GRID --}}
        {{-- ============================================================ --}}

        <div class="grid grid-cols-1 gap-5 lg:grid-cols-2">


            {{-- ======================================================== --}}
            {{-- MOVEMENT INFORMATION --}}
            {{-- ======================================================== --}}

            <div class="rounded-2xl border border-[#242830] bg-[#12151A]">

                <div class="border-b border-[#242830] px-6 py-5">

                    <h2 class="text-sm font-semibold text-[#F5F5F2]">
                        Movement Information
                    </h2>

                    <p class="mt-1 text-xs text-[#747B87]">
                        Core information for this stock movement.
                    </p>

                </div>


                <div class="px-6">

                    {{-- Type --}}
                    <div class="flex items-center justify-between border-b border-[#242830] py-5">

                        <span class="text-sm text-[#8B919A]">
                            Movement Type
                        </span>

                        @php
                            $typeClasses = match ($stockMovement->type) {
                                'purchase' => 'border-emerald-400/15 bg-emerald-400/10 text-emerald-300',
                                'sale' => 'border-rose-400/15 bg-rose-400/10 text-rose-300',
                                'adjustment' => 'border-amber-400/15 bg-amber-400/10 text-amber-300',
                                'transfer' => 'border-sky-400/15 bg-sky-400/10 text-sky-300',
                                'return' => 'border-violet-400/15 bg-violet-400/10 text-violet-300',
                                default => 'border-[#303640] bg-[#181D24] text-[#AEB3BB]',
                            };
                        @endphp

                        <span
                            class="inline-flex items-center gap-2 rounded-lg border px-2.5 py-1 text-xs font-medium {{ $typeClasses }}"
                        >

                            <span class="h-1.5 w-1.5 rounded-full bg-current"></span>

                            {{ $stockMovement->type_label }}

                        </span>

                    </div>


                    {{-- Quantity --}}
                    <div class="flex items-center justify-between border-b border-[#242830] py-5">

                        <span class="text-sm text-[#8B919A]">
                            Quantity
                        </span>

                        <span
                            class="text-sm font-semibold
                            {{ $stockMovement->quantity > 0
                                ? 'text-emerald-300'
                                : ($stockMovement->quantity < 0
                                    ? 'text-rose-300'
                                    : 'text-[#F5F5F2]')
                            }}"
                        >

                            @if ($stockMovement->quantity > 0)
                                +{{ number_format($stockMovement->quantity) }}
                            @else
                                {{ number_format($stockMovement->quantity) }}
                            @endif

                        </span>

                    </div>


                    {{-- Date --}}
                    <div class="flex items-center justify-between border-b border-[#242830] py-5">

                        <span class="text-sm text-[#8B919A]">
                            Recorded At
                        </span>

                        <div class="text-right">

                            <p class="text-sm font-medium text-[#F5F5F2]">
                                {{ $stockMovement->created_at?->format('d M Y') }}
                            </p>

                            <p class="mt-1 text-xs text-[#666C75]">
                                {{ $stockMovement->created_at?->format('H:i:s') }}
                            </p>

                        </div>

                    </div>


                    {{-- Updated --}}
                    <div class="flex items-center justify-between py-5">

                        <span class="text-sm text-[#8B919A]">
                            Last Updated
                        </span>

                        <div class="text-right">

                            <p class="text-sm font-medium text-[#F5F5F2]">
                                {{ $stockMovement->updated_at?->format('d M Y') }}
                            </p>

                            <p class="mt-1 text-xs text-[#666C75]">
                                {{ $stockMovement->updated_at?->format('H:i:s') }}
                            </p>

                        </div>

                    </div>

                </div>

            </div>



            {{-- ======================================================== --}}
            {{-- STOCK LOCATION --}}
            {{-- ======================================================== --}}

            <div class="rounded-2xl border border-[#242830] bg-[#12151A]">

                <div class="border-b border-[#242830] px-6 py-5">

                    <h2 class="text-sm font-semibold text-[#F5F5F2]">
                        Stock Location
                    </h2>

                    <p class="mt-1 text-xs text-[#747B87]">
                        Warehouse and product information.
                    </p>

                </div>


                <div class="px-6">

                    {{-- Product --}}
                    <div class="flex items-center justify-between border-b border-[#242830] py-5">

                        <span class="text-sm text-[#8B919A]">
                            Product
                        </span>

                        <span class="max-w-[60%] text-right text-sm font-medium text-[#F5F5F2]">
                            {{ $stockMovement->productVariant?->product?->name ?? '—' }}
                        </span>

                    </div>


                    {{-- Variant --}}
                    <div class="flex items-center justify-between border-b border-[#242830] py-5">

                        <span class="text-sm text-[#8B919A]">
                            Variant
                        </span>

                        <span class="max-w-[60%] text-right text-sm font-medium text-[#F5F5F2]">
                            {{ $stockMovement->productVariant?->name ?? 'Default' }}
                        </span>

                    </div>


                    {{-- SKU --}}
                    <div class="flex items-center justify-between border-b border-[#242830] py-5">

                        <span class="text-sm text-[#8B919A]">
                            SKU
                        </span>

                        <span class="max-w-[60%] text-right font-mono text-sm text-[#D9DCE1]">
                            {{ $stockMovement->productVariant?->sku ?? '—' }}
                        </span>

                    </div>


                    {{-- Warehouse --}}
                    <div class="flex items-center justify-between py-5">

                        <span class="text-sm text-[#8B919A]">
                            Warehouse
                        </span>

                        <div class="max-w-[60%] text-right">

                            <p class="text-sm font-medium text-[#F5F5F2]">
                                {{ $stockMovement->warehouse?->name ?? '—' }}
                            </p>

                            @if ($stockMovement->warehouse?->code)

                                <p class="mt-1 font-mono text-xs text-[#666C75]">
                                    {{ $stockMovement->warehouse->code }}
                                </p>

                            @endif

                        </div>

                    </div>

                </div>

            </div>

        </div>



        {{-- ============================================================ --}}
        {{-- REFERENCE & USER --}}
        {{-- ============================================================ --}}

        <div class="grid grid-cols-1 gap-5 lg:grid-cols-2">


            {{-- Reference --}}
            <div class="rounded-2xl border border-[#242830] bg-[#12151A]">

                <div class="border-b border-[#242830] px-6 py-5">

                    <h2 class="text-sm font-semibold text-[#F5F5F2]">
                        Reference
                    </h2>

                    <p class="mt-1 text-xs text-[#747B87]">
                        The operational record that generated this movement.
                    </p>

                </div>


                <div class="px-6 py-5">

                    @if ($stockMovement->reference)

                        <div class="rounded-xl border border-[#242830] bg-[#0B0D10] px-4 py-4">

                            <div class="flex items-center justify-between gap-4">

                                <div class="min-w-0">

                                    <p class="text-xs font-medium uppercase tracking-[0.12em] text-[#666C75]">
                                        {{ class_basename($stockMovement->reference_type) }}
                                    </p>

                                    <p class="mt-2 font-mono text-sm font-medium text-[#F5F5F2]">
                                        #{{ $stockMovement->reference->getKey() }}
                                    </p>

                                </div>

                                <span class="text-[#8B7CFF]">
                                    ◈
                                </span>

                            </div>

                        </div>

                    @elseif ($stockMovement->reference_type || $stockMovement->reference_id)

                        <div class="rounded-xl border border-[#242830] bg-[#0B0D10] px-4 py-4">

                            <p class="text-xs text-[#8B919A]">
                                Reference information is available, but the related record could not be loaded.
                            </p>

                            @if ($stockMovement->reference_type)

                                <p class="mt-3 text-xs text-[#666C75]">
                                    Type:
                                    <span class="font-mono text-[#AEB3BB]">
                                        {{ class_basename($stockMovement->reference_type) }}
                                    </span>
                                </p>

                            @endif

                            @if ($stockMovement->reference_id)

                                <p class="mt-1 text-xs text-[#666C75]">
                                    ID:
                                    <span class="font-mono text-[#AEB3BB]">
                                        #{{ $stockMovement->reference_id }}
                                    </span>
                                </p>

                            @endif

                        </div>

                    @else

                        <div class="rounded-xl border border-dashed border-[#242830] bg-[#0B0D10] px-4 py-5 text-center">

                            <p class="text-sm text-[#666C75]">
                                No reference record attached.
                            </p>

                        </div>

                    @endif

                </div>

            </div>



            {{-- User --}}
            <div class="rounded-2xl border border-[#242830] bg-[#12151A]">

                <div class="border-b border-[#242830] px-6 py-5">

                    <h2 class="text-sm font-semibold text-[#F5F5F2]">
                        Recorded By
                    </h2>

                    <p class="mt-1 text-xs text-[#747B87]">
                        User or system responsible for this movement.
                    </p>

                </div>


                <div class="px-6 py-5">

                    @if ($stockMovement->user)

                        <div class="flex items-center gap-4">

                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-[#5148A8] text-sm font-semibold text-white">
                                {{ strtoupper(substr($stockMovement->user->name, 0, 1)) }}
                            </div>

                            <div class="min-w-0">

                                <p class="truncate text-sm font-medium text-[#F5F5F2]">
                                    {{ $stockMovement->user->name }}
                                </p>

                                <p class="mt-1 truncate text-xs text-[#747B87]">
                                    {{ $stockMovement->user->email }}
                                </p>

                            </div>

                        </div>

                    @else

                        <div class="flex items-center gap-4">

                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-[#1C222B] text-sm text-[#8B919A]">
                                ◈
                            </div>

                            <div>

                                <p class="text-sm font-medium text-[#F5F5F2]">
                                    System
                                </p>

                                <p class="mt-1 text-xs text-[#747B87]">
                                    Automatically generated movement
                                </p>

                            </div>

                        </div>

                    @endif

                </div>

            </div>

        </div>



        {{-- ============================================================ --}}
        {{-- NOTES --}}
        {{-- ============================================================ --}}

        <div class="rounded-2xl border border-[#242830] bg-[#12151A]">

            <div class="border-b border-[#242830] px-6 py-5">

                <h2 class="text-sm font-semibold text-[#F5F5F2]">
                    Notes
                </h2>

                <p class="mt-1 text-xs text-[#747B87]">
                    Additional information attached to this movement.
                </p>

            </div>


            <div class="px-6 py-6">

                @if ($stockMovement->notes)

                    <div class="rounded-xl border border-[#242830] bg-[#0B0D10] px-5 py-4">

                        <p class="whitespace-pre-line text-sm leading-6 text-[#B8BDC5]">
                            {{ $stockMovement->notes }}
                        </p>

                    </div>

                @else

                    <div class="rounded-xl border border-dashed border-[#242830] bg-[#0B0D10] px-5 py-5 text-center">

                        <p class="text-sm text-[#666C75]">
                            No notes were added to this movement.
                        </p>

                    </div>

                @endif

            </div>

        </div>



        {{-- ============================================================ --}}
        {{-- FOOTER ACTION --}}
        {{-- ============================================================ --}}

        <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-between">

            <a
                href="{{ route('inventory.index') }}"
                class="inline-flex items-center justify-center rounded-lg border border-[#242830] px-5 py-3 text-sm font-medium text-[#9AA1AD] transition hover:border-[#3A404A] hover:bg-[#171C23] hover:text-white"
            >
                Back to inventory
            </a>

            <a
                href="{{ route('stock-movements.index') }}"
                class="inline-flex items-center justify-center rounded-lg bg-[#F5F5F2] px-5 py-3 text-sm font-semibold text-[#080B10] transition hover:bg-white"
            >
                View all movements
            </a>

        </div>

    </div>

</x-app-layout>