<?php
/*
* +----------------------------------------------------------------------
* | Quotes [ 花开的再灿烂，也有凋谢的一天，致我们过去的青春 ]
* +----------------------------------------------------------------------
* | Name: 适应各种中端、多模板导航系统-总裁导航系统
* +----------------------------------------------------------------------
* | Author: dhCat-总裁 QQ：123456
* +----------------------------------------------------------------------
* | Date: 2021年1月17日 15:14:20
* +----------------------------------------------------------------------
* | Ps: 借鉴者请留版权,感谢！！！
* +----------------------------------------------------------------------
*/
?>
<?php
    require_once 'header.php';
    $files = getFileList(BACKUP_PATH . 'data/', 'sql');
    $countData = count($files);
    $pageSize = !empty($_GET['size']) ? $_GET['size'] : 10;
    $nowPage = !empty($_GET['page']) ? $_GET['page'] : 1;
    $startNum = ($nowPage - 1) * $pageSize;
?>

  <div class="oz-container">
    <div class="oz-xs-12 oz-lg-8">
      <div class="oz-panel">
        <div class="oz-panel-head"><strong>备份列表</strong></div>
        <div class="oz-panel-body">
          <div class="oz-quote wrap-option">
            <div>
              共 <strong><?php echo $countData; ?></strong> 个备份
              <button type="button" class="oz-btn oz-btn-sm oz-bg-orange" onclick="backup('data')">备份数据</button>
            </div>
            <div style="margin-left: 15px;">
              <button type="button" class="oz-btn oz-btn-sm oz-bg-purple" onclick="packDownload('data')">打包下载</button>
              <button type="button" class="oz-btn oz-btn-sm oz-bg-red" onclick="batchDelete('data')">删除</button>
            </div>
          </div>
          <form id="batch" method="post" onsubmit="return false">
            <div class="oz-table-fluid">
              <table class="oz-table">
                <thead>
                <tr>
                  <th style="width: 5%;">
                    <label>
                      <input type="checkbox" onclick="selectAll(this);">
                    </label>
                  </th>
                  <th style="width: 5%;">#</th>
                  <th style="width: 40%;">文件</th>
                  <th style="width: 20%;">时间</th>
                  <th style="width: 10%;">大小</th>
                  <th style="width: 20%;">操作</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    if($countData < $pageSize) {
                        $total = $countData;
                    } else {
                        $total = $pageSize + $startNum;
                        if($total > $countData) {
                            $total = $countData;
                        }
                    }
                    for($i = $startNum; $i < $total; $i++) {
                        ?>
                      <tr>
                        <td>
                          <label>
                            <input type="checkbox" name="id[]" value="<?php echo $files[$i]; ?>">
                          </label>
                        </td>
                        <td><?php echo $i + 1; ?></td>
                        <td>
                          <a href="<?php echo BACKUP_URL . 'data/' . basename($files[$i]); ?>" class="oz-tooltip oz-tooltip-up" oz-title="点击下载"><?php echo basename($files[$i]); ?></a>
                        </td>
                        <td><?php echo getFileTime($files[$i]); ?></td>
                        <td><?php echo getFileSize($files[$i]); ?></td>
                        <td>
                          <button type="button" class="oz-btn oz-btn-xs oz-bg-blue" onclick="recover('data', '<?php echo $files[$i]; ?>')">恢复</button>
                          <button type="button" class="oz-btn oz-btn-xs oz-bg-red" onclick="deleteOne('data', '<?php echo $files[$i]; ?>')">删除</button>
                        </td>
                      </tr>
                    <?php } ?>
                </tbody>
              </table>
            </div>
          </form>
            <?php echo paging($countData, $nowPage, $pageSize); ?>
        </div>
      </div>
    </div>
    <div class="oz-xs-12 oz-lg-4">
      <div class="oz-panel">
        <div class="oz-panel-head"><strong>导入数据</strong></div>
        <div class="oz-panel-body">
          <div class="oz-quote">
            <p>该操作将会导入新数据到数据库中！请做好备份工作！！！</p>
            <p>仅可导入sql格式的数据文件，且数据库表前缀需保持一致！</p>
            <p>当前数据库表前缀：<strong><?php echo DB_PREFIX; ?></strong></p>
          </div>
          <form method="post" onsubmit="return false">
            <div class="oz-upload">
              <label class="oz-btn oz-bg-orange" onchange="selectFile(this, 'sql')">
                <input type="file" name="data" id="data">
                <i class="fa fa-folder-open fa-fw"></i> 选择
              </label>
              <span class="file-name">请选择文件</span>
            </div>
            <div class="oz-center">
              <button type="submit" class="oz-btn oz-bg-blue" style="width: 50%;" onclick="uploadFile('data')">确定导入</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

<?php
    require_once 'footer.php';
?>