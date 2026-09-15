@php
    $locale = app()->getLocale();
    $siteName = \App\Models\Setting::get('site_name_' . $locale, config('app.name'));
    $tagline = \App\Models\Setting::get('tagline_' . $locale);
    $phone = \App\Models\Setting::get('phone');
    $email = \App\Models\Setting::get('email');
    $address = \App\Models\Setting::get('address_' . $locale);
    $socials = [
        'facebook' => \App\Models\Setting::get('facebook'),
        'instagram' => \App\Models\Setting::get('instagram'),
        'twitter' => \App\Models\Setting::get('twitter'),
        'linkedin' => \App\Models\Setting::get('linkedin'),
        'youtube' => \App\Models\Setting::get('youtube'),
    ];
    $featuredProducts = \App\Models\Product::active()->orderBy('order')->limit(4)->get();
@endphp
<footer class="site-footer pt-5 pb-4">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4">
                <h5 class="mb-3"><i class="bi bi-flower1"></i> {{ $siteName }}</h5>
                <p>{{ $tagline }}</p>
                <p class="mb-1"><i class="bi bi-geo-alt me-2"></i>{{ $address }}</p>
                <p class="mb-1"><i class="bi bi-telephone me-2"></i>{{ $phone }}</p>
                <p class="mb-3"><i class="bi bi-envelope me-2"></i>{{ $email }}</p>
                <div>
                    @foreach($socials as $name => $url)
                        @if($url)
                            <a href="{{ $url }}" target="_blank" class="social-icon" aria-label="{{ $name }}"><i class="bi bi-{{ $name }}"></i></a>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="col-lg-2 col-6">
                <h5 class="mb-3">{{ __('site.quick_links') }}</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="{{ route('about', $locale) }}">{{ __('site.about') }}</a></li>
                    <li class="mb-2"><a href="{{ route('services.index', $locale) }}">{{ __('site.services') }}</a></li>
                    <li class="mb-2"><a href="{{ route('products.index', $locale) }}">{{ __('site.products') }}</a></li>
                    <li class="mb-2"><a href="{{ route('contact.index', $locale) }}">{{ __('site.contact') }}</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-6">
                <h5 class="mb-3">{{ __('site.our_products') }}</h5>
                <ul class="list-unstyled">
                    @foreach($featuredProducts as $p)
                        <li class="mb-2"><a href="{{ route('products.show', [$locale, $p->slug]) }}">{{ $p->name }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="col-lg-3">
                <h5 class="mb-3">{{ __('site.newsletter') }}</h5>
                <p>{{ __('site.newsletter_text') }}</p>
                <form class="d-flex gap-2">
                    <input type="email" class="form-control" placeholder="{{ __('site.email') }}">
                    <button class="btn-agri-light" type="submit"><i class="bi bi-send"></i></button>
                </form>
            </div>
        </div>
        <div class="footer-bottom d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
            <p class="mb-0 small">&copy; {{ date('Y') }} {{ $siteName }}. {{ __('site.all_rights_reserved') }}</p>
            <p class="mb-0 small">
            </p>
        </div>
    </div>
</footer>
