<?php
namespace Auth\Controller;
use Common\Controller\CommonController;
class IndexController extends CommonController {
	private $dep;
	public function _initialize(){
		parent::_initialize();
		$this->dep = new \Auth\Util\AroundValue(M('department'));
		$this->dep->tableName = 'department';
		$this->dep->fullTableName = 'ykb_department';
		$this->dep->field = array('id','name','status','lft','rgt');
	}
	/**
	 * 组织架构
	 * @2015-01-06
	 * @蔡斌
	 */
    public function index(){
    	$bid = I('id'); 
    	$pid = I('pid');
    	$departments = $this->dep->getCategoryList(1);
    	$positions = M('authGroup')->field('id,title,bid,pid')->select();
    	foreach ($departments as & $v){
    		$v['child'] = "";
    		foreach ($positions as $val){
    			if($val['bid'] == $v['id']){
    				$v['child'][] = $val;
    			}
    		}
    	}
    	$this->departments = $departments;
    	if($pid){
    		$this->users = R('User/getUserByPosition',array($pid));
    	}else{
    		$this->users = R('User/getUserByDepartment',array($bid));
    	}
        $arrs = $this->users;
        foreach ($arrs as $key => &$value) {
           $value['store'] = M('auth_store')->where(array('uid'=>$value['id']))->select();//显示页面显示店铺
        }
        $this->users = $arrs;
    	
    	//查询全部岗位（有样式）
    	$roles = R('Role/index');
    	$this->roles = $roles;
        $this->store = $stores = C('store');
    	foreach ($roles as $role){
    		$role_name[$role['id']] = $role['title'];
    	}
        foreach ($stores as $ke => &$vall) {
            $store_name[$ke] = $vall; 
        }
        // dump($roles);die;
    	$this->role_name = $role_name;
        $this->store_name = $store_name;
    	//查询全部节点
    	$navs = C('MENU');
    	$nodes = C('RULE');
    	foreach ($navs as $k=>&$nav){
    		foreach ($nodes as $node){
    			if($k == $node['pid']){
    				$nav['child'][] = $node;
    			}
    		}
    	}
    	$this->navs = $navs;
    	$this->display(); 	
    }
    /**
     * 保存部门
     * @蔡斌
     * @2015-01-06
     */
    public function update(){
    	$id = I('id');
    	if(!$id){
    		$list = $this->dep->insertCategory();
    		if ($list !== false)
    		{
    			$this->success('添加成功！',U('Auth/Index/index'));
    		}
    		else
    		{
    			$this->error('添加失败！');
    		}
    	}else{
    		$data['id'] = $id;
    		$data['name'] = I('name');
    		$list = M('department')->save($data);
    		if ($list !== false)
    		{
    			$this->success('更新成功！',U('Auth/Index/index'));
    		}
    		else
    		{
    			$this->error("更新失败!");
    		}
    	}
    }
    /**
     * 删除部门：操作
     * @caibin
     * @2015-01-07
     */
    public function delete(){
    	$mapbid['bid']=$map['id']=$id= I('id');
    	$id > 1 || $this->error('非法操作！顶级部门无法删除！');
    	//判断是否有子部门
    	$depart=M('department')->where($map)->field('lft,rgt')->find();
    	$depId=$depart['rgt']-$depart['lft'];
    	//判断部门下是否由岗位
    	$group=M('auth_group')->where($mapbid)->field('id')->count();
    	if ($depId>1 || $group >0) {
    		$this->error('非法操作');
    	}else{
    		//如果没有则删除该部门
    		$result = $this->dep->deleteCategory($id);
    		if ($result)
    		{
    			$this->success('删除成功！');
    		}
    		else
    		{
    			$this->error('删除出错！');
    		}
    	} 
    }
}