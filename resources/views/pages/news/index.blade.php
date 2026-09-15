@extends('layouts.app')

@section('title', __('site.news'))

@section('content')
@php($locale = app()->getLocale())

@include('partials.page-banner', ['title' => __('site.news')])

<section class="section-pad">
    <div class="container">

        {{-- Search --}}
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8">
                <form method="GET" class="row g-2" data-aos="fade-up">
                    <div class="col">
                        <input
                            type="text"
                            name="q"
                            value="{{ request('q') }}"
                            class="form-control"
                            placeholder="{{ __('site.search') }}..."
                        >
                    </div>

                    <div class="col-auto">
                        <button class="btn-agri px-4">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="row g-5 align-items-start">

            {{-- Articles --}}
            <div class="col-lg-8">

                <div class="row g-4">

                    @forelse($articles as $article)

                        <div class="col-md-6 d-flex" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">

                            <article class="card-agri shadow-sm border-0 h-100 w-100 overflow-hidden">

                                <div class="card-img-wrap">

                                    <img
                                        src="{{ $article->cover_image ? asset('storage/'.$article->cover_image) : 'https://images.unsplash.com/photo-1500382017468-9049fed747ef?q=80&w=900&auto=format&fit=crop' }}"
                                        alt="{{ $article->title }}"
                                        class="img-fluid w-100"
                                        style="height:240px;object-fit:cover;"
                                    >

                                </div>

                                <div class="p-4 d-flex flex-column h-100">

                                    <small class="text-muted mb-2">

                                        <i class="bi bi-calendar3 me-1"></i>

                                        {{ optional($article->published_at)->translatedFormat('d M Y') }}

                                    </small>

                                    <h5 class="fw-bold mb-3">

                                        {{ $article->title }}

                                    </h5>

<p class="text-muted small mb-3">
    {{ Str::limit($article->excerpt, 100) }}
</p>

<a href="{{ route('news.show', [$locale, $article->slug]) }}"
   class="btn btn-agri">
    {{ __('site.read_more') }}
    <i class="bi bi-arrow-right ms-2"></i>
</a>

                                </div>

                            </article>

                        </div>

                    @empty

                        <div class="col-12">

                            <div class="text-center py-5">

                                <h5 class="text-muted">

                                    {{ __('site.no_results') }}

                                </h5>

                            </div>

                        </div>

                    @endforelse

                </div>

                @if($articles->hasPages())

                    <div class="mt-5 d-flex justify-content-center">

                        {{ $articles->links() }}

                    </div>

                @endif

            </div>

            {{-- Sidebar --}}
            <div class="col-lg-4">

                <div class="position-sticky" style="top:110px;">

                    {{-- Categories --}}
                    <div class="card-agri shadow-sm border-0 p-4 mb-4">

                        <h5 class="fw-bold mb-4">

                            {{ __('site.all_categories') }}

                        </h5>

                        @foreach($categories as $cat)

                            <a
                                href="{{ route('news.index', array_merge([$locale],['category'=>$cat->slug])) }}"
                                class="d-flex justify-content-between align-items-center py-3 border-bottom text-decoration-none"
                            >

                                <span class="text-dark fw-medium">

                                    {{ $cat->name }}

                                </span>

                                <i class="bi bi-chevron-right text-green"></i>

                            </a>

                        @endforeach

                    </div>

                    {{-- Latest --}}
                    <div class="card-agri shadow-sm border-0 p-4">

                        <h5 class="fw-bold mb-4">

                            {{ __('site.latest_news') }}

                        </h5>

                        @foreach($latest as $item)

                            <a
                                href="{{ route('news.show',[$locale,$item->slug]) }}"
                                class="d-flex align-items-center gap-3 text-decoration-none py-3 border-bottom"
                            >

                                <img
                                    src="{{ $item->cover_image ? asset('storage/'.$item->cover_image) : 'https://images.unsplash.com/photo-1500382017468-9049fed747ef?q=80&w=300&auto=format&fit=crop' }}"
                                    width="78"
                                    height="78"
                                    class="rounded"
                                    style="object-fit:cover;"
                                >

                                <div>

                                    <div class="fw-semibold text-dark small mb-1">

                                        {{ Str::limit($item->title,55) }}

                                    </div>

                                    <small class="text-muted">

                                        {{ optional($item->published_at)->translatedFormat('d M Y') }}

                                    </small>

                                </div>

                            </a>

                        @endforeach

                    </div>

                </div>

            </div>

        </div>

    </div>
</section>

@endsection