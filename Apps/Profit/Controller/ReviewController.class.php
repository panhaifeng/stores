<?php 
namespace Profit\Controller;
use Common\Controller\CommonController;
/**
 * 售后服务审核
 */
class ReviewController extends CommonController {																										
	/**
	 * 售后
	 * Time : 2016-06-20
	 * @author : xgh
	 */
	public function index() {
		// 查询条件部分
		$data = I("post.");
		$uid = $_SESSION['uid'];	// 当前用户
		$map['reviewer'] = $data['reviewer']!=0?array("gt", 0):0;	// 审核条件
		// 店铺
		if($data['store']!="") $map['store'] = $data['store']; 
		// 开始/结束时间
//		if($data['start_time']!="" && $data['end_time']!="")
//			$map['date'] = array(array("EGT",$data['start_time']),array("ELT",$data['end_time']));
		if($data['orderId']!="") $map['orderId'] = array('like', "%".$data['orderId']."%");
		//if($data['saleID']!="") $map['saleID'] = array('like', "%".$data['saleID']."%");
		
		// 获取用户
		if($data['uid']!="") $umap['real_name'] = array('like', "%".$data['uid']."%");
		$users = M("user")->where($umap)->select();
		$uids = array();
		foreach ($users as $k => $v) {
			$uids[] = $v['id'];
		}
		$map['uid'] = array("in",$uids);
		// 售后服务信息部分
		$stores = C('store'); //店铺
		$user = $this->getSalesman();	// 客服
		$count = M("aftersale")->where($map)->count();// 查询满足要求的总记录数
		$Page = new \Think\Page($count, 30, I('param.'));	// 分页
		$shouhou = M("aftersale")->where($map)->limit($Page->firstRow.','.$Page->listRows)->select();
		// 获取 客服人员 ， 商店名称 和 审核人员 信息
		$i=0;
		foreach ($shouhou as $k => $v) {
			$shouhou[$k]['store'] = $stores[$v['store']];		// 商店名称
			$shouhou[$k]['var'] = "divDialog" . $i;
			$i = $i +1;
			foreach ($user as $key => $value) {
				if($v['uid'] == $value['id'])
					$shouhou[$k]['uid'] = $value['real_name'];	// 客服人员
				if($v['reviewer'] == $value['id'])
					$shouhou[$k]['reviewer'] = $value['real_name'];	// 审核人员
			}
		}
		$this->shouhou = $shouhou;// 售后服务列表
		$this->stores = $stores;	//店铺
		// 搜索条件
		$map['start_time'] = $data['start_time'];	// 加上时间显示
		$map['end_time'] = $data['end_time'];
		$map['orderId'] = $data['orderId'];	// 订单编号
		$map['saleID'] = $data['saleID'];	// ID
		$map['uid'] = $data['uid'];			//用户信息
		$this->map = $map;					// 搜索条件
		
		// 分页
		$this->uid = $uid;
    	$this->page = $Page->show();
    	$this->fromAction = "Profit/Review/index";
		$this->display();
	}

	/**
	 * 审核
	 * Time : 2016-06-20
	 * @author : xgh
	 * @return [type] [description]
	 */
	public function review(){
		$data = I("get.");
		$data['reviewTime'] = date('y-m-d h:i:s',time());
		M("aftersale")->save($data) || $this->error('保存失败');
		$this->success('保存成功',U('index'));
	}

	/**
	 * 取消审核
	 * Time : 2016-06-21
	 * @author : xgh
	 * @return [type] [description]
	 */
	public function unreview(){
		$data = I("get.");
		$data['reviewTime'] = null;
		M("aftersale")->save($data) || $this->error('保存失败');
		$this->success('保存成功',U('index'));	
	}

}

?>