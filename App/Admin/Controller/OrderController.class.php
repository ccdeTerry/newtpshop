<?php
/**
 * Created by PhpStorm.
 * OrderController.class.php
 * author: Terry
 * Date: 2017-10-13
 * Time: 6:58
 * description:
 */
namespace Admin\Controller;
class OrderController extends CommonController{
    /**
     * @index 订单列表
     * @author : Terry
     * @return
     */
    public  function index(){
        $data = D('Order')->getOrderList();
        $this->assign('data',$data);
        $this->display();
    }

    /**
     * @send 订单发货
     * @author : Terry
     * @return
     */
    public function send(){
        $order=D('Order');
        if (IS_GET){
            $orderId = intval(I('get.order_id'));
            $detail = $order->getOrderDetail($orderId);
//            dump($detail);
            $this->assign('detail',$detail);
            $this->display();
        }else{
            $orderId = I('post.id');
            $order = $order->where(['id'=>$orderId])->find();
//            dump($order);exit;
            if (!$order || $order['pay_status']!=1){
                $this->error('参数错误');
            }
            $data=[
                'com'=>I('post.com'),
                'no'=>I('post.no'),
                'order_status'=>2
            ];
            $order->where(['id'=>$orderId])->save($data);
            $this->success('录入成功');
        }

    }


}