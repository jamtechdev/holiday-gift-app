<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gift;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GiftController extends Controller
{
    public function index()
    {
        $gifts = Gift::with('category')->get();
        return view('admin.gifts.index', compact('gifts'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.gifts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|image|max:2048',
        ]);

        $imagePath = $request->file('image')->store('gifts', 'public');

        Gift::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.gifts.index')->with('status', 'Gift created successfully.');
    }

    public function edit(Gift $gift)
    {
        $categories = Category::all();
        return view('admin.gifts.edit', compact('gift', 'categories'));
    }

    public function update(Request $request, Gift $gift)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = [
            'name' => $request->name,
            'category_id' => $request->category_id,
        ];

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($gift->image && Storage::disk('public')->exists($gift->image)) {
                Storage::disk('public')->delete($gift->image);
            }
            $data['image'] = $request->file('image')->store('gifts', 'public');
        }

        $gift->update($data);
        return redirect()->route('admin.gifts.index')->with('status', 'Gift updated successfully.');
    }

    public function destroy(Gift $gift)
    {
        $gift->delete();
        return redirect()->route('admin.gifts.index');
    }
}