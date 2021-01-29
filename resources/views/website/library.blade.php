<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="userId" content="{{ Auth::check() ? Auth::user()->id : ''}}">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="telephone=no" name="format-detection">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>My Big Asian Wedding UK | @yield('title')</title>

    <!-- Latest compiled and minified CSS -->
    <meta name="theme-color" content="#533063">
    <link rel="shortcut icon" href="{{ asset('web_asset/images/favicon.png') }}" type="image/x-icon" />
    <link rel="apple-touch-icon-precomposed" href="{{ asset('web_asset/images/favicon.png') }}">
    <meta name="msapplication-TileImage" content="{{ asset('web_asset/images/favicon.png') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('admin_asset/css/image-uploader.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/fontawesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('web_asset/vendor/jquery-ui/jquery-ui.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('web_asset/vendor/animate3.7.0/animate.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('web_asset/vendor/owlcarousel/owl.carousel.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('web_asset/vendor/fancybox/jquery.fancybox.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('web_asset/css/custom-style.css') }}">
    <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('web_asset/vendor/jquery-ui/jquery-ui.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('web_asset/vendor/jqueryvalidate/jquery.validate.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('web_asset/vendor/owlcarousel/owl.carousel.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('web_asset/vendor/fancybox/jquery.fancybox.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('web_asset/js/js-custom.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
    <script type="text/javascript" src="{{ asset('web_asset/js/image-uploader.min.js') }}"></script>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-KLVSVGN');</script>
    <!-- End Google Tag Manager -->
</head>
