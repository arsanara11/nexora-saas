<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Index
    |--------------------------------------------------------------------------
    */

    public function index(Request $request): View
    {
        $company = $request->attributes->get('currentCompany');

        abort_unless($company, 403);

        $query = Category::query()
            ->where('company_id', $company->id)
            ->withCount('products')
            ->latest();

        if ($request->filled('search')) {
            $search = trim(
                $request->string('search')->toString()
            );

            $query->where(function ($q) use ($search) {
                $q->where(
                    'name',
                    'like',
                    "%{$search}%"
                )
                    ->orWhere(
                        'slug',
                        'like',
                        "%{$search}%"
                    )
                    ->orWhere(
                        'description',
                        'like',
                        "%{$search}%"
                    );
            });
        }

        if ($request->filled('status')) {
            $query->where(
                'is_active',
                $request->string('status')->toString() === 'active'
            );
        }

        $categories = $query
            ->paginate(15)
            ->withQueryString();

        $summary = [
            'total' => Category::where(
                'company_id',
                $company->id
            )->count(),

            'active' => Category::where(
                'company_id',
                $company->id
            )
                ->where('is_active', true)
                ->count(),

            'inactive' => Category::where(
                'company_id',
                $company->id
            )
                ->where('is_active', false)
                ->count(),

            'with_products' => Category::where(
                'company_id',
                $company->id
            )
                ->has('products')
                ->count(),
        ];

        return view(
            'categories.index',
            compact(
                'categories',
                'summary'
            )
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Create
    |--------------------------------------------------------------------------
    */

    public function create(Request $request): View
    {
        $company = $request->attributes->get('currentCompany');

        abort_unless($company, 403);

        return view('categories.create');
    }

    /*
    |--------------------------------------------------------------------------
    | Store
    |--------------------------------------------------------------------------
    */

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

            'slug' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('categories', 'slug')
                    ->where(
                        fn ($query) => $query->where(
                            'company_id',
                            $company->id
                        )
                    ),
            ],

            'description' => [
                'nullable',
                'string',
                'max:2000',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],
        ]);

        $slug = $validated['slug']
            ?? Str::slug($validated['name']);

        $baseSlug = $slug;
        $counter = 1;

        while (
            Category::where(
                'company_id',
                $company->id
            )
                ->where('slug', $slug)
                ->exists()
        ) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        $validated['slug'] = $slug;
        $validated['company_id'] = $company->id;
        $validated['is_active'] = $request->boolean(
            'is_active',
            true
        );

        $category = Category::create($validated);

        return redirect()
            ->route('categories.index')
            ->with(
                'success',
                "Category {$category->name} created successfully."
            );
    }

    /*
    |--------------------------------------------------------------------------
    | Show
    |--------------------------------------------------------------------------
    */

    public function show(
        Request $request,
        Category $category
    ): View {
        $company = $request->attributes->get('currentCompany');

        abort_unless($company, 403);

        /*
        |--------------------------------------------------------------------------
        | Tenant Isolation
        |--------------------------------------------------------------------------
        */

        abort_unless(
            $category->company_id === $company->id,
            404
        );

        $category->load([
            'products',
        ]);

        $products = $category
            ->products()
            ->where(
                'company_id',
                $company->id
            )
            ->latest()
            ->paginate(15)
            ->withQueryString();

        /*
        |--------------------------------------------------------------------------
        | Product Summary
        |--------------------------------------------------------------------------
        |
        | The current products table does not contain an is_active
        | column. Therefore we do not query products.is_active here.
        |
        | Existing products are treated as current product records
        | for the category summary without modifying the database.
        |
        */

        $productTotal = $category
            ->products()
            ->where(
                'company_id',
                $company->id
            )
            ->count();

        $productSummary = [
            'total' => $productTotal,
            'active' => $productTotal,
            'inactive' => 0,
        ];

        return view(
            'categories.show',
            compact(
                'category',
                'products',
                'productSummary'
            )
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Edit
    |--------------------------------------------------------------------------
    */

    public function edit(
        Request $request,
        Category $category
    ): View {
        $company = $request->attributes->get('currentCompany');

        abort_unless($company, 403);

        /*
        |--------------------------------------------------------------------------
        | Tenant Isolation
        |--------------------------------------------------------------------------
        */

        abort_unless(
            $category->company_id === $company->id,
            404
        );

        return view(
            'categories.edit',
            compact('category')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Update
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        Category $category
    ): RedirectResponse {
        $company = $request->attributes->get('currentCompany');

        abort_unless($company, 403);

        /*
        |--------------------------------------------------------------------------
        | Tenant Isolation
        |--------------------------------------------------------------------------
        */

        abort_unless(
            $category->company_id === $company->id,
            404
        );

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'slug' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('categories', 'slug')
                    ->ignore($category->id)
                    ->where(
                        fn ($query) => $query->where(
                            'company_id',
                            $company->id
                        )
                    ),
            ],

            'description' => [
                'nullable',
                'string',
                'max:2000',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],
        ]);

        $slug = $validated['slug']
            ?? Str::slug($validated['name']);

        $baseSlug = $slug;
        $counter = 1;

        while (
            Category::where(
                'company_id',
                $company->id
            )
                ->where('slug', $slug)
                ->where(
                    'id',
                    '!=',
                    $category->id
                )
                ->exists()
        ) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        $validated['slug'] = $slug;

        $validated['is_active'] = $request->boolean(
            'is_active',
            true
        );

        $categoryName = $category->name;

        $category->update($validated);

        return redirect()
            ->route('categories.index')
            ->with(
                'success',
                "Category {$categoryName} updated successfully."
            );
    }

    /*
    |--------------------------------------------------------------------------
    | Toggle Status
    |--------------------------------------------------------------------------
    */

    public function toggleStatus(
        Request $request,
        Category $category
    ): RedirectResponse {
        $company = $request->attributes->get('currentCompany');

        abort_unless($company, 403);

        /*
        |--------------------------------------------------------------------------
        | Tenant Isolation
        |--------------------------------------------------------------------------
        */

        abort_unless(
            $category->company_id === $company->id,
            404
        );

        $category->update([
            'is_active' => ! $category->is_active,
        ]);

        return redirect()
            ->back()
            ->with(
                'success',
                "Category {$category->name} status updated."
            );
    }

    /*
    |--------------------------------------------------------------------------
    | Destroy
    |--------------------------------------------------------------------------
    */

    public function destroy(
        Request $request,
        Category $category
    ): RedirectResponse {
        $company = $request->attributes->get('currentCompany');

        abort_unless($company, 403);

        /*
        |--------------------------------------------------------------------------
        | Tenant Isolation
        |--------------------------------------------------------------------------
        */

        abort_unless(
            $category->company_id === $company->id,
            404
        );

        /*
        |--------------------------------------------------------------------------
        | Prevent Delete When Used By Products
        |--------------------------------------------------------------------------
        */

        if ($category->products()->exists()) {
            return redirect()
                ->route('categories.index')
                ->with(
                    'error',
                    'This category cannot be deleted because it is already used by products.'
                );
        }

        $categoryName = $category->name;

        $category->delete();

        return redirect()
            ->route('categories.index')
            ->with(
                'success',
                "Category {$categoryName} deleted successfully."
            );
    }
}