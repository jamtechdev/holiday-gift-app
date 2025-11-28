@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('admin-content')
<div class="stats-grid">
    <a href="{{ route('admin.users.index') }}" class="stat-card">
        <div class="stat-card-content">
            <div class="text-3xl font-bold mb-2 stat-card-value">{{ number_format($stats['total_users']) }}</div>
            <div class="text-sm tracking-wider uppercase stat-card-label">Total Users</div>
        </div>
        <div class="stat-card-icon">👥</div>
    </a>
    <a href="{{ route('admin.categories.index') }}" class="stat-card">
        <div class="stat-card-content">
            <div class="text-3xl font-bold mb-2 stat-card-value">{{ number_format($stats['total_categories']) }}</div>
            <div class="text-sm tracking-wider uppercase stat-card-label">Gift Labels</div>
        </div>
        <div class="stat-card-icon">📂</div>
    </a>
    <a href="{{ route('admin.gifts.index') }}" class="stat-card">
        <div class="stat-card-content">
            <div class="text-3xl font-bold mb-2 stat-card-value">{{ number_format($stats['total_gifts']) }}</div>
            <div class="text-sm tracking-wider uppercase stat-card-label">Active Gifts</div>
        </div>
        <div class="stat-card-icon">🎁</div>
    </a>
    <a href="{{ route('admin.gift-requests.index') }}" class="stat-card">
        <div class="stat-card-content">
            <div class="text-3xl font-bold mb-2 stat-card-value">{{ number_format($stats['recent_requests']->count()) }}</div>
            <div class="text-sm tracking-wider uppercase stat-card-label">Gift Requests</div>
        </div>
        <div class="stat-card-icon">📋</div>
    </a>
</div>

<div class="card" style="margin-top: 2rem;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <h3>Recent Gift Requests</h3>
        <a href="{{ route('admin.gift-requests.index') }}" class="admin-btn-sm">View All</a>
    </div>
    
    @if($stats['recent_requests']->count() > 0)
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="border-bottom: 2px solid #e5e7eb;">
                        <th style="padding: 0.75rem; text-align: left; font-weight: 600; color: #374151;">Name</th>
                        <th style="padding: 0.75rem; text-align: left; font-weight: 600; color: #374151;">Email</th>
                        <th style="padding: 0.75rem; text-align: left; font-weight: 600; color: #374151;">Gift Label</th>
                        <th style="padding: 0.75rem; text-align: left; font-weight: 600; color: #374151;">Location</th>
                        <th style="padding: 0.75rem; text-align: left; font-weight: 600; color: #374151;">Date</th>
                        <th style="padding: 0.75rem; text-align: left; font-weight: 600; color: #374151;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($stats['recent_requests'] as $request)
                        <tr style="border-bottom: 1px solid #f3f4f6;">
                            <td style="padding: 0.75rem; color: #111827;">{{ $request->name }}</td>
                            <td style="padding: 0.75rem; color: #6b7280;">{{ $request->email }}</td>
                            <td style="padding: 0.75rem;">
                                <span class="category-badge">{{ $request->category->name }}</span>
                            </td>
                            <td style="padding: 0.75rem; color: #6b7280;">{{ $request->city }}, {{ $request->state }}</td>
                            <td style="padding: 0.75rem; color: #6b7280;">{{ $request->created_at->format('M d, Y') }}</td>
                            <td style="padding: 0.75rem;">
                                <a href="{{ route('admin.gift-requests.show', $request) }}" class="admin-btn-sm">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div style="text-align: center; padding: 2rem; color: #6b7280;">
            <div style="font-size: 2rem; margin-bottom: 0.5rem;">📋</div>
            <p>No gift requests yet</p>
        </div>
    @endif
</div>
@endsection