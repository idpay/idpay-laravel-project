<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8"/>
    <title>@yield('title')</title>
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>
    <link rel="stylesheet" href="{{asset('assets/bootstrap-3.4.1/css/bootstrap.min.css')}}">
    <script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('assets/bootstrap-3.4.1/js/bootstrap.min.js')}}"></script>
    <link href="{{ asset('/assets/files/bootstrap/css/bootstrap.css') }}" rel="stylesheet">
    <script src="{{ asset('/assets/files/common.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/main.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main-front.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontiran.css') }}">

    {{--<link rel="stylesheet" href="{{ asset('js/toastr.min.js') }}">--}}




    @yield('header')
    <style type="text/css">
        .pull-right {
            float: left !important;
        }
    </style>



</head>


<body>

{{--<script>--}}
    {{--// for success - green box--}}
    {{--toastr.success('Success messages');--}}
{{--</script>--}}

<header id="header" class="navbar navbar-static-top">
    <div id="header-logo">
        <a href="">
            <img class="logo" typeof="foaf:Image" src="{{asset('image/logo-orange.svg')}}" alt="IDPay logo">
        </a>
    </div>




</header>

<div class="container">

    @yield('content')

</div>


<footer id="footer">

    <p style="text-align: center;  font-size:12px; padding-top:10px; " >
        تمامی حقوق نزد <a href="https://idpay.ir/" target="_blank" style="color:#fe681e">IDPay</a> محفوظ می‌باشد &copy;
    </p>
</footer>



<script>
    function loadWaiting() {

        var div = $("#loadWaiting");

        div.animate({width: '100%', opacity: '1'}, "100");
        // div.animate({width: '0', opacity: '0'}, "fast");


    }

    function stopLoadWaiting() {

        var div = $("#loadWaiting");
        div.stop();
        div.animate({width: '0', opacity: '0'}, "fast");


    }


</script>
</body>



<div class="row" id="loadWaiting"></div>




</html>
