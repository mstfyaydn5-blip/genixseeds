<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PageRequest;
use App\Models\Page;
use App\Traits\HandlesUploads;

class PageController extends Controller
{
    use HandlesUploads;

    public function __construct()
    {
        $this->middleware('can:manage pages');
    }

    public function index()
    {
        $pages = Page::orderBy('title_en')->paginate(15);

        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.pages.form', ['page' => new Page()]);
    }

    public function store(PageRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('banner_image')) {
            $data['banner_image'] = $this->storeImage($request->file('banner_image'), 'pages');
        }

        Page::create($data);

        return redirect()->route('admin.pages.index')->with('success', __('Page created successfully.'));
    }

    public function edit(Page $page)
    {
        return view('admin.pages.form', compact('page'));
    }

    public function update(PageRequest $request, Page $page)
    {
        $data = $request->validated();

        if ($request->hasFile('banner_image')) {
            $this->deleteFile($page->banner_image);
            $data['banner_image'] = $this->storeImage($request->file('banner_image'), 'pages');
        }

        $page->update($data);

        return redirect()->route('admin.pages.index')->with('success', __('Page updated successfully.'));
    }

    public function destroy(Page $page)
    {
        $this->deleteFile($page->banner_image);
        $page->delete();

        return back()->with('success', __('Page deleted successfully.'));
    }
}
