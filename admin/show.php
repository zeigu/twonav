<?php
    require_once 'header.php';
?>
<div class="container-fluid p-t-15">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <ul class="nav nav-tabs page-tabs">
          <li> <a href="config.php">网站基本配置</a> </li>
          <li class="active"> <a href="#!">网站显示配置</a> </li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active">
            
            <form action="#!" id="config-edit" method="post" onsubmit="return false" class="edit-form">
              <div class="form-group">
                <label for="web_site_title">首页示站点分类显数量</label>
                <input class="form-control" type="number" value="<?php echo $CONFIG['number']; ?>" name="number" id="number" placeholder="不限制数量可留空" >
              </div> 
 
               <div class="form-group">
                <label for="web_site_title">分类页每页显示站点数量</label>
                <input class="form-control" type="number" value="<?php echo $CONFIG['sitePaging']; ?>" name="sitePaging" id="sitePaging" placeholder="不限制数量可留空" >
              </div> 

               <div class="form-group">
                <label for="web_site_title">分类页每页显示文章数量</label>
                <input class="form-control" type="number" value="<?php echo $CONFIG['postPaging']; ?>" name="postPaging" id="postPaging" placeholder="不限制数量可留空" >
              </div> 
 
                <div class="form-group">
                <label for="web_site_title">每次刷新或点击增加浏览数</label>
                <input class="form-control" type="number" value="<?php echo $CONFIG['viewNum']; ?>" id="viewNum" placeholder="请输入每次刷新或点击增加浏览数" >
              </div>

                <div class="form-group">
                <label for="web_site_title">站点缩略图接口</label>
                <input class="form-control" type="text" value="<?php echo $CONFIG['snapshot']; ?>" name="snapshot" id="snapshot" placeholder="请输入站点缩略图接口" >
              </div>
              
              <div class="form-group">
                <label for="develop_mode">申请收录</label>
                <div class="controls-box">
                  <label class="lyear-radio radio-inline radio-primary">
                    <input type="radio" name="apply" value="0" <?php echo $CONFIG['apply'] == '0' ? 'checked' : ''; ?>><span>关闭</span>
                  </label>
                  <label class="lyear-radio radio-inline radio-primary">
                    <input type="radio" name="apply" value="1" <?php echo $CONFIG['apply'] == '1' ? 'checked' : ''; ?>><span>开启</span>
                  </label>
                </div>
              </div>
              
              <div class="form-group">
                <label for="develop_mode">链接跳转页</label>
                <div class="controls-box">
                  <label class="lyear-radio radio-inline radio-primary">
                    <input type="radio" name="goto" value="0" <?php echo $CONFIG['goto'] == '0' ? 'checked' : ''; ?>><span>关闭</span>
                  </label>
                  <label class="lyear-radio radio-inline radio-primary">
                    <input type="radio" name="goto" value="1" <?php echo $CONFIG['goto'] == '1' ? 'checked' : ''; ?>><span>开启</span>
                  </label>
                </div>
              </div>

              <div class="form-group">
                <label for="develop_mode">站点详情页</label>
                <div class="controls-box">
                  <label class="lyear-radio radio-inline radio-primary">
                    <input type="radio" name="detail" value="0" <?php echo $CONFIG['detail'] == '0' ? 'checked' : ''; ?>><span>关闭</span>
                  </label>
                  <label class="lyear-radio radio-inline radio-primary">
                    <input type="radio" name="detail" value="1" <?php echo $CONFIG['detail'] == '1' ? 'checked' : ''; ?>><span>开启</span>
                  </label>
                </div>
              </div>

              <div class="form-group">
                <label for="develop_mode">自动检测外链审核</label>
                <div class="controls-box">
                  <label class="lyear-radio radio-inline radio-primary">
                    <input type="radio" name="autoPass" value="0" <?php echo $CONFIG['autoPass'] == '0' ? 'checked' : ''; ?>><span>关闭</span>
                  </label>
                  <label class="lyear-radio radio-inline radio-primary">
                    <input type="radio" name="autoPass" value="1" <?php echo $CONFIG['autoPass'] == '1' ? 'checked' : ''; ?>><span>开启</span>
                  </label>
                </div>
              </div>

              <div class="form-group">
                <label for="develop_mode">站点ICO图标本地化</label>
                <div class="controls-box">
                  <label class="lyear-radio radio-inline radio-primary">
                    <input type="radio" name="saveIco" value="0" <?php echo $CONFIG['saveIco'] == '0' ? 'checked' : ''; ?>><span>关闭</span>
                  </label>
                  <label class="lyear-radio radio-inline radio-primary">
                    <input type="radio" name="saveIco" value="1" <?php echo $CONFIG['saveIco'] == '1' ? 'checked' : ''; ?>><span>开启</span>
                  </label>
                </div>
              </div>
              
              <div class="form-group">
                <label for="develop_mode">站点排序方式</label>
                <div class="controls-box" style="line-height:30px">
            <label class="lyear-radio radio-inline radio-primary">
              <input type="radio" name="order" value="id DESC" <?php echo $CONFIG['order'] == 'id DESC' ? 'checked' : ''; ?>> <span>按添加先后</span>
            </label>
            <label class="lyear-radio radio-inline radio-primary">
              <input type="radio" name="order" value="dayView DESC" <?php echo $CONFIG['order'] == 'dayView DESC' ? 'checked' : ''; ?>> <span>按日浏览数</span>
            </label>
            <label class="lyear-radio radio-inline radio-primary">
              <input type="radio" name="order" value="monthView DESC" <?php echo $CONFIG['order'] == 'monthView DESC' ? 'checked' : ''; ?>> <span>按月浏览数</span>
            </label>
            <label class="lyear-radio radio-inline radio-primary">
              <input type="radio" name="order" value="totailView DESC" <?php echo $CONFIG['order'] == 'totailView DESC' ? 'checked' : ''; ?>> <span>按总浏览数</span>
            </label>
            <label class="lyear-radio radio-inline radio-primary">
              <input type="radio" name="order" value="love DESC" <?php echo $CONFIG['order'] == 'love DESC' ? 'checked' : ''; ?>> <span>按点赞数量</span>
            </label>
            <label class="lyear-radio radio-inline radio-primary">
              <input type="radio" name="order" value="rand()" <?php echo $CONFIG['order'] == 'rand()' ? 'checked' : ''; ?>> <span>按随机显示</span>
            </label>
            <label class="lyear-radio radio-inline radio-primary">
              <input type="radio" name="order" value="serial DESC" <?php echo $CONFIG['order'] == 'serial DESC' ? 'checked' : ''; ?>> <span>按序号正序</span>
            </label>
            <label class="lyear-radio radio-inline radio-primary">
               <input type="radio" name="order" value="id DESC" <?php echo $CONFIG['order'] == 'id DESC' ? 'checked' : ''; ?>> <span>按序号倒序</span>
            </label>
                </div>
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