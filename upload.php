<?php
	
	// 上传图片
	// 判断发生错误
if($_FILES['file_images']['error'] > 0){
	exit(json_encode(array('errno'=>1,'data'=>[])));
}


$fi = new finfo(FILEINFO_MIME_TYPE);
$mime_type = $fi->file($_FILES['file_images']['tmp_name']);

// 限制文件类型和大小
$allows = array('image/jpeg', 'image/png');
// 判断文件类型是否正确
if(!in_array($mime_type, $allows)){
	exit(json_encode(array('errno'=>1,'data'=>[])));
}
// 上传成功后，将本地的图片进行转移
move_uploaded_file($_FILES['file_images']['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/images/'.$_FILES['file_images']['name']);
//  转移失败
exit(json_encode(array('errno'=>0, 'data'=>['/images/'.$_FILES['file_images']['name']])));