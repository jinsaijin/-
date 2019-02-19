<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>用户列表</title>
</head>
<body>
<center>
	<h2>用户模块-无封装-面向过程</h2>
	<?php
		if(empty($_COOKIE['uid'])){
	?>
	<h3><a href="?act=login">用户登录</a>&nbsp;&nbsp;<a href="?act=reg">用户注册</a></h3>
	<?php
		}else{
	?>
	<h3><a href="?act=login">欢迎<?php echo $_COOKIE['username'] ?>回来</a>&nbsp;&nbsp;<a href="?act=logOut">注销</a></h3>
	<?php
		}
	?>