<?php
/*
 * @Author : 孜然
 * @Url : zrv7.com
 * @Date : 2022-1-29 20:46
 * @Project : 孜然导航系统
 * @Qq : 2937978586
 */
include "../include/function.php";
header("Content-type: text/html; charset=utf-8");
$url=$_GET['url'];
$data = file_get_contents($url);
$code = date("YmdHis").mt_rand(123456,654321);
if (!$url or $url === 'http://') {
    exit('{"code":-1,"msg":"链接不能为空！"}');
} else if (checkCode($url) === false) {
    exit('{"code":-1,"msg":"提交的网址无法访问！"}');
}
if (isset($_SESSION['title_api']) && $_SESSION['title_api']>time()-5) {
   exit('{"code":-1,"msg":"请勿频繁请求！5秒1次！"}');
}
//Title
preg_match('/<TITLE>([\w\W]*?)<\/TITLE>/si', $data, $Title);
if (!empty($Title[1])) {
    $title = $Title[1];
}
//Keywords
preg_match('/<META\s+name="keywords"\s+content="([\w\W]*?)"/si', $data, $Keywords);
if (empty($Keywords[1])) {
    preg_match("/<META\s+name='keywords'\s+content='([\w\W]*?)'/si", $data, $Keywords);
}
if (empty($Keywords[1])) {
    preg_match('/<META\s+content="([\w\W]*?)"\s+name="keywords"/si', $data, $Keywords);
}
if (empty($Keywords[1])) {
    preg_match('/<META\s+http-equiv="keywords"\s+content="([\w\W]*?)"/si', $data, $Keywords);
}
if (!empty($Keywords[1])) {
    $keywords = $Keywords[1];
}
//Description
preg_match('/<META\s+name="description"\s+content="([\w\W]*?)"/si', $data, $Description);
if (empty($Description[1])) {
    preg_match("/<META\s+name='description'\s+content='([\w\W]*?)'/si", $data, $Description);
}
if (empty($Description[1])) {
    preg_match('/<META\s+content="([\w\W]*?)"\s+name="description"/si', $data, $Description);
}
if (empty($Description[1])) {
    preg_match('/<META\s+http-equiv="description"\s+content="([\w\W]*?)"/si', $data, $Description);
}
if (!empty($Description[1])) {
    $description = $Description[1];
}
//ICP
preg_match("/^(http:\/\/|https:\/\/)?([^\/]+)/i", $url, $url2);//去掉一切参数
$html=curl_get("http://micp.chinaz.com/?query=".$url2[2]);
preg_match_all('/<tr><td class=\"ww-3 c-39 bg-3fa\">(.*?)<\/td\><td class=\"z-tl\">(.*?)<\/td\><\/tr\>/i',$html,$icp);
if ($icp[2][2]) {
    $icp=$icp[2][2];
} else {
    $icp='暂无备案';
}
if ($Title[1] !== "") {
    $_SESSION['title_api']=time()+5;
    $result = array('code'=>0,'msg'=>'获取成功！['.$code.']','title'=>$title,'keywords'=>$keywords,'description'=>$description,'icp'=>$icp);
} else {
    $_SESSION['title_api']=time()+5;
    $result = array('code'=>-1,'msg'=>'站点信息获取失败！['.$code.']');
}
if (json_encode($result) === false) {
    exit('{"code":-1,"msg":"站点信息获取失败！['.$code.']"}');
} else {
    exit(json_encode($result));
}
