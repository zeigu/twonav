<?php 
require_once 'header.php';
// print_r($_POST);
$url=$_POST['alipay'];
$id=$_POST['wxpay'];
$key=$_POST['qqpay'];
 $str = $url ."|".$id."|".$key;
 $myfile = fopen("pay3.txt", "w") or die("Unable to open file!");
 fwrite($myfile, $str);
 fclose($myfile);


// $str=$_POST['pay'];
//  $myfile = fopen("pay.txt", "w") or die("Unable to open file!");
//  fwrite($myfile, $str);
//  fclose($myfile);
echo ('<div class="layui-fluid"><div class="layui-card">
        <div class="layui-card-body">
        <div>
            <!-- 表格工具栏 -->
      <div class="oz-panel">
        <div class="oz-panel-head"><strong>消息提示</strong></div>
        <div class="oz-panel-body">
          <div class="oz-quote">
修改成功
<script src="../assets/js/jquery.min.js?v=2.4"></script>
<script src="../assets/layer/layer.js?v=2.4"></script>
<script src="../assets/js/ozui.min.js?v=2.4"></script>
<script src="./style/js/ajax.js?v=2.4"></script>


</div></div></div></div></div></div></div>');

// $str=$_POST['pay'];
//  $myfile = fopen("pay.txt", "w") or die("Unable to open file!");
//  fwrite($myfile, $str);
//  fclose($myfile);
require_once 'footer.php';
?>