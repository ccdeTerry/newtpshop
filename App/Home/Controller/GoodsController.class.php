<?php
/**
 * Created by PhpStorm.
 * Author: Terry
 * Date: 2017/10/5
 * Time: 16:17
 * description:
 */

namespace Home\Controller;

use Think\Cache\Driver\Redis;

class GoodsController extends CommonController{
    /**
     * index 商品首页
     *
     * author :Terry
     * return :
     */
    public  function index(){

        $goodsId = intval(I('goods_id'));
        if ($goodsId<=0){
            $this->redirect('Index/index');
        }
        $goods= D('Admin/Goods');
        //基本信息
        $goodsInfo = $goods->where(['isdel'=>1,'id'=>$goodsId])->find();
        //最近浏览商品
        $seenGoodsKey =$goods->seenGoods($goodsInfo);
        if (!$goodsInfo){
            $this->redirect('Index/index');
        }
        //判断用户是否登录 若登陆判断会员价格与促销价格  使用最低的价格
        if (session('user_id')){
            //获取会员等级
            $userinfo = session('user');
            $memberPrice = D('Admin/MemberLevel')->getMemberLevel($goodsId,$userinfo);
//            dump($memberPrice);
            //判断是否存在会员价格  如存在则判断促销价格与会员价格对比 显示使用最低的价格
            if ($goodsInfo['cx_price'] >0 && $goodsInfo['start']<time() && $goodsInfo['end']>time()){
                $goodsInfo['shop_price'] = $memberPrice[0]['price'] > $goodsInfo['cx_price'] ? $goodsInfo['cx_price']:$memberPrice[0]['price'];
                //若会员登录必会有会员价格 显示会员加个
            }elseif($memberPrice){
                $goodsInfo['shop_price'] =$memberPrice[0]['price'];
            }
        }else{
            //用户未登录状态 判断是否存在促销价格 显示使用最低的价格
            if ($goodsInfo['cx_price'] >0 && $goodsInfo['start']<time() && $goodsInfo['end']>time()){
                $goodsInfo['shop_price'] = $goodsInfo['cx_price'];
            }
        }
        $goodsInfo['goods_body'] =htmlspecialchars_decode($goodsInfo['goods_body']);
        //相册
        $pic =M('GoodsImg')->where(['goods_id'=>$goodsId])->select();
        //属性
        $attr = M('GoodsAttr')->alias('a')->field('a.*,b.attr_name,b.attr_type')->join('left join jx_attribute b on a.attr_id=b.id')->where(['a.goods_id'=>$goodsId])->select();
        foreach ($attr as $value){
            if ($value['attr_type'] ==1){
                $unique[] =$value;
            }else{
                $sigle[$value['attr_id']][] =$value;
            }
        }
        //获取商品评论
        $comment = D('Comment')->getCommentList($goodsId);
        //获取印象值
        $buyer = D('Impression')->where(['goods_id'=>$goodsId])->order('count desc')->limit(8)->select();
        //获取最近浏览商品
        $redis = new \Redis();
        $redis->connect(C('REDIS_HOST'),C('REDIS_PORT'));
        $seenGoods = $redis->ZRANGE($seenGoodsKey,0,-1);
        $seenGoods =  array_map(function ($val){return explode(',',$val);},$seenGoods);
//        dump($seenGoods);
        $this->assign('seenGoods',$seenGoods);
        $this->assign('buyer',$buyer);
        $this->assign('comment',$comment);
        $this->assign('sigle',$sigle);
        $this->assign('unique',$unique);
        $this->assign('pic',$pic);
        $this->assign('goodsInfo',$goodsInfo);
        $this->display();
    }


    /**
     * comment 商品评论
     *
     * author :Terry
     * return :
     */
    public function comment(){
        $this->checkLogin();
        $comment =D('Comment');
        $data = $comment->create();
        if (!$data){
            $this->ajaxReturn(['status'=>202,'msg'=>'评论失败!']);
        }
        $comment->add($data);
        $this->ajaxReturn(['status'=>200,'msg'=>'评论成功']);
    }

    /**
     * useful 增加评论有用值
     *
     * author :Terry
     * return :
     */
    public function useful(){
        $comment_id = intval(I('post.comment_id'));
        $comment = M('Comment');
        $info = $comment->where(['id'=>$comment_id])->find();
        if (!$info){
            $this->ajaxReturn(['status'=>202,'msg'=>'点赞失败']);
        }
        $useFulStauts = $comment->where(['id'=>$comment_id])->setInc('good_number');
        if ($useFulStauts){
            $this->ajaxReturn(['status'=>200,'goods_number'=>($info['good_number']+1)]);
        }

    }

}