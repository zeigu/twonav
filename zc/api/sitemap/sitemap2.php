<?php
header("Content-Type: text/html; charset=utf-8");
header('HTTP/1.1 200 OK');
include("../../../ZR/common.php");
?>

<?php
$result = $DB->query("SELECT * FROM zrdao_site WHERE type=1 order by id desc limit ".$conf['sitemap_site']."");
while($row = $DB->fetch($result)){
?>
http://<?php echo $domain ?>/site_<?php echo $row['id']; ?>.html<br>
<?php } ?>

<?php
$result = $DB->query("SELECT * FROM zrdao_post WHERE type=1 order by id desc limit ".$conf['sitemap_post']."");
while($rows = $DB->fetch($result)){
?>
http://<?php echo $domain ?>/post_<?php echo $rows['id']; ?>.html<br>
<?php } ?>

<?php
$result = $DB->query("SELECT * FROM zrdao_sort_site WHERE type=1 order by id desc limit ".$conf['sitemap_site']."");
while($site = $DB->fetch($result)){
?>
http://<?php echo $domain ?>/sort_<?php echo $site['id']; ?>.html<br>
<?php } ?>

<?php
$result = $DB->query("SELECT * FROM zrdao_sort_post WHERE type=1 order by id desc limit ".$conf['sitemap_post']."");
while($post = $DB->fetch($result)){
?>
http://<?php echo $domain ?>/class_<?php echo $post['id']; ?>.html<br>
<?php } ?>

http://<?php echo $domain ?>/<br>
http://<?php echo $domain ?>/apply.html<br>
http://<?php echo $domain ?>/about.html<br>
http://<?php echo $domain ?>/ranking.html<br>
http://<?php echo $domain ?>/sitemap.xml<br>