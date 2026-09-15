<?php

namespace App\Http\Controllers;

use App\Models\Service;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::active()->orderBy('order')->paginate(9);

        return view('pages.services.index', compact('services'));
    }

    public function show(string $slug)
    {
        $service = Service::active()->where('slug', $slug)->firstOrFail();
        $related = Service::active()->where('id', '!=', $service->id)->orderBy('order')->limit(3)->get();

        return view('pages.services.show', compact('service', 'related'));
    }
}
