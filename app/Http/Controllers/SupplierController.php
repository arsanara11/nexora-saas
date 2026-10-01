<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class SupplierController extends Controller
{
    public function index(Request $request): View
    {
        $company = $request->attributes->get('currentCompany');

        abort_unless($company, 403);

        $query = Supplier::query()
            ->where('company_id', $company->id)
            ->withCount('purchaseOrders')
            ->latest();

        if ($request->filled('search')) {
            $search = trim(
                $request->string('search')->toString()
            );

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('code', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('contact_person', 'like', "%{$search}%")
                    ->orWhere('city', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where(
                'is_active',
                $request->string('status')->toString() === 'active'
            );
        }

        $suppliers = $query
            ->paginate(15)
            ->withQueryString();

        $summary = [
            'total' => Supplier::where(
                'company_id',
                $company->id
            )->count(),

            'active' => Supplier::where(
                'company_id',
                $company->id
            )
                ->where('is_active', true)
                ->count(),

            'inactive' => Supplier::where(
                'company_id',
                $company->id
            )
                ->where('is_active', false)
                ->count(),

            'with_orders' => Supplier::where(
                'company_id',
                $company->id
            )
                ->has('purchaseOrders')
                ->count(),
        ];

        return view(
            'suppliers.index',
            compact(
                'suppliers',
                'summary'
            )
        );
    }

    public function create(Request $request): View
    {
        $company = $request->attributes->get('currentCompany');

        abort_unless($company, 403);

        return view('suppliers.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $company = $request->attributes->get('currentCompany');

        abort_unless($company, 403);

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'code' => [
                'required',
                'string',
                'max:100',
                Rule::unique('suppliers', 'code')
                    ->where(
                        fn ($query) => $query->where(
                            'company_id',
                            $company->id
                        )
                    ),
            ],

            'email' => [
                'nullable',
                'email',
                'max:255',
            ],

            'phone' => [
                'nullable',
                'string',
                'max:50',
            ],

            'address' => [
                'nullable',
                'string',
                'max:1000',
            ],

            'city' => [
                'nullable',
                'string',
                'max:100',
            ],

            'contact_person' => [
                'nullable',
                'string',
                'max:255',
            ],

            'notes' => [
                'nullable',
                'string',
                'max:2000',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],
        ]);

        $validated['company_id'] = $company->id;

        $validated['is_active'] = $request->boolean(
            'is_active',
            true
        );

        $supplier = Supplier::create($validated);

        return redirect()
            ->route('suppliers.index')
            ->with(
                'success',
                "Supplier {$supplier->name} created successfully."
            );
    }

    public function show(
        Request $request,
        Supplier $supplier
    ): View {
        $company = $request->attributes->get('currentCompany');

        abort_unless($company, 403);

        abort_unless(
            $supplier->company_id === $company->id,
            404
        );

        $purchaseOrders = $supplier
            ->purchaseOrders()
            ->where(
                'company_id',
                $company->id
            )
            ->with([
                'warehouse',
                'user',
            ])
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $orderSummary = [
            'total' => $supplier
                ->purchaseOrders()
                ->where(
                    'company_id',
                    $company->id
                )
                ->count(),

            'received' => $supplier
                ->purchaseOrders()
                ->where(
                    'company_id',
                    $company->id
                )
                ->where(
                    'status',
                    'received'
                )
                ->count(),

            'pending' => $supplier
                ->purchaseOrders()
                ->where(
                    'company_id',
                    $company->id
                )
                ->whereIn(
                    'status',
                    [
                        'draft',
                        'pending',
                        'approved',
                        'ordered',
                    ]
                )
                ->count(),

            'total_spend' => $supplier
                ->purchaseOrders()
                ->where(
                    'company_id',
                    $company->id
                )
                ->whereNotIn(
                    'status',
                    [
                        'draft',
                        'cancelled',
                    ]
                )
                ->sum('total'),
        ];

        return view(
            'suppliers.show',
            compact(
                'supplier',
                'purchaseOrders',
                'orderSummary'
            )
        );
    }

    public function edit(Request $request, Supplier $supplier): View
    {
        $company = $request->attributes->get('currentCompany');

        abort_unless($company, 403);

        abort_unless(
            $supplier->company_id === $company->id,
            404
        );

        return view(
            'suppliers.edit',
            compact('supplier')
        );
    }

    public function update(
        Request $request,
        Supplier $supplier
    ): RedirectResponse {
        $company = $request->attributes->get('currentCompany');

        abort_unless($company, 403);

        abort_unless(
            $supplier->company_id === $company->id,
            404
        );

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'code' => [
                'required',
                'string',
                'max:100',
                Rule::unique('suppliers', 'code')
                    ->where(
                        fn ($query) => $query->where(
                            'company_id',
                            $company->id
                        )
                    )
                    ->ignore($supplier->id),
            ],

            'email' => [
                'nullable',
                'email',
                'max:255',
            ],

            'phone' => [
                'nullable',
                'string',
                'max:50',
            ],

            'address' => [
                'nullable',
                'string',
                'max:1000',
            ],

            'city' => [
                'nullable',
                'string',
                'max:100',
            ],

            'contact_person' => [
                'nullable',
                'string',
                'max:255',
            ],

            'notes' => [
                'nullable',
                'string',
                'max:2000',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],
        ]);

        $validated['is_active'] = $request->boolean(
            'is_active'
        );

        $supplier->update($validated);

        return redirect()
            ->route('suppliers.index')
            ->with(
                'success',
                "Supplier {$supplier->name} updated successfully."
            );
    }

    public function destroy(
        Request $request,
        Supplier $supplier
    ): RedirectResponse {
        $company = $request->attributes->get('currentCompany');

        abort_unless($company, 403);

        abort_unless(
            $supplier->company_id === $company->id,
            404
        );

        if ($supplier->purchaseOrders()->exists()) {
            return redirect()
                ->route('suppliers.index')
                ->with(
                    'error',
                    'This supplier cannot be deleted because it has purchase orders.'
                );
        }

        $supplierName = $supplier->name;

        $supplier->delete();

        return redirect()
            ->route('suppliers.index')
            ->with(
                'success',
                "Supplier {$supplierName} deleted successfully."
            );
    }

    public function toggleStatus(
        Request $request,
        Supplier $supplier
    ): RedirectResponse {
        $company = $request->attributes->get('currentCompany');

        abort_unless($company, 403);

        abort_unless(
            $supplier->company_id === $company->id,
            404
        );

        $supplier->update([
            'is_active' => ! $supplier->is_active,
        ]);

        return redirect()
            ->back()
            ->with(
                'success',
                "Supplier {$supplier->name} status updated."
            );
    }
}