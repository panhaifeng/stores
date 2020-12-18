<?php 
	namespace Finance\Model;
	use Think\Model;
	class TransferModel extends Model
	{   
		//定义主表名称
		Protected $tableName = 'transfer';
		//自动验证
		protected $_validate = array(     
			array('transfer_money','require','付款金额必须！'),
			array('transfer_date','require','付款日期必须！'),
			array('payment_bankid','require','转出银行必须！'),
			array('collection_bankid','require','转入银行必须！'),
		);
	}
?>
