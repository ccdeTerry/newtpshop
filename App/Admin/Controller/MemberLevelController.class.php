<?php
namespace Admin\Controller;
use Think\Controller;
class MemberLevelController extends Controller 
{
    public function add()
    {
    	if(IS_POST)
    	{
    		$model = D('MemberLevel');
    		if($model->create(I('post.'), 1))
    		{
    			if($id = $model->add())
    			{
    				$this->success('添加成功！', U('lst'));
    				exit;
    			}
    		}
    		$this->error($model->getError());
    	}

		// 设置页面中的信息
		$this->display();
    }
    public function edit()
    {
    	$id = I('get.id');
    	if(IS_POST)
    	{
    		$model = D('MemberLevel');
    		if($model->create(I('post.'), 2))
    		{
    			if($model->save() !== FALSE)
    			{
    				$this->success('修改成功！', U('lst'));
    				exit;
    			}
    		}
    		$this->error($model->getError());
    	}
    	$model = M('MemberLevel');
    	$data = $model->find($id);
    	$this->assign('data', $data);

		$this->display();
    }
    public function delete()
    {
    	$model = D('MemberLevel');
    	if($model->delete(I('get.id', 0)) !== FALSE)
    	{
    		$this->success('删除成功！', U('lst'));
    		exit;
    	}
    	else 
    	{
    		$this->error($model->getError());
    	}
    }
    public function lst()
    {
    	$model = D('MemberLevel');
    	$data = $model->select();

    	$this->assign('data',$data);
    	$this->display();
    }


}