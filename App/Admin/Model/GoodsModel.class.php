<?php
/**
 * Created by PhpStorm.
 * GoodsModel.class.php
 * author: Terry
 * Date: 2017-8-25
 * Time: 18:37
 * description:
 */
namespace Admin\Model;
use Think\Cache\Driver\Redis;
use Think\Upload;

class GoodsModel  extends CommonModel{
protected  $fields = ['id','goods_name','goods_sn','cate_id','market_price','shop_price','goods_img','goods_thumb','goods_body','is_hot','is_rec','is_new','addtime','isdel','is_sale','type_id','goods_number','cx_price','start','end','plcount','sale_number'];

protected $_validate=[
    ['goods_name','require','商品名称必须填写',1],
    ['cate_id','checkCategory','分类必须填写',1,'callback'],
    ['market_price','currency','市场价格格式不对'],
    ['shop_price','currency','本店价格格式不对'],
];

    /**
     * @checkCatrgory 商品分类校验
     * @author : Terry
     * @return
     */
    protected function checkCategory($cate_id){
        $cateId = intval($cate_id);
        if ($cateId>0){
            return true;
        }
        return false;
    }


    public function _before_insert(&$data, $options)
    {
      $data['addtime'] = time();

        //促销商品
      if ($data['cx_price']>0){
          $data['start'] =strtotime($data['start']);
          $data['end'] =strtotime($data['end']);
      }else{
          $data['cx_price']=0.00;
          $data['start']=0;
          $data['end']=0.00;

      }
      if (!$data['goods_sn']){
          $data['goods_sn'] = 'tpshop'.uniqid();

      }else{
          $info = $this->where(['goods_sn'=>$data['goods_sn']])->find();
          if ($info){
              $this->error='货号重复';
              return false;
          }
      }

      /*$upload = new \Think\Upload();
      $goodsInfo = $upload->uploadOne($_FILES['goods_img']);
      if (!$goodsInfo){
          $this->error=$upload->getError();
      }
      $goods_img = 'Uploads/'.$goodsInfo['savepath'].$goodsInfo['savename'];
      $img = new \Think\Image();
      $img->open($goods_img);
      $goods_thumb ='Uploads/'.$goodsInfo['savepath'].'thumb_'.$goodsInfo['savename'];
      $img->thumb(450,450)->save($goods_thumb);*/
      //图片上传优化
        $result =  $this->ImgUpload();
      $data['goods_img'] = $result['goods_img'];
      $data['goods_thumb'] = $result['goods_thumb'];

    }


    public function  _after_insert($data, $options)
    {
        $goodsId   = $data['id'];
        $extCateId = I('post.ext_cate_id');
//        优化
        D('GoodsCate')->insertExtCate($extCateId,$goodsId);
       /* //判断是否有扩展分类 若有进行处理
        if ($extCateId){
            $extCateId = array_unique($extCateId);
            foreach ($extCateId as $key => $val) {
                if ($val != 0) {
                    $list[] = ['goods_id' => $goodsId, 'cate_id' => $val];
                }
            }

            M(GoodsCate)->addAll($list);
        }*/
       //商品属性入库
       D('GoodsAttr')->insertGoodsAttr(I('post.attr'),$goodsId);

        //商品相册
        unset($_FILES['goods_img']);
        $upload = new Upload();
        $info = $upload->upload();
        foreach ($info as $val){
            $goodsImgPath='Uploads/'.$val['savepath'].$val['savename'];
            $img =new \Think\Image();
            $img->open($goodsImgPath);
            $goodsThumb = 'Uploads/'.$val['savepath'].'thumb_'.$val['savename'];
            $img->thumb(100,100)->save($goodsThumb);
            $ImgInfo[] =[
                'goods_id'=>$goodsId,
                'goods_img'=>$goodsImgPath,
                'goods_thumb'=>$goodsThumb
            ];
        }
        if ($ImgInfo){
            M('GoodsImg')->addAll($ImgInfo);
        }

        //处理会员价格
        $memberPrice =I('post.member_price');
        foreach ($memberPrice as $key=>$val){
            $member[] =[
                'goods_id'=>$data['id'],
                'price'=>$val,
                'level_id'=>$key
            ];
        }
        M('MemberPrice')->addAll($member);

    }
        /**
         * @listData 获取商品列表
         * @author   : Terry
         * @return
         */
    public function listData($isdel=1)
        {
            $offset = 5 ;
            $where    = 'isdel='.$isdel;
            $cateId = intval(I('get.cate_id'));
            if($cateId){
                $cateModel =D('Category');
                $treeIds= $cateModel->getChildren($cateId);
                $treeIds[] = $cateId;
                $children = implode(',',$treeIds);
                //扩展分类
                $extGoodsIds =M('GoodsCate')->group('goods_id')->where("cate_id IN ($children)" )->select();

                echo M('GoodsCate')->getLastSql();
                if ($extGoodsIds){
                    $goodsIds = implode(',',array_column($extGoodsIds, 'goods_id'));
                }
                if (!$goodsIds){
                    $where.=" AND cate_id IN($children)";
                }else{
                    $where.=" AND (cate_id IN ($children) OR id IN ($goodsIds))";
                }
            }
            //最新 热销 推荐
            $introType = intval(I('get.intro_type'));
            if ($introType){
                if ($introType = 'is_new' || $introType = 'is_rec' ||$introType = 'is_hot' ){
                    $where .= "AND $introType =1";
                }
            }
            $isSale =intval(I('get.is_sale'));
            if ($isSale ==1){
                $where .="AND is_sale =1";
            }elseif($isSale ==2){
                $where .="AND is_sale =0";
            }
            //关键词搜索
            //后期可用sphinx代替
            $keyWord=I('get.keyword');
            if ($keyWord){
                $where .=" AND goods_name like '%$keyWord%'";
            }
//            dump($where);
            $count    =  $this->where($where)->count();
            $page = new  \Think\Page($count,$offset);
            $show =$page->show();
            $p = intval(I('get.p'));
            $data = $this->where($where)->page($p,$offset)->order('id desc')->select();
//            echo $this->getLastSql();
            return ['page'=>$show,'list'=>$data];
        }

    /**
     * @goodsDel 商品删除
     * @author : Terry
     * @return
     */
    public function setStatus($goodsId,$isdel =0){
          return  $this->where("id=$goodsId")->setField('isdel',$isdel);
        }

    /**
     * @Update 商品修改
     *
     * @param $data 修改信息
     *
     * @author : Terry
     * @return
     */
    public function Update($data){
        $goods_id =$data['id'];
        $goods_sn = $data['goods_sn'];
        //促销商品
        if ($data['cx_price']>0){
            $data['start'] =strtotime($data['start']);
            $data['end'] =strtotime($data['end']);
        }else{
            $data['cx_price']=0.00;
            $data['start']=0;
            $data['end']=0.00;

        }
        //货号
        if (!$goods_sn){
            $data['goods_sn']='tpshop'.uniqid();
        }else{
            $result = $this->where("goods_sn='$goods_sn' AND id != $goods_id")->find();
            if ($result){
                $this->error='货号错误';
                return fasle;
            }
        }

        //扩展分类
        //扩展分类优化

        $extCateModel = M('goodsCate');
        $extCateModel->where("goods_id=$goods_id")->delete();
        $extCateId = array_unique(I('post.ext_cate_id'));


        D('goodsCate')->insertExtCate($extCateId,$goods_id);
//        foreach($extCateId as $key=>$val ){
//            if ($val !=0){
//                $list[] = ['goods_id'=>$goods_id,'cate_id'=>$val];
//            }
//        }
//        $extCateModel->addAll($list);
        //图片处理
       $result =  $this->ImgUpload();
        $data['goods_img']=$result['goods_img'];
        $data['goods_thumb']=$result['goods_thumb'];

        //处理商品属性
        if (M('GoodsAttr')->where(['goods_id'=>$goods_id])->delete()){
            D('GoodsAttr')->insertGoodsAttr(I('post.attr'),$goods_id);
        }

        return $this->save($data);
    }

    /**
     * @ImgUpload 图片处理
     * @author : Terry
     * @return
     */
    protected  function ImgUpload(){
        if (!isset($_FILES['goods_img'])||$_FILES['goods_img']['error'] !=0){
            return false;
        }

        $upload =new  \Think\Upload();
        $info =$upload->uploadOne($_FILES['goods_img']);
        if (!$info){
            $this->error=$upload->getError();
        }
        $goodsImgPath='Uploads/'.$info['savepath'].$info['savename'];
        $img =new \Think\Image();
        $img->open($goodsImgPath);
        $goodsThumb = 'Uploads/'.$info['savepath'].'thumb_'.$info['savename'];
        $img->thumb(450,450)->save($goodsThumb);
        return ['goods_img'=>$goodsImgPath,'goods_thumb'=>$goodsThumb];

    }

    /**
     * @remove 商品徹底删除
     *
     * @param $goods_id
     *
     * @author : Terry
     * @return
     */
    public function  remove($goods_id){

        $goodsInfo = $this->getOneById($goods_id);
        if (!$goodsInfo){
            return fasle;
        }
        unlink($goodsInfo['goods_img']);
        unlink($goodsInfo['goods_thumb']);
        D(goodsCate)->where(['goods_id'=>$goods_id])->delete();
        $this->where(['id'=>$goods_id])->delete();
        return true;
    }

    /**
     * @getGooodAttrs 获取商品属性
     *
     * @param $goods_id 商品id
     *
     * @author : Terry
     * @return
     */
    public function getGooodAttrs($goods_id){
        $attrInfo =M('GoodsAttr')->alias('ga')->field('ga.*,attr.attr_name,attr.attr_type,attr.attr_input_type,attr.attr_value')->join('left join jx_attribute as attr on ga.attr_id=attr.id')->where('ga.goods_id='.$goods_id)->select();
        foreach ($attrInfo as $key =>$value){
            if ($value['attr_input_type'] == 2){
                $attrInfo[$key]['attr_value'] = explode(',',$value['attr_value']);
            }
        }
        foreach ($attrInfo as $val){
            $attrList[$val['attr_id']][] =$val;
        }
        return  $attrList;
    }

    /**
     * getRecGoods 根据关键字返回热卖 最新 新品
     * * @param $type
     * author :Terry
     * return :
     */
    public function getRecGoods($type){

       return    $this->where(['isdel'=>1,"$type"=>1])->limit(5)->order('id desc')->select();

    }

    /**
     * @getCarzyGoods 获得促销商品
     * @author : Terry
     * @return
     */
    public function  getCarzyGoods(){
        $where = "is_sale=1 AND cx_price>0 AND start <".time().' AND end > '.time();
        return $this->where($where)->limit(5)->select();

    }

    /**
     * @getMemberPrice 商品修改时 获取商品会员价格
     *
     * @param $goods_id 商品id
     *
     * @author : Terry
     * @return
     */
    public function getMemberPrice($goods_id){
//        dump($goods_id);
        $member =    M('MemberLevel');
        $memberData = $member->alias('ml')->join('left join __MEMBER_PRICE__ as mp on ml.id=mp.level_id')
            ->where('mp.goods_id='.$goods_id)->select();
//        dump($memberData);
        //若会员价格为空时 设置默认会员价格
        if(intval($memberData[0]['price']) ==0){
           $levelData =  $member->where(['flag'=>1])->select();
           $goodsPrice =  $this->getOneById($goods_id);
           foreach ($levelData as $key => $value){
               $memberData[$key]['price'] = $goodsPrice['shop_price']*($value['level_rate']/100);
           }
        }
        return $memberData;
    }

    /**
     * getGoodsList 前台 获取分类商品列表
     *
     * author :Terry
     * return :
     */
    public function  getGoodsList(){
        $cate_id  =I('get.id');
        $children = D('Admin/Category')->getChildren($cate_id);
        $children[] = $cate_id;
        $cateIds= implode(',', $children);
        $where ="is_sale=1 and  cate_id in ($cateIds)";
        $p=I('get.p');
        $offset = C('OFFSET');
        $count = $this->where($where)->count();
        $page = new  \Think\Page($count,$offset);
        $show = $page->show();
        $sort = I('get.sort') ? I('get.sort') :'sale_number';
        $goodInfo = $this->field('max(shop_price) as max_price,min(shop_price) as min_price,count(id) as goods_count,group_concat(id) goods_ids')->where($where)->find();

        // 8888  200
        if ($goodInfo['goods_count']>1){
            $cha =$goodInfo['max_price']- goodInfo['min_price'];
            //8688
            if ($cha<100){
                $sec=1;
            }elseif ($cha<500){
                $sec=2;
            }elseif ($cha<1000){
                $sec=3;
            }elseif ($cha<5000){
                $sec=4;
            }elseif ($cha<10000){
                $sec=5;
            }else{
                $sec=6;
            }
            $price=[];
            $first =$goodInfo['min_price'];
            $zl=ceil($cha/$sec); //8688/5 ~~1700    ||200~1900 ||1900~3600
            for ($i=0;$i<$sec;$i++){
                $price[] = $first.'-'.($first+$zl);
                $first+=$zl;
            }
        }
        if (I('get.price')){
            $tmp =explode('-',I('get.price'));
            $where.=' and shop_price > '.$tmp[0].' and shop_price < '.$tmp[1];
        }
        $data = $this->where($where)->page($p,$offset)-> order($sort.' desc')->select();
        return  ['show'=>$show,'data'=>$data,'price'=>$price];

    }

    /**
     * @seenGodos 最近浏览过的商品
     *
     * @param $id
     *
     * @author : Terry
     * @return
     */
    public  function  seenGoods($goodsInfo)
    {
        if ($goodsInfo) {
            //判断用户是否登录 若没有登录获取ip转为整形组建key值,若登录使用用户id组建key值
            if (session('user_id')) {
                $seenGoodsKey = 'seenGoods_' . session('user_id');
            } else {
                $seenGoodsKey = 'seenGoods_' . ip2long(getIP());
            }
            $seenGoodsInfo = $goodsInfo['id'] . ',' . $goodsInfo['goods_name'] . ',' . $goodsInfo['goods_thumb'];
            $reids = new \Redis();
            $reids->connect(C('REDIS_HOST'),C('REDIS_PORT'));
            $goodsCount = $reids->ZCARD($seenGoodsKey);

            if ($goodsCount > 5) {
                $reids->ZREMRANGEBYRANK($seenGoodsKey, 0, 1);
            }
            $reids->ZADD($seenGoodsKey, time(), $seenGoodsInfo);
            return $seenGoodsKey;

        }
    }

}









































