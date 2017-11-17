<?php
namespace Admin\Model;
use Think\Model;

/**
 * Class MemberLevelModel 会员级别模型
 *
 * @package Admin\Model
 * @anthor  Terry
 *
 */
class MemberLevelModel extends Model 
{
	protected $insertFields = array('level_name','jifen_bottom','jifen_top','level_rate');
	protected $updateFields = array('id','level_name','jifen_bottom','jifen_top','level_rate');
	protected $_validate = array(
		array('level_name', 'require', '级别名称不能为空！'),
		array('level_rate', 'require', '折扣率不能为空！'),
		array('jf_bottom', 'require', '积分下限不能为空！'),
		array('jf_top', 'require', '积分下限不能为空！'),
	);

    /**
     * @getMemberLeve 根据会员积分  获取会员价格
     *
     * @param $userInfo 用户信息
     *
     * @author : Terry
     * @return
     */
    public function getMemberLevel($goods_id,$userInfo){
        //拼接条件
		$where['ml.jifen_top']=['gt',intval($userInfo['jifen'])];
		$where['ml.jifen_bottom']=['lt',intval($userInfo['jifen'])];
		if (is_array($goods_id)){
			$goodsIds = implode(',', $goods_id);
            $where['mp.goods_id']=['in',$goodsIds];
		}else{
			$where['mp.goods_id']=$goods_id;
		}
        //查出会员则扣率
        $memberData = M('MemberLevel')->alias('ml')->join('left join jx_member_price as mp on ml.id=mp.level_id')
            ->where($where)->select();
        //商品中可能会存在无会员价格商品
		foreach ($memberData as $key=>$value){
		    //若数组中商品价格小于0 说明该商品为设置会员价格 则通过默认折扣率计算新价格
            if (intval($value['price'])<= 0 ){
                $goodsPrice =  D('Goods')->field('shop_price')->find($goods_id);
                $memberData[$key]['price'] = ($value['level_rate']/100)*$goodsPrice['shop_price'];
            }
        }
//        dump($memberData);
		//转换会员价格 若小于等于0 说明没有填写会员价格 使用默认折扣率
        return $memberData;
    }






	// 添加前 add()
	protected function _before_insert(&$data, $option)
	{


//        table' => string 'sp_member_level' (length=15)
//                  'model' => string 'memberLevel' (length=11)
	}
	protected function _after_insert($data, $option)
	{


//        table' => string 'sp_member_level' (length=15)
//                  'model' => string 'memberLevel' (length=11)
	}
	// 修改前
	protected function _before_update(&$data, $option)
	{

	    /*var_dump($option);
        'table' => string 'sp_member_level' (length=15)
                  'model' => string 'memberLevel' (length=11)
                  'where' =>
                        array (size=1)
                             'id' => int 8*/
	}
	// 修改前
	protected function _after_update($data, $option)
	{


	    /*var_dump($option);
        'table' => string 'sp_member_level' (length=15)
                  'model' => string 'memberLevel' (length=11)
                  'where' =>
                        array (size=1)
                             'id' => int 8*/
	}
	// 删除前
	protected function _before_delete($option)
	{
		if(is_array($option['where']['id']))
		{
//		    'id' => int 8
			$this->error = '不支持批量删除';
			return FALSE;
		}
	}
	/************************************ 其他方法 ********************************************/
}