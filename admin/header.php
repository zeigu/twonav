<?php
    require_once 'function.php';
    //检验登录状态
    if(!ADMIN_LOGIN) {
        header('location:./login.php');
    }
    $DATA = Data::getInstance(true);
    $DAO = $DATA->getDao();
    $countApply = $DATA->getCount(TABLE_APPLY);
?>
<?php
@header('Content-Type: text/html; charset=UTF-8');
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<title><?php echo $CONFIG['name']; ?>-管理后台</title>
	<meta name="keywords" content=""/>
	<meta name="description" content=""/>
	<link rel="stylesheet" href="/assets/libs/layui/css/layui.css"/>
    <link rel="stylesheet" href="/assets/module/admin.css?v=318"/>
    <link rel="shortcut icon" type="images/x-icon" href="../favicon.ico"/>
    <link rel="stylesheet" type="text/css" href="../assets/css/font-awesome-4.7.0/css/font-awesome.css"/>
    <link rel="stylesheet" type="text/css" href="/assets/css/ozui.min.css"/>
    <link rel="stylesheet" type="text/css" href="style/css/main.css"/>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/materialdesignicons.min.css" rel="stylesheet">
    <link href="css/style.min.css" rel="stylesheet">
    <script type="text/javascript" src="/assets/libs/layui/layui.all.js"></script>
    <script src="//lib.baomitu.com/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
   <!-- <link href="//lib.baomitu.com/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="//lib.baomitu.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
    <script src="//lib.baomitu.com/jquery/1.12.4/jquery.min.js"></script>
    <script src="//lib.baomitu.com/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="../assets/layuiadmin/layui/layui.all.js"></script>
	<link href="../assets/css/sweetalert.css" rel="stylesheet" type="text/css">
	<link href="../assets/css/components.css" rel="stylesheet" type="text/css">
	<link href="../assets/css/core.css" rel="stylesheet" type="text/css">-->
</head>
<body>