<?php
namespace Baseinfo\Controller;
use Common\Controller\CommonController;
class BaseInfoController extends CommonController {
    public function index(){
    	
    }
    
    /**
     * 行动方式
     * @author zhangyan
     * 2015-01-05
     */
    public function baseActiontype(){
    	//放到同一个界面
    	$this->actionList = M('base_actiontype')->select();
    	$this->sourceList = M('base_source')->select();
    	$this->industryList = M('base_industry')->select();
    	$this->employList = M('base_employnum')->select();
    	$this->productList = M('base_product')->select();
    	$this->display();
    }
    /**
     * 添加基础文档到相应数据库
     * @param 添加类型（数据库） $type
     * @author zhangyan
     * 2015-01-05
     */
    public function add(){
    	$type = I('get.type');
    	$this->display('add'.ucfirst($type));
    }
    /**
     * 执行添加基础文档到相应数据库
     * @param 添加类型（数据库） $type
     * @author zhangyan
     * 2015-01-05
     */
    public function addHandleBase($type){
    	$type = I('get.type');
    	$data = I('post.');
    	if($type=="baseProduct"){
    		 $product = D('product');
    		 $data['code'] = $product->_getCode('P','base_product','code');
    		 $res = D('product')->add($data);
    	} else {
    		$res = M($type)->add($data);
    	}
    	if($res){
    		$result = M($type)->select();
    		//写入文件
    		F($type,$result);
    		$this->success('添加成功',U('Baseinfo/BaseInfo/baseActiontype'));
    	}else{
    		$this->error('添加失败');
    	}
    }
    /**
     * 根据ID删除基础资料
     * @author zhangyan
     * 2015-01-05
     */
    public function delete()
    {
    	$type = I('post.type');
    	$map['id'] = I('post.id');
    	$res = M($type)->where($map)->delete();
    	if($res){
    		$result = M($type)->select();
    		F($type,$result);
    		$status = array (
    				'success' => true,
    				'mgs'=>'删除成功！'
    		);
    		$this->ajaxReturn($status);
    	}
    }
    /**
     * 编辑基础文档
     * @author zhangyan
     * 2015-01-05
     */
    public function edit()
    {
    	$type = I('get.type');
    	$map['id'] = I('id');
    	$this->$type = M($type)->where($map)->find();
    	$this->id = $map['id'];
    	$this->display('edit'.ucfirst($type));
    }
    /**
     * 编辑基础文档表单处理
     * @author zhangyan
     * 2015-01-05
     */
    public function editHandleBase()
    {
    	$type = I('get.type');
    	$map['id'] = I('get.id');
    	$data = I('post.');
    	$res = M($type)->where($map)->save($data);
    	if($res !== false){
    		$result = M($type)->select();
    		F($type,$result);
    		$this->success('编辑成功',U('Baseinfo/BaseInfo/baseActiontype'));
    	}else{
    		$this->error('编辑失败');
    	}
    }
   
}