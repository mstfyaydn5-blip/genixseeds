<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Traits\HandlesUploads;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    use HandlesUploads;

    public function __construct()
    {
        $this->middleware('can:manage settings');
    }

    public function general()
    {
        return view('admin.settings.general');
    }

    public function updateGeneral(Request $request)
    {
        $data = $request->validate([
            'site_name_en' => ['required', 'string', 'max:255'],
            'site_name_ar' => ['required', 'string', 'max:255'],
            'tagline_en' => ['nullable', 'string', 'max:255'],
            'tagline_ar' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
            'address_en' => ['nullable', 'string', 'max:500'],
            'address_ar' => ['nullable', 'string', 'max:500'],
            'facebook' => ['nullable', 'url'],
            'twitter' => ['nullable', 'url'],
            'instagram' => ['nullable', 'url'],
            'linkedin' => ['nullable', 'url'],
            'youtube' => ['nullable', 'url'],
            'logo' => ['nullable', 'image', 'max:2048'],
            'favicon' => ['nullable', 'image', 'max:1024'],
        ]);

        foreach ($data as $key => $value) {
            if (in_array($key, ['logo', 'favicon'])) {
                continue;
            }
            Setting::set($key, $value, 'general');
        }

        if ($request->hasFile('logo')) {
            Setting::set('logo', $this->storeImage($request->file('logo'), 'settings'), 'general');
        }
        if ($request->hasFile('favicon')) {
            Setting::set('favicon', $this->storeImage($request->file('favicon'), 'settings'), 'general');
        }

        return back()->with('success', __('Settings updated successfully.'));
    }

    public function seo()
    {
        return view('admin.settings.seo');
    }

    public function updateSeo(Request $request)
    {
        $data = $request->validate([
            'meta_title_en' => ['nullable', 'string', 'max:255'],
            'meta_title_ar' => ['nullable', 'string', 'max:255'],
            'meta_description_en' => ['nullable', 'string', 'max:500'],
            'meta_description_ar' => ['nullable', 'string', 'max:500'],
            'meta_keywords' => ['nullable', 'string', 'max:500'],
            'google_analytics' => ['nullable', 'string', 'max:100'],
            'google_site_verification' => ['nullable', 'string', 'max:255'],
        ]);

        foreach ($data as $key => $value) {
            Setting::set($key, $value, 'seo');
        }

        return back()->with('success', __('SEO settings updated successfully.'));
    }
}
