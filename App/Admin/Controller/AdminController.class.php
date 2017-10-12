<?php
/**
 * Created by PhpStorm.
 * AdminController.class.php
 * author: Terry
 * Date: 2017-9-5
 * Time: 12:41
 * description:
 */
namespace Admin\Controller;
class AdminController extends CommonController{
    /**
     * @adminAdd 添加管理员
     * @author : Terry
     * @return
     */
    public function  adminAdd(){
        if (IS_GET){
            $role=D('Role')->select();
            $this->assign('role',$role);
            $this->display();
        }else{
           $admin =  D('Admin');
           $data = $admin->create();
           if ($data === false){
               $this->error($admin->getError());
           }
           if(!$admin->add($data)){
               $this->error('添加失败');
           }
            $this->success('添加成功',U('adminList'));

        }
    }

    /**
     * @adminList 管理员列表
     * @author : Terry
     * @return
     */
    public  function adminList(){
        $model=D('Admin');
        $data=$model->listData();
        $this->assign('data',$data);
        $this->display();
    }

    /**
     * @adminDels 删除管理员
     * @author : Terry
     * @return
     */
    public  function  adminDels(){
        $adminId = intval(I('get.admin_id'));
        if ($adminId<=1){
            $this->error('参数错误');
        }
        $admin =D('Admin');
        $result = $admin->remove($adminId);
        if ($result === false){
            $this->error($admin->getError());
        }
        $this->success('删除成功');
    }

    /**
     * @adminEdit 编辑管理员
     * @author : Terry
     * @return
     */
    public function  adminEdit(){
       $admin =  D('admin');
       if (IS_GET){
           $adminId=intval(I('get.admin_id'));
           $info = $admin->findOne($adminId);
           $role =M('role')->select();
           $this->assign('role',$role);
           $this->assign('info',$info);
           $this->display();
       }else{
           $data = $admin->create();
           if (!$data){
               $this->error($admin->getError());
           }
           if ($data['id']<=1){
               $this->error('参数错误');
           }
           if(!$admin->update($data)){
               $this->error('修改失败');
           }
           $this->success('修改成功',U('adminList'));
       }

    }
}