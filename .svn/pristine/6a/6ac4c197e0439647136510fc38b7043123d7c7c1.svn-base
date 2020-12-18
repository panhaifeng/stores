<?php
namespace Home\Controller;
use Think\Controller;
class LoginController extends Controller {
	private $role;
	private $dep;
	/**
	 * 初始化
	 * @caibin 
	 * @2014-04-22
	 */
	Public function _initialize(){
		//判断浏览器的版本。为了获得更好的用户体验。建议使用IE9+。火狐，谷歌浏览器运行
		if(strpos($_SERVER["HTTP_USER_AGENT"],"MSIE 6.0") || strpos($_SERVER["HTTP_USER_AGENT"],"MSIE 7.0")  || strpos($_SERVER["HTTP_USER_AGENT"],"MSIE 8.0")){
           $this->display('./Public/tpl/browser.html');die;
	    }
	    $this->role = new \Auth\Util\AroundValue(M('authGroup'));
	    $this->role->tableName = 'auth_group';
	    $this->role->fullTableName = 'ykb_auth_group';
	    $this->role->field = array('id','title','pid','status','lft','rgt');
	    
	    $this->dep = new \Auth\Util\AroundValue(M('department'));
		$this->dep->tableName = 'department';
		$this->dep->fullTableName = 'ykb_department';
		$this->dep->field = array('id','name','status','lft','rgt');
	}
	/**
	 * 登陆界面
	 * @caibin
	 * @2014-04-15
	 */
    public function index(){
		$_login_Ip = 'http://sev1.eqinfo.com.cn/login_server';
		$_outTime = '3';
		$_Url = str_replace(PHP_EOL, '',$_login_Ip);
		//设置超时时间
		$context['http'] = array(
			'timeout'=>$_outTime > 0 ? $_outTime : 3,
			'method' => 'POST'
    	);
		$json = file_get_contents($_Url, false, stream_context_create($context));
		$_l = json_decode($json,true);
		if($_l['success']){
			$login = $_l['config'];
		}else{
			$login['bg']='http://yikebao.com.cn/Public/login/image/body-bg1.jpg';
            $login['btnColor'] = '#5A98DE'; // 默认为蓝色
		}
		$this->login = $login;
    	$this->display();
    }
    /**
     * 登陆操作
     * @caibin
     * @2014-04-15
     */
    public function login()
    {    	
    	//判断是否是提交操作
    	if(!IS_POST)$this->error('非法操作');
    	$verify_code=I('verify','');
		/* //检验验证码
   		if(!$this->_verifyCheck($verify_code)){
			$this->error("验证码错误！！！");
		} */
		//后台验证
		$pwd = md5(I('password'));
		$map['user_name'] = I('user_name');
		$adminInfo = M('user')->where($map)->find();
		if(!$adminInfo || $adminInfo['password'] != $pwd){
			$this->error('账号或密码错误');
		}
		$adminInfo['status'] == 1 || $this->error('账号被关闭');
		//$adminInfo['isLock'] == 0 || $this->error('账号被锁定');
		//更新数据库管理员登陆信息
		$data['id'] = $adminInfo['id'];
		$data['last_login_time'] = time();
		$data['last_login_ip'] = get_client_ip();
		M('user')->save($data);
		// 保留登录日志
		$log = array(
					'login_ip'=>$data['last_login_ip'],
					'login_user_id'=>$data['id'],
					'ctime'=>time(),
					'memo'=>$adminInfo['user_name'],
					);

		$logId = M('login_logs')->add($log);

		//保存SESSION
		session(C('USER_AUTH_KEY'),$adminInfo['id']);
		session('user_name',$adminInfo['user_name']);
		session('real_name',$adminInfo['real_name']);
		session('password',$adminInfo['password']);
		session('logintime',date('Y-m-d H:i',$data['last_login_time']));
		session('log_id', $logId);
		//超级管理员识别
		if($adminInfo['user_name'] == C('RBAC_SUPERADMIN')){
			session(C('ADMIN_AUTH_KEY'),TRUE);
		}
		//获取数据查询条件
		$tempIds = $this->getMaps($adminInfo);
		$_SESSION['assessIds'] = $tempIds;
		$this->redirect('Home/Index/index');
    }

    /**
	 * 注销登陆
	 * @caibin
	 * @2014-04-15
	 */
	Public function logout(){
		$logId = $_SESSION['log_id'];
		session_unset();
		session_destroy();
		session('[destroy]');
		// 注销登录，设置登出时间；
		// TODO 非正常登出的链接，统计登出时间
		M('login_logs')->save(array('id'=>$logId, 'logout_time'=>time()));
		$this->success('注销成功',U('Home/Login/index'));
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
				$temp = $this->role->getCategoryList($v['bid']);
				foreach ($temp as $vv){
					if($vv['id'] != $v['group_id']){
						$temp_son[] = $vv; 
					}
				}
				foreach ($temp_son as $value) {
					$temp_roles[] = $value['id'];
					$temp_depList[] = $this->dep->getCategoryList($value['bid']);
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
		$tempId .= $adminInfo['id'];
		return array('in',rtrim($tempId, ","));
	}
    /**
	 * 生成验证码
	 * @caibin
	 */
	Public function verify(){
		$config = array(    
			'fontSize'    =>    14,    // 验证码字体大小    
			'length'      =>    4,     // 验证码位数    
			'useNoise'    =>    false, // 关闭验证码杂点
			'imageH'      =>    '32',
		);
		$Verify = new \Think\Verify($config);
		// 开启验证码背景图片功能 随机使用 ThinkPHP/Library/Think/Verify/bgs 目录下面的图片
		//$Verify->useImgBg = true;
		// 开启中文验证码
		//$Verify->useZh = true;
		// 中文验证码字体
		//$Verify->fontttf = '1.ttf';
		
		$Verify->entry();
	}
	/**
	 * 验证验证码
	 * @caibin
	 */
	private function _verifyCheck($code, $id = ''){
		$verify = new \Think\Verify();
		return $verify->check($code, $id);
	}
}