@extends('layouts.admin')

@section('title', 'Add Gift')
@section('page-title', 'Add Gift')

@section('admin-content')
<div class="bg-gradient-to-br from-white via-slate-50 to-slate-200 rounded-3xl p-7 shadow-2xl border border-slate-300">
    <form method="POST" action="{{ route('admin.gifts.store') }}" enctype="multipart/form-data">
        @csrf
        
        <div class="mb-4">
            <input type="text" name="name" class="w-full px-4 py-3 rounded-xl bg-white/90 border border-slate-300 text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent" placeholder="Gift Name" value="{{ old('name') }}" required>
            @error('name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="mb-4">
            <textarea name="summary" class="w-full px-4 py-3 rounded-xl bg-white/90 border border-slate-300 text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent" placeholder="Summary (optional)" rows="3">{{ old('summary') }}</textarea>
            @error('summary')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="mb-4">
            <select name="category_id" class="w-full px-4 py-3 rounded-xl bg-white/90 border border-slate-300 text-gray-900 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent" required>
                <option value="">Select Category</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="mb-4">
            <input type="file" name="image" class="w-full px-4 py-3 rounded-xl bg-white/90 border border-slate-300 text-gray-900 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent" accept="image/*" required>
            @error('image')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        
        <button type="submit" class="w-full px-6 py-3 rounded-full bg-gradient-to-r from-pink-500 to-rose-500 text-white font-semibold text-sm uppercase tracking-wider shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2">Create Gift</button>
    </form>
</div>
@endsection