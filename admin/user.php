<?php
    $title = '用户管理';
    require_once 'header.php';
    $countUser = $DATA->getCount(TABLE_USER);
    $pageSize = !empty($_GET['size']) ? $_GET['size'] : 10;
    $nowPage = !empty($_GET['page']) ? $_GET['page'] : 1;
    $startNum = ($nowPage - 1) * $pageSize;
    $users = $DATA->getUsers($pageSize, $startNum);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>用户管理</title>
    <link rel="stylesheet" href="../../assets/libs/layui/css/layui.css"/>
    <link rel="stylesheet" href="../../assets/module/admin.css?v=318"/>
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<!-- 正文开始 -->
<div class="layui-fluid">
    <div class="layui-card">
        <div class="layui-card-body">
            <!-- 表格工具栏 -->
<div class="oz-quote wrap-option">
          <div>
            共 <strong><?php echo $countUser; ?></strong> 个用户
                        <!--            <button type="button" class="oz-btn oz-btn-sm oz-bg-orange" onclick="addPopup('添加用户')">添加用户</button>-->
          </div>
          <div style="margin-left: 15px;">
            <!--<button type="button" class="oz-btn oz-btn-sm oz-bg-green" onclick="batchModify('<?php /*echo TABLE_USER; */ ?>', 'state', 1)">正常</button>
            <button type="button" class="oz-btn oz-btn-sm" onclick="batchModify('<?php /*echo TABLE_USER; */ ?>', 'state', 0)">封停</button>
            <button type="button" class="oz-btn oz-btn-sm oz-bg-red" onclick="batchDelete('<?php /*echo TABLE_USER; */ ?>')">删除</button>-->
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
                <th style="width: 5%;text-align: center;">ID</th>
                <!--                <th style="width: 5%;">头像</th>-->
                <th style="width: 15%;text-align: center;">用户名</th>
                <th style="width: 5%;text-align: center;">角色</th>
                <th style="width: 5%;text-align: center;">QQ</th>
                <th style="width: 20%;text-align: center;">邮箱</th>
                <th style="width: 5%;text-align: center;">简介</th>
                <th style="width: 15%;text-align: center;">时间</th>
                <!--                <th style="width: 5%;">状态</th>-->
                <th style="width: 15%;">操作</th>
              </tr>
              </thead>
              <tbody>
              <?php foreach($users as $user) { ?>
                <tr>
                  <td>
                    <div id="data-<?php echo $user['id']; ?>" style="display: none;">
                        <?php echo json_encode($user, 320); ?>
                    </div>
                    <label>
                      <input type="checkbox" name="id[]" value="<?php echo $user['id']; ?>">
                    </label>
                  </td>
                  <td><?php echo $user['id']; ?></td>
                  <!--<td>
                    <button type="button" class="oz-btn oz-btn-xs oz-bg-black" onclick="imgPopup('头像 [<?php /*echo $user['username']; */ ?>]', '<?php /*echo $user['avatar']; */ ?>')">查看</button>
                  </td>-->
                  <td><?php echo $user['username']; ?></td>
                  <td>
                      <?php if($user['role'] == 1) { ?>
                        <span class="oz-badge oz-bg-purple oz-badge-radius">管理员</span>
                      <?php } else { ?>
                        <span class="oz-badge oz-bg-blue oz-badge-radius">用户</span>
                      <?php } ?>
                  </td>
                  <td>
                    <a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $user['qq']; ?>&site=qq&menu=yes" target="_blank" class="oz-tooltip oz-tooltip-up" oz-title="<?php echo $user['qq']; ?>">
                      <i class="fa fa-qq fa-fw" aria-hidden="true"></i>
                    </a>
                  </td>
                  <td>
                    <a href="mailto:<?php echo $user['email']; ?>" target="_blank">
                        <?php echo $user['email']; ?>
                    </a>
                  </td>
                  <td>
                    <button type="button" class="oz-btn oz-btn-xs oz-bg-orange oz-btn-radius" onclick="textPopup('简介 [<?php echo $user['username']; ?>]', '<?php echo $user['intro']; ?>');">查看</button>
                  </td>
                  <td><?php echo date('Y-m-d', $user['time']); ?></td>
                  <!--<td>
                      <?php /*if($user['state'] == 1) { */ ?>
                        <button type="button" class="oz-btn oz-btn-xs oz-bg-green oz-badge-radius oz-tooltip oz-tooltip-up" oz-title="封停用户" onclick="modifyOne('<?php /*echo TABLE_USER; */ ?>', <?php /*echo $user['id']; */ ?>, 'state', 0)">正常</button>
                      <?php /*} else { */ ?>
                        <button type="button" class="oz-btn oz-btn-xs oz-badge-radius oz-tooltip oz-tooltip-up" oz-title="恢复正常" onclick="modifyOne('<?php /*echo TABLE_USER; */ ?>', <?php /*echo $user['id']; */ ?>, 'state', 1)">封停</button>
                      <?php /*} */ ?>
                  </td>-->
                  <td>
                    <button type="button" class="layui-btn layui-btn-sm" onclick="editPopup('修改用户信息', '<?php echo TABLE_USER; ?>', <?php echo $user['id']; ?>)">修改</button>
                    <!--<button type="button" class="oz-btn oz-btn-xs oz-bg-red" onclick="deleteOne('<?php /*echo TABLE_USER; */ ?>', <?php /*echo $user['id']; */ ?>)">删除</button>-->
                  </td>
                </tr>
              <?php } ?>
              </tbody>
            </table>
          </div>
        </form>
          <?php echo paging($countUser, $nowPage, $pageSize); ?>

                        <!-- 数据表格 -->
            <table id="userTable" lay-filter="userTable"></table>
        </div>
    </div>
</div>


<div class="popup" id="edit-popup">
    <div class="oz-quote">
      温馨提示：用户必须绑定邮箱，用户修改密码等安全操作。且修改成功后需要重新登陆，所以请记住您的密码！
    </div>
    <form id="user-edit" method="post" onsubmit="return false">
      <label for="user-id">
        <input type="text" name="id" id="user-id" hidden>
      </label>
      <label for="user-role">
        <input type="text" name="role" id="user-role" hidden>
      </label>
      <div class="oz-form-group">
        <span class="oz-form-label">用户名</span>
        <label class="oz-form-field">
          <input type="text" placeholder="请输入用户名[必填]" name="username" id="user-username">
        </label>
      </div>
      <div class="oz-form-group">
        <span class="oz-form-label">密码</span>
        <label class="oz-form-field">
          <input type="password" placeholder="请输入用户密码[非必填，不修改请留空]" name="password" id="user-password">
        </label>
      </div>
      <div class="oz-form-group">
        <span class="oz-form-label">Q Q</span>
        <label class="oz-form-field">
          <input type="text" placeholder="请输入用户QQ号[非必填]" name="qq" id="user-qq">
        </label>
      </div>
      <div class="oz-form-group">
        <span class="oz-form-label">邮箱</span>
        <label class="oz-form-field">
          <input type="text" placeholder="请输入用户邮箱[必填]" name="email" id="user-email">
        </label>
      </div>
      <div class="oz-form-group oz-form-textarea">
        <span class="oz-form-label">简介</span>
        <label class="oz-form-field">
          <textarea rows="2" placeholder="请输入用户简介[非必填]" name="intro" id="user-intro"></textarea>
        </label>
      </div>
      <div class="oz-form-group">
        <span class="oz-form-label">状态</span>
        <label class="oz-form-field">
          <select name="state" id="user-state">
            <option value="1">正常</option>
            <option value="0">封停</option>
          </select>
        </label>
      </div>
      <div class="oz-center">
        <button type="submit" class="oz-btn oz-bg-blue" style="width: 50%;" onclick="editUser()">修改</button>
      </div>
    </form>
  </div>


</body>
</html>
<?php
    require_once 'footer.php';
?>