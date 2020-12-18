<?php
namespace Weixin\Controller;
use Think\Controller;
class CommonController extends Controller {
    public function _initialize(){
    	//获取入口URL
    	$_SESSION['jumpUrl'] = MODULE_NAME.'/'.CONTROLLER_NAME.'/'.ACTION_NAME;
    	if(!isset($_SESSION[C('USER_AUTH_KEY')]) || !isset($_SESSION['user_name'])){
    		//获取code
    		$code = $_REQUEST['code'];
    		//获取access_token
    		$appID = "wx691da5348c1ab177";
    		$appsecret = "OlcECN9rs8iMM2bZgwrPlY6EJZ_0rY9ZNWpWbWyOcnw0PYSgBJF51iduiXpltox6";
    		$token = "";
    		$access_token = get_access_token($appID,$appsecret,$token);
    		//获取用户userId和DeviceId
    		$url = "https://qyapi.weixin.qq.com/cgi-bin/user/getuserinfo?access_token=$access_token&code=$code&agentid=1";
    		$result = file_get_contents($url);
    		$userinfo = (array)json_decode($result);
    		$map['user_name'] = $userinfo['UserId'];
			$res = M('user')->where($map)->find();
			//判断是否绑定微信账号
    		if(!$res['user_name']){
    			$this->redirect('Weixin/Bundling/index');
    		}else{
    			//保存SESSION
    			session(C('USER_AUTH_KEY'),$res['id']);
    			session('user_name',$res['user_name']);
    			session('real_name',$res['real_name']);
    			session('DeviceId',$userinfo['DeviceId']);
    			//超级管理员识别
    			if($res['user_name'] == C('RBAC_SUPERADMIN')){
    				session(C('ADMIN_AUTH_KEY'),TRUE);
    			}
    		}
			
    	}
    	
    }
}