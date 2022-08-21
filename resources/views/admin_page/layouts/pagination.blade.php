@if ($paginator->hasPages())
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                        <span class="page-link">
                            <i class="fa-solid fa-minus fa-minus-before"></i>
                            <i class="fa-solid fa-angle-left"></i>
                        </span>
                </li>
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="page-link"><i class="fa-solid fa-angle-left"></i></span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->url(1) }}">
                        <i class="fa-solid fa-minus fa-minus-before"></i>
                        <i class="fa-solid fa-angle-left"></i>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')"><i class="fa-solid fa-angle-left"></i></a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled" aria-disabled="true"><span><i class="fa-solid fa-ellipsis"></i></span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item" aria-current="page">
                                <span class="page-link page-link-active">{{ $page }}</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $url}}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}"><i class="fa-solid fa-angle-right"></i></a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->url($paginator->lastPage()) }}"><i class="fa-solid fa-angle-right"></i><i class="fa-solid fa-minus fa-minus-after"></i></a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link"><i class="fa-solid fa-angle-right"></i></span>
                </li>
                <li class="page-item disabled">
                    <span class="page-link"><i class="fa-solid fa-angle-right"></i><i class="fa-solid fa-minus fa-minus-after"></i></span>
                </li>
            @endif
        </ul>
    </nav>
@endif
