@extends('layouts.admin')
@section('title', $page->exists ? 'Edit Page' : 'Add Page')
@section('page-title', $page->exists ? 'Edit Page' : 'Add Page')
@section('content')
<form method="POST" action="{{ $page->exists ? route('admin.pages.update', $page) : route('admin.pages.store') }}" enctype="multipart/form-data">
    @csrf
    @if($page->exists) @method('PUT') @endif
    <div class="row g-3">
        <div class="col-lg-8">
            <div class="card-form mb-3">
                <ul class="nav nav-tabs mb-3">
                    <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#en" type="button">English</button></li>
                    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#ar" type="button">العربية</button></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="en">
                        <div class="mb-3"><label class="form-label fw-semibold">Title (EN)</label><input type="text" name="title_en" value="{{ old('title_en', $page->title_en) }}" class="form-control" required></div>
                        <div class="mb-3"><label class="form-label fw-semibold">Content (EN)</label><textarea name="content_en" rows="10" class="form-control">{{ old('content_en', $page->content_en) }}</textarea></div>
                    </div>
                    <div class="tab-pane fade" id="ar">
                        <div class="mb-3"><label class="form-label fw-semibold">العنوان (AR)</label><input type="text" name="title_ar" value="{{ old('title_ar', $page->title_ar) }}" class="form-control" dir="rtl" required></div>
                        <div class="mb-3"><label class="form-label fw-semibold">المحتوى (AR)</label><textarea name="content_ar" rows="10" class="form-control" dir="rtl">{{ old('content_ar', $page->content_ar) }}</textarea></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card-form mb-3">
                <div class="mb-3"><label class="form-label fw-semibold">Slug</label><input type="text" name="slug" value="{{ old('slug', $page->slug) }}" class="form-control" required></div>
                <div class="mb-3"><label class="form-label fw-semibold">Meta Title (EN)</label><input type="text" name="meta_title_en" value="{{ old('meta_title_en', $page->meta_title_en) }}" class="form-control"></div>
                <div class="mb-3"><label class="form-label fw-semibold">Meta Description (EN)</label><textarea name="meta_description_en" rows="2" class="form-control">{{ old('meta_description_en', $page->meta_description_en) }}</textarea></div>
                <div class="form-check form-switch"><input class="form-check-input" type="checkbox" name="is_active" value="1" @checked(old('is_active', $page->is_active ?? true))><label class="form-check-label">Active</label></div>
            </div>
            <div class="card-form mb-3">
                <label class="form-label fw-semibold">Banner Image</label>
                <input type="file" name="banner_image" class="form-control" data-preview="imgPreview">
                <img id="imgPreview" src="{{ $page->banner_image ? asset('storage/'.$page->banner_image) : '' }}" class="img-fluid rounded mt-2 {{ $page->banner_image ? '' : 'd-none' }}" alt="">
            </div>
            <button class="btn-admin w-100">Save Page</button>
        </div>
    </div>
</form>
@endsection
