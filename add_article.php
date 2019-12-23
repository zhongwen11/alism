<?php
	// 判断用户是否登录了，登录就有权限查看，有权限发表文章
	// 开启session
	session_start();
	$user = isset($_SESSION['user']) ? $_SESSION['user'] : false;

	if(!$user){
		exit('你还未登录，请先登录在操作.......');
	}

	require_once $_SERVER['DOCUMENT_ROOT'].'/libs/Db.php';
	// 实例化对象
	$db = new Db();

	$cates = $db->table('cates')->lists();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>发表博客</title>
	<link rel="stylesheet" type="text/css" href="./static/plugins/bootstrap/css/bootstrap.min.css">
	<script type="text/javascript" src="./static/plugins/bootstrap/js/jquery.min.js"></script>
	<script type="text/javascript" src="./static/plugins/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="./static/js/UI.js"></script>
	<script type="text/javascript" src="./static/plugins/wangEditor/release/wangEditor.min.js"></script>
	<style type="text/css">
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
	<from class="from">
		<div class="input-group">
		  <span class="input-group-addon" id="sizing-addon2">博客标题：</span>
		  <input type="text" class="form-control" placeholder="请输入博客标题..." name="title">
		</div>
		<div class="input-group">
		  <span class="input-group-addon" id="sizing-addon2">博客分类：</span>
		  <select class="form-control" name="cid">
		  	<?php foreach($cates as $cate ){?>
		  			<option value="<?php echo $cate['id']?>"><?php echo $cate['title'];?></option>
		  	<?php }?>
		  </select>
		</div>
		<div class="input-group">
		  <span class="input-group-addon" id="sizing-addon2">关键字：</span>
		  <input type="text" class="form-control" placeholder="请输入博客关键字..." name="keywords">
		</div>
		<div class="input-group">
		  <span class="input-group-addon" id="sizing-addon2">博客描述：</span>
		  <input type="text" class="form-control" placeholder="请输入博客描述..." name="desc">
		</div>
		<div class="input-group">
		  <span class="input-group-addon" id="sizing-addon2">博客内容：</span>
		   <div id="editor">
        		<p>写入你要写入的内容呀...</p>
   		 </div>
		</div>
		<button class="btn btn-primary" style="float: right;" onclick="save();return false;">保存</button>
	</from>
</body>
</html>
<script type="text/javascript">
	 var editor;
        // 初始化富文本编辑器
        function initEditor(){
        	var E = window.wangEditor;
	        editor = new E('#editor');
	        // 或者 var editor = new E( document.getElementById('editor') )
	        editor.customConfig.uploadImgServer = '/upload.php';
	        editor.customConfig.uploadFileName = 'file_images';
	        editor.customConfig.zIndex = 1;
	        editor.customConfig.customAlert = function(info){
	        	// info 是需要提示内容
	        	UI.alert({msg:info,icon:'error'});
	        }
	        editor.create();
        }
        initEditor();

        // 提交数据
        function save(){
        	//创建对象
        	var data = new Object;
        	data.title = $.trim($('input[name="title"]').val());
        	data.cid = $.trim($('select[name="cid"]').val());
        	data.keywords = $.trim($('input[name="keywords"]').val());
        	data.desc = $.trim($('input[name="desc"]').val());
        	data.contents = editor.txt.html();
        	// 在JS端验证
        	// 必须要有博客标题
        	if(data.title == ""){
        		UI.alert({msg:"请输入博客的标题...",icon:"error"});
        		return;
        	}
        	// 必须要有博客内容
        	if(data.contents == "<p><br></p>"){
        		UI.alert({msg:"请输入博客内容...",icon:"error"});
        		return;
        	}
        	// 提交数据处理并保存到数据库
        	$.post('/service/save_article.php',data,function(res){
        		// 判断是否插入成功数据
        		if(res.code>0){
        			UI.alert({msg:res.msg,icon:'error'});
        		}else{
        			UI.alert({msg:res.msg,icon:'true'});
        			setTimeout(function(){parent.window.location.reload();}, 1000); // 跳转刷新页面
        		}
        	},'json');
        }
</script>