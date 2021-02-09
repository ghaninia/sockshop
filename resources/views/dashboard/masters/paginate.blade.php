@if ($paginator->lastPage() > 1)
<div class="clearfix mt-2"></div>
<div class="pagination-container" style="margin: 0 auto">
    <nav class="pagination">
        <ul class="pagination">
            @if ($paginator->currentPage() != 1 && $paginator->lastPage() >= 5)
                <li>
                    <a href="{{ $paginator->url($paginator->url(1)) }}" >
                        <i class="simple-icon-control-forward"></i>
                    </a>
                </li>
            @endif
            @if($paginator->currentPage() != 1)
                <li>
                    <a href="{{ $paginator->url($paginator->currentPage()-1) }}" >
                    <i class="simple-icon-arrow-left"></i>
                    </a>
                </li>
            @endif
            @for($i = max($paginator->currentPage()-2, 1); $i <= min(max($paginator->currentPage()-2, 1)+4,$paginator->lastPage()); $i++)
                    <li >
                        <a class="{{ ($paginator->currentPage() == $i) ? 'current-page' : '' }}" @unless ($paginator->currentPage() == $i)
                            href="{{ $paginator->url($i) }}"
                        @endunless>{{ $i }}</a>
                    </li>
            @endfor
            @if ($paginator->currentPage() != $paginator->lastPage())
                <li>
                    <a href="{{ $paginator->url($paginator->currentPage()+1) }}" >
                    <i class="simple-icon-arrow-right"></i>
                    </a>
                </li>
            @endif
            @if ($paginator->currentPage() != $paginator->lastPage() && $paginator->lastPage() >= 5)
                <li>
                    <a href="{{ $paginator->url($paginator->lastPage()) }}" >
                        <i class="simple-icon-control-rewind"></i>
                    </a>
                </li>
            @endif
        </ul>
    </nav>
</div>
@endif
