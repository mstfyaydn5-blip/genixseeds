@extends('layouts.app')
@section('title', $service->title)
@section('meta_description', $service->meta_description_en)
@section('content')
@php $locale = app()->getLocale(); @endphp
@include('partials.page-banner', ['title' => $service->title, 'eyebrow' => __('site.services')])

<section class="section-pad">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-8" data-aos="fade-up">
                <img src="{{ $service->image ? asset('storage/'.$service->image) : 'https://images.unsplash.com/photo-1625246333195-78d9c38ad449?q=80&w=1200&auto=format&fit=crop' }}" class="img-fluid rounded-agri shadow-agri mb-4" alt="{{ $service->title }}">
                <h2 class="mb-3">{{ $service->title }}</h2>
                <div class="text-muted fs-5">{!! nl2br(e($service->description)) !!}</div>
            </div>
            <div class="col-lg-4">
                <div class="card-agri p-4" data-aos="fade-left">
                    <h5 class="mb-3">{{ __('site.related_services') }}</h5>
                    @foreach($related as $r)
                        <a href="{{ route('services.show', [$locale, $r->slug]) }}" class="d-flex align-items-center gap-3 mb-3 text-decoration-none">
                            <div class="service-icon" style="width:48px;height:48px;margin:0;"><i class="bi {{ $r->icon ?: 'bi-flower1' }}"></i></div>
                            <span class="text-dark fw-semibold small">{{ $r->title }}</span>
                        </a>
                    @endforeach
                    <a href="{{ route('contact.index', $locale) }}" class="btn-agri w-100 justify-content-center mt-2">{{ __('site.get_in_touch') }}</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
