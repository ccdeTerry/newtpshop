<?php
/**
 * Created by PhpStorm.
 * Author: Terry
 * Date: 2017/11/1
 * Time: 21:44
 * description:
 */

namespace Admin\Model;

use Org\Util\Date;

class SeckillGoodsModel extends CommonModel{

    protected $fields=['id','goods_id','seckill_price','seckill_key','goods_num','btime','etime','create_time','flag'];
    protected $_validate=[
        ['goods_num','require','商品数量必须填写'],
        ['goods_num','number','商品数量必须为数字'],
        ['btime','require','开始时间必须填写'],
        ['time','require','结束时间必须填写'],
    ];
    protected $_auto=[
        ['btime','strtotime',3,'function'],
        ['etime','strtotime',3,'function'],
    ];
    private  $redisObj;
    private  $seckill_key_px;
    public function __construct(){
        parent::__construct();
        $this->seckill_key_px= date('Y-m-d');
        if (!class_exisit('Redis')){
            exit('Redis扩展未开启,请开启redis扩展');
        }
        $this->redisObj= new \Redis();
        $this->redisObj->connect(C('REDIS_HOST'),C('REDIS_PORT'));
    }

    /**
     * addSeckillGoods 添加秒杀
     *
     * author :Terry
     * return :
     */
    public  function addSeckillGoods($data){

       if($data['btime']>$data['etime']){
           $this->error='结束时间必须大于开始时间';
           return false;
       }
        //查看秒杀设置时间
        $todayTime = strtotime(date('Y-m-d 00:00:00'));
        if($data['btime']<$todayTime){
            $this->error='只能设置'.date('Y年m月d日').'以后的秒杀';
            return false;
        }

        //查看秒杀数量
        $toadyDate =date('Y-m-d',$data['btime']);
        $goodsCount=$this->redisObj->sCard($toadyDate.'_seckillKey_set');
        if($goodsCount >=5){
            $this->error=$toadyDate.'秒杀商品数据已达上限';
            return false;
        }
        //生成秒杀唯一key值
        $data['seckill_key'] = $listKey = 'seckillListKey_'.substr(md5(time()),16,8 );
        //将商品信息写入redis
        $list =  $this->addList($listKey,$data['goods_num'],$data['goods_id']);
        if($list){
            //秒杀基本信息入库
            return  $this->add($data);
        }

    }


    /**
     * addList商品写入redis队列
     * @param $listKey 队列key
     * @param $num 秒杀数量
     * @param $good_id 商品id
     * author :Terry
     * return :
     */
    private function addList($listKey,$num,$good_id)
    {

        //减少商品库存
        $goods = D('Goods')->getOneById($good_id);
        if($goods['goods_number']< $num){
            $this->error='库存不足';
            return false;
        }
        M('Goods')->where(['goods_id'=>$good_id])->setDec('goods_number',$num);
        //将商品写入队列
        for ($i=0;$i<$num;$i++){
            $this->redisObj->lPush($listKey, $good_id);
            usleep(80000);
        }
        $llen = $this->redisObj->lLen($listKey);
        if($llen!==$num ){
            for ($i=0;$i<($num-$llen);$i++){
                $this->redisObj->lPush($listKey, $good_id);
                usleep(80000);
            }
        }
        if(!$this->redisObj->exists($listKey)){
            return false;
        }

        $todaySeckillKey = $this->seckill_key_px.'_todaySeckill';
        //刷新商品缓存
        if($this->redisObj->EXISTS($todaySeckillKey)){
            $this->redisObj->del($todaySeckillKey);
        }
        return true;
    }
    public function _after_insert($data)
    {
        //设置秒杀key值前缀
        $sekillDate = date('Y-m-d',$data['etime']);
        //设置相应的生命周期
        $listStatus =   $this->redisObj->expire($data['seckill_key'], intval($data['etime']-time()));
        if ($listStatus){
            //将秒杀商品写入集合  用来判断秒杀上限
            $this->redisObj->sAdd($sekillDate.'_seckillKey_set',$data['id']);
            //将参加秒杀商品信息写入hash 用于判断商品秒杀结束是否结束
            $this->redisObj->hSet($sekillDate.'_seckillKey_hash', $data['id'], $data['etime']);
        }
    }

    /** 
     * getSeckillList 获取秒杀商品列表
     *
     * author :Terry
     * return :
     */
    public function  getSeckillList(){
     return  parent::CommonListData(I('get.p'));
        
    }
    /**
     * endSeckill 结束秒杀
     *
     * author :Terry
     * return :
     */
    public function endSeckill($seckillKey){
        //判断是否存在key
        if($this->redisObj->exists($seckillKey)) {
            //将秒杀剩余商品写回商品库存
            $goods_id = $this->redisObj->lRange($seckillKey,1 ,1 );
            $num =   $this->redisObj->lLen($seckillKey);
            M('Goods')->where(['id'=>$goods_id['0']])->setInc('goods_number',$num);
            //若存在就删除
            $sekillStatus = $this->redisObj->del($seckillKey);
            if (!$sekillStatus) {
                $this->error = '结束失败,请与系统管理员联系';
                return false;
            }
            return $this->where(['seckill_key'=>$seckillKey])->setField(['flag'=>1]);
        }else{
            return $this->where(['seckill_key'=>$seckillKey])->setField(['flag'=>1]);
        }


    }
    

    /**
     * getTodaySeckill 获取今日秒杀了
     *
     * author :Terry
     * return :
     */
    public function getTodaySeckill($seckill_id=0){
        $todaySeckillKey = $this->seckill_key_px.'_todaySeckill';
        //判断今日秒杀商品是否写入redis 若写入则在redis中去数据,若不存在则数据库取数据
        if (!$this->redisObj->EXISTS($todaySeckillKey)) {
            $where['s.btime']=['gt',strtotime(date('Y-m-d 00:00:00'))];
            $where['s.etime']=['lt',strtotime(date('Y-m-d 23:59:59'))];
            $where['s.flag']=0;
            $toadySeckill  =$this->alias('s')->field('s.id as seckillid,s.btime,s.etime,s.seckill_price,s.seckill_key,g.*')->where($where)->join('inner join jx_goods as g on s.goods_id = g.id')->select();
//            echo  $this->getLastSql();exit();
            foreach ($toadySeckill as $val){
                $this->redisObj->hset($todaySeckillKey,$val['seckillid'],serialize($val));
            }
            //为今日秒数据设置声明周期
            $ttl = strtotime(date('Y-m-d 23:59:59'))-time();
            $this->redisObj->expire($todaySeckillKey,$ttl);
        }
        $res=$this->redisObj->hGetAll($todaySeckillKey);
        if ($res) {
            if ($seckill_id) {
                $tmp =array_map('unserialize',$res);
                return $tmp[$seckill_id];
            }
            return array_map('unserialize',$res);
        }

    }
    
    /**
     * updateSeckill 修改秒杀
     * @param $data 修改信息
     * author :Terry
     * return :
     */
    public function updateSeckill($data)
    {
        if($data['btime']>$data['etime']){
            $this->error='结束时间必须大于开始时间';
            return false;
        }
        //查看秒杀设置时间
        $todayTime = strtotime(date('Y-m-d 00:00:00'));
        if($data['btime']<$todayTime){
            $this->error='只能设置'.date('Y年m月d日').'以后的秒杀';
            return false;
        }
        $seckillInfo =  parent::getOneById($data['id']);
        //判断是否修改了秒杀日期
        $btime = idate('Y-m-d',$seckillInfo['btime']);
        $list =  $this->addList($seckillInfo['seckill_key'],$data['goods_num'],$seckillInfo['goods_id']);
        if(!$list){
           $this->error('修改失败,请与管理员联系');
            return false;
        }
        return $this->save($data);

    }

    /**
     * @postUserSeckill 用户秒杀
     * @author : Terry
     * @return
     */
    public function postUserSeckill($id){
        $seckillInfo = $this->getTodaySeckill($id);
        $listKey = $seckillInfo['seckill_key'];
        if ($seckillInfo['btime'] > time()) {
            $this->error='不要心急,秒杀还未开始';
            return false;
        }
        $userId= session('user_id');
        $sekillDate = date('Y-m-d',$seckillInfo['etime']);
        //判断用户是否参加过秒杀
        $userSeckillStatus = $this->redisObj->sIsMember($sekillDate.'_success_set_'.$seckillInfo['id'],$userId);
        if ($userSeckillStatus) {
            $this->error='不要太贪心,你已经参加过一次秒杀';
            return false;
        }
        //若没参加过秒杀则获取商品
         $successId =  $this->redisObj->lPop($listKey);
//        dump($successId);exit();
          if($successId){
              //将秒杀到商品的用户写入成功集合
              if($this->redisObj->sAdd($sekillDate.'_success_set_'.$seckillInfo['id'],$userId)){
                  //设置秒杀成功用户string 用于检查十五分钟是否付款
                  $this->redisObj->setex($sekillDate.'_success_string_'.$seckillInfo['id']."-".$userId,900,$seckillInfo['id']);
                  //将商品写入购物车
                  $goods=['goods_id'=>$seckillInfo['id'],
                          'user_id'=>$userId,
                          'goods_count'=>1,
                          'flag'=>1,

                    ];

                  return  M('cart')->add($goods);
              }
          }
          $this->error='十分抱歉,秒杀结束';
          return false;
    }

    /**
     * postPaymentUser 将付款用户由秒杀集合转移付款至付款集合
     * @param $goods_ids
     * @param $user_id
     * author :Terry
     * return :
     */
    public function postPaymentUser($goods_ids,$user_id)
    {
        $PaymentKey = $this->seckill_key_px.'_payment_set_';
        foreach ($goods_ids as $goods_id) {
            $this->redisObj->sAdd($PaymentKey.$goods_id ,$user_id );
        }
    }

    /**
     * checkUserPayment Linux定时任务检查用户付款
     *
     * author :Terry
     * return :
     */
    public function cronCheckUserPayment()
    {   //获取今日秒杀商品
        $goodsIds = $this->getTodaySeckill();
        $goodsIds = array_column($goodsIds, 'id');
        foreach ($goodsIds as $goodsId) {
            //获取活的秒杀资格和已付款用的id差集
            $noPaymentUserIds =  $this->redisObj->SDIFF($this->seckill_key_px.'_success_set_'.$goodsId,$this->seckill_key_px.'_payment_set_'.$goodsId);
            foreach ($noPaymentUserIds as $noPaymentUserId) {
                //判断当前用户付款时间15分钟是否到期
                $ttl =    $this->redisObj->ttl($this->seckill_key_px.'_success_string_'.$goodsId."-".$noPaymentUserId);
                if($ttl<=0){
                    //若到期则将该用户移除秒杀集合
                    $this->redisObj->sRem($this->seckill_key_px.'_success_set_'.$goodsId,$noPaymentUserId );
                    //将当前用户购物车中商品清空
                    M('cart')->where(['user_id'=>$noPaymentUserId,'flag'=>1])->delete();
                }
            }
        }

    }


    /**
     * checkStatus 检查秒杀商品状态
     *
     * author :Terry
     * return :
     */
    public function cronCheckStatus(){
        //拼装key前缀
        $todaySeckillKey =$this->seckill_key_px.'_seckillKey';
        //获取今日参加秒杀商品
        $sekicllSets = $this->redisObj->sMembers($todaySeckillKey.'_set');
        //计算商品秒杀时间是否结束
        foreach ($sekicllSets as $val){
            $seckillEndTime = $this->redisObj->hGet($todaySeckillKey.'_hash',$val);
            if (time() >$seckillEndTime){
                $seckillEndIds[] = $val;
            }
        }
        if($seckillEndIds){
            $this->where('id in('.implode(',',$seckillEndIds).')')->setField('flag',1);
        }


    }
    
    /**
     * delTodaySeckill 删除当日秒杀
     *
     * author :Terry
     * return :
     */
    public function  delTodaySeckill(){
        $this->redisObj->del($this->seckill_key_px.'*');
    }
}
