<?php
namespace Admin\Controller;
/**
 * Created by PhpStorm.
 * CategroyController.class.php
 * author: Terry
 * Date: 2017-8-24
 * Time: 20:47
 * description:
 */
class CategoryController extends CommonController{

    /**
     * @categoryAdd 添加分类
     * @author : Terry
     * @return
     */
    public  function cateAdd(){
        $categroy = D('Category');
        if (IS_GET){
            $cate =  $categroy->getCateTree();
            $this->assign('cate',$cate);
            $this->display();
        }else{
           $data = $categroy->create();
            if(!$data){
               $this->error($categroy->getError());
            }
            $insertid = $categroy->add($data);
            if (!$insertid){
                  $this->error('分类添加失败!');
            }
            $this->success('分类添加成功');
        }
    }

    /**
     * @cateList 分类列表
     * @author : Terry
     * @return
     */
    public function cateList(){
        $categroy = D('Category');
        $list =  $categroy->getCateTree();
        $this->assign('list',$list);
        $this->display();
    }

    /**
     * @delCate 删除分类
     * @author : Terry
     * @return
     */
    public function  delCate(){
        if(IS_GET){
            $id=intval(I('get.id'));
            $categroy = D('Category');
            $delResult = $categroy->delCate($id);
            if (!$delResult){
                $this->error($categroy->getError());
            }
            $this->success('删除成功');

        }
    }

    /**
     * @cateEdit  编辑分类
     * @author : Terry
     * @return
     */
    public function  cateEdit(){
        $categroy = D('Category');
        if (IS_GET){
            $id=intval(I('get.id'));
            $listInfo =  $categroy->getOneById($id);
            $list = $categroy->getCateTree();
            $this->assign('listInfo',$listInfo);
            $this->assign('list',$list);
            $this->display();
        }else{
            $data = $categroy->create();
            $result = $categroy->cateUpdate($data);
            if ($result ==false){
                $this->error($categroy->getError());
            }
            $this->success('修改成功',U('cateList'));


        }

    }

}