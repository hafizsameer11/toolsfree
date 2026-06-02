@if ($paginator->hasPages())
    <nav class="blog-pagination" role="navigation" aria-label="Blog pagination">
        <ul class="blog-pagination-list">
            {{-- Previous --}}
            @if ($paginator->onFirstPage())
                <li class="blog-pagination-item disabled">
                    <span class="blog-pagination-link" aria-disabled="true">← Previous</span>
                </li>
            @else
                <li class="blog-pagination-item">
                    <a class="blog-pagination-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">← Previous</a>
                </li>
            @endif

            {{-- Page numbers --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="blog-pagination-item disabled">
                        <span class="blog-pagination-ellipsis">{{ $element }}</span>
                    </li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="blog-pagination-item active" aria-current="page">
                                <span class="blog-pagination-link">{{ $page }}</span>
                            </li>
                        @else
                            <li class="blog-pagination-item">
                                <a class="blog-pagination-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next --}}
            @if ($paginator->hasMorePages())
                <li class="blog-pagination-item">
                    <a class="blog-pagination-link" href="{{ $paginator->nextPageUrl() }}" rel="next">Next →</a>
                </li>
            @else
                <li class="blog-pagination-item disabled">
                    <span class="blog-pagination-link" aria-disabled="true">Next →</span>
                </li>
            @endif
        </ul>

        <p class="blog-pagination-info">
            Showing {{ $paginator->firstItem() }}–{{ $paginator->lastItem() }} of {{ $paginator->total() }} articles
        </p>
    </nav>
@endif
