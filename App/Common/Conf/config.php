<?php
return array(
	//'配置项'=>'配置值'
    'URL_MODEL'=>2,
    'DEFAULT_MODULE'=>'Home',
    'MODULE_ALLOW_LIST'=>['Home','Admin','Api'],
    'TMPL_PARSE_STRING'=>[
            '__PUBLIC_ADMIN__'=>'/Public/resources/Admin/',
            '__PUBLIC_HOME__'=>'/Public/resources/Home/',
    ],
    /* 数据库设置 */
    'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  '127.0.0.1', // 服务器地址
    'DB_NAME'               =>  'newshop',          // 数据库名
    'DB_USER'               =>  '',      // 用户名
    'DB_PWD'                =>  '',          // 密码
    'DB_PORT'               =>  '',        // 端口
    'DB_PREFIX'             =>  'jx_',    // 数据库表前缀
    'OFFSET'=>5 ,   //分页偏移量
    'SELF_SITE'=> "http://api.newshop.com/",//./home/user/login
    //短信验证码
    'SHORTMES_NEM' => [
        'BEGIN'  => '1000',
        'END' => '9999',
    ],
    //短信主帐号,对应开官网发者主账号下的 ACCOUNT SID
    'ACCOUNT_SID'=> '8aaf070857acf7a70157cb0a1a1a1b5d',
    //主帐号令牌,对应官网开发者主账号下的 AUTH TOKEN
    'AUTH_TOKEN'=> 'e94e91fc0da1445a9b79cb110d298679',
    //应用Id，在官网应用列表中点击应用，对应应用详情中的APP ID
    //在开发调试的时候，可以使用官网自动为您分配的测试Demo的APP ID
    'APP_ID'=>'8aaf070857acf7a70157cb0a1c791b64',
    //redis
//    'REDIS_HOST'=>'192.168.101.101',
    'REDIS_HOST'=>'',
    'REDIS_PORT'=>6379,
    //微博appkey
    'WB_AKEY'=>'819555918',
    'SITE'=>'http://www.ihelp365.com',
    'WB_SKEY'=>'b0807626ece3798b4c8ff778fbb67241',

   //设置允许访问ip
    // 允许某ip下所有用户访问格式 192.168.1.*
    //允许某ip下ip段访问用户访问格式 [192.168.1.1-20,192.168.1.40-55]
    //允许某ip下指定用户访问格式  数组形式[192.168.1.1,192.168.1,2]
//     'IPS'=>['192.168.33.1-7','192.168.33.48-60']
//     'IPS'=>['192.168.33.1','192.168.33.2'],
//     'IPS'=>['127.0.0.1'],

//'SHOW_PAGE_TRACE'=>TRUE,

);