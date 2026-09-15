@extends('layouts.app')
@section('title', __('site.contact'))
@section('content')
@php
$locale = app()->getLocale();
$phone = \App\Models\Setting::get('phone');
$email = \App\Models\Setting::get('email');
$address = \App\Models\Setting::get('address_' . $locale);
@endphp
@include('partials.page-banner', ['title' => __('site.contact')])

<section class="section-pad">
    <div class="container">
        @include('partials.alerts')
        <div class="row g-4 mb-5">
            <div class="col-md-4" data-aos="fade-up">
                <div class="card-agri p-4 text-center h-100">
                    <div class="service-icon mx-auto"><i class="bi bi-geo-alt"></i></div>
                    <h5 class="h6">{{ $locale==='ar'?'العنوان':'Address' }}</h5>
                    <p class="text-muted small mb-0">{{ $address }}</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card-agri p-4 text-center h-100">
                    <div class="service-icon mx-auto"><i class="bi bi-telephone"></i></div>
                    <h5 class="h6">{{ __('site.phone') }}</h5>
                    <p class="text-muted small mb-0">{{ $phone }}</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card-agri p-4 text-center h-100">
                    <div class="service-icon mx-auto"><i class="bi bi-envelope"></i></div>
                    <h5 class="h6">{{ __('site.email') }}</h5>
                    <p class="text-muted small mb-0">{{ $email }}</p>
                </div>
            </div>
        </div>

        <div class="row g-5 align-items-center">
            <div class="col-lg-6" data-aos="fade-right">
<iframe
    src="https://www.openstreetmap.org/export/embed.html?bbox=-74.15%2C40.68%2C-73.85%2C40.85&layer=mapnik"
    class="w-100 rounded-agri shadow-agri"
    style="height:420px;border:0;"
    loading="lazy">
</iframe>            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <span class="section-eyebrow">{{ __('site.contact') }}</span>
                <h2 class="mt-3 mb-4">{{ __('site.send_message') }}</h2>
                <form method="POST" action="{{ route('contact.store', $locale) }}">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6"><input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="{{ __('site.full_name') }}" required></div>
                        <div class="col-md-6"><input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="{{ __('site.email') }}" required></div>
                        <div class="col-md-6"><input type="text" name="phone" value="{{ old('phone') }}" class="form-control" placeholder="{{ __('site.phone') }}"></div>
                        <div class="col-md-6"><input type="text" name="subject" value="{{ old('subject') }}" class="form-control" placeholder="{{ __('site.subject') }}"></div>
                        <div class="col-12"><textarea name="message" rows="5" class="form-control" placeholder="{{ __('site.message') }}" required>{{ old('message') }}</textarea></div>
                        <div class="col-12"><button class="btn-agri">{{ __('site.send_message') }} <i class="bi bi-send"></i></button></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
