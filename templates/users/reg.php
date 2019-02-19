<?php
  require_once("templates/header.php");
?>
<div id="wrap" class="w980">
  <div class="clear"></div>
    <div id="main">
      <div id="main_left" class="mt25">
        <!----修改内容--->
        <center>
          <h3>用户注册</h3><br>
          <form action="?act=regTodo" method="post" enctype="multipart/form-data">
            用户名：<input type="text" name="username"><br><br>
            密&#12288;码：<input type="password" name="password"><br><br>
            性&nbsp;别：<input type="radio" name="sex" value="m" checked="checked">男&nbsp;|&nbsp;<input type="radio" name="sex" value="f" >女<br><br>
            爱&nbsp;好：<input type="checkbox" name="fav[]" value="reading"> 阅读&nbsp;<input type="checkbox" name="fav[]" value="sports"> 体育&nbsp;<input type="checkbox" name="fav[]" value="shopping"> 购物&nbsp;<br><br>
            城&#12288;市：<select name="city">
              <option value="hefei">合肥</option>
              <option value="anqing">安庆</option>
            </select><br>
            头&nbsp;像：<input type="file" name="avatar"><br>
            验证码:<input type="text" name="code" style="width:142px;" maxlength="4"> <img style="cursor:pointer;position:relative;top:-5px;" onclick="refreshImage(this);" src="captcha.class.php">
<script type="text/javascript">
  function refreshImage(obj){
    //obj指代当前的对象
    obj.src="captcha.class.php?t="+Math.random(); //t的作用防止浏览器缓存
    return false;
  }
</script>

            <input type="submit" name="" value="我要注册" class="btn btn-large"><br>
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
