<?php 
	namespace Storehouse\Model;
	use Think\Model;
	class PaymentModel extends Model
	{   
		//定义主表名称
		Protected $tableName = 'yl_payment';
		//自动验证
		protected $_validate = array(     
			array('payment_money','require','付款金额必须！'),
			array('payment_date','require','付款日期必须！'),
			array('sid','require','供应商必须！'),
			array('bankid','require','银行账户必须！'),
		);
	}
?>
