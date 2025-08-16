<?php 
require_once 'header.php';
$countUser = $DATA->getCount(TABLE_USER);
$countNotice = $DATA->getCount(TABLE_NOTICE);
$countLink = $DATA->getCount(TABLE_LINK);
$countAd = $DATA->getCount(TABLE_AD);
$countNav = $DATA->getCount(TABLE_NAV);
$countPost = $DATA->getCount(TABLE_POST);
    if(!empty($keyword)) {
        $sites = $DATA->getSitesByKeyword($keyword, $pageSize, $startNum);
        $countSite = count($DATA->getSitesByKeyword($keyword));
    } elseif(!empty($sortId)) {
        $sites = $DATA->getSitesBySortId($sortId, $pageSize, $startNum);
        $countSite = $DATA->getCount(TABLE_SITE, 'sortId=' . $sortId);
    } else {
        $sites = $DATA->getSites($pageSize, $startNum);
        $countSite = $DATA->getCount(TABLE_SITE);
    }
    $sorts = $DATA->getSiteSorts();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <link rel="stylesheet" href="./layuiadmin/layui/css/layui.css" media="all">
  <link rel="stylesheet" href="./layuiadmin/style/admin.css" media="all">
   <style>
        /** 应用快捷块样式 */
        .console-app-group {
            padding: 16px;
            border-radius: 4px;
            text-align: center;
            background-color: #fff;
            cursor: pointer;
            display: block;
        }

        .console-app-group .console-app-icon {
            width: 32px;
            height: 32px;
            line-height: 32px;
            margin-bottom: 6px;
            display: inline-block;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            font-size: 32px;
            color: #69c0ff;
        }

        .console-app-group:hover {
            box-shadow: 0 0 15px rgba(0, 0, 0, .08);
        }

        /** //应用快捷块样式 */

        /** 小组成员 */
        .console-user-group {
            position: relative;
            padding: 10px 0 10px 60px;
        }

        .console-user-group .console-user-group-head {
            width: 32px;
            height: 32px;
            position: absolute;
            top: 50%;
            left: 12px;
            margin-top: -16px;
            border-radius: 50%;
        }

        .console-user-group .layui-badge {
            position: absolute;
            top: 50%;
            right: 8px;
            margin-top: -10px;
        }

        .console-user-group .console-user-group-name {
            line-height: 1.2;
        }

        .console-user-group .console-user-group-desc {
            color: #8c8c8c;
            line-height: 1;
            font-size: 12px;
            margin-top: 5px;
        }

        /** 卡片轮播图样式 */
        .admin-carousel .layui-carousel-ind {
            position: absolute;
            top: -41px;
            text-align: right;
        }

        .admin-carousel .layui-carousel-ind ul {
            background: 0 0;
        }

        .admin-carousel .layui-carousel-ind li {
            background-color: #e2e2e2;
        }

        .admin-carousel .layui-carousel-ind li.layui-this {
            background-color: #999;
        }

        /** 广告位轮播图 */
        .admin-news .layui-carousel-ind {
            height: 45px;
        }

        .admin-news a {
            display: block;
            line-height: 70px;
            text-align: center;
        }

        /** 最新动态时间线 */
        .layui-timeline-dynamic .layui-timeline-item {
            padding-bottom: 0;
        }

        .layui-timeline-dynamic .layui-timeline-item:before {
            top: 16px;
        }

        .layui-timeline-dynamic .layui-timeline-axis {
            width: 9px;
            height: 9px;
            left: 1px;
            top: 7px;
            background-color: #cbd0db;
        }

        .layui-timeline-dynamic .layui-timeline-axis.active {
            background-color: #0c64eb;
            box-shadow: 0 0 0 2px rgba(12, 100, 235, .3);
        }

        .dynamic-card-body {
            box-sizing: border-box;
            overflow: hidden;
        }

        .dynamic-card-body:hover {
            overflow-y: auto;
            padding-right: 9px;
        }

        /** 优先级徽章 */
        .layui-badge-priority {
            border-radius: 50%;
            width: 20px;
            height: 20px;
            padding: 0;
            line-height: 18px;
            border-width: 2px;
            font-weight: 600;
        }
    </style>
</head>
<body>
<!-- 正文开始 -->
<div class="layui-fluid">
    <div class="layui-card">
        <div class="layui-card-body">
            <!-- 表格工具栏 -->
      管理员
      <a href="user.php" ><?php echo $USER['username']; ?></a> 登录成功，尽情管理您的网站吧！
               </div>
              </div>
            </div>
          </div>
        </div>

    <div class="layui-fluid">
    <div class="layui-row layui-col-space15">
      <div class="layui-col-md8 layui-col-sm6">
        <div class="layui-row layui-col-space15">
          <div class="layui-col-md6">
            <div class="layui-card">
              <div class="layui-card-header">快捷方式</div>
              <div class="layui-card-body">
                
                <div class="layui-carousel layadmin-carousel layadmin-shortcut">
                  <div carousel-item>
                    <ul class="layui-row layui-col-space10">
                      <!--li class="layui-col-xs3">
                        <a href="add.php">
                          <i class="layui-icon layui-icon-console"></i>
                          <cite>云端广告</cite>
                        </a>
                      </li-->
                        <li class="layui-col-xs3">
                        <a href="config.php">
                          <i class="layui-icon layui-icon-set"></i>
                          <cite>网站设置</cite>
                        </a>
                      </li>
                       <li class="layui-col-xs3">
                        <a href="template.php">
                          <i class="console-app-icon layui-icon layui-icon-slider"></i>
                          <cite>模板设置</cite>
                        </a>
                      </li>
                      <li class="layui-col-xs3">
                        <a href="pay.php">
                          <i class="console-app-icon layui-icon layui-icon-cart"></i>
                          <cite>支付管理</cite>
                        </a>
                      </li>
                      <li class="layui-col-xs3">
                        <a href="sort.php?type=1">
                          <i class="layui-icon layui-icon-template-1"></i>
                          <cite>站点分类</cite>
                        </a>
                      </li>
                      <li class="layui-col-xs3">
                        <a href="push.php">
                          <i class="layui-icon layui-icon-chat"></i>
                          <cite>链接推送</cite>
                        </a>
                      </li>
                      <li class="layui-col-xs3">
                        <a href="image.php">
                          <i class="layui-icon layui-icon-find-fill"></i>
                          <cite>图片上传</cite>
                        </a>
                      </li>
                      <li class="layui-col-xs3">
                        <a href="email.php">
                          <i class="layui-icon layui-icon-survey"></i>
                          <cite>邮箱管理</cite>
                        </a>
                      </li>
                      <li class="layui-col-xs3">
                        <a href="user.php">
                          <i class="console-app-icon layui-icon layui-icon-group"></i>
                          <cite>用户列表</cite>
                        </a>
                      </li>
                    </ul>
                    <ul class="layui-row layui-col-space10">
                      <li class="layui-col-xs3">
                        <a lay-href="set/user/info.html">
                          <i class="layui-icon layui-icon-set"></i>
                          <cite>我的资料</cite>
                        </a>
                      </li>
                      <li class="layui-col-xs3">
                        <a lay-href="set/user/info.html">
                          <i class="layui-icon layui-icon-set"></i>
                          <cite>我的资料</cite>
                        </a>
                      </li>
                      <li class="layui-col-xs3">
                        <a lay-href="set/user/info.html">
                          <i class="layui-icon layui-icon-set"></i>
                          <cite>我的资料</cite>
                        </a>
                      </li>
                      <li class="layui-col-xs3">
                        <a lay-href="set/user/info.html">
                          <i class="layui-icon layui-icon-set"></i>
                          <cite>我的资料</cite>
                        </a>
                      </li>
                      <li class="layui-col-xs3">
                        <a lay-href="set/user/info.html">
                          <i class="layui-icon layui-icon-set"></i>
                          <cite>我的资料</cite>
                        </a>
                      </li>
                      <li class="layui-col-xs3">
                        <a lay-href="set/user/info.html">
                          <i class="layui-icon layui-icon-set"></i>
                          <cite>我的资料</cite>
                        </a>
                      </li>
                      <li class="layui-col-xs3">
                        <a lay-href="set/user/info.html">
                          <i class="layui-icon layui-icon-set"></i>
                          <cite>我的资料</cite>
                        </a>
                      </li>
                      <li class="layui-col-xs3">
                        <a lay-href="set/user/info.html">
                          <i class="layui-icon layui-icon-set"></i>
                          <cite>我的资料</cite>
                        </a>
                      </li>
                    </ul>
                    
                  </div>
                </div>
                
              </div>
            </div>
          </div>
         <div class="layui-col-md6">
          <div class="layui-card">
            <div class="layui-card-header">网站数据</div>
            <div class="layui-card-body">

              <div class="layui-carousel layadmin-carousel layadmin-backlog">
                <div carousel-item>
                  <ul class="layui-row layui-col-space10">
                    <li class="layui-col-xs6">
                      <a href="site.php" class="layadmin-backlog-body">
                        <h3>站点统计</h3>
                        <p><cite><?php echo $countSite; ?></cite></p>
                      </a>
                    </li>
                    <li class="layui-col-xs6">
                      <a href="apply.php" class="layadmin-backlog-body">
                        <h3>待审站点</h3>
                        <p><cite><?php echo $countApply; ?></cite></p>
                      </a>
                    </li>
                    <li class="layui-col-xs6">
                      <a href="link.php" class="layadmin-backlog-body">
                        <h3>友情链接</h3>
                        <p><cite><?php echo $countLink; ?></cite></p>
                      </a>
                    </li>
                    <li class="layui-col-xs6">
                      <a href="ad.php" class="layadmin-backlog-body">
                        <h3>累计广告</h3>
                        <p><cite><?php echo $countAd; ?></cite></p>
                      </a>
                    </li>
                  </ul>
                  <ul class="layui-row layui-col-space10">
                    <li class="layui-col-xs6">
                      <a href="nav.php" class="layadmin-backlog-body">
                        <h3>系统导航</h3>
                        <p><cite><?php echo $countNav; ?></cite></p>
                      </a>
                    </li>
                    <li class="layui-col-xs6">
                      <a href="notice.php" class="layadmin-backlog-body">
                        <h3>网站公告</h3>
                        <p><cite><?php echo $countNotice; ?></cite></p>
                      </a>
                    </li>
                    <li class="layui-col-xs6">
                      <a href="link.php" class="layadmin-backlog-body">
                        <h3>友情链接</h3>
                        <p><cite><?php echo $countLink; ?></cite></p>
                      </a>
                    </li>
                    <li class="layui-col-xs6">
                      <a href="post.php" class="layadmin-backlog-body">
                        <h3>撰写文章</h3>
                        <p><cite><?php echo $countPost; ?></cite></p>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>

                <div class="layui-col-md12">
                    <div class="layui-card">
                        <div class="layui-card-header">项目开发进度</div>
                        <div class="layui-card-body">
                            <table class="layui-table" lay-skin="line">
                                <colgroup>
                                    <col width="40"/>
                                    <col/>
                                    <col/>
                                    <col/>
                                    <col/>
                                    <col width="160"/>
                                </colgroup>
                                <thead>
                                <tr>
                                    <td></td>
                                    <td>项目名称</td>
                                    <td align="center">开始时间</td>
                                    <td align="center">截至时间</td>
                                    <td align="center">状态</td>
                                    <td align="center">进度</td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td><span class="layui-text"><a>总裁系统最新重构版V4.1.5</a></span></td>
                                    <td align="center">2021-09-01</td>
                                    <td align="center">2025-01-01</td>
                                    <td align="center"><span class="text-success">已完成</span></td>
                                    <td>
                                        <div class="layui-progress" lay-showPercent="yes">
                                            <div class="layui-progress-bar" lay-percent="100%"></div>
                                        </div>
                                    </td>
                                </tr>
                                 <tr>
                                    <td>2</td>
                                    <td><span class="layui-text"><a>总裁系统V2.5.5</a></span></td>
                                    <td align="center">2021-09-01</td>
                                    <td align="center">2021-10-24</td>
                                    <td align="center"><span class="text-success">已完成</span></td>
                                    <td>
                                        <div class="layui-progress" lay-showPercent="yes">
                                            <div class="layui-progress-bar" lay-percent="100%"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td><span class="layui-text"><a>总裁系统V2.5.0</a></span></td>
                                    <td align="center">2021-07-01</td>
                                    <td align="center">2021-09-01</td>
                                    <td align="center"><span class="text-success">已完成</span></td>
                                    <td>
                                        <div class="layui-progress" lay-showPercent="yes">
                                            <div class="layui-progress-bar" lay-percent="100%"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td><span class="layui-text"><a>总裁系统V2.4.5</a></span></td>
                                    <td align="center">2021-06-01</td>
                                    <td align="center">2021-07-01</td>
                                    <td align="center"><span class="text-success">已完成</span></td>
                                    <td>
                                        <div class="layui-progress" lay-showPercent="yes">
                                            <div class="layui-progress-bar" lay-percent="100%"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td><span class="layui-text"><a>总裁系统V1.9</a></span></td>
                                    <td align="center">2021-05-01</td>
                                    <td align="center">2021-06-01</td>
                                    <td align="center"><span class="text-success">已完成</span></td>
                                    <td>
                                        <div class="layui-progress" lay-showPercent="yes">
                                            <div class="layui-progress-bar" lay-percent="100%"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td><span class="layui-text"><a>总裁系统V1.7</a></span></td>
                                    <td align="center">2021-04-01</td>
                                    <td align="center">2021-05-01</td>
                                    <td align="center"><span class="text-success">已完成</span></td>
                                    <td>
                                        <div class="layui-progress" lay-showPercent="yes">
                                            <div class="layui-progress-bar" lay-percent="100%"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>7</td>
                                    <td><span class="layui-text"><a>总裁系统V1.5</a></span></td>
                                    <td align="center">2021-03-01</td>
                                    <td align="center">2021-04-01</td>
                                    <td align="center"><span class="text-success">已完成</span></td>
                                    <td>
                                        <div class="layui-progress" lay-showPercent="yes">
                                            <div class="layui-progress-bar" lay-percent="100%"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>8</td>
                                    <td><span class="layui-text"><a>总裁系统V1.0</a></span></td>
                                    <td align="center">2021-01-01</td>
                                    <td align="center">2021-03-01</td>
                                    <td align="center"><span class="text-success">已完成</span></td>
                                    <td>
                                        <div class="layui-progress" lay-showPercent="yes">
                                            <div class="layui-progress-bar" lay-percent="100%"></div>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	<div class="layui-col-md4 layui-col-sm6">
 <div class="layui-card">
                <div class="layui-card-header">开发成员</div>
                <div class="layui-card-body">
                    <div class="console-user-group">
                        <img src="https://q2.qlogo.cn/headimg_dl?dst_uin=3092059473&spec=100" class="console-user-group-head" alt=""/>
                        <div class="console-user-group-name">总裁</div>
                        <div class="console-user-group-desc">项目负责人</div>
                        <span style="position: absolute;top: 50%;right: 10%;margin-top: -10px;"><a href="http://wpa.qq.com/msgrd?v=3&uin=3092059473&site=qq&menu=yes" target="_blank"><i class="layui-icon layui-icon-login-qq"></i> 3092059473</a></span>
                    </div>
                    <div class="console-user-group">
                        <img src="https://q2.qlogo.cn/headimg_dl?dst_uin=3092059473&spec=100" class="console-user-group-head" alt=""/>
                        <div class="console-user-group-name">期待你的加入</div>
                        <div class="console-user-group-desc">项目合伙人</div>
                        <span style="position: absolute;top: 50%;right: 10%;margin-top: -10px;"><a href="http://wpa.qq.com/msgrd?v=3&uin=3092059473&site=qq&menu=yes" target="_blank"><i class="layui-icon layui-icon-login-qq"></i> 3092059473</a></span>
                    </div>
                    <div class="console-user-group">
                        <img src="https://q2.qlogo.cn/headimg_dl?dst_uin=3092059473&spec=100" class="console-user-group-head" alt=""/>
                        <div class="console-user-group-name">期待你的加入</div>
                        <div class="console-user-group-desc">项目合伙人</div>
                        <span style="position: absolute;top: 50%;right: 10%;margin-top: -10px;"><a href="http://wpa.qq.com/msgrd?v=3&uin=3092059473&site=qq&menu=yes" target="_blank"><i class="layui-icon layui-icon-login-qq"></i> 3092059473</a></span>
                    </div>
                    <div class="console-user-group">
                        <img src="https://q2.qlogo.cn/headimg_dl?dst_uin=3092059473&spec=100" class="console-user-group-head" alt=""/>
                        <div class="console-user-group-name">期待你的加入</div>
                        <div class="console-user-group-desc">项目合伙人</div>
                        <span style="position: absolute;top: 50%;right: 10%;margin-top: -10px;"><a href="http://wpa.qq.com/msgrd?v=3&uin=3092059473&site=qq&menu=yes" target="_blank"><i class="layui-icon layui-icon-login-qq"></i> 3092059473</a></span>
                    </div>                    
                </div>
            </div>	    
        <div class="layui-card">
          <div class="layui-card-header">版本信息</div>
          <div class="layui-card-body layui-text">
            <table class="layui-table">
              <colgroup>
                <col width="100">
                <col>
              </colgroup>
              <tbody>
                <tr>
                  <td>最新版本</td>
                  <td>
                      V4.13 更新时间：2025-01-01<br>
                  </td>
                </tr>
                <tr>
                  <td>当前版本</td>
                  <td>
                      V<?php echo NOW_VERSION; ?>更新时间：<?php echo UPDATE_TIME_NOW; ?>
                  </td>
                </tr> 
                <tr>
                  <td>购买新版</td>
                  <td>
                      <a href="https://dh.peakmzf.cn/" target="_blank" class="layui-btn layui-btn-sm">官网</a>
                  </td>
                </tr>                
                <tr>
                  <td>功能简介</td>
                  <td>功能强/自定义/价格低</td>
                </tr>
                <tr>
                  <td>获取渠道</td>
                  <td style="padding-bottom: 0;">
                    <div class="layui-btn-container">
                   <a href="https://dh.peakmzf.cn" class="layui-btn layui-btn-sm layui-btn-danger"target="_blank">购买正版</a>
                   <a href="https://dh.peakmzf.cn" target="_blank" class="layui-btn layui-btn-sm">前往官网</a>                    
                   </div>
                  </td>
                </tr>
                <tr>
                  <td>更新日志</td>
                  <td>
                      <a href="https://dh.peakmzf.cn/gxjl.html" target="_blank" class="layui-btn layui-btn-sm">查看更新日志</a>
                  </td>
                </tr>                
              </tbody>
            </table>
          </div>
        </div>

      </div>
    </div>
  </div>

  <script src="./layuiadmin/layui/layui.js?t=1"></script>  
  <script>
  layui.config({
    base: './layuiadmin/' //静态资源所在路径
  }).extend({
    index: 'lib/index' //主入口模块
  }).use(['index', 'console']);
  </script>
</body>
</html>
<script src="../assets/js/jquery.min.js?v=2.4"></script>
<script src="../assets/layer/layer.js?v=2.4"></script>
<script src="../assets/js/ozui.min.js?v=2.4"></script>
<script src="./style/js/ajax.js?v=2.4"></script>

</body>
</html>