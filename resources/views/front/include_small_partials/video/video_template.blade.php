@php $eventOnPage = 0; @endphp

@if(isset($indexPage))
    {{--Strona główna--}}
    @if(!empty($activeEvent))
        {{--Jeżeli trwa jakiś event, niech będzie widok eventu--}}
        @include('front.include_small_partials.video.event_view')
        @php $eventOnPage = 1; @endphp
    @else


       {{-- --}}{{--widok video --}}{{--
        @include('front.include_small_partials.video.show_video')
       --}}

       @auth
           @if($video->price == 0 || Auth::user()->getVideoAccess($video->id) == 1 || Auth::user()->getActiveSubscription())
               {{--widok video --}}
               @include('front.include_small_partials.video.show_video')
           @else
               {{--widok aby kupic video--}}
               @include('front.include_small_partials.video.buy_video')
           @endif
       @else
           {{--widok miniaturki - niezalogowany --}}
           @include('front.include_small_partials.video.show_thumb')
       @endauth


    @endif
@else
    {{--Pozostale strony --}}
    @auth
        @if($video->price == 0 || Auth::user()->getVideoAccess($video->id) == 1 || Auth::user()->getActiveSubscription())
            {{--widok video --}}
            @include('front.include_small_partials.video.show_video')
        @else
            {{--widok aby kupic video--}}
            @include('front.include_small_partials.video.buy_video')
        @endif
    @else
        {{--widok miniaturki - niezalogowany --}}
        @include('front.include_small_partials.video.show_thumb')
    @endauth
@endif


@if($eventOnPage == 0)
    <div class="container__videos">
        <div class="container__videos--info">
            <h1><a href="{{ $video->getLink() }}">{{ $video->title }}</a></h1>


            @if(!is_null($video->description))
                @if(strlen($video->description) > 500)
                    <div id="description-video" class="description-short_video">
                        <p>{!! $video->description !!}</p>
                    </div>
                    <div class="flex-center-center">
                        <span onclick="$('#description-video').toggleClass('show-description');" class="show-more_description">{{ trans('homepage.show_more') }}</span>
                    </div>
                @else
                    <p>{!! $video->description !!}</p>
                @endif
            @endif


            <div class="videos__info--date-views">
                <span>{{ date('Y-m-d', strtotime($video->public_date)) }}</span>
                <span class="line">|</span>
                <span>{{ $video->views }} {{ trans('homepage.views') }}</span>
            </div>

            <div class="line"></div>
            <div class="container__videos--btn">
                <div class="flex__video-function">
                    @auth
                        @if(!empty($userVoice = $video->getUserVoice(Auth::user()->id)))
                            <span class="@if($userVoice->rating == 1) voice @else no_voice @endif" data-video="{{ $video->id }}" data-voting="1"><i class="fa fa-thumbs-up" aria-hidden="true"></i> {{
                            $video->rating_up
                            }}</span>
                            <span class="@if($userVoice->rating == 1) no_voice @else voice @endif" data-video="{{ $video->id }}" data-voting="2"><i class="fa fa-thumbs-down" aria-hidden="true"></i> {{
                            $video->rating_down }}</span>
                        @else
                            <span class="" data-video="{{ $video->id }}" data-voting="1"><i class="fa fa-thumbs-up" aria-hidden="true"></i> {{ $video->rating_up }}</span>
                            <span class="" data-video="{{ $video->id }}" data-voting="2"><i class="fa fa-thumbs-down" aria-hidden="true"></i> {{ $video->rating_down }}</span>
                        @endif
                    @else
                        <span data-toggle="tooltip" title="{{ trans('video.sign_in_to_vote') }}" data-to><i class="fa fa-thumbs-up" aria-hidden="true"></i> {{ $video->rating_up }}</span>
                        <span data-toggle="tooltip" title="{{ trans('video.sign_in_to_vote') }}" data-to><i class="fa fa-thumbs-down" aria-hidden="true"></i> {{ $video->rating_down }}</span>
                    @endauth
                    <div class="flex">
                        <span class="show_share"><i class="fa fa-share" aria-hidden="true"></i> {{ trans('homepage.share') }}</span>
                        <div class="flex__video-function--social-media">
                            <a target="_blank" class="social-media facebook-bg" href="{{ $video->getShareFacebookLink() }}"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                            <a target="_blank" class="social-media vk-bg" href="{{ $video->getShareVkontakteLink() }}"><i class="fa fa-vk" aria-hidden="true"></i></a>
                            <a target="_blank" class="social-media g-plus-bg" href="{{ $video->getShareGoogleLink() }}"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>

                @auth
                    <span class="link_edit">{{ trans('edit_account.edit') }}</span>
                @endauth
            </div>
            <div class="line margin_top_line_5"></div>

            @auth

                <div id="success_proposal_container" class="flex-center-center" style="display: none;">
                    <div class="success__container mb10">
                        <ul id="success_proposal_response"></ul>
                    </div>
                </div>

                <div class="edit-video__container">
                    <div id="error_proposal_container" class="flex-center-center" style="display: none;">
                        <div class="error__container mb10">
                            <ul id="error_proposal_response"></ul>
                        </div>
                    </div>


                    <input id="proposal_title" class="input__basic" placeholder="{{ trans('proposal.title') }}" type="text" value="{{ $video->getProposalTitle(Auth::user()->id) }}"/>
                    <textarea id="proposal_description" class="input__basic" placeholder="{{ trans('proposal.description') }}"
                              rows="10">{{ $video->getProposalDescription(Auth::user()->id) }}</textarea>

                    <div class="edit-video__container--btn">
                        <input id="proposal_video" type="hidden" value="{{ $video->id }}"/>
                        <span id="save_proposal" class="button__basic ">{{ trans('edit_account.save') }}</span>
                    </div>
                    <div class="line margin_top_line_5"></div>
                </div>
            @endauth

            @if(count($tags = $video->getTags))
                <div class="container__videos--tags">
                    <span>{{ trans('homepage.tags') }}:</span>
                    @foreach($tags as $tag)
                        <a href="{{ $tag->getLink() }}">{{ $tag->title }}</a>
                    @endforeach

                    @auth
                        @include('front.include_small_partials.video.add_proposal_tags')
                    @endauth
                </div>
                <div class="line margin_top_line_5"></div>
            @else
                @auth
                    <div class="container__videos--tags">
                        <span>{{ trans('homepage.tags') }}:</span>
                        @include('front.include_small_partials.video.add_proposal_tags')
                    </div>
                    <div class="line margin_top_line_5"></div>
                @endauth
            @endif
        </div>
    </div>
@endif












