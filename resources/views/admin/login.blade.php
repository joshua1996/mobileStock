<html>
<head>

</head>
<body>
<form action="{{ route('adminLoginP') }}" method="post">
    {{ csrf_field() }}
    <input type="text" name="adminName" id="">
    <input type="text" name="password" id="">
    <input type="submit" value="Login">
</form>
</body>
</html>