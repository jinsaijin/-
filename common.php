<?php
//公共文件
	header("Content-type:text/html;charset=utf-8");
	date_default_timezone_set('PRC');


//开启session
	session_start();
//session生存周期
	setcookie(session_name(),session_id(),time()+86400*7);

define("KENUO","KONO");//项目常量
require_once("config.php");//配置文件
require_once("include/global.func.php");//全局函数
// ini_set('max_execution_time',0);
//1.PHP链接MYSQL
	$res = mysql_connect(DB_HOST,DB_USER,DB_PWD) or die("亲，MYSQL链接失败");
//2.选择数据库
	mysql_select_db(DB_DATABASE,$res) or die("亲，数据库选择失败");
//3.设置字符集
	mysql_query("set names" .DB_CHARSET);
//流程控制器
	if(!isset($_GET['act']) || empty($_GET['act'])){
		$act = 'lists';
	}else{
		$act = trim($_GET['act']);
	}
//公共数据
	$catArr = mysql_exec("select * from ".DB_PREFIX."categories");
//p($catArr);
	$hotArr = mysql_getAll(DB_PREFIX."blogs","","hits desc","5");
//p($hotArr);
?>
