<?php
// +----------------------------------------------------------------------
// | Yikebao [ WE ARE EASY COMPANY ]
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://eqinfo.com.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: caibin <582079954@qq.com>
// +----------------------------------------------------------------------

return array(
	'MENU' => array(
		'1' => array('name'=>'系统首页') ,
		'2' => array('name'=>'部门') ,
		'3' => array('name'=>'岗位') ,
		'4' => array('name'=>'员工') ,
		'11' => array('name'=>'运营') ,
		'5' => array('name'=>'基础资料') ,
		'6' => array('name'=>'客户管理') ,
		'7' => array('name'=>'供应商管理') ,
		'8' => array('name'=>'仓库管理') ,
		'9' => array('name'=>'财务管理') ,
		'12' => array('name'=>'售后服务')
		//'10' => array('name'=>'合同') ,
		//'10' => array('name'=>'公告') ,
		
			
	),
	//无需验证的方法，配置规则 ：
	//1.MODULE_NAME.'/'.CONTROLLER_NAME.'/'.ACTION_NAME  不需要验证的方法	 
	//2.MODULE_NAME.'/'.CONTROLLER_NAME                  不需要验证的控制器
	//3.MODULE_NAME                                      不需要验证的模块    
	'NOT_AUTH' => array(
			//权限
			'Auth/User/resetPasswordHandle',             //保存修改密码
			'Auth/Role/access',             
			//客户
			'Client/Client/editClientHandle',            //保存编辑客户
			'Client/Client/addClientHandle',             //保存添加客户
			'Client/Client/city',						 //ajax 获取市县
			'Client/Client/area',                        //ajax 获取市县
			'Client/Client/clientPool',
			'Client/Client/ajaxPostLever',
			'Client/Client/clientAjax',
			'Client/Client/getClientKey',
			'Client/Client/upload',
			//供应商
			'Supplier/Index/addInsert',
			//仓库
			'Storehouse/Ruku/addInsert',				//原料入库
			'Storehouse/Ruku/supplierAjax',
			'Storehouse/Ruku/getSupplierKey',
			'Storehouse/Ruku/productAjax',
			'Storehouse/Ruku/getProductKey',
			'Storehouse/Ruku/getProduct',
			'Storehouse/Ruku/deletesonid',
			'Storehouse/Chuku/addInsert',				//原料出库
			'Storehouse/Chuku/supplierAjax',
			'Storehouse/Chuku/getSupplierKey',
			'Storehouse/Chuku/productAjax',
			'Storehouse/Chuku/getProductKey',
			'Storehouse/Chuku/getProduct',
			'Storehouse/Chuku/deletesonid',
			'Storehouse/Cpruku/addInsert',				//成品入库
			'Storehouse/Cpruku/supplierAjax',
			'Storehouse/Cpruku/getSupplierKey',
			'Storehouse/Cpruku/productAjax',
			'Storehouse/Cpruku/getProductKey',
			'Storehouse/Cpruku/getProduct',
			'Storehouse/Cpruku/deletesonid',
			'Storehouse/Cpchuku/addInsert',				//成品出库
			'Storehouse/Cpchuku/productAjax',
			'Storehouse/Cpchuku/deletesonid',
			'Storehouse/Cpchuku/getProduct',
			
			/* //基础
			'Baseinfo/BaseInfo/editHandleBase',          //保存基础资料
			'Baseinfo/BaseInfo/addHandleBase',           //添加基础资料 */
			//基础
			'Baseinfo/Product/addInsert',					//原料
			'Baseinfo/Chengpin/addInsert',					//成品
			'Baseinfo/Chengpin/deletesonid',
			/* //行动
			'Contact/Index/getClientKey',                //Ajax获取客户搜索
			'Contact/Index/clientAjax',                  //模态框客户Ajax分页查询 */
			//合同
			'Memorandum/Index/addInsert',                //合同执行权限，行动执行权限  
			//财务
			'Finance/Base/bankInsert',
			'Finance/Base/collectionInsert',
			'Finance/Base/paymentInsert',
			'Finance/Bank/addInsert',
			'Finance/Cpost/addInsert',
			'Finance/Collection/addInsert',
			'Finance/Collection/memorandumAjax',
			'Finance/Collection/getSonId',
			'Finance/Payment/getSonId',
			'Finance/Payment/addInsert',
       		'Finance/Bankcash/mingxiAjax',
			'Storehouse/Payment/addInsert',

			//公告
			'Notice/Notice/insertNotice',                //基础资料，公告编辑/添加保存
			'Notice/Notice/updateNotice',                 //基础资料，公告编辑/添加保存
			//运营
			'Profit/Index/save',                // 利润添加保存
            'Profit/Plan/showBill',
            'Profit/Plan/showForecastedLog',
            'Profit/Plan/showForecastProduct',
            'Profit/Aftersales/getOrderId',
	), 
    'RULE' =>array(
    		//	
    		//部门
			array('id'=>'1','name'=>'Auth/Index/index','title'=>'组织架构','pid'=>'2','status'=>'1','ismenu'=>'1','codition'=>''),
			array('id'=>'2','name'=>'Auth/Index/update','title'=>'添加/编辑部门','pid'=>'2','status'=>'1','ismenu'=>'0','codition'=>''),
    		array('id'=>'3','name'=>'Auth/Index/delete','title'=>'删除部门','pid'=>'2','status'=>'1','ismenu'=>'0','codition'=>''),
    		//岗位
    		array('id'=>'4','name'=>'Auth/Role/index','title'=>'岗位','pid'=>'3','status'=>'1','ismenu'=>'0','codition'=>''),
    		array('id'=>'5','name'=>'Auth/Role/update','title'=>'添加/编辑岗位','pid'=>'3','status'=>'1','ismenu'=>'0','codition'=>''),
    		array('id'=>'6','name'=>'Auth/Role/delete','title'=>'删除岗位','pid'=>'3','status'=>'1','ismenu'=>'0','codition'=>''),
    		array('id'=>'7','name'=>'Auth/Role/setAccess','title'=>'授权','pid'=>'3','status'=>'1','ismenu'=>'0','codition'=>''),
    		//用户
    		array('id'=>'8','name'=>'Auth/User/getUser','title'=>'员工','pid'=>'4','status'=>'1','ismenu'=>'0','codition'=>''),
    		array('id'=>'9','name'=>'Auth/User/resetPassword','title'=>'修改密码','pid'=>'4','status'=>'1','ismenu'=>'0','codition'=>''),
    		array('id'=>'10','name'=>'Auth/User/update','title'=>'添加用户','pid'=>'4','status'=>'1','ismenu'=>'0','codition'=>''),
    		array('id'=>'11','name'=>'Auth/User/delete','title'=>'删除用户','pid'=>'4','status'=>'1','ismenu'=>'0','codition'=>''),
    		array('id'=>'12','name'=>'Auth/User/getUserInfo','title'=>'编辑客户','pid'=>'4','status'=>'1','ismenu'=>'0','codition'=>''),
    		//首页
		    array('id'=>'13','name'=>'Home/Index/index','title'=>'系统首页','pid'=>'1','status'=>'1','ismenu'=>'0','codition'=>''),
		    //基础资料
		    array('id'=>'14','name'=>'Baseinfo/Product/index','title'=>'原料','pid'=>'5','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'15','name'=>'Baseinfo/Product/add','title'=>'原料新增','pid'=>'5','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'16','name'=>'Baseinfo/Product/edit','title'=>'原料修改','pid'=>'5','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'17','name'=>'Baseinfo/Product/delect','title'=>'原料删除','pid'=>'5','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'18','name'=>'Baseinfo/Product/import','title'=>'原料导入','pid'=>'5','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'19','name'=>'Baseinfo/Chengpin/index','title'=>'成品','pid'=>'5','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'20','name'=>'Baseinfo/Chengpin/add','title'=>'成品新增','pid'=>'5','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'21','name'=>'Baseinfo/Chengpin/edit','title'=>'成品修改','pid'=>'5','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'22','name'=>'Baseinfo/Chengpin/delect','title'=>'成品删除','pid'=>'5','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'23','name'=>'Baseinfo/Chengpin/import','title'=>'成品导入','pid'=>'5','status'=>'1','ismenu'=>'0','codition'=>''),
		    /* array('id'=>'14','name'=>'Baseinfo/BaseInfo/baseActiontype','title'=>'数据字典','pid'=>'5','status'=>'1','ismenu'=>'1','codition'=>''),
		    array('id'=>'15','name'=>'Baseinfo/BaseInfo/add','title'=>'添加基础资料','pid'=>'5','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'16','name'=>'Baseinfo/BaseInfo/edit','title'=>'编辑基础资料','pid'=>'5','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'17','name'=>'Baseinfo/BaseInfo/delete','title'=>'删除基础资料','pid'=>'5','status'=>'1','ismenu'=>'0','codition'=>''), */
		    
		    //客户管理
		    array('id'=>'24','name'=>'Client/Client/indexClient','title'=>'客户','pid'=>'6','status'=>'1','ismenu'=>'1','codition'=>''),
		    array('id'=>'25','name'=>'Client/Client/addClient','title'=>'添加客户','pid'=>'6','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'26','name'=>'Client/Client/editClient','title'=>'编辑客户','pid'=>'6','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'27','name'=>'Client/Client/deleteClient','title'=>'删除客户','pid'=>'6','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'28','name'=>'Client/Client/viewClient','title'=>'客户详情','pid'=>'6','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'29','name'=>'Client/Client/ajaxDeleteContact','title'=>'删除联系人','pid'=>'6','status'=>'1','ismenu'=>'0','codition'=>''),
		    //array('id'=>'38','name'=>'Client/Client/upload','title'=>'上传客户信息','pid'=>'6','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'30','name'=>'Client/Client/import','title'=>'导入客户','pid'=>'6','status'=>'1','ismenu'=>'0','codition'=>''),
		    //供应商管理
		    array('id'=>'31','name'=>'Supplier/Index/index','title'=>'供应商','pid'=>'7','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'32','name'=>'Supplier/Index/add','title'=>'供应商新增','pid'=>'7','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'33','name'=>'Supplier/Index/edit','title'=>'供应商修改','pid'=>'7','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'34','name'=>'Supplier/Index/delect','title'=>'供应商删除','pid'=>'7','status'=>'1','ismenu'=>'0','codition'=>''),
   			/* //行动查询
		    array('id'=>'24','name'=>'Contact/Index/index','title'=>'行动','pid'=>'7','status'=>'1','ismenu'=>'1','codition'=>''),
		    array('id'=>'25','name'=>'Contact/Index/add','title'=>'添加行动','pid'=>'7','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'26','name'=>'Contact/Index/edit','title'=>'编辑行动','pid'=>'7','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'27','name'=>'Contact/Index/delete','title'=>'删除行动','pid'=>'7','status'=>'1','ismenu'=>'0','codition'=>''), */
		    //仓库管理
		    array('id'=>'35','name'=>'Storehouse/Index/index','title'=>'原料库存','pid'=>'8','status'=>'1','ismenu'=>'1','codition'=>''),
            array('id'=>'300','name'=>'Storehouse/Index/kucunSafeReport','title'=>'原料库存警戒消息','pid'=>'8','status'=>'1','ismenu'=>'1','codition'=>''),
		    array('id'=>'36','name'=>'Storehouse/Ruku/index','title'=>'原料入库','pid'=>'8','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'37','name'=>'Storehouse/Ruku/add','title'=>'原料入库新增','pid'=>'8','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'38','name'=>'Storehouse/Ruku/edit','title'=>'原料入库修改','pid'=>'8','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'39','name'=>'Storehouse/Ruku/delect','title'=>'原料入库删除','pid'=>'8','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'160','name'=>'Storehouse/Ruku/kcTz','title'=>'原料库存调整','pid'=>'8','status'=>'1','ismenu'=>'0','codition'=>''),
		    
		    array('id'=>'40','name'=>'Storehouse/Chuku/index','title'=>'原料出库','pid'=>'8','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'41','name'=>'Storehouse/Chuku/add','title'=>'原料出库新增','pid'=>'8','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'42','name'=>'Storehouse/Chuku/edit','title'=>'原料出库修改','pid'=>'8','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'43','name'=>'Storehouse/Chuku/delect','title'=>'原料出库删除','pid'=>'8','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'44','name'=>'Storehouse/Chengpin/index','title'=>'成品库存','pid'=>'8','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'45','name'=>'Storehouse/Cpruku/index','title'=>'成品入库','pid'=>'8','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'46','name'=>'Storehouse/Cpruku/add','title'=>'成品入库新增','pid'=>'8','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'47','name'=>'Storehouse/Cpruku/edit','title'=>'成品入库修改','pid'=>'8','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'48','name'=>'Storehouse/Cpruku/delect','title'=>'成品入库删除','pid'=>'8','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'49','name'=>'Storehouse/Cpchuku/index','title'=>'成品出库','pid'=>'8','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'50','name'=>'Storehouse/Cpchuku/add','title'=>'成品出库新增','pid'=>'8','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'51','name'=>'Storehouse/Cpchuku/edit','title'=>'成品出库修改','pid'=>'8','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'52','name'=>'Storehouse/Cpchuku/delect','title'=>'成品出库删除','pid'=>'8','status'=>'1','ismenu'=>'0','codition'=>''),
            array('id'=>'159','name'=>'Storehouse/Cpchuku/listAdd','title'=>'成品库存-快捷出库','pid'=>'8','status'=>'1','ismenu'=>'0','codition'=>''),
		    
		    //财务查询
		    array('id'=>'53','name'=>'Finance/Index/index','title'=>'财务','pid'=>'9','status'=>'1','ismenu'=>'1','codition'=>''),
		    array('id'=>'54','name'=>'Finance/Collection/index','title'=>'收款','pid'=>'9','status'=>'1','ismenu'=>'0','codition'=>''),	
		    array('id'=>'55','name'=>'Finance/Collection/add','title'=>'添加收款','pid'=>'9','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'56','name'=>'Finance/Collection/edit','title'=>'编辑收款','pid'=>'9','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'57','name'=>'Finance/Collection/delect','title'=>'删除收款','pid'=>'9','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'101','name'=>'Finance/Collection/delAll','title'=>'清除收款数据','pid'=>'9','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'58','name'=>'Finance/Payment/index','title'=>'其他付款','pid'=>'9','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'59','name'=>'Finance/Payment/add','title'=>'添加其他付款','pid'=>'9','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'60','name'=>'Finance/Payment/edit','title'=>'编辑其他付款','pid'=>'9','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'61','name'=>'Finance/Payment/delect','title'=>'删除其他付款','pid'=>'9','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'102','name'=>'Finance/Payment/delAll','title'=>'清除付款数据','pid'=>'9','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'62','name'=>'Finance/Bank/index','title'=>'内部转账','pid'=>'9','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'63','name'=>'Finance/Bank/add','title'=>'添加转账','pid'=>'9','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'64','name'=>'Finance/Bank/edit','title'=>'编辑转账','pid'=>'9','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'65','name'=>'Finance/Bank/delect','title'=>'删除转账','pid'=>'9','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'103','name'=>'Finance/Bank/delAll','title'=>'清除转账数据','pid'=>'9','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'66','name'=>'Finance/Cpost/index','title'=>'应收过账','pid'=>'9','status'=>'1','ismenu'=>'0','codition'=>''),
		    //array('id'=>'67','name'=>'Finance/Cpost/update','title'=>'过账界面','pid'=>'9','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'68','name'=>'Finance/Cpost/edit','title'=>'过账操作','pid'=>'9','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'69','name'=>'Finance/Cash/index','title'=>'现金日报表','pid'=>'9','status'=>'1','ismenu'=>'0','codition'=>''),
 		    array('id'=>'120','name'=>'Finance/Bankcash/index','title'=>'账户余额表','pid'=>'9','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'70','name'=>'Finance/Base/bank','title'=>'银行账户','pid'=>'9','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'71','name'=>'Finance/Base/addbank','title'=>'添加银行账户','pid'=>'9','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'72','name'=>'Finance/Base/editbank','title'=>'编辑银行账户','pid'=>'9','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'73','name'=>'Finance/Base/delectbank','title'=>'删除银行账户','pid'=>'9','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'74','name'=>'Finance/Base/collection','title'=>'收款项目管理','pid'=>'9','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'75','name'=>'Finance/Base/addcollection','title'=>'添加收款项目','pid'=>'9','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'76','name'=>'Finance/Base/editcollection','title'=>'编辑收款项目','pid'=>'9','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'77','name'=>'Finance/Base/delectcollection','title'=>'删除收款项目','pid'=>'9','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'78','name'=>'Finance/Base/payment','title'=>'付款项目管理','pid'=>'9','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'79','name'=>'Finance/Base/addpayment','title'=>'添加付款项目','pid'=>'9','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'80','name'=>'Finance/Base/editpayment','title'=>'编辑付款项目','pid'=>'9','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'81','name'=>'Finance/Base/delectpayment','title'=>'删除付款项目','pid'=>'9','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'82','name'=>'Finance/Collection/kaipiao','title'=>'开票','pid'=>'9','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'83','name'=>'Storehouse/Payment/index','title'=>'供应商付款','pid'=>'9','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'84','name'=>'Storehouse/Payment/add','title'=>'添加供应商付款','pid'=>'9','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'85','name'=>'Storehouse/Payment/edit','title'=>'编辑供应商付款','pid'=>'9','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'86','name'=>'Storehouse/Payment/delect','title'=>'删除供应商付款','pid'=>'9','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'156','name'=>'Storehouse/Index/YlReport','title'=>'原料库存','pid'=>'9','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'157','name'=>'Finance/YfGz/index','title'=>'原料应付','pid'=>'9','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'158','name'=>'Finance/YfGz/Duizhang','title'=>'原料应付对账单','pid'=>'9','status'=>'1','ismenu'=>'0','codition'=>''),
		   /*  //合同
		    array('id'=>'87','name'=>'Memorandum/Index/index','title'=>'合同','pid'=>'10','status'=>'1','ismenu'=>'1','codition'=>''),
		    array('id'=>'88','name'=>'Memorandum/Index/add','title'=>'添加合同','pid'=>'10','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'89','name'=>'Memorandum/Index/edit','title'=>'编辑合同','pid'=>'10','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'90','name'=>'Memorandum/Index/delect','title'=>'删除合同','pid'=>'10','status'=>'1','ismenu'=>'0','codition'=>''), */
		    //公告
		    array('id'=>'87','name'=>'Notice/Notice/indexNotice','title'=>'公告','pid'=>'10','status'=>'1','ismenu'=>'1','codition'=>''),
		    array('id'=>'88','name'=>'Notice/Notice/addNotice','title'=>'添加公告','pid'=>'10','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'89','name'=>'Notice/Notice/editNotice','title'=>'编辑公告','pid'=>'10','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'90','name'=>'Notice/Notice/deleteNotice','title'=>'删除公告','pid'=>'10','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'91','name'=>'Notice/Notice/viewNotice','title'=>'公告详情','pid'=>'10','status'=>'1','ismenu'=>'0','codition'=>''),
		      //运营
		    array('id'=>'96','name'=>'','title'=>'查看全部利润记录','pid'=>'11','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'92','name'=>'Profit/Index/index','title'=>'利润表','pid'=>'11','status'=>'1','ismenu'=>'1','codition'=>''),
		    array('id'=>'93','name'=>'Profit/Index/add','title'=>'利润登记','pid'=>'11','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'94','name'=>'Profit/Index/edit','title'=>'利润编辑','pid'=>'11','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'95','name'=>'Profit/Index/delete','title'=>'删除利润','pid'=>'11','status'=>'1','ismenu'=>'0','codition'=>''),
		    // array('id'=>'97','name'=>'Profit/Product/index','title'=>'原料供应表','pid'=>'11','status'=>'1','ismenu'=>'1','codition'=>''),
              //运营-生产计划
            array('id'=>'200','name'=>'Profit/Plan/index','title'=>'查看生产计划','pid'=>'11','status'=>'1','ismenu'=>'0','codition'=>''),
            array('id'=>'201','name'=>'Profit/Plan/add','title'=>'新增生产计划','pid'=>'11','status'=>'1','ismenu'=>'0','codition'=>''),
            array('id'=>'202','name'=>'Profit/Plan/edit','title'=>'编辑生产计划','pid'=>'11','status'=>'1','ismenu'=>'0','codition'=>''),
            array('id'=>'203','name'=>'Profit/Plan/addInsert','title'=>'保存生产计划','pid'=>'11','status'=>'1','ismenu'=>'0','codition'=>''),
            array('id'=>'204','name'=>'Profit/Plan/delete','title'=>'删除生产计划','pid'=>'11','status'=>'1','ismenu'=>'0','codition'=>''),
            array('id'=>'205','name'=>'Profit/Plan/deleteBill','title'=>'删除生产计划子计划','pid'=>'11','status'=>'1','ismenu'=>'0','codition'=>''),
            array('id'=>'206','name'=>'Profit/Plan/deleteForecast','title'=>'删除采购计划','pid'=>'11','status'=>'1','ismenu'=>'0','codition'=>''),
            array('id'=>'207','name'=>'Profit/Plan/exportForecast','title'=>'导出采购计划','pid'=>'11','status'=>'1','ismenu'=>'0','codition'=>''),
            array('id'=>'208','name'=>'Profit/Plan/exportForecastProduct','title'=>'导出原料采购计划','pid'=>'11','status'=>'1','ismenu'=>'0','codition'=>''),
            array('id'=>'209','name'=>'Profit/Plan/buildForecast','title'=>'创建采购计划','pid'=>'11','status'=>'1','ismenu'=>'0','codition'=>''),
            array('id'=>'210','name'=>'Profit/Plan/import','title'=>'导入生产计划','pid'=>'11','status'=>'1','ismenu'=>'0','codition'=>''),
		    // 售后
		    // array('id'=>'130','name'=>'','title'=>'售后服务','pid'=>'12','status'=>'1','ismenu'=>'0','codition'=>''),
		    /*array('id'=>'131','name'=>'Profit/Aftersale/index','title'=>'查看售后服务','pid'=>'12','status'=>'1','ismenu'=>'1','codition'=>''),
		    array('id'=>'132','name'=>'Profit/Aftersale/add','title'=>'新增售后','pid'=>'12','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'133','name'=>'Profit/Aftersale/save','title'=>'保存售后','pid'=>'12','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'134','name'=>'Profit/Aftersale/edit','title'=>'编辑售后','pid'=>'12','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'135','name'=>'Profit/Aftersale/delete','title'=>'删除售后','pid'=>'12','status'=>'1','ismenu'=>'0','codition'=>''),
		    // 售后服务审核
		    array('id'=>'137','name'=>'Profit/Review/index','title'=>'查看售后服务审核','pid'=>'12','status'=>'1','ismenu'=>'1','codition'=>''),
		    array('id'=>'142','name'=>'Profit/Review/review','title'=>'审核','pid'=>'12','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'143','name'=>'Profit/Review/unreview','title'=>'取消审核','pid'=>'12','status'=>'1','ismenu'=>'0','codition'=>''),*/

		    array('id'=>'131','name'=>'Profit/Aftersales/index','title'=>'查看售后服务','pid'=>'12','status'=>'1','ismenu'=>'1','codition'=>''),
		    array('id'=>'132','name'=>'Profit/Aftersales/add','title'=>'新增售后','pid'=>'12','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'133','name'=>'Profit/Aftersales/save','title'=>'保存售后','pid'=>'12','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'134','name'=>'Profit/Aftersales/edit','title'=>'编辑售后','pid'=>'12','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'135','name'=>'Profit/Aftersales/delete','title'=>'删除售后','pid'=>'12','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'136','name'=>'Profit/Aftersales/exportFirst','title'=>'导出售后服务','pid'=>'12','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'137','name'=>'Profit/Aftersales/secPage','title'=>'运营处理','pid'=>'12','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'138','name'=>'Profit/Aftersales/operating','title'=>'运营确认','pid'=>'12','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'139','name'=>'Profit/Aftersales/exportSec','title'=>'运营导出','pid'=>'12','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'140','name'=>'Profit/Aftersales/thirdPage','title'=>'品控处理','pid'=>'12','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'141','name'=>'Profit/Aftersales/QcSave','title'=>'品控保存','pid'=>'12','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'142','name'=>'Profit/Aftersales/exportThird','title'=>'品控导出','pid'=>'12','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'143','name'=>'Profit/Aftersales/fourthPage','title'=>'运营审核弹窗','pid'=>'12','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'147','name'=>'Profit/Aftersales/shenheSave','title'=>'运营审核确认','pid'=>'12','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'144','name'=>'Profit/Aftersales/exportFourth','title'=>'运营审核导出','pid'=>'12','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'145','name'=>'Profit/Aftersales/report','title'=>'售后报表','pid'=>'12','status'=>'1','ismenu'=>'0','codition'=>''),
		    array('id'=>'146','name'=>'Profit/Aftersales/exportReport','title'=>'售后报表导出','pid'=>'12','status'=>'1','ismenu'=>'0','codition'=>''),


		    // 工具入口
		    // array('id'=>'144','name'=>'','title'=>'工具入口','pid'=>'5','status'=>'1','ismenu'=>'0','codition'=>''),
		    // array('id'=>'145','name'=>'Tool/Index/index','title'=>'工具入口','pid'=>'5','status'=>'1','ismenu'=>'0','codition'=>''),
		    // // 数据库提交
		    // array('id'=>'146','name'=>'Tool/Dbchange/index','title'=>'数据库改动管理界面','pid'=>'5','status'=>'1','ismenu'=>'0','codition'=>''),
		    // array('id'=>'147','name'=>'Tool/Dbchange/commitIndex','title'=>'改动提交管理界面','pid'=>'5','status'=>'1','ismenu'=>'0','codition'=>''),
		    // array('id'=>'148','name'=>'Tool/Dbchange/updateIndex','title'=>'改动执行管理界面','pid'=>'5','status'=>'1','ismenu'=>'0','codition'=>''),
		    // array('id'=>'149','name'=>'Tool/Dbchange/commit','title'=>'提交数据库改动(补丁模式)','pid'=>'5','status'=>'1','ismenu'=>'0','codition'=>''),
		    // array('id'=>'150','name'=>'Tool/Dbchange/update','title'=>'执行数据库改动（补丁模式）','pid'=>'5','status'=>'1','ismenu'=>'0','codition'=>''),
		    // array('id'=>'151','name'=>'Tool/Dbchange/remove','title'=>'删除补丁包','pid'=>'5','status'=>'1','ismenu'=>'0','codition'=>''),
		    // array('id'=>'152','name'=>'Tool/Dbchange/changePre','title'=>'更改前缀','pid'=>'5','status'=>'1','ismenu'=>'0','codition'=>''),
		    // array('id'=>'153','name'=>'Tool/Dbchange/listLog','title'=>'执行记录明细','pid'=>'5','status'=>'1','ismenu'=>'0','codition'=>''),
		    // array('id'=>'154','name'=>'Tool/Dbchange/getPatchContent','title'=>'获取补丁文件的内容','pid'=>'5','status'=>'1','ismenu'=>'0','codition'=>''),
		    // array('id'=>'155','name'=>'Tool/Dbchange/listPatch','title'=>'listPatch','pid'=>'5','status'=>'1','ismenu'=>'0','codition'=>''),
    		
    )
);