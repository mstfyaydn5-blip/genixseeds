<?php

use App\Http\Middleware\EnsureUserIsActive;
use App\Http\Middleware\SetLocale;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Trust all proxies (Cloudflare Tunnel, reverse proxies, load balancers).
        // Without this, Laravel can't see the X-Forwarded-Proto header and will
        // generate asset()/url() links as http:// even when the site is served
        // over https://, which browsers silently block as "mixed content" —
        // this is why custom CSS/JS/images fail to load behind a tunnel or proxy.
        $middleware->trustProxies(at: '*');

        $middleware->alias([
            'setlocale' => SetLocale::class,
            'active' => EnsureUserIsActive::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
