@extends('layouts.admin')

@section('title', 'Gift Request Details')
@section('page-title', 'Gift Request Details')

@section('admin-content')
<div class="detail-page-container">
    <div class="card detail-meta-card">
        <div class="detail-header">
            <div>
                <p class="detail-eyebrow">Request #{{ $userGiftRequest->id }}</p>
                <h3 class="detail-title">{{ $userGiftRequest->name }}</h3>
                <div class="detail-meta">
                    Submitted on {{ $userGiftRequest->created_at->format('M d, Y \\a\\t h:i A') }}
                    · {{ $userGiftRequest->email }}
                </div>
            </div>
            <div class="detail-header-actions">
                <a href="{{ route('admin.gift-requests.index') }}" class="admin-btn-sm">Back to List</a>
            </div>
        </div>
    </div>

    <div class="detail-stats-grid">
        <div class="detail-stat-card">
            <p class="detail-stats-label">Category</p>
            <h4 class="detail-stats-value">{{ $userGiftRequest->category->name }}</h4>
            <span class="detail-stats-meta">Gift label selected</span>
        </div>
        <div class="detail-stat-card">
            <p class="detail-stats-label">Location</p>
            <h4 class="detail-stats-value">{{ $userGiftRequest->city }}, {{ $userGiftRequest->state }}</h4>
            <span class="detail-stats-meta">{{ $userGiftRequest->zip }}</span>
        </div>
        <div class="detail-stat-card">
            <p class="detail-stats-label">Submitted</p>
            <h4 class="detail-stats-value">{{ $userGiftRequest->created_at->format('M d, Y') }}</h4>
            <span class="detail-stats-meta">{{ $userGiftRequest->created_at->diffForHumans() }}</span>
        </div>
    </div>

    <div class="card request-detail-card">
        <div class="detail-grid">
            <div class="detail-section detail-section-span">
                <div class="detail-section-heading">Personal Information</div>
                <dl class="detail-list">
                    <div>
                        <dt>Email</dt>
                        <dd>{{ $userGiftRequest->email }}</dd>
                    </div>
                    <div>
                        <dt>Phone</dt>
                        <dd>{{ $userGiftRequest->telephone ?? '—' }}</dd>
                    </div>
                    <div>
                        <dt>Company</dt>
                        <dd>{{ $userGiftRequest->company ?? '—' }}</dd>
                    </div>
                </dl>
            </div>

            <div class="detail-section">
                <div class="detail-section-heading">Shipping Address</div>
                <dl class="detail-list">
                    <div>
                        <dt>Street</dt>
                        <dd>{{ $userGiftRequest->street_address }}</dd>
                    </div>
                    <div>
                        <dt>City</dt>
                        <dd>{{ $userGiftRequest->city }}</dd>
                    </div>
                    <div>
                        <dt>State · ZIP</dt>
                        <dd>{{ $userGiftRequest->state }} {{ $userGiftRequest->zip }}</dd>
                    </div>
                </dl>
            </div>

            <div class="detail-section detail-section-span">
                <div class="detail-section-heading">Gift Selection</div>
                <div class="detail-gift">
                    @if($userGiftRequest->category->image)
                        <img src="{{ asset('storage/' . $userGiftRequest->category->image) }}" alt="{{ $userGiftRequest->category->name }}">
                    @endif
                    <div>
                        <div class="detail-gift-label">{{ $userGiftRequest->category->name }}</div>
                        <p>Chosen category for this request.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection