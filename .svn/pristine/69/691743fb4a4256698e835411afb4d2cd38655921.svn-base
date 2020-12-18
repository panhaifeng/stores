<?php
namespace Storehouse\Model;
use Think\Model;
class KucunModel extends Model 
{
	//定义主表名称
	Protected $tableName = 'cp_kucun'; 
	
	/**
	 * 插入库存表操作(封装的不是很好，待优化)
	 * @param $row 主表id  $fieldName 写入库存表判别字段   $tableM 主表名   $tableS 从表名  $kind 判断出入库   
	 * @author xuli 
	 * @ 2015-02-12 
	 */
	Public function _after_save($id,$fieldName,$tableM,$tableS,$kind) {
		$judge = stripos($kind,"ruku");//判断出入库；判断入库，是则返回值，不是则返回false
		$map2['id'] = $id;
		$main = M($tableM)->where($map2)->find();
		$map[$fieldName] = $id;
		$son = M($tableS)->where($map)->select();
		if($judge){
			$sonId = 'ruku2proId';
			$kind = $main['kind'] == 1? "外购入库" : "生产入库";
			foreach($son as $k => $v){
				$product[] = array(
					$fieldName => $main['id'],
					'dateFasheng' => $main['ruku_date'],
					'sid'   => $main['sid'],
					'kind'  => $kind,
					'proId'	=> $son[$k]['productId'],
					'cntFasheng'	=> $son[$k]['cnt'],
					$sonId	=> $son[$k]['id'],
				);
			}
		}else{
			$sonId = 'chuku2proId';
			foreach($son as $k => $v){
				$product[] = array(
					$fieldName => $main['id'],
					'dateFasheng' => $main['chuku_date'],
					'kind'  => '出库',
					'proId'	=> $son[$k]['productId'],
					'cntFasheng'	=> $son[$k]['cnt']*-1,
					$sonId	=> $son[$k]['id'],
				);
			}
		}
		$row = $product;
		$res = M('cp_kucun')->addAll($row);
		return $res;
	}
	
	/**
	 * 修改库存表操作(封装的不是很好，待优化)
	 * @param $data 数组  $keyword 子表名   $kind 判断出入库  
	 * @author xuli
	 * 2015-02-12
	 */
	Public function _after_edit($data,$keyword,$kind) {
		$judge = stripos($kind,"ruku");//判断出入库；判断入库，是则返回值，不是则返回false
		if($judge){
			$map['rukuId'] = $data['id'];
			$sonid = 'ruku2proId';
			$mainid = 'rukuId';
		}else{
			$map['chukuId'] = $data['id'];
			$sonid = 'chuku2proId';
			$mainid = 'chukuId';
		}
		$son = M($keyword)->where($map)->select();
		if(count($son)>0)foreach($son as &$v){
			$map2[$mainid] = $v[$mainid];
			$res = M('cp_kucun')->where($map2)->delete();
		} 
		if($judge){
			$product = array();
			$kind = $data['kind'] == 1? "外购入库" : "生产入库";
			foreach($son as $k => $val){
				$product[] = array(
					'rukuId' => $data['id'],
					'dateFasheng' => $data['ruku_date'],
					'sid'   => $data['sid'],
					'kind'  => $kind,
					'proId'	=> $val['productId'],
					'cntFasheng'	=> $val['cnt'],
					$sonid	=> $val['id'],
				);
			}
		}else{
			foreach($son as $k => $val){
				$product[] = array(
					'chukuId' => $data['id'],
					'dateFasheng' => $data['chuku_date'],
					'kind'  => '出库',
					'proId'	=> $val['productId'],
					'cntFasheng'	=> $val['cnt']*-1,
					$sonid	=> $val['id'],
				);
			}
		}
		$row = $product;
		$aa = M('cp_kucun')->addAll($row);
		return $aa;
	}
	
	/**
	 * 删除库存表操作
	 * @param $id 主表id $fieldName 写入库存表判别字段 
	 */
	Public function _after_del($id,$fieldName) {
		$map[$fieldName] = $id;
		$res = M('cp_kucun')->where($map)->select();
		foreach($res as &$v){
			$map2['id'] = $v['id'];
			$row = M('cp_kucun')->where($map2)->delete();
		}
		return $res;
	}
}
?>