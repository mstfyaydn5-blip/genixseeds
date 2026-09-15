@extends('layouts.admin')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('content')

<div class="row g-3 mb-4">
    @php
        $cards = [
            ['label' => 'Services', 'value' => $stats['services'], 'icon' => 'bi-flower1'],
            ['label' => 'Products', 'value' => $stats['products'], 'icon' => 'bi-box-seam'],
            ['label' => 'News Articles', 'value' => $stats['news'], 'icon' => 'bi-newspaper'],
            ['label' => 'Total Messages', 'value' => $stats['messages'], 'icon' => 'bi-envelope'],
            ['label' => 'Unread Messages', 'value' => $stats['unread_messages'], 'icon' => 'bi-envelope-exclamation'],
        ];
    @endphp
    @foreach($cards as $card)
        <div class="col-6 col-lg-3">
            <div class="stat-card d-flex align-items-center gap-3">
                <div class="stat-icon"><i class="bi {{ $card['icon'] }}"></i></div>
                <div>
                    <div class="stat-value">{{ $card['value'] }}</div>
                    <div class="text-muted small">{{ $card['label'] }}</div>
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class="row g-3">
    <div class="col-lg-6">
        <div class="table-card p-3">
            <h6 class="fw-bold mb-3">Recent Contact Messages</h6>
            <table class="table align-middle mb-0">
                <thead><tr><th>Name</th><th>Subject</th><th>Date</th></tr></thead>
                <tbody>
                    @forelse($recentMessages as $m)
                        <tr>
                            <td><a href="{{ route('admin.messages.show', $m) }}">{{ $m->name }}</a> @if(!$m->is_read)<span class="badge bg-warning text-dark">New</span>@endif</td>
                            <td>{{ Str::limit($m->subject ?: $m->message, 25) }}</td>
                            <td class="text-muted small">{{ $m->created_at->diffForHumans() }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="3" class="text-center text-muted py-3">No messages yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
