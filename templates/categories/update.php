<?php
  require_once("templates/header.php");
?>
<div id="wrap" class="w980">
  <div class="clear"></div>
    <div id="main">
      <div id="main_left" class="mt25">
        <!----修改内容--->
	<center>
		<form action="?act=updateTodo&cid=<?php echo $resOne['cid']?>" method="post" enctype="multipart/form-data">
		分类名：<input type="text" name="cname" value="<?php echo $resOne['cname']?>"><br><br>
		<input type="submit" name="" value="更新" class="btn btn-large">
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
