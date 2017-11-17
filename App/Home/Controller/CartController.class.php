<?php
/**
 * Created by PhpStorm.
 * Author: Terry
 * Date: 2017/10/8
 * Time: 12:49
 * description:
 */
namespace Home\Controller;

class CartController extends  CommonController{
    /**
     * addCart 添加购物车
     *
     * author :Terry
     * return :
     */
    public function addCart(){
        $goodsId = intval(I('post.goods_id'));
        $goodsCount  =intval(I('post.goods_count'));
        $attr =I('post.attr');

        $cart = D('Cart');
        $res = $cart->addCart($goodsId,$goodsCount,$attr);
        if (!$res){
            $this->error($cart->getError());

        }
        $this->success('已加入购物车');
        
    }

    /**
     * @idnex 购物车列表
     * @author : Terry
     * @return
     */
    public function  index(){
        $cart = D('cart');
        $cartInfo = $cart->getListData();
        if ($cartInfo ==false) {
            $this->error($cart->getError(),U('index/index'));
        }
        $goodsPrice = $cart->getPrice($cartInfo);
        $this->assign('cartInfo',$cartInfo);
        $this->assign('goodsPrice',$goodsPrice);
        $this->display();


    }

    /**
     * @dels 购物车删除
     * @author : Terry
     * @return
     */
    public  function  dels(){
        $goodsId = intval(I('get.good_id'));
        $goodsAttrIds = I('get.good_attr_ids');
        D('cart')->dels($goodsId,$goodsAttrIds);
         $this->success('删除成功');

    }

    public  function updateCount(){
      $goodsId =    intval(I('post.goods_id'));
      $goodscount = intval(I('post.goods_count'));
      $goodsAttrIds = I('post.goods_attr_ids');
//      var_dump($goodsId,$goodscount,$goodsAttrIds);exit();
      D('Cart')->updateCount($goodsId,$goodscount,$goodsAttrIds);

    }
}