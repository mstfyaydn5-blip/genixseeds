<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class NewsCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:manage news');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name_en' => ['required', 'string', 'max:255'],
            'name_ar' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'alpha_dash', 'unique:news_categories,slug'],
        ]);
        $data['slug'] = $data['slug'] ?? Str::slug($data['name_en']);

        NewsCategory::create($data);

        return back()->with('success', __('Category created successfully.'));
    }

    public function update(Request $request, NewsCategory $newsCategory)
    {
        $data = $request->validate([
            'name_en' => ['required', 'string', 'max:255'],
            'name_ar' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'alpha_dash', Rule::unique('news_categories', 'slug')->ignore($newsCategory->id)],
        ]);

        $newsCategory->update($data);

        return back()->with('success', __('Category updated successfully.'));
    }

    public function destroy(NewsCategory $newsCategory)
    {
        $newsCategory->delete();

        return back()->with('success', __('Category deleted successfully.'));
    }
}
