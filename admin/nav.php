<?php
    $title = '系统导航';
    require_once 'header.php';
    $countNav = $DATA->getCount(TABLE_NAV);
    $pageSize = !empty($_GET['size']) ? $_GET['size'] : 10;
    $nowPage = !empty($_GET['page']) ? $_GET['page'] : 1;
    $startNum = ($nowPage - 1) * $pageSize;
    $navs = $DATA->getNavs($pageSize, $startNum);
?>

<!-- 正文开始 -->
<div class="layui-fluid">
    <div class="layui-card">
        <div class="layui-card-body">
            <!-- 表格工具栏 -->
<div class="oz-quote wrap-option">
          <div>
                      共 <strong><?php echo $countNav; ?></strong> 个导航
            <button type="button" class="oz-btn oz-btn-sm oz-bg-orange" onclick="addPopup('添加导航')">添加导航</button>
          </div>
          <div style="margin-left: 15px;">
            <button type="button" class="oz-btn oz-btn-sm oz-bg-purple" onclick="batchModify('<?php echo TABLE_NAV; ?>', 'newTab', 1)">新窗口开</button>
            <button type="button" class="oz-btn oz-btn-sm oz-bg-brown" onclick="batchModify('<?php echo TABLE_NAV; ?>', 'newTab', 0)">新窗口关</button>
            <button type="button" class="oz-btn oz-btn-sm oz-bg-green" onclick="batchModify('<?php echo TABLE_NAV; ?>', 'state', 1)">显示</button>
            <button type="button" class="oz-btn oz-btn-sm" onclick="batchModify('<?php echo TABLE_NAV; ?>', 'state', 0)">隐藏</button>
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
                <th style="width: 10%;text-align: center;">序号</th>
                <th style="width: 10%;text-align: center;">图标</th>
                <th style="width: 10%;text-align: center;">类型</th>
                <th style="width: 25%;text-align: center;">名称</th>
                <th style="width: 10%;text-align: center;">新窗口打开</th>
                <th style="width: 15%;text-align: center;">状态</th>
                <th style="width: 20%;text-align: center;">操作</th>
              </tr>
              </thead>
              <tbody>
              <?php foreach($navs as $nav) { ?>
                <tr>
                  <td>
                    <div id="data-<?php echo $nav['id']; ?>" style="display: none;">
                        <?php echo json_encode($nav, 320); ?>
                    </div>
                    <label>
                      <input type="checkbox" name="id[]" value="<?php echo $nav['id']; ?>">
                    </label>
                  </td>
                  <td><?php echo $nav['serial']; ?></td>
                  <td>
                    <span class="oz-tooltip oz-tooltip-up" oz-title="<?php echo $nav['icon']; ?>">
                      <i class="<?php echo $nav['icon']; ?> fa-fw" aria-hidden="true"></i>
                    </span>
                  </td>
                  <td>
                      <?php if($nav['type'] == 1) { ?>
                        <span class="oz-badge oz-bg-yellow oz-badge-radius">自定</span>
                      <?php } elseif($nav['type'] == 2) { ?>
                        <span class="oz-badge oz-bg-purple oz-badge-radius">分类</span>
                      <?php } elseif($nav['type'] == 3) { ?>
                        <span class="oz-badge oz-bg-blue oz-badge-radius">单页</span>
                      <?php } else { ?>
                        <span class="oz-badge oz-bg-black oz-badge-radius">系统</span>
                      <?php } ?>
                  </td>
                  <td>
                    <a href="<?php echo $nav['url']; ?>" target="_blank" class="oz-tooltip oz-tooltip-up" oz-title="<?php echo $nav['url']; ?>">
                        <?php echo $nav['name']; ?>
                    </a>
                  </td>
                  <td>
                      <?php if($nav['newTab'] == 1) { ?>
                        <button type="button" class="oz-btn oz-btn-xs oz-bg-purple oz-tooltip oz-tooltip-up" oz-title="点击关闭" onclick="modifyOne('<?php echo TABLE_NAV; ?>', <?php echo $nav['id']; ?>, 'newTab', 0)">是</button>
                      <?php } elseif($nav['newTab'] == 0) { ?>
                        <button type="button" class="oz-btn oz-btn-xs oz-bg-brown oz-tooltip oz-tooltip-up" oz-title="点击打开" onclick="modifyOne('<?php echo TABLE_NAV; ?>', <?php echo $nav['id']; ?>, 'newTab', 1)">否</button>
                      <?php } ?>
                  </td>
                  <td>
                      <?php if($nav['state'] == 1) { ?>
                        <button type="button" class="oz-btn oz-btn-xs oz-bg-green oz-badge-radius oz-tooltip oz-tooltip-up" oz-title="点击隐藏" onclick="modifyOne('<?php echo TABLE_NAV; ?>', <?php echo $nav['id']; ?>, 'state', 0)">显示</button>
                      <?php } else { ?>
                        <button type="button" class="oz-btn oz-btn-xs oz-badge-radius oz-tooltip oz-tooltip-up" oz-title="点击显示" onclick="modifyOne('<?php echo TABLE_NAV; ?>', <?php echo $nav['id']; ?>, 'state', 1)">隐藏</button>
                      <?php } ?>
                  </td>
                  <td>
                    <button type="button" class="oz-btn oz-btn-xs oz-bg-blue" onclick="editPopup('修改导航信息', '<?php echo TABLE_NAV; ?>', <?php echo $nav['id']; ?>)">修改</button>
                    <button type="button" class="oz-btn oz-btn-xs oz-bg-red" onclick="deleteOne('<?php echo TABLE_NAV; ?>', <?php echo $nav['id']; ?>)">删除</button>
                  </td>
                </tr>
              <?php } ?>
              </tbody>
            </table>
          </div>
        </form>
          <?php echo paging($countNav, $nowPage, $pageSize); ?>
      </div>
    </div>
  </div>

  <div class="popup" id="add-popup">
    <div class="oz-tab">
      <ul class="oz-tab-title">
        <li class="active">自定义</li>
        <li>添加分类</li>
        <li>添加单页</li>
      </ul>
      <ul class="oz-tab-content">
        <li class="oz-tab-item active">
          <div class="oz-quote">
            <p>温馨提示：序号用于排序[数字越小排名越前]。<a href="http://www.fontawesome.com.cn/faicons">Font Awesome图标</a></p>
          </div>
          <form id="nav-add-1" method="post" onsubmit="return false">
            <div class="oz-form-group">
              <span class="oz-form-label">序号</span>
              <label class="oz-form-field">
                <input type="text" placeholder="请输入导航序号[必填，只能填数字]" name="serial" id="serial" value="0">
              </label>
            </div>
            <div class="oz-form-group">
              <span class="oz-form-label">图标</span>
              <label class="oz-form-field">
                <input type="text" class="oz-icon-input" placeholder="请输入导航图标[必填，例：fa fa-home]" name="icon" id="icon">
              </label>
              <span class="oz-form-btn">
                <span class="oz-btn oz-bg-orange oz-tooltip oz-tooltip-up" oz-title="点我" style="width: 36px;padding: 0;text-align: center;" onclick="iconPopup(this)"><i class="oz-icon-show fa-fw"></i></span>
              </span>
            </div>
            <div class="oz-form-group">
              <span class="oz-form-label">名称</span>
              <label class="oz-form-field">
                <input type="text" placeholder="请输入导航名称[必填]" name="name" id="name">
              </label>
            </div>
            <div class="oz-form-group">
              <span class="oz-form-label">链接</span>
              <label class="oz-form-field">
                <input type="text" placeholder="请输入导航链接[必填]" name="url" id="url">
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
              <button type="submit" class="oz-btn oz-bg-blue" style="width: 50%;" onclick="addNav(1)">添加</button>
            </div>
          </form>
        </li>
        <li class="oz-tab-item">
          <form id="nav-add-2" method="post" onsubmit="return false">
            <table class='oz-table oz-table-warp'>
              <thead>
              <tr>
                <th>
                  <label>
                    <input type="checkbox" onclick="selectAll(this)">
                  </label>
                </th>
                <th>分类名称</th>
              </tr>
              </thead>
              <tbody>
              <?php
                  $sorts = $DATA->getSorts();
                  foreach($sorts as $sort) {
                      ?>
                    <tr>
                      <td>
                        <label>
                          <input type="checkbox" name="sortId[]" value="<?php echo $sort['id']; ?>">
                        </label>
                      </td>
                      <td><?php echo $sort['name']; ?></td>
                    </tr>
                  <?php } ?>
              </tbody>
            </table>
            <div class="oz-center" style="margin-top: 20px;">
              <button type="submit" class="oz-btn oz-bg-blue" style="width: 50%;" onclick="addNav(2)">添加</button>
            </div>
          </form>
        </li>
        <li class="oz-tab-item">
          <form id="nav-add-3" method="post" onsubmit="return false">
            <table class='oz-table oz-table-warp'>
              <thead>
              <tr>
                <th>
                  <label>
                    <input type="checkbox" onclick="selectAll(this)">
                  </label>
                </th>
                <th>单页标题</th>
              </tr>
              </thead>
              <tbody>
              <?php
                  $pages = $DATA->getPages();
                  foreach($pages as $page) {
                      ?>
                    <tr>
                      <td>
                        <label>
                          <input type="checkbox" name="pageId[]" value="<?php echo $page['id']; ?>">
                        </label>
                      </td>
                      <td><?php echo $page['title']; ?></td>
                    </tr>
                  <?php } ?>
              </tbody>
            </table>
            <div class="oz-center" style="margin-top: 20px;">
              <button type="submit" class="oz-btn oz-bg-blue" style="width: 50%;" onclick="addNav(3)">添加</button>
            </div>
          </form>
        </li>
      </ul>
    </div>
  </div>

  <div class="popup" id="edit-popup">
    <div class="oz-quote">
      <p>温馨提示：序号用于排序[数字越小排名越前]。<a href="http://www.fontawesome.com.cn/faicons">Font Awesome图标</a></p>
    </div>
    <form id="nav-edit" method="post" onsubmit="return false">
      <label for="nav-id">
        <input type="text" name="id" id="nav-id" hidden>
      </label>
      <div class="oz-form-group">
        <span class="oz-form-label">序号</span>
        <label class="oz-form-field">
          <input type="text" placeholder="请输入导航序号[必填，只能填数字]" name="serial" id="nav-serial">
        </label>
      </div>
      <div class="oz-form-group">
        <span class="oz-form-label">图标</span>
        <label class="oz-form-field">
          <input type="text" class="oz-icon-input" placeholder="请输入导航图标[必填]" name="icon" id="nav-icon">
        </label>
        <span class="oz-form-btn">
					<span class="oz-btn oz-bg-orange oz-tooltip oz-tooltip-up" oz-title="点我" style="width: 34px;padding: 0;text-align: center;" onclick="iconPopup(this)"><i class="oz-icon-show"></i></span>
				</span>
      </div>
      <div class="oz-form-group">
        <span class="oz-form-label">名称</span>
        <label class="oz-form-field">
          <input type="text" placeholder="请输入导航名称[必填]" name="name" id="nav-name">
        </label>
      </div>
      <div class="oz-form-group">
        <span class="oz-form-label">链接</span>
        <label class="oz-form-field">
          <input type="text" placeholder="请输入导航链接[必填]" name="url" id="nav-url">
        </label>
      </div>
      <div class="oz-form-group">
        <span class="oz-form-label">新窗口打开</span>
        <label class="oz-form-field">
          <select name="newTab" id="nav-newTab">
            <option value="1">是</option>
            <option value="0">否</option>
          </select>
        </label>
      </div>
      <div class="oz-form-group">
        <span class="oz-form-label">状态</span>
        <label class="oz-form-field">
          <select name="state" id="nav-state">
            <option value="1">显示</option>
            <option value="0">隐藏</option>
          </select>
        </label>
      </div>
      <div class="oz-center">
        <button type="submit" class="oz-btn oz-bg-blue" style="width: 50%;" onclick="editNav()">修改</button>
      </div>
    </form>
  </div>

<?php
    require_once 'footer.php';
?>