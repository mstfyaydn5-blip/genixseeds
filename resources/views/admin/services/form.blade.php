@extends('layouts.admin')
@section('title', $service->exists ? 'Edit Service' : 'Add Service')
@section('page-title', $service->exists ? 'Edit Service' : 'Add Service')
@section('content')

<form method="POST" action="{{ $service->exists ? route('admin.services.update', $service) : route('admin.services.store') }}" enctype="multipart/form-data">
    @csrf
    @if($service->exists) @method('PUT') @endif

    <div class="row g-3">
        <div class="col-lg-8">
            <div class="card-form mb-3">
                <ul class="nav nav-tabs mb-3">
                    <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#en" type="button">English</button></li>
                    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#ar" type="button">العربية</button></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="en">
                        <div class="mb-3"><label class="form-label fw-semibold">Title (EN)</label><input type="text" name="title_en" value="{{ old('title_en', $service->title_en) }}" class="form-control" required></div>
                        <div class="mb-3"><label class="form-label fw-semibold">Short Description (EN)</label><textarea name="short_description_en" rows="2" class="form-control">{{ old('short_description_en', $service->short_description_en) }}</textarea></div>
                        <div class="mb-3"><label class="form-label fw-semibold">Description (EN)</label><textarea name="description_en" rows="6" class="form-control">{{ old('description_en', $service->description_en) }}</textarea></div>
                        <div class="mb-3"><label class="form-label fw-semibold">Meta Title (EN)</label><input type="text" name="meta_title_en" value="{{ old('meta_title_en', $service->meta_title_en) }}" class="form-control"></div>
                        <div class="mb-3"><label class="form-label fw-semibold">Meta Description (EN)</label><textarea name="meta_description_en" rows="2" class="form-control">{{ old('meta_description_en', $service->meta_description_en) }}</textarea></div>
                    </div>
                    <div class="tab-pane fade" id="ar">
                        <div class="mb-3"><label class="form-label fw-semibold">العنوان (AR)</label><input type="text" name="title_ar" value="{{ old('title_ar', $service->title_ar) }}" class="form-control" dir="rtl" required></div>
                        <div class="mb-3"><label class="form-label fw-semibold">وصف مختصر (AR)</label><textarea name="short_description_ar" rows="2" class="form-control" dir="rtl">{{ old('short_description_ar', $service->short_description_ar) }}</textarea></div>
                        <div class="mb-3"><label class="form-label fw-semibold">الوصف (AR)</label><textarea name="description_ar" rows="6" class="form-control" dir="rtl">{{ old('description_ar', $service->description_ar) }}</textarea></div>
                        <div class="mb-3"><label class="form-label fw-semibold">عنوان السيو (AR)</label><input type="text" name="meta_title_ar" value="{{ old('meta_title_ar', $service->meta_title_ar) }}" class="form-control" dir="rtl"></div>
                        <div class="mb-3"><label class="form-label fw-semibold">وصف السيو (AR)</label><textarea name="meta_description_ar" rows="2" class="form-control" dir="rtl">{{ old('meta_description_ar', $service->meta_description_ar) }}</textarea></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card-form mb-3">
                <div class="mb-3"><label class="form-label fw-semibold">Slug</label><input type="text" name="slug" value="{{ old('slug', $service->slug) }}" class="form-control" placeholder="auto-generated if empty"></div>
                <div class="mb-3"><label class="form-label fw-semibold">Icon (Bootstrap Icon class)</label><input type="text" name="icon" value="{{ old('icon', $service->icon) }}" class="form-control" placeholder="bi-flower1"></div>
                <div class="mb-3"><label class="form-label fw-semibold">Order</label><input type="number" name="order" value="{{ old('order', $service->order) }}" class="form-control"></div>
                <div class="form-check form-switch mb-2"><input class="form-check-input" type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $service->is_featured))><label class="form-check-label">Featured</label></div>
                <div class="form-check form-switch mb-2"><input class="form-check-input" type="checkbox" name="is_active" value="1" @checked(old('is_active', $service->is_active ?? true))><label class="form-check-label">Active</label></div>
            </div>
            <div class="card-form mb-3">
                <label class="form-label fw-semibold">Image</label>
                <input type="file" name="image" class="form-control" data-preview="imgPreview">
                <img id="imgPreview" src="{{ $service->image ? asset('storage/'.$service->image) : '' }}" class="img-fluid rounded mt-2 {{ $service->image ? '' : 'd-none' }}" alt="">
            </div>
            <button class="btn-admin w-100">Save Service</button>
        </div>
    </div>
</form>
@endsection
