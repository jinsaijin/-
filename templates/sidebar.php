<div id="main_right">
      <div id="main_right_1">
        <div id="mian_left_title">
          <div class="article"><a href="#">文章分类</a></div>
          <div class="sign"><a href="###">订阅</a></div>
        </div>
        <div class="clear mt10"></div>
        <ul>
          <?php
          foreach ($catArr as $key => $value) {
            $count = mysql_exec("select count(*) from ".DB_PREFIX."blogs where cid='".$value['cid']."'");
            $count = array_pop($count);
            // p($count);
            $count = intval($count['count(*)']);
        	echo '<li>
            <a href="index.php?cid='.$value['cid'].'">'.$value['cname'].'('.$count.')</a><img src="templates/img/lg000000.png"></li>';
                 }
           ?>
        </ul>
      </div>
      <div id="main_right_2">
        <h2>站内搜索</h2>
        <form method="post" action="index.php?act=search" class="pc_overflow mt5">
          <input type="text" name="keywords" size="15" style="width:130px;height:23px;margin-left:10px;" class="fl">
          <input type="submit" class="fl btn" value="我要搜索" style="height:32px;margin-left:5px;">
        </form>
      </div>
      <div id="main_right_3">
        <h2>热门文章</h2>
        <div class="clear mt10"></div>
        <ul class="">
          <?php
          foreach ($hotArr as $key => $value) {
        	      echo '<li><a href="blogs.php?act=views&bid='.$value['bid'].'" target="_blank">'.truncate_zh($value['title'],10).'<span style="color:#999999">('.$value['hits'].')</span></a></li>';
                 }
           ?>
        </ul>
      </div>
    </div>    