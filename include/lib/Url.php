<?php

        class Url {
        /**
         * 分类链接
         * @param $id
         * @param null $type
         * @param null $alias
         * @return string
         */
        public static function sort($id, $type = null, $alias = null) {
            $DATA = Data::getInstance();
            $type = $type ? $type : $DATA->getSortTypeById($id);
            $flag = $type == 1 ? 'sort' : 'article';
            if(!isset($alias)) {
                $alias = $DATA->getSortAliasById($id);
            }
            return OZDAO_URL . $flag . '/' . ($alias ? $alias : $id) . '.html';
        }

        /**
         * 站点链接
         * @param $id
         * @param null $alias
         * @param null $url
         * @return string
         */
        public static function site($id, $alias = null, $url = null) {
            $DATA = Data::getInstance();
            $detail = $DATA->getConfig('detail');
            if($detail != 1) {
                $url = $url ? $url : $DATA->getSiteUrlById($id);
                return self::jump($url);
            }
            if(!isset($alias)) {
                $alias = $DATA->getSiteAliasById($id);
            }
            return OZDAO_URL . ($alias ? $alias : 'site/' . $id) . '.html';
        }

        /**
         * 跳转链接
         * @param $url
         * @return mixed|string
         */
        public static function jump($url) {
            $DATA = Data::getInstance();
            $goto = $DATA->getConfig('goto');
            return $goto == 1 ? (OZDAO_URL . 'goto/' . $url) : $url;
        }

        /**
         * 页面链接
         * @param $id
         * @param null $alias
         * @return string
         */
        public static function post($id, $alias = null) {
            if(!isset($alias)) {
                $DATA = Data::getInstance();
                $alias = $DATA->getPostAliasById($id);
            }
            return OZDAO_URL . ($alias ? $alias : 'post/' . $id) . '.html';
        }
    }