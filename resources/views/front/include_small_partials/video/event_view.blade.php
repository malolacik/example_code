<div class="index__event">
    <div class="index__event--bg">
        <h3 class="title_event"><a href="{{ $activeEvent->getLink() }}">{{ $activeEvent->title }}</a></h3>
        <h4 class="title_place"><a href="{{ $activeEvent->getLink() }}">{{ $activeEvent->place }}</a></h4>
        <a href="{{ $activeEvent->getLink() }}"><img class="event_thumb" src="{{ $activeEvent->getImage() }}" alt="{{ $activeEvent->title }} {{ config('static.alt') }}"/></a>
        <div class="index__event--belt">
            <a class="text_event_is_running" href="{{ $activeEvent->getLink() }}">{{ trans('homepage.event_is_running') }}</a>
            @guest
                <a href="{{ $activeEvent->getLink() }}">{{ trans('homepage.sign_in_for_watch') }}</a>
            @endguest
        </div>
    </div>
</div>







