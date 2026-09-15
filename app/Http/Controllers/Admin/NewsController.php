<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\NewsRequest;
use App\Models\News;
use App\Models\NewsCategory;
use App\Traits\HandlesUploads;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    use HandlesUploads;

    public function __construct()
    {
        $this->middleware('can:manage news');
    }

    public function index(Request $request)
    {
        $articles = News::query()
            ->with('category')
            ->when($request->filled('q'), fn ($q) => $q->where('title_en', 'like', '%' . $request->q . '%'))
            ->when($request->filled('status'), fn ($q) => $q->where('is_published', $request->status === 'published'))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        $categories = NewsCategory::orderBy('name_en')->get();

        return view('admin.news.index', compact('articles', 'categories'));
    }

    public function create()
    {
        $categories = NewsCategory::orderBy('name_en')->get();

        return view('admin.news.form', ['article' => new News(), 'categories' => $categories]);
    }

    public function store(NewsRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = $data['slug'] ?: Str::slug($data['title_en']);
        $data['author_id'] = auth()->id();

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $this->storeImage($request->file('cover_image'), 'news');
        }
        if ($request->boolean('is_published') && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        News::create($data);

        return redirect()->route('admin.news.index')->with('success', __('Article created successfully.'));
    }

    public function edit(News $news)
    {
        $categories = NewsCategory::orderBy('name_en')->get();

        return view('admin.news.form', ['article' => $news, 'categories' => $categories]);
    }

    public function update(NewsRequest $request, News $news)
    {
        $data = $request->validated();

        if ($request->hasFile('cover_image')) {
            $this->deleteFile($news->cover_image);
            $data['cover_image'] = $this->storeImage($request->file('cover_image'), 'news');
        }
        if ($request->boolean('is_published') && empty($news->published_at) && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        $news->update($data);

        return redirect()->route('admin.news.index')->with('success', __('Article updated successfully.'));
    }

    public function destroy(News $news)
    {
        $this->deleteFile($news->cover_image);
        $news->delete();

        return back()->with('success', __('Article deleted successfully.'));
    }
}
