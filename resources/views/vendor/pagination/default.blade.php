@if ($paginator->hasPages())
       <div class="push-25"></div>
			<ul class="pagination" role="navigation" aria-label="Pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="pagination-previous disabled" aria-label="@lang('pagination.previous')">Previous <span class="show-for-sr">page</span>
                    <span aria-hidden="true">&lsaquo;</span>
                </li>
            @else
                <li class="pagination-previous">
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">Previous <span class="show-for-sr">page</span></a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="current" aria-current="page"><a href="{{ $url }}">{{ $page }}</a></li>
                        @else
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="pagination-next">
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">Next <span class="show-for-sr">page</span></a>
                </li>
            @else
                <li class="pagination-next disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    Next <span class="show-for-sr">page</span>
                </li>
            @endif
        </ul>
@endif
