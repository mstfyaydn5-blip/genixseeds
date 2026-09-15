@extends('layouts.admin')
@section('title', 'Services')
@section('page-title', 'Manage Services')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <form class="d-flex gap-2" method="GET">
        <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Search services...">
        <select name="status" class="form-select">
            <option value="">All Status</option>
            <option value="active" @selected(request('status')==='active')>Active</option>
            <option value="inactive" @selected(request('status')==='inactive')>Inactive</option>
        </select>
        <button class="btn btn-outline-secondary"><i class="bi bi-search"></i></button>
    </form>
    <a href="{{ route('admin.services.create') }}" class="btn-admin"><i class="bi bi-plus-lg"></i> Add Service</a>
</div>

<div class="table-card">
    <table class="table align-middle mb-0">
        <thead>
            <tr><th>Image</th><th>Title</th><th>Order</th><th>Featured</th><th>Status</th><th class="text-end">Actions</th></tr>
        </thead>
        <tbody>
            @forelse($services as $service)
                <tr>
                    <td><img src="{{ $service->image ? asset('storage/'.$service->image) : 'https://ui-avatars.com/api/?background=e6f4ea&color=1b6b39&name='.urlencode($service->title_en) }}" width="48" height="48" class="rounded" style="object-fit:cover;" alt=""></td>
                    <td class="fw-semibold">{{ $service->title_en }}</td>
                    <td>{{ $service->order }}</td>
                    <td>@if($service->is_featured)<span class="badge bg-success">Yes</span>@else<span class="badge bg-secondary">No</span>@endif</td>
                    <td>@if($service->is_active)<span class="badge bg-success">Active</span>@else<span class="badge bg-danger">Inactive</span>@endif</td>
                    <td class="text-end">
                        <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('admin.services.destroy', $service) }}" method="POST" class="d-inline" data-confirm="Delete this service?">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center text-muted py-4">No services found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-3">{{ $services->links() }}</div>
@endsection
