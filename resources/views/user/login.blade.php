<html>
<head>

</head>
<body>
<form action="{{ route('loginP') }}" method="post">
    {{ csrf_field() }}
    <input type="text" name="username" id="">
    <input type="text" name="password" id="">
    <input type="submit" value="Login">
</form>
</body>
</html>