<?php  require_once('sousuo.php'); ?>
<div class="container">
  <div class="card board">
    <span class="icon"><i class="fa fa-map-signs fa-fw"></i></span>
      <?php echoBoard($page['title']); ?>
  </div>
<div class="card">
    <div class="card-head"><i class="fa fa-bullhorn fa-fw"></i> 最新公告</div>
    <div class="card-body content">
<ul class="layui-timeline">
     <?php
         $notices = $DATA->getNotices();
              foreach($notices as $notice) { ?>
  <li class="layui-timeline-item">
    <i class="layui-icon layui-timeline-axis"></i>
    <div class="layui-timeline-content layui-text">
      <h3 class="layui-timeline-title"><?php echo date('Y-m-d', $notice['time']); ?>发布公告：</h3>
      <p>
 <?php echo $notice['content']; ?>
      </p>
    </div>
  </li>
<?php } ?>
  <li class="layui-timeline-item">
    <i class="layui-icon layui-timeline-axis"></i>
    <div class="layui-timeline-content layui-text">
      <h3 class="layui-timeline-title">本站于<?php echo date('Y-m-d', $CONFIG['time']); ?>正式上线运营</h3>
    </div>
  </li>
</ul> 
      



    </div>
  </div>
  <div class="card">
    <div class="card-head"><i class="fa fa-info-circle fa-fw"></i>本站简介</div>
    <div class="card-body content">
      <p>本站名称：<?php echo $CONFIG['name']; ?></p>
      <p>本站标题：<?php echo $CONFIG['title']; ?></p>
      <p>本站关键：<?php echo $CONFIG['keywords']; ?></p>
      <p>本站描述：<?php echo $CONFIG['description'] ?></p>
      <p>本站域名：<?php echo getDomain(OZDAO_URL); ?></p>
    </div>
  </div>
  <div class="card">
    <div class="card-head"><i class="fa fa-pie-chart fa-fw"></i>网站统计</div>
    <div class="card-body content">
      <p>百度收录：<strong><?php
header("Content-Type:text/html;charset=UTF-8");
date_default_timezone_set("PRC");
$url = OZDAO_URL;
$result = file_get_contents("https://api.btstu.cn/bdics/api.php?domain=".$url);
$arr=json_decode($result,true);
if ($arr['code']==200) {
    echo $arr['num'];
} else {
    echo $arr['msg'];
}
?></strong> 条</p>    
      <p>开设分类：<strong><?php echo $DATA->getCount('sort'); ?></strong> 个</p>
      <p>收录站点：<strong><?php echo $DATA->getCount('site'); ?></strong> 个</p>
      <p>待审核站点：<strong><?php echo $DATA->getCount('apply'); ?></strong> 个</p>
      <p>本站已稳定运行了 <strong>
          <script>var urodz = new Date(<?php echo $CONFIG['time'] * 1000;?>);
            var now = new Date();
            var ile = now.getTime() - urodz.getTime();
            var dni = Math.floor(ile / (1000 * 60 * 60 * 24));
            document.write(+dni)</script>
        </strong> 天。
      </p>
    </div>
  </div>
  <div class="card">
    <div class="card-head"><i class="fa fa-telegram fa-fw"></i>联系方式</div>
    <div class="card-body content">
      <p>
        <i class="fa fa-qq"></i>：<a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $adminInfo['qq']; ?>&site=qq&menu=yes" target="_blank"><?php echo $adminInfo['qq']; ?>
        </a>
      </p>
      <p><i class="fa fa-envelope"></i>：<a href="mailto:<?php echo $adminInfo['email']; ?>"><?php echo $adminInfo['email'] ?></a></p>
    </div>
  </div>
</div>

<?php
    include View::getView('footer');
?>