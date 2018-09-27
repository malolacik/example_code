@if($videos->lastPage() > 1)
    <div class="pagination_container">
        <div class="pagination_content">
            <select class="input__basic pagination_content--select" id="pagination_videos">
                @for($i = 1 ; $i <= $videos->lastPage() ; $i++)
                    <option @if($i == $videos->currentPage()) selected @endif value="{{ $videos->url($i) }}">{{ $i }}</option>
                @endfor
            </select>
            <span class="pagination_content--text"> of {{ $videos->lastPage() }} pages</span>

            @if($videos->currentPage() == 1)
                <span class="pagination_content--link input__basic disabled">
                                    <i class="fa fa-chevron-left" aria-hidden="true"></i>
                                </span>

            @else
                <a class="pagination_content--link input__basic " href="{{ $videos->previousPageUrl() }}">
                    <i class="fa fa-chevron-left" aria-hidden="true"></i>
                </a>
            @endif


            @if($videos->currentPage() == $videos->lastPage())
                <span class="pagination_content--link input__basic disabled">
                                    <i class="fa fa-chevron-right" aria-hidden="true"></i>
                                </span>
            @else
                <a class="pagination_content--link input__basic" href="{{ $videos->nextPageUrl() }}">
                    <i class="fa fa-chevron-right" aria-hidden="true"></i>
                </a>
            @endif
        </div>
    </div>
@endif