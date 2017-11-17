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

class RoleController extends CommonController{
    /**
     * @roleAdd 添加角色
     * @author : Terry
     * @return
     */
    public function roleAdd(){
       $role =  D('Role');
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
     * @roleList 角色列表
     * @author : Terry
     * @return
     */
    public function  roleList(){
        $role =D('Role');
        $listInfo = $role->listData();
        $this->assign('listInfo',$listInfo);
        $this->display();
    }

    /**
     * @roleDels 角色删除
     * @author : Terry
     * @return
     */
    public function  roleDels(){
        $roleId = intval(I('get.role_id'));
        if ($roleId<=1){
            $this->error('参数错误');
        }
        $result = D('Role')->remove($roleId);
        if ($result === false){
            $this->error('删除失败');
        }
        $this->success('删除成功');

    }

    /**
     * @roleEdit 角色修改
     * @author : Terry
     * @return
     */
    public function  roleEdit(){
       $role =  D('role');
        if (IS_GET){
            $roleId =intval(I('get.role_id'));
            $info= $role->getOneById($roleId);
            $this->assign('info',$info);
            $this->display();
        }else{
            $data =$role->create();
            if (!$data){
                $this->error($role->getError());
            }
            if ($data['id']<=1){
                $this->error('参数错误');
            }
            if(!$role->save($data)){
                $this->error('修改失败');
            }
            $this->success('修改成功',U('roleList'));
        }
    }

    /**
     * @disfetch 赋予权限
     * @author : Terry
     * @return
     */
    public function disfetch(){
        if (IS_GET){
            //获取所有权限
            $ruleModel =D('Rule');
            $rule = $ruleModel->getCateTree();
            //获取当前权限
            $roleId = intval(I('get.role_id'));
            if ($roleId<=0){
                $this->error('参数错误');
            }
            $hasRuleIds = D(RoleRule)->getRules($roleId);
            $this->assign('hasRuleIds',$hasRuleIds);
            $this->assign('rule',$rule);
            $this->display();
        }else{
            $roleId =intval(I('post.role_id'));
            if ($roleId<=0){
                $this->error('参数错误');
            }
            $ruleIds = I('post.rule');
            $userInfo =  M('AdminRole')->where(['role_id'=>$roleId])->select();
           //多个管理员可能拥有同一个角色
           foreach($userInfo as $val){
               S('user_'.$val['admin_id'],null);
           }
            if (D('RoleRule')->disfetch($roleId,$ruleIds)){
                $this->success('权限添加成功',U('roleList'));
            }
        }
    }




}