<?php
/**
全局函数 BY KONO
**/

/*打印函数*/
function p($var){
	echo '<pre>';
	print_r($var);
	die;
}
/*路由*/
//U('users','index')
//U('users','index',array('cid'=>10,'uid'=>20))
//U('users','index','cid=10&uid=20')
function U($controllerName,$actionName,$args=''){
	$url = "?c={$controllerName}&a={$actionName}";
	if(!empty($args)){
		if(is_array($args)){
			foreach($args as $k=>$v){
				$url .= "&".$k."=".$v;
			}
		}else{
			$url .= "&".$args;	
		}
	}
	return $url;
}

/*判断登录*/
function check_login(){
	if(empty($_COOKIE['uid'])){
		msg("亲,请先登录","users.php?act=login");
	}
}
/*MYSQL执行函数*/
function mysql_exec($sql) {
	$result = mysql_query($sql);
	if(is_bool($result)){//写 
		if($result==false){
			require_once("notice.php");
			die;
		}else{
			return $result;
		}
	}else{//查
		$arr = array();
		while($row = mysql_fetch_assoc($result)){
			$arr[] = $row;//二维数组
		}
		return $arr;
	}
}
//表字段
function mysql_columns($tbname){
	$sql = "show columns from $tbname";
	$arr = mysql_exec($sql);
	$colsArr = array();
	foreach($arr as $key=>$value){
		if($value['Key']=='PRI'){
			$pri = $value['Field'];
		}else{
			$colsArr[] = $value['Field'];
		}
	}	
	return array(
		'colsArr'=>$colsArr,
		'pri'=>$pri
	);
}


//添加数据
function mysql_add($tbname,$insertArr){
	$columnsArr = mysql_columns($tbname);
	$sql = "insert into $tbname set ";
	foreach($insertArr as $key=>$value){
		if(in_array($key,$columnsArr['colsArr'])){
			$sql .= "$key='".$value."',";
		}
	}
	$sql = substr($sql,0,-1);
	mysql_exec($sql);
	return mysql_insert_id();
}
//数据更新
function mysql_update($tbname,$updateArr){
	$columnsArr = mysql_columns($tbname);
	$sql = "update $tbname set ";
	foreach($updateArr as $key=>$value){
		if(in_array($key,$columnsArr['colsArr'])){
			$sql .= "$key='".$value."',";
		}
	}
	$sql = substr($sql,0,-1);
	@$sql .= " where ".$columnsArr['pri']."=".$updateArr[$columnsArr['pri']];
	return mysql_exec($sql);	
}
//删除
function mysql_delete($tbname,$id){
	$columnsArr = mysql_columns($tbname);
	mysql_exec("delete from $tbname where ".$columnsArr['pri']."='".$id."'");
	return mysql_affected_rows();
	
}
//id的有效性和真实性
function mysql_checkid($tbname,$id){
	$columnsArr = mysql_columns($tbname);
	if($id<=0){
		msg("亲,ID的有效性有问题");
	}
	$resOne = mysql_getOne($tbname,$columnsArr['pri']."='".$id."'");
	if(empty($resOne)){
		msg("亲,ID的真实性有问题");
	}
	return $resOne;
}
//查询一条记录
function mysql_getOne($tbname,$where,$join='',$columns='*'){
	$where = empty($where) ? 1 : $where;
	$sql = "select $columns from $tbname $join where $where limit 1";	
	$resOne = mysql_exec($sql);
	//二维变一维
	$resOne = array_pop($resOne);
	return $resOne;
}
//查询多条记录
function mysql_getAll($tbname,$where='',$order='',$limit='',$join='',$columns="*"){
	$where = empty($where) ? 1 : $where;
	$order = empty($order) ? "" : "order by $order";
	$limit = empty($limit) ? "" : "limit $limit";
	$sql = "select $columns from $tbname $join where $where $order $limit";
	return mysql_exec($sql);
}
//查询记录数
function mysql_getCount($tbname, $where = '') {
	$count = mysql_getOne($tbname,$where,"","count(*)");
	return intval($count['count(*)']);
}
//分页
function mysql_pagebar($tbname,$pageid,$perpage,$where='',$order="",$join='',$columns="*"){
	//总共几条
	$count = mysql_getCount($tbname,$where);
	//最大页数
	$maxpage = ceil($count/$perpage);
	$pageid = ($pageid>$maxpage) ? $maxpage:$pageid;
	//起始值
	$start = ($pageid-1)*$perpage;
	$start = ($start<0) ? 0:$start;
	$arr = mysql_getAll($tbname,$where,$order,"$start,$perpage",$join,$columns);
	$pageStr = mysql_pagination($pageid,$maxpage);
	return array(
		'arr'=>$arr,
		'pageStr'=>$pageStr
	);
}
//分页字符串
function mysql_pagination($pageid,$maxpage){
	$str = '';
	if($maxpage>1){
		$str .= '<li><a href="?pageid=1">首页</a></li>';
		$str .= '<li><a href="?pageid='.($pageid-1).'">上一页</a></li>';
		$str .= '<li><a href="?pageid='.($pageid+1).'">下一页</a></li>';
		$str .= '<li><a href="?pageid='.$maxpage.'">末页</a></li>';
	}
	return $str;
}

/*跳转函数*/
function msg($tip,$gotoStr='',$waiting=3){
	if(empty($gotoStr)){
		$gotoStr = "history.go(-1);";	
	}else{
		$gotoStr = "location.href='".$gotoStr."';";	
	}
	require_once("msg.php");
	die;
}
/*
转义函数
*/
function new_addslashes($var){
	$result = get_magic_quotes_gpc();//判断PHP是否自动转义
	if($result){
		return $var;
	}else{
		if(is_array($var)){
			foreach($var as $key=>$value){
				$var[$key] = new_addslashes($value);//递归
			}
		}else{
			$var = addslashes($var);
		}
		return $var;
	}
	
}
/*
反转义
*/
function new_stripslashes($var){
	$result = get_magic_quotes_gpc();//判断PHP是否自动转义
	if($result){
		return $var;
	}else{
		if(is_array($var)){
			foreach($var as $key=>$value){
				$var[$key] = new_stripslashes($value);//递归
			}
		}else{
			$var = stripslashes($var);
		}
		return $var;
	}
	
}


/*去除字符串所有空格*/
function trimall($str){
	$qian=array(" ","　","\t","\n","\r");
	$hou=array("","","","","");
	return str_replace($qian,$hou,$str);
}

/**
* 可以统计中文字符串长度的函数
* @param $str 要计算长度的字符串
* @param $type 计算长度类型，0(默认)表示一个中文算一个字符，1表示一个中文算两个字符
*
*/
function abslength($str){
	if(empty($str)){
		return 0;
	}
	if(function_exists('mb_strlen')){
		return mb_strlen($str,'utf-8');
	}else {
		preg_match_all("/./u", $str, $ar);
		return count($ar[0]);
	}
} 


/**
* 将字符串转换为数组
*
* @param    string  $data   字符串
* @return   array   返回数组格式，如果，data为空，则返回空数组
*/ 
function string2array($data) {  
    if($data == '') return array();  
    @eval("\$array = $data;");  
    return $array;  
}
 /**
* 将数组转换为字符串
*
* @param    array   $data       数组
* @return   string  返回字符串，如果，data为空，则返回空
*/ 
function array2string($data) {  
    if($data == '') return ''; 
    return var_export($data, TRUE);  
} 


//文件上传
//控件名、允许的文件类型和大小、存放的目录
function upload($fileName,$fileType,$fileSize,$uploadDir){
	//判断文件是否上传成功
	if(!is_uploaded_file($_FILES[$fileName]['tmp_name']) || $_FILES[$fileName]['error']==3 || $_FILES[$fileName]['error']==4){
		die("亲,文件上传失败");
	}
	//判断文件大小
	if($_FILES[$fileName]['size']>$fileSize || $_FILES[$fileName]['error']==1 || $_FILES[$fileName]['error']==2){
		die("亲,文件上传过大");
	}
	//判断文件格式
	$pathArr = pathinfo($_FILES[$fileName]['name']);
	$ext = $pathArr['extension'];
	if(!in_array(strtolower($ext),$fileType)){
		die("亲,文件格式有误");
	}
	//移动文件
	$dirName = $uploadDir."/".date("Y")."/".date("m"); 
	if(!file_exists($dirName)){
		@mkdir($dirName,0777,true);
	}
	$wan = $dirName."/".date("Ymd").rand(1000,9999).".".$ext;
	$result = move_uploaded_file($_FILES[$fileName]['tmp_name'],$wan);
	if($result){
		return $wan;
	}else{
		die("亲,文件移动失败");
	}
}


/**
 * 中文截取字符串  输入字符串和截取字数，生成带有...的字符串
 * 说明：该函数套用了网友使用在smarty中的内置函数。
 * $string  = 字符串内容
 * $sublen  = 字符串长度
 * @param str $string 字符串
 * @param str $sublen 截取中文字符串的长度
 * @param str $etc 默认为''
 * @return str  截断后的字符串
*/
function truncate_zh($string, $sublen = 80, $etc = '') {
	   $start = 0;
	   $code = "UTF-8";
	   if ($code == 'UTF-8') {
			  $pa = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/";
			  preg_match_all($pa, $string, $t_string);

			  if (count($t_string[0]) - $start > $sublen)
					 return join('', array_slice($t_string[0], $start, $sublen)) . $etc;
			  return join('', array_slice($t_string[0], $start, $sublen));
	   }
	   else {
			  $start = $start * 2;
			  $sublen = $sublen * 2;
			  $strlen = strlen($string);
			  $tmpstr = '';

			  for ($i = 0; $i < $strlen; $i++) {
					 if ($i >= $start && $i < ($start + $sublen)) {
							if (ord(substr($string, $i, 1)) > 129) {
								   $tmpstr.= substr($string, $i, 2);
							} else {
								   $tmpstr.= substr($string, $i, 1);
							}
					 }
					 if (ord(substr($string, $i, 1)) > 129)
							$i++;
			  }
			  if (strlen($tmpstr) < $strlen) {
					 $tmpstr.= $etc;
			  }
			  return $tmpstr;
	   }
}