<?php
  require_once("templates/header.php");
?>
<div id="wrap" class="w980">

  <!-----------------------clear--------------------->
  <div class="clear"></div>
    <div id="main">
      <div id="main_left">
        <!----修改内容---->
<script charset="utf-8" src="kindeditor/kindeditor.js"></script>
<script charset="utf-8" src="kindeditor/lang/zh_cn.js"></script>
<script>
var editor;
KindEditor.ready(function(K) {
  editor = K.create('#editor_id', {
    resizeType : 1,
    allowPreviewEmoticons : false,
    allowImageUpload : false,
    items : [
      'source', '|', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
      'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
      'insertunorderedlist', '|', 'emoticons', 'image', 'link','media']
  });
});
</script>
<style>
.ke-container{width: 630px !important;}
</style>
  <div id="main">
    <!--------------------main_left star-------------------->
    <div id="main_left" class="mt25">
      <!---左侧内容的替换--->
      <form action="blogs.php?act=updateTodo&bid=<?php echo $resOne['bid']?>" method="post" enctype="multipart/form-data">
            <div style="margin-left:10px;">
            标题:<input type="text" name="title" style="width:588px" value="<?php echo $resOne['title']?>" /><br /><br />
            <textarea name="contents" id="editor_id" style="width:600px;height:210px;"><?php echo $resOne['contents']?></textarea><br /><br />
            分类:
              <select name="cid">
                  <?php
                    foreach($catArr as $key=>$value){
                      echo "<option value='".$value["cid"]."'>".$value['cname']."</option>";
                    }
                  ?>
              </select><br /><br />
            <input type="submit" class="btn" value="更新日志">
            </div>

        </form>

      <div id="main_left_bottom"> </div>
    </div>
    <!--------------------main_left end-------------------->
    
        </form>
      </div>

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
