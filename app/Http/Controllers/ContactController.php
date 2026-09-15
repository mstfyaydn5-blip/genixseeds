<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\ContactMessageRequest;
use App\Models\ContactMessage;
use App\Models\Setting;

class ContactController extends Controller
{
    public function index()
    {
        return view('pages.contact');
    }

    public function store(ContactMessageRequest $request)
    {
        ContactMessage::create($request->validated());

        return back()->with('success', __('messages.contact_submitted'));
    }
}
