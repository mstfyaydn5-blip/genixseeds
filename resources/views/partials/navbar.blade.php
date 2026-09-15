@php
    $locale = app()->getLocale();
    $siteName = \App\Models\Setting::get('site_name_' . $locale, config('app.name'));
    $logo = \App\Models\Setting::get('logo');
    $navItems = [
        ['route' => 'home', 'label' => __('site.home')],
        ['route' => 'about', 'label' => __('site.about')],
        ['route' => 'services.index', 'label' => __('site.services')],
        ['route' => 'products.index', 'label' => __('site.products')],
        ['route' => 'news.index', 'label' => __('site.news')],
        ['route' => 'contact.index', 'label' => __('site.contact')],
    ];
@endphp
<nav class="navbar navbar-expand-lg navbar-agri sticky-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home', $locale) }}">
            @if($logo)
                <img src="{{ asset('storage/' . $logo) }}" alt="{{ $siteName }}" height="42">
            @else
                <i class="bi bi-flower1 text-green"></i> {{ explode(' ', $siteName)[0] ?? $siteName }}<span>{{ str_replace(explode(' ', $siteName)[0] ?? '', '', $siteName) }}</span>
            @endif
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav mx-auto">
                @foreach($navItems as $item)
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs($item['route']) ? 'active' : '' }}" href="{{ route($item['route'], $locale) }}">{{ $item['label'] }}</a>
                    </li>
                @endforeach
            </ul>
            <div class="d-flex align-items-center gap-2 mt-3 mt-lg-0">
        
                <a href="{{ route('contact.index', $locale) }}" class="btn-agri d-none d-lg-inline-flex">
                    {{ __('site.get_in_touch') }} <i class="bi bi-arrow-{{ $locale === 'ar' ? 'left' : 'right' }}"></i>
                </a>
            </div>
        </div>
    </div>
</nav>
