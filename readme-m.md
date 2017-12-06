## 后台搭建的步骤

### 后台搭建
1. 安装laravel框架
2. 配置虚拟主机
3. 配置路由
```
Route::get('/admin','AdminController@index');
```
4. 然后创建控制器 并创建方法.
5. 在方法中解析模板
6. 创建模板
7. 将写好的模板内容复制到`blade`文件中
8. 将css js img所在的目录内容复制到网站根目录下(public), 然后更名
9. 将blade文件中的资源路径进行调整.


### 用户模块儿管理
0. 数据库配置
1. 建表
2. 创建资源控制器
3. 创建路由规则
4. 修改后台的菜单链接
5. 在创建的模板中需要使用模板继承. 继承后台首页模板
6. 在主模板中打标记. 比如标题的位置, 还有内容的位置. 
7. 在新的模板中替换内容,显示当前添加的标题和表单内容. 针对表单内容可以直接到样式模板中去复制.

8. 列表页 读取数据  `paginate(10)`
9. 分页页码的显示  {{$users->appends(['num'=>$num, 'keywords'=>$keywords])->links()}}

10. 用户修改成功之后的提醒

```
//php代码
return redirect('/user')->with('msg','添加成功');
```

```
//html代码
@if(session('msg'))
<div class="alert alert-info">
    {{session('msg')}}
</div>
@endif
```

11. 删除. 拼接表单  `action` `method` `csrf_field()`  `method_field("DELETE")`



### 数据填充
1. 创建注入器文件 (类文件)  `database/seeds/`
2. 创建注入代码  `str_random`是一个函数用来创建随机位数的字符串.
3. 在基础的注入器中进行调用 `database/seeds/DatabaseSeeder.php` 
```
$this->call(UserTableSeeder::class);
```
4. 运行artisan命令
```
php artisan db:seed
```

### sublime artisan 插件
1. `ctrl + shift + p` 
2. 输入`install package`
3. `laravel 5 artisan`

### 百度编辑器的使用
1. 引入三个js文件. (注意路径正确)
2. 创建编辑器的容器 `<script id="editor" type="text/plain" name="content" style="width:1024px;height:500px;"></script>`
3. 实例化编辑器
```
var ue = UE.getEditor('editor');
```

### 流程图
1. 软件选择 `亿图` `microsoft visou`
2. 图形认识
	* 椭圆形  开始和结束
	* 长方形  单个的流程
	* 菱形    判断

### 注意
1. siderBar 侧边栏



### 注意点
1. 如果目录中存在访问的文件或者文件夹,此时服务器会去访问文件而不会走框架的路由
2. 表单的元素调整. action  enctype查看  csrf_field();
3. `encrypt` 是一个类似于 md5的加密函数.
4. 在数据库中存储图片路径时,尽量存储成绝对路径.
5. artisan 命令执行时, 也会运行项目中的代码, 所以代码如果有错误, 命令行下也会报错.
6. `return redirect('/')->with('msg','添加成功');` with的作用是用来设置session的.
7. js代码`return false` 阻止元素的默认行为.
8. php的字符串函数 
```
trim ltrim rtrim
str_shuffle
explode implode
str_replace
strpos  strrpos
strtoupper strtolower  ucwords 
substr strstr strrchr
str_repeat
md5
```
9. 微信 `xiaohigher`  手机号 `18311422275`
10. 页面加载较慢的解决方案
	* 查看网络控制台
	* 找出请求较慢的链接
	* 做出响应的处理. 可以删除,也可以修改.

11. compact 是一个函数, 能将数据转成一个数组.
12. 前台页面主要是用来给用户展现内容的, 后台主要是管理数据的.
13. 流程图绘制.
14. 一般用 `00...` 来代表成功

## 邮件发送

1. 配置文件修改 `.env`
```
MAIL_DRIVER=smtp
MAIL_HOST=smtp.163.com
MAIL_PORT=25
MAIL_USERNAME=love_lamp@163.com
MAIL_FROM_ADDRESS=love_lamp@163.com
MAIL_FROM_NAME=xiaohigh
MAIL_PASSWORD=abc123456
MAIL_ENCRYPTION=null
```

2. 控制器代码调用
```
Mail::send('emails.send', [], function ($message) {
    //标题
	$message->subject('ABC');
	//接收者
    $message->to('779498590@qq.com');
});
```

3. 创建模板 `resources/views/emails/send.blade.php`
```
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>网站注册确认邮件</title>
</head>
<body>
	欢迎您注册 XiaoHigh 博客， 点击以下链接完成注册
	<a href="http://weibo.cn/confirm/asdfadfadfafda">激活</a>
</body>
</html>
```

### 邮件发送的注意点
1. 建议使用 163 邮箱
2. 开启smtp/pop3/imap 
3. 设置客户端密码 (发送密码)
4. 很可能会被平台认为是垃圾邮件. 如果收件箱中么有的话,可以到垃圾箱中查看.