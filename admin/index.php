<?php 
require_once 'header.php';
$countUser = $DATA->getCount(TABLE_USER);
$countNotice = $DATA->getCount(TABLE_NOTICE);
$countLink = $DATA->getCount(TABLE_LINK);
$countAd = $DATA->getCount(TABLE_AD);
$countPost = $DATA->getCount(TABLE_POST);
?>
<!DOCTYPE html>
<html lang="zh">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
<title><?php echo $CONFIG['name']; ?> - 后台管理</title>
<link rel="icon" href="favicon.ico" type="image/ico">
<meta name="keywords" content="">
<meta name="description" content="">
<meta name="author" content="dhcat">
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/materialdesignicons.min.css" rel="stylesheet">
<link rel="stylesheet" href="js/bootstrap-multitabs/multitabs.min.css">
<link href="css/style.min.css" rel="stylesheet">
</head>
  
<body>
<div class="lyear-layout-web">
  <div class="lyear-layout-container">
    <!--左侧导航-->
    <aside class="lyear-layout-sidebar">
      
      <!-- logo -->
      <div id="logo" class="sidebar-header">
        <a href="./"><img src="images/logo-sidebar.png" title="DHCAT" alt="DHCAT" /></a>
      </div>
      <div class="lyear-layout-sidebar-scroll"> 
        
        <nav class="sidebar-main">
          <ul class="nav nav-drawer">
            <li class="nav-item nav-item-has-subnav">
              <a href="javascript:void(0)"><i class="layui-icon layui-icon-set"></i> <span>系统管理</span></a>
              <ul class="nav nav-subnav">
                <li> <a class="multitabs" href="config.php">网站设置</a> </li>
                <li> <a class="multitabs" href="email.php">邮箱设置</a> </li>
                <li> <a class="multitabs" href="nav.php">系统导航</a> </li>
                <li> <a class="multitabs" href="image.php">图片上传</a> </li>
                <li> <a class="multitabs" href="push.php">链接推送</a> </li>
                <li> <a class="multitabs" href="clear.php">垃圾清除</a> </li>
              </ul>
            </li>
            <li class="nav-item nav-item-has-subnav">
              <a href="javascript:void(0)"><i class="mdi mdi-file-outline"></i> <span>文章管理</span></a>
              <ul class="nav nav-subnav">
                <li> <a class="multitabs" href="sort.php?type=2">文章分类</a> </li>
                <li> <a class="multitabs" href="post.php">文章列表</a> </li>
                <li> <a class="multitabs" href="post.php?act=add">发布文章</a> </li>
              </ul>
            </li>
            <li class="nav-item nav-item-has-subnav">
              <a href="javascript:void(0)"><i class="layui-icon layui-icon-find-fill"></i> <span>站点管理</span></a>
              <ul class="nav nav-subnav">
                <li> <a class="multitabs" href="sort.php?type=1">站点分类</a> </li>
                <li> <a class="multitabs" href="site.php">站点列表</a> </li>
                <li> <a class="multitabs" href="apply.php">待审站点</a> </li>
              </ul>
            </li>
            <li class="nav-item nav-item-has-subnav">
              <a href="javascript:void(0)"><i class="layui-icon layui-icon-survey"></i> <span>单页管理</span></a>
              <ul class="nav nav-subnav">
                <li> <a class="multitabs" href="page.php">单页列表</a> </li>
                <li> <a class="multitabs" href="page.php?act=add">发布单页</a> </li>
              </ul>
            </li>
            <li class="nav-item nav-item-has-subnav">
              <a href="javascript:void(0)"><i class="console-app-icon layui-icon layui-icon-cart"></i> <span>支付管理</span></a>
              <ul class="nav nav-subnav">
                <li> <a class="multitabs" href="pay.php">支付接口</a> </li>
                <li> <a class="multitabs" href="money.php">价格设置</a> </li>
                <li> <a class="multitabs" href="pay3.php">支付方式</a> </li>
                <li> <a class="multitabs" href="playlist.php">订单列表</a> </li>
              </ul>
            </li>            
            <li class="nav-item nav-item-has-subnav">
              <a href="javascript:void(0)"><i class="layui-icon layui-icon-template-1"></i> <span>拓展管理</span></a>
              <ul class="nav nav-subnav">
                <li> <a class="multitabs" href="ad.php">图片广告</a> </li>
                <li> <a class="multitabs" href="add.php">其他广告</a> </li>
                <li> <a class="multitabs" href="link.php">友链管理</a> </li>
                <li> <a class="multitabs" href="notice.php">公告管理</a> </li>
                <li> <a class="multitabs" href="user.php">用户管理</a> </li>
                <li> <a class="multitabs" href="template.php">模板管理</a> </li>
              </ul>
            </li>    
          </ul>
        </nav>
        
        <div class="sidebar-footer">
          <p class="copyright">Copyright &copy; 2021. <a target="_blank" href="http://dhceo.net">总裁</a> All rights reserved.</p>
        </div>
      </div>
      
    </aside>
    <!--End 左侧导航-->
    
    <!--头部信息-->
    <header class="lyear-layout-header">
      
      <nav class="navbar navbar-default">
        <div class="topbar">
          
          <div class="topbar-left">
            <div class="lyear-aside-toggler">
              <span class="lyear-toggler-bar"></span>
              <span class="lyear-toggler-bar"></span>
              <span class="lyear-toggler-bar"></span>
            </div>
            <li style="margin-left:8px;margin-right:15px">
         <a href="/" target="_blank" title="前台">
          <i class="layui-icon layui-icon-website" style="font-size: 22px;" ></i>
        </a>               
            </li>
            
             <li class="">
         <a onclick="javascript:f5();return false;"  title="刷新"> 
          <i class="layui-icon layui-icon-refresh-3" style="font-size: 22px;"></i>
        </a>              
            </li>           
            
          </div>
          
          <ul class="topbar-right">
            <li class="dropdown dropdown-profile">
              <a href="javascript:void(0)" data-toggle="dropdown">
                <img class="img-avatar img-avatar-48 m-r-10" src="https://q2.qlogo.cn/headimg_dl?dst_uin=<?php echo $USER['qq']; ?>&spec=100" alt="DHCAT" />
                <span><?php echo $USER['username']; ?> <span class="caret"></span></span>
              </a>
              <ul class="dropdown-menu dropdown-menu-right">
                <li> <a class="multitabs" data-url="待添加页面" href="javascript:void(0)"><i class="mdi mdi-account"></i> 个人信息</a> </li>
                <li> <a class="multitabs" data-url="待添加页面" href="javascript:void(0)"><i class="mdi mdi-lock-outline"></i> 修改密码</a> </li>

                <li class="divider"></li>
                <li> <a onclick="javascript:logout()"><i class="mdi mdi-logout-variant"></i> 退出登录</a> </li>
              </ul>
            </li>
            <!--切换主题配色-->
		    <li class="dropdown dropdown-skin">
			  <span data-toggle="dropdown" class="icon-palette"><i class="mdi mdi-palette"></i></span>
			  <ul class="dropdown-menu dropdown-menu-right" data-stopPropagation="true">
			    <li class="drop-title"><p>LOGO</p></li>
				<li class="drop-skin-li clearfix">
                  <span class="inverse">
                    <input type="radio" name="logo_bg" value="default" id="logo_bg_1" checked>
                    <label for="logo_bg_1"></label>
                  </span>
                  <span>
                    <input type="radio" name="logo_bg" value="color_2" id="logo_bg_2">
                    <label for="logo_bg_2"></label>
                  </span>
                  <span>
                    <input type="radio" name="logo_bg" value="color_3" id="logo_bg_3">
                    <label for="logo_bg_3"></label>
                  </span>
                  <span>
                    <input type="radio" name="logo_bg" value="color_4" id="logo_bg_4">
                    <label for="logo_bg_4"></label>
                  </span>
                  <span>
                    <input type="radio" name="logo_bg" value="color_5" id="logo_bg_5">
                    <label for="logo_bg_5"></label>
                  </span>
                  <span>
                    <input type="radio" name="logo_bg" value="color_6" id="logo_bg_6">
                    <label for="logo_bg_6"></label>
                  </span>
                  <span>
                    <input type="radio" name="logo_bg" value="color_7" id="logo_bg_7">
                    <label for="logo_bg_7"></label>
                  </span>
                  <span>
                    <input type="radio" name="logo_bg" value="color_8" id="logo_bg_8">
                    <label for="logo_bg_8"></label>
                  </span>
				</li>
				<li class="drop-title"><p>头部</p></li>
				<li class="drop-skin-li clearfix">
                  <span class="inverse">
                    <input type="radio" name="header_bg" value="default" id="header_bg_1" checked>
                    <label for="header_bg_1"></label>                      
                  </span>                                                    
                  <span>                                                     
                    <input type="radio" name="header_bg" value="color_2" id="header_bg_2">
                    <label for="header_bg_2"></label>                      
                  </span>                                                    
                  <span>                                                     
                    <input type="radio" name="header_bg" value="color_3" id="header_bg_3">
                    <label for="header_bg_3"></label>
                  </span>
                  <span>
                    <input type="radio" name="header_bg" value="color_4" id="header_bg_4">
                    <label for="header_bg_4"></label>                      
                  </span>                                                    
                  <span>                                                     
                    <input type="radio" name="header_bg" value="color_5" id="header_bg_5">
                    <label for="header_bg_5"></label>                      
                  </span>                                                    
                  <span>                                                     
                    <input type="radio" name="header_bg" value="color_6" id="header_bg_6">
                    <label for="header_bg_6"></label>                      
                  </span>                                                    
                  <span>                                                     
                    <input type="radio" name="header_bg" value="color_7" id="header_bg_7">
                    <label for="header_bg_7"></label>
                  </span>
                  <span>
                    <input type="radio" name="header_bg" value="color_8" id="header_bg_8">
                    <label for="header_bg_8"></label>
                  </span>
				</li>
				<li class="drop-title"><p>侧边栏</p></li>
				<li class="drop-skin-li clearfix">
                  <span class="inverse">
                    <input type="radio" name="sidebar_bg" value="default" id="sidebar_bg_1" checked>
                    <label for="sidebar_bg_1"></label>
                  </span>
                  <span>
                    <input type="radio" name="sidebar_bg" value="color_2" id="sidebar_bg_2">
                    <label for="sidebar_bg_2"></label>
                  </span>
                  <span>
                    <input type="radio" name="sidebar_bg" value="color_3" id="sidebar_bg_3">
                    <label for="sidebar_bg_3"></label>
                  </span>
                  <span>
                    <input type="radio" name="sidebar_bg" value="color_4" id="sidebar_bg_4">
                    <label for="sidebar_bg_4"></label>
                  </span>
                  <span>
                    <input type="radio" name="sidebar_bg" value="color_5" id="sidebar_bg_5">
                    <label for="sidebar_bg_5"></label>
                  </span>
                  <span>
                    <input type="radio" name="sidebar_bg" value="color_6" id="sidebar_bg_6">
                    <label for="sidebar_bg_6"></label>
                  </span>
                  <span>
                    <input type="radio" name="sidebar_bg" value="color_7" id="sidebar_bg_7">
                    <label for="sidebar_bg_7"></label>
                  </span>
                  <span>
                    <input type="radio" name="sidebar_bg" value="color_8" id="sidebar_bg_8">
                    <label for="sidebar_bg_8"></label>
                  </span>
				</li>
			  </ul>
			</li>
            <!--切换主题配色-->
          </ul>
          
        </div>
      </nav>
      
    </header>
    <!--End 头部信息-->
    
    <!--页面主要内容-->
    <main class="lyear-layout-content">
      
      <div id="iframe-content"></div>
      
    </main>
    <!--End 页面主要内容-->
  </div>
</div>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="js/bootstrap-multitabs/multitabs.js"></script>
<script type="text/javascript" src="js/index.min.js"></script>
<script type="text/javascript" src="js/main.min.js"></script>
</body>
</html>