/*
Navicat MySQL Data Transfer

Source Server         : 本地
Source Server Version : 50547
Source Host           : localhost:3306
Source Database       : cetui

Target Server Type    : MYSQL
Target Server Version : 50547
File Encoding         : 65001

Date: 2017-01-06 17:58:50
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
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8 COMMENT='系统菜单';

-- ----------------------------
-- Records of admin_menu
-- ----------------------------
INSERT INTO `admin_menu` VALUES ('1', '首页', '0', 'admin', 'admin.index.index', '1', 'icon-home', '0', '');
INSERT INTO `admin_menu` VALUES ('2', '系统', '0', 'admin/menu/index', 'admin.menu.index', '6', 'icon-cogs', '0', '');
INSERT INTO `admin_menu` VALUES ('3', '用户', '0', 'admin/bank/index', 'admin.bank.index', '2', 'icon-user', '0', '');
INSERT INTO `admin_menu` VALUES ('4', '客服', '0', 'admin/custom/index', 'admin.custom.index', '3', 'icon-user-md', '0', '');
INSERT INTO `admin_menu` VALUES ('5', '菜单管理', '2', 'admin/menu/index', 'admin.menu.index', '5', '', '0', '系统设置');
INSERT INTO `admin_menu` VALUES ('6', '新增', '5', 'admin/menu/create', 'admin.menu.create', '0', '', '1', '系统设置');
INSERT INTO `admin_menu` VALUES ('7', '编辑', '5', 'admin/menu/edit', 'admin.menu.edit', '0', '', '1', '系统设置');
INSERT INTO `admin_menu` VALUES ('8', '更新', '5', 'admin/menu/update', 'admin.menu.update', '0', '', '1', '系统设置');
INSERT INTO `admin_menu` VALUES ('9', '删除', '5', 'admin/menu/destroy', 'admin.menu.destroy', '0', '', '1', '系统设置');
INSERT INTO `admin_menu` VALUES ('10', '网红', '0', 'admin/netred/system', 'admin.netred.system', '4', 'icon-star', '0', '');
INSERT INTO `admin_menu` VALUES ('11', '活动', '0', 'admin/task/index', 'admin.task.index', '5', 'icon-tasks', '0', '');
INSERT INTO `admin_menu` VALUES ('12', '导航管理', '2', 'admin/channel/index', 'admin.channel.index', '4', '', '0', '系统设置');
INSERT INTO `admin_menu` VALUES ('13', '日志管理', '2', 'admin/syslog/index', 'admin.syslog.ndex', '5', '', '0', '数据管理');
INSERT INTO `admin_menu` VALUES ('14', '数据备份', '2', 'admin/database/index', 'admin.database.index', '6', '', '0', '数据管理');
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
INSERT INTO `admin_menu` VALUES ('35', '新增', '12', 'admin/channel/create', 'admin.channel.create', '0', '', '1', '系统设置');
INSERT INTO `admin_menu` VALUES ('36', '修改', '12', 'admin/channel/edit', 'admin.channel.edit', '0', '', '1', '系统设置');
INSERT INTO `admin_menu` VALUES ('37', '更新', '12', 'admin/channel/update', 'admin.channel.update', '0', '', '1', '系统设置');
INSERT INTO `admin_menu` VALUES ('38', '删除', '12', 'admin/channel/destroy', 'admin.channel.destroy', '0', '', '1', '系统设置');
INSERT INTO `admin_menu` VALUES ('39', '排序', '12', 'admin/channel/sort', 'admin.channel.sort', '0', '', '1', '系统设置');
INSERT INTO `admin_menu` VALUES ('40', '更新排序', '12', 'admin/channel/order', 'admin.channel.order', '0', '', '1', '系统设置');
INSERT INTO `admin_menu` VALUES ('41', '配置管理', '2', 'admin/config/index', 'admin.config.index', '2', '', '0', '系统设置');
INSERT INTO `admin_menu` VALUES ('42', '网站设置', '2', 'admin/config/setting', 'admin.config.setting', '1', '', '0', '系统设置');
INSERT INTO `admin_menu` VALUES ('43', '更新设置', '42', 'admin/config/post', 'admin.config.post', '0', '', '1', '系统设置');
INSERT INTO `admin_menu` VALUES ('44', '新增', '41', 'admin/config/create', 'admin.config.create', '0', '', '1', '系统设置');
INSERT INTO `admin_menu` VALUES ('45', '修改', '41', 'admin/config/edit', 'admin.config.edit', '0', '', '1', '系统设置');
INSERT INTO `admin_menu` VALUES ('46', '更新', '41', 'admin/config/update', 'admin.config.update', '0', '', '1', '系统设置');
INSERT INTO `admin_menu` VALUES ('47', '删除', '41', 'admin/config/destroy', 'admin.config.destroy', '0', '', '1', '系统设置');
INSERT INTO `admin_menu` VALUES ('48', '导入', '17', 'admin/netred/import', 'admin.netred.import', '0', '', '0', '网红管理');
INSERT INTO `admin_menu` VALUES ('49', '会员管理', '3', 'admin/user/index', 'admin.user.index', '2', '', '0', '用户管理');
INSERT INTO `admin_menu` VALUES ('50', '广告主', '3', 'admin/user/ads', 'admin.user.ads', '3', '', '0', '用户管理');
INSERT INTO `admin_menu` VALUES ('51', '账户管理', '3', 'admin/bank/index', 'admin.bank.index', '1', '', '0', '模块设置');

-- ----------------------------
-- Table structure for admin_user
-- ----------------------------
DROP TABLE IF EXISTS `admin_user`;
CREATE TABLE `admin_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` varchar(255) NOT NULL DEFAULT '' COMMENT '密码',
  `nickname` varchar(100) NOT NULL DEFAULT '' COMMENT '昵称',
  `type` tinyint(4) DEFAULT '1' COMMENT '管理员分类：1系统管理员2网红管理员3广告主管理员',
  `qq` varchar(30) DEFAULT '' COMMENT '客服QQ',
  `role_id` tinyint(4) NOT NULL DEFAULT '0' COMMENT '用户组ID',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态：-1删除，0禁用，1正常',
  `remember_token` varchar(100) DEFAULT NULL COMMENT '记住我标识',
  `reg_time` timestamp NULL DEFAULT NULL COMMENT '注册时间',
  `login_time` timestamp NULL DEFAULT NULL COMMENT '最后登录时间',
  `login_ip` char(15) NOT NULL DEFAULT '' COMMENT '最后登录ID',
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_user_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='管理员表';

-- ----------------------------
-- Records of admin_user
-- ----------------------------
INSERT INTO `admin_user` VALUES ('1', 'admin', '$2y$10$gcM59gn/8fF7loOVC1a.QuffmG1wM1hKl.OpBc6BdiCh2Fz1WawRa', '超管', '1', '', '1', '1', 'NUpLpFBJYvFzJHS5xSLyiM51bdN5M40PLMLqBa5rGFDwTqn7FYN652F4LeCc', '2016-11-15 09:17:38', '2017-01-05 11:29:33', '127.0.0.1');
INSERT INTO `admin_user` VALUES ('2', 'xingyonghe', '$2y$10$1gGSm8H9xJx3/butYr/KheO2.gPnmh8prxOQ0AcPaXL0AgINKxM0m', '风影', '3', '365754061', '2', '1', 'KNYnalxXCJmMIp7OTmQywx2ybHgoaFLQPR27QqRmnGrfqeqr8zFh1Jdrxcaf', '2016-11-16 03:30:16', '2016-11-17 02:16:55', '127.0.0.1');
INSERT INTO `admin_user` VALUES ('3', 'xingyingfeng', '$2y$10$6m.iqImB7wikG6L0SVJPt.pM0kdRQvvNzMvZWq4ETHw628LNycZ6C', '永和测试', '1', '1342234898', '2', '1', null, '2016-11-16 03:33:25', '2016-11-16 03:33:25', '');

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
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8 COMMENT='分类';

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES ('1', '网络推广', '0', '0', 'netred', '2016-12-24 16:09:26', '2016-12-24 16:09:26');
INSERT INTO `category` VALUES ('2', 'APP推广', '0', '0', 'netred', '2016-12-24 16:09:38', '2016-12-24 16:09:38');
INSERT INTO `category` VALUES ('3', '游戏推广', '0', '0', 'netred', '2016-12-24 16:09:45', '2016-12-24 16:09:45');
INSERT INTO `category` VALUES ('4', '品牌推广', '0', '0', 'netred', '2016-12-24 16:09:52', '2016-12-24 16:09:52');
INSERT INTO `category` VALUES ('5', '男装', '1', '0', 'netred', '2016-12-24 16:10:12', '2016-12-24 16:10:12');
INSERT INTO `category` VALUES ('6', '女装', '1', '0', 'netred', '2016-12-24 16:11:22', '2016-12-24 16:11:22');
INSERT INTO `category` VALUES ('7', '美容', '1', '0', 'netred', '2016-12-24 16:11:46', '2016-12-24 16:11:46');
INSERT INTO `category` VALUES ('8', '整形', '1', '0', 'netred', '2016-12-24 16:11:54', '2016-12-24 16:11:54');
INSERT INTO `category` VALUES ('9', '时尚购物', '2', '0', 'netred', '2016-12-24 16:12:16', '2016-12-24 16:12:16');
INSERT INTO `category` VALUES ('10', '医疗健康', '2', '0', 'netred', '2016-12-24 16:12:28', '2016-12-24 16:12:28');
INSERT INTO `category` VALUES ('11', '页游', '3', '0', 'netred', '2016-12-24 16:12:55', '2016-12-24 16:12:55');
INSERT INTO `category` VALUES ('12', '端游', '3', '0', 'netred', '2016-12-24 16:13:07', '2016-12-24 16:13:07');
INSERT INTO `category` VALUES ('13', '手游', '3', '0', 'netred', '2016-12-24 16:13:18', '2016-12-24 16:13:18');
INSERT INTO `category` VALUES ('14', '手表饰品', '4', '0', 'netred', '2016-12-24 16:13:28', '2016-12-24 16:13:28');
INSERT INTO `category` VALUES ('15', '汽车品牌', '4', '0', 'netred', '2016-12-24 16:13:40', '2016-12-24 16:13:40');
INSERT INTO `category` VALUES ('16', '产品发布会', '4', '0', 'netred', '2016-12-24 16:13:49', '2016-12-24 16:13:49');
INSERT INTO `category` VALUES ('17', '彩妆', '1', '0', 'netred', '2016-12-24 16:13:49', '2016-12-24 16:13:49');
INSERT INTO `category` VALUES ('18', '家居家纺', '1', '0', 'netred', '2016-12-24 16:13:49', '2016-12-24 16:13:49');
INSERT INTO `category` VALUES ('19', '包包', '1', '0', 'netred', '2016-12-24 16:13:49', '2016-12-24 16:13:49');
INSERT INTO `category` VALUES ('20', '鞋帽', '1', '0', 'netred', '2016-12-24 16:13:49', '2016-12-24 16:13:49');
INSERT INTO `category` VALUES ('21', '母婴', '1', '0', 'netred', '2016-12-24 16:13:49', '2016-12-24 16:13:49');
INSERT INTO `category` VALUES ('22', '珠宝', '1', '0', 'netred', '2016-12-24 16:13:49', '2016-12-24 16:13:49');
INSERT INTO `category` VALUES ('23', '手机数码', '1', '0', 'netred', '2016-12-24 16:13:49', '2016-12-24 16:13:49');
INSERT INTO `category` VALUES ('24', '美食', '1', '0', 'netred', '2016-12-24 16:13:49', '2016-12-24 16:13:49');
INSERT INTO `category` VALUES ('25', '休闲娱乐', '2', '0', 'netred', '2016-12-24 16:13:49', '2016-12-24 16:13:49');
INSERT INTO `category` VALUES ('26', '自拍摄影', '2', '0', 'netred', '2016-12-24 16:13:49', '2016-12-24 16:13:49');
INSERT INTO `category` VALUES ('27', '户外旅游', '2', '0', 'netred', '2016-12-24 16:13:49', '2016-12-24 16:13:49');
INSERT INTO `category` VALUES ('28', '金融理财', '2', '0', 'netred', '2016-12-24 16:13:49', '2016-12-24 16:13:49');
INSERT INTO `category` VALUES ('29', '学习教育', '2', '0', 'netred', '2016-12-24 16:13:49', '2016-12-24 16:13:49');
INSERT INTO `category` VALUES ('30', '美食', '2', '0', 'netred', '2016-12-24 16:13:49', '2016-12-24 16:13:49');
INSERT INTO `category` VALUES ('31', 'O2O', '2', '0', 'netred', '2016-12-24 16:13:49', '2016-12-24 16:13:49');
INSERT INTO `category` VALUES ('32', '棋牌捕鱼', '3', '0', 'netred', '2016-12-24 16:13:49', '2016-12-24 16:13:49');
INSERT INTO `category` VALUES ('33', '小游戏', '3', '0', 'netred', '2016-12-24 16:13:49', '2016-12-24 16:13:49');
INSERT INTO `category` VALUES ('34', '单机游新', '3', '0', 'netred', '2016-12-24 16:13:49', '2016-12-24 16:13:49');
INSERT INTO `category` VALUES ('35', '金融理财', '2', '0', 'netred', '2016-12-24 16:13:49', '2016-12-24 16:13:49');
INSERT INTO `category` VALUES ('36', '学习教育', '2', '0', 'netred', '2016-12-24 16:13:49', '2016-12-24 16:13:49');
INSERT INTO `category` VALUES ('37', '美食', '2', '0', 'netred', '2016-12-24 16:13:49', '2016-12-24 16:13:49');
INSERT INTO `category` VALUES ('38', 'O2O', '2', '0', 'netred', '2016-12-24 16:13:49', '2016-12-24 16:13:49');
INSERT INTO `category` VALUES ('39', '活动发布', '4', '0', 'netred', '2016-12-24 16:13:49', '2016-12-24 16:13:49');
INSERT INTO `category` VALUES ('40', '房产', '4', '0', 'netred', '2016-12-24 16:13:49', '2016-12-24 16:13:49');
INSERT INTO `category` VALUES ('41', '酒店', '4', '0', 'netred', '2016-12-24 16:13:49', '2016-12-24 16:13:49');
INSERT INTO `category` VALUES ('42', '旅游', '4', '0', 'netred', '2016-12-24 16:13:49', '2016-12-24 16:13:49');
INSERT INTO `category` VALUES ('43', '景区', '4', '0', 'netred', '2016-12-24 16:13:49', '2016-12-24 16:13:49');
INSERT INTO `category` VALUES ('44', '名菜', '4', '0', 'netred', '2016-12-24 16:13:49', '2016-12-24 16:13:49');
INSERT INTO `category` VALUES ('45', '餐厅', '4', '0', 'netred', '2016-12-24 16:13:49', '2016-12-24 16:13:49');

-- ----------------------------
-- Table structure for channel
-- ----------------------------
DROP TABLE IF EXISTS `channel`;
CREATE TABLE `channel` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '导航标题',
  `url` varchar(150) NOT NULL DEFAULT '' COMMENT '导航链接',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '是否隐藏:1显示，0隐藏',
  `target` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否新窗口打开:0否，1是',
  `remark` varchar(150) NOT NULL DEFAULT '' COMMENT '导航备注',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='导航';

-- ----------------------------
-- Records of channel
-- ----------------------------
INSERT INTO `channel` VALUES ('1', '首页', 'home.index.index', '1', '1', '0', '', '2016-11-21 17:55:18', '2016-11-22 10:58:55');
INSERT INTO `channel` VALUES ('2', '网红推荐', 'home.rednet.index', '2', '1', '0', '', '2016-11-21 17:55:41', '2017-01-04 21:51:40');
INSERT INTO `channel` VALUES ('3', '客户案例', 'home.case.index', '3', '1', '0', '', '2016-11-22 15:43:43', '2016-12-08 12:49:52');
INSERT INTO `channel` VALUES ('4', '广告主', 'home.ads.index', '4', '1', '0', '', '2016-11-22 15:44:05', '2017-01-04 21:58:23');
INSERT INTO `channel` VALUES ('5', '网红入驻', 'home.enter.index', '5', '1', '0', '', '2016-11-22 15:45:15', '2017-01-04 21:58:23');

-- ----------------------------
-- Table structure for config
-- ----------------------------
DROP TABLE IF EXISTS `config`;
CREATE TABLE `config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '配置标题',
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '配置名称',
  `type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '配置类型:0数字，1字符，2文本，3数组，4枚举，5图片',
  `group` tinyint(4) NOT NULL DEFAULT '0' COMMENT '配置分组:0基本设置，1SEO优化',
  `module` varchar(20) NOT NULL DEFAULT '' COMMENT '所属模块',
  `value` varchar(300) NOT NULL DEFAULT '' COMMENT '配置值',
  `extra` varchar(300) NOT NULL DEFAULT '' COMMENT '配置项',
  `remark` varchar(150) NOT NULL DEFAULT '' COMMENT '配置说明',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='网站配置';

-- ----------------------------
-- Records of config
-- ----------------------------
INSERT INTO `config` VALUES ('1', '配置类型列表', 'CONFIG_TYPE_LIST', '3', '1', 'system', '1:数字\r\n2:字符\r\n3:文本\r\n4:枚举\r\n5:图片', '', '主要用于数据解析和页面表单的生成', '2016-11-14 13:32:11', '2016-11-14 13:41:33');
INSERT INTO `config` VALUES ('2', '配置分组', 'CONFIG_GROUP_LIST', '3', '1', 'system', '1:基本\r\n2:系统\r\n3:模块', '', '配置分组', '2016-11-14 13:40:43', '2017-01-04 23:19:31');
INSERT INTO `config` VALUES ('3', '后台系统列表页数目', 'ADMIN_PAGE_LIMIT', '1', '1', 'system', '10', '', '后台非模块部分列表页数目', '2016-11-14 13:48:10', '2016-11-17 03:33:00');
INSERT INTO `config` VALUES ('4', '网站LOGO', 'WEB_SITE_LOGO', '5', '2', 'system', '', '', '网站LOGO', '2016-11-14 13:49:36', '2017-01-04 23:35:08');
INSERT INTO `config` VALUES ('5', '网站域名地址', 'WEB_SITE_URL', '2', '2', 'system', 'http://www.cetui.com', '', '网站域名地址', '2016-11-14 13:50:27', '2016-11-14 13:50:27');
INSERT INTO `config` VALUES ('6', '网站名称', 'WEB_SITE_TITLE', '2', '2', 'system', '策推互动', '', '网站标题前台显示标题', '2016-11-17 02:27:55', '2017-01-04 23:22:38');
INSERT INTO `config` VALUES ('7', '会员添加网红审核', 'NETRED_VERIFY', '4', '3', 'netred', '1', '0:不需要\r\n1:需要', '新增网红是否需要后台管理员审核', '2016-11-17 02:31:48', '2017-01-04 23:08:07');
INSERT INTO `config` VALUES ('8', '网站模块', 'CONFIG_MODULE_LIST', '3', '1', 'system', 'system:系统\r\narticle:内容\r\nuser:用户\r\ncustom:客服\r\nnetred:网红\r\ntask:活动', '', '网站主要模块，用于网站模块设置', '2016-11-18 11:32:04', '2017-01-04 23:06:26');
INSERT INTO `config` VALUES ('9', '用户网红列表页数目', 'NETRED_PAGE_LIMIT', '1', '3', 'netred', '10', '', '前台列表分页数量', '2016-11-18 16:56:37', '2016-11-18 17:06:25');
INSERT INTO `config` VALUES ('10', '网红风格', 'NETRED_STYLE', '3', '3', 'netred', '1:明星/名人\r\n2:段子手\r\n3:娱乐搞笑\r\n4:时尚搭配\r\n5:美容美妆\r\n6:游戏/动漫     \r\n7:影视/音乐\r\n8:体育/健身\r\n9:美食\r\n10:户外/旅行\r\n11:母婴/育儿\r\n12:汽车\r\n13:摄影\r\n14:金融/理财\r\n15:教育\r\n16:其他', '', '', '2016-12-24 13:58:08', '2017-01-04 23:07:41');
INSERT INTO `config` VALUES ('11', '活动广告类型', 'ADS_TASK_TYPE', '3', '3', 'netred', '1:电商\r\n2:APP\r\n3:游戏\r\n4:金融\r\n5:品牌推广\r\n6:发布会', '', '', '2016-12-27 16:27:49', '2016-12-27 20:38:13');
INSERT INTO `config` VALUES ('12', '网红类型', 'NETRED_TYPE', '3', '3', 'netred', '1:直播\r\n2:短视频', '', '资源类型和广告投放类型都要用到', '2016-12-27 20:34:01', '2017-01-04 23:07:29');
INSERT INTO `config` VALUES ('13', '活动审核', 'ADS_TASK_VERIFY', '4', '3', 'netred', '1', '不需要\r\n需要', '', '2016-12-27 20:36:52', '2016-12-27 20:36:52');

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='图片表';

-- ----------------------------
-- Records of picture
-- ----------------------------
INSERT INTO `picture` VALUES ('1', '/uploads/picture/2017-01-04/586c8ca13308e.jpg', '', '3e1afd1663a7dad9521da3956deb09e3', '91e7cc9fb5b6f3e638d3fa925e8c29ea96975b9e', '2017-01-04 13:48:17');
INSERT INTO `picture` VALUES ('2', '/uploads/picture/2017-01-04/586c8cc5cbd96.jpg', '', 'ec1d0a0142a8038eebbaa8b1ea4fb9f3', '40d6829027f37ec8d9214be5d72753702b259a7a', '2017-01-04 13:48:53');
INSERT INTO `picture` VALUES ('3', '/uploads/picture/2017-01-04/586d14cd86e31.jpg', '', 'e87a76650049c27eec42d44a606b45c0', 'b411e1d6de5067b60b05c12f0e3176bafda337f2', '2017-01-04 23:29:17');
INSERT INTO `picture` VALUES ('4', '/uploads/picture/2017-01-04/586d15d6a65da.jpg', '', '3b0101902d2c97e7cba61e3f8f8cd8b5', 'fef034e82ecedf27a045264afdd1f0aaaf983df9', '2017-01-04 23:33:42');
INSERT INTO `picture` VALUES ('5', '/uploads/picture/2017-01-04/586d1623d7e01.png', '', '90d041042ea62d03b062793923d12a35', '2b22045077bc3e53013755cf3eac042dd3ffaf28', '2017-01-04 23:34:59');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL COMMENT '用户名:手机号',
  `password` varchar(255) NOT NULL DEFAULT '' COMMENT '密码',
  `remember_token` varchar(100) DEFAULT NULL COMMENT '记住我',
  `nickname` varchar(100) NOT NULL DEFAULT '' COMMENT '联系人',
  `is_auth` tinyint(4) NOT NULL DEFAULT '0' COMMENT '手机号是否认证通过:1已认证，0未认证',
  `type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '用户类型:1普通2广告主',
  `qq` varchar(20) NOT NULL DEFAULT '' COMMENT 'QQ',
  `weixin` varchar(150) NOT NULL DEFAULT '' COMMENT '微信',
  `balance` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '余额',
  `company` varchar(255) NOT NULL DEFAULT '0' COMMENT '公司名称',
  `custom_id` int(11) NOT NULL DEFAULT '0' COMMENT '客服ID',
  `custom_name` varchar(150) NOT NULL DEFAULT '' COMMENT '客服名称',
  `status` tinyint(4) NOT NULL DEFAULT '2' COMMENT '状态:-1删除、0锁定、1正常、2待审核',
  `email` varchar(255) NOT NULL DEFAULT '' COMMENT '邮箱',
  `reg_time` timestamp NULL DEFAULT NULL COMMENT '注册时间',
  `reg_ip` varchar(45) NOT NULL DEFAULT '' COMMENT '注册IP',
  `login_time` timestamp NULL DEFAULT NULL COMMENT '最后登录时间',
  `login_ip` varchar(45) NOT NULL DEFAULT '' COMMENT '最后登录IP',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='用户基本信息';

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', '13667635645', '$2y$10$D6JkE5X1i.ShnE5igAaNVOt//HKWHEke1f4ApUS8znYYP24MIDR/K', '2WitdgH0jSICzADOGI6isDVRShRZjotBl6dTUIQHtUfZ5jRPPuZQidYsUHPu', '邢永和', '1', '1', '1342234898', 'sdfddd', '0.00', '', '3', '永和测试', '1', 'asdfasd@qq.com', '2016-11-17 18:46:49', '127.0.0.1', '2017-01-06 10:27:12', '127.0.0.1');
INSERT INTO `user` VALUES ('2', '17723160667', '$2y$10$55bR8O6QHIFe6X70fM0nn.FeyC07/KGZmvBpt4LtWYZ0FelBBx48S', 'Bap70KsObpnZO2MsKHeAtQR33H3y3bT8sao2M2cM95OLNj5qZe9LVewoCKyg', '形影楓', '1', '2', '123123123', '', '0.00', '重庆问问我科技', '3', '永和测试', '1', '', '2016-11-17 19:15:14', '127.0.0.1', '2016-12-27 16:24:13', '127.0.0.1');

-- ----------------------------
-- Table structure for user_account
-- ----------------------------
DROP TABLE IF EXISTS `user_account`;
CREATE TABLE `user_account` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `bank_id` int(10) DEFAULT NULL COMMENT '账户类型，关联银行ID',
  `account` varchar(100) DEFAULT '' COMMENT '账户',
  `deposit` varchar(255) DEFAULT '' COMMENT '开户行',
  `username` varchar(255) DEFAULT '' COMMENT '开户姓名',
  `userid` int(255) DEFAULT NULL COMMENT '账户用户ID',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_account
-- ----------------------------
INSERT INTO `user_account` VALUES ('14', '3', '622254554454554458787455', '撒发射点大师傅撒旦发生', '孙大发大水法的', '1', '2017-01-06 17:00:42', '2017-01-06 17:00:42');

-- ----------------------------
-- Table structure for user_bank
-- ----------------------------
DROP TABLE IF EXISTS `user_bank`;
CREATE TABLE `user_bank` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT '' COMMENT '名称',
  `logo` varchar(255) DEFAULT '' COMMENT 'logo',
  `sort` tinyint(2) DEFAULT '0' COMMENT '排序',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_bank
-- ----------------------------
INSERT INTO `user_bank` VALUES ('1', '支付宝账号', '', '1', '2017-01-06 14:57:53', '2017-01-06 15:00:11');
INSERT INTO `user_bank` VALUES ('2', '招商银行', '', '2', '2017-01-06 14:58:15', '2017-01-06 15:00:11');
INSERT INTO `user_bank` VALUES ('3', '上海浦东发展银行', '', '3', '2017-01-06 14:58:32', '2017-01-06 15:00:11');
INSERT INTO `user_bank` VALUES ('4', '中国民生银行', '', '4', '2017-01-06 14:58:42', '2017-01-06 15:00:11');
INSERT INTO `user_bank` VALUES ('5', '中国农业银行', '', '5', '2017-01-06 14:58:51', '2017-01-06 15:00:11');
INSERT INTO `user_bank` VALUES ('6', '中国建设银行', '', '6', '2017-01-06 14:58:58', '2017-01-06 15:00:11');
INSERT INTO `user_bank` VALUES ('7', '中国银行', '', '7', '2017-01-06 14:59:06', '2017-01-06 15:00:11');
INSERT INTO `user_bank` VALUES ('8', '中国工商银行', '', '8', '2017-01-06 14:59:14', '2017-01-06 15:00:11');
INSERT INTO `user_bank` VALUES ('9', '交通银行', '', '9', '2017-01-06 14:59:22', '2017-01-06 15:00:11');
INSERT INTO `user_bank` VALUES ('10', '华夏银行', '', '10', '2017-01-06 14:59:31', '2017-01-06 15:00:11');

-- ----------------------------
-- Table structure for user_cash_log
-- ----------------------------
DROP TABLE IF EXISTS `user_cash_log`;
CREATE TABLE `user_cash_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `order_id` varchar(20) NOT NULL DEFAULT '' COMMENT '流水号',
  `account` varchar(100) NOT NULL DEFAULT '' COMMENT '账户',
  `money` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '提现金额',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态:1待处理、2成功、3拒绝处理',
  `created_at` timestamp NULL DEFAULT NULL COMMENT '记录时间',
  `pay_time` timestamp NULL DEFAULT NULL COMMENT '付款时间',
  `ip` varchar(45) NOT NULL DEFAULT '' COMMENT 'IP地址',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户提现记录';

-- ----------------------------
-- Records of user_cash_log
-- ----------------------------

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
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=utf8 COMMENT='平台';

-- ----------------------------
-- Records of user_netred
-- ----------------------------
INSERT INTO `user_netred` VALUES ('1', null, '1', '/uploads/picture/2017-01-05/1.png', 'KING无可替代', '1', '0', '0', '0', '', '1', '123865', '2', '', '17523', '0', '', '[\"catid_15\",\"catid_13\",\"catid_10\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:09', '2017-01-05 14:46:09');
INSERT INTO `user_netred` VALUES ('2', null, '1', '/uploads/picture/2017-01-05/2.png', '段语心', '1', '0', '0', '0', '', '1', '2311', '2', '', '7111', '0', '', '[\"catid_15\",\"catid_12\",\"catid_11\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:09', '2017-01-05 14:46:09');
INSERT INTO `user_netred` VALUES ('3', null, '1', '/uploads/picture/2017-01-05/3.png', '花筱熙_有妖气', '1', '0', '0', '0', '', '1', '13511', '2', '', '25600', '0', '', '[\"catid_1\",\"catid_15\",\"catid_9\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:10', '2017-01-05 14:46:10');
INSERT INTO `user_netred` VALUES ('4', null, '1', '/uploads/picture/2017-01-05/4.png', '趙翔宇', '1', '0', '0', '0', '', '1', '694947', '2', '', '7591', '0', '', '[\"catid_1\",\"catid_15\",\"catid_4\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:10', '2017-01-05 14:46:10');
INSERT INTO `user_netred` VALUES ('5', null, '1', '/uploads/picture/2017-01-05/5.png', '周大静', '1', '0', '0', '0', '', '1', '534938', '2', '', '96000', '0', '', '[\"catid_8\",\"catid_7\",\"catid_2\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:10', '2017-01-05 14:46:10');
INSERT INTO `user_netred` VALUES ('6', null, '1', '/uploads/picture/2017-01-05/6.png', 'sunny是个小太阳', '1', '0', '0', '0', '', '1', '1045567', '2', '', '52100', '0', '', '[\"catid_14\",\"catid_8\",\"catid_16\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:10', '2017-01-05 14:46:10');
INSERT INTO `user_netred` VALUES ('7', null, '1', '/uploads/picture/2017-01-05/7.png', '唐璇Lolia', '1', '0', '0', '0', '', '1', '104801', '2', '', '32000', '0', '', '[\"catid_1\",\"catid_9\",\"catid_7\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:10', '2017-01-05 14:46:10');
INSERT INTO `user_netred` VALUES ('8', null, '1', '/uploads/picture/2017-01-05/8.png', 'Aimee_呸呸', '1', '0', '0', '0', '', '1', '191815', '2', '', '15500', '0', '', '[\"catid_1\",\"catid_15\",\"catid_2\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:10', '2017-01-05 14:46:10');
INSERT INTO `user_netred` VALUES ('9', null, '1', '/uploads/picture/2017-01-05/9.png', '许鑫n', '1', '0', '0', '0', '', '1', '11267', '2', '', '3199', '0', '', '[\"catid_1\",\"catid_5\",\"catid_4\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:10', '2017-01-05 14:46:10');
INSERT INTO `user_netred` VALUES ('10', null, '1', '/uploads/picture/2017-01-05/10.png', '奶茶猫', '1', '0', '0', '0', '', '1', '1287732', '2', '', '127500', '0', '', '[\"catid_10\",\"catid_4\",\"catid_3\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:10', '2017-01-05 14:46:10');
INSERT INTO `user_netred` VALUES ('11', null, '1', '/uploads/picture/2017-01-05/11.png', '晴小天Shine', '1', '0', '0', '0', '', '1', '11789', '2', '', '16900', '0', '', '[\"catid_15\",\"catid_9\",\"catid_7\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:10', '2017-01-05 14:46:10');
INSERT INTO `user_netred` VALUES ('12', null, '1', '/uploads/picture/2017-01-05/12.png', '速报酱Live', '1', '0', '0', '0', '', '1', '1679880', '2', '', '44200', '0', '', '[\"catid_9\",\"catid_6\",\"catid_16\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:10', '2017-01-05 14:46:10');
INSERT INTO `user_netred` VALUES ('13', null, '1', '/uploads/picture/2017-01-05/13.png', '徐墨斋居士', '1', '0', '0', '0', '', '1', '10917', '2', '', '23700', '0', '', '[\"catid_12\",\"catid_11\",\"catid_7\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:10', '2017-01-05 14:46:10');
INSERT INTO `user_netred` VALUES ('14', null, '1', '/uploads/picture/2017-01-05/14.png', '阿伦、!', '1', '0', '0', '0', '', '1', '13266', '2', '', '2577', '0', '', '[\"catid_12\",\"catid_11\",\"catid_16\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:10', '2017-01-05 14:46:10');
INSERT INTO `user_netred` VALUES ('15', null, '1', '/uploads/picture/2017-01-05/15.png', '幸子', '1', '0', '0', '0', '', '1', '19529', '2', '', '6833', '0', '', '[\"catid_15\",\"catid_12\",\"catid_4\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:10', '2017-01-05 14:46:10');
INSERT INTO `user_netred` VALUES ('16', null, '1', '/uploads/picture/2017-01-05/16.png', '毛小兔兔小毛', '1', '0', '0', '0', '', '1', '249277', '2', '', '22200', '0', '', '[\"catid_8\",\"catid_7\",\"catid_5\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:10', '2017-01-05 14:46:10');
INSERT INTO `user_netred` VALUES ('17', null, '1', '/uploads/picture/2017-01-05/17.png', '段宝', '1', '0', '0', '0', '', '1', '45256', '2', '', '17200', '0', '', '[\"catid_1\",\"catid_12\",\"catid_2\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:10', '2017-01-05 14:46:10');
INSERT INTO `user_netred` VALUES ('18', null, '1', '/uploads/picture/2017-01-05/18.png', '主持李冲', '1', '0', '0', '0', '', '1', '370136', '2', '', '86529', '0', '', '[\"catid_1\",\"catid_9\",\"catid_6\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:10', '2017-01-05 14:46:10');
INSERT INTO `user_netred` VALUES ('19', null, '1', '/uploads/picture/2017-01-05/19.png', '亦欢choi', '1', '0', '0', '0', '', '1', '25319', '2', '', '7451', '0', '', '[\"catid_1\",\"catid_14\",\"catid_9\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:10', '2017-01-05 14:46:10');
INSERT INTO `user_netred` VALUES ('20', null, '1', '/uploads/picture/2017-01-05/20.png', '妙琳Yukiki', '1', '0', '0', '0', '', '1', '1011934', '2', '', '103700', '0', '', '[\"catid_12\",\"catid_5\",\"catid_4\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:10', '2017-01-05 14:46:10');
INSERT INTO `user_netred` VALUES ('21', null, '1', '/uploads/picture/2017-01-05/21.png', '小资风尚', '1', '0', '0', '0', '', '1', '1040453', '2', '', '117900', '0', '', '[\"catid_15\",\"catid_9\",\"catid_6\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:10', '2017-01-05 14:46:10');
INSERT INTO `user_netred` VALUES ('22', null, '1', '/uploads/picture/2017-01-05/22.png', 'Kelly喵', '1', '0', '0', '0', '', '1', '13819', '2', '', '6041', '0', '', '[\"catid_13\",\"catid_11\",\"catid_5\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:10', '2017-01-05 14:46:10');
INSERT INTO `user_netred` VALUES ('23', null, '1', '/uploads/picture/2017-01-05/23.png', '白野的白', '1', '0', '0', '0', '', '1', '147475', '2', '', '70700', '0', '', '[\"catid_5\",\"catid_4\",\"catid_2\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:10', '2017-01-05 14:46:10');
INSERT INTO `user_netred` VALUES ('24', null, '1', '/uploads/picture/2017-01-05/24.png', '梦甜Mandy', '1', '0', '0', '0', '', '1', '54237', '2', '', '2989', '0', '', '[\"catid_1\",\"catid_14\",\"catid_3\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:10', '2017-01-05 14:46:10');
INSERT INTO `user_netred` VALUES ('25', null, '1', '/uploads/picture/2017-01-05/25.png', '長谷川', '1', '0', '0', '0', '', '1', '63780', '2', '', '11700', '0', '', '[\"catid_1\",\"catid_9\",\"catid_16\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:10', '2017-01-05 14:46:10');
INSERT INTO `user_netred` VALUES ('26', null, '1', '/uploads/picture/2017-01-05/26.png', '蕙蕙大公主', '1', '0', '0', '0', '', '1', '214932', '2', '', '7449', '0', '', '[\"catid_13\",\"catid_9\",\"catid_7\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:10', '2017-01-05 14:46:10');
INSERT INTO `user_netred` VALUES ('27', null, '1', '/uploads/picture/2017-01-05/27.png', '苍穹王司', '1', '0', '0', '0', '', '1', '5951', '2', '', '7457', '0', '', '[\"catid_15\",\"catid_13\",\"catid_6\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:10', '2017-01-05 14:46:10');
INSERT INTO `user_netred` VALUES ('28', null, '1', '/uploads/picture/2017-01-05/28.png', '我是陈文胥', '1', '0', '0', '0', '', '1', '20143', '2', '', '5327', '0', '', '[\"catid_13\",\"catid_11\",\"catid_16\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:10', '2017-01-05 14:46:10');
INSERT INTO `user_netred` VALUES ('29', null, '1', '/uploads/picture/2017-01-05/29.png', '上班那点事', '1', '0', '0', '0', '', '1', '328944', '2', '', '40800', '0', '', '[\"catid_14\",\"catid_9\",\"catid_4\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:10', '2017-01-05 14:46:10');
INSERT INTO `user_netred` VALUES ('30', null, '1', '/uploads/picture/2017-01-05/30.png', '霁子Cherry', '1', '0', '0', '0', '', '1', '760023', '2', '', '18300', '0', '', '[\"catid_14\",\"catid_13\",\"catid_10\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:10', '2017-01-05 14:46:10');
INSERT INTO `user_netred` VALUES ('31', null, '1', '/uploads/picture/2017-01-05/31.png', '王姐姐', '1', '0', '0', '0', '', '1', '31157', '1', '', '31157', '0', '', '[\"catid_7\",\"catid_6\",\"catid_5\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:10', '2017-01-05 14:46:10');
INSERT INTO `user_netred` VALUES ('32', null, '1', '/uploads/picture/2017-01-05/32.png', '阳阳Sweet', '1', '0', '0', '0', '', '1', '311520', '1', '', '895250', '0', '', '[\"catid_14\",\"catid_13\",\"catid_2\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:10', '2017-01-05 14:46:10');
INSERT INTO `user_netred` VALUES ('33', null, '1', '/uploads/picture/2017-01-05/33.png', 'Viki', '1', '0', '0', '0', '', '1', '315201', '1', '', '4560', '0', '', '[\"catid_12\",\"catid_10\",\"catid_7\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:10', '2017-01-05 14:46:10');
INSERT INTO `user_netred` VALUES ('34', null, '1', '/uploads/picture/2017-01-05/34.png', 'Dolin林璃', '1', '0', '0', '0', '', '1', '260250', '1', '', '102521', '0', '', '[\"catid_15\",\"catid_7\",\"catid_16\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:10', '2017-01-05 14:46:10');
INSERT INTO `user_netred` VALUES ('35', null, '1', '/uploads/picture/2017-01-05/35.png', '紫希逗比', '1', '0', '0', '0', '', '1', '323501', '1', '', '214502', '0', '', '[\"catid_1\",\"catid_15\",\"catid_5\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:10', '2017-01-05 14:46:10');
INSERT INTO `user_netred` VALUES ('36', null, '1', '/uploads/picture/2017-01-05/36.png', '书菡主持人', '1', '0', '0', '0', '', '1', '210200', '1', '', '231050', '0', '', '[\"catid_14\",\"catid_12\",\"catid_10\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:10', '2017-01-05 14:46:10');
INSERT INTO `user_netred` VALUES ('37', null, '1', '/uploads/picture/2017-01-05/37.png', 'cindy小涵涵', '1', '0', '0', '0', '', '1', '216680', '1', '', '40255', '0', '', '[\"catid_1\",\"catid_4\",\"catid_16\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:10', '2017-01-05 14:46:10');
INSERT INTO `user_netred` VALUES ('38', null, '1', '/uploads/picture/2017-01-05/38.png', '章洁妮', '1', '0', '0', '0', '', '1', '126680', '1', '', '60023', '0', '', '[\"catid_13\",\"catid_9\",\"catid_5\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:10', '2017-01-05 14:46:10');
INSERT INTO `user_netred` VALUES ('39', null, '1', '/uploads/picture/2017-01-05/39.png', '曹煜Ss', '1', '0', '0', '0', '', '1', '109053', '1', '', '20330', '0', '', '[\"catid_11\",\"catid_6\",\"catid_16\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:10', '2017-01-05 14:46:10');
INSERT INTO `user_netred` VALUES ('40', null, '1', '/uploads/picture/2017-01-05/40.png', '豆子儿', '1', '0', '0', '0', '', '1', '10600', '1', '', '1370', '0', '', '[\"catid_10\",\"catid_5\",\"catid_4\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:10', '2017-01-05 14:46:10');
INSERT INTO `user_netred` VALUES ('41', null, '1', '/uploads/picture/2017-01-05/41.png', '潘仲格', '1', '0', '0', '0', '', '1', '12650', '1', '', '23067', '0', '', '[\"catid_12\",\"catid_10\",\"catid_7\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:10', '2017-01-05 14:46:10');
INSERT INTO `user_netred` VALUES ('42', null, '1', '/uploads/picture/2017-01-05/42.png', 'Luffy程咬金', '1', '0', '0', '0', '', '1', '62552', '1', '', '13060', '0', '', '[\"catid_5\",\"catid_3\",\"catid_16\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:10', '2017-01-05 14:46:10');
INSERT INTO `user_netred` VALUES ('43', null, '1', '/uploads/picture/2017-01-05/43.png', '李诗妍呀', '1', '0', '0', '0', '', '1', '42552', '1', '', '23000', '0', '', '[\"catid_12\",\"catid_6\",\"catid_3\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:10', '2017-01-05 14:46:10');
INSERT INTO `user_netred` VALUES ('44', null, '1', '/uploads/picture/2017-01-05/44.png', '楚大仙', '1', '0', '0', '0', '', '1', '63850', '1', '', '10506', '0', '', '[\"catid_12\",\"catid_11\",\"catid_2\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:10', '2017-01-05 14:46:10');
INSERT INTO `user_netred` VALUES ('45', null, '1', '/uploads/picture/2017-01-05/45.png', '六弦文子', '1', '0', '0', '0', '', '1', '12053', '1', '', '8060', '0', '', '[\"catid_1\",\"catid_15\",\"catid_8\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:10', '2017-01-05 14:46:10');
INSERT INTO `user_netred` VALUES ('46', null, '1', '/uploads/picture/2017-01-05/46.png', '刘忻', '1', '0', '0', '0', '', '1', '62558', '1', '', '26069', '0', '', '[\"catid_11\",\"catid_10\",\"catid_2\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:10', '2017-01-05 14:46:10');
INSERT INTO `user_netred` VALUES ('47', null, '1', '/uploads/picture/2017-01-05/47.png', 'Mc赵导', '1', '0', '0', '0', '', '1', '62352', '1', '', '3063', '0', '', '[\"catid_12\",\"catid_4\",\"catid_3\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:10', '2017-01-05 14:46:10');
INSERT INTO `user_netred` VALUES ('48', null, '1', '/uploads/picture/2017-01-05/48.png', '老外没毛病', '1', '0', '0', '0', '', '1', '62262', '1', '', '6506', '0', '', '[\"catid_13\",\"catid_11\",\"catid_7\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:10', '2017-01-05 14:46:10');
INSERT INTO `user_netred` VALUES ('49', null, '1', '/uploads/picture/2017-01-05/49.png', 'Amy 雪儿', '1', '0', '0', '0', '', '1', '62086', '1', '', '35040', '0', '', '[\"catid_1\",\"catid_12\",\"catid_10\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:10', '2017-01-05 14:46:10');
INSERT INTO `user_netred` VALUES ('50', null, '1', '/uploads/picture/2017-01-05/50.png', '安可儿kerr', '1', '0', '0', '0', '', '1', '62540', '1', '', '9306', '0', '', '[\"catid_13\",\"catid_12\",\"catid_8\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:10', '2017-01-05 14:46:10');
INSERT INTO `user_netred` VALUES ('51', null, '1', '/uploads/picture/2017-01-05/51.png', 'papi酱', '1', '0', '0', '0', '', '1', '610250', '1', '', '3026684', '0', '', '[\"catid_1\",\"catid_10\",\"catid_6\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:10', '2017-01-05 14:46:10');
INSERT INTO `user_netred` VALUES ('52', null, '1', '/uploads/picture/2017-01-05/52.png', '泳希宝宝', '1', '0', '0', '0', '', '1', '520003', '1', '', '20536', '0', '', '[\"catid_15\",\"catid_10\",\"catid_9\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:10', '2017-01-05 14:46:10');
INSERT INTO `user_netred` VALUES ('53', null, '1', '/uploads/picture/2017-01-05/53.png', '温雅MissWen', '1', '0', '0', '0', '', '1', '532018', '1', '', '50336', '0', '', '[\"catid_15\",\"catid_11\",\"catid_10\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:10', '2017-01-05 14:46:10');
INSERT INTO `user_netred` VALUES ('54', null, '1', '/uploads/picture/2017-01-05/54.png', '老薛老薛', '1', '0', '0', '0', '', '1', '500012', '1', '', '37033', '0', '', '[\"catid_10\",\"catid_4\",\"catid_16\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:10', '2017-01-05 14:46:10');
INSERT INTO `user_netred` VALUES ('55', null, '1', '/uploads/picture/2017-01-05/55.png', '琦琦小姐1201', '1', '0', '0', '0', '', '1', '430252', '1', '', '170862', '0', '', '[\"catid_1\",\"catid_15\",\"catid_4\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:10', '2017-01-05 14:46:10');
INSERT INTO `user_netred` VALUES ('56', null, '1', '/uploads/picture/2017-01-05/56.png', '慕双', '1', '0', '0', '0', '', '1', '413255', '1', '', '151800', '0', '', '[\"catid_15\",\"catid_10\",\"catid_16\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:10', '2017-01-05 14:46:10');
INSERT INTO `user_netred` VALUES ('57', null, '1', '/uploads/picture/2017-01-05/57.png', '张端端Uan', '1', '0', '0', '0', '', '1', '363200', '1', '', '8604', '0', '', '[\"catid_12\",\"catid_9\",\"catid_8\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:10', '2017-01-05 14:46:10');
INSERT INTO `user_netred` VALUES ('58', null, '1', '/uploads/picture/2017-01-05/58.png', '第一美食主播JOJO', '1', '0', '0', '0', '', '1', '340801', '1', '', '239000', '0', '', '[\"catid_13\",\"catid_8\",\"catid_6\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:10', '2017-01-05 14:46:10');
INSERT INTO `user_netred` VALUES ('59', null, '1', '/uploads/picture/2017-01-05/59.png', '沈漫雨', '1', '0', '0', '0', '', '1', '331405', '1', '', '133500', '0', '', '[\"catid_8\",\"catid_7\",\"catid_3\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:10', '2017-01-05 14:46:10');
INSERT INTO `user_netred` VALUES ('60', null, '1', '/uploads/picture/2017-01-05/60.png', 'Danny唐梓豪', '1', '0', '0', '0', '', '1', '329653', '1', '', '89005', '0', '', '[\"catid_8\",\"catid_5\",\"catid_2\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:10', '2017-01-05 14:46:10');
INSERT INTO `user_netred` VALUES ('61', null, '1', '/uploads/picture/2017-01-05/61.png', '原源', '1', '0', '0', '0', '', '1', '88584', '2', '', '2375', '0', '', '[\"catid_9\",\"catid_7\",\"catid_6\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:10', '2017-01-05 14:46:10');
INSERT INTO `user_netred` VALUES ('62', null, '1', '/uploads/picture/2017-01-05/62.png', '小肥妹宋潇', '1', '0', '0', '0', '', '1', '64866', '2', '', '8431', '0', '', '[\"catid_15\",\"catid_7\",\"catid_6\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:10', '2017-01-05 14:46:10');
INSERT INTO `user_netred` VALUES ('63', null, '1', '/uploads/picture/2017-01-05/63.png', '一只暴走猫', '1', '0', '0', '0', '', '1', '40622', '2', '', '9098', '0', '', '[\"catid_15\",\"catid_3\",\"catid_16\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:10', '2017-01-05 14:46:10');
INSERT INTO `user_netred` VALUES ('64', null, '1', '/uploads/picture/2017-01-05/64.png', '诗雨呗', '1', '0', '0', '0', '', '1', '17741', '2', '', '1751', '0', '', '[\"catid_14\",\"catid_12\",\"catid_10\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:10', '2017-01-05 14:46:10');
INSERT INTO `user_netred` VALUES ('65', null, '1', '/uploads/picture/2017-01-05/65.png', '爷们徐小妞', '1', '0', '0', '0', '', '1', '162941', '2', '', '7553', '0', '', '[\"catid_15\",\"catid_13\",\"catid_11\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:10', '2017-01-05 14:46:10');
INSERT INTO `user_netred` VALUES ('66', null, '1', '/uploads/picture/2017-01-05/66.png', '严为民', '1', '0', '0', '0', '', '1', '171183', '2', '', '67500', '0', '', '[\"catid_9\",\"catid_5\",\"catid_3\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:10', '2017-01-05 14:46:10');
INSERT INTO `user_netred` VALUES ('67', null, '1', '/uploads/picture/2017-01-05/67.png', 'L1六岁小公举', '1', '0', '0', '0', '', '1', '25941', '2', '', '7477', '0', '', '[\"catid_11\",\"catid_10\",\"catid_4\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:10', '2017-01-05 14:46:10');
INSERT INTO `user_netred` VALUES ('68', null, '1', '/uploads/picture/2017-01-05/68.png', '贺楣', '1', '0', '0', '0', '', '1', '64110', '2', '', '7351', '0', '', '[\"catid_13\",\"catid_10\",\"catid_2\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:10', '2017-01-05 14:46:10');
INSERT INTO `user_netred` VALUES ('69', null, '1', '/uploads/picture/2017-01-05/69.png', 'Piano杰克', '1', '0', '0', '0', '', '1', '15222', '2', '', '2885', '0', '', '[\"catid_15\",\"catid_13\",\"catid_7\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:10', '2017-01-05 14:46:10');
INSERT INTO `user_netred` VALUES ('70', null, '1', '/uploads/picture/2017-01-05/70.png', 'MeToo是你静宝宝', '1', '0', '0', '0', '', '1', '700', '2', '', '4329', '0', '', '[\"catid_11\",\"catid_10\",\"catid_8\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:10', '2017-01-05 14:46:10');
INSERT INTO `user_netred` VALUES ('71', null, '1', '/uploads/picture/2017-01-05/71.png', '大娃、新来的老湿', '1', '0', '0', '0', '', '1', '1151', '2', '', '6563', '0', '', '[\"catid_1\",\"catid_12\",\"catid_2\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:10', '2017-01-05 14:46:10');
INSERT INTO `user_netred` VALUES ('72', null, '1', '/uploads/picture/2017-01-05/72.png', '延参法师', '1', '0', '0', '0', '', '1', '45816265', '2', '', '8032', '0', '', '[\"catid_8\",\"catid_5\",\"catid_4\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:10', '2017-01-05 14:46:10');
INSERT INTO `user_netred` VALUES ('73', null, '1', '/uploads/picture/2017-01-05/73.png', '徐梦柔er', '1', '0', '0', '0', '', '1', '34327', '2', '', '3100', '0', '', '[\"catid_13\",\"catid_11\",\"catid_7\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:10', '2017-01-05 14:46:10');
INSERT INTO `user_netred` VALUES ('74', null, '1', '/uploads/picture/2017-01-05/74.png', '老陈皮x7', '1', '0', '0', '0', '', '1', '13399', '2', '', '6077', '0', '', '[\"catid_7\",\"catid_6\",\"catid_3\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:10', '2017-01-05 14:46:10');
INSERT INTO `user_netred` VALUES ('75', null, '1', '/uploads/picture/2017-01-05/75.png', '朴峻崎JQ', '1', '0', '0', '0', '', '1', '17780', '2', '', '7457', '0', '', '[\"catid_10\",\"catid_8\",\"catid_3\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:10', '2017-01-05 14:46:10');
INSERT INTO `user_netred` VALUES ('76', null, '1', '/uploads/picture/2017-01-05/76.png', 'Tf晴天sunny', '1', '0', '0', '0', '', '1', '12349', '2', '', '6625', '0', '', '[\"catid_15\",\"catid_14\",\"catid_5\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:10', '2017-01-05 14:46:10');
INSERT INTO `user_netred` VALUES ('77', null, '1', '/uploads/picture/2017-01-05/77.png', '原来是维尼', '1', '0', '0', '0', '', '1', '3919', '2', '', '6236', '0', '', '[\"catid_10\",\"catid_8\",\"catid_2\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:10', '2017-01-05 14:46:10');
INSERT INTO `user_netred` VALUES ('78', null, '1', '/uploads/picture/2017-01-05/78.png', '岳明儿', '1', '0', '0', '0', '', '1', '174', '2', '', '5717', '0', '', '[\"catid_5\",\"catid_4\",\"catid_2\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:10', '2017-01-05 14:46:10');
INSERT INTO `user_netred` VALUES ('79', null, '1', '/uploads/picture/2017-01-05/79.png', '雯雯要做小仙女', '1', '0', '0', '0', '', '1', '147222', '2', '', '21900', '0', '', '[\"catid_13\",\"catid_4\",\"catid_16\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:10', '2017-01-05 14:46:10');
INSERT INTO `user_netred` VALUES ('80', null, '1', '/uploads/picture/2017-01-05/80.png', 'Fangy方圆', '1', '0', '0', '0', '', '1', '89286', '2', '', '2877', '0', '', '[\"catid_12\",\"catid_11\",\"catid_9\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:10', '2017-01-05 14:46:10');
INSERT INTO `user_netred` VALUES ('81', null, '1', '/uploads/picture/2017-01-05/81.png', '童饱饱', '1', '0', '0', '0', '', '1', '4815', '2', '', '3093', '0', '', '[\"catid_15\",\"catid_12\",\"catid_6\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:10', '2017-01-05 14:46:10');
INSERT INTO `user_netred` VALUES ('82', null, '1', '/uploads/picture/2017-01-05/82.png', '王汐沫', '1', '0', '0', '0', '', '1', '4815', '2', '', '3093', '0', '', '[\"catid_14\",\"catid_5\",\"catid_4\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:10', '2017-01-05 14:46:10');
INSERT INTO `user_netred` VALUES ('83', null, '1', '/uploads/picture/2017-01-05/83.png', '文那', '1', '0', '0', '0', '', '1', '47171', '2', '', '3650', '0', '', '[\"catid_12\",\"catid_11\",\"catid_9\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:10', '2017-01-05 14:46:10');
INSERT INTO `user_netred` VALUES ('84', null, '1', '/uploads/picture/2017-01-05/84.png', '耗子传递正能量', '1', '0', '0', '0', '', '1', '308', '2', '', '4649', '0', '', '[\"catid_13\",\"catid_9\",\"catid_3\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:10', '2017-01-05 14:46:10');
INSERT INTO `user_netred` VALUES ('85', null, '1', '/uploads/picture/2017-01-05/85.png', '骚男', '1', '0', '0', '0', '', '1', '8960000', '13', '', '1080000', '0', '', '[\"catid_15\",\"catid_6\",\"catid_16\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:10', '2017-01-05 14:46:10');
INSERT INTO `user_netred` VALUES ('86', null, '1', '/uploads/picture/2017-01-05/86.png', '卡尔', '1', '0', '0', '0', '', '1', '4370000', '13', '', '7200000', '0', '', '[\"catid_8\",\"catid_2\",\"catid_16\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:10', '2017-01-05 14:46:10');
INSERT INTO `user_netred` VALUES ('87', null, '1', '/uploads/picture/2017-01-05/87.png', '卡尔', '1', '0', '0', '0', '', '1', '2450000', '13', '', '1130000', '0', '', '[\"catid_15\",\"catid_11\",\"catid_3\"]', '', '0.00', '0.00', '', '', '', '2017-01-05 14:46:10', '2017-01-05 14:46:10');

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
