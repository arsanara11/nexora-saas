<x-app-layout>

    <div class="mb-8 flex items-center justify-between">
        <div>
            <p class="mb-2 text-xs font-medium uppercase tracking-[0.2em] text-[#8B7CFF]">
                Operations / Purchasing / Purchase Order
            </p>

            <h1 class="text-2xl font-semibold tracking-tight text-[#F5F5F2]">
                {{ $purchaseOrder->po_number }}
            </h1>

            <p class="mt-1 text-sm text-[#8B919A]">
                Purchase order details and item overview.
            </p>
        </div>

        <div class="flex items-center gap-3">

            @if ($purchaseOrder->status === 'draft')
                <a
                    href="{{ route('purchasing.edit', $purchaseOrder) }}"
                    class="rounded-lg border border-[#242830] bg-[#12151A] px-5 py-3 text-sm font-medium text-[#F5F5F2] transition hover:bg-[#181C23]"
                >
                    Edit
                </a>
            @endif

            <a
                href="{{ route('purchasing.index') }}"
                class="rounded-lg border border-[#242830] bg-[#0B0D10] px-5 py-3 text-sm font-medium text-[#F5F5F2] transition hover:bg-[#181C23]"
            >
                Back
            </a>

        </div>
    </div>

    {{-- Success Message --}}
    @if (session('success'))
        <div class="mb-6 rounded-xl border border-emerald-500/20 bg-emerald-500/10 px-4 py-3">
            <p class="text-sm text-emerald-400">
                {{ session('success') }}
            </p>
        </div>
    @endif

    {{-- Error Message --}}
    @if (session('error'))
        <div class="mb-6 rounded-xl border border-red-500/20 bg-red-500/10 px-4 py-3">
            <p class="text-sm text-red-400">
                {{ session('error') }}
            </p>
        </div>
    @endif

    {{-- Validation Errors --}}
    @if ($errors->any())
        <div class="mb-6 rounded-xl border border-red-500/20 bg-red-500/10 p-4">
            <p class="mb-2 text-sm font-medium text-red-400">
                Please fix the following errors:
            </p>

            <ul class="space-y-1 text-sm text-red-300">
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Summary Cards --}}
    <div class="grid grid-cols-1 gap-5 md:grid-cols-3">

        {{-- Supplier --}}
        <div class="rounded-2xl border border-[#242830] bg-[#12151A] p-6">

            <p class="mb-4 text-xs font-medium uppercase tracking-[0.15em] text-[#8B919A]">
                Supplier
            </p>

            <h2 class="text-lg font-semibold text-[#F5F5F2]">
                {{ $purchaseOrder->supplier->name ?? 'Unknown Supplier' }}
            </h2>

            <p class="mt-2 text-sm text-[#8B919A]">
                {{ $purchaseOrder->supplier->code ?? '—' }}
            </p>

        </div>

        {{-- Warehouse --}}
        <div class="rounded-2xl border border-[#242830] bg-[#12151A] p-6">

            <p class="mb-4 text-xs font-medium uppercase tracking-[0.15em] text-[#8B919A]">
                Warehouse
            </p>

            <h2 class="text-lg font-semibold text-[#F5F5F2]">
                {{ $purchaseOrder->warehouse->name ?? 'Unknown Warehouse' }}
            </h2>

            <p class="mt-2 text-sm text-[#8B919A]">
                {{ $purchaseOrder->warehouse->code ?? '—' }}
            </p>

        </div>

        {{-- Status --}}
        <div class="rounded-2xl border border-[#242830] bg-[#12151A] p-6">

            <p class="mb-4 text-xs font-medium uppercase tracking-[0.15em] text-[#8B919A]">
                Status
            </p>

            @php
                $statusClasses = match ($purchaseOrder->status) {
                    'draft' => 'border-[#3A404A] bg-[#181C23] text-[#C8CDD5]',
                    'pending' => 'border-yellow-500/20 bg-yellow-500/10 text-yellow-400',
                    'approved' => 'border-blue-500/20 bg-blue-500/10 text-blue-400',
                    'ordered' => 'border-purple-500/20 bg-purple-500/10 text-purple-400',
                    'received' => 'border-emerald-500/20 bg-emerald-500/10 text-emerald-400',
                    'cancelled' => 'border-red-500/20 bg-red-500/10 text-red-400',
                    default => 'border-[#3A404A] bg-[#181C23] text-[#C8CDD5]',
                };
            @endphp

            <span
                class="inline-flex rounded-full border px-3 py-1.5 text-sm font-medium {{ $statusClasses }}"
            >
                {{ $purchaseOrder->status_label }}
            </span>

        </div>

    </div>

    {{-- Status Workflow --}}
    <div class="mt-6 rounded-2xl border border-[#242830] bg-[#12151A] p-6">

        <div class="mb-5">
            <h2 class="text-base font-semibold text-[#F5F5F2]">
                Purchase Order Workflow
            </h2>

            <p class="mt-1 text-sm text-[#8B919A]">
                Update the current purchase order status.
            </p>
        </div>

        <div class="flex flex-wrap items-center gap-3">

            {{-- Draft --}}
            @if ($purchaseOrder->status === 'draft')

                <form
                    action="{{ route('purchasing.status', $purchaseOrder) }}"
                    method="POST"
                >
                    @csrf
                    @method('PATCH')

                    <input
                        type="hidden"
                        name="status"
                        value="pending"
                    >

                    <button
                        type="submit"
                        class="rounded-lg bg-[#8B7CFF] px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-[#7969F2]"
                    >
                        Submit for Approval
                    </button>
                </form>

                <form
                    action="{{ route('purchasing.status', $purchaseOrder) }}"
                    method="POST"
                    onsubmit="return confirm('Cancel this purchase order?')"
                >
                    @csrf
                    @method('PATCH')

                    <input
                        type="hidden"
                        name="status"
                        value="cancelled"
                    >

                    <button
                        type="submit"
                        class="rounded-lg border border-red-500/20 bg-red-500/10 px-4 py-2.5 text-sm font-medium text-red-400 transition hover:bg-red-500/20"
                    >
                        Cancel PO
                    </button>
                </form>

            {{-- Pending --}}
            @elseif ($purchaseOrder->status === 'pending')

                <form
                    action="{{ route('purchasing.status', $purchaseOrder) }}"
                    method="POST"
                >
                    @csrf
                    @method('PATCH')

                    <input
                        type="hidden"
                        name="status"
                        value="approved"
                    >

                    <button
                        type="submit"
                        class="rounded-lg bg-[#8B7CFF] px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-[#7969F2]"
                    >
                        Approve Purchase Order
                    </button>
                </form>

                <form
                    action="{{ route('purchasing.status', $purchaseOrder) }}"
                    method="POST"
                    onsubmit="return confirm('Cancel this purchase order?')"
                >
                    @csrf
                    @method('PATCH')

                    <input
                        type="hidden"
                        name="status"
                        value="cancelled"
                    >

                    <button
                        type="submit"
                        class="rounded-lg border border-red-500/20 bg-red-500/10 px-4 py-2.5 text-sm font-medium text-red-400 transition hover:bg-red-500/20"
                    >
                        Cancel PO
                    </button>
                </form>

            {{-- Approved --}}
            @elseif ($purchaseOrder->status === 'approved')

                <form
                    action="{{ route('purchasing.status', $purchaseOrder) }}"
                    method="POST"
                >
                    @csrf
                    @method('PATCH')

                    <input
                        type="hidden"
                        name="status"
                        value="ordered"
                    >

                    <button
                        type="submit"
                        class="rounded-lg bg-[#8B7CFF] px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-[#7969F2]"
                    >
                        Mark as Ordered
                    </button>
                </form>

                <form
                    action="{{ route('purchasing.status', $purchaseOrder) }}"
                    method="POST"
                    onsubmit="return confirm('Cancel this purchase order?')"
                >
                    @csrf
                    @method('PATCH')

                    <input
                        type="hidden"
                        name="status"
                        value="cancelled"
                    >

                    <button
                        type="submit"
                        class="rounded-lg border border-red-500/20 bg-red-500/10 px-4 py-2.5 text-sm font-medium text-red-400 transition hover:bg-red-500/20"
                    >
                        Cancel PO
                    </button>
                </form>

            {{-- Ordered --}}
            @elseif ($purchaseOrder->status === 'ordered')

                <form
                    action="{{ route('purchasing.status', $purchaseOrder) }}"
                    method="POST"
                >
                    @csrf
                    @method('PATCH')

                    <input
                        type="hidden"
                        name="status"
                        value="received"
                    >

                    <button
                        type="submit"
                        class="rounded-lg bg-emerald-500/90 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-emerald-500"
                    >
                        Mark as Received
                    </button>
                </form>

                <form
                    action="{{ route('purchasing.status', $purchaseOrder) }}"
                    method="POST"
                    onsubmit="return confirm('Cancel this purchase order?')"
                >
                    @csrf
                    @method('PATCH')

                    <input
                        type="hidden"
                        name="status"
                        value="cancelled"
                    >

                    <button
                        type="submit"
                        class="rounded-lg border border-red-500/20 bg-red-500/10 px-4 py-2.5 text-sm font-medium text-red-400 transition hover:bg-red-500/20"
                    >
                        Cancel PO
                    </button>
                </form>

            {{-- Received --}}
            @elseif ($purchaseOrder->status === 'received')

                <div class="rounded-lg border border-emerald-500/20 bg-emerald-500/10 px-4 py-2.5 text-sm text-emerald-400">
                    Purchase order has been received.
                </div>

            {{-- Cancelled --}}
            @elseif ($purchaseOrder->status === 'cancelled')

                <div class="rounded-lg border border-red-500/20 bg-red-500/10 px-4 py-2.5 text-sm text-red-400">
                    Purchase order has been cancelled.
                </div>

            @endif

        </div>

        {{-- Progress --}}
        <div class="mt-6">

            @php
                $workflow = [
                    'draft' => 'Draft',
                    'pending' => 'Pending',
                    'approved' => 'Approved',
                    'ordered' => 'Ordered',
                    'received' => 'Received',
                ];

                $statuses = array_keys($workflow);

                $currentIndex = array_search(
                    $purchaseOrder->status,
                    $statuses
                );
            @endphp

            @if ($purchaseOrder->status !== 'cancelled')

                <div class="flex items-center gap-2">

                    @foreach ($workflow as $key => $label)

                        @php
                            $stepIndex = array_search($key, $statuses);

                            $isCompleted = $currentIndex !== false
                                && $stepIndex <= $currentIndex;

                            $isCurrent = $key === $purchaseOrder->status;
                        @endphp

                        <div class="flex flex-1 items-center">

                            <div
                                class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full border text-xs font-semibold
                                {{
                                    $isCompleted
                                        ? 'border-[#8B7CFF] bg-[#8B7CFF] text-white'
                                        : 'border-[#2B3038] bg-[#0B0D10] text-[#666D78]'
                                }}"
                            >
                                {{ $stepIndex + 1 }}
                            </div>

                            <div class="ml-2 min-w-0">
                                <p
                                    class="truncate text-xs font-medium
                                    {{
                                        $isCurrent
                                            ? 'text-[#F5F5F2]'
                                            : ($isCompleted ? 'text-[#A9A2FF]' : 'text-[#666D78]')
                                    }}"
                                >
                                    {{ $label }}
                                </p>
                            </div>

                            @if (!$loop->last)
                                <div
                                    class="mx-3 h-px flex-1
                                    {{
                                        $stepIndex < $currentIndex
                                            ? 'bg-[#8B7CFF]'
                                            : 'bg-[#242830]'
                                    }}"
                                ></div>
                            @endif

                        </div>

                    @endforeach

                </div>

            @endif

        </div>

    </div>

    {{-- Purchase Order Information --}}
    <div class="mt-6 rounded-2xl border border-[#242830] bg-[#12151A]">

        <div class="border-b border-[#242830] px-6 py-5">

            <h2 class="text-base font-semibold text-[#F5F5F2]">
                Purchase Order Information
            </h2>

            <p class="mt-1 text-sm text-[#8B919A]">
                General information about this purchase order.
            </p>

        </div>

        <div class="grid grid-cols-1 gap-6 px-6 py-6 md:grid-cols-4">

            <div>
                <p class="mb-2 text-xs font-medium uppercase tracking-[0.12em] text-[#8B919A]">
                    PO Number
                </p>

                <p class="text-sm font-semibold text-[#F5F5F2]">
                    {{ $purchaseOrder->po_number }}
                </p>
            </div>

            <div>
                <p class="mb-2 text-xs font-medium uppercase tracking-[0.12em] text-[#8B919A]">
                    Order Date
                </p>

                <p class="text-sm text-[#D7D9DE]">
                    {{ $purchaseOrder->ordered_at?->format('d M Y') ?? '—' }}
                </p>
            </div>

            <div>
                <p class="mb-2 text-xs font-medium uppercase tracking-[0.12em] text-[#8B919A]">
                    Expected Date
                </p>

                <p class="text-sm text-[#D7D9DE]">
                    {{ $purchaseOrder->expected_at?->format('d M Y') ?? '—' }}
                </p>
            </div>

            <div>
                <p class="mb-2 text-xs font-medium uppercase tracking-[0.12em] text-[#8B919A]">
                    Created By
                </p>

                <p class="text-sm text-[#D7D9DE]">
                    {{ $purchaseOrder->user->name ?? '—' }}
                </p>
            </div>

        </div>

    </div>

    {{-- Items --}}
    <div class="mt-6 rounded-2xl border border-[#242830] bg-[#12151A]">

        <div class="border-b border-[#242830] px-6 py-5">

            <h2 class="text-base font-semibold text-[#F5F5F2]">
                Order Items
            </h2>

            <p class="mt-1 text-sm text-[#8B919A]">
                Products included in this purchase order.
            </p>

        </div>

        <div class="overflow-x-auto">

            <table class="w-full min-w-[800px]">

                <thead>
                    <tr class="border-b border-[#242830]">

                        <th class="px-6 py-4 text-left text-xs font-medium uppercase tracking-[0.1em] text-[#8B919A]">
                            Product
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-medium uppercase tracking-[0.1em] text-[#8B919A]">
                            SKU
                        </th>

                        <th class="px-6 py-4 text-right text-xs font-medium uppercase tracking-[0.1em] text-[#8B919A]">
                            Quantity
                        </th>

                        <th class="px-6 py-4 text-right text-xs font-medium uppercase tracking-[0.1em] text-[#8B919A]">
                            Unit Cost
                        </th>

                        <th class="px-6 py-4 text-right text-xs font-medium uppercase tracking-[0.1em] text-[#8B919A]">
                            Received
                        </th>

                        <th class="px-6 py-4 text-right text-xs font-medium uppercase tracking-[0.1em] text-[#8B919A]">
                            Total
                        </th>

                    </tr>
                </thead>

                <tbody>

                    @forelse ($purchaseOrder->items as $item)

                        <tr class="border-b border-[#242830] last:border-b-0">

                            <td class="px-6 py-4">

                                <p class="text-sm font-medium text-[#F5F5F2]">
                                    {{
                                        $item->product_name
                                        ?? $item->productVariant->product->name
                                        ?? 'Unknown Product'
                                    }}
                                </p>

                                @if ($item->productVariant)
                                    <p class="mt-1 text-xs text-[#666D78]">
                                        {{ $item->productVariant->name }}
                                    </p>
                                @endif

                            </td>

                            <td class="px-6 py-4 text-sm text-[#8B919A]">
                                {{ $item->sku ?? $item->productVariant->sku ?? '—' }}
                            </td>

                            <td class="px-6 py-4 text-right text-sm text-[#D7D9DE]">
                                {{ number_format($item->quantity) }}
                            </td>

                            <td class="px-6 py-4 text-right text-sm text-[#D7D9DE]">
                                Rp {{ number_format((float) $item->unit_cost, 0, ',', '.') }}
                            </td>

                            <td class="px-6 py-4 text-right text-sm text-[#8B919A]">
                                {{ number_format($item->received_quantity ?? 0) }}
                            </td>

                            <td class="px-6 py-4 text-right text-sm font-semibold text-[#F5F5F2]">
                                Rp {{ number_format((float) $item->total, 0, ',', '.') }}
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td
                                colspan="6"
                                class="px-6 py-10 text-center text-sm text-[#8B919A]"
                            >
                                No items found.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

    {{-- Financial Summary --}}
    <div class="mt-6 grid grid-cols-1 gap-6 lg:grid-cols-2">

        {{-- Notes --}}
        <div class="rounded-2xl border border-[#242830] bg-[#12151A] p-6">

            <h2 class="text-base font-semibold text-[#F5F5F2]">
                Notes
            </h2>

            <div class="mt-4 rounded-xl border border-[#242830] bg-[#0B0D10] p-4">

                @if ($purchaseOrder->notes)
                    <p class="whitespace-pre-line text-sm leading-6 text-[#A9AEB7]">
                        {{ $purchaseOrder->notes }}
                    </p>
                @else
                    <p class="text-sm text-[#666D78]">
                        No notes added.
                    </p>
                @endif

            </div>

        </div>

        {{-- Summary --}}
        <div class="rounded-2xl border border-[#242830] bg-[#12151A] p-6">

            <h2 class="text-base font-semibold text-[#F5F5F2]">
                Summary
            </h2>

            <div class="mt-5 space-y-4">

                <div class="flex items-center justify-between">
                    <span class="text-sm text-[#8B919A]">
                        Subtotal
                    </span>

                    <span class="text-sm text-[#D7D9DE]">
                        Rp {{ number_format((float) $purchaseOrder->subtotal, 0, ',', '.') }}
                    </span>
                </div>

                <div class="flex items-center justify-between">
                    <span class="text-sm text-[#8B919A]">
                        Tax
                    </span>

                    <span class="text-sm text-[#D7D9DE]">
                        Rp {{ number_format((float) $purchaseOrder->tax, 0, ',', '.') }}
                    </span>
                </div>

                <div class="flex items-center justify-between">
                    <span class="text-sm text-[#8B919A]">
                        Shipping
                    </span>

                    <span class="text-sm text-[#D7D9DE]">
                        Rp {{ number_format((float) $purchaseOrder->shipping_cost, 0, ',', '.') }}
                    </span>
                </div>

                <div class="border-t border-[#242830] pt-4">

                    <div class="flex items-center justify-between">

                        <span class="text-sm font-medium text-[#F5F5F2]">
                            Total
                        </span>

                        <span class="text-xl font-semibold text-[#F5F5F2]">
                            Rp {{ number_format((float) $purchaseOrder->total, 0, ',', '.') }}
                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- Bottom Actions --}}
    <div class="mt-6 flex flex-wrap items-center justify-between gap-3">

        <a
            href="{{ route('purchasing.index') }}"
            class="rounded-lg border border-[#242830] bg-[#12151A] px-5 py-3 text-sm font-medium text-[#F5F5F2] transition hover:bg-[#181C23]"
        >
            Back to Purchasing
        </a>

        <div class="flex items-center gap-3">

            @if ($purchaseOrder->status === 'draft')

                <a
                    href="{{ route('purchasing.edit', $purchaseOrder) }}"
                    class="rounded-lg bg-[#8B7CFF] px-5 py-3 text-sm font-semibold text-white transition hover:bg-[#7969F2]"
                >
                    Edit Purchase Order
                </a>

                <form
                    action="{{ route('purchasing.destroy', $purchaseOrder) }}"
                    method="POST"
                    onsubmit="return confirm('Delete this purchase order?')"
                >
                    @csrf
                    @method('DELETE')

                    <button
                        type="submit"
                        class="rounded-lg border border-red-500/20 bg-red-500/10 px-5 py-3 text-sm font-medium text-red-400 transition hover:bg-red-500/20"
                    >
                        Delete Draft
                    </button>
                </form>

            @endif

        </div>

    </div>

</x-app-layout>