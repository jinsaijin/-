<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<meta content="IE=7" http-equiv="X-UA-Compatible">
<title>提示信息</title>
<style type="text/css">
*{ padding:0; margin:0; font-size:12px}
a:link,a:visited{text-decoration:none;color:#0068a6}
a:hover,a:active{color:#ff6600;text-decoration: underline}
.showMsg{border: 1px solid #1e64c8; zoom:1; width:450px; height:172px;position:absolute;top:44%;left:50%;margin:-87px 0 0 -225px}
.showMsg h5{background-image: url(templates/img/msg.png);background-repeat: no-repeat; color:#fff; padding-left:35px; height:25px; line-height:26px;*line-height:28px; overflow:hidden; font-size:14px; text-align:left}
.showMsg .content{ padding:46px 12px 10px 45px; font-size:14px; height:64px; text-align:left}
.showMsg .bottom{ background:#e4ecf7; margin: 0 1px 1px 1px;line-height:26px; *line-height:30px; height:26px; text-align:center}
.showMsg .ok,.showMsg .guery{background: url(templates/img/msg_bg.png) no-repeat 0px -560px;}
.showMsg .guery{background-position: left -460px;}
</style>
</head>
<body>
<div style="text-align:center" class="showMsg">
	<h5>提示信息</h5>
    <div style="display:inline-block;display:-moz-inline-stack;zoom:1;*display:inline;max-width:330px" class="content guery"><?php echo $tip;?>
    </div>
    <div class="bottom">
    	<a href="javascript:<?php echo($gotoStr); ?>" id="href">如果您的浏览器没有自动跳转，请点击这里　等待时间： <b id="wait"><?php echo $waiting;?></b></a>
	 </div>
</div>

<script type="text/javascript">
var wait = document.getElementById('wait');
var href = document.getElementById('href').href;
var interval = setInterval(function(){
	var time = --wait.innerHTML;
	if(time <= 0) {
		<?php echo $gotoStr;?>
		clearInterval(interval);
	};
}, 1000);
</script>

</body></html>