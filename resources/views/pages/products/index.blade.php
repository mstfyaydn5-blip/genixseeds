@extends('layouts.app')
@section('title', __('site.products'))
@section('content')
@php $locale = app()->getLocale(); @endphp
@include('partials.page-banner', ['title' => __('site.products')])

<section class="section-pad">
    <div class="container">
        <div class="row mb-4" data-aos="fade-up">
            <div class="col-lg-8 mx-auto">
                <form class="d-flex gap-2" method="GET">
                    <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="{{ __('site.search') }}...">
                    <select name="category" class="form-select" style="max-width:220px;">
                        <option value="">{{ __('site.all_categories') }}</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->slug }}" @selected(request('category') === $cat->slug)>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                    <button class="btn-agri"><i class="bi bi-search"></i></button>
                </form>
            </div>
        </div>
        <div class="row g-4">
            @forelse($products as $product)
                <div class="col-sm-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->index % 3 * 60 }}">
                    <div class="card-agri">
                        <div class="card-img-wrap">
                            <img src="{{ $product->image ? asset('storage/'.$product->image) : 'https://images.unsplash.com/photo-1574943320219-553eb213f72d?q=80&w=500&auto=format&fit=crop' }}" alt="{{ $product->name }}">
                        </div>
                        <div class="p-3">
                            @if($product->category)<span class="badge-agri small">{{ $product->category->name }}</span>@endif
                            <h5 class="h6 mt-2 mb-1">{{ $product->name }}</h5>
                            <p class="text-muted small">{{ Str::limit($product->short_description, 70) }}</p>
                            <a href="{{ route('products.show', [$locale, $product->slug]) }}" class="text-green small fw-semibold">{{ __('site.view_details') }}</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted py-5">{{ __('site.no_results') }}</div>
            @endforelse
        </div>
        <div class="mt-5">{{ $products->links() }}</div>
    </div>
</section>
@endsection
