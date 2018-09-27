<div class="container__videos--thumb">
    <div class="video-thumb__container">
        <div class="video-thumb__container--block block_login">
            <span id="login_popup" class="signup_btn-popup signup_btn">{{ trans('homepage.sign_in_to_watch') }}</span>
        </div>
    </div>

    <img class="img__thumb" src="{{ $video->getImage() }}" alt=" {{ config('static.alt') }}" />
</div>