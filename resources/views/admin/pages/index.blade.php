@extends('layouts.admin')
@section('title', 'Pages')
@section('page-title', 'Manage Pages')
@section('content')
<div class="d-flex justify-content-end mb-3">
    <a href="{{ route('admin.pages.create') }}" class="btn-admin"><i class="bi bi-plus-lg"></i> Add Page</a>
</div>
<div class="table-card">
    <table class="table align-middle mb-0">
        <thead><tr><th>Title</th><th>Slug</th><th>Status</th><th class="text-end">Actions</th></tr></thead>
        <tbody>
            @forelse($pages as $page)
                <tr>
                    <td class="fw-semibold">{{ $page->title_en }}</td>
                    <td><code>{{ $page->slug }}</code></td>
                    <td>@if($page->is_active)<span class="badge bg-success">Active</span>@else<span class="badge bg-danger">Inactive</span>@endif</td>
                    <td class="text-end">
                        <a href="{{ route('admin.pages.edit', $page) }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('admin.pages.destroy', $page) }}" method="POST" class="d-inline" data-confirm="Delete this page?">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button></form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-center text-muted py-4">No pages found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-3">{{ $pages->links() }}</div>
@endsection
