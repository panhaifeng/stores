<?php 
namespace Finance\Controller;
use Common\Controller\CommonController;
class BaseController extends CommonController {
	
	/**
	 * 银行账户
	 * @author xuli
	 * 2015-1-14
	 */
	public function bank() {
		$condition = I('param.');
		if($condition['bankname'] != NULL){
			$map['bankname'] = array('like','%'.trim($condition['bankname']).'%');
			$this->bankname = $condition['bankname'];
		}
		$count = M('Bank')->where($map)->count();
		$Page = new \Think\Page($count,10);
		$this->page = $Page->show(); 
		$row = M('Bank')->where($map)->limit($Page->firstRow.','.$Page->listRows)->select();
		foreach($map as $key=>$val) {
			$Page->parameter[$key] = urlencode($val);
		}
		$this->bank = $row;
		$this->display();
	} 
	
	/**
	 * 新增银行账户
	 * @author xuli
	 * 2015-1-14
	 */
	public function addbank() {
	
		$this->display();
	}
	
	/**
	 * 修改银行账户
	 * @author xuli
	 * 2015-1-14
	 */
	public function editbank() {
		$map['id'] = I('id');
		$this->bank = M('Bank')->where($map)->find();
		$this->display('addbank');
	}
	
	/**
	 * 保存
	 * @author xuli
	 * 2015-1-14
	 */
	public function bankInsert() {
		if(I('id')){ 
			$res = M('Bank')->save(I('post.'));
		}else{
			$res = M('Bank')->add(I('post.'));
		}
		if($res !== false){
			$this->success('新增成功',U('Finance/Base/bank'));
		}else{
			$this->error('新增失败');
		} 
	}
	
	/**
	 * 删除
	 * @author xuli
	 * 2015-1-14
	 */
	public function delectbank() {
		$map['id']=I('id');
		$res = M('Bank')->where($map)->delete();
    	if($res){ 
    		$this->success('删除成功',U('Finance/Base/bank'));
    	}else{
    		$this->error('删除失败');
    	}
	} 
	
/***********************************银行账户功能完毕***************************************/	
	
	/**
	 * 收款项目管理
	 * @author xuli
	 * @param kind
	 * 判别参数（1为收款，2为付款）
	 * 2015-1-14
	 */
	public function collection() {
		$condition = I('param.');
		if($condition['collection_name'] != NULL){
			$map['collection_name'] = array('like','%'.trim($condition['collection_name']).'%');
			$this->name = $condition['collection_name'];
		}
		//传父节点判断为父类或子类
		$map['parentId'] = $condition['parentId']>0?$condition['parentId']:0;
		$count = M('Collection')->where($map)->count();
		$Page = new \Think\Page($count,10);
		$this->page = $Page->show(); 
		$row = M('Collection')->where($map)->limit($Page->firstRow.','.$Page->listRows)->select();
		if(count($row)>0)foreach($row as &$v){
			$v['code'] = $v['collection_code'];
			$v['name'] = $v['collection_name'];
			$map2['item'] = $v['id'];
			//判断后期是否使用该数据
			$count = M('collection_money')->where($map2)->count();
			$v['exist'] = $count > 0 ? 1:0;
		} 
		foreach($map as $key=>$val) {
			$Page->parameter[$key] = urlencode($val);
		} 
		$this->items = $row;
		$this->kind = 1;
		$this->parentId = $map['parentId'];
		$this->display();
	}
	
	/**
	 * 新增收款项目管理
	 * @author xuli
	 * @param kind
	 * 判别参数（1为收款，2为付款）
	 * 2015-1-14
	 */
	public function addcollection() {
		$this->parentId = I('parentId');
		$this->kind = 1;
		$this->display();
	} 
	
	/**
	 * 修改收款项目管理
	 * @author xuli
	 * @param kind
	 * 判别参数（1为收款，2为付款）
	 * 2015-1-14
	 */
	public function editcollection() {
		$map['id']=I('id'); 
		$this->collection = M('Collection')->where($map)->find();
		$this->kind = 1;
		$this->parentId = $this->collection['parentId'];
		$this->display('addcollection');
	}
	
	/**
	 * 收款项目保存
	 * @author xuli
	 * 2015-1-14
	 */
	public function collectionInsert() {
		if(I('id')){ 
			$res = M('Collection')->save(I('post.'));
			$this->ajaxReturn($res,'json');
		}else{ 
			$res = M('Collection')->add(I('post.'));
		}
		if($res !== false){
			$this->success('新增成功',U('Finance/Base/collection'));
		}else{
			$this->error('新增失败');
		}
	}
	
	/**
	 * 收款项目删除
	 * @author xuli
	 * 2015-1-14
	 */
	public function delectcollection() {
		$map2['parentId']=$map['id']=I('id');
		$res = M('Collection')->where($map)->delete();
		//如果删除的是父节点，则子项也删除
		$res2 = M('Collection')->where($map2)->delete();
		if($res){
			$this->success('删除成功',U('Finance/Base/collection'));
		}else{
			$this->error('删除失败');
		}
	}
	
/***********************************收款项目管理功能完毕***************************************/
	
	/**
	 * 付款项目管理
	 * @author xuli
	 * @param kind
	 * 判别参数（1为收款，2为付款）
	 * 2015-1-14
	 */
	public function payment() {
		$condition = I('param.');
		if($condition['payment_name'] != NULL){
			$map['payment_name'] = array('like','%'.trim($condition['payment_name']).'%');
			$this->name = $condition['payment_name'];
		}
		//传父节点判断为父类或子类
		$map['parentId'] = $condition['parentId']>0?$condition['parentId']:0;
		$count = M('Payment')->where($map)->count();
		$Page = new \Think\Page($count,10);
		$this->page = $Page->show();
		$row = M('Payment')->where($map)->limit($Page->firstRow.','.$Page->listRows)->select();
		//dump($row);die;
		if(count($row)>0)foreach($row as &$v){ 
			$v['code'] = $v['payment_code'];
			$v['name'] = $v['payment_name'];
			$map2['item'] = $v['id'];
			//判断后期是否使用该数据
			$count = M('payment_money')->where($map2)->count();
			$v['exist'] = $count > 0 ? 1:0;
		}
		foreach($map as $key=>$val) {
			$Page->parameter[$key] = urlencode($val);
		}
		$this->items = $row;
		$this->kind = 2;
		$this->parentId = $map['parentId'];
		$this->display('collection');
	}
	
	/**
	 * 新增付款项目管理
	 * @author xuli
	 * @param kind
	 * 判别参数（1为收款，2为付款）
	 * 2015-1-14
	 */
	public function addpayment() {
		$this->parentId = I('parentId');
		$this->kind = 2;
		$this->display('addcollection');
	}
	
	/**
	 * 修改付款项目管理
	 * @author xuli
	 * @param kind
	 * 判别参数（1为收款，2为付款）
	 * 2015-1-14
	 */
	public function editpayment() {
		$map['id']=I('id');
		$this->payment = M('Payment')->where($map)->find();
		$this->kind = 2;
		$this->parentId = $this->payment['parentId'];
		$this->display('addcollection');
	}
	
	/**
	 * 付款项目保存
	 * @author xuli
	 * 2015-1-14
	 */
	public function paymentInsert() {
		if(I('id')){ 
			$res = M('Payment')->save(I('post.'));
			$this->ajaxReturn($res,'json');
		}else{
			$res = M('Payment')->add(I('post.'));
		}
		if($res !== false){
			$this->success('新增成功',U('Finance/Base/payment'));
		}else{
			$this->error('新增失败');
		}
	}
	
	/**
	 * 付款项目删除
	 * @author xuli
	 * 2015-1-14
	 */
	public function delectpayment() { 
		$map2['parentId']=$map['id']=I('id');
		$res = M('Payment')->where($map)->delete();
		//如果删除的是父节点，则子项也删除
		$res2 = M('Payment')->where($map2)->delete();
		if($res){
			$this->success('删除成功',U('Finance/Base/payment'));
		}else{
			$this->error('删除失败');
		}
	}
	
/***********************************付款项目管理功能完毕***************************************/
}

?>