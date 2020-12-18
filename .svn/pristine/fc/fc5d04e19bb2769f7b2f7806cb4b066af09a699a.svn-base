<?php 
namespace Storehouse\Controller;
use Common\Controller\CommonController;
class PaymentController extends CommonController {
	
	/**
	 * 付款查询
	 * @author xuli
	 * 2015-1-15
	 */
	public function index() {
		$conditions = I('param.');
		//dump($conditions); 
		if($conditions['start_time'] != NULL && $conditions['end_time'] != NULL){
			$time[0] = strtotime($conditions['start_time']);
			$time[1] = strtotime($conditions['end_time']);
			$map['payment_date'] = array('between',array($time[0],$time[1]));
			$this->start_time = $conditions['start_time'];
			$this->end_time = $conditions['end_time'];
		}else{
			//TODO:需优化！太难看了，虽然功能OK了
			if($conditions['time_kind'] !=NULL){
		
			}else{
				$time[0] = strtotime(date('Y-m-1'));
				$time[1] = strtotime(date("Y-m-d"));
				$map['payment_date'] = array('between',array($time[0],$time[1]));
				$this->start_time = date('Y-m-1');
				$this->end_time = date("Y-m-d");
			}
		} 
		if($conditions['time_kind'] !=NULL){
			$this->time_kind = $conditions['time_kind'];
		}else{
			$this->time_kind = 1;
		} 
		if($conditions['memo'] != NUll){
			$map['memo'] = array('like','%'.trim($conditions['memo']).'%');
			$this->memo = $conditions['memo'];
		}
		//dump($map);die;
		$count = M('yl_payment m')->where($map)->count();
		$Page = new \Think\Page($count,100,I('param.'));
		$this->page = $Page->show();
			
		$row = M('yl_payment m')->where($map)->order('id asc')
		->limit($Page->firstRow.','.$Page->listRows)->select();
			
		foreach($map as $key=>$val) {
			$Page->parameter[$key] = urlencode($val);
		}
		$type = C('collection_type');
		if(count($row)>0)foreach($row as &$v){ 
			$v['bankname'] = $this->getBankname($v['bankid']);
			$v['kind'] = $v['kind']==1?"成品付款":"原料付款";
			$v['payment_date'] = date('Y-m-d',$v['payment_date']);
			$money += $v['payment_money'];
		} 
		$row[] = array(
			'payment_number' => "合计",
			'payment_money'  => $money,
			'edit'			 => 1,
		);
		$this->money = $row;
		$this->display();
	}
	
	/**
	 * 付款修改
	 * @author xuli
	 * 2015-1-15
	 */
	public function edit() {
		$map['id'] = I('id');
		$this->payment = M('yl_payment')->where($map)->find();
		$this->payment_date = date('Y-m-d',$this->payment['payment_date']);
		$this->bank = M('bank')->where('id',I('bankid'))->select();
		$this->display('add');
	} 
	
	/**
	 * 付款登记
	 * @author xuli
	 * 2015-1-15
	 */
	public function add() {
		$this->bank = M('Bank')->select();
		$this->isNew = 1;
		$this->display();
	}
	
	/**
	 * 付款保存
	 * @author xuli
	 * 2015-1-15
	 */
	public function addInsert() {
		$data = array();
		$data = I('post.');
		$data['payment_date'] = strtotime(I('payment_date'));
		unset($data['isNew']);
		unset($data['isCollection']);
		//自动验证
		$payment = D('Payment');
		if (!$payment->create($data)){
			exit($payment->getError());
		}
		if(I('id')){
			$data['id']=I('id');
			$res = $payment->save($data);
		}else{
			$data['payment_number'] = $this->_getNewCode('GYFK','yl_payment','payment_number');
			$res = $payment->add($data);
		}
		
		if($res !== false){
			$this->success('保存成功',U('Storehouse/Payment/index'));
		}else{
			$this->error('保存失败');
		}
	} 

	
	/**
	 * 付款删除
	 * @author xuli
	 * 2015-1-15
	 */
	public function delect() {
		$map['id'] = I('id');
		$res = M('yl_payment')->where($map)->delete();
		if($res){
			$this->success('删除成功',U('Storehouse/Payment/index'));
		}else{
			$this->error('删除失败');
		}
	}
	
}

?>