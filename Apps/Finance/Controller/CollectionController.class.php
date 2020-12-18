<?php
namespace Finance\Controller;
use Common\Controller\CommonController;
class CollectionController extends CommonController {

    /**
     * 收款查询
     * @author xuli
     * 2015-1-15
     */
    public function index() {
        $conditions = I('param.');
        if($conditions['company'] != NUll){
            $map['clientName']  = array('like','%'.trim($conditions['company']).'%');
            $arr['company']=$this->company = $conditions['company'];
        }
        if($conditions['start_time'] != NULL && $conditions['end_time'] != NULL){
            $time[0] = strtotime($conditions['start_time']);
            $time[1] = strtotime($conditions['end_time']);
            $map['collection_date'] = array('between',array($time[0],$time[1]));
            $arr['start_time']=$this->start_time = $conditions['start_time'];
            $arr['end_time']=$this->end_time = $conditions['end_time'];
        }else{
            //TODO:需优化！太难看了，虽然功能OK了
            if($conditions['time_kind'] !=NULL){

            }else{
                $time[0] = strtotime(date('Y-m-1'));
                $time[1] = strtotime(date("Y-m-d"));
                $map['collection_date'] = array('between',array($time[0],$time[1]));
                $arr['start_time']=$this->start_time = date('Y-m-1');
                $arr['end_time']=$this->end_time = date("Y-m-d");
            }
        }
        if($conditions['time_kind'] !=NULL){
            $arr['time_kind']=$this->time_kind = $conditions['time_kind'];
        }else{
            $arr['time_kind']=$this->time_kind = 1;
        }
        if($conditions['collection_type'] != NUll){
            $map['item']  = $conditions['collection_type'];
            $arr['collection_type']=$this->pkind = $conditions['collection_type'];
            $map2['parentId'] = $conditions['collection_type'];
            $this->collection2 = M('collection')->where($map2)->select();
        }
        if($conditions['collection_type2'] != NUll){
            $map['son']  = $conditions['collection_type2'];
            $arr['collection_type2']=$this->pkind2 = $conditions['collection_type2'];
            $map2['parentId'] = $conditions['collection_type'];
            $this->collection2 = M('collection')->where($map2)->select();
        }
        if($conditions['memo'] != NUll){
            $map['memo'] = array('like','%'.trim($conditions['memo']).'%');
            $arr['memo']=$this->memo = $conditions['memo'];
        }
        $this->arr=$arr;
        if($conditions['export']==1){
            $row = M('collection_money')->where($map)->order('collection_date desc')->select();
            $rowset=array();
            if(count($row)>0)foreach($row as &$v){
                $rowset[]=array(
                    'collection_number'=>$v['collection_number'],
                    'collection_date'=>date('Y-m-d',$v['collection_date']),
                    'clientName'=>$v['clientName'],
                    'bankname'=>$this->getBankname($v['bankid']),
                    'son_name'=> $this->getSon($v['item'])."->".$this->getSon($v['son']),
                    'collection_money'=>$v['collection_money'],
                    'kaipiao_money'=>$v['kaipiao_money'],
                    'memo'=>$v['memo'],
                    );
                $money += $v['collection_money'];
            }
            $rowset[] = array(
                'collection_number' => "合计",
                'collection_date'=>'',
                'clientName'=>'',
                'bankname'=>'',
                'son_name'=>'',
                'collection_money'=>$money,
                'kaipiao_money'=>'',
                'memo'=>'',
            );
            $filename=date('Y-m-d',time()).'  收款数据';
            $this->exportexcel($rowset,array('收款单号','收款时间','客户名称','银行账户','项目类型','收款金额','开票金额','备注'),$filename);
            exit;
        }
        $count = M('collection_money')->where($map)->count();
        $Page = new \Think\Page($count,100,I('param.'));
        $this->page = $Page->show();

        $row = M('collection_money')->where($map)->order('collection_date desc')
        ->limit($Page->firstRow.','.$Page->listRows)->select();
        foreach($map as $key=>$val) {
            $Page->parameter[$key] = urlencode($val);
        }
        $type = C('collection_type');

        if(count($row)>0)foreach($row as &$v){
            $v['bankname'] = $this->getBankname($v['bankid']);
            $v['collection_code'] = $this->getMemorandumcode($v['mid']);
            $v['isKai'] = $this->getShuilv($v['mid']);
            $v['son_name'] = $this->getSon($v['item'])."->".$this->getSon($v['son']);
            $v['collection_type'] = $type[$v['collection_type']];
            $v['collection_date'] = date('Y-m-d',$v['collection_date']);
            $money += $v['collection_money'];
        }
        $row[] = array(
            'collection_number' => "合计",
            'collection_money'  => $money,
            'edit'              => 1,
        );
        $this->money = $row;
        $where['parentId'] = 0;
        $this->collection = M('collection')->where($where)->select();
        $this->display();
    }

    /**
     * 收款登记
     * @author xuli
     * @param isNew
     * 判断是否为新增
     * @param isCollection
     * 判断是否为收款
     * 2015-1-15
     */
    public function add() {
        $this->_addCurrentUserInfo();
        $this->bank = M('Bank')->select();
        $this->collection_parent = M('collection')->where('parentId = 0')->select();
        $this->isNew = 1;
        $this->isCollection = 1;
        $this->display();
    }

    /**
     * 收款修改
     * @author xuli
     * 2015-1-15
     */
    public function edit() {
        $map['id'] = I('id');
        $this->_addCurrentUserInfo();
        $this->Collection = M('collection_money')->where($map)->find();
        $this->noCollection = $this->Collection['mid'] > 0? 2 : 1;
        $this->Collection_date = date('Y-m-d',$this->Collection['collection_date']);
        $this->orderCode = $this->getMemorandumcode($this->Collection['mid']);
        $this->bank = M('bank')->where('id',I('bankid'))->select();
        $this->collection_parent = M('collection')->where('parentId = 0')->select();
        $map2['parentId'] = $this->Collection['item'];
        $this->collection_son = M('collection')->where($map2)->select();
        $this->isCollection = 1;
        $this->display('add');
    }

    /**
     * 收款保存
     * @author xuli
     * 2015-1-15
     */
    public function addInsert() {
        $money = array();
        $money = I('post.');
        $money['collection_date'] = strtotime(I('collection_date'));
        unset($money['isNew']);
        unset($money['isCollection']);

        $creator = $_SESSION['real_name'];
        $ctime    = time();
        $user_id = $_SESSION['uid'];

        //自动验证
        $collection = D('Gathering');
        if (!$collection->create($money)){
            $this->error($collection->getError());
        }
        if(I('id')){
            $money['id']=I('id');
            $res = $collection->save($money);
        }else{
            $money['creator'] = $creator;
            $money['ctime']   = $ctime;
            $money['user_id'] = $user_id;
            $money['collection_number'] = $this->_getNewCode('SK','collection_money','collection_number');
            //收款保存
            $res = $collection->add($money);
        }
        if($res !== false){
            $this->success('保存成功',U('Finance/Collection/index'));
        }else{
            $this->error('保存失败');
        }
    }

    /**
     * 收款删除
     * @author xuli
     * 2015-1-15
     */
    public function delect() {
        $map['id'] = I('id');
        $map2['id'] = I('mid');
        //删除应收款
        $fasheng = M('memorandum')->where($map2)->field('moneyfasheng,money')->find();
        $memorandum['moneyfasheng'] = $fasheng['moneyfasheng'] - I('collection_money');
        $memorandum['isOver'] = $memorandum['moneyfasheng']>=$fasheng['money']? 1:0;
        $id = M('memorandum')->where($map2)->save($memorandum);
        //删除
        $res = M('collection_money')->where($map)->delete();
        if($res){
            $this->success('删除成功',U('Finance/Collection/index'));
        }else{
            $this->error('删除失败');
        }
    }

    /**
     * 合同Ajax分页
     * @author xuli
     * 2015-01-15
     *
     */
    public function memorandumAjax(){
        $map['isOver'] = 0;
        $map['isPost'] = 1;
        $count = M('Memorandum')->where($map)->count(); //计算记录数
        $limitRows = 2; // 设置每页记录数
        $p = new \Common\Util\Ajaxpage($count, $limitRows,"memorandum"); //第三个参数是你需要调用换页的ajax函数名
        $limit_value = $p->firstRow . "," . $p->listRows;
        $data['list'] = M('Memorandum m')->join('LEFT JOIN ykb_client c ON m.cid=c.id')->join('LEFT JOIN ykb_collection_money o ON o.mid=m.id')->where($map)->field('m.*,c.company,sum(o.collection_money) as collection_money')->limit($limit_value)->group('m.id')->order('id desc')->select(); // 查询数据
        $page = $p->show(); // 产生分页信息，AJAX的连接在此处生成
        $data['page']=$page;
        $this->ajaxReturn($data);
    }

    /**
     * 得到项目子节点
     * @author xuli
     * 2015-1-15
     */
    public function getSonId() {
        $map['parentId'] = I('parentId')>0?I('parentId'):-1;
        $res = M('collection')->where($map)->select();
        foreach($res as &$v){
            $map2['son'] = $v['id'];
            //判断后期是否使用该数据
            $count = M('collection_money')->where($map2)->count();
            $v['exist'] = $count > 0 ? 1:0;
        }
        /* if(I('isCollection')){
            $res = M('collection')->where($map)->field('id,collection_name')->select();
        }else{
            $res = M('payment')->where($map)->field('id,payment_name as collection_name')->select();
        } */
        if($res){
            $res[0]['kind'] = 1;
            $this->ajaxReturn($res,'json');
        } else {
            $res['parentId'] = $map['parentId'];
            $res['kind'] = 1;
            $res['id'] = 0;
            $this->ajaxReturn($res,'json');
        }
    }

    /**
     * 开票
     * @author xuli
     * 2015-1-26
     */
    public function kaipiao() {
        $map['id'] = I('id');
        $res = M('collection_money')->where($map)->save(I('post.'));
        if($res!==false){
            $this->success('开票成功',U('Finance/Collection/index'));
        }else{
            $this->error('开票失败');
        }
    }
    public function delAll(){
        $pwd = md5($_POST['password']);
        if($_SESSION['password']!=$pwd){
            $this->error('密码错误，请重新输入！',U('Finance/Collection/index'));
        }
        $row=M('collection_money')->select();
        foreach($row as & $v){
            $temp=array();
            $temp=$v;
            $temp['oldId']=intval($v['id']);
            unset($temp['id']);
            $res=M('collection_backups')->add($temp);
            $map['id']=$v['id'];
            M('collection_money')->where($map)->delete();
        }
        $this->success('清除数据成功',U('Finance/Collection/index'));
    }
}

?>