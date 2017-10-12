<?php
return array(
	//'配置项'=>'配置值'
    'URL_MODEL'=>2,
    'DEFAULT_MODULE'=>'Home',
    'MODULE_ALLOW_LIST'=>['Home','Admin'],
    'TMPL_PARSE_STRING'=>[
            '__PUBLIC_ADMIN__'=>'/Public/resources/Admin/',
            '__PUBLIC_HOME__'=>'/Public/resources/Home/',
    ],
    /* 数据库设置 */
    'DB_TYPE'               =>  'mysql',     // 数据库类型
//    'DB_HOST'               =>  '101.200.160.169', // 服务器地址
    'DB_HOST'               =>  '127.0.0.1', // 服务器地址
    'DB_NAME'               =>  'newshop',          // 数据库名
    'DB_USER'               =>  'study',      // 用户名
    'DB_PWD'                =>  'zhangxiaorui',          // 密码
    'DB_PORT'               =>  '',        // 端口
    'DB_PREFIX'             =>  'jx_',    // 数据库表前缀
    'OFFSET'=>6 ,   //分页偏移量
    'SELF_SITE'=> "http://newshop.com/"
);