<?php
namespace Storehouse\Controller;
use Common\Controller\CommonController;
class ChukuController extends CommonController {

    /**
     * 出库查询
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
            $map[] = "(chuku_date between '{$time[0]}' AND '{$time[1]}') or (cprk.ruku_date between '{$time[0]}' and '{$time[1]}')";

            $this->start_time = $conditions['start_time'];
            $this->end_time = $conditions['end_time'];
        }else{
            if($conditions['time_kind'] !=NULL){
            }else{
                $time[0] = strtotime(date('Y-m-1'));
                $time[1] = strtotime(date("Y-m-d"));
                $map[] = "(chuku_date between '{$time[0]}' AND '{$time[1]}') or (cprk.ruku_date between '{$time[0]}' and '{$time[1]}')";

                $this->start_time = date('Y-m-1');
                $this->end_time = date("Y-m-d");
            }
        }

        $count = M('chuku_product c')
                 ->join('left join ykb_chuku a ON a.id = c.chukuId')
                 ->join('left join ykb_cpruku_product cprkp ON cprkp.id = c.cpid')
                 ->join('left join ykb_cp_ruku cprk ON cprk.id = cprkp.rukuId')
                 ->join('ykb_base_product p ON p.id= c.productId')
                 ->where($map)
                 ->count();
        $Page = new \Think\Page($count,100,I('param.'));
        $this->page = $Page->show();
        $row = M('chuku_product c')
               ->join('LEFT JOIN ykb_chuku a ON a.id = c.chukuId')
               ->join('ykb_base_product p ON p.id= c.productId')
                ->join('left join ykb_cpruku_product cprkp ON cprkp.id = c.cpid')
                ->join('left join ykb_cp_ruku cprk ON cprk.id = cprkp.rukuId')
               ->where($map)
               ->field('a.*,p.code,p.name,p.norms,c.cnt,c.cpid,c.cpchuid,cprk.ruku_date,cprk.ruku_code')
               ->order('id asc')
               ->limit($Page->firstRow.','.$Page->listRows)
               ->select();
        foreach($map as $key=>$val) {
            $Page->parameter[$key] = urlencode($val);
        }
        if(count($row)>0)foreach($row as &$v){
            // 原料出库列表关联成品入库操作信息
            if($v['cpid']>0){
                $map2['r.id'] = $v['cpid'];
                $rowset = M('cpruku_product r')->join('ykb_cp_ruku p ON r.rukuId = p.id')->field('p.*')->where($map2)->find();
                $v['chuku_date'] = date('Y-m-d',$rowset['ruku_date']);
                $v['chuku_code'] = $rowset['ruku_code'];
                $v['creator'] = $rowset['creator'];
                $v['memo'] = "自动出库";//.(empty($v['ruku_code'])?'':"-成品入库编号:{$v['ruku_code']}");

            }elseif($v['cpchuid']>0){
                $map3['c.id'] = $v['cpchuid'];
                $rowset = M('cpchuku_product c')->join('ykb_cp_chuku p ON c.chukuId = p.id')->field('p.*')->where($map3)->find();
                $v['chuku_date'] = date('Y-m-d',$rowset['chuku_date']);
                $v['chuku_code'] = $rowset['chuku_code'];
                $v['creator'] = $rowset['creator'];
                $v['memo'] = "自动出库";
            }else{
                $v['chuku_date'] = date('Y-m-d',$v['chuku_date']);
            }
            $v['cnt'] = round($v['cnt'], 0);
        }
        $this->Chuku = $row;
        $this->display();
    }

    /**
     * 出库新增
     * @author xuli
     * 2015-1-13
     */
    public function add() {
        $this->_addCurrentUserInfo();
        $this->chukuKind = '原料出库';
        $this->date = date('Y-m-d',time());
        $this->display();
    }

    /**
     * 出库保存
     * @author xuli
     * 2015-1-13
     */
    public function addInsert() {
        $data = I('post.');
        $data['chuku_date'] = strtotime($data['chuku_date']);
        $chuku = D('Chuku');

        $creator = $_SESSION['real_name'];
        $user_id = $_SESSION['uid'];
        $time    = time();

        // 数据有效性验证
        if (!$chuku->create($data)){
            $this->error($chuku->getError());
        }

        // 构建出库子表(关联产品表信息)
        $products = array();
        foreach($data['productId'] as $key => $v){
            // 产品ID值为空，则无需要操作的数据
            if(empty($v)){
                continue;
            }

            $product = array(
                'productId' => $data['productId'][$key],
                'cnt'       => $data['cnt'][$key],
                'price'   => $data['price'][$key],
                'money' => $data['money'][$key],
                'sId'   => $data['supplierId'][$key],
            );
            // 若已存在记录(已有ID)
            if($data['sonId'][$key]){
                $product['id'] = $data['sonId'][$key];
                $product['creator'] = $creator;
                $product['user_id'] = $user_id;
                $product['ctime']   = $time;
            }
            $products[] = $product;
        }
        $data['chuku_product'] = $products;
        if(I('id')){
            $res = $chuku->relation(true)->save($data);
            $kucun = D('Ykucun');
            $row = $kucun->_after_edit($data,'chuku_product','ischuku');//chuku_product:外键
        }else{
            // 创建时间
            $data['ctime'] = $time;
            $data['creator'] = $creator;
            $data['user_id'] = $user_id;

            $data['chuku_code'] = $this->_getNewCode('CK','chuku','chuku_code');
            $res = $chuku->relation(true)->add($data);
            $kucun = D('Ykucun');
            $row = $kucun->_after_save($res,'chukuId','chuku','chuku_product','ischuku');
        }
        if($res !== false){
            $this->success('添加成功',U('Storehouse/Chuku/index'));
        }else{
            $this->error('添加失败');
        }
    }
    /**
     * 出库修改
     * @author xuli
     * 2015-1-13
     */
    public function edit(){
        $map2['p.chukuId'] = $map['id'] = I('id');
        //先查出主体部分内容
        $main = M('chuku')->where($map)->select();
        $product = M('chuku_product p')
                ->join('ykb_base_product b ON b.id = p.productId')
                ->join('ykb_chuku a ON a.id = p.chukuId')
                ->where($map2)
                ->field('p.cnt,p.price,p.money,p.productId,p.id as chukuProId,b.name,b.code,norms,a.chukuKind')->select();
        foreach($main as &$v){
            $v['date'] = date('Y-m-d',$v['chuku_date']);
        }
        $this->_addCurrentUserInfo();
        $this->Main = $main[0];
        $this->Chuku = $product;
        $this->display();
    }
    /**
     * 出库删除
     * @author xuli
     * 2015-1-13
     */
    public function delect(){
        $map['id'] = I('get.id');
        $res = D('chuku')->relation(true)->where($map)->delete();
        $kucun = D('Ykucun');
        $row = $kucun->_after_del(I('get.id'),'chukuId');
        if($row!==false){
            $this->success('删除成功',U('Storehouse/Chuku/index'));
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
        $data = I('get.');
        $map['name'] = array('like',"%".$data['name']."%");
        $count = M('base_product')->where($map)->count(); //计算记录数
        $limitRows = 10; // 设置每页记录数
        $p = new \Common\Util\Ajaxpage($count, $limitRows,"product"); //第三个参数是你需要调用换页的ajax函数名
        $limit_value = $p->firstRow . "," . $p->listRows;
        $data['list'] = M('base_product')->where($map)->limit($limit_value)->select(); // 查询数据
        $page = $p->show(); // 产生分页信息，AJAX的连接在此处生成
        $data['page']=$page;
        $this->ajaxReturn($data);
    }

    /**
     * ajax查询出库明细
     * @author xuli
     * 2015-1-28
     */
    public function getProduct() {
        $map['chukuId'] = I('chukuId')>0?I('chukuId'):-1;
        $res = M('chuku_product r')->join('ykb_base_product p ON p.id = r.productId')->field('p.name,p.code,p.norms,r.cnt,r.price,r.money')->where($map)->select();
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
        $res = M('chuku_product')->where($map)->delete();
        $this->ajaxReturn($res);
    }
}
?>