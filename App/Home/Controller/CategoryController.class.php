<?php
/**
 * Created by PhpStorm.
 * Author: Terry
 * Date: 2017/10/4
 * Time: 17:28
 * description:
 */
namespace  Home\Controller;

class CategoryController extends  CommonController{

    /**
     * index 分类首页
     *
     * author :Terry
     * return :
     */
    public  function index(){
//dump(session('user'));
//        dump(__INFO__);
        $goods  =D('Admin/Goods');
        $data = $goods->getGoodsList();
//        dump($data);
        $this->assign('data',$data);
        $this->display();
    }
}