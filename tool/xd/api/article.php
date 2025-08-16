<?php
/**
 * 作者 ：Hidove Ivey
 * 2019年7月31日10:59:16
 */
$id = isset($_GET['id'])?$_GET['id']:die();
function HidoveCurl($url){
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_HEADER, false);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	$resourse = curl_exec($curl);
	curl_close($curl);
	$resourse = iconv('GBK', 'UTF-8', $resourse);
	return $resourse;
}
$res = HidoveCurl("https://www.xd0.com/".$id);
if (strstr($res, '对象已移动')) {
	$json = [
	'code' => 0,
	'msg' => 'moved',
	];
	$data = json_encode($json,JSON_UNESCAPED_UNICODE);
	print_r($data);
	die();
}
preg_match('~<h2 class="post-title">(.+?)</h2>~', $res,$title);
$title = $title[1];
$pattern = '~<div id="arctext" >([\s\S]+)</div></td>
</tr>~';
preg_match($pattern, $res,$text);
$pattern = '~<a href="#down" onclick="window.open\(\'(.+?)\'\);return false;" class="sbtn" title=""><i class="ico"></i><i class="line"></i>(.+?)</a> &nbsp;~';
$text = preg_replace($pattern, '', $text[1]);
$text = preg_replace('~<h3 class="tit"><i class="ico"></i>下载地址</h3>~', '', $text);
$text = strip_tags($text,'<p><br>');
// 图片
$pattern = '~<a class="pics" href="(/upload/.+?)" rel="pics">~';
preg_match_all($pattern, $res,$imageMatchs,PREG_SET_ORDER);
// 下载地址
$pattern = '~<a href="#down" onclick="window.open\(\'(.+?)\'\);return false;" class="sbtn" title=""><i class="ico"></i><i class="line"></i>(.+?)</a>~';
preg_match_all($pattern, $res,$downMatchs,PREG_SET_ORDER);
$data = null;
$images = [];
$down = [];

foreach ($imageMatchs as $key => $value) {
	$images[] = $value[1];
}
$dwonTemp = [];
foreach ($downMatchs as $key => $value) {
	$dwonTemp['title'] = $value[2];
	$dwonTemp['url'] = $value[1];
	$down[] = $dwonTemp;
}
$json = [
	'code' => 1,
	'msg' => 'success',
	'data' => [
		'title' => $title,
		'images' => $images,
		'text' => $text,
		'down' => $down,
	]
];
$data = json_encode($json,JSON_UNESCAPED_UNICODE);
print_r($data);

