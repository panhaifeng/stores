<?php
namespace Storehouse\Model;
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
	//自动验证
	protected $_validate = array(
			array('ruku_date','require','入库日期必须！'),
			array('kind','require','入库类型必须！'),
			array('productId[]','require','产品必须！'),
			array('cnt[]','require','入库数量必须！'),
	);
}
?>