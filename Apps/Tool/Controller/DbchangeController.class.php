<?php
namespace Tool\Controller;
use Common\Controller\CommonController;
/**
 * 数据库改动管理
 *    管理模式
 *    a. 变更来源文件：提交补丁到版本库，存放变更的内容；
 *    b. 变更执行履历：在数据表中以执行日志的形式管理；
 */
class DbchangeController extends CommonController {
	 
	/**
	 * 是否为开发者模式
	 */
	private $_isDevModel = false;

	/**
	 * 补丁文件的默认文件前缀
	 */
	private $_prefix = 'EQ_DEV';

	Private $_patchPath = 'db/patchs';

	/**
	 * 通用-处理没有权限的操作
	 */
	Protected function _noAuth( $msg = '没有权限操作！')
	{
		$this->error($msg);
	}

	/**
	 * 初始化
	 */
	Public function _initialize()
	{
        $devInfo = C('DEV_INFO');

	    // Dbchange，需要用户以超级管理员的身份登录之后，才可以做修改
	    if ($devInfo['DEV_MODEL'])
	    {

	    	## 初始化-项目状态（是否处于开发状态）
	    	if (true === $devInfo['DEV_MODEL'])
	    	{
	    		$this->_isDevModel = true;
	    	}

	    	## 初始化-补丁文件前缀（使用当前开发人员标识）
	    	if (isset($devInfo['DEV_MAN']))
	    	{
	    		$this->_prefix = $devInfo['DEV_MAN'];
	    	}

	    	## 初始化-补丁文件存放的位置
	    	if (isset($devInfo['DB_PATCH_PATH']))
	    	{
		    	$this->_patchPath = $devInfo['DB_PATCH_PATH'];
	    	}
	    	
			return true;
		}else{

			$this->_noAuth();
		
		}
	}


	/**
	 * 数据库改动管理界面
	 */
    public function index()
    {
    	$this->display();
    }

    /**
     * 改动提交管理界面
     */
    public function commitIndex()
    {
		// 若为开发模式，允许提交数据库改动
		if(!$this->_isDevModel)
		{
			$this->_noAuth();
		}

		$this->prefix = $this->_prefix;
		$this->display();
    }

    /**
     * 改动执行管理界面
     */
    Public function updateIndex(){
    	// 可查看补丁的起始时间
    	$data['dateFrom'] = (date('Y')-1).date('-m-d');
    	$this->data = $data;
    	$this->display();
    }

	/**
	 * 提交数据库改动(补丁模式)
	 */
	public function commit(){
		$data = I('post.');
		$sql = $data['sql'];

		$patchName  = str_replace('-', '', $data['datePatch']);
		$patchName .= str_replace(':', '', $data['timePatch']);

		// 获得目标的文件名
		$fileName = $this->_getFileName($data['fileName'], $patchName);

		// 操作文件
		$file = $this->_patchPath.'/'.$fileName;
		// 重写文件
		$this->_rewrite($file, $sql);

		$res = $this->_logDbChange($fileName, $sql);

		$return = array('success'=>true,'curFile'=>$fileName);
		$this->ajaxReturn($return);
	}

	/**
	 * 执行数据库改动（补丁模式）
	 */
	Public function update(){
		$param = I('post.');
		//文件是否存在
		if(! $this->_hasPatch($param['fileName']))
		{
			$this->ajaxReturn(array('success'=>false,'msg'=>'文件不存在'));
		}
		// 是否已标记数据库
		if( $this->_hasLog($param['fileName']))
		{
			$this->ajaxReturn(array('success'=>false,'msg'=>'此文件已经执行过，不需要标记'));
		}

		$fileAllPath = $this->_patchPath.'/'.$param['fileName'];
		//取得文件内容
		$content = file_get_contents($fileAllPath);
		//去掉bom头
		$content = $this->_removeBOM($content);
		//作为sql语句执行,
		$arrSql = split(';',$content);
		foreach($arrSql as & $v) {
			$v = trim($v);
		}
		$arrSql = array_filter($arrSql);

		if(count($arrSql)){
			//如果sql语句执行错误，返回错误信息
			$model = M();
			foreach($arrSql as & $v) {
				$res = $model->execute($v);
				$error = $model->getDbError();
				if($error!='') {
					$this->ajaxReturn(array(
						'success'=>false,
						'msg'=>"{$param['fileName']}执行失败,错误如下:<br /><font color='red'>{$error}</font><br/>sql语句:<pre>{$v}</pre>",
						'fileName'=>$param['fileName']
					));
				}
			}

			//如果sql语句执行成功,插入日志表中
			$log = array('fileName'=>$_POST['fileName'],'content'=>$content);

			$res = $this->_logDbChange($param['fileName'], $content, 'update');

			$this->ajaxReturn(array(
				'success'=>true,
				'msg'=>$param['fileName']."执行成功",
				'fileName'=>$param['fileName']
			));
		}

		$this->ajaxReturn(array(
				'success'=>false,
				'msg'=>$param['fileName']."无可执行内容",
				'fileName'=>$param['fileName']
		));
	}

	/**
	 * 删除补丁包
	 */
	Public function remove(){
		$param = I('post.');
		if(!$this->_hasPatch($param['fileName'])) 
		{
			$this->ajaxReturn(array('success'=>false,'msg'=>'文件不存在'));
		}
		$fileAllPath = $this->_patchPath.'/'.$param['fileName'];
		
		$ret = unlink($fileAllPath);
		
		if(!$ret) 
		{
			$this->ajaxReturn(array('success'=>false,'msg'=>'文件删除失败'));
		}
		
		$this->ajaxReturn(array('success'=>true));
	}

	/**
	 * 更改前缀
	 */
	Public function changePre(){
		$this->ajaxReturn(array(
								'success'=>false,
								'msg' => '请手动修改配置文件',)
		);
	}

	/**
	 * 执行记录明细
	 */
	Public function listLog(){

		$logs = M('ToolDbchangeLog')->select();

		$head = array('fileName'=>array('title'=>'文件名', ),
					  'content'=>array('title'=>'执行内容'),
					  'dotime'=>array('title'=>'执行时间'),
					  'memo' =>array('title'=>'备注'),
					 );
		$this->data = array('head'=>$head, 'rowset'=>$logs);
		$this->display();
	}

	/**
	 * 获取补丁文件的内容
	 */
	Public function getPatchContent(){
		$param = I('post.');

		$fileAllPath = $this->_patchPath.'/'.$param['fileName'];

		if( ! file_exists($fileAllPath) )
		{
			$arr = array('success'=>false,'msg'=>'文件不存在');
		}
		else
		{
			$content = file_get_contents($fileAllPath);
			$content = $this->_removeBOM($content);	//去掉bom头
			$arr = array('success'=>true,'content'=>$content);
		}
		$this->ajaxReturn($arr);
	}

	/**
	 * 补丁包明细
	 */
	Public function listPatch(){
		$param = I('post.');
		$map = array();
		// 检索条件
		if( isset($param['type']) ){
			$map['_Method'] = $param['type'];
			$map['_Method'] = "_{$map['_Method']}Patch";
		}

		// -- 补丁文件名-提交人
		if( isset($param['prefix']) ){
			$map['prefix'] = $param['prefix'];
		}
		// -- 补丁文件名-时间
		if( isset($param['datePatch']) ){
			$map['datePatch'] = str_replace('-', '', $param['datePatch']);
		}

		// 获取补丁文件目录下的文件名集合
		$arrFile = $this->_listFiles($this->_patchPath);

		// 文件名是否匹配 要检索的项目
		foreach ($map as $k => $v) {
			foreach ($arrFile as $index =>$fn) {
				if(false === strpos($fn, $v)){
					unset($arrFile['$index']);					
				}
			}
		}

		if($map['_Method']){
			// 过滤方法不存在时，无结果；
			$arrFile = method_exists($this, $map['_Method'])?$this->$map['_Method']($arrFile):false;
		}

		$this->ajaxReturn($arrFile);
	}


	// 获得未执行的补丁文件列表
	Private function _undoPatch($arrSource){
		$arr = array();
		foreach ($arrSource as $index => $fn) {
			if(!$this->_hasLog($fn)){
				$arr[] = $fn;
			}
		}
		return $arr;
	}

	/**
	 * 将某个补丁文件标记为已执行 
	 */
	function doMark() {
		$data = I('post.');

		if($this->_hasLog($data['fileName']))
		{
			$this->ajaxReturn(array('success'=>false,'msg'=>'此文件已经执行过，不需要标记'));
		}

		// 标记为已执行
		$res = $this->_logDbChange($data['fileName'], '', 'mark');
		$this->ajaxReturn(array('success'=>$res?true:false,'fileName'=>$f));
	}

	

	/**
	 * 标记提交的数据库更改
	 * @param $type { commit:程序员提交， mark: 人工标记为已执行 ，update:执行并影响数据表 }
	 */
	Protected function _logDbChange($fileName, $sql, $type = 'commit')
	{
		$memoType = array(
					'commit'=>'程序员提交:'.$this->_prefix,
					'mark'=>'人工标记为已执行',
					'update' =>'',
					);
		$memo = $memoType[$type]?$memoType[$type]:'--';
		// 查找对应的记录
		$row  = M('ToolDbchangeLog')->where(array('fileName'=>$fileName))->find();
		$row  = ($row['id'])?$row:array();

		if($row['id']){
			// 更新
			$row['content'] = $sql;
			$row['memo'] = $memo;
			$res = D('ToolDbchangeLog')->save($row);
		}else{
			// 新建
			$row = array(
					'fileName' => $fileName,
					'content'  => $sql,
					'memo'     => $memo,
					);
			$res = D('ToolDbchangeLog')->add($row);
		}
		return $res;
	}

	/**
	 * 查看文件的存在状态
	 */
	Private function _hasLog($fileName)
	{
		$row = M('ToolDbchangeLog')->where(array('fileName'=>$fileName))->find();
		return $row['id']?true:false;;
	}

	Private function _hasPatch($fileName)
	{
		return file_exists($this->_patchPath.'/'.$fileName);
	}

	// 操作-执行数据库改动文件

	/**
	 * 获取数组集合：指定目录下的所有文件名
	 */
	Protected function _listFiles($path=''){
		$list = array();
		
		if($path && $dh = opendir($path)){
			while (false !== ($file = readdir($dh))) {
				//不是文件跳过
				if(!is_file($path.'/'.$file)) continue;
				$list[] = $file;
			};
			closedir($dh);
		}
		return $list;
	}

	/**
	 * 重写文件；若不存在，则新建；
	 */
	Protected function _rewrite($filename, $data) {

        if(get_magic_quotes_gpc())//如果get_magic_quotes_gpc()是打开的
        {
            $data=stripslashes($data);//将字符串进行处理
        }
		$filenum = fopen($filename, "w");
		flock($filenum, LOCK_EX);
		fwrite($filenum, $data);
		fclose($filenum);
	}

	/**
	 * 去除文件的BOM头
	 */
	Protected function _removeBOM($content) {
		$charset[1] = substr($content, 0, 1);
		$charset[2] = substr($content, 1, 1);
		$charset[3] = substr($content, 2, 1);
		if (ord($charset[1]) == 239 && ord($charset[2]) == 187 && ord($charset[3]) == 191) {
			$content = substr($content, 3);
		}
		return $content;
	}

	/**
	 * 通用-获取补丁文件的名字
	 */
	Protected function _getFileName($fileName, $patchName)
	{
		$prefix = $this->_prefix;
		//新建文件
		if( '' == $fileName)
		{
			//搜索最大的文件名
			$initFile = "{$prefix}_{$patchName}_0.txt";
			
			if(!file_exists($this->_patchPath.'/'.$initFile))
			{
				$fileName = $initFile;
			}
			else
			{
				//如果文件名存在，检索最后创建的那个文件，在此基础上+1;
				$maxIndex = 0;
				if ($dh = opendir($this->_patchPath)) {
					while (false !== ($file = readdir($dh))) {
						//不是文件跳过
						if(!is_file($this->_patchPath.'/'.$file)) continue;
						//日期不匹配跳过
						if(strpos($file,$patchName)===false) continue;

						$_preArr = explode('_',$file);
						//前缀不匹配跳过
						if($_preArr[0]!=$prefix) continue;

						$_preArr = explode(".",$_preArr[2]);
						// 后缀数字取大值
						if($_preArr[0]+0>$maxIndex) {
							$maxIndex = $_preArr[0];
							continue;
						}
						
					};
					$fileName = "{$prefix}_{$patchName}_".($maxIndex+1).".txt";
					closedir($dh);
				}
			}
			//创建文件名
		}
		return $fileName;
	}
}