<?php

namespace App\Http\Controllers\Demo;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\UserGiftRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserJourneyController extends Controller
{
    /**
     * Show the journey landing page.
     */
    public function index(): View
    {
        return view('demo.journey.index');
    }

    /**
     * Show gift category selection.
     * In demo mode, never check for claimed status - always allow browsing.
     */
    public function giftCategories(): View|RedirectResponse
    {
        // In demo mode, skip ALL claimed checks - always allow browsing
        // Never redirect to already-claimed page in demo mode
        $categories = Category::orderBy('name')->get();

        return view('demo.journey.giftlabel', compact('categories'));
    }

    /**
     * Show gifts for a selected category.
     * In demo mode, gifts can never be claimed - always show contact message.
     */
    public function showGiftsByCategory(Category $category): View|RedirectResponse
    {
        $category->load('gifts');

        // In demo mode: hasClaimed is always false - gifts can never be claimed
        // Users can only view gifts and see contact message
        return view('demo.journey.gift', [
            'category' => $category,
            'gifts' => $category->gifts,
            'hasClaimed' => false, // Always false - gifts cannot be claimed in demo mode
        ]);
    }

    /**
     * Show the claimed/success page (demo version - won't actually be reached).
     */
    public function claimed(): View
    {
        $user = Auth::user();

        $giftRequest = UserGiftRequest::where('user_id', $user->id)
            ->with('category')
            ->latest()
            ->first();

        return view('demo.journey.claimed', [
            'giftRequest' => $giftRequest,
            'category' => $giftRequest?->category,
        ]);
    }

    /**
     * Show the already claimed message page.
     */
    public function alreadyClaimed(): View
    {
        $user = Auth::user();

        $giftRequest = UserGiftRequest::where('user_id', $user->id)
            ->with('category')
            ->whereYear('created_at', now()->year)
            ->latest()
            ->first();

        return view('demo.journey.already-claimed', [
            'giftRequest' => $giftRequest,
            'category' => $giftRequest?->category,
        ]);
    }
}
