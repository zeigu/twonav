<?php
    require_once 'header.php';
    $templates = getTemplates();
    $countTemplate = count($templates);
?>
<!-- 正文开始 -->
<div class="layui-fluid">
    <div class="layui-card">
        <div class="layui-card-body">
        <div>
            <!-- 表格工具栏 -->
      <div class="oz-panel">
        <div class="oz-panel-head"><strong>模板列表</strong></div>
        <div class="oz-panel-body">
          <div class="oz-quote">
            共 <strong><?php echo $countTemplate; ?></strong> 个模板
            <a href="store.php" class="oz-btn oz-btn-sm oz-bg-orange">模板商店</a>
              <?php if(!checkTemplate(TEMPLATE_NAME)) {
                  echo '<strong>当前使用模板已损坏，请切换其他模板</strong>';
              } ?>
          </div>
            <?php foreach($templates as $template) {
                $using = TEMPLATE_NAME == $template['file'];
                ?>
              <div class="oz-xs-12 oz-sm-6 oz-md-4">
                <div class="template <?php echo $using ? 'active' : ''; ?>">
                  <div <?php if(!$using) {
                      echo 'onclick="changeTemplate(\'' . $template['file'] . '\')"';
                  } ?>>
                    <div class="preview">
                      <img src="<?php echo TL_URL . $template['file']; ?>/preview.jpg" alt="模板预览图">
                      <div class="more">
                        <p>版本：<?php echo $template['version']; ?></p>
                        <p>作者：<?php echo $template['author']; ?></p>
                        <p>介绍：<?php echo $template['description']; ?></p>
                      </div>
                    </div>
                    <div class="name"><?php echo $template['name']; ?></div>
                  </div>
                    <?php if(!$using) { ?>
                      <span class="delete fa fa-close fa-fw" onclick="deleteOne('template', '<?php echo $template['file']; ?>')"></span>
                      <a href="<?php echo OZDAO_URL . '?template=' . $template['file'] ?>" target="_blank" class="oz-btn oz-btn-sm oz-bg-orange template-btn">预览</a>
                      <!--                    <?php /*} else { */ ?>
                      <span class="oz-btn oz-btn-sm oz-bg-black template-btn" onclick="templateSetting('<?php /*echo $template['name']; */ ?>')">设置</span>-->
                    <?php } ?>
                </div>
              </div>
            <?php } ?>
        </div>
      </div>
    </div>
      <div class="oz-panel">
        <div class="oz-panel-head"><strong>安装模板</strong></div>
        <div class="oz-panel-body">
          <div class="oz-quote">上传一个模板文件夹至templates即可（自行适配）</div>

        </div>
      </div>
    </div>
  </div>
<?php
    require_once 'footer.php';
?>