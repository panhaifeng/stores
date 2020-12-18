<?php
    namespace Baseinfo\Controller;
    use Common\Controller\CommonController;
    class ProductController extends CommonController {

    /**
     * 产品显示
     * @author xuli
     * 2015-1-27
     */
    public function index(){
        $conditions = I('param.');
        $arr=array();
        $map = array();
        if($conditions['product']){
            $map['x.name'] = array('like','%'.trim($conditions['product']).'%');
            $this->product = $conditions['product'];
            $arr['product'] = $conditions['product'];
        }

        if($conditions['kind']){
            $map['x.kind'] = array('like','%'.trim($conditions['kind']).'%');
            $this->kind = $conditions['kind'];
            $arr['kind'] = $conditions['kind'];
        }
        $product = M('base_product x');
        $count = $product->where($map)->count();
        $Page = new \Think\Page($count,25,I('param.'));
        $this->page = $Page->show();
        $row = M('base_product x')
            ->join('left join ykb_supplier y on x.supplierId=y.id')
            ->where($map)
            ->field('x.*,y.supplier_name')
            ->limit($Page->firstRow.','.$Page->listRows)
            ->order('id desc')
            ->select();

        $kindArr = $product->field('kind')->group('kind')->select();//类别
        $this->kindArr=$kindArr;
        $this->arr=$arr;

        //导出
        if($conditions['export']==1){
            $this->export($map);
        }else{
            $this->base_product = $row;
            $this->display();
        }
    }

    /**
     * 产品新增
     * @author xuli
     * 2015-1-27
     */
    public function add(){
        $supplierModel = M('supplier');
        $this->supplier = $supplierModel->select();
        $this->display();
    }

    /**
     * 保存
     * @author xuli
     * 2015-1-27
     */
    public function addInsert(){
        $data = I('post.');
        if($data['id']){
            $res = D('product')->save($data);
        }else{
            $product = D('product');
            $res = D('product')->add($data);
        }
        if($res!==false){
            $this->success('添加成功',U('Baseinfo/Product/index'));
        }else{
            $this->error('添加失败');
        }
    }

    /**
     * 修改
     * @author xuli
     * 2015-1-27
     */
    public function edit(){
        $map['id'] = I('id');
        $this->product = M('base_product')->where($map)->find();

        $supplierModel = M('supplier');
        $this->supplier = $supplierModel->select();
        $this->display('add');
    }

    /**
     * 删除
     * @author xuli
     * 2015-1-27
     */
    public function delect(){
        $map['id'] = I('id');
        $res = M('base_product')->where($map)->delete();
        if($res){
            $this->success('删除成功',U('Baseinfo/Product/index'));
        }else{
            $this->error('删除失败');
        }
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
        $filepath = $_POST;
        //$filepath = "./Upload/client.xlsx";
        $product = R('Base/Import/import',array($filepath['file']));
        $total = count($product);
        echo "(0-".$total."-读取完成，准备导入……)~";
        ob_flush();
        //处理数据
        $data = array();
        $Fields = array(
                'code' => '0',
                'name' => '1',
                'kind' => '2',
                'norms' => '3',
                // 'cnt' => '4',
                'safeCnt' => '4',
                'supplier_name' => '5',
                'danjia' => '6',
        );
        $i = 0;
        foreach($product as & $v){
            //客户信息
            $data[$i]['code'] = $v[$Fields['code']];
            $data[$i]['name'] = $v[$Fields['name']];
            $data[$i]['kind'] = $v[$Fields['kind']];
            $data[$i]['norms'] = $v[$Fields['norms']];
            // $data[$i]['cnt'] = $v[$Fields['cnt']]+0;
            $data[$i]['safeCnt'] = $v[$Fields['safeCnt']]+0;
            $data[$i]['supplier_name'] = $v[$Fields['supplier_name']];
            $data[$i]['danjia'] = $v[$Fields['danjia']];
            $i++;
        }
        echo "(0-".$total."-导入中……)~";
        ob_flush();
        //写入数据库
        $j=0;
        foreach ($data as $key=>$val){
            $j++;
            //检测是否为修改
            $con['code'] = trim($val['code']);
            $basePro = M('base_product')->where($con)->find();
            if($basePro['id']){
                $val['id'] = $basePro['id'];
            }
            
            $map['supplier_name'] = array('like','%'.trim($val['supplier_name']).'%');
            $supplier = M('supplier')->where($map)->find();
            $val['supplierId'] = $supplier['id']+0;
            //$val['ctime'] = time();
            $res = M('base_product')->save($val);
           /* //取消入库初始化库存 
            if($val[name]!==NULL && $val['cnt']>0){
                $ruku['ruku_date'] = strtotime(date("Y-m-d"));
                $ruku['memo'] = "初始化";
                $ruku['rukuKind'] = "原料入库";
                $ruku['ruku_product'] = array();
                $product2[0] = array(
                    'productId' => $res,
                    'cnt'     => $val['cnt'],
                );
                $ruku['ruku_product'] = $product2;
                $r = D('Ruku');
                $res2 = $r->relation(true)->add($ruku);
                $kucun = D('Ykucun');
                $r2= $kucun->_after_save($res2,'rukuId','ruku','ruku_product','isruku');
            }*/ 
            echo "(".$j."-".$total."-导入中……)~";
            ob_flush();
            usleep(5000);
            /* $progress['progress'] = $j;
            if($j == count($data)){
                $progress['msg'] = "导入成功！";
            }
            $this->updataProgress($progress); */
        }
        //$ret =1;
        //$this->ajaxReturn($ret);
    }

    /**
     * 产品导出
     * @author shenhao
     * 2018-12-4
     */
    function export($map){
        $row = M('base_product x')
            ->join('left join ykb_supplier y on x.supplierId=y.id')
            ->where($map)
            ->field('x.*,y.supplier_name')
            ->select();
      
        $rowset=array();
        if(count($row)>0)foreach($row as &$v){ 
            $rowset[]=array(
                'code'=>$v['code'],
                'kind'=>$v['kind'],
                'name'=>$v['name'],
                'norms'=>$v['norms'],
                'safeCnt'=> $v['safeCnt'],
                'supplier_name'=> $v['supplier_name'],
                'danjia'=> $v['danjia'],
            );
        } 
        $filename=date('Y-m-d',time()).'原料表导出';
        $this->exportexcel($rowset,array('编码','类别','名称','规格','安全库存数','供应商','单价'),$filename);
        exit;
    }
}
?>