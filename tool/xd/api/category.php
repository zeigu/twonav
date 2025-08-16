<?php
/**
 * 作者 ：Hidove Ivey
 * 2019年7月31日11:27:55
 */
$id = isset($_GET['id'])?$_GET['id']:die();
$page = isset($_GET['page'])?$_GET['page']:die();

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
$res = HidoveCurl("https://www.xd0.com/i_wz.asp?id=".$id.'&PageIndex='.$page);
preg_match_all('~<a href="(i-wz-\d+.html)"target="_blank"style="color:#000000;font-weight:bold;">(.+?)</a></h2>~', $res, $matches,PREG_SET_ORDER);
preg_match_all('~<span class="ptime"><i class="icon-calendar"></i><[span|span style="color: #F00;"]+>(.+?)</span>~', $res, $dateMatches,PREG_SET_ORDER);
preg_match_all('~<div id=CommonListTitle> &nbsp; &nbsp; &nbsp; (.+?)</div>~', $res, $categoryMatches);

$data =[];
foreach ($matches as $key => $value) {
	$dataTemp['title'] = $value[2];
	$dataTemp['url'] = $value[1];
	$dataTemp['date'] = $dateMatches[$key][1];
	$data[] = $dataTemp;
}
$json = [
	'code' => 1,
	'msg' => 'success',
	'data' => $data,
	'category' => $categoryMatches[1][0],
];
$json = json_encode($json,JSON_UNESCAPED_UNICODE);
print_r($json);
