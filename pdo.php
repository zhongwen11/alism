<?php

	// 连接数据库
	
	$dsn = "mysql:host=127.0.0.1;dbname=myblog";
	$user = "root";
	$pass = "zhongwen";
	// 创建实例对象
	$pdo = new PDO($dsn, $user, $pass);

	// 查询数据
	// $sql = "select * from cates where id=:id";
	//更新数据
	// $sql = "update cates set title='其它分类_PHP' where id=:id";
	// 插入数据
	$sql = "insert into cates(`title`) values(:title)";
	// 准备数据库
	$stmt = $pdo->prepare($sql);
	// 绑定数据防止攻击
	$stmt->bindValue(":title","Aliwen小栈");
	// 开始执行sql
	$stmt->execute();
	// 插入的时候返回最后的id

	$id = $pdo->lastInsertid();
	// $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	echo "<pre>";
	var_dump($id);
	// print_r($rows);