<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocaleController extends Controller
{
    public function switch(Request $request, string $locale)
    {
        if (! in_array($locale, ['en', 'ar'])) {
            $locale = 'en';
        }

        $path = $request->query('redirect', '/');
        $segments = explode('/', trim($path, '/'));

        if (isset($segments[0]) && in_array($segments[0], ['en', 'ar'])) {
            array_shift($segments);
        }

        $newPath = '/' . $locale . (count($segments) ? '/' . implode('/', $segments) : '');

        return redirect($newPath);
    }
}
