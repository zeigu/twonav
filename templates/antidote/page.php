<?php  require_once('sousuo.php'); ?>
<div class="container">
  <div class="card board">
    <span class="icon"><i class="fa fa-map-signs fa-fw"></i></span>
      <?php echoBoard($page['title']); ?>
  </div>
  <div class="card">
    <div class="card-head"><i class="fa fa-book fa-fw"></i><?php echo $page['title']; ?></div>
    <div class="card-body content">
        <?php echo $page['content']; ?>
    </div>
  </div>
</div>

<?php
    include View::getView('footer');
?>