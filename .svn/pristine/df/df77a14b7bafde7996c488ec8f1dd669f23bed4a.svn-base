<?php
namespace Weixin\Controller;
use Weixin\Controller\CommonController;
class SigninController extends CommonController {
	/**
	 * 签到选择
	 */
    public function index(){
    	//二次判断账号是否异常
    	$res = M('user')->where(array('user_name'=>$_SESSION['user_name']))->find();
    	//判断是否绑定微信账号
    	if(!$res['user_name']){
    		$this->redirect('Weixin/Bundling/index');
    	}else{
    		$w = date('w',time());
	    	$this->w = C('WEEKDAYS.'.$w);
	    	$map['uid'] = $_SESSION['uid'];
	    	$map['stime'] = date('Ymd');
	    	$status = M('signinLogs')->field('type')->where($map)->select();
	    	$sign = C('SIGN');
	    	if($status){
	    		foreach ($status as $v){
	    			$sign[$v['type']] = true;
	    		}
	    	}
	    	
	    	$this->sign = $sign;
	    	$this->display();
    	}
    }
    /**
     * 签到页面
     */
    public function dosign(){
    	$this->type = I('type');
    	$w = date('w',time());
    	$this->w = C('WEEKDAYS.'.$w);
    	$this->display();
    }
    
    /**
     * 插入签到信息
     * @caibin
     */
    public function insert(){
    	$data = I('post.');
    	$data['uid'] = $_SESSION['uid'];
    	$data['device_id'] = $_SESSION['DeviceId'];
    	$data['ctime'] = time();
    	$w = date('w',time());
    	//判断当天周六或周末为加班
    	if ($w==0||$w==6) {
    		$data['workday']=2;
    	}
        if ($data['type']==1) {
        	//当天8点
        	$todayTime=strtotime('today')+28800;
        	if ($data['ctime']>$todayTime) {
        		$data['statue']=2;
        	}
        }else{
        	//当天17点
        	$todayPc=strtotime('today')+61200;
        	if ($data['ctime']<$todayPc) {
        		$data['statue']=3;
        	}
        }
    	$data['stime'] = date('Ymd',time());
    	$res = M('signinLogs')->add($data);
    	$this->ajaxReturn($res);
    }
    
}