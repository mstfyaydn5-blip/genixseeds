<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', __('site.dashboard')) | {{ __('site.admin_panel') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=Inter:wght@400;500;600;700;800&family=Cairo:wght@400;600;700;800&display=swap" rel="stylesheet">
    @if(app()->getLocale() === 'ar')
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    @else
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    @endif
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    @stack('styles')
</head>
<body class="admin-body">

@php
    $menu = [
        'main' => [
            ['route' => 'admin.dashboard', 'icon' => 'bi-speedometer2', 'label' => __('site.dashboard')],
        ],
        'content' => [
            ['route' => 'admin.pages.index', 'icon' => 'bi-file-earmark-text', 'label' => 'Pages'],
            ['route' => 'admin.services.index', 'icon' => 'bi-flower1', 'label' => 'Services'],
            ['route' => 'admin.products.index', 'icon' => 'bi-box-seam', 'label' => 'Products'],
            ['route' => 'admin.product-categories.index', 'icon' => 'bi-tags', 'label' => 'Product Categories'],
            ['route' => 'admin.news.index', 'icon' => 'bi-newspaper', 'label' => 'News & Articles'],
        ],
  
        'system' => [
            ['route' => 'admin.messages.index', 'icon' => 'bi-envelope', 'label' => 'Messages'],
            ['route' => 'admin.settings.general', 'icon' => 'bi-gear', 'label' => 'General Settings'],
            ['route' => 'admin.settings.seo', 'icon' => 'bi-search', 'label' => 'SEO Settings'],
            ['route' => 'admin.users.index', 'icon' => 'bi-people', 'label' => 'Users & Roles'],
        ],
    ];
@endphp

<aside class="admin-sidebar">
    <div class="brand"><i class="bi bi-flower1"></i> Genix<span>seeds</span></div>
    <nav class="admin-nav">
        @foreach($menu['main'] as $item)
            <a href="{{ route($item['route']) }}" class="nav-link {{ request()->routeIs($item['route']) ? 'active' : '' }}"><i class="bi {{ $item['icon'] }}"></i> {{ $item['label'] }}</a>
        @endforeach

        <div class="nav-section">Content</div>
        @foreach($menu['content'] as $item)
            @can(str_contains($item['route'], 'product') ? 'manage products' : (str_contains($item['route'], 'news') ? 'manage news' : (str_contains($item['route'], 'services') ? 'manage services' : 'manage pages')))
            <a href="{{ route($item['route']) }}" class="nav-link {{ request()->routeIs(str_replace('.index', '*', $item['route'])) ? 'active' : '' }}"><i class="bi {{ $item['icon'] }}"></i> {{ $item['label'] }}</a>
            @endcan
        @endforeach

        <div class="nav-section">System</div>
        @can('manage messages')
        <a href="{{ route('admin.messages.index') }}" class="nav-link {{ request()->routeIs('admin.messages*') ? 'active' : '' }}"><i class="bi bi-envelope"></i> Messages</a>
        @endcan
        @can('manage settings')
        <a href="{{ route('admin.settings.general') }}" class="nav-link {{ request()->routeIs('admin.settings.general') ? 'active' : '' }}"><i class="bi bi-gear"></i> General Settings</a>
        <a href="{{ route('admin.settings.seo') }}" class="nav-link {{ request()->routeIs('admin.settings.seo') ? 'active' : '' }}"><i class="bi bi-search"></i> SEO Settings</a>
        @endcan
        @can('manage users')
        <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users*') ? 'active' : '' }}"><i class="bi bi-people"></i> Users & Roles</a>
        @endcan
    </nav>
</aside>

<div class="admin-main">
    <div class="admin-topbar">
        <div class="d-flex align-items-center gap-3">
            <button id="sidebarToggle" class="btn btn-light d-lg-none"><i class="bi bi-list"></i></button>
            <h5 class="mb-0 fw-bold">@yield('page-title', 'Dashboard')</h5>
        </div>
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('home', app()->getLocale()) }}" target="_blank" class="btn btn-sm btn-outline-secondary"><i class="bi bi-box-arrow-up-right"></i> View Site</a>
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center gap-2 text-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown">
                    <img src="https://ui-avatars.com/api/?background=1b6b39&color=fff&name={{ urlencode(auth()->user()->name) }}" class="rounded-circle" width="36" height="36" alt="">
                    <span class="fw-semibold small">{{ auth()->user()->name }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><form method="POST" action="{{ route('admin.logout') }}">@csrf<button class="dropdown-item"><i class="bi bi-box-arrow-right me-2"></i>{{ __('site.logout') }}</button></form></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="admin-content">
        @include('partials.alerts')
        @yield('content')
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/admin.js') }}"></script>
@stack('scripts')
</body>
</html>
