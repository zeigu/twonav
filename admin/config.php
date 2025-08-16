<?php
    require_once 'header.php';
?>
<div class="container-fluid p-t-15">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <ul class="nav nav-tabs page-tabs">
          <li class="active"> <a href="#!">网站基本配置</a> </li>
          <li> <a href="show.php">网站显示配置</a> </li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active">
            
            <form id="config-edit" method="post" onsubmit="return false" class="edit-form">
              <div class="form-group">
                <label for="web_site_title">网站名称</label>
                <input class="form-control" type="text" value="<?php echo $CONFIG['name']; ?>" name="name" placeholder="请输入网站名称" >
              </div>

              <div class="form-group">
                <label for="web_site_title">网站副标题</label>
                <input class="form-control" type="text" value="<?php echo $CONFIG['title']; ?>" name="title" placeholder="请输入网站副标题" >
              </div>

              <div class="form-group">
                <label for="web_site_title">关键词</label>
                <input class="form-control" type="text" value="<?php echo $CONFIG['keywords']; ?>" name="keywords" placeholder="请输入网站关键词" >
              </div>
              
              <div class="form-group">
                <label for="web_site_description">网站描述</label>
                <textarea class="form-control" name="description" rows="5"  placeholder="请输入网站描述" ><?php echo $CONFIG['description']; ?></textarea>
                <small class="help-block">网站描述，有利于搜索引擎抓取相关信息</small>
              </div>

              <div class="form-group">
                <label for="web_site_title">建站时间</label>
                <input class="form-control" type="date" value="<?php echo date('Y-m-d', $CONFIG['time']); ?>" id="time" placeholder="请输入建站时间" >
              </div>              

              <div class="form-group">
                <label for="web_site_title">备案号</label>
                <input class="form-control" type="text" value="<?php echo $CONFIG['icp']; ?>" name="icp" placeholder="请输入ICP备案号" >
              </div>
              
              <div class="form-group">
                <label for="web_site_title">首页音乐KEY[注册地址<b>https://myhkw.cn/</b>]</label>
                <input class="form-control" type="text" value="<?php echo $CONFIG['musickey']?>" name="musickey" placeholder="不填则不播放" >
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
<?php
    require_once 'footer.php';
?>
