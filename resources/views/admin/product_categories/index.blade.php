@extends('layouts.admin')
@section('title', 'Product Categories')
@section('page-title', 'Product Categories')
@section('content')

<div class="row g-3">
    <div class="col-lg-4">
        <div class="card-form">
            <h6 class="fw-bold mb-3">Add Category</h6>
            <form method="POST" action="{{ route('admin.product-categories.store') }}">
                @csrf
                <div class="mb-3"><label class="form-label small fw-semibold">Name (EN)</label><input type="text" name="name_en" class="form-control" required></div>
                <div class="mb-3"><label class="form-label small fw-semibold">Name (AR)</label><input type="text" name="name_ar" class="form-control" dir="rtl" required></div>
                <div class="mb-3"><label class="form-label small fw-semibold">Slug</label><input type="text" name="slug" class="form-control" placeholder="auto"></div>
                <div class="mb-3"><label class="form-label small fw-semibold">Order</label><input type="number" name="order" value="0" class="form-control"></div>
                <button class="btn-admin w-100">Add</button>
            </form>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="table-card">
            <table class="table align-middle mb-0">
                <thead><tr><th>Name (EN)</th><th>Name (AR)</th><th>Products</th><th class="text-end">Actions</th></tr></thead>
                <tbody>
                    @forelse($categories as $cat)
                        <tr>
                            <td>{{ $cat->name_en }}</td>
                            <td dir="rtl">{{ $cat->name_ar }}</td>
                            <td>{{ $cat->products_count }}</td>
                            <td class="text-end">
                                <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#edit{{ $cat->id }}"><i class="bi bi-pencil"></i></button>
                                <form action="{{ route('admin.product-categories.destroy', $cat) }}" method="POST" class="d-inline" data-confirm="Delete this category?">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button></form>
                            </td>
                        </tr>
                        <div class="modal fade" id="edit{{ $cat->id }}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form method="POST" action="{{ route('admin.product-categories.update', $cat) }}">
                                        @csrf @method('PUT')
                                        <div class="modal-header"><h6 class="modal-title">Edit Category</h6><button class="btn-close" data-bs-dismiss="modal"></button></div>
                                        <div class="modal-body">
                                            <div class="mb-3"><label class="form-label small">Name (EN)</label><input type="text" name="name_en" value="{{ $cat->name_en }}" class="form-control" required></div>
                                            <div class="mb-3"><label class="form-label small">Name (AR)</label><input type="text" name="name_ar" value="{{ $cat->name_ar }}" class="form-control" dir="rtl" required></div>
                                            <div class="mb-3"><label class="form-label small">Slug</label><input type="text" name="slug" value="{{ $cat->slug }}" class="form-control" required></div>
                                            <div class="form-check form-switch"><input class="form-check-input" type="checkbox" name="is_active" value="1" @checked($cat->is_active)><label class="form-check-label">Active</label></div>
                                        </div>
                                        <div class="modal-footer"><button class="btn-admin">Save</button></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr><td colspan="4" class="text-center text-muted py-4">No categories yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">{{ $categories->links() }}</div>
    </div>
</div>
@endsection
