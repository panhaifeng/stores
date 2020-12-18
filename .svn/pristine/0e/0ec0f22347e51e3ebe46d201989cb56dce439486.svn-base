<?php
namespace Memorandum\Model;
use Think\Model\RelationModel;
class MemorandumModel extends RelationModel
{
	//定义主表名称
	Protected $tableName = 'memorandum';
	
	//自动验证
	protected $_validate = array(
			array('cid','require','客户必须！'),
			array('salesman','require','签单人必须！'),
			array('orderCode','require','合同号必须！'),
			array('orderDate','require','签订时间必须！'),
			array('start_time','require','合同开始时间必须！'),
			array('end_time','require','合同结束时间必须！'),
			array('productId','require','产品必须！'),
			array('money','require','合同金额必须！'),
			array('shuilv','require','税率必须！'),
	);
}
?>