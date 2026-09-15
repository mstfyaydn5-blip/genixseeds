@extends('layouts.admin')
@section('title', 'Contact Messages')
@section('page-title', 'Contact Messages')
@section('content')
<form class="d-flex gap-2 mb-3" method="GET">
    <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Search messages...">
    <select name="status" class="form-select" style="max-width:180px;"><option value="">All</option><option value="read" @selected(request('status')==='read')>Read</option><option value="unread" @selected(request('status')==='unread')>Unread</option></select>
    <button class="btn btn-outline-secondary"><i class="bi bi-search"></i></button>
</form>
<div class="table-card">
    <table class="table align-middle mb-0">
        <thead><tr><th>Name</th><th>Email</th><th>Subject</th><th>Date</th><th>Status</th><th class="text-end">Actions</th></tr></thead>
        <tbody>
            @forelse($messages as $msg)
                <tr class="{{ !$msg->is_read ? 'fw-bold' : '' }}">
                    <td>{{ $msg->name }}</td>
                    <td>{{ $msg->email }}</td>
                    <td>{{ Str::limit($msg->subject ?: $msg->message, 30) }}</td>
                    <td class="text-muted small fw-normal">{{ $msg->created_at->format('d M Y') }}</td>
                    <td>@if($msg->is_read)<span class="badge bg-secondary fw-normal">Read</span>@else<span class="badge bg-warning text-dark fw-normal">New</span>@endif</td>
                    <td class="text-end">
                        <a href="{{ route('admin.messages.show', $msg) }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-eye"></i></a>
                        <form action="{{ route('admin.messages.destroy', $msg) }}" method="POST" class="d-inline" data-confirm="Delete this message?">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button></form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center text-muted py-4">No messages found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-3">{{ $messages->links() }}</div>
@endsection
