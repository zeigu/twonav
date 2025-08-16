<?php  require_once('sousuo.php'); ?>
<div class="container">
  <div id="main">
    <div class="card board">
      <span class="icon"><i class="fa fa-map-signs fa-fw"></i></span>
        <?php echoBoard('搜索「' . $keyword . '」的结果'); ?>
    </div>
    <div class="card">
      <div class="card-head">
        <i class="fa fa-search fa-fw"></i>搜索「<?php echo $keyword; ?>」的站点结果
      </div>
      <div class="card-body">
          <?php echoSites($sites); ?>
      </div>
    </div>
      <?php echoAd($ads[0]); ?>
    <div class="card">
      <div class="card-head">
        <i class="fa fa-search fa-fw"></i>搜索「<?php echo $keyword; ?>」的文章结果
      </div>
      <div class="card-body">
          <?php echoPosts($posts); ?>
      </div>
    </div>
      <?php echoAd($ads[1]); ?>
  </div>
  <div id="side">
    <div class="card">
      <div class="card-head"><i class="fa fa-random fa-fw"></i>随机站点推荐</div>
      <div class="card-body">
        <div class="rand-site">
            <?php echoSites($DATA->getRandSites(16), false, true); ?>
        </div>
      </div>
    </div>
      <?php echoAd($ads[2]); ?>
    <div class="card">
      <div class="card-head"><i class="fa fa-random fa-fw"></i>随机文章推荐</div>
      <div class="card-body">
          <?php echoPosts($DATA->getRandPosts(5), true); ?>
      </div>
    </div>
      <?php echoAd($ads[3]); ?>
  </div>
</div>

<?php
    include View::getView('footer');
?>