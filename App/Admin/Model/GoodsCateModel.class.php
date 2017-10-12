<?php
/**
 * Created by PhpStorm.
 * GoodsCateModel.class.php
 * author: Terry
 * Date: 2017-9-4
 * Time: 17:19
 * description:
 */

namespace Admin\Model;

class GoodsCateModel extends CommonModel{
    /**
     * @insertExtCate
     *
     * @param $extCateIds 扩展分类id
     * @param $goodsId 商品id
     *
     * @author : Terry
     * @return
     */
    public function insertExtCate($extCateIds,$goodsId){
        $extCateIds=array_unique($extCateIds);
        foreach ($extCateIds as $key =>$val){
            if ($val !=0){
                $list[] = ['goods_id'=>$goodsId,'cate_id'=>$val];
            }
        }
        $this->addAll($list);
    }
}