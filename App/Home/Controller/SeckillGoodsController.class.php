<?php
/**
 * Created by PhpStorm.
 * SeckillGoodsController.class.php
 * author: Terry
 * Date: 2017-11-12
 * Time: 18:45
 * description:
 */
namespace Home\Controller;

class SeckillGoodsController extends CommonController{
    /**
     * @detail 秒杀详情
     * @author : Terry
     * @return
     */
    public function detail(){
        $userId = session('user_id');
        $seckill_id = I('get.seckill_id');
        //判断用户是否登录 在秒杀前让用户登录
        if (!$userId){
            $this->checkLogin(U('SeckillGoods/detail/seckill_id/'.$seckill_id));
        }
        if (IS_GET){
            $goodsInfo = D('Admin/SeckillGoods') -> getTodaySeckill();
            $goodsImg = M('GoodsImg')->where(['goods_id'=>$goodsInfo[$seckill_id]['id']])->select();
            $this->assign('goodsImg',$goodsImg);
            $this->assign('goodsInfo',$goodsInfo[$seckill_id]);
//            dump($goodsInfo[$seckill_id]);
            $this->display();
        }

    }

    public function userSeckill()
    {
        if (IS_AJAX) {
            $id = I('post.seckill_id');
           $seckill =  D('Admin/SeckillGoods');
            $goodsInfo = $seckill -> postUserSeckill($id);
            if ($goodsInfo ==false) {
                $this->ajaxReturn(['status'=>202,'msg'=>$seckill->getError()]);
            }
            $this->ajaxReturn(['status'=>200,'msg'=>'秒杀成功,请在15分钟没付款,即将跳转...','uri'=>U('Order/check')]);
        }
    }
}