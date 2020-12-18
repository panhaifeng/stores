<?php 
namespace Profit\Controller;
use Common\Controller\CommonController;
/**
 * 售后服务登记、修改
 */
class AftersaleController extends CommonController {
	/**
	 * 售后
	 * Time : 2016-06-20
	 */
	public function index() {
        $params = I("param.");

        $map = array(); // 查询用,检索条件
        $arr = array(); // 缓存用,检索条件
        // 检索:审核
        if(isset($params)){
            $map['reviewer'] = ($params['reviewer']==0)?0:array('gt', 0);
            $arr['reviewer'] = $params['reviewer'];

            $arrText = $params['reviewer']==0?'未审核':'已审核';
        }else{
            $arr['reviewer'] = 0; // 默认为0:未审核;
        }

        $aftFileName = '~'.date('Y-m-d');
        // 检索:时间
        if($params['start_time'] != NULL && $params['end_time'] != NULL){
            $map['a.date'] = array('between',array($params['start_time'],$params['end_time']));
            $arr['start_time'] = $params['start_time'];
            $arr['end_time'] = $params['end_time'];
            $aftFileName = $arr['start_time'].$aftFileName;
        }
        if($params['time_kind'] !=NULL){
            $arr['time_kind'] = $params['time_kind'];

        }else{
            $arr['time_kind'] = 0;
        }

        // 检索:店铺
        if(!empty($params['store'])){
            $map['a.store'] = $params['store'];
            $arr['store'] = $params['store'];

            $arrText .= ' | 店铺:'.$arr['store'];
        }

        // 检索:订单编号
        if(!empty($params['orderId'])){
            $map['a.orderId'] = array('like', "%{$params['orderId']}%");
            $arr['orderId'] = $params['orderId'];

            $arrText .= ' | 订单: '.$arr['orderId'];
        }

        // 检索:客服姓名
        if(!empty($params['userName'])){
            $map['u.real_name'] = array('like', "%{$params['userName']}%");
            $arr['userName']    = $params['userName'];

            $arrText .= ' 客服: '.$arr['userName'];
        }

        // 总记录数
        $count = M("aftersale a")
            ->join('LEFT JOIN __USER__ u ON u.id = a.uid')
            ->where($map)
            ->count();

        if($params['export']==1){
            $Page = new \Think\Page($count, $count, $arr);
        }else{
            // 分页
            $Page = new \Think\Page($count, 30, $arr);
        }
        // 查询
        $rows = M("aftersale a")
                ->join('LEFT JOIN __USER__ u ON u.id = a.uid')
                ->where($map)
                ->limit($Page->firstRow.','.$Page->listRows)
                ->field('a.*')
                ->select();

        // 渲染数据
        //店铺
        $stores = C('store');
        // 客服
        $user = $this->getSalesman();
        $userMap = array();
        foreach ($user as $u){
            $userMap[$u['id']] = $u;
        }
        // 获取 客服人员 ， 商店名称 和 审核人员 信息
        foreach ($rows as $k => &$v) {
            $v['store'] = $stores[$v['store']];                         // 商店名称
            $v['uid']  = $userMap[$v['uid']]['real_name'];              // 客服人员姓名
            $v['reviewer']  = isset($userMap[$v['reviewer']])?$userMap[$v['reviewer']]['real_name']:0;    // 审核人员姓名
        }
        // 导出数据
        if($params['export']==1){
            $rowset = array(); // 导出的数据

            //TIPS 将换行符替换为excel中的单元格内换行符: 字符两侧加上双引号
            foreach ($rows as $k=>$r){
                $rowset[] = array(
                    'date' => $r['date'],
                    'kefu' => $r['uid'],
                    'store' => $r['store'],
                    'orderId' => "\"{$r['orderId']}\"",
                    'salelID' => "\"{$r['saleID']}\"",
                    'saleProblem' => "\"{$r['saleProblem']}\"",
                    'handleMessuares' => "\"{$r['handleMessuares']}\"",
                    'handleProcess' => "\"{$r['handleProcess']}\"",
                    'cserviceCallback' => "\"{$r['cserviceCallback']}\"",
                    'reviewer' => empty($r['reviewer'])?"未审核":"审核人:{$r['reviewer']}"
                );
            }

            $rowsHead = array(
                '日期',
                '客服',
                '店铺',
                '订单',
                'ID',
                '问题',
                '措施',
                '后台处理跟进',
                '客服反馈',
                '审核',
                "检索条件【{$arrText}】",
            );

            $filename= '售后单'.$aftFileName;
            $this->exportexcel($rowset, $rowsHead, $filename);
            exit;
        }else{
            $this->page = $Page->show();
            $this->list = $rows;            // 售后服务列表
            $this->stores = $stores;        //店铺
            $this->arr = $arr;              // 搜索条件
            $this->display();
        }
	}

	/**
	 * 新增售后信息
	 * Time : 2016-06-20
	 * @author : xgh
	 */
	public function add(){
		$map = I("get.");
		$fromAction = $map['fromAction'];
		unset($map['fromAction']);	// 来源Action
		$stores = C('store'); //店铺
		$aRow['uid'] = $_SESSION['uid'];
		$user = $this->getSalesman();

		$this->user = $user;		// 业务员
		$this->aRow = $aRow;		// 当前业务员信息
		$this->stores = $stores;		// 店铺列表
		$this->fromAction = $fromAction;
		$this->display();
	}

	/**
	 * 保存售后信息
	 * Time : 2016-06-20
	 * @author : xgh
	 * @return [type] [description]
	 */
	public function save(){
		header("Content-type:text/html;charset=utf-8");
		//dump(I());exit();
		$fromAction = "Profit/".I("get.fromAction")."/index";
		$data = I("post.");
		if($data['id']!=""){
			$res = M("aftersale")->save($data);
			if($res===false){
				$this->error('保存失败');
			}elseif($res===0){
				$this->success('未作任何更改',U($fromAction));
			}else{
				$this->success('保存成功',U($fromAction));
			}
		}else{
			M("aftersale")->add($data) || $this->error('添加失败');
			$this->success('添加成功',U($fromAction));
		}
	}

	/**
	 * 编辑售后信息
	 * Time : 2016-06-20
	 * @author : xgh
	 * @return [type] [description]
	 */
	public function edit(){
		$map = I("get.");
		$fromAction = $map['fromAction'];
		unset($map['fromAction']);	// 来源Action
		$stores = C('store'); //店铺
		$aRow = M('aftersale')->where($map)->find();
		$user = $this->getSalesman();

		$this->fromAction = $fromAction;
		$this->user = $user;		// 业务员
		$this->aRow = $aRow;		
		$this->stores = $stores;		// 店铺列表
		$this->display("add");
	}

	/**
	 * 删除
	 * Time : 2016-06-20
	 * @author : xgh
	 * @return [type] [description]
	 */
	public function delete(){
		$map['id'] = I('id');
		M('aftersale')->where($map)->delete() || $this->error('删除失败');
		$this->success('删除成功',U('Profit/Aftersale/index'));
	}
}

?>