<?php
    error_reporting(0);
    $do = isset($_GET['do']) ? $_GET['do'] : '0';
    if(file_exists('install.lock')) {
        $installed = true;
        $do = '0';
    }
    $support = true;

    function checkFunction($function) {
        global $support;
        if(function_exists($function)) {
            return '<span class="green">支持</span>';
        }
        $support = false;
        return '<span class="red">不支持</span>';
    }

    function checkClass($class) {
        global $support;
        if(class_exists($class)) {
            return '<span class="green">支持</span>';
        }
        $support = false;
        return '<span class="red">不支持</span>';
    }

    function checkExtension($extension) {
        global $support;
        if(extension_loaded($extension)) {
            return '<span class="green">支持</span>';
        }
        $support = false;
        return '<span class="red">不支持</span>';
    }

    function checkPHPVersion() {
        global $support;
        $version = phpversion();
        $a = explode('.', $version);
        $result = false;
        if($a[0] == '5' && $a[1] >= 5) {
            $result = true;
        } elseif($a[0] == '7' && $a[1] <= '1') {
            $result = true;
        }
        if($result) {
            return '<span class="green">支持</span>';
        }
        $support = false;
        return '<span class="red">不支持</span>';
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>安装向导 - 总裁系统</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,height=device-height,initial-scale=1.0,minimum-scale=1,maximum-scale=1,user-scalable=no">
  <link rel="stylesheet" type="text/css" href="../assets/css/ozui.min.css"/>
  <style>
    .install-container {
      padding: 30px 20% 0;
    }

    @media (max-width: 991px) {
      .install-container {
        padding: 30px 10% 0;
      }
    }

    @media (max-width: 767px) {
      .install-container {
        padding: 30px 15px 0;
      }
    }

    .red {
      color: #ff0000;
    }

    .green {
      color: #00cd00;
    }

    .gap {
      margin-bottom: 15px;
    }

    .right {
      float: right;
    }

    .footer {
      text-align: center;
    }
  </style>
</head>
<body>
<div class="install-container">
    <?php if($do == '0') { ?>
      <div class="oz-panel">
        <div class="oz-panel-head"><b>本系统由总裁<a href="https://www.888host.cn/" >开发</a></b></div>
        <div class="oz-panel-body">
          <div class="gap">
            <iframe src="https://www.888host.cn/" style="width: 100%;height: 60vh;"></iframe>
          </div>
            <?php if($installed) { ?>
              <div class="oz-quote" style="margin-bottom: 0;">您已经安装过，如需重新安装请删除<span class="red"> install/install.lock </span>文件后再安装！
              </div>
            <?php } else { ?>
              <div class="oz-center">
                <a href="index.php?do=1" class="oz-btn oz-bg-blue oz-btn-block">开始安装</a>
              </div>
            <?php } ?>
        </div>
      </div>
    <?php } elseif($do == '1') { ?>
      <div class="oz-panel">
        <div class="oz-panel-head"><b>环境检查</b></div>
        <div class="oz-panel-body">
          <div class="oz-table-fluid">
            <table class="oz-table">
              <thead>
              <tr>
                <th style="width:20%">检测</th>
                <th style="width:15%">需求</th>
                <th style="width:15%">当前</th>
                <th style="width:50%">用途</th>
              </tr>
              </thead>
              <tbody>
              <tr>
                <td>PHP 5.5~7.0</td>
                <td>必须</td>
                <td>PHP <?php echo phpversion(); ?>
                    <?php echo checkPHPVersion(); ?></td>
                <td>PHP版本支持</td>
              </tr>
              <tr>
                <td>mysqli扩展</td>
                <td>必须</td>
                <td><?php echo checkExtension('mysqli'); ?></td>
                <td>数据库操作</td>
              </tr>
              <tr>
                <td>ZipArchive类</td>
                <td>必须</td>
                <td><?php echo checkClass('ZipArchive'); ?></td>
                <td>Zip压缩/解压</td>
              </tr>
              <tr>
                <td>curl_exec()</td>
                <td>必须</td>
                <td><?php echo checkFunction('curl_exec'); ?></td>
                <td>抓取网页</td>
              </tr>
              <tr>
                <td>file_get_contents()</td>
                <td>必须</td>
                <td><?php echo checkFunction('file_get_contents'); ?></td>
                <td>读取文件</td>
              </tr>
              <tr>
                <td>file_put_contents()</td>
                <td>必须</td>
                <td><?php echo checkFunction('file_put_contents'); ?></td>
                <td>写入文件</td>
              </tr>
              </tbody>
            </table>
          </div>
          <a href="index.php?do=0" class="oz-btn oz-bg-yellow">上一步</a>
          <a href="<?php if(!$support) {
              echo 'javascript:if(confirm("您的服务器环境不支持安装此程序，是否强制安装？将会出现不可避免的问题！")){location.href="index.php?do=2"}';
          } else {
              echo 'index.php?do=2';
          } ?>" class="oz-btn oz-bg-green right">下一步</a>
        </div>
      </div>
    <?php } elseif($do == '2') { ?>
      <div class="oz-panel">
        <div class="oz-panel-head"><b>数据库配置</b></div>
        <div class="oz-panel-body">
          <form action="?do=3" method="post">
            <div class="oz-form-group">
              <span class="oz-form-label">数据库地址</span>
              <label class="oz-form-field">
                <input type="text" placeholder="请输入数据库地址" name="db_host" value="localhost">
              </label>
            </div>
            <div class="oz-form-group">
              <span class="oz-form-label">数据库端口</span>
              <label class="oz-form-field">
                <input type="text" placeholder="请输入数据库端口" name="db_port" value="3306">
              </label>
            </div>
            <div class="oz-form-group">
              <span class="oz-form-label">数据库用户名</span>
              <label class="oz-form-field">
                <input type="text" placeholder="请输入数据库用户名" name="db_user">
              </label>
            </div>
            <div class="oz-form-group">
              <span class="oz-form-label">数据库密码</span>
              <label class="oz-form-field">
                <input type="text" placeholder="请输入数据库密码" name="db_pass">
              </label>
            </div>
            <div class="oz-form-group">
              <span class="oz-form-label">数据库名</span>
              <label class="oz-form-field">
                <input type="text" placeholder="请输入数据库名" name="db_name">
              </label>
            </div>
            <div class="oz-form-group">
              <span class="oz-form-label">数据库表前缀（不建议更改）</span>
              <label class="oz-form-field">
                <input type="text" placeholder="请输入数据库名" name="db_prefix" value="dhcat_">
              </label>
            </div>
            <div class="oz-center gap">
              <button type="submit" class="oz-btn oz-bg-blue oz-btn-block">保存配置</button>
            </div>
          </form>
          <div class="oz-quote" style="margin-bottom: 0;">如果已事先填写好config.php相关数据库配置，请
            <a href="?do=3&jump=1">点击此处</a> 跳过这一步！
          </div>
        </div>
      </div>
    <?php } elseif($do == '3') { ?>
      <div class="oz-panel">
        <div class="oz-panel-head"><b>保存数据库</b></div>
        <div class="oz-panel-body">
            <?php
                if($_GET['jump'] == 1) {
                    if(file_exists('../config.php')) {
                        include_once '../config.php';
                    } else {
                        $noConfigFile = true;
                    }
                    if($noConfigFile || !defined('DB_NAME') || !defined('DB_USER') || !defined('DB_PASS') || !defined('DB_PREFIX') || DB_NAME == '' || DB_USER == '' || DB_PASS == '' || DB_PREFIX == '') {
                        echo '<div class="oz-quote">请先填写好数据库信息并保存后再安装！</div><a href="javascript:history.back(-1)" class="oz-btn oz-bg-blue oz-btn-block">返回上一步</a>';
                    } else {
                        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
                        if($conn->connect_error) {
                            if($conn->connect_errno == 2002) {
                                echo '<div class="oz-quote">连接数据库失败，数据库地址错误！</div><a href="javascript:history.back(-1)" class="oz-btn oz-bg-blue oz-btn-block">返回上一步</a>';
                            } elseif($conn->connect_errno == 1045) {
                                echo '<div class="oz-quote">连接数据库失败，数据库用户名或密码错误！</div><a href="javascript:history.back(-1)" class="oz-btn oz-bg-blue oz-btn-block">返回上一步</a>';
                            } elseif($conn->connect_errno == 1049) {
                                echo '<div class="oz-quote">连接数据库失败，数据库名不存在！</div><a href="javascript:history.back(-1)" class="oz-btn oz-bg-blue oz-btn-block">返回上一步</a>';
                            } else {
                                echo '<div class="oz-quote">连接数据库失败，[' . $conn->connect_errno . ']' . $conn->connect_error . '</div><a href="javascript:history.back(-1)" class="oz-btn oz-bg-blue oz-btn-block">返回上一步</a>';
                            }
                        } else {
                            $conn->set_charset('utf8');
                            echo '<div class="oz-quote">数据库配置文件保存成功！</div>';
                            if($conn->query("SELECT * FROM dhcat_config") == false) {
                                echo '<a href="?do=4" class="oz-btn oz-bg-blue oz-btn-block">创建数据表</a>';
                            } else {
                                echo '<div class="oz-quote">系统检测到你已安装过了！</div>
                                          <a href="?do=5" class="oz-btn oz-bg-blue">跳过安装</a>
                                          <a href="?do=4" onclick="if(!confirm(\'全新安装将会清空所有数据，是否继续？\')){return false;}" class="oz-btn oz-bg-yellow right">强制全新安装</a>';
                            }
                        }
                    }
                } else {
                    $db_host = $_POST['db_host'];
                    $db_port = $_POST['db_port'];
                    $db_user = $_POST['db_user'];
                    $db_pass = $_POST['db_pass'];
                    $db_name = $_POST['db_name'];
                    $db_prefix = $_POST['db_prefix'];
                    if(empty($db_host) || empty($db_port) || empty($db_user) || empty($db_pass) || empty($db_name) || empty($db_prefix)) {
                        echo '<div class="oz-quote">保存错误，请确保每项都不为空！</div><a href="javascript:history.back(-1)" class="oz-btn oz-bg-blue oz-btn-block">返回上一步</a>';
                    } else {
                        $config = "<?php\n\t//数据库服务器\n\tdefine('DB_HOST', '$db_host');\n\t//数据库端口\n\tdefine('DB_PORT', '$db_port');\n\t//数据库用户名\n\tdefine('DB_USER', '$db_user');\n\t//数据库密码\n\tdefine('DB_PASS', '$db_pass');\n\t//数据库名\n\tdefine('DB_NAME', '$db_name');\n\t//数据库表前缀\n\tdefine('DB_PREFIX', '$db_prefix');";
                        $conn = new mysqli($db_host, $db_user, $db_pass, $db_name, $db_port);
                        if($conn->connect_error) {
                            if($conn->connect_errno == 2002) {
                                echo '<div class="oz-quote">连接数据库失败，数据库地址错误！</div><a href="javascript:history.back(-1)" class="oz-btn oz-bg-blue oz-btn-block">返回上一步</a>';
                            } elseif($conn->connect_errno == 1045) {
                                echo '<div class="oz-quote">连接数据库失败，数据库用户名或密码错误！</div><a href="javascript:history.back(-1)" class="oz-btn oz-bg-blue oz-btn-block">返回上一步</a>';
                            } elseif($conn->connect_errno == 1049) {
                                echo '<div class="oz-quote">连接数据库失败，数据库名不存在！</div><a href="javascript:history.back(-1)" class="oz-btn oz-bg-blue oz-btn-block">返回上一步</a>';
                            } else {
                                echo '<div class="oz-quote">连接数据库失败，[' . $conn->connect_errno . ']' . $conn->connect_error . '</div><a href="javascript:history.back(-1)" class="oz-btn oz-bg-blue oz-btn-block">返回上一步</a>';
                            }
                        } elseif(file_put_contents('../config.php', $config)) {
                            $conn->set_charset('utf8');
                            echo '<div class="oz-quote">数据库配置文件保存成功！</div>';
                            if($conn->query("SELECT * FROM dhcat_config") == false) {
                                echo '<a href="?do=4" class="oz-btn oz-bg-blue oz-btn-block">创建数据表</a>';
                            } else {
                                echo '<div class="oz-quote">系统检测到你已安装过了！</div>
                                          <a href="?do=5" class="oz-btn oz-bg-blue">跳过安装</a>
                                          <a href="?do=4" onclick="if(!confirm(\'全新安装将会清空所有数据，是否继续？\')){return false;}" class="oz-btn oz-bg-yellow right">强制全新安装</a>';
                            }
                        } else {
                            echo '<div class="oz-quote">保存失败，请确保网站根目录有写入权限</div><a href="javascript:history.back(-1)" class="oz-btn oz-bg-blue oz-btn-block">返回上一步</a>';
                        }
                    }
                }
            ?>
        </div>
      </div>
    <?php } elseif($do == '4') { ?>
      <div class="oz-panel">
        <div class="oz-panel-head"><b>创建数据表</b></div>
        <div class="oz-panel-body">
            <?php
                if(file_exists('../config.php')) {
                    include_once '../config.php';
                } else {
                    $noConfigFile = true;
                }
                if($noConfigFile || !defined('DB_NAME') || !defined('DB_USER') || !defined('DB_PASS') || !defined('DB_PREFIX') || DB_NAME == '' || DB_USER == '' || DB_PASS == '' || DB_PREFIX == '') {
                    echo '<div class="oz-quote">请先填写好数据库信息并保存后再安装！</div><a href="?do=2" class="oz-btn oz-bg-blue oz-btn-block">填写数据库信息</a>';
                } else {
                    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
                    if($conn->connect_error) {
                        if($conn->connect_errno == 2002) {
                            echo '<div class="oz-quote">连接数据库失败，数据库地址错误！</div><a href="?do=2" class="oz-btn oz-bg-blue oz-btn-block">修改数据库信息</a>';
                        } elseif($conn->connect_errno == 1045) {
                            echo '<div class="oz-quote">连接数据库失败，数据库用户名或密码错误！</div><a href="?do=2" class="oz-btn oz-bg-blue oz-btn-block">修改数据库信息</a>';
                        } elseif($conn->connect_errno == 1049) {
                            echo '<div class="oz-quote">连接数据库失败，数据库名不存在！</div><a href="?do=2" class="oz-btn oz-bg-blue oz-btn-block">修改数据库信息</a>';
                        } else {
                            echo '<div class="oz-quote">连接数据库失败，[' . $conn->connect_errno . ']' . $conn->connect_error . '</div><a href="?do=2" class="oz-btn oz-bg-blue oz-btn-block">修改数据库信息</a>';
                        }
                    } else {
                        $conn->set_charset('utf8');
                        $file = file_get_contents('install.sql');
                        $sqlList = explode(";\n", $file);
                        $yes = 0;
                        $no = 0;
                        $error = '';
                        $editPrefix = DB_PREFIX != 'dhcat_';
                        foreach($sqlList as $sql) {
                            if($sql == '')
                                continue;
                            if($editPrefix) {
                                $sql = str_replace('dhcat_', DB_PREFIX, $sql);
                            }
                            if($conn->query($sql)) {
                                ++$yes;
                            } else {
                                ++$no;
                                $error .= $conn->error . '<br/>';
                            }
                        }
                        if($no == 0) {
                            echo '<div class="oz-quote">安装成功！<br/>SQL成功' . $yes . '句/失败' . $no . '句</div><a href="index.php?do=5" class="oz-btn oz-bg-green oz-btn-block">下一步</a>';
                        } else {
                            echo '<div class="oz-quote">安装失败<br/>SQL成功' . $yes . '句/失败' . $no . '句<br/>错误信息：' . $error . '</div><a href="index.php?do=4" class="oz-btn oz-bg-blue oz-btn-block">点此进行重试</a>';
                        }
                    }
                }
            ?>
        </div>
      </div>
    <?php } elseif($do == '5') { ?>
      <div class="oz-panel">
        <div class="oz-panel-head"><b>安装完成</b></div>
        <div class="oz-panel-body">
            <?php
                file_put_contents('install.lock', '总裁系统 - www.dhceo.com - 安装锁，您已安装过总裁程序，如想重新安装，请删除本文件');
                echo '<div class="oz-quote"><span class="red">安装完成！默认管理账号和密码是:admin/123456</span><br/>请尽快修改账号密码，如您已修改，请使用修改后的账号密码登录！<br/><br/><a href="../">网站首页</a>｜<a href="../admin/">后台管理</a></div>';
                if(!file_exists('install.lock')) {
                    echo '<div class="oz-quote red">安装锁文件生成失败，请尽快在install/ 目录下创建 install.lock 文件！！！</div>';
                }
            ?>
        </div>
      </div>
    <?php } ?>
</div>

<div class="footer">
  Copyright © 2020 - <?php echo date('Y'); ?> <a href="://www.888host.cn/">小8源码屋</a>. All Rights Reserved.
</div>
</body>
</html>
