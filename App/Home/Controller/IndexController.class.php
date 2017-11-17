<?php
namespace Home\Controller;
class IndexController extends CommonController {


    /**
     * index 前台首页
     *
     * author :Terry
     * return :
     */
    public function index(){
     $goodsModel =    D('Admin/Goods');
        //热销
        $isHot = $goodsModel->getRecGoods('is_hot');
        //最新
        $isNew = $goodsModel->getRecGoods('is_new');
        //推荐
        $isRec = $goodsModel->getRecGoods('is_rec');
         //促销
        $carzy = $goodsModel->getCarzyGoods();
        //获取楼层数据
        $floor = D('Admin/Category')->getFloor();
        //获取秒杀
         $seckill =   D('Admin/SeckillGoods')->getTodaySeckill();
        $this->assign('seckill',$seckill);
        $this->assign('floor',$floor);
        $this->assign('carzy',$carzy);
        $this->assign('isHot',$isHot);
        $this->assign('isNew',$isNew);
        $this->assign('isRec',$isRec);
        $this->assign('is_show',1);
        $this->display();

    }


}