<?php 
namespace Finance\Controller;
use Common\Controller\CommonController;
class CashController extends CommonController {
	
	/**
	 * 现金日报表查询
	 * @author xuli
	 * 2015-1-16
	 */
	public function index() {
		$conditions = I('param.'); 
		if($conditions['bank'] != NUll){
			$map4['collection_bankid'] = $map3['payment_bankid'] = $map2['bankid'] = $map['bankid']  = $conditions['bank'];
			$collect_early_date['bankid']=$pay_early_date['bankid']=$conditions['bank'];
			$this->bankid = $conditions['bank'];
		}  
		if($conditions['start_time'] != NULL && $conditions['end_time'] != NULL){
			$time[0] = strtotime($conditions['start_time']);
			$time[1] = strtotime($conditions['end_time']);
			$map['collection_date'] = array('between',array($time[0],$time[1]));
			$map2['payment_date'] = array('between',array($time[0],$time[1]));
			$map3['transfer_date'] = array('between',array($time[0],$time[1]));
			$map4['transfer_date'] = array('between',array($time[0],$time[1]));
			$this->start_time = $conditions['start_time'];
			$this->end_time = $conditions['end_time'];
		}else{
			//TODO:需优化！太难看了，虽然功能OK了
			if($conditions['time_kind'] !=NULL){
				
			}else{ 
				$time[0] = strtotime(date('Y-m-1'));
				$time[1] = strtotime(date("Y-m-d"));
				$map['collection_date'] = array('between',array($time[0],$time[1]));
				$map2['payment_date'] = array('between',array($time[0],$time[1]));
				$map3['transfer_date'] = array('between',array($time[0],$time[1]));
				$map4['transfer_date'] = array('between',array($time[0],$time[1]));
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
			$map4['transfer_memo'] = $map3['transfer_memo'] = $map2['memo'] = $map['memo'] = array('like','%'.trim($conditions['memo']).'%');
			$this->memo = $conditions['memo'];
		} 
		//期初其他支出 
		$pay_early_date['payment_date'] = array('LT',$time[0]);
		$pay_early = M('payment_money')->where($pay_early_date)->select();
		if(count($pay_early)>0)foreach($pay_early as & $v){
			$totalInitP +=$v['payment_money'];
		}
		//期初供应商支出
		$pay_early2 = M('yl_payment')->where($pay_early_date)->select();
		if(count($pay_early2)>0)foreach($pay_early2 as & $v){
			$totalInitG +=$v['payment_money'];
		}
		//期初收入
		$collect_early_date['collection_date'] = array('LT',$time[0]);
		$collect_early = M('collection_money')->where($collect_early_date)->select();
		if(count($collect_early)>0)foreach($collect_early as & $v){
			$totalInitC +=$v['collection_money'];
		}
		
		//总期初
		$totalInit = $totalInitC - $totalInitP - $totalInitG;
		$this->remain = $totalInit > 0 ? $totalInit:0;
		
		$arrRet = array();
		$i=0;
		$totalIncome =0;
		$totalExpense = 0;
		$type = C('collection_type');
		//其他支出
		$pay = M('payment_money')->where($map2)->order('payment_date asc')->select();
		if(count($pay)>0)foreach($pay as & $v){
			$arrRet[$i]['date'] = date('Y-m-d',$v['payment_date']);
			$arrRet[$i]['type'] = $type[$v['payment_type']];
			$arrRet[$i]['son_name'] = $this->getSon2($v['item'])."->".$this->getSon2($v['son']);
			$arrRet[$i]['bankname'] = $this->getBankname($v['bankid']);
			$arrRet[$i]['expense'] = $v['payment_money'];
			$arrRet[$i]['memo'] = $v['memo'];
			if(mb_strlen($v['memo'],'utf8')<12){
				$arrRet[$i]['memo2'] = $v['memo'];
			}else{
				$arrRet[$i]['memo2'] = mb_substr($v['memo'], 0, 12, 'utf-8')."...";
			} 
			$i++;
			$totalExpense += $v['payment_money'];
		}
		//供应商支出
		$pay2 = M('yl_payment')->where($map2)->order('payment_date asc')->select();
		if(count($pay2)>0)foreach($pay2 as & $v){
			$arrRet[$i]['date'] = date('Y-m-d',$v['payment_date']);
			$arrRet[$i]['type'] = $type[$v['payment_type']];
			$arrRet[$i]['son_name'] = $v['kind']==1?"成品付款":"原料付款";
			$arrRet[$i]['clientName'] = $v['supplier_name'];
			if(mb_strlen($v['supplier_name'],'utf8') < 7){
				$arrRet[$i]['clientName2'] = $v['supplier_name'];
			}else{
				$arrRet[$i]['clientName2'] = mb_substr($v['supplier_name'], 0, 7, 'utf-8')."...";
			} 
			$arrRet[$i]['bankname'] = $this->getBankname($v['bankid']);
			$arrRet[$i]['expense'] = $v['payment_money'];
			$arrRet[$i]['memo'] = $v['memo'];
			if(mb_strlen($v['memo'],'utf8')<12){
				$arrRet[$i]['memo2'] = $v['memo'];
			}else{
				$arrRet[$i]['memo2'] = mb_substr($v['memo'], 0, 12, 'utf-8')."...";
			}
			$i++;
			$totalExpenseG += $v['payment_money'];
		}
		//收入
		$collect = M('collection_money m')->join('ykb_client a ON a.id = m.cid')->where($map)->field('a.company,m.*')->order('collection_date asc')->select();
		if(count($collect)>0)foreach($collect as & $v){
			$arrRet[$i]['date'] = date('Y-m-d',$v['collection_date']);
			$arrRet[$i]['type'] = $type[$v['collection_type']];
			$arrRet[$i]['son_name'] = $this->getSon($v['item'])."->".$this->getSon($v['son']);
			$arrRet[$i]['bankname'] = $this->getBankname($v['bankid']);
			$arrRet[$i]['clientName'] = $v['company'];
			if(mb_strlen($v['company'],'utf8') < 7){
				$arrRet[$i]['clientName2'] = $v['company'];
			}else{
				$arrRet[$i]['clientName2'] = mb_substr($v['company'], 0, 7, 'utf-8')."...";
			}
			$arrRet[$i]['income'] = $v['collection_money'];
			$arrRet[$i]['memo'] = $v['memo'];
			if(mb_strlen($v['memo'],'utf8') < 12){
				$arrRet[$i]['memo2'] = $v['memo'];
			}else{
				$arrRet[$i]['memo2'] = mb_substr($v['memo'], 0, 12, 'utf-8')."...";
			} 
			$i++;
			$totalIncome += $v['collection_money']; 
		}
		//转账支出
		$transfer_payment = M('transfer')->where($map3)->order('transfer_date asc')->select();
		if(count($transfer_payment)>0)foreach($transfer_payment as & $v){
			$arrRet[$i]['date'] = date('Y-m-d',$v['transfer_date']);
			$arrRet[$i]['son_name'] = "内部转账->转出";
			$arrRet[$i]['bankname'] = $this->getBankname($v['payment_bankid']);
			$arrRet[$i]['expense'] = $v['transfer_money'];
			$arrRet[$i]['memo'] = $v['transfer_memo'];
			if(mb_strlen($v['transfer_memo'],'utf8')<12){
				$arrRet[$i]['memo2'] = $v['transfer_memo'];
			}else{
				$arrRet[$i]['memo2'] = mb_substr($v['transfer_memo'], 0, 12, 'utf-8')."...";
			} 
			$i++;
			$totalExpense2 += $v['transfer_money']; 
		}
		//转账收入
		$transfer_collection = M('transfer')->where($map4)->order('transfer_date asc')->select();
		if(count($transfer_collection)>0)foreach($transfer_collection as & $v){
			$arrRet[$i]['date'] = date('Y-m-d',$v['transfer_date']);
			$arrRet[$i]['son_name'] = "内部转账->转入";
			$arrRet[$i]['bankname'] = $this->getBankname($v['collection_bankid']);
			$arrRet[$i]['income'] = $v['transfer_money'];
			$arrRet[$i]['memo'] = $v['transfer_memo'];
			if(mb_strlen($v['transfer_memo'],'utf8')<12){
				$arrRet[$i]['memo2'] = $v['transfer_memo'];
			}else{
				$arrRet[$i]['memo2'] = mb_substr($v['transfer_memo'], 0, 12, 'utf-8')."...";
			} 
			$i++;
			$totalIncome2 += $v['transfer_money'];
		}
		//排序
		$arrRet = $this->array_sort($arrRet,'date');
		$Page = new \Think\Page($i,200,I('param.'));
		$newarray_1 = array_slice($arrRet,$Page->firstRow,$Page->listRows);
		$this->page = $Page->show();
		$this->money = $newarray_1;
		//合计
		$this->moneyIncome = $totalIncome+$totalIncome2;
		$this->moneyExpense = $totalExpense+$totalExpense2+$totalExpenseG;
		$this->totalRemain = round($totalInit + $totalIncome + $totalIncome2 - $totalExpense - $totalExpense2 - $totalExpenseG,2);
		//银行
		$this->bank = M('bank')->select();
		$this->display();
	}
	
}

?>