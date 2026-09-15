@extends('layouts.admin')
@section('title', $article->exists ? 'Edit Article' : 'Add Article')
@section('page-title', $article->exists ? 'Edit Article' : 'Add Article')
@section('content')
<form method="POST" action="{{ $article->exists ? route('admin.news.update', $article) : route('admin.news.store') }}" enctype="multipart/form-data">
    @csrf
    @if($article->exists) @method('PUT') @endif
    <div class="row g-3">
        <div class="col-lg-8">
            <div class="card-form mb-3">
                <ul class="nav nav-tabs mb-3">
                    <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#en" type="button">English</button></li>
                    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#ar" type="button">العربية</button></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="en">
                        <div class="mb-3"><label class="form-label fw-semibold">Title (EN)</label><input type="text" name="title_en" value="{{ old('title_en', $article->title_en) }}" class="form-control" required></div>
                        <div class="mb-3"><label class="form-label fw-semibold">Excerpt (EN)</label><textarea name="excerpt_en" rows="2" class="form-control">{{ old('excerpt_en', $article->excerpt_en) }}</textarea></div>
                        <div class="mb-3"><label class="form-label fw-semibold">Content (EN)</label><textarea name="content_en" rows="8" class="form-control" required>{{ old('content_en', $article->content_en) }}</textarea></div>
                    </div>
                    <div class="tab-pane fade" id="ar">
                        <div class="mb-3"><label class="form-label fw-semibold">العنوان (AR)</label><input type="text" name="title_ar" value="{{ old('title_ar', $article->title_ar) }}" class="form-control" dir="rtl" required></div>
                        <div class="mb-3"><label class="form-label fw-semibold">مقتطف (AR)</label><textarea name="excerpt_ar" rows="2" class="form-control" dir="rtl">{{ old('excerpt_ar', $article->excerpt_ar) }}</textarea></div>
                        <div class="mb-3"><label class="form-label fw-semibold">المحتوى (AR)</label><textarea name="content_ar" rows="8" class="form-control" dir="rtl" required>{{ old('content_ar', $article->content_ar) }}</textarea></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card-form mb-3">
                <div class="mb-3"><label class="form-label fw-semibold">Category</label>
                    <select name="news_category_id" class="form-select">
                        <option value="">-- None --</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" @selected(old('news_category_id', $article->news_category_id) == $cat->id)>{{ $cat->name_en }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3"><label class="form-label fw-semibold">Slug</label><input type="text" name="slug" value="{{ old('slug', $article->slug) }}" class="form-control" placeholder="auto"></div>
                <div class="mb-3"><label class="form-label fw-semibold">Tags (comma separated)</label><input type="text" name="tags" value="{{ old('tags', $article->tags) }}" class="form-control"></div>
                <div class="mb-3"><label class="form-label fw-semibold">Publish Date</label><input type="datetime-local" name="published_at" value="{{ old('published_at', $article->published_at?->format('Y-m-d\TH:i')) }}" class="form-control"></div>
                <div class="form-check form-switch"><input class="form-check-input" type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $article->is_featured))><label class="form-check-label">Featured</label></div>
                <div class="form-check form-switch"><input class="form-check-input" type="checkbox" name="is_published" value="1" @checked(old('is_published', $article->is_published ?? true))><label class="form-check-label">Published</label></div>
            </div>
            <div class="card-form mb-3">
                <label class="form-label fw-semibold">Cover Image</label>
                <input type="file" name="cover_image" class="form-control" data-preview="imgPreview">
                <img id="imgPreview" src="{{ $article->cover_image ? asset('storage/'.$article->cover_image) : '' }}" class="img-fluid rounded mt-2 {{ $article->cover_image ? '' : 'd-none' }}" alt="">
            </div>
            <button class="btn-admin w-100">Save Article</button>
        </div>
    </div>
</form>
@endsection
