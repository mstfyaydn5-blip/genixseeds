<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Product;
use App\Models\Service;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $locales = ['en', 'ar'];
        $urls = [];

        foreach ($locales as $locale) {
            $static = ['', 'about', 'services', 'products', 'news', 'contact'];
            foreach ($static as $path) {
                $urls[] = [
                    'loc' => url("/{$locale}" . ($path ? "/{$path}" : '')),
                    'changefreq' => 'weekly',
                    'priority' => $path === '' ? '1.0' : '0.8',
                ];
            }

            foreach (Service::active()->get() as $item) {
                $urls[] = ['loc' => url("/{$locale}/services/{$item->slug}"), 'changefreq' => 'monthly', 'priority' => '0.6'];
            }
            foreach (Product::active()->get() as $item) {
                $urls[] = ['loc' => url("/{$locale}/products/{$item->slug}"), 'changefreq' => 'monthly', 'priority' => '0.6'];
            }
            foreach (News::published()->get() as $item) {
                $urls[] = ['loc' => url("/{$locale}/news/{$item->slug}"), 'changefreq' => 'weekly', 'priority' => '0.5'];
            }
        }

        $xml = view('sitemap', compact('urls'))->render();

        return response($xml, 200)->header('Content-Type', 'text/xml');
    }
}
