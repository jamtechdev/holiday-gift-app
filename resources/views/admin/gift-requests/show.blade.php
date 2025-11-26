@extends('layouts.admin')

@section('title', 'Gift Request Details')
@section('page-title', 'Gift Request Details')

@section('admin-content')
<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <h3>Request Details</h3>
        <a href="{{ route('admin.gift-requests.index') }}" class="admin-btn-sm">Back to List</a>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
        <div>
            <h4 style="margin-bottom: 1rem; color: #111827;">Personal Information</h4>
            <div style="margin-bottom: 0.75rem; color: #374151;"><strong style="color: #111827;">Name:</strong> {{ $userGiftRequest->name }}</div>
            <div style="margin-bottom: 0.75rem; color: #374151;"><strong style="color: #111827;">Email:</strong> {{ $userGiftRequest->email }}</div>
            <div style="margin-bottom: 0.75rem; color: #374151;"><strong style="color: #111827;">Phone:</strong> {{ $userGiftRequest->telephone }}</div>
            @if($userGiftRequest->company)
                <div style="margin-bottom: 0.75rem; color: #374151;"><strong style="color: #111827;">Company:</strong> {{ $userGiftRequest->company }}</div>
            @endif
        </div>
        
        <div>
            <h4 style="margin-bottom: 1rem; color: #111827;">Address</h4>
            <div style="margin-bottom: 0.75rem; color: #374151;"><strong style="color: #111827;">Street:</strong> {{ $userGiftRequest->street_address }}</div>
            <div style="margin-bottom: 0.75rem; color: #374151;"><strong style="color: #111827;">City:</strong> {{ $userGiftRequest->city }}</div>
            <div style="margin-bottom: 0.75rem; color: #374151;"><strong style="color: #111827;">State:</strong> {{ $userGiftRequest->state }}</div>
            <div style="margin-bottom: 0.75rem; color: #374151;"><strong style="color: #111827;">ZIP:</strong> {{ $userGiftRequest->zip }}</div>
        </div>
    </div>

    <div style="margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid #e5e7eb;">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div style="display: flex; align-items: center; gap: 1rem;">
                @if($userGiftRequest->category->image)
                    <img src="{{ asset('storage/' . $userGiftRequest->category->image) }}" alt="{{ $userGiftRequest->category->name }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px; border: 1px solid #d1d5db;">
                @endif
                <div>
                    <span class="category-badge">{{ $userGiftRequest->category->name }}</span>
                    <div style="font-size: 0.9rem; color: #374151; margin-top: 0.25rem;">
                        Requested on {{ $userGiftRequest->created_at->format('M d, Y') }}
                    </div>
                </div>
            </div>
            
            <form method="POST" action="{{ route('admin.gift-requests.update-status', $userGiftRequest) }}" style="display: flex; gap: 0.5rem; align-items: center;">
                @csrf
                @method('PATCH')
                <select name="status" class="form-input" style="width: auto; padding: 0.5rem;">
                    <option value="pending" {{ $userGiftRequest->status === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="approved" {{ $userGiftRequest->status === 'approved' ? 'selected' : '' }}>Approved</option>
                    <option value="shipped" {{ $userGiftRequest->status === 'shipped' ? 'selected' : '' }}>Shipped</option>
                    <option value="delivered" {{ $userGiftRequest->status === 'delivered' ? 'selected' : '' }}>Delivered</option>
                </select>
                <button type="submit" class="admin-btn-sm">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection