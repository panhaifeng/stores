<?php
return array(
		'table' => array(
				'ykb_client' =>'客户表' ,
				'ykb_client_contact' =>'联系人' ,
		),
		//客户表
	'ykb_client' => array(
			'company' =>'客户名称' ,
			'salesman' =>'业务员' ,
			'province' =>'省' ,
			'city' =>'市' ,
			'area' =>'县',
			'source' =>'来源',
			'industry' =>'行业',
			'industry_size' =>'行业规模',
			'memo' =>'备注',
			'ctime' =>'创建时间',
	),
	//联系人表
	'ykb_client_contact' => array(
			'contact_name' =>'联系人姓名' ,
			'telephone' =>'手机' ,
			'email' =>'邮箱' ,
			'position' =>'职位' ,
			'birthday' =>'生日',
			'card_id' =>'身份证号',
			'contact_memo' =>'备注',
	),
// 		行动表
	'contact' => array(
			'contact_time' =>'行动时间' ,
			'sid' =>'行动人' ,
			'contact_type' =>'行动类型' ,
			'memo' =>'行动反馈' ,
			'feedback' =>'行动反馈',
			'feedback_memo' =>'反馈备注',
			'update_time' =>'创建时间',
	),
);