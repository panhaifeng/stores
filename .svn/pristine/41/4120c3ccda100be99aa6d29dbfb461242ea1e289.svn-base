<?php
namespace Storehouse\Controller;
use Common\Controller\CommonController;
class RukuController extends CommonController {

    /**
     * 入库查询
     * @author xuli
     * 2015-1-27
     */
    public function index(){
        $conditions = I('param.');
//        if($conditions['supplier'] != NUll){
//            $map['a.supplier_name'] = array('like','%'.trim($conditions['supplier']).'%');
//            $this->supplier = $conditions['supplier'];
//        }

        // 关键词检索
        if($conditions['key'] != NULL){
            $map[] = " (p.code like '%{$conditions['key']}%' 
                     OR  p.kind like '%{$conditions['key']}%'
                     OR  p.norms like '%{$conditions['key']}%'
                     OR  p.name like '%{$conditions['key']}%'
                     ) ";
            $this->key = $conditions['key'];
        }

        // 时间范围检索
        if($conditions['start_time'] != NULL && $conditions['end_time'] != NULL){
            $time[0] = strtotime($conditions['start_time']);
            $time[1] = strtotime($conditions['end_time']);
            $map['ruku_date'] = array('between',array($time[0],$time[1]));
            $this->start_time = $conditions['start_time'];
            $this->end_time = $conditions['end_time'];
        }else{
            if($conditions['time_kind'] !=NULL){
            }else{
                $time[0] = strtotime(date('Y-m-1'));
                $time[1] = strtotime(date("Y-m-d"));
                $map['ruku_date'] = array('between',array($time[0],$time[1]));
                $this->start_time = date('Y-m-1');
                $this->end_time = date("Y-m-d");
            }
        }

        $count = M('ruku_product r')
                    ->join('ykb_ruku a ON a.id = r.rukuId')
                    ->join('ykb_base_product p ON p.id= r.productId')
                    ->where($map)->count();
        $Page = new \Think\Page($count,100,I('param.'));
        $this->page = $Page->show();
        $row = M('ruku_product r')
            ->join('ykb_ruku a ON a.id = r.rukuId')
            ->join('ykb_base_product p ON p.id= r.productId')
            ->where($map)
            ->field('a.*,p.code,p.name,p.norms,p.kind,r.cnt')->order('id asc')
        ->limit($Page->firstRow.','.$Page->listRows)->select();
        foreach($map as $key=>$val) {
            $Page->parameter[$key] = urlencode($val);
        }
        if(count($row)>0)foreach($row as &$v){
            $v['ruku_date'] = date('Y-m-d',$v['ruku_date']);
            $v['cnt'] = round($v['cnt'], 0);
        }
        $this->Ruku = $row;
        $this->display();
    }

    /**
     * 入库新增
     * @author xuli
     * 2015-1-13
     */
    public function add() {
        $this->date = date('Y-m-d',time());
        $this->creator = $_SESSION['real_name'];
        $this->display();
    }

    /**
     * 入库保存
     * @author xuli
     * 2015-1-13
     */
    public function addInsert() {
        $data = I('post.');
        $data['ruku_date'] = strtotime($data['ruku_date']);
        $ruku = D('Ruku');

        $time = time();
        $creator = $_SESSION['real_name'];
        $uid =   $_SESSION['uid'];

        

        //应该可优化
        $products = array();
        foreach($data['productId'] as $key => $v){
            if(empty($v)){
                continue;
            }
            $product = array(
                'productId'	=> $data['productId'][$key],
                'cnt'   => $data['cnt'][$key]+0,
                'price'   => $data['price'][$key]+0,
                'money' => $data['money'][$key]+0,
                'sId'	=> $data['supplierId'][$key]+0,
            );
            if($data['sonId'][$key]!=""){
                $product['id'] = $data['sonId'][$key];
            }else{
                $product['creator'] = $creator;
                $product['ctime']   = $time;
                $product['user_id']   = $uid;
            }
            $products[] = $product;
        }
        $data['ruku_product'] = $products;
        $data['creator'] = $creator;// 操作员

        if (!$ruku->create($data)){
            $this->error($ruku->getError());
        }
        if(I('id')){
            $res = $ruku->relation(true)->save($data);
            $kucun = D('Ykucun');
            $row = $kucun->_after_edit($data,'ruku_product','isruku');//ruku_product:外键
            $this->autoRkGz(I('id'));
        }else{
            // 创建时间
            $data['ctime'] = $time;
            $data['creator'] = $creator;
            $data['user_id'] = $uid;

            $data['ruku_code'] = $this->_getNewCode('RK','ruku','ruku_code');
            $res = $ruku->relation(true)->add($data);
            $kucun = D('Ykucun');
            $row = $kucun->_after_save($res,'rukuId','ruku','ruku_product','isruku');
            $this->autoRkGz($res);
        }
        if($row !== false){
            $this->success('添加成功',U('Storehouse/Ruku/index'));
        }else{
            $this->error('添加失败');
        }
    }
    /**
     * 入库修改
     * @author xuli
     * 2015-1-13
     */
    public function edit(){
        $map2['p.rukuId'] = $map['id'] = I('id');
        //先查出主体部分内容
        $main = M('ruku')->where($map)->select();
        $product = M('ruku_product p')->join('ykb_base_product b ON b.id = p.productId')->where($map2)
                              ->field('p.cnt,p.price,p.money,p.productId,p.id as rukuProId,p.sId,b.name,b.code,norms')->select();
        foreach($main as &$v){
            $v['date'] = date('Y-m-d',$v['ruku_date']);
        }
        $this->creator = $_SESSION['real_name'];
        $this->Main = $main[0];
        $this->Ruku = $product;
        $this->display();
    }
    /**
     * 入库删除
     * @author xuli
     * 2015-1-13
     */
    public function delect(){
        $map['id'] = I('get.id');
        $map3['rukuId'] = $map['id'];
        M('yf_guozhang')->where($map3)->delete();
        $res = D('ruku')->relation(true)->where($map)->delete();
        $kucun = D('Ykucun');
        $row = $kucun->_after_del(I('get.id'),'rukuId');
        if($row!==false){
            $this->success('删除成功',U('Storehouse/Ruku/index'));
        }else{
            $this->error('删除失败');
        }
    }

    /**
     * 添加Ajax分页
     * @ author xuli
     * 2015-01-28
     *
     */
    public function supplierAjax(){
        $count = M('supplier')->count(); //计算记录数
        $limitRows = 20; // 设置每页记录数
        $p = new \Common\Util\Ajaxpage($count, $limitRows,"supplier"); //第三个参数是你需要调用换页的ajax函数名
        $limit_value = $p->firstRow . "," . $p->listRows;

        $data['list'] = M('supplier')->order('id desc')->limit($limit_value)->select(); // 查询数据
        $page = $p->show(); // 产生分页信息，AJAX的连接在此处生成
        $data['page']=$page;
        $this->ajaxReturn($data);
    }

    /**
     * 根据关键字搜索
     * @author xuli
     * 2015-1-28
     */
    public function getSupplierKey(){
        $data = I('get.');
        $map['supplier_name'] = array('like',"%".$data['supplier_name']."%");
        $count = M('supplier')->where($map)->count(); //计算记录数
        $limitRows = 10; // 设置每页记录数
        $p = new \Common\Util\Ajaxpage($count, $limitRows,"supplier"); //第三个参数是你需要调用换页的ajax函数名
        $limit_value = $p->firstRow . "," . $p->listRows;
        $data['list'] = M('supplier')->where($map)->limit($limit_value)->select(); // 查询数据
        $page = $p->show(); // 产生分页信息，AJAX的连接在此处生成
        $data['page']=$page;
        $this->ajaxReturn($data);
    }

    /**
     * 添加Ajax分页
     * @ author xuli
     * 2015-01-28
     *
     */
    public function productAjax(){
        $count = M('base_product')->count(); //计算记录数
        $limitRows = 20; // 设置每页记录数
        $p = new \Common\Util\Ajaxpage($count, $limitRows,"product"); //第三个参数是你需要调用换页的ajax函数名
        $limit_value = $p->firstRow . "," . $p->listRows;
        $data['list'] = M('base_product')->order('id desc')->limit($limit_value)->select(); // 查询数据
        $page = $p->show(); // 产生分页信息，AJAX的连接在此处生成
        $data['page']=$page;
        $this->ajaxReturn($data);
    }

    /**
     * 根据关键字搜索
     * @author xuli
     * 2015-1-28
     */
    public function getProductKey(){
        $form = I('get.');
        // 检索条件: 品牌//、型号、编码
        $map['name'] = array('like',"%".$form['name']."%");

        $limitRows = 20; // 设置每页记录数

        // 总数
        $count = M('base_product')->where($map)->count(); //计算记录数

        // 分页信息
        $p = new \Common\Util\Ajaxpage($count, $limitRows,"product"); //第三个参数是你需要调用换页的ajax函数名

        // 查询结果
        $rows = M('base_product')->where($map)->limit($p->firstRow . "," . $p->listRows)->select(); // 查询数据

        // 分页Html代码
        $pageHtml = $p->show(); // 产生分页信息，AJAX的连接在此处生成

        $data = $form;
        $data['list'] = $rows?$rows:array();
        $data['page']=  $pageHtml;
        $this->ajaxReturn($data);
    }

    /**
     * ajax查询入库明细
     * @author xuli
     * 2015-1-28
     */
    public function getProduct() {
        $map['rukuId'] = I('rukuId')>0?I('rukuId'):-1;
        $res = M('ruku_product r')->join('ykb_base_product p ON p.id = r.productId')->field('p.name,p.code,p.norms,r.cnt,r.price,r.money')->where($map)->select();
        if($res){
            $this->ajaxReturn($res,'json');
        }
    }

    /**
     * ajax删除从表子类
     * @author xuli
     * 2015-2-14
     */
    public function deletesonid() {
        $map['id'] = I('post.id');
        $map3['ruku2ProId'] = I('post.id');
        M('yf_guozhang')->where($map3)->delete();
        $res = M('ruku_product')->where($map)->delete();
        $this->ajaxReturn($res);
    }


     /**
     * 采购退回
     * @author shen
     * 2018年11月12日
     */
    public function back(){
        $map2['p.rukuId'] = $map['id'] = I('id');
        //先查出主体部分内容
        $main = M('ruku')->where($map)->select();
        $product = M('ruku_product p')->join('ykb_base_product b ON b.id = p.productId')->where($map2)
                              ->field('p.cnt,p.price,p.money,p.productId,p.id as rukuProId,p.sId,b.name,b.code,norms')->select();
        foreach($main as &$v){
            $v['date'] = date('Y-m-d',$v['ruku_date']);
        }
        $this->creator = $_SESSION['real_name'];
        $this->Main = $main[0];
        $this->Ruku = $product;
        $this->Kind = '采购退回';
        $this->display();
    }

    public function kcTz(){
        $data = I('post.');
        $row = M('kucun')
                ->field('sum(cntFasheng) as kucun')
                ->where(" proId = {$data['proId']}")
                ->find();
        if($data['cnt']-$row['kucun']>0){
            $cnt = $data['cnt'] - $row['kucun']; //入库操作
            $res = $this->goRuku($cnt,$data['proId']);
            
        }elseif($row['kucun']-$data['cnt']>0){
            $cnt = $row['kucun']- $data['cnt']; //出库操作
            $res = $this->goChuku($cnt,$data['proId']);
        }
        if(!$res){
            $this->error('添加失败');
        }else{
            $this->success('添加成功',U('Storehouse/Index/index'));
        }

    }

    function goRuku($cnt,$proId){
        $data['chuku_date'] = strtotime(date('Y-m-d'));
        $chukuMode = D('chuku');

        $time = time();
        $creator = $_SESSION['real_name'];
        $uid =   $_SESSION['uid'];

        if (!$chukuMode->create($data)){
            return false;
        }

        $row = M('base_product')
                ->field('supplierId,danjia')
                ->where(" id = {$proId}")
                ->find();

        //应该可优化
        $products = array();
        $product = array(
            'productId' => $proId,
            'cnt'   => $cnt*-1,
            'price'   => $row['danjia']+0,
            'money' => round($cnt * $row['danjia']*-1,2),
            'sId'   => $row['supplierId']+0,
        );
        $product['creator'] = $creator;
        $product['ctime']   = $time;
        $product['user_id']   = $uid;
        $products[] = $product;

        $data['chuku_product'] = $products;
        // 操作员
        $data['creator'] = $creator;
 
        // 创建时间
        $data['ctime'] = $time;
        $data['creator'] = $creator;
        $data['user_id'] = $uid;
        $data['chukuKind'] = '调库出库';
        $data['memo'] = '调库出库';

        $data['chuku_code'] = $this->_getNewCode('CK','chuku','chuku_code');
        $res = $chukuMode->relation(true)->add($data);
        $kucun = D('Ykucun');
        $row = $kucun->_after_save($res,'chukuId','chuku','chuku_product','ischuku');
        return true;

    }

    function goChuku($cnt,$proId){
        $data['chuku_date'] = strtotime(date('Y-m-d'));
        $chukuMode = D('chuku');

        $time = time();
        $creator = $_SESSION['real_name'];
        $uid =   $_SESSION['uid'];

        if (!$chukuMode->create($data)){
            return false;
        }

        $row = M('base_product')
                ->field('supplierId,danjia')
                ->where(" id = {$proId}")
                ->find();

        //应该可优化
        $products = array();
        $product = array(
            'productId' => $proId,
            'cnt'   => $cnt,
            'price'   => $row['danjia']+0,
            'money' => round($cnt * $row['danjia'],2),
            'sId'   => $row['supplierId']+0,
        );
        $product['creator'] = $creator;
        $product['ctime']   = $time;
        $product['user_id']   = $uid;
        $products[] = $product;

        $data['chuku_product'] = $products;
        // 操作员
        $data['creator'] = $creator;
 
        // 创建时间
        $data['ctime'] = $time;
        $data['creator'] = $creator;
        $data['user_id'] = $uid;
        $data['chukuKind'] = '调库出库';
        $data['memo'] = '调库出库';

        $data['chuku_code'] = $this->_getNewCode('CK','chuku','chuku_code');
        $res = $chukuMode->relation(true)->add($data);
        $kucun = D('Ykucun');
        $row = $kucun->_after_save($res,'chukuId','chuku','chuku_product','ischuku');
        return true;
    }


     /**
     * 自动入库过账
     * @author shen
     * 2018年8月7日 16:50:29
     */
    public function autoRkGz($rukuId){
         // 清空原有数据
        $mapCprkProduct = array(
            'rukuId' => $rukuId
        );
        $rowset = M('ruku_product r')
                ->join('ykb_ruku a ON a.id = r.rukuId')
                ->where($mapCprkProduct)
                ->field('r.id,r.productId,r.cnt,r.price,r.money,a.ruku_date,r.sId,a.rukuKind')
                ->select();
        foreach($rowset as &$v4){
            $gz['ruku2ProId'] = $v4['id'];
            if($gz['ruku2ProId']>0){
                M('yf_guozhang')->where($gz)->delete();
            }
        }

        $product = array();
        foreach($rowset as $k => &$val){
            $product[] = array(
                'rukuId'       => $rukuId,
                'ruku2ProId'   => $val['id'],
                'supplierId'   => $val['sId'],
                'dateFasheng'  => date('Y-m-d',$val['ruku_date']),
                'guozhangDate' => date('Y-m-d',$val['ruku_date']),
                'kind'         => $val['rukuKind'],
                'productId'    => $val['productId'],
                'cnt'          => $val['cnt']*-1,
                'danjia'       => $val['price'],
                'money'        => $val['money']*-1,
            );
        }
        $row = $product;
        $aa = M('yf_guozhang')->addAll($row);

    }
}
?>