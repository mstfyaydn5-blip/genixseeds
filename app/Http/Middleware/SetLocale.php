<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->segment(1);

        if (! in_array($locale, ['en', 'ar'])) {
            $locale = session('locale', config('app.locale'));
        }

        session(['locale' => $locale]);
        app()->setLocale($locale);

        return $next($request);
    }
}
