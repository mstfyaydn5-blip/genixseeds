@extends('layouts.app')
@section('title', __('site.services'))
@section('content')
@php $locale = app()->getLocale(); @endphp
@include('partials.page-banner', ['title' => __('site.services')])

<section class="section-pad">
    <div class="container">
        <div class="row g-4">
            @forelse($services as $service)
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->index % 3 * 60 }}">
                    <div class="card-agri p-4">
                        <div class="service-icon"><i class="bi {{ $service->icon ?: 'bi-flower1' }}"></i></div>
                        <h4 class="h5">{{ $service->title }}</h4>
                        <p class="text-muted small">{{ $service->short_description }}</p>
                        <a href="{{ route('services.show', [$locale, $service->slug]) }}" class="text-green fw-semibold">
                            {{ __('site.view_details') }} <i class="bi bi-arrow-{{ $locale==='ar'?'left':'right' }}"></i>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted py-5">{{ __('site.no_results') }}</div>
            @endforelse
        </div>
        <div class="mt-5">{{ $services->links() }}</div>
    </div>
</section>
@endsection
