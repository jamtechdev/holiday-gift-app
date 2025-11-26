@extends('layouts.admin')

@section('title', 'Gift Requests')
@section('page-title', 'Gift Requests')

@section('admin-content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <h3 style="color: #fff; margin: 0; font-size: 1.8rem; text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);">Gift Requests</h3>
</div>

@if(session('status'))
    <div style="margin-bottom: 1.5rem; padding: 1rem; background: #d1fae5; color: #065f46; border-radius: 12px; border: 1px solid #a7f3d0;">
        {{ session('status') }}
    </div>
@endif

@if($requests->count() > 0)
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(350px, 1fr)); gap: 1.5rem;">
        @foreach($requests as $request)
            <div class="gift-card">
                <div class="gift-content">
                    <div class="gift-title">{{ $request->name }}</div>
                    <div style="margin: 0.5rem 0;">
                        <span class="category-badge">{{ $request->category->name }}</span>
                        <span style="background: 
                            @if($request->status === 'pending') #fbbf24
                            @elseif($request->status === 'approved') #3b82f6
                            @elseif($request->status === 'shipped') #8b5cf6
                            @else #10b981 @endif; 
                            color: white; padding: 0.25rem 0.75rem; border-radius: 12px; font-size: 0.75rem; margin-left: 0.5rem;">
                            {{ ucfirst($request->status) }}
                        </span>
                    </div>
                    <div style="font-size: 0.9rem; color: #6b7280; margin: 0.5rem 0;">
                        <div>{{ $request->email }}</div>
                        <div>{{ $request->city }}, {{ $request->state }} {{ $request->zip }}</div>
                        @if($request->company)
                            <div>{{ $request->company }}</div>
                        @endif
                    </div>
                </div>
                <div class="gift-actions">
                    <a href="{{ route('admin.gift-requests.show', $request) }}" class="admin-btn-sm">View</a>
                    <form method="POST" action="{{ route('admin.gift-requests.destroy', $request) }}" style="display: inline;">
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
        <div style="font-size: 4rem; margin-bottom: 1rem; opacity: 0.3;">📋</div>
        <h4 style="color: #374151; margin-bottom: 0.5rem;">No gift requests found</h4>
        <p style="color: #6b7280;">Gift requests will appear here when users submit them</p>
    </div>
@endif
@endsection