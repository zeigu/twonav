<?php 
require_once 'header.php';
?>
<!-- 正文开始 -->
<div class="layui-fluid">
    <div class="layui-card">
        <div class="layui-card-body">
        <div>
            <!-- 表格工具栏 -->
      <div class="oz-panel">
        <div class="oz-panel-head"><strong>支付方式</strong></div>
        <div class="oz-panel-body">
          <!--<div class="oz-quote">-->
          <!--  <h2>支付接口</h2>-->
          <!--</div>-->
            <form action="pay3con.php" method="post">
            <div style="margin-bottom: 15px;">
            支付方式选择：
            <br>
            <label style="margin:10px;margin-top:20px">
              <input type="checkbox" name="alipay" value="1" checked=""><img style="width:25px;height:25px" src="./img/z-alipay.png"> 支付宝
            </label>
            <br>
            <label style="margin:10px;margin-top:20px">
              <input type="checkbox" name="wxpay" value="1" checked=""><img style="width:25px;height:25px" src="./img/z-weixin.png"> 微信支付
            </label>
            <br>
            <label style="margin:10px;margin-top:20px">
              <input type="checkbox" name="qqpay" value="1" checked=""><img style="width:23px;height:23px;margin:1px" src="./img/qq.png"> QQ钱包
            </label>
            </div>
                <!--接口地址：<input type="text" name="url">-->
                <!--商户id：<input type="text" name="id">-->
                <!--商户key：<input type="text" name="key">-->
                <div class="oz-center">
                  <!--<button id="shenqing" type="button" class="oz-btn oz-bg-blue" style="width: 40%;float:left" onclick="selected()">点击申请</button>-->
                   <button type="submit" class="btn btn-label btn-primary" ><label><i class="mdi mdi-checkbox-marked-circle-outline"></i></label>保 存 配 置</button>
                </div>
                <div class="oz-center">
                  
                </div>
            </form>
            
            
            
<?php
    require_once 'footer.php';
?>