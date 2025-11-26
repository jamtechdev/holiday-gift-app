@extends('layouts.admin')

@section('title', 'Gift Labels')
@section('page-title', 'Gift Labels')

@section('admin-content')
<div class="card">
    <div class="flex justify-between items-center mb-6">
        <h3>All Gift Labels</h3>
        <a href="{{ route('admin.categories.create') }}" class="admin-btn">Add Gift Label</a>
    </div>

    @foreach($categories as $category)
        <div class="admin-list-row">
            <div class="admin-list-main">
                <div class="admin-list-title">{{ $category->name }}</div>
                <div class="admin-list-text">
                    @if($category->image)
                        <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" style="max-width: 50px; height: auto;">
                    @else
                        No image
                    @endif
                </div>
            </div>
            <div class="admin-list-actions">
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
@endsection