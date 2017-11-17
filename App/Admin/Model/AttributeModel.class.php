<?php
/**
 * Created by PhpStorm.
 * AttributeModel.class.php
 * author: Terry
 * Date: 2017-9-7
 * Time: 11:13
 * description:
 */
namespace Admin\Model;

use Think\Crypt\Driver\Think;
use Think\Image;
use Think\Page;

class AttributeModel extends CommonModel{
    protected $fields=['id','attr_name','type_id','attr_type','attr_input_type','attr_value'];
    protected $_validate=[
        ['attr_name','require','属性名称不能为空'],
        ['attr_id','require','属性类型不能为空'],
        ['attr_type','1,2','属性类型只能为单选或唯一',1,'in'],
        ['attr_input_type','1,2','属性录入方式只能为手工录入或列表',1,'in']
    ];

    /**
     * @listData 属性列表
     * @author : Terry
     * @return
     */
    public function listData(){
    $attrInfo =  parent::CommonListData(intval(I('get.p')));
    $typeInfo = D('Type')->select();
    foreach ($typeInfo as $key =>$value){
        $type[$value['id']] = $value;
    }
    foreach ($attrInfo['list'] as $key =>$value){
        $attrInfo['list'][$key]['type_id'] =$type[$value['type_id']]['type_name'];
    }
    return $attrInfo;


    }
    public  function reomve($attr_id){
        return $this->where(['id'=>$attr_id])->delete();
    }
}