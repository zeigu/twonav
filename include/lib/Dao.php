<?php

    /*
    * 数据访问对象控制
    */
    class Dao {
        /**
         * 内部数据连接对象
         * @var mysqli
         */
        private $_conn;

        /**
         * 内部查询次数
         * @var int
         */
        private $_queryCount = 0;

        /**
         * 内部实例对象
         * @var object MySql
         */
        private static $_instance = null;

        public function __construct() {
            if(!class_exists('mysqli')) {
                die('服务器空间PHP不支持MySQLi驱动');
            }
            $this->_conn = new mysqli(DB_HOST ? DB_HOST : 'localhost', DB_USER, DB_PASS, DB_NAME, DB_PORT ? DB_PORT : 3306);
            $error = $this->_conn->connect_error;
            $errno = $this->_conn->connect_errno;
            if($error) {
                switch($errno) {
                    case 1045:
                        die('连接数据库失败，数据库用户名或密码错误');
                    case 1049:
                        die('连接数据库失败，数据库名不存在');
                    case 2002:
                        die('连接数据库失败，数据库地址错误');
                    default :
                        die("连接数据库失败，[$errno]" . $error);
                }
            }
            $this->_conn->set_charset('utf8');
        }

        /**
         * 数据访问对象实例
         * @return Dao|object|null
         */
        public static function getInstance() {
            if(!self::$_instance) {
                self::$_instance = new Dao();
            }
            return self::$_instance;
        }

        /**
         * 获取数据库连接实例
         * @return mysqli
         */
        public function getConn() {
            return $this->_conn;
        }

        /**
         * 关闭数据库连接
         * @return bool
         */
        public function close() {
            return $this->_conn->close();
        }

        /**
         * 执行数据库查询
         * @param $sql
         * @return bool|mysqli_result
         */
        public function query($sql) {
            $result = $this->_conn->query($sql);
            $this->_queryCount++;
            return $result;
        }

        /**
         * 取得上一步INSERT操作产生的ID
         * @return mixed
         */
        public function getInsertId() {
            return $this->_conn->insert_id;
        }

        //获取mysql错误信息

        /**
         * 获取mysql错误信息
         * @return string
         */
        public function getError() {
            return $this->_conn->error;
        }

        /**
         * 获取mysql错误码
         * @return int
         */
        public function getErrno() {
            return $this->_conn->errno;
        }

        /**
         * 获取组合错误信息
         * @return string
         */
        public function getErrorMsg() {
            return '[' . $this->getErrno() . ']: ' . $this->getError();
        }

        /**
         * 获取上一次MySQL操作中受影响的行数
         * @return int
         */
        public function getAffectedRows() {
            return $this->_conn->affected_rows;
        }

        /**
         * 获取数据库版本信息
         * @return string
         */
        public function getMysqlVersion() {
            return $this->_conn->server_info;
        }

        /**
         * 获取数据库查询次数
         * @return int
         */
        public function getQueryCount() {
            return $this->_queryCount;
        }

        /**
         * 查询数据
         * @param $table
         * @param null $fields
         * @param null $where
         * @param null $order
         * @param null $num
         * @param null $startNum
         * @return bool|mysqli_result
         */
        public function select($table, $fields = null, $where = null, $order = null, $num = null, $startNum = null) {
            $where = $where ? (' WHERE ' . $where) : '';
            $order = $order ? (' ORDER BY ' . $order) : '';
            $limit = $num ? ($startNum ? (' LIMIT ' . $startNum . ',' . $num) : (' LIMIT ' . $num)) : '';
            $sql = 'SELECT ';
            if($fields) {
                if(is_array($fields)) {
                    foreach($fields as $field) {
                        $sql .= $field . ',';
                    }
                    $sql = rtrim($sql, ',');
                } else {
                    $sql .= $fields;
                }
            } else {
                $sql .= '*';
            }
            $sql .= ' FROM ' . DB_PREFIX . $table . $where . $order . $limit;
            return $this->query($sql);
        }

        /**
         * 插入单条数据
         * @param $table
         * @param $fields
         * @param null $update
         * @return bool|mysqli_result
         */
        public function insertOne($table, $fields, $update = null) {
            $sql = 'INSERT INTO ' . DB_PREFIX . $table . ' (';
            foreach($fields as $key => $value) {
                $sql .= $key . ',';
            }
            $sql = rtrim($sql, ',');
            $sql .= ') VALUES (';
            foreach($fields as $key => $value) {
                $sql .= "'$value',";
            }
            $sql = rtrim($sql, ',') . ')';
            if($update) {
                $sql .= ' ON DUPLICATE KEY UPDATE ';
                foreach($fields as $key => $value) {
                    $sql .= $key . "='$value',";
                }
                $sql = rtrim($sql, ',');
            }
            return $this->query($sql);
        }

        /**
         * 更新数据
         * @param $table
         * @param $fields
         * @param null $where
         * @param bool $isString
         * @return bool|mysqli_result
         */
        public function update($table, $fields, $where = null, $isString = true) {
            $where = $where ? (' WHERE ' . $where) : '';
            $sql = 'UPDATE ' . DB_PREFIX . $table . ' SET ';
            foreach($fields as $key => $value) {
                $sql .= $key . ($isString ? "='$value'," : "=$value,");
            }
            $sql = rtrim($sql, ',') . $where;
            return $this->query($sql);
        }

        /**
         * 根据ID更新数据
         * @param $table
         * @param $id
         * @param $fields
         * @param bool $isString
         * @return bool|mysqli_result
         */
        public function updateById($table, $id, $fields, $isString = true) {
            return $this->update($table, $fields, "id='$id'", $isString);
        }

        /**
         * 删除数据
         * @param $table
         * @param null $where
         * @return bool|mysqli_result
         */
        public function delete($table, $where = null) {
            $where = $where ? (' WHERE ' . $where) : '';
            $sql = 'DELETE FROM ' . DB_PREFIX . $table . $where;
            return $this->query($sql);
        }

        /**
         * 根据ID删除数据
         * @param $table
         * @param $id
         * @return bool|mysqli_result
         */
        public function deleteById($table, $id) {
            return $this->delete($table, "id='$id'");
        }

        /**
         * 统计数量
         * @param $table
         * @param null $where
         * @return mixed
         */
        public function count($table, $where = null) {
            $where = $where ? (' WHERE ' . $where) : '';
            $sql = 'SELECT COUNT(*) AS num FROM ' . DB_PREFIX . $table . $where;
            $result = $this->query($sql);
            $row = $result->fetch_assoc();
            return $row['num'];
        }
    }