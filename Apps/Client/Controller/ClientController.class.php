<?php
namespace Client\Controller;
use Common\Controller\CommonController;
class ClientController extends CommonController {
	var $total = 100;
	var $cntFinished = 0;
	/**
	 * 客户查询
	 * @author zhangyan
	 * @2015-01-09
	 */
    public function indexClient(){
    	//获取自定义字段
    	$fieldArr=$this->getFields(1);
    	$field=$fieldArr['field'];
    	$field .=",ykb_client.level";
    	$aa = array('0'=>'company','1'=>'salesman','2'=>'memo','3'=>'ctime','4'=>'contact_name','5'=>'telephone');
    	$this->fieldArray=$aa;
    	//构造查询条件
    	$conditions = I('param.');
    	$map['ykb_client.salesman'] = $_SESSION['assessIds'];
    	if($conditions['user'] != NUll){ 
			$map['ykb_client.salesman'] = $conditions['user'];
			$this->user = $conditions['user'];
		}
		if($conditions['level'] != NUll){
			$map['ykb_client.level'] = $conditions['level'];
			$this->level = $conditions['level'];
		}
		if($conditions['isnew'] != NUll){
			$map['ykb_client.isnew'] = $conditions['isnew'];
			$this->isnew = $conditions['isnew'];
		}
		if($conditions['source_s'] != NUll){
			$map['ykb_client.source'] = $conditions['source_s'];
			$this->source_s = $conditions['source_s'];
		}
		if($conditions['keywords'] != NUll){
			$where['ykb_client.company']  = array('like','%'.trim($conditions['keywords']).'%');
			$where['_logic'] = 'or';
			$map['_complex'] = $where;
			//将搜索条件传入页面
			$this->keywords = $conditions['keywords'];
		}
    	//分页
    	$Client = M('client'); 
    	$count = $Client->join('LEFT JOIN ykb_client_contact ON ykb_client.id = ykb_client_contact.cid')
		    	->field($field) 
		    	->where($map)->count();
    	$Page = new \Think\Page($count,10,$conditions);
    	$this->page  = $Page->show();
    	//进行分页数据查询 注意limit方法的参数要使用Page类的属性 
    	$list = $Client
		    	->join('LEFT JOIN ykb_client_contact ON ykb_client.id = ykb_client_contact.cid')
		    	->field($field)
		    	->where($map)->order('ykb_client.id DESC')
		    	->limit($Page->firstRow.','.$Page->listRows)->select();
    	//查询业务员
    	$salesman = $this->getSalesman();
    	foreach ($salesman as $v){
    		$sales_name[$v['id']] = $v['real_name'];
    	}
    	$this->salesman = $salesman;
    	//查询行业
    	$industry=F("baseIndustry");
	    foreach ($industry as $v){
	    	$industry_name[$v['id']] = $v['name'];
	    	}
    	$this->industry=$industry;
    	//查询客户来源
    	$source = F('baseSource');
    	foreach ($source as $v){
    		$source_name[$v['id']] = $v['name'];
    	}
    	$this->source=$source;
    	//查询行业规模
    	$size = F('baseEmploynum');
    	foreach ($size as $v){
    		$size_name[$v['id']] = $v['employee_num'];
    	}
    	$this->size=$size;
	   	foreach ($list as &$v){
	    		$v['salesman']= $v['salesman']?$sales_name[$v['salesman']]:'';
	    		$v['source']=$v['source']? $source_name[$v['source']]:'';
	    		$v['industry']= $v['industry']? $industry_name[$v['industry']]:'';
	    		$v['industry_size'] = $v['industry_size']? $size_name[$v['industry_size']]:'';
	    		$v['province'] = $v['province']? C('province.'.$v['province']):'';
	    		$v['city'] = $v['city'] ? C('city.'.$v['city']):'';
	    		$v['area']= $v['area'] ? C('area.'.$v['area']):'';
	    		$v['birthday'] && $v['birthday'] = date('Y-m-d',$v['birthday']);
	    		$v['ctime'] = date('Y-m-d',$v['ctime']);
	    		unset($v);
	    } 
    	$this->list = $list;
    	$this->display();  
    }
    /**
     * 客户查询
     * @author zhangyan
     * @2015-01-09
     */
    
 public function clientPool(){
    	//获取自定义字段
    	$fieldArr=$this->getFields(1);
    	$field=$fieldArr['field'];
    	$this->fieldArray=$fieldArr['fieldArray'];
    	//构造查询条件
    	$conditions = I('param.');
    	$map['salesman']="";
		if($conditions['source_s'] != NUll){
			$map['ykb_client.source'] = $conditions['source_s'];
			$this->source_s = $conditions['source_s'];
		}
		if($conditions['keywords'] != NUll){
			$where['ykb_client.company']  = array('like','%'.trim($conditions['keywords']).'%');
			$where['_logic'] = 'or';
			$map['_complex'] = $where;
			//将搜索条件传入页面
			$this->keywords = $conditions['keywords'];
		}
    	//分页
    	$Client = M('client'); 
    	$count = $Client->join('LEFT JOIN ykb_client_contact ON ykb_client.id = ykb_client_contact.cid')
		    	->field($field)
		    	->where($map)->count();
    	$Page = new \Think\Page($count,10,$conditions);
    	$this->page  = $Page->show();
    	//进行分页数据查询 注意limit方法的参数要使用Page类的属性 
    	$list = $Client
		    	->join('LEFT JOIN ykb_client_contact ON ykb_client.id = ykb_client_contact.cid')
		    	->field($field)
		    	->where($map)->order('ykb_client.id DESC')
		    	->limit($Page->firstRow.','.$Page->listRows)->select();
    	//查询业务员
    	$salesman = $this->getSalesman();
    	foreach ($salesman as $v){
    		$sales_name[$v['id']] = $v['real_name']; 
    	}
    	$this->salesman = $salesman;
    	//查询行业
    	$industry=F("baseIndustry");
	    foreach ($industry as $v){
	    	$industry_name[$v['id']] = $v['name'];
	    	}
    	$this->industry=$industry;
    	//查询客户来源
    	$source = F('baseSource');
    	foreach ($source as $v){
    		$source_name[$v['id']] = $v['name'];
    	}
    	$this->source=$source;
    	//查询行业规模
    	$size = F('baseEmploynum');
    	foreach ($size as $v){
    		$size_name[$v['id']] = $v['employee_num'];
    	}
    	$this->size=$size;
	   	foreach ($list as &$v){
	    		$v['salesman']= $v['salesman']?$sales_name[$v['salesman']]:'';
	    		$v['source']=$v['source']? $source_name[$v['source']]:'';
	    		$v['industry']= $v['industry']? $industry_name[$v['industry']]:'';
	    		$v['industry_size'] = $v['industry_size']? $size_name[$v['industry_size']]:'';
	    		$v['province'] = $v['province']? C('province.'.$v['province']):'';
	    		$v['city'] = $v['city'] ? C('city.'.$v['city']):'';
	    		$v['area']= $v['area'] ? C('area.'.$v['area']):'';
	    		$v['birthday'] && $v['birthday'] = date('Y-m-d',$v['birthday']);
	    		$v['ctime'] = date('Y-m-d',$v['ctime']);
	    		unset($v);
	    } 
    	$this->list = $list;
    	//分页跳转的时候保证查询条件
    	foreach($map as $key=>$val) {
    		$Page->parameter[$key] = urlencode($val);
    	}
    	$this->display();  
    }
    
    /**
     * 编辑客户
     * @author zhangyan
     * @2015-01-12
     */
    public function editClient()
    {
      	$this->source = F('baseSource');
    	$this->industry = F('baseIndustry');
    	$this->industrySize = F('baseEmploynum');
    	$this->provinces = $this->province();
    	$this->salesman = $this->getSalesman();
    	
        $map['id'] = I('id');
        $client = D('Client')->where($map)->relation(true)->find();
        $province = M('province')->where(array('provinceid'=>$client['province']))->field('provinceid,province')->find();
       
        $city = M('city')->where(array('cityid'=>$client['city']))->find();
        $area = M('area')->where(array('areaid'=>$client['area']))->field('areaid,area')->find();
        $this->province = $province;
       
        $this->area = $area;
        $this->city = $city;
        $this->client = $client;
        $this->id = $map['id'];
        $this->display();
    }
    /**
     * 编辑客户
     * @author zhangyan
     * @2015-01-12
     */
    public function editClientHandle()
    {
    	$data = $_POST;
    	$client['id'] = $data['clientId'];
    	$client['company'] = $data['company'];
    	$client['industry'] = $data['industry'];
    	$client['source'] = $data['source'];
    	$client['salesman'] = $data['salesman'];
    	$client['province'] = $data['province'];
    	$client['area'] = $data['area'];
    	$client['city'] = $data['city'];
    	$client['address'] = $data['address'];
    	$client['industry_size'] = $data['industry_size'];
    	$client['memo'] = $data['memo'];
    	$client['isnew'] = $data['isnew'];
    	$client['utime'] = time();
    	//添加多个联系人
    	foreach ($data['contact_name'] as $k=>$v){ 
    		if($v != Null){
    			if ($data['id'][$k]) {
    				$client['client_contact'][$k]['id'] = $data['id'][$k];
    			}
    			$client['client_contact'][$k]['contact_name'] = $data['contact_name'][$k];
    			$client['client_contact'][$k]['telephone'] = $data['telephone'][$k];
    			$client['client_contact'][$k]['position'] = $data['position'][$k];
    			$client['client_contact'][$k]['email'] = $data['email'][$k];
    			$client['client_contact'][$k]['card_id'] = $data['card_id'][$k];
    			$client['client_contact'][$k]['birthday'] = strtotime($data['birthday'][$k]);
    			$client['client_contact'][$k]['contact_memo'] = $data['contact_memo'][$k];
    		}
    	}
    	$model = D('Client');
    	//自动验证
    	$result = $model->create($client);
    	if(!$result){
    		//验证失败返回错误信息
    		$this->error($model->getError());
    	}else{
    		$res = $model->relation(true)->save($client);
    		if($res){
    			if ($client['salesman']) {
    				$this->success('编辑成功',U('Client/Client/indexClient'));
    			}else {
    				$this->success('编辑成功',U('Client/Client/clientPool'));
    			}
    		}else{
    			$this->error('编辑失败');
    		}
    	}
    	
    }
    /**
     * 删除客户
     * @author zhangyan
     * @2015-01-11
     */
    public function deleteClient()
    {
        $map['id'] = I('id');
		$res = D('Client')->where($map)->relation(true)->delete();
		
		if($res){
		    $this->success('删除成功');
			/* $status = array (
					'success' => true,
					'mgs'=>'删除成功！'
			);
			$this->ajaxReturn($status); */
		}else{
		    $this->error('删除失败');
		}
    }
    
  	/**
     * ajax删除关联联系人
     *  @author zhangyan
     * @2015-01-14
     */
    public function ajaxDeleteContact(){
    	$map['id'] = I('id');
    	$res = M('client_contact')->where($map)->delete();
    	$this->ajaxReturn($res);
    }

    /**
     * 添加意向客户
     * @zhangyan
	 * @2014-01-11
     */
    public function addClient()
    {
    	$this->source = M('base_source')->select();
    	$this->industry = M('base_industry')->select();
    	$this->industrySize = M('base_employnum')->select();
    	$this->province = $this->province();
    	$this->salesman = $this->getSalesman();
    	$this->display();
    }
    
    /**
     * 添加客户表单处理
     * @author zhangyan
	 * @2015-01-12
     */
    public function addClientHandle()
    {
    	//I函数无法获取多个联系人只能用$_POST来获取
    	$data = $_POST;
    	$client['company'] = $data['company'];
    	$client['salesman'] = $data['salesman'];
    	$client['address'] = $data['address'];
    	$client['memo'] = $data['memo'];
    	$client['ctime'] = time();
    	//添加多个联系人
    	foreach ($data['contact_name'] as $k=>$v){ 
    		if($v != Null){
    			//$client['client_contact'][$k]['first'] = 1;
    			$client['client_contact'][$k]['contact_name'] = $data['contact_name'][$k];
    			$client['client_contact'][$k]['telephone'] = $data['telephone'][$k];
    			$client['client_contact'][$k]['position'] = $data['position'][$k];
    			$client['client_contact'][$k]['email'] = $data['email'][$k];
    			$client['client_contact'][$k]['card_id'] = $data['card_id'][$k];
    			$client['client_contact'][$k]['birthday'] = strtotime($data['birthday'][$k]);
    			$client['client_contact'][$k]['contact_memo'] = $data['contact_memo'][$k];
    		}
    	}
    	$model = D('Client');
    	//自动验证
    	$result = $model->create($client);
    	if(!$result){
    		//验证失败返回错误信息
    		$this->error($model->getError());
    	}else{
    		$res = $model->relation(true)->add($client);
    		if($res!==false){
    			if ($client['salesman']) {
    				$this->success('添加成功',U('Client/Client/indexClient'));
    			}else { 
    				$this->success('添加成功',U('Client/Client/clientPool'));
    			}
    		}else{
    			$this->error('添加失败');
    		}
    	}
    }
    /**
     * 查看客户详细信息
     * @author zhangyan
     * @2015-01-12
     */
    public function viewClient()
    {
    	$map['id'] = I('id');
    	$client = D('Client')->where($map)->relation(true)->find();
    	//获取来源
    	$source = F('baseSource');
    	foreach ($source as $v){
    		$source_name[$v['id']] = $v['name'];
    	}
    	//获取行业
    	$industry = F('baseIndustry');
    	foreach ($industry as $v){
    		$industry_name[$v['id']] = $v['name'];
    	}
    	$employeenum = F('baseEmploynum');
    	foreach ($employeenum as $v){
    		$employee_num[$v['id']] = $v['employee_num'];
    	}
    	$salesman = $this->getSalesman();
    	foreach ($salesman as $v){
    		$sales_name[$v['id']] = $v['real_name'];
    	}
    	$Ctype = F('baseActiontype');
    	foreach ($Ctype as $v){
    		$type_name[$v['id']] = $v['name'];
    	}
    	$this->type_name = $type_name;
    	$this->employee_num = $employee_num;
    	$this->sales_name = $sales_name;
    	$this->industry_name = $industry_name;
    	$this->source_name = $source_name;
    	$this->client = $client;
    	$this->display();
    }
    /**
     * AJAX根据省份ID查询城市
     * @author zhangyan
     * 2015-01-11
     * @return 城市数组
     */
    function city(){
    	$fatherid = $_POST['fatherid'];
    	$cities = M('city')->where(array('fatherid'=>$fatherid))->select();
    	$cities = json_encode($cities);
    	$this->ajaxReturn($cities);
    }
    /**
     * AJAX根据城市ID查询区域
     * @author zhangyan
     * 2015-01-11
     * @return 区域数组
     */
    function area(){
    	$fatherid = $_POST['fatherid'];
    	$areas = M('area')->where(array('fatherid'=>$fatherid))->select();
    	$areas = json_encode($areas);
    	$this->ajaxReturn($areas);
    }
    /**
     * 上传导入文件
     * @蔡斌
     * @2015-01-14
     */
    public function upload(){
    	//先上传导入的文件
    	$res = R('Base/Upload/upload');
    	$this->ajaxReturn($res);
    }
    
    /**
     * 导入上传文件
     * @蔡斌
     * @2015-01-14 13:02
     */
    public function import(){
    	ob_implicit_flush(true);
    	echo "(0-0.000001-读取中……)~";
    	ob_flush();
    	$filepath = $_POST;
    	//$filepath = "./Upload/client.xlsx";
    	$clients = R('Base/Import/import',array($filepath['file']));
    	$total = count($clients);
    	echo "(0-".$total."-读取完成，准备导入……)~";
    	ob_flush();
    	//处理数据
    	$data = array();
    	$clientFields = array(
    			'company' => '0',
    			'salesman' => '1',
    			'source' => '2',
    			'industry' => '3',
    			'industry_size' => '4',
    			'level' => '5',
    			'province' => '6',
    			'city' => '7',
    			'area' => '8',
    			'address' => '9',
    			'memo' => '10',
    	);
    	$contact = array(
    			'contact_name' => '11',
    			'position' => '12',
    			'telephone' => '13',
    			'email' => '14',
    			'contact_memo' => '15',
    			'card_id'=>'16',
    			'birthday'=>'17'
    	);
    	//读取地区信息
    	$province = array_flip(C('province'));
    	$city = array_flip(C('city'));
    	$area = array_flip(C('area'));
    	//获取业务员信息
    	$selesman = $this->getSalesman();
    	foreach ($selesman as $sales){
    		$selesman_name[$sales['real_name']] = $sales['id'];
    	}
    	//获取来源
    	$source = F('baseSource');
    	foreach ($source as $vs){
    		$source_id[$vs['name']] = $vs['id'];
    	}
    	//获取行业
    	$industry = F('baseIndustry');
    	foreach ($industry as $vi){
    		$industry_id[$vi['name']] = $vi['id'];
    	}
    	
    	$i = 0;
    	
    	foreach($clients as & $v){
    		//客户信息
    		$data[$i]['company'] = $v[$clientFields['company']];
    		$data[$i]['salesman'] = $selesman_name[$v[$clientFields['salesman']]]?$selesman_name[$v[$clientFields['salesman']]]:"";
    		$data[$i]['source'] = $source_id[$v[$clientFields['source']]]?$source_id[$v[$clientFields['source']]]:"";
    		$data[$i]['industry'] = $industry_id[$v[$clientFields['industry']]]?$industry_id[$v[$clientFields['industry']]]:"";
    		$data[$i]['province'] = $province[$v[$clientFields['province']]]?$province[$v[$clientFields['province']]]:"";
    		$data[$i]['city'] = $city[$v[$clientFields['city']]]?$city[$v[$clientFields['city']]]:"";
    		$data[$i]['area'] = $area[$v[$clientFields['area']]]?$area[$v[$clientFields['area']]]:"";
    		$data[$i]['address'] = $v[$clientFields['address']]?$v[$clientFields['address']]:"";
    		$data[$i]['memo'] = $v[$clientFields['memo']]?$v[$clientFields['memo']]:"";
    		//判断联系人有效性，姓名和电话必须
    		if($v[$contact['contact_name']] && $v[$contact['telephone']]){
    			$data[$i]['client_contact'][0]['contact_name'] = $v[$contact['contact_name']]?$v[$contact['contact_name']]:"";
    			$data[$i]['client_contact'][0]['position'] = $v[$contact['position']]?$v[$contact['position']]:"";
    			$data[$i]['client_contact'][0]['telephone'] = $v[$contact['telephone']]?$v[$contact['telephone']]:"";
    			$data[$i]['client_contact'][0]['email'] = $v[$contact['email']]?$v[$contact['email']]:"";
    			$data[$i]['client_contact'][0]['contact_memo'] = $v[$contact['contact_memo']]?$v[$contact['contact_memo']]:"";
    			$data[$i]['client_contact'][0]['card_id'] = $v[$contact['card_id']]?$v[$contact['card_id']]:"";
    			$data[$i]['client_contact'][0]['birthday'] = strtotime($v[$contact['birthday']]);
    		}
    		$i++;
    	}
    	echo "(0-".$total."-导入中……)~";
    	ob_flush();
    	$model = D('Client');
    	//写入数据库
    	$j=0;
    	foreach ($data as $key=>$val){
    		$j++;
    		$val['ctime'] = time();
    		$model->relation(true)->add($val);
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
     * 标记客户星级
     * @author zhangyan
     * 2015-01-26
     */
    public function ajaxPostLever(){
    	$data=I('post.');
    	$res = M('Client')->save($data);
    	if($res>0){
    		$status = array (
    				'success' => true,
    		);
    		$this->ajaxReturn($status);
    	}
    }
    /**
     * 客户生日提醒
     * @author zhangyan
     * @ 2015-02-03
     */
    public function birthday(){
    	//取当天时间的时间戳和一周后的时间戳
    	$now = strtotime(date('Y-m-d',time()));
    	$week = strtotime(date("Y-m-d",strtotime("+1 week")));
    	$Y=date('Y');
    	$contact = M('Client_contact')->field('id,birthday')->select();
    	$ids = array();
    	//循环判断生日时间是否满足条件，同时把符合条件的id都传到ids数组中
    	foreach($contact as &$val){
    		if($val['birthday']!=0){
    			$birth = date('Y-m-d',$val['birthday']);//时间戳转换
    			$time = explode("-",$birth);//拆分时间
    			$bir = strtotime($Y."-".$time[1]."-".$time[2]);//当年年份-生日月份-生日日期
    			if($bir>=$now && $bir<=$week){
    				$ids[] = $val['id'];
    			}
    		}
    	}
    	$map['s.id'] = array('in',$ids);
    	$ClientContact = M('client_contact s');
    	$count = $ClientContact->join('ykb_client c ON c.id = s.cid')
    						   ->where($map)->count();// 查询满足要求的总记录数
    	$Page = new \Think\Page($count,10);
    	//分页跳转的时候保证查询条件
    	foreach($map as $key=>$val) {
    		$Page->parameter[$key] = urlencode($val);
    	}
    	$this->page  = $Page->show();// 分页显示输出
    	$this->list = $ClientContact
			    	->join('ykb_client c ON c.id = s.cid')
			    	->where($map)->field('s.*,c.company')->order('s.birthday ASC')
			    	->limit($Page->firstRow.','.$Page->listRows)->select();
    	$this->display(); 
    }
    
    /**
     * 行动添加Ajax分页
     * @ author zhangyan
     * 2015-01-13
     *
     */
    public function clientAjax(){
    	$count = M('client')->count(); //计算记录数
    	$limitRows = 20; // 设置每页记录数
    	$p = new \Common\Util\Ajaxpage($count, $limitRows,"clients"); //第三个参数是你需要调用换页的ajax函数名
    	$limit_value = $p->firstRow . "," . $p->listRows;
    
    	$data['list'] = M('client')->order('id desc')->limit($limit_value)->select(); // 查询数据
    	$page = $p->show(); // 产生分页信息，AJAX的连接在此处生成
    	$data['page']=$page;
    	$this->ajaxReturn($data);
    }
    
    /**
     * 根据关键字搜索客户信息
     * @author xuli
     * 2015-1-12
     * update zhangyan
     */
    public function getClientKey(){
    	$data = I('get.');
    	$map['company'] = array('like',"%".$data['company']."%");
    	$count = M('client')->where($map)->count(); //计算记录数
    	$limitRows = 10; // 设置每页记录数
    	$p = new \Common\Util\Ajaxpage($count, $limitRows,"clientss"); //第三个参数是你需要调用换页的ajax函数名
    	$limit_value = $p->firstRow . "," . $p->listRows;
    
    	$data['list'] = M('client')->where($map)->limit($limit_value)->select(); // 查询数据
    	$page = $p->show(); // 产生分页信息，AJAX的连接在此处生成
    	$data['page']=$page;
    	$this->ajaxReturn($data);
    }
}