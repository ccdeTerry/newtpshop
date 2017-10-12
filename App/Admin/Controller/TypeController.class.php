<?php
/**
 * Created by PhpStorm.
 * RoleController.class.php
 * author: Terry
 * Date: 2017-9-5
 * Time: 10:56
 * description:
 */

namespace Admin\Controller;

class TypeController extends CommonController{
    /**
     * @typeAdd 添加类型
     * @author : Terry
     * @return
     */
    public function typeAdd(){
       $role =  D('Type');
        if (IS_GET){
            $this->display();
        }else{

            $data =$role->create();
            if (!$data){
                $this->error($role->getError());
            }
            if ($role->add($data)){
                $this->success('添加成功');
            }

        }
    }

    /**
     * @typeList 类型列表
     * @author : Terry
     * @return
     */
    public function  typeList(){
        $role =D('Type');
        $listInfo = $role->listData();
        $this->assign('listInfo',$listInfo);
        $this->display();
    }

    /**
     * @typeDels 类型删除
     * @author : Terry
     * @return
     */
    public function  typeDels(){
        $typeId = intval(I('get.type_id'));
        if ($typeId<=1){
            $this->error('参数错误');
        }
        $result = D('Type')->remove($typeId);
        if ($result === false){
            $this->error('删除失败');
        }
        $this->success('删除成功');

    }

    /**
     * @typeEdit 类型修改
     * @author : Terry
     * @return
     */
    public function  typeEdit(){
        $type =  D('Type');
        if (IS_GET){
            $typeId =intval(I('get.type_id'));
            $info= $type->getOneById($typeId);
            $this->assign('info',$info);
            $this->display();
        }else{
            $data =$type->create();
            if (!$data){
                $this->error($role->getError());
            }
            if ($data['id']<=1){
                $this->error('参数错误');
            }
            if(!$type->save($data)){
                $this->error('修改失败');
            }
            $this->success('修改成功',U('typeList'));
        }
    }





}