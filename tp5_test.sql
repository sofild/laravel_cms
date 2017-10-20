/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50540
Source Host           : localhost:3306
Source Database       : tp5_test

Target Server Type    : MYSQL
Target Server Version : 50540
File Encoding         : 65001

Date: 2017-10-20 10:42:21
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for cate
-- ----------------------------
DROP TABLE IF EXISTS `cate`;
CREATE TABLE `cate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0' COMMENT '父分类ID',
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '分类名称',
  `addtime` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cate
-- ----------------------------
INSERT INTO `cate` VALUES ('1', '0', '水果', '0');
INSERT INTO `cate` VALUES ('2', '0', '植物', '0');
INSERT INTO `cate` VALUES ('3', '1', '苹果', '0');
INSERT INTO `cate` VALUES ('4', '1', '梨子', '0');
INSERT INTO `cate` VALUES ('5', '1', '香蕉', '0');
INSERT INTO `cate` VALUES ('6', '2', '花儿', '0');
INSERT INTO `cate` VALUES ('7', '2', '小草', '0');
INSERT INTO `cate` VALUES ('8', '1', '柿子', '0');
INSERT INTO `cate` VALUES ('9', '1', '桃子', '1490952927');
INSERT INTO `cate` VALUES ('16', '1', '梨子', '1490952998');
INSERT INTO `cate` VALUES ('17', '1', '李子', '1490953586');
INSERT INTO `cate` VALUES ('20', '1', '草莓', '1490953720');
INSERT INTO `cate` VALUES ('21', '1', '西瓜', '1490954020');
INSERT INTO `cate` VALUES ('22', '1', '葡萄', '1490954398');
INSERT INTO `cate` VALUES ('23', '1', '橙子', '1490954432');
INSERT INTO `cate` VALUES ('24', '1', '柚子', '1490954433');
INSERT INTO `cate` VALUES ('25', '1', '哈密瓜', '1490954434');
INSERT INTO `cate` VALUES ('26', '1', '香瓜', '1490954434');
INSERT INTO `cate` VALUES ('27', '1', '黄瓜', '1490954434');
INSERT INTO `cate` VALUES ('28', '1', '椰子', '1490954434');
INSERT INTO `cate` VALUES ('29', '1', '榴莲', '1490954434');
INSERT INTO `cate` VALUES ('31', '1', '火龙果', '1490955371');
INSERT INTO `cate` VALUES ('32', '1', '柠檬', '1490955371');
INSERT INTO `cate` VALUES ('33', '1', '火龙果', '1490955371');
INSERT INTO `cate` VALUES ('34', '1', '火龙果', '1490955372');
INSERT INTO `cate` VALUES ('35', '1', '火龙果', '1490955373');
INSERT INTO `cate` VALUES ('36', '1', '火龙果', '1490955373');

-- ----------------------------
-- Table structure for integral_log
-- ----------------------------
DROP TABLE IF EXISTS `integral_log`;
CREATE TABLE `integral_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `source` int(5) NOT NULL DEFAULT '0' COMMENT '积分来源',
  `integral` int(11) NOT NULL DEFAULT '0' COMMENT '积分',
  `note` varchar(100) NOT NULL DEFAULT '' COMMENT '说明',
  `addtime` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `userid` int(11) NOT NULL DEFAULT '0' COMMENT 'user表ID',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of integral_log
-- ----------------------------
INSERT INTO `integral_log` VALUES ('1', '1', '100', 'test', '1491551309', '3');
INSERT INTO `integral_log` VALUES ('2', '1', '100', 'test', '1491551332', '3');
INSERT INTO `integral_log` VALUES ('3', '1', '100', 'test', '1491551379', '3');
INSERT INTO `integral_log` VALUES ('4', '1', '100', 'test', '1491551427', '3');
INSERT INTO `integral_log` VALUES ('5', '1', '100', 'test', '1491551763', '3');
INSERT INTO `integral_log` VALUES ('6', '1', '100', 'test', '1491554071', '3');
INSERT INTO `integral_log` VALUES ('7', '1', '100', 'test', '1491554181', '3');
INSERT INTO `integral_log` VALUES ('8', '1', '100', 'test', '1491554633', '3');

-- ----------------------------
-- Table structure for manager
-- ----------------------------
DROP TABLE IF EXISTS `manager`;
CREATE TABLE `manager` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` varchar(100) NOT NULL DEFAULT '' COMMENT '密码',
  `addtime` int(11) NOT NULL DEFAULT '0' COMMENT '新增时间',
  `logintime` int(11) NOT NULL DEFAULT '0' COMMENT '登录时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of manager
-- ----------------------------
INSERT INTO `manager` VALUES ('1', 'admin', '21232f297a57a5a743894a0e4a801fc3', '1490692549', '1508466258');

-- ----------------------------
-- Table structure for news
-- ----------------------------
DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '标题',
  `cate_id` int(11) NOT NULL DEFAULT '0' COMMENT '分类ID',
  `description` varchar(255) NOT NULL DEFAULT '' COMMENT '描述',
  `content` longtext NOT NULL COMMENT '内容',
  `addtime` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `pic` varchar(255) NOT NULL DEFAULT '' COMMENT '图片',
  `author` int(6) NOT NULL DEFAULT '0' COMMENT '用户ID',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of news
-- ----------------------------

-- ----------------------------
-- Table structure for sys_menu
-- ----------------------------
DROP TABLE IF EXISTS `sys_menu`;
CREATE TABLE `sys_menu` (
  `sme_id` int(11) NOT NULL AUTO_INCREMENT,
  `sme_sm_id` int(11) NOT NULL COMMENT '模块ID',
  `sme_parent_id` int(11) NOT NULL COMMENT '父级菜单ID',
  `sme_title` varchar(255) NOT NULL DEFAULT '' COMMENT '名称',
  `sme_path` varchar(255) NOT NULL DEFAULT '' COMMENT '路径',
  `sme_type` smallint(1) NOT NULL DEFAULT '1' COMMENT '1：子菜单，2：功能',
  `sme_addtime` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `sme_sort` int(4) NOT NULL DEFAULT '0' COMMENT '排序，大的在前',
  `sme_template` int(4) NOT NULL DEFAULT '0' COMMENT '模版ID',
  PRIMARY KEY (`sme_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sys_menu
-- ----------------------------
INSERT INTO `sys_menu` VALUES ('1', '1', '0', '关于我们', '/content', '1', '0', '0', '0');
INSERT INTO `sys_menu` VALUES ('2', '1', '0', '新闻中心', '/news', '1', '0', '0', '0');
INSERT INTO `sys_menu` VALUES ('3', '1', '1', '我们是谁', '/content/who', '1', '0', '0', '0');
INSERT INTO `sys_menu` VALUES ('4', '1', '1', '我们在哪', '/content/where', '1', '0', '0', '0');
INSERT INTO `sys_menu` VALUES ('5', '1', '2', '最新新闻', '/news/new', '1', '0', '0', '0');
INSERT INTO `sys_menu` VALUES ('6', '1', '2', '最热新闻', '/news/hot', '1', '0', '0', '0');
INSERT INTO `sys_menu` VALUES ('7', '2', '0', '管理员管理', '/managers', '1', '0', '0', '0');
INSERT INTO `sys_menu` VALUES ('8', '2', '0', '系统配置', '/setting', '1', '0', '0', '0');
INSERT INTO `sys_menu` VALUES ('9', '2', '7', '管理员列表', '/managers/list', '1', '0', '0', '0');
INSERT INTO `sys_menu` VALUES ('10', '2', '8', '系统配置', '/setting', '1', '0', '0', '0');

-- ----------------------------
-- Table structure for sys_module
-- ----------------------------
DROP TABLE IF EXISTS `sys_module`;
CREATE TABLE `sys_module` (
  `sm_id` int(11) NOT NULL AUTO_INCREMENT,
  `sm_name` varchar(255) NOT NULL DEFAULT '' COMMENT '模块名',
  `sm_sort` int(4) NOT NULL DEFAULT '0' COMMENT '排序，从小到大排',
  PRIMARY KEY (`sm_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sys_module
-- ----------------------------
INSERT INTO `sys_module` VALUES ('1', '内容管理', '0');
INSERT INTO `sys_module` VALUES ('2', '系统管理', '1');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(100) NOT NULL DEFAULT '' COMMENT 'UID',
  `username` varchar(255) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` varchar(255) NOT NULL DEFAULT '' COMMENT '密码',
  `addtime` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `logintime` int(11) NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  `integral` int(11) NOT NULL DEFAULT '0' COMMENT '积分',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'e323f12c12f34', 'admin', '21232f297a57a5a743894a0e4a801fc3', '1491463215', '1491463215', '0');
INSERT INTO `user` VALUES ('2', 'e323f12c12f3446d456df', 'test', '098f6bcd4621d373cade4e832627b4f6', '1491463536', '1491463536', '0');
INSERT INTO `user` VALUES ('3', 'e3600ea7131c02b4adef97031393f22469a26dd0', 'sofild', 'e10adc3949ba59abbe56e057f20f883e', '1491551210', '1491551210', '100');
