<?php
    $title = '友链管理';
    require_once 'header.php';
    $countLink = $DATA->getCount(TABLE_LINK);
    $pageSize = !empty($_GET['size']) ? $_GET['size'] : 10;
    $nowPage = !empty($_GET['page']) ? $_GET['page'] : 1;
    $startNum = ($nowPage - 1) * $pageSize;
    $links = $DATA->getLinks($pageSize, $startNum);
?>

<!-- 正文开始 -->
<div class="layui-fluid">
    <div class="layui-card">
        <div class="layui-card-body">
            <!-- 表格工具栏 -->
<div class="oz-quote wrap-option">
          <div>            共 <strong><?php echo $countLink; ?></strong> 个友链
            <button type="button" class="oz-btn oz-btn-sm oz-bg-orange" onclick="addPopup('添加友链');">添加友链</button>
          </div>
          <div style="margin-left: 15px;">
            <button type="button" class="oz-btn oz-btn-sm oz-bg-purple" onclick="batchModify('<?php echo TABLE_LINK; ?>', 'newTab', 1)">新窗口开</button>
            <button type="button" class="oz-btn oz-btn-sm oz-bg-brown" onclick="batchModify('<?php echo TABLE_LINK; ?>', 'newTab', 0)">新窗口关</button>
            <button type="button" class="oz-btn oz-btn-sm oz-bg-green" onclick="batchModify('<?php echo TABLE_LINK; ?>', 'state', 1)">显示</button>
            <button type="button" class="oz-btn oz-btn-sm" onclick="batchModify('<?php echo TABLE_LINK; ?>', 'state', 0)">隐藏</button>
            <button type="button" class="oz-btn oz-btn-sm oz-bg-red" onclick="batchDelete('<?php echo TABLE_LINK; ?>')">删除</button>
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
                <th style="width: 10%;text-align: center;">序号</th>
                <th style="width: 20%;text-align: center;">名称</th>
                <th style="width: 25%;text-align: center;">链接</th>
                <th style="width: 15%;text-align: center;">时间</th>
                <th style="width: 10%;text-align: center;">新窗口打开</th>
                <th style="width: 5%;text-align: center;">状态</th>
                <th style="width: 15%;text-align: center;">操作</th>
              </tr>
              </thead>
              <tbody>
              <?php foreach($links as $link) { ?>
                <tr>
                  <td>
                    <div id="data-<?php echo $link['id']; ?>" style="display: none;">
                        <?php echo json_encode($link, 320); ?>
                    </div>
                    <label>
                      <input type="checkbox" name="id[]" value="<?php echo $link['id']; ?>">
                    </label>
                  </td>
                  <td><?php echo $link['serial']; ?></td>
                  <td><?php echo $link['name']; ?></td>
                  <td>
                    <a href="<?php echo $link['url']; ?>" target="_blank">
                        <?php echo $link['url']; ?>
                    </a>
                  </td>
                  <td><?php echo date('Y-m-d H:i:s', $link['time']); ?></td>
                  <td>
                      <?php if($link['newTab'] == 1) { ?>
                        <button type="button" class="oz-btn oz-btn-xs oz-bg-purple oz-tooltip oz-tooltip-up" oz-title="点击关闭" onclick="modifyOne('<?php echo TABLE_LINK; ?>', <?php echo $link['id']; ?>, 'newTab', 0)">是</button>
                      <?php } elseif($link['newTab'] == 0) { ?>
                        <button type="button" class="oz-btn oz-btn-xs oz-bg-brown oz-tooltip oz-tooltip-up" oz-title="点击打开" onclick="modifyOne('<?php echo TABLE_LINK; ?>', <?php echo $link['id']; ?>, 'newTab', 1)">否</button>
                      <?php } ?>
                  </td>
                  <td>
                      <?php if($link['state'] == 1) { ?>
                        <button type="button" class="oz-btn oz-btn-xs oz-bg-green oz-badge-radius oz-tooltip oz-tooltip-up" oz-title="点击隐藏" onclick="modifyOne('<?php echo TABLE_LINK; ?>', <?php echo $link['id']; ?>, 'state', 0)">显示</button>
                      <?php } else { ?>
                        <button type="button" class="oz-btn oz-btn-xs oz-badge-radius oz-tooltip oz-tooltip-up" oz-title="点击显示" onclick="modifyOne('<?php echo TABLE_LINK; ?>', <?php echo $link['id']; ?>, 'state', 1)">隐藏</button>
                      <?php } ?>
                  </td>
                  <td>
                    <button type="button" class="oz-btn oz-btn-xs oz-bg-blue" onclick="editPopup('修改友链信息', '<?php echo TABLE_LINK; ?>', <?php echo $link['id']; ?>)">修改</button>
                    <button type="button" class="oz-btn oz-btn-xs oz-bg-red" onclick="deleteOne('<?php echo TABLE_LINK; ?>', <?php echo $link['id']; ?>)">删除</button>
                  </td>
                </tr>
              <?php } ?>
              </tbody>
            </table>
          </div>
        </form>
          <?php echo paging($countLink, $nowPage, $pageSize); ?>
      </div>
    </div>
  </div>

  <div class="popup" id="add-popup">
    <div class="oz-quote">
      温馨提示：序号用于排序[数字越小排名越前]。
    </div>
    <form id="link-add" method="post" onsubmit="return false">
      <div class="oz-form-group">
        <span class="oz-form-label">序号</span>
        <label class="oz-form-field">
          <input type="text" placeholder="请输入友链序号[必填，只能填数字]" name="serial" id="serial" value="0">
        </label>
      </div>
      <div class="oz-form-group">
        <span class="oz-form-label">名称</span>
        <label class="oz-form-field">
          <input type="text" placeholder="请输入友链名称[必填]" name="name" id="name">
        </label>
      </div>
      <div class="oz-form-group">
        <span class="oz-form-label">链接</span>
        <label class="oz-form-field">
          <input type="text" placeholder="请输入友链地址[必填]" name="url" id="url">
        </label>
      </div>
      <div class="oz-form-group">
        <span class="oz-form-label">新窗口打开</span>
        <label class="oz-form-field">
          <select name="newTab" id="newTab">
            <option value="1">是</option>
            <option value="0">否</option>
          </select>
        </label>
      </div>
      <div class="oz-center">
        <button type="submit" class="oz-btn oz-bg-blue" style="width: 50%;" onclick="addLink()">添加</button>
      </div>
    </form>
  </div>

  <div class="popup" id="edit-popup">
    <div class="oz-quote">
      温馨提示：序号用于排序[数字越小排名越前]。
    </div>
    <form id="link-edit" method="post" onsubmit="return false">
      <label for="link-id">
        <input type="text" name="id" id="link-id" hidden>
      </label>
      <div class="oz-form-group">
        <span class="oz-form-label">序号</span>
        <label class="oz-form-field">
          <input type="text" placeholder="请输入友链序号[必填，只能填数字]" name="serial" id="link-serial">
        </label>
      </div>
      <div class="oz-form-group">
        <span class="oz-form-label">名称</span>
        <label class="oz-form-field">
          <input type="text" placeholder="请输入友链名称[必填]" name="name" id="link-name">
        </label>
      </div>
      <div class="oz-form-group">
        <span class="oz-form-label">链接</span>
        <label class="oz-form-field">
          <input type="text" placeholder="请输入友链地址[必填]" name="url" id="link-url">
        </label>
      </div>
      <div class="oz-form-group">
        <span class="oz-form-label">新窗口打开</span>
        <label class="oz-form-field">
          <select name="newTab" id="link-newTab">
            <option value="1">是</option>
            <option value="0">否</option>
          </select>
        </label>
      </div>
      <div class="oz-form-group">
        <span class="oz-form-label">状态</span>
        <label class="oz-form-field">
          <select name="state" id="link-state">
            <option value="1">显示</option>
            <option value="0">隐藏</option>
          </select>
        </label>
      </div>
      <div class="oz-center">
        <button type="submit" class="oz-btn oz-bg-blue" style="width: 50%;" onclick="editLink()">修改</button>
      </div>
    </form>
  </div>

<?php
    require_once 'footer.php';
?>