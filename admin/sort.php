<?php
    $type = $_GET['type'];
    if($type != '1' && $type != '2') {
        header('location:./sort.php?type=1');
    }
    $title = $type == '2' ? '文章分类' : '站点分类';
    require_once 'header.php';
    $countSort = $DATA->getCount(TABLE_SORT, 'type=' . $type);
    $pageSize = !empty($_GET['size']) ? $_GET['size'] : 10;
    $nowPage = !empty($_GET['page']) ? $_GET['page'] : 1;
    $startNum = ($nowPage - 1) * $pageSize;
    if($type == '2') {
        $sorts = $DATA->getPostSorts($pageSize, $startNum);
    } else {
        $sorts = $DATA->getSiteSorts($pageSize, $startNum);
    }
?>

<!-- 正文开始 -->
<div class="layui-fluid">
    <div class="layui-card">
        <div class="layui-card-body">
            <!-- 表格工具栏 -->
<div class="oz-quote wrap-option">
          <div>
                      共 <strong><?php echo $countSort; ?></strong> 个<?php echo $title; ?>
            <button type="button" class="oz-btn oz-btn-sm oz-bg-orange" onclick="addPopup('添加分类')">添加分类</button>
          </div>
          <div style="margin-left: 15px;">
            <button type="button" class="oz-btn oz-btn-sm oz-bg-green" onclick="batchModify('<?php echo TABLE_SORT; ?>', 'state', 1)">显示</button>
            <button type="button" class="oz-btn oz-btn-sm" onclick="batchModify('<?php echo TABLE_SORT; ?>', 'state', 0)">隐藏</button>
            <button type="button" class="oz-btn oz-btn-sm oz-bg-red" onclick="batchDelete('<?php echo TABLE_SORT; ?>')">删除</button>
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
                <th style="width: 5%;text-align: center;">序号</th>
                <th style="width: 10%;text-align: center;">图标</th>
                <th style="width: 30%;text-align: center;">名称</th>
                <th style="width: 10%;text-align: center;">别名</th>
                <th style="width: 10%;text-align: center;"><?php echo $type == '1' ? '站点' : '文章'; ?>数量</th>
                <th style="width: 10%;text-align: center;">状态</th>
                <th style="width: 20%;text-align: center;">操作</th>
              </tr>
              </thead>
              <tbody>
              <?php foreach($sorts as $sort) {
                  $sort['num'] = $DATA->getCount($type == '2' ? 'post' : 'site', 'sortId=' . $sort['id']);
                  ?>
                <tr>
                  <td>
                    <div id="data-<?php echo $sort['id']; ?>" style="display: none;">
                        <?php echo json_encode($sort, 320); ?>
                    </div>
                    <label>
                      <input type="checkbox" name="id[]" value="<?php echo $sort['id']; ?>">
                    </label>
                  </td>
                  <td><?php echo $sort['serial']; ?></td>
                  <td>
                    <span class="oz-tooltip oz-tooltip-up" oz-title="<?php echo $sort['icon']; ?>">
                      <i class="<?php echo $sort['icon']; ?> fa-fw" aria-hidden="true"></i>
                    </span>
                  </td>
                  <td>
                    <a href="<?php echo $sort['url']; ?>" target="_blank" class="oz-tooltip oz-tooltip-up" oz-title="<?php echo $sort['url']; ?>">
                        <?php echo $sort['name']; ?>
                    </a>
                  </td>
                  <td><?php echo $sort['alias']; ?></td>
                  <td>
                      <?php if($type == '2') { ?>
                        <a href="post.php?sortId=<?php echo $sort['id']; ?>" class="oz-tooltip oz-tooltip-up" oz-title="「<?php echo $sort['name']; ?>」的文章">
                          <strong><?php echo $sort['num']; ?></strong> 篇
                        </a>
                      <?php } else { ?>
                        <a href="site.php?sortId=<?php echo $sort['id']; ?>" class="oz-tooltip oz-tooltip-up" oz-title="「<?php echo $sort['name']; ?>」的站点">
                          <strong><?php echo $sort['num']; ?></strong> 个
                        </a>
                      <?php } ?>
                  </td>
                  <td>
                      <?php if($sort['state'] == 1) { ?>
                        <button type="button" class="oz-btn oz-btn-xs oz-bg-green oz-badge-radius oz-tooltip oz-tooltip-up" oz-title="点击隐藏" onclick="modifyOne('<?php echo TABLE_SORT; ?>', <?php echo $sort['id']; ?>, 'state', 0)">显示</button>
                      <?php } else { ?>
                        <button type="button" class="oz-btn oz-btn-xs oz-badge-radius oz-tooltip oz-tooltip-up" oz-title="点击显示" onclick="modifyOne('<?php echo TABLE_SORT; ?>', <?php echo $sort['id']; ?>, 'state', 1)">隐藏</button>
                      <?php } ?>
                  </td>
                  <td>
                    <button type="button" class="oz-btn oz-btn-xs oz-bg-blue" onclick="editPopup('修改分类信息', '<?php echo TABLE_SORT; ?>', <?php echo $sort['id']; ?>)">修改</button>
                    <button type="button" class="oz-btn oz-btn-xs oz-bg-red" onclick="deleteOne('<?php echo TABLE_SORT; ?>', <?php echo $sort['id']; ?>)">删除</button>
                  </td>
                </tr>
              <?php } ?>
              </tbody>
            </table>
          </div>
        </form>
          <?php echo paging($countSort, $nowPage, $pageSize); ?>
      </div>
    </div>
  </div>

  <div class="popup" id="add-popup">
    <div class="oz-quote">
      <p>温馨提示：序号用于排序[数字越小排名越前]。<a href="http://www.fontawesome.com.cn/faicons">Font Awesome图标</a></p>
      <p>别名必须以字母开头，可包含字母、数字和下划线</p>
    </div>
    <form id="sort-add" method="post" onsubmit="return false">
      <div class="oz-form-group">
        <span class="oz-form-label">序号</span>
        <label class="oz-form-field">
          <input type="text" placeholder="请输入分类序号[必填，只能填数字]" name="serial" id="serial" value="0">
        </label>
      </div>
      <div class="oz-form-group">
        <span class="oz-form-label">图标</span>
        <label class="oz-form-field">
          <input type="text" class="oz-icon-input" placeholder="请输入分类图标[必填，例：fa fa-home]" name="icon" id="icon">
        </label>
        <span class="oz-form-btn">
					<span class="oz-btn oz-bg-orange oz-tooltip oz-tooltip-up" oz-title="点我" style="width: 34px;padding: 0;text-align: center;" onclick="iconPopup(this)"><i class="oz-icon-show fa-fw"></i></span>
				</span>
      </div>
      <div class="oz-form-group">
        <span class="oz-form-label">名称</span>
        <label class="oz-form-field">
          <input type="text" placeholder="请输入分类名称[必填]" name="name" id="name">
        </label>
      </div>
      <div class="oz-form-group">
        <span class="oz-form-label">别名</span>
        <label class="oz-form-field">
          <input type="text" placeholder="请输入链接别名[非必填]" name="alias" id="alias">
        </label>
      </div>
      <div class="oz-center">
        <button type="submit" class="oz-btn oz-bg-blue" style="width: 50%;" onclick="addSort(<?php echo $type; ?>)">添加</button>
      </div>
    </form>
  </div>

  <div class="popup" id="edit-popup">
    <div class="oz-quote">
      <p>温馨提示：序号用于排序[数字越小排名越前]。<a href="http://www.fontawesome.com.cn/faicons">Font Awesome图标</a></p>
      <p>别名必须以字母开头，可包含字母、数字和下划线</p>
    </div>
    <form id="sort-edit" method="post" onsubmit="return false">
      <label for="sort-id">
        <input type="text" name="id" id="sort-id" hidden>
      </label>
      <div class="oz-form-group">
        <span class="oz-form-label">序号</span>
        <label class="oz-form-field">
          <input type="text" placeholder="请输入分类序号[必填，只能填数字]" name="serial" id="sort-serial">
        </label>
      </div>
      <div class="oz-form-group">
        <span class="oz-form-label">图标</span>
        <label class="oz-form-field">
          <input type="text" class="oz-icon-input" placeholder="请输入分类图标[必填，例：fa fa-home]" name="icon" id="sort-icon">
        </label>
        <span class="oz-form-btn">
					<span class="oz-btn oz-bg-orange oz-tooltip oz-tooltip-up" oz-title="点我" style="width: 34px;padding: 0;text-align: center;" onclick="iconPopup(this)"><i class="oz-icon-show fa-fw"></i></span>
				</span>
      </div>
      <div class="oz-form-group">
        <span class="oz-form-label">名称</span>
        <label class="oz-form-field">
          <input type="text" placeholder="请输入分类名称[必填]" name="name" id="sort-name">
        </label>
      </div>
      <div class="oz-form-group">
        <span class="oz-form-label">别名</span>
        <label class="oz-form-field">
          <input type="text" placeholder="请输入链接别名[非必填]" name="alias" id="sort-alias">
        </label>
      </div>
      <div class="oz-form-group">
        <span class="oz-form-label">状态</span>
        <label class="oz-form-field">
          <select name="state" id="sort-state">
            <option value="1">显示</option>
            <option value="0">隐藏</option>
          </select>
        </label>
      </div>
      <div class="oz-center">
        <button type="submit" class="oz-btn oz-bg-blue" style="width: 50%;" onclick="editSort()">修改</button>
      </div>
    </form>
  </div>

<?php
    require_once 'footer.php';
?>