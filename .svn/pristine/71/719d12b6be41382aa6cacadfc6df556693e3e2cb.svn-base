<?php 
	namespace Profit\Model;
	use Think\Model;
	class Profit extends Model
	{   
		//定义主表名称
		Protected $tableName = 'profit';
		//自动验证
		protected $_validate = array(     
			array('store','require','店铺必选！'),
			array('date','require','日期必填！'),
			array('uid','require','负责人必选！'),
			array('realMoney','require','销售额必填！'),
			array('zcMoney','require','种菜额必填！'),
			array('rate','require','利润率必填！'),
			array('zcRate','require','种菜费用率必填！'),
		);
	}
?>
