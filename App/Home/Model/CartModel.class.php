<?php
/**
 * Created by PhpStorm.
 * Author: Terry
 * Date: 2017/10/8
 * Time: 14:57
 * description:
 */
namespace  Home\Model;

use Think\Model;

class CartModel extends Model{
    protected $fields=['id','user_id','goods_id','goods_count','goods_attr_ids'];

    /**
     * addCart 购物车信息入库
     * * @param $goods_id 商品ID
     * @param $goods_count 商品数量
     * @param $attr 商品属性
     * author :Terry
     * return :
     */
    public function addCart($goods_id,$goods_count,$attr){
        //将熟悉从小到大排序
        sort($attr);
        //属性信息转为字符串
        $goods_attr_ids = $attr?implode(',',$attr ):'';
        //处理商品库存
        $res = $this->checkGoodsNumber($goods_id,$goods_count,$goods_attr_ids);
        if (!$res){
            $this->error='库存不足';
            return false;
        }
        //若用户登录
        $user_id =session('user_id');
        if ($user_id){
            //组装购买商品信息
            $map = [
                'user_id'=>$user_id,
                'goods_id'=>$goods_id,
                'goods_attr_ids'=>$goods_attr_ids
            ];
            $info = $this->where($map)->find();
         
            if ($info){
                //若存在购买更新商品数量
                $this->where($map)->setField('goods_count',$info['goods_count']+$goods_count);
            }else{
                // 若不存在购买够来商品直接入库
                $map['goods_count'] =$goods_count;
                $this->add($map);
            }
        }else{
            //用户没有登录
            $cart = unserialize(cookie('cart'));
            $key = $goods_id.'-'.$goods_attr_ids;
                if(array_key_exists($key,$cart)){
                    $cart[$key]+=$goods_count;
                }else{
                    $cart[$key] =$goods_count;
                }
            cookie('cart',serialize($cart));
        }
        return true;
        
    }

    /**
     * checkGoodsNumber 检查商品库存
     * * @param $goods_id 商品ID
     * @param $goods_count 商品数量
     * @param $goods_attr_ids 商品属性
     * author :Terry
     * return :
     */
    public function  checkGoodsNumber($goods_id,$goods_count,$goods_attr_ids){
        //检查总库存数量
        $goods = D('Admin/Goods')->where(['id'=>$goods_id])->find();
        if ($goods['goods_number']<$goods_count){
            return false;
        }
        //根据单选属性检查商品库存
        if ($goods_attr_ids){
            $where=['goods_id'=>$goods_id,'goods_attr_ids'=>$goods_attr_ids];
            $number = M('GoodsNumber')->where($where)->find();

            if (!$number || $number['goods_number']<$goods_count){
                return false;
            }
        }
        return true;
    }

    /**
     * cookieGoodsToDb 登录后cookie商品转移
     *
     * author :Terry
     * return :
     */
    public function cookieGoodsToDb(){
        //反序列化购物车商品信息
        $cart = unserialize(cookie('cart'));
        //获取用户id
        $user_id=session('user_id');
        if (!$user_id){
            return false;
        }

        foreach ($cart as $key=>$value){  //goods_id-goods_attr_ids
            $tmp = explode('-',$key);
            $map = [
                'user_id'=>$user_id,
                'goods_id'=>$tmp[0],
                'goods_attr_ids'=>$tmp[1]
            ];
            $info = $this->where($map)->find();
            if ($info){
                //若存在购买更新商品数量
                $this->where($map)->setField('goods_count',$info['goods_count']+$value);
            }else{
                // 若不存在购买够来商品直接入库
                $map['goods_count'] =$value;
                $this->add($map);
            }
        }
        cookie('cart',null);
    }

    /**
     * @getListData 获取购物车数据
     * @author : Terry
     * @return
     */
    public function  getListData(){
//        cookie('cart',null);
        $userId = session('user_id');
        if($userId){
            $data =$this->where(['user_id'=>$userId])->select();
        }else{
            $cartInfo =unserialize(cookie('cart'));
            foreach($cartInfo as $key=>$value){
                $tmp = explode('-',$key);
                $data[] =[
                    'goods_id'=>$tmp[0],
                    'goods_attr_ids'=>$tmp[1],
                    'goods_count'=>$value

                ];
            }

        }
//        //获取商品信息
//       $goodsModel = D('Admin/Goods');
//        $goodsIds =implode(',',array_unique(array_column($cartData,'goods_id')));
//        $goodsData =  $goodsModel->where("id in ($goodsIds)")->select();
//        foreach ($goodsData as $key =>$value){
//            if($value['cx_price']>0 &&$value['start']<time() && $value['end']>time() ){
//            $data[$key]['goods']['shop_price'] = $value['cx_price'];
//            }
//            $data[$key]['goods']=$value;
//
//        }
//        foreach ($cartData as $key=>$value){
//            if ($value['goods_attr_ids']){
//                $data[$key]['attr'] =  M('GoodsAttr')->alias('ga')->join('left join jx_attribute as attr on ga.attr_id=attr.id')->field('ga
//                .attr_values,attr.attr_name')->where("ga.id in({$value['goods_attr_ids']})")->select();
//            }
//        }
//        dump($data);
        $goodsModel= D('Admin/Goods');
        foreach ($data as $key => $value) {
            //获取具体的商品信息
            $goods = $goodsModel->where('id='.$value['goods_id'])->find();
            //获取会员价格
            $memberPrice =  D('Admin/MemberLevel')->getMemberLevel($value['goods_id'],session('user'));

//            dump($memberPrice);exit;
            //根据商品是否处于促销状态设置价格
            if($goods['cx_price']>0 && $goods['start']<time() && $goods['end']>time()){
                /*处于促销状态因此设置对于的shop_price为促销价格 */
                //获取会员价格 获取促销加个 三元判断 取最小价格
                $goods['shop_price']=$memberPrice[0]['price'] >$goods['cx_price'] ?$goods['cx_price']:$memberPrice[0]['price'];
            //若会员登录必有会员价格 显示会员加个
            }elseif($memberPrice){
                $goods['shop_price']=$memberPrice[0]['price'];
            }
            $data[$key]['goods']=$goods;
            //3、根据商品对应的属性值的组合获取对应的属性名称跟属性值
            if($value['goods_attr_ids']){
                //获取商品的属性信息
                $attr = M('GoodsAttr')->alias('a')->join('left join jx_attribute b on a.attr_id=b.id')->field('a.attr_values,b.attr_name')->where("a.id in ({$value['goods_attr_ids']})")->select();
                $data[$key]['attr']=$attr;
            }
        }
        return $data;
    }

    /**
     * @getPrice 获取商品价格
     *
     * @param $data
     *
     * @author : Terry
     * @return array
     */
    public function getPrice($data){
       /*
           array(5) {
            [0] => array(7) {
                ["id"] => string(2) "34"
                ["user_id"] => string(1) "2"
                ["goods_id"] => string(2) "64"
                ["goods_attr_ids"] => string(7) "194,196"
                ["goods_count"] => string(1) "2"
                ["goods"] => array(22) {
                    ["id"] => string(2) "64"
                    ["goods_name"] => string(21) "会员价格测试二"
                    ["goods_sn"] => string(19) "tpshop59dcc641b712e"
                    ["cate_id"] => string(1) "5"
                    ["market_price"] => string(7) "2345.00"
                    ["shop_price"] => string(7) "2343.00"
                    ["goods_img"] => string(36) "Uploads/2017-10-10/59dcc641b9e43.jpg"
                    ["goods_thumb"] => string(42) "Uploads/2017-10-10/thumb_59dcc641b9e43.jpg"
                    ["goods_body"] => NULL

                }
                ["attr"] => array(2) {
                                [0] => array(2) {
                                    ["attr_values"] => string(2) "2G"
                                    ["attr_name"] => string(6) "内存"
                  }
                  [1] => array(2) {
                                    ["attr_values"] => string(6) "联通"
                                    ["attr_name"] => string(12) "网络制式"
                  }
                }
              }

        */
        /*foreach ($data as $key=>$value){

               $count +=$value['goods_count'];
               $price +=$value['goods_count'] *$value['goods']['shop_price'];
       }*/
        $count=$price=0;
        //判断用户是否登录 若登陆计算会员价格 若没登陆使用本店价格
        if (session('user')){
            $goodsIds = array_unique(array_column(array_column($data, 'goods'),'id' ));
/*//dump($goodsIds);
            array(2) {
                [0] => string(2) "66"
                [3] => string(2) "67"
}*/
            //根据商品id 用户信息获取会员价格
            $memberGoodsPrice =   D('Admin/MemberLevel')->getMemberLevel($goodsIds,session('user'));

            /*dump($memberGoodsPrice);
            array(2) {
                [0] => array(9) {
                    ["id"] => string(2) "17"
                    ["level_name"] => string(12) "白银会员"
                    ["level_rate"] => string(2) "98"
                    ["jifen_bottom"] => string(3) "501"
                    ["jifen_top"] => string(4) "5000"
                    ["flag"] => string(1) "1"
                    ["goods_id"] => string(2) "66"
                    ["level_id"] => string(2) "17"
                    ["price"] => string(7) "6663.00"
  }
  [1] => array(9) {
                    ["id"] => string(2) "17"
                    ["level_name"] => string(12) "白银会员"
                    ["level_rate"] => string(2) "98"
                    ["jifen_bottom"] => string(3) "501"
                    ["jifen_top"] => string(4) "5000"
                    ["flag"] => string(1) "1"
                    ["goods_id"] => string(2) "67"
                    ["level_id"] => string(2) "17"
                    ["price"] => float(783.02)
  }*/
            if ($memberGoodsPrice){
                foreach ($memberGoodsPrice as $value){
                    $memberPrice[$value['goods_id']]=$value['price'];
                }
            }
//               dump($memberPrice);
////           array(2) {
//            [66] => string(7) "6663.00"
//            [67] => float(783.02)
//}
            foreach ($data as $key=>$value){
                $count +=$value['goods_count'];
                $price +=$value['goods_count'] *$memberPrice[$value['goods_id']];
            }
        }else{
            foreach ($data as $key=>$value){

                $count +=$value['goods_count'];
                $price +=$value['goods_count'] *$value['goods']['shop_price'];
            }
        }

        return ['count'=>$count,'price'=>$price];
    }

    /**
     * @dels 删除购物车商品
     *
     * @param $goods_id 商品id
     * @param $goods_attr_id 属性id
     *
     * @author : Terry
     * @return bool
     */
    public function dels($goods_id,$goods_attr_ids){
        $goods_attr_ids = $goods_attr_ids? $goods_attr_ids:'';
//        dump(cookie('cart'));exit();
        $user_id =session('user_id');
        if ($user_id){
            $where = "user_id=$user_id and goods_id=$goods_id and goods_attr_ids ='$goods_attr_ids'";
            $this->where($where)->delete();
        }else{
            $cart =unserialize(cookie('cart'));
            $key=$goods_id.'-'.$goods_attr_ids;
            unset($cart[$key]);
            cookie('cart',serialize($cart));
        }

    }

    /**
     * @updateCount 修改购物车商品数量
     * @author : Terry
     * @return
     */
    public  function updateCount($goods_id,$goods_count,$goods_attr_ids){
        if ($goods_count<0){
            return  false;
        }
        $goods_attr_ids = $goods_attr_ids ? $goods_attr_ids :'';
        $userId = session('user_id');
        if ($userId){
            $where="user_id=$userId and goods_id=$goods_id and goods_attr_ids ='$goods_attr_ids''";
            $this->where($where)->setField('goods_count',$goods_count);
        }else{
            $cart =unserialize(cookie('cart'));
            $key=$goods_id.'-'.$goods_attr_ids;
            $cart[$key]=$goods_count;
            cookie('cart',serialize($cart));
        }
    }
}