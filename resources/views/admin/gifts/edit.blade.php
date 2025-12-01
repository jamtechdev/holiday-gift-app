@extends('layouts.admin')

@section('title', 'Edit Gift')
@section('page-title', 'Edit Gift')

@section('admin-content')
<div class="card">
    <form method="POST" action="{{ route('admin.gifts.update', $gift) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <select name="category_id" class="form-input" required>
                <option value="">Select Gift Label</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id', $gift->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')
                <p style="margin-top: 0.25rem; font-size: 0.875rem; color: #dc2626;">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="form-group">
            <input type="text" name="name" class="form-input" placeholder="Gift Name" value="{{ old('name', $gift->name) }}" required>
            @error('name')
                <p style="margin-top: 0.25rem; font-size: 0.875rem; color: #dc2626;">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="form-group">
            <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #374151;">Current Images</label>
            @php
                $images = is_array($gift->image) ? $gift->image : (is_string($gift->image) && $gift->image ? [$gift->image] : []);
            @endphp
            @if(count($images) > 0)
                <div style="display: flex; flex-wrap: wrap; gap: 1rem; margin-bottom: 1rem;">
                    @foreach($images as $img)
                        <div style="position: relative; display: inline-block;" id="image-{{ $loop->index }}">
                            <img src="{{ asset('storage/' . $img) }}" alt="{{ $gift->name }}" style="width: 128px; height: 128px; object-fit: cover; border-radius: 8px; border: 1px solid #d1d5db;" id="img-{{ $loop->index }}">
                            <label for="remove-{{ $loop->index }}" style="position: absolute; top: -8px; right: -8px; background: #dc2626; color: white; border-radius: 50%; width: 24px; height: 24px; display: flex; align-items: center; justify-content: center; cursor: pointer; font-size: 14px; font-weight: bold; transition: opacity 0.2s;">
                                ×
                            </label>
                            <input type="checkbox" name="remove_images[]" value="{{ $img }}" id="remove-{{ $loop->index }}" style="display: none;" onchange="document.getElementById('img-{{ $loop->index }}').style.opacity = this.checked ? '0.5' : '1'; document.getElementById('image-{{ $loop->index }}').querySelector('label').style.opacity = this.checked ? '0.5' : '1';">
                        </div>
                    @endforeach
                </div>
                <p style="margin-top: 0.25rem; font-size: 0.75rem; color: #6b7280; margin-bottom: 0.5rem;">Click × on images to mark them for removal</p>
            @else
                <p style="margin-top: 0.25rem; font-size: 0.75rem; color: #6b7280; margin-bottom: 0.5rem;">No images currently</p>
            @endif
            
            <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #374151;">Add New Images</label>
            <input type="file" name="images[]" class="form-input" accept="image/*" multiple>
            <p style="margin-top: 0.5rem; font-size: 0.75rem; color: #6b7280;">You can select multiple images. They will be added to existing images.</p>
            @error('images')
                <p style="margin-top: 0.25rem; font-size: 0.875rem; color: #dc2626;">{{ $message }}</p>
            @enderror
            @error('images.*')
                <p style="margin-top: 0.25rem; font-size: 0.875rem; color: #dc2626;">{{ $message }}</p>
            @enderror
        </div>
        
        <button type="submit" class="submit-btn">Update Gift</button>
    </form>
</div>
@endsection