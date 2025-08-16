<?php
    $act = $_GET['act'];
    if($act == 'add') {
        $title = '发布文章';
    } elseif($act == 'edit') {
        $title = '编辑文章';
    } else {
        $title = '文章列表';
    }
    require_once 'header.php';
    $sorts = $DATA->getPostSorts();
?>

<!-- 正文开始 -->
<div class="layui-fluid">
    <div class="layui-card">
        <div class="layui-card-body">
        <div>
            <!-- 表格工具栏 -->
      <?php if($act == 'add') { ?>
        <form id="post-add" method="post" onsubmit="return false">
        <div class="oz-panel-head"><strong>发布文章</strong></div>
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

          
            <div class="oz-panel">
              <div class="oz-panel-head"><strong>文章设置</strong></div>
              <div class="oz-panel-body">
                <div class="oz-quote">
                  <p>温馨提示：别名必须以字母开头，可包含字母、数字和下划线</p>
                </div>
                <div class="oz-form-group">
                  <span class="oz-form-label">分类</span>
                  <label class="oz-form-field">
                    <select name="sortId" id="sortId">
                      <option value="">请选择文章分类[必选]</option>
                        <?php foreach($sorts as $sort) { ?>
                          <option value="<?php echo $sort['id']; ?>"><?php echo $sort['name']; ?></option>
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
                  <button type="submit" class="oz-btn oz-bg-green" onclick="addPost(1)">发布文章</button>
                  <button type="button" class="oz-btn oz-bg-blue" onclick="addPost(0)">保存草稿</button>
                  <button type="button" class="oz-btn oz-bg-yellow" onclick="history.back()">返回列表</button>
                </div>
              </div>
            </div>
         
        </form>
      <?php } elseif($act == 'edit') {
          $id = $_GET['id'];
          $post = $DATA->getPostById($id);
          ?>
        <form id="post-edit" method="post" onsubmit="return false">

              <div class="oz-panel-head"><strong>编辑文章</strong></div>
              <div class="oz-panel-body">
                <label>
                  <input type="text" name="id" value="<?php echo $post['id']; ?>" hidden>
                </label>
              <div class="form-group">
                <label for="web_site_title">标题</label>
                <input class="form-control" type="text" name="title" id="title" value="<?php echo $post['title']; ?>" placeholder="请输入文章标题" >
              </div>
              
              <div class="form-group">
                <label for="web_site_description">内容</label>
                <textarea class="form-control" name="content" id="tContent" rows="18"  placeholder="请输入文章内容[支持HTMl代码]" ><?php echo $post['content']; ?></textarea>
              </div>
              
              </div>

         
           <div class="oz-panel">
               <div class="oz-panel-body">
                <div class="oz-quote">
                  <p>温馨提示：别名必须以字母开头，可包含字母、数字和下划线</p>
                </div>
                <div class="oz-form-group">
                  <span class="oz-form-label">分类</span>
                  <label class="oz-form-field">
                    <select name="sortId" id="sortId">
                      <option value="">请选择文章分类[必选]</option>
                        <?php foreach($sorts as $sort) { ?>
                          <option value="<?php echo $sort['id']; ?>" <?php echo $post['sortId'] == $sort['id'] ? 'selected' : ''; ?>>
                              <?php echo $sort['name']; ?>
                          </option>
                        <?php } ?>
                    </select>
                  </label>
                </div>
                <div class="oz-form-group">
                  <span class="oz-form-label">别名</span>
                  <label class="oz-form-field">
                    <input type="text" placeholder="请输入链接别名[非必填]" name="alias" id="alias" value="<?php echo $post['alias']; ?>">
                  </label>
                </div>
                <div class="oz-center">
                  <button type="submit" class="oz-btn oz-bg-green" onclick="editPost(1)">修改文章</button>
                  <button type="button" class="oz-btn oz-bg-blue" onclick="editPost(0)">保存草稿</button>
                  <button type="button" class="oz-btn oz-bg-yellow" onclick="history.back()">返回列表</button>
                </div>
                </div>
                </div>
              </div>
            </div>
          </div>
        </form>
<!--该修改这里了-->      <?php } else {
          $sortId = $_GET['sortId'];
          $keyword = $_GET['keyword'];
          $pageSize = !empty($_GET['size']) ? $_GET['size'] : 10;
          $nowPage = !empty($_GET['page']) ? $_GET['page'] : 1;
          $startNum = ($nowPage - 1) * $pageSize;
          if(!empty($keyword)) {
              $posts = $DATA->getPostsByKeyword($keyword, $pageSize, $startNum);
              $countPost = count($DATA->getPostsByKeyword($keyword));
          } elseif(!empty($sortId)) {
              $posts = $DATA->getPostsBySortId($sortId, $pageSize, $startNum);
              $countPost = $DATA->getCount(TABLE_POST, 'sortId=' . $sortId);
          } else {
              $posts = $DATA->getPosts($pageSize, $startNum);
              $countPost = $DATA->getCount(TABLE_POST);
          }
          ?>
            <div class="oz-quote wrap-option">
              <div>
                  <?php if(!empty($keyword)) {
                      echo "搜索「{$keyword}」结果";
                  } elseif(!empty($sortId)) {
                      $sortName = $DATA->getByKey(TABLE_SORT, 'name', 'id', $sortId);
                      echo "「{$sortName}」分类下";
                  } ?>共 <strong><?php echo $countPost; ?></strong> 篇文章
                <a href="post.php?act=add" class="oz-btn oz-btn-sm oz-bg-orange" type="button">发布文章</a>
<!--                <button type="button" class="oz-btn oz-btn-sm oz-bg-blue" onclick="pushAll('baidu', '<?php /*echo TABLE_POST; */?>')">推送百度</button>
                <button type="button" class="oz-btn oz-btn-sm oz-bg-pink" onclick="pushAll('bearPaw', '<?php /*echo TABLE_POST; */?>')">推送熊掌</button>-->
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
                    <th style="width: 15%;text-align: center;">分类</th>
                    <th style="width: 5%;text-align: center;">别名</th>
                    <th style="width: 10%;text-align: center;">推送</th>
                    <th style="width: 5%;text-align: center;">状态</th>
                    <th style="width: 15%;text-align: center;">操作</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php foreach($posts as $post) {
                      $sortName = $DATA->getByKey(TABLE_SORT, 'name', 'id', $post['sortId']);
                      ?>
                    <tr>
                      <td>
                        <label>
                          <input type="checkbox" name="id[]" value="<?php echo $post['id']; ?>">
                        </label>
                      </td>
                      <td>
                        <a href="<?php echo $post['url']; ?>" target="_blank" class="oz-tooltip oz-tooltip-up" oz-title="<?php echo $post['url']; ?>">
                            <?php echo $post['title']; ?>
                        </a>
                      </td>
                      <td>
                        <a href="post.php?sortId=<?php echo $post['sortId']; ?>">
                            <?php echo $post['sortId'] == '0' ? '暂未分类' : $sortName; ?>
                        </a>
                      </td>
                      <td><?php echo $post['alias']; ?></td>
                      <td>
                        <button type="button" class="oz-btn oz-btn-xs oz-bg-blue oz-tooltip oz-tooltip-up" oz-title="<?php echo $post['push'] != 1 && $post['push'] != 3 ? '未' : '已'; ?>推送" onclick="pushUrl('baidu', '<?php echo $post['url']; ?>', '<?php echo TABLE_POST; ?>', <?php echo $post['id']; ?>)">百度</button>
                        <button type="button" class="oz-btn oz-btn-xs oz-bg-pink oz-tooltip oz-tooltip-up" oz-title="<?php echo $post['push'] != 2 && $post['push'] != 3 ? '未' : '已'; ?>推送" onclick="pushUrl('bearpaw', '<?php echo $post['url']; ?>', '<?php echo TABLE_POST; ?>', <?php echo $post['id']; ?>)">熊掌</button>
                      </td>
                      <td>
                          <?php if($post['state'] == 1) { ?>
                            <button type="button" class="oz-btn oz-btn-xs oz-bg-green oz-badge-radius oz-tooltip oz-tooltip-up" oz-title="转为草稿" onclick="modifyOne('<?php echo TABLE_POST; ?>', <?php echo $post['id']; ?>, 'state', 0)">发布</button>
                          <?php } else { ?>
                            <button type="button" class="oz-btn oz-btn-xs oz-badge-radius oz-tooltip oz-tooltip-up" oz-title="点击发布" onclick="modifyOne('<?php echo TABLE_POST; ?>', <?php echo $post['id']; ?>, 'state', 1)">草稿</button>
                          <?php } ?>
                      </td>
                      <td>
                        <a href="post.php?act=edit&id=<?php echo $post['id']; ?>" class="oz-btn oz-btn-xs oz-bg-blue" type="submit">修改</a>
                        <button type="button" class="oz-btn oz-btn-xs oz-bg-red" onclick="deleteOne('<?php echo TABLE_POST; ?>', <?php echo $post['id']; ?>)">删除</button>
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
							<button type="submit" class="oz-btn oz-bg-blue" onclick="moveSort('<?php echo TABLE_POST; ?>')">确定执行</button>
			 			</span>
              </div>
            </form>
              <?php echo paging($countPost, $nowPage, $pageSize) ?>
          </div>
        </div>
      <?php } ?>
  </div>

<?php
    require_once 'footer.php';
?>