<?php 
namespace Finance\Controller;
use Common\Controller\CommonController;
class YsGzController extends CommonController { 
	
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

		$count = M('ar_guozhang')
				->where($map)
				->group('clientId')
				->count();
		$Page = new \Think\Page($count,100,I('param.'));
		$this->page = $Page->show();

        //期初发生
		$row = M('ar_guozhang a')
			->join('ykb_client b on b.id=a.clientId')
			->where($map)
			->field('sum(a.money)as fsMoney,a.clientId,b.company as client_name')
			->limit($Page->firstRow.','.$Page->listRows)
			->group('a.clientId') 
			->order('a.clientId asc') 
			->select();

		foreach($row as & $v){
            //期初金额
            $rowset[$v['clientId']]['initMoney']=round(($v['fsMoney']+0),3);//期初余额
            $rowset[$v['clientId']]['initIn']=round(($v['fsMoney']+0),3);
        }
        //期初收款
        $incomeStart = strtotime($conditions['start_time']);
        $mapIncome['collection_date'] = array('lt',$incomeStart);
		$mapIncome['isYF'] = 1;
        $sqlIncome = M('collection_money a')
			->where($mapIncome)
			->field('sum(a.collection_money) as FukuMoney,a.cid as clientId')
			->group('a.cid') 
			->order('a.cid asc') 
			->select();
		foreach($sqlIncome as & $v1){
            //期初金额
            $rowset[$v['clientId']]['initMoney']=round(($rowset[$v['clientId']]['initMoney']-$v['FukuMoney']+0),3);//期初余额=期初发生-期初已付款
            $rowset[$v['clientId']]['initOut']=round($v['FukuMoney'],3);
        }

        //本期收款
        $curStart = strtotime($conditions['start_time']);
        $curEnd = strtotime($conditions['end_time']);
		$mapCur['collection_date'] = array('between',array($curStart,$curEnd));
		$mapCur['isYF'] = 1;
        $curIncome = M('collection_money a')
			->where($mapCur)
			->field('sum(a.collection_money) as moneyfukuan,a.cid as clientId')
			->group('a.cid') 
			->order('a.cid asc') 
			->select();
		foreach($curIncome as & $v1){
            $rowset[$v1['clientId']]['fukuanMoney']=round(($v1['moneyfukuan']+0),3);
        }
        //本期发生
        $curFsStart = $conditions['start_time'];
        $curFsEnd = $conditions['end_time'];
		$mapCurFs['guozhangDate'] = array('between',array($curFsStart,$curFsEnd));
		$mapCurFs['clientId'] = array('gt',0);
		$curFs = M('ar_guozhang a')
			->where($mapCurFs)
			->field('sum(a.money)as fsMoney,a.clientId')
			->group('a.clientId') 
			->order('a.clientId asc') 
			->select();
        foreach($curFs as & $v2){
            $rowset[$v2['clientId']]['fsMoney']=round(($v2['fsMoney']+0),3);
        }

        if(count($rowset)>0){
            foreach($rowset as $key => & $v){
            	$clientArr = array();
            	$clientArr['id'] = $key;
            	$supps = D('client')->where($clientArr)->field('id,company as client_name')->find();
       			$v['clientId'] = $supps['id'];
       			$v['client_name'] = $supps['client_name'];

                $v['weifuMoney']=round(($v['initMoney']+$v['fsMoney']-$v['fukuanMoney']),3);
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

		if(empty($conditions['clientId'])){
            echo "Supplier is necessary";exit;
        }
        $client['id'] = $conditions['clientId'];
        $jgh = M('client a')
			->where($client)
			->field('company')
			->select();
		$this->client_name = $jgh[0]['company'];

		//期初发生
		$timeStart = $conditions['start_time'];
		$map['guozhangDate'] = array('lt',$timeStart);
        $map['b.id'] = $conditions['clientId'];
		$fsMoney = M('ar_guozhang a')
			->join('ykb_client b on b.id=a.clientId')
			->where($map)
			->field('sum(a.money)as money')
			->group('a.clientId') 
			->order('a.clientId asc') 
			->select();
        //期初付款
		$incomeStart = strtotime($conditions['start_time']);
        $mapIncome['collection_date'] = array('lt',$incomeStart);
        $mapIncome['a.cid'] = $conditions['clientId'];
        $sqlIncome = M('collection_money a')
			->where($mapIncome)
			->field('sum(a.collection_money) as money')
			->group('a.cid') 
			->order('a.cid asc') 
			->select();

		$row['money']=round($fsMoney[0]['money']-$sqlIncome[0]['money'],2);
        $row['kind']="<b>期初余额</b>";

	 	$curStart =$conditions['start_time'];
        $curEnd = $conditions['end_time'];
		$mapCur['a.guozhangDate'] = array('between',array($curStart,$curEnd));
        $mapCur['a.clientId'] = $conditions['clientId'];
		$rowset = M('ar_guozhang a')
			->join('ykb_chengpin_product b on b.id=a.productId')
			->join('ykb_cp_chuku c on c.id=a.chukuId')
			->where($mapCur)
			->field('a.*,b.name as proName,b.code as proCode,b.kind as proKind,b.color as proColor,c.chuku_code as chukuCode,c.chuku_date as chukuDate')
			->select();
		foreach ($rowset as $k => &$v) {
			$v['chukuDate'] = date('Y-m-d', $v['chukuDate']);
		}

		//本期收款
		$currentStart = strtotime($conditions['start_time']);
		$currentEnd = strtotime($conditions['end_time']);
        $mapCurrent['collection_date'] = array('between',array($currentStart,$currentEnd));
		$mapCurrent['isYF'] = 1;
        $mapCurrent['cid'] = $conditions['clientId'];
        $sqlCurrent = M('collection_money a')
			->where($mapCurrent)
			->field('a.collection_money,a.collection_date,a.memo')
			->order('a.cid asc') 
			->select();
		foreach ($sqlCurrent as & $v){
            if($v['collection_money']>0){
            	$rowset[] = array(
            		'chukuDate'=>date('Y-m-d',$v['collection_date']),
            		'money'=>$v['collection_money']*-1,
            		'kind'=>'本期收款',
            		'memo'=>$v['memo'],
        		);
            }
        }

        $ret=array_merge(array($row),$rowset);
		$ret = $this->array_sort($ret,'chukuDate');

     	$heji = $this->getHeji($ret, array('cnt','money'), 'kind');
     	$heji['chukuCode'] = '合计';
        $ret[]=$heji;
        // dump($ret);die;

		$this->Duizhang = $ret;
		$this->display();
	}


	/**
	 * Ajax 查询收支明细
	 * @ author shen
	 * 2018-08-09
	 *
	 */
	public function mingxiAjax(){
		$conditions = $_POST;

	 	$curStart =$conditions['start_time'];
        $curEnd = $conditions['end_time'];
		$mapCur['a.guozhangDate'] = array('between',array($curStart,$curEnd));
        $mapCur['a.clientId'] = $conditions['clientId'];
		$rowset = M('ar_guozhang a')
			->join('ykb_chengpin_product b on b.id=a.productId')
			->join('ykb_cp_chuku c on c.id=a.chukuId')
			->join('ykb_client d on d.id=a.clientId')
			->where($mapCur)
			->field('a.*,b.name as proName,b.code as proCode,c.chuku_code as chukuCode,c.chuku_date as chukuDate,d.company as client_name')
			->select();
		foreach ($rowset as $k => &$v) {
			$v['chukuDate'] = date('Y-m-d', $v['chukuDate']);
			$v['cnt'] = $v['cnt'];
			$v['money'] = $v['money'];
		}

		$ret = $this->array_sort($rowset,'chukuDate');

     	$heji = $this->getHeji($ret, array('cnt','money'), 'kind');
     	$heji['chukuCode'] = '合计';
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
	 * Ajax 查询本期收款
	 * @ author shen
	 * 2018-08-09
	 *
	 */
	public function BqSkAjax(){
		$conditions = $_POST;

		$currentStart = strtotime($conditions['start_time']);
		$currentEnd = strtotime($conditions['end_time']);
        $mapCurrent['collection_date'] = array('between',array($currentStart,$currentEnd));
        $mapCurrent['a.cid'] = $conditions['clientId'];
        $ret = M('collection_money a')
			->where($mapCurrent)
			->field('a.*')
			->select();

		foreach ($ret as $k => &$v) {
			$v['collection_date'] = date('Y-m-d', $v['collection_date']);
			$v['money'] = $v['collection_money']*-1;
		}
     	$heji = $this->getHeji($ret, array('money'), 'collection_date');
     	$heji['collection_date'] = '合计';
        $ret[]=$heji;
		$data['list']=$ret;
		$this->ajaxReturn($data);
	}
}

?>