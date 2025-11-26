@extends('layouts.admin')

@section('title', 'Gifts')
@section('page-title', 'Gifts')

@section('admin-content')
<div class="flex flex-col h-full overflow-hidden">
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-xl font-semibold text-gray-900 tracking-wider uppercase">All Gifts</h3>
        <a href="{{ route('admin.gifts.create') }}" class="px-6 py-2.5 rounded-full bg-gradient-to-r from-pink-500 to-rose-500 text-white font-semibold text-sm uppercase tracking-wider shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2">
            Add Gift
        </a>
    </div>

    @if(session('status'))
        <div class="mb-4 p-4 bg-emerald-100 text-emerald-800 rounded-xl border border-emerald-300">
            {{ session('status') }}
        </div>
    @endif

    @if($gifts->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 flex-1 overflow-y-auto">
            @foreach($gifts as $gift)
                <div class="bg-gradient-to-br from-white via-slate-50 to-slate-200 rounded-3xl p-6 shadow-2xl border border-slate-300 flex flex-col">
                    @if($gift->image_path)
                        <div class="mb-4 rounded-2xl overflow-hidden">
                            <img src="{{ asset('storage/' . $gift->image_path) }}" 
                                 alt="{{ $gift->name }}" 
                                 class="w-full h-48 object-cover">
                        </div>
                    @else
                        <div class="mb-4 rounded-2xl overflow-hidden bg-slate-200 h-48 flex items-center justify-center">
                            <span class="text-gray-400 text-sm">No Image</span>
                        </div>
                    @endif
                    
                    <div class="flex-1">
                        <h4 class="text-lg font-semibold text-gray-900 mb-2">{{ $gift->name }}</h4>
                        
                        @if($gift->summary)
                            <p class="text-sm text-gray-600 mb-3 line-clamp-2">{{ $gift->summary }}</p>
                        @endif
                        
                        <div class="mb-4">
                            <span class="inline-block px-3 py-1 rounded-full text-xs font-medium" 
                                  style="background-color: {{ $gift->category->accent_color ?? '#e5e7eb' }}20; color: {{ $gift->category->accent_color ?? '#4b5563' }};">
                                {{ $gift->category->name }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="flex gap-2 mt-4 pt-4 border-t border-slate-300">
                        <a href="{{ route('admin.gifts.edit', $gift) }}" 
                           class="flex-1 px-4 py-2 text-center rounded-lg bg-blue-500 text-white text-sm font-semibold hover:bg-blue-600 transition-colors">
                            Edit
                        </a>
                        <form method="POST" action="{{ route('admin.gifts.destroy', $gift) }}" class="flex-1" onsubmit="return confirm('Are you sure you want to delete this gift?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full px-4 py-2 rounded-lg bg-red-500 text-white text-sm font-semibold hover:bg-red-600 transition-colors">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="flex-1 flex items-center justify-center">
            <div class="text-center">
                <p class="text-gray-500 text-lg mb-4">No gifts found</p>
                <a href="{{ route('admin.gifts.create') }}" class="inline-block px-6 py-3 rounded-full bg-gradient-to-r from-pink-500 to-rose-500 text-white font-semibold text-sm uppercase tracking-wider shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                    Create First Gift
                </a>
            </div>
        </div>
    @endif
</div>
@endsection