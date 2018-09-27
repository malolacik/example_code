@php
    if(!Session::has('pop_up_login')){
        Session::put('pop_up_login', 1);
    } else{
        Session::put('pop_up_login', Session::get('pop_up_login') + 1);
    }
@endphp


<div class="pop_up-register--all-page" @if(session('pop_up_register') || session('pop_up_login') % 3 == 0) style="display: block;" @endif></div>

<div class="pop_up-register" @if(session('pop_up_register') || session('pop_up_login') % 3 == 0) style="display: block;" @endif>

    <div class="pop_up-register__container">
        <span class="btn_popup_close">X</span>

        <h4>{{ trans('pop_up_register.sign_in') }}</h4>
        <h5>{{ trans('pop_up_register.with_sm') }}</h5>
        <div class="social-media__register">
            @if(Request::route()->getName() == 'event.show')
                <a class="social-media__register--link facebook-bg" href="{{ route('facebook.login') }}?e={{ $event->id }}"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                <a class="social-media__register--link vk-bg" href="{{ route('vkontakte.login') }}?e={{ $event->id }}"><i class="fa fa-vk" aria-hidden="true"></i></a>
                <a class="social-media__register--link g-plus-bg" href="{{ route('google.login') }}?e={{ $event->id }}"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
            @elseif(Request::route()->getName() == 'video.show' || (Request::route()->getName() == 'index') && isset($video))
                <a class="social-media__register--link facebook-bg" href="{{ route('facebook.login') }}?v={{ $video->id }}"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                <a class="social-media__register--link vk-bg" href="{{ route('vkontakte.login') }}?v={{ $video->id }}"><i class="fa fa-vk" aria-hidden="true"></i></a>
                <a class="social-media__register--link g-plus-bg" href="{{ route('google.login') }}?v={{ $video->id }}"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
            @else
                <a class="social-media__register--link facebook-bg" href="{{ route('facebook.login') }}"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                <a class="social-media__register--link vk-bg" href="{{ route('vkontakte.login') }}"><i class="fa fa-vk" aria-hidden="true"></i></a>
                <a class="social-media__register--link g-plus-bg" href="{{ route('google.login') }}"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
            @endif
        </div>
        <h5>{{ trans('pop_up_register.or_mail') }}</h5>

        @if(count($errors))
            <div class="error__container error_pop-up mb10">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {!! Form::open(['route' => 'login']) !!}


        <div class="register__input--content">
            {!! Form::label('email', trans('register.email').'*:') !!}
            {!! Form::email('email', null, ['class' => 'input__basic', 'required']) !!}
        </div>
        <div class="register__input--content">
            {!! Form::label('password', trans('register.password').'*:') !!}
            {!! Form::password('password', ['class' => 'input__basic', 'required']) !!}
        </div>

        @if(Request::route()->getName() == 'event.show')
            {!! Form::hidden('popup', 'e|'.$event->id) !!}
        @elseif(Request::route()->getName() == 'video.show')
            {!! Form::hidden('popup', 'v|'.$video->id) !!}
        @else
            {!! Form::hidden('popup', '0') !!}
        @endif

        <div class="register__input--content mt10">
            <button class="button__basic sign-up__content--btn">{{ trans('pop_up_register.sign_in') }}</button>
        </div>
        {!! Form::close() !!}


        <a class="link-popup" href="{{ route('password.request') }}">{{ trans('homepage.forgot') }}</a>

        <h5>or</h5>
        @if(Request::route()->getName() == 'event.show')
            <a class="link-popup" href="{{ route('register') }}?e={{ $event->id }}">{{ trans('homepage.sign_up') }}</a>
        @elseif(Request::route()->getName() == 'video.show')
            <a class="link-popup" href="{{ route('register') }}?v={{ $video->id }}">{{ trans('homepage.sign_up') }}</a>
        @else
            <a class="link-popup" href="{{ route('register') }}">{{ trans('homepage.sign_up') }}</a>
        @endif
    </div>


</div>









