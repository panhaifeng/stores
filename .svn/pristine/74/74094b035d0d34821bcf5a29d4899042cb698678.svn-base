<?php 
	namespace Finance\Model;
	use Think\Model;
	class PaymentModel extends Model
	{   
		//定义主表名称
		Protected $tableName = 'payment_money';
		//自动验证
		protected $_validate = array(     
			array('payment_money','require','付款金额必须！'),
			array('payment_date','require','付款日期必须！'),
			array('bankid','require','银行账户必须！'),
			array('item','require','项目大类必须！'),
			array('son','require','项目小类必须！'),
		);
	}
?>
