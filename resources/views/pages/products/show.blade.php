@extends('layouts.app')
@section('title', $product->name)
@section('meta_description', $product->meta_description_en)
@section('content')
@php $locale = app()->getLocale(); @endphp
@include('partials.page-banner', ['title' => $product->name, 'eyebrow' => __('site.products')])

<section class="section-pad">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-6" data-aos="fade-right">
                <img src="{{ $product->image ? asset('storage/'.$product->image) : 'https://images.unsplash.com/photo-1574943320219-553eb213f72d?q=80&w=900&auto=format&fit=crop' }}" class="img-fluid rounded-agri shadow-agri" alt="{{ $product->name }}">
                @if(!empty($product->gallery))
                    <div class="row g-2 mt-2">
                        @foreach($product->gallery as $img)
                            <div class="col-3"><img src="{{ asset('storage/'.$img) }}" class="img-fluid rounded-agri" alt=""></div>
                        @endforeach
                    </div>
                @endif
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                @if($product->category)<span class="badge-agri mb-2">{{ $product->category->name }}</span>@endif
                <h2 class="mb-3">{{ $product->name }}</h2>
                <p class="text-muted fs-5">{{ $product->short_description }}</p>
                @if($product->price)<div class="h3 text-green mb-3">${{ number_format($product->price, 2) }} @if($product->unit)<small class="text-muted fs-6">/ {{ $product->unit }}</small>@endif</div>@endif
                <div class="text-muted mb-4">{!! nl2br(e($product->description)) !!}</div>
                @if(!empty($product->specifications))
                    <table class="table table-borderless">
                        @foreach($product->specifications as $key => $val)
                            <tr><td class="fw-semibold" style="width:40%">{{ $key }}</td><td class="text-muted">{{ $val }}</td></tr>
                        @endforeach
                    </table>
                @endif
                <a href="{{ route('contact.index', $locale) }}" class="btn-agri">{{ __('site.get_in_touch') }} <i class="bi bi-arrow-{{ $locale==='ar'?'left':'right' }}"></i></a>
            </div>
        </div>

        @if($related->count())
        <div class="mt-5 pt-5">
            <h3 class="mb-4">{{ __('site.related_products') }}</h3>
            <div class="row g-4">
                @foreach($related as $r)
                    <div class="col-sm-6 col-lg-3">
                        <div class="card-agri">
                            <div class="card-img-wrap"><img src="{{ $r->image ? asset('storage/'.$r->image) : 'https://images.unsplash.com/photo-1574943320219-553eb213f72d?q=80&w=500&auto=format&fit=crop' }}" alt="{{ $r->name }}"></div>
                            <div class="p-3">
                                <h6 class="mb-1">{{ $r->name }}</h6>
                                <a href="{{ route('products.show', [$locale, $r->slug]) }}" class="text-green small fw-semibold">{{ __('site.view_details') }}</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>
@endsection
