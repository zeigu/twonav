<?php
    $domain = getDomain($site['url']);
?>
<?php  require_once('sousuo.php'); ?>
  <div class="container">
    <div class="card board">
      <span class="icon"><i class="fa fa-map-signs fa-fw"></i></span>
        <?php echoBoard($site['name'], $sort['id']); ?>
    </div>
    <div class="card">
      <div class="card-body">
        <div class="site-main">
          <span class="title"><?php echo $site['name']; ?></span>
          <span class="oz-xs-12 oz-sm-6 oz-lg-4">今日点击：<?php echo convertNum($site['dayView']); ?>次</span>
          <span class="oz-xs-12 oz-sm-6 oz-lg-4">本月点击：<?php echo convertNum($site['monthView']); ?>次</span>
          <span class="oz-xs-12 oz-sm-6 oz-lg-4">累计点击：<?php echo convertNum($site['totalView']); ?>次</span>
          <span class="oz-xs-12 oz-sm-6 oz-lg-4">站点域名：<?php echo $domain; ?></span>
          <span class="oz-xs-6 oz-sm-6 oz-lg-4">站点星级：<img class="lazy-load" src="<?php echo TEMPLATE_URL; ?>images/star/<?php echo getStarNum($site['totalView']); ?>.png" alt=""></span>
          <span class="oz-xs-6 oz-sm-6 oz-lg-4">收录日期：<?php echo date('Y-m-d', $site['time']); ?></span>
          <span class="oz-xs-6 oz-sm-6 oz-lg-4">备案信息：<a title="<?php echo $site['icp']; ?>" href="http://icp.chinaz.com/info?q=<?php echo $domain; ?>" target="_blank"><?php echo $site['icp']; ?></a></span>
          <span class="oz-xs-6 oz-sm-6 oz-lg-4">站长ＱＱ：<?php if(!empty($site['qq'])) { ?>
              <a title="<?php echo $site['qq']; ?>" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $site['qq']; ?>&site=qq&menu=yes" target="_blank"><?php echo $site['qq']; ?></a>
              <?php } else {
                  echo '暂无';
              } ?></span>
          <span class="oz-xs-6 oz-sm-6 oz-lg-4">所属分类：<a href="<?php echo $sort['url']; ?>" title="<?php echo $sort['name']; ?>"><?php echo $sort['name']; ?></a></span>
          <span class="oz-xs-6 oz-sm-6 oz-lg-4">百度权重：<a href="https://baidurank.aizhan.com/baidu/<?php echo $domain; ?>/" target="_blank"><img class="lazy-load" src="https://baidurank.aizhan.com/api/br?domain=<?php echo $domain; ?>&style=images" oncontextmenu="return false" ondragstart="return false" alt=""></a></span>
          <span class="oz-xs-6 oz-sm-6 oz-lg-4">移动权重：<a href="https://baidurank.aizhan.com/baidu/<?php echo $domain; ?>/" target="_blank"><img class="lazy-load" src="https://baidurank.aizhan.com/api/mbr?domain=<?php echo $domain; ?>&style=images" oncontextmenu="return false" ondragstart="return false" alt=""></a></span>          
          <span class="oz-xs-6 oz-sm-6 oz-lg-4">搜狗权重：<a href="https://sogourank.aizhan.com/mobail/<?php echo $domain; ?>/" target="_blank"><img class="lazy-load" src="https://sogourank.aizhan.com/api/br?domain=<?php echo $domain; ?>&type=sogou" oncontextmenu="return false" ondragstart="return false" alt=""></a></span>

             <i class="fa fa-newspaper-o" aria-hidden="true">快捷查询：</i>
             <a href="http://whois.chinaz.com/?DomainName=<?php echo $domain; ?>" title="Whois查询" target=_blank>Whois查询</a> | 
             <a href="http://seo.chinaz.com/?host=<?php echo $domain; ?>" title="SEO综合查询" target=_blank>SEO综合查询</a> | 
             <a href="http://alexa.chinaz.com/?Domain=<?php echo $domain; ?>" title="Alexa排名查询" target=_blank>Alexa排名查询</a> | 
             <a href="http://pr.chinaz.com/?PRAddress=<?php echo $domain; ?>" title="PR查询" target=_blank>PR查询</a> | 
             <a href="http://tool.chinaz.com/speedtest.aspx?host=<?php echo $domain; ?>" title="网站测速" target=_blank>网站测速</a> |  
             <a href="http://icp.chinaz.com/?s=<?php echo $domain; ?>" title="ICP备案查询" target=_blank>ICP备案查询</a> | 
             <a href="http://link.chinaz.com/?wd=<?php echo $domain; ?>" title="友情链接检测" target=_blank>友情链接检测</a> | 
             <a href="http://rank.chinaz.com/?host=<?php echo $domain; ?>" title="百度权重查询" target=_blank>百度权重查询</a> | 
             <a href="http://tool.chinaz.com/webscan/?host=<?php echo $domain; ?>" title="网站安全检测" target=_blank>网站安全检测</a> |  
          	 <a href="http://www.baidu.com/s?wd=site:<?php echo $domain; ?>" title="百度收录查询" target="_blank">百度收录查询</a>
        </div>
        <div class="site-side">
          <div class="snapshot">
            <img class="lazy-load" src="<?php echo IMAGES_URL; ?>loading.gif" data-src="<?php echo $CONFIG['snapshot'] . $site['url']; ?>" alt="">
          </div>
          <a title="<?php echo $site['url']; ?>" href="<?php echo $site['goto']; ?>" target="_blank" class="oz-btn oz-btn-lg oz-btn-block oz-bg-green">
          <i class="fa fa-send-o fa-fw" aria-hidden="true"></i> 网站直达
                    </a>
          <button class="oz-btn oz-btn-lg oz-btn-block oz-bg-blue" onclick="addLove(this, <?php echo $site['id']; ?>)">
            <i class="fa fa-thumbs-o-up fa-fw" aria-hidden="true"></i> 点赞 [<?php echo $site['love']; ?>]
          </button>
        </div>
      </div>
    </div>
<div class="card">
<div class="wzgg">
 <?php echo $CONFIG['sitewzgg']; ?>
</div>
</div>
 <?php echoAd($ads[0]); ?>
     <?php echoAd($ads[1]); ?>
 <?php echoAd($ads[2]); ?>
     <?php echoAd($ads[3]); ?>
 <?php echoAd($ads[4]); ?>
     <?php echoAd($ads[5]); ?>
    
    <div class="card">
      <div class="card-head">
        <i class="fa fa-feed fa-fw" aria-hidden="true"></i> 站点信息
      </div>
      <div class="card-body content">
<p><b>站点域名：</b><font color="#FF0000"><?php echo $domain; ?></font> </p>      
<p><b>站点标题：</b><font color="#FF0000"><?php echo $site['title']; ?></font> </p>
<p><b>站点关键：</b><font color="#FF0000"><?php echo $site['keywords']; ?></font> </p>
<p><b>站点描述：</b><font color="#FF0000"><?php echo $site['description']; ?></font> </p>
      </div>
    </div>
<?php echoAd($ads[6]); ?>
<?php echoAd($ads[7]); ?>
<?php echoAd($ads[8]); ?>
<?php echoAd($ads[9]); ?>
    <div class="card">
      <div class="card-head">
      <i class="fa fa-twitch" aria-hidden="true"></i> 加入好处
      </div>
      <p>简单来说就是可以给您的网站提升权重排名，增加外链和网站流量！如果细分的话那么有如下几个好处！</p>
      <p>让您的网站更快、更多地被搜索引擎收录</p>
      <p>让您的网站名称的关键词在搜索引擎的搜索结果的第一页甚至第一个</p>
      <p>通过本站这个分类目录平台从而给您的网站带来巨大流量</p>
      <p>如您网站被搜索引擎屏蔽,<?php echo $CONFIG['name']; ?>永久缓存贵站信息，通过这个页面浏览者照样借助<?php echo $CONFIG['name']; ?>进入您的网站！</p>
      <p> 
      <font color="#ff0000">温馨提示：如果贵站想上百度，希望贵站能添加本页面为友情链接，感谢您对本站的支持！</font></P> 
      <p> <span style="color: #000000; font-size: 14px;"><strong>&lt;a href="<?php echo OZDAO_URL; ?>" target="_blank"&gt;<?php echo $CONFIG['name']; ?>&lt;/a&gt;</strong></span>
      </p>      
      </div>
                         <div class="card">
            <div class="card-head">
<i class="fa fa-cubes" aria-hidden="true"></i> 相关站点
            </div>
            <div class="card-body">
          <?php echoSites($DATA->getRelatedSites($sort['id'], $site['id'], 21)); ?>
      </div>
    </div>
    </div>
  </div>
<?php
    include View::getView('footer');
?>