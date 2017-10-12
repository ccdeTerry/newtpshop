<?php
/**
 * Created by PhpStorm.
 * AdminModel.class.php
 * author: Terry
 * Date: 2017-9-5
 * Time: 14:30
 * description:
 */
namespace Admin\Model;

class AdminModel extends CommonModel{
    protected $field=['id','username','password','salt'];
    protected $_validate=[
        ['username','require','用户名必须填写'],
        ['username','','用户名不能重复',1,'unique'],
        ['password','require','用户密码必须填写'],
        ['password','passwd','确认密码不正确',0,'confirm'],
        ['role_id','require','角色必须选择'],
    ];
    protected $_auto=[
        ['create_time','time',1,'function'],
        ['update_time','time',2,'function'],
    ];

    /**
     * @_after_insert 后置钩子函数
     *
     * @param $data
     * @param $options
     *
     * @author : Terry
     * @return
     */
    protected function _after_insert($data, $options)
    {
        $adminRoleInfo = [
          'admin_id'=>$data['id'],
          'role_id'=>I('post.role_id')
      ];
      M('AdminRole')->add($adminRoleInfo);
    }

    /**
     * @_before_insert 前置钩子函数
     *
     * @param $data
     * @param $options
     *
     * @author : Terry
     * @return
     */
    protected  function _before_insert(&$data, $options)
    {
        $data['salt'] =substr(md5(time()),16,8);
        $data['password']=md5(I('post.password').$data['salt']);
    }


    /**
     * @listData 管理员列表
     * @author : Terry
     * @return
     */
    public function listData(){
        $offset =5;
        $count = $this->count();
        $page =new \Think\Page($count,$offset);
        $show =$page->show();
        $p =intval(I('get.p'));
        $list= $this->alias('a')->field("a.*,r.role_name")->join('left join jx_admin_role b on a.id=b.admin_id')->join('left join jx_role as r on b.role_id=r.id')->page($p,$offset)->select();
        return ['page'=>$show,'list'=>$list];
    }

    /**
     * @remove 删除管理员
     *
     * @param $admin_id
     *
     * @author : Terry
     * @return
     */
    public function remove($admin_id){
        //开启事务
        $this->startTrans();
        $userStatus =  $this->where(['id'=>$admin_id])->delete();
        if (!$userStatus){
            $this->rollback();
            $this->error='管理员删除失败,请与系统管理员联系';
            return false;
        }
        $roleStatus =M('AdminRole')->where(['admin_id'=>$admin_id])->delete();
        if (!$roleStatus){
            $this->rollback();
            $this->error='管理员权限无法删除请与管理员联系';
            return false;
        }
        $this->commit();
        return true;
    }

    /**
     * @findOne 连表查询获取一条数据
     * @author : Terry
     * @return
     */
    public function findOne($admin_id){
        return $this->alias('a')->field("a.*,b.role_id")->join("left join jx_admin_role as b on a.id=b.admin_id")->where("a.id=$admin_id")->find();
    }

    /**
     * @update 修改管理员
     *
     * @param $data
     *
     * @author : Terry
     * @return
     */
    public function update($data){
        $this->startTrans();
        $roleId = intval(I('post.role_id'));
        if (!$this->save($data)){
            $this->rollback();
            $this->error='管理员信息修改失败';
            return false;
        }
       $adminRoleStatus = M('AdminRole')->where(['admin_id'=>$data['id']])->save(['role_id'=>$roleId]);
        if(!$adminRoleStatus){
            $this->rollback();
            $this->error='管理员权限修改失败';
            return false;
        }
        $this->commit();
        return true;
    }

    /**
     * @checkLogin 用户登录校验
     *
     * @param $username 用户名
     * @param $password 用户密码
     *
     * @author : Terry
     * @return
     */
    public function checkLogin($username,$password){
        $userInfo = $this->where(['username'=>$username])->find();
        if (!$userInfo){
            $this->error='用户名不存在';
            return false;
        }
         $postPasswd = md5(md5($password).$userInfo['salt']);
        if ($userInfo['password']!=$postPasswd){
            $this->error='密码错误';
            return false;
        }
        session('admin',$userInfo);
        return true;
    }
}



