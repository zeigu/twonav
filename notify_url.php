<?php

require_once('wxpay.php');
require_once("include/EPaySDK/epay.config.php");
require_once("include/EPaySDK/epay_notify.class.php");
$DATA = Data::getInstance();
$DAO = $DATA->getDao();

//计算得出通知验证结果
$alipayNotify = new AlipayNotify($alipay_config);
$verify_result = $alipayNotify->verifyNotify();

if($verify_result) {//验证成功
	$out_trade_no = $_GET['out_trade_no'];
	$trade_no = $_GET['trade_no'];
	$trade_status = $_GET['trade_status'];
	$type = $_GET['type'];
	if ($_GET['trade_status'] == 'TRADE_SUCCESS') {
		$od = $DATA->getByOrder(TABLE_ORDER, null, 'trade_no', $out_trade_no);
		if(empty($od) || $od['status']==1)
		{
		    echo "fail";
		    exit;
		}
		//更新订单状态，并执行购买逻辑
		$result = $DAO->updateById(TABLE_ORDER, $od['id'], [
           'status' =>1,
           'end_time'=>time()
        ]);
        if($od['type']==1)
        {
            $site = $DATA->getByKey(TABLE_SITE, 'id', 'url', $od['domain']);
            $result = $DAO->updateById(TABLE_SITE, $site['id'], [
             'top' =>1
            ]);
        }
        else if($od['type']==2)
        {
            $result = $DAO->insertOne(TABLE_AD, [
             'page' => 'list',
             'title' => $od['qq'],
             'picture' => $od['tu_url'],
             'url' =>$od['domain'],
             'state' => 1,
             'end_time'=>strtotime('+'.$od['num'].'month')
           ]);
        }
        else if($od['type']==3)
        {
            $result = $DAO->insertOne(TABLE_AD, [
             'page' => 'post',
             'title' => $od['qq'],
             'picture' => $od['tu_url'],
             'url' =>$od['domain'],
             'state' => 1,
             'end_time'=>strtotime('+'.$od['num'].'month')
           ]);
        }
        else{
            $result = $DAO->insertOne(TABLE_AD, [
             'page' => 'site',
             'title' => $od['qq'],
             'picture' => $od['tu_url'],
             'url' =>$od['domain'],
             'state' => 1,
             'end_time'=>strtotime('+'.$od['num'].'month')
           ]);
        }
        
        
        

    }

	echo "success";	
}
else {
    //验证失败
    echo "fail";
}
?>