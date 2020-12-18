<?php
namespace Auth\Model;
use Think\Model\RelationModel;
class UserModel extends RelationModel
{
	//定义主表名称
	Protected $tableName = 'user';
	//自动验证
	protected $_validate = array(
		 array('user_name','require','员工账号不能为空！',0,'',3), // 账号必须
		 array('user_name','','该账号已经存在！',0,'unique',1), // 在新增的时候验证账号是否唯一
		 array('real_name','require','员工名称不能为空！'), // 在新增的时候验证学号字段是否唯一
		 array('user_id','require','微信号不能为空！',0,'',3), // 账号必须
		 array('user_id','','微信号已经存在！',0,'unique',1), // 在新增的时候验证账号是否唯一
		 //array('password','require','密码不能为空',0,'',1), // 验证确认密码是否和密码一致
		 array('bid','require','选择员工所在部门',0,'',3), //验证部门是否填写    
			 
	);
	//自动完成
	protected $_auto = array (   
		array('password','',3,'ignore'),       // 密码留空则忽略
		array('password','md5',3,'function') , // 对password字段在新增的时候使md5函数处理
		array('ctime','time',1,'function'),    // 对ctime字段在新增的时候写入当前时间戳   
		array('utime','time',2,'function'),    // 对utime字段在更新的时候写入当前时间戳
    );
	//定义关联关系
	Protected $_link = array(
		'auth_group_access' => array(
			'mapping_type'         =>  self::HAS_MANY,
			'class_name'           =>  'auth_group_access',
			'foreign_key'          =>  'uid',
			'mapping_name'         =>  'group',
		),
		// 'auth_store' => array(
  //          'mapping_type'         =>  self::HAS_MANY,
  //          'class_name'           => 'auth_store',
  //          'foreign_key'          => 'uid',
  //          'mapping_type'         => 'store',

  //   	)
			
	);

}
?>