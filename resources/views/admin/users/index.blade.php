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
                <p><strong>Includes:</strong> Customer, First Name, Last Name, Email, Password (blank), Street Address, Apt., Suite, Unit, City, State, Zip</p>
                <p><strong>Users:</strong> All users (admin and regular)</p>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" onclick="closeExportModal()" class="admin-btn-sm">Cancel</button>
            <a href="{{ route('admin.users.export') }}" class="admin-btn" onclick="handleExportClick(event)">Download Excel</a>
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
        <form id="importForm" method="POST" action="{{ route('admin.users.import.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Select Excel File</label>
                    <input type="file" name="file" class="form-input" accept=".xlsx,.xls,.csv" required>
                </div>
                <div class="import-info">
                    <p><strong>Format:</strong> Customer (or First Name/Last Name), Email, Password, Street Address, Apt., Suite, Unit, City, State, Zip</p>
                    <p><strong>Required:</strong> Email (must be unique)</p>
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

    function handleExportClick(event) {
        // Close modal immediately when export link is clicked
        closeExportModal();
        // Let the default download action proceed
        // The download will happen automatically
    }

    // Handle import form submission with AJAX to show errors
    document.addEventListener('DOMContentLoaded', function() {
        const importForm = document.getElementById('importForm');
        if (importForm) {
            importForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const formData = new FormData(this);
                const submitButton = this.querySelector('button[type="submit"]');
                const originalText = submitButton.textContent;
                
                // Disable submit button
                submitButton.disabled = true;
                submitButton.textContent = 'Importing...';
                
                fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                    }
                })
                .then(async response => {
                    const contentType = response.headers.get('content-type');
                    
                    // Check if response is JSON
                    if (contentType && contentType.includes('application/json')) {
                        const data = await response.json();
                        if (response.ok && data.success) {
                            // Success
                            closeImportModal();
                            if (typeof toastr !== 'undefined') {
                                toastr.success(data.message || 'Users imported successfully!');
                            }
                            setTimeout(() => {
                                window.location.reload();
                            }, 1000);
                        } else {
                            // Error response
                            const errorMessage = data.message || 'Failed to import users. Please check the file format and try again.';
                            if (typeof toastr !== 'undefined') {
                                // Handle HTML in error message (from validation failures)
                                if (errorMessage.includes('<br>')) {
                                    toastr.error(errorMessage, '', { escapeHtml: false });
                                } else {
                                    toastr.error(errorMessage);
                                }
                            }
                            submitButton.disabled = false;
                            submitButton.textContent = originalText;
                        }
                    } else {
                        // Handle redirect or HTML response
                        if (response.redirected || response.status === 302) {
                            // Success - redirect
                            closeImportModal();
                            if (typeof toastr !== 'undefined') {
                                toastr.success('Users imported successfully!');
                            }
                            setTimeout(() => {
                                window.location.href = response.url || window.location.href;
                            }, 500);
                        } else {
                            // Error - try to get error message
                            const text = await response.text();
                            const errorMessage = text || 'Failed to import users. Please check the file format and try again.';
                            if (typeof toastr !== 'undefined') {
                                toastr.error(errorMessage);
                            }
                            submitButton.disabled = false;
                            submitButton.textContent = originalText;
                        }
                    }
                })
                .catch(error => {
                    console.error('Import error:', error);
                    if (typeof toastr !== 'undefined') {
                        toastr.error(error.message || 'Failed to import users. Please check the file format and try again.');
                    }
                    submitButton.disabled = false;
                    submitButton.textContent = originalText;
                });
            });
        }
    });
</script>
@endpush

@endsection