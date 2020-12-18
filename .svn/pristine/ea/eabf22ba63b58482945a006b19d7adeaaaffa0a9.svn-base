<?php
namespace Storehouse\Model;
use Think\Model\RelationModel;
class ChukuModel extends RelationModel
{
	//定义主表名称
	Protected $tableName = 'chuku';
	
	//定义关联关系
	Protected $_link = array(
		'ruku_product' =>array(
			'mapping_type' => self::HAS_MANY,
			'class_name'    =>'chuku_product',
			'foreign_key' => 'chukuId',
			'mapping_name'=>'chuku_product',
		),
	);
	//自动验证
	protected $_validate = array(
		array('chuku_date','require','出库日期必须！'),
		array('productId[]','require','产品必须！'),
		array('cnt[]','require','出库数量必须！'),
	);
}
?>