/*
Navicat MySQL Data Transfer

Source Server         : localhost_server
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : newshop

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2017-11-17 08:56:20
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for jx_admin
-- ----------------------------
DROP TABLE IF EXISTS `jx_admin`;
CREATE TABLE `jx_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` char(32) NOT NULL DEFAULT '' COMMENT '密码',
  `salt` varchar(8) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jx_admin
-- ----------------------------
INSERT INTO `jx_admin` VALUES ('1', 'zhangxiaorui', '9ad7af36faf4567383d09fa32e311024', '64d494');
INSERT INTO `jx_admin` VALUES ('4', 'php3', '21232f297a57a5a743894a0e4a801fc3', null);
INSERT INTO `jx_admin` VALUES ('10', 'admin', '21232f297a57a5a743894a0e4a801fc3', null);
INSERT INTO `jx_admin` VALUES ('12', 'dongmei', 'bc25403387b9c56c5449e2099456e7ac', '5aca45b8');
INSERT INTO `jx_admin` VALUES ('13', 'xialuo', '64b0e90ba07123768e7c8fee8a65f619', '00584c40');
INSERT INTO `jx_admin` VALUES ('14', 'gao', '0ae5e9f64c98e95188256de8c83034fe', 'b64c6c67');

-- ----------------------------
-- Table structure for jx_admin_role
-- ----------------------------
DROP TABLE IF EXISTS `jx_admin_role`;
CREATE TABLE `jx_admin_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `role_id` int(11) NOT NULL DEFAULT '0' COMMENT '角色ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jx_admin_role
-- ----------------------------
INSERT INTO `jx_admin_role` VALUES ('1', '1', '1');
INSERT INTO `jx_admin_role` VALUES ('4', '4', '3');
INSERT INTO `jx_admin_role` VALUES ('6', '12', '1');
INSERT INTO `jx_admin_role` VALUES ('7', '13', '1');
INSERT INTO `jx_admin_role` VALUES ('8', '14', '1');

-- ----------------------------
-- Table structure for jx_attribute
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
-- Table structure for jx_cart
-- ----------------------------
DROP TABLE IF EXISTS `jx_cart`;
CREATE TABLE `jx_cart` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '登录的用户id',
  `goods_id` int(11) NOT NULL DEFAULT '0' COMMENT '商品id',
  `goods_attr_ids` varchar(255) NOT NULL DEFAULT '' COMMENT '商品属性id每个属性逗号隔开,关联jx_goods_attr表中的id',
  `goods_count` int(11) NOT NULL DEFAULT '0' COMMENT '商品购买数量',
  `flag` int(1) NOT NULL DEFAULT '0' COMMENT '商品状态 0普通商品 1秒杀商品',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jx_cart
-- ----------------------------
INSERT INTO `jx_cart` VALUES ('27', '2', '71', '', '1', '1');

-- ----------------------------
-- Table structure for jx_category
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
-- Table structure for jx_comment
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
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=utf8 COMMENT='评论';

-- ----------------------------
-- Records of jx_comment
-- ----------------------------
INSERT INTO `jx_comment` VALUES ('1', '2', '64', '1501536336', '哈哈', '3', '9');
INSERT INTO `jx_comment` VALUES ('2', '2', '64', '1501551265', '很好混好', '5', '5');
INSERT INTO `jx_comment` VALUES ('3', '2', '64', '1501553050', '好不好', '5', '1');
INSERT INTO `jx_comment` VALUES ('4', '2', '64', '1501553079', '好不好', '5', '0');
INSERT INTO `jx_comment` VALUES ('5', '2', '64', '1501555189', '非常漂亮', '5', '0');
INSERT INTO `jx_comment` VALUES ('6', '2', '64', '1501555210', '很好', '3', '0');
INSERT INTO `jx_comment` VALUES ('7', '2', '64', '1501558015', '高端大气上档次', '5', '0');
INSERT INTO `jx_comment` VALUES ('8', '2', '64', '1507739152', ' 真是一个测试', '5', '0');
INSERT INTO `jx_comment` VALUES ('9', '2', '64', '1507739286', '是V啊是vs', '0', '0');
INSERT INTO `jx_comment` VALUES ('10', '2', '64', '1507739302', '真是一个测试', '0', '0');
INSERT INTO `jx_comment` VALUES ('11', '2', '64', '1507739362', '测试测试测试测试测试测试', '5', '0');
INSERT INTO `jx_comment` VALUES ('12', '2', '64', '1507739366', '测试测试测试测试测试测试', '5', '0');
INSERT INTO `jx_comment` VALUES ('13', '2', '64', '1507739438', 'comment_btncomment_btncomment_btncomment_btn', '5', '0');
INSERT INTO `jx_comment` VALUES ('14', '2', '64', '1507739638', '测试测试', '2', '0');
INSERT INTO `jx_comment` VALUES ('15', '2', '64', '1507740215', '', '0', '0');
INSERT INTO `jx_comment` VALUES ('16', '2', '64', '1507740444', '', '5', '0');
INSERT INTO `jx_comment` VALUES ('17', '2', '64', '1507740450', '我去额服务气氛', '5', '0');
INSERT INTO `jx_comment` VALUES ('18', '2', '64', '1507740454', '我去额服务气氛', '5', '0');
INSERT INTO `jx_comment` VALUES ('19', '2', '64', '1507740483', '我去额服务气氛', '5', '0');
INSERT INTO `jx_comment` VALUES ('20', '2', '64', '1507740605', '测试测试测试测试测试', '2', '0');
INSERT INTO `jx_comment` VALUES ('21', '2', '64', '1507740620', '测试测试测试测试测试', '2', '0');
INSERT INTO `jx_comment` VALUES ('22', '2', '64', '1507740642', '测试测试测试测试测试', '2', '0');
INSERT INTO `jx_comment` VALUES ('23', '2', '64', '1507740678', '测试测试测试测试测试', '2', '0');
INSERT INTO `jx_comment` VALUES ('24', '2', '64', '1507740706', '真是测试啊 ', '1', '0');
INSERT INTO `jx_comment` VALUES ('25', '2', '64', '1507740794', '测试测试测试', '2', '0');
INSERT INTO `jx_comment` VALUES ('26', '2', '64', '1507741152', '测试啊测试', '2', '0');
INSERT INTO `jx_comment` VALUES ('27', '2', '64', '1507772669', 'qwertyuiop[谁的风格回家看了', '2', '0');
INSERT INTO `jx_comment` VALUES ('28', '2', '64', '1507772715', 'qwertyuiop[谁的风格回家看了', '2', '0');
INSERT INTO `jx_comment` VALUES ('29', '2', '0', '1507773641', '去AFSGDHFGQWASGDFH', '0', '0');
INSERT INTO `jx_comment` VALUES ('30', '2', '64', '1507773682', '哇额发生过人都挺好复印件股权温柔的风格', '0', '3');
INSERT INTO `jx_comment` VALUES ('31', '2', '64', '1507773721', '其实单位烦死个人他还有巨款I了', '0', '0');
INSERT INTO `jx_comment` VALUES ('32', '2', '64', '1507775614', '我去儿童发育', '0', '0');
INSERT INTO `jx_comment` VALUES ('33', '2', '64', '1507775658', '这真是一个测试啊啊啊啊嗄', '0', '0');
INSERT INTO `jx_comment` VALUES ('34', '2', '64', '1507775679', '访问人', '0', '1');
INSERT INTO `jx_comment` VALUES ('35', '2', '64', '1507775728', '评论一次', '0', '17');
INSERT INTO `jx_comment` VALUES ('41', '2', '64', '1510709219', 't34y34y3y4', '0', '0');
INSERT INTO `jx_comment` VALUES ('42', '2', '64', '1510709255', 'qwertyuioi', '0', '0');
INSERT INTO `jx_comment` VALUES ('40', '2', '64', '1507776505', '1.修改评论ajax提交,然后一个用户只能评论一次,选择有用也是一次,可以追加评论,然后评论完成定位到评论位置.只有购买该商品才可以评论', '0', '0');
INSERT INTO `jx_comment` VALUES ('43', '2', '64', '1510709452', '', '0', '0');

-- ----------------------------
-- Table structure for jx_goods
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
  `end` int(11) NOT NULL DEFAULT '0' COMMENT '结束时间',
  `plcount` int(11) DEFAULT '0' COMMENT '评论数量',
  `sale_number` int(11) DEFAULT '0' COMMENT '总销量',
  PRIMARY KEY (`id`),
  UNIQUE KEY `goods_sn` (`goods_sn`) USING BTREE,
  KEY `goods_name` (`goods_name`) USING BTREE,
  KEY `isdel` (`isdel`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jx_goods
-- ----------------------------
INSERT INTO `jx_goods` VALUES ('53', '小辣椒 红辣椒4A 高配版 4GB+32GB 全网通 黑色 ', 'JX597415b2f122f', '13', '1900.00', '799.00', 'Uploads/2017-10-11/59de2620946d0.jpg', 'Uploads/2017-10-08/thumb_59da01fe9a7e8.jpg', '&lt;p&gt;&lt;span style=&quot;color: rgb(102, 102, 102); font-family: Arial, &amp;#39;microsoft yahei&amp;#39;; font-weight: bold; line-height: 28px; background-color: rgb(255, 255, 255);&quot;&gt;小辣椒 红辣椒4A 高配版 4GB+32GB 全网通 黑色 移动联通电信4G手机 双卡双待&lt;/span&gt;&lt;/p&gt;', '1', '0', '0', '1500779954', '1', '1', '3', '90', '0.00', '0', '0', '1', '0');
INSERT INTO `jx_goods` VALUES ('54', 'Apple iPhone 6 32GB 金色 移动联通电信4G手机', 'JX597415fa7d456', '13', '25787.00', '2578.00', 'Uploads/2017-10-11/59de2620946d0.jpg', 'Uploads/2017-10-08/thumb_59da01fe9a7e8.jpg', '&lt;p&gt;2578&lt;/p&gt;', '0', '0', '1', '1500780026', '1', '1', '3', '32', '2000.00', '1493568000', '1506787200', '0', '1');
INSERT INTO `jx_goods` VALUES ('55', '荣耀 畅玩6X 4GB 64GB 全网通4G手机 尊享版 冰河银', 'JX5974163c73424', '13', '6000.00', '100.00', 'Uploads/2017-10-11/59de2620946d0.jpg', 'Uploads/2017-10-08/thumb_59da01fe9a7e8.jpg', '&lt;p&gt;&lt;span style=&quot;color: rgb(102, 102, 102); font-family: Arial, &amp;#39;microsoft yahei&amp;#39;; font-weight: bold; line-height: 28px; background-color: rgb(255, 255, 255);&quot;&gt;荣耀 畅玩6X 4GB 64GB 全网通4G手机 尊享版 冰河银&lt;/span&gt;&lt;/p&gt;', '0', '1', '0', '1500780092', '1', '1', '3', '55', '0.00', '0', '0', '0', '0');
INSERT INTO `jx_goods` VALUES ('56', '小米Max2 全网通 4GB+64GB 金色 移动联通电信4G手机 ', 'JX5974166b57053', '10', '2799.00', '1699.00', 'Uploads/2017-10-11/59de2620946d0.jpg', 'Uploads/2017-10-08/thumb_59da01fe9a7e8.jpg', '&lt;p&gt;&lt;span style=&quot;color: rgb(102, 102, 102); font-family: Arial, &amp;#39;microsoft yahei&amp;#39;; font-weight: bold; line-height: 28px; background-color: rgb(255, 255, 255);&quot;&gt;小米Max2 全网通 4GB+64GB 金色 移动联通电信4G手机 双卡双待&lt;/span&gt;&lt;/p&gt;', '0', '0', '0', '1500780139', '1', '1', '3', '0', '0.00', '0', '0', '0', '0');
INSERT INTO `jx_goods` VALUES ('57', '华为 HUAWEI P10 全网通 4GB+64GB 草木绿 ', 'JX5974169943cf3', '13', '6000.00', '100.00', 'Uploads/2017-10-11/59de2620946d0.jpg', 'Uploads/2017-10-08/thumb_59da01fe9a7e8.jpg', '&lt;p&gt;&lt;span style=&quot;color: rgb(102, 102, 102); font-family: Arial, &amp;#39;microsoft yahei&amp;#39;; font-weight: bold; line-height: 28px; background-color: rgb(255, 255, 255);&quot;&gt;华为 HUAWEI P10 全网通 4GB+64GB 草木绿 移动联通电信4G手机 双卡双待&lt;/span&gt;&lt;/p&gt;', '0', '1', '0', '1500780185', '1', '1', '0', '0', '0.00', '0', '0', '0', '0');
INSERT INTO `jx_goods` VALUES ('61', 'iiiiiii', 'JX597b65f88909b', '9', '400.00', '200.00', '', '', null, '0', '0', '0', '1501259256', '1', '1', '0', '0', '100.00', '1493568000', '1588262400', '0', '0');
INSERT INTO `jx_goods` VALUES ('62', '魅族 PRO 7 Plus', 'tpshop59da01fe98d93', '5', '2345.00', '1111.00', 'Uploads/2017-10-08/59da01fe9a7e8.jpg', 'Uploads/2017-10-08/thumb_59da01fe9a7e8.jpg', '&lt;p&gt;&lt;img src=&quot;/ueditor/php/upload/image/20171008/1507459553.jpg&quot; title=&quot;1507459553.jpg&quot; alt=&quot;acer4739.jpg&quot;/&gt;&lt;/p&gt;', '1', '0', '1', '1507459582', '0', '1', '3', '393', '1234.00', '0', '0', '0', '0');
INSERT INTO `jx_goods` VALUES ('63', '会员价格测试一', 'tpshop59dcc5631a36a', '5', '2345.00', '1111.00', 'Uploads/2017-10-10/59dcc5631bd88.jpg', 'Uploads/2017-10-10/thumb_59dcc5631bd88.jpg', null, '1', '1', '1', '1507640675', '1', '1', '3', '4000', '1234.00', '0', '0', '0', '0');
INSERT INTO `jx_goods` VALUES ('64', '会员价格测试二', 'tpshop59dcc641b712e', '5', '2345.00', '1234.00', 'Uploads/2017-10-10/59dcc641b9e43.jpg', 'Uploads/2017-10-10/thumb_59dcc641b9e43.jpg', null, '1', '1', '1', '1507640897', '1', '1', '3', '3984', '1234.00', '0', '0', '20', '0');
INSERT INTO `jx_goods` VALUES ('65', '秒杀测试1', 'tpshop5a0823c106645', '3', '8888.00', '6666.00', 'Uploads/2017-11-12/5a0823c107cde.jpg', 'Uploads/2017-11-12/thumb_5a0823c107cde.jpg', null, '0', '0', '0', '1510482881', '1', '1', '3', '2095', '0.00', '0', '0', '0', '0');
INSERT INTO `jx_goods` VALUES ('66', '大吉大利 今晚吃鸡', 'tpshop5a0ab385122f3', '10', '88888.00', '10000.00', '', '', null, '1', '0', '0', '1510650757', '1', '1', '3', '0', '0.00', '0', '0', '0', '0');
INSERT INTO `jx_goods` VALUES ('67', '会员价格测试三', 'tpshop5a0ac72533b63', '5', '88888.00', '10000.00', '', '', null, '1', '1', '1', '1510655781', '1', '1', '3', '0', '0.00', '0', '0', '0', '0');
INSERT INTO `jx_goods` VALUES ('68', '会员价格测试四', 'tpshop5a0ac786c103f', '3', '88888.00', '10000.00', '', '', '', '1', '1', '1', '1510655878', '1', '1', '3', '100', '0.00', '0', '0', '0', '0');
INSERT INTO `jx_goods` VALUES ('69', '是无法WGERHJHBB', 'tpshop5a0bb6259910d', '3', '8888.00', '6666.00', '', '', null, '0', '0', '0', '1510716965', '1', '0', '2', '0', '0.00', '0', '0', '0', '0');
INSERT INTO `jx_goods` VALUES ('70', '属性测试1', 'tpshop5a0bdf74874c7', '7', '8888.00', '6666.00', '', '', null, '1', '0', '0', '1510727540', '1', '1', '3', '0', '0.00', '0', '0', '0', '0');
INSERT INTO `jx_goods` VALUES ('71', '属性测试2', 'tpshop5a0be104602d9', '3', '8888.00', '6666.00', 'Uploads/2017-11-15/5a0be10460d19.jpg', 'Uploads/2017-11-15/thumb_5a0be10460d19.jpg', null, '1', '0', '0', '1510727940', '1', '1', '3', '0', '0.00', '0', '0', '0', '0');

-- ----------------------------
-- Table structure for jx_goods_attr
-- ----------------------------
DROP TABLE IF EXISTS `jx_goods_attr`;
CREATE TABLE `jx_goods_attr` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `goods_id` int(11) NOT NULL DEFAULT '0' COMMENT '��ƷID',
  `attr_id` int(11) NOT NULL DEFAULT '0' COMMENT '����ID',
  `attr_values` varchar(255) NOT NULL DEFAULT '' COMMENT '����ֵ',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=429 DEFAULT CHARSET=utf8;

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
INSERT INTO `jx_goods_attr` VALUES ('158', '62', '3', '2G');
INSERT INTO `jx_goods_attr` VALUES ('159', '62', '3', '4G');
INSERT INTO `jx_goods_attr` VALUES ('160', '62', '4', '联通');
INSERT INTO `jx_goods_attr` VALUES ('161', '62', '4', '移动');
INSERT INTO `jx_goods_attr` VALUES ('162', '62', '6', '5.0');
INSERT INTO `jx_goods_attr` VALUES ('163', '62', '7', '骁龙810');
INSERT INTO `jx_goods_attr` VALUES ('188', '63', '3', '2G');
INSERT INTO `jx_goods_attr` VALUES ('189', '63', '3', '4G');
INSERT INTO `jx_goods_attr` VALUES ('190', '63', '4', '移动');
INSERT INTO `jx_goods_attr` VALUES ('191', '63', '4', '联通');
INSERT INTO `jx_goods_attr` VALUES ('192', '63', '6', '5.0');
INSERT INTO `jx_goods_attr` VALUES ('193', '63', '7', '24h');
INSERT INTO `jx_goods_attr` VALUES ('194', '64', '3', '2G');
INSERT INTO `jx_goods_attr` VALUES ('195', '64', '3', '4G');
INSERT INTO `jx_goods_attr` VALUES ('196', '64', '4', '联通');
INSERT INTO `jx_goods_attr` VALUES ('197', '64', '4', '移动');
INSERT INTO `jx_goods_attr` VALUES ('198', '64', '6', '5.0');
INSERT INTO `jx_goods_attr` VALUES ('199', '64', '7', '24h');
INSERT INTO `jx_goods_attr` VALUES ('277', '65', '3', '4G');
INSERT INTO `jx_goods_attr` VALUES ('278', '65', '3', '8G');
INSERT INTO `jx_goods_attr` VALUES ('279', '65', '4', '移动');
INSERT INTO `jx_goods_attr` VALUES ('280', '65', '4', '联通');
INSERT INTO `jx_goods_attr` VALUES ('281', '65', '4', '全球通');
INSERT INTO `jx_goods_attr` VALUES ('282', '65', '6', '5.0');
INSERT INTO `jx_goods_attr` VALUES ('283', '65', '7', '骁龙810');
INSERT INTO `jx_goods_attr` VALUES ('308', '65', '3', '2G');
INSERT INTO `jx_goods_attr` VALUES ('309', '65', '3', '4G');
INSERT INTO `jx_goods_attr` VALUES ('310', '65', '3', '8G');
INSERT INTO `jx_goods_attr` VALUES ('311', '65', '4', '移动');
INSERT INTO `jx_goods_attr` VALUES ('312', '65', '4', '联通');
INSERT INTO `jx_goods_attr` VALUES ('313', '65', '4', '全球通');
INSERT INTO `jx_goods_attr` VALUES ('314', '65', '6', '5.0');
INSERT INTO `jx_goods_attr` VALUES ('315', '65', '7', '24h');
INSERT INTO `jx_goods_attr` VALUES ('332', '67', '3', '2G');
INSERT INTO `jx_goods_attr` VALUES ('333', '67', '3', '4G');
INSERT INTO `jx_goods_attr` VALUES ('334', '67', '3', '8G');
INSERT INTO `jx_goods_attr` VALUES ('335', '67', '4', '移动');
INSERT INTO `jx_goods_attr` VALUES ('336', '67', '4', '联通');
INSERT INTO `jx_goods_attr` VALUES ('337', '67', '4', '全球通');
INSERT INTO `jx_goods_attr` VALUES ('338', '67', '6', '5.0');
INSERT INTO `jx_goods_attr` VALUES ('339', '67', '6', '5.0');
INSERT INTO `jx_goods_attr` VALUES ('340', '67', '7', '24h');
INSERT INTO `jx_goods_attr` VALUES ('341', '67', '7', '24h');
INSERT INTO `jx_goods_attr` VALUES ('351', '66', '3', '2G');
INSERT INTO `jx_goods_attr` VALUES ('352', '66', '3', '2G');
INSERT INTO `jx_goods_attr` VALUES ('353', '66', '3', '2G');
INSERT INTO `jx_goods_attr` VALUES ('354', '66', '4', '移动');
INSERT INTO `jx_goods_attr` VALUES ('355', '66', '4', '移动');
INSERT INTO `jx_goods_attr` VALUES ('356', '66', '6', '5.0');
INSERT INTO `jx_goods_attr` VALUES ('357', '66', '6', '5.0');
INSERT INTO `jx_goods_attr` VALUES ('358', '66', '7', '24h');
INSERT INTO `jx_goods_attr` VALUES ('359', '66', '7', '24h');
INSERT INTO `jx_goods_attr` VALUES ('406', '69', '1', 'WEDRTYHJKL');
INSERT INTO `jx_goods_attr` VALUES ('407', '69', '1', 'WERTYUIKOL');
INSERT INTO `jx_goods_attr` VALUES ('408', '69', '5', '白色');
INSERT INTO `jx_goods_attr` VALUES ('409', '69', '5', '白色');
INSERT INTO `jx_goods_attr` VALUES ('410', '69', '5', '白色');
INSERT INTO `jx_goods_attr` VALUES ('425', '71', '3', '2G');
INSERT INTO `jx_goods_attr` VALUES ('426', '71', '4', '移动');
INSERT INTO `jx_goods_attr` VALUES ('427', '71', '6', '5.0');
INSERT INTO `jx_goods_attr` VALUES ('428', '71', '7', '24h');

-- ----------------------------
-- Table structure for jx_goods_cate
-- ----------------------------
DROP TABLE IF EXISTS `jx_goods_cate`;
CREATE TABLE `jx_goods_cate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `goods_id` int(11) NOT NULL DEFAULT '0' COMMENT '商品ID标识',
  `cate_id` smallint(6) NOT NULL DEFAULT '0' COMMENT '分类ID标识',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=121 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jx_goods_cate
-- ----------------------------
INSERT INTO `jx_goods_cate` VALUES ('61', '55', '10');
INSERT INTO `jx_goods_cate` VALUES ('62', '57', '11');
INSERT INTO `jx_goods_cate` VALUES ('63', '53', '11');
INSERT INTO `jx_goods_cate` VALUES ('66', '54', '12');
INSERT INTO `jx_goods_cate` VALUES ('67', '54', '11');
INSERT INTO `jx_goods_cate` VALUES ('68', '62', '10');
INSERT INTO `jx_goods_cate` VALUES ('73', '63', '10');
INSERT INTO `jx_goods_cate` VALUES ('74', '63', '13');
INSERT INTO `jx_goods_cate` VALUES ('75', '64', '10');
INSERT INTO `jx_goods_cate` VALUES ('90', '65', '7');
INSERT INTO `jx_goods_cate` VALUES ('91', '65', '8');
INSERT INTO `jx_goods_cate` VALUES ('96', '67', '7');
INSERT INTO `jx_goods_cate` VALUES ('97', '67', '8');
INSERT INTO `jx_goods_cate` VALUES ('101', '66', '10');
INSERT INTO `jx_goods_cate` VALUES ('102', '66', '7');
INSERT INTO `jx_goods_cate` VALUES ('103', '66', '3');
INSERT INTO `jx_goods_cate` VALUES ('113', '69', '3');
INSERT INTO `jx_goods_cate` VALUES ('118', '70', '3');
INSERT INTO `jx_goods_cate` VALUES ('119', '71', '7');
INSERT INTO `jx_goods_cate` VALUES ('120', '71', '9');

-- ----------------------------
-- Table structure for jx_goods_img
-- ----------------------------
DROP TABLE IF EXISTS `jx_goods_img`;
CREATE TABLE `jx_goods_img` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `goods_id` int(11) NOT NULL DEFAULT '0' COMMENT '商品ID',
  `goods_img` varchar(255) NOT NULL DEFAULT '' COMMENT '相册图片',
  `goods_thumb` varchar(255) NOT NULL DEFAULT '' COMMENT '相册小图',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

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
INSERT INTO `jx_goods_img` VALUES ('17', '62', 'Uploads/2017-10-08/59da01fee27eb.jpg', 'Uploads/2017-10-08/thumb_59da01fee27eb.jpg');
INSERT INTO `jx_goods_img` VALUES ('18', '62', 'Uploads/2017-10-08/59da01fee8561.jpg', 'Uploads/2017-10-08/thumb_59da01fee8561.jpg');
INSERT INTO `jx_goods_img` VALUES ('19', '63', 'Uploads/2017-10-10/59dcc5632f252.jpg', 'Uploads/2017-10-10/thumb_59dcc5632f252.jpg');
INSERT INTO `jx_goods_img` VALUES ('20', '63', 'Uploads/2017-10-10/59dcc56330735.jpg', 'Uploads/2017-10-10/thumb_59dcc56330735.jpg');
INSERT INTO `jx_goods_img` VALUES ('21', '64', 'Uploads/2017-10-10/59dcc641d25c5.jpg', 'Uploads/2017-10-10/thumb_59dcc641d25c5.jpg');
INSERT INTO `jx_goods_img` VALUES ('22', '64', 'Uploads/2017-10-10/59dcc641d5fba.jpg', 'Uploads/2017-10-10/thumb_59dcc641d5fba.jpg');
INSERT INTO `jx_goods_img` VALUES ('23', '65', 'Uploads/2017-10-11/59de25a6a0882.jpg', 'Uploads/2017-10-11/thumb_59de25a6a0882.jpg');
INSERT INTO `jx_goods_img` VALUES ('24', '65', 'Uploads/2017-10-11/59de25a6a36e4.jpg', 'Uploads/2017-10-11/thumb_59de25a6a36e4.jpg');
INSERT INTO `jx_goods_img` VALUES ('25', '66', 'Uploads/2017-10-12/59df230f652b4.jpg', 'Uploads/2017-10-12/thumb_59df230f652b4.jpg');
INSERT INTO `jx_goods_img` VALUES ('26', '66', 'Uploads/2017-10-12/59df230f688ff.jpg', 'Uploads/2017-10-12/thumb_59df230f688ff.jpg');
INSERT INTO `jx_goods_img` VALUES ('27', '67', 'Uploads/2017-10-12/59df235e51e1e.jpg', 'Uploads/2017-10-12/thumb_59df235e51e1e.jpg');
INSERT INTO `jx_goods_img` VALUES ('28', '67', 'Uploads/2017-10-12/59df235e53776.jpg', 'Uploads/2017-10-12/thumb_59df235e53776.jpg');
INSERT INTO `jx_goods_img` VALUES ('29', '65', 'Uploads/2017-11-12/5a0823c11afe8.jpg', 'Uploads/2017-11-12/thumb_5a0823c11afe8.jpg');
INSERT INTO `jx_goods_img` VALUES ('30', '65', 'Uploads/2017-11-12/5a0823c11c375.jpg', 'Uploads/2017-11-12/thumb_5a0823c11c375.jpg');
INSERT INTO `jx_goods_img` VALUES ('31', '65', 'Uploads/2017-11-12/5a0823c11d5ba.jpg', 'Uploads/2017-11-12/thumb_5a0823c11d5ba.jpg');
INSERT INTO `jx_goods_img` VALUES ('32', '66', 'Uploads/2017-11-14/5a0ab3852fe23.jpg', 'Uploads/2017-11-14/thumb_5a0ab3852fe23.jpg');
INSERT INTO `jx_goods_img` VALUES ('33', '66', 'Uploads/2017-11-14/5a0ab38530f6a.jpg', 'Uploads/2017-11-14/thumb_5a0ab38530f6a.jpg');
INSERT INTO `jx_goods_img` VALUES ('34', '67', 'Uploads/2017-11-14/5a0ac7254141a.jpg', 'Uploads/2017-11-14/thumb_5a0ac7254141a.jpg');
INSERT INTO `jx_goods_img` VALUES ('35', '67', 'Uploads/2017-11-14/5a0ac72542500.jpg', 'Uploads/2017-11-14/thumb_5a0ac72542500.jpg');

-- ----------------------------
-- Table structure for jx_goods_number
-- ----------------------------
DROP TABLE IF EXISTS `jx_goods_number`;
CREATE TABLE `jx_goods_number` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `goods_id` int(11) NOT NULL COMMENT '商品的id',
  `goods_attr_ids` varchar(32) NOT NULL COMMENT '属性信息多个属性使用逗号隔开',
  `goods_number` int(11) NOT NULL DEFAULT '0' COMMENT '货品的库存',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=123 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jx_goods_number
-- ----------------------------
INSERT INTO `jx_goods_number` VALUES ('40', '53', '138,141', '9');
INSERT INTO `jx_goods_number` VALUES ('39', '53', '138,142', '10');
INSERT INTO `jx_goods_number` VALUES ('38', '53', '138,143', '10');
INSERT INTO `jx_goods_number` VALUES ('37', '53', '139,141', '10');
INSERT INTO `jx_goods_number` VALUES ('36', '53', '139,142', '9');
INSERT INTO `jx_goods_number` VALUES ('35', '53', '139,143', '10');
INSERT INTO `jx_goods_number` VALUES ('34', '53', '140,141', '10');
INSERT INTO `jx_goods_number` VALUES ('33', '53', '140,142', '10');
INSERT INTO `jx_goods_number` VALUES ('32', '53', '140,143', '10');
INSERT INTO `jx_goods_number` VALUES ('41', '54', '152,154', '0');
INSERT INTO `jx_goods_number` VALUES ('42', '54', '152,155', '10');
INSERT INTO `jx_goods_number` VALUES ('43', '54', '153,154', '10');
INSERT INTO `jx_goods_number` VALUES ('44', '54', '153,155', '10');
INSERT INTO `jx_goods_number` VALUES ('110', '64', '194,197', '992');
INSERT INTO `jx_goods_number` VALUES ('109', '64', '194,196', '990');
INSERT INTO `jx_goods_number` VALUES ('48', '62', '159,161', '100');
INSERT INTO `jx_goods_number` VALUES ('47', '62', '159,160', '100');
INSERT INTO `jx_goods_number` VALUES ('45', '62', '158,160', '96');
INSERT INTO `jx_goods_number` VALUES ('46', '62', '158,161', '97');
INSERT INTO `jx_goods_number` VALUES ('108', '64', '195,196', '999');
INSERT INTO `jx_goods_number` VALUES ('107', '64', '195,197', '992');
INSERT INTO `jx_goods_number` VALUES ('62', '63', '189,190', '999');
INSERT INTO `jx_goods_number` VALUES ('63', '63', '189,191', '998');
INSERT INTO `jx_goods_number` VALUES ('64', '63', '188,190', '995');
INSERT INTO `jx_goods_number` VALUES ('65', '63', '188,191', '999');
INSERT INTO `jx_goods_number` VALUES ('122', '65', '308,279', '97');
INSERT INTO `jx_goods_number` VALUES ('121', '65', '278,280', '999');
INSERT INTO `jx_goods_number` VALUES ('120', '65', '309,281', '999');
INSERT INTO `jx_goods_number` VALUES ('85', '66', '237,240', '999');
INSERT INTO `jx_goods_number` VALUES ('86', '66', '237,241', '98');
INSERT INTO `jx_goods_number` VALUES ('87', '66', '237,242', '98');
INSERT INTO `jx_goods_number` VALUES ('88', '66', '238,241', '100');
INSERT INTO `jx_goods_number` VALUES ('89', '66', '238,240', '1000');
INSERT INTO `jx_goods_number` VALUES ('90', '66', '239,242', '1000');
INSERT INTO `jx_goods_number` VALUES ('91', '67', '261,265', '100');
INSERT INTO `jx_goods_number` VALUES ('92', '67', '262,264', '99');
INSERT INTO `jx_goods_number` VALUES ('93', '67', '262,265', '97');
INSERT INTO `jx_goods_number` VALUES ('94', '67', '261,264', '100');

-- ----------------------------
-- Table structure for jx_impression
-- ----------------------------
DROP TABLE IF EXISTS `jx_impression`;
CREATE TABLE `jx_impression` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `goods_id` mediumint(8) unsigned NOT NULL COMMENT '商品id',
  `name` varchar(30) NOT NULL COMMENT '印象名称',
  `count` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '印象出现的次数',
  PRIMARY KEY (`id`),
  KEY `goods_id` (`goods_id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COMMENT='印象';

-- ----------------------------
-- Records of jx_impression
-- ----------------------------
INSERT INTO `jx_impression` VALUES ('1', '64', '高端', '14');
INSERT INTO `jx_impression` VALUES ('2', '64', '大气', '15');
INSERT INTO `jx_impression` VALUES ('3', '64', '上档次', '7');
INSERT INTO `jx_impression` VALUES ('4', '64', '非常漂亮', '3');
INSERT INTO `jx_impression` VALUES ('5', '64', '很好', '5');
INSERT INTO `jx_impression` VALUES ('6', '0', '', '0');
INSERT INTO `jx_impression` VALUES ('7', '64', '真测试', '3');
INSERT INTO `jx_impression` VALUES ('8', '64', '测试', '3');
INSERT INTO `jx_impression` VALUES ('9', '64', '轻松的哇额法国人他还有', '1');
INSERT INTO `jx_impression` VALUES ('10', '64', '6666', '4');
INSERT INTO `jx_impression` VALUES ('11', '64', '好啊', '4');
INSERT INTO `jx_impression` VALUES ('12', '64', '问题', '1');
INSERT INTO `jx_impression` VALUES ('13', '64', 't34t3', '1');
INSERT INTO `jx_impression` VALUES ('14', '64', 'test', '1');

-- ----------------------------
-- Table structure for jx_member_level
-- ----------------------------
DROP TABLE IF EXISTS `jx_member_level`;
CREATE TABLE `jx_member_level` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `level_name` varchar(30) NOT NULL COMMENT '级别名称',
  `level_rate` tinyint(3) unsigned NOT NULL DEFAULT '100' COMMENT '折扣率，100=10折 98=9.8折 90=9折，用时除100',
  `jifen_bottom` mediumint(8) unsigned NOT NULL COMMENT '积分下限',
  `jifen_top` mediumint(8) unsigned NOT NULL COMMENT '积分上限',
  `flag` int(1) NOT NULL DEFAULT '1' COMMENT '1正常 0删除',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='会员级别';

-- ----------------------------
-- Records of jx_member_level
-- ----------------------------
INSERT INTO `jx_member_level` VALUES ('31', '青铜会员', '100', '1', '500', '1');
INSERT INTO `jx_member_level` VALUES ('17', '白银会员', '98', '501', '5000', '1');
INSERT INTO `jx_member_level` VALUES ('18', '黄金会员', '97', '5001', '10000', '1');
INSERT INTO `jx_member_level` VALUES ('19', '铂金会员', '96', '10001', '50000', '1');
INSERT INTO `jx_member_level` VALUES ('20', '钻石会员', '95', '50001', '150000', '1');
INSERT INTO `jx_member_level` VALUES ('21', '星耀会员', '90', '150001', '300000', '1');
INSERT INTO `jx_member_level` VALUES ('22', '王者会员', '85', '300001', '16777215', '1');

-- ----------------------------
-- Table structure for jx_member_price
-- ----------------------------
DROP TABLE IF EXISTS `jx_member_price`;
CREATE TABLE `jx_member_price` (
  `goods_id` mediumint(8) unsigned NOT NULL COMMENT '商品id',
  `level_id` tinyint(3) unsigned NOT NULL COMMENT '级别id',
  `price` decimal(10,2) NOT NULL COMMENT '价格',
  KEY `goods_id` (`goods_id`) USING BTREE,
  KEY `level_id` (`level_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED COMMENT='会员价格';

-- ----------------------------
-- Records of jx_member_price
-- ----------------------------
INSERT INTO `jx_member_price` VALUES ('68', '17', '0.00');
INSERT INTO `jx_member_price` VALUES ('67', '19', '0.00');
INSERT INTO `jx_member_price` VALUES ('67', '20', '0.00');
INSERT INTO `jx_member_price` VALUES ('67', '21', '0.00');
INSERT INTO `jx_member_price` VALUES ('67', '22', '0.00');
INSERT INTO `jx_member_price` VALUES ('67', '31', '0.00');
INSERT INTO `jx_member_price` VALUES ('68', '20', '0.00');
INSERT INTO `jx_member_price` VALUES ('71', '17', '0.00');
INSERT INTO `jx_member_price` VALUES ('71', '18', '0.00');
INSERT INTO `jx_member_price` VALUES ('71', '19', '0.00');
INSERT INTO `jx_member_price` VALUES ('71', '20', '0.00');
INSERT INTO `jx_member_price` VALUES ('71', '21', '0.00');
INSERT INTO `jx_member_price` VALUES ('71', '22', '0.00');
INSERT INTO `jx_member_price` VALUES ('71', '31', '0.00');
INSERT INTO `jx_member_price` VALUES ('69', '21', '0.00');
INSERT INTO `jx_member_price` VALUES ('69', '22', '0.00');
INSERT INTO `jx_member_price` VALUES ('69', '31', '0.00');
INSERT INTO `jx_member_price` VALUES ('70', '17', '0.00');
INSERT INTO `jx_member_price` VALUES ('70', '18', '0.00');
INSERT INTO `jx_member_price` VALUES ('70', '19', '0.00');
INSERT INTO `jx_member_price` VALUES ('68', '18', '0.00');
INSERT INTO `jx_member_price` VALUES ('68', '19', '0.00');
INSERT INTO `jx_member_price` VALUES ('67', '17', '0.00');
INSERT INTO `jx_member_price` VALUES ('67', '18', '0.00');
INSERT INTO `jx_member_price` VALUES ('70', '20', '0.00');
INSERT INTO `jx_member_price` VALUES ('70', '21', '0.00');
INSERT INTO `jx_member_price` VALUES ('70', '22', '0.00');
INSERT INTO `jx_member_price` VALUES ('70', '31', '0.00');
INSERT INTO `jx_member_price` VALUES ('68', '21', '0.00');
INSERT INTO `jx_member_price` VALUES ('68', '22', '0.00');
INSERT INTO `jx_member_price` VALUES ('68', '31', '0.00');
INSERT INTO `jx_member_price` VALUES ('69', '17', '0.00');
INSERT INTO `jx_member_price` VALUES ('69', '18', '0.00');
INSERT INTO `jx_member_price` VALUES ('69', '19', '0.00');
INSERT INTO `jx_member_price` VALUES ('69', '20', '0.00');
INSERT INTO `jx_member_price` VALUES ('66', '17', '9999.00');
INSERT INTO `jx_member_price` VALUES ('66', '18', '9998.00');
INSERT INTO `jx_member_price` VALUES ('66', '19', '9990.00');
INSERT INTO `jx_member_price` VALUES ('66', '20', '9985.00');
INSERT INTO `jx_member_price` VALUES ('66', '21', '9980.00');
INSERT INTO `jx_member_price` VALUES ('66', '22', '9950.00');
INSERT INTO `jx_member_price` VALUES ('66', '31', '10000.00');

-- ----------------------------
-- Table structure for jx_order
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
  `alipay_num` varchar(32) DEFAULT '0' COMMENT '支付宝回执号',
  `com` char(6) DEFAULT NULL COMMENT '快递公司',
  `cn` varchar(32) DEFAULT NULL COMMENT '快递单号',
  `order_status` int(11) DEFAULT '1' COMMENT '1未发货 2已发货',
  `open_id` varchar(255) DEFAULT NULL COMMENT 'qqopen_id',
  PRIMARY KEY (`id`),
  KEY `addtime` (`addtime`)
) ENGINE=MyISAM AUTO_INCREMENT=52 DEFAULT CHARSET=utf8 COMMENT='定单';

-- ----------------------------
-- Records of jx_order
-- ----------------------------
INSERT INTO `jx_order` VALUES ('20', '2', '1507600280', '1000.00', '0', 'test', '愤怒为了保护服务ieV你我V那完了', '15966737789', '0', '', null, '0', null);
INSERT INTO `jx_order` VALUES ('21', '2', '1507603115', '18000.00', '0', 'app_debug', '愤怒为了保护服务ieV你我V那完了', '15966737789', '0', '', null, '1', null);
INSERT INTO `jx_order` VALUES ('22', '2', '1507605238', '1000.00', '0', '', '', '', '0', '', null, '1', null);
INSERT INTO `jx_order` VALUES ('23', '2', '1507606979', '2000.00', '0', 'truetablesname', '愤怒为了保护服务ieV你我V那完了', '15966737789', '0', '', null, '1', null);
INSERT INTO `jx_order` VALUES ('24', '2', '1507607059', '1000.00', '0', 'app_debug', '愤怒为了保护服务ieV你我V那完了', '15966737789', '0', '', null, '1', null);
INSERT INTO `jx_order` VALUES ('25', '2', '1507607424', '1000.00', '0', 'app_debug', '愤怒为了保护服务ieV你我V那完了', '15966737789', '0', '', null, '1', null);
INSERT INTO `jx_order` VALUES ('26', '2', '1507607465', '1000.00', '0', 'app_debug', '愤怒为了保护服务ieV你我V那完了', '15966737789', '0', '圆通', null, '1', null);
INSERT INTO `jx_order` VALUES ('27', '2', '1507607581', '1000.00', '0', 'app_debug', '愤怒为了保护服务ieV你我V那完了', '15966737789', '0', '', null, '1', null);
INSERT INTO `jx_order` VALUES ('28', '2', '1507607729', '2000.00', '0', 'app_debug', '愤怒为了保护服务ieV你我V那完了', '15966737789', '0', '', null, '1', null);
INSERT INTO `jx_order` VALUES ('29', '2', '1507607849', '1000.00', '0', 'truetablesname', '愤怒为了保护服务ieV你我V那完了', '15966737789', '0', '', null, '1', null);
INSERT INTO `jx_order` VALUES ('30', '2', '1507607880', '1000.00', '0', 'app_debug', '愤怒为了保护服务ieV你我V那完了', '15966737789', '0', '', null, '1', null);
INSERT INTO `jx_order` VALUES ('31', '2', '1507607911', '1000.00', '0', 'app_debug', '愤怒为了保护服务ieV你我V那完了', '15966737789', '0', '', null, '1', null);
INSERT INTO `jx_order` VALUES ('32', '2', '1507607945', '1000.00', '0', 'app_debug', '愤怒为了保护服务ieV你我V那完了', '15966737789', '0', '', null, '1', null);
INSERT INTO `jx_order` VALUES ('33', '2', '1507620602', '2000.00', '1', 'app_debug', '愤怒为了保护服务ieV你我V那完了', '15966737789', '2017101021001004920200341876', '', null, '1', null);
INSERT INTO `jx_order` VALUES ('34', '2', '1507620683', '1000.00', '0', 'truetablesname', '愤怒为了保护服务ieV你我V那完了', '15966737789', '0', '', null, '1', null);
INSERT INTO `jx_order` VALUES ('35', '2', '1507620832', '1000.00', '1', 'app_debug', '愤怒为了保护服务ieV你我V那完了', '15966737789', '2017101021001004920200342058', '', null, '1', null);
INSERT INTO `jx_order` VALUES ('36', '2', '1507622221', '1000.00', '0', 'truetablesname', '愤怒为了保护服务ieV你我V那完了', '15966737789', '0', '', null, '1', null);
INSERT INTO `jx_order` VALUES ('37', '2', '1507624330', '2000.00', '1', 'app_debug', '愤怒为了保护服务ieV你我V那完了', '15966737789', '0', '', null, '1', null);
INSERT INTO `jx_order` VALUES ('38', '2', '1507624941', '1000.00', '1', 'terry', '愤怒为了保护服务ieV你我V那完了', '15966737789', '2017101121001004920200342334', '', null, '1', null);
INSERT INTO `jx_order` VALUES ('39', '2', '1507624995', '1000.00', '1', 'terry', '愤怒为了保护服务ieV你我V那完了', '15966737789', '0', '', null, '1', null);
INSERT INTO `jx_order` VALUES ('40', '2', '1507723809', '0.00', '0', '', '', '', '0', '', null, '1', null);
INSERT INTO `jx_order` VALUES ('41', '2', '1507724130', '1109.00', '1', 'app_debug', '愤怒为了保护服务ieV你我V那完了', '15966737789', '2017101121001004920200342235', '', null, '1', null);
INSERT INTO `jx_order` VALUES ('42', '2', '1507725187', '4436.00', '1', 'app_debug', '愤怒为了保护服务ieV你我V那完了', '15966737789', '2017101121001004920200342335', '', null, '1', null);
INSERT INTO `jx_order` VALUES ('43', '2', '1507728357', '2216.00', '1', 'app_debug', '愤怒为了保护服务ieV你我V那完了', '15966737789', '2017101121001004920200342336', '', null, '1', null);
INSERT INTO `jx_order` VALUES ('44', '2', '1507729959', '6648.00', '1', 'app_debug', '愤怒为了保护服务ieV你我V那完了', '15966737789', '2017101121001004920200342236', '', null, '1', null);
INSERT INTO `jx_order` VALUES ('45', '2', '1507734803', '3132.08', '1', 'app_debug', '愤怒为了保护服务ieV你我V那完了', '15966737789', '2017101121001004920200342237', '', null, '1', null);
INSERT INTO `jx_order` VALUES ('46', '2', '1507735218', '5676.06', '1', 'app_debug', '愤怒为了保护服务ieV你我V那完了', '15966737789', '2017101121001004920200342238', '', null, '1', null);
INSERT INTO `jx_order` VALUES ('47', '2', '1507799274', '21555.04', '0', 'app_debug', '愤怒为了保护服务ieV你我V那完了', '15966737789', '0', '', null, '1', null);
INSERT INTO `jx_order` VALUES ('48', '2', '1507799601', '14892.04', '1', 'truetablesname', '愤怒为了保护服务ieV你我V那完了', '15966737789', '2017101221001004920200342517', '圆通', null, '2', null);
INSERT INTO `jx_order` VALUES ('49', '2', '1510640254', '12177.00', '0', '', '', '', '0', null, null, '1', null);
INSERT INTO `jx_order` VALUES ('50', '2', '1510658050', '76800.00', '0', 'truetablesname', '愤怒为了保护服务ieV你我V那完了', '15966737789', '0', null, null, '1', null);
INSERT INTO `jx_order` VALUES ('51', '2', '1510658218', '96000.00', '1', 'truetablesname', '愤怒为了保护服务ieV你我V那完了', '15966737789', '2017111421001004920200351111', null, null, '1', null);

-- ----------------------------
-- Table structure for jx_order_goods
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
) ENGINE=MyISAM AUTO_INCREMENT=72 DEFAULT CHARSET=utf8 COMMENT='定单商品';

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
INSERT INTO `jx_order_goods` VALUES ('16', '20', '62', '158,160', '1111.00', '2');
INSERT INTO `jx_order_goods` VALUES ('17', '21', '62', '158,160', '1111.00', '2');
INSERT INTO `jx_order_goods` VALUES ('18', '22', '62', '158,161', '1111.00', '1');
INSERT INTO `jx_order_goods` VALUES ('19', '23', '62', '158,161', '1111.00', '1');
INSERT INTO `jx_order_goods` VALUES ('20', '24', '62', '158,161', '1111.00', '1');
INSERT INTO `jx_order_goods` VALUES ('49', '45', '65', '214,217', '1209.32', '1');
INSERT INTO `jx_order_goods` VALUES ('43', '42', '64', '194,197', '1109.00', '3');
INSERT INTO `jx_order_goods` VALUES ('44', '43', '64', '194,196', '1108.00', '1');
INSERT INTO `jx_order_goods` VALUES ('45', '43', '64', '194,197', '1108.00', '1');
INSERT INTO `jx_order_goods` VALUES ('46', '44', '64', '194,197', '1108.00', '2');
INSERT INTO `jx_order_goods` VALUES ('47', '44', '64', '195,197', '1108.00', '4');
INSERT INTO `jx_order_goods` VALUES ('42', '42', '64', '195,196', '1109.00', '1');
INSERT INTO `jx_order_goods` VALUES ('48', '45', '65', '214,216', '1209.32', '2');
INSERT INTO `jx_order_goods` VALUES ('38', '40', '53', '138,141', '799.00', '1');
INSERT INTO `jx_order_goods` VALUES ('39', '40', '63', '189,190', '1111.00', '1');
INSERT INTO `jx_order_goods` VALUES ('40', '41', '63', '188,191', '1111.00', '1');
INSERT INTO `jx_order_goods` VALUES ('41', '41', '64', '194,197', '1109.00', '1');
INSERT INTO `jx_order_goods` VALUES ('50', '45', '65', '214,218', '1209.32', '1');
INSERT INTO `jx_order_goods` VALUES ('51', '46', '65', '214,216', '1209.32', '1');
INSERT INTO `jx_order_goods` VALUES ('52', '46', '65', '215,217', '1209.32', '2');
INSERT INTO `jx_order_goods` VALUES ('53', '46', '64', '194,196', '1109.00', '2');
INSERT INTO `jx_order_goods` VALUES ('54', '46', '64', '195,197', '1109.00', '1');
INSERT INTO `jx_order_goods` VALUES ('55', '46', '63', '188,190', '1111.00', '1');
INSERT INTO `jx_order_goods` VALUES ('56', '47', '66', '237,240', '6663.00', '1');
INSERT INTO `jx_order_goods` VALUES ('57', '47', '66', '237,241', '6663.00', '1');
INSERT INTO `jx_order_goods` VALUES ('58', '47', '66', '237,242', '6663.00', '1');
INSERT INTO `jx_order_goods` VALUES ('59', '47', '67', '262,265', '980.00', '1');
INSERT INTO `jx_order_goods` VALUES ('60', '47', '67', '262,264', '980.00', '1');
INSERT INTO `jx_order_goods` VALUES ('61', '48', '67', '262,265', '980.00', '2');
INSERT INTO `jx_order_goods` VALUES ('62', '48', '66', '237,241', '6663.00', '1');
INSERT INTO `jx_order_goods` VALUES ('63', '48', '66', '237,242', '6663.00', '1');
INSERT INTO `jx_order_goods` VALUES ('64', '49', '64', '194,196', '1234.00', '7');
INSERT INTO `jx_order_goods` VALUES ('65', '49', '64', '194,197', '1234.00', '1');
INSERT INTO `jx_order_goods` VALUES ('66', '49', '53', '139,142', '799.00', '1');
INSERT INTO `jx_order_goods` VALUES ('67', '49', '64', '195,197', '1234.00', '3');
INSERT INTO `jx_order_goods` VALUES ('68', '49', '63', '188,190', '1111.00', '4');
INSERT INTO `jx_order_goods` VALUES ('69', '49', '63', '189,191', '1111.00', '2');
INSERT INTO `jx_order_goods` VALUES ('70', '50', '68', '', '9600.00', '8');
INSERT INTO `jx_order_goods` VALUES ('71', '51', '68', '', '9600.00', '10');

-- ----------------------------
-- Table structure for jx_role
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
-- Table structure for jx_role_rule
-- ----------------------------
DROP TABLE IF EXISTS `jx_role_rule`;
CREATE TABLE `jx_role_rule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL DEFAULT '0' COMMENT '角色ID',
  `rule_id` int(11) NOT NULL DEFAULT '0' COMMENT '权限ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

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
INSERT INTO `jx_role_rule` VALUES ('16', '1', '0');
INSERT INTO `jx_role_rule` VALUES ('17', '1', '0');
INSERT INTO `jx_role_rule` VALUES ('27', '6', '23');
INSERT INTO `jx_role_rule` VALUES ('28', '6', '24');
INSERT INTO `jx_role_rule` VALUES ('29', '6', '25');
INSERT INTO `jx_role_rule` VALUES ('30', '6', '26');
INSERT INTO `jx_role_rule` VALUES ('31', '6', '27');
INSERT INTO `jx_role_rule` VALUES ('32', '6', '28');
INSERT INTO `jx_role_rule` VALUES ('33', '6', '29');
INSERT INTO `jx_role_rule` VALUES ('34', '6', '32');
INSERT INTO `jx_role_rule` VALUES ('35', '6', '30');

-- ----------------------------
-- Table structure for jx_rule
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
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jx_rule
-- ----------------------------
INSERT INTO `jx_rule` VALUES ('1', '商品管理', 'admin', 'goods', '#', '0', '1');
INSERT INTO `jx_rule` VALUES ('5', '商品添加', 'admin', 'goods', 'goodsAdd', '1', '1');
INSERT INTO `jx_rule` VALUES ('7', '商品删除', 'admin', 'goods', 'goodsDels', '5', '0');
INSERT INTO `jx_rule` VALUES ('8', '商品列表', 'admin', 'goods', 'goodsList', '1', '1');
INSERT INTO `jx_rule` VALUES ('9', '商品编辑', 'admin', 'goods', 'goodsEdit', '1', '0');
INSERT INTO `jx_rule` VALUES ('10', '商品回收站', 'admin', 'goods', 'trash', '1', '1');
INSERT INTO `jx_rule` VALUES ('11', '商品还原', 'admin', 'goods', 'recover', '1', '0');
INSERT INTO `jx_rule` VALUES ('12', '商品彻底删除', 'admin', 'goods', 'remove', '1', '0');
INSERT INTO `jx_rule` VALUES ('13', '分类管理', 'admin', 'category', '#', '0', '1');
INSERT INTO `jx_rule` VALUES ('14', '添加分类', 'admin', 'category', 'cateAdd', '13', '1');
INSERT INTO `jx_rule` VALUES ('15', '分类列表', 'admin', 'category', 'cateList', '13', '1');
INSERT INTO `jx_rule` VALUES ('16', '分类删除', 'admin', 'category', 'godosDels', '13', '0');
INSERT INTO `jx_rule` VALUES ('17', '分类编辑', 'admin', 'category', 'goodsDdit', '13', '0');
INSERT INTO `jx_rule` VALUES ('18', '用户管理', 'admin', 'admin', '#', '0', '1');
INSERT INTO `jx_rule` VALUES ('19', '添加用户', 'admin', 'admin', 'adminAdd', '18', '1');
INSERT INTO `jx_rule` VALUES ('20', '删除用户', 'admin', 'admin', 'adminDels', '18', '0');
INSERT INTO `jx_rule` VALUES ('21', '编辑用户', 'admin', 'admin', 'adminDdit', '18', '0');
INSERT INTO `jx_rule` VALUES ('22', '用户列表', 'admin', 'admin', 'adminList', '18', '1');
INSERT INTO `jx_rule` VALUES ('23', '角色管理', 'admin', 'role', '#', '0', '1');
INSERT INTO `jx_rule` VALUES ('24', '角色添加', 'admin', 'role', 'roleAdd', '23', '1');
INSERT INTO `jx_rule` VALUES ('25', '角色列表', 'admin', 'role', 'roleList', '23', '1');
INSERT INTO `jx_rule` VALUES ('26', '角色编辑', 'admin', 'role', 'roleEdit', '23', '0');
INSERT INTO `jx_rule` VALUES ('27', '角色删除', 'admin', 'role', 'roleDels', '23', '0');
INSERT INTO `jx_rule` VALUES ('28', '权限管理', 'admin', 'rule', '#', '0', '1');
INSERT INTO `jx_rule` VALUES ('29', '添加权限', 'admin', 'rule', 'ruleAdd', '28', '1');
INSERT INTO `jx_rule` VALUES ('30', '会员管理', 'admin', 'MemberLevel', '#', '0', '1');
INSERT INTO `jx_rule` VALUES ('31', '添加会员级别', 'admin', 'MemberLevel', 'add', '30', '1');
INSERT INTO `jx_rule` VALUES ('32', '权限列表', 'admin', 'rule', 'ruleList', '28', '1');
INSERT INTO `jx_rule` VALUES ('33', '会员级别列表', 'admin', 'MemberLevel', 'lst', '30', '1');
INSERT INTO `jx_rule` VALUES ('34', '修改会员级别', 'admin', 'MemberLevel', 'edit', '30', '0');
INSERT INTO `jx_rule` VALUES ('35', '删除会员级别', 'admin', 'MemberLevel', 'detele', '30', '0');
INSERT INTO `jx_rule` VALUES ('36', '订单管理', 'admin', 'Order', '#', '0', '1');
INSERT INTO `jx_rule` VALUES ('37', '订单列表', 'admin', 'Order', 'index', '36', '1');
INSERT INTO `jx_rule` VALUES ('38', '商品秒杀', 'admin', 'SeckillGoods', 'index', '1', '1');
INSERT INTO `jx_rule` VALUES ('39', '商品属性', 'admin', 'attribute', '#', '0', '1');
INSERT INTO `jx_rule` VALUES ('40', '添加属性', 'admin', 'attribute', 'attrAdd', '39', '1');
INSERT INTO `jx_rule` VALUES ('41', '属性列表', 'admin', 'attribute', 'attrList', '39', '1');

-- ----------------------------
-- Table structure for jx_seckill_goods
-- ----------------------------
DROP TABLE IF EXISTS `jx_seckill_goods`;
CREATE TABLE `jx_seckill_goods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `goods_id` int(5) NOT NULL COMMENT '商品id',
  `seckill_key` varchar(32) NOT NULL COMMENT '秒杀队列key',
  `seckill_price` decimal(16,2) NOT NULL DEFAULT '0.00' COMMENT '秒杀价格',
  `goods_num` int(11) NOT NULL DEFAULT '0' COMMENT '参加秒杀数量',
  `btime` int(11) NOT NULL COMMENT '秒杀开始时间',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '创建时间',
  `flag` int(1) NOT NULL DEFAULT '0' COMMENT '秒杀状态 1结束 0进行',
  `etime` int(11) NOT NULL COMMENT '秒杀结束时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of jx_seckill_goods
-- ----------------------------
INSERT INTO `jx_seckill_goods` VALUES ('1', '65', 'seckillListKey_b8d36a7b', '0.00', '10', '1510365600', '2017-11-09 11:05:05', '1', '1510383600');
INSERT INTO `jx_seckill_goods` VALUES ('2', '65', 'seckillListKey_6902b44c', '0.00', '10', '0', '2017-11-12 18:36:12', '1', '0');
INSERT INTO `jx_seckill_goods` VALUES ('3', '64', 'seckillListKey_7011d05c', '0.00', '10', '1510367400', '2017-11-13 15:25:33', '1', '1510210800');
INSERT INTO `jx_seckill_goods` VALUES ('4', '63', 'seckillListKey_59adff02', '11.11', '10', '0', '2017-11-13 15:25:18', '1', '0');
INSERT INTO `jx_seckill_goods` VALUES ('5', '65', 'seckillListKey_ef9b712f', '11.11', '10', '0', '2017-11-13 15:25:10', '1', '0');
INSERT INTO `jx_seckill_goods` VALUES ('6', '65', 'seckillListKey_cf92c947', '11.11', '10', '1510624800', '2017-11-13 15:42:18', '1', '1510671600');
INSERT INTO `jx_seckill_goods` VALUES ('7', '64', 'seckillListKey_e4883dcd', '11.11', '10', '0', '2017-11-13 15:37:07', '1', '0');
INSERT INTO `jx_seckill_goods` VALUES ('8', '63', 'seckillListKey_a86204d9', '11.11', '10', '1510624800', '2017-11-13 15:42:18', '1', '1510671600');
INSERT INTO `jx_seckill_goods` VALUES ('10', '63', 'seckillListKey_80ca8fed', '11.11', '10', '1510624800', '2017-11-13 15:43:10', '1', '1510671600');
INSERT INTO `jx_seckill_goods` VALUES ('11', '68', 'seckillListKey_adb63070', '11.11', '10', '1510665000', '2017-11-14 21:02:22', '0', '1510671600');
INSERT INTO `jx_seckill_goods` VALUES ('12', '67', 'seckillListKey_897d2424', '11.11', '10', '1510665600', '2017-11-14 21:12:54', '0', '1510667940');
INSERT INTO `jx_seckill_goods` VALUES ('13', '71', 'seckillListKey_326e830b', '11.11', '10', '1510743600', '2017-11-15 17:20:08', '0', '1510750800');

-- ----------------------------
-- Table structure for jx_type
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
-- Table structure for jx_user
-- ----------------------------
DROP TABLE IF EXISTS `jx_user`;
CREATE TABLE `jx_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` char(32) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` char(32) NOT NULL DEFAULT '' COMMENT '密码',
  `salt` char(6) NOT NULL DEFAULT '' COMMENT '盐',
  `jifen` int(8) NOT NULL DEFAULT '0' COMMENT '会员积分',
  `tel` char(11) DEFAULT NULL COMMENT '手机号',
  `active_code` varchar(32) DEFAULT NULL COMMENT '激活嘛',
  `status` int(1) DEFAULT '0' COMMENT '是否激活 0未激活 1激活',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='用户信息表';

-- ----------------------------
-- Records of jx_user
-- ----------------------------
INSERT INTO `jx_user` VALUES ('1', 'admin', 'afbd40d551556aaa7b009a323863888d', '597351', '0', '0', null, '0');
INSERT INTO `jx_user` VALUES ('2', 'zhangxiaorui', '9ad7af36faf4567383d09fa32e311024', '64d494', '111935', '0', null, '0');
INSERT INTO `jx_user` VALUES ('3', 'qquser_Terry。', '9dac24ce72667c39efd48983c3cc3dbc', '208215', '0', '', null, '1');
