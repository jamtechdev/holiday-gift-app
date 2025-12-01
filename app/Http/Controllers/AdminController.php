<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Gift;
use App\Models\User;
use App\Models\UserGiftRequest;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function dashboard(): View
    {
        $categories = Category::with('gifts')->latest()->get();
        $gifts = Gift::with('category')->latest()->get();

        $totalUsers = User::where('role', '!=', 'admin')->count();
        $todayGifts = Gift::whereDate('created_at', today())->count();
        $recentGifts = Gift::with('category')->latest()->take(10)->get();
        $recentUsers = User::where('role', '!=', 'admin')->latest()->take(10)->get();
        $recentRequests = UserGiftRequest::with('category')->latest()->take(10)->get();

        $stats = [
            'total_users' => $totalUsers,
            'total_categories' => Category::count(),
            'total_gifts' => Gift::count(),
            'today_gifts' => $todayGifts,
            'recent_users' => $recentUsers,
            'recent_gifts' => $recentGifts,
            'recent_requests' => $recentRequests,
        ];

        return view('admin.dashboard', compact('categories', 'gifts', 'stats'));
    }
}

