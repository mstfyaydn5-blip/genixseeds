@extends('layouts.app')
@section('title', $article->title)
@section('meta_description', $article->meta_description_en)
@section('content')
@php $locale = app()->getLocale(); @endphp
@include('partials.page-banner', ['title' => $article->title, 'eyebrow' => $article->category?->name ?? __('site.news')])

<section class="section-pad">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9" data-aos="fade-up">
                <img src="{{ $article->cover_image ? asset('storage/'.$article->cover_image) : 'https://images.unsplash.com/photo-1500382017468-9049fed747ef?q=80&w=1200&auto=format&fit=crop' }}" class="img-fluid rounded-agri shadow-agri mb-4" alt="{{ $article->title }}">
                <div class="d-flex gap-3 text-muted small mb-4">
                    <span><i class="bi bi-calendar3 me-1"></i>{{ $article->published_at?->translatedFormat('d M Y') }}</span>
                    <span><i class="bi bi-eye me-1"></i>{{ $article->views }}</span>
                    @if($article->author)<span><i class="bi bi-person me-1"></i>{{ $article->author->name }}</span>@endif
                </div>
                <div class="fs-5 text-muted">{!! nl2br(e($article->content)) !!}</div>

                @if($related->count())
                <div class="mt-5 pt-4">
                    <h4 class="mb-4">{{ $locale==='ar'?'مقالات ذات صلة':'Related Articles' }}</h4>
                    <div class="row g-4">
                        @foreach($related as $r)
                            <div class="col-md-4">
                                <div class="card-agri">
                                    <div class="card-img-wrap"><img src="{{ $r->cover_image ? asset('storage/'.$r->cover_image) : 'https://images.unsplash.com/photo-1500382017468-9049fed747ef?q=80&w=500&auto=format&fit=crop' }}" alt="{{ $r->title }}"></div>
                                    <div class="p-3"><h6 class="mb-1">{{ Str::limit($r->title, 40) }}</h6><a href="{{ route('news.show', [$locale, $r->slug]) }}" class="text-green small fw-semibold">{{ __('site.read_more') }}</a></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
