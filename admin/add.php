<?php
    require_once 'header.php';
?>
<div class="container-fluid p-t-15">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <ul class="nav nav-tabs page-tabs">
          <li class="active"> <a href="#!">其他广告配置</a> </li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active">
        
            <form id="config-edit" method="post" onsubmit="return false" class="edit-form">

              <div class="form-group">
                <label for="web_site_description">首页文字广告[html]</label>
                <textarea class="form-control" name="indexwzgg" rows="5" onkeydown="tab(this)"  placeholder="请输入HTML超链接 如：&lt;a href=&quot;//dhceo.net&quot; target=&quot;_blank&quot;&gt;总裁&lt;/a&gt;" ><?php echo $CONFIG['indexwzgg']; ?></textarea>
                <small class="help-block">首页的文字广告</small>
              </div>

              <div class="form-group">
                <label for="web_site_description">站点内页文字广告[html]</label>
                <textarea class="form-control" name="sitewzgg" rows="5" onkeydown="tab(this)"  placeholder="请输入HTML超链接 如：&lt;a href=&quot;//dhceo.net&quot; target=&quot;_blank&quot;&gt;总裁&lt;/a&gt;" ><?php echo $CONFIG['sitewzgg']; ?></textarea>
                <small class="help-block">站点内页的文字广告</small>
              </div>
           
              <div class="form-group">
                <label for="web_site_description">文章内页文字广告[html]</label>
                <textarea class="form-control" name="postwzgg" rows="5" onkeydown="tab(this)"  placeholder="请输入HTML超链接 如：&lt;a href=&quot;//dhceo.net&quot; target=&quot;_blank&quot;&gt;总裁&lt;/a&gt;" ><?php echo $CONFIG['postwzgg']; ?></textarea>
                <small class="help-block">文章内页的文字广告</small>
              </div>

              <div class="form-group">
                <label for="web_site_description">首页侧边栏广告[html]</label>
                <textarea class="form-control" name="indexsider" rows="5"  placeholder="请输入HTML广告" ><?php echo $CONFIG['indexsider']; ?></textarea>
                <small class="help-block">网站侧边栏广告</small>
              </div>
              
              <div class="form-group">
                <label for="web_site_description">站点/文章分类侧边栏广告[html]</label>
                <textarea class="form-control" name="sortsider" rows="5"  placeholder="请输入HTML广告" ><?php echo $CONFIG['sortsider']; ?></textarea>
                <small class="help-block">站点/文章分类侧边栏广告</small>
              </div>
              
              <div class="form-group">
                <label for="web_site_description">文章内页侧边栏广告[html]</label>
                <textarea class="form-control" name="postsider" rows="5"  placeholder="请输入HTML广告" ><?php echo $CONFIG['postsider']; ?></textarea>
                <small class="help-block">文章内页侧边栏广告[html]</small>
              </div>
              
              <div class="form-group">
                <button type="submit" class="btn btn-label btn-primary" onclick="editConfig()"><label><i class="mdi mdi-checkbox-marked-circle-outline"></i></label>保 存 配 置</button>
              </div>
            </form>
            
          </div>
        </div>

      </div>
    </div>
    
  </div>
  
</div>
<script>
function tab(obj){
  if (event.keyCode == 9)
  {
     obj.value = obj.value + "  "; // 跳几格由你自已决定
     event.returnValue = false;
  }
}
</script>
<?php
    require_once 'footer.php';
?>