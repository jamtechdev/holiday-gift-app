<?php

namespace App\Http\Controllers;

use App\Models\UserGiftRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GiftRequestController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'street_address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|size:2',
            'zip' => 'required|string|size:5',
            'telephone' => 'required|string|min:10|max:15',
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

        UserGiftRequest::create([
            'user_id' => $user->id,
            'category_id' => $categoryId,
            'name' => $request->name,
            'street_address' => $request->street_address,
            'city' => $request->city,
            'state' => $request->state,
            'zip' => $request->zip,
            'telephone' => $request->telephone,
            'email' => $request->email,
            'company' => $request->company,
            'charity_selection' => $request->charity_selection,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Gift request submitted successfully! Your gift will be processed soon.'
        ]);
    }
}
