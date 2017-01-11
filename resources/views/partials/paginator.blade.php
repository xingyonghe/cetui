<ul class="pagination">
    @if($paginator->lastPage() > 1)
        <!-- Previous Page Link -->
        @if ($paginator->onFirstPage())
            <li class="prev disabled"><a rel="prev">上一页</a></li>
        @else
            <li class="prev"><a href="{{ $paginator->previousPageUrl() }}" rel="prev">上一页</a></li>
        @endif
        <!-- Pagination Elements -->
        @foreach ($elements as $element)
        <!-- "Three Dots" Separator -->
            @if (is_string($element))
                <li class="disabled"><span>{{ $element }}</span></li>
            @endif

        <!-- Array Of Links -->
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active"><span>{{ $page }}</span></li>
                    @else
                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        <!-- Next Page Link -->
        @if ($paginator->hasMorePages())
            <li class="next"><a href="{{ $paginator->nextPageUrl() }}" rel="next">下一页</a></li>
        @else
            <li class="next disabled"><a rel="next">下一页</a></li>
        @endif
    @endif
</ul>