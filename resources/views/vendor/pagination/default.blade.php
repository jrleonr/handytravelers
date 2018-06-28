@if ($paginator->hasPages())
<nav class="pagination is-centered notification is-white">
    {{-- Previous Page Link --}}
    @if ($paginator->onFirstPage())
    <span class="pagination-previous is-disabled"><span>Previous</span></span>
    @else
    <a class="pagination-previous" href="{{ $paginator->previousPageUrl() }}" rel="prev">Previous</a>
    @endif
    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
    <a class="pagination-next" href="{{ $paginator->nextPageUrl() }}" rel="next">Next page</a>
    @else
    <span class="pagination-next is-disabled"><span>Next page</span></span>
    @endif
    <ul class="pagination-list">
        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
        {{-- "Three Dots" Separator --}}
        @if (is_string($element))
        <li class="pagination-ellipsis is-disabled"><span>{{ $element }}</span></li>
        @endif

        {{-- Array Of Links --}}
        @if (is_array($element))
        @foreach ($element as $page => $url)
        @if ($page == $paginator->currentPage())
        <li class="pagination-link is-current"><span>{{ $page }}</span></li>
        @else
        <li class="pagination-link"><a href="{{ $url }}">{{ $page }}</a></li>
        @endif
        @endforeach
        @endif
        @endforeach
    </ul>
</nav>
@endif
