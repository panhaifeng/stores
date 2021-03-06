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

// 应用入口文件

// 检测PHP环境
if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');

// 开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
define('APP_DEBUG',true);
// 定义应用目录
define('APP_PATH','./Apps/');
//缓存目录设置，此目录必须可写，建议移动到非WEB目录
define ( 'RUNTIME_PATH', './Runtime/' );

// 引入ThinkPHP入口文件
require './eqinfo/ThinkPHP.php';
