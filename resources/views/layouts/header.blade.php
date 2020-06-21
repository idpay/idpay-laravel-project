<!DOCTYPE html>

<html dir="rtl">
<head>
    <meta charset="UTF-8"/>
    <title>@yield('title')</title>
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>
    <script src="{{ asset('/assets/files/jquery/jquery-2.1.1.min.js') }}"></script>
    <script src="{{ asset('/assets/files/bootstrap/css/bootstrap.min.js') }}"></script>
    <link href="{{ asset('/assets/files/bootstrap/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('/bootstrap/files/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <script src="{{ asset('/assets/files/common.js') }}"></script>
    <script src="{{ asset('/assets/files/select2/js/select2.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/main.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main-front.css') }}">
    @yield('header')
    <style type="text/css">
        .pull-right {
            float: left !important;
        }
    </style>
</head>

<body>
<div id="container">
    <header id="header" class="navbar navbar-static-top">
        <div id="header-logo">
        <a href="">
            <img class="logo" typeof="foaf:Image" src="{{asset('image/logo-orange.svg')}}" alt="IDPay logo">
        </a>
        </div>
        <div id="title-header"> آزمایشگاه سرویس پرداخت</div>


    </header>
