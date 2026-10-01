<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Index
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $company = request()->attributes->get('currentCompany');

        abort_unless($company, 403);

        $products = Product::with([
            'category',
            'variants.inventories',
        ])
            ->where('company_id', $company->id)
            ->latest()
            ->get();

        return view('products.index', compact('products'));
    }

    /*
    |--------------------------------------------------------------------------
    | Show
    |--------------------------------------------------------------------------
    */

    public function show(Product $product)
    {
        $company = request()->attributes->get('currentCompany');

        abort_unless($company, 403);

        /*
        |--------------------------------------------------------------------------
        | Tenant Isolation
        |--------------------------------------------------------------------------
        |
        | Product harus berasal dari company yang sedang aktif.
        |
        */

        abort_unless(
            $product->company_id === $company->id,
            404
        );

        $product->load([
            'category',
            'variants.inventories',
        ]);

        return view('products.show', compact('product'));
    }

    /*
    |--------------------------------------------------------------------------
    | Edit
    |--------------------------------------------------------------------------
    */

    public function edit(Product $product)
    {
        $company = request()->attributes->get('currentCompany');

        abort_unless($company, 403);

        /*
        |--------------------------------------------------------------------------
        | Tenant Isolation
        |--------------------------------------------------------------------------
        */

        abort_unless(
            $product->company_id === $company->id,
            404
        );

        $product->load([
            'category',
            'variants',
        ]);

        $categories = Category::where(
            'company_id',
            $company->id
        )
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        $variant = $product->variants->first();

        return view('products.edit', compact(
            'product',
            'categories',
            'variant'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | Create
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $company = request()->attributes->get('currentCompany');

        abort_unless($company, 403);

        $categories = Category::where(
            'company_id',
            $company->id
        )
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('products.create', compact('categories'));
    }

    /*
    |--------------------------------------------------------------------------
    | Store
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $company = request()->attributes->get('currentCompany');

        abort_unless($company, 403);

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'category_id' => [
                'nullable',
                'exists:categories,id',
            ],

            'brand' => [
                'nullable',
                'string',
                'max:255',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'sku' => [
                'required',
                'string',
                'max:100',
            ],

            'variant_name' => [
                'required',
                'string',
                'max:255',
            ],

            'price' => [
                'required',
                'numeric',
                'min:0',
            ],

            'cost_price' => [
                'nullable',
                'numeric',
                'min:0',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Validate Category Ownership
        |--------------------------------------------------------------------------
        */

        $categoryId = $validated['category_id'] ?? null;

        if ($categoryId) {
            $categoryExists = Category::where(
                'company_id',
                $company->id
            )
                ->whereKey($categoryId)
                ->exists();

            abort_unless($categoryExists, 422);
        }

        /*
        |--------------------------------------------------------------------------
        | Create Product
        |--------------------------------------------------------------------------
        */

        $product = Product::create([
            'company_id' => $company->id,
            'category_id' => $categoryId,
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'description' => $validated['description'] ?? null,
            'brand' => $validated['brand'] ?? null,
            'status' => $request->has('is_active')
                ? 'active'
                : 'inactive',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Create Initial Variant
        |--------------------------------------------------------------------------
        */

        ProductVariant::create([
            'company_id' => $company->id,
            'product_id' => $product->id,
            'sku' => $validated['sku'],
            'name' => $validated['variant_name'],
            'price' => $validated['price'],
            'cost_price' => $validated['cost_price'] ?? null,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()
            ->route('products.index')
            ->with(
                'success',
                'Product created successfully.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | Update
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        Product $product
    ) {
        $company = request()->attributes->get('currentCompany');

        abort_unless($company, 403);

        /*
        |--------------------------------------------------------------------------
        | Tenant Isolation
        |--------------------------------------------------------------------------
        */

        abort_unless(
            $product->company_id === $company->id,
            404
        );

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'category_id' => [
                'nullable',
                'exists:categories,id',
            ],

            'brand' => [
                'nullable',
                'string',
                'max:255',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'sku' => [
                'required',
                'string',
                'max:100',
            ],

            'variant_name' => [
                'required',
                'string',
                'max:255',
            ],

            'price' => [
                'required',
                'numeric',
                'min:0',
            ],

            'cost_price' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'status' => [
                'required',
                'in:active,inactive',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Validate Category Ownership
        |--------------------------------------------------------------------------
        */

        $categoryId = $validated['category_id'] ?? null;

        if ($categoryId) {
            $categoryExists = Category::where(
                'company_id',
                $company->id
            )
                ->whereKey($categoryId)
                ->exists();

            abort_unless($categoryExists, 422);
        }

        /*
        |--------------------------------------------------------------------------
        | Update Product
        |--------------------------------------------------------------------------
        */

        $product->update([
            'category_id' => $categoryId,
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'brand' => $validated['brand'] ?? null,
            'status' => $validated['status'],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Update Variant
        |--------------------------------------------------------------------------
        */

        $variant = $product->variants()
            ->where('company_id', $company->id)
            ->first();

        if ($variant) {
            $variant->update([
                'sku' => $validated['sku'],
                'name' => $validated['variant_name'],
                'price' => $validated['price'],
                'cost_price' => $validated['cost_price'] ?? null,
                'is_active' => $request->has('is_active'),
            ]);
        }

        return redirect()
            ->route('products.show', $product)
            ->with(
                'success',
                'Product updated successfully.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | Destroy
    |--------------------------------------------------------------------------
    */

    public function destroy(Product $product)
    {
        $company = request()->attributes->get('currentCompany');

        abort_unless($company, 403);

        /*
        |--------------------------------------------------------------------------
        | Tenant Isolation
        |--------------------------------------------------------------------------
        */

        abort_unless(
            $product->company_id === $company->id,
            404
        );

        $product->delete();

        return redirect()
            ->route('products.index')
            ->with(
                'success',
                'Product deleted successfully.'
            );
    }
}