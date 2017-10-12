<?php
/**
 * Created by PhpStorm.
 * RoleModel.class.php
 * author: Terry
 * Date: 2017-9-5
 * Time: 11:04
 * description:
 */
namespace Admin\Model;

class RoleModel extends CommonModel{
    protected $field=['id','role_name'];
    protected $_validate=[
        ['role_name','require','角色名称必须填写'],
        ['role_name','','角色名称不能重复',1,'unique']
    ];

    /**
     * @listData 角色列表
     * @author : Terry
     * @return
     */
    public  function listData(){
        $offset = 5;
        $count =$this->count();
        $page = new \Think\Page($count,$offset);
        $list = $page->show();
        $p = intval(I('get.p'));
        $data = $this->page($p,$offset)->select();
        return ['data'=>$data,'page'=>$list];
    }

    /**
     * @remove 删除角色
     *
     * @param $role_id 角色id
     *
     * @author : Terry
     * @return
     */
    public function remove($role_id){
        return $this->where("id=$role_id")->delete();
    }
}