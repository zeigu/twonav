<?php  require_once('sousuo.php'); ?>
<div class="container">
    <div class="card">
      <div class="card-head"><i class="hydhfl"></i><span style="margin-left: 15px;">随机文章</span></div>
      <div class="card-body">
        <div class="side-latest oz-timeline">
          <?php echoPosts($DATA->getRandPosts(5), true); ?>
        </div>
         </div>
    </div>
      <div class="card links">
    <div class="card-head"><i class="fa fa-link fa-fw"></i>友情链接</div>
    <div class="card-body">
        <?php echoLinks($DATA->getLinks()); ?>
    </div>
  </div>
    </div>

</div>    
    <?php
    include View::getView('footer');
?>