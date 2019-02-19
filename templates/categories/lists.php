<?php
  require_once("templates/header.php");
?>
<div id="wrap" class="w980">
  <div class="clear"></div>
    <div id="main">
      <div id="main_left" class="mt25">
        <!----修改内容--->
        <div style="text-align: right"><a href="?act=add" class="btn btn-large">分类添加</a></div>
        <table class="table table-striped table-bordered table-hover mytable">
          <tr height="60">
            <th>分类id</th>
            <th>分类名</th>
            <th>操作</th>
          </tr>
    <?php
      foreach($arr as $key=>$value){
      echo "<tr>";
      echo '<td><span class="label label-info">'.$value['cid'].'</span></td>';
      echo '<td><span class="label label-success">'.$value['cname'].'</span></td>';
      // if(@$_COOKIE['uid'] == 1){
      echo '<td><i class="icon-pencil"></i><a href="?act=update&cid='.$value['cid'].'">编辑</a> <i class="icon-trash"></i><a href="?act=delete&cid='.$value['cid'].'" onclick="javascript:return confirm(\'亲，数据无价，你真的忍心删除吗？\')">删除</a></td>';
      // }else {
      //   echo '<td></td>';
      // }
      echo "</tr>";
      }
    ?>
  </table>
<!--  -分页- -->
 <div class="pagination pagination-large pagination-centered">
   <ul>
     <?php echo $pageStr?>
   </ul>
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
