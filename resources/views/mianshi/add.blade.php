<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
<form method="post" action="{{url('mianshi/do_add')}}" enctype="multipart/form-data">

    面试公司：<input type="text" name="name"></br>
    地址：<input type="text" name="address"></br>
    商品图片：<input type="file" name="pic"></br>
    面试时间:<input type="date" name="time" id=""></br>
    <input type="submit" value="提交">
</form>
</body>
</html>