<?php
namespace Auth\Util;
    /**
     *应用基于thinkphp的左右值无限分类
     *岗位（角色）
     */
    class Position
    {
    	var $tableName = 'auth_group';
    	var $fullTableName = 'ykb_auth_group';
    	var $primaryKey = 'id';
    	var $_leftNodeFieldName = 'lft';
    	var $_rightNodeFieldName = 'rgt';
    	var $_parentNodeFieldName = 'pid';
        //传入实化的对象【M('表名')】
        private $objPosition;
        //基础节点ID号
        public $intCurrentId;
        //设置制表符样式
        private $arrTabsStyle = array(
                                'indent' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',
                                'process' => '├─ ',
                                'end'=>'└─ '
                            );
        //构造函数初始化
        public function __construct($objPosition)
        {
            $this->objPosition = $objPosition;
        }
        //验证传入ID【大于0的数字】
        private function checkFun($intId)
        {
            //$intId优先验证
            if(isset($intId))
            {
                $this->intCurrentId = $intId;
                return true;
            }
            //如果$this->intCurrentId 已设置，验证
            else
            {
                if(isset($this->intCurrentId))
                {
                    return true;
                }
                else
                {
                    return false;
                }
            }
        }
        //根据ID号获取当前节点左右值
        private function setCurrentData($intId)
        {
            if(false == $this->checkFun($intId))
            {
                return false;
            }
            $map['id'] = $this->intCurrentId;
            return $this->objPosition->field(array('lft','rgt'))->where($map)->find();
        }
        /**
         * 作用：设置输出列表数据的制表符样式
         * 参数：$key：arrTabsStyle的KEY $value：arrTabsStyle的值
         */
        public function setTabStyle($key, $value = '')
        {
            if(isset($this->arrTabsStyle[$key]))
            {
                $this->arrTabsStyle[$key] = $value;
            }
        }
        /**
         * 作用： 根据ID号获取当前节点数据
         * 参数： $intId：可设置的，需读取节点ID号
         */
        public function getCurrentData($intId)
        {
        	if(false == $this->checkFun($intId))
            {
                return false;
            }
            
            $map['id'] = $this->intCurrentId;
            return $this->objPosition->field(array('id','title','remark','bid','status','lft','rgt'))->where($map)->find();
            
        }
        /**
         *作用：获取当前节点的父节点数据
         *参数： $intId：需要读取节点的ID
         */
        public function getParentPositionData($intId)
        {
        	$arrRoot = $this->setCurrentData($intId);
        	
        	if($arrRoot)
            {
                $map['lft'] = array('LT', $arrRoot['lft']);
                $map['rgt'] = array('GT', $arrRoot['rgt']);
                return $this->objPosition->where($map)->order('lft desc')->find();
            }
            else
            {
                return false;
            }
        }
        /**
         *作用：获取ID下节点列表
         *参数： $intId：需要读取节点的父ID $intLevel：目录等级默认到100级
         */
        public function getPositionList($intId = 1, $intLevel = 100)
        {
            //获取选定节点左右值，得出取值区间
            $arrRoot = $this->setCurrentData($intId);
           
            if($arrRoot)
            {
                //读取数据库符合条件的数据
                $map['lft'] = array('BETWEEN', array($arrRoot['lft'], $arrRoot['rgt']));
                $arrChildList = $this->objPosition->where($map)->order('lft')->select();
                //return $arrChildList;
                //对取出数据进行格式化
                $arrRight = array();
                foreach($arrChildList as $v)
                {
                	
                	if(count($arrRight))
                    {
                        while ($arrRight[count($arrRight) - 1] < $v['rgt'])
                        {
                            array_pop($arrRight);
                        }
                        //获取父节点的右值
                        $parentRgt = $this->getParentPositionData($v['id']);
                    }
                    
                    //设置读取目录等级
                    if($intLevel > count($arrRight))
                    {
                        $tags = "";
                        //设置输出时的样式
                        if(count($arrRight))
                        {
                        	if(intval($parentRgt['rgt'])-1 == $v['rgt']){
                        		$tags = $this->arrTabsStyle['end'].$tags;
                        	}else{
                        		$tags = $this->arrTabsStyle['process'].$tags;
                        	}
                        }
                        $tags = str_repeat($this->arrTabsStyle['indent'], count($arrRight)).$tags;
                        $returnPositionList[] = array('id'=>$v['id'],'title'=>$v['title'],'tags'=>$tags,'remark'=>$v['remark'],'bid'=>$v['bid'],'status'=>$v['status'],'lft'=>$v['lft'],'rgt'=>$v['rgt']);
                        $arrRight[]  = $v['rgt'];
                    }
                    
                }
                return $returnPositionList;
            }
            return false;
        }
        /**
         * 作用： 获取节点的子节点数
         * 参数：$intId：需要读取节点的父ID
         */
        public function getPositionCount($intId)
        {
            $arrRoot = $this->setCurrentData($intId);
            return ($arrRoot['rgt'] - $arrRoot['lft'] - 1) / 2;
        }
        /**
         * 作用：添加节点
         * 参数： $bolType：true添加到节点前面，false添加到节点尾部 $intId：添加到的父节点
         */
        public function insertPosition($bolType = false, $intPid)
        {
            $data = I('param.');
            if(!isset($intPid))
            {
                $intPid = $data['pid'];
            }
            $arrRoot = $this->setCurrentData($intPid);
            if($arrRoot)
            {
                if($bolType)
                //true添加到节点前面
                {
                    $this->objPosition->where('rgt>'.$arrRoot['lft'])->setInc('rgt',2);
                    $this->objPosition->where('lft>'.$arrRoot['lft'])->setInc('lft',2);
                    //设置当前节点的左右值
                    $data['lft'] = $arrRoot['lft'] + 1;
                    $data['rgt'] = $arrRoot['lft'] + 2;
                }
                else
                //false添加到节点尾部
                {
                    $this->objPosition->where('rgt>='.$arrRoot['rgt'])->setInc('rgt',2);
                    $this->objPosition->where('lft>'.$arrRoot['rgt'])->setInc('lft',2);
                    $data['lft'] = $arrRoot['rgt'];
                    $data['rgt'] = $arrRoot['rgt'] + 1;
                }
                return $this->objPosition->add($data);
            }
            else
            {
                return false;
            }
        }
        /**
         *作用：删除节点
         *参数：$intId：被删除的节点ID
         */
        public function deletePosition($intId)
        {
            $arrRoot = $this->setCurrentData($intId);
            if($arrRoot)
            {
                $ints = $arrRoot['rgt'] - $arrRoot['lft'] + 1;
                $map['lft'] = array('BETWEEN', array($arrRoot['lft'], $arrRoot['rgt']));
                $this->objPosition->where($map)->delete();
                $this->objPosition->where('lft>'.$arrRoot['rgt'])->setDec('lft',$ints);
                $this->objPosition->where('rgt>'.$arrRoot['rgt'])->setDec('rgt',$ints);
                return true;
            }
            else
            {
                return false;
            }
        }
        /**
         *作用：更新节点
         *参数：$intId：被删除的节点ID
         */
        public function updatePosition()
        {
        	
            //读取POST数据存入数组
            $data = I('post.');
            
            //父ID等于子ID，直接跳出
            if($data['pid'] == $data['id']){return false;}
            //post.pid和当前父post.old相等说明未改变目录，不更新左右值
            if($data['pid'] !== $data['oldpid'])
            {
            	//获取新的父节点的数据
	            $targetNode = $this->setCurrentData($data['pid']);
	            //取当前节点的数据
	            $sourceNode = $this->setCurrentData($data['id']);
	            
	    		$childCount = $this -> calcAllChildCount($sourceNode);
                $targetChild = $this -> calcAllChildCount($targetNode);
                $addNum1 = ( $childCount + 1 ) * 2 ;
                //读取数据库符合条件的数据
                $map['lft'] = array('BETWEEN', array($sourceNode['lft'], $sourceNode['rgt']));
                $sourceTree = $this->objPosition->where($map)->order('lft')->select();
                foreach ($sourceTree as $a_node){
                	$sourceId[] = $a_node['id'];
                }
                if(isset($sourceId) && is_array($sourceId)){
                	$sourceQStr = implode(",",$sourceId);
                }
                //更新左右值
                if(($sourceNode[$this->_leftNodeFieldName]<$targetNode[$this->_leftNodeFieldName]) && ($sourceNode[$this->_rightNodeFieldName]<$targetNode[$this->_rightNodeFieldName]))
                {
                	//parent to brother and S<'T
                	$sql_left = "update {$this->fullTableName} SET {$this->_leftNodeFieldName} = {$this->_leftNodeFieldName} - ".$addNum1."
                			     where {$this->_leftNodeFieldName} > {$sourceNode[$this->_rightNodeFieldName]}
                	             and {$this->_leftNodeFieldName} < {$targetNode[$this->_rightNodeFieldName]}";
                	$sql_right = "update {$this->fullTableName} SET {$this->_rightNodeFieldName} = {$this->_rightNodeFieldName} - ".$addNum1."
                	              where {$this->_rightNodeFieldName} > {$sourceNode[$this->_rightNodeFieldName]}
                				  and {$this->_rightNodeFieldName} < {$targetNode[$this->_rightNodeFieldName]}";
                	$addNum = $targetNode[$this->_rightNodeFieldName] - $sourceNode[$this->_rightNodeFieldName]-1;
                	$sql_stree = "UPDATE {$this->fullTableName} SET "."{$this->_leftNodeFieldName} = {$this->_leftNodeFieldName} + " . $addNum .
                	             " , {$this->_rightNodeFieldName} = {$this->_rightNodeFieldName} + " . $addNum .
                	             " WHERE " . $this->primaryKey . " in (".$sourceQStr.")";
                } 
                elseif (($sourceNode[$this->_leftNodeFieldName]<$targetNode[$this->_leftNodeFieldName]) && ($sourceNode[$this->_rightNodeFieldName]>$targetNode[$this->_rightNodeFieldName]))
                {
                	//parent move to child . not allow
                	return false;
                } 
                elseif (($sourceNode[$this->_leftNodeFieldName]>$targetNode[$this->_leftNodeFieldName]) && ($sourceNode[$this->_rightNodeFieldName]<$targetNode[$this->_rightNodeFieldName]))
                {
                	//move to parents
                	$sql_left = "update {$this->fullTableName} SET {$this->_leftNodeFieldName} = {$this->_leftNodeFieldName} - ".$addNum1."
                		         where {$this->_leftNodeFieldName} > {$sourceNode[$this->_rightNodeFieldName]}
                		         and {$this->_leftNodeFieldName} < {$targetNode[$this->_rightNodeFieldName]}";
                    $sql_right = "update {$this->fullTableName} SET {$this->_rightNodeFieldName} = {$this->_rightNodeFieldName} - ".$addNum1."
                		          where {$this->_rightNodeFieldName} > {$sourceNode[$this->_rightNodeFieldName]}
                		          and {$this->_rightNodeFieldName} < {$targetNode[$this->_rightNodeFieldName]}";
                	$addNum = $targetNode[$this->_rightNodeFieldName] - $sourceNode[$this->_rightNodeFieldName] - 1  ;
                	$sql_stree = "UPDATE {$this->fullTableName} SET "."{$this->_leftNodeFieldName} = {$this->_leftNodeFieldName} + " . $addNum .
                		         " , {$this->_rightNodeFieldName} = {$this->_rightNodeFieldName} + " . $addNum .
                		         " WHERE " . $this->primaryKey . " in (".$sourceQStr.")";
                } 
                elseif (($sourceNode[$this->_leftNodeFieldName]>$targetNode[$this->_leftNodeFieldName]) && ($sourceNode[$this->_rightNodeFieldName]>$targetNode[$this->_rightNodeFieldName]))
                {
                	//move to brother and S>T
                	$sql_left = "update {$this->fullTableName} SET {$this->_leftNodeFieldName} = {$this->_leftNodeFieldName} + ".$addNum1."
                	             where {$this->_leftNodeFieldName} > {$targetNode[$this->_rightNodeFieldName]}
                	             and {$this->_leftNodeFieldName} < {$sourceNode[$this->_leftNodeFieldName]}";
                    $sql_right = "update {$this->fullTableName} SET {$this->_rightNodeFieldName} = {$this->_rightNodeFieldName} + ".$addNum1."
                			      where {$this->_rightNodeFieldName} >= {$targetNode[$this->_rightNodeFieldName]}
                			      and {$this->_rightNodeFieldName} < {$sourceNode[$this->_leftNodeFieldName]}";
     				$addNum = $sourceNode[$this->_leftNodeFieldName] - $targetNode[$this->_rightNodeFieldName];
                	$sql_stree = "UPDATE {$this->fullTableName} SET "."{$this->_leftNodeFieldName} = {$this->_leftNodeFieldName} - " . $addNum .
                			     " , {$this->_rightNodeFieldName} = {$this->_rightNodeFieldName} - " . $addNum .
                			     " WHERE " . $this->primaryKey . " in (".$sourceQStr.")";
                }
                //update parent_id
                //$sql3 = "update {$this->fullTableName} SET {$this->_parentNodeFieldName}=".$targetNode[$this->primaryKey]." where " . $this->primaryKey . " = ".$sourceNode[$this->primaryKey];
                //echo $sql_left."<br>".$sql_right."<br>".$sql_stree."<br>".$sql3;exit;
               	/* if($this->objPosition->execute($sql_left)&&$this->objPosition->execute($sql_right)&&$this->objPosition->execute($sql_stree))
                {
                	return true;
                }else{
                	return false;
                } */
                if(mysql_query($sql_left)&&mysql_query($sql_right)&&mysql_query($sql_stree))
                {
                	
                	return true;
                }else{
                	return false;
                }
            }
            
            $updata['title'] = $data['title'];
            $updata['pid'] = $data['pid'];
            $updata['bid'] = $data['bid'];
            $updata['remark'] = $data['remark'];
            $updata['status'] = $data['status'];
           // dump()
            return $this->objPosition->where('id='.$data['id'])->save($updata);
        }
        /**
         * 计算所有子节点的总数
         * @param array $node
         * @return int
         */
        function calcAllChildCount($node) {
        	return intval(($node[$this->_rightNodeFieldName] - $node[$this->_leftNodeFieldName] - 1) / 2);
        }
    }
?>