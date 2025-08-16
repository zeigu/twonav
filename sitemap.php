<?php
/*
本php代码是自动抓取本站的网站链接的，是不需要手动更新网站地图的  总裁dh.peakmzf.cn 
*/
    header("Content-type: text/xml");
    header('HTTP/1.1 200 OK');

    echo '<?xml version="1.0" encoding="UTF-8"?>';
    $DATA = Data::getInstance();
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:mobile="http://www.baidu.com/schemas/sitemap-mobile/1/">
  <url>
    <loc><?php echo OZDAO_URL; ?></loc>
    <mobile:mobile type="mobile"/>
    <lastmod><?php echo gmdate('Y-m-d', time()); ?></lastmod>
    <changefreq>daily</changefreq>
    <priority>1.0</priority>
  </url>
    <?php
        //最新站点100个
        $sites = $DATA->getLatestSites(100);
        foreach($sites as $site) { ?>
          <url>
            <loc><?php echo OZDAO_URL; ?>site/<?php echo $site['id']; ?>.html</loc>
            <mobile:mobile type="autoadapt"/>
            <lastmod><?php echo date('Y-m-d', $site['time']); ?></lastmod>
            <changefreq>daily</changefreq>
            <priority>1.0</priority>
          </url>
        <?php }
    ?>
    <?php
        //最新文章100篇
        $posts = $DATA->getLatestPosts(100);
        foreach($posts as $post) { ?>
          <url>
            <loc><?php echo $post['url']; ?></loc>
            <mobile:mobile type="autoadapt"/>
            <lastmod><?php echo date('Y-m-d', $post['time']); ?></lastmod>
            <changefreq>daily</changefreq>
            <priority>0.9</priority>
          </url>
        <?php }
    ?>
    <?php
        //站点分类
        $siteSorts = $DATA->getSiteSorts();
        foreach($siteSorts as $siteSort) { ?>
          <url>
            <loc><?php echo $siteSort['url']; ?></loc>
            <mobile:mobile type="autoadapt"/>
            <lastmod><?php echo date('Y-m-d', $site['time']); ?></lastmod>
            <changefreq>daily</changefreq>
            <priority>0.8</priority>
          </url>
        <?php }
    ?>
    <?php
        //文章分类
        $postSorts = $DATA->getPostSorts();
        foreach($postSorts as $postSort) { ?>
          <url>
            <loc><?php echo $postSort['url']; ?></loc>
            <mobile:mobile type="autoadapt"/>
            <lastmod><?php echo date('Y-m-d', $post['time']); ?></lastmod>
            <changefreq>daily</changefreq>
            <priority>0.7</priority>
          </url>
        <?php }
    ?>
</urlset>
