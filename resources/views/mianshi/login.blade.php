<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>前台登录</title>
</head>
<body>
<form action="{{url('mianshi/do_login')}}" method="post">
    用户名：<input type="text" name="name" id=""></br>
    密码：<input type="password" name="password" id=""><br>
    <input type="submit" value="登录">
</form>
</body>
</html>