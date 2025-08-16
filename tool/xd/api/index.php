<?php
/**
 * 作者 ：Hidove Ivey
 * 2019年7月31日11:17:12
 */
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
$res = HidoveCurl('https://www.xd0.com/ajax/wz.ajax.asp?page='.$page);
preg_match_all('~<[span|span style="color: #F00;"]+>(.+?)</span><img src=".+?"/>
<a href="(.+?)" title=".+?" style="color:#000000;" target="_blank">(.+?)</a>~', $res, $matches,PREG_SET_ORDER);
$data = [];
foreach ($matches as $key => $value) {
	$dataTemp['title'] = $value[3];
	$dataTemp['url'] = $value[2];
	$dataTemp['date'] = $value[1];
	$data[] = $dataTemp;
}
$json = [
	'code' => 1,
	'msg' => 'success',
	'data' => $data,
];
$json = json_encode($json,JSON_UNESCAPED_UNICODE);
print_r($json);
