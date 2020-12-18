<?php 
namespace Finance\Controller;
use Common\Controller\CommonController;
class CpostController extends CommonController { 
	
	/**
	 * 成品过账查询  
	 * @author xuli 
	 * 2015-1-27 
	 */
	public function index(){ 
		$conditions = I('param.');
		if($conditions['client'] != NUll){
			$map['client_name'] = array('like','%'.trim($conditions['client']).'%');
			$this->client = $conditions['client'];
		}
		$count = M('cpchuku_product c')->join('ykb_cp_chuku a ON a.id = c.chukuId')->where($map)->count();
		$Page = new \Think\Page($count,100,I('param.'));
		$this->page = $Page->show();
		$row = M('cpchuku_product c')->join('ykb_cp_chuku a ON a.id = c.chukuId')->join('ykb_chengpin_product p ON p.id= c.productId')->where($map)->field('a.*,p.code,p.name,p.norms,c.cnt,c.price,c.money')->order('id asc') 
		->limit($Page->firstRow.','.$Page->listRows)->select();
			
		foreach($map as $key=>$val) {
			$Page->parameter[$key] = urlencode($val);
		}
		
		if(count($row)>0)foreach($row as &$v){
			$v['chuku_date'] = date('Y-m-d',$v['chuku_date']);
		}
		$this->Chuku = $row;
		$this->display();
	} 
	/**
	 * 过账修改
	 * @author xuli
	 * 2015-1-13
	 */
	public function edit(){
		$map2['p.chukuId'] = $map['id'] = I('id');
		//先查出主体部分内容
		$main = M('cp_chuku')->where($map)->select();
		$product = M('cpchuku_product p')->join('ykb_chengpin_product b ON b.id = p.productId')->where($map2)
		->field('p.cnt,p.price,p.money,p.productId,p.id as chukuProId,b.name,b.code,norms')->select();
		foreach($main as &$v){
			$v['date'] = date('Y-m-d',$v['chuku_date']);
		}
		$this->Main = $main[0];
		$this->Chuku = $product;
		$this->display();
	}
	/**
	 * 过账保存
	 * @author xuli
	 * 2015-1-13
	 */
	public function addInsert() {
		$data = I('post.');
		$data['chuku_date'] = strtotime($data['chuku_date']);
		$chuku = D('Cpchuku');
		if (!$chuku->create($data)){
			exit($chuku->getError());
		}
		
		$data['chuku_product'] = array();
		//应该可优化
		foreach($data['productId'] as $key => $v){
			if($data['sonId'][$key]!=""){
				$product[] = array(
						'productId'	=> $data['productId'][$key],
						'cnt'	=> $data['cnt'][$key],
						'price'	=> $data['price'][$key],
						'money'	=> $data['money'][$key],
						'id'	=> $data['sonId'][$key],
				);
			}
		}
		$data['chuku_product'] = $product;
		if(I('id')){
			$res = $chuku->relation(true)->save($data);
			$kucun = D('Cpost');
			$row = $kucun->_after_edit($data,'cpchuku_product','ischuku');//cpchuku_product:外键
		}
		if($row !== false){
			$this->success('过账成功',U('Finance/Cpost/index'));
		}else{
			$this->error('过账失败');
		} 
	} 
}

?>