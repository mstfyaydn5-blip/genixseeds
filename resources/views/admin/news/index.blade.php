@extends('layouts.admin')
@section('title', 'News & Articles')
@section('page-title', 'Manage News & Articles')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    <form class="d-flex gap-2" method="GET">
        <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Search articles...">
        <select name="status" class="form-select">
            <option value="">All Status</option>
            <option value="published" @selected(request('status')==='published')>Published</option>
            <option value="draft" @selected(request('status')==='draft')>Draft</option>
        </select>
        <button class="btn btn-outline-secondary"><i class="bi bi-search"></i></button>
    </form>
    <div class="d-flex gap-2">
        <button class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#categoriesModal"><i class="bi bi-tags"></i> Categories</button>
        <a href="{{ route('admin.news.create') }}" class="btn-admin"><i class="bi bi-plus-lg"></i> Add Article</a>
    </div>
</div>
<div class="table-card">
    <table class="table align-middle mb-0">
        <thead><tr><th>Image</th><th>Title</th><th>Category</th><th>Views</th><th>Status</th><th>Date</th><th class="text-end">Actions</th></tr></thead>
        <tbody>
            @forelse($articles as $article)
                <tr>
                    <td><img src="{{ $article->cover_image ? asset('storage/'.$article->cover_image) : 'https://ui-avatars.com/api/?background=e6f4ea&color=1b6b39&name='.urlencode($article->title_en) }}" width="48" height="48" class="rounded" style="object-fit:cover;" alt=""></td>
                    <td class="fw-semibold">{{ Str::limit($article->title_en, 40) }}</td>
                    <td>{{ $article->category->name_en ?? '-' }}</td>
                    <td>{{ $article->views }}</td>
                    <td>@if($article->is_published)<span class="badge bg-success">Published</span>@else<span class="badge bg-secondary">Draft</span>@endif</td>
                    <td class="text-muted small">{{ $article->created_at->format('d M Y') }}</td>
                    <td class="text-end">
                        <a href="{{ route('admin.news.edit', $article) }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('admin.news.destroy', $article) }}" method="POST" class="d-inline" data-confirm="Delete this article?">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button></form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" class="text-center text-muted py-4">No articles found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-3">{{ $articles->links() }}</div>

<div class="modal fade" id="categoriesModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header"><h6 class="modal-title">News Categories</h6><button class="btn-close" data-bs-dismiss="modal"></button></div>
            <div class="modal-body">
                <form method="POST" action="{{ route('admin.news-categories.store') }}" class="row g-2 mb-4">
                    @csrf
                    <div class="col-md-5"><input type="text" name="name_en" class="form-control" placeholder="Name (EN)" required></div>
                    <div class="col-md-5"><input type="text" name="name_ar" class="form-control" placeholder="الاسم (AR)" dir="rtl" required></div>
                    <div class="col-md-2"><button class="btn-admin w-100">Add</button></div>
                </form>
                <table class="table align-middle">
                    <thead><tr><th>Name (EN)</th><th>Name (AR)</th><th class="text-end">Actions</th></tr></thead>
                    <tbody>
                        @forelse($categories as $cat)
                            <tr>
                                <td>{{ $cat->name_en }}</td>
                                <td dir="rtl">{{ $cat->name_ar }}</td>
                                <td class="text-end">
                                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#editNewsCat{{ $cat->id }}"><i class="bi bi-pencil"></i></button>
                                    <form method="POST" action="{{ route('admin.news-categories.destroy', $cat) }}" class="d-inline" data-confirm="Delete this category?">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button></form>
                                </td>
                            </tr>
                            <div class="modal fade" id="editNewsCat{{ $cat->id }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form method="POST" action="{{ route('admin.news-categories.update', $cat) }}">
                                            @csrf @method('PUT')
                                            <div class="modal-header"><h6 class="modal-title">Edit Category</h6><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                                            <div class="modal-body">
                                                <div class="mb-3"><label class="form-label small">Name (EN)</label><input type="text" name="name_en" value="{{ $cat->name_en }}" class="form-control" required></div>
                                                <div class="mb-3"><label class="form-label small">Name (AR)</label><input type="text" name="name_ar" value="{{ $cat->name_ar }}" class="form-control" dir="rtl" required></div>
                                                <div class="mb-3"><label class="form-label small">Slug</label><input type="text" name="slug" value="{{ $cat->slug }}" class="form-control" required></div>
                                            </div>
                                            <div class="modal-footer"><button class="btn-admin">Save</button></div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr><td colspan="3" class="text-center text-muted py-3">No categories yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
