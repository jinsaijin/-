<?php
header('Content-type:text/html;charset=utf-8');
	$msg = mysql_error();
	$errno = mysql_errno();
	//mysql错误提示信息数组
$errMsgArr = array(
	1005 => '创建表失败',
	1006 => '创建数据库失败',
	1007 => '数据库已存在，创建数据库失败',
	1008 => '数据库不存在，删除数据库失败',
	1009 => '不能删除数据库文件导致删除数据库失败',
	1010 => '不能删除数据目录导致删除数据库失败',
	1011 => '删除数据库文件失败',
	1012 => '不能读取系统表中的记录',
	1020 => '记录已被其他用户修改',
	1021 => '硬盘剩余空间不足，请加大硬盘可用空间',
	1022 => '关键字重复，更改记录失败',
	1023 => '关闭时发生错误',
	1024 => '读文件错误',
	1025 => '更改名字时发生错误',
	1026 => '写文件错误',
	1032 => '记录不存在',
	1036 => '数据表是只读的，不能对它进行修改',
	1037 => '系统内存不足，请重启数据库或重启服务器',
	1038 => '用于排序的内存不足，请增大排序缓冲区',
	1040 => '已到达数据库的最大连接数，请加大数据库可用连接数',
	1041 => '系统内存不足',
	1042 => '无效的主机名',
	1043 => '无效连接',
	1044 => '当前用户没有访问数据库的权限',
	1045 => '不能连接数据库，用户名或密码错误',
	1048 => '字段不能为空',
	1049 => '数据库不存在',
	1050 => '数据表已存在',
	1051 => '数据表不存在',
	1052 => '连表后字段唯一性不确定',
	1054 => '字段不存在',
    1064 => 'SQL语句语法错误,亲,请仔细检查哦!',
	1065 => '无效的SQL语句，SQL语句为空',
	1081 => '不能建立Socket连接',
	1114 => '数据表已满，不能容纳任何记录',
	1116 => '打开的数据表太多',
	1129 => '数据库出现异常，请重启数据库',
	1130 => '连接数据库失败，没有连接数据库的权限',
	1133 => '数据库用户不存在',
	1141 => '当前用户无权访问数据库',
	1142 => '当前用户无权访问数据表',
	1143 => '当前用户无权访问数据表中的字段',
	1146 => '数据表不存在',
	1147 => '未定义用户对数据表的访问权限',
	1149 => 'SQL语句语法错误',
	1158 => '网络错误，出现读错误，请检查网络连接状况',
	1159 => '网络错误，读超时，请检查网络连接状况',
	1160 => '网络错误，出现写错误，请检查网络连接状况',
	1161 => '网络错误，写超时，请检查网络连接状况',
	1062 => '字段值重复，入库失败',
	1169 => '字段值重复，更新记录失败',
	1177 => '打开数据表失败',
	1180 => '提交事务失败',
	1181 => '回滚事务失败',
	1203 => '当前用户和数据库建立的连接已到达数据库的最大连接数，请增大可用的数据库连接数或重启数据库',
	1205 => '加锁超时',
	1211 => '当前用户没有创建用户的权限',
	1216 => '外键约束检查失败，更新子表记录失败',
	1217 => '外键约束检查失败，删除或修改主表记录失败',
	1226 => '当前用户使用的资源已超过所允许的资源，请重启数据库或重启服务器',
	1227 => '权限不足，您无权进行此操作',
	1235 => 'MySQL版本过低，不具有本功能');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="robots" content="noindex, nofollow, noarchive" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $msg?></title>
<style>
body {
    background: none repeat scroll 0 0 #EBF8FF;
    color: #5E5E5E;
    font-family: Arial,Helvetica,sans-serif;
    margin: 0;
    padding: 0;
    text-align: center;
}
div, h1, h2, h3, h4, p, form, label, input, textarea, img, span {
    margin: 0;
    padding: 0;
}
ul {
    font-size: 0;
    line-height: 0;
    list-style-type: none;
    margin: 0;
    padding: 0;
}
#body {
    margin: 0 auto;
    width: 918px;
}
#main {
    margin: 13px auto 0;
    padding: 0 0 5px;
    text-align: left;
    width: 918px;
}
#contents {
    background: none repeat scroll 0 0 #FFFFFF;
    margin: 13px auto 0;
    padding: 8px 0 1px 9px;
    width: 918px;
}
#contents h2 {
    background: none repeat scroll 0 0 #CFF0F3;
    display: block;
    margin: 0 10px 10px 1px;
    padding: 12px 0 0 30px;
	word-break:break-all;
}
#contents ul {
    font-size: 0;
    line-height: 0;
    padding: 0 0 0 18px;
}
#contents ul li {
    background-color: inherit;
    color: #8F8F8F;
    display: block;
    font: 14px Arial,Helvetica,sans-serif;
    margin: 0;
    padding: 0;
}
#contents ul li span {
    background-color: inherit;
    color: #408BAA;
    display: block;
    font: bold 14px Arial,Helvetica,sans-serif;
    margin: 0;
    padding: 0 0 10px;
}
#oneborder {
    border: 4px solid #EBF3F5;
    font: 14px/23px Arial,Helvetica,sans-serif;
    margin: 0 30px 20px;
    padding: 10px 20px;
    width: 800px;
}
#oneborder span {
    margin: 0;
    padding: 0;
}
#oneborder #current {
    background: none repeat scroll 0 0 #CFF0F3;
}

</style>
</head><body><div id="main"><div id="contents">
<h2><?php echo $msg?><br />错误编号:<?php echo $errno;?><br />错误信息:<?php echo $errMsgArr[$errno];?><br />SQL语句:<?php echo $sql;	?></h2>
</div></div></body></html>