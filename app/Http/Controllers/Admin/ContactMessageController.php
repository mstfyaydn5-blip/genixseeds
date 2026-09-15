<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:manage messages');
    }

    public function index(Request $request)
    {
        $messages = ContactMessage::query()
            ->when($request->filled('q'), fn ($q) => $q->where('name', 'like', '%' . $request->q . '%')->orWhere('email', 'like', '%' . $request->q . '%'))
            ->when($request->filled('status'), fn ($q) => $q->where('is_read', $request->status === 'read'))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.messages.index', compact('messages'));
    }

    public function show(ContactMessage $message)
    {
        $message->update(['is_read' => true]);

        return view('admin.messages.show', compact('message'));
    }

    public function destroy(ContactMessage $message)
    {
        $message->delete();

        return back()->with('success', __('Message deleted successfully.'));
    }
}
