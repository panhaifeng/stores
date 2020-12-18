<?php
namespace Baseinfo\Model;
use Think\Model\RelationModel;
class CprukuModel extends RelationModel
{
	//定义主表名称
	Protected $tableName = 'cp_ruku';
	
	//定义关联关系
	Protected $_link = array(
			'ruku_product' =>array(
				'mapping_type' => self::HAS_MANY,
				'class_name'    =>'cpruku_product',
				'foreign_key' => 'rukuId',
				'mapping_name'=>'ruku_product', 
			),
	);
	
}
?>