<?php
/**
 * Created by PhpStorm.
 * Author: Terry
 * Date: 2017/10/8
 * Time: 09:35
 * description:
 */
namespace  Home\Controller;

class UserController extends CommonController{
    /**
     * regist 用户注册
     *
     * author :Terry
     * return :
     */
    public  function regist(){
        if(IS_GET){
            $this->display();
        }else{
//            dump(I('post.'));
            $username = I('post.username');
            $password = I('post.username');
            $checkCode = I('post.checkcode');
            $verfiy = new \Think\Verify();
            if (!$verfiy->check($checkCode)){
                $this->ajaxReturn(['status'=>202,'msg'=>'验证码错误!']);
            }
            $user = D('User');
            $res = $user->regist($username,$password);
            if (!$res){
                $this->ajaxReturn(['status'=>202,'msg'=>$user->getError()]);
            }
            $this->ajaxReturn(['status'=>200,'msg'=>'注册成功,即将跳转登录','uri'=>U('login')]);
        }
    }

    /**
     * code 验证码
     *
     * author :Terry
     * return :
     */
    public function  code(){
        ob_clean();
        $config=['length'=>2];
        $code = new  \Think\Verify($config);
        $code->entry();
    }

    /**
     * login 用户登录
     *
     * author :Terry
     * return :
     */
    public function login(){
        if (IS_GET){
            $reUri = I('get.reUri');
            if ($reUri){
                $reUri =  str_replace('-','/' ,$reUri) ;
                session('checkLogin','/'.$reUri);
            }
            $this->display();

        }else{
            $username = I('post.username');
            $password = I('post.password');
            $checkCode = I('post.checkcode');
            $this->reUri = I('get.reUri');
            $verfiy = new \Think\Verify();
            if (!$verfiy->check($checkCode)){
                $this->ajaxReturn(['status'=>202,'msg'=>'验证码错误!']);
            }
            $user = D('User');
            $res = $user->login($username,$password);
            if (!$res){
                $this->ajaxReturn(['status'=>202,'msg'=>$user->getError()]);
            }
            if (session('checkLogin')){
                $redirect=session('checkLogin'); ///order/check.html
                session('checkLogin',null);
            }else{
                $redirect='/';
            }
            $this->ajaxReturn(['status'=>200,'msg'=>'登录成功','uri'=>$redirect]);
        }
          

    }

    /**
     * logout 退出登录
     *
     * author :Terry
     * return :
     */
    public function logout(){
        session('user',null);
        session('user_id',null);
        $this->redirect('/');
    }
}