@extends('layouts.admin')
@section('title', 'SEO Settings')
@section('page-title', 'SEO Settings')
@section('content')
@php $get = fn($key) => \App\Models\Setting::get($key); @endphp
<form method="POST" action="{{ route('admin.settings.seo.update') }}">
    @csrf @method('PUT')
    <div class="card-form mb-3">
        <div class="row g-3">
            <div class="col-md-6"><label class="form-label small fw-semibold">Meta Title (EN)</label><input type="text" name="meta_title_en" value="{{ old('meta_title_en', $get('meta_title_en')) }}" class="form-control"></div>
            <div class="col-md-6"><label class="form-label small fw-semibold">Meta Title (AR)</label><input type="text" name="meta_title_ar" value="{{ old('meta_title_ar', $get('meta_title_ar')) }}" class="form-control" dir="rtl"></div>
            <div class="col-md-6"><label class="form-label small fw-semibold">Meta Description (EN)</label><textarea name="meta_description_en" rows="3" class="form-control">{{ old('meta_description_en', $get('meta_description_en')) }}</textarea></div>
            <div class="col-md-6"><label class="form-label small fw-semibold">Meta Description (AR)</label><textarea name="meta_description_ar" rows="3" class="form-control" dir="rtl">{{ old('meta_description_ar', $get('meta_description_ar')) }}</textarea></div>
            <div class="col-md-6"><label class="form-label small fw-semibold">Meta Keywords</label><input type="text" name="meta_keywords" value="{{ old('meta_keywords', $get('meta_keywords')) }}" class="form-control" placeholder="comma, separated, keywords"></div>
            <div class="col-md-6"><label class="form-label small fw-semibold">Google Analytics ID</label><input type="text" name="google_analytics" value="{{ old('google_analytics', $get('google_analytics')) }}" class="form-control" placeholder="G-XXXXXXX"></div>
            <div class="col-md-6"><label class="form-label small fw-semibold">Google Site Verification</label><input type="text" name="google_site_verification" value="{{ old('google_site_verification', $get('google_site_verification')) }}" class="form-control"></div>
        </div>
    </div>
    <button class="btn-admin">Save SEO Settings</button>
</form>
@endsection
