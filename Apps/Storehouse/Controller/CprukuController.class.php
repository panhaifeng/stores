<?php
namespace Storehouse\Controller;
use Common\Controller\CommonController;
class CprukuController extends CommonController {

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

        $count = M('cpruku_product r')
                 ->join('ykb_cp_ruku a ON a.id = r.rukuId')
                ->where($map)->count();
        $Page = new \Think\Page($count,100,I('param.'));
        $this->page = $Page->show();
        $row = M('cpruku_product r')
              ->join('ykb_cp_ruku a ON a.id = r.rukuId')
              ->join('left join ykb_chengpin_product p ON p.id= r.productId')
              ->where($map)
              ->field('a.*,p.code,p.name,p.color,p.kind as proKind,r.cnt')
              ->order('id asc')
              ->limit($Page->firstRow.','.$Page->listRows)
              ->select();
        foreach($map as $key=>$val) {
            $Page->parameter[$key] = urlencode($val);
        }

        if(count($row)>0)foreach($row as &$v){
            $v['ruku_date'] = date('Y-m-d',$v['ruku_date']);
            $v['kind'] = $v['kind']==1? "外购入库":"自产入库";
            $v['cnt']  = round($v['cnt'], 0);
        }
//        dump($row);exit;
        $this->Ruku = $row;
        $this->display();
    }

    /**
     * 入库新增
     * @author xuli
     * 2015-1-13
     */
    public function add() {
        $this->_addCurrentUserInfo();
        $this->date = date('Y-m-d',time());
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
        $ruku = D('Cpruku');

        if (!$ruku->create($data)){
            $this->error($ruku->getError());
        }

        // 操作人信息
        $creator = $_SESSION['real_name'];
        $user_id = $_SESSION['uid'];
        $time = time();

        // 构建入库产品明细
        $products = array();
        //应该可优化
        foreach($data['productId'] as $key => $v){
            // 若产品ID为空，则本行数据无效
            if(empty($v)){
                continue;
            }
            $product = array(
                'productId'	=> $data['productId'][$key],
                'cnt'	=> $data['cnt'][$key],
            );
            // 需要更新的数据（存在子表ID）
            if($data['sonId'][$key]!=""){
                $product['id'] = $data['sonId'][$key];

            }else{
                $product['creator'] = $creator;
                $product['user_id'] = $user_id;
                $product['ctime']   = $time;
            }
            $products[] = $product;
        }
        $data['ruku_product'] = $products;

        if(I('id')){
            // kind == 0 自购入库
            if($data['kind']==0){
                // 清空原有数据
                $mapCprkProduct = array(
                    'rukuId' => I('id')
                );
                $rowset = M('cpruku_product')
                          ->where($mapCprkProduct)
                          ->field('id,productId,cnt')
                          ->select();

                foreach($rowset as &$v4){
                    $map3['cpid'] = $v4['id'];
                    if($map3['cpid']>0){
                        D('Ykucun')->where($map3)->delete();
                        M('chuku_product')->where($map3)->delete();
                    }
                }
            }
            // 重新保存现有数据
            $res = $ruku->relation(true)->save($data);
            $kucun = D('Kucun');
            $row = $kucun->_after_edit($data,'cpruku_product','isruku');//ruku_product:外键

            if($data['kind']==0){
                $map['rukuId'] = I('id');
                $rowset = M('cpruku_product')->where($map)->field('id,productId,cnt')->select();
                foreach($rowset as &$v2){
                    $map2['pid'] = $v2['productId'];
                    $map2['isbox'] = 0;
                    $r = M('chengpin_form')->where($map2)->field('productId,cnt')->select();
                    foreach($r as &$v3){
                        $mapPro['id'] = $v3['productId'];
                        $proList = M('base_product')->where($mapPro)->field('supplierId,danjia')->find(); // 查询数据

                        $new['cnt'] = $v3['cnt']*$v2['cnt'];
                        $new['cpid'] = $v2['id'];
                        $new['sid'] = $proList['supplierId']+0;
                        $new['price'] = $proList['danjia']+0;
                        $new['money'] = $proList['danjia']*$v3['cnt']*$v2['cnt'];
                        $new['productId'] = $v3['productId'];
                        $newid = M('chuku_product')->add($new);

                        $kucun2['dateFasheng'] = $data['ruku_date'];
                        $kucun2['cpid'] = $v2['id'];
                        $kucun2['chuku2proId'] = $newid;
                        $kucun2['cntFasheng'] = $new['cnt']*-1;
                        $kucun2['priceFasheng'] = $proList['danjia'];
                        $kucun2['moneyFasheng'] = $proList['danjia']*$new['cnt']*-1;
                        $kucun2['proId'] = $new['productId'];
                        $kucun2['sid'] = $proList['supplierId']+0;
                        $kucun2['kind'] = "原料出库";
                        D('Ykucun')->add($kucun2);
                    }
                }
            }
        }else{
            $data['creator'] = $creator;
            $data['user_id'] = $user_id;
            $data['ctime']   = $time;

            $data['ruku_code'] = $this->_getNewCode('CPRK','cp_ruku','ruku_code');
            $res = $ruku->relation(true)->add($data);
            $kucun = D('Kucun');
            $row = $kucun->_after_save($res,'rukuId','cp_ruku','cpruku_product','isruku');
            if($data['kind']==0){
                $map['rukuId'] = $res;
                $rowset = M('cpruku_product')->where($map)->field('id,productId,cnt')->select();
                foreach($rowset as &$v2){
                    $map2['pid'] = $v2['productId'];
                    $map2['isbox'] = 0;
                    $r = M('chengpin_form')->where($map2)->field('productId,cnt')->select();
                    foreach($r as &$v3){
                        $mapPro['id'] = $v3['productId'];
                        $proList = M('base_product')->where($mapPro)->field('supplierId,danjia')->find(); // 查询数据

                        $new['cnt'] = $v3['cnt']*$v2['cnt'];
                        $new['cpid'] = $v2['id'];
                        $new['sid'] = $proList['supplierId']+0;
                        $new['price'] = $proList['danjia']+0;
                        $new['money'] = $proList['danjia']*$v3['cnt']*$v2['cnt'];
                        $new['productId'] = $v3['productId'];
                        $newid = M('chuku_product')->add($new);

                        $kucun2['dateFasheng'] = $data['ruku_date'];
                        $kucun2['cpid'] = $v2['id'];
                        $kucun2['chuku2proId'] = $newid;
                        $kucun2['cntFasheng'] = $new['cnt']*-1;
                        $kucun2['priceFasheng'] = $proList['danjia']+0;
                        $kucun2['moneyFasheng'] = $proList['danjia']*$new['cnt']*-1;
                        $kucun2['sid'] = $proList['supplierId']+0;
                        $kucun2['proId'] = $new['productId'];
                        $kucun2['kind'] = "原料出库";
                        D('Ykucun')->add($kucun2);
                    }
                }
            }
        }

        if($row !== false){
            $this->success('添加成功',U('Storehouse/Cpruku/index'));
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
        $main = M('cp_ruku')->where($map)->select();
        $product = M('cpruku_product p')->join('ykb_chengpin_product b ON b.id = p.productId')->where($map2)
                              ->field('p.cnt,p.price,p.money,p.productId,p.id as rukuProId,b.name,b.code,color')->select();
        foreach($main as &$v){
            $v['date'] = date('Y-m-d',$v['ruku_date']);
        }
        $this->_addCurrentUserInfo();
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
        $map1['rukuId'] = $map['id'] = I('get.id');
        $rowset = M('cpruku_product')->where($map1)->field('id,productId,cnt')->select();
        foreach($rowset as &$v2){
            $map2['cpid'] = $v2['id'];
            M('chuku_product')->where($map2)->delete();
            M('Kucun')->where($map2)->delete();
        }
        $res = D('Cpruku')->relation(true)->where($map)->delete();
        $kucun = D('Kucun');
        $row = $kucun->_after_del(I('get.id'),'rukuId');
        if($row!==false){
            $this->success('删除成功',U('Storehouse/Cpruku/index'));
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
        $count = M('supplier')->count(); // 计算记录数
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
        $count = M('chengpin_product')->count(); //计算记录数
        $limitRows = 20; // 设置每页记录数
        $p = new \Common\Util\Ajaxpage($count, $limitRows,"product"); //第三个参数是你需要调用换页的ajax函数名
        $limit_value = $p->firstRow . "," . $p->listRows;
        $data['list'] = M('chengpin_product')->order('id desc')->limit($limit_value)->select(); // 查询数据
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

        // 检索条件
        $map['name'] = array('like',"%".$form['name']."%");
        $map['code'] = array('like',"%".$form['name']."%");
        $map['kind'] = array('like',"%".$form['name']."%");
        $map['color'] = array('like',"%".$form['name']."%");
        $map['_logic'] = 'OR';

        $limitRows = 20; // 设置每页记录数

        // 总数
        $count = M('chengpin_product')->where($map)->count(); //计算记录数

        // 分页
        $p = new \Common\Util\Ajaxpage($count, $limitRows,"product"); //第三个参数是你需要调用换页的ajax函数名

        // 查询结果
        $rows = M('chengpin_product')->where($map)->limit($p->firstRow . "," . $p->listRows)->select(); // 查询数据

        // 产生分页信息，AJAX的连接在此处生成
        $pageHtml = $p->show();

        $data = $form;
        $data['list'] = $rows?$rows:array();
        $data['page'] = $pageHtml;
        $this->ajaxReturn($data);
    }

    /**
     * ajax查询入库明细
     * @author xuli
     * 2015-1-28
     */
    public function getProduct() {
        $map['rukuId'] = I('rukuId')>0?I('rukuId'):-1;
        $res = M('cpruku_product r')->join('ykb_chengpin_product p ON p.id = r.productId')->field('p.name,p.code,p.color,r.cnt,r.price,r.money')->where($map)->select();
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
        $map2['cpid'] = $map['id'] = I('post.id');
        M('kucun')->where($map2)->delete();
        M('chuku_product')->where($map2)->delete();
        $res = M('cpruku_product')->where($map)->delete();
        $this->ajaxReturn($res);
    }
}
?>