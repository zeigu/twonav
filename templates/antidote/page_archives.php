<?php  require_once('sousuo.php'); ?>
<div class="container">
    <div class="card">
      <div class="card-head"><span style="margin-left: 15px;"><i class="fa fa-folder-open"></i>全部文章</span></div>
      <div class="card-body">
        <div class="side-latest oz-timeline" >
            <?php echoPosts($DATA->getLatestPosts(99999),true); ?>
        </div>
         </div>
    </div>
    </div>
    <?php
    include View::getView('footer');
?>