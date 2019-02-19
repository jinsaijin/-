<?php
	require_once("common.php");
//文章列表
	$tbname = DB_PREFIX."blogs";
//文章分类判断
	$where = '';
	if(isset($_GET['cid']) && !empty($_GET['cid'])){
		$cid = intval($_GET['cid']);
		$where = DB_PREFIX."blogs.cid='$cid'";
	}else if(isset($_GET['act']) && $_GET['act'] == 'search'){
//搜索判断
		$keywords = trim($_POST['keywords']);
		$where = "title like '%".$keywords."%' || contents like '%".$keywords."%'";
	}
//查询分类
	$pageid = (!isset($_GET['pageid']) || empty($_GET['pageid']) || intval($_GET['pageid'])<=0) ? 1:intval($_GET['pageid']);
	$perpage = 3;
//分页
	$result = mysql_pagebar($tbname,$pageid,$perpage,$where,"","left join ".DB_PREFIX."users on ".DB_PREFIX."users.uid=".DB_PREFIX."blogs.uid left join ".DB_PREFIX."categories on ".DB_PREFIX."blogs.cid=".DB_PREFIX."categories.cid");
	$arr = $result['arr'];
	$pageStr = $result['pageStr'];
	require_once("templates/index/index.php");
	