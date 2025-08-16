<?php
    $act = $_GET['act'];
    if($act == 'add') {
        $title = '新建单页';
    } elseif($act == 'edit') {
        $title = '编辑单页';
    } else {
        $title = '单页列表';
    }
    require_once 'header.php';
?>

<!-- 正文开始 -->
<div class="layui-fluid">
    <div class="layui-card">
        <div class="layui-card-body">
        <div>
            <!-- 表格工具栏 -->
            <?php if($act == 'add') { ?>
        <form id="post-add" method="post" onsubmit="return false">

        <div class="oz-panel-head"><strong>发布单页</strong></div>
        <div class="oz-panel-body">
          <label> 
          </label>
              <div class="form-group">
                <label for="web_site_title">标题</label>
                <input class="form-control" type="text" name="title" id="title" placeholder="请输入文章标题" >
              </div>                

              <div class="form-group">
                <label for="web_site_description">内容</label>
                <textarea class="form-control" name="content" id="tContent" rows="18"  placeholder="请输入文章内容[支持HTMl代码]" ></textarea>
              </div>

              </div>

          </div>
            <div class="oz-panel">
              <div class="oz-panel-head"><strong>单页设置</strong></div>
              <div class="oz-panel-body">
                <div class="oz-quote">
                  <p>温馨提示：别名必须以字母开头，可包含字母、数字和下划线</p>
                </div>
                <div class="oz-form-group">
                  <span class="oz-form-label">模板</span>
                  <label class="oz-form-field">
                    <select name="template" id="template">
                      <option value="page">默认模板 - page</option>
                        <?php
                            $templates = getPageTemplates();
                            foreach($templates as $template) {
                                ?>
                              <option value="<?php echo $template['path']; ?>"><?php echo $template['name']; ?></option>
                            <?php } ?>
                    </select>
                  </label>
                </div>
                <div class="oz-form-group">
                  <span class="oz-form-label">别名</span>
                  <label class="oz-form-field">
                    <input type="text" placeholder="请输入链接别名[非必填]" name="alias" id="alias">
                  </label>
                </div>
                <div class="oz-center">
                  <button type="submit" class="oz-btn oz-bg-green" onclick="addPost(1, true)">发布单页</button>
                  <button type="button" class="oz-btn oz-bg-blue" onclick="addPost(0, true)">保存草稿</button>
                  <button type="button" class="oz-btn oz-bg-yellow" onclick="history.back()">返回列表</button>
                </div>
              </div>
            </div>
          </div>
        </form>
      <?php } elseif($act == 'edit') {
          $id = $_GET['id'];
          $page = $DATA->getPageById($id);
          ?>
        <form id="post-edit" method="post" onsubmit="return false">

        <div class="oz-panel-head"><strong>编辑单页</strong></div>
        <div class="oz-panel-body">
          <label>
             <input type="text" name="id" value="<?php echo $page['id']; ?>" hidden>
          </label>
        <div class="form-group">
                <label for="web_site_title">标题</label>
                <input class="form-control" type="text" name="title" id="title" value="<?php echo $page['title']; ?>" placeholder="请输入单页标题" >
                </div>
                
              <div class="form-group">
                <label for="web_site_description">内容</label>
                <textarea class="form-control" name="content" id="tContent" rows="18"  placeholder="请输入文章内容[支持HTMl代码]" ><?php echo $page['content']; ?></textarea>
              </div>
                
                
              </div>

          </div>
            <div class="oz-panel">
              <div class="oz-panel-head"><strong>单页设置</strong></div>
              <div class="oz-panel-body">
                <div class="oz-quote">
                  <p>温馨提示：别名必须以字母开头，可包含字母、数字和下划线</p>
                </div>
                <div class="oz-form-group">
                  <span class="oz-form-label">模板</span>
                  <label class="oz-form-field">
                    <select name="template" id="template">
                      <option value="page">默认模板 - page</option>
                        <?php
                            $templates = getPageTemplates();
                            foreach($templates as $template) {
                                ?>
                              <option value="<?php echo $template['path']; ?>" <?php echo $page['template'] == $template['path'] ? 'selected' : ''; ?>>
                                  <?php echo $template['name']; ?>
                              </option>
                            <?php } ?>
                    </select>
                  </label>
                </div>
                <div class="oz-form-group">
                  <span class="oz-form-label">别名</span>
                  <label class="oz-form-field">
                    <input type="text" placeholder="请输入链接别名[非必填]" name="alias" id="alias" value="<?php echo $page['alias']; ?>">
                  </label>
                </div>
                <div class="oz-center">
                  <button type="submit" class="oz-btn oz-bg-green" onclick="editPost(1, true)">修改单页</button>
                  <button type="button" class="oz-btn oz-bg-blue" onclick="editPost(0, true)">保存草稿</button>
                  <button type="button" class="oz-btn oz-bg-yellow" onclick="history.back()">返回列表</button>
                </div>
              </div>
            </div>
          </div>
        </form>
      <?php } else {
          $pageSize = !empty($_GET['size']) ? $_GET['size'] : 10;
          $nowPage = !empty($_GET['page']) ? $_GET['page'] : 1;
          $startNum = ($nowPage - 1) * $pageSize;
          $pages = $DATA->getPages($pageSize, $startNum);
          $countPage = $DATA->getCount('page');
          ?>
        <div class="oz-panel">
          <div class="oz-panel-head"><strong>单页列表</strong></div>
          <div class="oz-panel-body">
            <div class="oz-quote wrap-option">
              <div>
                共 <strong><?php echo $countPage; ?></strong> 个单页
                <a href="page.php?act=add" class="oz-btn oz-btn-sm oz-bg-orange" type="button">发布单页</a>
              </div>
              <div style="margin-left: 15px;">
                <button type="button" class="oz-btn oz-btn-sm oz-bg-green" onclick="batchModify('<?php echo TABLE_POST; ?>', 'state', 1)">发布</button>
                <button type="button" class="oz-btn oz-btn-sm" onclick="batchModify('<?php echo TABLE_POST; ?>', 'state', 0)">草稿</button>
                <button type="button" class="oz-btn oz-btn-sm oz-bg-red" onclick="batchDelete('<?php echo TABLE_POST; ?>')">删除</button>
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
                    <th style="width: 50%;text-align: center;">标题</th>
                    <th style="width: 15%;text-align: center;">模板</th>
                    <th style="width: 10%;text-align: center;">别名</th>
                    <th style="width: 5%;text-align: center;">状态</th>
                    <th style="width: 20%;text-align: center;">操作</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php foreach($pages as $page) {
                      $sortName = $DATA->getByKey(TABLE_SORT, 'name', 'id', $page['sortId']);
                      ?>
                    <tr>
                      <td>
                        <label>
                          <input type="checkbox" name="id[]" value="<?php echo $page['id']; ?>">
                        </label>
                      </td>
                      <td>
                        <a href="<?php echo $page['url']; ?>" target="_blank" class="oz-tooltip oz-tooltip-up" oz-title="<?php echo $page['url']; ?>">
                            <?php echo $page['title']; ?>
                        </a>
                      </td>
                      <td><?php echo $page['template']; ?></td>
                      <td><?php echo $page['alias']; ?></td>
                      <td>
                          <?php if($page['state'] == 1) { ?>
                            <button type="button" class="oz-btn oz-btn-xs oz-bg-green oz-badge-radius oz-tooltip oz-tooltip-up" oz-title="转为草稿" onclick="modifyOne('<?php echo TABLE_POST; ?>', <?php echo $page['id']; ?>, 'state', 0)">发布</button>
                          <?php } elseif($page['state'] == 0) { ?>
                            <button type="button" class="oz-btn oz-btn-xs oz-badge-radius oz-tooltip oz-tooltip-up" oz-title="点击发布" onclick="modifyOne('<?php echo TABLE_POST; ?>', <?php echo $page['id']; ?>, 'state', 1)">草稿</button>
                          <?php } ?>
                      </td>
                      <td>
                        <a href="page.php?act=edit&id=<?php echo $page['id']; ?>" class="oz-btn oz-btn-xs oz-bg-blue" type="submit">修改</a>
                        <button type="button" class="oz-btn oz-btn-xs oz-bg-red" onclick="deleteOne('page', <?php echo $page['id'] ?>)">删除</button>
                      </td>
                    </tr>
                  <?php } ?>
                  </tbody>
                </table>
              </div>
            </form>
              <?php echo paging($countPage, $nowPage, $pageSize) ?>
          </div>
        </div>
      <?php } ?>
  </div>

<?php
    require_once 'footer.php';
?>