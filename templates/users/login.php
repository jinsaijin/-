<?php
  require_once("templates/header.php");
?>
<div id="wrap" class="w980">
  <div class="clear"></div>
    <div id="main">
      <div id="main_left" class="mt25">
        <!----修改内容--->
	<center>
		<h3>用户登录</h3><br>
		<form action="?act=loginTodo" method="post" enctype="multipart/form-data">
		用户名：<input type="text" name="username"><br><br>
		密&#12288;码：<input type="password" name="password"><br><br>
		<input type="submit" name="" value="登录" class="btn btn-large">
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
