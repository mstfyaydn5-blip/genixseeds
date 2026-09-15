@extends('layouts.admin')
@section('title', 'Message Details')
@section('page-title', 'Message Details')
@section('content')
<div class="card-form">
    <dl class="row">
        <dt class="col-sm-2">From</dt><dd class="col-sm-10">{{ $message->name }} ({{ $message->email }})</dd>
        <dt class="col-sm-2">Phone</dt><dd class="col-sm-10">{{ $message->phone ?: '-' }}</dd>
        <dt class="col-sm-2">Subject</dt><dd class="col-sm-10">{{ $message->subject ?: '-' }}</dd>
        <dt class="col-sm-2">Date</dt><dd class="col-sm-10">{{ $message->created_at->format('d M Y, h:i A') }}</dd>
    </dl>
    <hr>
    <p class="fs-5">{{ $message->message }}</p>
    <a href="mailto:{{ $message->email }}" class="btn-admin"><i class="bi bi-reply"></i> Reply via Email</a>
    <a href="{{ route('admin.messages.index') }}" class="btn btn-outline-secondary">Back</a>
</div>
@endsection
