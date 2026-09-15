@extends('layouts.admin')
@section('title', 'General Settings')
@section('page-title', 'Website Settings')
@section('content')
@php
    $get = fn($key) => \App\Models\Setting::get($key);
@endphp
<form method="POST" action="{{ route('admin.settings.general.update') }}" enctype="multipart/form-data">
    @csrf @method('PUT')
    <div class="row g-3">
        <div class="col-lg-8">
            <div class="card-form mb-3">
                <h6 class="fw-bold mb-3">Site Identity</h6>
                <div class="row g-3">
                    <div class="col-md-6"><label class="form-label small fw-semibold">Site Name (EN)</label><input type="text" name="site_name_en" value="{{ old('site_name_en', $get('site_name_en')) }}" class="form-control" required></div>
                    <div class="col-md-6"><label class="form-label small fw-semibold">Site Name (AR)</label><input type="text" name="site_name_ar" value="{{ old('site_name_ar', $get('site_name_ar')) }}" class="form-control" dir="rtl" required></div>
                    <div class="col-md-6"><label class="form-label small fw-semibold">Tagline (EN)</label><input type="text" name="tagline_en" value="{{ old('tagline_en', $get('tagline_en')) }}" class="form-control"></div>
                    <div class="col-md-6"><label class="form-label small fw-semibold">Tagline (AR)</label><input type="text" name="tagline_ar" value="{{ old('tagline_ar', $get('tagline_ar')) }}" class="form-control" dir="rtl"></div>
                </div>
            </div>
            <div class="card-form mb-3">
                <h6 class="fw-bold mb-3">Contact Information</h6>
                <div class="row g-3">
                    <div class="col-md-6"><label class="form-label small fw-semibold">Phone</label><input type="text" name="phone" value="{{ old('phone', $get('phone')) }}" class="form-control"></div>
                    <div class="col-md-6"><label class="form-label small fw-semibold">Email</label><input type="email" name="email" value="{{ old('email', $get('email')) }}" class="form-control"></div>
                    <div class="col-md-6"><label class="form-label small fw-semibold">Address (EN)</label><input type="text" name="address_en" value="{{ old('address_en', $get('address_en')) }}" class="form-control"></div>
                    <div class="col-md-6"><label class="form-label small fw-semibold">Address (AR)</label><input type="text" name="address_ar" value="{{ old('address_ar', $get('address_ar')) }}" class="form-control" dir="rtl"></div>
                </div>
            </div>
            <div class="card-form">
                <h6 class="fw-bold mb-3">Social Media</h6>
                <div class="row g-3">
                    @foreach(['facebook','twitter','instagram','linkedin','youtube'] as $social)
                        <div class="col-md-6"><label class="form-label small fw-semibold text-capitalize">{{ $social }}</label><input type="url" name="{{ $social }}" value="{{ old($social, $get($social)) }}" class="form-control"></div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card-form mb-3">
                <label class="form-label fw-semibold">Logo</label>
                <input type="file" name="logo" class="form-control mb-2">
                @if($get('logo'))<img src="{{ asset('storage/'.$get('logo')) }}" class="img-fluid rounded" alt="">@endif
            </div>
            <div class="card-form mb-3">
                <label class="form-label fw-semibold">Favicon</label>
                <input type="file" name="favicon" class="form-control mb-2">
                @if($get('favicon'))<img src="{{ asset('storage/'.$get('favicon')) }}" width="48" alt="">@endif
            </div>
            <button class="btn-admin w-100">Save Settings</button>
        </div>
    </div>
</form>
@endsection
