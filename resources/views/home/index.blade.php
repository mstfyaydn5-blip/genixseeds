@extends('layouts.app')

@section('title', \App\Models\Setting::get('site_name_' . app()->getLocale()))

@section('content')
@php $locale = app()->getLocale(); @endphp

{{-- HERO --}}
<section class="hero">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <span class="eyebrow" data-aos="fade-up">{{ __('site.company_intro_title') }}</span>
                <h1 class="my-4" data-aos="fade-up" data-aos-delay="100">
                    {{ $locale === 'ar' ? 'بذور خضروات عالية الجودة لمزارعي العالم' : 'High Quality Vegetable Seeds For Growers Worldwide' }}
                </h1>
                <p class="lead" data-aos="fade-up" data-aos-delay="200">
                    {{ $locale === 'ar'
                        ? 'البذور الزراعية عالية الجودة هي نتاج مزيج فريد من ظروف مناخية زراعية جيدة، وتربة خصبة، ومزارعين ذوي خبرة، وفنيين ميدانيين، ومصنع بذور بأحدث التقنيات للحفاظ على جودة البذور أثناء المعالجة. وهذا بالضبط ما تقدمه لكم جينكس سيدز.'
                        : 'High quality agricultural seeds are the outcome of a unique combination of good agro-climatic conditions, good soils, experienced growers, field technicians and a state-of-the-art seed plant to preserve seed quality during processing. This is what Genix Seeds can offer you.' }}
                </p>
                <div class="d-flex flex-wrap gap-3 mt-4" data-aos="fade-up" data-aos-delay="300">
                    <a href="{{ route('services.index', $locale) }}" class="btn-agri">{{ __('site.services') }} <i class="bi bi-arrow-{{ $locale==='ar'?'left':'right' }}"></i></a>
                    <a href="{{ route('contact.index', $locale) }}" class="btn-agri-outline" style="border-color:#fff;color:#fff;">{{ __('site.get_in_touch') }}</a>
                </div>
            </div>
        </div>
    </div>
    <div class="hero-scroll"><i class="bi bi-chevron-double-down fs-4"></i></div>
</section>

{{-- COMPANY INTRO --}}
<section class="section-pad">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="position-relative">
                    <img src="https://images.unsplash.com/photo-1625246333195-78d9c38ad449?q=80&w=900&auto=format&fit=crop" class="img-fluid rounded-agri shadow-agri" alt="Farm">
                    <div class="position-absolute bottom-0 start-0 translate-middle-y ms-4 bg-white rounded-agri shadow-agri p-3 d-none d-md-block" style="max-width:220px;">
                        <div class="d-flex align-items-center gap-2">
                            <div class="service-icon" style="width:50px;height:50px;margin:0;"><i class="bi bi-award"></i></div>
                            <div>
                                <div class="fw-bold text-green">6+ {{ $locale==='ar'?'سنوات':'Years' }}</div>
                                <small class="text-muted">{{ $locale==='ar'?'من الخبرة الزراعية':'of agri expertise' }}</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <span class="section-eyebrow">{{ __('site.our_story') }}</span>
                <h2 class="mt-3 mb-4">{{ __('site.company_intro_title') }}</h2>
                <p class="text-muted mb-4">
                    {{ $locale === 'ar'
                        ? 'جينكس سيدز مؤسسة سريعة التطور رغم حداثة تأسيسها، إذ برزت كمنظمة رائدة من خلال خبرة ومعرفة فريق الإدارة والمهندسين الزراعيين والفنيين والمربّين وفرق التسويق. يمتلك فريقنا ككل خبرة لا تقل عن 6 سنوات في تطوير البذور وتقييمها وتوزيعها.'
                        : "Genix Seeds is a fast-progressing establishment despite being recently founded — emerging as a leading organization through the expertise of our management, agronomists, technicians, breeders and marketing teams. Our team as a whole has a minimum of 6 years' experience in seed development, evaluation and distribution." }}
                </p>
                <div class="row g-3 mb-4">
                    @foreach([
                        $locale==='ar' ? 'ممارسات زراعية مستدامة' : 'Sustainable farming practices',
                        $locale==='ar' ? 'تقنيات زراعية متطورة' : 'Advanced agri-technology',
                        $locale==='ar' ? 'فريق خبراء متخصص' : 'Expert specialist team',
                    ] as $point)
                        <div class="col-12"><i class="bi bi-check-circle-fill text-green me-2"></i>{{ $point }}</div>
                    @endforeach
                </div>
                <a href="{{ route('about', $locale) }}" class="btn-agri">{{ __('site.read_more') }} <i class="bi bi-arrow-{{ $locale==='ar'?'left':'right' }}"></i></a>
            </div>
        </div>
    </div>
</section>

{{-- FEATURED SERVICES --}}
<section class="section-pad bg-agri-100">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="section-eyebrow justify-content-center">{{ __('site.services') }}</span>
            <h2 class="mt-3">{{ __('site.featured_services') }}</h2>
        </div>
        <div class="row g-4">
            @foreach($services as $service)
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                    <div class="card-agri p-4">
                        <div class="service-icon"><i class="bi {{ $service->icon ?: 'bi-flower1' }}"></i></div>
                        <h4 class="h5">{{ $service->title }}</h4>
                        <p class="text-muted small">{{ $service->short_description }}</p>
                        <a href="{{ route('services.show', [$locale, $service->slug]) }}" class="text-green fw-semibold">
                            {{ __('site.view_details') }} <i class="bi bi-arrow-{{ $locale==='ar'?'left':'right' }}"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="text-center mt-5">
            <a href="{{ route('services.index', $locale) }}" class="btn-agri-outline">{{ __('site.view_all') }}</a>
        </div>
    </div>
</section>

{{-- FEATURED PRODUCTS --}}
<section class="section-pad">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="section-eyebrow justify-content-center">{{ __('site.products') }}</span>
            <h2 class="mt-3">{{ __('site.featured_products') }}</h2>
        </div>
        <div class="row g-4">
            @foreach($products as $product)
                <div class="col-sm-6 col-lg-3" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                    <div class="card-agri">
                        <div class="card-img-wrap">
                            <img src="{{ $product->image ? asset('storage/'.$product->image) : 'https://images.unsplash.com/photo-1574943320219-553eb213f72d?q=80&w=500&auto=format&fit=crop' }}" alt="{{ $product->name }}">
                        </div>
                        <div class="p-3">
                            @if($product->category)
                                <span class="badge-agri small">{{ $product->category->name }}</span>
                            @endif
                            <h5 class="h6 mt-2 mb-1">{{ $product->name }}</h5>
                            <a href="{{ route('products.show', [$locale, $product->slug]) }}" class="text-green small fw-semibold">
                                {{ __('site.view_details') }}
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="text-center mt-5">
            <a href="{{ route('products.index', $locale) }}" class="btn-agri-outline">{{ __('site.view_all') }}</a>
        </div>
    </div>
</section>

{{-- STATS --}}
<section class="section-pad" style="background: linear-gradient(120deg, var(--agri-green-900), var(--agri-green-700));">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="section-eyebrow justify-content-center" style="color:#fff;">{{ __('site.company_stats') }}</span>
            <h2 class="mt-3" style="color:#fff;">{{ $locale==='ar'?'أرقام تتحدث عن نجاحنا':'Numbers That Speak For Themselves' }}</h2>
        </div>
        <div class="row g-4">
            @foreach($statistics as $stat)
                <div class="col-6 col-lg-3" data-aos="zoom-in" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="stat-item">
                        <i class="bi {{ $stat->icon ?: 'bi-graph-up' }} fs-1 mb-2" style="color:#d4a72c;"></i>
                        <div class="stat-number" style="color:#fff;" data-count="{{ $stat->value }}" data-suffix="{{ $stat->suffix }}">0</div>
                        <div class="stat-label" style="color:rgba(255,255,255,.75);">{{ $stat->label }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- WHY CHOOSE US --}}
<section class="section-pad">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-right">
                <span class="section-eyebrow">{{ __('site.why_choose_us') }}</span>
                <h2 class="mt-3 mb-4">{{ $locale==='ar'?'شريكك الموثوق لنجاح مزرعتك':'Your Trusted Partner In Farming Success' }}</h2>
                @php
                $reasons = $locale === 'ar' ? [
                    ['icon'=>'bi-people','title'=>'فريق خبراء','text'=>'مهندسون زراعيون ذوو خبرة عالية في كافة المجالات.'],
                    ['icon'=>'bi-recycle','title'=>'استدامة حقيقية','text'=>'حلول صديقة للبيئة تحافظ على الموارد الطبيعية.'],
                    ['icon'=>'bi-cpu','title'=>'تقنية متطورة','text'=>'استخدام أحدث تقنيات الزراعة الدقيقة والذكية.'],
                ] : [
                    ['icon'=>'bi-people','title'=>'Expert Team','text'=>'Seasoned agronomists and engineers across every discipline.'],
                    ['icon'=>'bi-recycle','title'=>'True Sustainability','text'=>'Eco-friendly solutions that protect natural resources.'],
                    ['icon'=>'bi-cpu','title'=>'Advanced Technology','text'=>'Cutting-edge precision and smart farming techniques.'],
                ];
                @endphp
                @foreach($reasons as $reason)
                    <div class="feature-row">
                        <div class="feature-icon"><i class="bi {{ $reason['icon'] }}"></i></div>
                        <div>
                            <h5 class="h6 mb-1">{{ $reason['title'] }}</h5>
                            <p class="text-muted mb-0 small">{{ $reason['text'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <img src="https://images.unsplash.com/photo-1592982537447-7440770cbfc9?q=80&w=900&auto=format&fit=crop" class="img-fluid rounded-agri shadow-agri" alt="Why choose us">
            </div>
        </div>
    </div>
</section>

{{-- LATEST NEWS --}}
@if($news->count())
<section class="section-pad bg-agri-100">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="section-eyebrow justify-content-center">{{ __('site.news') }}</span>
            <h2 class="mt-3">{{ __('site.latest_news') }}</h2>
        </div>
        <div class="row g-4">
            @foreach($news as $article)
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                    <div class="card-agri">
                        <div class="card-img-wrap">
                            <img src="{{ $article->cover_image ? asset('storage/'.$article->cover_image) : 'https://images.unsplash.com/photo-1500382017468-9049fed747ef?q=80&w=600&auto=format&fit=crop' }}" alt="{{ $article->title }}">
                        </div>
                        <div class="p-4">
                            <small class="text-muted"><i class="bi bi-calendar3 me-1"></i>{{ $article->published_at?->translatedFormat('d M Y') }}</small>
                            <h5 class="mt-2 mb-2">{{ $article->title }}</h5>
                            <p class="text-muted small">{{ Str::limit($article->excerpt, 90) }}</p>
                            <a href="{{ route('news.show', [$locale, $article->slug]) }}" class="text-green fw-semibold">{{ __('site.read_more') }} <i class="bi bi-arrow-{{ $locale==='ar'?'left':'right' }}"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif



{{-- TESTIMONIALS --}}
@if($testimonials->count())
<section class="section-pad bg-agri-100">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="section-eyebrow justify-content-center">{{ __('site.testimonials') }}</span>
            <h2 class="mt-3">{{ $locale==='ar'?'ماذا يقول عملاؤنا':'What Our Clients Say' }}</h2>
        </div>
        <div class="row g-4">
            @foreach($testimonials as $t)
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                    <div class="testimonial-card">
                        <div class="testimonial-quote mb-2"><i class="bi bi-quote"></i></div>
                        <p class="text-muted">{{ $t->message }}</p>
                        <div class="d-flex align-items-center gap-3 mt-3">
                            <img src="{{ $t->image ? asset('storage/'.$t->image) : 'https://ui-avatars.com/api/?background=1b6b39&color=fff&name=' . urlencode($t->name) }}" class="testimonial-avatar" alt="{{ $t->name }}">
                            <div>
                                <div class="fw-bold">{{ $t->name }}</div>
                                <small class="text-muted">{{ $t->position }}{{ $t->company ? ', '.$t->company : '' }}</small>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- CONTACT CTA --}}
<section class="section-pad">
    <div class="container">
        <div class="cta-band text-center" data-aos="zoom-in">
            <h2 style="color:#fff;" class="mb-3">{{ __('site.cta_heading') }}</h2>
            <p class="mb-4" style="color:rgba(255,255,255,.85);max-width:600px;margin-inline:auto;">{{ __('site.cta_text') }}</p>
            <a href="{{ route('contact.index', $locale) }}" class="btn-agri-light">{{ __('site.cta_button') }} <i class="bi bi-arrow-{{ $locale==='ar'?'left':'right' }}"></i></a>
        </div>
    </div>
</section>
@endsection
