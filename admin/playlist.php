<?php
    $title = '订单记录';
    require_once 'header.php';
    $countNav = $DATA->getCount(TABLE_ORDER);
    $pageSize = !empty($_GET['size']) ? $_GET['size'] : 10;
    $nowPage = !empty($_GET['page']) ? $_GET['page'] : 1;
    $startNum = ($nowPage - 1) * $pageSize;
    $navs = $DATA->getNavs2($pageSize, $startNum);
    //echo($navs[0]);
?>

<!-- 正文开始 -->
<div class="layui-fluid">
    <div class="layui-card">
        <div class="layui-card-body">
            <!-- 表格工具栏 -->
<div class="oz-quote wrap-option">
          <div>
                      共 <strong><?php echo $countNav; ?></strong> 笔记录
            
          </div>
  
        </div>
        <form id="batch" method="post" onsubmit="return false">
          <div class="oz-table-fluid">
            <table class="oz-table">
              <thead>
              <tr>
               
                <th style="width: 10%;text-align: center;">序号</th>
                <th style="width: 15%;text-align: center;">订单号</th>
                <th style="width: 10%;text-align: center;">购买类型</th>
                <th style="width: 10%;text-align: center;">金额</th>
                <th style="width: 10%;text-align: center;">数量</th>
                <th style="width: 10%;text-align: center;">支付方式</th>
                <th style="width: 10%;text-align: center;">创建时间</th>
                <th style="width: 10%;text-align: center;">状态</th>
              </tr>
              </thead>
              <tbody>
              <?php foreach($navs as $nav) { ?>
                <tr>
                  <td><?php echo $nav['id']; ?></td>
                  <td><?php echo $nav['trade_no']; ?></td>
                  <td><?php echo $nav['type']; ?></td>
                  <td><?php echo $nav['money']; ?></td>
                  <td><?php echo $nav['num']; ?>/月</td>
                  <td><?php echo $nav['pay_type']; ?></td>
                  <td><?php echo $nav['creat_time']; ?></td>
                  <td><?php echo $nav['status']; ?></td>
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