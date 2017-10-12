<?php
/**
 * Created by PhpStorm.
 * Author: Terry
 * Date: 2017/10/8
 * Time: 10:19
 * description:
 */
namespace Home\Model;

use Think\Model;

class UserModel extends Model{

    /**
     * regist 用户注册
     * @param $username 用户名
     * @param $password密码
     * author :Terry
     * return :
     */
    public function regist($username,$password){
       $info = $this->where(['username'=>$username]) ->find();
        if ($info){
            $this->error='用户名存在';
            return false;
        }
        $salt  = substr(md5(time()),16,6);
        $dbPassword = md5(md5($password).$salt);
        $data = [
          'username'=>$username, 'password'=>$dbPassword,'salt'=>$salt
        ];
        return $this->add($data);

    }

    /**
     * login 用户登录
     * * @param $username 用户名
     * @param $password 密码
     * author :Terry
     * return :
     */
    public function login($username,$password){

        $info = $this->where(['username'=>$username]) ->find();
        if (!$info) {
            $this->error = '用户名不存在';
            return false;
        }
        $pwd = md5(md5($password).$info['salt']);
        if ($pwd !=  $info['password']){
            $this->error='用户名或密码错误';
            return fale;
        }
        //拼接where条件查询会员级别
        $where['jifen_top']=['gt',intval($info['jifen'])];
        $where['jifen_bottom']=['lt',intval($info['jifen'])];
        $levelName =  M('MemberLevel')->where($where)->field('level_name')->find();
        $info['level_name']=$levelName['level_name'];
        session('user',$info);
        session('user_id',$info['id']);
        if (cookie('cart')){
            D('Cart')->cookieGoodsToDb();
        }
        return true;

    }

    /**
     * @addJiFen 增加用户积分
     *
     * @param $jifen
     *
     * @author : Terry
     * @return
     */
    public  function addJiFen($jifen){
        $userId = session('user_id');
        $this->where(['id'=>$userId])->setInc('jifen',floor($jifen));
    }
}