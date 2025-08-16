<?php
    require_once '../wxpay.php';
    //前台api
    header('Content-type:application/json; charset=utf-8');
    //判断是否有来路或者来路是否为本站
    if(isOtherReferer()) {
        returnJson(400, '非法来路');
    }
    session_start();
    $request = [];
    //转义POST数据
    foreach($_POST as $key => $value) {
        $request[$key] = myAddSlashes(removeXSS($value));
    }
    list($type, $method) = explode('_', strtolower($_GET['act']));
    $DATA = Data::getInstance();
    $DAO = $DATA->getDao();

    switch($type) {
        //站点管理
        case TABLE_SITE:
            switch($method) {
                //浏览站点
                case 'view':
                    $id = intval($request['id']);
                    if(!is_numeric($id)) {
                        returnJson(400, '站点ID无效');
                    }
                    $lastDate = $DATA->getByKey(TABLE_SITE, 'lastDate', 'id', $id);
                    $nowDate = date('Y-m-d');
                    $lastArr = explode('-', $lastDate);
                    $nowArr = explode('-', $nowDate);
                    $viewNum = is_numeric($CONFIG['viewNum']) ? $CONFIG['viewNum'] : 1;
                    $fields = [
                        'totalViews' => 'totalViews+' . $viewNum,
                        'lastDate' => $lastDate
                    ];
                    if($lastArr[0] == $nowArr[0] && $lastArr[1] == $nowArr[1]) {
                        if($lastArr[2] == $nowArr[2]) {
                            $fields['dayViews'] = 'dayViews+' . $viewNum;
                            $fields['monthViews'] = 'monthViews+' . $viewNum;
                        } else {
                            $fields['dayViews'] = 1;
                            $fields['monthViews'] = 'monthViews+' . $viewNum;
                        }
                    } else {
                        $fields['dayViews'] = 1;
                        $fields['monthViews'] = 1;
                    }
                    $DAO->updateById(TABLE_SITE, $id, $fields);
                    break;
                //点赞站点
                case 'love':
                    $id = intval($request['id']);
                    if(!is_numeric($id)) {
                        returnJson(400, '站点ID无效');
                    }
                    if($_SESSION['love' . $id]) {
                        returnJson(400, '您已赞过');
                    }
                    $_SESSION['love' . $id] = true;
                    $result = $DAO->updateById(TABLE_SITE, $id, [
                        'love' => 'love+1'
                    ], false);
                    if($result) {
                        $love = $DATA->getByKey(TABLE_SITE, 'love', 'id', $id);
                        returnJson(200, '点赞成功', ['love' => $love]);
                    }
                    returnJson(500, '站点不存在或系统错误');
                    break;
                //获取站点信息
                case 'info':
                    $url = $request['url'];
                    $result = getSiteInfo($url);
                    if($result) {
                        $result['ico'] = 'https://favicon.cccyun.cc/' . $url;
                        returnJson(200, '获取成功', $result);
                    }
                    returnJson(500, '获取失败，请检查链接或接口失效');
                    break;
                //更新站点信息
                case 'update':
                    $id = intval($request['id']);
                    $url = $request['url'];
                    if(!is_numeric($id)) {
                        returnJson(400, '站点ID无效');
                    }
                    $url = empty($url) ? $DATA->getSiteUrlById($id) : $url;
                    if(empty($url)) {
                        returnJson(400, '站点不存在');
                    }
                    $info = getSiteInfo($url);
                    $CONFIG['saveIco'] == '1' && saveIco($url);
                    $result = $DAO->updateById(TABLE_SITE, $id, [
                        'icp' => $info['icp'],
                        'title' => $info['title'],
                        'keywords' => $info['keywords'],
                        'description' => $info['description'],
                    ]);
                    if($result) {
                        returnJson(200, '更新成功');
                    }
                    returnJson(500, '站点不存在或系统错误');
                    break;
                default:
                    returnJson(400, '无效方法');
            }
            break;
        //申请管理
        case TABLE_APPLY:
            switch($method) {
                //申请收录
                case 'add':
                    if($CONFIG['apply'] != 1) {
                        returnJson(500, '本站已关闭申请收录权限');
                    }
                    if(strtolower($request['captcha']) != strtolower($_SESSION['captcha'])) {
                        returnJson(400, '验证码错误');
                    }
                    $name = $request['name'];
                    $sortId = $request['sortId'];
                    $qq = $request['qq'];
                    $domain = rtrim($request['domain'], '/');
                    $url = addProtocol($domain, $request['protocol']);
                    if(!$name || !$sortId || !$domain) {
                        returnJson(400, '名称、分类、域名缺一不可');
                    }
                    if($DATA->isSiteUrlRepeat($url)) {
                        returnJson(400, '该站点已存在');
                    }
                    if($DATA->isApplyUrlRepeat($url)) {
                        returnJson(400, '该站点已提交过申请');
                    }
                    if($CONFIG['autoPass'] == 1 && checkExternalLink($url)) {
                        $result = $DAO->insertOne(TABLE_SITE, [
                            'name' => $request['name'],
                            'sortId' => $request['sortId'],
                            'qq' => $request['qq'],
                            'url' => $url,
                            'time' => time()
                        ]);
                        $tip = '，检测到贵站有本站友链，审核通过！';
                    } else {
                        $result = $DAO->insertOne(TABLE_APPLY, [
                            'name' => $request['name'],
                            'sortId' => $request['sortId'],
                            'qq' => $request['qq'],
                            'url' => $url,
                            'time' => time()
                        ]);
                        $tip = '，请添加本站友链，等待审核！';
                    }
                    if($result) {
                        $CONFIG['emailNotice'] == '1' && sendEmail([
                            'host' => $CONFIG['smtpHost'],
                            'port' => $CONFIG['smtpPort'],
                            'username' => $CONFIG['smtpUsername'],
                            'password' => $CONFIG['smtpPassword']
                        ], [
                            'name' => $CONFIG['name'],
                            'email' => $CONFIG['smtpUsername']
                        ], [
                            'email' => $CONFIG['smtpUsername']
                        ], [
                            'subject' => '「站点申请」' . $CONFIG['name'],
                            'body' => '<p>收到站点申请，请登录管理后台查看详情</p><p>站点链接：<a href="' . $url . '" target="_blank">' . $url . '</a></p><p>申请者QQ：<a href="http://wpa.qq.com/msgrd?v=3&uin=' . $qq . '&site=qq&menu=yes" target="_blank">' . $qq . '</a></p><p>总裁免费收录中-dh.peakmzf.cn 欢迎提交</p>'
                        ]);
                        returnJson(200, '申请成功' . $tip);
                    }
                    returnJson(400, '申请失败，请联系站长');
                    break;
                default:
                    returnJson(400, '无效方法');
            }
            break;
        default:
            returnJson(400, '无效请求');
    }

