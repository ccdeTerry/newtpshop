<?php
/**
 * Created by PhpStorm.
 * LoginController.class.php
 * author: Terry
 * Date: 2017-9-6
 * Time: 11:41
 * description:
 */
namespace Admin\Controller;

use Think\Controller;

class LoginController extends Controller{
    /**
     * @login 用户登录
     * @author : Terry
     * @return
     */
    public  function  login(){
        if (IS_GET){
//            session(null);
            if (checkLoginIp() ===false){
                exit('哈哈哈,你无权访问!');

            }
            $this->display();
        }else{
            $admin = D('Admin');
            $captcha =I('post.captcha');
            $verify = new \Think\Verify();
            if ($verify->check($captcha)){
                $result = $admin->checkLogin(I('post.username'),I('post.password'));
                if(!$result){
                    $this->error($admin->getError());
                }
                $this->success('登录成功',U('index/index'));
            }else{
                $this->error('验证码不正确!');
            }
        }
    }

    /**
     * @verify 验证码
     * @author : Terry
     * @return
     */
    public function verify(){
        $config = ['length'=>3];
        ob_clean();
        $verify = new \Think\Verify($config);
        $verify->entry();
    }

    /**
     * @logout 退出
     * @author : Terry
     * @return
     */
    public function logout(){
        session('admin',null);
        $this->success('成功退出',U('login'));
    }
}