<?php
/**
 * Created by PhpStorm.
 * RoleRuleModel.class.php
 * author: Terry
 * Date: 2017-9-6
 * Time: 11:13
 * description:
 */
namespace Admin\Model;

class RoleRuleModel extends CommonModel{
    protected $fields =['id','role_id','rule_id'];

    /**
     * @disfetch 分配权限
     *
     * @param $role_id 角色id
     * @param $rule_ids权限ids
     *
     * @author : Terry
     * @return
     */
    public  function disfetch($role_id,$rule_ids){
        $this->where(['role_id'=>$role_id])->delete();
        foreach ($rule_ids as $key => $rule_id){
           $ruleInfo[] = [
                          'role_id'=>$role_id,
                          'rule_id'=>$rule_id
                        ];
        }
        return  $this->addAll($ruleInfo);
    }

    /**
     * @getRules获取角色权限
     *
     * @param $role_id角色id
     *
     * @author : Terry
     * @return
     */
    public function getRules($role_id){
      $ruleIds =  $this->where(['role_id'=>$role_id])->select();

//     array_map(function($param){return $param['rule_id'];},$ruleIds);

     return array_column($ruleIds,'rule_id');


    }
}