<section class="page-banner text-center">
    <div class="container">
        <span class="section-eyebrow text-white-50">{{ $eyebrow ?? __('site.quick_links') }}</span>
        <h1 class="mt-2 mb-3" style="color:#fff;">{{ $title }}</h1>
        <nav class="breadcrumb-agri">
            <a href="{{ route('home', app()->getLocale()) }}">{{ __('site.home') }}</a>
            <span class="mx-2">/</span>
            <span class="active">{{ $title }}</span>
        </nav>
    </div>
</section>
