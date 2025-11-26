<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\UserGiftRequest;
use Illuminate\Http\Request;

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
            'telephone' => 'required|string|size:10',
            'email' => 'required|email|max:255',
            'company' => 'nullable|string|max:255',
        ]);

        UserGiftRequest::create($request->all());
        
        return redirect()->route('gift-request.success');
    }

    public function success()
    {
        return view('gift-request.success');
    }
}