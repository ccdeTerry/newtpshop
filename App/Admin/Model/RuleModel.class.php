<?php
namespace Admin\Model;

/**
 * Created by PhpStorm.
 * CategroyModel.php
 * author: Terry
 * Date: 2017-8-24
 * Time: 20:48
 * description:
 */
class RuleModel extends CommonModel {
    protected  $field =['id','rule_name','module_name','controller_name','action_name','parent_id','is_show'];
    protected $_validate=[
        ['rule_name','require','权限名称必须填写'],
        ['module_name','require','模型名称必须填写'],
        ['controller_name','require','控制器名称必须填写'],
        ['action_name','require','方法名称必须填写'],
    ];

    /**
     * @getCateTree 获取层级分类
     *
     * @param $data
     *
     * @author : Terry
     * @return
     */
    public  function getCateTree($id=0){
        $data = $this->select();
        $list = $this->getTree($data,$id);
        return $list;
    }

    /**
     * @getTree 递归分类
     *
     * @param     $data
     * @param int $id
     * @param int $level
     *
     * @author : Terry
     * @return
     */
    private function getTree($data,$id=0,$level=1,$iscache=true){
        //注意顺序
        static $list =[];
        if (!$iscache){
            $list=[];
        }

        foreach ($data as $kay => $val){
            if ($val['parent_id'] ==$id){
                $val['level'] = $level;
                $list[] = $val;
                $this->getTree($data,$val['id'],$level+1);
            }
        }
        return $list;
    }

    /**
     * @delCate 删除分类
     * @author : Terry
     * @return
     */
    public function delCate($id){
        $result = $this->where(['parent_id'=>$id])->find();
        if ($result){
            $this->error='该分类存在子分类,不允许删除';
            return false;
        }
        if (!$this->delete($id)){
            $this->error='删除失败!';
            return false;

        }
        return true;
    }

    /**
     * @cateEdit 修改分类
     *
     * @param $data 修改数据
     *
     * @author : Terry
     * @return
     */
    public  function  cateUpdate($data){

        $tree  =$this->getCateTree($data['id']);
        $tree[] = ['id'=>$data['id']];
        foreach ($data as $key =>$val){
            if ($data['parent_id'] == $val['id']){
                $this->error='不能设置子分类为父分类';
                return false;
            }
        }
        if(!$this->save($data)){
            $this->error='修改失败';
            return false;
        }
        return true;
    }

    /**
     * @getChildren 获取某个分类分子分类
     *
     * @param $id 分类id
     *
     * @author : Terry
     * @return
     */
    public function getChildren($id){
        $data = $this->select();
        $list = $this->getTree($data,$id,1,false);
        $tree = array_column($list, 'id');
        return $tree;
    }




}