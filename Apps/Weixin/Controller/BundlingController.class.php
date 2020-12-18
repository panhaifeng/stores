<?php
namespace Weixin\Controller;
use Think\Controller;
class BundlingController extends Controller {
	/**
	 * 初始化
	 * @caibin
	 * @2014-04-22
	 */
	Public function _initialize(){
		$this->jumpUrl = $_SESSION['jumpUrl'];
	}
	/**
	 * 绑定微信页面
	 */
    public function index(){
    	$w = date('w',time());
    	$this->w = C('WEEKDAYS.'.$w);
    	$this->display();
    }
    /**
     * 绑定操作
     */
    public function bundling(){
    	//判断是否是提交操作
    	if(!IS_POST)$this->error('非法操作');
    	//后台验证
    	$pwd = md5(I('password'));
    	$map['user_name'] = I('user_name');
    	$adminInfo = M('user')->where($map)->find();
    	if(!$adminInfo || $adminInfo['password'] != $pwd){
    		$this->error('账号或密码错误');
    	}
    	$adminInfo['status'] == 1 || $this->error('账号被关闭');
    	$adminInfo['isLock'] == 0 || $this->error('账号被锁定');
    	//绑定微信账号
    	$weixinInfo = array(
    		'id' => $adminInfo['id'],
    		'user_id' => I('user_id'),
    		'device_id' => I('device_id')
    	);
    	$bundlingStatus = M('user')->save($weixinInfo);
    	$bundlingStatus || $this->error('绑定失败，请联系系统管理员!');
    	//保存SESSION
    	session(C('USER_AUTH_KEY'),$adminInfo['id']);
    	session('user_name',$adminInfo['user_name']);
    	session('real_name',$adminInfo['real_name']);
    	session('DeviceId',$weixinInfo['device_id']);
    	//超级管理员识别
    	if($adminInfo['user_name'] == C('RBAC_SUPERADMIN')){
    		session(C('ADMIN_AUTH_KEY'),TRUE);
    	}
    	//邦定成功之后跳转
    	$this->redirect($this->jumpUrl);
    }
    /**
     * 根据登陆信息生成数据查询条件，存数SESSION
     * @蔡斌
     * @2014-10-19
     */
    Public function getMaps($adminInfo){
    	if(!$_SESSION[C('ADMIN_AUTH_KEY')]){
    		//生成数据查看权限。
    		//查询当前用户全部角色ID
    		$role = M('auth_group_access')->where(array('uid'=>$adminInfo['id']))->field('group_id')->select();
    		foreach ($role as $v ){
    			//查询当前角色子角色
    			$temp = $this->objRole->getPositionList($v['group_id']);
    
    			foreach ($temp as $vv){
    				if($vv['id'] != $v['group_id']){
    					$temp_son[] = $vv;
    				}
    			}
    			foreach ($temp_son as $value) {
    				$temp_roles[] = $value['id'];
    				$temp_depList[] = $this->objCG->getCategoryList($value['bid']);
    				foreach ($temp_depList as $v){
    					foreach ($v as $vs){
    						$temp_deps[] = $vs['id'];
    					}
    				}
    			}
    		}
    		$temp_roles = array_unique($temp_roles);
    		$temp_deps = array_unique($temp_deps);
    		foreach ($temp_roles as $v) {
    			foreach ($role as $val){
    				if($v != $val['group_id']){
    					$temp_role .= $v.",";
    				}
    			}
    		}
    		$temp_role = rtrim($temp_role, ",");
    		foreach ($temp_deps as $v) {
    			$temp_dep .= $v.",";
    		}
    		$temp_dep = rtrim($temp_dep, ",");
    		//限制部门，此处条件有错误
    		//$where['a.bid'] = array('in',$temp_dep);
    		$where['b.group_id'] = array('in',$temp_role);
    		$userIds = M('user a')
    		->join('ykb_auth_group_access b ON a.id = b.uid')
    		->field('a.*')
    		->where($where)->select();
    			
    		foreach ($userIds as $v ){
    			$tempIds[] = $v['id'];
    		}
    		$tempIds = array_unique($tempIds);
    		foreach ($tempIds as $v ){
    			$tempId .= $v.",";
    		}
    	}else{
    		$userIds = M('user')->field('id')->select();
    		foreach ($userIds as $v ){
    			$tempId .= $v['id'].",";
    		}
    	}
    	if(!$tempId){
    		$tempId = $adminInfo['id'];
    	}
    	return array('in',rtrim($tempId, ","));
    }
}