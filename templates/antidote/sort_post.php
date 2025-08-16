<?php  require_once('sousuo.php'); ?>
<div class="container">
  <div id="main">
    <div class="card board">
      <span class="icon"><i class="fa fa-map-signs fa-fw"></i></span>
        <?php echoBoard($sort['name']); ?>
    </div>
    <div id="<?php echo $sort['name']; ?>" class="card">
      <div class="card-head">
        <i class="<?php echo $sort['icon']; ?> fa-fw"></i><?php echo $sort['name']; ?>
      </div>
      <div class="card-body">
          <?php echoPosts($sort['posts']); ?>
      </div>
    </div>
      <?php echoPaging($postNum, $nowPage, $CONFIG['postPaging']); ?>
      <?php echoAd($ads[0]); ?>
  </div>
  <div id="side">
            <!--分类页侧栏广告位-->
        <?php echo $CONFIG['sortsider']; ?>
    <div class="card">
      <div class="card-head"><i class="fa fa-folder-open fa-fw"></i>文章分类</div>
      <div class="card-body">
          <?php echoPostSorts($DATA->getPostSorts(), $sort['id']); ?>
      </div>
    </div>
    <div class="card">
      <div class="card-head"><i class="fa fa-bar-chart fa-fw"></i>分类浏览TOP10</div>
      <div class="card-body">
          <?php echoPosts($DATA->getPostRanking(10, 0, $sort['id']), true, true); ?>
      </div>
    </div>
      <?php echoAd($ads[1]); ?>
  </div>
</div>

<?php
    include View::getView('footer');
?>