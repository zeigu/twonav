<?php

    /*
     * 数据池控制
     */
    class Data {
        /**
         * 数据访问对象控制实例
         * @var object
         */
        private $_dao;

        /**
         * 网站配置
         * @var array
         */
        private $_config;

        /**
         * 是否管理员
         * @var bool
         */
        private $_admin;

        /**
         * 内部实例对象
         * @var object|null
         */
        private static $_instance = null;

        public function __construct($admin = false) {
            $this->_admin = $admin;
            $this->_dao = Dao::getInstance();
            $rows = [];
            $result = $this->_dao->select(TABLE_CONFIG);
            if($result) {
                while($row = $result->fetch_assoc()) {
                    $rows[$row['name']] = $row['main'];
                }
                $this->_config = $rows;
            }
        }

        /**
         * 数据池控制对象实例
         * @param bool $admin
         * @return Data|null
         */
        public static function getInstance($admin = false) {
            if(!self::$_instance || self::$_instance->_admin !== $admin) {
                self::$_instance = new Data($admin);
            }
            return self::$_instance;
        }

        /**
         * 返回数据访问对象实例
         * @return Dao|object|null
         */
        public function getDao() {
            return $this->_dao;
        }

        //获取网站配置
        public function getConfig($key = null) {
            if($key) {
                return $this->_config[$key];
            }
            return $this->_config;
        }

        //参数查询
        public function getByFactor($table, $factor = null, $number = null, $startNum = null, $order = null) {
            $rows = [];
            $factor = $factor ? $factor : '';
            $stateFactor = $this->_admin ? $factor : ('state=1' . (!empty($factor) ? (' && ' . $factor) : ''));
            switch($table) {
                case TABLE_AD:
                    $order = $order ? $order : 'id ASC';
                    $result = $this->_dao->select($table, '*', $factor, $order, $number, $startNum);
                    while($row = $result->fetch_assoc()) {
                        if($row['end_time']==0){
                            $row['end_time'] ='后台添加';
                        }else{
                            $row['end_time'] =  date('Y-m-d H:i:s', $row['end_time']);
                        }
                        
                        $rows[] = ($row['state'] == 1 || $this->_admin) ? $row : null;
                    }
                    break;
                case TABLE_NAV:
                    $order = $order ? $order : 'serial ASC,id ASC';
                    $result = $this->_dao->select($table, '*', $stateFactor, $order, $number, $startNum);
                    while($row = $result->fetch_assoc()) {
                        if($row['type'] == '0') {
                            $row['url'] = OZDAO_URL;
                        } elseif($row['type'] == '2') {
                            $row['url'] = Url::sort($row['tid']);
                        } elseif($row['type'] == '3') {
                            $row['url'] = Url::post($row['tid']);
                        }
                        $rows[] = $row;
                    }
                    break;
                case TABLE_ORDER:
                    $order = $order ? $order : 'id ASC,id ASC';
                    $result = $this->_dao->select($table, '*', $stateFactor, $order, $number, $startNum);
                    while($row = $result->fetch_assoc()) {
                        
                        $row['creat_time'] =  date('Y-m-d H:i:s', $row['creat_time']);
                        
                        if($row['status'] == 1) {
                            $row['status'] = '已支付';
                        } 
                        else{
                            $row['status'] = '未支付';
                        }
                        if($row['type']==1){
                            $row['type'] = '置顶站点';
                        }
                        else if($row['type']==2)
                        {
                            $row['type'] = '首页图片';
                        }else if($row['type']==3)
                        {
                            $row['type'] = '文章内页';
                        }else{
                            $row['type'] = '站点详情';
                        }
                        $rows[] = $row;
                    }
                    break;
                case TABLE_USER:
                    $order = $order ? $order : 'time ASC,id ASC';
                    $result = $this->_dao->select($table, '*', $stateFactor, $order, $number, $startNum);
                    while($row = $result->fetch_assoc()) {
                        unset($row['password']);
                        $rows[] = $row;
                    }
                    break;
                case TABLE_SORT:
                    $order = $order ? $order : 'serial ASC,id ASC';
                    $result = $this->_dao->select($table, '*', $stateFactor, $order, $number, $startNum);
                    while($row = $result->fetch_assoc()) {
                        $row['url'] = Url::sort($row['id'], $row['type'], $row['alias']);
                        $rows[] = $row;
                    }
                    break;
                case TABLE_SITE:
                    $order = $order ? $order : ($this->_config['order'] ? $this->_config['order'] : 'id DESC');
                    $result = $this->_dao->select($table, '*', $stateFactor, $order, $number, $startNum);
                    while($row = $result->fetch_assoc()) {
                         if($row['zhiding_time']==0){
                            $row['zhiding_time'] ='后台添加';
                        }else{
                            $row['zhiding_time'] =  date('Y-m-d H:i:s', $row['zhiding_time']);
                        }
                        $row['domain'] = getDomain($row['url']);
                        if(is_file(IMAGES_PATH . 'ico/' . $row['domain'] . '.ico')) {
                            $row['ico'] = IMAGES_URL . 'ico/' . $row['domain'] . '.ico';
                        } else {
                            $row['ico'] = URL .'ico?url=' . $row['url'];
                        }
                        $row['link'] = Url::site($row['id'], $row['alias'], $row['url']);
                        $row['goto'] = Url::jump($row['url']);
                        $rows[] = $row;
                    }
                    break;
                case TABLE_POST:
                    $order = $order ? $order : 'time DESC,id DESC';
                    $result = $this->_dao->select($table, '*', $stateFactor, $order, $number, $startNum);
                    while($row = $result->fetch_assoc()) {
                        $row['url'] = Url::post($row['id'], $row['alias']);
                        $rows[] = $row;
                    }
                    break;
                case TABLE_LINK:
                    $order = $order ? $order : 'serial ASC,id ASC';
                    $result = $this->_dao->select($table, '*', $stateFactor, $order, $number, $startNum);
                    while($row = $result->fetch_assoc()) {
                        $rows[] = $row;
                    }
                    break;
                case TABLE_APPLY:
                case TABLE_NOTICE:
                    $order = $order ? $order : 'time DESC,id DESC';
                    $result = $this->_dao->select($table, '*', $factor, $order, $number, $startNum);
                    while($row = $result->fetch_assoc()) {
                        $rows[] = $row;
                    }
                    break;
            }
            return $rows;
        }

        //通过查询table表中keyName字段值=keyValue获取valueName值
        public function getByKey($table, $valueName, $keyName, $keyValue) {
            $result = $this->_dao->select($table, $valueName, $keyName . "='$keyValue'");
            $row = $result->fetch_assoc();
            return $row[$valueName];
        }
        
        public function getByOrder($table, $valueName, $keyName, $keyValue) {
            $result = $this->_dao->select($table, $valueName, $keyName . "='$keyValue'");
            $row = $result->fetch_assoc();
            return $row;
        }

        //判断字段是否重复（跳过空值和本身）
        private function isFieldRepeat($table, $field, $value, $id = null) {
            $where = "$field !='' && $field='{$value}'";
            if($id !== null) {
                $where .= " && id!='$id'";
            }
            $result = $this->_dao->count($table, $where);
            return $result > 0;
        }

        /*广告Start*/

        //获取网站广告
        public function getAds($number = null, $startNum = null) {
            return $this->getByFactor(TABLE_AD, null, $number, $startNum);
        }

        //通过广告页面获取广告
        public function getAdsByPage($page) {
            return $this->getByFactor(TABLE_AD, "page='$page'");
        }

        //通过广告id获取广告
        public function getAdById($id) {
            return $this->getByFactor(TABLE_AD, 'id=' . $id)[0];
        }

        /*广告End*/

        /*导航Start*/

        //获取系统导航
        public function getNavs($number = null, $startNum = null) {
            return $this->getByFactor(TABLE_NAV, null, $number, $startNum);
        }
        
        public function getNavs2($number = null, $startNum = null) {
            return $this->getByFactor(TABLE_ORDER, null, $number, $startNum);
        }

        //通过分类id获取导航
        public function getNavById($id) {
            return $this->getByFactor(TABLE_NAV, 'id=' . $id)[0];
        }

        /*导航End*/

        /*用户Start*/

        //获取用户
        public function getUsers($number = null, $startNum = null) {
            return $this->getByFactor(TABLE_USER, null, $number, $startNum);
        }

        //通过用户id获取用户
        public function getUserById($id) {
            return $this->getByFactor(TABLE_USER, 'id=' . $id)[0];
        }

        //获取管理员信息
        public function getAdminInfo() {
            return $this->getByFactor(TABLE_USER, 'role=1')[0];
        }

        //用户名是否重复
        public function isUsernameRepeat($username, $id = null) {
            return $this->isFieldRepeat(TABLE_USER, 'username', $username, $id);
        }

        //用户邮箱是否重复
        public function isUserEmailRepeat($email, $id = null) {
            return $this->isFieldRepeat(TABLE_USER, 'email', $email, $id);
        }

        //验证用户的用户名和密码，若传入isAdmin为true者验证为管理员
        public function verifyUser($username, $password, $isAdmin = false) {
            $password = md5($password);
            $where = "username='$username' && password='$password'" . ($isAdmin ? ' && role=1' : '');
            $result = $this->_dao->select(TABLE_USER, '*', $where, null, 1);
            if($result->num_rows == 1) {
                $user = $result->fetch_assoc();
                return authCode($user['id'] . KEY . md5($user['username'] . $user['password']));
            }
            return false;
        }

        //验证管理员的用户名和密码
        public function verifyAdmin($username, $password) {
            return $this->verifyUser($username, $password, true);
        }

        //验证token
        public function verifyToken() {
            $token = $_COOKIE['ozdao_token'];
            if(empty($token)) {
                return false;
            }
            $tokenDecode = authCode(myAddSlashes($token), true);
            list($userId, $secret) = explode(KEY, $tokenDecode);
            $result = $this->_dao->select(TABLE_USER, '*', 'id=' . $userId, null, 1);
            if($result->num_rows != 1) {
                return false;
            }
            $user = $result->fetch_assoc();
            return $secret === md5($user['username'] . $user['password']) ? $user : false;
        }

        /*用户End*/

        /*分类Start*/

        //获取分类
        public function getSorts($number = null, $startNum = null) {
            return $this->getByFactor(TABLE_SORT, null, $number, $startNum);
        }

        //获取站点分类
        public function getSiteSorts($number = null, $startNum = null) {
            return $this->getByFactor(TABLE_SORT, 'type=1', $number, $startNum);
        }

        //获取文章分类
        public function getPostSorts($number = null, $startNum = null) {
            return $this->getByFactor(TABLE_SORT, 'type=2', $number, $startNum);
        }

        //通过分类id获取分类
        public function getSortById($id) {
            return $this->getByFactor(TABLE_SORT, 'id=' . $id)[0];
        }

        //通过分类id获取分类别名
        public function getSortAliasById($id) {
            return $this->getByKey(TABLE_SORT, 'alias', 'id', $id);
        }

        //通过分类别名获取分类id
        public function getSortIdByAlias($alias) {
            return $this->getByKey(TABLE_SORT, 'id', 'alias', $alias);
        }

        //通过分类id获取分类类型
        public function getSortTypeById($id) {
            return $this->getByKey(TABLE_SORT, 'type', 'id', $id);
        }

        //分类别名重复
        public function isSortAliasRepeat($alias, $id = null) {
            return $this->isFieldRepeat(TABLE_SORT, 'alias', $alias, $id);
        }

        /*分类End*/

        /*站点Start*/

        //获取站点
        public function getSites($number = null, $startNum = null) {
            return $this->getByFactor(TABLE_SITE, null, $number, $startNum);
        }

        //通过站点id获取站点
        public function getSiteById($id) {
            return $this->getByFactor(TABLE_SITE, 'id=' . $id)[0];
        }

        //通过分类id获取分类下所有站点
        public function getSitesBySortId($sortId, $number = null, $startNum = null) {
            return $this->getByFactor(TABLE_SITE, 'sortId=' . $sortId, $number, $startNum);
        }

        //通过关键词获取站点
        public function getSitesByKeyword($keyword, $number = null, $startNum = null) {
            return $this->getByFactor(TABLE_SITE, "name LIKE '%$keyword%' || url LIKE '%$keyword%'", $number, $startNum);
        }

        //通过站点id获取站点别名
        public function getSiteAliasById($id) {
            return $this->getByKey(TABLE_SITE, 'alias', 'id', $id);
        }

        //通过站点别名获取站点id
        public function getSiteIdByAlias($alias) {
            return $this->getByKey(TABLE_SITE, 'id', 'alias', $alias);
        }

        //通过站点id获取站点url
        public function getSiteUrlById($id) {
            return $this->getByKey(TABLE_SITE, 'url', 'id', $id);
        }

        //获取置顶站点
        public function getTopSites($number = null, $startNum = null) {
            return $this->getByFactor(TABLE_SITE, "top=1", $number, $startNum);
        }

        //获取最新收录站点
        public function getLatestSites($number = 10, $startNum = null) {
            return $this->getByFactor(TABLE_SITE, null, $number, $startNum, 'time DESC,id DESC');
        }

        //获取随机站点
        public function getRandSites($number = 10, $startNum = null) {
            return $this->getByFactor(TABLE_SITE, null, $number, $startNum, 'rand()');
        }

        //随机相关站点(同分类下其他站点)
        public function getRelatedSites($sortId, $siteId, $number = 10, $startNum = null) {
            return $this->getByFactor(TABLE_SITE, "sortId = '$sortId' && id != '$siteId'", $number, $startNum, 'rand()');
        }

        //获取站点排行榜单 type=day日榜单  type=month月榜单  type=total总榜单
        public function getSiteRanking($type = 'total', $number = 10, $startNum = null, $sortId = null) {
            $nowDate = date('Y-m-d');
            $nowArr = explode('-', $nowDate);
            $order = $type == 'day' ? 'dayView' : ($type == 'month' ? 'monthView' : 'totalView');
            $sites = $this->getByFactor(TABLE_SITE, $sortId ? ('sortId=' . $sortId) : null, $number, $startNum, $order . ' DESC,id DESC');
            foreach($sites as $key => $site) {
                $lastArr = explode('-', $site['lastDate']);
                if($lastArr[2] == $nowArr[2]) {
                    continue;
                }
                $fields = ['lastDate' => $nowDate, 'dayView' => 1];
                $sites[$key]['dayView'] = 1;
                if($lastArr[0] != $nowArr[0] || $lastArr[1] != $nowArr[1]) {
                    $fields['monthView'] = 1;
                    $sites[$key]['monthView'] = 1;
                }
                if($site['totalView'] == 0) {
                    $fields['totalView'] = 1;
                    $sites[$key]['totalView'] = 1;
                }
                $this->_dao->updateById(TABLE_SITE, $site['id'], $fields);
            }
            return $sites;
        }

        //获取今日总浏览数
        public function getDayViewNum() {
            $numberArr = ['siteNum' => 0, 'viewNum' => 0];
            $nowDate = date('Y-m-d');
            $result = $this->_dao->select(TABLE_SITE, 'dayView', "state=1 && dayView>1 && lastDate='$nowDate'");
            while($row = $result->fetch_assoc()) {
                $numberArr['viewNum'] += $row['dayView'];
            }
            $numberArr['siteNum'] = $result->num_rows;
            return $numberArr;
        }

        //获取本月总浏览数
        public function getMonthViewNum() {
            $numberArr = ['siteNum' => 0, 'viewNum' => 0];
            $nowDate = date('Y-m-d');
            $nowArr = explode('-', $nowDate);
            $result = $this->_dao->select(TABLE_SITE, ['monthView', 'lastDate'], 'state=1 && monthView>1');
            while($row = $result->fetch_assoc()) {
                $lastArr = explode('-', $row['lastDate']);
                if($lastArr[0] == $nowArr[0] && $lastArr[1] == $nowArr[1]) {
                    $numberArr['viewNum'] += $row['monthView'];
                    $numberArr['siteNum']++;
                }
            }
            return $numberArr;
        }

        //获取总共总浏览数
        public function getTotalViewNum() {
            $numberArr = ['siteNum' => 0, 'viewNum' => 0];
            $result = $this->_dao->select(TABLE_SITE, 'totalView', 'state=1 && totalView>1');
            while($row = $result->fetch_assoc()) {
                $numberArr['viewNum'] += $row['totalView'];
            }
            $numberArr['siteNum'] = $result->num_rows;
            return $numberArr;
        }

        //站点别名重复
        public function isSiteAliasRepeat($alias, $id = null) {
            return $this->isFieldRepeat(TABLE_SITE, 'alias', $alias, $id) || $this->isFieldRepeat(TABLE_POST, 'alias', $alias);
        }

        //站点链接重复
        public function isSiteUrlRepeat($url, $id = null) {
            return $this->isFieldRepeat(TABLE_SITE, 'url', $url, $id);
        }

        /*站点End*/

        /*文章/单页Start*/

        //通过文章/单页id获取文章/单页别名
        public function getPostAliasById($id) {
            return $this->getByKey(TABLE_POST, 'alias', 'id', $id);
        }

        //通过文章/单页别名获取文章/单页id
        public function getPostIdByAlias($alias) {
            return $this->getByKey(TABLE_POST, 'id', 'alias', $alias);
        }

        //文章/单页别名重复
        public function isPostAliasRepeat($alias, $id = null) {
            return $this->isFieldRepeat(TABLE_POST, 'alias', $alias, $id) || $this->isFieldRepeat(TABLE_SITE, 'alias', $alias);
        }

        /*文章/单页End*/

        /*文章Start*/

        //获取文章
        public function getPosts($number = null, $startNum = null) {
            return $this->getByFactor(TABLE_POST, 'isPage!=1', $number, $startNum);
        }

        //通过文章id获取文章
        public function getPostById($id) {
            return $this->getByFactor(TABLE_POST, 'isPage!=1 && id=' . $id)[0];
        }

        //通过分类id获取分类下所有文章
        public function getPostsBySortId($sortId, $number = null, $startNum = null) {
            return $this->getByFactor(TABLE_POST, 'isPage!=1 && sortId=' . $sortId, $number, $startNum);
        }

        //通过关键词获取站点
        public function getPostsByKeyword($keyword, $number = null, $startNum = null) {
            return $this->getByFactor(TABLE_POST, "title LIKE '%$keyword%'", $number, $startNum);
        }

        //获取最新文章
        public function getLatestPosts($number = 10, $startNum = null) {
            return $this->getByFactor(TABLE_POST, 'isPage!=1', $number, $startNum, 'time DESC,id DESC');
        }

        //获取随机文章
        public function getRandPosts($number = 10, $startNum = null) {
            return $this->getByFactor(TABLE_POST, 'isPage!=1', $number, $startNum, 'rand()');
        }

        //随机相关文章(同分类下其他文章)
        public function getRelatedPosts($sortId, $postId, $number = 10, $startNum = null) {
            return $this->getByFactor(TABLE_POST, "isPage!=1 && sortId = '$sortId' && id != '$postId'", $number, $startNum, 'rand()');
        }

        //获取文章浏览排行榜单
        public function getPostRanking($number = 10, $startNum = null, $sortId = null) {
            return $this->getByFactor(TABLE_POST, 'isPage!=1' . ($sortId ? " && sortId='$sortId'" : ''), $number, $startNum, 'view DESC,time DESC,id DESC');
        }

        /*文章End*/

        /*单页Start*/

        public function getPages($number = null, $startNum = null) {
            return $this->getByFactor(TABLE_POST, 'isPage=1', $number, $startNum);
        }

        //通过文章/单页id获取文章/单页
        public function getPageById($id) {
            return $this->getByFactor(TABLE_POST, 'isPage=1 && id=' . $id)[0];
        }

        /*单页End*/

        /*友链Start*/

        //获取友情链接
        public function getLinks($number = null, $startNum = null) {
            return $this->getByFactor(TABLE_LINK, null, $number, $startNum);
        }

        //通过友链id获取友链
        public function getLinkById($id) {
            return $this->getByFactor(TABLE_LINK, 'id=' . $id)[0];
        }

        /*友链End*/

        /*申请Start*/

        //获取申请
        public function getApplies($number = null, $startNum = null) {
            return $this->getByFactor(TABLE_APPLY, null, $number, $startNum);
        }

        //通过申请id获取申请
        public function getApplyById($id) {
            return $this->getByFactor(TABLE_APPLY, 'id=' . $id)[0];
        }

        //站点链接重复
        public function isApplyUrlRepeat($url, $id = null) {
            return $this->isFieldRepeat(TABLE_APPLY, 'url', $url, $id);
        }

        /*申请End*/

        /*公告Start*/

        //获取网站公告
        public function getNotices($number = null, $startNum = null) {
            return $this->getByFactor(TABLE_NOTICE, null, $number, $startNum);
        }

        //通过分类id获取导航
        public function getNoticeById($id) {
            return $this->getByFactor(TABLE_NOTICE, 'id=' . $id)[0];
        }

        /*公告End*/

        //统计数量
        public function getCount($table, $factor = null) {
            $where = $factor ? $factor : '';
            if(!$this->_admin && $table != TABLE_APPLY && $table != TABLE_NOTICE) {
                $where .= (empty($where) ? '' : ' && ') . 'state=1';
            }
            if($table == TABLE_POST) {
                $where .= (empty($where) ? '' : ' && ') . 'isPage!=1';
            } elseif($table == 'page') {
                $where .= (empty($where) ? '' : ' && ') . 'isPage=1';
                $table = TABLE_POST;
            }
            return $this->_dao->count($table, $where);
        }
    }