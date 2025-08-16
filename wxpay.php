<?php

    /**
     * 初始化
    */
    error_reporting(0);
    ob_start();
    session_start();
    $NEW_VERSION = file_get_contents("/VERSION.txt"); //读取远程版本号;
    define('NEW_VERSION', $NEW_VERSION);//最新版本号
    define('NOW_VERSION', '2.5.5');//当前版本号
    $NEW_UPDATE = file_get_contents("/update.txt"); //读取远程更新时间;
    define('UPDATE_TIME_NEW', $NEW_UPDATE);//最新版本更新时间
    define('UPDATE_TIME_NOW', '2021-10-24');//当前版本更新时间
    //定义系统秘钥
    define('OZDAO_KEY', 'dhcat');
    //定义系统根目录
    define('OZDAO_ROOT', str_replace('\\', '/', dirname(__FILE__)) . '/');
    //引入基础函数库
    require_once OZDAO_ROOT . '360safe/360webscan.php';
    require_once OZDAO_ROOT . '360safe/xss.php';
    require_once OZDAO_ROOT . 'include/function.php';
    require_once OZDAO_ROOT . 'include/authcode.php';

    //网站固定地址
    define('authcode', $authcode); 
    define('OZDAO_URL', getRealUrl());
    //定义表名
    define('TABLE_AD', 'ad');           //广告表名
    define('TABLE_NAV', 'nav');         //导航表名
    define('TABLE_USER', 'user');       //用户表名
    define('TABLE_SORT', 'sort');       //分类表名
    define('TABLE_SITE', 'site');       //站点表名
    define('TABLE_POST', 'post');       //文章表名
    define('TABLE_LINK', 'link');       //友链表名
    define('TABLE_APPLY', 'apply');     //申请表名
    define('TABLE_NOTICE', 'notice');   //公告表名
    define('TABLE_CONFIG', 'config');   //配置表名
    define('TABLE_ORDER', 'order');     //支付表名

    //引入数据库配置
    if(is_file(OZDAO_ROOT . 'config.php')) {
        require_once OZDAO_ROOT . 'config.php';
    } else {
        gotoInstall();
    }
    //校验必要的数据库信息常量
    !checkConstants(['DB_USER', 'DB_PASS', 'DB_NAME', 'DB_PREFIX']) && gotoInstall();
    //创建数据池实例
    $DATA = Data::getInstance();
    //获取全局设置
    $CONFIG = $DATA->getConfig();
    //检测是否存在网站配置数据表，不存在则跳转安装
    !$CONFIG && gotoInstall();

    //模板名称
    define('TEMPLATE_NAME', !empty($_GET['template']) ? $_GET['template'] : (isset($CONFIG['template']) ? $CONFIG['template'] : 'default'));
    //模板库路径
    define('TL_PATH', OZDAO_ROOT . 'templates/');
    //模板库地址
    define('TL_URL', OZDAO_URL . 'templates/');
    //模板路径
    define('TEMPLATE_PATH', TL_PATH . TEMPLATE_NAME . '/');
    //模板地址
    define('TEMPLATE_URL', TL_URL . TEMPLATE_NAME . '/');
    //图片路径
    define('IMAGES_PATH', OZDAO_ROOT . 'assets/images/');
    //图片地址
    define('IMAGES_URL', OZDAO_URL . 'assets/images/');
    //验证用户是否登录
    $USER = $DATA->verifyToken();
    define('USER_LOGIN', $USER && $USER['state'] == 1 && $USER['role'] != 1);
    define('ADMIN_LOGIN', $USER && $USER['state'] == 1 && $USER['role'] == 1);