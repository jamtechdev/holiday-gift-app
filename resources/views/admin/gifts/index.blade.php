@extends('layouts.admin')

@section('title', 'Gifts')
@section('page-title', 'Gifts')

@section('admin-content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <h3 style="color: #fff; margin: 0; font-size: 1.8rem; text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);">All Gifts</h3>
    <a href="{{ route('admin.gifts.create') }}" class="admin-btn">Add Gift</a>
</div>

@if(session('status'))
    <div style="margin-bottom: 1.5rem; padding: 1rem; background: #d1fae5; color: #065f46; border-radius: 12px; border: 1px solid #a7f3d0;">
        {{ session('status') }}
    </div>
@endif

@if($gifts->count() > 0)
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 1.5rem;">
        @foreach($gifts as $gift)
            <div class="gift-card">
                <div class="gift-image">
                    @if($gift->image)
                        <img src="{{ asset('storage/' . $gift->image) }}" alt="{{ $gift->name }}">
                    @else
                        <div class="gift-no-image">🎁</div>
                    @endif
                </div>
                <div class="gift-content">
                    <div class="gift-title">{{ $gift->name }}</div>
                    <div class="gift-category">
                        <span class="category-badge">{{ $gift->category->name }}</span>
                    </div>
                </div>
                <div class="gift-actions">
                    <a href="{{ route('admin.gifts.edit', $gift) }}" class="admin-btn-sm">Edit</a>
                    <form method="POST" action="{{ route('admin.gifts.destroy', $gift) }}" style="display: inline;">
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
        <div style="font-size: 4rem; margin-bottom: 1rem; opacity: 0.3;">🎁</div>
        <h4 style="color: #374151; margin-bottom: 0.5rem;">No gifts found</h4>
        <p style="color: #6b7280; margin-bottom: 2rem;">Start by creating your first gift</p>
        <a href="{{ route('admin.gifts.create') }}" class="admin-btn">Create First Gift</a>
    </div>
@endif
@endsection