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
        $categories = Category::all();
        return view('admin.gifts.create', compact('categories'));
    }

    /**
     * Check if an image path is used by other gifts
     */
    private function isImageUsedElsewhere(string $imagePath, int $excludeGiftId = null): bool
    {
        $query = Gift::query();
        
        if ($excludeGiftId) {
            $query->where('id', '!=', $excludeGiftId);
        }
        
        // Get all gifts and check their image arrays
        $gifts = $query->get();
        
        foreach ($gifts as $gift) {
            $images = is_array($gift->image) ? $gift->image : (is_string($gift->image) && $gift->image ? [$gift->image] : []);
            if (in_array($imagePath, $images)) {
                return true;
            }
        }
        
        return false;
    }

    /**
     * Check if an image already exists in storage by comparing hash
     */
    private function isDuplicateImage($file, array $existingImages = []): ?string
    {
        $fileHash = md5_file($file->getRealPath());
        
        // Check against existing images in the current gift
        foreach ($existingImages as $existingImagePath) {
            if (Storage::disk('public')->exists($existingImagePath)) {
                $existingFileHash = md5_file(Storage::disk('public')->path($existingImagePath));
                if ($fileHash === $existingFileHash) {
                    return $existingImagePath; // Return existing path if duplicate found
                }
            }
        }
        
        return null; // No duplicate found
    }

    /**
     * Store uploaded image and return path, or return existing path if duplicate
     */
    private function storeImage($file, array $existingImages = []): string
    {
        // Check for duplicate
        $duplicatePath = $this->isDuplicateImage($file, $existingImages);
        if ($duplicatePath) {
            return $duplicatePath; // Return existing path, don't upload again
        }
        
        // Store new image
        return $file->store('gifts', 'public');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'images.*' => 'image|max:2048',
            'images' => 'required|array|min:1',
        ]);

        $imagePaths = [];
        $duplicatesSkipped = 0;
        
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                // Check for duplicates within the current upload batch
                $duplicateInBatch = false;
                foreach ($imagePaths as $existingPath) {
                    if (Storage::disk('public')->exists($existingPath)) {
                        $existingHash = md5_file(Storage::disk('public')->path($existingPath));
                        $newHash = md5_file($image->getRealPath());
                        if ($existingHash === $newHash) {
                            $duplicateInBatch = true;
                            $duplicatesSkipped++;
                            break;
                        }
                    }
                }
                
                if (!$duplicateInBatch) {
                    $imagePaths[] = $this->storeImage($image);
                }
            }
        }

        Gift::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'image' => $imagePaths,
        ]);

        $message = 'Gift created successfully.';
        if ($duplicatesSkipped > 0) {
            $message .= " {$duplicatesSkipped} duplicate image(s) skipped.";
        }

        return redirect()->route('admin.gifts.index')->with('status', $message);
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
            'images.*' => 'image|max:2048',
            'images' => 'nullable|array',
            'remove_images' => 'nullable|array',
        ]);

        $data = [
            'name' => $request->name,
            'category_id' => $request->category_id,
        ];

        // Get existing images
        $existingImages = is_array($gift->image) ? $gift->image : (is_string($gift->image) && $gift->image ? [$gift->image] : []);
        $imagesToDelete = []; // Track images to delete from storage

        // Remove images that are marked for deletion
        if ($request->has('remove_images') && is_array($request->remove_images)) {
            foreach ($request->remove_images as $imageToRemove) {
                // Verify the image belongs to this gift before deleting
                if (in_array($imageToRemove, $existingImages)) {
                    // Check if this image is used by other gifts before deleting
                    if (!$this->isImageUsedElsewhere($imageToRemove, $gift->id) && Storage::disk('public')->exists($imageToRemove)) {
                        $imagesToDelete[] = $imageToRemove;
                    }
                    
                    // Remove from array
                    $existingImages = array_values(array_filter($existingImages, function($img) use ($imageToRemove) {
                        return $img !== $imageToRemove;
                    }));
                }
            }
        }

        // Add new images (check for duplicates first)
        $duplicatesSkipped = 0;
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                // Check for duplicates within existing images
                $duplicatePath = $this->isDuplicateImage($image, $existingImages);
                if ($duplicatePath) {
                    $duplicatesSkipped++;
                    continue; // Skip this duplicate
                }
                
                // Check for duplicates within the new upload batch
                $duplicateInBatch = false;
                foreach ($existingImages as $existingPath) {
                    if (Storage::disk('public')->exists($existingPath)) {
                        $existingHash = md5_file(Storage::disk('public')->path($existingPath));
                        $newHash = md5_file($image->getRealPath());
                        if ($existingHash === $newHash) {
                            $duplicateInBatch = true;
                            $duplicatesSkipped++;
                            break;
                        }
                    }
                }
                
                if (!$duplicateInBatch) {
                    $existingImages[] = $this->storeImage($image, $existingImages);
                }
            }
        }

        // Ensure at least one image exists
        if (empty($existingImages)) {
            return redirect()->back()->withErrors(['images' => 'A gift must have at least one image.'])->withInput();
        }

        // Delete images from storage that are no longer needed
        foreach ($imagesToDelete as $imagePath) {
            try {
                if (Storage::disk('public')->exists($imagePath)) {
                    Storage::disk('public')->delete($imagePath);
                }
            } catch (\Exception $e) {
                // Log error but continue
                \Log::warning("Failed to delete image: {$imagePath}", ['error' => $e->getMessage()]);
            }
        }

        $data['image'] = array_values(array_unique($existingImages)); // Remove any duplicate paths
        $gift->update($data);
        
        $message = 'Gift updated successfully.';
        if ($duplicatesSkipped > 0) {
            $message .= " {$duplicatesSkipped} duplicate image(s) skipped.";
        }
        
        return redirect()->route('admin.gifts.index')->with('status', $message);
    }

    public function destroy(Gift $gift)
    {
        // Delete associated images only if not used by other gifts
        $images = is_array($gift->image) ? $gift->image : (is_string($gift->image) && $gift->image ? [$gift->image] : []);
        
        foreach ($images as $image) {
            // Check if this image is used by other gifts before deleting
            // Only delete if not used elsewhere
            if (!$this->isImageUsedElsewhere($image, $gift->id) && Storage::disk('public')->exists($image)) {
                try {
                    Storage::disk('public')->delete($image);
                } catch (\Exception $e) {
                    // Log error but continue
                    \Log::warning("Failed to delete image: {$image}", ['error' => $e->getMessage()]);
                }
            }
        }
        
        $gift->delete();
        return redirect()->route('admin.gifts.index')->with('status', 'Gift deleted successfully.');
    }
}
