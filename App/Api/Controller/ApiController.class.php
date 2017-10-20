<?php
/**
 * Created by PhpStorm.
 * Author: Terry
 * Date: 2017/10/14
 * Time: 21:57
 * description:
 */

namespace  Api\Controller;
use Org\Util\ApiErrCode;
use Home\Controller\CommonController;

class ApiController extends  CommonController{
    
    public function __construct()
    {
        parent::__construct();
        if (!checkLoginIp()){
            $this->ajaxReturn(['errorCode'=>ApiErrCode::ALLOW_IP_CODE,'data'=>''] );
        }
    }

    /**
     * apiLogin Api用户登录
     *
     * author :Terry
     * return :
     */
    public  function apiLogin(){
        $username = I('get.username');
        $password = I('get.password');
        if (!$username || !$password){
            $this->ajaxReturn(['errorCode'=>ApiErrCode::ERR_ERROR_KEY,'data'=>''] );
        }
        $user = D('User');
        $info = $user->where(['username'=>$username])->find();
        if (!$info){
            $this->ajaxReturn(['errorCode'=>ApiErrCode::ERR_USERINFO_KEY,'data'=>''] );
        }
        if ($info['status'] !=1){
            $this->ajaxReturn(['errorCode'=>ApiErrCode::ERR__USER_STATUS_CODE,'data'=>''] );
        }
        if ($info['password']!=md5(md5($password).$info['salt'])){
            $this->ajaxReturn(['errorCode'=>ApiErrCode::ERR_ERROR_KEY,'data'=>''] );
        }
        $this->ajaxReturn(['errorCode'=>ApiErrCode::SUCCESS_CODE,'data'=>$info] );
    }
}