<?php 
namespace Finance\Controller;
use Common\Controller\CommonController;
class PostController extends CommonController { 
	
	/**
	 * 原料过账查询  
	 * @author xuli 
	 * 2015-1-27 
	 */
	public function index(){ 
		$conditions = I('param.'); 
		if($conditions['supplier'] != NUll){ 
			$map['a.supplier_name'] = array('like','%'.trim($conditions['supplier']).'%'); 
			$this->supplier = $conditions['supplier']; 
		}
		$count = M('ruku_product r')->join('ykb_ruku a ON a.id = r.rukuId')->where($map)->count(); 
		$Page = new \Think\Page($count,100,I('param.')); 
		$this->page = $Page->show();
		$row = M('ruku_product r')->join('ykb_ruku a ON a.id = r.rukuId')->join('ykb_base_product p ON p.id= r.productId')->where($map)->field('a.*,p.code,p.name,p.norms,r.cnt,r.price,r.money')->order('id asc') 
		->limit($Page->firstRow.','.$Page->listRows)->select(); 
		foreach($map as $key=>$val) {
			$Page->parameter[$key] = urlencode($val); 
		}
		if(count($row)>0)foreach($row as &$v){
			$v['ruku_date'] = date('Y-m-d',$v['ruku_date']);
		}
		$this->Ruku = $row;
		$this->display();
	} 
	/**
	 * 入库修改
	 * @author xuli
	 * 2015-1-13
	 */
	public function edit(){
		$map2['p.rukuId'] = $map['id'] = I('id');
		//先查出主体部分内容
		$main = M('ruku')->where($map)->select();
		$product = M('ruku_product p')->join('ykb_base_product b ON b.id = p.productId')->where($map2)
		->field('p.cnt,p.price,p.money,p.productId,p.id as rukuProId,b.name,b.code,norms')->select();
		foreach($main as &$v){
			$v['date'] = date('Y-m-d',$v['ruku_date']);
		}
		$this->Main = $main[0];
		$this->Ruku = $product;
		$this->display();
	}
	/**
	 * 过账保存
	 * @author xuli
	 * 2015-1-13
	 */
	public function addInsert() {
		$data = I('post.');
		$data['ruku_date'] = strtotime($data['ruku_date']);
		$ruku = D('Ruku');
		if (!$ruku->create($data)){
			exit($ruku->getError());
		}
		$data['ruku_product'] = array();
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
		$data['ruku_product'] = $product;
		if(I('id')){
			$res = $ruku->relation(true)->save($data);
			$kucun = D('Post');
			$row = $kucun->_after_edit($data,'ruku_product','isruku');//ruku_product:外键
		}
		if($row !== false){
			$this->success('过账成功',U('Finance/Post/index'));
		}else{
			$this->error('过账失败');
		} 
	} 
}

?>