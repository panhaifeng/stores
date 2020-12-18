<?php 
namespace Finance\Controller;
use Common\Controller\CommonController;
class BankController extends CommonController { 
	
	/**
	 * 转账查询
	 * @author xuli
	 * 2015-1-15 
	 */
	public function index() {
		$conditions = I('param.');
		if($conditions['start_time'] != NULL && $conditions['end_time'] != NULL){
			$time[0] = strtotime($conditions['start_time']);
			$time[1] = strtotime($conditions['end_time']);
			$map['transfer_date'] = array('between',array($time[0],$time[1]));
			$this->start_time = $conditions['start_time'];
			$this->end_time = $conditions['end_time'];
		}
		if($conditions['time_kind'] !=NULL){
			$this->time_kind = $conditions['time_kind'];
		}
		if($conditions['memo'] != NUll){
			$map['memo'] = array('like','%'.trim($conditions['memo']).'%');
			$this->memo = $conditions['memo'];
		} 
		$count = M('transfer')->where($map)->count();
		$Page = new \Think\Page($count,100);
		$this->page = $Page->show();
		 
		$row = M('transfer')->where($map)->order('id asc')
		->limit($Page->firstRow.','.$Page->listRows)->select();
		 
		foreach($map as $key=>$val) {
			$Page->parameter[$key] = urlencode($val);
		}
		
		if(count($row)>0)foreach($row as &$v){ 
			$v['payment_bank'] = $this->getBankname($v['payment_bankid']);
			$v['collection_bank'] = $this->getBankname($v['collection_bankid']);
			$v['transfer_date'] = date('Y-m-d',$v['transfer_date']);
		} 
		$this->money = $row; 
		$this->display(); 
	}
	
	/**
	 * 转账登记
	 * @author xuli
	 * 2015-1-15
	 */
	public function add() {
		$this->collection_bank=$this->payment_bank = M('Bank')->select();
		$this->Transfer_date = date('Y-m-d');
		$this->display();
	}
	
	/**
	 * 转账修改
	 * @author xuli
	 * 2015-1-15
	 */
	public function edit() {
		$map['id'] = I('id');
		$this->Transfer = M('transfer')->where($map)->find();
		$this->Transfer_date = date('Y-m-d',$this->Transfer['transfer_date']);
		$this->collection_bank=$this->payment_bank = M('Bank')->select();
		$this->display('add');
	}
	
	/**
	 * 转账保存
	 * @author xuli
	 * 2015-1-15
	 */
	public function addInsert() {
		$money = array();
		$money = I('post.');
		$money['transfer_date'] = strtotime(I('transfer_date'));
		$transfer = D('Transfer');
		if(!$transfer->create($money)){
			exit($transfer->getError());
		}
		if(I('id')){
			$res = $transfer->save($money);
		}else{
			$money['transfer_number'] = $this->_getNewCode('ZZ', 'transfer', 'transfer_number');
			$res = $transfer->add($money);
		}
		if($res !== false){
			$this->success('保存成功',U('Finance/Bank/index'));
		}else{
			$this->error('保存失败');
		}
	}
	
	/**
	 * 转账删除
	 * @author xuli
	 * 2015-1-15
	 */
	public function delect() {
		$map['id'] = I('id');	
		$res = M('transfer')->where($map)->delete();
		if($res){
			$this->success('删除成功',U('Finance/Bank/index'));
		}else{
			$this->error('删除失败');
		}
	}
	public function delAll(){
		$pwd = md5($_POST['password']);
		if($_SESSION['password']!=$pwd){
			$this->error('密码错误，请重新输入！',U('Finance/Bank/index'));
		}
		$row=M('transfer')->select();
		foreach($row as & $v){
			$temp=array();
			$temp=$v;
			$temp['oldId']=intval($v['id']);
			unset($temp['id']);
			$res=M('transfer_backups')->add($temp);
			$map['id']=$v['id'];
			M('transfer')->where($map)->delete();
		}
		$this->success('清除数据成功',U('Finance/Bank/index'));
	}
}

?>