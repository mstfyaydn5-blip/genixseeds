<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Traits\HandlesUploads;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    use HandlesUploads;

    public function __construct()
    {
        $this->middleware('can:manage products');
    }

    public function index(Request $request)
    {
        $products = Product::query()
            ->with('category')
            ->when($request->filled('q'), fn ($q) => $q->where('name_en', 'like', '%' . $request->q . '%'))
            ->when($request->filled('category'), fn ($q) => $q->where('product_category_id', $request->category))
            ->when($request->filled('status'), fn ($q) => $q->where('is_active', $request->status === 'active'))
            ->orderBy('order')
            ->paginate(15)
            ->withQueryString();

        $categories = ProductCategory::orderBy('name_en')->get();

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = ProductCategory::active()->orderBy('name_en')->get();

        return view('admin.products.form', ['product' => new Product(), 'categories' => $categories]);
    }

    public function store(ProductRequest $request)
    {
       $data = $request->validated();
$data['order'] = $data['order'] ?? 0;
$data['is_featured'] = $request->boolean('is_featured');
$data['is_active'] = $request->boolean('is_active');
        $data['slug'] = $data['slug'] ?: Str::slug($data['name_en']);

        if ($request->hasFile('image')) {
            $data['image'] = $this->storeImage($request->file('image'), 'products');
        }

        if ($request->hasFile('gallery')) {
            $data['gallery'] = $this->storeMultiple($request->file('gallery'), 'products/gallery');
        }

        if ($request->filled('spec_keys')) {
            $data['specifications'] = array_filter(array_combine($request->spec_keys, $request->spec_values ?? []));
        }

        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', __('Product created successfully.'));
    }

    public function edit(Product $product)
    {
        $categories = ProductCategory::active()->orderBy('name_en')->get();

        return view('admin.products.form', compact('product', 'categories'));
    }
public function update(ProductRequest $request, Product $product)
{
    $data = $request->validated();
$data['order'] = $data['order'] ?? 0;
    $data['is_featured'] = $request->boolean('is_featured');
    $data['is_active'] = $request->boolean('is_active');

    if ($request->hasFile('image')) {
        $this->deleteFile($product->image);
        $data['image'] = $this->storeImage($request->file('image'), 'products');
    }

    if ($request->hasFile('gallery')) {
        $data['gallery'] = array_merge(
            $product->gallery ?? [],
            $this->storeMultiple($request->file('gallery'), 'products/gallery')
        );
    }

    if ($request->filled('spec_keys')) {
        $data['specifications'] = array_filter(
            array_combine($request->spec_keys, $request->spec_values ?? [])
        );
    }

    $product->update($data);

    return redirect()
        ->route('admin.products.index')
        ->with('success', __('Product updated successfully.'));
}

    public function destroy(Product $product)
    {
        $this->deleteFile($product->image);
        foreach ($product->gallery ?? [] as $img) {
            $this->deleteFile($img);
        }
        $product->delete();

        return back()->with('success', __('Product deleted successfully.'));
    }
}
