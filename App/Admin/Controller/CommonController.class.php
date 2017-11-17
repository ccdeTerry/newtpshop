<?php
namespace  Admin\Controller;

use Think\Controller;

/**
 * Created by PhpStorm.
 * CommonController.class.php
 * author: Terry
 * Date: 2017-8-24
 * Time: 20:45
 * description:
 */

class CommonController extends Controller{
    //是否进行权限认证标识
    public $isChchkRule=true;
    public $user =[];
    public function __construct()
    {
        parent::__construct();
        //检测用户IP是否允许访问
        if (checkLoginIp() ===false){
            $this->error('哈哈哈,你无权访问!',U('Login/login'));
            
        }
//        myU();
//        session(null);
        $admin =session('admin');
        if (!$admin){
            $this->error('没有登录,请先登录!',U('Login/login'));
        }
        $this->user=S('user_'.$admin['id']);
        if (!$this->user) {
            $this->user = $admin;
            $roleInfo              = M(AdminRole)->where(['admin_id' => $admin['id']])->find();
            $this->user['role_id'] = $roleInfo['role_id'];
            $rule     = D('Rule');
            if ($roleInfo['role_id'] == 1){
                //超级管理员
                $this->is_check_rule=false;//不验证权限
                $ruleList = $rule->select();
            }else{
                $rules    = D('RoleRule')->getRules($roleInfo['role_id']);
                $ruleids  = implode(',', $rules);
                $ruleList = $rule->where("id IN($ruleids)")->select();
            }

            foreach ($ruleList as $key => $val) {
                //组装数组 用于权限认证
                $this->user['rules'][] = strtolower($val['module_name'] . '/' . $val['controller_name'] . '/' . $val['action_name']);
                //用于展示
                if ($val['is_show'] == 1) {
                    $this->user['menus'][] = $val;
                }
            }
            S('user_' . $admin['id'], $this->user);
        }
        //
        if ($this->user['role_id'] ==1){
            $this->isChchkRule=false;
        }
       //权限认证
       if ($this->isChchkRule){
           $this->user['rules'][]='admin/index/index';
           $this->user['rules'][]='admin/index/top';
           $this->user['rules'][]='admin/index/menu';
           $this->user['rules'][]='admin/index/main';
           $action = strtolower(MODULE_NAME.'/'.CONTROLLER_NAME.'/'.ACTION_NAME);
           if (!in_array($action,$this->user['rules'])){
               if (IS_AJAX){
                   $this->ajaxReturn(['status'=>202,'msg'=>'没有权限']);
               }else{
                    exit('没有权限');
               }
           }

       }


    }
}