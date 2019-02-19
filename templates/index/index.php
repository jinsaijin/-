<?php
  require_once("templates/header.php");
?>
<div id="wrap" class="w980">

  <!-----------------------clear--------------------->
  <div class="clear"></div>
  <!-----------------------clear end----------------> <!--------------------main star-------------------->


    <div id="main">
    <!--------------------main_left star-------------------->
    <div id="main_left">
      <h2 style="text-align:right;margin-top:5px;"><a href="blogs.php?act=add" class="btn btn-success btn-large">添加日志</a></h2>
      <?php
       if(isset($_GET['act']) && $_GET['act'] == 'search'){
         echo '<h2 style="font-size:18px;margin:0px 0 0 40px;color:#1387D2;">搜索功能:亲,通过搜索 <span style="color:#F89406;">'.$_POST['keywords'].'</span> 关键词,共查询出<span style="color:#F89406;">'.count($arr).'</span>条记录</h2>';
       }
      ?>
      <!--------------------main_left center------------------>
      <?php 
      foreach($arr as $key=>$value){
       ?>
            
        <div id="main_left_<?php if($key==0){echo '1';}else{echo '2';}?>">
            <ul>
             <li class="li_1"><a href="blogs.php?act=views&bid=<?php echo $value['bid']?>" target="_blank"><?php echo $value['title']?></a></li>
              <li class="li_2"><a href="blogs.php?act=views&bid=<?php echo $value['bid']?>" target="_blank"> Author : <?php echo $value['username']?> Time :<?php echo date("Y-m-d",$value['createTime'])?></a></li>
              <li class="li_3" style="color:#666666; text-indent:45px;">&nbsp;<?php echo truncate_zh($value['contents'],80,'...')?><a style="color:#336699;" href="blogs.php?act=views&bid=<?php echo $value['bid']?>" target="_blank">阅读全文</a> </li>
            </ul>
        </div>
      <?php
        }
        ?>
                   
              
                <div id="main_left_2" style="background:none;width:100%;font-size:14px">
      	<div class="pc_overflow tc pagination pagination-large">
      		<ul>
            <?php echo $pageStr?>  
          </ul>
      </div>


      </div>




      <!-----------------------main_left center end-------------------->
      <div id="main_left_bottom"> </div>
    </div>
    <!--------------------main_left end-------------------->
    <!--------------------main_right star-------------------->
    <?php
      require_once("templates/sidebar.php");
    ?>
    <!--------------------main_right end-------------------->
  </div>
  <!--------------------main end--------------------->


</div>
<?php
  require_once("templates/footer.php");
?>
