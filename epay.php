<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>总裁支付</title>
</head>
<?php
require_once('wxpay.php');
require_once("include/EPaySDK/epay.config.php");
require_once("include/EPaySDK/epay_submit.class.php");
    $DATA = Data::getInstance();
    $DAO = $DATA->getDao();

    $notify_url = OZDAO_URL."notify_url.php";
    $return_url = OZDAO_URL."return_url.php";
    
    $sortid = $_POST['sortId'];
    $num = $_POST['num'];
    $domain = $_POST['domain'];
    if(empty($num))
    {
        exit('<title>总裁提示</title>
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
        <img src="https://auth.dhceo.com/assets/img/error.svg" alt="" width="120" />
    </div>
    <h1>请输入购买时长</h1>
            <p class="jump">
            页面将在 <span id="wait">3</span> 秒后自动跳转        </p>
        <p class="clearfix">
                    <a href="/pay.html" class="btn btn-primary">立即跳转</a>
            </p>
</div>
    <script type="text/javascript">
        (function () {
            var wait = document.getElementById(\'wait\');
            var interval = setInterval(function () {
                var time = --wait.innerHTML;
                if (time <= 0) {
					location.href = "/pay.html";
                    clearInterval(interval);
                }
            }, 1000);
        })();
    </script>');
    }
    if($num<1){
        exit('<title>总裁提示</title>
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
        <img src="https://auth.dhceo.com/assets/img/error.svg" alt="" width="120" />
    </div>
    <h1>购买时长有误 请重新输入</h1>
            <p class="jump">
            页面将在 <span id="wait">3</span> 秒后自动跳转        </p>
        <p class="clearfix">
                    <a href="/pay.html" class="btn btn-primary">立即跳转</a>
            </p>
</div>
    <script type="text/javascript">
        (function () {
            var wait = document.getElementById(\'wait\');
            var interval = setInterval(function () {
                var time = --wait.innerHTML;
                if (time <= 0) {
					location.href = "/pay.html";
                    clearInterval(interval);
                }
            }, 1000);
        })();
    </script>');
    }
    if($sortid==0)
    {
        exit('<title>总裁提示</title>
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
        <img src="https://auth.dhceo.com/assets/img/error.svg" alt="" width="120" />
    </div>
    <h1>请选择购买广告类型</h1>
            <p class="jump">
            页面将在 <span id="wait">3</span> 秒后自动跳转        </p>
        <p class="clearfix">
                    <a href="/pay.html" class="btn btn-primary">立即跳转</a>
            </p>
</div>
    <script type="text/javascript">
        (function () {
            var wait = document.getElementById(\'wait\');
            var interval = setInterval(function () {
                var time = --wait.innerHTML;
                if (time <= 0) {
					location.href = "/pay.html";
                    clearInterval(interval);
                }
            }, 1000);
        })();
    </script>');
    }
    else if($sortid==1)
    {
        //检查域名是否存在
        $site = $DATA->getByKey(TABLE_SITE, 'id', 'url', $domain);
        if(empty($site))
        {
            exit('<title>总裁提示</title>
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
        <img src="https://auth.dhceo.com/assets/img/error.svg" alt="" width="120" />
    </div>
    <h1>请先收录站点 再购买置顶</h1>
            <p class="jump">
            页面将在 <span id="wait">3</span> 秒后自动跳转        </p>
        <p class="clearfix">
                    <a href="/pay.html" class="btn btn-primary">立即跳转</a>
            </p>
</div>
    <script type="text/javascript">
        (function () {
            var wait = document.getElementById(\'wait\');
            var interval = setInterval(function () {
                var time = --wait.innerHTML;
                if (time <= 0) {
					location.href = "/pay.html";
                    clearInterval(interval);
                }
            }, 1000);
        })();
    </script>');
        }
        $money = $num * $CONFIG['zhiding_money'];
        
    }
    else if($sortid==2)
    {
        $money = $num * $CONFIG['list_money'];
    }
    else if($sortid==3)
    {
        $money = $num * $CONFIG['page_money'];
    }
    else
    {
        $money = $num * $CONFIG['site_money'];
    }
    
    //商户订单号
    $out_trade_no = $_POST['WIDout_trade_no'];
	//支付方式
    $type = $_POST['type'];
    //商品名称
    $name = '广告位自助购买';
	//付款金额
    
	//站点名称
    $sitename = '总裁';
    //构造要请求的参数数组，无需改动
    $parameter = array(
    		"pid" => trim($alipay_config['partner']),
    		"type" => $type,
    		"notify_url"	=> $notify_url,
    		"return_url"	=> $return_url,
    		"out_trade_no"	=> $out_trade_no,
    		"name"	=> $name,
    		"money"	=> $money,
    		"sitename"	=> $sitename
    );
    //添加订单记录到数据库
     $result = $DAO->insertOne(TABLE_ORDER, [
         'trade_no' => $out_trade_no,
         'type' => $sortid,
         'qq' => $_POST['qq'],
         'domain' => $_POST['domain'],
         'num' => $num,
         'pay_type'=>$type,
         'money'=>$money,
         'tu_url'=>$_POST['tu_url'],
         'creat_time'=>time()
       ]);
    
    
    //建立请求
    $alipaySubmit = new AlipaySubmit($alipay_config);
    $html_text = $alipaySubmit->buildRequestForm($parameter);
    echo $html_text;
    
    ?>
</body>
</html>