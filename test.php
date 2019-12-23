<?php
	echo '<pre>';
	require_once $_SERVER['DOCUMENT_ROOT'].'/libs/Db.php';
	// 实例化对象
	$db = new Db();
	// 链式调用数据库中的数据
	// $res = $db->table('article')->where(array('id'=>3, 'title'=>'abcd'))->item();   // table、where、item方法
	// 其实上面的语句在执行的是执行的sql语句： "select * from article where id = 3 limit 1"
	// $res = $db->table('article')->field('id','title')->where(array('id'=>2))->item();
	// $res = $db->table('article')->field('id,title')->where('id>=1')->lists();
	// $res = $db->table('article')->order('id desc')->where('id>=1')->lists();
	// print_r($res);

	// 插入数据
	// $data = array('uid'=>'19','cid'=>'22','title'=>'呼哈拉扯','pv'=>'aa');
	// 执行插入操作
	// $id = $db->table('article')->insert($data);
	// var_dump($id);

	// 删除数据
	// $res = $db->table('article')->where(array('id'=>6))->delete();
	// var_dump($res);
	// "delete from article where id = 7"

	// 更新数据
	// $data = ['title'=>"指定数据更新",'pv'=>125];
	// $res = $db->table('article')->where(array('id'=>5))->update($data);
	// var_dump($res);

	// 查询：select
	// 添加：insert
	// 更新：update
	// 删除：delete

	// 分页查询
//$cid = $_GET['cid'];	// 分类id
$page = $_GET['page'];	// 第几页
$pageSize = 2;			// 每页加载多少条数据

$res = $db->table('article')->field('id,title')->where('id>2')->pages($page,$pageSize,'/test.php');


function input($param){
	if(!isset($_POST[$param])){
		return false;
	}
	$value = $_POST[$param];
	// 做安全处理
	$value = htmlspecialchars($value);
	return $value;
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>分页</title>
<link rel="stylesheet" type="text/css" href="./static/plugins/bootstrap/css/bootstrap.min.css">
</head>
<body>

	<div class="container" style="margin-top: 50px;">
		<p>共查询出<?php echo $res['total']?>条数据</p>
		<table class="table table-bordered">
		 	<thead>
		 		<tr>
		 			<th>ID</th>
		 			<th>标题</th>
		 		</tr>
		 	</thead>
		 	<tbody>
		 		<?php foreach($res['data'] as $article){?>
		 		<tr>
		 			<td><?php echo $article['id']?></td>
		 			<td><?php echo $article['title']?></td>
		 		</tr>
		 		<?php }?>
		 	</tbody>
		</table>
		
		<!--分页-->

		<div>
			<?php echo $res['pages']?>
		</div>
	</div>
</body>
</html>