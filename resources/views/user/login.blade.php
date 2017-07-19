<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="{{ asset("js/jquery-3.2.1.js") }}" type="text/javascript"></script>
    <script src="{{ asset("materialize/js/materialize.js") }}" type="text/javascript"></script>
    <link rel="stylesheet" href="{{ asset("materialize/css/materialize.css") }}">
    {{--<link rel="stylesheet" href="{{ asset("css/bootstrap.css") }}" />--}}
    <style>

    </style>
</head>
<body>

    <div class="container">
        <div class="row" style="padding-top: 200px;">
            <div class="col s3"></div>
            <div class="col s6">

                <form action="{{ route('loginP') }}" method="post" class="">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="last_name" type="text" class="validate" name="username">
                            <label for="last_name">Username</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="last_name" type="text" class="validate" name="password">
                            <label for="last_name">Password</label>
                        </div>
                    </div>

                    <div class="row">
                        <input type="submit" value="Login" class="waves-effect waves-light btn" style="margin-top: 20px;">

                    </div>




                </form>
            </div>
        </div>

    </div>


</body>
</html>