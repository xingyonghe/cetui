/*
Navicat MySQL Data Transfer

Source Server         : 本地
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : cetui

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2017-01-03 23:13:39
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
  `url` varchar(100) NOT NULL DEFAULT '' COMMENT '链接名称',
  `name` varchar(100) DEFAULT '' COMMENT '标识',
  `sort` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序（同级有效）',
  `icon` varchar(50) NOT NULL DEFAULT '' COMMENT '样式',
  `hide` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否隐藏:0显示，1隐藏',
  `group` varchar(50) NOT NULL DEFAULT '' COMMENT '分组',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='系统菜单';

-- ----------------------------
-- Records of admin_menu
-- ----------------------------
INSERT INTO `admin_menu` VALUES ('1', '首页', '0', 'admin', 'admin.index.index', '0', 'icon-home', '0', '');
INSERT INTO `admin_menu` VALUES ('2', '系统', '0', 'admin/menu/index', 'admin.menu.index', '0', 'icon-cogs', '0', '');
INSERT INTO `admin_menu` VALUES ('3', '用户', '0', 'admin/user/index', 'admin.user.index', '0', 'icon-user', '0', '');
INSERT INTO `admin_menu` VALUES ('4', '客服', '0', 'admin/custom/index', 'admin.custom.index', '0', 'icon-user-md', '0', '');
INSERT INTO `admin_menu` VALUES ('5', '菜单管理', '2', 'admin/menu/index', 'admin.menu.index', '0', '', '0', '系统设置');
INSERT INTO `admin_menu` VALUES ('6', '新增', '5', 'admin/menu/create', 'admin.menu.create', '0', '', '1', '系统设置');
INSERT INTO `admin_menu` VALUES ('7', '编辑', '5', 'admin/menu/edit', 'admin.menu.edit', '0', '', '1', '系统设置');
INSERT INTO `admin_menu` VALUES ('8', '更新', '5', 'admin/menu/update', 'admin.menu.update', '0', '', '1', '系统设置');
INSERT INTO `admin_menu` VALUES ('9', '删除', '5', 'admin/menu/destroy', 'admin.menu.destroy', '0', '', '1', '系统设置');
