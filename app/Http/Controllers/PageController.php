<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Statistic;
use App\Models\Testimonial;

class PageController extends Controller
{
public function show(string $locale, string $slug = 'about')
{
    $page = Page::active()->where('slug', $slug)->firstOrFail();

    $statistics = Statistic::active()->orderBy('order')->get();
    $testimonials = Testimonial::active()->orderBy('order')->get();

    return view('pages.about', compact(
        'page',
        'statistics',
        'testimonials'
    ));
}
}
