<?php
/**
 * Created by PhpStorm.
 * GoodsAttrModel.class.php
 * author: Terry
 * Date: 2017-9-7
 * Time: 18:03
 * description:
 */
namespace Admin\Model;
class GoodsAttrModel extends CommonModel{
    protected $_field=['id','goods_id','attr_values'];

    /**
     * @insertGoodsAttr 添加商品属性
     * @author : Terry
     * @return
     */
    public function insertGoodsAttr($data,$goods_id){
        $data = array_map('array_unique',$data);
        foreach ($data as $key=>$value){
            foreach ($value as $val){
                $attrList[] =[
                    'goods_id'=>$goods_id,
                    'attr_id'=>$key,
                    'attr_values'=>$val
                ];
            }

        }
        D('GoodsAttr')->addAll($attrList);
    }

    /**
     * @getSigleAttr 获取商品的属性信息
     *
     * @param $goods_id
     *
     * @author : Terry
     * @return
     */
    public function getSigleAttr($goods_id){
        $data =$this->alias('ga')->join('left join jx_attribute  as attr on  ga.attr_id = attr.id')->field('ga.*,attr.attr_name,attr.attr_type,attr.attr_value,attr.attr_input_type')->where("attr.attr_type =2 and ga.goods_id=$goods_id")->select();
//        dump($data);
        foreach ($data as $key =>$val){
            $list[$val['attr_id']][] =$val;
        }
//        dump($list);
        return $list;
    }
}