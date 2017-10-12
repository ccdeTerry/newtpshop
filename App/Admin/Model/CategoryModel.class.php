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
class CategoryModel extends CommonModel {
    protected  $field =['id','cname','parent_id','isrec'];
    protected $_validate=[
        ['cname','require','分类名称必须填写'],
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

    /**
     * @getFloor 前台楼层
     * @author : Terry
     * @return
     */
    public  function  getFloor(){
        //原版
      /*  $data = $this->where(['parent_id'=>0])->select();  //10
        foreach ($data as $key=>$value){ //20 *
            $data[$key]['son'] =$this->where(['parent_id'=>$value['id']])->select();
            $data[$key]['recson'] =$this->where(['isrec'=>1,'parent_id'=>$value['id']])->select();
        }*/

        //优化
        $data =$this->select();
        //循环处理数组,最后生成两个数组 父类数组和子类数组 两个数组key值相同
        foreach($data as $key =>$value){
            //判断是否是顶级分类
            if ($value['parent_id'] == 0){
                //将顶级分类作为数组key值
                $dataInfo[$value['id']] = $value;
                //储存父id临时变量
                $parentIds[] = $value['id'];
            }else{
                //判断出次级分类
                //将次级分类父id当作key
                $info[$value['parent_id']]['son'][]=$value;
                if ($value['isrec'] ==1){
                    //判断是否是推荐
                    $info[$value['parent_id']]['recson'][]=$value;
                }

            }
        }

        //循环子类数组 将子类数组追加到父类数组中
        foreach($info as $key =>$value){
            if (in_array($key,$parentIds)){
                $dataInfo[$key]['son']=$value['son'];
                $dataInfo[$key]['recson']=$value['recson'];
                //将商品追加到recson中recson
                foreach ($dataInfo[$key]['recson'] as $k =>$v){
                    $dataInfo[$key]['recson'][$k]['goods']=$this->getGoodsByCateId($v['id']);
                }
            }

        }
//        dump($dataInfo);
        return $dataInfo;
    }

    /**
     * @getGoodsByCateId 根据分类id获取商品信息
     *
     * @param     $cate_id 分类id
     * @param int $limit   获取条数
     *
     * @author : Terry
     * @return
     */
    public function  getGoodsByCateId($cate_id,$limit=8){
        $cateIds =$this->getChildren($cate_id);
        $cateIds[] = $cate_id;
        $cateIds=implode(',',$cateIds);
         return  D('goods')->where("is_sale=1 and cate_id in ($cateIds)")->limit($limit)->select();


    }



}