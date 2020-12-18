<?php
namespace Weixin\Controller;
use Think\Controller;
class AnalyseController extends Controller {
	/**
	 * 当天考勤情况
	 * @author zhangyan
	 * 2015-01-06
	 */
	public function attendDay(){
		$condition=$_REQUEST;
		$map['id']=array('neq',1);
		$userList = M('user')
				->field('real_name,id')
				->where($map)
				->select();
		//查询那天的考勤
		if ($condition['ctime'] != NULL) {
			$time=strtotime($condition['ctime']);
			$mapAttend['stime'] = date('Ymd',$time);
			$this->ctime = $condition['ctime'];
		}else{
			$mapAttend['stime'] = date('Ymd',time());
		}
		//查询每月考勤次数
		if ($condition['begintime'] != NULL) {
			$begintime=strtotime($condition['begintime']);
			$this->begintime = $condition['begintime'];
		}
		if ($condition['endtime'] != NULL) {
			$endtime=strtotime($condition['endtime']);
			$this->endtime = $condition['endtime'];
		}
		$list = M('signinLogs')->where($mapAttend)->select();
		//获取员工签到时间
		foreach ($userList as & $v){
			foreach ($list as $val){
				//截取字符串
				$val['labelJC']=mb_substr($val['label'], 6,4,'utf-8');
				$val['memoJC']=mb_substr($val['memo'], 0,5,'utf-8');
				if($val['uid'] == $v['id']){
					$v['attendList'][]=$val;
				}
			}
		}
		//获取当月考勤情况
		$temp=$this->attendMonthly($begintime,$endtime);
		$this->monthList=$temp[0];
		$this->workday=$temp['workDays'];
		$this->userList=$userList;
		$this->display();
	}
	/**
	 * 当月考勤情况
	 * @author zhangyan
	 * 2015-01-06
	 * @return array 
	 */
	public function attendMonthly($begintime,$endtime){
		$map['id']=array('neq',1);
		$monthList = M('user')
				->field('real_name,id')
				->where($map)
				->select();
		//如果不存在条件则取当月开始时间戳
		$beginThismonth=$begintime?$begintime:mktime(0,0,0,date('m'),1,date('Y'));
		//如果不存在条件则当月结束时间戳
		$endThismonth=$endtime?$endtime:mktime(23,59,59,date('m'),date('t'),date('Y'));
		$mapElary['ctime']=$mapLate['ctime']=$mapAttend['ctime'] = array('between',array($beginThismonth,$endThismonth));
		$mapElary['workday']=$mapLate['workday']=$mapAttend['workday']=1;
	 	//获取实际考勤次数
		$list = M('signinLogs')->field('count(uid) as num,type,uid')
								->where($mapAttend)->order('type ASC')
								->group('uid,type')->select(); 
		//获取迟到次数
		$mapElary['statue']=array('eq',2);
		$mapElary['type']=array('eq',1);
		$listElary = M('signinLogs')->field('count(uid) as num,type,uid')
		->where($mapElary)->group('uid')->select();
		//获取早退次数
		$mapLate['statue']=3;
		$mapLate['type']=2;
		$listLate = M('signinLogs')->field('count(uid) as num,type,uid')
		->where($mapLate)->group('uid')->select();
		//获取年月
		$year=date('Y');
		$month=date('m');
		//获取当月应到次数
		$workDays=$this->workDays($year, $month);
		foreach ($monthList as & $v){
			foreach ($list as & $val1){
				if($val1['uid'] == $v['id']){
					$v['attendList'][]=$val1;
				}
			}
			foreach ($listElary as & $val2){
				if($val2['uid'] == $v['id']){
					$v['elaryList'][]=$val2;
				}
			}
			foreach ($listLate as & $val3){
				if($val3['uid'] == $v['id']){
					$v['lateList'][]=$val3;
				}
			}
		}
		$data['workDays']=$workDays;
		$data[]=$monthList;
		return $data;
	}
	
	/**
	 * 当月迟到详情
	 * @author zhangyan
	 * 2015-01-06
	 */
	public function viewElary(){
		$mapElary['uid']=$_GET['id'];
		$mapElary['statue']=array('eq',2);
		$mapElary['type']=array('eq',1);
		$listElary = M('signinLogs')->field('*')
		->where($mapElary)->select();
		$this->list=$listElary;
		$this->display();
	}
	/**
	 * 当月早退详情
	 * @author zhangyan
	 * 2015-01-06
	 */
 	public function viewLate(){
		$mapElary['uid']=$_GET['id'];
		$mapElary['statue']=array('eq',3);
		$mapElary['type']=array('eq',2);
		$listElary = M('signinLogs')->field('*')
		->where($mapElary)->select();
		$this->list=$listElary;
		$this->display('');
	
	} 
	
	/**
	 * 计算当月工作日
	 * @author zhangyan
	 * 2015-01-06
	 * @return $days
	 */
	public function workDays($year,$month){
		$day=1;
		$days=0;
		$t=mktime(0,0,0,$month,$day,$year);
		$days=date('t',$t);
		$fristDayWeek=date('w',$t);//每月一号的星期数
		$lastDayWeek=date('w',mktime(0,0,0,$month,$days,$year));//每月最后一天的星期数
		if($days>28){//非平年二月算法，平年二月无论怎么都只有20天。
			if($fristDayWeek==6)//起始日是星期六的减去2天，星期天的减去一天。
				$days-=2;
			if($fristDayWeek==0)
				$days-=1;
			if($lastDayWeek==6)//结束日是星期六的减去一天，星期天的减去2天。
				$days-=1;
			if($lastDayWeek==0)
				$days-=2;
		}
	
		if($days<28)//每个月最少会工作20天，此处修正开始日期是星期六，结束日期是星期天的31天的月份
	
			$days=28;
		return $days-8;// 减去每个月都有的4个星期天共8天
	}

}