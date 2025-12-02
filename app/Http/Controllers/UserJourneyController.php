<?php

namespace App\Http\Controllers;

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
        return view('journey.index');
    }

    /**
     * Show gift category selection (replaces old step 1).
     */
    public function giftCategories(): View|RedirectResponse
    {
        $user = Auth::user();

        // Check if user has already claimed any gift this year
        $hasClaimedAny = UserGiftRequest::where('user_id', $user->id)
            ->whereYear('created_at', now()->year)
            ->exists();

        // If already claimed, redirect to already claimed page
        if ($hasClaimedAny) {
            return redirect()->route('user.already.claimed');
        }

        $categories = Category::orderBy('name')->get();

        return view('journey.giftlabel', compact('categories'));
    }

    /**
     * Show gifts for a selected category (after clicking on giftlabel).
     */
    public function showGiftsByCategory(Category $category): View|RedirectResponse
    {
        $user = Auth::user();

        // Check if user has already claimed ANY gift this year
        $hasClaimedAny = UserGiftRequest::where('user_id', $user->id)
            ->whereYear('created_at', now()->year)
            ->exists();

        // If already claimed, redirect to already claimed page
        if ($hasClaimedAny) {
            return redirect()->route('user.already.claimed');
        }

        $category->load('gifts');

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
        $user = Auth::user();

        // Get the user's latest gift request with category
        $giftRequest = UserGiftRequest::where('user_id', $user->id)
            ->with('category')
            ->latest()
            ->first();

        return view('journey.claimed', [
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

        // Get the user's claimed gift request with category
        $giftRequest = UserGiftRequest::where('user_id', $user->id)
            ->with('category')
            ->whereYear('created_at', now()->year)
            ->latest()
            ->first();

        return view('journey.already-claimed', [
            'giftRequest' => $giftRequest,
            'category' => $giftRequest?->category,
        ]);
    }

public function page3 (){

return view('journey.page3');
}


}
