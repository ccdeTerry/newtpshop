CREATE TABLE `jx_member_price` (
  `goods_id` mediumint(8) unsigned NOT NULL COMMENT '商品id',
  `level_id` tinyint(3) unsigned NOT NULL COMMENT '级别id',
  `price` decimal(10,2) NOT NULL COMMENT '价格',
  KEY `goods_id` (`goods_id`) USING BTREE,
  KEY `level_id` (`level_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED COMMENT='会员价格';

CREATE TABLE `jx_member_level` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `level_name` varchar(30) NOT NULL COMMENT '级别名称',
  `level_rate` tinyint(3) unsigned NOT NULL DEFAULT '100' COMMENT '折扣率，100=10折 98=9.8折 90=9折，用时除100',
  `jifen_bottom` mediumint(8) unsigned NOT NULL COMMENT '积分下限',
  `jifen_top` mediumint(8) unsigned NOT NULL COMMENT '积分上限',
  `flag` int(1) NOT NULL DEFAULT '1' COMMENT '1正常 0删除',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='会员级别';