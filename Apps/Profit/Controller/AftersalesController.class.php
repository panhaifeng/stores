<?php 
namespace Profit\Controller;
use Common\Controller\CommonController;
/**
 * 售后服务登记、修改
 */
class AftersalesController extends CommonController {
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
            $map['audit'] = ($params['audit']==0)?0:array('gt', 0);
            $arr['audit'] = $params['audit'];

            $arrText = $params['audit']==0?'未审核':'已审核';
        }else{
            $arr['audit'] = 0; // 默认为0:未审核;
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
        $setStore = $this->SetStore($_SESSION['uid']);//设置商铺的人员
        if($setStore){
            foreach ($setStore as $key => $value) {
                $setStore[$key] = $value['storeId'];
            }
        }
        if($setStore) $map['a.store'] = array('in',$setStore);
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
        //检索:快递单号
        if(!empty($params['transId'])){
            $map['a.transId'] = array('like',"%{$params['transId']}%");
            $arr['transId'] = $params['transId'];
            $arrText .= ' 快递单号：'.$arr['transId'];
        }

        // 总记录数
        $count = M("aftersales a")
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
        $rows = M("aftersales a")
                ->join('LEFT JOIN __USER__ u ON u.id = a.uid')
                ->where($map)
                ->limit($Page->firstRow.','.$Page->listRows)
                ->field('a.*')
                ->select();

        // 渲染数据
        $stores = C('store');//店铺
    
        $saleProblems = C('saleProblems');//售后问题
        $plan = C('plan');//售后问题
        // 客服
        $user = $this->getSalesman();
        $userMap = array();
        foreach ($user as $u){
            $userMap[$u['id']] = $u;
        }
        //dump($rows);die;
        // 获取 客服人员 ， 商店名称 和 审核人员 信息
        foreach ($rows as $k => &$v) {
           
            $v['store'] = $stores[$v['store']];                         // 商店名称
            $v['saleProblem'] = $saleProblems[$v['saleProblem']];                         // 问题
            $v['handleMessuares'] = $plan[$v['handleMessuares']];                         // 方案
            $v['uid']  = $userMap[$v['uid']]['real_name'];              // 客服人员姓名
            $v['auditName']  = isset($userMap[$v['operatorSec']])?$userMap[$v['operatorSec']]['real_name']:'';    // 审核人员姓名
           
           
        }
        //针对搜索框，显示登录人对应的店铺
        $searchStore = $this->SearchStore($_SESSION['uid'],$stores);
        $stores = $searchStore;
    
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
                    'audit' => empty($r['audit'])?"未审核":"审核人:{$r['audit']}"
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
                '审核',
            );

            $filename= '售后单'.$aftFileName;
            $this->exportexcel($rowset, $rowsHead, $filename);
            exit;
        }else{
            $this->page = $Page->show();
            $this->list = $rows;            // 售后服务列表
            $this->stores = $stores;        //店铺
            $this->saleProblems = $saleProblems;        //售后问题
            $this->plan = $plan;        //售后方案
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
        //针对搜索框，显示登录人对应的店铺
        $searchStore = $this->SearchStore($_SESSION['uid'],$stores);
        $stores = $searchStore;

        $saleProblems = C('saleProblems');//售后问题
        $plan = C('plan');//售后问题
		$aRow['uid'] = $_SESSION['uid'];
		$user = $this->getSalesman();

		$this->user = $user;		// 业务员
		$this->aRow = $aRow;		// 当前业务员信息
		$this->stores = $stores;		// 店铺列表
        $this->saleProblems = $saleProblems;        //售后问题
        $this->plan = $plan;        //售后方案
		$this->fromAction = $fromAction;
		$this->display();
	}

    /**
     * 编辑售后信息
     * Time : 2018-12-07
     * @author : shen
     * @return [type] [description]
     */
    public function edit(){
        $map = I("get.");
        $fromAction = $map['fromAction'];
        unset($map['fromAction']);  // 来源Action
        $stores = C('store'); //店铺
        //针对搜索框，显示登录人对应的店铺
        $searchStore = $this->SearchStore($_SESSION['uid'],$stores);
        $stores = $searchStore;
        $saleProblems = C('saleProblems');//售后问题
        $plan = C('plan');//售后问题
        $aRow = M('aftersales')->where($map)->find();
        $user = $this->getSalesman();

        $this->fromAction = $fromAction;
        $this->user = $user;        // 业务员
        $this->aRow = $aRow;        
        $this->stores = $stores;        // 店铺列表
        $this->saleProblems = $saleProblems;        //售后问题
        $this->plan = $plan;        //售后方案
        $this->display("add");
    }

    //ajax判断前台输入的订单号是否已经存在
    public function getOrderId(){
          $orderId = M('aftersales')->where(array('orderId'=>I('orderId')))->select(); //查询页面上的orderid表中有没有
          if(I('ids')){  //修改的时候
             if($orderId && $orderId[0]['id']!=I('ids')){
                $this->ajaxReturn($orderId);
             }
          }else{   //增加的时候
             if($orderId){
              $this->ajaxReturn($orderId);
             }
          }
          
    }

	/**
	 * 保存售后信息
	 * Time : 2018-12-06
	 * @author : shen
	 * @return [type] [description]
	 */
	public function save(){
		header("Content-type:text/html;charset=utf-8");
		//dump(I());exit();
		$fromAction = "Profit/".I("get.fromAction")."/index";
		$data = I("post.");
        //查询前台页面输入的订单号，是否已经存在
        $orderId = M('aftersales')->where(array('orderId'=>$data['orderId']))->select();

		if($data['id']!=""){
            if($orderId && $orderId[0]['id'] != $data['id']){
                $this->error('已存在该订单号，请重新输入！');
            }
			$res = M("aftersales")->save($data);
			if($res===false){
				$this->error('保存失败');
			}elseif($res===0){
				$this->success('未作任何更改',U($fromAction));
			}else{
				$this->success('保存成功',U($fromAction));
			}
		}else{
            if($orderId){
                $this->error('已存在该订单号，请重新输入！');
            }
			M("aftersales")->add($data) || $this->error('添加失败');
			$this->success('添加成功',U($fromAction));
		}
	}

	/**
	 * 删除
	 * Time : 2018-12-06
	 * @author : shen
	 * @return [type] [description]
	 */
	public function delete(){
		$map['id'] = I('id');
		M('aftersales')->where($map)->delete() || $this->error('删除失败');
		$this->success('删除成功',U('Profit/Aftersales/index'));
	}

    /**
     * 运营
     * Time : 2018-12-7
     * @author : shen
     * @return [type] [description]
     */
    public function secPage(){
        $params = I("param.");
        //dump($params);die;
        //dump($params);die;
        $map = array(); // 查询用,检索条件
        $arr = array(); // 缓存用,检索条件
        // 检索:审核
        if(isset($params)){
            $map['audit'] = ($params['audit']==0)?0:array('gt', 0);
            $arr['audit'] = $params['audit'];

            $arrText = $params['audit']==0?'未审核':'已审核';
        }else{
            $arr['audit'] = 0; // 默认为0:未审核;
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

         //检索:快递单号
        if(!empty($params['transId'])){
            $map['a.transId'] = array('like',"%{$params['transId']}%");
            $arr['transId'] = $params['transId'];
            $arrText .= ' 快递单号：'.$arr['transId'];
        }

        $setStore = $this->SetStore($_SESSION['uid']);//设置商铺的人员
        if($setStore){
            foreach ($setStore as $key => $value) {
                $setStore[$key] = $value['storeId'];
            }
        }
        if($setStore) $map['a.store'] = array('in',$setStore);
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
        $count = M("aftersales a")
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
        $rows = M("aftersales a")
                ->join('LEFT JOIN __USER__ u ON u.id = a.uid')
                ->where($map)
                ->limit($Page->firstRow.','.$Page->listRows)
                ->field('a.*')
                ->select();
        $nowPage = $Page->getNowPages(); //获取当前页
        //dump($nowPage);die;
        // 渲染数据
        $stores = C('store');//店铺
        //针对搜索框，显示登录人对应的店铺
        $searchStore = $this->SearchStore($_SESSION['uid'],$stores);
        $stores = $searchStore;

        $saleProblems = C('saleProblems');//售后问题
        $plan = C('plan');//售后问题
        $feedback = C('feedback');//处理反馈
        // 客服
        $user = $this->getSalesman();
        $userMap = array();
        foreach ($user as $u){
            $userMap[$u['id']] = $u;
        }
        // 获取 客服人员 ， 商店名称 和 审核人员 信息
        foreach ($rows as $k => &$v) {
            $v['store'] = $stores[$v['store']];                         // 商店名称
            $v['saleProblem'] = $saleProblems[$v['saleProblem']];                         // 问题
            $v['handleProcessId'] = $v['handleProcess'];
            $v['handleMessuares'] = $plan[$v['handleMessuares']]; 
            $v['handleProcess'] = $feedback[$v['handleProcess']]; 
            $v['uid']  = $userMap[$v['uid']]['real_name'];              // 客服人员姓名
            $v['auditName']  = isset($userMap[$v['operatorSec']])?$userMap[$v['operatorSec']]['real_name']:'';    // 审核人员姓名
        }
        $operatorId = $_SESSION['uid'];
        $this->operatorId = $operatorId;        // 当前操作员
        $this->user = $user;        // 业务员
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
                    'audit' => empty($r['audit'])?"未审核":"审核人:{$r['audit']}"
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
                '处理反馈',
                '审核',
            );

            $filename= '售后单'.$aftFileName;
            $this->exportexcel($rowset, $rowsHead, $filename);
            exit;
        }else{
            $this->nowPage = $nowPage;      //当前页
            $this->page = $Page->show();
            $this->list = $rows;            // 售后服务列表
            $this->stores = $stores;        //店铺
            $this->arr = $arr;              // 搜索条件
            $this->feedback = $feedback;    // 处理反馈
            $this->display();
        }
    }

     /**
     * 保存
     * Time : 2018-12-06
     * @author : shen
     * @return [type] [description]
     */
    public function operating(){
        header("Content-type:text/html;charset=utf-8");
        $data = I("post.");
        // dump($data);die;
        $arr['operator'] = $data['uid'];
        $arr['handleProcess'] = $data['handleProcess'];
        $arr['memoYy'] = $data['memoYy'];
        $arr['id'] = $data['aId'];
        $fromAction = "Profit/Aftersales/secPage";
        if($arr['id']!=""){
            $res = M("aftersales")->save($arr);
            if($res===false){
                $this->error('保存失败');
            }elseif($res===0){
                $this->success('未作任何更改',U($fromAction,array('p'=>$data['pages'])));
            }else{
                $this->success('保存成功',U($fromAction,array('p'=>$data['pages'])));
            }
        }else{
            $this->error('保存失败',U($fromAction));
        }
    } 


    /**
     * 品控
     * Time : 2018-12-7
     * 
     * @author : shen
     * @return [type] [description]
     */
    public function thirdPage(){
        $params = I("param.");

        $map = array(); // 查询用,检索条件
        $arr = array(); // 缓存用,检索条件
        // 检索:审核
        if(isset($params)){
            $map['audit'] = ($params['audit']==0)?0:array('gt', 0);
            $arr['audit'] = $params['audit'];

            $arrText = $params['audit']==0?'未审核':'已审核';
        }else{
            $arr['audit'] = 0; // 默认为0:未审核;
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

               //检索:快递单号
        if(!empty($params['transId'])){
            $map['a.transId'] = array('like',"%{$params['transId']}%");
            $arr['transId'] = $params['transId'];
            $arrText .= ' 快递单号：'.$arr['transId'];
        }
        
        $setStore = $this->SetStore($_SESSION['uid']);//设置商铺的人员
        if($setStore){
            foreach ($setStore as $key => $value) {
                $setStore[$key] = $value['storeId'];
            }
        }
        if($setStore) $map['a.store'] = array('in',$setStore);
        // 检索:订单编号
        if(!empty($params['orderId'])){
            $map['a.orderId'] = array('like', "%{$params['orderId']}%");
            $arr['orderId'] = $params['orderId'];

            $arrText .= ' | 订单: '.$arr['orderId'];
        }
        //运营处理过后才可以进行这一步，没有做运营处理的就不显示
        $map['a.handleProcess'] = array("neq","");
        //$map['_string'] = 'a.handleProcess is not null';
        // 检索:客服姓名
        if(!empty($params['userName'])){
            $map['u.real_name'] = array('like', "%{$params['userName']}%");
            $arr['userName']    = $params['userName'];

            $arrText .= ' 客服: '.$arr['userName'];
        }
        //dump($map);die;
        // 总记录数
        $count = M("aftersales a")
            ->join('LEFT JOIN __USER__ u ON u.id = a.uid')
            ->where($map)
            ->count();

        if($params['export']==1){
            $Page = new \Think\Page($count, $count, $arr);
        }else{
            // 分页
            $Page = new \Think\Page($count, 30, $arr);
        }

        $nowPage = $Page->getNowPages(); //获取当前页
        // 查询
        $rows = M("aftersales a")
                ->join('LEFT JOIN __USER__ u ON u.id = a.uid')
                ->where($map)
                ->limit($Page->firstRow.','.$Page->listRows)
                ->field('a.*')
                ->select();

        // 渲染数据
        $stores = C('store');//店铺
        //针对搜索框，显示登录人对应的店铺
        $searchStore = $this->SearchStore($_SESSION['uid'],$stores);
        $stores = $searchStore;

        $saleProblems = C('saleProblems');//售后问题
        $plan = C('plan');//售后问题
        $feedback = C('feedback');//处理反馈
        $confirmQc = C('confirmQc');//售后问题确认
        // 客服
        $user = $this->getSalesman();
        $userMap = array();
        foreach ($user as $u){
            $userMap[$u['id']] = $u;
        }
        // 获取 客服人员 ， 商店名称 和 审核人员 信息
        foreach ($rows as $k => &$v) {
            $v['store'] = $stores[$v['store']];                         // 商店名称
            $v['saleProblem'] = $saleProblems[$v['saleProblem']];                         // 问题
            $v['handleMessuares'] = $plan[$v['handleMessuares']]; 
            $v['handleProcess'] = $feedback[$v['handleProcess']]; 
            $v['confirmQcText'] = $confirmQc[$v['confirmQc']]; 
            $v['uid']  = $userMap[$v['uid']]['real_name'];              // 客服人员姓名
            $v['auditName']  = isset($userMap[$v['operatorSec']])?$userMap[$v['operatorSec']]['real_name']:'';    // 审核人员姓名
            $v['auditState'] = $v['audit']>0?"通过":"未通过";
        }
        $operatorId = $_SESSION['uid'];
        $this->operatorId = $operatorId;        // 当前操作员
        $this->user = $user;        // 业务员
        // dump($rows);die;
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
                    'confirmQcText' => "\"{$r['confirmQcText']}\"",
                    'memoQc' => "\"{$r['memoQc']}\"",
                    'audit' => empty($r['audit'])?"未审核":"审核人:{$r['audit']}"
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
                '运营处理反馈',
                '后台处理跟进',
                '客服反馈',
                '审核',
            );

            $filename= '售后单'.$aftFileName;
            $this->exportexcel($rowset, $rowsHead, $filename);
            exit;
        }else{
            $this->nowPage = $nowPage;      //获取当前页
            $this->page = $Page->show();
            $this->list = $rows;            // 售后服务列表
            $this->stores = $stores;        //店铺
            $this->arr = $arr;              // 搜索条件
            $this->feedback = $feedback;    // 处理反馈
            $this->confirmQcs = $confirmQc;    // 售后问题确认
            $this->display();
        }
    }

   public function QcSave()
   {
        header("Content-type:text/html;charset=utf-8");
        $data = I("post.");
        $arr['Qc'] = $data['uid'];
        $arr['confirmQc'] = $data['confirmQc'];
        $arr['id'] = $data['aId'];
        $arr['memoQc'] = $data['memoQc'];
        // dump($arr);die;
        $fromAction = "Profit/Aftersales/thirdPage";
        if($arr['id']!=""){
            $res = M("aftersales")->save($arr);
            if($res===false){
                $this->error('保存失败');
            }elseif($res===0){
                $this->success('未作任何更改',U($fromAction,array('p'=>$data['pagePk'])));
            }else{
                $this->success('保存成功',U($fromAction,array('p'=>$data['pagePk'])));
            }
        }else{
            $this->error('保存失败',U($fromAction));
        }
   }

   /**
     * 运营审核
     * Time : 2018-12-7
     * 
     * @author : shen
     * @return [type] [description]
     */
    public function fourthPage(){
        $params = I("param.");

        $map = array(); // 查询用,检索条件
        $arr = array(); // 缓存用,检索条件
        // 检索:审核
        if(isset($params)){
            $map['audit'] = ($params['audit']==0)?0:array('gt', 0);
            $arr['audit'] = $params['audit'];

            $arrText = $params['audit']==0?'未审核':'已审核';
        }else{
            $arr['audit'] = 0; // 默认为0:未审核;
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

               //检索:快递单号
        if(!empty($params['transId'])){
            $map['a.transId'] = array('like',"%{$params['transId']}%");
            $arr['transId'] = $params['transId'];
            $arrText .= ' 快递单号：'.$arr['transId'];
        }

        $setStore = $this->SetStore($_SESSION['uid']);//设置商铺的人员
        if($setStore){
            foreach ($setStore as $key => $value) {
                $setStore[$key] = $value['storeId'];
            }
        }
        if($setStore) $map['a.store'] = array('in',$setStore);
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
        //品控处理过后才会显示
        $map['a.confirmQc'] = array('neq','');

        // 总记录数
        $count = M("aftersales a")
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
        $rows = M("aftersales a")
                ->join('LEFT JOIN __USER__ u ON u.id = a.uid')
                ->where($map)
                ->limit($Page->firstRow.','.$Page->listRows)
                ->field('a.*')
                ->select();
        // 渲染数据
        $stores = C('store');//店铺
        //针对搜索框，显示登录人对应的店铺
        $searchStore = $this->SearchStore($_SESSION['uid'],$stores);
        $stores = $searchStore;

        $saleProblems = C('saleProblems');//售后问题
        $plan = C('plan');//售后问题
        $feedback = C('feedback');//处理反馈
        $confirmQc = C('confirmQc');//售后问题确认
        // 客服
        $user = $this->getSalesman();
        $userMap = array();
        foreach ($user as $u){
            $userMap[$u['id']] = $u;
        }
        // 获取 客服人员 ， 商店名称 和 审核人员 信息
        foreach ($rows as $k => &$v) {
            $v['store'] = $stores[$v['store']];                         // 商店名称
            $v['saleProblem'] = $saleProblems[$v['saleProblem']];                         // 问题
            $v['handleMessuares'] = $plan[$v['handleMessuares']]; 
            $v['confirmQcText'] = $confirmQc[$v['confirmQc']]; 
            $v['handleProcess'] = $feedback[$v['handleProcess']]; 
            $v['uid']  = $userMap[$v['uid']]['real_name'];              // 客服人员姓名
            $v['auditName']  = isset($userMap[$v['operatorSec']])?$userMap[$v['operatorSec']]['real_name']:'';    // 审核人员姓名
            $v['auditState'] = $v['audit']>0?"通过":"未通过";
        }
        $operatorId = $_SESSION['uid'];
        $this->operatorId = $operatorId;        // 当前操作员
        $this->user = $user;        // 业务员
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
                    'auditState' => "\"{$r['auditState']}\"",
                    'auditName' => "\"{$r['auditName']}\"",
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
                '运营处理反馈',
                '状态',
                '审核人',
            );

            $filename= '售后单'.$aftFileName;
            $this->exportexcel($rowset, $rowsHead, $filename);
            exit;
        }else{
            $this->page = $Page->show();
            $this->list = $rows;            // 售后服务列表
            $this->stores = $stores;        //店铺
            $this->arr = $arr;              // 搜索条件
            $this->feedback = $feedback;    // 处理反馈
            $this->confirmQcs = $confirmQc;    // 售后问题确认
            $this->display();
        }
    }

   public function shenheSave()
   {
        header("Content-type:text/html;charset=utf-8");
        $data = I("post.");
        $arr['id'] = $data['aId'];
        $arr['audit'] = $data['audit']+0;
        $arr['operatorSec'] = $data['uid'];
        $arr['operatorMemo'] = $data['operatorMemo'];
        $fromAction = "Profit/Aftersales/thirdPage";
        if($arr['id']!=""){
            $res = M("aftersales")->save($arr);
            if($res===false){
                $this->error('保存失败');
            }elseif($res===0){
                $this->success('未作任何更改',U($fromAction));
            }else{
                $this->success('保存成功',U($fromAction));
            }
        }else{
            $this->error('保存失败',U($fromAction));
        }
   }

   public function report(){
        $conditions = I('param.');
        if($conditions['start_time'] != NULL && $conditions['end_time'] != NULL){
            $map['a.date'] = array('between',array($conditions['start_time'],$conditions['end_time']));
            $arr['start_time']=$this->start_time = $conditions['start_time'];
            $arr['end_time']=$this->end_time = $conditions['end_time'];
        }else{
            //TODO:需优化！太难看了，虽然功能OK了
            if($conditions['time_kind'] !=NULL){
                
            }else{ 
                $arr['start_time']=$this->start_time = date('Y-m-01');
                $arr['end_time']=$this->end_time = date("Y-m-d");
                $map['a.date'] = array('between',array($this->start_time,$this->end_time));
            }
        }
        if($conditions['time_kind'] !=NULL){
            $arr['time_kind']=$this->time_kind = $conditions['time_kind'];
        }else{
            $arr['time_kind']=$this->time_kind = 1;
        }
        $noStore = true;
        if($conditions['store'] != NUll){
            $map['a.store'] = $conditions['store'];
            $arr['store']=$this->store = $conditions['store'];
            $noStore = false;
        } 
        //统计审核过的
        $map['a.audit'] = 1;
        $arr['audit'] = 1;

        $this->arr=$arr;
        $this->stores = $stores = C('store');
        $confirmQc = C('confirmQc');//售后问题确认

        if($noStore){
            $group='a.confirmQc';
        }else{
            $group='a.store,a.confirmQc';
        }
        $map['a.confirmQc']   = array('NEQ','');

        $count = M('aftersales a')->where($map)->count(); 
        $Page = new \Think\Page($count,100,I('param.'));//传参
        $this->page  = $Page->show();

        $aftersales = M('aftersales a')
            ->join('LEFT JOIN __USER__ u ON u.id = a.uid')
            ->where($map)
            ->field('a.*,u.user_name,count(a.id)as cnt')
            ->group($group)
            ->limit($Page->firstRow.','.$Page->listRows)->select();
        foreach($aftersales as & $v){
            $v['store']=$stores[$v['store']];
            $v['confirmQcText'] = $confirmQc[$v['confirmQc']]; 
        }

        //导出
        if($conditions['export']==1){
            $rowset=array();
            if(count($aftersales)>0)foreach($aftersales as &$v){ 
                if($noStore){
                    $rowset[]=array(
                        'date'=>$v['date'],
                        'confirmQcText' => str_replace('—','-',$confirmQc[$v['confirmQc']]),
                        'cnt' => $v['cnt'],
                    );
                }else{
                    $rowset[]=array(
                        'date'=>$v['date'],
                        'store'=>$v['store'],
                        'confirmQcText' => str_replace('—','-',$confirmQc[$v['confirmQc']]),
                        'cnt' => $v['cnt'],
                    );
                }
            }
            if($noStore){
                $exportArr = array('日期','问题类型','数量');
            }else{
                $exportArr = array('日期','店铺','问题类型','数量');
            }
            // dump($rowset);die;
            $filename=date('Y-m-d',time()).'售后分析表导出';
            $this->exportexcel($rowset,$exportArr,$filename);
            exit;
        }
       
        
     
        $this->aftersales = $aftersales;
        $this->display();
   }

   /**
     * 导出权限
     * Time : 2018-12-10
     * 
     * @author : shen
     * @return [type] [description]
     */
    public function exportFirst(){
        $this->index();
    }

    /**
     * 导出权限
     * Time : 2018-12-10
     * 
     * @author : shen
     * @return [type] [description]
     */
    public function exportSec(){
        $this->secPage();
    }

    /**
     * 导出权限
     * Time : 2018-12-10
     * 
     * @author : shen
     * @return [type] [description]
     */
    public function exportThird(){
        $this->thirdPage();
    }

    /**
     * 导出权限
     * Time : 2018-12-10
     * 
     * @author : shen
     * @return [type] [description]
     */
    public function exportFourth(){
        $this->fourthPage();
    }

    /**
     * 导出权限
     * Time : 2018-12-10
     * 
     * @author : shen
     * @return [type] [description]
     */
    public function exportReport(){
        $this->report();
    }
}

?>