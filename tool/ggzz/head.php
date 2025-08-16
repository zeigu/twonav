<?php include('./jason.php'); ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title><?php echo $网站名称; ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta name="keywords" content="<?php echo $关键词汇; ?>">
  <meta name="description" content="<?php echo $名称后辍; ?>">
  <link rel="stylesheet" href="./layui/css/layui.css">
  <link rel="stylesheet" href="./layui/css/global.css">
  <script src="./layui/jquery.min.js"></script>
  <script src="./layui/layui.js"></script>
</head>
<body>
<div class="fly-header layui-bg-black">
  <div class="layui-container">
    <a class="fly-logo" href="/">
      <img src="http://dhceo.com/assets/images/logo.png" alt="logo" style="width: 120px;height: 40px;">
    </a>
    
    <ul class="layui-nav fly-nav-user">
      <li class="layui-nav-item">
        <a href="/tools.html">更多在线工具</a>
      </li>
    </ul>
  </div>
</div>
<style>
	* {
		margin: 0;
		padding: 0;
	}
	.w {
		width: 1200px;
		margin: 0px auto;
	}
	.nav_menu {
		display: flex;
		justify-content: space-around;
		align-items: center;
		height: 50px;
		/* background-color: #4caf50; */
		/* border: 1px solid #ccc; */
		padding: 10px;
		color: #fff;
		
	}
	.menu_item {
		position: relative;
		flex: 1;
		height: 100%;
		line-height: 50px;
		text-align: center;
		transform-style: preserve-3d;
		transition: all 0.5s;
		/* margin: 0 5px; */
	}
	.menu_item:hover {
		cursor: pointer;
		transform: rotateX(90deg);
	}
	.home, .web_home {
		position: absolute;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		perspective: 300px;
	}
	.home {
		background-color: #4caf50;
		z-index: 11;
		transform: translateZ(25px);
	}
	.web_home {
		background-color: #009688;
		transform: translateY(25px) rotateX(-90deg);
	}
</style>

</head>
<body>

<div class="nav_menu w">
	<div class="menu_item">
		<div class="home">总裁导航</div>
		<div class="web_home"><a href="http://dhceo.com" target="_blank">总裁导航</a></div>
	</div>
	<div class="menu_item">
		<div class="home">在线工具</div>
		<div class="web_home"><a href="http://dhceo.com/tools.html" target="_blank">在线工具</a></div>
	</div>
	<div class="menu_item">
		<div class="home">文章资讯</div>
		<div class="web_home"><a href="http://dhceo.com" target="_blank">文章资讯</a></div>
	</div>
	<div class="menu_item">
		<div class="home">广告合作</div>
		<div class="web_home"><a href="http://dhceo.com" target="_blank">广告合作</a></div>
	</div>
	<div class="menu_item">
		<div class="home">联系我们</div>
		<div class="web_home"><a href="https://wpa.qq.com/msgrd?v=3&uin=3092059473&site=qq&menu=yes/" target="_blank">联系我们</a></div>
	</div>
	<div class="menu_item">
		<div class="home">总裁精选</div>
		<div class="web_home"><a href="http://dhceo.com" target="_blank">总裁精选</a></div>
	</div>
</div>
<div class="fly-panel fly-column">
  <div class="layui-container">
	<i class="layui-icon layui-icon-speaker" style="font-size: 15px; color: #F00;"></i> <?php echo $gg; ?>
  </div>
</div>