<?php
namespace Admin\Model;

use Think\Model;

/**
 * Created by PhpStorm.
 * CommonModel.php
 * author: Terry
 * Date: 2017-8-24
 * Time: 20:48
 * description:
 */
class CommonModel extends Model{
    /**
     * @getOneById 返回一条数据
     *
     * @param $id 主键id
     *
     * @author : Terry
     * @return
     */
    public  function getOneById($id){
        return $this->where(['id'=>$id])->find();
    }

    /**
     * @CommonListData 获取列表公共方法
     * @author : Terry
     * @return
     */
    protected  function CommonListData($p){

        $offset =C('OFFSET');
        $count =$this->count();
        $page = new \Think\Page($count,$offset);
        $show= $page->show();
        $list = $this->page($p,$offset)->order('id desc')->select();
        return ['page'=>$show,'list'=>$list];
    }

}