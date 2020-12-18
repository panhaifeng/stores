<?php
namespace Auth\Controller;
use Common\Controller\CommonController;
class UserController extends CommonController {
	/**
	 * 根据部门查询用户
	 * @蔡斌
	 * @2015-01-08
	 */
	public function getUserByDepartment($bid,$field="*"){
		$map['id'] = array('gt',1);
		if($bid)$map['bid'] = $bid;
		return D('User')->relation(true)->field($field)->where($map)->select();
	}
	/**
	 * 根据岗位查询用户
	 * @蔡斌
	 * @2015-01-22
	 */
	public function getUserByPosition($pid,$field="*"){
		$res = M('authGroupAccess')->where(array('group_id'=>$pid))->getField('uid',true);
		$map['id'] = array('in',$res);
		return D('User')->relation(true)->field($field)->where($map)->select();
	}
    /**
     * 用户重置密码
     * @caibin
     * @2014-06-09
     */
    public function resetPassword(){
    	$this->display();
    }
    
    public function resetPasswordHandle(){
    	$map['id'] = $_SESSION['uid'];
    	$admin = M('user')->where($map)->find();
    	$old_password = $admin['password'];
    	if($old_password != md5(I('old_password'))){
    		$this->error('原密码错误');
    	}
    	$data['id'] = $_SESSION['uid'];
    	$data['password'] = md5(I('new_password'));
    	$res = M('user')->save($data);
    	if($res){
    		$this->success('密码修改成功',U('Home/Login/index'));
    	}else {
    		$this->error('密码修改失败');
    	}
    }
    
    /**
     * 添加用户
     * @caibin
	 * @2014-04-15
     */
    public function update()
    {
    	$id = I('id');
    	$User = D('User');
    	$data = $User->create($_POST);
    	//获取角色
    	$position = I('position');
        $store = I('store');
    	if (!$User->create(I('post.'))){ 
	    	$this->error($User->getError());
	    }else{
	    	if(!$id){
	    		$result = $User->add($data);
	    		$id = $User->getLastInsID();
	    		$res = $this->setRole($position,$id);
                //保存用户和店铺的关系
                $this->setStoreWithUser($store,$id);
	    	    $res ? $this->success('添加成功',U('Auth/Index/index')):$this->error('添加失败');
	    	}else{
	    		$data->utime = time();
	    		//如果密码为空则不修改密码
	    		if ($data['password']==null) {
	    			unset($data['password']);
	    		}
	    		$result = $User->save($data);
	    		$res = $this->setRole($position,$id);
                $this->setStoreWithUser($store,$id);
	    		$res ? $this->success('编辑成功',U('Auth/Index/index')):$this->error('编辑失败');
	    	}
	    }
	}
    /**
     * 删除用户
     * @caibin
     * @2014-04-15
     */
    public function delete()
    {
    	if(I('id') != 1){
        	$map['id'] = I('id');
        	$res = D('User')->relation(true)->where($map)->delete();
	    	if($res){
				$status = array (
						'success' => true,
						'mgs'=>'删除成功！'
				);
				$this->ajaxReturn($status);
	    	}
        }else{
        	$this->error('非法操作！');
        }
        
    }
    /**
     * 设置用户角色
     * @param string $info 角色数组
     * @param string $uid 用户ID
     * @蔡斌
     * @2015-01-09
     */
    public function setRole($info,$uid){
    	//删除原有角色信息,如果是管理员
    	M('auth_group_access')->where(array('uid'=>$uid))->delete();
    	//循环处理角色ID和用户ID关系
    	foreach ($info as $k=>$v){
    		$access[$k]['uid'] = $uid;
    		$access[$k]['group_id'] = $v;
    	}
    	//重新添加用户角色关联表信息
    	return  M('auth_group_access')->addAll($access);
    }

    public function setStoreWithUser($info,$uid){
        //删除原有的信息
        M('auth_store')->where(array('uid'=>$uid))->delete();
        foreach ($info as $key => &$value) {
            $access[$key]['uid'] = $uid;
            $access[$key]['storeId'] = $value;
        }
        //dump($access);die;
        //重新添加角色关联表信息
        return M('auth_store')->addAll($access);
    }
    
    /**
     * (Ajax)查询用户当前信息
     * @caibin
     * @2014-11-08
     */
    public function getUserInfo(){
    	$map = I('post.');
    	$res = D('User')->relation(true)->where($map)->find();
        $stores = M('auth_store')->where(array('uid'=>$res['id']))->select();
        $res['store'] = $stores;
    	$this->ajaxReturn($res);
    }
    /**
     * (Ajax)管理员授权用户组处理
     * @caibin
     * @2014-11-08
     */
    public function setGroup(){
    	$map = I('post.');
    	$res = M('auth_group_access')->where($map)->delete();
    	if($res){
    		$status = 0;
    		$this->ajaxReturn($status);
    	}else{
    		M('auth_group_access')->add($map);
    		$status = 1;
    		$this->ajaxReturn($status);
    	}
    }
    /**
     * 锁定用户
     * @caibin
     * @2014-04-23
     */
    public function changeUserLockStatus()
    {
    	
    	$map['id'] = I('id');
    	$statu = I('status');
    	$statu == "1" ? $statu = 2 : $statu=1;
    	$res=M('user')->where($map)->setField('status',$statu);
    	if($res>0){
    		$status = array (
    				'success' => true,
    				'msg' => "操作成功",
    		);
    		$this->ajaxReturn($status);
    	}
    }
}