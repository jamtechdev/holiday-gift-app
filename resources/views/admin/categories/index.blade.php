@extends('layouts.admin')

@section('title', 'Categories')
@section('page-title', 'Categories')

@section('admin-content')
<div class="card">
    <div class="flex justify-between items-center mb-4">
        <h3>All Categories</h3>
        <a href="{{ route('admin.categories.create') }}" class="next-btn">Add Category</a>
    </div>

    @foreach($categories as $category)
        <div class="admin-list-row">
            <div class="admin-list-main">
                <div class="admin-list-title">{{ $category->name }}</div>
                <div class="admin-list-text">{{ $category->description }}</div>
            </div>
            <div class="admin-list-actions">
                <a href="{{ route('admin.categories.edit', $category) }}" class="next-btn">Edit</a>
                <form method="POST" action="{{ route('admin.categories.destroy', $category) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="logout-btn">Delete</button>
                </form>
            </div>
        </div>
    @endforeach
</div>
@endsection