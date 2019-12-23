<?php

	// 获取表单传过来的数据
	$username = $_POST['username'];
	$pwd = $_POST['pwd'];

	// 引入执行类操作库
	require_once $_SERVER['DOCUMENT_ROOT'].'/libs/Db.php';
	// 实例化对象
	$db = new Db();

	// 判断用户名是否存在或者是否正确
	// 执行查询操作用户名
	$user = $db->table('user')->where(array('username'=>$username))->item();
	// 判断是否存在
	if(!$user){
		// 不存在返回一个状态码
		exit(json_encode(array('code'=>1,'msg'=>'该用户不存在')));
	}
	// 判断密码
	if($user['password'] != $_POST['pwd']){
		exit(json_encode(array('code'=>1,'msg'=>'密码不正确')));
	}

	// 开启Session
	session_start();
	// 保存Session
	$_SESSION['user'] = $user;
	exit(json_encode(array('code'=>0,'msg'=>'恭喜，登录成功')));