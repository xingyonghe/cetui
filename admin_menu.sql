/*
Navicat MySQL Data Transfer

Source Server         : 本地
Source Server Version : 50547
Source Host           : localhost:3306
Source Database       : cetui

Target Server Type    : MYSQL
Target Server Version : 50547
File Encoding         : 65001

Date: 2017-01-03 17:33:24
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for admin_menu
-- ----------------------------
DROP TABLE IF EXISTS `admin_menu`;
CREATE TABLE `admin_menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '标题',
  `pid` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '上级分类ID',
  `sort` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序（同级有效）',
  `url` varchar(50) NOT NULL DEFAULT '' COMMENT '链接名称',
  `hide` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否隐藏:0显示，1隐藏',
  `icon` varchar(50) NOT NULL DEFAULT '' COMMENT '样式',
  `group` varchar(50) NOT NULL DEFAULT '' COMMENT '分组',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='系统菜单';

-- ----------------------------
-- Records of admin_menu
-- ----------------------------
