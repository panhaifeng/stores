<?php
namespace Baseinfo\Controller;
use Common\Controller\CommonController;
use Baseinfo;
class CustomController extends CommonController {
    public function index(){
    	
    }
    
    /**
     * 自定义字段显示
     * @author zhangyan
     * 2015-01-21
     */
    public function fieldCustom(){
    	//
    	$maps['uid']=$_SESSION['uid'];
    	//判断哪个模块
    	$maps['place']=1;
    	//查询已定义的字段
    	$temp=M('view')->where($maps)->select();
    	if ($temp) {
    		foreach ($temp as $v){
    			//反序列化字段组成数组
    			$fieldArr[$v['table']]=unserialize($v['fields']);
    			foreach ($fieldArr[$v['table']] as $key=>$value){
    				$fieldArray[]=$value;
    			}
    		}
    	}
    	//查询表名
 		$table=C('table');
 		foreach ($table as $k=>& $v){
 			//读取表中要设置的所有字段
 			$fields[$k]['table'] = $k;
 			$fields[$k]['fields'] = C($k);
 			//没选的字段状态为0
 			foreach ($fields[$k]['fields'] as $key=>$f){
 				$fields[$k]['field'][$key]['text'] = $f;
 				$fields[$k]['field'][$key]['status'] = 0;
 			}
 			//已选字段状态为1，没选的字段使其不能用
 			foreach ($fieldArray as $val){
 				if($fields[$k]['field'][$val]['text']){
 					$fields[$k]['field'][$val]['status'] = 1;
 				}else{
 					unset($fields[$k]['field'][$val]);
 				}
 			}
 		}
 		$this->fields = $fields;
 		$this->display(); 
    }
    /**
     * 处理客户选择的字段
     * @author zhangyan
     * 2015-01-22
     */
    public function fieldHandle(){
    	$data=I('post.');
    	$maps['uid']=$client['uid']=$_SESSION['uid'];
    	$client['ctime']=time();
    	$maps['place']=$client['place']=1;
    	//查询表中用户是否有设定
    	$tab=M('view')->where($maps)->field('table,id')->select();
    	foreach ($data as $k=>& $value){
    		$temp= explode("-",$k);
    		$client['table']=$temp[0];
    		//序列化数组
    		$client['fields']= serialize($value);
    		//如果表中没有记录则直接添加
    		if ($tab) {
	    		//如果有则修改记录否则添加记录
	    		foreach ($tab as $v){
	    			if($client['table']==$v['table']){
	    				$client['id']=$v['id'];
	    				$res = M('view')->save($client);
	    			}else{
	    				$res = M('view')->add($client);
	    			}
	    		}
    		}else{
    			$res = M('view')->add($client);
    		}
    	}
    	if($res){
    			$this->success('操作成功',U('Baseinfo/Custom/fieldCustom'));
    		}else{
    			$this->error('操作失败');
    		}
    }
   
}