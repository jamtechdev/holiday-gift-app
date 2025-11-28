@extends('layouts.admin')

@section('title', 'Gift Requests')
@section('page-title', 'Gift Requests')

@section('admin-content')
<div class="card admin-user-toolbar">
    <div>
        <h3 style="margin-bottom: 0.25rem;">Gift Requests</h3>
        <p class="admin-list-text" style="margin: 0;">Review every submission and keep fulfillment on track.</p>
    </div>
    <div class="toolbar-actions gift-filter-toolbar">
        <form method="GET" action="{{ route('admin.gift-requests.index') }}" class="gift-filter-form">
            <label class="gift-filter-label" for="gift-category-filter">Category</label>
            <select id="gift-category-filter" name="category" class="gift-filter-select" onchange="this.form.submit()">
                <option value="">All Categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ (string)$category->id === (string)($selectedCategory ?? '') ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @if($selectedCategory)
                <a href="{{ route('admin.gift-requests.index') }}" class="admin-btn-sm">Clear</a>
            @endif
        </form>
        <a href="{{ route('admin.gift-requests.export', ['category' => $selectedCategory]) }}" class="admin-btn">Export</a>
    </div>
</div>

@if(session('status'))
    <div style="margin-bottom: 1.5rem; padding: 1rem; background: #d1fae5; color: #065f46; border-radius: 12px; border: 1px solid #a7f3d0;">
        {{ session('status') }}
    </div>
@endif

@if($requests->count() > 0)
    <div class="card" style="padding: 0; overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="border-bottom: 2px solid #e5e7eb;">
                    <th class="table-head-cell">Name</th>
                    <th class="table-head-cell">Email</th>
                    <th class="table-head-cell">Category</th>
                    <th class="table-head-cell">Street Address</th>
                    <th class="table-head-cell">Location</th>
                    <th class="table-head-cell">Company</th>
                    <th class="table-head-cell">Submitted</th>
                    <th class="table-head-cell">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($requests as $request)
                    <tr style="border-bottom: 1px solid #f3f4f6;">
                        <td class="table-cell">{{ $request->name }}</td>
                        <td class="table-cell muted-text">{{ $request->email }}</td>
                        <td class="table-cell">
                            <span class="category-badge">{{ $request->category->name ?? 'Uncategorized' }}</span>
                        </td>
                        <td class="table-cell muted-text">
                            {{ $request->street_address ?? '—' }}
                        </td>
                        <td class="table-cell muted-text">
                            {{ $request->city }}, {{ $request->state }} {{ $request->zip }}
                        </td>
                        <td class="table-cell muted-text">
                            {{ $request->company ?? '—' }}
                        </td>
                        <td class="table-cell muted-text">
                            {{ $request->created_at?->format('M d, Y') }}
                        </td>
                        <td class="table-cell">
                            <div class="table-actions">
                                <a href="{{ route('admin.gift-requests.show', $request) }}" class="admin-btn-sm">View</a>
                                <form method="POST" action="{{ route('admin.gift-requests.destroy', $request) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="admin-btn-sm admin-btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @include('partials.admin.pagination', [
        'paginator' => $requests,
        'itemLabel' => 'gift requests',
        'range' => 1
    ])
@else
    <div class="card" style="text-align: center; padding: 4rem 2rem;">
        <div style="font-size: 4rem; margin-bottom: 1rem; opacity: 0.3;">📋</div>
        <h4 style="color: #374151; margin-bottom: 0.5rem;">No gift requests found</h4>
        <p style="color: #6b7280;">Gift requests will appear here when users submit them</p>
    </div>
@endif
@endsection