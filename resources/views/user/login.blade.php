<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="{{ asset("js/jquery-3.2.1.js") }}" type="text/javascript"></script>
    <script src="{{ asset("materialize/js/materialize.js") }}" type="text/javascript"></script>
    <link rel="stylesheet" href="{{ asset("materialize/css/materialize.css") }}">
    <link rel="stylesheet" href="{{ asset("css/bootstrap.css") }}" />
    <style>

    </style>
</head>
<body>
    <div class="container">
        <div class="row" style="padding-top: 200px;">
            <div class="col s3"></div>
            <div class="col s6">
                @if (count($errors))
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                <form action="{{ route('loginP') }}" method="post" class="">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="" type="text" class="validate" name="username">
                            <label for="username">Username</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="" type="password" class="validate" name="password">
                            <label for="password">Password</label>
                        </div>

                    </div>

                    <button type="submit"  class="waves-effect waves-light btn" >Login</button>

                </form>
            </div>
            <div class="col s3"></div>
        </div>

        <script>
            $(document).ready(function () {

            });
        </script>
    </div>


</body>
</html>