<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $company = auth()->user()->companies()->first();

        abort_unless($company, 403);

        $customers = Customer::where('company_id', $company->id)
            ->withCount('orders')
            ->latest()
            ->get();

        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        $company = auth()->user()->companies()->first();

        abort_unless($company, 403);

        return view('customers.create');
    }

    public function store(Request $request)
    {
        $company = auth()->user()->companies()->first();

        abort_unless($company, 403);

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
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
            ],

            'city' => [
                'nullable',
                'string',
                'max:100',
            ],

            'notes' => [
                'nullable',
                'string',
            ],
        ]);

        Customer::create([
            'company_id' => $company->id,
            'name' => $validated['name'],
            'email' => $validated['email'] ?? null,
            'phone' => $validated['phone'] ?? null,
            'address' => $validated['address'] ?? null,
            'city' => $validated['city'] ?? null,
            'notes' => $validated['notes'] ?? null,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()
            ->route('customers.index')
            ->with(
                'success',
                'Customer created successfully.'
            );
    }

    public function show(Customer $customer)
    {
        $company = auth()->user()->companies()->first();

        abort_unless($company, 403);

        abort_unless(
            $customer->company_id === $company->id,
            404
        );

        $customer->load([
            'orders' => function ($query) {
                $query->latest();
            },
        ]);

        return view(
            'customers.show',
            compact('customer')
        );
    }

    public function edit(Customer $customer)
    {
        $company = auth()->user()->companies()->first();

        abort_unless($company, 403);

        abort_unless(
            $customer->company_id === $company->id,
            404
        );

        return view(
            'customers.edit',
            compact('customer')
        );
    }

    public function update(
        Request $request,
        Customer $customer
    ) {
        $company = auth()->user()->companies()->first();

        abort_unless($company, 403);

        abort_unless(
            $customer->company_id === $company->id,
            404
        );

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
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
            ],

            'city' => [
                'nullable',
                'string',
                'max:100',
            ],

            'notes' => [
                'nullable',
                'string',
            ],
        ]);

        $customer->update([
            'name' => $validated['name'],
            'email' => $validated['email'] ?? null,
            'phone' => $validated['phone'] ?? null,
            'address' => $validated['address'] ?? null,
            'city' => $validated['city'] ?? null,
            'notes' => $validated['notes'] ?? null,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()
            ->route(
                'customers.show',
                $customer
            )
            ->with(
                'success',
                'Customer updated successfully.'
            );
    }

    public function destroy(Customer $customer)
    {
        $company = auth()->user()->companies()->first();

        abort_unless($company, 403);

        abort_unless(
            $customer->company_id === $company->id,
            404
        );

        abort_if(
            $customer->orders()->exists(),
            422,
            'This customer cannot be deleted because they have existing orders.'
        );

        $customer->delete();

        return redirect()
            ->route('customers.index')
            ->with(
                'success',
                'Customer deleted successfully.'
            );
    }
}