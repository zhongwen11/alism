<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>登录页面</title>
	<link rel="stylesheet" type="text/css" href="./static/plugins/bootstrap/css/bootstrap.min.css">
	<script type="text/javascript" src="./static/plugins/bootstrap/js/jquery.min.js"></script>
	<script type="text/javascript" src="./static/plugins/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="./static/js/UI.js"></script>
	<style type="text/css">
		.title{
			margin-top: 10px;
		}
		img{
			width: 80px;
			height: 80px;
			border-radius: 50%;
			display: inline-block;
		}
		.from{
			margin: 30px 0px;
		}
		.from .input-group{
			margin: 10px 0px;
		}
		.from .input-group .input-group-addon{
			background-color: #fff;
		}
	</style>
</head>
<body>
	<div class="title">
		<img src="./static/img/avatar.png" alt="头像" class="img-responsive center-block">
	</div>	
	
	<div class="from">

		<div class="input-group">
		  <span class="input-group-addon" id="sizing-addon2">用户名：</span>
		  <input type="text" class="form-control" placeholder="Username" name="username">
		</div>
		<div class="input-group">
		  <span class="input-group-addon" id="sizing-addon2">密&nbsp;&nbsp;&nbsp;&nbsp;码：</span>
		  <input type="password" class="form-control" placeholder="password" name="pwd">
		</div>

	</div>  

	<button type="button" class="btn btn-primary btn-lg btn-block" onclick="login()">登录</button>
</body>
</html>
<script type="text/javascript">
	// 登录验证
	function login(){
		var username = $.trim($('input[name="username"]').val());
		var pwd = $.trim($('input[name="pwd"]').val());
		// 判断
		if(username == ''){
			UI.alert({msg:'用户名不能为空',icon:'error'});
			return;
		}
		if(pwd == ''){
			UI.alert({msg:'密码不能为空',icon:'error'});
			return;
		}
		//提交验证
		$.post('/service/dologin.php',{username:username,pwd:pwd},function(res){
			// 判断后台的传过来的状态
			if(res.code>0){
				// false
				UI.alert({msg:res.msg,icon:'error'});
			}else{
				// true
				UI.alert({msg:res.msg,icon:'true'});
				//执行回调函数，跳转页面到指定的页面
				setTimeout(function(){parent.window.location.reload();},1000);
			}
		},'json');// 执行回调函数，以json格式返回数据
	}
</script>