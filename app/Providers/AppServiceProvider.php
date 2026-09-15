<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // استخدم Bootstrap Pagination بدلاً من Tailwind
        Paginator::useBootstrapFive();

        // Force HTTPS when behind a trusted proxy
        if (str_starts_with(config('app.url'), 'https://') || $this->requestIsSecureBehindProxy()) {
            URL::forceScheme('https');
        }
    }

    /**
     * Detect HTTPS behind a proxy.
     */
    private function requestIsSecureBehindProxy(): bool
    {
        return $this->app->bound('request') && $this->app['request']->isSecure();
    }
}