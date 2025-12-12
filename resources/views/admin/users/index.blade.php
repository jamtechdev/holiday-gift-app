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
    <div class="toolbar-actions gift-filter-toolbar">
        <form method="GET" action="{{ route('admin.users.index') }}" class="gift-filter-form" id="searchForm">
            <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Search by name, email, address..." class="gift-filter-search" id="searchInput" style="min-width: 280px; border-radius: 999px; padding: 0.5rem 1rem; border: 1px solid rgba(15, 23, 42, 0.15); background: rgba(255, 255, 255, 0.75); font-size: 0.9rem; color: #111827; transition: box-shadow 0.2s ease, border-color 0.2s ease;">
            @if($search ?? '')
                <a href="{{ route('admin.users.index') }}" class="admin-btn-sm" id="clearFiltersBtn" style="margin-left: 0.5rem; text-decoration: none;">Clear All</a>
            @endif
        </form>
        <div style="display: flex; gap: 0.5rem;">
            <button onclick="openExportModal()" class="admin-btn-sm">Export</button>
            <button onclick="openImportModal()" class="admin-btn-sm">Import</button>
            <a href="{{ route('admin.users.create') }}" class="admin-btn">Add User</a>
        </div>
    </div>
</div>

@if(session('status'))
<div style="margin-bottom: 1.5rem; padding: 1rem; background: #d1fae5; color: #065f46; border-radius: 12px; border: 1px solid #a7f3d0;">
    {{ session('status') }}
</div>
@endif

<div id="tableContainer" style="transition: opacity 0.3s ease; position: relative;">
    <div id="loadingIndicator" style="display: none; position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(255, 255, 255, 0.95); z-index: 10; padding: 4rem 2rem; border-radius: 24px; flex-direction: column; align-items: center; justify-content: center;">
        <div style="display: inline-block; width: 40px; height: 40px; border: 4px solid #f3f4f6; border-top-color: #f97373; border-radius: 50%; animation: spin 0.8s linear infinite;"></div>
        <p style="margin-top: 1rem; color: #6b7280; font-size: 0.9rem;">Searching...</p>
    </div>

    @include('admin.users.partials.table', ['users' => $users])
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
                <p><strong>Includes:</strong> Customer, First Name, Last Name, Email, Password (blank), Street Address, Apt., Suite, Unit, City, State, Zip</p>
                <p><strong>Users:</strong> All users (admin and regular){{ $search ? ' - Filtered by search' : '' }}</p>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" onclick="closeExportModal()" class="admin-btn-sm">Cancel</button>
            <a href="{{ route('admin.users.export', ['search' => $search ?? '']) }}" class="admin-btn" onclick="handleExportClick(event)">Download Excel</a>
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
                    <p><strong>Default password:</strong> Holiday2025 (if Password column is blank)</p>
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
    // Real-time search functionality
    (function() {
        let searchTimeout;
        const searchInput = document.getElementById('searchInput');
        const tableContainer = document.getElementById('tableContainer');
        let paginationContainer = document.getElementById('paginationContainer') || tableContainer?.querySelector('#paginationContainer');
        const loadingIndicator = document.getElementById('loadingIndicator');
        const clearFiltersBtn = document.getElementById('clearFiltersBtn');

        function updateClearButton() {
            const search = searchInput ? searchInput.value.trim() : '';
            const form = document.getElementById('searchForm');

            if (!form) return;

            let existingBtn = document.getElementById('clearFiltersBtn');

            if (search) {
                if (!existingBtn) {
                    const btn = document.createElement('a');
                    btn.href = '{{ route("admin.users.index") }}';
                    btn.className = 'admin-btn-sm';
                    btn.id = 'clearFiltersBtn';
                    btn.textContent = 'Clear All';
                    btn.style.marginLeft = '0.5rem';
                    btn.style.textDecoration = 'none';
                    form.appendChild(btn);
                }
            } else {
                if (existingBtn) {
                    existingBtn.remove();
                }
            }
        }

        function performSearch() {
            if (!searchInput || !tableContainer || !loadingIndicator || !paginationContainer) {
                return;
            }

            const search = searchInput.value.trim();

            // Update URL without reload - search will be empty when cleared, which is fine
            const params = new URLSearchParams();
            if (search) {
                params.set('search', search);
            }
            const queryString = params.toString();
            const newUrl = '{{ route("admin.users.index") }}' + (queryString ? '?' + queryString : '');
            window.history.pushState({}, '', newUrl);

            // Show loading
            tableContainer.classList.add('fade-out');
            loadingIndicator.style.display = 'flex';
            if (paginationContainer) {
                paginationContainer.style.display = 'none';
            }

            // Make AJAX request
            fetch(newUrl, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.html) {
                    tableContainer.innerHTML = data.html;
                    // Find pagination container inside the updated table
                    paginationContainer = tableContainer.querySelector('#paginationContainer');
                }
                if (data.pagination && paginationContainer) {
                    paginationContainer.innerHTML = data.pagination;
                }

                // Update clear button visibility
                updateClearButton();

                // Hide loading and show results
                loadingIndicator.style.display = 'none';
                tableContainer.classList.remove('fade-out');
                tableContainer.classList.add('fade-in');
                if (paginationContainer) {
                    paginationContainer.style.display = 'block';
                    paginationContainer.style.visibility = 'visible';
                    paginationContainer.style.opacity = '1';
                }
            })
            .catch(error => {
                console.error('Search error:', error);
                loadingIndicator.style.display = 'none';
                tableContainer.classList.remove('fade-out');
            });
        }

        // Debounced search on input - triggers on typing and deleting
        if (searchInput) {
            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(function() {
                    performSearch();
                    updateClearButton();
                }, 300);
            });

            // Also trigger on keyup to catch backspace/delete immediately
            searchInput.addEventListener('keyup', function(e) {
                // If backspace or delete is pressed, trigger search immediately after debounce
                if (e.key === 'Backspace' || e.key === 'Delete') {
                    clearTimeout(searchTimeout);
                    searchTimeout = setTimeout(function() {
                        performSearch();
                        updateClearButton();
                    }, 200);
                }
            });

            // Trigger search when input is cleared or pasted
            searchInput.addEventListener('paste', function() {
                clearTimeout(searchTimeout);
                setTimeout(function() {
                    performSearch();
                    updateClearButton();
                }, 100);
            });
        }

        // Handle clear button click - refresh page
        if (clearFiltersBtn) {
            clearFiltersBtn.addEventListener('click', function(e) {
                e.preventDefault();
                // Redirect to index page without any filters (full refresh)
                window.location.href = '{{ route("admin.users.index") }}';
            });
        }

        // Handle pagination
        document.addEventListener('click', function(e) {

            // Handle pagination links
            if (e.target && e.target.classList.contains('page-btn') && e.target.href && !e.target.classList.contains('disabled') && !e.target.classList.contains('active')) {
                e.preventDefault();
                const url = new URL(e.target.href);

                // Update form values from URL
                if (url.searchParams.has('search')) {
                    searchInput.value = url.searchParams.get('search');
                } else {
                    searchInput.value = '';
                }

                // Show loading
                tableContainer.classList.add('fade-out');
                loadingIndicator.style.display = 'flex';
                if (paginationContainer) {
                    paginationContainer.style.display = 'none';
                }

                // Fetch new page
                fetch(url.toString(), {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.html) {
                        tableContainer.innerHTML = data.html;
                        // Find pagination container inside the updated table
                        paginationContainer = tableContainer.querySelector('#paginationContainer');
                    }
                    if (data.pagination && paginationContainer) {
                        paginationContainer.innerHTML = data.pagination;
                    }

                    // Update URL
                    window.history.pushState({}, '', e.target.href);

                    // Update form values from URL
                    if (searchInput && url.searchParams.has('search')) {
                        searchInput.value = url.searchParams.get('search');
                    } else if (searchInput) {
                        searchInput.value = '';
                    }

                    // Update clear button
                    updateClearButton();

                    // Hide loading
                    if (loadingIndicator) loadingIndicator.style.display = 'none';
                    if (tableContainer) {
                        tableContainer.classList.remove('fade-out');
                        tableContainer.classList.add('fade-in');
                    }
                    if (paginationContainer) {
                        paginationContainer.style.display = 'block';
                        paginationContainer.style.visibility = 'visible';
                        paginationContainer.style.opacity = '1';
                    }
                })
                .catch(error => {
                    console.error('Pagination error:', error);
                    loadingIndicator.style.display = 'none';
                    tableContainer.classList.remove('fade-out');
                });
            }
        });
    })();

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
