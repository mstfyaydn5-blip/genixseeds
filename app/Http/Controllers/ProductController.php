<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::active()->brand('genix')->with('category');

        if ($request->filled('category')) {
            $query->whereHas('category', fn ($q) => $q->where('slug', $request->category));
        }

        if ($request->filled('q')) {
            $term = $request->q;
            $query->where(function ($q) use ($term) {
                $q->where('name_en', 'like', "%{$term}%")
                    ->orWhere('name_ar', 'like', "%{$term}%");
            });
        }

        $products = $query->orderBy('order')->paginate(9)->withQueryString();
        $categories = ProductCategory::active()->brand('genix')->orderBy('order')->get();

        return view('pages.products.index', compact('products', 'categories'));
    }

public function show(string $locale, string $slug)
{
    $product = Product::active()
        ->where('slug', $slug)
        ->with('category')
        ->firstOrFail();

    $related = Product::active()
        ->brand($product->brand)
        ->where('product_category_id', $product->product_category_id)
        ->where('id', '!=', $product->id)
        ->limit(4)
        ->get();

    return view('pages.products.show', compact('product', 'related'));
}
}
