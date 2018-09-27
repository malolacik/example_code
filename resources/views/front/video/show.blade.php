@extends('front.main_template')

@section('title', $video->title)
@section('description', $video->description)
@section('og_image', $video->getOpenGraphImage())

@section('content')
    <div class="main-container mt15">
        <div class="main-container__child content__flex container__aside">
            @include('front.include_small_partials.aside_category_list')
            <div>
                @include('front.include_small_partials.video.video_template')

                <div class="container__more-videos">
                    @foreach($videos as $oneVideo)
                        <div class="container__more-videos--one-video container__more-videos--width">
                            <div class="more-videos__info--container">
                                <a href="{{ $oneVideo->getLink() }}">
                                    <img src="{{ $oneVideo->getImage() }}" alt="{{ $oneVideo->title }} {{ config('static.alt') }}"/>
                                </a>

                                @if($oneVideo->price != 0)
                                    <img class="premium-video__img" src="/img/site/premium.png" alt="{{ $oneVideo->title }} {{ config('static.alt') }}"/>
                                @endif

                                <div class="more-videos__info">
                                    <div class="more-videos__info-likes">
                                        @include('front.include_small_partials.video_list_rating')
                                    </div>
                                    <div class="more-videos__info-view">
                                        <span>{{ $oneVideo->views }} {{ trans('homepage.views') }}</span>
                                    </div>
                                </div>
                            </div>
                            <a href="{{ $oneVideo->getLink() }}">
                                <h2>{{ $oneVideo->title }}</h2>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@stop







