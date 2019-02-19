<?php
//分类模块
	require_once("common.php");
	$tbname = DB_PREFIX."categories";

if($act == 'lists'){//列表
/*分页*/
	$pageid = (!isset($_GET['pageid']) || empty($_GET['pageid']) || intval($_GET['pageid'])<=0) ? 1:intval($_GET['pageid']);
	$perpage = 5;
	//总共几条
	$count = mysql_exec("select count(*) from $tbname");
	$count = intval($count[0]['count(*)']);
	//最大页数
	$maxpage = ceil($count/$perpage);
	$pageid = ($pageid>$maxpage) ? $maxpage :$pageid;
	//起始值
	$start = ($pageid-1)*$perpage;

	$pageStr = mysql_pagination($pageid,$maxpage);
	$arr = "select * from $tbname limit $start,$perpage";
	$arr = mysql_exec($arr);
require_once("templates/categories/lists.php");
}else if($act  == 'add'){//分类添加
	require_once("templates/categories/add.php");
}else if($act == 'addTodo'){//添加操作
	$cname = trim($_POST['cname']);
	if(empty($cname)){
		msg("亲，分类名不能为空");
	}
//重名验证
	$findOne = mysql_exec("select * from $tbname where cname='".$cname."'");
	if(!empty($findOne)){
		msg("亲，分类名已存在");
	}
//入库
	$sql = "insert into $tbname set cname='".$cname."'";
	mysql_exec($sql);
	if(mysql_insert_id()){
		msg("添加成功","?act=lists");
	}else{
		msg("添加失败");
	}
}else if($act == 'update'){//更新
	$id = intval($_GET['cid']);
	$resOne = mysql_exec("select * from $tbname where cid='".$id."'");
//二维变一维
	$resOne = array_pop($resOne);
	require_once("templates/categories/update.php");
}else if($act == 'updateTodo'){//更新处理
	$id = intval($_GET['cid']);
	extract($_POST);
	if(empty($cname)){
		msg("亲，分类名不能为空");
	}
//重名
	$findOne = mysql_exec("select * from $tbname where cname='".$cname."' && cid !='".$id."'");
	if(!empty($findOne)){
		msg("亲，更新重名");
	}
//更新操作
	$sql = "update $tbname set cname='".$cname."' where cid ='".$id."'";
	$result = mysql_exec($sql);
	if($result){
		msg("亲，更新成功","?act=lists");
	}else{
		msg("亲，更新失败");
	}
}else if($act == 'delete'){//删除
	$id = intval($_GET['cid']);
	mysql_exec("delete from $tbname where cid='".$id."'");
	if(mysql_affected_rows()>0){
		msg("删除成功","?act=lists");
	}else{
		msg("删除失败");
	}
}
?>