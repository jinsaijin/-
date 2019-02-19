<?php
  require_once("templates/header.php");
?>
<div id="wrap" class="w980">

  <!-----------------------clear--------------------->
  <div class="clear"></div>
   
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
      'insertunorderedlist', '|', 'emoticons', 'image', 'link']
  });
});
</script>
<style>
.ke-container{width: 698px !important;}
</style>
<style>
#main_left h1{ text-align:center;margin-bottom:10px;color:#1986CB;font-size:26px;}
#content{ line-height:24px; font-size:14px;  text-align:justify; font-family:'宋体';}
#content p{ line-height:24px;}
#description{ color:#999999; border-bottom:1px dashed #999;padding:5px 0 10px 0;}
.message_dao{ font-size:20px;color:#1986CB; margin:10px 0;}
.message_title{ line-height:30px;border-bottom:1px dashed #CCCCCC;}
.message_title span{color:#999; }
.message_con{  text-align:justify;  text-indent:25px;margin:10px 0 5px 0; color:#666666; line-height:22px;}
.message_add{padding-bottom:20px;}
</style>
 
    <!--------------------main_left star-------------------->
    <div id="main_left" class="mt30">
      <h1><?php echo $resOne['title']?></h1>
      <!---文章内容--->
      <div id="description">
      作者 : <?php echo $resOne['username']?>　　　　　　　　
      所属分类:<?php echo $resOne['cname']?>　　　　　　　　
      点击数:<?php echo $resOne['hits']?>　　　　
      发布时间:<?php echo date("Y-m-d",$resOne['regtime'])?>      
      </div>
      
      
      <div id="content" class="mt15">
     <?php echo $resOne['contents']?>
       </div>
       <div class="clear"></div>
       <?php
       if(!empty($messageArr)){
          echo '<div class="pc_overflow ft14 message_dao">留言列表</div>';
       }
        ?>
       <?php
          foreach($messageArr as $key=>$value){
        ?>  
        <div class="message_list">
                <div class="message_each pc_overflow">
                    <div class="message_title tr"><a href="javascript:" class="fl">留言用户 : <?php echo ($value['username']=='') ? "匿名" : $value['username'];?></a><span>Date:<?php echo date("Y-m-d",$value['mtime'])?><a href="blogs.php?act=messagedelete&mid=<?php echo $value['mid']?>" onclick="jvascript:return confirm('亲,数据无价,您确认删除吗?')"><i class="icon-trash"></i></a></span></div>
                    <div class="clear"></div>
                    <div class="message_con">
                    <?php echo $value['message']?>                      </div>
                </div>
        </div>
        <?php
          }
        ?>
       <div class="clear"></div>
       <div class="pc_overflow ft14 message_dao">发表留言</div>
       <div class="message_add pc_overflow">
        <form method="post" action="blogs.php?act=message">
          <textarea name="message" id="editor_id" style="width:508px;height:210px;"></textarea><br />
          <?php
          if(empty($_COOKIE['uid'])){
             $_COOKIE['uid'] = 0;
           }
          ?>
            <input type="hidden" name="uid" value="<?php echo $_COOKIE['uid']?>" />
            <input type="hidden" name="bid" value="<?php echo $resOne['bid']?>"/>
            <input type="submit" class="btn btn-large" value="我要发布留言"/>
        </form>
       </div>
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
