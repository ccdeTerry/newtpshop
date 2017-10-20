/*
Navicat MySQL Data Transfer

Source Server         : 本机
Source Server Version : 50530
Source Host           : localhost:3306
Source Database       : itshop

Target Server Type    : MYSQL
Target Server Version : 50530
File Encoding         : 65001

Date: 2017-08-01 14:04:10
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `jx_admin`
-- ----------------------------
DROP TABLE IF EXISTS `jx_admin`;
CREATE TABLE `jx_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` char(32) NOT NULL DEFAULT '' COMMENT '密码',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jx_admin
-- ----------------------------
INSERT INTO `jx_admin` VALUES ('1', 'admin', '21232f297a57a5a743894a0e4a801fc3');
INSERT INTO `jx_admin` VALUES ('4', 'php3', '21232f297a57a5a743894a0e4a801fc3');

-- ----------------------------
-- Table structure for `jx_admin_role`
-- ----------------------------
DROP TABLE IF EXISTS `jx_admin_role`;
CREATE TABLE `jx_admin_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `role_id` int(11) NOT NULL DEFAULT '0' COMMENT '角色ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jx_admin_role
-- ----------------------------
INSERT INTO `jx_admin_role` VALUES ('1', '1', '1');
INSERT INTO `jx_admin_role` VALUES ('4', '4', '3');

-- ----------------------------
-- Table structure for `jx_attribute`
-- ----------------------------
DROP TABLE IF EXISTS `jx_attribute`;
CREATE TABLE `jx_attribute` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `attr_name` varchar(30) NOT NULL DEFAULT '' COMMENT '属性名称',
  `type_id` int(11) NOT NULL DEFAULT '0' COMMENT '属性所对应的类型',
  `attr_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '表示属性的类型 1表示唯一 2表示单选',
  `attr_input_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '表示属性值的录入方法 1表示手工输入 2表示列表选择',
  `attr_value` varchar(255) NOT NULL DEFAULT '' COMMENT '列表选择的默认值 多个值之间使用逗号隔开',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jx_attribute
-- ----------------------------
INSERT INTO `jx_attribute` VALUES ('1', '屏幕', '2', '2', '1', '');
INSERT INTO `jx_attribute` VALUES ('3', '内存', '3', '2', '2', '2G,4G,8G');
INSERT INTO `jx_attribute` VALUES ('4', '网络制式', '3', '2', '2', '移动,联通,全球通');
INSERT INTO `jx_attribute` VALUES ('5', '颜色', '2', '2', '2', '白色,黑色,金色');
INSERT INTO `jx_attribute` VALUES ('6', '屏幕大小', '3', '1', '1', '');
INSERT INTO `jx_attribute` VALUES ('7', '待机时间', '3', '1', '1', '');

-- ----------------------------
-- Table structure for `jx_cart`
-- ----------------------------
DROP TABLE IF EXISTS `jx_cart`;
CREATE TABLE `jx_cart` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '登录的用户id',
  `goods_id` int(11) NOT NULL DEFAULT '0' COMMENT '商品id',
  `goods_attr_ids` varchar(255) NOT NULL DEFAULT '' COMMENT '商品属性id每个属性逗号隔开,关联jx_goods_attr表中的id',
  `goods_count` int(11) NOT NULL DEFAULT '0' COMMENT '商品购买数量',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jx_cart
-- ----------------------------
INSERT INTO `jx_cart` VALUES ('1', '1', '54', '152,154', '1');

-- ----------------------------
-- Table structure for `jx_category`
-- ----------------------------
DROP TABLE IF EXISTS `jx_category`;
CREATE TABLE `jx_category` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `cname` char(50) NOT NULL DEFAULT '' COMMENT '分类名称',
  `parent_id` smallint(6) NOT NULL DEFAULT '0' COMMENT '分类的父分类ID',
  `isrec` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否推荐 0表示不推荐1表示推荐',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jx_category
-- ----------------------------
INSERT INTO `jx_category` VALUES ('3', '家用电器', '0', '1');
INSERT INTO `jx_category` VALUES ('5', '手机、数码', '0', '1');
INSERT INTO `jx_category` VALUES ('7', '大家电', '3', '1');
INSERT INTO `jx_category` VALUES ('8', '洗衣机', '7', '1');
INSERT INTO `jx_category` VALUES ('9', '空调', '7', '1');
INSERT INTO `jx_category` VALUES ('10', '手机通讯', '5', '1');
INSERT INTO `jx_category` VALUES ('11', '手机配件', '5', '1');
INSERT INTO `jx_category` VALUES ('12', '电脑整机', '7', '1');
INSERT INTO `jx_category` VALUES ('13', 'OPPO手机', '10', '1');

-- ----------------------------
-- Table structure for `jx_comment`
-- ----------------------------
DROP TABLE IF EXISTS `jx_comment`;
CREATE TABLE `jx_comment` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `user_id` mediumint(8) unsigned NOT NULL COMMENT '会员id',
  `goods_id` mediumint(8) unsigned NOT NULL COMMENT '商品id',
  `addtime` int(10) unsigned NOT NULL COMMENT '评论时间',
  `content` varchar(300) NOT NULL COMMENT '评论的内容',
  `star` tinyint(3) unsigned NOT NULL COMMENT '评论的分值',
  `good_number` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '有用的数字',
  PRIMARY KEY (`id`),
  KEY `goods_id` (`goods_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='评论';

-- ----------------------------
-- Records of jx_comment
-- ----------------------------
INSERT INTO `jx_comment` VALUES ('1', '1', '53', '1501536336', '哈哈', '3', '4');
INSERT INTO `jx_comment` VALUES ('2', '1', '53', '1501551265', '很好混好', '5', '1');
INSERT INTO `jx_comment` VALUES ('3', '1', '53', '1501553050', '好不好', '5', '0');
INSERT INTO `jx_comment` VALUES ('4', '1', '53', '1501553079', '好不好', '5', '0');
INSERT INTO `jx_comment` VALUES ('5', '1', '53', '1501555189', '非常漂亮', '5', '0');
INSERT INTO `jx_comment` VALUES ('6', '1', '53', '1501555210', '很好', '3', '0');
INSERT INTO `jx_comment` VALUES ('7', '1', '53', '1501558015', '高端大气上档次', '5', '0');

-- ----------------------------
-- Table structure for `jx_goods`
-- ----------------------------
DROP TABLE IF EXISTS `jx_goods`;
CREATE TABLE `jx_goods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '商品ID',
  `goods_name` varchar(255) NOT NULL DEFAULT '' COMMENT '商品名称',
  `goods_sn` char(30) NOT NULL DEFAULT '' COMMENT '商品货号',
  `cate_id` smallint(6) NOT NULL DEFAULT '0' COMMENT '商品分类ID 对于category表中的ID字段',
  `market_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '市场售价',
  `shop_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '本店售价',
  `goods_img` varchar(255) NOT NULL DEFAULT '' COMMENT '商品缩略图',
  `goods_thumb` varchar(255) NOT NULL DEFAULT '' COMMENT '商品缩略小图',
  `goods_body` text,
  `is_hot` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否热卖 1表示热卖 0表示不是',
  `is_rec` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否推荐 1表示推荐 0表示不推荐',
  `is_new` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否热卖 1表示新品 0表示不是',
  `addtime` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `isdel` tinyint(4) NOT NULL DEFAULT '1' COMMENT '表示商品是否删除 1正常 0删除状态',
  `is_sale` tinyint(4) NOT NULL DEFAULT '1' COMMENT '商品是否销售 1销售 0下架状态',
  `type_id` int(11) NOT NULL DEFAULT '0' COMMENT '类型ID',
  `goods_number` int(11) NOT NULL DEFAULT '0' COMMENT '商品个数',
  `cx_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '促销价格',
  `start` int(11) NOT NULL DEFAULT '0' COMMENT '开始时间',
  `sale_number` int(11) NOT NULL DEFAULT '0' COMMENT '销量',
  `plcount` int(11) NOT NULL DEFAULT '0' COMMENT '评论量',
  `end` int(11) NOT NULL DEFAULT '0' COMMENT '结束时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `goods_sn` (`goods_sn`) USING BTREE,
  KEY `goods_name` (`goods_name`) USING BTREE,
  KEY `isdel` (`isdel`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jx_goods
-- ----------------------------
INSERT INTO `jx_goods` VALUES ('53', '小辣椒 红辣椒4A 高配版 4GB+32GB 全网通 黑色 ', 'JX597415b2f122f', '13', '1900.00', '799.00', 'Uploads/2017-07-23/597415b2f1b8d.jpg', 'Uploads/2017-07-23/thumb_597415b2f1b8d.jpg', '&lt;p&gt;&lt;span style=&quot;color: rgb(102, 102, 102); font-family: Arial, &amp;#39;microsoft yahei&amp;#39;; font-weight: bold; line-height: 28px; background-color: rgb(255, 255, 255);&quot;&gt;小辣椒 红辣椒4A 高配版 4GB+32GB 全网通 黑色 移动联通电信4G手机 双卡双待&lt;/span&gt;&lt;/p&gt;', '1', '0', '0', '1500779954', '1', '1', '3', '90', '0.00', '0', '0', '1', '0');
INSERT INTO `jx_goods` VALUES ('54', 'Apple iPhone 6 32GB 金色 移动联通电信4G手机', 'JX597415fa7d456', '13', '25787.00', '2578.00', 'Uploads/2017-07-23/597415fa7dc78.jpg', 'Uploads/2017-07-23/thumb_597415fa7dc78.jpg', '&lt;p&gt;2578&lt;/p&gt;', '0', '0', '1', '1500780026', '1', '1', '3', '32', '2000.00', '1493568000', '1', '0', '1506787200');
INSERT INTO `jx_goods` VALUES ('55', '荣耀 畅玩6X 4GB 64GB 全网通4G手机 尊享版 冰河银', 'JX5974163c73424', '13', '6000.00', '100.00', 'Uploads/2017-07-23/5974163c73d2a.jpg', 'Uploads/2017-07-23/thumb_5974163c73d2a.jpg', '&lt;p&gt;&lt;span style=&quot;color: rgb(102, 102, 102); font-family: Arial, &amp;#39;microsoft yahei&amp;#39;; font-weight: bold; line-height: 28px; background-color: rgb(255, 255, 255);&quot;&gt;荣耀 畅玩6X 4GB 64GB 全网通4G手机 尊享版 冰河银&lt;/span&gt;&lt;/p&gt;', '0', '1', '0', '1500780092', '1', '1', '3', '0', '0.00', '0', '0', '0', '0');
INSERT INTO `jx_goods` VALUES ('56', '小米Max2 全网通 4GB+64GB 金色 移动联通电信4G手机 ', 'JX5974166b57053', '10', '2799.00', '1699.00', 'Uploads/2017-07-23/5974166b57889.jpg', 'Uploads/2017-07-23/thumb_5974166b57889.jpg', '&lt;p&gt;&lt;span style=&quot;color: rgb(102, 102, 102); font-family: Arial, &amp;#39;microsoft yahei&amp;#39;; font-weight: bold; line-height: 28px; background-color: rgb(255, 255, 255);&quot;&gt;小米Max2 全网通 4GB+64GB 金色 移动联通电信4G手机 双卡双待&lt;/span&gt;&lt;/p&gt;', '0', '0', '0', '1500780139', '1', '1', '3', '0', '0.00', '0', '0', '0', '0');
INSERT INTO `jx_goods` VALUES ('57', '华为 HUAWEI P10 全网通 4GB+64GB 草木绿 ', 'JX5974169943cf3', '13', '6000.00', '100.00', 'Uploads/2017-07-23/5974169944be9.jpg', 'Uploads/2017-07-23/thumb_5974169944be9.jpg', '&lt;p&gt;&lt;span style=&quot;color: rgb(102, 102, 102); font-family: Arial, &amp;#39;microsoft yahei&amp;#39;; font-weight: bold; line-height: 28px; background-color: rgb(255, 255, 255);&quot;&gt;华为 HUAWEI P10 全网通 4GB+64GB 草木绿 移动联通电信4G手机 双卡双待&lt;/span&gt;&lt;/p&gt;', '0', '1', '0', '1500780185', '1', '1', '0', '0', '0.00', '0', '0', '0', '0');
INSERT INTO `jx_goods` VALUES ('61', 'iiiiiii', 'JX597b65f88909b', '9', '400.00', '200.00', '', '', null, '0', '0', '0', '1501259256', '1', '1', '0', '0', '100.00', '1493568000', '0', '0', '1588262400');

-- ----------------------------
-- Table structure for `jx_goods_attr`
-- ----------------------------
DROP TABLE IF EXISTS `jx_goods_attr`;
CREATE TABLE `jx_goods_attr` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `goods_id` int(11) NOT NULL DEFAULT '0' COMMENT '��ƷID',
  `attr_id` int(11) NOT NULL DEFAULT '0' COMMENT '����ID',
  `attr_values` varchar(255) NOT NULL DEFAULT '' COMMENT '����ֵ',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=158 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jx_goods_attr
-- ----------------------------
INSERT INTO `jx_goods_attr` VALUES ('130', '55', '3', '2G');
INSERT INTO `jx_goods_attr` VALUES ('131', '55', '4', '移动');
INSERT INTO `jx_goods_attr` VALUES ('132', '55', '6', '100mm');
INSERT INTO `jx_goods_attr` VALUES ('133', '55', '7', '25h');
INSERT INTO `jx_goods_attr` VALUES ('134', '56', '3', '2G');
INSERT INTO `jx_goods_attr` VALUES ('135', '56', '4', '移动');
INSERT INTO `jx_goods_attr` VALUES ('136', '56', '6', '100mm1');
INSERT INTO `jx_goods_attr` VALUES ('137', '56', '7', '22');
INSERT INTO `jx_goods_attr` VALUES ('138', '53', '3', '2G');
INSERT INTO `jx_goods_attr` VALUES ('139', '53', '3', '4G');
INSERT INTO `jx_goods_attr` VALUES ('140', '53', '3', '8G');
INSERT INTO `jx_goods_attr` VALUES ('141', '53', '4', '移动');
INSERT INTO `jx_goods_attr` VALUES ('142', '53', '4', '全球通');
INSERT INTO `jx_goods_attr` VALUES ('143', '53', '4', '联通');
INSERT INTO `jx_goods_attr` VALUES ('144', '53', '6', '200mm');
INSERT INTO `jx_goods_attr` VALUES ('145', '53', '7', '29h');
INSERT INTO `jx_goods_attr` VALUES ('152', '54', '3', '2G');
INSERT INTO `jx_goods_attr` VALUES ('153', '54', '3', '8G');
INSERT INTO `jx_goods_attr` VALUES ('154', '54', '4', '移动');
INSERT INTO `jx_goods_attr` VALUES ('155', '54', '4', '全球通');
INSERT INTO `jx_goods_attr` VALUES ('156', '54', '6', '98');
INSERT INTO `jx_goods_attr` VALUES ('157', '54', '7', '25h');

-- ----------------------------
-- Table structure for `jx_goods_cate`
-- ----------------------------
DROP TABLE IF EXISTS `jx_goods_cate`;
CREATE TABLE `jx_goods_cate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `goods_id` int(11) NOT NULL DEFAULT '0' COMMENT '商品ID标识',
  `cate_id` smallint(6) NOT NULL DEFAULT '0' COMMENT '分类ID标识',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jx_goods_cate
-- ----------------------------
INSERT INTO `jx_goods_cate` VALUES ('61', '55', '10');
INSERT INTO `jx_goods_cate` VALUES ('62', '57', '11');
INSERT INTO `jx_goods_cate` VALUES ('63', '53', '11');
INSERT INTO `jx_goods_cate` VALUES ('66', '54', '12');
INSERT INTO `jx_goods_cate` VALUES ('67', '54', '11');

-- ----------------------------
-- Table structure for `jx_goods_img`
-- ----------------------------
DROP TABLE IF EXISTS `jx_goods_img`;
CREATE TABLE `jx_goods_img` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `goods_id` int(11) NOT NULL DEFAULT '0' COMMENT '商品ID',
  `goods_img` varchar(255) NOT NULL DEFAULT '' COMMENT '相册图片',
  `goods_thumb` varchar(255) NOT NULL DEFAULT '' COMMENT '相册小图',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jx_goods_img
-- ----------------------------
INSERT INTO `jx_goods_img` VALUES ('6', '53', 'Uploads/2017-07-23/597415b319bcd.jpg', 'Uploads/2017-07-23/thumb_597415b319bcd.jpg');
INSERT INTO `jx_goods_img` VALUES ('7', '53', 'Uploads/2017-07-23/597415b31ab47.jpg', 'Uploads/2017-07-23/thumb_597415b31ab47.jpg');
INSERT INTO `jx_goods_img` VALUES ('10', '54', 'Uploads/2017-07-23/597415fa9f50b.jpg', 'Uploads/2017-07-23/thumb_597415fa9f50b.jpg');
INSERT INTO `jx_goods_img` VALUES ('11', '54', 'Uploads/2017-07-23/597415faa039a.jpg', 'Uploads/2017-07-23/thumb_597415faa039a.jpg');
INSERT INTO `jx_goods_img` VALUES ('12', '54', 'Uploads/2017-07-23/597415faa11d1.jpg', 'Uploads/2017-07-23/thumb_597415faa11d1.jpg');
INSERT INTO `jx_goods_img` VALUES ('13', '55', 'Uploads/2017-07-23/5974163c8dd1e.jpg', 'Uploads/2017-07-23/thumb_5974163c8dd1e.jpg');
INSERT INTO `jx_goods_img` VALUES ('14', '55', 'Uploads/2017-07-23/5974163c8ed09.jpg', 'Uploads/2017-07-23/thumb_5974163c8ed09.jpg');
INSERT INTO `jx_goods_img` VALUES ('15', '56', 'Uploads/2017-07-23/5974166b6ab25.jpg', 'Uploads/2017-07-23/thumb_5974166b6ab25.jpg');
INSERT INTO `jx_goods_img` VALUES ('16', '56', 'Uploads/2017-07-23/5974166b6ba48.jpg', 'Uploads/2017-07-23/thumb_5974166b6ba48.jpg');

-- ----------------------------
-- Table structure for `jx_goods_number`
-- ----------------------------
DROP TABLE IF EXISTS `jx_goods_number`;
CREATE TABLE `jx_goods_number` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `goods_id` int(11) NOT NULL COMMENT '商品的id',
  `goods_attr_ids` varchar(32) NOT NULL COMMENT '属性信息多个属性使用逗号隔开',
  `goods_number` int(11) NOT NULL DEFAULT '0' COMMENT '货品的库存',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jx_goods_number
-- ----------------------------
INSERT INTO `jx_goods_number` VALUES ('40', '53', '138,141', '10');
INSERT INTO `jx_goods_number` VALUES ('39', '53', '138,142', '10');
INSERT INTO `jx_goods_number` VALUES ('38', '53', '138,143', '10');
INSERT INTO `jx_goods_number` VALUES ('37', '53', '139,141', '10');
INSERT INTO `jx_goods_number` VALUES ('36', '53', '139,142', '10');
INSERT INTO `jx_goods_number` VALUES ('35', '53', '139,143', '10');
INSERT INTO `jx_goods_number` VALUES ('34', '53', '140,141', '10');
INSERT INTO `jx_goods_number` VALUES ('33', '53', '140,142', '10');
INSERT INTO `jx_goods_number` VALUES ('32', '53', '140,143', '10');
INSERT INTO `jx_goods_number` VALUES ('41', '54', '152,154', '0');
INSERT INTO `jx_goods_number` VALUES ('42', '54', '152,155', '10');
INSERT INTO `jx_goods_number` VALUES ('43', '54', '153,154', '10');
INSERT INTO `jx_goods_number` VALUES ('44', '54', '153,155', '10');

-- ----------------------------
-- Table structure for `jx_impression`
-- ----------------------------
DROP TABLE IF EXISTS `jx_impression`;
CREATE TABLE `jx_impression` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `goods_id` mediumint(8) unsigned NOT NULL COMMENT '商品id',
  `name` varchar(30) NOT NULL COMMENT '印象名称',
  `count` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '印象出现的次数',
  PRIMARY KEY (`id`),
  KEY `goods_id` (`goods_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='印象';

-- ----------------------------
-- Records of jx_impression
-- ----------------------------
INSERT INTO `jx_impression` VALUES ('1', '53', '高端', '4');
INSERT INTO `jx_impression` VALUES ('2', '53', '大气', '3');
INSERT INTO `jx_impression` VALUES ('3', '53', '上档次', '1');
INSERT INTO `jx_impression` VALUES ('4', '53', '非常漂亮', '1');
INSERT INTO `jx_impression` VALUES ('5', '53', '很好', '1');

-- ----------------------------
-- Table structure for `jx_order`
-- ----------------------------
DROP TABLE IF EXISTS `jx_order`;
CREATE TABLE `jx_order` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `user_id` mediumint(8) unsigned NOT NULL COMMENT '会员id',
  `addtime` int(10) unsigned NOT NULL COMMENT '下单时间',
  `total_price` decimal(10,2) NOT NULL COMMENT '定单总价',
  `pay_status` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '支付状态',
  `name` varchar(30) NOT NULL COMMENT '收货人姓名',
  `address` varchar(150) NOT NULL COMMENT '收货人详细地址',
  `tel` varchar(30) NOT NULL COMMENT '收货人电话',
  PRIMARY KEY (`id`),
  KEY `addtime` (`addtime`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COMMENT='定单';

-- ----------------------------
-- Records of jx_order
-- ----------------------------
INSERT INTO `jx_order` VALUES ('7', '1', '1501529663', '2000.00', '0', 'leo', '花果山', '110');
INSERT INTO `jx_order` VALUES ('8', '1', '1501529741', '2000.00', '0', 'leo', '花果山', '110');
INSERT INTO `jx_order` VALUES ('9', '1', '1501529805', '2000.00', '0', 'leo', '花果山', '110');
INSERT INTO `jx_order` VALUES ('10', '1', '1501529839', '2000.00', '0', 'leo', '花果山', '110');
INSERT INTO `jx_order` VALUES ('11', '1', '1501529863', '2000.00', '0', 'leo', '花果山', '110');
INSERT INTO `jx_order` VALUES ('12', '1', '1501529915', '2000.00', '0', 'leo', '花果山', '110');
INSERT INTO `jx_order` VALUES ('13', '1', '1501531546', '2000.00', '0', 'leo', '花果山', '110');
INSERT INTO `jx_order` VALUES ('14', '1', '1501531601', '2000.00', '0', 'leo', '花果山', '110');
INSERT INTO `jx_order` VALUES ('15', '1', '1501532223', '2000.00', '0', 'leo', '花果山', '110');
INSERT INTO `jx_order` VALUES ('16', '1', '1501532483', '2000.00', '0', 'leo', '花果山', '110');
INSERT INTO `jx_order` VALUES ('17', '1', '1501532498', '2000.00', '0', 'leo', '花果山', '110');
INSERT INTO `jx_order` VALUES ('18', '1', '1501532522', '2000.00', '0', 'leo', '花果山', '110');
INSERT INTO `jx_order` VALUES ('19', '1', '1501558182', '2000.00', '0', 'leo', '花果山123', '3333');

-- ----------------------------
-- Table structure for `jx_order_goods`
-- ----------------------------
DROP TABLE IF EXISTS `jx_order_goods`;
CREATE TABLE `jx_order_goods` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `order_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '定单Id',
  `goods_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '商品Id',
  `goods_attr_ids` varchar(150) NOT NULL DEFAULT '' COMMENT '商品属性Id',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '商品的价格',
  `goods_count` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '购买数量',
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `goods_id` (`goods_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COMMENT='定单商品';

-- ----------------------------
-- Records of jx_order_goods
-- ----------------------------
INSERT INTO `jx_order_goods` VALUES ('3', '7', '54', '152,154', '2000.00', '1');
INSERT INTO `jx_order_goods` VALUES ('4', '8', '54', '152,154', '2000.00', '1');
INSERT INTO `jx_order_goods` VALUES ('5', '9', '54', '152,154', '2000.00', '1');
INSERT INTO `jx_order_goods` VALUES ('6', '10', '54', '152,154', '2000.00', '1');
INSERT INTO `jx_order_goods` VALUES ('7', '11', '54', '152,154', '2000.00', '1');
INSERT INTO `jx_order_goods` VALUES ('8', '12', '54', '152,154', '2000.00', '1');
INSERT INTO `jx_order_goods` VALUES ('9', '13', '54', '152,154', '2000.00', '1');
INSERT INTO `jx_order_goods` VALUES ('10', '14', '54', '152,154', '2000.00', '1');
INSERT INTO `jx_order_goods` VALUES ('11', '15', '54', '152,154', '2000.00', '1');
INSERT INTO `jx_order_goods` VALUES ('12', '16', '54', '152,154', '2000.00', '1');
INSERT INTO `jx_order_goods` VALUES ('13', '17', '54', '152,154', '2000.00', '1');
INSERT INTO `jx_order_goods` VALUES ('14', '18', '54', '152,154', '2000.00', '1');
INSERT INTO `jx_order_goods` VALUES ('15', '19', '54', '152,154', '2000.00', '1');

-- ----------------------------
-- Table structure for `jx_role`
-- ----------------------------
DROP TABLE IF EXISTS `jx_role`;
CREATE TABLE `jx_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(30) NOT NULL DEFAULT '' COMMENT '角色名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jx_role
-- ----------------------------
INSERT INTO `jx_role` VALUES ('1', '超级管理员');
INSERT INTO `jx_role` VALUES ('3', '商品管理员');
INSERT INTO `jx_role` VALUES ('4', '客服管理员');
INSERT INTO `jx_role` VALUES ('5', '信息管理员');
INSERT INTO `jx_role` VALUES ('6', '物流管理员');
INSERT INTO `jx_role` VALUES ('7', '新手管理员');

-- ----------------------------
-- Table structure for `jx_role_rule`
-- ----------------------------
DROP TABLE IF EXISTS `jx_role_rule`;
CREATE TABLE `jx_role_rule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL DEFAULT '0' COMMENT '角色ID',
  `rule_id` int(11) NOT NULL DEFAULT '0' COMMENT '权限ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jx_role_rule
-- ----------------------------
INSERT INTO `jx_role_rule` VALUES ('6', '3', '1');
INSERT INTO `jx_role_rule` VALUES ('7', '3', '5');
INSERT INTO `jx_role_rule` VALUES ('8', '3', '7');
INSERT INTO `jx_role_rule` VALUES ('9', '3', '8');
INSERT INTO `jx_role_rule` VALUES ('10', '3', '9');
INSERT INTO `jx_role_rule` VALUES ('11', '3', '13');
INSERT INTO `jx_role_rule` VALUES ('12', '3', '14');
INSERT INTO `jx_role_rule` VALUES ('13', '3', '15');
INSERT INTO `jx_role_rule` VALUES ('14', '3', '16');
INSERT INTO `jx_role_rule` VALUES ('15', '3', '17');

-- ----------------------------
-- Table structure for `jx_rule`
-- ----------------------------
DROP TABLE IF EXISTS `jx_rule`;
CREATE TABLE `jx_rule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rule_name` varchar(30) NOT NULL DEFAULT '' COMMENT '权限名称',
  `module_name` varchar(30) NOT NULL DEFAULT '' COMMENT '模型名称',
  `controller_name` varchar(30) NOT NULL DEFAULT '' COMMENT '控制器名称',
  `action_name` varchar(30) NOT NULL DEFAULT '' COMMENT '方法名称',
  `parent_id` int(11) NOT NULL DEFAULT '0' COMMENT '上级权限ID 0表示顶级权限',
  `is_show` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否导航菜单显示1  显示 0 不显示',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jx_rule
-- ----------------------------
INSERT INTO `jx_rule` VALUES ('1', '商品管理', 'admin', 'goods', '#', '0', '1');
INSERT INTO `jx_rule` VALUES ('5', '商品添加', 'admin', 'goods', 'add', '1', '1');
INSERT INTO `jx_rule` VALUES ('7', '商品删除', 'admin', 'goods', 'dels', '5', '0');
INSERT INTO `jx_rule` VALUES ('8', '商品列表', 'admin', 'goods', 'index', '1', '1');
INSERT INTO `jx_rule` VALUES ('9', '商品编辑', 'admin', 'goods', 'edit', '1', '0');
INSERT INTO `jx_rule` VALUES ('10', '商品回收站', 'admin', 'goods', 'trash', '1', '1');
INSERT INTO `jx_rule` VALUES ('11', '商品还原', 'admin', 'goods', 'recover', '1', '0');
INSERT INTO `jx_rule` VALUES ('12', '商品彻底删除', 'admin', 'goods', 'remove', '1', '0');
INSERT INTO `jx_rule` VALUES ('13', '分类管理', 'admin', 'category', '#', '0', '1');
INSERT INTO `jx_rule` VALUES ('14', '添加分类', 'admin', 'category', 'add', '13', '1');
INSERT INTO `jx_rule` VALUES ('15', '分类列表', 'admin', 'category', 'index', '13', '1');
INSERT INTO `jx_rule` VALUES ('16', '分类删除', 'admin', 'category', 'dels', '13', '0');
INSERT INTO `jx_rule` VALUES ('17', '分类编辑', 'admin', 'category', 'edit', '13', '0');
INSERT INTO `jx_rule` VALUES ('18', '用户管理', 'admin', 'admin', '#', '0', '1');
INSERT INTO `jx_rule` VALUES ('19', '添加用户', 'admin', 'admin', 'add', '18', '1');
INSERT INTO `jx_rule` VALUES ('20', '删除用户', 'admin', 'admin', 'dels', '18', '0');
INSERT INTO `jx_rule` VALUES ('21', '编辑用户', 'admin', 'admin', 'edit', '18', '0');
INSERT INTO `jx_rule` VALUES ('22', '用户列表', 'admin', 'admin', 'index', '18', '1');
INSERT INTO `jx_rule` VALUES ('23', '角色管理', 'admin', 'role', '#', '0', '1');
INSERT INTO `jx_rule` VALUES ('24', '角色添加', 'admin', 'role', 'add', '23', '1');
INSERT INTO `jx_rule` VALUES ('25', '角色列表', 'admin', 'role', 'index', '23', '1');
INSERT INTO `jx_rule` VALUES ('26', '角色编辑', 'admin', 'role', 'edit', '23', '0');
INSERT INTO `jx_rule` VALUES ('27', '角色删除', 'admin', 'role', 'dels', '23', '0');

-- ----------------------------
-- Table structure for `jx_type`
-- ----------------------------
DROP TABLE IF EXISTS `jx_type`;
CREATE TABLE `jx_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(30) NOT NULL DEFAULT '' COMMENT '类型名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jx_type
-- ----------------------------
INSERT INTO `jx_type` VALUES ('2', '电脑');
INSERT INTO `jx_type` VALUES ('3', '手机');
INSERT INTO `jx_type` VALUES ('4', 'ThinkPad电脑');

-- ----------------------------
-- Table structure for `jx_user`
-- ----------------------------
DROP TABLE IF EXISTS `jx_user`;
CREATE TABLE `jx_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` char(32) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` char(32) NOT NULL DEFAULT '' COMMENT '密码',
  `salt` char(6) NOT NULL DEFAULT '' COMMENT '盐',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='用户信息表';

-- ----------------------------
-- Records of jx_user
-- ----------------------------
INSERT INTO `jx_user` VALUES ('1', 'admin', 'afbd40d551556aaa7b009a323863888d', '597351');
