<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="userId" content="{{ Auth::check() ? Auth::user()->id : ''}}">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="telephone=no" name="format-detection">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>myBigAsianWedding | @yield('title')</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="shortcut icon" href="{{ asset('admin_asset/images/fav-icon-32.ico') }}" type="image/x-icon" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700|Montserrat:300,400,500,600,700,800&amp;subset=latin-ext" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/fontawesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.1/css/swiper.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/djibe/bootstrap-material-datetimepicker@6659d24c7d2a9c782dc2058dcf4267603934c863/css/bootstrap-material-datetimepicker-bs4.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/fontawesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_asset/css/datepicker.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_asset/css/image-uploader.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_asset/css/daterangepicker.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_asset/css/custom.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_asset/css/bootstrap-timepicker.min.css') }}" />
    <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin_asset/js/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin_asset/js/datepicker.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin_asset/js/image-uploader.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin_asset/js/bootstrap.bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin_asset/js/daterangepicker.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin_asset/js/bootstrap-timepicker.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin_asset/js/businessHours.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin_asset/js/custom.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.1/js/swiper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/djibe/bootstrap-material-datetimepicker@83a10c38ee94dd27fd946ea137af6667c65a738f/js/bootstrap-material-datetimepicker-bs4.min.js"></script>
</head>
