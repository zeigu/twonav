<?php
    $title = '公告管理';
    require_once 'header.php';
    $countNotice = $DATA->getCount(TABLE_NOTICE);
    $pageSize = !empty($_GET['size']) ? $_GET['size'] : 10;
    $nowPage = !empty($_GET['page']) ? $_GET['page'] : 1;
    $startNum = ($nowPage - 1) * $pageSize;
    $notices = $DATA->getNotices($pageSize, $startNum);
?>

<!-- 正文开始 -->
<div class="layui-fluid">
    <div class="layui-card">
        <div class="layui-card-body">
            <!-- 表格工具栏 -->
<div class="oz-quote wrap-option">
          <div>
                      共 <strong><?php echo $countNotice; ?></strong> 条公告
            <button type="button" class="oz-btn oz-btn-sm oz-bg-orange" onclick="addPopup('发布公告')">发布公告</button>
          </div>
          <div style="margin-left: 15px;">
            <button type="button" class="oz-btn oz-btn-sm oz-bg-red" onclick="batchDelete('<?php echo TABLE_NOTICE; ?>')">删除</button>
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
                <th style="width: 60%; min-width: 400px;text-align: center;">公告内容</th>
                <th style="width: 20%;text-align: center;">时间</th>
                <th style="width: 15%;text-align: center;">操作</th>
              </tr>
              </thead>
              <tbody>
              <?php foreach($notices as $notice) { ?>
                <tr>
                  <td>
                    <div id="data-<?php echo $notice['id']; ?>" style="display: none;">
                        <?php echo json_encode($notice, 320); ?>
                    </div>
                    <label>
                      <input type="checkbox" name="id[]" value="<?php echo $notice['id']; ?>">
                    </label>
                  </td>
                  <td class="oz-left" style="white-space: normal;"><?php echo $notice['content']; ?></td>
                  <td><?php echo date('Y-m-d H:i:s', $notice['time']); ?></td>
                  <td>
                    <button type="button" class="oz-btn oz-btn-xs oz-bg-blue" onclick="editPopup('修改公告内容', '<?php echo TABLE_NOTICE; ?>', <?php echo $notice['id']; ?>)">修改</button>
                    <button type="button" class="oz-btn oz-btn-xs oz-bg-red" onclick="deleteOne('<?php echo TABLE_NOTICE; ?>', <?php echo $notice['id']; ?>)">删除</button>
                  </td>
                </tr>
              <?php } ?>
              </tbody>
            </table>
          </div>
        </form>
          <?php echo paging($countNotice, $nowPage, $pageSize); ?>
      </div>
    </div>
  </div>

  <div class="popup" id="add-popup">
    <div class="oz-quote">
      温馨提示：公告内容可以输入HTML代码。
    </div>
    <form id="notice-add" method="post" onsubmit="return false">
        <div class="form-group">
            <label for="web_site_description">内容</label>
                <textarea class="form-control" name="content" id="content" rows="4"  placeholder="请输入公告内容[支持HTML代码]" ></textarea>
                <small class="help-block">这是网站首页滚动的公告</small>
        </div>      
      
      <div class="oz-center">
        <button type="submit" class="oz-btn oz-bg-blue" style="width: 50%;" onclick="addNotice()">发布</button>
      </div>
    </form>
  </div>

  <div class="popup" id="edit-popup">
    <div class="oz-quote">
      温馨提示：公告内容可以输入HTML代码。
    </div>
    <form id="notice-edit" method="post" onsubmit="return false">
      <label for="notice-id">
        <input type="text" name="id" id="notice-id" hidden>
      </label>
        <div class="form-group">
            <label for="web_site_description">内容</label>
                <textarea class="form-control" name="content" id="notice-content" rows="4"  placeholder="请输入公告内容[支持HTML代码]" ></textarea>
                <small class="help-block">这是网站首页滚动的公告</small>
        </div> 
      <div class="oz-center">
        <button type="submit" class="oz-btn oz-bg-blue" style="width: 50%;" onclick="editNotice()">修改</button>
      </div>
    </form>
  </div>

<?php
    require_once 'footer.php';
?>