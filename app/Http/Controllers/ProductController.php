<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with([
            'category',
            'variants.inventories',
        ])
            ->latest()
            ->get();

        return view('products.index', compact('products'));
    }

    public function show(Product $product)
    {
        $product->load([
            'category',
            'variants.inventories',
        ]);

        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $company = auth()->user()->companies()->first();

        abort_unless($company, 403);

        $product->load([
            'category',
            'variants',
        ]);

        $categories = Category::where('company_id', $company->id)
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

    public function create()
    {
        $company = auth()->user()->companies()->first();

        abort_unless($company, 403);

        $categories = Category::where('company_id', $company->id)
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $company = auth()->user()->companies()->first();

        abort_unless($company, 403);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'brand' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],

            'sku' => ['required', 'string', 'max:100'],
            'variant_name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'cost_price' => ['nullable', 'numeric', 'min:0'],
        ]);

        $product = Product::create([
            'company_id' => $company->id,
            'category_id' => $validated['category_id'] ?? null,
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'description' => $validated['description'] ?? null,
            'brand' => $validated['brand'] ?? null,
            'status' => $request->has('is_active') ? 'active' : 'inactive',
        ]);

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
            ->with('success', 'Product created successfully.');
    }

    public function update(Request $request, Product $product)
    {
        $company = auth()->user()->companies()->first();

        abort_unless($company, 403);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'brand' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],

            'sku' => ['required', 'string', 'max:100'],
            'variant_name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'cost_price' => ['nullable', 'numeric', 'min:0'],
            'status' => ['required', 'in:active,inactive'],
        ]);

        $product->update([
            'category_id' => $validated['category_id'] ?? null,
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'brand' => $validated['brand'] ?? null,
            'status' => $validated['status'],
        ]);

        $variant = $product->variants()->first();

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
            ->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $company = auth()->user()->companies()->first();

        abort_unless($company, 403);

        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('success', 'Product deleted successfully.');
    }
}