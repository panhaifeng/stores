<?php
namespace Home\Controller;
use Common\Controller\CommonController;
class IndexController extends CommonController {
    public function index(){
    	//添加公告
    	$notice = M('notice')->order('listorder ASC,ctime DESC')->limit(5)->select();
    	foreach ($notice as &$v){
    		$v['titles']=substr($v['title'], 0,15);
    	}
    	$this->notice=$notice;
    	$this->display();
    }
}