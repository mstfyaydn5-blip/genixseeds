<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $query = News::published()->with(['category', 'author']);

        if ($request->filled('category')) {
            $query->whereHas('category', fn ($q) => $q->where('slug', $request->category));
        }

        if ($request->filled('q')) {
            $term = $request->q;
            $query->where(function ($q) use ($term) {
                $q->where('title_en', 'like', "%{$term}%")->orWhere('title_ar', 'like', "%{$term}%");
            });
        }

        $articles = $query->latest('published_at')->paginate(6)->withQueryString();
        $categories = NewsCategory::orderBy('name_en')->get();
        $latest = News::published()->latest('published_at')->limit(4)->get();

        return view('pages.news.index', compact('articles', 'categories', 'latest'));
    }

 public function show(string $locale, string $slug)
{
    $article = News::published()
        ->where('slug', $slug)
        ->with(['category', 'author'])
        ->firstOrFail();

    $article->increment('views');

    $related = News::published()
        ->where('id', '!=', $article->id)
        ->where('news_category_id', $article->news_category_id)
        ->limit(3)
        ->get();

    return view('pages.news.show', compact('article', 'related'));
}
}
