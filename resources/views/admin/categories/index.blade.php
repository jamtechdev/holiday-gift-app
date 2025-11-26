@extends('layouts.admin')

@section('title', 'Gift Labels')
@section('page-title', 'Gift Labels')

@section('admin-content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <h3 style="color: #fff; margin: 0; font-size: 1.8rem; text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);">All Gift Labels</h3>
    <a href="{{ route('admin.categories.create') }}" class="admin-btn">Add Gift Label</a>
</div>

@if($categories->count() > 0)
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 1.5rem;">
        @foreach($categories as $category)
            <div class="gift-card">
                <div class="gift-image">
                    @if($category->image)
                        <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                    @else
                        <div class="gift-no-image">🏷️</div>
                    @endif
                </div>
                <div class="gift-content">
                    <div class="gift-title">{{ $category->name }}</div>
                </div>
                <div class="gift-actions">
                    <a href="{{ route('admin.categories.edit', $category) }}" class="admin-btn-sm">Edit</a>
                    <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="admin-btn-sm admin-btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="card" style="text-align: center; padding: 4rem 2rem;">
        <div style="font-size: 4rem; margin-bottom: 1rem; opacity: 0.3;">🏷️</div>
        <h4 style="color: #374151; margin-bottom: 0.5rem;">No gift labels found</h4>
        <p style="color: #6b7280; margin-bottom: 2rem;">Start by creating your first gift label</p>
        <a href="{{ route('admin.categories.create') }}" class="admin-btn">Create First Gift Label</a>
    </div>
@endif
@endsection