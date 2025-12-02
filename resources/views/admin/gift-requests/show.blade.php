@extends('layouts.admin')

@section('title', 'Gift Request Details')
@section('page-title', 'Gift Request Details')

@section('admin-content')
<div class="detail-page-container">
    <div class="detail-header-section">
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

    <div class="detail-content-wrapper">
        <div class="detail-content-section">
            <div class="detail-group">
                <div class="detail-group-heading">Personal Information</div>
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

            <div class="detail-group">
                <div class="detail-group-heading">Shipping Address</div>
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
        </div>

        <div class="detail-sidebar-section">
            <div class="gift-info-card">
                <div class="gift-info-header">
                    <div class="gift-info-title">Gift Information</div>
                </div>
                <div class="gift-info-badges">
                    <div class="gift-badge-item">
                        <div class="gift-badge-label">Category</div>
                        @if($userGiftRequest->category)
                        <a href="{{ route('admin.categories.index') }}" class="gift-badge-link">
                            <div class="gift-badge">
                                @if($userGiftRequest->category->image)
                                    <img src="{{ asset('storage/' . $userGiftRequest->category->image) }}" alt="{{ $userGiftRequest->category->name }}" class="gift-badge-icon">
                                @endif
                                <span class="gift-badge-text">{{ $userGiftRequest->category->name }}</span>
                            </div>
                        </a>
                        @else
                        <div class="gift-badge">
                            <span class="gift-badge-text">Uncategorized</span>
                        </div>
                        @endif
                    </div>
                    @if($userGiftRequest->category && strtolower($userGiftRequest->category->name) === 'donation' && $userGiftRequest->charity_selection)
                    <div class="gift-badge-item">
                        <div class="gift-badge-label">Charity Selection</div>
                        @php
                            $charityLabels = [
                                'wildheart' => 'Wild Heart Ministries',
                                'lionheart' => 'Lion Heart Foundation',
                                'split' => 'Split 50% / 50%'
                            ];
                            $charityLabel = $charityLabels[$userGiftRequest->charity_selection] ?? ucfirst($userGiftRequest->charity_selection);
                            $charityLogo = null;
                            $charityLink = null;

                            if($userGiftRequest->charity_selection === 'lionheart') {
                                $charityLogo = asset('images/lionlogo.webp');
                                $charityLink = 'https://www.themicahparsons.com/givingback';
                            } elseif($userGiftRequest->charity_selection === 'wildheart') {
                                $charityLogo = asset('images/location.png');
                                $charityLink = 'https://www.wildheartministries.net/';
                            }
                        @endphp
                        @if($charityLink)
                        <a href="{{ $charityLink }}" target="_blank" class="gift-badge-link">
                            <div class="gift-badge">
                                @if($charityLogo)
                                    <img src="{{ $charityLogo }}" alt="{{ $charityLabel }}" class="gift-badge-icon">
                                @endif
                                <span class="gift-badge-text">{{ $charityLabel }}</span>
                            </div>
                        </a>
                        @else
                        <div class="gift-badge">
                            <span class="gift-badge-text">{{ $charityLabel }}</span>
                        </div>
                        @endif
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
    