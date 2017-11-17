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
            $bdLogin = $this->bdLogin();
            $this->assign('bdLogin',$bdLogin);
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

    /**
     * @sendCheckCode发送手机验证码
     * @author : Terry
     * @return
     */
    public  function  sendCheckCode(){
        if (IS_AJAX && IS_POST){
            //获取手机号码
            $telphone = I('post.phone');
            //设置错误信息代码 200成功
            $errorCode =  array('code'=>200,'info'=>'发送失败!');
            //手机号码，替换内容数组，模板ID
            $res = sendTemplateSMS($telphone,'',"1");
//            dump($telphone);
            if($res){
                $errorCode['info']='发送成功！';
            }else{
                $errorCode['code']='202';
                $errorCode['info']='发送失败,请稍候再试！';
            }
            echo json_encode($errorCode);
        }
    }

    /**
     * qqOAuth QQ oauth授权
     *
     * author :Terry
     * return :
     */
    public  function qqOAuth(){
        Vendor('QQAPI.qqConnectAPI');

        $qc = new \QC();
        $qc->qq_login();
    }

    /**
     * callback qq回调函数
     *
     * author :Terry
     * return :
     */
    public function callback(){
        Vendor('QQAPI.qqConnectAPI');
        $qc = new \QC();
        $token = $qc->qq_callback();
        $open_id = $qc->get_openid($qc);
        $qc = new \QC($token,$open_id);
        $userInfo = $qc->get_user_info();
//        dump($userInfo);exit;
        D('User')->qqLogin($userInfo,$open_id);
        $this->success('登录成功',U('Index/index'));
        //关闭授权小窗口
        echo <<<EOF
<script type='text/javascript'>
window.opener.location.href='/';
window.close();
</script>
EOF;

    }

    /**
     * @bdLogin 百度第三方登录
     * @author : Terry
     * @return
     */
    public  function bdLogin(){
        Vendor('bdApi.Baidu');
        Vendor('bdApi.BaiduCookieStore');
        $clientId = 'TX3R7oGIf5K9x8Ve039mKx0p';
        $clientSecret = '2IqA0ATNKGeDTc5Cx4GWMgui0Q3Nrkm5';
        $redirectUri = 'http://newshop.com/user/bdCallback.html';;
        $domain = '.newshop.com';
        $baidu = new \Baidu($clientId, $clientSecret, $redirectUri, new \BaiduCookieStore($clientId));
        $user = $baidu->getLoggedInUser();
        if ($user === false){
        return   $baidu->getLoginUrl('', 'popup');

        }
    }

    /**
     * @bdCallback 百度第三方登录回调
     * @author : Terry
     * @return
     */
    public function bdCallback()
    {
        Vendor('bdApi.Baidu');
        Vendor('bdApi.BaiduCookieStore');
        $clientId = 'TX3R7oGIf5K9x8Ve039mKx0p';
        $clientSecret = '2IqA0ATNKGeDTc5Cx4GWMgui0Q3Nrkm5';
        $redirectUri = 'http://newshop.com/user/bdCallback.html';
        $domain = '.newshop.com';
        $baidu = new \Baidu($clientId, $clientSecret, $redirectUri, new \BaiduCookieStore($clientId));
        $user = $baidu->getLoggedInUser();
        if ($user) {
            $apiClient = $baidu->getBaiduApiClientService();
            $profile = $apiClient->api('/rest/2.0/passport/users/getInfo',
                array('fields' => 'userid,username,sex,birthday'));
            if ($profile === false) {
               exit('登录失败');
                $user = null;
            }
        }

    }
}