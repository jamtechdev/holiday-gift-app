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
        $gifts = Gift::with('category')->paginate(8);
        return view('admin.gifts.index', compact('gifts'));
    }

    public function create()
    {
        $categories = $this->getAvailableCategories();
        return view('admin.gifts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->getValidationRules());

        $validated['image'] = $request->file('image')->store('gifts', 'public');

        Gift::create($validated);

        return redirect()->route('admin.gifts.index')->with('status', 'Gift created successfully.');
    }

    public function edit(Gift $gift)
    {
        $categories = $this->getAvailableCategories();
        return view('admin.gifts.edit', compact('gift', 'categories'));
    }

    public function update(Request $request, Gift $gift)
    {
        $validated = $request->validate($this->getValidationRules($gift));

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($gift->image && Storage::disk('public')->exists($gift->image)) {
                Storage::disk('public')->delete($gift->image);
            }
            $validated['image'] = $request->file('image')->store('gifts', 'public');
        }

        $gift->update($validated);
        return redirect()->route('admin.gifts.index')->with('status', 'Gift updated successfully.');
    }

    public function destroy(Gift $gift)
    {
        $gift->delete();
        return redirect()->route('admin.gifts.index');
    }

    /**
     * Get available categories excluding donation.
     */
    private function getAvailableCategories()
    {
        return Category::excludeDonation()->get();
    }

    /**
     * Get validation rules for gift creation/update.
     */
    private function getValidationRules(Gift $gift = null): array
    {
        return [
            'name' => 'required|string|max:255',
            'category_id' => [
                'required',
                'exists:categories,id',
                function ($attribute, $value, $fail) use ($gift) {
                    $query = Gift::where('category_id', $value);

                    // When updating, exclude current gift from uniqueness check
                    if ($gift) {
                        $query->where('id', '!=', $gift->id);
                    }

                    $existingGift = $query->first();
                    if ($existingGift) {
                        $fail('A gift already exists for this category. Only one gift per category is allowed.');
                    }
                },
            ],
            'image' => $gift ? 'nullable|image|max:2048' : 'required|image|max:2048',
        ];
    }
}
