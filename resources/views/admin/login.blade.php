<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="{{ asset("js/jquery-3.2.1.js") }}" type="text/javascript"></script>
    <script src="{{ asset("materialize/js/materialize.js") }}" type="text/javascript"></script>
    <link rel="stylesheet" href="{{ asset("materialize/css/materialize.css") }}">
    <link rel="stylesheet" href="{{ asset("css/bootstrap.css") }}" />
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col s3"></div>
        <div class="col s6">
            <form action="{{ route('adminLoginP') }}" method="post">
                {{ csrf_field() }}
                <div class="row">
                    <div class="input-field col s12">
                        <input id="" type="text" class="validate" name="adminName">
                        <label for="adminName">Admin Name</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="" type="password" class="validate" name="password">
                        <label for="password">Password</label>
                    </div>
                </div>
                <button class="btn waves-effect waves-light" type="submit" name="action">Login</button>
                {{--<input type="submit" value="Login" class="waves-effect waves-light btn">--}}
            </form>
        </div>
        <div class="col s3"></div>
    </div>
</div>

</body>
</html>