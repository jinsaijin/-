<?php
  require_once("templates/header.php");
?>
<div id="wrap" class="w980">
  <div class="clear"></div>
    <div id="main">
      <div id="main_left" class="mt25">
        <!----修改内容--->
			<center>
			<h3>用户更新</h3><br>
			<form action="?act=updateTodo&uid=<?php echo $resOne['uid']?>" method="post" enctype="multipart/form-data">
				用户名：<input type="text" name="username" value="<?php echo $resOne['username']?>"><br><br>
				密&nbsp;码：<input type="password" name="password"><br>亲，密码置空不修改<br><br>	
				性&nbsp;别：<input type="radio" name="sex" value="m" <?php if($resOne['sex'] == 'm') echo 'checked'?>/>男&nbsp;|&nbsp;<input type="radio" name="sex" value="f" <?php if($resOne['sex'] == 'f') echo 'checked'?>/>女<br><br>
				爱&nbsp;好：<input type="checkbox" name="fav[]" value="reading" <?php if(strstr($resOne['fav'],'reading')) echo 'checked'?>> 阅读&nbsp;<input type="checkbox" name="fav[]" value="sports" <?php if(strstr($resOne['fav'],'sports')) echo 'checked'?>> 体育&nbsp;<input type="checkbox" name="fav[]" value="shopping" <?php if(strstr($resOne['fav'],'shopping')) echo 'checked'?>> 购物&nbsp;<br><br>
				城&nbsp;市：<select name="city">
					<option value="hefei" <?php if($resOne['city'] == 'hefei') echo 'selected'?>>合肥</option>
					<option value="anqing" <?php if($resOne['city'] == 'anqing') echo 'selected'?>>安庆</option>
				</select><br><br>
				头&nbsp;像：<input type="file" name="avatar"><br>
				<input type="submit" name="" value="我要更新" class="btn btn-large"><br>
			</form>
</center>
        </div>
        <?php
            require_once("templates/sidebar.php");
        ?>
      </div>
  </div>
</div>
<?php
  require_once("templates/footer.php");
?>
