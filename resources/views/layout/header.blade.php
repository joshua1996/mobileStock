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
    <title>SB Admin v2.0 in Laravel 5</title>

    <script src="{{ asset("js/jquery-3.2.1.js") }}" type="text/javascript"></script>
    <script src="{{ asset("js/tether.min.js") }}" type="text/javascript"></script>
    <script src="{{ asset("materialize/js/materialize.js") }}" type="text/javascript"></script>
    {{--<script src="{{ asset("js/jquery-ui.js") }}" type="text/javascript"></script>--}}

    {{--<link rel="stylesheet" href="{{ asset("css/bootstrap.css") }}" />--}}
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
</head>
<body>
@yield('body')

{{--<script src="{{ asset("js/bootstrap.js") }}" type="text/javascript"></script>--}}
</body>
</html>