<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  	<meta name="keywords" content="" />
  	<meta name="author" content="" />
  	<meta name="robots" content="" />
  	<meta name="description" content="JobBoard - HTML Template" />
  	<meta property="og:title" content="JobBoard - HTML Template" />
  	<meta property="og:description" content="JobBoard - HTML Template" />
  	<meta property="og:image" content="JobBoard - HTML Template" />
  	<meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/templete.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins.css') }}" rel="stylesheet">
    <link href="{{ asset('css/lightgallery.css') }}" rel="stylesheet">
    <link href="{{ asset('css/skin/skin-1.css') }}" rel="stylesheet">
    <link href="{{ asset('css/wickedpicker.css') }}" rel="stylesheet">
    <link href="{{ asset('css/datepicker.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('plugins\dropify\dist\css\dropify.min.css')}}">
    @yield("css")
</head>
<body id="bg">
  <div id="loading-area"></div>
    <div class="page-wraper">
        @include("layouts.header")
        @yield('content')
    </div>
</body>
@include("layouts.footer")
