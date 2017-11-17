<?php
/**
 * Created by PhpStorm.
 * OrderModel.class.php
 * author: Terry
 * Date: 2017-10-9
 * Time: 23:54
 * description:
 */

namespace Home\Model;

use Think\Model;

class OrderModel extends Model{
    /**
     * @order 订单入库
     * @author : Terry
     * @return
     */
    public function postOrder()
    {
        //获取购物车中商品的信息
        $cateModel = D('Cart');
        $data = $cateModel->getListData();
        if(!$data){
            $this->error='购物车中没有商品';
            return false;
        }
        //根据每一个商品做一个库存检查
        foreach ($data as $key => $value) {
            if($value['flag'] != 1){
                //具体针对每一个商品检查库存
                $status = $cateModel->checkGoodsNumber($value['goods_id'],$value['goods_count'],$value['goods_attr_ids']);
                if(!$status){
                    $this->error='库存量不够';
                    return false;
                }
            }

        }
        //向订单总表写入数据
        //计算购物车中商品的总价格
        $total = $cateModel->getPrice($data);
        $order=array(
            'user_id'=>session('user_id'),
            'addtime'=>time(),
            'total_price'=>$total['price'],
            'name'=>I('post.name'),
            'address'=>I('post.address'),
            'tel'=>I('post.tel'),
        );
//        dump($order);exit;
        $order_id = $this->add($order);

        //向商品订单详情表写入具体的信息
        foreach ($data as $key => $value) {
            $goods_order[]=array(
                'order_id'=>$order_id,
                'goods_id'=>$value['goods_id'],
                'goods_attr_ids'=>$value['goods_attr_ids'],
                'price'=>$value['goods']['shop_price'],
                'goods_count'=>$value['goods_count']
            );
        }
        M('OrderGoods')->addAll($goods_order);
        //减少商品对应的库存量
        foreach ($data as $key => $value) {
            //先需要将商品表中总库存减少
            M('Goods')->where('id='.$value['goods_id'])->setDec('goods_number',$value['goods_count']);
            M('Goods')->where('id='.$value['goods_id'])->setInc('goods_number',$value['goods_count']);
            //根据商品的单选属性组合减少对应的库存
            if($value['goods_attr_ids']){
                $where='goods_id = '.$value['goods_id'].' and goods_attr_ids='."'".$value['goods_attr_ids']."'";
                M('GoodsNumber')->where($where)->setDec('goods_number',$value['goods_count']);
            }
        }
        $order['id']=$order_id;
        return $order;
    }

    /**
     * @getList 获取用户订单
     *
     * @param $user_id 用户id
     *
     * @author : Terry
     * @return
     */
    public  function getOrderList($user_id){
        $offset=C('OFFSET');
        $count    =  $this->count();
        $page = new  \Think\Page($count,$offset);
        $show =$page->show();
        $p = intval(I('get.p'));
        $data = $this->order('id desc')->where(['user_id'=>$user_id])->page($p,$offset)->select();
//        dump($data);
        return ['page'=>$show,'list'=>$data];
    }
}
