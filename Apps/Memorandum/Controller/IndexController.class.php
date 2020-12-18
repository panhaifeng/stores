<?php 
namespace Memorandum\Controller;
use Common\Controller\CommonController;
class IndexController extends CommonController {
	
	/**
	 * 合同查询
	 * @author xuli
	 * 2015-1-13
	 * @param guozhang 搜索判断（数据库中为isPost 1为过账  0为未过账；guozhang : -1为全部  0为未过账  1为过账）
	 * 
	 */
	public function index(){ 
		$conditions = I('param.');
		if($conditions['sid'] != NUll){
			$map['sid'] = $conditions['sid'];
			$this->sid = $conditions['sid']; 
		}
		if($conditions['company'] != NUll){
			$where['company']  = array('like','%'.trim($conditions['company']).'%');
			$where['_logic'] = 'or';
			$map['_complex'] = $where;
			$this->company = $conditions['company'];
		}
		//TODO:写的很烂，需优化。功能OK！
		if($conditions['isPost'] != NULL){
			if($conditions['isPost'] == 1){
				$map['isPost'] = $conditions['isPost'];
				$this->isPost = $conditions['isPost'];
			}elseif($conditions['isPost'] == -1){
				unset($map['isPost']);
				$this->isPost = $conditions['isPost'];
			}else{
				$map['isPost'] = $conditions['isPost'];
				$this->isPost = $conditions['isPost'];
			}
		}else{
			$map['isPost'] = 0;
			$this->isPost = 0;
		} 
		$Memorandum = M('Memorandum'); 
		$count = $Memorandum->where($map)->count();	
		//传参
		$Page = new \Think\Page($count,100,I('param.'));
		
		$this->page  = $Page->show();
		$row = M('Memorandum c')->join('ykb_client a ON a.id = c.cid') 
		->field('a.company,c.*')->where($map)
		->limit($Page->firstRow.','.$Page->listRows)->select();
		
		foreach($map as $key=>$val) { 
			$Page->parameter[$key] = urlencode($val);
		} 
		
		if(count($row)>0)foreach($row as &$v){
			$Salesman = M('user')->field('real_name as name')->where(array('id'=>$v['sid']))->find();
			$kaipiao = M('collection_money')->field('sum(kaipiao_money) as piaomoney')->where(array('mid'=>$v['id']))->group('mid')->select();
			$v['name'] = $Salesman['name']; 
			$v['orderDate'] = date('Y-m-d',$v['orderDate']); 
			$v['start_time'] = date('Y-m-d',$v['start_time']);
			$v['end_time'] = date('Y-m-d',$v['end_time']);
			$v['seephoto'] = substr($v['photo_address'],2);
			$v['proName'] = $this->getProName($v['proId']);
			$v['kaipiao_money'] = $kaipiao[0]['piaomoney'];
			$v['isPhoto'] = strlen(substr($v['photo_address'], 15));
			$v['isShou'] = $v['moneyfasheng'] > 0? 1:0;//是否已收款
			if($v['shuilv']==2){
				$v['shuilv'] = 0.17;
			}else{
				$v['shuilv'] = 0;
			}
			$money += $v['money'];
		}
		$row[] = array(
			'company' => '合计',
			'money'   => $money,
			'isShou'  => 1, //目的是取消操作内容 
		);
		$this->Contact = $row;
		$this->Salesman = M('user')->field('id,real_name as name')->select();
		$this->display();
	} 
	
	/**
	 * 合同新增
	 * @author xuli
	 * 2015-1-13
	 */
	public function add() {
		$this->Salesman = M('user')->field('id,real_name as name')->select();
		$this->Product = M('base_product')->select();
		$this->display(); 
	}
	
	/**
	 * 合同保存
	 * @author xuli
	 * 2015-1-13
	 */
	public function addInsert() {
		$filename = $this->_Upload('hetong');
		$memorandum['cid'] = I('cid');
		$memorandum['sid'] = I('salesman');
		$memorandum['orderDate'] = strtotime(I('orderDate'));
		$memorandum['start_time'] = strtotime(I('start_time'));
		$memorandum['end_time'] = strtotime(I('end_time'));
		$memorandum['period'] = I('period');
		$memorandum['proId'] = I('productId');
		$memorandum['money'] = I('money');
		$memorandum['shuilv'] = I('shuilv');
		$memorandum['memo'] = I('memo');
		//自动验证
		$m= D('Memorandum');
		if (!$m->create($memorandum)){
			exit($m->getError());
		}
		if(I('id')){ 
			//判断四种修改合同图片的情况
			$mphoto = strlen(substr(I('mphoto'), 15));
			$len= strlen(substr($filename, 15));
			if($mphoto==5){
				if($len==5){
					$memorandum['photo_address'] = I('mphoto');
				}else{ 
					$memorandum['photo_address'] = $filename;
				}	
			}else{
				if($len==5){ 
					$memorandum['photo_address'] = I('mphoto');
				}else{
					$memorandum['photo_address'] = $filename;
				}	
			}
			$memorandum['id']=I('id');
			$res = $m->save($memorandum);
		}else{
			$memorandum['orderCode'] = $this->_getNewCode('HT','memorandum','orderCode');
			$memorandum['photo_address'] = $filename;
			$res = $m->add($memorandum);
		}
		if($res !== false){
			$this->success('添加成功',U('memorandum/Index/add'));
		}else{
			$this->error('添加失败');
		}
	}
	/**
	 * 合同修改
	 * @author xuli
	 * 2015-1-13
	 */
	public function edit(){ 
		$this->Salesman = M('user')->field('id,real_name as name')->select(); 
		$this->Product = M('base_product')->select();
		$this->Memorandum = M('Memorandum c')->join('ykb_client a ON a.id = c.cid')->where(array('c.id'=>I('get.id')))->field('a.company,c.*')->find();
		$this->orderDate = date('Y-m-d',$this->Memorandum['orderDate']);
		$this->start_time = date('Y-m-d',$this->Memorandum['start_time']);
		$this->end_time = date('Y-m-d',$this->Memorandum['end_time']);
		$this->address = strlen(substr($this->Memorandum['photo_address'], 15)); 
		$this->photo_address = substr($this->Memorandum['photo_address'],2);
		$this->shuilv = $this->Memorandum['shuilv']==1? 1 : 2 ; 
		$this->kind = 1; 
		$this->display('add');  
	}
	/**
	 * 合同删除
	 * @author xuli
	 * 2015-1-13
	 */
	public function delect(){
		$map['id'] = I('get.id');
		$row = M('Memorandum')->where($map)->find();
		//删除服务器上图片
		unlink($_SERVER['DOCUMENT_ROOT'].$row["photo_address"]); 
		//删除本地图片
		unlink($row["photo_address"]);
		$res = M('Memorandum')->where($map)->delete();
		if($res){
			$this->success('删除成功',U('Memorandum/Index/index'));
		}else{
			$this->error('删除失败');
		}
	}
	/**
	 * 根据关键字搜索合同信息
	 * @author xuli
	 * 2015-1-12
	 */
	public function getMemorandumKey(){
		$data = I('get.');
		$map['company'] = array('like',"%".$data['company']."%");
		$map['isOver'] = 0;
		$count = M('memorandum m')->join('ykb_client c ON m.cid=c.id')->field('m.*,c.company')->where($map)->count(); //计算记录数
		$limitRows = 10; // 设置每页记录数 
		$p = new \Common\Util\Ajaxpage($count, $limitRows,"memorandum"); //第三个参数是你需要调用换页的ajax函数名
		$limit_value = $p->firstRow . "," . $p->listRows;
	
		$data['list'] = M('memorandum m')->join('ykb_client c ON m.cid=c.id')->join('ykb_collection_money o ON m.id=o.mid')->field('m.*,c.company,sum(o.collection_money) as collection_money')->where($map)->limit($limit_value)->group('m.id')->select(); // 查询数据
		$page = $p->show(); // 产生分页信息，AJAX的连接在此处生成   
		$data['page']=$page;
		$this->ajaxReturn($data);
	}
}
?>