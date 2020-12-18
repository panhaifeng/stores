<?php
namespace Supplier\Controller;
use Common\Controller\CommonController;
use Supplier;
class IndexController extends CommonController {
	
	/**
	 * 供应商查询
	 * @author xuli
	 * 2015-1-27
	 */
    public function index(){
    	$conditions = I('param.');
        $arr=array();
    	if($conditions['supplier']!=NULL){
    		$map['supplier_name'] = array('like','%'.trim($conditions['supplier'].'%'));
    		$this->supplier = $conditions['supplier'];
    	}
    	$supplier = M('supplier');
    	$count = $supplier->where($map)->count();
    	$Page = new \Think\Page($count,25,I('param.'));
    	$this->page = $Page->show();
    	$row = $supplier->where($map)->limit($Page->firstRow.','.$Page->listRows)->select();
    	$this->information = $row;
        $this->arr=$arr;

        //导出
        if($conditions['export']==1){
            $this->export($map);
        }else{
            $this->display();
        }
    }
    
    /**
     * 供应商新增
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
    	if(I('id')){
    		$map['id'] = I('id');
    		$res = M('supplier')->where($map)->save(I('post.'));
    	}else{
    		$res = M('supplier')->add(I('post.'));
    	}
    	if($res!==false){
    		$this->success('保存成功',U('Supplier/Index/index'));
    	}else{
    		$this->error('保存失败');
    	}
    }
    
    /**
     * 修改
     * @author xuli
     * 2015-1-27
     */
    public function edit(){
    	$map['id'] = I('id');
    	$this->Supplier = M('supplier')->where($map)->find();
    	$this->display('add');
    } 
    
    /**
     * 删除
     * @author xuli 
     * 2015-1-27
     */
    public function delect(){
    	$map['id'] = I('id');
    	$res = M('supplier')->where($map)->delete();
    	if($res!==false){
    		$this->success('删除成功',U('Supplier/Index/index'));
    	}else{
    		$this->error('删除失败');
    	} 
    }

    /**
     * 供应商导入
     * @shenhao
     * 2018-12-5
     */
    public function import(){
        ob_implicit_flush(true);
        echo "(0-0.000001-读取中……)~";
        ob_flush();
        $filepath = $_POST;
        $product = R('Base/Import/import',array($filepath['file']));
        $total = count($product);
        echo "(0-".$total."-读取完成，准备导入……)~";
        ob_flush();
        //处理数据
        $data = array();
        $Fields = array(
            'supplier_name' => '0',
            'supplier_people' => '1',
            'supplier_tel' => '2',
        );
        $i = 0;
        foreach($product as & $v){
            if($v[$Fields['supplier_name']]==NULL) continue;
            //客户信息
            $data[$i]['supplier_name'] = $v[$Fields['supplier_name']];
            $data[$i]['supplier_people'] = $v[$Fields['supplier_people']];
            $data[$i]['supplier_tel'] = $v[$Fields['supplier_tel']];
            $i++;
        }
        echo "(0-".$total."-导入中……)~";
        ob_flush();
        //写入数据库
        $j=0;
        foreach ($data as $key=>$val){
            $j++;
            //$val['ctime'] = time();
            $res = M('supplier')->add($val);
      
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
     * 供应商导出
     * @author shenhao
     * 2018-12-4
     */
    function export($map){
        $supplier = M('supplier');
        $row = $supplier->where($map)->select();
        
        $rowset=array();
        if(count($row)>0)foreach($row as &$v){ 
            $rowset[]=array(
                'supplier_name'=>$v['supplier_name'],
                'supplier_people'=>$v['supplier_people'],
                'supplier_tel'=>$v['supplier_tel'],
            );
        } 
        $filename=date('Y-m-d',time()).'供应商导出';
        $this->exportexcel($rowset,array('供应商名称','联系人','联系电话'),$filename);
        exit;
    }

    /**
     * 供应商Ajax分页
     * @author shenhao
     * 2018年12月17日 
     */
    public function supplierAjax(){
        $count = M('supplier')->count(); //计算记录数
        $limitRows = 20; // 设置每页记录数
        $p = new \Common\Util\Ajaxpage($count, $limitRows,"suppliers"); //第三个参数是你需要调用换页的ajax函数名
        $limit_value = $p->firstRow . "," . $p->listRows;
    
        $data['list'] = M('supplier')->order('id desc')->limit($limit_value)->select(); // 查询数据
        $page = $p->show(); // 产生分页信息，AJAX的连接在此处生成
        $data['page']=$page;
        $this->ajaxReturn($data);
    }

    /**
     * 根据关键字搜索供应商信息
     * @author shenhao
     * 2018年12月17日 14:11:01
     */
    public function getSupplierKey(){
        $data = I('get.');
        $map['supplier_name'] = array('like',"%".$data['company']."%");
        $count = M('supplier')->where($map)->count(); //计算记录数
        $limitRows = 10; // 设置每页记录数
        $p = new \Common\Util\Ajaxpage($count, $limitRows,"suppliers"); //第三个参数是你需要调用换页的ajax函数名
        $limit_value = $p->firstRow . "," . $p->listRows;
    
        $data['list'] = M('supplier')->where($map)->limit($limit_value)->select(); // 查询数据
        $page = $p->show(); // 产生分页信息，AJAX的连接在此处生成
        $data['page']=$page;
        $this->ajaxReturn($data);
    }
}