@extends('layouts.app')
@section('title', $page->title)
@section('meta_description', $page->meta_description_en)
@section('content')
@php $locale = app()->getLocale(); @endphp

@include('partials.page-banner', ['title' => $page->title, 'eyebrow' => __('site.about')])

<section class="section-pad">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-right">
                <img src="https://images.unsplash.com/photo-1560493676-04071c5f467b?q=80&w=900&auto=format&fit=crop" class="img-fluid rounded-agri shadow-agri" alt="About">
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <span class="section-eyebrow">{{ __('site.our_story') }}</span>
                <h2 class="mt-3 mb-4">{{ $page->title }}</h2>
                <div class="text-muted">{!! nl2br(e($page->content)) !!}</div>
            </div>
        </div>
    </div>
</section>

@if($statistics->count())
<section class="section-pad bg-agri-100">
    <div class="container">
        <div class="row g-4">
            @foreach($statistics as $stat)
                <div class="col-6 col-lg-3" data-aos="zoom-in" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="stat-item">
                        <i class="bi {{ $stat->icon ?: 'bi-graph-up' }} fs-1 mb-2 text-green"></i>
                        <div class="stat-number" data-count="{{ $stat->value }}" data-suffix="{{ $stat->suffix }}">0</div>
                        <div class="stat-label">{{ $stat->label }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<section class="section-pad">
    <div class="container">
        <div class="row g-4 text-center">
            @php
            $values = $locale === 'ar' ? [
                ['icon'=>'bi-bullseye','title'=>'رسالتنا','text'=>'تمكين المزارعين بحلول مبتكرة ومستدامة.'],
                ['icon'=>'bi-eye','title'=>'رؤيتنا','text'=>'أن نكون الشريك الزراعي الأول عالمياً.'],
                ['icon'=>'bi-gem','title'=>'قيمنا','text'=>'الجودة، الاستدامة، والابتكار المستمر.'],
            ] : [
                ['icon'=>'bi-bullseye','title'=>'Our Mission','text'=>'Empowering farmers with innovative, sustainable solutions.'],
                ['icon'=>'bi-eye','title'=>'Our Vision','text'=>'To be the leading agricultural partner worldwide.'],
                ['icon'=>'bi-gem','title'=>'Our Values','text'=>'Quality, sustainability, and continuous innovation.'],
            ];
            @endphp
            @foreach($values as $v)
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="card-agri p-4">
                        <div class="service-icon mx-auto"><i class="bi {{ $v['icon'] }}"></i></div>
                        <h4 class="h5">{{ $v['title'] }}</h4>
                        <p class="text-muted small">{{ $v['text'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

@if($testimonials->count())
<section class="section-pad bg-agri-100">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up"><h2>{{ __('site.testimonials') }}</h2></div>
        <div class="row g-4">
            @foreach($testimonials as $t)
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                    <div class="testimonial-card">
                        <p class="text-muted">{{ $t->message }}</p>
                        <div class="d-flex align-items-center gap-3 mt-3">
                            <img src="{{ $t->image ? asset('storage/'.$t->image) : 'https://ui-avatars.com/api/?background=1b6b39&color=fff&name=' . urlencode($t->name) }}" class="testimonial-avatar" alt="{{ $t->name }}">
                            <div><div class="fw-bold">{{ $t->name }}</div><small class="text-muted">{{ $t->position }}</small></div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection
