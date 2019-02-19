<?php
//用户模块
	require_once("common.php");
	$tbname = DB_PREFIX."users";//表名
	if($act == 'lists'){//用户列表
/*分页*/
	$pageid = (!isset($_GET['pageid']) || empty($_GET['pageid']) || intval($_GET['pageid'])<=0) ? 1:intval($_GET['pageid']);
	$perpage = 4;
	//总共几条
	$count = mysql_exec("select count(*) from $tbname");
	$count = intval($count[0]['count(*)']);
	//最大页数
	$maxpage = ceil($count/$perpage);
	$pageid = ($pageid>$maxpage) ? $maxpage :$pageid;
	//起始值
	$start = ($pageid-1)*$perpage;
	//分页字符串
	$pageStr = mysql_pagination($pageid,$maxpage);
//MYSQL查询函数
	$arr = mysql_exec("select * from $tbname limit $start,$perpage");
//p($arr);
require_once("templates/users/lists.php");

}else if($act == 'reg'){//用户注册
	require_once("templates/users/reg.php");
}else if($act == 'regTodo'){//注册处理
//验证码
	$code = ($_POST['code']);
	if(empty($code)){
		msg("亲，验证码未填写");
	}
	if(strtoupper($code)!=$_SESSION['code']){
		msg("亲，验证码填写错误");
	}
//基本验证

	extract($_POST);
	if(empty($username) || empty($password) || empty($sex) || empty($fav) || empty($city)){
		msg("亲，用户信息注册不完整；");
	}
//用户名重名验证
	$findOne = mysql_exec("select * from $tbname where username='".$username."'");
	if(!empty($findOne)){
		msg("亲，用户名已存在，请换一个试试");
	}
		

//头像上传
	if($_FILES['avatar']['error'] != 4){
	$fileName = "avatar";
	$fileType = array("jpg","png","gif","jpeg");
	$fileSize = 1*1024*1024; //B
	$uploadDir = "uploads";
	$avatar = upload($fileName,$fileType,$fileSize,$uploadDir);
	}else{
		$avatar = '';
	}
//完整
	$password = md5($password);
	$fav = implode(',',$fav);
//入库
	$sql = "insert into $tbname set username='".$username."',password='".$password."',sex='".$sex."',fav='".$fav."',city='".$city."',avatar='".$avatar."',regtime=".time();
	mysql_exec($sql);
	if(mysql_insert_id()){
		msg("亲，用户注册成功","?act=lists");
	}else{
		msg("亲，用户注册失败");
	}
}else if($act == 'login'){//登录
	require_once("templates/users/login.php");
}else if($act == 'loginTodo'){//登录处理
//基本验证
	extract($_POST);
	if(empty($username) || empty($password)){
		msg("亲，用户登录信息不完整");
	}
//验证用户名
	$findOne = mysql_exec("select * from $tbname where username='".$username."'");
	//二维变一维
	$findOne = array_pop($findOne);
	// p($findOne);
	if(empty($findOne)){
	msg("亲，用户名不存在；");
	}
//验证密码
	if($password != $findOne['password']){
		msg("亲，密码错误");
	}
//cookie
	setcookie("uid",$findOne['uid'],time()+86400*7);
	setcookie("username",$findOne['username'],time()+86400*7);
	msg("亲，用户登录成功","?act=lists");
}else if($act == 'logOut'){//注销
	setcookie("uid",'');
	setcookie("username",'');
	msg("亲，用户注销成功","index.php");
}else if($act == 'update'){//更新
/*ID的有效性和真实性*/
	$id = intval($_GET['uid']);
	if($id<0){
		msg("亲，ID的有效性有问题");
	}
	$resOne = mysql_exec("select * from $tbname where uid='".$id."'");
	if(empty($resOne)){
		msg("亲，ID的真实性有问题");
	}
/*ID的有效性和真实性*/
//二维变一维
	$resOne = array_pop($resOne);
require_once("templates/users/update.php");
}else if($act == 'updateTodo'){//更新处理
/*ID的有效性和真实性*/
	$id = intval($_GET['uid']);
	if($id<0){
		msg("亲，ID的有效性有问题");
	}
	$resOne = mysql_exec("select * from $tbname where uid='".$id."'");
	if(empty($resOne)){
		msg("亲，ID的真实性有问题");
	}
/*ID的有效性和真实性*/

//基本验证

	extract($_POST);
	if(empty($username) || empty($sex) || empty($fav) || empty($city)){
		msg("亲，用户更新信息填写不完整");
	}
//用户名更新重名
	$findOne = mysql_exec("select * from $tbname where username='".$username."' && uid !='".$id."'");
	if(!empty($findOne)){
		msg("亲，用户名更新重名");
	}
//头像上传
	if($_FILES['avatar']['error'] != 4){
	$fileName = "avatar";
	$fileType = array("jpg","png","gif","jpeg");
	$fileSize = 1*1024*1024; //B
	$uploadDir = "uploads";
	$avatar = upload($fileName,$fileType,$fileSize,$uploadDir);
	}else{
		$avatar = '';
	}
//完整
	$fav = implode(",", $fav);
	if(empty($password)){
	$sql = "update $tbname set username='".$username."',sex='".$sex."',fav='".$fav."',city='".$city."',avatar='".$avatar."' where uid ='".$id."'";
	}else {
	$sql = "update $tbname set username='".$username."',password='".$password."',sex='".$sex."',fav='".$fav."',city='".$city."',avatar='".$avatar."' where uid ='".$id."'";
	}	
	$result = mysql_exec($sql);
	if($result){
		msg("亲，更新成功","?act=lists");
	}else{
		msg("亲，更新失败");
	}
}else if($act == 'delete'){//删除
	$id = intval($_GET['uid']);
//删除操作
	mysql_exec("delete from $tbname where uid='".$id."'");
	if(mysql_affected_rows()>0){
		msg("删除成功！","?act=lists");
	}else{
		msg("删除失败！");
	}
}
?>