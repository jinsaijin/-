<?php
  require_once("templates/header.php");

?>

<div id="wrap" class="w980">
  <div class="clear"></div>
    <div id="main">
      <div id="main_left" class="mt25">
        <!----修改内容--->
        <table class="table table-striped table-bordered table-hover mytable">
          <tr height="60">
            <th>用户头像</th>
            <th>用户id</th>
            <th>用户名</th>
            <th>性别</th>
            <th>爱好</th>
            <th>城市</th>
            <th>注册时间</th>
            <th>操作</th>
          </tr>

    <?php
//循环遍历
   /* ----start-----*/
      foreach($arr as $key=>$value){
      echo "<tr>";
      $avatar = empty($value['avatar']) ? "templates/img/default.gif" : $value['avatar'];
      $city = ($value['city'] == 'hefei') ? "合肥" : "安庆";
      $sex = ($value['sex'] == 'm') ? "男" : "女";
      $favStr = '';
      if(strstr($value['fav'],"reading")){
        $favStr .= "阅读 ";
      }
      if(strstr($value['fav'],"sports")){
        $favStr .= "体育 ";
      }
      if(strstr($value['fav'],"shopping")){
        $favStr .= "购物 ";
      }
      echo '<td><img src="'.$avatar.'" style="width:60px; height:60px;"></td>';
      echo '<td><span class="label label-info">'.$value['uid'].'</span></td>';
      echo '<td><span class="label label-success">'.$value['username'].'</span></td>';
      echo '<td><span class="label label-warning">'.$sex.'</span></td>';
      echo '<td><span class="label label-important">'.$favStr.'</span></td>';
      echo '<td><span class="label">'.$city.'</span></td>';
      echo '<td><span class="label label-info">'.date('Y-m-d',$value['regtime']).'</span></td>';
       // if(@$_COOKIE['uid'] == $value['uid']){
      echo '<td><i class="icon-pencil"></i><a href="?act=update&uid='.$value['uid'].'">编辑</a> <i class="icon-trash"></i><a href="?act=delete&uid='.$value['uid'].'" onclick="javascript:return confirm(\'亲，数据无价，你真的忍心删除吗？\')">删除</a></td>';  
     // }else {
     //  echo '<td></td>';
     // }
     echo "</tr>";
     }
    /*----end-----*/
    ?> 
  </table>
<!---分页--->
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
