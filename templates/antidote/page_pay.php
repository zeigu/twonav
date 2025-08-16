<?php  require_once('sousuo.php'); ?>
<div class="container">
  <div class="card board">
    <span class="icon"><i class="fa fa-map-signs fa-fw"></i></span>
      <?php echoBoard($page['title']); ?>
  </div>
<div class="card">
<div class="card-head">
<i class="fa fa-bookmark" aria-hidden="true"></i>共计收录：<font color="red"><?php echo $DATA->getCount('site'); ?></font> - 待审网站：<font color="red"><?php echo $DATA->getCount('apply'); ?></font></a>	  
      </div>
        </div>
  <div class="card">
    <div class="card-head"><i class="fa fa-plus-square fa-fw"></i><?php echo $page['title']; ?></div>
    <div class="card-body content">
        <?php echo $page['content']; ?>
      <form  method="post" action="/epay.php" style="margin-top: 8px">
        <div class="oz-xs-12 oz-sm-6 oz-form-group">
          <label class="oz-form-label">商户订单</label>
          <label class="oz-form-field">
            <input type="text" name="WIDout_trade_no" id="WIDout_trade_no" placeholder="" value="<?php echo date("YmdHis").mt_rand(100,999); ?>"  class="layui-input">
          </label>
        </div>
              
        <div class="oz-xs-12 oz-sm-6 oz-form-group">
          <label class="oz-form-label">广告类型</label>
          <label class="oz-form-field">
            <select name="sortId" id="sortId">
                <option value="0">请选择要购买的广告分类[必选]</option>
                <option value="1">首页置顶站点 - <?php echo $CONFIG['zhiding_money']; ?>/月</option>
                <option value="2">首页图片广告 - <?php echo $CONFIG['list_money']; ?>/月</option>
                <option value="3">文章内页广告 - <?php echo $CONFIG['page_money']; ?>/月</option>
                <option value="4">详情图片广告 - <?php echo $CONFIG['site_money']; ?>/月</option>
            </select>
          </label>
        </div>
        
        <div class="oz-xs-12 oz-sm-6 oz-form-group">
          <label class="oz-form-label">站长ＱＱ</label>
          <label class="oz-form-field">
            <input type="text" name="qq" id="qq" placeholder="请输入站长QQ号[选填]" class="layui-input">
          </label>
        </div>
         <div class="oz-xs-12 oz-sm-6 oz-form-group" id="tu">
          <label class="oz-form-label">图片地址</label>
          <label class="oz-form-field">
            <input type="text" name="tu_url" id="tu_url" placeholder="请输入广告的图片地址" class="layui-input">
          </label>
        </div>
        <div class="oz-xs-12 oz-sm-6 oz-form-group">
          <label class="oz-form-label">跳转链接</label>
          
          <label class="oz-form-field">
            <input type="text" name="domain" id="domain" placeholder="请输入站点域名,需带http或https[必填]" class="layui-input">
          </label>
        </div>  
        <div class="oz-xs-12 oz-sm-6 oz-form-group">
          <label class="oz-form-label">支付方式</label>
          <label class="oz-form-field">
            <select name="type" id="type">
                <option value="wxpay">微信支付</option>
                <option value="alipay">支付宝</option>
                <option value="qqpay">QQ钱包</option>
            </select>
          </label>
        </div>
        <div class="oz-xs-12 oz-sm-6 oz-form-group">
          <label class="oz-form-label">购买时间</label>
          <label class="oz-form-field">
            <input type="text" name="num" id="num" placeholder="请输入要购买的时长（月）" value="1" class="layui-input">
          </label>
        </div>
        <div class="oz-center" style="margin-bottom: 8px">
          <button class="oz-btn oz-bg-blue" type="submit" style="margin-right: 10px">
            <i class="fa fa-telegram fa-fw" aria-hidden="true"></i> 立即购买
          </button>
          <button class="oz-btn oz-bg-red" type="reset"><i class="fa fa-refresh fa-fw" aria-hidden="true"></i>
            重置输入
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php
    include View::getView('footer');
?>
<script>
    $("#sortId").bind("change",function(){
            var sortId = $(this).val();
            if(sortId==1){
                $("#tu").hide();
            }else{
                $("#tu").show();
            }
        });

</script>