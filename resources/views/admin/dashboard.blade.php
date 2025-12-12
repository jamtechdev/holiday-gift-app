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
        <div class="table-scroll-container" style="padding: 0; max-height: 500px;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="border-bottom: 2px solid #e5e7eb;">
                        <th class="table-head-cell">Name</th>
                        <th class="table-head-cell">Email</th>
                        <th class="table-head-cell">Gift Label</th>
                        <th class="table-head-cell">Location</th>
                        <th class="table-head-cell">Date</th>
                        <th class="table-head-cell">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($stats['recent_requests'] as $request)
                        <tr style="border-bottom: 1px solid #e5e7eb; background-color: #ffffff;">
                            <td class="table-cell">{{ $request->name }} {{ $request->lastname ?? '' }}</td>
                            <td class="table-cell muted-text">{{ $request->email }}</td>
                            <td class="table-cell">
                                <span class="category-badge">{{ $request->category->name ?? 'Uncategorized' }}</span>
                            </td>
                            <td class="table-cell muted-text">
                                {{ $request->city }}{{ $request->city && $request->state ? ',' : '' }} {{ $request->state }}
                                @if($request->country)
                                    <br><small style="color: #9ca3af;">{{ $request->country }}</small>
                                @endif
                            </td>
                            <td class="table-cell muted-text">{{ $request->created_at->format('M d, Y') }}</td>
                            <td class="table-cell">
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