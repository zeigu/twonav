-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2025-01-03 05:02:50
-- 服务器版本： 5.7.44-log
-- PHP 版本： 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `dh_zcymc_com`
--

-- --------------------------------------------------------

--
-- 表的结构 `dhcat_ad`
--

CREATE TABLE `dhcat_ad` (
  `id` int(11) NOT NULL,
  `page` varchar(10) NOT NULL,
  `title` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `state` tinyint(1) NOT NULL DEFAULT '1',
  `end_time` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `dhcat_ad`
--

INSERT INTO `dhcat_ad` (`id`, `page`, `title`, `picture`, `url`, `state`, `end_time`) VALUES
(1, 'list', '快速提交网站收录', 'https://www.888host.cn/wp-content/uploads/2024/02/www.888host.cn_.png', 'https://888host.cn', 1, 0),
(2, 'list', '快速提交网站收录', 'https://www.888host.cn/wp-content/uploads/2024/02/www.888host.cn_.png', 'https://888host.cn/', 1, 0);

-- --------------------------------------------------------

--
-- 表的结构 `dhcat_apply`
--

CREATE TABLE `dhcat_apply` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `sortId` int(11) NOT NULL,
  `qq` varchar(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `time` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `dhcat_config`
--

CREATE TABLE `dhcat_config` (
  `name` varchar(255) NOT NULL,
  `main` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `dhcat_config`
--

INSERT INTO `dhcat_config` (`name`, `main`) VALUES
('name', '总裁导航系统—收录平台-小8源码屋888host.cn'),
('time', '1609718400'),
('number', '21'),
('sitePaging', '24'),
('postPaging', '10'),
('viewNum', '1'),
('snapshot', 'https://mini.s-shot.ru/1024x768/PNG/800/?'),
('apply', '1'),
('goto', '1'),
('detail', '1'),
('order', 'id DESC'),
('autoPass', '1'),
('saveIco', '1'),
('title', '总裁导航系统—收录平台'),
('keywords', '总裁,总裁导航,总裁导航系统,技术导航,QQ技术导航,娱乐网,小刀娱乐网,爱Q,QQ技术,QQ导航,导航君'),
('description', '总裁导航国内屈指可数的技术教程活动目录导航分类平台，站点已累计收录数千网站，累计为中国网民提供多达数亿的访问点击，满足用户随时查阅最全面最权威的文章资讯教程。'),
('icp', ''),
('info', ''),
('baiduToken', 'cRptX60OZkjZMSjf'),
('bearPawToken', '121'),
('bearPawAppId', '120'),
('cronKey', 'shane'),
('emailNotice', '1'),
('smtpHost', 'ssl://smtp.exmail.qq.com'),
('smtpPort', '465'),
('smtpUsername', 'zc@'),
('smtpPassword', '123456'),
('template', 'antidote'),
('zhiding_money', '20'),
('list_money', '30'),
('site_money', '30'),
('page_money', '30'),
('epay_url', 'https://pay.peakmzf.com/'),
('epay_id', '1000'),
('epay_key', '8Ppuc2oNuJnNIiIaStUkJ4ZtOHjPMGvC'),
('musickey', ''),
('email', 'zc@dhceo.net'),
('indexwzgg', '<a href=\"https://888host.cn/\" target=\"_blank\">广告位招租</a>\r\n<a href=\"https://888host.cn/\" target=\"_blank\">广告位招租</a>\r\n<a href=\"https://888host.cn/\" target=\"_blank\">广告位招租</a>\r\n<a href=\"https://888host.cn/\" target=\"_blank\">广告位招租</a>\r\n<a href=\"https://888host.cn/\" target=\"_blank\">广告位招租</a>\r\n<a href=\"https://888host.cn/\"_blank\">广告位招租</a>\r\n<a href=\"https://888host.cn/\"_blank\">广告位招租</a>\r\n<a href=\"https://888host.cn/\"_blank\">广告位招租</a>'),
('sitewzgg', '<a href=\"https://888host.cn/\" target=\"_blank\">广告位招租</a>\r\n<a href=\"https://888host.cn/\" target=\"_blank\">广告位招租</a>\r\n<a href=\"https://888host.cn/\" target=\"_blank\">广告位招租</a>\r\n<a href=\"https://888host.cn/\" target=\"_blank\">广告位招租</a>\r\n<a href=\"https://888host.cn/\" target=\"_blank\">广告位招租</a>\r\n<a href=\"https://888host.cn/\"_blank\">广告位招租</a>\r\n<a href=\"https://888host.cn/\"_blank\">广告位招租</a>\r\n<a href=\"https://888host.cn/\"_blank\">广告位招租</a>'),
('postwzgg', '<a href=\"https://888host.cn/\" target=\"_blank\">广告位招租</a>\r\n<a href=\"https://888host.cn/\" target=\"_blank\">广告位招租</a>\r\n<a href=\"https://888host.cn/\" target=\"_blank\">广告位招租</a>\r\n<a href=\"https://888host.cn/\" target=\"_blank\">广告位招租</a>\r\n<a href=\"https://888host.cn/\" target=\"_blank\">广告位招租</a>\r\n<a href=\"https://888host.cn/\"_blank\">广告位招租</a>\r\n<a href=\"https://888host.cn/\"_blank\">广告位招租</a>\r\n<a href=\"https://888host.cn/\"_blank\">广告位招租</a>'),
('indexsider', '<div class=\"card\">\r\n      <div class=\"card-head\"><i class=\"fa fa-coffee fa-fw\"></i>图片尺寸300*300</div>\r\n      <div class=\"card-body\">\r\n            <a href=\"https://wpa.qq.com/msgrd?v=3&uin=123456789&site=qq&menu=yes&jumpflag=1\"><img  class=\"lazy-load\"  src=\"https://888host.cn/\" data-src=\"/assets/images/dtgg.jpg\" style=\"width:100%;height:302px;border-radius: 5px;\" ></a>\r\n      </div>\r\n    </div>'),
('sortsider', '<div class=\"card\">\r\n      <div class=\"card-head\"><i class=\"fa fa-coffee fa-fw\"></i>图片尺寸300*300</div>\r\n      <div class=\"card-body\">\r\n            <a href=\"https://wpa.qq.com/msgrd?v=3&uin=123456789&site=qq&menu=yes&jumpflag=1\"><img  class=\"lazy-load\"  src=\"https://888host.cn/\" data-src=\"/assets/images/dtgg.jpg\" style=\"width:100%;height:302px;border-radius: 5px;\" ></a>\r\n      </div>\r\n    </div>'),
('postsider', '<div class=\"card\">\r\n      <div class=\"card-head\"><i class=\"fa fa-coffee fa-fw\"></i>图片尺寸300*300</div>\r\n      <div class=\"card-body\">\r\n            <a href=\"https://wpa.qq.com/msgrd?v=3&uin=123456789&site=qq&menu=yes&jumpflag=1\"><img  class=\"lazy-load\"  src=\"https://888host.cn/\" data-src=\"/assets/images/dtgg.jpg\" style=\"width:100%;height:302px;border-radius: 5px;\" ></a>\r\n      </div>');

-- --------------------------------------------------------

--
-- 表的结构 `dhcat_link`
--

CREATE TABLE `dhcat_link` (
  `id` int(11) NOT NULL,
  `serial` int(11) NOT NULL DEFAULT '0',
  `name` varchar(100) NOT NULL,
  `url` varchar(255) NOT NULL,
  `time` varchar(10) NOT NULL,
  `newTab` tinyint(1) NOT NULL DEFAULT '1',
  `state` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `dhcat_link`
--

INSERT INTO `dhcat_link` (`id`, `serial`, `name`, `url`, `time`, `newTab`, `state`) VALUES
(1, 1, '小8源码屋', 'https://888host.cn/', '1735847010', 1, 1),
(2, 2, '总裁导航', 'https://888host.cn/', '1735846998', 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `dhcat_nav`
--

CREATE TABLE `dhcat_nav` (
  `id` int(11) NOT NULL,
  `serial` int(11) NOT NULL DEFAULT '0',
  `icon` varchar(50) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `type` tinyint(1) NOT NULL,
  `tid` int(11) NOT NULL,
  `newTab` tinyint(1) NOT NULL DEFAULT '0',
  `state` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `dhcat_nav`
--

INSERT INTO `dhcat_nav` (`id`, `serial`, `icon`, `name`, `url`, `type`, `tid`, `newTab`, `state`) VALUES
(1, 1, 'fa fa-home', '导航首页', NULL, 0, 0, 0, 1),
(2, 2, 'fa fa-plus-square', '申请收录', NULL, 3, 1, 0, 1),
(3, 3, 'fa fa-info-circle', '关于本站', NULL, 3, 2, 0, 1),
(4, 4, 'fa fa-info-circle', '购买广告', NULL, 3, 4, 0, 1),
(5, 5, 'fa fa-info-circle', '在线工具', NULL, 3, 5, 0, 1),
(6, 0, 'fa fa-address-book', '排行榜单', NULL, 3, 7, 0, 1),
(7, 0, 'fa fa-address-book-o', '文章归档', NULL, 3, 3, 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `dhcat_notice`
--

CREATE TABLE `dhcat_notice` (
  `id` int(11) NOT NULL,
  `time` varchar(10) NOT NULL,
  `content` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `dhcat_notice`
--

INSERT INTO `dhcat_notice` (`id`, `time`, `content`) VALUES
(1, '1669563214', '<b id=\"gonggao\">欢迎各大小站长提交贵站</b></marquee>');

-- --------------------------------------------------------

--
-- 表的结构 `dhcat_order`
--

CREATE TABLE `dhcat_order` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `trade_no` varchar(50) NOT NULL COMMENT '订单号',
  `type` int(11) NOT NULL COMMENT '购买类型',
  `money` varchar(50) NOT NULL,
  `qq` varchar(50) NOT NULL COMMENT 'QQ',
  `tu_url` varchar(2500) NOT NULL,
  `num` int(11) NOT NULL,
  `pay_type` varchar(50) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `domain` varchar(2500) NOT NULL,
  `creat_time` int(11) NOT NULL,
  `end_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `dhcat_order`
--

INSERT INTO `dhcat_order` (`id`, `trade_no`, `type`, `money`, `qq`, `tu_url`, `num`, `pay_type`, `status`, `domain`, `creat_time`, `end_time`) VALUES
(1, '20221204203319716', 2, '30', '111111', 'https://www.dhceo.net/assets/images/logo.png', 1, 'wxpay', 0, 'https://www.baidu.com', 1670157220, 0),
(2, '20221208085041587', 2, '30', '', 'iyaoxing.com', 1, 'wxpay', 0, 'iyaoxing.com', 1670460660, 0),
(3, '20230128174014598', 2, '30', '3486971897', 'https://blog.21ixc.cn/ipcrd/img.php', 1, 'alipay', 0, 'https://blog.21ixc.cn', 1674898855, 0);

-- --------------------------------------------------------

--
-- 表的结构 `dhcat_post`
--

CREATE TABLE `dhcat_post` (
  `id` int(11) NOT NULL,
  `sortId` int(11) NOT NULL DEFAULT '0',
  `isPage` tinyint(1) NOT NULL DEFAULT '0',
  `title` text NOT NULL,
  `content` text NOT NULL,
  `template` varchar(50) DEFAULT NULL,
  `alias` varchar(30) DEFAULT NULL,
  `time` varchar(10) NOT NULL,
  `view` int(11) NOT NULL DEFAULT '0',
  `push` tinyint(1) NOT NULL DEFAULT '0',
  `state` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `dhcat_post`
--

INSERT INTO `dhcat_post` (`id`, `sortId`, `isPage`, `title`, `content`, `template`, `alias`, `time`, `view`, `push`, `state`) VALUES
(1, 0, 1, '申请收录', '', 'page_apply', 'apply', '1603497600', 1726, 3, 1),
(2, 0, 1, '关于本站', '', 'page_about', 'about', '1603497600', 716, 3, 1),
(3, 0, 1, '文章归档', '', 'page_archives', 'archives', '1603497600', 698, 3, 1),
(4, 0, 1, '购买广告', '', 'page_pay', 'pay', '1603497600', 1148, 3, 1),
(5, 0, 1, '在线工具', '', 'page_tools', 'tools', '1603497600', 739, 3, 1),
(6, 25, 0, '口味王自动代挂-直接躺赚- 挂到活动结束-自动软件', '<p>口味王自动答题做任务项目，每天领低保【自动脚本+教程】</p>\r\n<p>口味王全套养号，签到+任务+答题+三个游戏，积分够了自动兑换抽奖码，你啥事不管，等红包到账即可，8r/月（中途黄了不退）</p>\r\n<p>&nbsp;</p>\r\n<p>联系QQ：28150975</p>\r\n<p><img src=\"https://www.kekezyw.com/content/uploadfile/202211/f3cc1669577883.jpg\" alt=\"\" width=\"497\" height=\"532\" /></p>\r\n<p>以前的文案，全新的价格!<br />很多朋友就自己一两个号，怎么样利润最大化呢？<br />帮朋友去挂号，然后让他把利润跟你55分，绝对躺赚</p>\r\n<p><img src=\"https://tiebapic.baidu.com/forum/pic/item/dc647cec8a1363276d2bc1f1d48fa0ec0afac76e.jpg?tbpicau=2022-11-30-05_6ed60606b618fd37e04f85640d4c2753\" alt=\"\" width=\"920\" height=\"748\" /></p>\r\n<p><span data-font-family=\"default\">参与抽奖的前提就是要足够多的积分才可以 880积分抽一次 </span></p>\r\n<p><span data-font-family=\"default\">可以挂在我这里 每天稳定给你刷300+积分 平均下来就是三天够抽一次</span></p>\r\n<p><span data-font-family=\"default\">在我这里挂好之后你什么也不用干 就等公众号给你推红包就行 </span></p>\r\n<p><span data-font-family=\"default\">不用点击领取 是直接推送到零钱的 到时候账单可以看到</span></p>\r\n<p><span data-font-family=\"default\">项目收费66 可以让你挂三个号 这样平均下来=就是一天一个红包</span></p>\r\n<p><span data-font-family=\"default\">微信号就可以 随便就行 只要是微信号就可以挂 相当于你一个号投资了22 </span></p>\r\n<p><span data-font-family=\"default\">中一个四等奖直接回本 后期就是纯利润 项目最少做一个月 包你稳赚不赔</span></p>\r\n<p><span data-font-family=\"default\">自己微信号不多的话可以用室友或者朋友的挂 多挂就等于多中奖=多赚</span></p>\r\n<p><span data-font-family=\"default\">目前这个项目做了差不多一个星期多一点了 中奖几率还是挺猛的</span></p>\r\n<p><span data-font-family=\"default\">我自己也在玩 批量做了10几个号 准备加量干 每天也是稳稳领低保</span></p>\r\n<p><span data-font-family=\"default\">这个项目不是一天二天的 保底玩一个月 一次二次不中 总要中的</span></p>\r\n<p><span data-font-family=\"default\">中一个大包直接起飞 你们一个号投资22 啥也不用干 就等着刺激推红包</span></p>\r\n<p><span data-font-family=\"default\">小投资大回报 躺着就把钱给赚了</span></p>\r\n<p>&nbsp;</p>\r\n<p><span data-font-family=\"default\">联系QQ：28150975</span></p>\r\n<p>&nbsp;</p>', NULL, '', '1669614206', 182, 3, 0),
(7, 0, 1, '排行榜单', '', 'page_ranking', 'ranking', '1670398999', 649, 3, 1);

-- --------------------------------------------------------

--
-- 表的结构 `dhcat_site`
--

CREATE TABLE `dhcat_site` (
  `id` int(11) NOT NULL,
  `serial` int(11) NOT NULL DEFAULT '0',
  `name` varchar(100) NOT NULL,
  `sortId` int(11) NOT NULL,
  `qq` varchar(11) DEFAULT NULL,
  `url` varchar(255) NOT NULL,
  `icp` varchar(20) DEFAULT NULL,
  `title` text,
  `keywords` text,
  `description` text,
  `alias` varchar(30) DEFAULT NULL,
  `time` varchar(10) NOT NULL,
  `top` tinyint(1) NOT NULL DEFAULT '0',
  `love` int(11) NOT NULL DEFAULT '0',
  `dayView` int(11) NOT NULL DEFAULT '0',
  `monthView` int(11) NOT NULL DEFAULT '0',
  `totalView` int(11) NOT NULL DEFAULT '0',
  `lastDate` varchar(20) DEFAULT NULL,
  `push` tinyint(1) NOT NULL DEFAULT '0',
  `state` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `dhcat_site`
--

INSERT INTO `dhcat_site` (`id`, `serial`, `name`, `sortId`, `qq`, `url`, `icp`, `title`, `keywords`, `description`, `alias`, `time`, `top`, `love`, `dayView`, `monthView`, `totalView`, `lastDate`, `push`, `state`) VALUES
(109, 0, '总裁导航系统', 13, '123456789', 'https://888host.cn', '暂无备案信息', '总裁导航系统—收录平台-总裁QQ：123456789 微信：zongcaiym', '总裁,总裁导航,总裁导航系统,技术导航,QQ技术导航,娱乐网,小刀娱乐网,爱Q,QQ技术,QQ导航,导航君', '总裁,总裁导航,总裁导航系统,技术导航,QQ技术导航,娱乐网,小刀娱乐网,爱Q,QQ技术,QQ导航,导航君', '', '1735850035', 1, 0, 1, 1, 1, '2025-01-03', 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `dhcat_sort`
--

CREATE TABLE `dhcat_sort` (
  `id` int(11) NOT NULL,
  `serial` int(11) NOT NULL DEFAULT '0',
  `type` tinyint(1) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `name` varchar(30) NOT NULL,
  `alias` varchar(30) DEFAULT NULL,
  `state` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `dhcat_sort`
--

INSERT INTO `dhcat_sort` (`id`, `serial`, `type`, `icon`, `name`, `alias`, `state`) VALUES
(1, 0, 1, 'fa fa-book', '资源博客', '', 1),
(2, 1, 1, 'fa fa-file-movie-o', '影视大全', '', 1),
(3, 2, 1, 'fa fa-cloud-download', '源码下载', '', 1),
(4, 3, 1, 'fa fa-download', '软件工具', '', 1),
(5, 4, 1, 'fa fa-desktop', 'IDC服务器', '', 1),
(6, 5, 1, 'fa fa-edit', '论坛社区', '', 1),
(7, 6, 1, 'fa fa-music', '聆听音乐', '', 1),
(8, 7, 1, 'fa fa-address-book', '小说漫画', '', 1),
(9, 8, 1, 'fa fa-cc-paypal', '支付系统', '', 1),
(10, 9, 1, 'fa fa-shopping-bag', '代刷代挂', '', 1),
(11, 10, 1, 'fa fa-picture-o', '素材资源', '', 1),
(12, 11, 1, 'fa fa-refresh', 'API接口', '', 1),
(13, 13, 1, 'fa fa-send-o', '网址导航', '', 1),
(14, 14, 1, 'fa fa-envira', '常用工具', '', 1),
(21, 0, 2, 'fa fa-folder-open', '网站源码', 'wangzhanyuanma', 1),
(22, 1, 2, 'fa fa-folder', '绿色软件', '', 1),
(23, 2, 2, 'fa fa-leanpub', '技术教程', '', 1),
(24, 3, 2, 'fa fa-youtube-play', '值得一看', '', 1),
(25, 4, 2, 'fa fa-users', '活动线报', '', 1),
(26, 5, 2, 'fa fa-newspaper-o', '其他资源', '', 1);

-- --------------------------------------------------------

--
-- 表的结构 `dhcat_user`
--

CREATE TABLE `dhcat_user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(32) NOT NULL,
  `role` tinyint(1) NOT NULL DEFAULT '0',
  `qq` varchar(11) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `intro` varchar(255) NOT NULL,
  `time` varchar(10) NOT NULL,
  `state` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `dhcat_user`
--

INSERT INTO `dhcat_user` (`id`, `username`, `password`, `role`, `qq`, `avatar`, `email`, `intro`, `time`, `state`) VALUES
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 1, '123456', '', '123456@qq.com', '', '1546272000', 1);

--
-- 转储表的索引
--

--
-- 表的索引 `dhcat_ad`
--
ALTER TABLE `dhcat_ad`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `dhcat_apply`
--
ALTER TABLE `dhcat_apply`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `dhcat_config`
--
ALTER TABLE `dhcat_config`
  ADD PRIMARY KEY (`name`);

--
-- 表的索引 `dhcat_link`
--
ALTER TABLE `dhcat_link`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `dhcat_nav`
--
ALTER TABLE `dhcat_nav`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `dhcat_notice`
--
ALTER TABLE `dhcat_notice`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `dhcat_order`
--
ALTER TABLE `dhcat_order`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `dhcat_post`
--
ALTER TABLE `dhcat_post`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `dhcat_site`
--
ALTER TABLE `dhcat_site`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `dhcat_sort`
--
ALTER TABLE `dhcat_sort`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `dhcat_user`
--
ALTER TABLE `dhcat_user`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `dhcat_ad`
--
ALTER TABLE `dhcat_ad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- 使用表AUTO_INCREMENT `dhcat_apply`
--
ALTER TABLE `dhcat_apply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- 使用表AUTO_INCREMENT `dhcat_link`
--
ALTER TABLE `dhcat_link`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用表AUTO_INCREMENT `dhcat_nav`
--
ALTER TABLE `dhcat_nav`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- 使用表AUTO_INCREMENT `dhcat_notice`
--
ALTER TABLE `dhcat_notice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `dhcat_order`
--
ALTER TABLE `dhcat_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=4;

--
-- 使用表AUTO_INCREMENT `dhcat_post`
--
ALTER TABLE `dhcat_post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- 使用表AUTO_INCREMENT `dhcat_site`
--
ALTER TABLE `dhcat_site`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- 使用表AUTO_INCREMENT `dhcat_sort`
--
ALTER TABLE `dhcat_sort`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- 使用表AUTO_INCREMENT `dhcat_user`
--
ALTER TABLE `dhcat_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
