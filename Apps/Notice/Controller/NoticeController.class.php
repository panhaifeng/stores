<?php
namespace Notice\Controller;
use Common\Controller\CommonController;
class NoticeController extends CommonController {
	/**
	 * 通告列表
	 * @caibin
	 * @2014-12-07
	 */
    public function indexNotice(){
    	$this->notice = M('notice')->select();
    	$this->display();
    }
    /**
     * 添加通告
     * @caibin
     * @2014-12-07
     */
    public function addNotice(){
        $this->display();
    }
    /**
     * 编辑通告
     * @caibin
     * @2014-12-07
     */
    public function editNotice(){
    	$map['id'] = I('get.id');
        $this->notice = M('notice')->where($map)->find();
        $this->display();
    }
    
    /**
     * 执行添加通告
     * @caibin
     * @2014-12-07
     */
    public function insertNotice(){
    	$data = I('post.');
        $data['ctime'] = time();
        $res = M('notice')->add($data);
    	if($res){
    		$this->success('添加成功',U('Notice/Notice/indexNotice'));
    	}else{
    		$this->error('添加失败');
    	}
    }

    /**
     * 执行编辑通告
     * @caibin
     * @2014-04-15
     */
    public function updateNotice(){
        $data = I('post.');
        $data['utime'] = time();
        $res = M('notice')->save($data);
        if($res){
            $this->success('编辑成功',U('Notice/Notice/indexNotice'));
        }else{
            $this->error('编辑失败');
        }
    }

    /**
     * 删除通告
     * @caibin
     * @2014-04-28
     */
    public function deleteNotice()
    {
    	$map['id'] = I('id');
    	$res = M('notice')->where($map)->delete();
    	if($res){
			$status = array (
					'success' => true,
					'mgs'=>'删除成功！'
			);
			$this->ajaxReturn($status);
		}
    }
    /**
     * 删除通告
     * @caibin
     * @2014-04-28
     */
    public function viewNotice()
    {
        $map['id'] = I('get.id');
        $this->notice = M('notice')->where($map)->find();
        $this->display();
    }
    
}