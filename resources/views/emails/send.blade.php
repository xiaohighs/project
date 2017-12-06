<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>网站注册确认邮件</title>
</head>
<body>
	欢迎您注册 XiaoHigh 博客， 点击以下链接完成注册
	<a href="http://project.cn/confirm/{{$data['verify']}}">激活</a>,如果该链接失效,请复制以下连接到浏览器中进行激活.

	http://project.cn/confirm/{{$data['verify']}}

</body>
</html>