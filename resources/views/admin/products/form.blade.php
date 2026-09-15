@extends('layouts.admin')
@section('title', $product->exists ? 'Edit Product' : 'Add Product')
@section('page-title', $product->exists ? 'Edit Product' : 'Add Product')
@section('content')

<form method="POST" action="{{ $product->exists ? route('admin.products.update', $product) : route('admin.products.store') }}" enctype="multipart/form-data">
    @csrf
    @if($product->exists) @method('PUT') @endif

    <div class="row g-3">
        <div class="col-lg-8">
            <div class="card-form mb-3">
                <ul class="nav nav-tabs mb-3">
                    <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#en" type="button">English</button></li>
                    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#ar" type="button">العربية</button></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="en">
                        <div class="mb-3"><label class="form-label fw-semibold">Name (EN)</label><input type="text" name="name_en" value="{{ old('name_en', $product->name_en) }}" class="form-control" required></div>
                        <div class="mb-3"><label class="form-label fw-semibold">Short Description (EN)</label><textarea name="short_description_en" rows="2" class="form-control">{{ old('short_description_en', $product->short_description_en) }}</textarea></div>
                        <div class="mb-3"><label class="form-label fw-semibold">Description (EN)</label><textarea name="description_en" rows="5" class="form-control">{{ old('description_en', $product->description_en) }}</textarea></div>
                    </div>
                    <div class="tab-pane fade" id="ar">
                        <div class="mb-3"><label class="form-label fw-semibold">الاسم (AR)</label><input type="text" name="name_ar" value="{{ old('name_ar', $product->name_ar) }}" class="form-control" dir="rtl" required></div>
                        <div class="mb-3"><label class="form-label fw-semibold">وصف مختصر (AR)</label><textarea name="short_description_ar" rows="2" class="form-control" dir="rtl">{{ old('short_description_ar', $product->short_description_ar) }}</textarea></div>
                        <div class="mb-3"><label class="form-label fw-semibold">الوصف (AR)</label><textarea name="description_ar" rows="5" class="form-control" dir="rtl">{{ old('description_ar', $product->description_ar) }}</textarea></div>
                    </div>
                </div>
            </div>
            <div class="card-form">
                <h6 class="fw-bold mb-3">Specifications</h6>
                @php $specs = $product->specifications ?? []; @endphp
                <div id="specWrap">
                    @forelse($specs as $key => $val)
                        <div class="row g-2 mb-2">
                            <div class="col-5"><input type="text" name="spec_keys[]" value="{{ $key }}" class="form-control" placeholder="Attribute"></div>
                            <div class="col-6"><input type="text" name="spec_values[]" value="{{ $val }}" class="form-control" placeholder="Value"></div>
                            <div class="col-1"><button type="button" class="btn btn-outline-danger" onclick="this.closest('.row').remove()"><i class="bi bi-x"></i></button></div>
                        </div>
                    @empty
                        <div class="row g-2 mb-2">
                            <div class="col-5"><input type="text" name="spec_keys[]" class="form-control" placeholder="Attribute"></div>
                            <div class="col-6"><input type="text" name="spec_values[]" class="form-control" placeholder="Value"></div>
                            <div class="col-1"><button type="button" class="btn btn-outline-danger" onclick="this.closest('.row').remove()"><i class="bi bi-x"></i></button></div>
                        </div>
                    @endforelse
                </div>
                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="document.getElementById('specWrap').insertAdjacentHTML('beforeend', '<div class=\'row g-2 mb-2\'><div class=\'col-5\'><input type=\'text\' name=\'spec_keys[]\' class=\'form-control\' placeholder=\'Attribute\'></div><div class=\'col-6\'><input type=\'text\' name=\'spec_values[]\' class=\'form-control\' placeholder=\'Value\'></div><div class=\'col-1\'><button type=\'button\' class=\'btn btn-outline-danger\' onclick=\'this.closest(&quot;.row&quot;).remove()\'><i class=\'bi bi-x\'></i></button></div></div>')">+ Add Spec</button>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card-form mb-3">
                <div class="mb-3"><label class="form-label fw-semibold">Category</label>
                    <select name="product_category_id" class="form-select">
                        <option value="">-- None --</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" @selected(old('product_category_id', $product->product_category_id) == $cat->id)>{{ $cat->name_en }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3"><label class="form-label fw-semibold">Slug</label><input type="text" name="slug" value="{{ old('slug', $product->slug) }}" class="form-control" placeholder="auto"></div>
                <div class="row g-2">
                    <div class="col-6"><label class="form-label fw-semibold">Price</label><input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}" class="form-control"></div>
                    <div class="col-6"><label class="form-label fw-semibold">Order</label><input type="number" name="order" value="{{ old('order', $product->order) }}" class="form-control"></div>
                </div>
                <div class="row g-2 mt-1">
                    <div class="col-6"><label class="form-label fw-semibold small">Unit (EN)</label><input type="text" name="unit_en" value="{{ old('unit_en', $product->unit_en) }}" class="form-control"></div>
                    <div class="col-6"><label class="form-label fw-semibold small">Unit (AR)</label><input type="text" name="unit_ar" value="{{ old('unit_ar', $product->unit_ar) }}" class="form-control" dir="rtl"></div>
                </div>
                <div class="form-check form-switch mt-3"><input class="form-check-input" type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $product->is_featured))><label class="form-check-label">Featured</label></div>
                <div class="form-check form-switch"><input class="form-check-input" type="checkbox" name="is_active" value="1" @checked(old('is_active', $product->is_active ?? true))><label class="form-check-label">Active</label></div>
            </div>
            <div class="card-form mb-3">
                <label class="form-label fw-semibold">Main Image</label>
                <input type="file" name="image" class="form-control" data-preview="imgPreview">
                <img id="imgPreview" src="{{ $product->image ? asset('storage/'.$product->image) : '' }}" class="img-fluid rounded mt-2 {{ $product->image ? '' : 'd-none' }}" alt="">
                <label class="form-label fw-semibold mt-3">Gallery Images</label>
                <input type="file" name="gallery[]" class="form-control" multiple>
            </div>
            <button class="btn-admin w-100">Save Product</button>
        </div>
    </div>
</form>
@endsection
