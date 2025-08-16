<?php
if ($_GET['url']) {
  $site='http://';
  $url=trim($site.$_GET['url']);
  $info=file_get_contents($url);
  header('Content-type:text/json');
function _charset($url){
  $text = file_get_contents($url);
  $mode = '/charset=(.*)\"/iU';
  preg_match($mode,$text,$result);
  return $result[1];
}
$charset = _charset($url);
function _title($url,$charset){
  $text = file_get_contents($url);
  if ($charset == 'gb2312'){
   $text = iconv('gb2312','utf-8',$text);
  }
  $mode = '/<title>(.*)<\/title>/iU';
  preg_match($mode,$text,$result);
  return $result[1];
}
echo '网站标题：'.$title = _title($url,$charset);
echo "\n";
function _keywords($url,$charset){
  $text = file_get_contents($url);
  if ($charset == 'gb2312'){
   $text = iconv('gb2312','utf-8',$text);
  }
  $mode = '/<meta\s+name=\"keywords\"\s+content=\"(.*)\"\s?\/?>/iU';
  preg_match($mode,$text,$result);
  return $result[1];

}
echo '网站关键词：'.$keywords = _keywords($url,$charset);
echo "\n";
function _description($url,$charset){
  $text = file_get_contents($url);
  if ($charset == 'gb2312'){
   $text = iconv('gb2312','utf-8',$text);
  }
  $mode = '/<meta\s+name=\"description\"\s+content=\"(.*)\"\s?\/?>/iU';
  preg_match($mode,$text,$result);
  return $result[1];
}
echo '网站简介：'.$description = _description($url,$charset);
}