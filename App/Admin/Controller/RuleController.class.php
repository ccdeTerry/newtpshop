<?php
namespace Admin\Controller;
/**
 * Created by PhpStorm.
 * RuleController.class.php
 * author: Terry
 * Date: 2017-8-24
 * Time: 20:47
 * description:
 */
class RuleController extends CommonController{

    /**
     * @categoryAdd 添加分类
     * @author : Terry
     * @return
     */
    public  function ruleAdd(){
        $rule = D('Rule');
        if (IS_GET){
            $cate =  $rule->getCateTree();
            $this->assign('cate',$cate);
            $this->display();
        }else{
           $data = $rule->create();
            if(!$data){
               $this->error($rule->getError());
            }
            $insertid = $rule->add($data);
            if (!$insertid){
                  $this->error('权限添加失败!');
            }
            $this->success('权限添加成功',U('ruleList'),3);
        }
    }

    /**
     * @cateList 分类列表
     * @author : Terry
     * @return
     */
    public function RuleList(){
        $rule = D('Rule');
        $list =  $rule->getCateTree();
        $this->assign('list',$list);
        $this->display();
    }

    /**
     * @delCate 删除分类
     * @author : Terry
     * @return
     */
    public function  delRule(){
        if(IS_GET){
            $id=intval(I('get.id'));
            $rule = D('Rule');
            $delResult = $rule->delCate($id);
            if (!$delResult){
                $this->error($rule->getError());
            }
            $this->success('删除成功');

        }
    }

    /**
     * @cateEdit  编辑分类
     * @author : Terry
     * @return
     */
    public function  ruleEdit(){
        $rule = D('Rule');
        if (IS_GET){
            $id=intval(I('get.id'));
            $listInfo =  $rule->getOneById($id);
            $list = $rule->getCateTree();
            $this->assign('listInfo',$listInfo);
            $this->assign('list',$list);
            $this->display();
        }else{
            $data = $rule->create();
            $result = $rule->cateUpdate($data);
            if ($result ==false){
                $this->error($rule->getError());
            }
            $this->success('修改成功',U('cateList'));


        }

    }

}