<div class="aside">
    <button class="show__menu--btn">
        <span class="show__menu--btn-show">{{ trans('homepage.show_menu') }} <i class="fa fa-angle-down" aria-hidden="true"></i></span>
        <span class="show__menu--btn-hide">{{ trans('homepage.hide_menu') }} <i class="fa fa-angle-up" aria-hidden="true"></i></span>
    </button>

    <div class="aside__block aside__block--xs search__content">
        {!! Form::open(['route' => 'search.search']) !!}
        <h3 data-show-category="1">{{ trans('homepage.search_1') }} <i class="fa fa-angle-down" aria-hidden="true"></i></h3>

        {!! Form::text('word', null, ['class' => 'input__basic input__search category__show-after-click', 'placeholder' => trans('homepage.search_1'), 'required']) !!}

        <button class="button__basic button__login category__show-after-click"><i class="fa fa-angle-right" aria-hidden="true"></i></button>
        {!! Form::close() !!}
    </div>

    <div class="aside__block aside__block--xs">
        <h3 data-show-category="2">{{ trans('homepage.all_categories') }} <i class="fa fa-angle-down" aria-hidden="true"></i></h3>
        <ul class="categories__list category__show-after-click">
            <li>
                <h2>
                    <a class="play" href="{{ route('category.all_videos') }}"><i class="fa fa-play" aria-hidden="true"></i> </a>
                    <a href="{{ route('category.all_videos') }}">{{ trans('homepage.latest_video') }}</a>
                </h2>
                <a href="{{ route('category.all_videos') }}">({{ $countVideos }})</a>
            </li>
            @php $i = 1; @endphp
            @php $limitCat = 25; @endphp

            @foreach($categories as $category)
                <li class="
                    @if($i == $limitCat - 2)
                        category__list--half-hidden category__hidden--11
                    @elseif($i == $limitCat - 1)
                        category__list--half-hidden category__hidden--12
                    @elseif($i == $limitCat)
                        category__list--half-hidden category__hidden--13
                    @elseif($i > $limitCat)
                        category__list--hidden
                    @endif
                        ">
                    <h2 @if(!empty($categoryButton = $category->getPaymentButton)) class="padlock_category_title" @endif>
                        <a class="play" href="{{ $category->getLink() }}"><i class="fa fa-play" aria-hidden="true"></i> </a>
                        @if(!empty($categoryButton = $category->getPaymentButton))<a class="play" href="{{ $category->getLink() }}"><i class="fa fa-lock padlock_category" aria-hidden="true"></i></a> @endif
                        <a href="{{ $category->getLink() }}">{{ $category->title }}</a>
                    </h2>
                    <a href="{{ $category->getLink() }}">({{ $category->countVideo() }})</a>
                </li>

                @php $i++; @endphp
            @endforeach

            @if(count($categories) > 20)
                <li class="category__show-more">
                    <span class="category__show-more--btn">{{ trans('homepage.show_more') }}</span>
                </li>
            @endif
        </ul>
    </div>


    <div class="aside__block aside__block--xs">
        <h3 data-show-category="4">{{ trans('homepage.tags') }} <i class="fa fa-angle-down" aria-hidden="true"></i></h3>
        <ul class="categories__list category__show-after-click">
            @php $i = 1; @endphp
            @php $limitCat = 25; @endphp

            @foreach($tags as $tag)
                <li class="
                    @if($i == $limitCat - 2)
                        category__list--half-hidden category__hidden--11
                    @elseif($i == $limitCat - 1)
                        category__list--half-hidden category__hidden--12
                    @elseif($i == $limitCat)
                        category__list--half-hidden category__hidden--13
                    @elseif($i > $limitCat)
                        category__list--hidden
                    @endif
                        ">
                    <h2>
                        <a class="play" href="{{ $tag->getLink() }}"><i class="fa fa-play" aria-hidden="true"></i> </a>
                        <a href="{{ $tag->getLink() }}">{{ $tag->title }}</a>
                    </h2>
                    <a href="{{ $tag->getLink() }}">({{ $tag->countVideo() }})</a>
                </li>

                @php $i++; @endphp
            @endforeach

            @if(count($tags) > 20)
                <li class="category__show-more">
                    <span class="category__show-more--btn">{{ trans('homepage.show_more') }}</span>
                </li>
            @endif
        </ul>
    </div>
</div>








