<?php

namespace Org\Util;

/**
 * 接口全局返回码
 */
class ApiErrCode
{
    // 返回的状态码
    const SUCCESS_CODE       = 200; //接口成功访问
    const UNAUTHORIZED_CODE  = 401; //未授权
    const NOT_ALLOWED_CODE   = 403; //无权访问
    const NOT_FOUND_CODE     = 404; //访问的接口不存在
    const ERR__USER_STATUS_CODE  = 412; //用户处于未激活或冻结状态
    const HTTP_TYPE_ERR_CODE = 416; //访问的http类型不允许
    const SGIN_ERR_CODE      = 417; //签名验证失败
    const ALLOW_IP_CODE      = 418; //访问IP受限
    const PARAMS_ERR_CODE    = 419; //必要参数缺失 注意 该状态的err_msg应由具体的执行的方法根据业务逻辑定义
    const FAILURE_CODE       = 500; //具体的业务逻辑错误状态码 注意 该状态的err_msg应由具体的执行的方法根据业务逻辑定义
    const ERR_UNDEFIND_KEY            = 40000; //缺少必要参数
    const ERR_SUITE_UNDEFIND_ID       = 40001; //缺少suite_id
    const ERR_SUITE_UNDEFIND_TICKET   = 40002; //缺少suite_ticket
    const ERR_COMPANY_UNDEFIND_CORPID = 40003; //缺少corpid
    const ERR_ERROR_KEY               = 40005; //参数错误
    const ERR_USERINFO_KEY            =   456;
    const AI_UNDEFIND_KEY               = 60000; //缺少必要参数
    const AI_MESSAGE_ANALYSIS_FAIL      = 60001; //信息解释失败


    // 状态码所对应的返回信息
    public static $ERROR_MESSAGE = array(
        '200'   => '操作成功.',
        '401'   => '未授权的Vendor.',
        '403'   => '无权访问.',
        '404'   => '访问的接口不存在.',
        '412'   => '用户处于未激活或冻结状态.',
        '416'   => '只允许GET或POST的方式访问接口.',
        '417'   => '签名验证失败,请检查签名规则.',
        '418'   => '您的IP不在服务器允许访问的IP列表中.',
        '456'   => '人员信息不匹配.',
        '40005' => '参数错误',
        '60001' => '信息解释失败',
    );

    /**
     * 根据状态码获取其所对应的状态信息.
     *
     * @author Cui
     *
     * @date   2015-10-01
     *
     * @param int $code 预设的状态码
     *
     * @return string 预设的状态信息
     */
    public static function getErrMsgByCode($code)
    {
        if (!array_key_exists($code, self::$ERROR_MESSAGE)) {
            //E('状态码或状态码所对应的信息未设置');
        }

        return self::$ERROR_MESSAGE[$code];
    }
}
