<?php 
namespace Finance\Controller;
use Common\Controller\CommonController;
class YfGzController extends CommonController { 
	
	/**
	 * 应付款报表
	 * @author shen 
	 * 2018-8-9 
	 */
	public function index(){ 
		$conditions = I('param.');
		if($conditions['client'] != NUll){
			$map['client_name'] = array('like','%'.trim($conditions['client']).'%');
			$this->client = $conditions['client'];
		}
		if(!$conditions['time_kind']){
			$this->time_kind=1;
			$this->start_time = date('Y-m-1');
			$this->end_time = date("Y-m-d");
			$conditions['start_time'] = date("Y-m-1");
			$conditions['end_time'] = date("Y-m-d");
		}else{
			$this->time_kind=$conditions['time_kind'];
			$this->start_time = $conditions['start_time'];
			$this->end_time = $conditions['end_time'];
		}
		$timeStart = $conditions['start_time'];
		$map['guozhangDate'] = array('lt',$timeStart);

		$count = M('yf_guozhang')
				->where($map)
				->group('supplierId')
				->count();
		$Page = new \Think\Page($count,100,I('param.'));
		$this->page = $Page->show();

        //期初发生
		$row = M('yf_guozhang a')
			->join('ykb_supplier b on b.id=a.supplierId')
			->where($map)
			->field('sum(a.money)as fsMoney,a.supplierId,b.supplier_name')
			->limit($Page->firstRow.','.$Page->listRows)
			->group('a.supplierId') 
			->order('a.supplierId asc') 
			->select();
		foreach($row as & $v){
            //期初金额
            $rowset[$v['supplierId']]['initMoney']=round(($v['fsMoney']+0),3);//期初余额
            $rowset[$v['supplierId']]['initIn']=round(($v['fsMoney']+0),3);
        }
        //期初收款
        $incomeStart = strtotime($conditions['start_time']);
        $mapIncome['payment_date'] = array('lt',$incomeStart);
        $sqlIncome = M('payment_money a')
			->where($mapIncome)
			->field('sum(a.payment_money) as FukuMoney,a.sid as supplierId')
			->group('a.sid') 
			->order('a.sid asc') 
			->select();
		foreach($sqlIncome as & $v){
			if(!$v['supplierId']) continue;
            //期初金额
            $rowset[$v['supplierId']]['initMoney']=round(($rowset[$v['supplierId']]['initMoney']+$v['FukuMoney']+0),3);//期初余额=期初发生-期初已付款
            $rowset[$v['supplierId']]['initOut']=round($v['FukuMoney'],3);
        }
        //本期收款
        $curStart = strtotime($conditions['start_time']);
        $curEnd = strtotime($conditions['end_time']);
		$mapCur['payment_date'] = array('between',array($curStart,$curEnd));
        $mapCur['supplierId'] = array('gt',0);
        $curIncome = M('payment_money a')
			->where($mapCur)
			->field('sum(a.payment_money) as moneyfukuan,a.supplierId')
			->group('a.supplierId') 
			->order('a.supplierId asc') 
			->select();
		foreach($curIncome as & $v1){
            $rowset[$v1['supplierId']]['fukuanMoney']=round(($v1['moneyfukuan']+0),3);
        }
        //本期发生
        $curFsStart = $conditions['start_time'];
        $curFsEnd = $conditions['end_time'];
		$mapCurFs['guozhangDate'] = array('between',array($curFsStart,$curFsEnd));
        $mapCurFs['supplierId'] = array('gt',0);
		$curFs = M('yf_guozhang a')
			->where($mapCurFs)
			->field('sum(a.money)as fsMoney,a.supplierId')
			->group('a.supplierId') 
			->order('a.supplierId asc') 
			->select();
        foreach($curFs as & $v2){
            $rowset[$v2['supplierId']]['fsMoney']=round(($v2['fsMoney']+0),3);
        }
        if(count($rowset)>0){
            foreach($rowset as $key => & $v){
            	$supplierArr = array();
            	$supplierArr['id'] = $key;
            	$supps = D('supplier')->where($supplierArr)->field('id,supplier_name')->find();
       			$v['supplierId'] = $supps['id'];
       			$v['supplier_name'] = $supps['supplier_name'];

                $v['weifuMoney']=round(($v['initMoney']+$v['fsMoney']+$v['fukuanMoney']),3);
            }
        }

    
		$this->Ruku = $rowset;
		$this->display();
	} 

	/**
	 * 对账单明细
	 * @author shen 
	 * 2018-8-9 
	 */
	public function Duizhang(){ 
		$conditions = I('param.');

		if(empty($conditions['supplierId'])){
            echo "缺少供应加工商信息";exit;
        }
        $supplier['id'] = $conditions['supplierId'];
        $jgh = M('supplier a')
			->where($supplier)
			->field('supplier_name')
			->select();
		$this->jghName = $jgh[0]['supplier_name'];

		//期初发生
		$timeStart = $conditions['start_time'];
		$map['guozhangDate'] = array('lt',$timeStart);
        $map['b.id'] = $conditions['supplierId'];
		$fsMoney = M('yf_guozhang a')
			->join('ykb_supplier b on b.id=a.supplierId')
			->where($map)
			->field('sum(a.money*-1)as money')
			->group('a.supplierId') 
			->order('a.supplierId asc') 
			->select();

        //期初付款
		$incomeStart = strtotime($conditions['start_time']);
        $mapIncome['payment_date'] = array('lt',$incomeStart);
        $mapIncome['a.supplierId'] = $conditions['supplierId'];
        $sqlIncome = M('payment_money a')
			->where($mapIncome)
			->field('sum(a.payment_money) as money')
			->group('a.supplierId') 
			->order('a.supplierId asc') 
			->select();

		$row['money']=round($fsMoney[0]['money']-$sqlIncome[0]['money'],2);
        $row['kind']="<b>期初余额</b>";

	 	$curStart =$conditions['start_time'];
        $curEnd = $conditions['end_time'];
		$mapCur['a.guozhangDate'] = array('between',array($curStart,$curEnd));
        $mapCur['a.supplierId'] = $conditions['supplierId'];
		$rowset = M('yf_guozhang a')
			->join('ykb_base_product b on b.id=a.productId')
			->join('ykb_ruku c on c.id=a.rukuId')
			->where($mapCur)
			->field('a.*,b.name as proName,b.code as proCode,b.kind as proKind,null as proColor,c.ruku_code as rukuCode,c.ruku_date as rukuDate')
			->select();
		$backMoney = 0;
		foreach ($rowset as $k => &$v) {
			if($v['kind']=='原料退回'){
				$backMoney +=$v['money'];
			}
			$v['cnt'] = $v['cnt'] *-1;
			$v['money'] = $v['money'] *-1;
			$v['rukuDate'] = date('Y-m-d', $v['rukuDate']);
		}
		//本期付款
		$currentStart = strtotime($conditions['start_time']);
		$currentEnd = strtotime($conditions['end_time']);
        $mapCurrent['payment_date'] = array('between',array($currentStart,$currentEnd));
        $mapCurrent['a.supplierId'] = $conditions['supplierId'];
        $sqlCurrent = M('payment_money a')
			->where($mapCurrent)
			->field('a.payment_money,a.payment_date,a.memo')
			->order('a.supplierId asc') 
			->select();
		foreach ($sqlCurrent as & $v){
            if($v['payment_money']>0){
            	$rowset[] = array(
            		'rukuDate'=>date('Y-m-d',$v['payment_date']),
            		'money'=>$v['payment_money']*-1,
            		'kind'=>'本期付款',
            		'memo'=>$v['memo'],
        		);
            }
        }
        $ret=array_merge(array($row),$rowset);
        // $ret = $rowset;
		$ret = $this->array_sort($ret,'rukuDate');
     	$heji = $this->getHeji($ret, array('cnt','money'), 'kind');
     	$heji['rukuCode'] = '合计';
        $ret[]=$heji;
        // dump($ret);die;
        $this->backMoney = $backMoney;
		$this->Duizhang = $ret;
		$this->display();
	}


	/**
	 * Ajax 查询收支明细
	 * @author shen
	 * 2018-08-09
	 *
	 */
	public function mingxiAjax(){
		$conditions = $_POST;

	 	$curStart =$conditions['start_time'];
        $curEnd = $conditions['end_time'];
		$mapCur['a.guozhangDate'] = array('between',array($curStart,$curEnd));
        $mapCur['a.supplierId'] = $conditions['supplierId'];
		$rowset = M('yf_guozhang a')
			->join('ykb_base_product b on b.id=a.productId')
			->join('ykb_ruku c on c.id=a.rukuId')
			->join('ykb_supplier d on d.id=a.supplierId')
			->where($mapCur)
			->field('a.*,b.name as proName,b.code as proCode,c.ruku_code as rukuCode,c.ruku_date as rukuDate,d.supplier_name')
			->select();
		foreach ($rowset as $k => &$v) {
			$v['rukuDate'] = date('Y-m-d', $v['rukuDate']);
			$v['cnt'] = $v['cnt']*-1;
			$v['money'] = $v['money']*-1;
		}

		$ret = $this->array_sort($rowset,'rukuDate');

     	$heji = $this->getHeji($ret, array('cnt','money'), 'kind');
     	$heji['rukuCode'] = '合计';
        $ret[]=$heji;
		//排序
		//合计
		$data['list']=$ret;
		// $moneyIncome = $totalIncome+$totalIncome2;
		// $moneyExpense = $totalExpense+$totalExpense2+$totalExpenseG;
		// $totalRemain = round($totalInit + $totalIncome + $totalIncome2 - $totalExpense - $totalExpense2 - $totalExpenseG,2);
		// $data['moneyIncome']=$moneyIncome;
		// $data['moneyExpense']=$moneyExpense;
		$this->ajaxReturn($data);
	}


	/**
	 * Ajax 查询本期付款
	 * @author shen
	 * 2018-08-09
	 *
	 */
	public function BqFkAjax(){
		$conditions = $_POST;

		$currentStart = strtotime($conditions['start_time']);
		$currentEnd = strtotime($conditions['end_time']);
        $mapCurrent['payment_date'] = array('between',array($currentStart,$currentEnd));
        $mapCurrent['a.supplierId'] = $conditions['supplierId'];
        $ret = M('payment_money a')
			->where($mapCurrent)
			->field('a.*')
			->order('a.supplierId asc') 
			->select();

		foreach ($ret as $k => &$v) {
			$v['paymentDate'] = date('Y-m-d', $v['payment_date']);
			$v['money'] = $v['payment_money']*-1;
		}

     	$heji = $this->getHeji($ret, array('cnt','money'), 'paymentDate');
     	$heji['paymentDate'] = '合计';
        $ret[]=$heji;
		$data['list']=$ret;
		$this->ajaxReturn($data);
	}
}

?>