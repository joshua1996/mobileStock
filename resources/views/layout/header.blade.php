<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Stock Management System</title>

    <script src="{{ asset("js/jquery-3.2.1.js") }}" type="text/javascript"></script>
    <script src="{{ asset("js/tether.min.js") }}" type="text/javascript"></script>
    <script src="{{ asset("materialize/js/materialize.js") }}" type="text/javascript"></script>
    <script src="{{ asset("js/jquery.jstepper.js") }}" type="text/javascript"></script>
    <link rel="stylesheet" href="{{ asset("css/jquery-ui.css") }}">
    <link rel="stylesheet" href="{{ asset("materialize/css/materialize.css") }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
    </script>
    <style>
        .preloaderblock.active{
            height: auto;
            left: 0;
            min-height: 100%;
            position: absolute;
            right: 0;
            top: 0;
            z-index: 2000;
        }

        .preloader-background {
            display: flex;
            align-items: center;
            justify-content: center;
            position: fixed;
            z-index: 2000;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: black;
            opacity: 0.5;
        }
    </style>
</head>
<body>
@yield('body')

{{--<div style="" class="preloaderblock active">--}}

{{--</div>--}}
<div class="" id="preloaderBlock">
    <div class="preloader-wrapper big active">
        <div class="spinner-layer spinner-blue">
            <div class="circle-clipper left">
                <div class="circle"></div>
            </div><div class="gap-patch">
                <div class="circle"></div>
            </div><div class="circle-clipper right">
                <div class="circle"></div>
            </div>
        </div>

        <div class="spinner-layer spinner-red">
            <div class="circle-clipper left">
                <div class="circle"></div>
            </div><div class="gap-patch">
                <div class="circle"></div>
            </div><div class="circle-clipper right">
                <div class="circle"></div>
            </div>
        </div>

        <div class="spinner-layer spinner-yellow">
            <div class="circle-clipper left">
                <div class="circle"></div>
            </div><div class="gap-patch">
                <div class="circle"></div>
            </div><div class="circle-clipper right">
                <div class="circle"></div>
            </div>
        </div>

        <div class="spinner-layer spinner-green">
            <div class="circle-clipper left">
                <div class="circle"></div>
            </div><div class="gap-patch">
                <div class="circle"></div>
            </div><div class="circle-clipper right">
                <div class="circle"></div>
            </div>
        </div>
    </div>
</div>

{{--<script src="{{ asset("js/bootstrap.js") }}" type="text/javascript"></script>--}}
</body>
</html>