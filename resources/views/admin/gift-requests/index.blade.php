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
        <form method="GET" action="{{ route('admin.gift-requests.index') }}" class="gift-filter-form" id="searchForm">
            <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Search by name, email, company, address..." class="gift-filter-search" id="searchInput" style="min-width: 280px; border-radius: 999px; padding: 0.5rem 1rem; border: 1px solid rgba(15, 23, 42, 0.15); background: rgba(255, 255, 255, 0.75); font-size: 0.9rem; color: #111827; transition: box-shadow 0.2s ease, border-color 0.2s ease;">
            <label class="gift-filter-label" for="gift-category-filter">Category</label>
            <select id="gift-category-filter" name="category" class="gift-filter-select">
                <option value="">All Categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ (string)$category->id === (string)($selectedCategory ?? '') ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @if($selectedCategory || ($search ?? ''))
                <a href="{{ route('admin.gift-requests.index') }}" class="admin-btn-sm" id="clearFiltersBtn" style="margin-left: 0.5rem; text-decoration: none;">Clear All</a>
            @endif
        </form>
        <a href="{{ route('admin.gift-requests.export', ['category' => $selectedCategory, 'search' => $search]) }}" class="admin-btn" id="exportBtn">Export</a>
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
    
    @include('admin.gift-requests.partials.table', ['requests' => $requests])
</div>


@push('scripts')
<script>
    (function() {
        let searchTimeout;
        const searchInput = document.getElementById('searchInput');
        const categorySelect = document.getElementById('gift-category-filter');
        const tableContainer = document.getElementById('tableContainer');
        let paginationContainer = document.getElementById('paginationContainer') || tableContainer?.querySelector('#paginationContainer');
        const loadingIndicator = document.getElementById('loadingIndicator');
        const exportBtn = document.getElementById('exportBtn');
        const clearFiltersBtn = document.getElementById('clearFiltersBtn');

        function updateClearButton() {
            const search = searchInput ? searchInput.value.trim() : '';
            const category = categorySelect ? categorySelect.value : '';
            const form = document.getElementById('searchForm');
            
            if (!form) return;
            
            let existingBtn = document.getElementById('clearFiltersBtn');
            
            if (search || category) {
                if (!existingBtn) {
                    const btn = document.createElement('a');
                    btn.href = '{{ route("admin.gift-requests.index") }}';
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
            if (!searchInput || !categorySelect || !tableContainer || !loadingIndicator || !paginationContainer) {
                return;
            }

            const search = searchInput.value.trim();
            const category = categorySelect.value;
            
            // Update URL without reload - always include search param even if empty
            const params = new URLSearchParams();
            if (search) {
                params.set('search', search);
            }
            if (category) {
                params.set('category', category);
            }
            const queryString = params.toString();
            const newUrl = '{{ route("admin.gift-requests.index") }}' + (queryString ? '?' + queryString : '');
            window.history.pushState({}, '', newUrl);

            // Update export link
            if (exportBtn) {
                exportBtn.href = '{{ route("admin.gift-requests.export") }}' + (queryString ? '?' + queryString : '');
            }

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
            
            // Trigger search when input is cleared
            searchInput.addEventListener('paste', function() {
                clearTimeout(searchTimeout);
                setTimeout(function() {
                    performSearch();
                    updateClearButton();
                }, 100);
            });
        }

        // Search on category change
        if (categorySelect) {
            categorySelect.addEventListener('change', function() {
                clearTimeout(searchTimeout);
                performSearch();
                updateClearButton();
            });
        }

        // Handle clear button click - refresh page
        if (clearFiltersBtn) {
            clearFiltersBtn.addEventListener('click', function(e) {
                e.preventDefault();
                // Redirect to index page without any filters (full refresh)
                window.location.href = '{{ route("admin.gift-requests.index") }}';
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
                if (url.searchParams.has('category')) {
                    categorySelect.value = url.searchParams.get('category');
                } else {
                    categorySelect.value = '';
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
                    
                    // Update export link
                    if (exportBtn) {
                        const exportUrl = new URL('{{ route("admin.gift-requests.export") }}');
                        if (url.searchParams.has('search')) exportUrl.searchParams.set('search', url.searchParams.get('search'));
                        if (url.searchParams.has('category')) exportUrl.searchParams.set('category', url.searchParams.get('category'));
                        exportBtn.href = exportUrl.toString();
                    }
                    
                    // Update form values from URL
                    if (searchInput && url.searchParams.has('search')) {
                        searchInput.value = url.searchParams.get('search');
                    } else if (searchInput) {
                        searchInput.value = '';
                    }
                    if (categorySelect && url.searchParams.has('category')) {
                        categorySelect.value = url.searchParams.get('category');
                    } else if (categorySelect) {
                        categorySelect.value = '';
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
</script>
@endpush
@endsection