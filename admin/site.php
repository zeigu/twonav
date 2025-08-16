<?php
    $title = '站点列表';
    require_once 'header.php';
    $sortId = $_GET['sortId'];
    $keyword = $_GET['keyword'];
    $pageSize = !empty($_GET['size']) ? $_GET['size'] : 50;
    $nowPage = !empty($_GET['page']) ? $_GET['page'] : 1;
    $startNum = ($nowPage - 1) * $pageSize;
    if(!empty($keyword)) {
        $sites = $DATA->getSitesByKeyword($keyword, $pageSize, $startNum);
        $countSite = count($DATA->getSitesByKeyword($keyword));
    } elseif(!empty($sortId)) {
        $sites = $DATA->getSitesBySortId($sortId, $pageSize, $startNum);
        $countSite = $DATA->getCount(TABLE_SITE, 'sortId=' . $sortId);
    } else {
        $sites = $DATA->getSites($pageSize, $startNum);
        $countSite = $DATA->getCount(TABLE_SITE);
    }
    $sorts = $DATA->getSiteSorts();
?>

<!-- 正文开始 -->
<div class="layui-fluid">
    <div class="layui-card">
        <div class="layui-card-body">
            <!-- 表格工具栏 -->
<div class="oz-quote wrap-option">
          <div>
                        <?php if(!empty($keyword)) {
                  echo "搜索「{$keyword}」结果";
              } elseif(!empty($sortId)) {
                  $sortName = $DATA->getByKey(TABLE_SORT, 'name', 'id', $sortId);
                  echo "「{$sortName}」分类下";
              } ?>共 <strong><?php echo $countSite; ?></strong> 个站点
            <button type="button" class="oz-btn oz-btn-sm oz-bg-orange" onclick="addPopup('添加站点')">添加站点</button>
            <button type="button" class="oz-btn oz-btn-sm oz-bg-black" onclick="updateAllSite()">更新站点</button>
<!--            <button type="button" class="oz-btn oz-btn-sm oz-bg-blue" onclick="pushAll('baidu', '<?php /*echo TABLE_SITE; */?>')">推送百度</button>
            <button type="button" class="oz-btn oz-btn-sm oz-bg-pink" onclick="pushAll('bearPaw', '<?php /*echo TABLE_SITE; */?>')">推送熊掌</button>-->
          </div>
          <div style="margin-left: 15px;">
            <button type="button" class="oz-btn oz-btn-sm oz-bg-purple" onclick="batchModify('<?php echo TABLE_SITE; ?>', 'top', 1)">置顶</button>
            <button type="button" class="oz-btn oz-btn-sm oz-bg-brown" onclick="batchModify('<?php echo TABLE_SITE; ?>', 'top', 0)">取置</button>
            <button type="button" class="oz-btn oz-btn-sm oz-bg-green" onclick="batchModify('<?php echo TABLE_SITE; ?>', 'state', 1)">显示</button>
            <button type="button" class="oz-btn oz-btn-sm" onclick="batchModify('<?php echo TABLE_SITE; ?>', 'state', 0)">隐藏</button>
            <button type="button" class="oz-btn oz-btn-sm oz-bg-red" onclick="batchDelete('<?php echo TABLE_SITE; ?>')">删除</button>
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
                  <?php if($CONFIG['order'] == 'serial ASC' || $CONFIG['order'] == 'serial DESC') { ?>
                    <th style="width: 5%;">序号</th>
                  <?php } ?>
                <th style="width: 25%;text-align: center;">名称</th>
                <th style="width: 5%;text-align: center;">缩略图</th>
                <th style="width: 15%;text-align: center;">分类</th>
                <th style="width: 5%;text-align: center;">QQ</th>
                <th style="width: 5%;text-align: center;">详情</th>
                <th style="width: 5%;text-align: center;">别名</th>
                <th style="width: 10%;text-align: center;">推送</th>
                <th style="width: 5%;text-align: center;">置顶</th>
                <th style="width: 5%;text-align: center;">状态</th>
                <th style="width: 5%;text-align: center;">到期时间</th>
                <th style="width: 15%;text-align: center;">操作</th>
              </tr>
              </thead>
              <tbody>
              <?php foreach($sites as $site) {
                  $sortName = $DATA->getByKey(TABLE_SORT, 'name', 'id', $site['sortId']);
                  ?>
                <tr>
                  <td>
                    <div id="data-<?php echo $site['id']; ?>" style="display: none;">
                        <?php echo json_encode($site, 320); ?>
                    </div>
                    <label>
                      <input type="checkbox" name="id[]" value="<?php echo $site['id']; ?>">
                    </label>
                  </td>
                    <?php if($CONFIG['order'] == 'serial ASC' || $CONFIG['order'] == 'serial DESC') { ?>
                      <td><?php echo $site['serial']; ?></td>
                    <?php } ?>
                  <td>
                    <a href="<?php echo $site['url']; ?>" target="_blank" class="oz-tooltip oz-tooltip-up" oz-title="<?php echo $site['url']; ?>">
                        <?php echo $site['name']; ?>
                    </a>
                  </td>
                  <td>
                    <button type="button" class="oz-btn oz-btn-xs oz-bg-black" onclick="imgPopup('缩略图 [<?php echo $site['name']; ?>]', '<?php echo 'https://mini.s-shot.ru/1024x768/PNG/800/?' . $site['url'] ?>')">查看</button>
                  </td>
                  <td>
                    <a href="site.php?sortId=<?php echo $site['sortId']; ?>"><?php echo $sortName; ?></a>
                  </td>
                  <td>
                    <a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $site['qq']; ?>&site=qq&menu=yes" target="_blank" class="oz-tooltip oz-tooltip-up" oz-title="<?php echo $site['qq']; ?>">
                      <i class="fa fa-qq fa-fw" aria-hidden="true"></i>
                    </a>
                  </td>
                  <td>
                    <button type="button" class="oz-btn oz-btn-xs oz-bg-orange oz-btn-radius" onclick="detailPopup('详情 [<?php echo $site['name']; ?>]', <?php echo $site['id']; ?>)">查看</button>
                  </td>
                  <td><?php echo $site['alias']; ?></td>
                  <td>
                    <button type="button" class="oz-btn oz-btn-xs oz-bg-blue oz-tooltip oz-tooltip-up" oz-title="<?php echo $site['push'] != 1 && $site['push'] != 3 ? '未' : '已'; ?>推送" onclick="pushUrl('baidu', '<?php echo $site['link']; ?>', '<?php echo TABLE_SITE; ?>', <?php echo $site['id']; ?>)">百度</button>
                    <button type="button" class="oz-btn oz-btn-xs oz-bg-pink oz-tooltip oz-tooltip-up" oz-title="<?php echo $site['push'] != 2 && $site['push'] != 3 ? '未' : '已'; ?>推送" onclick="pushUrl('bearpaw', '<?php echo $site['link']; ?>', '<?php echo TABLE_SITE; ?>', <?php echo $site['id']; ?>)">熊掌</button>
                  </td>
                  <td>
                      <?php if($site['top'] == 1) { ?>
                        <button type="button" class="oz-btn oz-btn-xs oz-bg-purple oz-tooltip oz-tooltip-up" oz-title="取消置顶" onclick="modifyOne('<?php echo TABLE_SITE; ?>', <?php echo $site['id']; ?>, 'top', 0)">是</button>
                      <?php } elseif($site['top'] == 0) { ?>
                        <button type="button" class="oz-btn oz-btn-xs oz-bg-brown oz-tooltip oz-tooltip-up" oz-title="点击置顶" onclick="modifyOne('<?php echo TABLE_SITE; ?>', <?php echo $site['id']; ?>, 'top', 1)">否</button>
                      <?php } ?>
                  </td>
                  <td>
                      <?php if($site['state'] == 1) { ?>
                        <button type="button" class="oz-btn oz-btn-xs oz-bg-green oz-badge-radius oz-tooltip oz-tooltip-up" oz-title="点击隐藏" onclick="modifyOne('<?php echo TABLE_SITE; ?>', <?php echo $site['id']; ?>, 'state', 0)">显示</button>
                      <?php } else { ?>
                        <button type="button" class="oz-btn oz-btn-xs oz-badge-radius oz-tooltip oz-tooltip-up" oz-title="点击显示" onclick="modifyOne('<?php echo TABLE_SITE; ?>', <?php echo $site['id']; ?>, 'state', 1)">隐藏</button>
                      <?php } ?>
                  </td>
                  <td><?php echo $site['zhiding_time']; ?></td>
                  <td>
                    <button type="button" class="oz-btn oz-btn-xs oz-bg-blue" onclick="editPopup('修改站点信息', '<?php echo TABLE_SITE; ?>', <?php echo $site['id']; ?>)">修改</button>
                    <button type="button" class="oz-btn oz-btn-xs oz-bg-red" onclick="deleteOne('<?php echo TABLE_SITE; ?>', <?php echo $site['id']; ?>)">删除</button>
                  </td>
                </tr>
              <?php } ?>
              </tbody>
            </table>
          </div>
          <div class="oz-form-group">
            <span class="oz-form-label">移动分类</span>
            <label class="oz-form-field">
              <select name="sortId" id="move-sortId">
                <option value="">请选择分类</option>
                  <?php foreach($sorts as $sort) { ?>
                    <option value="<?php echo $sort['id']; ?>"><?php echo $sort['name']; ?></option>
                  <?php } ?>
              </select>
            </label>
            <span class="oz-form-btn">
							<button type="submit" class="oz-btn oz-bg-blue" onclick="moveSort('<?php echo TABLE_SITE; ?>')">确定执行</button>
			 			</span>
          </div>
        </form>
          <?php echo paging($countSite, $nowPage, $pageSize); ?>
      </div>
    </div>
  </div>

  <div class="popup" id="add-popup">
    <div class="oz-quote">
      <p>温馨提示：别名必须以字母开头，可包含字母、数字和下划线</p>
    </div>
    <form id="site-add" method="post" onsubmit="return false">
        <?php if($CONFIG['order'] == 'serial ASC' || $CONFIG['order'] == 'serial DESC') { ?>
          <div class="oz-form-group">
            <span class="oz-form-label">序号</span>
            <label class="oz-form-field">
              <input type="text" placeholder="请输入站点序号[必填，只能填数字]" name="serial" id="serial" value="0">
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
          <input type="text" class="oz-form-field" placeholder="请输入站点域名[必填]" name="domain" id="domain">
        </label>
      </div>
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
              <?php foreach($sorts as $sort) { ?>
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
        <button type="submit" class="oz-btn oz-bg-blue" style="width: 50%;" onclick="addSite()">添加</button>
      </div>
    </form>
  </div>

  <div class="popup" id="edit-popup">
    <div class="oz-quote">
      <p>温馨提示：别名必须以字母开头，可包含字母、数字和下划线</p>
    </div>
    <form id="site-edit" method="post" onsubmit="return false">
      <label for="site-id">
        <input type="text" name="id" id="site-id" hidden>
      </label>
        <?php if($CONFIG['order'] == 'serial ASC' || $CONFIG['order'] == 'serial DESC') { ?>
          <div class="oz-form-group">
            <span class="oz-form-label">序号</span>
            <label class="oz-form-field">
              <input type="text" placeholder="请输入站点序号[必填，只能填数字]" name="serial" id="site-serial">
            </label>
          </div>
        <?php } ?>
      <div class="oz-form-group">
        <span class="oz-form-label">链接</span>
        <label class="oz-form-field">
          <select name="protocol" id="site-protocol">
            <option value="http://">http://</option>
            <option value="https://">https://</option>
          </select>
        </label>
        <label class="oz-form-field">
          <input type="text" placeholder="请输入站点域名[必填]" name="domain" id="site-domain">
        </label>
      </div>
      <div class="oz-form-group">
        <span class="oz-form-label">名称</span>
        <label class="oz-form-field">
          <input type="text" placeholder="请输入站点名称[必填]" name="name" id="site-name">
        </label>
      </div>
      <div class="oz-form-group">
        <span class="oz-form-label">分类</span>
        <label class="oz-form-field">
          <select name="sortId" id="site-sortId">
            <option value="">请选择站点分类[必选]</option>
              <?php foreach($sorts as $sort) { ?>
                <option value="<?php echo $sort['id']; ?>"><?php echo $sort['name']; ?></option>
              <?php } ?>
          </select>
        </label>
      </div>
      <div class="oz-form-group">
        <span class="oz-form-label">Q Q</span>
        <label class="oz-form-field">
          <input type="text" placeholder="请输入站长QQ[非必填]" name="qq" id="site-qq">
        </label>
      </div>
      <div class="oz-form-group">
        <span class="oz-form-label">别名</span>
        <label class="oz-form-field">
          <input type="text" placeholder="请输入链接别名[非必填]" name="alias" id="site-alias">
        </label>
      </div>
      <div class="oz-form-group">
        <span class="oz-form-label">置顶</span>
        <label class="oz-form-field">
          <select name="top" id="site-top">
            <option value="0">否</option>
            <option value="1">是</option>
          </select>
        </label>
      </div>
      <div class="oz-form-group">
        <span class="oz-form-label">状态</span>
        <label class="oz-form-field">
          <select name="state" id="site-state">
            <option value="1">显示</option>
            <option value="0">隐藏</option>
          </select>
        </label>
      </div>
      <div class="oz-center">
        <button type="button" class="oz-btn" onclick="infoPopup('修改更多信息', true)">更多信息</button>
        <button type="submit" class="oz-btn oz-bg-blue" style="width: 50%;" onclick="editSite()">修改</button>
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

  <div class="popup" id="detail-popup">
    <table class="oz-table oz-table-warp">
      <tbody>
      <tr>
        <th><strong>图标</strong></th>
        <td><img id="detail-ico" src="" alt="" style="width: auto; height: 28px;"></td>
      </tr>
      <tr>
        <th><strong>标题</strong></th>
        <td class="oz-left" id="detail-title"></td>
      </tr>
      <tr>
        <th><strong>关键词</strong></th>
        <td class="oz-left" id="detail-keywords"></td>
      </tr>
      <tr>
        <th><strong>描述</strong></th>
        <td class="oz-left" id="detail-description"></td>
      </tr>
      <tr>
        <th><strong>备案号</strong></th>
        <td id="detail-icp"></td>
      </tr>
      <tr>
        <th><strong>收录时间</strong></th>
        <td id="detail-time"></td>
      </tr>
      <tr>
        <th><strong>日浏览数</strong></th>
        <td id="detail-dayView"></td>
      </tr>
      <tr>
        <th><strong>月浏览数</strong></th>
        <td id="detail-monthView"></td>
      </tr>
      <tr>
        <th><strong>总浏览数</strong></th>
        <td id="detail-totalView"></td>
      </tr>
      <tr>
        <th><strong>点赞次数</strong></th>
        <td id="detail-love"></td>
      </tr>
      </tbody>
    </table>
  </div>

<?php
    require_once 'footer.php';
?>
