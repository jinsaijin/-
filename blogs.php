<?php
//日志模块
	require_once("common.php");
	$tbname = DB_PREFIX."blogs";


if($act == 'lists'){//列表
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


	$pageStr = mysql_pagination($pageid,$maxpage);
/*MYSQL执行函数*/
	$arr = "select * from ".DB_PREFIX."blogs left join ".DB_PREFIX."users on ".DB_PREFIX."users.uid=".DB_PREFIX."blogs.uid left join ".DB_PREFIX."categories on ".DB_PREFIX."blogs.cid=".DB_PREFIX."categories.cid limit $start,$perpage";
	$arr = mysql_exec($arr);
// p($arr);
require_once("templates/blogs/lists.php");

}else if($act == 'add'){//添加
//判断登录
	check_login();
	require_once("templates/blogs/add.php");
}else if($act == 'addTodo'){//添加处理
//判断登录
	check_login();
//基本校验
	extract($_POST);
	if(empty($title) || empty($contents) || empty($cid)){
		msg("文章添加信息不完整");
	}
//重名验证
	$findOne = mysql_exec("select * from $tbname where title='".$title."'");
	if(!empty($findOne)){
		msg("亲，标题重名");
	}
//完整
	$_POST['uid'] = $_COOKIE['uid'];
	$_POSt['createTime'] = time();
//入库
	$sql = "insert into $tbname set title='".$title."',contents='".$contents."',cid='".$cid."',uid='".$_POST['uid']."'";
	mysql_exec($sql);
	if(mysql_insert_id()){
		msg("添加成功","?act=lists");
	}else {
		msg("添加失败");
	}
}else if($act == 'update'){//编辑
	$id = intval($_GET['bid']);
	$resOne = mysql_exec("select * from $tbname where bid='".$id."'");
//二维变一维
	$resOne = array_pop($resOne);
		require_once("templates/blogs/update.php");
}else if($act == 'updateTodo'){//编辑处理
	$id = intval($_GET['bid']);
	extract($_POST);
	if(empty($title) || empty($contents)){
		msg("亲，请填写完整");
	}
//重名验证
	$findOne = mysql_exec("select * from $tbname where title='".$title."' && bid !='".$id."'");
	if(!empty($findOne)){
		msg("亲，标题重名");
	}
//更新操作
	$sql = "update $tbname set title='".$title."',contents='".$contents."',cid='".$cid."' where bid ='".$id."'";
	$result = mysql_exec($sql);
	if($result){
		msg("亲，更新成功","?act=lists");
	}else{
		msg("亲，更新失败");
	}
}else if($act == 'delete'){//删除
	$id = intval($_GET['bid']);
	mysql_exec("delete from $tbname where bid='".$id."'");
	if(mysql_affected_rows()>0){
		msg("删除成功","?act=lists");
	}else{
		msg("删除失败");
		}
}else if($act == 'views'){//查看新闻
	$id = intval($_GET['bid']);
//生成一维数组
	$resOne = mysql_exec("select * from $tbname left join ".DB_PREFIX."users on ".DB_PREFIX."users.uid=".DB_PREFIX."blogs.uid left join ".DB_PREFIX."categories on ".DB_PREFIX."blogs.cid=".DB_PREFIX."categories.cid where bid='".$id."'");
	$resOne = array_pop($resOne);
//点击次数加一
	mysql_exec("update $tbname set hits = hits + 1 where bid='".$id."'");
	
//留言列表
	$messageArr = mysql_exec("select * from ".DB_PREFIX."message left join ".DB_PREFIX."users on ".DB_PREFIX."users.uid=".DB_PREFIX."message.uid where bid='".$id."'");
// p($messageArr);
	require_once("templates/blogs/views.php");
}else if($act == 'message'){//添加留言
	extract($_POST);
	// P($_POST);
	$bid = intval($_POST['bid']);
	if(empty($bid) || empty($message)){
		msg("亲，留言填写不完整");
	}
	// if(){
	// msg("亲，留言内容过少");
	// }
	//完整
//入库
	$resId = mysql_add(DB_PREFIX."message",$_POST);
	if($resId>0){
		msg("留言成功","?act=views&bid=".$bid);
	}else {
		msg("留言失败");
	}
}else if($act == 'messagedelete'){
	$mid = intval($_GET['mid']);
//id的真实性和有效性
	$resOne = mysql_checkid(DB_PREFIX."message",$mid);
//删除
	$rows = mysql_exec("delete from ".DB_PREFIX."message where mid='".$mid."'");
 	if(mysql_affected_rows()>0){
		msg("删除成功","?act=views&bid=".$resOne['bid']);
	}else{
		msg("删除失败");
		}
}