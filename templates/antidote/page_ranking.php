<?php  require_once('sousuo.php'); ?>
<div class="container">
  <div class="card board">
    <span class="icon"><i class="fa fa-map-signs fa-fw"></i></span>
      <?php echoBoard($page['title']); ?>
  </div>
  <div class="ranking">
    <div class="oz-md-4 oz-sm-6 oz-md-12">
      <div class="card">
        <div class="card-head"><i>Day</i>日浏览榜</div>
        <div class="card-body">
            <?php echoSiteRanking($DATA->getSiteRanking('day', 30), 'day'); ?>
        </div>
      </div>
        <?php echoAd($ads[0]); ?>
    </div>
    <div class="oz-md-4 oz-sm-6 oz-md-12">
      <div class="card">
        <div class="card-head"><i>Month</i>月浏览榜</div>
        <div class="card-body">
            <?php echoSiteRanking($DATA->getSiteRanking('month', 30), 'month'); ?>
        </div>
      </div>
        <?php echoAd($ads[1]); ?>
    </div>
    <div class="oz-md-4 oz-sm-6 oz-md-12">
      <div class="card">
        <div class="card-head"><i>Total</i>总浏览榜</div>
        <div class="card-body">
            <?php echoSiteRanking($DATA->getSiteRanking('total', 30), 'total'); ?>
        </div>
      </div>
        <?php echoAd($ads[2]); ?>
    </div>
  </div>
</div>

<?php
    include View::getView('footer');
?>