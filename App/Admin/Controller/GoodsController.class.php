<?php
/**
 * Created by PhpStorm.
 * GoodsController.class.php
 * author: Terry
 * Date: 2017-8-25
 * Time: 17:12
 * description:
 */
namespace Admin\Controller;

class GoodsController extends CommonController{
    /**
     * @goodsAdd 商品添加
     * @author : Terry
     * @return
     */
   public function goodsAdd(){
        if (IS_GET){
            $type = D('Type')->select();
            $this->assign('type',$type);
            $categroy= D('category');
            $cate =  $categroy->getCateTree();
            $memberLevel  =D('MemberLevel')->order('id')->where(['falg'=>1])->select();
            $this->assign('memberLevel',$memberLevel);
            $this->assign('cate',$cate);
            $this->display();
            exit();
        }
        $goods=D('goods');
//       dump(I('post.'));
        $data = $goods->create();
//       dump($data);exit();
        if (!$data){
            $this->error($goods->getError());
        }
        $goodsId = $goods->add($data);
        if (!$goodsId){
            $this->error($goods->getError());
        }
        $this->success('添加成功',U('goodsList'));
    }

    /**
     * @goodsList 商品列表
     * @author : Terry
     * @return
     */
   public function goodsList(){

        $cate =D('Category')->getCateTree();
        $this->assign('cate',$cate);
        $goods = D('goods');
        $listInfo = $goods->listData();
        $this->assign('listInfo',$listInfo);
        $this->display();

    }

    /**
     * @goodsDels 商品删除
     * @author : Terry
     * @return
     */
   public function goodsDels(){
        $godosId =intval(I('get.goods_id'));
        if ($godosId<=0){
            $this->error('参数错误');
        }
        $goods =D('Goods');
        $result = $goods->setStatus($godosId);
        if ($result == false){
            $this->error($goods->getError());
        }
            $this->success('删除成功');

    }

    /**
     * @goodsEdit 商品修改
     * @author : Terry
     * @return
     */
   public function goodsEdit(){
        $goodsId = intval(I('get.goods_id'));
        $goods =  D('Goods');
        if (IS_GET){
            $goodsInfo = $goods->getOneById($goodsId);
            if (!$goodsInfo){
                $this->error('参数错误');
            }
            //主分类
            $category =  D('Category');
            $cate = $category->getCateTree();
            //扩阵分类
            $extGoodsIds =  M('GoodsCate')->where('goods_id='.$goodsId)->select();
            if (!$extGoodsIds){
                $extGoodsIds = ['msg'=>'no data'];
            }
            //获取所有分类
            $type= D('Type')->select();
            $this->assign('type',$type);
            //获取商品属性
            $attrInfo =  $goods->getGooodAttrs($goodsId);
            $this->assign('attrInfo',$attrInfo);
            $this->assign('extGoodsIds',$extGoodsIds);
            $this->assign('cate',$cate);
            $goodsInfo['goods_body']= htmlspecialchars_decode($goodsInfo['goods_body']);
            $this->assign('goodsInfo',$goodsInfo);
            $goodImgPic = M('GoodsImg')->where(['goods_id'=>$goodsId])->field('id,goods_thumb')->select();
            $this->assign('goodsImg',$goodImgPic);
            //会员价格
            $member = $goods->getMemberPrice($goodsId);
            $this->assign('member',$member);
            $this->display();
        }else{
           $data =  $goods->create();
           if (!$data){
                $this->error($goods->getError());
           }
           $result = $goods->update($data);
           if ( $result == false){
               $this->error($goods->getError());
           }
           $this->success('修改成功',U('goodsList'));

        }

    }

    /**
     * @trash 商品回收站
     * @author : Terry
     * @return
     */
   public  function trash(){
       $cate =  D('Category')->getCateTree();
       $this->assign('cate',$cate);
       $goods = D('goods');
       $listInfo=$goods->listData(0);
       $this->assign('listInfo',$listInfo);
       $this->display();
   }

    /**
     * @recover 商品还原
     * @author : Terry
     * @return
     */
   public function recover(){
       $goodsId = intval(I('get.goods_id'));
       $goods=D('Goods');
       $result = $goods->setStatus($goodsId,1);
       if ($result ===fasle){
           $this->error('还原失败');
       }
       $this->success('还原成功');
   }

    /**
     * @remove  彻底删除
     * @author : Terry
     * @return
     */
   public function remove(){
       $goodsId =intval(I('get.goods_id'));
       if ($goodsId<=0){
           $this->error('参数错误');
       }
       $goods=D('Goods');
       $result =$goods->remove($goodsId);
       if ($result ===fasle){
           $this->error('删除失败');
       }
       $this->success('删除成功');
   }

    /**
     * @showAttr 商品属性
     * @author : Terry
     * @return
     */
   public function showAttr(){
       if (IS_AJAX){
           $typeId = intval(I('post.type_id'));
           if ($typeId<=0){
               exit('参数错误');
           }
           $data =D('Attribute')->where(['type_id'=>$typeId])->select();

            foreach ($data as $key=>$val){
                if ($val['attr_input_type']==2){
                    $data[$key]['attr_value']= explode(',',$val['attr_value']);
                }
            }
            $this->assign('data',$data);
            $this->display();

       }
   }

    /**
     * @delGoodsImg 删除商品图片
     * @author : Terry
     * @return
     */
   public function  delGoodsImg(){
       $imgId = intval(I('post.img_id'));
       $goodsImg =  M('GoodsImg');
       $imgInfo =  $goodsImg->where(['id'=>$imgId])->find();
        if (!$imgInfo){
            $this->ajaxReturn(['status'=>200,'msg'=>'参数错误']);
        }
        unlink($imgInfo['goods_img']);
        unlink($imgInfo['goods_thumb']);
      if ($goodsImg->where(['id'=>$imgId])->delete()){
          $this->ajaxReturn(['status'=>200,'msg'=>'删除成功']);
      }
    }

    /**
     * @setNumber 设置商品库存
     * @author : Terry
     * @return
     */
   public function setNumber(){
       if (IS_GET){
           $goodsId =intval(I('get.goods_id'));
           $goodsAttrInfo = D('GoodsAttr')->getSigleAttr($goodsId);
           //该商品没有单选属性
           if (!$goodsAttrInfo){
               //没有单选属性
               $currentGoodsNum = M('goods')->field('goods_number')->where(['id'=>$goodsId])->find();
               $this->assign('goodsNumberInfo',$currentGoodsNum);
               $this->display('nosigle');
               exit;
           }
           //单选属性
           $currentGoodsNum = M('GoodsNumber')->where(['goods_id'=>$goodsId])->select();
           if (!$currentGoodsNum){
               $currentGoodsNum['goods_number']=0;
           }
           $this->assign('goodsNumberInfo',$currentGoodsNum);
           $this->assign('attr',$goodsAttrInfo);
           $this->display();
       }else{
        $attr = I('post.attr');
        $goodsNumber = I('post.goods_number');
        $goodsId = I('post.goods_id');
        // 若没有单选属性
        if ($attr) {
            foreach ($goodsNumber as $key => $value) {
                $tmp = [];
                foreach ($attr as $k => $val) {
                    $tmp[] = $val[$key];
                }
                $goodsAttrIds = implode(',', $tmp);
                //数据排序
                sort($tmp);
                $has = [];
                if (in_array($goodsAttrIds, $has)) {
                    unset($value[$key]);
                    continue;
                }
                $has[]  = $goodsAttrIds;
                $list[] = [
                    'goods_id'       => $goodsId,
                    'goods_attr_ids' => $goodsAttrIds,
                    'goods_number'   => $value
                ];
            }
            $godosNum = M('GoodsNumber');
            //删除原有库存
            $godosNum->where(['goods_id' => $goodsId])->delete();
            //更新库存
            $godosNum->addAll($list);
            //计算当前库存总和
            $goodsNumber = array_sum($goodsNumber);
        }
           //更新商品库存
          $addGoodsNumber = M('Goods')->where(['id'=>$goodsId])->setField('goods_number',$goodsNumber);
        if ($addGoodsNumber){
            $this->success('库存写入成功',U('goodsList'));
        }
       }
   }





}