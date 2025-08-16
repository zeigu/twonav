<?php
    require_once 'header.php';
?>

<div class="layui-fluid">
    <div class="layui-card">
        <div class="layui-card-header">自助购买广告价格配置</div>
        <div class="layui-card-body">
          <form id="config-edit" method="post" onsubmit="return false" class="layui-form layui-form-pane">                        
        <div class="layui-field-box">
        


         <div class="layui-form-item">
         <label class="layui-form-label">置顶站点</label>
         <div class="layui-input-block">
                 <input type="text" placeholder="请输入置顶站点价格" value="<?php echo $CONFIG['zhiding_money']; ?>" name="zhiding_money" class="layui-input"/>
         </div>
           </div>


          <div class="layui-form-item">
          <label class="layui-form-label">首页图片</label>
          <div class="layui-input-block">
          <input type="text" placeholder="请输入首页图片广告价格" value="<?php echo $CONFIG['list_money']; ?>" name="list_money" class="layui-input"/>
          </div>
            </div>


          <div class="layui-form-item">
          <label class="layui-form-label">文章内页</label>
           <div class="layui-input-block">
            <input type="text" placeholder="请输入文章内页广告价格" value="<?php echo $CONFIG['page_money']; ?>" name="page_money" class="layui-input"/>
           </div>
          </div>


          <div class="layui-form-item">
          <label class="layui-form-label">站点详情</label>
          <div class="layui-input-block">
           <input type="text" placeholder="请输入站点详情广告价格" value="<?php echo $CONFIG['site_money']; ?>" name="site_money" class="layui-input"/>
       </div>
         </div>

               <hr style="width:0px"><hr>       
               <div class="layui-form-item layui-row layui-col-space10 ">                  
               <div class="layui-col-md2">
             <button type="submit" class="btn btn-label btn-primary" onclick="editConfig()"><label><i class="mdi mdi-checkbox-marked-circle-outline"></i></label>保 存 配 置</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

<script type="text/javascript" src="../assets/libs/layui/layui.js"></script>
<script type="text/javascript" src="../assets/js/common.js?v=318"></script>
  
<script>
var items = $("select[default]");
for (i = 0; i < items.length; i++) {
$(items[i]).val($(items[i]).attr("default")||0);
}
layui.use(['admin','form', 'element','jquery', 'tagsInput', 'laydate', 'notice'], function () {
        var admin = layui.admin;
        var form = layui.form;
        var $ = layui.jquery;
        var tagsInput = layui.tagsInput;
        var laydate = layui.laydate;
        var notice = layui.notice;
$('#mailtest').click(function () {
var ii = notice.msg('正在执行中..', {icon: 4, close: true});
    $.ajax({
        type: "GET",
        url: "ajax.php?act=mailtest",
        dataType: "json",
        success: function(data) {
            notice.destroy();
            if (data.code == 0) {
                notice.msg(data.msg, {icon: 1});
            } else {
                notice.msg(data.msg, {icon: 2});
            }
        }
    });
});
$('#noticeBtn').click(function () {



    var title = $("input[name='title']").val();
    var foot = $("input[name='foot']").val();
    var ICP = $("input[name='ICP']").val();
    var keywords = $("input[name='keywords']").val();
    var description = $("input[name='description']").val();
    var kfqq = $("input[name='kfqq']").val();
    var jiaqunlianjie = $("input[name='jiaqunlianjie']").val();
    var site_background = $("input[name='site_background']:checked").val();
    var img = $("input[name='img']").val();
    var site_background_music = $("input[name='site_background_music']:checked").val();
    var diy_background_music = $("input[name='diy_background_music']").val();
    var netease_music_toplist = $("input[name='netease_music_toplist']:checked").val();
    var tencent_music_toplist = $("input[name='tencent_music_toplist']:checked").val();
    var diy_background_music_id = $("#diy_background_music_id").val();
    var background_text = $("input[name='background_text']").val();
    var background_text_per = $("input[name='background_text_per']:checked").val();
    var background_text_spd = $("input[name='background_text_spd']:checked").val();
    var background_text_pit = $("input[name='background_text_pit']:checked").val();
    var background_text_vol = $("input[name='background_text_vol']:checked").val();
    var is_webwh = $("input[name='is_webwh']").val();
    var gh_number = $("input[name='gh_number']").val();
    var gh_price = $("input[name='gh_price']").val();
    var is_lts = $("input[name='is_lts']").val();
    var blacklist = $("#blacklist").val();
    var captcha_open = $("input[name='captcha_open']").val();
    var captcha_id = $("input[name='captcha_id']").val();
    var captcha_key = $("input[name='captcha_key']").val();
    var qqtz = $("input[name='qqtz']").val();
    var is_qqkuaijie = $("input[name='is_qqkuaijie']").val();
    var is_qqlogin = $("input[name='is_qqlogin']").val();
    var gonggao = $("#gonggao").val();
    var ht_gonggao = $("#ht_gonggao").val();
    var kmbuy_gonggao = $("#kmbuy_gonggao").val();
    var onlinebuy_gonggao = $("#onlinebuy_gonggao").val();
    var int_market_gonggao = $("#int_market_gonggao").val();
    var reg_gonggao = $("#reg_gonggao").val();
    var is_reg = $("input[name='is_reg']").val();
    var is_kmbuy = $("input[name='is_kmbuy']").val();
    var is_onlinebuy = $("input[name='is_onlinebuy']").val();
    var is_zbcx = $("input[name='is_zbcx']").val();
    var is_zfcx = $("input[name='is_zfcx']").val();
    var is_dlcx = $("input[name='is_dlcx']").val();
    var is_gh = $("input[name='is_gh']").val();
    var int_market_open = $("input[name='int_market_open']").val();
    var download = $("input[name='download']:checked").val();
    var template = $("input[name='template']:checked").val();
    var login_template = $("input[name='login_template']:checked").val();
    var maintain_template = $("input[name='maintain_template']:checked").val();
    var epay_url = $("input[name='epay_url']").val();
    var epay_pid = $("input[name='epay_pid']").val();
    var epay_key = $("input[name='epay_key']").val();
    var qqpay_url = $("input[name='qqpay_url']").val();
    var qqpay_pid = $("input[name='qqpay_pid']").val();
    var qqpay_key = $("input[name='qqpay_key']").val();
    var qqpay_mchid = $("input[name='qqpay_mchid']").val();
    var qqpay_mchkey = $("input[name='qqpay_mchkey']").val();
    var wxpay_url = $("input[name='wxpay_url']").val();
    var wxpay_pid = $("input[name='wxpay_pid']").val();
    var wxpay_key = $("input[name='wxpay_key']").val();
    var wxpay_key2 = $("input[name='wxpay_key2']").val();
    var wxpay_mchid = $("input[name='wxpay_mchid']").val();
    var wxpay_appid = $("input[name='wxpay_appid']").val();
    var wxpay_appsecret = $("input[name='wxpay_appsecret']").val();
    var alipay_url = $("input[name='alipay_url']").val();
    var alipay_pid = $("input[name='alipay_pid']").val();
    var alipay_key = $("input[name='alipay_key']").val();
    var alipay_pid2 = $("input[name='alipay_pid2']").val();
    var alipay_key2 = $("input[name='alipay_key2']").val();
    var alipay_account = $("input[name='alipay_account']").val();
    var codepay_url = $("input[name='codepay_url']").val();
    var codepay_id = $("input[name='codepay_id']").val();
    var codepay_key = $("input[name='codepay_key']").val();
    var alipay_api = $("select[name='alipay_api']").val();
    var alipay2_api = $("select[name='alipay2_api']").val();
    var qqpay_api = $("select[name='qqpay_api']").val();
    var wxpay_api = $("select[name='wxpay_api']").val();
    var epays_open = $("select[name='epays_open']").val();
    var mail_cloud = $("input[name='mail_cloud']:checked").val();
    var mail_smtp = $("input[name='mail_smtp']").val();
    var mail_port = $("input[name='mail_port']").val();
    var mail_name = $("input[name='mail_name']").val();
    var mail_pwd = $("input[name='mail_pwd']").val();
    var mail_recv = $("input[name='mail_recv']").val();
    console.log(is_zbcx)
    if (kfqq.length < 5 || kfqq.length > 10 || isNaN(kfqq)) {
        notice.msg('请输入5~10位QQ账号', {icon: 3});
        return false;
    } else if (title == "") {
        notice.msg('请输入网站名称', {icon: 3});
        return false;
    }
    var ii = notice.msg('正在执行中..', {icon: 4, close: true});
    $.ajax({
        type: "POST",
        url: "ajax.php?act=SF_System_Setting",
        data : {title:title,foot:foot,ICP:ICP,keywords:keywords,description:description,kfqq:kfqq,jiaqunlianjie:jiaqunlianjie,site_background:site_background,site_background_music:site_background_music,diy_background_music:diy_background_music,netease_music_toplist:netease_music_toplist,tencent_music_toplist:tencent_music_toplist,diy_background_music_id:diy_background_music_id,background_text:background_text,background_text_per:background_text_per,background_text_spd:background_text_spd,background_text_pit:background_text_pit,background_text_vol:background_text_vol,img:img,is_webwh:is_webwh,gh_number:gh_number,gh_price:gh_price,is_lts:is_lts,blacklist:blacklist,captcha_open:captcha_open,captcha_id:captcha_id,captcha_key:captcha_key,qqtz:qqtz,is_qqkuaijie:is_qqkuaijie,is_qqlogin:is_qqlogin,gonggao:gonggao,ht_gonggao:ht_gonggao,kmbuy_gonggao:kmbuy_gonggao,onlinebuy_gonggao:onlinebuy_gonggao,int_market_gonggao:int_market_gonggao,reg_gonggao:reg_gonggao,is_zbcx:is_zbcx,is_zfcx:is_zfcx,is_dlcx:is_dlcx,is_reg:is_reg,is_kmbuy:is_kmbuy,is_onlinebuy:is_onlinebuy,is_gh:is_gh,int_market_open:int_market_open,download:download,template:template,login_template:login_template,maintain_template:maintain_template,epay_url:epay_url,epay_pid:epay_pid,epay_key:epay_key,qqpay_url:qqpay_url,qqpay_pid:qqpay_pid,qqpay_key:qqpay_key,qqpay_mchid:qqpay_mchid,qqpay_mchkey:qqpay_mchkey,wxpay_url:wxpay_url,wxpay_pid:wxpay_pid,wxpay_key:wxpay_key,wxpay_key2:wxpay_key2,wxpay_mchid:wxpay_mchid,wxpay_appid:wxpay_appid,wxpay_appsecret:wxpay_appsecret,alipay_url:alipay_url,alipay_pid:alipay_pid,alipay_key:alipay_key,alipay_pid2:alipay_pid2,alipay_key2:alipay_key2,alipay_account:alipay_account,codepay_url:codepay_url,codepay_id:codepay_id,codepay_key:codepay_key,alipay_api:alipay_api,alipay2_api:alipay2_api,qqpay_api:qqpay_api,wxpay_api:wxpay_api,epays_open:epays_open,mail_cloud:mail_cloud,mail_smtp:mail_smtp,mail_port:mail_port,mail_name:mail_name,mail_pwd:mail_pwd,mail_recv:mail_recv},
        dataType: "json",
        success: function(data) {

            notice.destroy();
            if (data.code == 0) {
                notice.msg(data.msg, {icon: 1});
            } else {
                notice.msg(data.msg, {icon: 2});
            }
        }
    });
});
        form.on('select(alipay_api)', function(data){ 
        if(data.value == '1'){
            $("#payapi_01").show();
            $("#payapi_06").hide();
        }else if(data.value == '3'){
            $("#payapi_01").hide();
            $("#payapi_06").show();
        }else{
            $("#payapi_01").hide();
            $("#payapi_06").hide();
        }
    });
    form.on('select(wxpay_api)', function(data){ 
        if(data.value == '1' || data.value == '3'){
            $("#payapi_04").show();
        }else{
            $("#payapi_04").hide();
        }
    });
    form.on('select(qqpay_api)', function(data){ 
        if(data.value == '1'){
            $("#payapi_05").show();
        }else{
            $("#payapi_05").hide();
        }
    });
    form.on('select(alipay2_api)', function(data){ 
        if(data.value == '1'){
            $("#payapi_02").show();
        }else{
            $("#payapi_02").hide();
        }
    });
    form.on('select(epays_open)', function(data){ 
        if(data.value == '1'){
            $("#dlpay").show();
        }else{
            $("#dlpay").hide();
        }
    });
        form.on('radio(background_text_per)', function (data) {
            var text = $("input[name='background_text']").val();
            var text_per = data.value;
            var text_spd = $("input[name='background_text_spd']:checked").val();
            var text_pit = $("input[name='background_text_pit']:checked").val();
            var text_vol = $("input[name='background_text_vol']:checked").val();
            $("#mp3").html("<embed src=\"https://tts.baidu.com/text2audio.mp3?tex="+text+"&cuid=baike&lan=ZH&ctp=1&pdt=301&vol="+text_vol+"&rate=32&per="+text_per+"&spd="+text_spd+"&pit="+text_pit+"\" id=\"media\" width=\"0\" height=\"0\" allowNetworking=\"all\">");
            form.render('radio');
        });
        form.on('radio(background_text_spd)', function (data) {
            var text = $("input[name='background_text']").val();
            var text_per = $("input[name='background_text_per']:checked").val();
            var text_spd = data.value;
            var text_pit = $("input[name='background_text_pit']:checked").val();
            var text_vol = $("input[name='background_text_vol']:checked").val();
            $("#mp3").html("<embed src=\"https://tts.baidu.com/text2audio.mp3?tex="+text+"&cuid=baike&lan=ZH&ctp=1&pdt=301&vol="+text_vol+"&rate=32&per="+text_per+"&spd="+text_spd+"&pit="+text_pit+"\" id=\"media\" width=\"0\" height=\"0\" allowNetworking=\"all\">");
        });
        form.on('radio(background_text_pit)', function (data) {
            var text = $("input[name='background_text']").val();
            var text_per = $("input[name='background_text_per']:checked").val();
            var text_spd = $("input[name='background_text_spd']:checked").val();
            var text_pit = data.value;
            var text_vol = $("input[name='background_text_vol']:checked").val();
            $("#mp3").html("<embed src=\"https://tts.baidu.com/text2audio.mp3?tex="+text+"&cuid=baike&lan=ZH&ctp=1&pdt=301&vol="+text_vol+"&rate=32&per="+text_per+"&spd="+text_spd+"&pit="+text_pit+"\" id=\"media\" width=\"0\" height=\"0\" allowNetworking=\"all\">");
        });
        form.on('radio(background_text_vol)', function (data) {
            var text = $("input[name='background_text']").val();
            var text_per = $("input[name='background_text_per']:checked").val();
            var text_spd = $("input[name='background_text_spd']:checked").val();
            var text_pit = $("input[name='background_text_pit']:checked").val();
            var text_vol = data.value;
            $("#mp3").html("<embed src=\"https://tts.baidu.com/text2audio.mp3?tex="+text+"&cuid=baike&lan=ZH&ctp=1&pdt=301&vol="+text_vol+"&rate=32&per="+text_per+"&spd="+text_spd+"&pit="+text_pit+"\" id=\"media\" width=\"0\" height=\"0\" allowNetworking=\"all\">");
            form.render('radio');
        });
        form.on('radio(site_background)', function (data) {
            if(data.value==0){
                $("#is_img").css("display","inherit");
            }else{
                $("#is_img").css("display","none");
            }
            form.render('radio');
        });
        form.on('radio(site_background_music)', function (data) {
            if(data.value==0){
                $("#is_music").css("display","none");
                $("#is_background").css("display","none");
                $("#netease_music_toplist").css("display","none");
                $("#tencent_music_toplist").css("display","none");
                $("#is_music_id").css("display","none");
            }else if(data.value==1){
                $("#is_music").css("display","inherit");
                $("#is_background").css("display","none");
                $("#netease_music_toplist").css("display","none");
                $("#tencent_music_toplist").css("display","none");
                $("#is_music_id").css("display","none");
            }else if(data.value==2){
                $("#netease_music_toplist").css("display","none");
                $("#tencent_music_toplist").css("display","none");
                $("#is_music").css("display","none");
                $("#is_background").css("display","none");
                $("#is_music_id").css("display","inherit");
            }else if(data.value==3){
                $("#netease_music_toplist").css("display","none");
                $("#tencent_music_toplist").css("display","none");
                $("#is_music").css("display","none");
                $("#is_background").css("display","inherit");
                $("#is_music_id").css("display","none");
            }else if(data.value==4){
                $("#netease_music_toplist").css("display","inherit");
                $("#tencent_music_toplist").css("display","none");
                $("#is_music").css("display","none");
                $("#is_background").css("display","none");
                $("#is_music_id").css("display","none");
            }else if(data.value==5){
                $("#tencent_music_toplist").css("display","inherit");
                $("#netease_music_toplist").css("display","none");
                $("#is_music").css("display","none");
                $("#is_background").css("display","none");
                $("#is_music_id").css("display","none");
            }
            form.render('radio');
        });
        form.on('switch(int_market_open)', function(data){
            var ii = notice.msg('正在执行中..', {icon: 4, close: true});
            if(this.checked){
                $("input[name='int_market_open']").val("1");
                notice.destroy();
                notice.msg('积分商城已开启！', {icon: 1});
            }else{
                $("input[name='int_market_open']").val("0");
                notice.destroy();
                notice.msg('积分商城已关闭！', {icon: 1});
            }
        });
        form.on('switch(is_kmbuy)', function(data){
            var ii = notice.msg('正在执行中..', {icon: 4, close: true});
            if(this.checked){
                $("input[name='is_kmbuy']").val("1");
                notice.destroy();
                notice.msg('卡密兑换已开启！', {icon: 1});
            }else{
                $("input[name='is_kmbuy']").val("0");
                notice.destroy();
                notice.msg('卡密兑换已关闭！', {icon: 1});
            }
        });
        form.on('switch(is_zbcx)', function(data){
            var ii = notice.msg('正在执行中..', {icon: 4, close: true});
            if(this.checked){
                $("input[name='is_zbcx']").val("1");
                notice.destroy();
                notice.msg('正版查询已开启！', {icon: 1});
            }else{
                $("input[name='is_zbcx']").val("0");
                notice.destroy();
                notice.msg('正版查询已关闭！', {icon: 1});
            }
        });
        form.on('switch(is_zfcx)', function(data){
            var ii = notice.msg('正在执行中..', {icon: 4, close: true});
            if(this.checked){
                $("input[name='is_zfcx']").val("1");
                notice.destroy();
                notice.msg('支付查询已开启！', {icon: 1});
            }else{
                $("input[name='is_zfcx']").val("0");
                notice.destroy();
                notice.msg('支付查询已关闭！', {icon: 1});
            }
        });
        form.on('switch(is_dlcx)', function(data){
            var ii = notice.msg('正在执行中..', {icon: 4, close: true});
            if(this.checked){
                $("input[name='is_dlcx']").val("1");
                notice.destroy();
                notice.msg('代理查询已开启！', {icon: 1});
            }else{
                $("input[name='is_dlcx']").val("0");
                notice.destroy();
                notice.msg('代理查询已关闭！', {icon: 1});
            }
        });
        form.on('switch(is_gh)', function(data){
            var ii = notice.msg('正在执行中..', {icon: 4, close: true});
            if(this.checked){
                $("input[name='is_gh']").val("1");
                notice.destroy();
                notice.msg('用户自助更换授权已开启！', {icon: 1});
            }else{
                $("input[name='is_gh']").val("0");
                notice.destroy();
                notice.msg('用户自助更换授权已关闭！', {icon: 1});
            }
        });
        form.on('switch(is_reg)', function(data){
            var ii = notice.msg('正在执行中..', {icon: 4, close: true});
            if(this.checked){
                $("input[name='is_reg']").val("1");
                notice.destroy();
                notice.msg('游客自助注册代理已开启！', {icon: 1});
            }else{
                $("input[name='is_reg']").val("0");
                notice.destroy();
                notice.msg('游客自助注册代理已关闭！', {icon: 1});
            }
        });
        form.on('switch(is_onlinebuy)', function(data){
            var ii = notice.msg('正在执行中..', {icon: 4, close: true});
            if(this.checked){
                $("input[name='is_onlinebuy']").val("1");
                notice.destroy();
                notice.msg('游客自助购买授权已开启！', {icon: 1});
            }else{
                $("input[name='is_onlinebuy']").val("0");
                notice.destroy();
                notice.msg('游客自助购买授权已关闭！', {icon: 1});
            }
        });
        form.on('switch(qqtz)', function(data){
            var ii = notice.msg('正在执行中..', {icon: 4, close: true});
            if(this.checked){
                $("input[name='qqtz']").val("1");
                notice.destroy();
                notice.msg('QQ跳转浏览器已开启！', {icon: 1});
            }else{
                $("input[name='qqtz']").val("0");
                notice.destroy();
                notice.msg('QQ跳转浏览器已关闭！', {icon: 1});
            }
        });
        form.on('checkbox(is_qqkuaijie)', function (data) {
            if(data.elem.checked){
                $("input[name='is_qqkuaijie']").val("1");
            }else{
                $("input[name='is_qqkuaijie']").val("0");
            }
            form.render('checkbox');
        });
        form.on('checkbox(is_qqlogin)', function (data) {
            if(data.elem.checked){
                $("input[name='is_qqlogin']").val("1");
            }else{
                $("input[name='is_qqlogin']").val("0");
            }
            form.render('checkbox');
        });
        form.on('switch(qqtz)', function(data){
            var ii = notice.msg('正在执行中..', {icon: 4, close: true});
            if(this.checked){
                $("input[name='qqtz']").val("1");
                notice.destroy();
                notice.msg('QQ跳转浏览器已开启！', {icon: 1});
            }else{
                $("input[name='qqtz']").val("0");
                notice.destroy();
                notice.msg('QQ跳转浏览器已关闭！', {icon: 1});
            }
        }); 
        form.on('switch(is_webwh)', function(data){
            var ii = notice.msg('正在执行中..', {icon: 4, close: true});
            if(this.checked){
                $("input[name='is_webwh']").val("1");
                notice.destroy();
                notice.msg('站点维护已开启！', {icon: 1});
            }else{
                $("input[name='is_webwh']").val("0");
                notice.destroy();
                notice.msg('站点维护已关闭！', {icon: 1});
            }
        }); 
        form.on('switch(is_lts)', function(data){
            var ii = notice.msg('正在执行中..', {icon: 4, close: true});
            if(this.checked){
                $("#is_frame").css("display","inherit");
                $("input[name='is_lts']").val("1");
                notice.destroy();
                notice.msg('聊天室触发违禁词秒封已开启！', {icon: 1});
            }else{
                $("#is_frame").css("display","none");
                $("input[name='is_lts']").val("0");
                notice.destroy();
                notice.msg('聊天室触发违禁词秒封已关闭！', {icon: 1});
            }
        }); 
        form.on('switch(captcha_open)', function(data){
            var ii = notice.msg('正在执行中..', {icon: 4, close: true});
            if(this.checked){
                $("input[name='captcha_open']").val("1");
                $("#captcha_frame").css("display","inherit");
                notice.destroy();
                notice.msg('滑动验证已开启！', {icon: 1});
            }else{
                $("input[name='captcha_open']").val("0");
                $("#captcha_frame").css("display","none");
                notice.destroy();
                notice.msg('滑动验证已关闭！', {icon: 1});
            }
        }); 
        laydate.render({
            elem: '#test1' //指定元素
            ,mark: {
                '0-3-15': 'SF'
            }
            ,type: 'datetime'
        });
});

function previewImg(src) {
            var imgHtml = "<img src='" +src + "' width='100%' />";
            //捕获页
            layer.open({
                type: 1,
                shade: 0.5,
                title: false, //不显示标题
                //area:['600px','500px'],
                area: ['91%',''], 
                content: imgHtml, //捕获的元素，注意：最好该指定的元素要存放在body最外层，否则可能被其它的相对元素所影响
                cancel: function () {
                    //layer.msg('捕获就是从页面已经存在的元素上，包裹layer的结构', { time: 5000, icon: 6 });
                }
            });
}
function fileSelect(){
	$("#file").trigger("click");
}
function fileView(){
    layui.use(['notice'], function(){

  var notice = layui.notice;
	var shopimg = $("input[name='img']").val();
	if(shopimg=='') {
	    notice.msg('请先上传图片，才能预览！', {icon: 2});
	//	layer.alert("请先上传图片，才能预览");
		return;
	
	}
	layer.open({
                type: 1,
                shade: 0.5,
                title: false, //不显示标题
                //area:['600px','500px'],
                area: ['91%',''], 
                content: '<img src="' +shopimg + '" width="100%"/>', //捕获的元素，注意：最好该指定的元素要存放在body最外层，否则可能被其它的相对元素所影响
                cancel: function () {
                    //layer.msg('捕获就是从页面已经存在的元素上，包裹layer的结构', { time: 5000, icon: 6 });
            }
        });
    });
}
function fileUpload(){
layui.use(['notice'], function(){

  var notice = layui.notice;
	var fileObj = $("#file")[0].files[0];
	if (typeof (fileObj) == "undefined" || fileObj.size <= 0) {
		return;
	}
	var formData = new FormData();
	formData.append("do","upload");
	formData.append("type","shop");
	formData.append("file",fileObj);
	var ii = layer.load(2, {shade:[0.1,'#fff']});
	$.ajax({
		url: "ajax.php?act=cx_uploadimg",
		data: formData,
		type: "POST",
		dataType: "json",
		cache: false,
		processData: false,
		contentType: false,
		success: function (data) {
			layer.close(ii);
			if(data.code == 0){
			    notice.msg('图片上传成功！', {icon: 1});
			//	layer.msg('上传图片成功');
				$("#shopimg").val(data.url);
			}else{
				layer.alert(data.msg);
			}
		},
		error:function(data){
		    notice.msg('服务器错误！', {icon: 2});
		//	layer.msg('服务器错误');
			return false;
		}
	})
    });
}

</script>  
<?php
    require_once 'footer.php';
?>