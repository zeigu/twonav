<?php
    require_once 'function.php';
    //管理后台api
    header('Content-type:application/json; charset=utf-8');
    //判断是否有来路或者来路是否为本站
    if(isOtherReferer()) {
        returnJson(400, '非法来路');
    }
    session_start();
    $request = [];
    //转义POST数据
    foreach($_POST as $key => $value) {
        $request[$key] = myAddSlashes($value);
    }
    list($type, $method) = explode('_', strtolower($_GET['act']));
    $DATA = Data::getInstance(true);
    $DAO = $DATA->getDao();

    //修改单个字段
    function modifyField($table, $id, $key, $value) {
        global $DAO;
        $result = false;
        $ids = is_array($id) ? $id : [$id];
        foreach($ids as $id) {
            $result = $DAO->updateById($table, $id, [
                $key => $value
            ]);
        }
        if($result) {
            returnJson(200, '修改成功');
        }
        returnJson(400, $DAO->getErrorMsg());
    }

    //删除单条记录
    function deleteRecord($table, $id, $callback = false) {
        global $DAO;
        $result = false;
        $ids = is_array($id) ? $id : [$id];
        foreach($ids as $id) {
            $result = $DAO->deleteById($table, $id);
        }
        if($callback) {
            return $result ? $result : $DAO->getErrorMsg();
        }
        if($result) {
            returnJson(200, '删除成功');
        }
        returnJson(400, $DAO->getErrorMsg());
        return false;
    }

    //上传文件
    function uploadFile($name, $savePath, $callback = false) {
        if(!is_uploaded_file($_FILES[$name]['tmp_name'])) {
            if($callback) {
                return false;
            }
            returnJson(400, '未选择上传的文件');
        }
        $file = $_FILES[$name];
        $dir = dirname($savePath);
        !is_dir($dir) && mkdir($dir, 0777, true);
        if(move_uploaded_file($file['tmp_name'], $savePath)) {
            if($callback) {
                return $savePath;
            }
            returnJson(200, '上传成功');
        }
        returnJson(500, '请检查权限');
        return false;
    }

    switch($type) {
        //广告管理
        case TABLE_AD:
            switch($method) {
                //获取全部广告
                case 'all':
                    $result = $DATA->getAds($request['num'], $request['startNum']);
                    if($result) {
                        returnJson(200, 'OK', $result);
                    }
                    returnJson(404, '查询为空');
                    break;
                //获取单个广告
                case 'one':
                    $result = $DATA->getAdById($request['id']);
                    if($result) {
                        returnJson(200, 'OK', $result);
                    }
                    returnJson(404, '查询为空');
                    break;
                //添加广告
                case 'add':
                    $result = $DAO->insertOne(TABLE_AD, [
                        'page' => $request['page'],
                        'title' => $request['title'],
                        'picture' => addProtocol($request['picture']),
                        'url' => addProtocol($request['url'])
                    ]);
                    if($result) {
                        returnJson(200, '添加成功', ['id' => $DAO->getInsertId()]);
                    }
                    returnJson(400, $DAO->getErrorMsg());
                    break;
                //修改广告信息
                case 'edit':
                    $result = $DAO->updateById(TABLE_AD, $request['id'], [
                        'page' => $request['page'],
                        'title' => $request['title'],
                        'picture' => addProtocol($request['picture']),
                        'url' => addProtocol($request['url']),
                        'state' => $request['state']
                    ]);
                    if($result) {
                        returnJson(200, '修改成功');
                    }
                    returnJson(400, $DAO->getErrorMsg());
                    break;
                //修改广告单个字段
                case 'modify':
                    modifyField(TABLE_AD, $request['id'], $request['key'], $request['value']);
                    break;
                //删除广告
                case 'delete':
                    deleteRecord(TABLE_AD, $request['id']);
                    break;
                default:
                    returnJson(400, '无效方法');
            }
            break;
        //系统导航
        case TABLE_NAV:
            switch($method) {
                //获取全部导航
                case 'all':
                    $result = $DATA->getNavs($request['num'], $request['startNum']);
                    if($result) {
                        returnJson(200, 'OK', $result);
                    }
                    returnJson(404, '查询为空');
                    break;
                //获取单个导航
                case 'one':
                    $result = $DATA->getNavById($request['id']);
                    if($result) {
                        returnJson(200, 'OK', $result);
                    }
                    returnJson(404, '查询为空');
                    break;
                //添加导航
                case 'add':
                    $type = $request['type'];
                    $result = false;
                    if($type == 1) {
                        $result = $DAO->insertOne(TABLE_NAV, [
                            'serial' => $request['serial'],
                            'icon' => $request['icon'],
                            'name' => $request['name'],
                            'url' => addProtocol($request['url']),
                            'type' => 1,
                            'tid' => 0,
                            'newTab' => $request['newTab']
                        ]);
                    } elseif($type == 2) {
                        $sortIds = $request['sortId'];
                        foreach($sortIds as $sortId) {
                            if(!$sort = $DATA->getSortById($sortId)) {
                                continue;
                            }
                            $result = $DAO->insertOne(TABLE_NAV, [
                                'icon' => $sort['icon'],
                                'name' => $sort['name'],
                                'type' => 2,
                                'tid' => $sort['id']
                            ]);
                        }
                    } elseif($type == 3) {
                        $pageIds = $request['pageId'];
                        foreach($pageIds as $pageId) {
                            if(!$post = $DATA->getPageById($pageId)) {
                                continue;
                            }
                            $result = $DAO->insertOne(TABLE_NAV, [
                                'name' => $post['title'],
                                'type' => 3,
                                'tid' => $post['id']
                            ]);
                        }
                    }
                    if($result) {
                        returnJson(200, '添加成功', ['id' => $DAO->getInsertId()]);
                    }
                    returnJson(400, $DAO->getErrorMsg());
                    break;
                //修改导航信息
                case 'edit':
                    $fields = [
                        'serial' => $request['serial'],
                        'icon' => $request['icon'],
                        'name' => $request['name'],
                        'newTab' => $request['newTab'],
                        'state' => $request['state']
                    ];
                    if(!empty($request['url'])) {
                        $fields['url'] = addProtocol($request['url']);
                    }
                    $result = $DAO->updateById(TABLE_NAV, $request['id'], $fields);
                    if($result) {
                        returnJson(200, '修改成功');
                    }
                    returnJson(400, $DAO->getErrorMsg());
                    break;
                //修改导航单个字段
                case 'modify':
                    modifyField(TABLE_NAV, $request['id'], $request['key'], $request['value']);
                    break;
                //删除导航
                case 'delete':
                    deleteRecord(TABLE_NAV, $request['id']);
                    break;
                default:
                    returnJson(400, '无效方法');
            }
            break;
        //用户管理
        case TABLE_USER:
            switch($method) {
                //获取全部用户
                case 'all':
                    $result = $DATA->getUsers($request['num'], $request['startNum']);
                    if($result) {
                        returnJson(200, 'OK', $result);
                    }
                    returnJson(404, '查询为空');
                    break;
                //获取单个用户
                case 'one':
                    $result = $DATA->getUserById($request['id']);
                    if($result) {
                        returnJson(200, 'OK', $result);
                    }
                    returnJson(404, '查询为空');
                    break;
                //添加用户
                case 'add':
                    if($DATA->isUsernameRepeat($request['username'])) {
                        returnJson(400, '用户名已被注册');
                    }
                    if($DATA->isUserEmailRepeat($request['email'])) {
                        returnJson(400, '该邮箱已被注册');
                    }
                    $result = $DAO->insertOne(TABLE_USER, [
                        'username' => $request['username'],
                        'password' => md5($request['password']),
                        'qq' => $request['qq'],
                        'avatar' => $request['avatar'],
                        'email' => $request['email'],
                        'intro' => $request['intro'],
                        'time' => time(),
                        'state' => 1
                    ]);
                    if($result) {
                        returnJson(200, '添加成功', ['id' => $DAO->getInsertId()]);
                    }
                    returnJson(400, $DAO->getErrorMsg());
                    break;
                //修改用户信息
                case 'edit':
                    if($DATA->isUsernameRepeat($request['username'], $request['id'])) {
                        returnJson(400, '用户名已被注册');
                    }
                    if($DATA->isUserEmailRepeat($request['email'], $request['id'])) {
                        returnJson(400, '邮箱已被用户绑定');
                    }
                    $fields = [
                        'username' => $request['username'],
                        'qq' => $request['qq'],
                        'avatar' => $request['avatar'],
                        'email' => $request['email'],
                        'intro' => $request['intro'],
                        'state' => $request['state']
                    ];
                    if(!empty($request['password'])) {
                        $fields['password'] = md5($request['password']);
                    }
                    $result = $DAO->updateById(TABLE_USER, $request['id'], $fields);
                    if($result) {
                        //如果修改的是当前登录用户，且修改了用户名或者修改了密码时，重置登录token
                        if($USER['id'] == $request['id'] && ($USER['username'] != $fields['username'] || !empty($fields['password']))) {
                            $password = empty($fields['password']) ? $USER['password'] : $fields['password'];
                            $token = authCode($request['id'] . OZDAO_KEY . md5($fields['username'] . $password));
                            if(!setcookie('ozdao_token', $token, time() + 86400)) {
                                returnJson(500, '无法设置Cookie');
                            }
                        }
                        returnJson(200, '修改成功');
                    }
                    returnJson(400, $DAO->getErrorMsg());
                    break;
                //修改用户单个字段
                case 'modify':
                    $ids = $request['id'];
                    if($request['key'] == 'state') {
                        if(is_array($ids)) {
                            foreach($ids as $index => $id) {
                                $role = $DATA->getByKey(TABLE_USER, 'role', 'id', $id);
                                if($role == 1 && $request['value'] != 1) {
                                    unset($ids[$index]);
                                }
                            }
                        } else {
                            $role = $DATA->getByKey(TABLE_USER, 'role', 'id', $ids);
                            if($role == 1 && $request['value'] != 1) {
                                returnJson(400, '不可封停管理员账号');
                            }
                        }
                    }
                    modifyField(TABLE_USER, $ids, $request['key'], $request['value']);
                    break;
                //删除用户
                case 'delete':
                    $ids = $request['id'];
                    if(is_array($ids)) {
                        foreach($ids as $index => $id) {
                            $role = $DATA->getByKey(TABLE_USER, 'role', 'id', $id);
                            if($role == 1) {
                                unset($ids[$index]);
                            }
                        }
                    } else {
                        $role = $DATA->getByKey(TABLE_USER, 'role', 'id', $ids);
                        if($role == 1) {
                            returnJson(400, '不可删除管理员账号');
                        }
                    }
                    deleteRecord(TABLE_USER, $ids);
                    break;
                //用户登录
                case 'login':
                    $token = $DATA->verifyUser($request['username'], $request['password']);
                    if(!$token) {
                        returnJson(401, '账号或密码错误');
                    }
                    if(setcookie('ozdao_token', $token, time() + 86400)) {
                        returnJson(200, '登录成功');
                    }
                    returnJson(500, '无法设置Cookie');
                    break;
                //用户注销登录
                case 'logout':
                    $result = setcookie('ozdao_token', '', time() - 86400);
                    if($result) {
                        returnJson(200, '注销成功');
                    }
                    returnJson(500, '无法清除Cookie');
                    break;
                default:
                    returnJson(400, '无效方法');
            }
            break;
        //分类管理
        case TABLE_SORT:
            switch($method) {
                //获取全部分类
                case 'all':
                    if($request['type'] == 1) {
                        $result = $DATA->getSiteSorts($request['num'], $request['startNum']);
                    } elseif($request['type'] == 2) {
                        $result = $DATA->getPostSorts($request['num'], $request['startNum']);
                    } else {
                        $result = $DATA->getSorts($request['num'], $request['startNum']);
                    }
                    if($result) {
                        returnJson(200, 'OK', $result);
                    }
                    returnJson(404, '查询为空');
                    break;
                //获取单个分类
                case 'one':
                    $result = $DATA->getSortById($request['id']);
                    if($result) {
                        returnJson(200, 'OK', $result);
                    }
                    returnJson(404, '查询为空');
                    break;
                //添加分类
                case 'add':
                    if($DATA->isSortAliasRepeat($request['alias'])) {
                        returnJson(400, '别名不可重复');
                    }
                    $result = $DAO->insertOne(TABLE_SORT, [
                        'serial' => $request['serial'],
                        'type' => $request['type'],
                        'icon' => $request['icon'],
                        'name' => $request['name'],
                        'alias' => $request['alias']
                    ]);
                    if($result) {
                        returnJson(200, '添加成功', ['id' => $DAO->getInsertId()]);
                    }
                    returnJson(400, $DAO->getErrorMsg());
                    break;
                //修改分类信息
                case 'edit':
                    if($DATA->isSortAliasRepeat($request['alias'], $request['id'])) {
                        returnJson(400, '别名不可重复');
                    }
                    $result = $DAO->updateById(TABLE_SORT, $request['id'], [
                        'serial' => $request['serial'],
                        'icon' => $request['icon'],
                        'name' => $request['name'],
                        'alias' => $request['alias'],
                        'state' => $request['state']
                    ]);
                    if($result) {
                        returnJson(200, '修改成功');
                    }
                    returnJson(400, $DAO->getErrorMsg());
                    break;
                //修改分类单个字段
                case 'modify':
                    modifyField(TABLE_SORT, $request['id'], $request['key'], $request['value']);
                    break;
                //删除分类
                case 'delete':
                    $id = $request['id'];
                    $ids = is_array($id) ? $id : [$id];
                    foreach($ids as $id) {
                        $type = $DATA->getByKey(TABLE_SORT, 'type', 'id', $id);
                        if($type == 1) {
                            $DAO->delete(TABLE_SITE, "sortId='$id'");
                        } elseif($type == 2) {
                            $DAO->delete(TABLE_POST, "sortId='$id'");
                        }
                    }
                    $result = deleteRecord(TABLE_SORT, $id, true);
                    if($result === true) {
                        returnJson(200, '删除成功');
                    }
                    returnJson(400, $result);
                    break;
                default:
                    returnJson(400, '无效方法');
            }
            break;
        //站点管理
        case TABLE_SITE:
            switch($method) {
                //获取全部站点
                case 'all':
                    $result = $DATA->getSites($request['num'], $request['startNum']);
                    if($result) {
                        returnJson(200, 'OK', $result);
                    }
                    returnJson(404, '查询为空');
                    break;
                //获取单个站点
                case 'one':
                    $result = $DATA->getSiteById($request['id']);
                    if($result) {
                        returnJson(200, 'OK', $result);
                    }
                    returnJson(404, '查询为空');
                    break;
                //添加站点
                case 'add':
                    $url = addProtocol(rtrim($request['domain'], '/'), $request['protocol']);
                    if($DATA->isSiteAliasRepeat($request['alias'])) {
                        returnJson(400, '别名不可重复');
                    }
                    if($DATA->isSiteUrlRepeat($url)) {
                        returnJson(400, '该站点已存在');
                    }
                    $CONFIG['saveIco'] == '1' && saveIco($url, $request['ico']);
                    $result = $DAO->insertOne(TABLE_SITE, [
                        'serial' => $request['serial'] ? $request['serial'] : 0,
                        'url' => $url,
                        'name' => $request['name'],
                        'sortId' => $request['sortId'],
                        'qq' => $request['qq'],
                        'alias' => $request['alias'],
                        'time' => time(),
                        'top' => $request['top'],
                        'title' => $request['title'],
                        'keywords' => $request['keywords'],
                        'description' => $request['description'],
                        'icp' => $request['icp']
                    ]);
                    if($result) {
                        $insertId = $DAO->getInsertId();
                        $DAO->delete(TABLE_APPLY, "id='{$request['id']}' || url='{$url}'");
                        returnJson(200, '添加成功', ['id' => $insertId]);
                    }
                    returnJson(400, $DAO->getErrorMsg());
                    break;
                //修改站点信息
                case 'edit':
                    $url = addProtocol(rtrim($request['domain'], '/'), $request['protocol']);
                    if($DATA->isSiteAliasRepeat($request['alias'], $request['id'])) {
                        returnJson(400, '别名不可重复');
                    }
                    if($DATA->isSiteUrlRepeat($url, $request['id'])) {
                        returnJson(400, '该站点已存在');
                    }
                    $ico = $request['ico'];
                    $CONFIG['saveIco'] == '1' && substr($ico, 0, mb_strlen(OZDAO_URL)) !== OZDAO_URL && saveIco($url, $ico);
                    $fields = [
                        'serial' => $request['serial'],
                        'url' => $url,
                        'name' => $request['name'],
                        'sortId' => $request['sortId'],
                        'qq' => $request['qq'],
                        'alias' => $request['alias'],
                        'top' => $request['top'],
                        'state' => $request['state'],
                        'title' => $request['title'],
                        'keywords' => $request['keywords'],
                        'description' => $request['description'],
                        'icp' => $request['icp']
                    ];
                    $oldAlias = $DATA->getByKey(TABLE_SITE, 'alias', 'id', $request['id']);
                    $oldAlias != $request['alias'] && $fields['push'] = 0;
                    $result = $DAO->updateById(TABLE_SITE, $request['id'], $fields);
                    if($result) {
                        $DAO->delete(TABLE_APPLY, "id='{$request['id']}' || url='{$url}'");
                        returnJson(200, '修改成功');
                    }
                    returnJson(400, $DAO->getErrorMsg());
                    break;
                //修改站点单个字段
                case 'modify':
                    modifyField(TABLE_SITE, $request['id'], $request['key'], $request['value']);
                    break;
                //移动站点分类
                case 'move':
                    $id = $request['id'];
                    $result = false;
                    $ids = is_array($id) ? $id : [$id];
                    foreach($ids as $id) {
                        $result = $DAO->updateById(TABLE_SITE, $id, [
                            'sortId' => $request['sortId']
                        ]);
                    }
                    if($result) {
                        returnJson(200, '移动成功');
                    }
                    returnJson(400, $DAO->getErrorMsg());
                    break;
                //删除站点
                case 'delete':
                    deleteRecord(TABLE_SITE, $request['id']);
                    break;
                default:
                    returnJson(400, '无效方法');
            }
            break;
        //文章或单页管理
        case TABLE_POST:
            switch($method) {
                //获取全部文章或单页
                case 'all':
                    if($request['isPage'] == 1) {
                        $result = $DATA->getPages($request['num'], $request['startNum']);
                    } else {
                        $result = $DATA->getPosts($request['num'], $request['startNum']);
                    }
                    if($result) {
                        returnJson(200, 'OK', $result);
                    }
                    returnJson(404, '查询为空');
                    break;
                //获取单篇文章或单页
                case 'one':
                    if($request['isPage'] == 1) {
                        $result = $DATA->getPageById($request['id']);
                    } else {
                        $result = $DATA->getPostById($request['id']);
                    }
                    if($result) {
                        returnJson(200, 'OK', $result);
                    }
                    returnJson(404, '查询为空');
                    break;
                //添加文章或单页
                case 'add':
                    if($DATA->isPostAliasRepeat($request['alias'])) {
                        returnJson(400, '别名不可重复');
                    }
                    $fields = [
                        'isPage' => $request['isPage'] ? $request['isPage'] : 0,
                        'title' => $request['title'],
                        'content' => $request['content'],
                        'alias' => $request['alias'],
                        'time' => time(),
                        'state' => $request['state']
                    ];
                    if(!empty($request['sortId'])) {
                        $fields['sortId'] = $request['sortId'];
                    }
                    if(!empty($request['template'])) {
                        $fields['template'] = $request['template'];
                    }
                    $result = $DAO->insertOne(TABLE_POST, $fields);
                    if($result) {
                        returnJson(200, $request['state'] == '1' ? '发布成功' : '保存成功', ['id' => $DAO->getInsertId()]);
                    }
                    returnJson(400, $DAO->getErrorMsg());
                    break;
                //修改文章或单页信息
                case 'edit':
                    if($DATA->isPostAliasRepeat($request['alias'], $request['id'])) {
                        returnJson(400, '别名不可重复');
                    }
                    $fields = [
                        'title' => $request['title'],
                        'content' => $request['content'],
                        'alias' => $request['alias'],
                        'time' => $request['time'],
                        'state' => $request['state']
                    ];
                    if(!empty($request['sortId'])) {
                        $fields['sortId'] = $request['sortId'];
                    }
                    if(!empty($request['template'])) {
                        $fields['template'] = $request['template'];
                    }
                    $oldAlias = $DATA->getByKey(TABLE_POST, 'alias', 'id', $request['id']);
                    $oldAlias != $request['alias'] && $fields['push'] = 0;
                    $result = $DAO->updateById(TABLE_POST, $request['id'], $fields);
                    if($result) {
                        returnJson(200, $request['state'] == '1' ? '修改成功' : '保存成功');
                    }
                    returnJson(400, $DAO->getErrorMsg());
                    break;
                //修改文章/单页单个字段
                case 'modify':
                    modifyField(TABLE_POST, $request['id'], $request['key'], $request['value']);
                    break;
                //移动文章分类
                case 'move':
                    $id = $request['id'];
                    $result = false;
                    $ids = is_array($id) ? $id : [$id];
                    foreach($ids as $id) {
                        $result = $DAO->updateById(TABLE_POST, $id, [
                            'sortId' => $request['sortId']
                        ]);
                    }
                    if($result) {
                        returnJson(200, '移动成功');
                    }
                    returnJson(400, $DAO->getErrorMsg());
                    break;
                //删除文章或单页
                case 'delete':
                    deleteRecord(TABLE_POST, $request['id']);
                    break;
                default:
                    returnJson(400, '无效方法');
            }
            break;
        //友链管理
        case TABLE_LINK:
            switch($method) {
                //获取全部友链
                case 'all':
                    $result = $DATA->getLinks($request['num'], $request['startNum']);
                    if($result) {
                        returnJson(200, 'OK', $result);
                    }
                    returnJson(404, '查询为空');
                    break;
                //获取单个友链
                case 'one':
                    $result = $DATA->getLinkById($request['id']);
                    if($result) {
                        returnJson(200, 'OK', $result);
                    }
                    returnJson(404, '查询为空');
                    break;
                //添加友链
                case 'add':
                    $result = $DAO->insertOne(TABLE_LINK, [
                        'serial' => $request['serial'],
                        'name' => $request['name'],
                        'url' => addProtocol($request['url']),
                        'time' => time(),
                        'newTab' => $request['newTab']
                    ]);
                    if($result) {
                        returnJson(200, '添加成功', ['id' => $DAO->getInsertId()]);
                    }
                    returnJson(400, $DAO->getErrorMsg());
                    break;
                //修改友链信息
                case 'edit':
                    $result = $DAO->updateById(TABLE_LINK, $request['id'], [
                        'serial' => $request['serial'],
                        'name' => $request['name'],
                        'url' => addProtocol($request['url']),
                        'time' => time(),
                        'newTab' => $request['newTab'],
                        'state' => $request['state']
                    ]);
                    if($result) {
                        returnJson(200, '修改成功');
                    }
                    returnJson(400, $DAO->getErrorMsg());
                    break;
                //修改友链单个字段
                case 'modify':
                    modifyField(TABLE_LINK, $request['id'], $request['key'], $request['value']);
                    break;
                //删除友链
                case 'delete':
                    deleteRecord(TABLE_LINK, $request['id']);
                    break;
                default:
                    returnJson(400, '无效方法');
            }
            break;
        //申请管理
        case TABLE_APPLY:
            switch($method) {
                //获取全部申请
                case 'all':
                    $result = $DATA->getApplies($request['num'], $request['startNum']);
                    if($result) {
                        returnJson(200, 'OK', $result);
                    }
                    returnJson(404, '查询为空');
                    break;
                //获取单个申请
                case 'one':
                    $result = $DATA->getApplyById($request['id']);
                    if($result) {
                        returnJson(200, 'OK', $result);
                    }
                    returnJson(404, '查询为空');
                    break;
                //通过申请
                case 'pass':
                    $id = $request['id'];
                    $result = false;
                    $ids = is_array($id) ? $id : [$id];
                    foreach($ids as $id) {
                        $apply = $DATA->getApplyById($id);
                        $result = $DAO->insertOne(TABLE_SITE, [
                            'name' => $apply['name'],
                            'sortId' => $apply['sortId'],
                            'qq' => $apply['qq'],
                            'url' => $apply['url'],
                            'time' => time()
                        ]);
                        if($result) {
                            $DAO->delete(TABLE_APPLY, "id='{$apply['id']}' || url='{$apply['url']}'");
                        }
                    }
                    if($result) {
                        returnJson(200, '通过成功');
                    }
                    returnJson(400, $DAO->getErrorMsg());
                    break;
                //删除申请
                case 'delete':
                    deleteRecord(TABLE_APPLY, $request['id']);
                    break;
                default:
                    returnJson(400, '无效方法');
            }
            break;
        //公告管理
        case TABLE_NOTICE:
            switch($method) {
                //获取全部公告
                case 'all':
                    $result = $DATA->getNotices($request['num'], $request['startNum']);
                    if($result) {
                        returnJson(200, 'OK', $result);
                    }
                    returnJson(404, '查询为空');
                    break;
                //获取单个公告
                case 'one':
                    $result = $DATA->getNoticeById($request['id']);
                    if($result) {
                        returnJson(200, 'OK', $result);
                    }
                    returnJson(404, '查询为空');
                    break;
                //添加公告
                case 'add':
                    $result = $DAO->insertOne(TABLE_NOTICE, [
                        'time' => time(),
                        'content' => $request['content']
                    ]);
                    if($result) {
                        returnJson(200, '发布成功', ['id' => $DAO->getInsertId()]);
                    }
                    returnJson(400, $DAO->getErrorMsg());
                    break;
                //修改公告信息
                case 'edit':
                    $result = $DAO->updateById(TABLE_NOTICE, $request['id'], [
                        'time' => time(),
                        'content' => $request['content']
                    ]);
                    if($result) {
                        returnJson(200, '修改成功');
                    }
                    returnJson(400, $DAO->getErrorMsg());
                    break;
                //删除公告
                case 'delete':
                    deleteRecord(TABLE_NOTICE, $request['id']);
                    break;
                default:
                    returnJson(400, '无效方法');
            }
            break;
        //网站配置
        case TABLE_CONFIG:
            switch($method) {
                //修改配置信息
                case 'edit':
                    $result = false;
                    foreach($request as $key => $value) {
                        $result = $DAO->insertOne(TABLE_CONFIG, [
                            'name' => $key,
                            'main' => $value
                        ], true);
                    }
                    if($result) {
                        returnJson(200, '修改成功');
                    }
                    returnJson(400, $DAO->getErrorMsg());
                    break;
                default:
                    returnJson(400, '无效方法');
            }
            break;
        //模板管理
        case 'template':
            switch($method) {
                //更换模板
                case 'change':
                    $template = $request['template'];
                    if(!checkTemplate($template)) {
                        returnJson(500, '该模板已不存在或已损坏');
                    }
                    $result = $DAO->update('config', [
                        'main' => $template
                    ], "name='template'");
                    if($result) {
                        returnJson(200, '更换成功');
                    }
                    returnJson(500, '更换失败');
                    break;
                //上传并安装模板
                case 'upload':
                    $file = $_FILES['template'];
                    $path = TL_PATH . $file['name'];
                    if(uploadFile('template', $path, true)) {
                        if(unzip($path, TL_PATH)) {
                            returnJson(200, '安装成功');
                        }
                        returnJson(500, '解压失败，请检查上传的zip压缩包，或检查权限');
                    }
                    returnJson(500, '安装失败，请检查权限');
                    break;
                //下载模板
                case 'download':
                    $file = file_get_contents($request['url']);
                    if(empty($file)) {
                        returnJson(500, '模板下载路径失效');
                    }
                    $path = TL_PATH . basename($request['url']);
                    !is_dir(TL_PATH) && mkdir(TL_PATH, 0777, true);
                    if(!file_put_contents($path, $file)) {
                        returnJson(500, '模板下载失败');
                    }
                    $result = unzip($path, TL_PATH);
                    if($result === true) {
                        returnJson(200, '安装成功');
                    }
                    returnJson(500, '解压失败');
                    break;
                //刷新模板商店
                case 'refresh':
                    $ip = $_SERVER['HTTP_VIA'] ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
                    $result = httpGet('https://o.ouzero.com:811/auth/?act=get_template&domain=dao.ouzero.com&ip=192.168.1.1');
                    if(empty($result)) {
                        returnJson(500, '获取到的数据为空');
                    }
                    $file = fopen(ADMIN_PATH . 'store.json', 'w');
                    if(fwrite($file, $result)) {
                        fclose($file);
                        returnJson(200, '刷新成功');
                    }
                    fclose($file);
                    returnJson(500, '没有写入文件权限');
                    break;
                //删除模板
                case 'delete':
                    $template = $request['id'];
                    if(empty($template)) {
                        returnJson(400, '模板名不可为空');
                    }
                    if($template == TEMPLATE_NAME) {
                        returnJson(500, '不可删除正在使用的模板');
                    }
                    $result = deleteFile(TL_PATH . $template);
                    if($result) {
                        returnJson(200, '删除成功');
                    }
                    returnJson(500, '请确定该模板存在或检查权限问题');
                    break;
                default:
                    returnJson(400, '无效方法');
            }
            break;
        //通用图片
        case 'image':
            switch($method) {
                //favicon图标
                case 'favicon':
                    uploadFile('favicon', OZDAO_ROOT . 'favicon.ico');
                    break;
                //logo
                case 'logo':
                    uploadFile('logo', IMAGES_PATH . 'logo.png');
                    break;
                //banner图
                case 'banner':
                    uploadFile('banner', IMAGES_PATH . 'banner.jpg');
                    break;
                //loading图
                case 'loading':
                    uploadFile('loading', IMAGES_PATH . 'loading.gif');
                    break;
                //微信二维码
                case 'weixin':
                    uploadFile('weixin', IMAGES_PATH . 'weixin.png');
                    break;
                //图片上传(tinymce编辑器)
                case 'upload':
                    $name = date('Ymd_his') . mt_rand() . '.' . pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
                    if(uploadFile('file', OZDAO_ROOT . 'upload/' . $name, true)) {
                        die(json_encode(['location' => '/upload/' . $name], 320));
                    }
                    returnJson(500, '请检查权限');
                    break;
                default:
                    returnJson(400, '无效方法');
            }
            break;
        //垃圾清理
        case 'clear':
            switch($method) {
                //清除打包缓存
                case 'pack':
                    if(deleteFile(BACKUP_PATH . 'cache')) {
                        returnJson(200, '清除成功');
                    }
                    returnJson(500, '请检查权限');
                    break;
                //清除ico缓存
                case 'ico':
                    if(deleteFile(IMAGES_PATH . 'ico')) {
                        returnJson(200, '清除成功');
                    }
                    returnJson(500, '请检查权限');
                    break;
                default:
                    returnJson(400, '无效方法');
            }
            break;
        //链接推送
        case 'push':
            switch($method) {
                //百度
                case 'baidu':
                    $baiduToken = $CONFIG['baiduToken'];
                    if(empty($baiduToken)) {
                        returnJson(400, '请先设置好百度推送Token');
                    }
                    $url = $request['url'];
                    $urls = is_array($url) ? $url : [$url];
                    $api = 'http://data.zz.baidu.com/urls?site=' . getDomain(OZDAO_URL) . '&token=' . $baiduToken;
                    $result = pushUrls($api, $urls);
                    if(!isset($result['success'])) {
                        returnJson($result['error'], $result['message']);
                    }
                    if(!empty($request['type']) && !empty($request['id'])) {
                        $push = $DATA->getByKey($request['type'], 'push', 'id', $request['id']);
                        if($push != 1 && $push != 3) {
                            $DAO->updateById($request['type'], $request['id'], [
                                'push' => $push == 2 ? 3 : 1
                            ]);
                        }
                    }
                    returnJson(200, '推送成功', $result);
                    break;
                //熊掌
                case 'bearpaw':
                    $bearPawAppId = $CONFIG['bearPawAppId'];
                    $bearPawToken = $CONFIG['bearPawToken'];
                    if(empty($bearPawAppId) || empty($bearPawToken)) {
                        returnJson(400, '请先设置好熊掌推送AppId和Token');
                    }
                    $url = $request['url'];
                    $urls = is_array($url) ? $url : [$url];
                    $api = 'http://data.zz.baidu.com/urls?appid=' . $bearPawAppId . '&token=' . $bearPawToken . '&type=realtime';
                    $result = pushUrls($api, $urls);
                    if(!$result['success_realtime']) {
                        returnJson($result['error'], $result['message']);
                    }
                    if(!empty($request['type']) && !empty($request['id'])) {
                        $push = $DATA->getByKey($request['type'], 'push', 'id', $request['id']);
                        if($push != 2 && $push != 3) {
                            $DAO->updateById($request['type'], $request['id'], [
                                'push' => $push == 1 ? 3 : 2
                            ]);
                        }
                    }
                    returnJson(200, '推送成功', $result);
                    break;
                default:
                    returnJson(400, '无效方法');
            }
            break;
        //邮箱发信
        case 'email':
            switch($method) {
                //发送邮件
                case 'send':
                    $result = sendEmail([
                        'host' => $CONFIG['smtpHost'],
                        'port' => $CONFIG['smtpPort'],
                        'username' => $CONFIG['smtpUsername'],
                        'password' => $CONFIG['smtpPassword']
                    ], [
                        'name' => $CONFIG['name'],
                        'email' => $CONFIG['smtpUsername']
                    ], [
                        'email' => $request['email']
                    ], [
                        'subject' => $request['subject'],
                        'body' => $request['body']
                    ]);
                    if($result === true) {
                        returnJson(200, '发送成功');
                    }
                    returnJson(500, $result);
                    break;
                default:
                    returnJson(400, '无效方法');
            }
            break;
        //系统更新
        case 'update':
            switch($method) {
                //检测更新
                case 'check':
                    $resultData = SF_update_version();
                    if($resultData['code'] == 1) {
                        returnJson(200, 'OK', [
                            'name' => '总裁导航系统',
                            'version' => $resultData['version'],
                            'ver' => $resultData['ver'],
                            'file' => $resultData['file'],
                            'uplog' => $resultData['uplog'],
                            'description' => $resultData['msg']
                        ]);
                    } elseif($resultData['code'] == 0) {
                        returnJson(201, $resultData['msg']);
                    }
                    returnJson(500, $resultData['msg'] ? $resultData['msg'] : '检测失败，请联系QQ：123456');
                    break;
                //检测更新
                case 'online':
                    $resultData = SF_update_version();
                    $RemoteFile = $resultData['file'];
                    $ZipFile = "Update.zip";
                    if (copy($RemoteFile,$ZipFile)) {
                        if (zipExtract($ZipFile,OZDAO_ROOT)) {
                            returnJson(200, '更新成功');
                            unlink($ZipFile);
                        } else {
                            returnJson(500, '更新包解压失败');
                            if(file_exists($ZipFile))unlink($ZipFile);
                        }
                    } else {
                        returnJson(500, '更新包下载失败');
                    }
                    break;
                default:
                    returnJson(400, '无效方法');
            }
            break;
        default:
            returnJson(400, '无效请求');
    }