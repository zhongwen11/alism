<?php
	// 判断用户是否登录了，登录就有权限查看，有权限发表文章
	// 开启session
	session_start();
	$user = isset($_SESSION['user']) ? $_SESSION['user'] : false;

	if(!$user){
		exit(json_encode(array('code'=>1,'msg'=>"你还未登录...")));
	}

	// 对表单提交过来的数据进行保存并且处理
	$data['uid'] = $user['uid'];
	$data['title'] = trim($_POST['title']);
	$data['cid'] = (int)($_POST['cid']);
	$data['keywords'] = trim($_POST['keywords']);
	$data['desc'] = trim($_POST['desc']);
	$data['contents'] = htmlspecialchars(trim($_POST['contents']));
	$data['add_time'] = time();

	// 判断标题
	if(!$data['title']){
		exit(json_encode(array('code'=>1,'msg'=>'没有输入博客标题...')));
	}
	// 判断内容

	// 将数据进行保存到数据库中去
	require_once $_SERVER['DOCUMENT_ROOT'].'/libs/Db.php';
	// 实例化对象
	$db = new Db();

	// 写入数据
	$id = $db->table('article')->insert($data);
	if(!$id){
		exit(json_encode(array('code'=>1,'msg'=>'保存数据失败...')));
	}
	exit(json_encode(array('code'=>0, 'msg'=>'恭喜，保存成功')));
