<?php
    require_once 'header.php';
?>
<div class="container-fluid p-t-15">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <ul class="nav nav-tabs page-tabs">
          <li class="active"> <a class="active"href="#">链接推送配置</a> </li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active">
            
            <form action="#!" id="config-edit" method="post" onsubmit="return false" class="edit-form">
          <div class="oz-quote">
                     温馨提示：如需开启智能推送
              <span class="oz-tooltip oz-tooltip-down" oz-title="当站点/文章的链接变动后自动推送">
                <i class="fa fa fa-question-circle"></i>
              </span>
              ，需要监听以下链接（建议12小时一次）：
              <p>
                <a href="<?php echo OZDAO_URL; ?>cron.php?key=<?php echo $CONFIG['cronKey']; ?>" target="_blank">
                    <?php echo OZDAO_URL; ?>cron.php?key=<?php echo $CONFIG['cronKey']; ?>
                </a>
              </p>
            </div>

              <div class="form-group">
                <label for="web_site_title">百度推送Token</label>
                <input class="form-control" type="text" value="<?php echo $CONFIG['baiduToken']; ?>" name="baiduToken"  placeholder="请输入百度推送Token" >
              </div> 

              <div class="form-group">
                <label for="web_site_title">熊掌AppId</label>
                <input class="form-control" type="text" value="<?php echo $CONFIG['bearPawAppId']; ?>" name="bearPawAppId"  placeholder="请输入熊掌AppId" >
              </div> 

              <div class="form-group">
                <label for="web_site_title">熊掌Token</label>
                <input class="form-control" type="text" value="<?php echo $CONFIG['bearPawToken']; ?>" name="bearPawToken"  placeholder="请输入熊掌Token" >
              </div> 

              <div class="form-group">
                <label for="web_site_title">监听密钥</label>
                <input class="form-control" type="text" value="<?php echo $CONFIG['cronKey']; ?>" name="cronKey"  placeholder="请输入监听密钥" >
              </div> 
              
              <div class="form-group">
                <button type="submit" class="btn btn-label btn-primary" onclick="editConfig()"><label><i class="mdi mdi-checkbox-marked-circle-outline"></i></label>保 存 配 置</button>
              </div>
            </form>
            
            
              <div class="form-group">
                <label for="web_site_description">批量推送</label>
                <form id="config-edit" method="post" onsubmit="return false">
                <textarea class="form-control" name="description" rows="11" placeholder="请输入完整链接[一行一个]" id="url" ></textarea>
              </div>
              <button type="submit" class="oz-btn oz-bg-blue" onclick="batchPush('baidu')">推送百度</button>
            <button type="submit" class="oz-btn oz-bg-pink" onclick="batchPush('bearPaw')">推送熊掌</button>
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