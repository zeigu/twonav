<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    //自动加载类
    spl_autoload_register(function($class) {
        $filename = OZDAO_ROOT . 'include/lib/' . $class . '.php';
        if(file_exists($filename)) {
            require_once $filename;
        } else {
            die($class . '类未定义');
        }
    });
    
    //校验常量是否定义且不为空，如果传入的是数组，则有一个未定义或未空就返回false
    function checkConstants($constants) {
        if(!is_array($constants)) {
            return defined($constants) && !empty($constants);
        }
        foreach($constants as $constant) {
            if(!defined($constant) || empty($constants)) {
                return false;
            }
        }
        return true;
    }

    //跳转安装
    function gotoInstall() {
        die('<title>总裁提示</title>
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
    <h1>还未安装 请先安装总裁导航系统</h1>
            <p class="jump">
            页面将在 <span id="wait">3</span> 秒后自动跳转        </p>
        <p class="clearfix">
                    <a href="/install" class="btn btn-primary">立即跳转</a>
            </p>
</div>
    <script type="text/javascript">
        (function () {
            var wait = document.getElementById(\'wait\');
            var interval = setInterval(function () {
                var time = --wait.innerHTML;
                if (time <= 0) {
					location.href = "/install";
                    clearInterval(interval);
                }
            }, 1000);
        })();
    </script>');
    }

    //返回404页面
    function return404() {
        header('HTTP/1.1 404 Not Found');
        header('Status: 404 Not Found');
        if(file_exists(TEMPLATE_PATH . '404.php')) {
            include TEMPLATE_PATH . '404.php';
        } elseif(file_exists(OZDAO_ROOT . '404.php')) {
            include OZDAO_ROOT . '404.php';
        } else {
            echo '抱歉，请求的页面不存在！<a href="javascript:history.back();">点击返回</a>';
        }
        die();
    }
function get_curl($url,$post=0,$referer=0,$cookie=0,$header=0,$ua=0,$nobaody=0){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	$httpheader[] = "Accept: */*";
	$httpheader[] = "Accept-Encoding: gzip,deflate,sdch";
	$httpheader[] = "Accept-Language: zh-CN,zh;q=0.8";
	$httpheader[] = "Connection: close";
	curl_setopt($ch, CURLOPT_TIMEOUT, 30);
	if($post){
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	}
	curl_setopt($ch, CURLOPT_HTTPHEADER, $httpheader);
	if($header){
		curl_setopt($ch, CURLOPT_HEADER, TRUE);
	}
	if($cookie){
		curl_setopt($ch, CURLOPT_COOKIE, $cookie);
	}
	if($referer){
		if($referer==1){
			curl_setopt($ch, CURLOPT_REFERER, 'http://m.qzone.com/infocenter?g_f=');
		}else{
			curl_setopt($ch, CURLOPT_REFERER, $referer);
		}
	}
	if($ua){
		curl_setopt($ch, CURLOPT_USERAGENT,$ua);
	}else{
		curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36');
	}
	if($nobaody){
		curl_setopt($ch, CURLOPT_NOBODY,1);
	}
	curl_setopt($ch, CURLOPT_ENCODING, "gzip");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	$ret = curl_exec($ch);
	curl_close($ch);
	return $ret;
}
    //RESTFul转JSON
    function jsonEncode($code, $msg, $data = null) {
        $result = ['code' => $code, 'msg' => $msg];
        $data != null && $result['data'] = $data;
        return json_encode($result, 320);
    }

    //返回JSON数据，并退出
    function returnJson($code, $msg, $data = null) {
        die(jsonEncode($code, $msg, $data));
    }

    //推送链接
    function pushUrls($api, $urls) {
        $ch = curl_init();
        $options = [
            CURLOPT_URL => $api,
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS => implode("\n", $urls),
            CURLOPT_HTTPHEADER => ['Content-Type: text/plain'],
        ];
        curl_setopt_array($ch, $options);
        $result = curl_exec($ch);
        curl_close($ch);
        return json_decode($result, 320);
    }

       //获取模板初始设置
        function getInitTSettings($simple = true) {
            $configFile = TEMPLATE_PATH . 'config.json';
            if(!is_file($configFile)) {
                return [];
            }
            $jsonString = file_get_contents($configFile);
            $data = json_decode($jsonString, 320);
            $settings = $data['settings'];
            if(!is_array($settings)) {
                return [];
            }
            $initSettings = [];
            foreach($settings as $setting) {
                if(empty($setting['key']) || empty($setting['default'])) {
                    continue;
                }
                if($simple) {
                    $initSettings[$setting['key']] = $setting['default'];
                } else {
                    $initSettings[] = $setting;
                }
            }
            return $initSettings;
        }

    //判断是否来自其他来路
    function isOtherReferer() {
        $referer = $_SERVER['HTTP_REFERER'];
        if(!isset($referer)) {
            return true;
        }
        $refererHost = parse_url($referer)['host'];
        $thisHost = parse_url(OZDAO_URL)['host'];
        return $refererHost != $thisHost;
    }

    //检测是否外链到本站
    function checkExternalLink($url) {
        $text = httpGet($url);
        return stripos($text, $_SERVER['HTTP_HOST']);
    }

    //通过链接获取域名
    function getDomain($url) {
        preg_match("/^(?:http:\/\/|https:\/\/)?([^\/]+)/i", $url, $matches);
        return $matches[1];
    }

    //给无http://或https://前缀的链接加上默认http://
    function addProtocol($url, $protocol = null) {
        if(!empty($url)) {
            $protocol = $protocol ? $protocol : 'http://';
            if(!preg_match("/^(http:\/\/|https:\/\/)/i", $url)) {
                return $protocol . $url;
            }
        }
        return $url;
    }

    //httpGet
    function httpGet($url) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 500);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        $result = curl_exec($curl);
        curl_close($curl);
        return $result;
    }

    //获取站点信息（标题,关键词,描述）
    function getSiteInfo($url) {
        $api = 'https://api.ba9.cn/api/get.tdk?url=';
        return json_decode(httpGet($api . $url), 320);
    }

    //保存ico图标
   function saveIco($url, $ico = null) {
        $ico = $ico ? $ico : 'https://favicon.cccyun.cc/' . $url;
        $dir = IMAGES_PATH . 'ico/';
        !is_dir($dir) && mkdir($dir, 0777, true);
        $path = $dir . getDomain($url) . '.ico';
        $file = file_get_contents($ico);
        file_put_contents($path, $file);
    }
function sysmsge($msg = '未知的异常', $die = true) {
    echo "  \r\n    <!DOCTYPE html>\r\n    <html xmlns=\"http://www.w3.org/1999/xhtml\" lang=\"zh-CN\">\r\n    <head>\r\n        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\r\n        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\r\n        <title>站点提示信息</title>\r\n        <style type=\"text/css\">\r\nhtml{background:#eee}body{background:#fff;color:#333;font-family:\"微软雅黑\",\"Microsoft YaHei\",sans-serif;margin:2em auto;padding:1em 2em;max-width:700px;-webkit-box-shadow:10px 10px 10px rgba(0,0,0,.13);box-shadow:10px 10px 10px rgba(0,0,0,.13);opacity:.8}h1{border-bottom:1px solid #dadada;clear:both;color:#666;font:24px \"微软雅黑\",\"Microsoft YaHei\",,sans-serif;margin:30px 0 0 0;padding:0;padding-bottom:7px}#error-page{margin-top:50px}h3{text-align:center}#error-page p{font-size:9px;line-height:1.5;margin:25px 0 20px}#error-page code{font-family:Consolas,Monaco,monospace}ul li{margin-bottom:10px;font-size:9px}a{color:#21759B;text-decoration:none;margin-top:-10px}a:hover{color:#D54E21}.button{background:#f7f7f7;border:1px solid #ccc;color:#555;display:inline-block;text-decoration:none;font-size:9px;line-height:26px;height:28px;margin:0;padding:0 10px 1px;cursor:pointer;-webkit-border-radius:3px;-webkit-appearance:none;border-radius:3px;white-space:nowrap;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;-webkit-box-shadow:inset 0 1px 0 #fff,0 1px 0 rgba(0,0,0,.08);box-shadow:inset 0 1px 0 #fff,0 1px 0 rgba(0,0,0,.08);vertical-align:top}.button.button-large{height:29px;line-height:28px;padding:0 12px}.button:focus,.button:hover{background:#fafafa;border-color:#999;color:#222}.button:focus{-webkit-box-shadow:1px 1px 1px rgba(0,0,0,.2);box-shadow:1px 1px 1px rgba(0,0,0,.2)}.button:active{background:#eee;border-color:#999;color:#333;-webkit-box-shadow:inset 0 2px 5px -3px rgba(0,0,0,.5);box-shadow:inset 0 2px 5px -3px rgba(0,0,0,.5)}table{table-layout:auto;border:1px solid #333;empty-cells:show;border-collapse:collapse}th{padding:4px;border:1px solid #333;overflow:hidden;color:#333;background:#eee}td{padding:4px;border:1px solid #333;overflow:hidden;color:#333}\r\n        </style>\r\n    </head>\r\n    <body id=\"error-page\">\r\n        ";
    echo "<h3>站点提示信息</h3>";
    echo $msg;
    echo "    </body>\r\n    </html>\r\n    ";
    if ($die == true) {
        exit(0);
    }
}
    //发送邮件
    function sendEmail($config, $sender, $receiver, $email) {
        require_once OZDAO_ROOT . 'include/PHPMailer/Exception.php';
        require_once OZDAO_ROOT . 'include/PHPMailer/PHPMailer.php';
        require_once OZDAO_ROOT . 'include/PHPMailer/SMTP.php';
        $mailer = new PHPMailer(true);                                            // Passing `true` enables exceptions
        try {
            //服务器配置
            $mailer->CharSet = 'UTF-8';                                                   //设定邮件编码
            $mailer->SMTPDebug = 0;                                                       // 调试模式输出
            $mailer->isSMTP();                                                            // 使用SMTP
            $mailer->Host = $config['host'];                                              // SMTP服务器
            $mailer->SMTPAuth = true;                                                     // 允许 SMTP 认证
            $mailer->Username = $config['username'];                                      // SMTP 用户名  即邮箱的用户名
            $mailer->Password = $config['password'];                                      // SMTP 密码  部分邮箱是授权码(例如163邮箱)
            $mailer->SMTPSecure = $mailer::ENCRYPTION_SMTPS;                              // 允许 TLS 或者ssl协议
            $mailer->Port = $config['port'];                                              // 服务器端口 25 或者465 具体要看邮箱服务器支持
            $mailer->setFrom($sender['email'], $sender['name']);                          //发件人
            $mailer->addAddress($receiver['email'], $receiver['name']);                   // 收件人
            $mailer->addReplyTo($sender['email'], $sender['name']);                       //回复的时候回复给哪个邮箱 建议和发件人一致
            //邮件内容
            $mailer->isHTML(true);                                                  // 是否以HTML文档格式发送  发送后客户端可直接显示对应HTML内容
            $mailer->Subject = $email['subject'];
            $mailer->Body = $email['body'];
            $mailer->AltBody = getTextFromHtml($email['body']);
            $mailer->send();
            return true;
        } catch(Exception $e) {
            return $mailer->ErrorInfo;
        }
    }

    //从HTML中获取文本
    function getTextFromHtml($str) {
        $str = html_entity_decode($str);    //实体化html
        $str = trim($str); //清除字符串两边的空格
        $str = strip_tags($str, '');    //利用php自带的函数清除html格式
        $str = preg_replace("/\b/", '', $str); //使用正则表达式替换内容，如：空格，换行，并将替换为空
        $str = preg_replace("/&nbsp;/", '', $str);
        return trim($str); //返回字符串
    }

    //获取截取后的字符串
    function getSubstr($string, $length, $suffix = '...') {
        if(mb_strlen($string) > $length) {
            return mb_substr($string, 0, $length) . $suffix;
        }
        return $string;
    }

    //转义
    function myAddSlashes($string, $strip = false) {
        if(is_array($string)) {
            foreach($string as $key => $val) {
                $string[$key] = myAddSlashes($val, $strip);
            }
        } else {
            $string = addslashes($strip ? stripslashes($string) : $string);
        }
        return $string;
    }

    //XSS过滤
    function removeXSS($val) {
        if(!is_string($val)) {
            return $val;
        }
        $val = htmlspecialchars($val, ENT_QUOTES);
        $val = preg_replace('/([\x00-\x08,\x0b-\x0c,\x0e-\x19])/', '', $val);
        $search = 'abcdefghijklmnopqrstuvwxyz';
        $search .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $search .= '1234567890!@#$%^&*()';
        $search .= '~`";:?+/={}[]-_|\'\\';
        for($i = 0; $i < strlen($search); $i++) {
            $val = preg_replace('/(&#[xX]0{0,8}' . dechex(ord($search[$i])) . ';?)/i', $search[$i], $val);
            $val = preg_replace('/(&#0{0,8}' . ord($search[$i]) . ';?)/', $search[$i], $val);
        }
        $ra1 = ['javascript', 'vbscript', 'expression', 'applet', 'meta', 'xml', 'blink', 'link', 'style', 'script', 'embed', 'object', 'iframe', 'frame', 'frameset', 'ilayer', 'layer', 'bgsound', 'title', 'base'];
        $ra2 = ['onabort', 'onactivate', 'onafterprint', 'onafterupdate', 'onbeforeactivate', 'onbeforecopy', 'onbeforecut', 'onbeforedeactivate', 'onbeforeeditfocus', 'onbeforepaste', 'onbeforeprint', 'onbeforeunload', 'onbeforeupdate', 'onblur', 'onbounce', 'oncellchange', 'onchange', 'onclick', 'oncontextmenu', 'oncontrolselect', 'oncopy', 'oncut', 'ondataavailable', 'ondatasetchanged', 'ondatasetcomplete', 'ondblclick', 'ondeactivate', 'ondrag', 'ondragend', 'ondragenter', 'ondragleave', 'ondragover', 'ondragstart', 'ondrop', 'onerror', 'onerrorupdate', 'onfilterchange', 'onfinish', 'onfocus', 'onfocusin', 'onfocusout', 'onhelp', 'onkeydown', 'onkeypress', 'onkeyup', 'onlayoutcomplete', 'onload', 'onlosecapture', 'onmousedown', 'onmouseenter', 'onmouseleave', 'onmousemove', 'onmouseout', 'onmouseover', 'onmouseup', 'onmousewheel', 'onmove', 'onmoveend', 'onmovestart', 'onpaste', 'onpropertychange', 'onreadystatechange', 'onreset', 'onresize', 'onresizeend', 'onresizestart', 'onrowenter', 'onrowexit', 'onrowsdelete', 'onrowsinserted', 'onscroll', 'onselect', 'onselectionchange', 'onselectstart', 'onstart', 'onstop', 'onsubmit', 'onunload'];
        $ra = array_merge($ra1, $ra2);
        $found = true;
        while($found == true) {
            $val_before = $val;
            for($i = 0; $i < sizeof($ra); $i++) {
                $pattern = '/';
                for($j = 0; $j < strlen($ra[$i]); $j++) {
                    if($j > 0) {
                        $pattern .= '(';
                        $pattern .= '(&#[xX]0{0,8}([9ab]);)';
                        $pattern .= '|';
                        $pattern .= '|(&#0{0,8}([9|10|13]);)';
                        $pattern .= ')*';
                    }
                    $pattern .= $ra[$i][$j];
                }
                $pattern .= '/i';
                $replacement = substr($ra[$i], 0, 2) . '<x>' . substr($ra[$i], 2);
                $val = preg_replace($pattern, $replacement, $val);
                if($val_before == $val) {
                    $found = false;
                }
            }
        }
        return $val;
    }
    
function sfauthcode($string, $operation = 'DECODE', $key = '', $expiry = 0) {
	$ckey_length = 4;
	$key = md5($key ? $key : ENCRYPT_KEY);
	$keya = md5(substr($key, 0, 16));
	$keyb = md5(substr($key, 16, 16));
	$keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length): substr(md5(microtime()), -$ckey_length)) : '';
	$cryptkey = $keya.md5($keya.$keyc);
	$key_length = strlen($cryptkey);
	$string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0).substr(md5($string.$keyb), 0, 16).$string;
	$string_length = strlen($string);
	$result = '';
	$box = range(0, 255);
	$rndkey = array();
	for($i = 0; $i <= 255; $i++) {
		$rndkey[$i] = ord($cryptkey[$i % $key_length]);
	}
	for($j = $i = 0; $i < 256; $i++) {
		$j = ($j + $box[$i] + $rndkey[$i]) % 256;
		$tmp = $box[$i];
		$box[$i] = $box[$j];
		$box[$j] = $tmp;
	}
	for($a = $j = $i = 0; $i < $string_length; $i++) {
		$a = ($a + 1) % 256;
		$j = ($j + $box[$a]) % 256;
		$tmp = $box[$a];
		$box[$a] = $box[$j];
		$box[$j] = $tmp;
		$result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
	}
	if($operation == 'DECODE') {
		if((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26).$keyb), 0, 16)) {
			return substr($result, 26);
		} else {
			return '';
		}
	} else {
		return $keyc.str_replace('=', '', base64_encode($result));
	}
}
    //用于生成登录token
    function authCode($string, $decode = false, $key = '', $expiry = 0) {
        $cKey_length = 4;
        $key = md5($key ? $key : OZDAO_KEY);
        $keyA = md5(substr($key, 0, 16));
        $keyB = md5(substr($key, 16, 16));
        $keyC = $cKey_length ? ($decode ? substr($string, 0, $cKey_length) : substr(md5(microtime()), -$cKey_length)) : '';
        $cryptKey = $keyA . md5($keyA . $keyC);
        $key_length = strlen($cryptKey);
        $string = $decode ? base64_decode(substr($string, $cKey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0) . substr(md5($string . $keyB), 0, 16) . $string;
        $string_length = strlen($string);
        $result = '';
        $box = range(0, 255);
        $rndKey = [];
        for($i = 0; $i <= 255; $i++) {
            $rndKey[$i] = ord($cryptKey[$i % $key_length]);
        }
        for($j = $i = 0; $i < 256; $i++) {
            $j = ($j + $box[$i] + $rndKey[$i]) % 256;
            $tmp = $box[$i];
            $box[$i] = $box[$j];
            $box[$j] = $tmp;
        }
        for($a = $j = $i = 0; $i < $string_length; $i++) {
            $a = ($a + 1) % 256;
            $j = ($j + $box[$a]) % 256;
            $tmp = $box[$a];
            $box[$a] = $box[$j];
            $box[$j] = $tmp;
            $result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
        }
        if($decode) {
            if((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26) . $keyB), 0, 16)) {
                return substr($result, 26);
            } else {
                return '';
            }
        } else {
            return $keyC . str_replace('=', '', base64_encode($result));
        }
    }
    

    //获取当前访问的real url
    function getRealUrl() {
        static $realUrl = NULL;
        if($realUrl !== NULL) {
            return $realUrl;
        }
        $path = trim(OZDAO_ROOT, '/') . DIRECTORY_SEPARATOR;
        $scriptPath = pathinfo($_SERVER['SCRIPT_NAME'], PATHINFO_DIRNAME);
        $scriptPath = str_replace('\\', '/', $scriptPath);
        $pathElement = explode('/', $scriptPath);
        $thisMatch = '';
        $bestMatch = '';
        $currentDeep = 0;
        $maxDeep = count($pathElement);
        while($currentDeep < $maxDeep) {
            $thisMatch = $thisMatch . $pathElement[$currentDeep] . DIRECTORY_SEPARATOR;
            if(substr($path, strlen($thisMatch) * (-1)) === $thisMatch) {
                $bestMatch = $thisMatch;
            }
            $currentDeep++;
        }
        $bestMatch = str_replace(DIRECTORY_SEPARATOR, '/', $bestMatch);
        $realUrl = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
        $realUrl .= $_SERVER['HTTP_HOST'];
        $realUrl .= $bestMatch;
        return $realUrl;
    }