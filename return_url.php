<?php
require_once('wxpay.php');
require_once("include/EPaySDK/epay.config.php");
require_once("include/EPaySDK/epay_notify.class.php");
$DATA = Data::getInstance();
$DAO = $DATA->getDao();
?>
<!DOCTYPE HTML>
<html>
    <head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
//计算得出通知验证结果
$alipayNotify = new AlipayNotify($alipay_config);
$verify_result = $alipayNotify->verifyReturn();
if($verify_result) {
	//商户订单号
	$out_trade_no = $_GET['out_trade_no'];
	//支付宝交易号
	$trade_no = $_GET['trade_no'];
	//交易状态
	$trade_status = $_GET['trade_status'];
	//支付方式
	$type = $_GET['type'];
    if($_GET['trade_status'] == 'TRADE_SUCCESS')
    {
		$od = $DATA->getByOrder(TABLE_ORDER, null, 'trade_no', $out_trade_no);
		if(empty($od))
		{
		    echo "该订单不存在<br />";
		}
		if($od['status']!=1)
		{
		    echo "支付失败,有疑问联系管理员<br />";
		}
		echo '<title>总裁提示</title>
    <style type="text/css">
        *{box-sizing:border-box;margin:0;padding:0;font-family:Lantinghei SC,Open Sans,Arial,Hiragino Sans GB,Microsoft YaHei,"微软雅黑",STHeiti,WenQuanYi Micro Hei,SimSun,sans-serif;-webkit-font-smoothing:antialiased}
        body{padding:70px 50px;background:#edf1f4;font-weight:400;font-size:1pc;-webkit-text-size-adjust:none;color:#333}
        a{outline:0;color:#3498db;text-decoration:none;cursor:pointer}
        .system-message{margin:20px auto;padding:50px 0px;background:#fff;box-shadow:0 0 30px hsla(0,0%,39%,.06);text-align:center;width:100%;border-radius:2px;}
        .system-message h1{margin:0;margin-bottom:9pt;color:#444;font-weight:400;font-size:30px}
        .system-message .jump,.system-message .image{margin:20px 0;padding:0;padding:10px 0;font-weight:400}
        .system-message .jump{font-size:14px}
        .system-message .jump a{color:#333}
        .system-message p{font-size:9pt;line-height:20px}
        .system-message .btn{display:inline-block;margin-right:10px;width:138px;height:2pc;border:1px solid #44a0e8;border-radius:30px;color:#44a0e8;text-align:center;font-size:1pc;line-height:2pc;margin-bottom:5px;}
        .success .btn{border-color:#69bf4e;color:#69bf4e}
        .error .btn{border-color:#ff8992;color:#ff8992}
        .info .btn{border-color:#3498db;color:#3498db}
        .copyright p{width:100%;color:#919191;text-align:center;font-size:10px}
        .system-message .btn-grey{border-color:#bbb;color:#bbb}
        .clearfix:after{clear:both;display:block;visibility:hidden;height:0;content:"."}
        @media (max-width:768px){body {padding:20px;}}
        @media (max-width:480px){.system-message h1{font-size:30px;}}
    </style>
<div class="system-message error">
    <div class="image">
        <img src="https://auth.dhceo.com/assets/img/success.svg" alt="" width="120" />
    </div>
    <h1>购买成功</h1>
            <p class="jump">
            页面将在 <span id="wait">3</span> 秒后自动跳转        </p>
        <p class="clearfix">
                    <a href="/" class="btn btn-primary">立即跳转</a>
            </p>
</div>
    <script type="text/javascript">
        (function () {
            var wait = document.getElementById(\'wait\');
            var interval = setInterval(function () {
                var time = --wait.innerHTML;
                if (time <= 0) {
					location.href = "/";
                    clearInterval(interval);
                }
            }, 1000);
        })();
    </script>';
		exit;
		
    }
    else
    {
      echo "trade_status=".$_GET['trade_status'];
    }

	echo '<title>总裁提示</title>
    <style type="text/css">
        *{box-sizing:border-box;margin:0;padding:0;font-family:Lantinghei SC,Open Sans,Arial,Hiragino Sans GB,Microsoft YaHei,"微软雅黑",STHeiti,WenQuanYi Micro Hei,SimSun,sans-serif;-webkit-font-smoothing:antialiased}
        body{padding:70px 50px;background:#edf1f4;font-weight:400;font-size:1pc;-webkit-text-size-adjust:none;color:#333}
        a{outline:0;color:#3498db;text-decoration:none;cursor:pointer}
        .system-message{margin:20px auto;padding:50px 0px;background:#fff;box-shadow:0 0 30px hsla(0,0%,39%,.06);text-align:center;width:100%;border-radius:2px;}
        .system-message h1{margin:0;margin-bottom:9pt;color:#444;font-weight:400;font-size:30px}
        .system-message .jump,.system-message .image{margin:20px 0;padding:0;padding:10px 0;font-weight:400}
        .system-message .jump{font-size:14px}
        .system-message .jump a{color:#333}
        .system-message p{font-size:9pt;line-height:20px}
        .system-message .btn{display:inline-block;margin-right:10px;width:138px;height:2pc;border:1px solid #44a0e8;border-radius:30px;color:#44a0e8;text-align:center;font-size:1pc;line-height:2pc;margin-bottom:5px;}
        .success .btn{border-color:#69bf4e;color:#69bf4e}
        .error .btn{border-color:#ff8992;color:#ff8992}
        .info .btn{border-color:#3498db;color:#3498db}
        .copyright p{width:100%;color:#919191;text-align:center;font-size:10px}
        .system-message .btn-grey{border-color:#bbb;color:#bbb}
        .clearfix:after{clear:both;display:block;visibility:hidden;height:0;content:"."}
        @media (max-width:768px){body {padding:20px;}}
        @media (max-width:480px){.system-message h1{font-size:30px;}}
    </style>
<div class="system-message error">
    <div class="image">
        <img src="https://auth.dhceo.com/assets/img/success.svg" alt="" width="120" />
    </div>
    <h1>购买成功</h1>
            <p class="jump">
            页面将在 <span id="wait">3</span> 秒后自动跳转        </p>
        <p class="clearfix">
                    <a href="/" class="btn btn-primary">立即跳转</a>
            </p>
</div>
    <script type="text/javascript">
        (function () {
            var wait = document.getElementById(\'wait\');
            var interval = setInterval(function () {
                var time = --wait.innerHTML;
                if (time <= 0) {
					location.href = "/";
                    clearInterval(interval);
                }
            }, 1000);
        })();
    </script>';

}
else {
    //验证失败
    //如要调试，请看alipay_notify.php页面的verifyReturn函数
    echo "验证失败";
}
?>
        <title>总裁充值通知</title>
	</head>
    <body>
    </body>
</html>