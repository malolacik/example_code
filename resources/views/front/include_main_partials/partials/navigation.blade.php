<div class="main-container menu">
    <div class="main-container__child navigation__body--content">

        <ul class="menu__body">
            <li @if(Route::current()->getName() == 'index') class="armfight" @endif><a href="{{ route('index') }}">{{ trans('navigation.home') }}</a></li>
            <li @if(Route::current()->getName() == 'event.index' || Route::current()->getName() == 'event.access_event' || Route::current()->getName() == 'event.show') class="armfight" @endif><a
                        href="{{ route('event.index') }}">{{ trans('navigation.live_events') }}</a></li>
            <li @if(Route::currentRouteName() == 'category.all_videos' || Route::currentRouteName() == 'video.show' || Route::currentRouteName() == 'category.show' || Route::currentRouteName() == 'tag.show' || Route::currentRouteName() == 'search.show') class="armfight" @endif>
                <a href="{{ route('category.all_videos') }}">{{ trans('navigation.videos') }}</a>
            </li>
            <li @if(Route::current()->getName() == 'contact.show') class="armfight" @endif><a href="{{ route('contact.show') }}">{{ trans('navigation.contact') }}</a></li>
        </ul>

        <div class="navbar__btn">
            <i class="fa fa-bars nav__bar" aria-hidden="true"></i>
        </div>
    </div>
</div>