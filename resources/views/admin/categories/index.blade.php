@extends('layouts.admin')

@section('title', 'Gift Labels')
@section('page-title', 'Gift Labels')

@section('admin-content')
<div class="card admin-user-toolbar">
    <div>
        <h3 style="margin-bottom: 0.25rem;">All Gift Labels</h3>
        <p class="admin-list-text" style="margin: 0;">Keep the catalog organized with curated labels.</p>
    </div>
    <div class="toolbar-actions">
        <a href="{{ route('admin.categories.create') }}" class="admin-btn">Add Gift Label</a>
    </div>
</div>

@if($categories->count() > 0)
    <div class="gift-grid-wrapper">
        <div class="gift-grid gift-grid-4">
            @foreach($categories as $category)
                <div class="gift-card">
                    <div class="gift-image">
                        @if($category->image)
                            <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}">
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

        @include('partials.admin.pagination', [
            'paginator' => $categories,
            'itemLabel' => 'gift labels'
        ])
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