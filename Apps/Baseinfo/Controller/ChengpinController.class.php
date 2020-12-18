<?php
    namespace Baseinfo\Controller;
    use Common\Controller\CommonController;
    class ChengpinController extends CommonController {

    /**
     * 产品显示
     * @author xuli
     * 2015-1-27
     */
    public function index(){
        $conditions = I('param.');
        $arr=array();
        if($conditions['product']){
            $map['name'] = array('like','%'.trim($conditions['product']).'%');
            $this->product = $conditions['product'];
            $arr['product'] = $conditions['product'];
        }
        if($conditions['code']){
            $map['code'] = array('like','%'.trim($conditions['code']).'%');
            $this->code = $conditions['code'];
            $arr['code'] = $conditions['code'];
        }
        if($conditions['kind']){
            $map['kind'] = array('like','%'.trim($conditions['kind']).'%');
            $this->kind = $conditions['kind'];
            $arr['kind'] = $conditions['kind'];
        }
        if($conditions['color']){
            $map['color'] = array('like','%'.trim($conditions['color']).'%');
            $this->color = $conditions['color'];
            $arr['color'] = $conditions['color'];
        }

        $product = M('chengpin_product');
        $count = $product->where($map)->count();
        $Page = new \Think\Page($count,25,I('param.'));
        $this->page = $Page->show();
        $row = M('chengpin_product')->where($map)->limit($Page->firstRow.','.$Page->listRows)->order('kind asc')->select();

        $kindArr = $product->field('name')->group('name')->select();//品牌集合
        $this->kindArr=$kindArr;

        $this->base_product = $row;
        $this->arr=$arr;
        //导出
        if($conditions['export']==1){
            $this->export($map);
        }else{
            $this->display();
        }
    }

    /**
     * 产品新增
     * @author xuli
     * 2015-1-27
     */
    public function add(){
        $this->display();
    }

    /**
     * 保存
     * @author xuli
     * 2015-1-27
     */
    public function addInsert(){
        $data = I('post.');
        $chengpin = D('Chengpin');
        if (!$chengpin->create($data)){
            $this->error($chengpin->getError());
        }
        $data['chengpinform'] = array();
        //应该可优化
        $products = array();
        foreach($data['productId'] as $key => $v){
            if(empty($v)){
                continue;
            }
            $product = array(
                'productId' => $data['productId'][$key],
                'cnt'	=> $data['cnt'][$key],
                'isbox'	=> $data['isbox'][$key]
            );
            if($data['sonId'][$key]!=""){
                $product['id'] = $data['sonId'][$key];
            }
            $products[] = $product;
        }
        $data['chengpinform'] = $products;
        if($data['id']){
            $res = $chengpin->relation(true)->save($data);
        }else{
            $res = $chengpin->relation(true)->add($data);
        }
        if($res!==false){
            $this->success('添加成功',U('Baseinfo/Chengpin/index'));
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
        $map3['f.pid']=$map2['f.pid']=$map['id'] = I('id');
        $map2['isbox']=0;
        $this->product = M('chengpin_product')->where($map)->find();
        $this->form = M('chengpin_form f')->join('ykb_base_product p ON p.id = f.productId')->where($map2)->field('f.*,p.code,p.name,p.kind,p.norms')->select();
        $map3['isbox']=1;
        $this->box=M('chengpin_form f')->join('ykb_base_product p ON p.id = f.productId')->where($map3)->field('f.*,p.code,p.name,p.kind,p.norms')->find();
        $this->display();
    }

    /**
     * 删除
     * @author xuli
     * 2015-1-27
     */
    public function delect(){
        $map['id'] = I('id');
        $res = D('Chengpin')->relation(true)->where($map)->delete();
        if($res){
            $this->success('删除成功',U('Baseinfo/Chengpin/index'));
        }else{
            $this->error('删除失败');
        }
    }

    /**
     * ajax删除从表子类
     * @author xuli
     * 2015-2-14
     */
    public function deletesonid() {
        $map['id'] = I('post.id');
        $res = M('chengpin_form')->where($map)->delete();
        $this->ajaxReturn($res);
    }

    /**
     * 产品导入
     * @xuli
     * 2015-02-16
     */
    public function import(){
        set_time_limit(0);
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
                'kind' => '1',
                'name' => '2',
                'color' => '3',
                'cnt' => '4',
                'chengpinform' => '5',
                'bomRemove' => '13',
        );
        $i = 0;
        foreach($product as & $v){
            //客户信息
            $data[$i]['code'] = $v[$Fields['code']];
            $data[$i]['name'] = $v[$Fields['name']];
            $data[$i]['kind'] = $v[$Fields['kind']];
            $data[$i]['color'] = $v[$Fields['color']];
            $data[$i]['cnt'] = $v[$Fields['cnt']]+0;
            $data[$i]['chengpinform'] = $v[$Fields['chengpinform']];
            $data[$i]['bomRemove'] = $v[$Fields['bomRemove']];
            $i++;
        }
        echo "(0-".$total."-导入中……)~";
        ob_flush();
        //写入数据库
        $j=0;
        $modelChengpin = D('Chengpin');
        foreach ($data as $key=>$val){
            $j++;
            if($val['bomRemove']){//删除模式不做导入保存
                $bomData = $cp = $con = array();
                $con['kind'] = $val['kind'];
                $con['code'] = $val['code'];
                $cp = D('Chengpin')->where($con)->find();//成品id

                $bomData= explode(',',$val['bomRemove']);
                foreach ($bomData as $k => &$b) {
                    $mapPro = $delCon = $bomDetail =$proList = $infoCon = array();
                    $bomDetail= explode(':',$b);
                    $mapPro['code'] = $bomDetail[0];//查询bom的productId
                    $proList = M('base_product')->where($mapPro)->field('id')->find();

                    //删除bom
                    if($proList['id']){
                        $infoCon['productId'] = $proList['id'];
                        $infoCon['pid'] = $cp['id'];
                        $info = M('chengpin_form')->where($infoCon)->field('id')->find();
                        if($info['id']){
                            $delCon['id'] = $info['id'];
                            $result = M('chengpin_form')->where($delCon)->delete();
                        }
                    }
                    
                }
            }else{
                //$val['ctime'] = time();
                $val['chengpinform'] = $this->_getBaseProducts($val['chengpinform']);
                $res = $modelChengpin->relation(true)->add($val);
                if($val[name]!==NULL && $val['cnt']>0){
                    $ruku['ruku_date'] = strtotime(date("Y-m-d"));
                    $ruku['memo'] = "初始化";
                    $ruku['ruku_product'] = array();
                    $product2[0] = array(
                        'productId' => $res,
                        'cnt'     => $val['cnt'],
                    );
                    $ruku['ruku_product'] = $product2;
                    $r = D('Cpruku');
                    $res2 = $r->relation(true)->add($ruku);
                    $kucun = D('Kucun');
                    $r2 = $kucun->_after_save($res2,'rukuId','cp_ruku','cpruku_product','isruku');
                }
            }
            
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

    private  function _getBaseProducts($info){
        $rows = array();
        $products = explode(',', $info);
        foreach ($products as $product){
            if(!$product){
                continue;
            }
            $info = explode(':', $product);
            $code = $info[0];
            $cnt  = $info[1]?$info[1]:1;
            $data = M('base_product')->where(array('code'=>$code))->find();
            if($data){
                $rows[] = array(
                    'productId' =>$data['id'],
                    'cnt'       => $cnt,
                    'isBox'     => 0,
                );
            }
        }
        return $rows;
    }

     /**
     * 产品导出
     * @author shenhao
     * 2018-12-4
     */
    function export($map){
        $row = M('chengpin_product')->where($map)->order('kind asc')->select();
        $rowset=array();
        if(count($row)>0)foreach($row as &$v){
            $tmp = array();
            $con = array();
            $con['f.pid']=$v['id'];
            $data = M('chengpin_form f')
            ->join('ykb_base_product p ON p.id = f.productId')
            ->where($con)
            ->field('f.*,p.code,p.name,p.kind,p.norms')
            ->select();
            foreach ($data as $key => &$b) {
                $b['cnt'] = floatval($b['cnt']);
                $tmp[] = $b['code'].':'.$b['cnt'];
            }
            $textTmp = implode(',',$tmp);
            $rowset[]=array(
                'code'=>$v['code'],
                'kind'=>$v['kind'],
                'name'=>$v['name'],
                'color'=>$v['color'],
                'cnt'=>'',
                'textTmp'=>$textTmp,
            );
        } 
        $filename=date('Y-m-d',time()).'成品表导出';
        $this->exportexcel($rowset,array('编码','型号','品牌','颜色','数量','关联原料'),$filename);
        exit;
    }
}
?>