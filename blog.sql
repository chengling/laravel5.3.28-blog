/*
Navicat MySQL Data Transfer

Source Server         : 本地
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : blog

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2016-12-25 13:30:30
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `article`
-- ----------------------------
DROP TABLE IF EXISTS `article`;
CREATE TABLE `article` (
  `article_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '表id',
  `cat_id` smallint(5) NOT NULL DEFAULT '0' COMMENT '类别ID',
  `title` varchar(150) NOT NULL DEFAULT '' COMMENT '文章标题',
  `author` varchar(30) NOT NULL DEFAULT '' COMMENT '文章作者',
  `platform` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1:pc2wap',
  `is_publish` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否发布',
  `add_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  `file_url` varchar(255) NOT NULL DEFAULT '' COMMENT '附件地址',
  `description` varchar(255) NOT NULL DEFAULT '' COMMENT '文章摘要',
  `click` int(11) unsigned DEFAULT '0' COMMENT '浏览量',
  `publish_time` int(11) DEFAULT '0' COMMENT '文章发布时间',
  `thumb` varchar(255) DEFAULT '' COMMENT '文章缩略图',
  `is_delete` tinyint(4) DEFAULT '0' COMMENT '是否被删除',
  `sort_order` smallint(6) DEFAULT '0' COMMENT '排序',
  `attr` tinyint(4) DEFAULT '0' COMMENT '1:推荐2:置顶',
  PRIMARY KEY (`article_id`),
  KEY `cat_id` (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of article
-- ----------------------------

-- ----------------------------
-- Table structure for `article_body`
-- ----------------------------
DROP TABLE IF EXISTS `article_body`;
CREATE TABLE `article_body` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `article_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '文章id',
  `content` longtext COMMENT '文章内容',
  `title` varchar(100) DEFAULT NULL COMMENT 'SEO标题',
  `description` varchar(255) DEFAULT '' COMMENT 'SEO简介',
  `keywords` varchar(200) DEFAULT '' COMMENT 'SEO关键字',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ind_article_id` (`article_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of article_body
-- ----------------------------

-- ----------------------------
-- Table structure for `article_cat`
-- ----------------------------
DROP TABLE IF EXISTS `article_cat`;
CREATE TABLE `article_cat` (
  `cat_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(20) DEFAULT '' COMMENT '分类名称',
  `parent_id` int(10) DEFAULT '0' COMMENT '上级ID',
  `is_show` tinyint(1) DEFAULT '1' COMMENT '是否显示',
  `sort_order` smallint(6) DEFAULT '0' COMMENT '排序',
  `title` varchar(255) DEFAULT '' COMMENT 'seo标题',
  `keywords` varchar(255) DEFAULT '' COMMENT 'seo关键词',
  `description` varchar(255) DEFAULT '' COMMENT 'seo描述',
  `thumb` varchar(255) NOT NULL DEFAULT '' COMMENT '图片地址',
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of article_cat
-- ----------------------------
INSERT INTO `article_cat` VALUES ('3', '移动互联网', '0', '1', '0', '', '', '', '');
INSERT INTO `article_cat` VALUES ('4', 'PHP', '3', '1', '0', '', '', '', '');
INSERT INTO `article_cat` VALUES ('5', 'JAVA', '3', '1', '0', '', '', '', '');
INSERT INTO `article_cat` VALUES ('6', '初级工程师', '4', '1', '0', '', '', '', '');
INSERT INTO `article_cat` VALUES ('7', '中级工程师', '0', '1', '0', '中级工程师', '中级工程师', '中级工程师', '');
INSERT INTO `article_cat` VALUES ('8', '中级工程师', '4', '1', '0', '中级工程师', '中级工程师', '中级工程师', '');
INSERT INTO `article_cat` VALUES ('9', '高级工程师', '4', '1', '0', '高级工程师', '高级工程师', '高级工程师', '');
INSERT INTO `article_cat` VALUES ('10', 'PHP架构师', '4', '1', '0', 'PHP架构师', 'PHP架构师', 'PHP架构师', '');

-- ----------------------------
-- Table structure for `desktop_account`
-- ----------------------------
DROP TABLE IF EXISTS `desktop_account`;
CREATE TABLE `desktop_account` (
  `account_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '账户序号ID',
  `login_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT '登录用户名',
  `login_password` varchar(60) COLLATE utf8_unicode_ci NOT NULL COMMENT '登录密码',
  `salt` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '秘钥',
  `super` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否是超级管理员',
  `last_login` int(11) NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  `last_ip` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '最后登录ip',
  `disabled` tinyint(1) DEFAULT '0' COMMENT '是否禁用',
  `role_id` smallint(5) DEFAULT NULL COMMENT '角色id',
  `createtime` int(10) unsigned DEFAULT NULL COMMENT '创建时间',
  `logincount` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '登录次数',
  PRIMARY KEY (`account_id`),
  UNIQUE KEY `ind_account` (`login_name`,`disabled`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of desktop_account
-- ----------------------------
INSERT INTO `desktop_account` VALUES ('1', 'admin', '6720f0dbd34dc96cae3170bd03bcf974', '147997', '0', '0', '', '0', null, null, '0');

-- ----------------------------
-- Table structure for `site_ad`
-- ----------------------------
DROP TABLE IF EXISTS `site_ad`;
CREATE TABLE `site_ad` (
  `ad_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '广告id',
  `position` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '广告位置1:首页',
  `name` varchar(60) NOT NULL DEFAULT '' COMMENT '广告名称',
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT '链接地址',
  `picture` varchar(255) NOT NULL DEFAULT '' COMMENT '图片地址',
  `is_show` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '是否显示',
  `sort_order` smallint(6) DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`ad_id`),
  KEY `position_show` (`position`,`is_show`,`sort_order`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='广告';

-- ----------------------------
-- Records of site_ad
-- ----------------------------

-- ----------------------------
-- Table structure for `site_link`
-- ----------------------------
DROP TABLE IF EXISTS `site_link`;
CREATE TABLE `site_link` (
  `link_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '表id',
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '链接名称',
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT '链接地址',
  `sort_order` tinyint(3) unsigned NOT NULL DEFAULT '50' COMMENT '排序',
  `is_show` tinyint(1) DEFAULT '1' COMMENT '是否显示',
  PRIMARY KEY (`link_id`),
  KEY `show_order` (`sort_order`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of site_link
-- ----------------------------
