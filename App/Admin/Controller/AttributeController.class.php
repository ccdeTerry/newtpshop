<?php
/**
 * Created by PhpStorm.
 * AttributeController.class.php
 * author: Terry
 * Date: 2017-9-6
 * Time: 18:15
 * description:
 */
namespace Admin\Controller;

class  AttributeController extends CommonController{
    protected function _model(){
        if (!$this->_model){
            $this->_model =D('Attribute');
        }
        return $this->_model;
    }


    /**
     * @attrAdd 属性添加
     * @author : Terry
     * @return
     */
    public  function attrAdd(){
        $type  =  D('Type');
        if(IS_GET){
            $typeInfo =   $type->select();
            $this->assign('type',$typeInfo);
            $this->display();
        }else{
            $data = $this->_model()->create();
            if (!$data){
                $this->error($this->_model()->getError());
            }
            $this->_model()->add($data);
            $this->success('添加成功');
        }
    }

    /**
     * @attrList 属性列表
     * @author : Terry
     * @return
     */
    public function attrList(){
        $attr = $this->_model()->listData();
        $this->assign('attr',$attr);
        $this->display();
    }

    /**
     * @attrEdit 属性修改
     * @author : Terry
     * @return
     */
    public function attrEdit(){
        if (IS_GET){
            $attr_id  = intval(I('get.attr_id'));
            $attrInfo = $this->_model()->getOneById($attr_id);
            $typeInfo = D('type')->select();
            $this->assign('typeInfo',$typeInfo);
            $this->assign('attrInfo',$attrInfo);
            $this->display();
        }else{
            $data = $this->_model()->create();
            if (!$data){
                $this->error($this->_model()->getError());
            }
            if ($data['id']<=0){
                $this->error('参数错误');
            }
            $this->_model()->save($data);
            $this->success('修改成功',U('attrList'),3);
        }
    }

    /**
     * @attrDels 删除属性
     * @author : Terry
     * @return
     */
    public function attrDels(){
        $attr_id  = intval(I('get.attr_id'));
        if ($attr_id<=0){
            $this->error('参数错误');
        }
        $result = $this->_model()->remove($attr_id);
        if ($result ===false){
            $this->error('删除失败');
        }
        $this->success('删除成功');

    }
}