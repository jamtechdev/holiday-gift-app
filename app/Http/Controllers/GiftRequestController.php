<?php

namespace App\Http\Controllers;

use App\Models\UserGiftRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GiftRequestController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'street_address' => 'required|string|max:255',
            'street_address2' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|size:2',
            'zip' => 'required|string|size:5',
            'country' => 'nullable|string|max:255',
            'telephone' => 'required|string|min:10|max:15',
            'country_code' => 'nullable|string|max:10',
            'email' => 'required|email|max:255',
            'company' => 'nullable|string|max:255',
            'charity_selection' => 'nullable|string|in:wildheart,lionheart,split',
        ]);

        $user = Auth::user();
        $categoryId = $request->category_id;

        // Check if user has already claimed ANY gift this year
        $hasClaimedAny = UserGiftRequest::where('user_id', $user->id)
            ->whereYear('created_at', now()->year)
            ->exists();

        if ($hasClaimedAny) {
            $errorMessage = 'Our records show that you\'ve already claimed your gift for this year. If this is unexpected or you have any questions, please contact us at info@thinkgraphtech.com, and we will assist you.';
            
            return response()->json([
                'success' => false,
                'error' => 'already_claimed',
                'message' => $errorMessage
            ], 422);
        }

        // Get category to check if it's donation
        $category = Category::find($categoryId);
        
        // Set default charity to wildheart if donation category and no charity_selection provided
        $charitySelection = $request->charity_selection;
        if ($category && strtolower($category->name) === 'donation' && empty($charitySelection)) {
            $charitySelection = 'wildheart';
        }

        UserGiftRequest::create([
            'user_id' => $user->id,
            'category_id' => $categoryId,
            'name' => $request->name,
            'lastname' => $request->lastname,
            'street_address' => $request->street_address,
            'street_address2' => $request->street_address2,
            'city' => $request->city,
            'state' => $request->state,
            'zip' => $request->zip,
            'country' => $request->country,
            'telephone' => $request->telephone,
            'country_code' => $request->country_code,
            'email' => $request->email,
            'company' => $request->company,
            'charity_selection' => $charitySelection,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Gift request submitted successfully! Your gift will be processed soon.'
        ]);
    }
}
