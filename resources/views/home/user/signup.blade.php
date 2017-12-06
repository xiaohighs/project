@extends('layouts.home')

@section('content')
<section class="cover fullscreen image-bg overlay" style="height: 670px;">
    <div class="background-image-holder fadeIn" style="background: url(/home/img/home2.jpg);">
        <img alt="image" class="background-image" src="/home/img/home2.jpg" style="display: none;">
    </div>
    <div class="container v-align-transform">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <div class="feature bordered text-center">
                    <h4 class="uppercase">注册</h4>
                    <form class="text-left" method="post" action='/signup'>
                        <input type="text" name="username" placeholder="用户名">
                        <input type="text" name="phone" placeholder="手机号"><button id="send" type="button" class="btn btn-sm">发送验证码</button>
                        <input type="text" name="vcode" placeholder="手机验证码">
                        <input type="text" name="email" placeholder="邮箱">
                        <input type="password" name="password" placeholder="密码">
                        <input type="password" placeholder="确认密码" name="repassword">
                        {{csrf_field()}}
                        <input type="submit" value="Register">
                    </form>
                    <p class="mb0">By signing up, you agree to our
                        <a href="#">Terms Of Use</a>
                    </p>
                </div>
            </div>
        </div>
        <!--end of row-->
    </div>
    <!--end of container-->
</section>

@stop


@section('js')
	<script>
		$('#send').click(function(){
			// $.get('/message', {}, function(data){
			// 	console.log(data);
			// });
			//获取用户输入的手机号  name=phone
			var phone = $('input[name=phone]').val();

			//检测用户的手机号格式是否正确
			var reg = /1\d{10}/;

			//检测
			if(!reg.test(phone)) {
				alert('手机号格式错误!!');
				return;
			}


			$.ajax({
				type:'get',
				data:{phone:phone},
				url: '/message',
				success: function(data){
					alert(data.data.vcode);
					console.log(data);
				}
			});
			//发送短信之后 1分钟之内不能点击该按钮
			$(this).addClass('disabled');
			var t = 5;
			//加倒计时
			var inte = setInterval(function(){
				$('#send').html(t+'秒之后再重新发送');
				t--;
				if(t < 0) {
					//停止定时器
					clearInterval(inte);
					//使按钮可点
					$('#send').removeClass('disabled');
					//更换文字
					$('#send').html('发送验证码');
				}
			}, 1000);

		});
	</script>
@stop