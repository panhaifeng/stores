<?php
namespace Finance\Model;
use Think\Model;
class PostModel extends Model 
{
	//定义主表名称
	Protected $tableName = 'kucun'; 
	
	
	/**
	 * 修改库存表操作(封装的不是很好，待优化)
	 * @param $data 数组  $keyword 外键  $kind 判断出入库  
	 * @author xuli
	 * 2015-02-12
	 */
	Public function _after_edit($data,$keyword,$kind) {
		$judge = stripos($kind,"ruku");//判断出入库；判断入库，是则返回值，不是则返回false
		if($judge){
			$map['rukuId'] = $data['id'];
			$sonid = 'ruku2proId';
			$mainid = 'rukuId';
		}
		$son = M($keyword)->where($map)->select();
		if(count($son)>0)foreach($son as &$v){
			$map2[$mainid] = $v[$mainid];
			$res = M('kucun')->where($map2)->delete();
		} 
		if($judge){
			$product = array();
			foreach($son as $k => $val){
				$product[] = array(
					'rukuId' => $data['id'],
					'dateFasheng' => $data['ruku_date'],
					'sid'   => $data['sid'],
					'kind'  => '入库',
					'proId'	=> $val['productId'],
					'cntFasheng'	=> $val['cnt'],
					'priceFasheng'	=> $val['price'],
					'moneyFasheng'	=> $val['money'],
					$sonid	=> $val['id'],
				);
			}
		}
		$row = $product;
		$aa = M('kucun')->addAll($row);
		return $aa;
	}
	
}
?>