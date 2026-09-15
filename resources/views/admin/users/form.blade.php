@extends('layouts.admin')
@section('title', $user->exists ? 'Edit User' : 'Add User')
@section('page-title', $user->exists ? 'Edit User' : 'Add User')
@section('content')
<form method="POST" action="{{ $user->exists ? route('admin.users.update', $user) : route('admin.users.store') }}">
    @csrf
    @if($user->exists) @method('PUT') @endif
    <div class="row g-3">
        <div class="col-lg-8">
            <div class="card-form">
                <div class="row g-3">
                    <div class="col-md-6"><label class="form-label small fw-semibold">Name</label><input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control" required></div>
                    <div class="col-md-6"><label class="form-label small fw-semibold">Email</label><input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" required></div>
                    <div class="col-md-6"><label class="form-label small fw-semibold">Phone</label><input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="form-control"></div>
                    <div class="col-md-6"><label class="form-label small fw-semibold">Password {{ $user->exists ? '(leave blank to keep)' : '' }}</label><input type="password" name="password" class="form-control" {{ $user->exists ? '' : 'required' }}></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card-form mb-3">
                <label class="form-label fw-semibold">Role</label>
                <select name="role" class="form-select" required>
                    @foreach($roles as $role)
                        <option value="{{ $role }}" @selected(old('role', $user->roles->first()->name ?? '') === $role)>{{ ucfirst($role) }}</option>
                    @endforeach
                </select>
                <div class="form-check form-switch mt-3"><input class="form-check-input" type="checkbox" name="is_active" value="1" @checked(old('is_active', $user->is_active ?? true))><label class="form-check-label">Active</label></div>
            </div>
            <button class="btn-admin w-100">Save User</button>
        </div>
    </div>
</form>
@endsection
