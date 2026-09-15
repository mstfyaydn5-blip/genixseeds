<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Partner;
use App\Models\Product;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Statistic;
use App\Models\Testimonial;

class HomeController extends Controller
{
    public function index()
    {
        $services = Service::active()->orderBy('order')->limit(6)->get();
        $products = Product::active()->featured()->with('category')->orderBy('order')->limit(8)->get();
        $statistics = Statistic::active()->orderBy('order')->get();
        $news = News::published()->latest('published_at')->limit(3)->get();
        $partners = Partner::active()->orderBy('order')->get();
        $testimonials = Testimonial::active()->orderBy('order')->get();



        return view('home.index', compact('services', 'products', 'statistics', 'news', 'partners', 'testimonials'));
    }
}
