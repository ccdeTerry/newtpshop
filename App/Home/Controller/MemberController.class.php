<?php
/**
 * Created by PhpStorm.
 * MemberController.class.php
 * author: Terry
 * Date: 2017-10-10
 * Time: 16:47
 * description:
 */

namespace  Home\Controller;

class MemberController extends  CommonController{

    public  function  __construct()
    {
        parent::__construct();
        if (!session('user_id')){
            $this->checkLogin(U('Member/myOrder'));
        }

    }

    /**
     * @myOrder
     * @author : Terry
     * @return
     */
    public function myOrder(){
        $userId = session('user_id');
        $data =  D('order')->getOrderList($userId);
        $this->assign('data',$data);
        $this->display();
    }
}