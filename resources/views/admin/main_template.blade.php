<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title') # Administracja</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="Robots" content="index,follow"/>
    <meta http-equiv="Expires" content="0"/>
    <meta http-equiv="Cache-Control" CONTENT="NO-CACHE"/>
    <meta http-equiv="Pragma" content="no-cache"/>
    <meta content="yes" name="apple-mobile-web-app-capable">
    <meta name="author" content="Mazurenko Promotion"/>

    <meta name="Keywords" content="Keywords"/>
    <meta name="Description" content="Description"/>
    <meta property="og:site_name" content="og__site_name"/>
    <meta property="og:image" content="@yield('open_graph', 'dsadsa')"/>
    <meta property="og:description" content="og__description"/>
    <meta property="og:title" content="og__title"/>

    <meta property="og:type" content="website"/>
    <meta name="rating" content="general"/>

    <link rel="image_src" href="@yield('open_graph')"/>

    @include('admin.include_main_partials.scripts_styles.link_top')
</head>
<body>


@include('admin.include_main_partials.partials.navigation')


@yield('content')


@include('admin.include_main_partials.scripts_styles.link_bottom')
</body>
</html>










