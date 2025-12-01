<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\UserGiftRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserJourneyController extends Controller
{
    /**
     * Show the journey landing page.
     */
    public function index(): View
    {
        return view('journey.index');
    }

    /**
     * Show gift category selection (replaces old step 1).
     */
    public function giftCategories(): View
    {
        $categories = Category::orderBy('name')->get();

        return view('journey.giftlabel', compact('categories'));
    }

    /**
     * Show gifts for a selected category (after clicking on giftlabel).
     */
    public function showGiftsByCategory(Category $category): View
    {
        $category->load('gifts');
        $user = Auth::user();

        $hasClaimed = UserGiftRequest::where('user_id', $user->id)
            ->where('category_id', $category->id)
            ->whereYear('created_at', now()->year)
            ->exists();

        return view('journey.gift', [
            'category' => $category,
            'gifts' => $category->gifts,
            'hasClaimed' => $hasClaimed,
        ]);
    }

    /**
     * Show the claimed/success page after gift request submission.
     */
    public function claimed(): View
    {
        return view('journey.claimed');
    }
}
