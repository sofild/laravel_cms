-- phpMyAdmin SQL Dump
-- version 4.4.11
-- http://www.phpmyadmin.net
--
-- Host: 192.168.0.109:3306
-- Generation Time: 2017-10-22 13:22:13
-- 服务器版本： 5.7.17-log
-- PHP Version: 7.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tp5_test`
--

-- --------------------------------------------------------

--
-- 表的结构 `cate`
--

CREATE TABLE IF NOT EXISTS `cate` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0' COMMENT '父分类ID',
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '分类名称',
  `addtime` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间'
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `cate`
--

INSERT INTO `cate` (`id`, `parent_id`, `name`, `addtime`) VALUES
(1, 0, '水果', 0),
(2, 0, '植物', 0),
(3, 1, '苹果', 0),
(4, 1, '梨子', 0),
(5, 1, '香蕉', 0),
(6, 2, '花儿', 0),
(7, 2, '小草', 0),
(8, 1, '柿子', 0),
(9, 1, '桃子', 1490952927),
(16, 1, '梨子', 1490952998),
(17, 1, '李子', 1490953586),
(20, 1, '草莓', 1490953720),
(21, 1, '西瓜', 1490954020),
(22, 1, '葡萄', 1490954398),
(23, 1, '橙子', 1490954432),
(24, 1, '柚子', 1490954433),
(25, 1, '哈密瓜', 1490954434),
(26, 1, '香瓜', 1490954434),
(27, 1, '黄瓜', 1490954434),
(28, 1, '椰子', 1490954434),
(29, 1, '榴莲', 1490954434),
(31, 1, '火龙果', 1490955371),
(32, 1, '柠檬', 1490955371),
(33, 1, '火龙果', 1490955371),
(34, 1, '火龙果', 1490955372),
(35, 1, '火龙果', 1490955373),
(36, 1, '火龙果', 1490955373);

-- --------------------------------------------------------

--
-- 表的结构 `integral_log`
--

CREATE TABLE IF NOT EXISTS `integral_log` (
  `id` int(11) NOT NULL,
  `source` int(5) NOT NULL DEFAULT '0' COMMENT '积分来源',
  `integral` int(11) NOT NULL DEFAULT '0' COMMENT '积分',
  `note` varchar(100) NOT NULL DEFAULT '' COMMENT '说明',
  `addtime` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `userid` int(11) NOT NULL DEFAULT '0' COMMENT 'user表ID'
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `integral_log`
--

INSERT INTO `integral_log` (`id`, `source`, `integral`, `note`, `addtime`, `userid`) VALUES
(1, 1, 100, 'test', 1491551309, 3),
(2, 1, 100, 'test', 1491551332, 3),
(3, 1, 100, 'test', 1491551379, 3),
(4, 1, 100, 'test', 1491551427, 3),
(5, 1, 100, 'test', 1491551763, 3),
(6, 1, 100, 'test', 1491554071, 3),
(7, 1, 100, 'test', 1491554181, 3),
(8, 1, 100, 'test', 1491554633, 3);

-- --------------------------------------------------------

--
-- 表的结构 `manager`
--

CREATE TABLE IF NOT EXISTS `manager` (
  `id` int(5) NOT NULL,
  `username` varchar(50) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` varchar(100) NOT NULL DEFAULT '' COMMENT '密码',
  `addtime` int(11) NOT NULL DEFAULT '0' COMMENT '新增时间',
  `logintime` int(11) NOT NULL DEFAULT '0' COMMENT '登录时间'
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `manager`
--

INSERT INTO `manager` (`id`, `username`, `password`, `addtime`, `logintime`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1490692549, 1508646534);

-- --------------------------------------------------------

--
-- 表的结构 `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '标题',
  `cate_id` int(11) NOT NULL DEFAULT '0' COMMENT '分类ID',
  `description` varchar(255) NOT NULL DEFAULT '' COMMENT '描述',
  `content` longtext NOT NULL COMMENT '内容',
  `addtime` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `pic` varchar(255) NOT NULL DEFAULT '' COMMENT '图片',
  `author` int(6) NOT NULL DEFAULT '0' COMMENT '用户ID'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `sys_menu`
--

CREATE TABLE IF NOT EXISTS `sys_menu` (
  `sme_id` int(11) NOT NULL,
  `sme_sm_id` int(11) NOT NULL COMMENT '模块ID',
  `sme_parent_id` int(11) NOT NULL COMMENT '父级菜单ID',
  `sme_title` varchar(255) NOT NULL DEFAULT '' COMMENT '名称',
  `sme_path` varchar(255) NOT NULL DEFAULT '' COMMENT '路径',
  `sme_type` smallint(1) NOT NULL DEFAULT '1' COMMENT '1：子菜单，2：功能',
  `sme_addtime` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `sme_sort` int(4) NOT NULL DEFAULT '0' COMMENT '排序，大的在前',
  `sme_template` int(4) NOT NULL DEFAULT '0' COMMENT '模版ID'
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `sys_menu`
--

INSERT INTO `sys_menu` (`sme_id`, `sme_sm_id`, `sme_parent_id`, `sme_title`, `sme_path`, `sme_type`, `sme_addtime`, `sme_sort`, `sme_template`) VALUES
(1, 1, 0, '关于我们', '/content', 1, 0, 0, 0),
(2, 1, 0, '新闻中心', '/news', 1, 0, 0, 0),
(3, 1, 1, '我们是谁', '/news/list/1', 1, 0, 0, 0),
(4, 1, 1, '我们在哪', '/content/where', 1, 0, 0, 0),
(5, 1, 2, '最新新闻', '/news/list/2', 1, 0, 0, 0),
(6, 1, 2, '最热新闻', '/news/list/3', 1, 0, 0, 0),
(7, 2, 0, '管理员管理', '/managers', 1, 0, 0, 0),
(8, 2, 0, '系统配置', '/setting', 1, 0, 0, 0),
(9, 2, 7, '管理员列表', '/managers/list', 1, 0, 0, 0),
(10, 2, 8, '系统配置', '/setting', 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `sys_module`
--

CREATE TABLE IF NOT EXISTS `sys_module` (
  `sm_id` int(11) NOT NULL,
  `sm_name` varchar(255) NOT NULL DEFAULT '' COMMENT '模块名',
  `sm_sort` int(4) NOT NULL DEFAULT '0' COMMENT '排序，从小到大排'
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `sys_module`
--

INSERT INTO `sys_module` (`sm_id`, `sm_name`, `sm_sort`) VALUES
(1, '内容管理', 0),
(2, '系统管理', 1);

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `uid` varchar(100) NOT NULL DEFAULT '' COMMENT 'UID',
  `username` varchar(255) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` varchar(255) NOT NULL DEFAULT '' COMMENT '密码',
  `addtime` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `logintime` int(11) NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  `integral` int(11) NOT NULL DEFAULT '0' COMMENT '积分'
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `uid`, `username`, `password`, `addtime`, `logintime`, `integral`) VALUES
(1, 'e323f12c12f34', 'admin', '21232f297a57a5a743894a0e4a801fc3', 1491463215, 1491463215, 0),
(2, 'e323f12c12f3446d456df', 'test', '098f6bcd4621d373cade4e832627b4f6', 1491463536, 1491463536, 0),
(3, 'e3600ea7131c02b4adef97031393f22469a26dd0', 'sofild', 'e10adc3949ba59abbe56e057f20f883e', 1491551210, 1491551210, 100);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cate`
--
ALTER TABLE `cate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `integral_log`
--
ALTER TABLE `integral_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_menu`
--
ALTER TABLE `sys_menu`
  ADD PRIMARY KEY (`sme_id`);

--
-- Indexes for table `sys_module`
--
ALTER TABLE `sys_module`
  ADD PRIMARY KEY (`sm_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cate`
--
ALTER TABLE `cate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `integral_log`
--
ALTER TABLE `integral_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `manager`
--
ALTER TABLE `manager`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sys_menu`
--
ALTER TABLE `sys_menu`
  MODIFY `sme_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `sys_module`
--
ALTER TABLE `sys_module`
  MODIFY `sm_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
