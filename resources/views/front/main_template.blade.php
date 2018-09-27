<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title') {{ config('static.site_title') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="Robots" content="index,follow"/>
    <meta http-equiv="Expires" content="0"/>
    <meta http-equiv="Cache-Control" CONTENT="NO-CACHE"/>
    <meta http-equiv="Pragma" content="no-cache"/>
    <meta content="yes" name="apple-mobile-web-app-capable">

    <meta name="Keywords" content="{{ config('static.keywords') }}"/>
    <meta name="Description" content="@yield('description', config('static.description'))"/>
    <meta property="og:site_name" content="@yield('title') {{ config('static.alt') }}"/>
    <meta property="og:image" content="@yield('og_image', url(config('static.default_og_image_filename')))"/>
    <meta property="og:description" content="@yield('description', config('static.description'))"/>
    <meta property="og:title" content="@yield('title') {{ config('static.alt') }}"/>

    <meta property="og:type" content="website"/>
    <meta name="rating" content="general"/>

    <link rel="apple-touch-icon" sizes="57x57" href="/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon/favicon-16x16.png">
    <link rel="manifest" href="/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">


    <link rel="image_src" href="@yield('og_image', url(config('static.default_og_image_filename')))"/>

@include('front.include_main_partials.scripts_styles.link_top')



</head>
<body>

@guest
    @include('front.include_small_partials.login_popup')
@endguest

@include('front.include_small_partials.modal')



@include('front.include_main_partials.partials.header')

@include('front.include_main_partials.partials.navigation')



@yield('content')


@if(!isset($withoutPlanBanner))
    @include('front.include_main_partials.partials.choose_plan')
@endif


@include('front.include_main_partials.partials.footer')

@include('front.include_main_partials.scripts_styles.link_bottom')

@if(Session::has('premium_category_error'))
    @auth
        <script type="text/javascript">
            $(document).ready(function () {
                $('#buy_now_popup').click();
            });
        </script>
    @else
        <script type="text/javascript">
            $(document).ready(function () {
                $('#login_popup').click();
            });
        </script>
    @endif
@endif




</body>
</html>










