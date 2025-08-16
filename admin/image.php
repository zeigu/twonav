<?php
    $title = '通用图片';
    require_once 'header.php';
?>
<div class="container-fluid p-t-15">
  
  <div class="row">
    <div class="col-md-12">
        
      <div class="card">
        <div class="card-header"><h4>favicon图标上传</h4></div>
        <div class="card-body">
          <form class="form-horizontal" method="post" onsubmit="return false">
            <div class="form-group">
              <label class="col-xs-12"  onchange="selectFile(this, 'img')">选择favicon图片</label>
              <div class="col-xs-12 img-upload">
                <input type="file" name="favicon" id="favicon">
              </div>
            </div>
            <div class="form-group">
              <div class="col-xs-12">
                <button type="submit" class="btn btn-label btn-primary" onclick="uploadFile('favicon')"><label><i class="mdi mdi-checkbox-marked-circle-outline"></i></label>开 始 上 传</button>
              </div>
            </div>
          </form>
          <br>
          当前favicon图标：
          <button type="button" class="oz-btn oz-btn-sm oz-bg-black" onclick="imgPopup('favicon图标', '<?php echo OZDAO_URL; ?>favicon.ico?'+Math.random())">点击查看</button>
        </div>
      </div>

      <div class="card">
        <div class="card-header"><h4>logo上传</h4></div>
        <div class="card-body">
          <form class="form-horizontal" method="post" onsubmit="return false">
            <div class="form-group">
              <label class="col-xs-12"  onchange="selectFile(this, 'img')">选择logo图片</label>
              <div class="col-xs-12">
                <input type="file" name="logo" id="logo">
              </div>
            </div>
            <div class="form-group">
              <div class="col-xs-12">
                <button type="submit" class="btn btn-label btn-primary" onclick="uploadFile('logo')"><label><i class="mdi mdi-checkbox-marked-circle-outline"></i></label>开 始 上 传</button>
              </div>
            </div>
          </form>
          <br>
          当前logo图片：
          <button type="button" class="oz-btn oz-btn-sm oz-bg-black" onclick="imgPopup('logo', '<?php echo IMAGES_URL; ?>logo.png?'+Math.random())">点击查看</button>
        </div>
      </div>

      <div class="card">
        <div class="card-header"><h4>banner图上传</h4></div>
        <div class="card-body">
          <form class="form-horizontal" method="post" onsubmit="return false">
            <div class="form-group">
              <label class="col-xs-12"  onchange="selectFile(this, 'img')">选择banner图片</label>
              <div class="col-xs-12">
                <input type="file" name="logo" id="logo">
              </div>
            </div>
            <div class="form-group">
              <div class="col-xs-12">
                <button type="submit" class="btn btn-label btn-primary" onclick="uploadFile('banner')"><label><i class="mdi mdi-checkbox-marked-circle-outline"></i></label>开 始 上 传</button>
              </div>
            </div>
          </form>
          <br>
          当前banner图片：
          <button type="button" class="oz-btn oz-btn-sm oz-bg-black" onclick="imgPopup('banner图', '<?php echo IMAGES_URL; ?>banner.jpg?'+Math.random())">点击查看</button>
        </div>
      </div>
 
      <div class="card">
        <div class="card-header"><h4>loading图上传</h4></div>
        <div class="card-body">
          <form class="form-horizontal" method="post" onsubmit="return false">
            <div class="form-group">
              <label class="col-xs-12"  onchange="selectFile(this, 'img')">选择loading图片</label>
              <div class="col-xs-12">
                <input type="file" name="logo" id="logo">
              </div>
            </div>
            <div class="form-group">
              <div class="col-xs-12">
                <button type="submit" class="btn btn-label btn-primary" onclick="uploadFile('loading')"><label><i class="mdi mdi-checkbox-marked-circle-outline"></i></label>开 始 上 传</button>
              </div>
            </div>
          </form>
          <br>
          当前loading图片：
          <button type="button" class="oz-btn oz-btn-sm oz-bg-black" onclick="imgPopup('loading图', '<?php echo IMAGES_URL; ?>loading.gif?'+Math.random())">点击查看</button>
        </div>
      </div>
      
    </div>
  </div>
</div>
<?php
    require_once 'footer.php';
?>