<?php
    require('../wxpay.php');
    //后台路径
    define('ADMIN_PATH', str_replace('\\', '/', dirname(BTIzzP1027)) . '/');
    //后台目录
    define('ADMIN_DIR', rtrim(substr(ADMIN_PATH, strrpos(rtrim(ADMIN_PATH, '/'), '/') + 1), '/'));
    //后台地址
    define('ADMIN_URL', OZDAO_URL . ADMIN_DIR . '/');

    //分页按钮
    function paging($totalNumber, $nowPage, $pageSize = 10) {
        $query = preg_replace('/(&*page=[^&]*)*/', '', $_SERVER['QUERY_STRING']);
        $url = '?' . ltrim($query, '&') . (!empty($query) ? '&' : '') . 'page=';
        $totalPage = ceil($totalNumber / $pageSize);
        if($totalPage <= 1) {
            return '';
        }
        $first = 1;
        $prev = $nowPage - 1;
        $next = $nowPage + 1;
        $last = $totalPage;
        $html = '';
        $html .= '<div class="oz-center">';
        $html .= '<ul class="oz-pagination">';
        if($nowPage < 6) {
            for($i = 1; $i <= $totalPage; $i++) {
                if($nowPage <= 6) {
                    if($i > 6)
                        continue;
                }
                if($nowPage == $i) {
                    $html .= '<li class="disabled active"><a>' . $nowPage . '</a></li>';
                } else {
                    $html .= '<li><a href="' . $url . $i . '">' . $i . '</a></li>';
                }
            }
            if($totalPage > 6) {
                $html .= '<li class="disabled"><a>...</a></li>';
                $html .= '<li><a href="' . $url . $last . '">' . $last . '</a></li>';
            }
        } elseif($nowPage >= 6 && $nowPage <= $totalPage - 5) {
            $html .= '<li><a href="' . $url . $first . '">' . $first . '</a></li><li class="disabled"><a>...</a></li>';
            for($i = $prev - 1; $i <= $next + 1; $i++) {
                if($nowPage == $i) {
                    $html .= '<li class="disabled active"><a>' . $nowPage . '</a></li>';
                } else {
                    $html .= '<li><a href="' . $url . $i . '">' . $i . '</a></li>';
                }
            }
            if($totalPage > 6) {
                $html .= '<li class="disabled"><a>...</a></li><li><a href="' . $url . $last . '">' . $last . '</a></li>';
            }
        } elseif($nowPage > $totalPage - 5) {
            if($totalPage > 6) {
                $html .= '<li><a href="' . $url . $first . '">' . $first . '</a></li><li class="disabled"><a>...</a></li>';
            }
            for($i = 1; $i <= $totalPage; $i++) {
                if($nowPage >= $totalPage - 6) {
                    if($i <= $totalPage - 6)
                        continue;
                }
                if($nowPage == $i) {
                    $html .= '<li class="disabled active"><a>' . $nowPage . '</a></li>';
                } else {
                    $html .= '<li><a href="' . $url . $i . '">' . $i . '</a></li>';
                }
            }
        }
        $html .= '</ul></div>';
        return $html;
    }
    //获取模板
    function getTemplates() {
        $handle = opendir(TL_PATH) or die('总裁模板路径错误!');
        $templates = [];
        while($file = readdir($handle)) {
            $configFile = TL_PATH . $file . '/config.json';
            if(is_file($configFile)) {
                $jsonString = file_get_contents($configFile);
                $data = json_decode($jsonString, 320);
                $author = !empty($data['author']) ? $data['author'] : '';
                $authorUrl = !empty($data['authorUrl']) ? $data['authorUrl'] : '';
                $template['name'] = !empty($data['name']) ? $data['name'] : $file;
                $template['version'] = !empty($data['version']) ? $data['version'] : '';
                $template['description'] = !empty($data['description']) ? $data['description'] : '';
                $template['author'] = !empty($authorUrl) ? ('<a href="' . $authorUrl . ' target="_blank" onclick="event.stopPropagation()">' . $author . '</a>') : $author;
                $template['file'] = $file;
                $templates[] = $template;
            }
        }
        @closedir($handle);
        return $templates;
    }

    //检测模板是否正常
    function checkTemplate($template) {
        $dir = TL_PATH . $template;
        if(is_dir($dir) && is_file($dir . '/config.json')) {
            return true;
        }
        return false;
    }

    //获取单页模板
    function getPageTemplates() {
        $templates = [];
        $configFile = TEMPLATE_PATH . 'config.json';
        if(!is_file($configFile)) {
            return $templates;
        }
        $jsonString = file_get_contents($configFile);
        $data = json_decode($jsonString, 320);
        $pageTemplates = $data['pageTemplates'];
        if(!is_array($pageTemplates)) {
            return $templates;
        }
        foreach($pageTemplates as $pageTemplate) {
            $path = $pageTemplate['path'];
            $name = $pageTemplate['name'];
            if(empty($path) || empty($name)) {
                continue;
            }
            $template['path'] = $path;
            $template['name'] = $name . ' - ' . $path;
            $templates[] = $template;
        }
        return $templates;
    }

    //获取文件大小并转换单位
    function getFileSize($filePath) {
        $fileSize = filesize($filePath);
        $KB = 1024;
        $MB = 1024 * $KB;
        $GB = 1024 * $MB;
        $TB = 1024 * $GB;
        if($fileSize < $KB) {
            return $fileSize . 'B';
        } elseif($fileSize < $MB) {
            return round($fileSize / $KB, 2) . 'KB';
        } elseif($fileSize < $GB) {
            return round($fileSize / $MB, 2) . 'MB';
        } elseif($fileSize < $TB) {
            return round($fileSize / $GB, 2) . 'GB';
        } else {
            return round($fileSize / $TB, 2) . 'TB';
        }
    }

    //获取文件创建时间并转换格式
    function getFileTime($filePath, $format = 'Y-m-d H:i:s') {
        $fileTime = filectime($filePath);
        return date($format, $fileTime);
    }

    //获取文件数组
    function getFileList($dirPath, $suffix = null) {
        $pattern = $dirPath . '*' . ($suffix ? ('.' . $suffix) : '');
        return glob($pattern);
    }

    //复制文件或目录
    function copyFile($source, $dest, $delete = false) {
        if(is_file($source)) {
            $dir = dirname($dest);
            !is_dir($dir) && mkdir($dir, 0777, true);
            if(!copy($source, $dest)) {
                return false;
            }
        } elseif(is_dir($source)) {
            !is_dir($dest) && mkdir($dest, 0777, true);
            if(!$handle = opendir($source)) {
                return false;
            }
            while($fileName = readdir($handle)) {
                if($fileName == '.' || $fileName == '..') {
                    continue;
                }
                $newSource = $source . '/' . $fileName;
                $newDest = $dest . '/' . $fileName;
                if(is_dir($newSource)) {
                    copyFile($newSource, $newDest, $delete);
                } elseif(is_file($newSource)) {
                    if(copy($newSource, $newDest)) {
                        $delete && unlink($newSource);
                    }
                }
            }
            closedir($handle);
        } else {
            return false;
        }
        $delete && deleteFile($source);
        return true;
    }

    //移动文件或目录
    function moveFile($source, $dest) {
        return copyFile($source, $dest, true);
    }

    //删除文件或目录
    function deleteFile($filePath) {
        $filePath = trim($filePath);
        if(empty($filePath)) {
            return false;
        }
        if(is_file($filePath)) {
            return unlink($filePath);
        } elseif(is_dir($filePath)) {
            if(!$handle = opendir($filePath)) {
                return false;
            }
            while($fileName = readdir($handle)) {
                if($fileName == '.' || $fileName == '..') {
                    continue;
                }
                deleteFile($filePath . '/' . $fileName);
            }
            closedir($handle);
            @rmdir($filePath);
        }
        if(file_exists($filePath) && !rmdir($filePath)) {
            return false;
        }
        return true;
    }

    //添加目录中文件到zip压缩包中
    function addDirToZip($dirPath, $zipObject, $skipPath = null) {
        if(!$handle = opendir($dirPath)) {
            return;
        }
        while($fileName = readdir($handle)) {
            if($fileName == '.' || $fileName == '..') {
                continue;
            }
            $newPath = $dirPath . '/' . $fileName;
            if($newPath == $skipPath) {
                continue;
            }
            if(is_dir($newPath)) {
                addDirToZip($newPath, $zipObject, $skipPath);
            } elseif(is_file($newPath)) {
                $zipObject->addFile($newPath);
            }
        }
        closedir($handle);
    }

    //zip压缩
    function zipped($filePath, $savePath, $skipPath = null) {
        $skipPath = rtrim($skipPath, '/');
        $zip = new ZipArchive();
        if($zip->open($savePath, ZipArchive::CREATE) !== true) {
            return false;
        }
        if(is_array($filePath)) {
            foreach($filePath as $file) {
                if($file == $skipPath) {
                    continue;
                }
                zipped($file, $savePath, $skipPath);
            }
        } elseif(is_file($filePath)) {
            if($filePath != $skipPath) {
                $zip->addFile($filePath, basename($filePath));
            }
        } elseif(is_dir($filePath)) {
            addDirToZip(rtrim($filePath, '/'), $zip, $skipPath);
        } else {
            return false;
        }
        $zip->close();
        return true;
    }

    //zip解压
    function unzip($filePath, $extractPath = null, $delete = true) {
        $extractPath = $extractPath == null ? dirname($filePath) : $extractPath;
        $zip = new ZipArchive();
        if($zip->open($filePath) === true && $zip->extractTo($extractPath)) {
            $zip->close();
            $delete && deleteFile($filePath);
            return true;
        }
        return false;
    }

    //导出数据
    function exportData($savePath, $prefix = DB_PREFIX) {
        $DAO = DAO::getInstance();
        //如果文件路径存在则先删除
        if(is_file($savePath)) {
            unlink($savePath);
        }
        //写入说明信息
        $infoText = "-- ----------------------------\n"
            . "-- 程序名称：总裁导航\n"
            . "-- 程序作者：善与恶\n"
            . "-- 作者官网：auth.dhceo.com\n"
            . "-- 备份时间：" . date("Y-m-d H:i:s") . "\n"
            . "-- ----------------------------\n\n";
        file_put_contents($savePath, $infoText, FILE_APPEND);
        $tables = [];
        //查询数据库中的表，并记录到数组中
        $result = $DAO->query("SHOW TABLES");
        while($row = $result->fetch_assoc()) {
            $table = $row['Tables_in_' . DB_NAME];
            if(!empty($prefix) && substr($table, 0, mb_strlen($prefix)) != $prefix) {
                continue;
            }
            $tables[] = $table;
        }
        //写入表的结构
        foreach($tables as $table) {
            $result = $DAO->query("SHOW CREATE TABLE {$table}");
            $row = $result->fetch_assoc();
            $tableText = "-- ----------------------------\n";
            $tableText .= "-- 表的结构 `{$table}`\n";
            $tableText .= "-- ----------------------------\n";
            $tableText .= "DROP TABLE IF EXISTS `{$table}`;\n";
            $tableText .= "{$row['Create Table']};\n\n";
            file_put_contents($savePath, $tableText, FILE_APPEND);
        }
        //转存表中的数据
        foreach($tables as $table) {
            $result = $DAO->query("SELECT * FROM " . $table);
            if($result->num_rows === 0) {
                continue;
            }
            $infoText = "-- ----------------------------\n";
            $infoText .= "-- 转存表中的数据 `{$table}`\n";
            $infoText .= "-- ----------------------------\n";
            file_put_contents($savePath, $infoText, FILE_APPEND);
            while($row = $result->fetch_assoc()) {
                $dataText = "INSERT INTO `{$table}` VALUES (";
                foreach($row as $val) {
                    $val = myAddSlashes(trim($val));
                    $dataText .= "'{$val}', ";
                }
                //去掉最后一个逗号和空格
                $dataText = substr($dataText, 0, strlen($dataText) - 2);
                $dataText .= ");\n";
                file_put_contents($savePath, $dataText, FILE_APPEND);
            }
            file_put_contents($savePath, "\n", FILE_APPEND);
        }
        return true;
    }

    //导入数据
    function importData($filePath, $delete = true) {
        $DAO = DAO::getInstance();
        $str = '';
        $total = 0;
        $success = 0;
        $fail = '';
        $lines = file($filePath);
        foreach($lines as $line) {
            //去除空字符和换行符和"--"注释
            if(empty($line) || $line == "\n" || substr($line, 0, 2) == "--") {
                continue;
            }
            $str .= $line;
        }
        //根据";\n"条件分隔sql语句
        $sqlArr = explode(";\n", $str);
        foreach($sqlArr as $sql) {
            if(empty($sql)) {
                continue;
            }
            $total++;
            if($DAO->query($sql)) {
                $success++;
            } else {
                $fail = '<br>' . $sql;
            }
        }
        if($total === $success) {
            $delete && unlink($filePath);
            return $success;
        }
        return $success . '条语句执行成功，' . ($total - $success) . '条语句执行失败：' . $fail;
    }