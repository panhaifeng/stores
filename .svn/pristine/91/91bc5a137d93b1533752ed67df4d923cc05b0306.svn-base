<?php
namespace Storehouse\Controller;
use Common\Controller\CommonController;
class CpchukuController extends CommonController {

    /**
     * 出库查询
     * @author xuli
     * 2015-1-27
     */
    public function index(){
        $conditions = I('param.');
        if($conditions['client'] != NUll){
            $map['client_name'] = array('like','%'.trim($conditions['client']).'%');
            $this->client = $conditions['client'];
        }

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
            $map['chuku_date'] = array('between',array($time[0],$time[1]));
            $this->start_time = $conditions['start_time'];
            $this->end_time = $conditions['end_time'];
        }else{
            if($conditions['time_kind'] !=NULL){
            }else{
                $time[0] = strtotime(date('Y-m-1'));
                $time[1] = strtotime(date("Y-m-d"));
                $map['chuku_date'] = array('between',array($time[0],$time[1]));
                $this->start_time = date('Y-m-1');
                $this->end_time = date("Y-m-d");
            }
        }

        $count = M('cpchuku_product c')
                 ->join('ykb_cp_chuku a ON a.id = c.chukuId')
                 ->where($map)->count();
        $Page = new \Think\Page($count,100,I('param.'));
        $this->page = $Page->show();
        $row = M('cpchuku_product c')
                ->join('ykb_cp_chuku a ON a.id = c.chukuId')
                ->join('LEFT JOIN ykb_chengpin_product p ON p.id= c.productId')
                ->where($map)
                ->field('a.*,p.code,p.name,p.color,p.kind as proKind,c.cnt')
                ->order('id asc')
                ->limit($Page->firstRow.','.$Page->listRows)
                ->select();

        foreach($map as $key=>$val) {
            $Page->parameter[$key] = urlencode($val);
        }

        if(count($row)>0)foreach($row as &$v){
            $v['chuku_date'] = date('Y-m-d',$v['chuku_date']);
            $v['cnt']  = round($v['cnt'], 0);
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
        $this->date = date('Y-m-d',time());
        $map['f.isbox'] = 1;
        $this->product_box = M('chengpin_form f')->join('ykb_base_product p ON p.id = f.productId')->where($map)->field('p.id,p.name')->select();
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
        $chuku = D('Cpchuku');
        if (!$chuku->create($data)){
            $this->error($chuku->getError());
        }

        $creator = $_SESSION['real_name'];
        $user_id = $_SESSION['uid'];
        $time    = time();

        // 构建成品出库-产品明细表数据
        $products = array();
        //应该可优化
        foreach($data['productId'] as $key => $v){
            if(empty($v)){
                continue;
            }
            $product = array(
                'productId' => $data['productId'][$key],
                'cnt'       => $data['cnt'][$key],
            );
            if($data['sonId'][$key]!=""){
                $product['id'] = $data['sonId'][$key];
            }else{
                $product['creator'] = $creator;
                $product['ctime'] = $time;
                $product['user_id'] = $user_id;
            }
            $products[] = $product;
        }
        $data['cpchuku_product'] = $products;
        unset($data['chubox']);unset($data['box']);unset($data['boxcnt']);


        if(I('id')){
            $map1['chukuId'] = I('id');
            $rowset = M('cpchuku_product')->where($map1)->field('id,productId,cnt')->select();
            foreach($rowset as &$v4){
                $map3['cpchuid'] = $v4['id'];
                if($map3['cpchuid']>0){
                    M('kucun')->where($map3)->delete();
                    M('chuku_product')->where($map3)->delete();
                }
            }
            $res = $chuku->relation(true)->save($data);
            $kucun = D('Kucun');
            $row = $kucun->_after_edit($data,'cpchuku_product','ischuku');//cpchuku_product:从表
            $map['chukuId'] = I('id');
            $rowset = M('cpchuku_product')->where($map)->field('id,cnt,boxid,boxcnt')->select();
            foreach($rowset as &$v2){
                $new['cnt'] = $v2['cnt']*$v2['boxcnt'];
                $new['cpchuid'] = $v2['id'];
                $new['productId'] = $v2['boxid'];
                $newid = M('chuku_product')->add($new);
                $kucun2['dateFasheng'] = $data['chuku_date'];
                $kucun2['cpchuid'] = $v2['id'];
                $kucun2['chuku2proId'] = $newid;
                $kucun2['cntFasheng'] = $new['cnt']*-1;
                $kucun2['proId'] = $new['productId'];
                $kucun2['kind'] = "出库";
                M('kucun')->add($kucun2);
            }
        }else{
            $data['creator'] = $creator;
            $data['ctime']   = $time;
            $data['user_id'] = $user_id;

            $data['chuku_code'] = $this->_getNewCode('CK','cp_chuku','chuku_code');
            $res = $chuku->relation(true)->add($data);
            $kucun = D('Kucun');
            $row = $kucun->_after_save($res,'chukuId','cp_chuku','cpchuku_product','ischuku');
            $map['chukuId'] = $res;
            $rowset = M('cpchuku_product')->where($map)->field('id,cnt,boxid,boxcnt')->select();
            foreach($rowset as &$v2){
                $new['cnt'] = $v2['cnt']*$v2['boxcnt'];
                $new['cpchuid'] = $v2['id'];
                $new['productId'] = $v2['boxid'];
                $newid = M('chuku_product')->add($new);
                $kucun2['dateFasheng'] = $data['chuku_date'];
                $kucun2['cpchuid'] = $v2['id'];
                $kucun2['chuku2proId'] = $newid;
                $kucun2['cntFasheng'] = $new['cnt']*-1;
                $kucun2['proId'] = $new['productId'];
                $kucun2['kind'] = "出库";
                M('kucun')->add($kucun2);
            }
        }
        if($res !== false){
            $this->success('添加成功',U('Storehouse/Cpchuku/index'));
        }else{
            $this->error('添加失败');
        }
    }


    public function  listAdd(){

        // 获得将要批量出库的成品
        $proIdArr = I('proId');
        $proNumArr = I('proNum');

        $products = array();
        foreach ($proIdArr as $key => $proId){
            if(empty($proId)){
                continue;
            }
            $productObject = M('chengpin_product')->find($proId);

            if(empty($productObject)){
                continue;
            }
            $product = array(
                'productId' => $productObject['id'],
                'code'      => $productObject['code'],
                'name'      => $productObject['name'],
                'color'      => $productObject['color'],
                'cnt'      => isset($proNumArr[$key])?$proNumArr[$key]:0,
                'boxId'    => '',
                'box_cnt'  => '',
            );
            $products[] = $product;
        }

        $this->Chuku = $products;
        $this->Main = array(
            'id' => '',
            'date' => date('Y-m-d',time()),
            'chuku_code' => '',
            'memo'    => '',
        );
        $this->_addCurrentUserInfo();
        $this->date = date('Y-m-d',time());
        $map['f.isbox'] = 1;
        $this->product_box = M('chengpin_form f')->join('ykb_base_product p ON p.id = f.productId')->where($map)->field('p.id,p.name')->select();
        $this->display('edit');
    }


    /**
     * 出库修改
     * @author xuli
     * 2015-1-13
     */
    public function edit(){
        $map2['p.chukuId'] = $map['id'] = I('id');
        //先查出主体部分内容
        $main = M('cp_chuku')->where($map)->select();
        $product = M('cpchuku_product p')->join('ykb_chengpin_product b ON b.id = p.productId')->where($map2)
                              ->field('p.boxid,p.boxcnt,p.cnt,p.price,p.money,p.productId,p.id as chukuProId,b.name,b.code,b.color')->select();
        foreach($main as &$v){
            $v['date'] = date('Y-m-d',$v['chuku_date']);
        }
        $this->_addCurrentUserInfo();
        $this->Main = $main[0];
        $this->Chuku = $product;
        $map3['f.isbox'] = 1;
        $this->product_box = M('chengpin_form f')->join('ykb_base_product p ON p.id = f.productId')->where($map3)->field('p.id,p.name')->select();
        $this->display();
    }
    /**
     * 出库删除
     * @author xuli
     * 2015-1-13
     */
    public function delect(){
        $map1['chukuId'] = $map['id'] = I('get.id');
        $rowset = M('cpchuku_product')->where($map1)->field('id,productId,cnt')->select();
        foreach($rowset as &$v2){
            $map2['cpchuid'] = $v2['id'];
            M('chuku_product')->where($map2)->delete();
            M('kucun')->where($map2)->delete();
        }
        $res = D('Cpchuku')->relation(true)->where($map)->delete();
        $kucun = D('Kucun');
        $row = $kucun->_after_del(I('get.id'),'chukuId');
        if($row!==false){
            $this->success('删除成功',U('Storehouse/Cpchuku/index'));
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
    public function productAjax(){
        $count = M('chengpin_product')->count(); //计算记录数
        $limitRows = 20; // 设置每页记录数
        $p = new \Common\Util\Ajaxpage($count, $limitRows,"product"); //第三个参数是你需要调用换页的ajax函数名
        $limit_value = $p->firstRow . "," . $p->listRows;
        $map['f.isbox'] = 1;
        $data['list'] = M('chengpin_product c')->join('ykb_chengpin_form f ON f.pid = c.id')->field('c.*,f.productId as pid,f.cnt')->where($map)->order('id desc')->limit($limit_value)->select(); // 查询数据
        $page = $p->show(); // 产生分页信息，AJAX的连接在此处生成
        $data['page']=$page;
        $this->ajaxReturn($data);
    }

    /**
     * ajax删除从表子类
     * @author xuli
     * 2015-2-14
     */
    public function deletesonid() {
        $id = I('post.id');
        $map2['cpchuid'] = $map['id'] = $id;

        M('kucun')->where($map2)->delete();

        M('chuku_product')->where($map2)->delete();

        $res = M('cpchuku_product')->where($map)->delete();

        $this->ajaxReturn($res);
    }

    /**
     * ajax查询出库明细
     * @author xuli
     * 2015-1-28
     */
    public function getProduct() {
        $map['chukuId'] = I('chukuId')>0?I('chukuId'):-1;
        $res = M('cpchuku_product r')->join('ykb_chengpin_product p ON p.id = r.productId')->field('p.name,p.code,p.norms,r.cnt,r.price,r.money')->where($map)->select();
        if($res){
            $this->ajaxReturn($res,'json');
        }
    }
}
?>