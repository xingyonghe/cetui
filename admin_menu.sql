/*
Navicat MySQL Data Transfer

Source Server         : 本地
Source Server Version : 50547
Source Host           : localhost:3306
Source Database       : cetui

Target Server Type    : MYSQL
Target Server Version : 50547
File Encoding         : 65001

Date: 2017-01-04 16:21:20
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
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COMMENT='系统菜单';

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
INSERT INTO `admin_menu` VALUES ('10', '网红', '0', 'admin/netred/system', 'admin.netred.system', '0', 'icon-star', '0', '');
INSERT INTO `admin_menu` VALUES ('11', '活动', '0', 'admin/task/index', 'admin.task.index', '0', 'icon-tasks', '0', '');
INSERT INTO `admin_menu` VALUES ('12', '导航管理', '2', 'admin/channel/index', 'admin.channel.index', '0', '', '0', '系统设置');
INSERT INTO `admin_menu` VALUES ('13', '日志管理', '2', 'admin/syslog/index', 'admin.syslog.ndex', '0', '', '0', '数据管理');
INSERT INTO `admin_menu` VALUES ('14', '数据备份', '2', 'admin/database/index', 'admin.database.index', '0', '', '0', '数据管理');
INSERT INTO `admin_menu` VALUES ('15', '网红平台', '10', 'admin/platform/index', 'admin.platform.index', '1', '', '0', '模块设置');
INSERT INTO `admin_menu` VALUES ('16', '广告形式', '10', 'admin/adform/index', 'admin.adform.index', '2', '', '0', '模块设置');
INSERT INTO `admin_menu` VALUES ('17', '系统网红', '10', 'admin/netred/system', 'admin.netred.system', '3', '', '0', '网红管理');
INSERT INTO `admin_menu` VALUES ('18', '会员网红', '10', 'admin/netred/index', 'admin.netred.index', '4', '', '0', '网红管理');
INSERT INTO `admin_menu` VALUES ('19', '网红审核', '10', 'admin/netred/check', 'admin.netred.check', '5', '', '0', '网红管理');
INSERT INTO `admin_menu` VALUES ('20', '回收站', '10', 'admin/netred/recycle', 'admin.netred.recycle', '6', '', '0', '网红管理');
INSERT INTO `admin_menu` VALUES ('21', '排序', '5', 'admin/menu/sort', 'admin.menu.sort', '0', '', '1', '系统设置');
INSERT INTO `admin_menu` VALUES ('22', '更新排序', '5', 'admin/menu/order', 'admin.menu.order', '0', '', '1', '系统设置');
INSERT INTO `admin_menu` VALUES ('23', '新增', '15', 'admin/platform/create', 'admin.platform.create', '0', '', '1', '模块设置');
INSERT INTO `admin_menu` VALUES ('24', '编辑', '15', 'admin/platform/edit', 'admin.platform.edit', '0', '', '1', '模块设置');
INSERT INTO `admin_menu` VALUES ('25', '更新', '15', 'admin/platform/update', 'admin.platform.update', '0', '', '1', '模块设置');
INSERT INTO `admin_menu` VALUES ('26', '删除', '15', 'admin/platform/destroy', 'admin.platform.destroy', '0', '', '1', '模块设置');
INSERT INTO `admin_menu` VALUES ('27', '排序', '15', 'admin/platform/sort', 'admin.platform.sort', '0', '', '1', '模块设置');
INSERT INTO `admin_menu` VALUES ('28', '更新排序', '15', 'admin/platform/order', 'admin.platform.order', '0', '', '1', '模块设置');
INSERT INTO `admin_menu` VALUES ('29', '新增', '16', 'admin/adform/create', 'admin.adform.create', '0', '', '1', '模块设置');
INSERT INTO `admin_menu` VALUES ('30', '编辑', '16', 'admin/adform/edit', 'admin.adform.edit', '0', '', '1', '模块设置');
INSERT INTO `admin_menu` VALUES ('31', '更新', '16', 'admin/adform/update', 'admin.adform.update', '0', '', '1', '模块设置');
INSERT INTO `admin_menu` VALUES ('32', '删除', '16', 'admin/adform/destroy', 'admin.adform.destroy', '0', '', '1', '模块设置');
INSERT INTO `admin_menu` VALUES ('33', '排序', '16', 'admin/adform/sort', 'admin.adform.sort', '0', '', '1', '模块设置');
INSERT INTO `admin_menu` VALUES ('34', '更新排序', '16', 'admin/adform/order', 'admin.adform.order', '0', '', '1', '模块设置');

-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '分类名称',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '上级分类ID',
  `sort` tinyint(4) NOT NULL DEFAULT '0' COMMENT '排序',
  `model` varchar(30) NOT NULL DEFAULT '' COMMENT '模块分组',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COMMENT='分类';

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES ('1', '电商', '0', '0', 'netred', '2016-12-24 16:09:26', '2016-12-24 16:09:26');
INSERT INTO `category` VALUES ('2', 'APP', '0', '0', 'netred', '2016-12-24 16:09:38', '2016-12-24 16:09:38');
INSERT INTO `category` VALUES ('3', '游戏', '0', '0', 'netred', '2016-12-24 16:09:45', '2016-12-24 16:09:45');
INSERT INTO `category` VALUES ('4', '品牌', '0', '0', 'netred', '2016-12-24 16:09:52', '2016-12-24 16:09:52');
INSERT INTO `category` VALUES ('5', '男装', '7', '0', 'netred', '2016-12-24 16:10:12', '2016-12-24 16:10:12');
INSERT INTO `category` VALUES ('6', '女装', '7', '0', 'netred', '2016-12-24 16:11:22', '2016-12-24 16:11:22');
INSERT INTO `category` VALUES ('7', '美容', '7', '0', 'netred', '2016-12-24 16:11:46', '2016-12-24 16:11:46');
INSERT INTO `category` VALUES ('8', '整形', '7', '0', 'netred', '2016-12-24 16:11:54', '2016-12-24 16:11:54');
INSERT INTO `category` VALUES ('9', '时尚购物', '8', '0', 'netred', '2016-12-24 16:12:16', '2016-12-24 16:12:16');
INSERT INTO `category` VALUES ('10', '医疗健康', '8', '0', 'netred', '2016-12-24 16:12:28', '2016-12-24 16:12:28');
INSERT INTO `category` VALUES ('11', '页游', '9', '0', 'netred', '2016-12-24 16:12:55', '2016-12-24 16:12:55');
INSERT INTO `category` VALUES ('12', '端游', '9', '0', 'netred', '2016-12-24 16:13:07', '2016-12-24 16:13:07');
INSERT INTO `category` VALUES ('13', '手游', '9', '0', 'netred', '2016-12-24 16:13:18', '2016-12-24 16:13:18');
INSERT INTO `category` VALUES ('14', '手表饰品', '10', '0', 'netred', '2016-12-24 16:13:28', '2016-12-24 16:13:28');
INSERT INTO `category` VALUES ('15', '汽车品牌', '10', '0', 'netred', '2016-12-24 16:13:40', '2016-12-24 16:13:40');
INSERT INTO `category` VALUES ('16', '产品发布会', '10', '0', 'netred', '2016-12-24 16:13:49', '2016-12-24 16:13:49');

-- ----------------------------
-- Table structure for picture
-- ----------------------------
DROP TABLE IF EXISTS `picture`;
CREATE TABLE `picture` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `path` varchar(255) NOT NULL DEFAULT '' COMMENT '路径',
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT '图片链接',
  `md5` char(32) NOT NULL DEFAULT '' COMMENT '文件md5',
  `sha1` char(40) NOT NULL DEFAULT '' COMMENT '文件sha1编码',
  `create_time` timestamp NULL DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='图片表';

-- ----------------------------
-- Records of picture
-- ----------------------------
INSERT INTO `picture` VALUES ('1', '/uploads/picture/2017-01-04/586c8ca13308e.jpg', '', '3e1afd1663a7dad9521da3956deb09e3', '91e7cc9fb5b6f3e638d3fa925e8c29ea96975b9e', '2017-01-04 13:48:17');
INSERT INTO `picture` VALUES ('2', '/uploads/picture/2017-01-04/586c8cc5cbd96.jpg', '', 'ec1d0a0142a8038eebbaa8b1ea4fb9f3', '40d6829027f37ec8d9214be5d72753702b259a7a', '2017-01-04 13:48:53');

-- ----------------------------
-- Table structure for user_netred
-- ----------------------------
DROP TABLE IF EXISTS `user_netred`;
CREATE TABLE `user_netred` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '资源ID',
  `userid` int(10) DEFAULT NULL COMMENT '网红ID',
  `status` tinyint(4) DEFAULT '1' COMMENT '状态:-1删除1正常2待审核3审核未通过',
  `avatar` varchar(255) DEFAULT '' COMMENT '头像',
  `stage_name` varchar(255) DEFAULT '' COMMENT '艺名',
  `sex` tinyint(2) DEFAULT '1' COMMENT '1男2女',
  `province` int(10) DEFAULT '0' COMMENT '省份ID',
  `city` int(10) DEFAULT '0' COMMENT '城市ID',
  `district` int(10) DEFAULT '0' COMMENT '地区ID',
  `area` varchar(100) DEFAULT '' COMMENT '地区字符',
  `type` tinyint(2) DEFAULT '1' COMMENT '资源分类：1直播2短视频',
  `fans` int(12) DEFAULT '0' COMMENT '粉丝数量',
  `platform` tinyint(4) DEFAULT '0' COMMENT '所属平台',
  `platform_id` varchar(100) DEFAULT '' COMMENT '平台ID',
  `average_num` int(10) DEFAULT '0' COMMENT '平均观看人数',
  `max_num` int(10) DEFAULT '0' COMMENT '最高观看人数',
  `style` varchar(255) DEFAULT '' COMMENT '风格',
  `catids` varchar(255) DEFAULT '' COMMENT '广告类型',
  `form_price` varchar(255) DEFAULT '' COMMENT '广告形式及价格',
  `min_money` decimal(10,2) DEFAULT '0.00' COMMENT '最低价格',
  `max_money` decimal(10,2) DEFAULT '0.00' COMMENT '最大价格',
  `note` varchar(2000) DEFAULT '' COMMENT '备注',
  `advantage` varchar(2000) DEFAULT '' COMMENT '优势',
  `introduce` varchar(2000) DEFAULT '' COMMENT '介绍',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='平台';

-- ----------------------------
-- Records of user_netred
-- ----------------------------

-- ----------------------------
-- Table structure for user_netred_adform
-- ----------------------------
DROP TABLE IF EXISTS `user_netred_adform`;
CREATE TABLE `user_netred_adform` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '广告形式id',
  `name` varchar(100) DEFAULT '' COMMENT '广告形式名称',
  `category` tinyint(2) DEFAULT '1' COMMENT '广告形式类别：1直播2短视频',
  `sort` tinyint(2) DEFAULT '0' COMMENT '排序',
  `explain` varchar(500) DEFAULT '' COMMENT '说明',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='广告形式';

-- ----------------------------
-- Records of user_netred_adform
-- ----------------------------
INSERT INTO `user_netred_adform` VALUES ('1', '品牌植入', '1', '1', '', '2016-12-24 18:11:50', '2016-12-24 18:14:43');
INSERT INTO `user_netred_adform` VALUES ('2', '专场口播', '1', '2', '', '2016-12-24 18:12:01', '2016-12-24 18:14:43');
INSERT INTO `user_netred_adform` VALUES ('3', '线下驻场', '1', '3', '', '2016-12-24 18:12:07', '2016-12-24 18:14:43');
INSERT INTO `user_netred_adform` VALUES ('4', '品牌植入', '2', '4', '', '2016-12-24 18:12:15', '2016-12-24 18:14:43');
INSERT INTO `user_netred_adform` VALUES ('5', '专场口播', '2', '5', '', '2016-12-24 18:12:24', '2016-12-24 18:14:43');
INSERT INTO `user_netred_adform` VALUES ('6', '片头展示', '2', '6', '', '2016-12-24 18:12:33', '2016-12-24 18:14:43');
INSERT INTO `user_netred_adform` VALUES ('7', '片尾展示', '2', '7', '', '2016-12-24 18:12:42', '2016-12-24 18:14:43');
INSERT INTO `user_netred_adform` VALUES ('8', '线下驻场', '2', '8', '', '2016-12-24 18:12:50', '2017-01-04 13:11:10');

-- ----------------------------
-- Table structure for user_netred_platform
-- ----------------------------
DROP TABLE IF EXISTS `user_netred_platform`;
CREATE TABLE `user_netred_platform` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '平台id',
  `name` varchar(100) DEFAULT '' COMMENT '平台名称',
  `icon` varchar(255) DEFAULT '' COMMENT '平台图标',
  `category` tinyint(2) DEFAULT '1' COMMENT '平台分类：1直播2短视频',
  `sort` tinyint(2) DEFAULT '0' COMMENT '排序',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='平台';

-- ----------------------------
-- Records of user_netred_platform
-- ----------------------------
INSERT INTO `user_netred_platform` VALUES ('1', '花椒', '/uploads/picture/2016-12-24/585dfde4e3bf3.jpg', '1', '1', '2016-12-24 13:06:57', '2016-12-24 13:26:34');
INSERT INTO `user_netred_platform` VALUES ('2', '一直播', '/uploads/picture/2016-12-24/585e03d934af8.jpg', '1', '2', '2016-12-24 13:12:59', '2016-12-24 18:13:15');
INSERT INTO `user_netred_platform` VALUES ('3', '熊猫TV', '/uploads/picture/2016-12-24/585e03efd02f2.jpg', '1', '4', '2016-12-24 13:13:21', '2017-01-04 13:50:41');
INSERT INTO `user_netred_platform` VALUES ('4', '映客', '/uploads/picture/2016-12-24/585e04005df29.jpg', '1', '6', '2016-12-24 13:13:37', '2017-01-04 13:50:41');
INSERT INTO `user_netred_platform` VALUES ('5', '斗鱼', '/uploads/picture/2016-12-24/585e041613240.jpg', '1', '8', '2016-12-24 13:13:59', '2017-01-04 13:50:41');
INSERT INTO `user_netred_platform` VALUES ('6', '快手 ', '/uploads/picture/2016-12-24/585e04455f1ed.jpg', '2', '9', '2016-12-24 13:14:47', '2017-01-04 13:50:41');
INSERT INTO `user_netred_platform` VALUES ('7', '秒拍', '/uploads/picture/2016-12-24/585e045bd62a6.jpg', '2', '10', '2016-12-24 13:15:09', '2017-01-04 13:50:41');
INSERT INTO `user_netred_platform` VALUES ('8', '美拍', '/uploads/picture/2016-12-24/585e0465557d0.jpg', '2', '11', '2016-12-24 13:15:29', '2017-01-04 13:51:15');
INSERT INTO `user_netred_platform` VALUES ('9', '微拍', '/uploads/picture/2016-12-24/585e04806bc9e.jpg', '2', '7', '2016-12-24 13:15:45', '2017-01-04 13:50:41');
INSERT INTO `user_netred_platform` VALUES ('10', '爱拍', '/uploads/picture/2016-12-24/585e0495c5992.jpg', '2', '5', '2016-12-24 13:16:06', '2017-01-04 13:50:41');
INSERT INTO `user_netred_platform` VALUES ('11', '小咖秀', '/uploads/picture/2016-12-24/585e04a4c0ce2.jpg', '2', '3', '2016-12-24 13:16:21', '2017-01-04 13:50:41');
INSERT INTO `user_netred_platform` VALUES ('12', '小影', '/uploads/picture/2017-01-04/586c8ca13308e.jpg', '2', '12', '2016-12-24 13:16:38', '2017-01-04 13:51:15');
