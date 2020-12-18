<?php
namespace Tool\Controller;
use Common\Controller\CommonController;
/**
 * 工具管理
 */
class IndexController extends CommonController {

	/**
	 * 工具管理内容
	 */
	Public function index(){
        $this->subJs = 'Specific/Index/js';
		$this->display();
	}
}