@extends('layouts.admin')

@section('title', 'Users')
@section('page-title', 'Users')

@section('admin-content')
<div class="card">
    <div class="flex justify-between items-center mb-6">
        <h3>All Users</h3>
        <div class="flex gap-2">
            <button onclick="openExportModal()" class="admin-btn-sm">Export</button>
            <button onclick="openImportModal()" class="admin-btn-sm">Import</button>
            <a href="{{ route('admin.users.create') }}" class="admin-btn">Add User</a>
        </div>
    </div>

    @foreach($users->where('is_admin', false) as $user)
        <div class="admin-list-row">
            <div class="admin-list-main">
                <div class="admin-list-title">{{ $user->name }}</div>
                <div class="admin-list-text">{{ $user->email }}</div>
                <div class="admin-list-meta">Regular User</div>
            </div>
            <div class="admin-list-actions">
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

@endsection