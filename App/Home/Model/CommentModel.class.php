<?php
/**
 * Created by PhpStorm.
 * Author: Terry
 * Date: 2017/10/11
 * Time: 13:31
 * description:
 */
namespace  Home\Model;

use Think\Model;

class CommentModel  extends  Model{
    protected  $fields=['id','goods_id','user_id','addtime','content','star','goods_number'];

    protected function _before_insert(&$data){
        $data['addtime']=time();
        $data['user_id']=session('user_id');
    }

    /**
     * getCommentList 获取评论列表
     * * @param $goods_id 商品ID
     * author :Terry
     * return :
     */
    public  function  getCommentList($goods_id){
        $p=intval(I('p'));
        $offset = C('OFFSET');
        $count = $this->where(['goods_id'=>$goods_id])->count();
        $page= new \Think\Page($count,$offset);
        $page->setConfig('is_anchor', true);
        $show= $page->show();

        $data=$this->alias('c')->field('c.*,u.username')->join('left join __USER__ as u on u.id=c.user_id')->where(['goods_id'=>$goods_id])->order('addtime desc')->page($p,$offset)->select();
        return ['show'=>$show,'data'=>$data];

    }

    public function _after_insert($data){
        $impression = M('Impression');
        $old = I('post.old');
        foreach($old as $key=>$val){
            $impression->where(['id'=>$val])->setInc('count');
        }
        $name = I('post.user_tag');

        $name=array_unique(explode(',',$name ));
        foreach ($name as $key=>$value){
            if (!$value){
                continue;
            }
            $where = ['goods_id'=>$data['goods_id'],'name'=>$value];
           $result =  $impression->where($where)->find();
            if ($result){
                $impression-> where($where)->setInc('count');
            }else{
                $where['count']=1;
                $impression->add($where);
            }
        }
        M('Goods')->where(['id'=>$data['goods_id']])->setInc('plcount');

    }
}