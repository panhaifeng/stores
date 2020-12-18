<?php
namespace Auth\Controller;
use Common\Controller\CommonController;
class RoleController extends CommonController {
	private $role;
	public function _initialize(){
		parent::_initialize();
		$this->role = new \Auth\Util\AroundValue(M('authGroup'));
		$this->role->tableName = 'auth_group';
		$this->role->fullTableName = 'ykb_auth_group';
		$this->role->field = array('id','title','pid','status','lft','rgt');
	}
	/**
	 * 查询全部角色（岗位）
	 * @蔡斌
	 * @2015-01-07
	 */
    public function index(){
    	$bid = I('bid');
    	$bid = $bid ? $bid : 1;
    	$departments = $this->role->getCategoryList($bid);
    	return $departments;
    }
    /**
     * 保存角色（岗位）
     * @caibin
     * @2014-04-21
     */
    public function update(){
    	$id = I('id');
    	if(!$id){
    		$list = $this->role->insertCategory();
    		if ($list !== false){
    			$this->success('添加成功！',U('Auth/Index/index'));
    		}else{
    			$this->error('添加失败！');
    		}
    	}else{
    		$data['id'] = $id;
    		$data['title'] = I('title');
    		$list = M('authGroup')->save($data);
    		if ($list !== false){
    			$this->success('更新成功！',U('Auth/Index/index'));
    		}else{
    			$this->error("更新失败!");
    		}
    	}
    }
    
    /**
     * 删除角色
     * @caibin
     * @2014-04-15
     */
    public function delete()
    {
    	$map['id'] = I('id');
    	$map['id'] > 1 || $this->error('非法操作！顶级岗位无法删除！');
    	if (!empty($map['id'])){
    		$result = $this->role->deleteCategory($map['id']);
    		if ($result)
    		{
    			//删除权限中间表中的该角色的关联数据
    			M('auth_group_access')->where(array('group_id'=>$map['id']))->delete();
    			$this->success('删除成功！');
    		}else{
    			$this->error('删除失败！');
    		}
    	}else{
    		$this->error("非法操作");
    	}
    }
    
    /**
     * (Ajax)获取当前角色的权限组
     * @caibin
	 * @2015-01-12
     */
    public function access()
    {
    	$groupId = I('id');
    	//查询角色权限
    	$groupAccess = M('auth_group')->getFieldById($groupId,'rules');
    	$access = explode(",",$groupAccess);
    	$this->ajaxReturn($access);
    	
    }

    /**
     * 执行配置权限
     * @caibin
	 * @2014-04-15
     */
    public function setAccess()
    {
    	$map['id'] = I('id');
        $groupAccess = I('post.rules');
        //合并规则id
        $data['rules'] = implode(",",array_values($groupAccess));
        //更新角色规则权限
        $res = M('auth_group')->where($map)->save($data);
        if($res !== false){
            $this->success('授权成功！',U('Auth/Index/index'));
        }else{
            $this->success('授权失败！');
        }
}
}