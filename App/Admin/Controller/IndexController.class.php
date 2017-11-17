<?php
namespace Admin\Controller;
//use Think\Controller;
class IndexController extends CommonController {
    /**\
     * @index 后台首页
     * @author : Terry
     * @return
     *
     */
    public function index(){
        $this->display();
    }
    public function menu(){
//        dump($this->user['menus']);
        $this->assign('menus',$this->user['menus']);
        $this->display();
    }
    public function main(){
    $this->display();
    }
    public function top(){
    $this->display();
    }
}