@extends('layouts.admin')

@section('title', 'Users')
@section('page-title', 'Users')
@php use Illuminate\Support\Str; @endphp

@section('admin-content')
<div class="card admin-user-toolbar">
    <div>
        <h3 style="margin-bottom: 0.25rem;">All Users</h3>
        <p class="admin-list-text" style="margin: 0;">Manage recipients and admins in one place.</p>
    </div>
    <div class="toolbar-actions">
        <button onclick="openExportModal()" class="admin-btn-sm">Export</button>
        <button onclick="openImportModal()" class="admin-btn-sm">Import</button>
        <a href="{{ route('admin.users.create') }}" class="admin-btn">Add User</a>
    </div>
</div>

@if(session('status'))
<div style="margin-bottom: 1.5rem; padding: 1rem; background: #d1fae5; color: #065f46; border-radius: 12px; border: 1px solid #a7f3d0;">
    {{ session('status') }}
</div>
@endif

@if($users->count() > 0)
<div class="gift-grid-wrapper">
    <div class="gift-grid gift-grid-4">
        @foreach($users as $user)
        <div class="gift-card user-card">
            <div class="user-card-header">
                <div class="user-avatar">{{ strtoupper(Str::substr($user->name, 0, 1)) }}</div>
                <div>
                    <div class="gift-title">{{ $user->name }}</div>
                    <div class="user-email">{{ $user->email }}</div>
                </div>
            </div>
            <div class="user-meta">
                <span class="category-badge">{{ ucfirst($user->role) }}</span>
                <span class="user-created">Joined {{ $user->created_at?->format('M d, Y') }}</span>
            </div>
            <div class="gift-actions">
                <a href="{{ route('admin.users.edit', $user) }}" class="admin-btn-sm">Edit</a>
                <form method="POST" action="{{ route('admin.users.destroy', $user) }}" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="admin-btn-sm admin-btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>

    @include('partials.admin.pagination', [
    'paginator' => $users,
    'itemLabel' => 'users'
    ])
</div>
@else
<div class="card" style="text-align: center; padding: 4rem 2rem;">
    <div style="font-size: 4rem; margin-bottom: 1rem; opacity: 0.3;">👥</div>
    <h4 style="color: #374151; margin-bottom: 0.5rem;">No users found</h4>
    <p style="color: #6b7280; margin-bottom: 2rem;">Start by creating your first user</p>
    <a href="{{ route('admin.users.create') }}" class="admin-btn">Create First User</a>
</div>
@endif

<!-- Export Modal -->
<div id="exportModal" class="modal-overlay" style="display: none;">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Export Users</h3>
            <button onclick="closeExportModal()" class="modal-close">&times;</button>
        </div>
        <div class="modal-body">
            <div class="import-info">
                <p><strong>Export Format:</strong> Excel (.xlsx)</p>
                <p><strong>Includes:</strong> Name, Email, Password (blank)</p>
                <p><strong>Users:</strong> All users (admin and regular)</p>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" onclick="closeExportModal()" class="admin-btn-sm">Cancel</button>
            <a href="{{ route('admin.users.export') }}" class="admin-btn">Download Excel</a>
        </div>
    </div>
</div>

<!-- Import Modal -->
<div id="importModal" class="modal-overlay" style="display: none;">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Import Users</h3>
            <button onclick="closeImportModal()" class="modal-close">&times;</button>
        </div>
        <form method="POST" action="{{ route('admin.users.import.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Select Excel File</label>
                    <input type="file" name="file" class="form-input" accept=".xlsx,.xls,.csv" required>
                </div>
                <div class="import-info">
                    <p><strong>Format:</strong> Name, Email, Password columns</p>
                    <p><strong>Default password:</strong> password123 (if Password column is blank)</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="closeImportModal()" class="admin-btn-sm">Cancel</button>
                <button type="submit" class="admin-btn">Import</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function openExportModal() {
        document.getElementById('exportModal').style.display = 'flex';
    }

    function closeExportModal() {
        document.getElementById('exportModal').style.display = 'none';
    }

    function openImportModal() {
        document.getElementById('importModal').style.display = 'flex';
    }

    function closeImportModal() {
        document.getElementById('importModal').style.display = 'none';
    }
</script>
@endpush

@endsection