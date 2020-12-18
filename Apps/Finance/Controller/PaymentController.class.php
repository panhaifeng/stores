<?php
namespace Finance\Controller;
use Common\Controller\CommonController;
class PaymentController extends CommonController {

    /**
     * 付款查询
     * @author xuli
     * 2015-1-15
     */
    public function index() {
        $conditions = I('param.');
        //dump($conditions);
        if($conditions['start_time'] != NULL && $conditions['end_time'] != NULL){
            $time[0] = strtotime($conditions['start_time']);
            $time[1] = strtotime($conditions['end_time']);
            $map['payment_date'] = array('between',array($time[0],$time[1]));
            $arr['start_time']=$this->start_time = $conditions['start_time'];
            $arr['end_time']=$this->end_time = $conditions['end_time'];
        }else{
            //TODO:需优化！太难看了，虽然功能OK了
            if($conditions['time_kind'] !=NULL){

            }else{
                $time[0] = strtotime(date('Y-m-1'));
                $time[1] = strtotime(date("Y-m-d"));
                $map['payment_date'] = array('between',array($time[0],$time[1]));
                $arr['start_time']=$this->start_time = date('Y-m-1');
                $arr['end_time']=$this->end_time = date("Y-m-d");
            }
        }
        if($conditions['time_kind'] !=NULL){
            $arr['time_kind']=$this->time_kind = $conditions['time_kind'];
        }else{
            $arr['time_kind']=$this->time_kind = 1;
        }
        if($conditions['payment_type'] != NUll){
            $map['item']  = $conditions['payment_type'];
            $arr['payment_type']=$this->pkind = $conditions['payment_type'];
            $map2['parentId'] = $conditions['payment_type'];
            $this->payment2 = M('payment')->where($map2)->select();
        }
        if($conditions['payment_type2'] != NUll){
            $map['son']  = $conditions['payment_type2'];
            $arr['payment_type2']=$this->pkind2 = $conditions['payment_type2'];
            $map2['parentId'] = $conditions['payment_type'];
            $this->payment2 = M('payment')->where($map2)->select();
        }
        if($conditions['memo'] != NUll){
            $map['memo'] = array('like','%'.trim($conditions['memo']).'%');
            $arr['memo']=$this->memo = $conditions['memo'];
        }
        //dump($map);die;
        $this->arr=$arr;
            if($conditions['export']==1){
            $row = M('payment_money')->where($map)->order('id asc')->select();
            $rowset=array();
            if(count($row)>0)foreach($row as &$v){
                $rowset[]=array(
                    'payment_number'=>$v['payment_number'],
                    'payment_date'=>date('Y-m-d',$v['payment_date']),
                    'bankname'=>$this->getBankname($v['bankid']),
                    'son_name'=> $this->getSon2($v['item'])."->".$this->getSon2($v['son']),
                    'payment_money'=>$v['payment_money'],
                    'memo'=>$v['memo'],
                    );
                $money += $v['payment_money'];
            }
            $rowset[] = array(
                'payment_number' => "合计",
                'payment_date'=>'',
                'bankname'=>'',
                'son_name'=>'',
                'payment_money'=>$money,
                'memo'=>'',
            );
            $filename=date('Y-m-d',time()).'  付款数据';
            $this->exportexcel($rowset,array('付款单号','付款时间','银行账户','付款项目','付款金额','备注'),$filename);
            exit;
        }
        $count = M('payment_money m')->where($map)->count();
        $Page = new \Think\Page($count,100,I('param.'));
        $this->page = $Page->show();

        $row = M('payment_money m')->where($map)->order('payment_date desc')
        ->limit($Page->firstRow.','.$Page->listRows)->select();

        foreach($map as $key=>$val) {
            $Page->parameter[$key] = urlencode($val);
        }
        $type = C('collection_type');
        if(count($row)>0)foreach($row as &$v){
            $v['bankname'] = $this->getBankname($v['bankid']);
            $v['son_name'] = $this->getSon2($v['item'])."->".$this->getSon2($v['son']);
            $v['payment_type'] = $type[$v['payment_type']];
            $v['payment_date'] = date('Y-m-d',$v['payment_date']);
            $money += $v['payment_money'];
        }
        $row[] = array(
            'payment_number' => "合计",
            'payment_money'  => $money,
            'edit'			 => 1,
        );
        $where['parentId'] = 0;
        $this->payment = M('payment')->where($where)->select();
        $this->money = $row;
        $this->display();
    }

    /**
     * 付款修改
     * @author xuli
     * 2015-1-15
     */
    public function edit() {
        $map['id'] = I('id');
        $this->_addCurrentUserInfo();
        $row = M('payment_money')->where($map)->find();
        
        $mapSupp['id'] = $row['supplierId'];
        $res = M('supplier')->where($mapSupp)->find();
        $row['supplierName'] = $res['supplier_name'];
        $this->payment = $row;
        $this->payment_date = date('Y-m-d',$this->payment['payment_date']);
        $this->bank = M('bank')->where('id',I('bankid'))->select();
        $this->payment_parent = M('payment')->where('parentId = 0')->select();
        $map2['parentId'] = $this->payment['item'];
        $this->payment_son = M('payment')->where($map2)->select();
        $this->display('add');
    }

    /**
     * 付款登记
     * @author xuli
     * 2015-1-15
     */
    public function add() {
        $this->_addCurrentUserInfo();
        $this->bank = M('Bank')->select();
        $this->payment_parent = M('payment')->where('parentId = 0')->select();
        $this->isNew = 1;
        $this->display();
    }

    /**
     * 付款保存
     * @author xuli
     * 2015-1-15
     */
    public function addInsert() {

        $data = I('post.');
        $data['payment_date'] = strtotime(I('payment_date'));
        $data['supplierId'] = $data['sid']+0;
        unset($data['isNew']);
        unset($data['isCollection']);

        $creator = $_SESSION['real_name'];
        $ctime   = time();
        $user_id = $_SESSION['uid'];

        //自动验证
        $payment = D('Payment');
        if (!$payment->create($data)){
            $this->error($payment->getError());
        }
        if(I('id')){
            $data['id']=I('id');
            $res = M('payment_money')->save($data);
        }else{
            $data['creator'] = $creator;
            $data['ctime']   = $ctime;
            $data['user_id'] = $user_id;
            $data['payment_number'] = $this->_getNewCode('FK','payment_money','payment_number');
            $res = M('payment_money')->add($data);
        }
        if($res !== false){
            $this->success('保存成功',U('Finance/Payment/index'));
        }else{
            $this->error('保存失败');
        }
    }


    /**
     * 付款删除
     * @author xuli
     * 2015-1-15
     */
    public function delect() {
        $map['id'] = I('id');
        $res = M('payment_money')->where($map)->delete();
        if($res){
            $this->success('删除成功',U('Finance/Payment/index'));
        }else{
            $this->error('删除失败');
        }
    }

    /**
     * 得到项目子节点
     * @author xuli
     * 2015-1-15
     */
    public function getSonId() {
        $map['parentId'] = I('parentId')>0?I('parentId'):-1;
        $res = M('payment')->where($map)->select();
        foreach($res as &$v){
            $map2['son'] = $v['id'];
            //判断后期是否使用该数据
            $count = M('payment_money')->where($map2)->count();
            $v['exist'] = $count > 0 ? 1:0;
        }
        if($res){
            $res[0]['kind'] = 2;
            $this->ajaxReturn($res,'json');
        } else {
            $res['parentId'] = $map['parentId'];
            $res['kind'] = 2;
            $res['id'] = 0;
            $this->ajaxReturn($res,'json');
        }
    }
    public function delAll(){
        $pwd = md5($_POST['password']);
        if($_SESSION['password']!=$pwd){
            $this->error('密码错误，请重新输入！',U('Finance/Payment/index'));
        }
        $row=M('payment_money')->select();
        foreach($row as & $v){
            $temp=array();
            $temp=$v;
            $temp['oldId']=intval($v['id']);
            unset($temp['id']);
            $res=M('payment_backups')->add($temp);
            $map['id']=$v['id'];
            M('payment_money')->where($map)->delete();
        }
        $this->success('清除数据成功',U('Finance/Payment/index'));
    }
}

?>