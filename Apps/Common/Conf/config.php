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
    /* 数据库配置 */
    'DB_TYPE'   => 'mysql',                                      // 数据库类型
    'DB_HOST'   => 'localhost',                                  // 服务器地址
    'DB_NAME'   => 'ykb_kpdev',                                     // 数据库名
    'DB_USER'   => 'root',                                       // 用户名
    'DB_PWD'    => 'root',                                           // 密码         
    'DB_PORT'   => '3306',                                       // 端口
    'DB_PREFIX' => 'ykb_',                                       // 数据库表前缀
	/*布局设置*/
	'LAYOUT_ON' =>  true,                                        //开启模板布局
	/* URL设置 */
	'URL_MODEL' => 0,                                            //0 普通模式， 1 pathinfo ，2 rewrite
	/* 模板引擎设置 */
	//'TMPL_EXCEPTION_FILE' => './Public/Tpl/404.htm',             //指定错误页面模板路径
	'SHOW_PAGE_TRACE'       =>false, 
	'LANG_SWITCH_ON' => true,                             // 开启语言包功能
	/*权限*/
	'AUTH_CONFIG'=>array(
		'AUTH_ON' => true,                                       //认证开关
		'AUTH_TYPE' => 1,                                        // 认证方式，1为时时认证；2为登录认证。
		'AUTH_GROUP' => 'ykb_auth_group',                        //用户组数据表名
		'AUTH_GROUP_ACCESS' => 'ykb_auth_group_access',          //用户组明细表
		'AUTH_RULE' => 'ykb_auth_rule',                          //权限规则表
		'AUTH_USER' => 'ykb_user'                                //用户信息表
	),
	/*自定义*/
	'ADMIN_AUTH_KEY' => 'superadmin',                            //超级管理员识别
	'USER_AUTH_KEY'  => 'uid',	                                 //用户认证识别号（存储在SESSION里面）
	'DEFAULT_MODULE' => 'Home',                                  // 默认模块
	'NOT_AUTH_MODULE' => 'Home',                                 //无需验证的控制器
	'RBAC_SUPERADMIN' => 'admin',        //超级管理员名称
	'NOT_AUTH_ACTION' => 'access',       //无需验证的方法
	
	//加载扩展配置
	'LOAD_EXT_CONFIG' => 'menu,server,company',
);