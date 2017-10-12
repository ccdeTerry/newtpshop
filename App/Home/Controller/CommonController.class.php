<?php
/**
 * Created by PhpStorm.
 * Author: Terry
 * Date: 2017/10/4
 * Time: 16:53
 * description:
 */

namespace  Home\Controller;

use Think\Controller;

class CommonController extends Controller{
    
    public function  __construct()
    {
        parent::__construct();

//        dump(session());
        $cate = D('Admin/Category')->getCateTree();
        $this->assign('cate',$cate);
    }

    /**
     * @checkLogin 检查登录
     * @author : Terry
     * @return
     */
    public  function checkLogin($redirect){ //Order/check.html
        $userId =session('user_id');
        if (!$userId){
            session('checkLogin',$redirect);
            $this->redirect('User/login');
        }
    }
}