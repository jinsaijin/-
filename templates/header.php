<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<head>
<title>个人博客网站</title>
<link rel="stylesheet" type="text/css" href="templates/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="templates/css/basic.css">
<link rel="stylesheet" type="text/css" href="templates/css/boke.css">
<style>
p {
	line-height: 1.6em;
	padding: 5px 0 10px;
}
#reg-content label, #login-content label {
	float: left;
	font-family: Helvetica, Arial, sans-serif;
	font-size: 14px;
	font-weight: normal;
	padding: 0;
	width: 70px;
}
form label {
	display: block;
	font-weight: bold;
	padding: 0 0 10px;
}
</style>
</head>

<body>
<div id="header">
  <div id="logo"> <a href="#"></a></div>
  <div id="title">
    <ul>
      <li><a href="index.php">首页</a>&nbsp; <a href="users.php">用户管理</a>&nbsp; <a href="blogs.php">日志管理</a> <a href="categories.php">分类管理</a>&nbsp;
        &nbsp;
        <?php
        	if(empty($_COOKIE['username'])){	
        ?>
        <a href="users.php?act=reg" id="userReg">注册</a>&nbsp;<a href="users.php?act=login" id="userLogin">登录</a>
        <?php
        	}else{	
        	$avatar = empty($_COOKIE['avatar']) ? "templates/img/default.gif" : $_COOKIE['avatar'];
        ?>
		<img src="<?php echo $avatar ?>" style='width: 30px;height: 30px;'> <a href="users.php?act=reg" id="userReg">欢迎  <?php echo $_COOKIE['username']?>  回来</a>&nbsp;<a href="users.php?act=logOut" id="userlogOut">注销</a>
        <?php
        	}
        ?>
       </li> 
    </ul>
  </div>
</div>
<!--------------------header end------------------->
<!-----------------------clear--------------------->
<div class="clear"></div>
<!-----------------------clear end---------------->
<!---------------------banner---------------------->
<div id="banner"> </div>
<!--------------------banner  end------------------>