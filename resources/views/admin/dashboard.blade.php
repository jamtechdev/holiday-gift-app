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
            <div class="text-sm tracking-wider uppercase stat-card-label">Gift Types</div>
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
</div>
@endsection