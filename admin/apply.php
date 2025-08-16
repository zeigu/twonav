<?php
    $title = '站点申请';
    require_once 'header.php';
    $pageSize = !empty($_GET['size']) ? $_GET['size'] : 10;
    $nowPage = !empty($_GET['page']) ? $_GET['page'] : 1;
    $startNum = ($nowPage - 1) * $pageSize;
    $applies = $DATA->getApplies($pageSize, $startNum);
?>

<!-- 正文开始 -->
<div class="layui-fluid">
    <div class="layui-card">
        <div class="layui-card-body">
            <!-- 表格工具栏 -->
<div class="oz-quote wrap-option">
          <div>
                      共 <strong><?php echo $countApply; ?></strong> 条申请
            <a href="site.php" class="oz-btn oz-btn-sm oz-bg-orange">查看站点</a>
          </div>
          <div style="margin-left: 15px;">
            <button type="button" class="oz-btn oz-btn-sm oz-bg-green" onclick="passApply()">通过</button>
            <button type="button" class="oz-btn oz-btn-sm oz-bg-red" onclick="batchDelete('<?php echo TABLE_NAV; ?>')">删除</button>
          </div>
        </div>
        <form id="batch" method="post" onsubmit="return false">
          <div class="oz-table-fluid">
            <table class="oz-table">
              <thead>
              <tr>
                <th style="width: 5%;text-align: center;">
                  <label>
                    <input type="checkbox" onclick="selectAll(this)">
                  </label>
                </th>
                <th style="width: 30%;text-align: center;">名称</th>
                <th style="width: 5%;text-align: center;">缩略图</th>
                <th style="width: 15%;text-align: center;">分类</th>
                <th style="width: 5%;text-align: center;">QQ</th>
                <th style="width: 20%;text-align: center;">时间</th>
                <th style="width: 20%;text-align: center;">操作</th>
              </tr>
              </thead>
              <tbody>
              <?php foreach($applies as $apply) {
                  $sortName = $DATA->getByKey(TABLE_SORT, 'name', 'id', $apply['sortId']);
                  ?>
                <tr>
                  <td>
                    <div id="data-<?php echo $apply['id']; ?>" style="display: none;">
                        <?php echo json_encode($apply, 320); ?>
                    </div>
                    <label>
                      <input type="checkbox" name="id[]" value="<?php echo $apply['id']; ?>">
                    </label>
                  </td>
                  <td>
                    <a href="<?php echo $apply['url']; ?>" target="_blank" class="oz-tooltip oz-tooltip-up" oz-title="<?php echo $apply['url']; ?>">
                        <?php echo $apply['name']; ?>
                    </a>
                  </td>
                  <td>
                    <button type="button" class="oz-btn oz-btn-xs oz-bg-black" onclick="imgPopup('缩略图 [<?php echo $apply['name']; ?>]', '<?php echo 'https://mini.s-shot.ru/1024x768/PNG/800/?' . $apply['url'] ?>')">查看</button>
                  </td>
                  <td>
                    <a href="site.php?sortId=<?php echo $apply['sortId']; ?>">
                        <?php echo $sortName; ?>
                    </a>
                  </td>
                  <td>
                    <a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $apply['qq']; ?>&site=qq&menu=yes" target="_blank" class="oz-tooltip oz-tooltip-up" oz-title="<?php echo $apply['qq']; ?>">
                      <i class="fa fa-qq fa-fw" aria-hidden="true"></i>
                    </a>
                  </td>
                  <td><?php echo date('Y-m-d H:i:s', $apply['time']); ?></td>
                  <td>
                    <button type="button" class="oz-btn oz-btn-xs oz-bg-green" onclick="passApply(<?php echo $apply['id'] ?>)">通过</button>
                    <button type="button" class="oz-btn oz-btn-xs oz-bg-blue" onclick="editPopup('审核站点申请', '<?php echo TABLE_APPLY; ?>', <?php echo $apply['id'] ?>)">审核</button>
                    <button type="button" class="oz-btn oz-btn-xs oz-bg-red" onclick="deleteOne('<?php echo TABLE_APPLY; ?>', <?php echo $apply['id'] ?>)">删除</button>
                  </td>
                </tr>
              <?php } ?>
              </tbody>
            </table>
          </div>
        </form>
          <?php echo paging($countApply, $nowPage, $pageSize); ?>
      </div>
    </div>
  </div>

  <div class="popup" id="edit-popup">
    <div class="oz-quote">
      <p>温馨提示：别名必须以字母开头，可包含字母、数字和下划线</p>
    </div>
    <form id="site-add" method="post" onsubmit="return false">
      <label for="id">
        <input type="text" name="id" id="id" hidden>
      </label>
        <?php if($CONFIG['order'] == 'lid asc' && $CONFIG['order'] == 'lid desc') { ?>
          <div class="oz-form-group">
            <span class="oz-form-label">序号</span>
            <label class="oz-form-field">
              <input type="text" placeholder="请输入站点序号[必填，只能填数字]" name="serial" id="serial">
            </label>
          </div>
        <?php } ?>
      <div class="oz-form-group">
        <span class="oz-form-label">链接</span>
        <label class="oz-form-field">
          <select name="protocol" id="protocol">
            <option value="http://">http://</option>
            <option value="https://">https://</option>
          </select>
        </label>
        <label class="oz-form-field">
          <input type="text" placeholder="请输入站点域名[必填]" name="domain" id="domain">
        </label>
      </div>
       <div class="oz-form-group">
        <label class="oz-form-field">
          <input type="button" class="oz-btn oz-bg-green" value="本窗口查看站点" onclick="OpenUrl()" />
        </label>
      </div>
      <div class="oz-form-group">
        <label class="oz-form-field">
          <input type="button" class="oz-btn oz-bg-blue" value="新窗口查看站点" onclick="NewOpenUrl()" />
        </label>
      </div>      
<script type="text/javascript">
function OpenUrl() {
   var URL = document.getElementById("domain").value;
    location.href = `https://${URL}`;
}

function NewOpenUrl() {
   var URL = document.getElementById("domain").value;
    window.open('http://' + URL) ;
}
</script>     
      
      <div class="oz-form-group">
        <span class="oz-form-label">名称</span>
        <label class="oz-form-field">
          <input type="text" placeholder="请输入站点名称[必填]" name="name" id="name">
        </label>
      </div>
      <div class="oz-form-group">
        <span class="oz-form-label">分类</span>
        <label class="oz-form-field">
          <select name="sortId" id="sortId">
            <option value="">请选择站点分类[必选]</option>
              <?php
                  $sorts = $DATA->getSiteSorts();
                  foreach($sorts as $sort) {
                      ?>
                    <option value="<?php echo $sort['id']; ?>"><?php echo $sort['name']; ?></option>
                  <?php } ?>
          </select>
        </label>
      </div>
      <div class="oz-form-group">
        <span class="oz-form-label">Q Q</span>
        <label class="oz-form-field">
          <input type="text" placeholder="请输入站长QQ号[非必填]" name="qq" id="qq">
        </label>
      </div>
      <div class="oz-form-group">
        <span class="oz-form-label">别名</span>
        <label class="oz-form-field">
          <input type="text" placeholder="请输入链接别名[非必填]" name="alias" id="alias">
        </label>
      </div>
      <div class="oz-form-group">
        <span class="oz-form-label">置顶</span>
        <label class="oz-form-field">
          <select name="top" id="top">
            <option value="0">否</option>
            <option value="1">是</option>
          </select>
        </label>
      </div>
      <div class="oz-center">
        <button type="button" class="oz-btn" onclick="infoPopup('填写更多信息')">更多信息</button>
        <button type="submit" class="oz-btn oz-bg-blue" style="width: 50%;" onclick="addSite()">修改并通过审核</button>
      </div>
    </form>
  </div>

  <div class="popup" id="info-popup">
    <div class="oz-quote">
      <p>温馨提示：以下信息必须在上一个弹窗填写域名后才可一键获取。</p>
    </div>
    <form id="site-info" method="post" onsubmit="return false">
      <div class="oz-form-group">
        <span class="oz-form-label">图标</span>
        <label class="oz-form-field">
          <input type="text" placeholder="请输入ico图标链接[非必填]" name="ico" id="info-ico">
        </label>
        <span class="oz-form-label" style="width: 36px; padding: 3px;">
          <img id="info-ico-show" src="" alt="">
        </span>
      </div>
      <div class="oz-form-group">
        <span class="oz-form-label">标题</span>
        <label class="oz-form-field">
          <input type="text" placeholder="请输入站点标题[非必填]" name="title" id="info-title">
        </label>
      </div>
      <div class="oz-form-group oz-form-textarea">
        <span class="oz-form-label">关键词</span>
        <label class="oz-form-field">
          <textarea rows="1" placeholder="请输入站点关键词[非必填]" name="keywords" id="info-keywords"></textarea>
        </label>
      </div>
      <div class="oz-form-group oz-form-textarea">
        <span class="oz-form-label">描述</span>
        <label class="oz-form-field">
          <textarea rows="2" placeholder="请输入站点描述[非必填]" name="description" id="info-description"></textarea>
        </label>
      </div>
      <div class="oz-form-group">
        <span class="oz-form-label">备案号</span>
        <label class="oz-form-field">
          <input type="text" placeholder="请输入站点备案号[非必填]" name="icp" id="info-icp">
        </label>
      </div>
      <div class="oz-center">
        <button type="submit" class="oz-btn oz-bg-orange" id="getInfo-btn" onclick="getSiteInfo()">一键获取</button>
        <button type="submit" class="oz-btn oz-bg-blue" style="width: 50%;" id="saveInfo-btn" onclick="closePopup()">确定</button>
      </div>
    </form>
  </div>

<?php
    require_once 'footer.php';
?>