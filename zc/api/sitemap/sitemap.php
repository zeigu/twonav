<?php
header("Content-Type: text/xml; charset=utf-8");
header('HTTP/1.1 200 OK');
echo '<?xml version="1.0" encoding="utf-8"?>';
include("../../../ZR/common.php");
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:mobile="http://www.baidu.com/schemas/sitemap-mobile/1/">
 <url>
    <loc><?php echo $httpdomain; ?></loc>
    <mobile:mobile type="mobile"/>
      <lastmod><?php echo gmdate('Y-m-d\TH:i:s+00:00', time()); ?></lastmod>
    <changefreq>daily</changefreq>
    <priority>1.0</priority>
  </url>

<?php
$result = $DB->query("SELECT * FROM zrdao_site WHERE type=1 order by id desc limit ".$conf['sitemap_site']."");
while($row = $DB->fetch($result)){
$url=$httpdomain.'/site_'.$row['id'].'.html';
?>
         <url>
            <loc><?php echo $url;?></loc>
            <mobile:mobile type="autoadapt"/>
           <lastmod><?php echo gmdate('Y-m-d\TH:i:s+00:00', time()); ?></lastmod>
             <changefreq>monthly</changefreq>
            <priority>0.8</priority>
          </url>
<?php } ?>

<?php
$result = $DB->query("SELECT * FROM zrdao_post WHERE type=1 order by id desc limit ".$conf['sitemap_post']."");
while($rows = $DB->fetch($result)){
$url=$httpdomain.'/post_'.$rows['id'].'.html';
?>
         <url>
            <loc><?php echo $url;?></loc>
            <mobile:mobile type="autoadapt"/>
            <lastmod><?php echo gmdate('Y-m-d\TH:i:s+00:00', time()); ?></lastmod>
            <changefreq>monthly</changefreq>
            <priority>0.8</priority>
          </url>
        <?php } ?>

<?php
$result = $DB->query("SELECT * FROM zrdao_sort_site WHERE type=1 order by id desc limit ".$conf['sitemap_site']."");
while($site = $DB->fetch($result)){
$url=$httpdomain.'/sort_'.$site['id'].'.html';
?>
          <url>
            <loc><?php echo $url;?></loc>
            <mobile:mobile type="autoadapt"/>
           <lastmod><?php echo gmdate('Y-m-d\TH:i:s+00:00', time()); ?></lastmod>
             <changefreq>monthly</changefreq>
            <priority>0.8</priority>
          </url>
        <?php } ?>
    
<?php
$result = $DB->query("SELECT * FROM zrdao_sort_post WHERE type=1 order by id desc limit ".$conf['sitemap_post']."");
while($post = $DB->fetch($result)){
$url=$httpdomain.'/class_'.$post['id'].'.html';
?>
          <url>
            <loc><?php echo $url;?></loc>
            <mobile:mobile type="autoadapt"/>
           <lastmod><?php echo gmdate('Y-m-d\TH:i:s+00:00', time()); ?></lastmod>
             <changefreq>monthly</changefreq>
            <priority>0.8</priority>
          </url>
        <?php } ?>

        <url>
            <loc>http://<?php echo $domain ?>/apply.html</loc>
            <mobile:mobile type="autoadapt"/>
            <lastmod><?php echo gmdate('Y-m-d\TH:i:s+00:00', time()); ?></lastmod>
            <changefreq>monthly</changefreq>
            <priority>0.8</priority>
          </url>
        <url>
            <loc>http://<?php echo $domain ?>/about.html</loc>
            <mobile:mobile type="autoadapt"/>
           <lastmod><?php echo gmdate('Y-m-d\TH:i:s+00:00', time()); ?></lastmod>
             <changefreq>monthly</changefreq>
            <priority>0.8</priority>
          </url>
        <url>
            <loc>http://<?php echo $domain ?>/ranking.html</loc>
            <mobile:mobile type="autoadapt"/>
           <lastmod><?php echo gmdate('Y-m-d\TH:i:s+00:00', time()); ?></lastmod>
             <changefreq>monthly</changefreq>
            <priority>0.8</priority>
          </url>
</urlset>