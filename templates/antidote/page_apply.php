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
        <!--p><img src="https://www.hlapi.cn/api/ipqm" title="访问IP签名档" alt="访问IP签名档"></p-->
<!--p><strong>将以下代码放在你的网站底部即可自动过审：</strong></p>
<p><strong><font color="red">&lt;a href="<?php echo OZDAO_URL; ?>" target="_blank"&gt;<?php echo $CONFIG['name']; ?>&lt;/a&gt;</font></strong></p-->
<p><strong>因近期有人恶意提交 所以关闭免审通道 全部转人工审核 严格把控每一个站点</strong></p>
<p><strong><font color="red">审核时间22:00审核上一天申请的 22:00之后的需等第二天审核</font></strong></p>
<p><strong>申请收录条件：</strong></p>
<p><strong>1、贵站必须是正规网站，不能含有反动、色情、赌博等不良内容的网站。</strong></p>
<p><strong>2、本站不收录在正常情况下无法正常连接或打开时间太长的网站。</strong></p>
<p><strong>3、本站会不定期检查所有网站，如发现收录的网站违背我们的收录标准，我们将删除链接。</strong></p>
<p><strong>4、代刷网等一切盈利类网站请走文字广告、图片广告。</strong></p>
        <?php echo $page['content']; ?>
      <form id="apply-add" method="post" onsubmit="return false" style="margin-top: 8px">
        <div class="oz-xs-12 oz-sm-6 oz-form-group">
          <label class="oz-form-label">网站名称</label>
          <label class="oz-form-field">
            <input type="text" name="name" id="name" placeholder="请输入站点名称[必填] 如:总裁" class="layui-input">
          </label>
        </div>
        <div class="oz-xs-12 oz-sm-6 oz-form-group">
          <label class="oz-form-label">网站域名</label>
          <label class="oz-form-field">
            <select name="protocol" id="protocol">
              <option value="http://">http://</option>
              <option value="https://">https://</option>
            </select>
          </label>
          <label class="oz-form-field">
            <input type="text" name="domain" id="domain" placeholder="请输入站点域名[必填]" class="layui-input">
          </label>
        </div>        
        <div class="oz-xs-12 oz-sm-6 oz-form-group">
          <label class="oz-form-label">网站分类</label>
          <label class="oz-form-field">
            <select name="sortId" id="sortId">
              <option value="">请选择站点分类[必选]</option>
                <?php
                    $sorts = $DATA->getSiteSorts();
                    foreach($sorts as $sort) { ?>
                      <option value="<?php echo $sort['id']; ?>"><?php echo $sort['name']; ?></option>
                    <?php } ?>
            </select>
          </label>
        </div>
        <div class="oz-xs-12 oz-sm-6 oz-form-group">
          <label class="oz-form-label">站长ＱＱ</label>
          <label class="oz-form-field">
            <input type="text" name="qq" id="qq" placeholder="请输入站长QQ号[选填]" class="layui-input">
          </label>
        </div>
        <div class="oz-xs-12 oz-sm-6 oz-form-group">
          <label class="oz-form-label">&nbsp;验 证 码&nbsp;</label>
          <label class="oz-form-field" style="flex: auto;">
            <input type="text" name="captcha" id="captcha" placeholder="请输入验证码[必填]" class="layui-input">
          </label>&nbsp;&nbsp;
          <img id="captchaImage" src="<?php echo OZDAO_URL; ?>include/captcha.php" onclick="this.src='<?php echo OZDAO_URL; ?>include/captcha.php?'+Math.random();" alt="">
        </div>
        <div class="oz-center" style="margin-bottom: 8px">
          <button class="oz-btn oz-bg-blue" type="submit" onclick="addApply()" style="margin-right: 10px">
            <i class="fa fa-telegram fa-fw" aria-hidden="true"></i> 立即提交
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