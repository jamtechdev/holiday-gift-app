@php
    $range = $range ?? 2;
    $start = max(1, $paginator->currentPage() - $range);
    $end = min($paginator->lastPage(), $paginator->currentPage() + $range);
    $label = $itemLabel ?? 'items';
@endphp

@if ($paginator->hasPages())
<div class="pagination-wrapper">
    <div class="pagination-info">
        Showing {{ $paginator->firstItem() }} – {{ $paginator->lastItem() }} of {{ $paginator->total() }} {{ $label }}
    </div>
    <div class="pagination-controls" role="navigation" aria-label="Pagination Navigation">
        @if ($paginator->onFirstPage())
            <span class="page-btn disabled">Prev</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="page-btn">Prev</a>
        @endif

        @if($start > 1)
            <a href="{{ $paginator->url(1) }}" class="page-btn">1</a>
            @if($start > 2)
                <span class="page-ellipsis">…</span>
            @endif
        @endif

        @for ($page = $start; $page <= $end; $page++)
            @if ($page == $paginator->currentPage())
                <span class="page-btn active">{{ $page }}</span>
            @else
                <a href="{{ $paginator->url($page) }}" class="page-btn">{{ $page }}</a>
            @endif
        @endfor

        @if($end < $paginator->lastPage())
            @if($end + 1 < $paginator->lastPage())
                <span class="page-ellipsis">…</span>
            @endif
            <a href="{{ $paginator->url($paginator->lastPage()) }}" class="page-btn">{{ $paginator->lastPage() }}</a>
        @endif

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="page-btn">Next</a>
        @else
            <span class="page-btn disabled">Next</span>
        @endif
    </div>
</div>
@endif

