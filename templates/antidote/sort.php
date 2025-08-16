<?php  require_once('sousuo.php'); ?>
<div class="container">
  <ul class="sort">
    <li><a href="<?php echo OZDAO_URL; ?>"><span>返回首页</span> <i class="fa fa-home fa-fw"></i></a></li>
      <?php echoSideSorts($DATA->getSiteSorts(), $sort['id']); ?>
  </ul>
  <div id="main">
    <div class="card board">
      <span class="icon"><i class="fa fa-map-signs fa-fw"></i></span>
        <?php echoBoard($sort['name']); ?>
    </div>
    <div class="card">
      <div class="card-head">
        <i class="<?php echo $sort['icon']; ?> fa-fw"></i><?php echo $sort['name']; ?>
      </div>
      <div class="card-body">
          <?php echoSites($sort['sites']); ?>
      </div>
    </div>
      <?php echoPaging($siteNum, $nowPage, $CONFIG['sitePaging']); ?>
      <?php echoAd($ads[0]); ?>
  </div>
  <div id="side">
      <!--分类页侧栏广告位-->
        <?php echo $CONFIG['sortsider']; ?>
    <div class="card">
      <div class="card-head"><i class="fa fa-bar-chart fa-fw"></i>分类总TOP10</div>
      <div class="card-body">
          <?php echoSiteRanking($DATA->getSiteRanking('total', 10, 0, $sort['id']), 'total'); ?>
      </div>
    </div>
      <?php echoAd($ads[1]); ?>
  </div>
</div>

<?php
    include View::getView('footer');
?>