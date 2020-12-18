<?php
namespace Client\Model;
use Think\Model\RelationModel;
class ClientModel extends RelationModel
{
	//定义主表名称
	Protected $tableName = 'client';
	//自动验证
	/* protected $_validate = array(
			array('company','','公司名称已经存在！',0,'unique',1), // 在新增的时候验证name字段是否唯一
	); */
	
	//定义关联关系
	Protected $_link = array(
		'client_contact' =>array(
				'mapping_type' => self::HAS_MANY,
				'class_name'    =>'client_contact',
				'foreign_key' => 'cid',
				'mapping_name'=>'client_contact',
			)
	);
}
?>