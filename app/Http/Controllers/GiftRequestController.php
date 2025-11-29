<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\UserGiftRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GiftRequestController extends Controller
{
    public function create()
    {
        $categories = Category::all();
        return view('gift-request.create', compact('categories'));
    }

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
        ]);

        $user = Auth::user();
        $categoryId = $request->category_id;

        // Check if user has already claimed a gift for this category this year
        $existingClaim = UserGiftRequest::where('user_id', $user->id)
            ->where('category_id', $categoryId)
            ->whereYear('created_at', now()->year)
            ->first();

        if ($existingClaim) {
            $errorMessage = 'Our records show that you\'ve already claimed your gift for this year. If this is unexpected or you have questions, please contact us at info@thinkgraphtech.com so we can assist you.';
            
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'error' => 'already_claimed',
                    'message' => $errorMessage
                ], 422);
            }

            return back()->withErrors([
                'category_id' => $errorMessage
            ])->with('error', $errorMessage);
        }

        // Create the gift request with user_id
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
        ]);

        $successMessage = 'Gift request submitted successfully! Your gift will be processed soon.';

        // If AJAX request, return JSON response
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => $successMessage
            ]);
        }

        // Otherwise redirect
        if ($request->has('redirect_to')) {
            return redirect($request->redirect_to)
                ->with('success', $successMessage);
        }

        return redirect()->route('user.claimed')
            ->with('success', $successMessage);
    }
}
