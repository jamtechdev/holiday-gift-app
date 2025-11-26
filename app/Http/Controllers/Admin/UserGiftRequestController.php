<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserGiftRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class UserGiftRequestController extends Controller
{
    public function index()
    {
        $requests = UserGiftRequest::with('category')->latest()->get();
        return view('admin.gift-requests.index', compact('requests'));
    }

    public function show(UserGiftRequest $userGiftRequest)
    {
        return view('admin.gift-requests.show', compact('userGiftRequest'));
    }

    public function updateStatus(Request $request, UserGiftRequest $userGiftRequest)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,shipped,delivered'
        ]);

        $userGiftRequest->update(['status' => $request->status]);
        return redirect()->back()->with('status', 'Status updated successfully.');
    }

    public function destroy(UserGiftRequest $userGiftRequest)
    {
        $userGiftRequest->delete();
        return redirect()->route('admin.gift-requests.index')->with('status', 'Request deleted successfully.');
    }
}