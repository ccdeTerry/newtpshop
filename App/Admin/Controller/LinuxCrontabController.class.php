<?php
/**
 * Created by PhpStorm.
 * Author: Terry
 * Date: 2017/11/7
 * Time: 21:35
 * description: linux 定时任务
 */

namespace  Admin\Controller;
use Think\Controller;

class LinuxCrontabController extends Controller{

    /**
     * checkSeckill linux 定时任务检查秒杀是否结束
     *定时任务: ＊　＊　＊　＊　＊　curl http://域名/admin/LinuxCrontab/checkSeckill
     * author :Terry
     * return :
     *
     */
    public  function checkSeckill(){
        D('SeckillGoods')->cronCheckStatus();
    }

    /**
     * delTodaySeckill 删除当日秒杀信息
     *定时任务: 59　23　＊　＊　＊　curl http://域名/admin/LinuxCrontab/delTodaySeckill
     * author :Terry
     * return :
     */
    public  function delTodaySeckill(){
        D('SeckillGoods')->delTodaySeckill();
    }

    /**
     * cronCheckUserPayment 检测未付款用户
     * 定时任务 * 6-23 * * *  curl http://域名/admin/LinuxCrontab/cronCheckUserPayment
     *
     * author :Terry
     * return :
     */
    public function cronCheckUserPayment()
    {
        D('SeckillGoods')-> cronCheckUserPayment();
    }
}