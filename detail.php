<?php
	session_start();
	$user = isset($_SESSION['user']) ? $_SESSION['user'] : false;
	// 文章详情
	$aid = (int)$_GET['aid'];
	// 读取数据库的数据
	require_once $_SERVER['DOCUMENT_ROOT'].'/libs/Db.php';
		// 实例化对象
	$db = new Db();

	// 读取数据
	$article = $db->table('article')->where(array('id'=>$aid))->item();

?>

<!DOCTYPE html>
<html>
<head>
	<title><?php echo $article['title']?></title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="./static/plugins/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="./static/css/style.css">
	<script type="text/javascript" src="./static/plugins/bootstrap/js/jquery.min.js"></script>
	<script type="text/javascript" src="./static/plugins/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="./static/js/UI.js"></script>
	<style type="text/css">
		.content-list .title{
			margin: 15px 0;
			text-align: center;
			font-size: 22px;
			color: #666;
		}
		.content-list .time{
			float: right;
			font-size: 12px;
			color: grey;
		}
		.contents img{
			text-align: center;
		}
	</style>
</head>
<body>
	<div class="header">
		<div class="container">
			<span class="title">小栈博客</span>
			<div class="search">
				 <div class="input-group">
				    <input type="text" class="form-control" placeholder="输入博客标题...">
				    	<span class="input-group-btn">
				        	<button class="btn btn-default" type="button">搜索</button>
				        </span>
				</div><!-- /input-group -->
			</div>
			<div class="login-reg">
				<?php if($user){?>
					<span><?php echo $user['username']?></span>&nbsp;<a href="javascript:;" onclick="logout()">退出</a>
				<?php }else{?>
				<button type="button" class="btn btn-success" onclick="login()">登录</button>
			<?php }?>
				<button type="button" class="btn btn-warning" onclick="add_article()">发表博客</button>
			</div>
		</div>
	</div>

	<div class="main container">
		<div class="col-lg-3 col-xs-3 left-container">
			<p class="cates">博客分类</p>
			<div class="cate-list">
				<div class="cate-item"><a href="/index.php?cid=1">编程语言</a></div>
				<div class="cate-item"><a href="/index.php?cid=2">软件设计</a></div>
				<div class="cate-item"><a href="/index.php?cid=3">Web前端</a></div>
				<div class="cate-item"><a href="/index.php?cid=4">企业信息化</a></div>
				<div class="cate-item"><a href="/index.php?cid=5">安卓开发</a></div>
				<div class="cate-item"><a href="/index.php?cid=6">IOS开发</a></div>
				<div class="cate-item"><a href="/index.php?cid=7">软件工程</a></div>
				<div class="cate-item"><a href="/index.php?cid=8">数据库技术</a></div>
				<div class="cate-item"><a href="/index.php?cid=9">操作系统</a></div>
				<div class="cate-item"><a href="/index.php?cid=10">其他分类</a></div>
			</div>
		</div>
		<div class="col-lg-9 col-xs-9 contents">
			<div class="nav">
				<a href="/index.php?cid=11">热门</a>
				<a href="" class="active">最新</a>
			</div>
			
			<div class="content-list">
				<p class="title"><?php echo $article['title'];?></p>
				<p class="time"><?php echo date('Y-m-d H:i:s',$article['add_time']);?></p>
				<div style="clear: both;"></div>
				<hr>
				<div class="contents">
					<?php echo htmlspecialchars_decode($article['contents']);?>
				</div>
			</div>

		</div>
	</div>

	

</body>
</html>

<script type="text/javascript">
	// 点击登录出现模态框按钮
	function login(){
		// UI.alert({title: '系统提示', icon: 'true', msg: '请输入用户名...'});
		UI.open({title: '登录',url: './login.php',width: 300, height: 330});
	}

	// 退出登录
	function logout(){
		if(!confirm('确定要退出吗？')){
			return;
		}
		// 传入logout页面进行处理
		$.get('/service/logout.php',{},function(res){
			if(res.code>0){
				UI.alert({msg:res.msg,icon:'error'});
			}else{
				UI.alert({msg:res.msg,icon:'true'});
				setTimeout(function(){parent.window.location.reload();},1000);
			}
		},'json');
	}

	// 发表博客
	function add_article(){
		UI.open({title: '发表博客',url: './add_article.php',width: 820, height: 620});
	}
</script>