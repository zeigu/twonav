<?php  require_once('sousuo.php'); ?>
<div class="container">
    <div class="sjwu">
  <ul class="sort">
    <li><a href="#置顶站点" class="move"><span>置顶推荐</span> <i class="fa fa-thumbs-o-up fa-fw"></i></a></li>
      <?php echoSideSorts($DATA->getSiteSorts()); ?>
  </ul></div>
  <div id="main">
    <div class="card board">
        <span class="icon" style="background: url(/assets/images/gg.png) no-repeat 50% 50%/85%;height: 100%; width: 100px;"></span> 
      <span class="icon"><i class="fa fa-bullhorn fa-fw"></i></span>
        <?php $latestNotice = $DATA->getNotices(1)[0]; ?>
      <marquee scrollamount="4" behavior="scroll" onmouseover="this.stop()" onmouseout="this.start()"><?php echo $latestNotice['content']; ?></marquee>
    </div>
  <div id="置顶站点" class="card">
<div class="card-head"><i class="fa fa-diamond" aria-hidden="true"></i><font style="color:red">置顶站点：<?php echo $CONFIG['zhiding_money']; ?>/月</font></a>
<a href="/pay.html" class="more"><i class="fa fa-shopping-cart" aria-hidden="true"></i>购买置顶/广告</a></div>
<div class="card-body">
<?php echoSites($DATA->getTopSites(),true); ?>                        
   </div>
        </div>
<div class="card">
<div class="wzgg">
 <?php echo $CONFIG['indexwzgg']; ?>
</div>
</div>
         <!--首页顶部图片广告-->
        <?php echoAd($ads[0]); ?>
        <?php echoAd($ads[1]); ?>
        <?php echoAd($ads[2]); ?>
        <?php echoAd($ads[3]); ?>
        <?php echoAd($ads[4]); ?>
        <?php echoAd($ads[5]); ?>
 
      <?php foreach($sorts as $sort) { ?>
        <div id="<?php echo $sort['name']; ?>" class="card">
          <div class="card-head">
            <i class="<?php echo $sort['icon']; ?> fa-fw"></i><?php echo $sort['name']; ?>
            <a href="<?php echo $sort['url']; ?>" title="查看更多" class="more"><i class="fa fa-chevron-right"></i></a>
          </div>
          <div class="card-body">
              <?php echoSites($sort['sites']); ?>
          </div>
        </div>
      <?php } ?>
  <!--首页底部图片广告-->
  <?php echoAd($ads[6]); ?>
  <?php echoAd($ads[7]); ?>
  <?php echoAd($ads[8]); ?>
  <?php echoAd($ads[9]); ?>
  </div>
 
  <div id="side"> 
   <!--首页侧栏广告位-->
  <?php echo $CONFIG['indexsider']; ?>
     <div class="card">
      <div class="card-head"><i class="fa fa-bookmark" aria-hidden="true"></i>站点统计<a href="apply.html" title="申请收录" class="more"><i class="fa fa-plus-square" aria-hidden="true"></i>申请收录</a></div>
      <div class="card-body side-statistic">
          &nbsp;&nbsp;<strong>共计收录：<font color="red"><?php echo $DATA->getCount('site'); ?></font>&nbsp;&nbsp;-&nbsp;&nbsp;待审网站：<font color="red">
<?php echo $DATA->getCount('apply'); ?></font></strong> <?php echoStatistics(); ?>
      </div>
    </div>      
    <div class="card">
      <div class="card-head"><i class="fa fa-line-chart fa-fw"></i>TOP10</div>
      <div class="card-body">
           <?php echoSiteRanking($DATA->getSiteRanking('total', 10), 'total'); ?>
      </div>
    </div>
    <div class="card">
      <div class="card-head"><i class="fa fa-coffee fa-fw"></i>最新收录</div>
      <div class="card-body">
            <?php echoLatestSites($DATA->getLatestSites(10)); ?>
      </div>
    </div>
    <div class="card">
      <div class="card-head"><i class="fa fa-folder-open fa-fw"></i>文章分类</div>
      <div class="card-body">
          <?php echoPostSorts($DATA->getPostSorts()); ?>
      </div>
    </div>
    <div class="card">
      <div class="card-head"><i class="fa fa-leaf fa-fw"></i>最新文章</div>
      <div class="card-body">
          <?php echoPosts($DATA->getLatestPosts(10), true); ?>
      </div>
    </div>
<!--首页侧边栏广告-->
  </div>
  <div class="card links">
    <div class="card-head"><i class="fa fa-link fa-fw"></i>友情链接<a href="javaScript:lxqq(3092059473);" title="申请友链" class="more"><i class="fa fa-plus-square" aria-hidden="true"></i>申请友链</a></div>
    <div class="card-body">
        <?php echoLinks($DATA->getLinks()); ?>
    </div>
  </div>
</div>
<script src="<?php echo TEMPLATE_URL; ?>js/tc.js"></script>
<?php
    include View::getView('footer');
?>