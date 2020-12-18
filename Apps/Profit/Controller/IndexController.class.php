<?php 
namespace Profit\Controller;
use Common\Controller\CommonController;
class IndexController extends CommonController {																										
	public function index() {
		$conditions = I('param.');
		if($conditions['start_time'] != NULL && $conditions['end_time'] != NULL){
			$map['date'] = array('between',array($conditions['start_time'],$conditions['end_time']));
			$arr['start_time']=$this->start_time = $conditions['start_time'];
			$arr['end_time']=$this->end_time = $conditions['end_time'];
		}else{
			//TODO:需优化！太难看了，虽然功能OK了
			if($conditions['time_kind'] !=NULL){
				
			}else{ 
				$arr['start_time']=$this->start_time = date('Y-m-01');
				$arr['end_time']=$this->end_time = date("Y-m-d");
				$map['date'] = array('between',array($this->start_time,$this->end_time));
			}
		}
		if($conditions['time_kind'] !=NULL){
			$arr['time_kind']=$this->time_kind = $conditions['time_kind'];
		}else{
			$arr['time_kind']=$this->time_kind = 1;
		}
		if($conditions['store'] != NUll){
			$map['store'] = $conditions['store'];
			$arr['store']=$this->store = $conditions['store'];
		} 
		if($_SESSION['uid']!=1){
			$all= $this->access();
			//如果没有查看全部的权限，则按照职位等级权限进行查看
			if(!$all){
				$map['uid'] = $_SESSION['assessIds'];
			}
		}
		$this->arr=$arr;
		$this->stores = $stores = C('store');
		//导出
		if($conditions['export']==1){
			$row = M('profit a')
				->join('LEFT JOIN __USER__ u ON u.id = a.uid')
				->where($map)
            	->field('a.*,u.user_name')
				->select();
			$rowset=array();
			if(count($row)>0)foreach($row as &$v){ 
				$v['profitM'] = $v['realMoney']-$v['refund']-$v['zcFeiyong']-$v['gdFeiyong']-$v['ptFeiyong']-$v['tgFeiyong']-$v['ptFeiyong']-$v['qtFeiyong']-$v['proCost'];
				$rowset[]=array(
					'date'=>$v['date'],
					'store'=>$stores[$v['store']],
					'user_name'=>$v['user_name'],
					'realMoney'=>$v['realMoney'],
					'refund'=>$v['refund'],
					'zcMoney'=> $v['zcMoney'],
					'zcFeiyong'=> $v['zcMoney']*$v['zcRate'],
					'gdFeiyong'=>$v['gdFeiyong'],
					'ptFeiyong'=>$v['ptFeiyong'],
					'proCost'=>$v['proCost'],
					'tgFeiyong'=>$v['tgFeiyong'],
					'profit'=>$v['profitM'],
				);
				$realM +=$v['realMoney'];    
				$refund +=$v['refund'];
				$zcMoney +=$v['zcMoney'];
				$zcFeiyong +=$v['zcMoney']*$v['zcRate'];
				$gdFeiyong +=$v['gdFeiyong'];
				$ptFeiyong +=$v['ptFeiyong'];
				$proCost +=$v['proCost'];
				$tgFeiyong +=$v['tgFeiyong'];
				$profitT +=$v['profitM']; 
			} 
			$rowset[] = array(
				'date' => "合计",
				'store'=>'',
				'user_name'=>'',
				'realMoney'=>$realM,
				'refund'=>$refund,
				'zcMoney'=> $zcMoney,
				'zcFeiyong'=>$zcFeiyong,
				'gdFeiyong'=>$gdFeiyong,
				'ptFeiyong'=>$ptFeiyong,
				'proCost'=>$proCost,
				'tgFeiyong'=>$tgFeiyong,
				'profit'=>$profitT
			);
			$filename=date('Y-m-d',time()).'利润表导出';
			$this->exportexcel($rowset,array('日期','店铺','负责人','真实销售额','退款额','种菜额','种菜费用','固定费用','平台费用','产品成本','推广费用','利润额'),$filename);
			exit;
		}
		$count = M('profit')->where($map)->count();	
		//传参
		$Page = new \Think\Page($count,100,I('param.'));
		$this->page  = $Page->show();
		$profit = M('profit a')
            ->join('LEFT JOIN __USER__ u ON u.id = a.uid')
			->where($map)
            ->field('a.*,u.user_name')
			->limit($Page->firstRow.','.$Page->listRows)->select();
		foreach($profit as & $v){
			$v['zcFeiyong'] = $v['zcMoney']*$v['zcRate'];
			$v['profit'] = $v['realMoney']-$v['refund']-$v['zcFeiyong']-$v['gdFeiyong']-$v['tgFeiyong']-$v['ptFeiyong']-$v['qtFeiyong']-$v['proCost'];

			$v['store'] = $stores[$v['store']];
			$realM +=$v['realMoney'];
			$refund +=$v['refund'];
			$zcMoney +=$v['zcMoney'];
			$zcFeiyong +=$v['zcFeiyong'];
			$gdFeiyong +=$v['gdFeiyong'];
			$ptFeiyong +=$v['ptFeiyong'];
			$proCost +=$v['proCost'];
				
			$tgFeiyong +=$v['tgFeiyong'];
			$profitT +=$v['profit'];
		}
		$profit[] = array(
			'date' => "合计",
			'realMoney'  => $realM,
			'refund'  => $refund,
			'zcMoney'  => $zcMoney,
			'zcFeiyong'  => $zcFeiyong,
			'tgFeiyong'  => $tgFeiyong,
			'gdFeiyong'=>$gdFeiyong,
			'ptFeiyong'=>$ptFeiyong,
			'proCost'=>$proCost,
			'profit'  => $profitT,
			'edit'              => 1,
		);
		$this->profit = $profit;
		$this->display();
	}
	function add(){
		$aRow['uid'] = $_SESSION['uid'];
		$this->user = $this->getSalesman();
		$this->store=C('store');
		$this->aRow = $aRow;
		$this->display();
	}
	function save(){
		$arr=$_GET;
		$data=$_POST;
		$model = D('Profit');
		if (!$model->create($data)){
			exit($model->getError());
		}
		if($data['id']){
			$res = $model->save($data);
		}else{
			$res = $model->add($data);
		}
		if($res !== false){
    		$this->success('保存成功',U('Profit/Index/index',$arr));
    	}else{
    		$this->error('保存失败');
    	}
	}
	function edit(){
		$this->arr=$_GET;
		$map['id'] = I('id'); 
		$aRow=M('profit')->where($map)->find();
		// $aRow['zcFeiyong'] = round($aRow['zcMoney']*$aRow['zcRate'],2);
		// $money = ($aRow['realMoney']-$aRow['refund'])*$aRow['rate']-$aRow['zcFeiyong']-$aRow['tgFeiyong'];
		// $aRow['profitMoney'] = round($money,2);
		$this->aRow=$aRow;
		$this->user = $this->getSalesman();
		$this->store=C('store');
		$this->display('add');
	}
	function delete(){
		$map['id'] = I('id');
		$res = M('profit')->where($map)->delete();
		if($res){
			$this->success('删除成功',U('Profit/Index/index'));
		}else{
			$this->error('删除失败');
		}
	}
	//查询当前登录用户的角色权限
    function access(){
		$pos=M('auth_group_access')->where(array('uid'=>$_SESSION['uid']))->select();
        foreach($pos as $p){
            $groupAccess=M('auth_group')->where(array('id'=>$p['group_id']))->find();
            $access = explode(",",$groupAccess['rules']);
            if(in_array('96', $access)){
                return true;
            }
        }
    	return false;
    }

	
}

?>