<div class="main-container navigation">
    <div class="main-container__child navigation__body">
        <div class="navigation__body--logo">
            <a href="{{ route('index') }}">
                <img src="/img/site/logo.png" alt=" {{ config('static.alt') }}">
            </a>
        </div>
        <div class="navigation__body--links @auth navigation__100-xs @endauth">
            <div class="flex flags__content--xl">
                <div class="navigation_tabs sign-up__content flags__content">
                    <ul class="list-flags">
                        @if(App::getLocale() == 'en')
                            <li class="change_lang">
                                <img src="/img/site/usa.jpg" alt=" {{ config('static.alt') }}"/>
                            </li>
                            <li class="second_lang none">
                                <a href="{{ route('change_language', 'ru') }}">
                                    <img src="/img/site/rus.jpg" alt=" {{ config('static.alt') }}"/>
                                </a>
                            </li>
                        @else
                            <li class="change_lang">
                                <img src="/img/site/rus.jpg" alt=" {{ config('static.alt') }}"/>
                            </li>
                            <li class="second_lang none">
                                <a href="{{ route('change_language', 'en') }}">
                                    <img src="/img/site/usa.jpg" alt=" {{ config('static.alt') }}"/>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>

            @guest
                {!! Form::open(['route' => 'login', 'class' => 'sign-in__form navigation_tabs']) !!}
                <div class="sign-in__form--content">
                    {!! Form::email('email', null, ['class' => 'input__basic', 'required', 'autofocus', 'placeholder' => 'E-mal']) !!}
                    {!! Form::password('password', ['class' => 'input__basic', 'required']) !!}
                    <button class="button__basic button__login"><i class="fa fa-angle-right" aria-hidden="true"></i></button>
                </div>
                <a class="sign-in__form--link-forgot" href="{{ route('password.request') }}">{{ trans('homepage.forgot') }}</a>
                {!! Form::close() !!}
            @endguest


            <div class="small-nav__register-lang">
                <div class="navigation__body--logo logo-xs">
                    <a href="{{ route('index') }}">
                        <img src="/img/site/logo.png" alt=" {{ config('static.alt') }}">
                    </a>
                </div>

                <div class="flex flex-xs__register-lang">


                    <div class="flex flags__content--xs">
                        <div class="navigation_tabs sign-up__content flags__content">
                            <ul class="list-flags">

                                @if(App::getLocale() == 'en')
                                    <li class="change_lang">
                                        <img src="/img/site/usa.jpg" alt=" {{ config('static.alt') }}"/>
                                    </li>
                                    <li class="second_lang none">
                                        <a href="{{ route('change_language', 'ru') }}">
                                            <img src="/img/site/rus.jpg" alt=" {{ config('static.alt') }}"/>
                                        </a>
                                    </li>
                                @else
                                    <li class="change_lang">
                                        <img src="/img/site/rus.jpg" alt=" {{ config('static.alt') }}"/>
                                    </li>
                                    <li class="second_lang none">
                                        <a href="{{ route('change_language', 'en') }}">
                                            <img src="/img/site/usa.jpg" alt=" {{ config('static.alt') }}"/>
                                        </a>
                                    </li>
                                @endif

                            </ul>
                        </div>
                    </div>


                    @guest
                        @if(Request::route()->getName() == 'event.show')
                            <div class="navigation_tabs sign-in__social-media tall__tab">
                                <a class="button__basic button__login facebook-bg" href="{{ route('facebook.login') }}?e={{ $event->id }}"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                <a class="button__basic button__login vk-bg" href="{{ route('vkontakte.login') }}?e={{ $event->id }}"><i class="fa fa-vk" aria-hidden="true"></i></a>
                                <a class="button__basic button__login g-plus-bg" href="{{ route('google.login') }}?e={{ $event->id }}"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                            </div>
                        @elseif(Request::route()->getName() == 'video.show')
                            <div class="navigation_tabs sign-in__social-media tall__tab">
                                <a class="button__basic button__login facebook-bg" href="{{ route('facebook.login') }}?v={{ $video->id }}"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                <a class="button__basic button__login vk-bg" href="{{ route('vkontakte.login') }}?v={{ $video->id }}"><i class="fa fa-vk" aria-hidden="true"></i></a>
                                <a class="button__basic button__login g-plus-bg" href="{{ route('google.login') }}?v={{ $video->id }}"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                            </div>
                        @else
                            <div class="navigation_tabs sign-in__social-media tall__tab">
                                <a class="button__basic button__login facebook-bg" href="{{ route('facebook.login') }}"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                <a class="button__basic button__login vk-bg" href="{{ route('vkontakte.login') }}"><i class="fa fa-vk" aria-hidden="true"></i></a>
                                <a class="button__basic button__login g-plus-bg" href="{{ route('google.login') }}"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                            </div>
                        @endif

                        <div class="navigation_tabs sign-up__content tall__tab">
                            <a class="button__basic sign-up__content--btn" href="{{ route('register') }}">{{ trans('homepage.sign_up') }}</a>
                        </div>
                    @endguest

                    @auth
                        <div class="navigation_tabs sign-up__content tall__tab user-nav background_tabs">
                            <div class="user-nav__content no-select">
                                <span>{{ Auth::user()->username }}</span>
                            </div>

                            <div class="user-nav__content-more">
                                <div class="flex-center-center coins__content">
                                    {{--<a href="" class="user-nav__text"></a>--}}
                                    <ul>
                                        <li class="buy-coins__btn">
                                            <a href="{{ route('armcoins.history_list') }}">{{ Auth::user()->getUserArmcoins() }} ARC [{{ trans('homepage.view') }}]</a>
                                        </li>
                                    </ul>
                                </div>
                                @if($subscription = Auth::user()->getActiveSubscription())
                                    <span class="user-nav__text">{{ trans('homepage.subscription_till') }}</span>
                                    <span class="user-nav__text">{{ $subscription->date_to }}</span>
                                @else
                                    <span class="user-nav__text">{{ trans('homepage.no_active') }}</span>
                                    <a href="{{ route('subscriptions') }}" class="user-nav__text">{{ trans('homepage.get_one') }}</a>
                                @endif

                                <ul>
                                    {{--<li class="buy-coins__btn">--}}
                                    {{--<a href="#">Buy ArmCoins</a>--}}
                                    {{--</li>--}}
                                    <li>
                                        <a href="{{ route('referral.show') }}">{{ trans('referral.title') }}</a>
                                    </li>
                                    {{--<li>--}}
                                    {{--<a href="#">My ranking</a>--}}
                                    {{--</li>--}}
                                    <li>
                                        <a href="{{ route('user.edit_account.show') }}">{{ trans('homepage.edit_account') }}</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('promo_code.show') }}">{{ trans('homepage.enter_code') }}</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('user.purchases') }}">{{ trans('homepage.my_purchases') }}</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('proposal.show') }}">{{ trans('homepage.my_proposals') }}</a>
                                    </li>
                                    {{--<li>--}}
                                    {{--<a href="#">Complaint form</a>--}}
                                    {{--</li>--}}
                                    <li class="logout__btn">
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">{{ trans('homepage.logout') }}</a>
                                        <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @endauth

                </div>
            </div>
        </div>
    </div>
</div>




