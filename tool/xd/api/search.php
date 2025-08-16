<?php
/**
 * 作者 ：Hidove Ivey
 * 2019年7月31日11:23:55
 */
$keyword = isset($_GET['keyword'])?$_GET['keyword']:die();

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
$keyword = urlencode(iconv('utf-8','gb2312',$keyword));
$res = HidoveCurl("https://www.xd0.com/sousuo.asp?SearchText=".$keyword);
preg_match_all('~<span>(.+?)</span> <a href="(.+?.html)" target="_blank" style="color:#.+?;font-weight:bold;">(.+?)</a>~', $res, $matches,PREG_SET_ORDER);
$data =[];
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
  'count' =>count($data)
];
$json = json_encode($json,JSON_UNESCAPED_UNICODE);
print_r($json);
