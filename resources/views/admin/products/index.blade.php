@extends('layouts.admin')
@section('title', 'Products')
@section('page-title', 'Manage Products')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    <form class="d-flex gap-2" method="GET">
        <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Search products...">
        <select name="category" class="form-select">
            <option value="">All Categories</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" @selected(request('category')==$cat->id)>{{ $cat->name_en }}</option>
            @endforeach
        </select>
        <button class="btn btn-outline-secondary"><i class="bi bi-search"></i></button>
    </form>
    <a href="{{ route('admin.products.create') }}" class="btn-admin"><i class="bi bi-plus-lg"></i> Add Product</a>
</div>

<div class="table-card">
    <table class="table align-middle mb-0">
        <thead><tr><th>Image</th><th>Name</th><th>Category</th><th>Price</th><th>Featured</th><th>Status</th><th class="text-end">Actions</th></tr></thead>
        <tbody>
            @forelse($products as $product)
                <tr>
                    <td><img src="{{ $product->image ? asset('storage/'.$product->image) : 'https://ui-avatars.com/api/?background=e6f4ea&color=1b6b39&name='.urlencode($product->name_en) }}" width="48" height="48" class="rounded" style="object-fit:cover;" alt=""></td>
                    <td class="fw-semibold">{{ $product->name_en }}</td>
                    <td>{{ $product->category->name_en ?? '-' }}</td>
                    <td>{{ $product->price ? '$'.number_format($product->price,2) : '-' }}</td>
                    <td>@if($product->is_featured)<span class="badge bg-success">Yes</span>@else<span class="badge bg-secondary">No</span>@endif</td>
                    <td>@if($product->is_active)<span class="badge bg-success">Active</span>@else<span class="badge bg-danger">Inactive</span>@endif</td>
                    <td class="text-end">
                        <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="d-inline" data-confirm="Delete this product?">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button></form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" class="text-center text-muted py-4">No products found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-3">{{ $products->links() }}</div>
@endsection
