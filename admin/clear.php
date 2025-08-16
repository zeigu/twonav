<?php
    $title = '垃圾清理';
    require_once 'header.php';
?>

<!-- 正文开始 -->
<div class="layui-fluid">
    <div class="layui-card">
        <div class="layui-card-body">
        <div>
            <!-- 表格工具栏 -->
      <div class="oz-panel">
        <div class="oz-panel-head"><strong>站点ico图标</strong></div>
        <div class="oz-panel-body">
          <p>开启站点ico图标本地化后下载到本地的ico图标。</p>
          <p>具体路径为：<?php echo IMAGES_PATH; ?>ico/</p>
          <p>点击清除将删除该目录下所有文件！</p>
            <div class="form-group">
                <button type="submit" class="btn btn-label btn-primary" onclick="clearCache('ico')"><label><i class="mdi mdi-checkbox-marked-circle-outline"></i></label>立 即 清 理</button>
              </div>
        </div>
      </div>
    </div>
  </div>

<?php
    require_once 'footer.php';
?>