<?php
    $title = '广告管理';
    require_once 'header.php';
    $countAd = $DATA->getCount(TABLE_AD);
    $pageSize = !empty($_GET['size']) ? $_GET['size'] : 50;
    $nowPage = !empty($_GET['page']) ? $_GET['page'] : 1;
    $startNum = ($nowPage - 1) * $pageSize;
    $ads = $DATA->getAds($pageSize, $startNum);
    $pageList = [
        'list' => '首页列表页',
        'postList' => '文章列表页',
        'siteSort' => '站点分类页',
        'site' => '站点详情页',
        'postSort' => '文章分类页',
        'post' => '文章内容页',
        'page' => '单页内容页',
        'search' => '搜索结果页'
    ];
?>

<!-- 正文开始 -->
<div class="layui-fluid">
    <div class="layui-card">
        <div class="layui-card-body">
            <!-- 表格工具栏 -->
<div class="oz-quote wrap-option">
          <div>
                      共 <strong><?php echo $countAd; ?></strong> 个广告
            <button type="button" class="oz-btn oz-btn-sm oz-bg-orange" onclick="addPopup('添加广告');">添加广告</button>
          </div>
          <div style="margin-left: 15px;">
            <button type="button" class="oz-btn oz-btn-sm oz-bg-green" onclick="batchModify('<?php echo TABLE_AD; ?>', 'state', 1)">显示</button>
            <button type="button" class="oz-btn oz-btn-sm" onclick="batchModify('<?php echo TABLE_AD; ?>', 'state', 0)">隐藏</button>
            <button type="button" class="oz-btn oz-btn-sm oz-bg-red" onclick="batchDelete('<?php echo TABLE_AD; ?>')">删除</button>
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
                <th style="width: 20%;text-align: center;">页面</th>
                <th style="width: 30%;text-align: center;">标题</th>
                <th style="width: 10%;text-align: center;">图片</th>
                <th style="width: 10%;text-align: center;">链接</th>
                <th style="width: 10%;text-align: center;">状态</th>
                <th style="width: 10%;text-align: center;">到期时间</th>
                <th style="width: 15%;text-align: center;">操作</th>
              </tr>
              </thead>
              <tbody>
              <?php foreach($ads as $ad) { ?>
                <tr>
                  <td>
                    <div id="data-<?php echo $ad['id']; ?>" style="display: none;">
                        <?php echo json_encode($ad, 320); ?>
                    </div>
                    <label>
                      <input type="checkbox" name="id[]" value="<?php echo $ad['id']; ?>">
                    </label>
                  </td>
                  <td><?php echo $pageList[$ad['page']] ?></td>
                  <td><?php echo $ad['title']; ?></td>
                  <td>
                    <button type="button" class="oz-btn oz-btn-xs oz-bg-black" onclick="imgPopup('广告图 [<?php echo $ad['title']; ?>]', '<?php echo $ad['picture'] ?>')">查看</button>
                  </td>
                  <td>
                    <a href="<?php echo $ad['url']; ?>" target="_blank" class="oz-tooltip oz-tooltip-up" oz-title="<?php echo $ad['url']; ?>"><i class="fa fa-window-restore fa-fw" aria-hidden="true"></i></a>
                  </td>
                  <td>
                      <?php if($ad['state'] == 1) { ?>
                        <button type="button" class="oz-btn oz-btn-xs oz-bg-green oz-badge-radius oz-tooltip oz-tooltip-up" oz-title="点击隐藏" onclick="modifyOne('<?php echo TABLE_AD; ?>', <?php echo $ad['id']; ?>, 'state', 0)">显示</button>
                      <?php } else { ?>
                        <button type="button" class="oz-btn oz-btn-xs oz-badge-radius oz-tooltip oz-tooltip-up" oz-title="点击显示" onclick="modifyOne('<?php echo TABLE_AD; ?>', <?php echo $ad['id']; ?>, 'state', 1)">隐藏</button>
                      <?php } ?>
                  </td>
                  <td><?php echo $ad['end_time']; ?></td>
                  <td>
                    <button type="button" class="oz-btn oz-btn-xs oz-bg-blue" onclick="editPopup('修改广告信息', '<?php echo TABLE_AD; ?>', <?php echo $ad['id']; ?>)">修改</button>
                    <button type="button" class="oz-btn oz-btn-xs oz-bg-red" onclick="deleteOne('<?php echo TABLE_AD; ?>', <?php echo $ad['id']; ?>)">删除</button>
                  </td>
                </tr>
              <?php } ?>
              </tbody>
            </table>
          </div>
        </form>
          <?php echo paging($countAd, $nowPage, $pageSize); ?>
      </div>
    </div>
  </div>

  <div class="popup" id="add-popup">
    <div class="oz-quote">
      温馨提示：暂只支持图片广告，并且根据各个模板自定广告位置。<strong>部分模板可能不支持一些广告页面。</strong>
    </div>
    <form id="ad-add" method="post" onsubmit="return false">
      <div class="oz-form-group">
        <span class="oz-form-label">页面</span>
        <label class="oz-form-field">
          <select name="page" id="page">
            <option value="">请选择广告页面[必选]</option>
              <?php foreach($pageList as $key => $value) { ?>
                <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
              <?php } ?>
          </select>
        </label>
      </div>
      <div class="oz-form-group">
        <span class="oz-form-label">标题</span>
        <label class="oz-form-field">
          <input type="text" placeholder="请输入广告标题[必填]" name="title" id="title">
        </label>
      </div>
      <div class="oz-form-group">
        <span class="oz-form-label">图片</span>
        <label class="oz-form-field">
          <input type="text" placeholder="请输入广告图片链接[必填]" name="picture" id="picture">
        </label>
      </div>
      <div class="oz-form-group">
        <span class="oz-form-label">链接</span>
        <label class="oz-form-field">
          <input type="text" placeholder="请输入广告链接[必填]" name="url" id="url">
        </label>
      </div>
      <div class="oz-center">
        <button type="submit" class="oz-btn oz-bg-blue" style="width: 50%;" onclick="addAd()">添加</button>
      </div>
    </form>
  </div>

  <div class="popup" id="edit-popup">
    <div class="oz-quote">
      温馨提示：暂只支持图片广告，并且根据各个模板自定广告位置。<strong>部分模板可能不支持一些广告页面。</strong>
    </div>
    <form id="ad-edit" method="post" onsubmit="return false">
      <label for="ad-id">
        <input type="text" name="id" id="ad-id" hidden>
      </label>
      <div class="oz-form-group">
        <span class="oz-form-label">页面</span>
        <label class="oz-form-field">
          <select name="page" id="ad-page">
            <option value="">请选择广告页面[必选]</option>
              <?php foreach($pageList as $key => $value) { ?>
                <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
              <?php } ?>
          </select>
        </label>
      </div>
      <div class="oz-form-group">
        <span class="oz-form-label">标题</span>
        <label class="oz-form-field">
          <input type="text" placeholder="请输入广告标题[必填]" name="title" id="ad-title">
        </label>
      </div>
      <div class="oz-form-group">
        <span class="oz-form-label">图片</span>
        <label class="oz-form-field">
          <input type="text" placeholder="请输入广告图片链接[必填]" name="picture" id="ad-picture">
        </label>
      </div>
      <div class="oz-form-group">
        <span class="oz-form-label">链接</span>
        <label class="oz-form-field">
          <input type="text" placeholder="请输入广告地址[必填]" name="url" id="ad-url">
        </label>
      </div>
      <div class="oz-form-group">
        <span class="oz-form-label">状态</span>
        <label class="oz-form-field">
          <select name="state" id="ad-state">
            <option value="1">显示</option>
            <option value="0">隐藏</option>
          </select>
        </label>
      </div>
      <div class="oz-center">
        <button type="submit" class="oz-btn oz-bg-blue" style="width: 50%;" onclick="editAd()">修改</button>
      </div>
    </form>
  </div>

<?php
    require_once 'footer.php';
?>