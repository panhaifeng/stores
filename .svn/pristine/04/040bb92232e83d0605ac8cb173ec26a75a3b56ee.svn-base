<?php 
	namespace Baseinfo\Model;
	use Think\Model\RelationModel;
	class ChengpinModel extends RelationModel 
	{
		//定义主表名称
		Protected $tableName = 'chengpin_product';
		
		//定义关联关系
		Protected $_link = array(
			'ChengpinForm' =>array(
				'mapping_type' => self::HAS_MANY,
				'class_name'    =>'ChengpinForm',
				'foreign_key' => 'pid',
				'mapping_name'=>'chengpinform',
			),
		);
		
		/**
		 * 编号自动生成
		 * @param $head 开头  $tblName 表名   $fieldName 字符名
		 */
		Public function _getCode($head,$tblName,$fieldName) {			
			$map[$fieldName] = array('like',$head.'%');
			$row = M($tblName)->where($map)->field($fieldName)->order($fieldName.' desc')->select();
			$init = $head.'0001';
			if(empty($row[0][$fieldName])) return $init;
			if($init>$row[0][$fieldName]) return $init;
			//自增1
			$max = substr($row[0][$fieldName],-4);
			$pre = substr($row[0][$fieldName],0,-4);
			return $pre .substr(10001+$max,1);
		}
	}

?> 