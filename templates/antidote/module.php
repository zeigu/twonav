<?php
    //转换数字，大于10000显示两位小数的万
    function convertNum($num) {
        return $num >= 10000 ? round($num / 10000, 2) . '万' : $num;
    }

    //获取星级
    function getStarNum($view) {
        return $view >= 50 ? 5 : floor($view / 10);
    }

    //获取文章中图片链接
    function getPostPic($content) {
        preg_match('/<img[^<>]*?\ssrc=[\'\"]?([^\'"]+)[\'\"]?\\s.*?>/i', $content, $matches);
        $pic = $matches[1];
        return empty($pic) ? TEMPLATE_URL . 'images/default.jpg' : $pic;
    }

?>

<?php
    //面包屑导航
    function echoBoard($text, $sortId = null) {
        global $DATA;
        $boardHtml = '<a href="' . OZDAO_URL . '">导航首页</a>&nbsp;»&nbsp;';
        if($sortId == null) {
            $boardHtml .= '<span>' . $text . '</span>';
        } else {
            $sortName = $DATA->getSortById($sortId)['name'];
            $boardHtml .= '<a href="' . Url::sort($sortId) . '">' . $sortName . '</a>&nbsp;»&nbsp;' . '<span>' . $text . '</span>';
        }
        echo $boardHtml;
    }

?>

<?php
    //输出侧边分类
    function echoSideSorts($sorts, $id = null) {
        foreach($sorts as $sort) { ?>
          <li>
            <a href="<?php echo $id ? $sort['url'] : '#' . $sort['name']; ?>" title="<?php echo $sort['name']; ?>" class="<?php echo $id ? ($id == $sort['id'] ? 'active' : '') : 'move'; ?>">
              <span><?php echo $sort['name']; ?></span> <i class="<?php echo $sort['icon']; ?> fa-fw"></i>
            </a>
          </li>
            <?php
        }
    }

?>

<?php
    //输出站点
    function echoSites($sites, $isTop = false, $isSide = false) {
        foreach($sites as $site) { ?>
          <a href="<?php echo $site['link']; ?>" title="<?php echo $site['title']; ?>" target="_blank" class="site-item <?php echo $isTop ? 'top' : '';
              echo $isSide ? ' side' : ''; ?>">
            <span class="icon">
              <img class="lazy-load" src="<?php echo IMAGES_URL; ?>siteloading.gif" data-src="<?php echo $site['ico']; ?>" alt="">
            </span>
            <span class="name"><?php echo $site['name']; ?></span>
          </a>
            <?php
        }
    }

?>

<?php
    //输出文章
    function echoPosts($posts, $isSide = false, $isRanking = false) {
        foreach($posts as $key => $post) { ?>
          <a href="<?php echo $post['url']; ?>" title="<?php echo $post['title']; ?>" target="_blank" class="post-item <?php echo $isSide ? 'side' : '';
              echo $isRanking ? ' ranking' : ''; ?>">
              <?php if($isRanking) { ?>
                <span class="rank"><?php echo $key + 1; ?></span>
              <?php } ?>
            <div class="pic">
              <img class="lazy-load" src="<?php echo IMAGES_URL; ?>loading.gif" data-src="<?php echo getPostPic($post['content']); ?>" alt="">
            </div>
            <div class="text">
              <div class="title"><?php echo $post['title']; ?></div>
              <div class="info">
                <span><i class="fa fa-eye fa-fw"></i><?php echo $post['view']; ?></span>
                <span><i class="fa fa-clock-o fa-fw"></i><?php echo date('Y-m-d h:m', $post['time']); ?></span>
              </div>
            </div>
          </a>
            <?php
        }
    }

?>

<?php
    //输出浏览榜单
    function echoSiteRanking($sites, $type) {
        foreach($sites as $key => $site) { ?>
          <a href="<?php echo $site['link']; ?>" title="<?php echo $site['title']; ?>" target="_blank" class="site-ranking">
            <span class="rank"><?php echo $key + 1; ?></span>
            <span class="icon">
              <img class="lazy-load" src="<?php echo IMAGES_URL; ?>siteloading.gif" data-src="<?php echo $site['ico']; ?>" alt="">
            </span>
            <span class="name"><?php echo $site['name']; ?></span>
            <span class="view"><?php echo convertNum($site[$type . 'View']); ?></span>
          </a>
            <?php
        }
    }

?>

<?php
    //输出侧栏最新收录
    function echoLatestSites($sites, $type) {
        foreach($sites as $key => $site) { ?>
          <a href="<?php echo $site['link']; ?>" title="<?php echo $site['title']; ?>" target="_blank" class="site-ranking">
            <span class="rank"><?php echo $key + 1; ?></span>
            <span class="icon">
              <img class="lazy-load" src="<?php echo IMAGES_URL; ?>siteloading.gif" data-src="<?php echo $site['ico']; ?>" alt="">
            </span>
            <span class="name"><?php echo $site['name']; ?></span>
            <span class="view"><?php echo date('y/m/d', $site['time']); ?></span>
            </a>
        <?php 
        }
    }

?>

<?php
    //输出侧栏所有文章分类
    function echoPostSorts($sorts, $sortId = null) {
        foreach($sorts as $sort) { ?>
          <a href="<?php echo $sort['url']; ?>" title="<?php echo $sort['name']; ?>" class="side-sort <?php echo $sortId == $sort['id'] ? 'active' : ''; ?>">
            <i class="<?php echo $sort['icon']; ?> fa-fw"></i><?php echo $sort['name']; ?>
          </a>
            <?php
        }
    }

?>

<?php
    //输出友情链接
    function echoLinks($links) {
        foreach($links as $link) { ?>
         <a href="<?php echo $link['url']; ?>" <?php echo $link['newTab'] == 1 ? ' target="_blank"' : ''; ?> title="<?php echo $link['name']; ?>" class="link-item">  <img style="width:18px;height:18px;margin: 0 auto;" src="https://o.ouzero.com:811/ico/?url=<?php echo $link['url']; ?> "> <?php echo $link['name']; ?></a>
            <?php
        }
    }

?>

<?php
    //图片广告
    function echoAd($ad) {
        if(!$ad) {
            return;
        } ?>
      <div class="card">
        <a class="ad" href="<?php echo $ad['url']; ?>" rel="nofollow" target="_blank">
          <img src="<?php echo $ad['picture']; ?>" alt="">
        </a>
      </div>
        <?php
    }

?>

<?php
    //输出侧栏热度统计
    function echoStatistics() {
        global $DATA;
        $day = $DATA->getDayViewNum();
        $month = $DATA->getMonthViewNum();
        $total = $DATA->getTotalViewNum();
        $daySite = $DATA->getSiteRanking('day', 1)[0];
        $monthSite = $DATA->getSiteRanking('month', 1)[0];
        $totalSite = $DATA->getSiteRanking('total', 1)[0];
        echo '<p>今日有 ' . $day['siteNum'] . ' 个站点被点击 ' . convertNum($day['viewNum']) . ' 次</p>
    <p>今日最受欢迎的站点是：<a href="' . $daySite['link'] . '" title="' . $daySite['title'] . '" target="_blank">' . $daySite['name'] . '</a></p>
		<p>本月有 ' . $month['siteNum'] . ' 个站点被点击 ' . convertNum($month['viewNum']) . ' 次</p>
		<p>本月最受欢迎的站点是：<a href="' . $monthSite['link'] . '" title="' . $monthSite['title'] . '" target="_blank">' . $monthSite['name'] . '</a></p>
		<p>累计有 ' . $total['siteNum'] . ' 个站点被点击 ' . convertNum($total['viewNum']) . ' 次</p>
		<p>总共最受欢迎的站点是：<a href="' . $totalSite['link'] . '" title="' . $totalSite['title'] . '" target="_blank">' . $totalSite['name'] . '</a></p>';
    }

?>

<?php
    //分页
    function echoPaging($totalNum, $nowPage, $pageSize) {
        $pageSize = $pageSize ? $pageSize : $totalNum;
        if($totalNum == 0 || $pageSize == 0) {
            echo '';
        } else {
            $query = preg_replace('/(&*page=[^&]*)*/', '', $_SERVER['QUERY_STRING']);
            $url = '?' . ltrim($query, '&') . (!empty($query) ? '&' : '') . 'page=';
            $totalPage = ceil($totalNum / $pageSize);
            $html = '';
            if($totalPage > 1) {
                $first = 1;
                $prev = $nowPage - 1;
                $next = $nowPage + 1;
                $last = $totalPage;
                $html .= '<div class="card"><ul class="pagination">';
                if($nowPage < 6) {
                    for($i = 1; $i <= $totalPage; $i++) {
                        if($nowPage <= 6) {
                            if($i > 6)
                                continue;
                        }
                        if($nowPage == $i) {
                            $html .= '<li class="disabled active"><a>' . $nowPage . '</a></li>';
                        } else {
                            $html .= '<li><a href="' . $url . $i . '">' . $i . '</a></li>';
                        }
                    }
                    if($totalPage > 6) {
                        $html .= '<li class="disabled"><a>...</a></li>';
                        $html .= '<li><a href="' . $url . $last . '">' . $last . '</a></li>';
                    }
                } elseif($nowPage >= 6 && $nowPage <= $totalPage - 5) {
                    $html .= '<li><a href="' . $url . $first . '">' . $first . '</a></li><li class="disabled"><a>...</a></li>';
                    for($i = $prev - 1; $i <= $next + 1; $i++) {
                        if($nowPage == $i) {
                            $html .= '<li class="disabled active"><a>' . $nowPage . '</a></li>';
                        } else {
                            $html .= '<li><a href="' . $url . $i . '">' . $i . '</a></li>';
                        }
                    }
                    if($totalPage > 6) {
                        $html .= '<li class="disabled"><a>...</a></li><li><a href="' . $url . $last . '">' . $last . '</a></li>';
                    }
                } elseif($nowPage > $totalPage - 5) {
                    if($totalPage > 6) {
                        $html .= '<li><a href="' . $url . $first . '">' . $first . '</a></li><li class="disabled"><a>...</a></li>';
                    }
                    for($i = 1; $i <= $totalPage; $i++) {
                        if($nowPage >= $totalPage - 6) {
                            if($i <= $totalPage - 6)
                                continue;
                        }
                        if($nowPage == $i) {
                            $html .= '<li class="disabled active"><a>' . $nowPage . '</a></li>';
                        } else {
                            $html .= '<li><a href="' . $url . $i . '">' . $i . '</a></li>';
                        }
                    }
                }
                $html .= '</ul></div>';
            }
            echo $html;
        }
    }

?>

<?php
 //查询本站收录域名
function baidu($baidu){
  $url=dh.peakmzf.cn;
  $baidu="http://api.jybkw.cn/baidu/?domain=$url";
  $str = file_get_contents($baidu);
 preg_match_all('/\d+/',$str,$arr);
$arr=join('',$arr[0]);
echo $arr;
}
?>