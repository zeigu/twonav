<?php  require_once('sousuo.php'); ?>
<div class="container">
  <div class="card board">
    <span class="icon"><i class="fa fa-map-signs fa-fw"></i></span>
      <?php echoBoard($post['title'], $sort['id']); ?>
  </div>
  <div id="main">
    <div class="card">
      <div class="card-head"><i class="fa fa-book fa-fw"></i><?php echo $post['title']; ?></div>
      <div class="card-body content">
        <div class="post-info">
          <span><i class="fa fa-clock-o fa-fw"></i><?php echo date('Y-m-d h:m', $post['time']); ?></span>
          <span><i class="fa fa-eye fa-fw"></i><?php echo $post['view']; ?></span>
          <span><i class="fa fa-folder-open fa-fw"></i><a href="<?php echo $sort['url']; ?>"><?php echo $sort['name']; ?></a></span>
        </div>
        <div class="card">
<div class="wzgg">
 <?php echo $CONFIG['postwzgg']; ?>
</div>
</div>
        <?php echoAd($ads[0]); ?>
        <?php echoAd($ads[1]); ?>
        <?php echoAd($ads[2]); ?>
        <?php echoAd($ads[3]); ?>
        <?php echoAd($ads[4]); ?>
        <?php echoAd($ads[5]); ?>
          <?php echo $post['content']; ?><br>
          <hr class="layui-border-red">
          <div class="copyright">
                        <p class="tit">#免责声明#</p>
                        <p>总裁提供的一切软件、教程和内容信息仅限用于学习和研究目的；不得将上述内容用于商业或者非法用途，否则，一切后果请用户自负。本站信息来自网络收集整理，版权争议与本站无关。您必须在下载后的24个小时之内，从您的电脑或手机中彻底删除上述内容。如果您喜欢该程序和内容，请支持正版，购买注册，得到更好的正版服务。我们非常重视版权问题，如有侵权请邮件123456@qq.com与我们联系处理。敬请谅解！</p>
                        </div>
      </div>
    </div>
      <?php echoAd($ads[6]); ?>
      <?php echoAd($ads[7]); ?>
      <?php echoAd($ads[8]); ?>
      <?php echoAd($ads[9]); ?>
  </div>
  <div id="side">
      <!--文章内页侧栏广告位-->
        <?php echo $CONFIG['postsider']; ?>
    <div class="card">
      <div class="card-head"><i class="fa fa-folder-open fa-fw"></i>文章分类</div>
      <div class="card-body">
          <?php echoPostSorts($DATA->getPostSorts(), $sort['id']); ?>
      </div>
    </div>
    <div class="card">
      <div class="card-head"><i class="fa fa-magnet fa-fw"></i>相关文章</div>
      <div class="card-body">
          <?php echoPosts($DATA->getRelatedPosts($sort['id'], $post['id'], 10), true); ?>
      </div>
    </div>
  </div>
</div>

<?php
    include View::getView('footer');
?>