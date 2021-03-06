<?php
namespace Profit\Controller;
use Common\Controller\CommonController;
class PlanController extends CommonController {

    /**
     * 生产计划列表页
     *
     */
    public function index(){
        $conditions = I('param.');
        // 检索条件- 起始时间~截止时间
        if($conditions['start_time'] != NULL && $conditions['end_time'] != NULL){
            $map['plan_date'] = array('between',
                array(strtotime($conditions['start_time']),strtotime($conditions['end_time']))
            );
            $arr['start_time']=$this->start_time = $conditions['start_time'];
            $arr['end_time']=$this->end_time = $conditions['end_time'];
        }

        // 检索条件-时间范围类型 ，默认为“全部”
        if($conditions['time_kind'] !=NULL){
            $arr['time_kind']=$this->time_kind = $conditions['time_kind'];
        }else{
            $arr['time_kind']=$this->time_kind = 1;
        }

        // 检索条件-供应商
        if($conditions['title'] != NUll){
            $arr['title']=$this->title = $conditions['title'];
            $map['title'] = array('like','%'.trim($conditions['title']).'%');
        }

        $this->arr=$arr;

        $count = M('plan_production')->where($map)->count();
        //传参
        $Page = new \Think\Page($count,100,I('param.'));
        $this->page  = $Page->show();
        $plans = D('plan_production')
            ->relation(true)
            ->where($map)
            ->order('plan_date desc')
            ->limit($Page->firstRow.','.$Page->listRows)->select();

        foreach ($plans as &$plan){
            // 计划时间
            $plan['plan_date'] = date('Y-m-d', $plan['plan_date']);
            // 创建时间
            $plan['ctime'] = date('Y-m-d H:i:s', $plan['ctime']);

            // 成品明细  production_bill
            $plan['bill'] = count($plan['plan_production_bill']);

            // 预测历史  forcast
            $plan['forecast'] = count($plan['plan_forecast']);

            // 原料明细  production_product
            $tmpIndex = count($plan['plan_forecast']) - 1;
            $plan['lastForecastId'] = $plan['plan_forecast'][$tmpIndex]['id'];
            $plan['productes'] = M('PlanForecastProduct')
                                 ->where(array('forecast_id'=>$plan['lastForecastId']))
                                 ->count();
            // 预测明细  forcast_bill

            // 生成采购预测

            // 导出采购预测
        }


        $this->Plans = $plans;
        $this->display();
    }

    /**
     * 查看计划中的成品需求明细
     */
    public function showBill(){

        $form = I('get.');

        $id   = $form['id'];


        $bill = D('PlanProductionBill')
                ->where(array('production_id'=>$id))
                ->relation(true)
                ->select();

        foreach ($bill as &$cp){
            $cp['name'] = $cp['chengpin_product']['name'];
            $cp['color'] = $cp['chengpin_product']['color'];
            $cp['kind'] = $cp['chengpin_product']['kind'];
            $cp['code'] = $cp['chengpin_product']['code'];
            $cp['norms'] = $cp['chengpin_product']['norms'];

            $cp['ctime'] = date('Y-m-d H:i:s', $cp['ctime']);
        }
        $this->rows = $bill;
        $this->display();
    }

    /**
     * 查看由计划生成预测的日志
     */
    public function showForecastedLog(){

        $form = I('get.');

        $id   = $form['id'];

        $forecastes = D('PlanForecast')
                      ->where(array('production_id'=>$id))
                      ->order(' ctime DESC ')
                      ->relation(true)
                      ->select();
        $cpList =  array();
        $proList =  array();
        foreach ($forecastes as  &$forecast){

            $forecast['cpMore'] = "<ul class='.nav'>";
            // 设置关联的成品信息
            foreach ($forecast['plan_forecast_bill'] as $bill){
                if(!isset($cpList[$bill['cpid']])){
                    $tmpCpInfo = M('ChengpinProduct')->find($bill['cpid']);
                    $cpList[$bill['cpid']] = $tmpCpInfo;
                }
                $tmpCp = $cpList[$bill['cpid']];
                $forecast['cpMore'] .= "<tr><td>{$bill['num']}</td><td>{$tmpCp['name']}</td><td>{$tmpCp['code']}</td><td>{$tmpCp['kind']}</td><td>{$tmpCp['color']}</td></tr>";
            }
            $forecast['cpMore'] ="<table  class='.nav'>"
                               ."<tr class='head'><td>数量</td><td>成品名</td><td>编码</td><td>类型</td><td>颜色</td></tr>"
                               . $forecast['cpMore']
                               . "</table>";

            // 设置关联的原料信息
            foreach ($forecast['plan_forecast_product'] as $pro){
                if(!isset($proList[$pro['product_id']])){
                    $tmpInfo = M('base_product')->find($pro['product_id']);
                    $proList[$pro['product_id']] = $tmpInfo;
                }
                $tmpPro = $proList[$pro['product_id']];
                $forecast['proMore'] .="<tr><td>{$pro['num']}</td><td>{$tmpPro['name']}</td><td>{$tmpPro['code']}</td><td>{$tmpPro['kind']}</td><td>{$tmpPro['norms']}</td></tr>";
            }
            $forecast['proMore'] ="<table  class='.nav'>"
                                ."<tr class='head'><td>数量</td><td>原料名</td><td>编码</td><td>类型</td><td>规格</td></tr>"
                                .$forecast['proMore']
                                ."</table>";

            $forecast['ctime'] = date('Y-m-d H:i:s', $forecast['ctime']);
        }


        $this->Logs  = $forecastes;

        $this->display();
    }


    /**
     * 查看由计划 预测 原料的采购明细
     * OR 导出该明细
     */
    public function showForecastProduct(){
        $form = I('get.');

        $id   = $form['id'];

        $fid   = $form['fid'];

        $products = D('PlanForecastProduct')
            ->where(array('forecast_id'=>$fid, 'production_id'=>$id))
            ->relation(true)
            ->select();

        foreach ($products as &$fproduct){
            $fproduct['name'] = $fproduct['product']['name'];
            $fproduct['color'] = $fproduct['product']['color'];
            $fproduct['kind'] = $fproduct['product']['kind'];
            $fproduct['code'] = $fproduct['product']['code'];

            $fproduct['ctime'] = date('Y-m-d H:i:s', $fproduct['ctime']);
        }
        $this->rows = $products;
        $this->display();

    }

    /**
     * 由计划按当前时间，构建 预测的原料采购明细
     */
    public function buildForecast(){
        $creator = $_SESSION['real_name'];
        $user_id = $_SESSION['uid'];
        $ctime    = time();

        // 获取页面数据
        $form =  I('post.');

        $productionId = $form['id'];

        $plan = D('PlanProduction')->relation(true)->where(array('id'=>$productionId))->find();

        $bill = $plan['plan_production_bill'];

        $forecastBill = array();
        $proCntMap = array();

        $chengpinModel = D('ChengpinProduct');
        // 转存预测清单；  预计算所需原料数量。
        foreach ($bill as $v){
            // 转存预测时的清单
            $frsBill = $v;
            // 消除更新时间
            $frsBill['bill_utime'] = $v['utime']?$v['utime']:$v['ctime'];
            $frsBill['ctime'] = $ctime;
            unset($frsBill['utime']);

            // 构建
            $forecastBill[] = $frsBill;

            // 计算所需的原料

            $tmpCp = $chengpinModel->relation(true)->where(array('id'=>$v['cpid']))->find();



            if(!(count($tmpCp['chengpinform'])>0)){
                continue;
            }
            // 计算
            foreach ($tmpCp['chengpinform'] as $cpf){
                // 初始化涉及的产品基本信息
                if(!isset($proCntMap[$cpf['productId']])){
                    // 产品信息;
                    $tmpProInfo = D('Product')->find(intval($cpf['productId']));
                    //库存信息
                    $tmpProKucunInfo = M('kucun')
                                    ->field('sum(cntFasheng) as kucun')
                                    ->where(" proId = {$cpf['productId']}")
                                    ->find();

                    $proCntMap[$cpf['productId']] = array(
                        'production_id' => $productionId,
                        'product_id'    => $cpf['productId'],
                        'product_name'  => $tmpProInfo['name'],
                        'product_code'  => $tmpProInfo['code'],
                        'kucun_safe_num'=> $tmpProInfo['safeCnt']?$tmpProInfo['safeCnt']:0,
                        'kucun_num'     => $tmpProKucunInfo['kucun']?$tmpProKucunInfo['kucun']:0,

                        // 初始化所需原料数量
                        'num'           =>  $cpf['cnt'] * $frsBill['num'] * 1,
                        'user_id'       => $user_id,
                        'creator'       => $creator,
                        'ctime'         => $ctime,
                    );
                }else{
                    // 累加所需原料数量
                    $proCntMap[$cpf['productId']]['num'] +=$cpf['cnt'] * $frsBill['num'] * 1;
                }
            }
        }
        $forecastProduct = array();
        // 构造所需原料数量
        foreach ($proCntMap as $proId => &$proInfo){
            // 计算: 需要购买量 =  所需数量 - (库存数量-库存警戒值)
            $proInfo['purchase_num'] = $proInfo['num']  - ($proInfo['kucun_num'] - $proInfo['kucun_safe_num']);

            // 若建议采购数为负数，则建议量应为0件，即不采购。
            $proInfo['purchase_num'] = $proInfo['purchase_num']<0?0:$proInfo['purchase_num'];

            $forecastProduct[] = $proInfo;
        }

        // 预测信息
        $forecast = array(
            'production_id' => $productionId,
            'date'          => date('Y-m-d'),
            'is_export'     => 0,
            'ctime'        => $ctime,
            'creator'      => $creator,
            'user_id'      => $user_id,
            'plan_forecast_bill'=> $forecastBill,
            'plan_forecast_product' => $forecastProduct,
        );

        $forecastModel = D('PlanForecast');


        // 保存前验证
        if (!$forecastModel->create($forecast)){
            $this->error($forecastModel->getError());
        }
        // 创建预测
        $res = $forecastModel->relation(true)->add($forecast);

        // 返回操作信息
        if($res !== false){
            $this->success('创建成功','', true);
        }else{
            $this->error('创建失败', '', true);
        }
    }


    /**
     * 导出生产计划
     */
    public function exportForecast(){
        $form = I('get.');

        $id   = $form['id'];

        $fid  = $form['fid'];

        // 生产计划
        $plan =  M('PlanProduction')->find($id);
        $title = urlencode($plan['title']);

        // 成品明细
        $bill = D('PlanForecastBill')
            ->where(array('production_id'=>$id, 'forecast_id'=>$fid))
            ->relation(true)
            ->select();

        // 分析后所需的原料明细
        $products = D('PlanForecastProduct')
            ->where(array('forecast_id'=>$fid, 'production_id'=>$id))
            ->relation(true)
            ->select();

        //导出
        $rowset = array();
        $rowset[] = array('成品编码','成品类型','成品名称','成品规格','成品颜色','成品所需数量','','');

        foreach ($bill as $cp){
            $rowset[] = array(
                'code' => $cp['chengpin_product']['code'],
                'kind' => $cp['chengpin_product']['kind'],
                'name' => $cp['chengpin_product']['name'],
                'norms'=> $cp['chengpin_product']['norms'],
                'color'=> $cp['chengpin_product']['color'],
                'num'=>$cp['num'],
                'blank1'=>'',
                'blank2' => '',
            );
        }
        $rowset[] = array();
        $rowset[] = array('【原料明细】');
        $rowset[] =  array('原料编码','原料类型','原料名称','原料规格','库存数量','库存安全值','所需数量','建议采购');
        foreach ($products as $row){
            $rowset[] = array(
                'code' => $row['product']['code'],
                'kind' => $row['product']['kind'],
                'name' => $row['product']['name'],
                'norms'=> $row['product']['norms'],
                'kucun_num'=> $row['kucun_num'],
                'kucun_safe_num'=>$row['kucun_safe_num'],
                'num'=>$row['num'],
                'purchase_num'   => $row['purchase_num'],
            );
        }

        $filename=date('Y-m-d',time()).'计划('.$title.')导出';
        $this->exportexcel($rowset,array('【成品明细】','','','','','','',''),$filename);
        exit;
    }

    /**
     * 导出原料采购明细
     */
    public function exportForecastProduct(){
        $form = I('get.');

        $id   = $form['id'];
        $fid   = $form['fid'];

        // 生产计划
        $plan =  M('PlanProduction')->find($id);

        // 生产计划的标题
        $title = $plan['title'];

        // 分析后所需的原料明细
        $products = D('PlanForecastProduct')
            ->where(array('forecast_id'=>$fid, 'production_id'=>$id))
            ->relation(true)
            ->select();

        //导出
        $rowset = array();
        foreach ($products as $row){
            $rowset[] = array(
                'code' => $row['product']['code'],
                'kind' => $row['product']['kind'],
                'name' => $row['product']['name'],
                'norms'=> $row['product']['norms'],
                'kucun_num'=> $row['kucun_num'],
                'kucun_safe_num'=>$row['kucun_safe_num'],
                'num'=>$row['num'],
                'purchase_num'   => $row['purchase_num'],
            );
        }
        $filename=date('Y-m-d',time()).'采购计划('.urlencode($title).')导出';
        $this->exportexcel($rowset,array('原料编码','原料类型','原料名称','原料规格','库存数量','库存安全值','所需数量','建议采购'),$filename);
        exit;
    }


    public function add(){
        $date = date('Y-m-d',time());
        $main = array('plan_date'=>$date, 'creator'=>$_SESSION['real_name']);
        $this->Main = $main;
        $this->Bills = array(array(),array(),array());
        $this->display('edit');
    }


    public function edit(){
        $form = I('param.');

        $id = $form['id'];

        $map['id'] = $id;

        $plan = M('plan_production')->where($map)->find();

        $plan['plan_date'] = date('Y-m-d', $plan['plan_date']);

        $bills = M('plan_production_bill p')
                 ->join('left join ykb_chengpin_product cp ON cp.id= p.cpid')
                ->field('p.id,p.cpid,cp.name,cp.code,cp.color,p.num')
                ->where(array('p.production_id'=>$id))
                ->select();

        $this->Main = $plan;
        $this->Bills = $bills;
        $this->display();
    }

    public function addInsert(){
        // 计划信息
        $form = I('post.');

        $res = $this->_saveBill($form);

        if($res !== false){
            $this->success('添加成功',U('Profit/Plan/index'));
        }else{
            $this->error('添加失败');
        }
    }

    private function _saveBill($form){
        $planModel = D('PlanProduction');

        // 负责人信息
        $creator = $_SESSION['real_name'];
        $user_id = $_SESSION['uid'];
        $time    = time();

        // 计划信息
        $form['plan_date'] = strtotime($form['plan_date']);

        // 计划将生产成品的信息
        $bill = array();
        foreach($form['cpid'] as $key => $v){
            // 没有成品ID的跳过
            if(empty($v)){
                continue;
            }
            $product = array(
                'cpid' => $form['cpid'][$key],
                'num'       => $form['num'][$key],
            );

            if($form['sonId'][$key]!=""){
                // 更新
                $product['id'] = $form['sonId'][$key];
            }else{
                // 新增
                $product['creator'] = $creator;
                $product['user_id'] = $user_id;
                $product['ctime'] = $time;
            }
            $bill[] = $product;
        }

        $form['plan_production_bill'] = $bill;

        // 保存前验证
        if (!$planModel->create($form)){
            $this->error($planModel->getError());
        }

        // 计划主信息
        if(I('id')){
            $res = $planModel->relation(true)->save($form);
        }else{
            unset($form['id']);
            // 新增
            $form['creator'] = $creator;
            $form['ctime']   = $time;
            $form['user_id'] = $user_id;

            $form['plan_code'] = $this->_getNewCode('PL','plan_production','plan_code');
            $res = $planModel->relation(true)->add($form);
        }
        return $res;
    }

    /**
     * 产品导入
     * @xuli
     * 2015-02-16
     */
    public function import(){
        ob_implicit_flush(true);
        echo "(0-0.000001-读取中……)~";
        ob_flush();
        $fileInfo = $_POST;
        $product = R('Base/Import/import',array($fileInfo['file']));
        $total = count($product);
        echo "(0-".$total."-读取完成，准备导入……)~";
        ob_flush();
        //处理数据
        $data = array();
        $Fields = array(
            'code' => '0',
            'cnt' => '1'
        );
        $i = 0;
        foreach($product as & $v){
            //客户信息
            $data[$i]['code'] = $v[$Fields['code']];
            $data[$i]['cnt'] = $v[$Fields['cnt']];
            $i++;
        }
        $form = array(
            'title' => $fileInfo['title'],
            'memo'  => $fileInfo['memo'],
            'plan_date'=> $fileInfo['date']?$fileInfo['date']:date('Y-m-d'),
        );

        echo "(0-".$total."-导入中……)~";
        ob_flush();
        //写入数据库
        $j=0;
        foreach ($data as $key=>$val){
            $j++;
            $cpInfo = M('ChengpinProduct')->where("code = '{$val['code']}'")->find();
            if(!empty($cpInfo)){
                $form['cpid'][] = $cpInfo['id'];
                $form['num'][] = $val['cnt'];

                echo "(".$j."-".$total."-{$val['code']}导入中……)~";
                ob_flush();
                usleep(5000);
            }
        }
        $res = $this->_saveBill($form);
        return $res;
    }


    /**
     * 删除计划
     */
    public function delete(){
        $form = I('param.');

        $id = $form['id'];

        $plan = D('PlanProduction')->where(array('id'=>$id))->relation(true)->find();

        // 删除前验证
        if($plan['is_lock']){
            $this->error('已被锁定，删除失败！', '', true);
        }
        if(count($plan['plan_forecast'])>0){
            $this->error('先删除相关的预测信息！', '', true);
        }
        // 关联删除所有数据
        $res = D('PlanProduction')->relation(true)->where(array('id'=>$id))->delete();

        if($res!==false){
            $this->success('删除成功', '', true);
        }else{
            $this->error('删除失败', '', true);
        }
    }

    /**
     * 删除计划的成品清单信息
     */
    public function deleteBill(){
        $form = I('param.');
        $id = $form['id'];

        $bill = D('PlanProductionBill')->where(array('id'=>$id))->find();

        // 成品清单，删除前验证
        if($bill['plan_production']['is_lock']){
            $this->error('该计划已被锁定，无法删除明细','', true);
        }

        $res = D('PlanProductionBill')->where(array('id'=>$id))->delete();

        if($res !== false){
            $this->success('删除成功', '', true);
        }else{
            $this->success('删除失败', '', true);
        }
    }

    /**
     * 删除预测出的信息
     */
    public function deleteForecast(){
        $form = I('param.');

        $id = $form['id'];

        $forecast = D('PlanForecast')->where(array('id'=>$id))->find();

        // 关联删除所有数据
        $res = D('PlanForecast')->relation(true)->where(array('id'=>$id))->delete();

        if($res!==false){
            $this->success('删除成功',U('Profit/Plan/index'));
        }else{
            $this->error('删除失败');
        }
    }


    // 原料供应统计报表
    public function report() {
        $conditions = I('param.');
        // 检索条件- 起始时间~截止时间
        if($conditions['start_time'] != NULL && $conditions['end_time'] != NULL){
            $map['k.dateFasheng'] = array('between',
                                        array(strtotime($conditions['start_time'])
                                             ,strtotime($conditions['end_time'])
                                             )
                                        );
            $arr['start_time']=$this->start_time = $conditions['start_time'];
            $arr['end_time']=$this->end_time = $conditions['end_time'];
        }

        // 检索条件-时间范围类型 ，默认为“全部”
        if($conditions['time_kind'] !=NULL){
            $arr['time_kind']=$this->time_kind = $conditions['time_kind'];
        }else{
            $arr['time_kind']=$this->time_kind = 1;
        }

        // 检索条件-供应商
        if($conditions['supplier'] != NUll){
            $arr['supplier']=$this->supplier = $conditions['supplier'];
            $mapSupplier['supplier_name'] = array('like','%'.trim($conditions['supplier']).'%');
        }

        $this->arr=$arr;

        // //导出
        // if($conditions['export']==1){
        // 	$row = M('profit')->where($map)->select();
        // 	$rowset=array();
        // 	if(count($row)>0)foreach($row as &$v){
        // 		$rowset[]=array(
        // 			'date'=>$v['date'],
        // 			'store'=>$stores[$v['store']],
        // 			'realMoney'=>$v['realMoney'],
        // 			'refund'=>$v['refund'],
        // 			'zcMoney'=> $v['zcMoney'],
        // 			'zcFeiyong'=> $v['zcMoney']*$v['zcRate'],
        // 			'tgFeiyong'=>$v['tgFeiyong'],
        // 			'profit'=>($v['realMoney']-$v['refund'])*$v['rate']-$v['zcMoney']*$v['zcRate']-$v['tgFeiyong'],
        // 			);
        // 		$realM +=$v['realMoney'];
        // 		$refund +=$v['refund'];
        // 		$zcMoney +=$v['zcMoney'];
        // 		$zcFeiyong +=$v['zcMoney']*$v['zcRate'];
        // 		$tgFeiyong +=$v['tgFeiyong'];
        // 		$profitT +=($v['realMoney']-$v['refund'])*$v['rate']-$v['zcMoney']*$v['zcRate']-$v['tgFeiyong'];
        // 	}
        // 	$rowset[] = array(
        // 		'date' => "合计",
        // 		'store'=>'',
        // 		'realMoney'=>$realM,
        // 		'refund'=>$refund,
        // 		'zcMoney'=> $zcMoney,
        // 		'zcFeiyong'=>$zcFeiyong,
        // 		'tgFeiyong'=>$tgFeiyong,
        // 		'profit'=>$profitT
        // 	);
        // 	$filename=date('Y-m-d',time()).'  利润表导出';
        // 	$this->exportexcel($rowset,array('日期','店铺','真实销售额','退款额','种菜额','种菜费用','推广费用','利润额'),$filename);
        // 	exit;
        // }

        $count = M('supplier')->where($mapSupplier)->count();
        //传参
        $Page = new \Think\Page($count,100,I('param.'));
        $this->page  = $Page->show();
        $supplier = M('supplier')
            ->where($mapSupplier)
            ->field('supplier_name AS supplierName, id')
            ->limit($Page->firstRow.','.$Page->listRows)->select();
        //查询数据
        // $list = D('supplier s')
        //         ->join("left join __KUCUN__ k on k.sid = s.id")
        //         // ->where($map)
        //         ->limit($Page->firstRow.','.$Page->listRows)
        //         ->field("s.id, supplier_name AS supplierName,SUM(IF(k.kind='入库',k.cntFasheng,0)) AS rukuCnt, SUM(IF(k.kind='出库',k.cntFasheng,0)) AS chukuCnt")
        //         ->group('s.id')
        //         ->order('s.id')
        //         ->select();
        // 期初检索条件
        $preMap =   array(
                        'dateFasheng'=>array('lt',strtotime($conditions['start_time']))
                    );
        foreach($supplier as & $v){
            // 检索供应商当期期初结余
            $preMap['sid']= $v['id'];
            $preRow = D('kucun')
                   ->where($preMap)
                   ->field("SUM(IF(kind='入库',cntFasheng,0)) AS rukuCnt, SUM(IF(kind='出库',cntFasheng,0)) AS chukuCnt")
                   ->find();
            $map['sid'] = $v['id'];
            $crtRow = D('kucun')
                   ->where($map)
                   ->field("SUM(IF(kind='入库',cntFasheng,0)) AS rukuCnt, SUM(IF(kind='出库',cntFasheng,0)) AS chukuCnt")
                   ->find();

            $v['preCnt'] = $preRow['rukuCnt']-$preRow['chukuCnt'];
            $v['rukuCnt'] = $crtRow['rukuCnt']?$crtRow['rukuCnt']:0;
            $v['chukuCnt'] = $crtRow['chukuCnt']?$crtRow['chukuCnt']:0;
            $v['currentCnt'] = $v['preCnt'] + $crtRow['rukuCnt'] - $crtRow['chukuCnt'];
        }

        $this->list = $supplier;
        $this->display();
    }
}