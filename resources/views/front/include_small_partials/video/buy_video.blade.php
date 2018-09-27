<div class="container__videos--thumb">
    <div class="video-thumb__container">
        <div class="video-thumb__container--block">
            <p class="info_no_active_subscription">{{ trans('homepage.no_active') }}</p>
            <p>{{ trans('homepage.you_have') }} <a href="{{ route('subscriptions') }}">{{ trans('homepage.buy_subscription') }}</a> {{ trans('homepage.or_this_video') }}</p>

            <div class="video-thumb__container-btn">
                <div class="video-thumb__content-btn">
                    <span class="video-thumb__price">PayPal - $0,99</span>
                    {{--<span class="paypayl_btn">PAYPAL</span>--}}
                    <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                        <input type="hidden" name="cmd" value="_s-xclick">
                        <input type="hidden" name="hosted_button_id" value="F3W3XHZZ5ZA48">

                        {{--<input type="hidden" name="on0" value="wartosc1"><input value="__VIDEO_ID__" type="hidden" name="os0" maxlength="200">--}}
                        <input type="hidden" name="on0" value="video_id"><input value="{{ $video->id }}" type="hidden" name="os0" maxlength="200">

                        {{--<input type="hidden" name="on1" value="wartosc2"><input value="__USER_HASH__" type="hidden" name="os1" maxlength="200">--}}
                        <input type="hidden" name="on1" value="user_hash"><input value="{{ Auth::user()->hash }}" type="hidden" name="os1" maxlength="200">

                        <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                        <img alt="" border="0" src="https://www.paypalobjects.com/pl_PL/i/scr/pixel.gif" width="1" height="1">
                    </form>


                </div>
            </div>
            <p class="info_no_active_subscription">{{ trans('subscription.or') }}</p>
            <div class="video-thumb__content-btn">
                <span class="video-thumb__price">99 ArmCoins</span>
                {!! Form::open(['route' => 'armcoins.buy_video']) !!}
                {!! Form::hidden('buy_video', $video->id) !!}
                <button class="armcoins_btn">{{ trans('subscription.buy') }}</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <img class="img__thumb" src="{{ $video->getImage() }}" alt=" {{ config('static.alt') }}"/>
</div>