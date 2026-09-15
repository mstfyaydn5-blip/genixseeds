<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProductCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:manage products');
    }

    public function index()
    {
        $categories = ProductCategory::withCount('products')->orderBy('order')->paginate(20);

        return view('admin.product_categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name_en' => ['required', 'string', 'max:255'],
            'name_ar' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'alpha_dash', 'max:255', 'unique:product_categories,slug'],
            'order' => ['nullable', 'integer'],
        ]);
        $data['slug'] = $data['slug'] ?? Str::slug($data['name_en']);

        ProductCategory::create($data);

        return back()->with('success', __('Category created successfully.'));
    }

    public function update(Request $request, ProductCategory $productCategory)
    {
        $data = $request->validate([
            'name_en' => ['required', 'string', 'max:255'],
            'name_ar' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'alpha_dash', 'max:255', Rule::unique('product_categories', 'slug')->ignore($productCategory->id)],
            'order' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $productCategory->update($data);

        return back()->with('success', __('Category updated successfully.'));
    }

    public function destroy(ProductCategory $productCategory)
    {
        $productCategory->delete();

        return back()->with('success', __('Category deleted successfully.'));
    }
}
