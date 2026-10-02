<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Notifications\SystemNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ExpenseController extends Controller
{
    /**
     * Display a listing of expenses.
     */
    public function index(Request $request): View
    {
        $company = $request->attributes->get('currentCompany');

        abort_unless($company, 403);

        $query = Expense::with(['user'])
            ->where('company_id', $company->id)
            ->latest('expense_date')
            ->latest();

        // Search
        if ($request->filled('search')) {
            $search = trim(
                $request->string('search')->toString()
            );

            $query->where(function ($q) use ($search) {
                $q->where(
                    'category',
                    'like',
                    "%{$search}%"
                )
                    ->orWhere(
                        'description',
                        'like',
                        "%{$search}%"
                    )
                    ->orWhere(
                        'status',
                        'like',
                        "%{$search}%"
                    );
            });
        }

        // Status filter
        if ($request->filled('status')) {
            $query->where(
                'status',
                $request->string('status')->toString()
            );
        }

        // Category filter
        if ($request->filled('category')) {
            $query->where(
                'category',
                $request->string('category')->toString()
            );
        }

        // Date filter
        if ($request->filled('date_from')) {
            $query->whereDate(
                'expense_date',
                '>=',
                $request->date('date_from')
            );
        }

        if ($request->filled('date_to')) {
            $query->whereDate(
                'expense_date',
                '<=',
                $request->date('date_to')
            );
        }

        $expenses = $query
            ->paginate(12)
            ->withQueryString();

        $categories = Expense::where(
            'company_id',
            $company->id
        )
            ->whereNotNull('category')
            ->where('category', '!=', '')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        $summary = [
            'total' => Expense::where(
                'company_id',
                $company->id
            )->count(),

            'pending' => Expense::where(
                'company_id',
                $company->id
            )
                ->where('status', 'pending')
                ->count(),

            'paid' => Expense::where(
                'company_id',
                $company->id
            )
                ->where('status', 'paid')
                ->count(),

            'cancelled' => Expense::where(
                'company_id',
                $company->id
            )
                ->where('status', 'cancelled')
                ->count(),

            'total_amount' => Expense::where(
                'company_id',
                $company->id
            )->sum('amount'),

            'paid_amount' => Expense::where(
                'company_id',
                $company->id
            )
                ->where('status', 'paid')
                ->sum('amount'),
        ];

        return view(
            'finance.expenses.index',
            compact(
                'expenses',
                'categories',
                'summary'
            )
        );
    }

    /**
     * Show the form for creating a new expense.
     */
    public function create(Request $request): View
    {
        $company = $request->attributes->get('currentCompany');

        abort_unless($company, 403);

        $categories = Expense::where(
            'company_id',
            $company->id
        )
            ->whereNotNull('category')
            ->where('category', '!=', '')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        return view(
            'finance.expenses.create',
            compact('categories')
        );
    }

    /**
     * Store a newly created expense.
     */
    public function store(Request $request): RedirectResponse
    {
        $user = $request->user();

        $company = $request->attributes->get('currentCompany');

        abort_unless($company, 403);

        $validated = $request->validate([
            'category' => [
                'required',
                'string',
                'max:100',
            ],

            'description' => [
                'required',
                'string',
                'max:255',
            ],

            'amount' => [
                'required',
                'numeric',
                'min:0',
            ],

            'expense_date' => [
                'required',
                'date',
            ],

            'status' => [
                'required',
                'in:pending,paid,cancelled',
            ],
        ]);

        $expense = Expense::create([
            'company_id' => $company->id,
            'user_id' => $user->id,
            'category' => $validated['category'],
            'description' => $validated['description'],
            'amount' => $validated['amount'],
            'expense_date' => $validated['expense_date'],
            'status' => $validated['status'],
        ]);

        $user->notify(
            new SystemNotification(
                'Expense Created',
                "Expense {$expense->description} was created for Rp "
                    . number_format(
                        (float) $expense->amount,
                        0,
                        ',',
                        '.'
                    )
                    . '.',
                'finance',
                '−'
            )
        );

        return redirect()
            ->route(
                'finance.expenses.show',
                $expense
            )
            ->with(
                'success',
                'Expense created successfully.'
            );
    }

    /**
     * Display the specified expense.
     */
    public function show(
        Request $request,
        Expense $expense
    ): View {
        $company = $request->attributes->get('currentCompany');

        abort_unless($company, 403);

        abort_unless(
            $expense->company_id === $company->id,
            404
        );

        $expense->load(['user']);

        return view(
            'finance.expenses.show',
            compact('expense')
        );
    }

    /**
     * Show the form for editing the specified expense.
     */
    public function edit(
        Request $request,
        Expense $expense
    ): View {
        $company = $request->attributes->get('currentCompany');

        abort_unless($company, 403);

        abort_unless(
            $expense->company_id === $company->id,
            404
        );

        $categories = Expense::where(
            'company_id',
            $company->id
        )
            ->whereNotNull('category')
            ->where('category', '!=', '')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        return view(
            'finance.expenses.edit',
            compact(
                'expense',
                'categories'
            )
        );
    }

    /**
     * Update the specified expense.
     */
    public function update(
        Request $request,
        Expense $expense
    ): RedirectResponse {
        $user = $request->user();

        $company = $request->attributes->get('currentCompany');

        abort_unless($company, 403);

        abort_unless(
            $expense->company_id === $company->id,
            404
        );

        $validated = $request->validate([
            'category' => [
                'required',
                'string',
                'max:100',
            ],

            'description' => [
                'required',
                'string',
                'max:255',
            ],

            'amount' => [
                'required',
                'numeric',
                'min:0',
            ],

            'expense_date' => [
                'required',
                'date',
            ],

            'status' => [
                'required',
                'in:pending,paid,cancelled',
            ],
        ]);

        $oldStatus = $expense->status;
        $oldAmount = (float) $expense->amount;
        $oldDescription = $expense->description;

        $expense->update([
            'category' => $validated['category'],
            'description' => $validated['description'],
            'amount' => $validated['amount'],
            'expense_date' => $validated['expense_date'],
            'status' => $validated['status'],
        ]);

        $user->notify(
            new SystemNotification(
                'Expense Updated',
                "Expense {$expense->description} was updated.",
                'finance',
                '✎'
            )
        );

        if ($oldStatus !== $expense->status) {
            $user->notify(
                new SystemNotification(
                    'Expense Status Updated',
                    "Expense {$expense->description} changed from "
                        . ucfirst($oldStatus)
                        . ' to '
                        . ucfirst($expense->status)
                        . '.',
                    'finance',
                    '◫'
                )
            );
        }

        if ($oldAmount !== (float) $expense->amount) {
            $user->notify(
                new SystemNotification(
                    'Expense Amount Updated',
                    "Expense {$expense->description} amount changed from Rp "
                        . number_format(
                            $oldAmount,
                            0,
                            ',',
                            '.'
                        )
                        . ' to Rp '
                        . number_format(
                            (float) $expense->amount,
                            0,
                            ',',
                            '.'
                        )
                        . '.',
                    'finance',
                    '₋'
                )
            );
        }

        if ($oldDescription !== $expense->description) {
            $user->notify(
                new SystemNotification(
                    'Expense Description Updated',
                    'Expense description was changed.',
                    'finance',
                    '≡'
                )
            );
        }

        return redirect()
            ->route(
                'finance.expenses.show',
                $expense
            )
            ->with(
                'success',
                'Expense updated successfully.'
            );
    }

    /**
     * Remove the specified expense.
     */
    public function destroy(
        Request $request,
        Expense $expense
    ): RedirectResponse {
        $user = $request->user();

        $company = $request->attributes->get('currentCompany');

        abort_unless($company, 403);

        abort_unless(
            $expense->company_id === $company->id,
            404
        );

        $description = $expense->description;
        $amount = (float) $expense->amount;

        $expense->delete();

        $user->notify(
            new SystemNotification(
                'Expense Deleted',
                "Expense {$description} for Rp "
                    . number_format(
                        $amount,
                        0,
                        ',',
                        '.'
                    )
                    . ' was deleted.',
                'finance',
                '×'
            )
        );

        return redirect()
            ->route('finance.expenses.index')
            ->with(
                'success',
                'Expense deleted successfully.'
            );
    }
}