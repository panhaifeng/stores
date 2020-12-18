<?php
namespace Storehouse\Controller;
use Common\Controller\CommonController;
class TuiController extends CommonController {

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
        $this->date = date('Y-m-d',time());
        $this->creator = $_SESSION['real_name'];
        $this->Main = $main[0];
        $this->Ruku = $product;
        $this->rukuKind = '原料退回';
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

        if (!$ruku->create($data)){
            $this->error($ruku->getError());
        }

        //应该可优化
        $products = array();
        foreach($data['productId'] as $key => $v){
            if(empty($v)){
                continue;
            }
            $product = array(
                'productId' => $data['productId'][$key],
                'cnt'   => $data['cnt'][$key]*-1,
                'price'   => $data['price'][$key],
                'money' => $data['money'][$key]*-1,
                'sId'   => $data['supplierId'][$key],
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
        // 操作员
        $data['creator'] = $creator;
        if(I('id')){
            $res = $ruku->relation(true)->save($data);
            $kucun = D('Ykucun');
            $row = $kucun->_after_edit($data,'ruku_product','isruku');//ruku_product:外键
        }else{
            // 创建时间
            $data['ctime'] = $time;
            $data['creator'] = $creator;
            $data['user_id'] = $uid;

            $data['ruku_code'] = $this->_getNewCode('TK','ruku','ruku_code');
            $res = $ruku->relation(true)->add($data);
            $kucun = D('Ykucun');
            $row = $kucun->_after_save($res,'rukuId','ruku','ruku_product','isruku');
        }
        if($row !== false){
            $this->success('添加成功',U('Storehouse/Ruku/index'));
        }else{
            $this->error('添加失败');
        }
    }

    /**
     * 退库修改
     * @author shen
     * 2018年11月12日
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
}
?>