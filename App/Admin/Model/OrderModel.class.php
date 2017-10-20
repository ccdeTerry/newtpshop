<?php
/**
 * Created by PhpStorm.
 * OrderModel.class.php
 * author: Terry
 * Date: 2017-10-13
 * Time: 7:13
 * description:
 */
namespace Admin\Model;

class OrderModel extends CommonModel{
    /**
     * @getOrderList 获取订单列表
     * @author : Terry
     * @return
     */
    public function getOrderList(){
        $p=I('get.p');
        return $this->CommonListData($p);
    }

    /**
     * @getOrderDetail 获取订单详情
     * @author : Terry
     * @return
     */
    public function getOrderDetail($order_id){
       return $this->alias('o')->field('o.*,u.username')->join('left join __USER__ as u on o.user_id =u.id ')->where(['o.id'=>$order_id])->find();
    }
}