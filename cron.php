<?php
    /*
     * 定时任务
     */
    require_once('wxpay.php');

    $DAO = $DATA->getDao();
    if(empty($CONFIG['cronKey'])) {
        die(jsonEncode(400, '请先设置好cronKey'));
    }
    if($_GET['key'] != $CONFIG['cronKey']) {
        die(jsonEncode(400, 'cronKey错误'));
    }

    function editPushState($table, $type) {
        global $DAO;
        $DAO->update($table, [
            'push' => 3
        ], 'push=' . $type == 'bearPaw' ? 1 : 2);
        $DAO->update($table, [
            'push' => $type == 'bearPaw' ? 2 : 1
        ], 'push=0');
    }

    $pushBaiduUrls = [];
    $pushBearPawUrls = [];

    $result = $DAO->select(TABLE_SITE, 'id,alias,push', 'push<2');
    while($row = $result->fetch_assoc()) {
        $url = Url::site($row['id'], $row['alias']);
        if($row['push'] == 1) {
            $pushBearPawUrls[] = $url;
        } else {
            $pushBaiduUrls[] = $url;
        }
    }

    $result = $DAO->select(TABLE_POST, 'id,alias,push', 'push<2');
    while($row = $result->fetch_assoc()) {
        $url = Url::post($row['id'], $row['alias']);
        if($row['push'] == 1) {
            $pushBearPawUrls[] = $url;
        } else {
            $pushBaiduUrls[] = $url;
        }
    }

    $baiduToken = $CONFIG['baiduToken'];
    if(empty($baiduToken)) {
        echo jsonEncode(400, '请先设置好百度推送Token');
    } else {
        // $api = 'http://data.zz.baidu.com/urls?site=' . getDomain(OZDAO_URL) . '&token=' . $baiduToken;
        $api = 'http://data.zz.baidu.com/urls?site=' . $bearPawAppId . '&token=' . $baiduToken;
        $result = pushUrls($api, $pushBaiduUrls);
        if($result['success']) {
            editPushState(TABLE_SITE, 'baidu');
            editPushState(TABLE_POST, 'baidu');
            echo jsonEncode(200, '推送成功', $result);
        } else {
            echo jsonEncode($result['error'], $result['message']);
        }
    }

    echo '</br>';

    $bearPawAppId = $CONFIG['bearPawAppId'];
    $bearPawToken = $CONFIG['bearPawToken'];
    if(empty($bearPawAppId) || empty($bearPawToken)) {
        echo jsonEncode(400, '请先设置好熊掌推送AppId和Token');
    } else {
        $api = 'http://data.zz.baidu.com/urls?appid=' . $bearPawAppId . '&token=' . $bearPawToken . '&type=realtime';
        $result = pushUrls($api, $pushBearPawUrls);
        if($result['success_realtime']) {
            editPushState(TABLE_SITE, 'bearPaw');
            editPushState(TABLE_POST, 'bearPaw');
            echo jsonEncode(200, '推送成功', $result);
        } else {
            echo jsonEncode($result['error'], $result['message']);
        }
    }
