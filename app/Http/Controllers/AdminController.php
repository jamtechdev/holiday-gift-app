<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Gift;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function dashboard(): View
    {
        $categories = Category::with('gifts')->latest()->get();
        $gifts = Gift::with('category')->latest()->get();
        
        // Statistics for dashboard - exclude admin users
        $totalUsers = \App\Models\User::where('role', '!=', 'admin')->count();
        $todayGifts = Gift::whereDate('created_at', today())->count();
        $recentGifts = Gift::with('category')->latest()->take(10)->get();
        $recentUsers = \App\Models\User::where('role', '!=', 'admin')->latest()->take(10)->get();
        
        $stats = [
            'total_users' => $totalUsers,
            'total_categories' => Category::count(),
            'total_gifts' => Gift::count(),
            'today_gifts' => $todayGifts,
            'recent_users' => $recentUsers,
            'recent_gifts' => $recentGifts,
        ];

        return view('admin.dashboard', compact('categories', 'gifts', 'stats'));
    }

    public function storeCategory(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'accent_color' => ['required', 'string', 'max:20'],
            'description' => ['nullable', 'string', 'max:500'],
        ]);

        Category::create($data);

        return back()->with('status', 'Category created successfully.');
    }

    public function storeGift(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:150'],
            'summary' => ['nullable', 'string', 'max:500'],
            'image' => ['required', 'image', 'max:2048'],
        ]);

        $imagePath = $request->file('image')->store('gifts', 'public');

        Gift::create([
            'category_id' => $data['category_id'],
            'name' => $data['name'],
            'summary' => $data['summary'] ?? null,
            'image_path' => $imagePath,
        ]);

        return back()->with('status', 'Gift added successfully.');
    }
}

