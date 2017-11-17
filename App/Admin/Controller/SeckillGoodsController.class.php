<?php
/**
 * Created by PhpStorm.
 * Author: Terry
 * Date: 2017/11/1
 * Time: 16:24
 * description:
 */
namespace Admin\Controller;

class SeckillGoodsController extends CommonController{
    /**
     * add 添加秒杀商品
     *
     * author :Terry
     * return :
     */
    public function add($goods_id){
       $seckill =  D('SeckillGoods');
        if (IS_GET){
            if ($goods_id<1){
                $this->error('参数错误');
            }
            //判断商品是否已参加秒杀,若在秒杀中提示秒杀进行中
           $goodsStatus =$seckill->where(['goods_id'=>$goods_id,'flag'=>0])->find();
            if ($goodsStatus){
                $this->error('该商品已秒杀进行中,请结束后在进行添加',U('Goods/goodsList'));
            }
            $goodsInfo = D('goods')->getOneById($goods_id);
            $goodsInfo['goodsCount']=($seckillCount+1);
            $this->assign('goodsInfo',$goodsInfo);
            $this->display();
        }else{
           $data =  $seckill->create();
            if (!$data){
                $this->error($seckill->getError());
            }
            if(!D('SeckillGoods')->addSeckillGoods($data)){
                $this->error($seckill->getError());
            }
            $this->success('添加成功',U('index'));
            

        }
       
    }

    /**
     * index 秒杀列表
     *
     * author :Terry
     * return :
     */
    public  function index(){
        $list =  D('SeckillGoods')->getSeckillList();
        $this->assign('data',$list);
        $this->display();
        
    }

    /**
     * endSeckill 结束秒杀
     *
     * author :Terry
     * return :
     */
    public  function  endSeckill(){
        $seckillKey = I('get.seckillKey');
       $seckillGoods =  D('SeckillGoods');
       $status= $seckillGoods->endSeckill($seckillKey);
        if ($status === false){
            $this->error($seckillGoods->getError());
        }
        $this->success('已结束','',3);
 
    }

    /**
     * @edit 秒杀编辑
     * @author : Terry
     * @return
     */
    public function  edit(){
        $seckill =    D('SeckillGoods');
        if (IS_GET){
            $goods_id = I('get.goods_id');
            if($goods_id<0){
                $this->error('参数错误');
            }
            $seckillInfo = $seckill->getOneById($goods_id);
            if (time()>$seckillInfo['btime']){
                $this->error('秒杀已开始,禁止编辑');
            }
            $goodsInfo = D('Goods')->getOneById($seckillInfo['goods_id']);
            $this->assign('seckillInfo',$seckillInfo);
            $this->assign('goodsInfo',$goodsInfo);
            $this->display();
            exit;
        }
        $data = $seckill->create();
        $saveStatus =  $seckill->updateSeckill($data);
        if (!$saveStatus){
            $this->error($seckill->getError());
        }
        $this->success('修改成功',U('index'),3);
    }

   
}