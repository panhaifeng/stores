<?php
namespace Common\Controller;
use Think\Controller;
class CommonController extends Controller {
        /**
         * 验证登陆等初始化操作
         * @caibin
         * @2014-11-03
         */
        Public function _initialize(){
            //判断浏览器的版本。为了获得更好的用户体验。建议使用IE9+。火狐，谷歌浏览器运行
            if(strpos($_SERVER["HTTP_USER_AGENT"],"MSIE 6.0") || strpos($_SERVER["HTTP_USER_AGENT"],"MSIE 7.0")  || strpos($_SERVER["HTTP_USER_AGENT"],"MSIE 8.0")){
                $this->show("浏览器版本太低！！请先升级浏览器");
                $this->display('./Public/tpl/browser.html');die;
            }
            //判断是否登陆
            if(!isset($_SESSION[C('USER_AUTH_KEY')]) || !isset($_SESSION['user_name'])){ //判断是否有uid
                $this->redirect("Home/Login/index");
            }
            //设置生日提醒天数
            $this->birthday = $this->getdayCount();
            //设置生日提醒天数
            $this->birthday2 = $this->getdayCount2();
            //设置生日提醒下拉框
            $this->client2 = $this->getBirth();
            //以用户名来判断是否是超级管理员，绕过验证，不用用户组来判断的原因是用户组有时候是中文，而且常删除或更改。
            if($_SESSION[C('ADMIN_AUTH_KEY')]){
                return true;
            }
            $not_auth = C('NOT_AUTH');
            //读取不需要验证的模块和控制器
            $module_name = MODULE_NAME;
            $controller_name = MODULE_NAME.'/'.CONTROLLER_NAME;
            $action_name = MODULE_NAME.'/'.CONTROLLER_NAME.'/'.ACTION_NAME;
            $notAuth = in_array($module_name, $not_auth) || in_array($controller_name,$not_auth) || in_array($action_name,$not_auth);
            //验证权限
            if(!$notAuth){
                $Auth = new \Common\Util\Auth();
                $action_name=MODULE_NAME.'/'.CONTROLLER_NAME.'/'.ACTION_NAME;
                $Auth->check($action_name,$_SESSION[C('USER_AUTH_KEY')]) || $this->error('您没有权限');
            }
        }

        protected function _addCurrentUserInfo(){
            $this->creator = $_SESSION['real_name'];
        }

        /**
         * 空操作
         * @param unknown $name
         */
        public function _empty($name){
            $this->display('./Public/Tpl/404.html');die;
        }
        /**
         * 查询省份
         * @return 省份数组
         */
        function province(){
            return M('province')->select();
        }
        /**
         * 根据省份ID查询城市
         * @return 城市数组
         */
        function getCity($fatherId){
            return M('city')->where(array('fatherid'=>$fatherId))->select();

        }
        /**
         * 根据城市ID查询区域
         * @return 区域数组
         */
        function getArea($fatherId){
            return M('area')->where(array('fatherid'=>$fatherId))->select();
        }
        /**
         * 查询所有业务员
         */
        public function getSalesman(){
            return  M('user')->field('id,real_name')->select();
        }

        public function SetStore($uid){
            // $rres = M('auth_store')->where(array('uid'=>$uid))->field('storeId')->select();
            return $rres;
        }
        /**
         * 针对搜索框，显示登录人对应的店铺
         * Time : 2018-12-29
         * @author : pan
         */
        public function SearchStore($uid,$stores){
            //找到登录人他对应的店铺
            // $rres = M('auth_store')->where(array('uid'=>$uid))->field('storeId')->select();
            if($rres){
                foreach ($rres as $ky => &$vvs) {
                    $rrr[] = $vvs['storeId'];
                }
            }
            //没有设置过店铺关联的人员搜索框可以选择全部
            if($rres){
                foreach ($stores as $key => &$vals) {
                    if(!in_array($key, $rrr)){
                        unset($stores[$key]);
                    }
                }
            }
            return $stores;
        }

        /**
         * 查询设置的字段
         * @author zhangyan
         * 2015-01-22
         */
        public function getFields($module) {
            //获取当前用户设置的字段
            $maps['uid']=$_SESSION['uid'];
            //判断哪个模块
            $maps['place']=$module;
            $temp=M('view')->where($maps)->select();
            if ($temp) {
                foreach ($temp as $v){
                $fields[$v['table']]=unserialize($v['fields']);
                foreach ($fields[$v['table']] as $key=>$value){
                    $fieldArray[]=$value;
                    $field .= $v['table'].".".$value.",";
                }
            }
                $field .="ykb_client.id";
                //如果不存在则是默认值
            }else{
                $field="ykb_client.id,ykb_client.company,ykb_client.salesman,ykb_client_contact.contact_name,ykb_client_contact.telephone";
                $fieldArray=array(
                        '0'=>'company',
                        '1'=>'salesman',
                        '2'=>'contact_name',
                        '3'=>'telephone',
                );
            }
            //获取表头字段
            $data['fieldArray']=$fieldArray;
            $data['field']=$field;
            return $data;
        }

        /**
         * 查询银行名
         * @param $id
         * 传过来的id值
         */
        public function getBankname($id) {
            $map['id'] = $id;
            $row = M('bank')->where($map)->field('bankname')->find();
            return $row['bankname'];
        }

        /**
         * 查询合同单号
         * @param $id
         * 传过来的id值
         */
        public function getMemorandumcode($id) {
            $map['id'] = $id;
            $row = M('memorandum')->where($map)->field('orderCode')->find();
            return $row['orderCode'];
        }

        /**
         * 查询是否开票
         * @param $id
         * 传过来的id值
         */
        public function getShuilv($id) {
            $map['id'] = $id;
            $row = M('memorandum')->where($map)->field('shuilv')->find();
            return $row['shuilv'];
        }

        /**
         * 查询产品
         */
        public function getProName($id){
            $map['id'] = $id;
            $row = M('base_product')->where($map)->field('name')->find();
            return $row['name'];
        }
        /**
         * 查询收款项目名称
         * @param $id
         * 传过来的id值
         */
        public function getSon($id) {
            $map['id'] = $id;
            $row = M('collection')->where($map)->field('collection_name')->find();
            $row['collection_name'] = strlen($row['collection_name']) > 0 ? $row['collection_name'] : "";
            return $row['collection_name'];
        }

        /**
         * 查询付款项目名称
         * @param $id
         * 传过来的id值
         */
        public function getSon2($id) {
            $map['id'] = $id;
            $row = M('payment')->where($map)->field('payment_name')->find();
            $row['payment_name'] = strlen($row['payment_name']) > 0 ? $row['payment_name'] : "";
            return $row['payment_name'];
        }

        /**
         * 上传
         * @param 附件夹名 $subName
         * @author xuli
         * 2015-1-13
         */
        Public function _Upload($subName) {
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize = 3145728 ;// 设置附件上传大小
            $upload->exts = array('jpg','png');// 设置附件上传类型
            $upload->rootPath = './Upload/'; // 设置附件上传根目录
            $upload->savePath = ''; // 设置附件上传（子）目录
            $upload->saveName = ''; // 设置附件名
            $upload->subName  = $subName; // 设置附件文件夹名
            // 上传文件
            $info = $upload->upload();
            //取得上传文件名
            foreach($info as $file){
                $savename = explode(".",$file['savename']);
                $name = $savename[0];
            }
            $filename="./Upload/".$subName."/" .$name. ".jpg";
            return $filename;
        }

        /**
         * 单号自动生成
         * @param $head 开头  $tblName 表名   $fieldName 字符名
         */
        Public function _getNewCode($head,$tblName,$fieldName) {
            $map[$fieldName] = array('like',$head.'%');
            $row = M($tblName)->where($map)->field($fieldName)->order($fieldName.' desc')->select();
            $init = $head .date('ym').'001';
            if(empty($row[0][$fieldName])) return $init;
            if($init>$row[0][$fieldName]) return $init;
            //自增1
            $max = substr($row[0][$fieldName],-3);
            $pre = substr($row[0][$fieldName],0,-3);
            return $pre .substr(1001+$max,1);
        }
        /**
         * 查询当前用户的下属用户。（用于搜索条件的查询）
         * @蔡斌
         * @2015-01-28
         */
        public function getChildrenSalemans(){
            $map['id'] = array('in',$_SESSION['assessIds']);
            return M('user')->where($map)->select();
        }
        /**
         * 操作成功跳转的快捷方法
         * @access protected
         * @param string $message 提示信息
         * @param string $jumpUrl 页面跳转地址
         * @param mixed $ajax 是否为Ajax方式 当数字时指定跳转时间
         * @return void
         */
        /*   function success($message = '', $url = '') {
            redirect($url,'','保存成功');
        } */
        /**
         * 将任意字符串转换为 JavaScript 字符串（不包括首尾的"）
         *
         * @param string $content
         *
         * @return string
         */
    /* 	public function t2js($content)
        {
            return str_replace(array("\r", "\n"), array('', '\n'), addslashes($content));
        } */

        /**
         * 客户生日提醒个数
         * @ by xuli
         * @2014-11-27
         */
        public function getdayCount(){
            //取当天时间的时间戳
            $now = strtotime(date('Y-m-d',time()));
            $Y=date('Y');
            /* 取出数据库中的生日，把今年年份替换为生日年份
             这样的目的是为了做判断时使用时间戳,更加的效率 */
            $Client = M('Client_contact')->field('id,birthday')->select();
            $i=0;
            //循环判断生日时间是否满足条件，同时把符合条件的id都传到ids数组中
            foreach($Client as &$val){
                if($val['birthday']!=0){
                    $birth = date('Y-m-d',$val['birthday']);//时间戳转换
                    $time = explode("-",$birth);//拆分时间
                    $bir = strtotime($Y."-".$time[1]."-".$time[2]);//当年年份-生日月份-生日日期
                    if($bir==$now){
                        $i++;
                    }
                }
            }
            return $i;
        }
        /**
         * 客户生日提醒个数
         * @ by xuli
         * @2014-11-27
         */
        public function getdayCount2(){
            //取当天时间的时间戳和一周后天的时间戳
            $now = strtotime(date('Y-m-d',time()));
            $week = strtotime(date("Y-m-d",strtotime("+1 week")));
            $Y=date('Y');
            /* 取出数据库中的生日，把今年年份替换为生日年份
             这样的目的是为了做判断时使用时间戳,更加的效率 */
            $Client = M('Client_contact')->field('id,birthday')->select();
            $ids = array();
            $j=0;
            //循环判断生日时间是否满足条件，同时把符合条件的id都传到ids数组中
            foreach($Client as &$val){
                if($val['birthday']!=0){
                    $birth = date('Y-m-d',$val['birthday']);//时间戳转换
                    $time = explode("-",$birth);//拆分时间
                    $bir = strtotime($Y."-".$time[1]."-".$time[2]);//当年年份-生日月份-生日日期
                    if($bir>=$now && $bir<=$week){
                        $j++;
                    }
                }
            }
            return $j;
        }
        /**
         * 客户生日下拉列表
         * @ by xuli
         * @ 2014-11-27
         */
        public function getBirth(){
            $now = strtotime(date('Y-m-d',time()));
            $Y=date('Y');
            $Client = M('Client_contact')->field('id,birthday')->select();
            $ids = array();
            foreach($Client as &$val){
                if($val['birthday']!=0){
                    $birth = date('Y-m-d',$val['birthday']);//时间戳转换
                    $time = explode("-",$birth);//拆分时间
                    $bir = strtotime($Y."-".$time[1]."-".$time[2]);//当年年份-生日月份-生日日期
                    if($bir==$now){
                        $ids[] = $val['id'];
                    }
                }
            }
            $map['id'] = array('in',$ids);
            //分页
            $Client = M('client_contact');
            $client = $Client->where($map)->order('id DESC')->limit(5)->select();
            foreach ($client as & $v){
                $v['birthday'] = date('Y-m-d',$v['birthday']);
            }
            return $client;
        }

        /**
         *二维数组按指定的键值排序
         * $array 数组
         * $key排序键值
         * $type排序方式
         */
        Public function array_sort($arr, $keys, $type = 'asc') {
            $keysvalue = $new_array = array();
            foreach ($arr as $k => $v) {
                $keysvalue[$k] = $v[$keys];
            }
            if ($type == 'asc') {
                asort($keysvalue);
            } else {
                arsort($keysvalue);
            }
            reset($keysvalue);
            foreach ($keysvalue as $k => $v) {
                $new_array[$k] = $arr[$k];
            }
            return $new_array;
        }

        /**
            * 导出数据为excel表格
            *@param $data    一个二维数组,结构如同从数据库查出来的数组
            *@param $title   excel的第一行标题,一个数组,如果为空则没有标题
            *@param $filename 下载的文件名
            *@examlpe
        */
        Public function exportexcel($data=array(),$title=array(),$filename='report'){
            header("Content-type:application/octet-stream");
            header("Accept-Ranges:bytes");
            header("Content-type:application/vnd.ms-excel");
            header("Content-Disposition:attachment;filename=".$filename.".xls");
            header("Pragma: no-cache");
            header("Expires: 0");
            //导出xls 开始
            if (!empty($title)){
                foreach ($title as $k => $v) {
                    $title[$k]=iconv("UTF-8", "GB2312",$v);
                }
                $title= implode("\t", $title);
                echo "$title\n";
            }
            if (!empty($data)){
                foreach($data as $key=>$val){
                    foreach ($val as $ck => $cv) {
                        $data[$key][$ck]=iconv("UTF-8", "GB2312", $cv);
                    }
                    $data[$key]=implode("\t", $data[$key]);

                }
                echo implode("\n",$data);
            }
        }

        #对rowset的某几个字段进行合计,
        #firstField表示需要显示为"合计"字样的字段
        #返回合计行的数据
        function getHeji(&$rowset, $arrField, $firstField = '')
        {
            $str = "\$newRow[\"" . join('"]["', explode('.', $firstField)) . '"]="合计";';
            eval($str);
            foreach ($rowset as & $v) {
                foreach ($arrField as & $f) {
                    $newRow[$f] += $v[$f];
                    $newRow[$f] = $newRow[$f];
                }
            }
            $newRow['_bgColor'] = '#F2F4F6';
            $newRow['mark'] = 'heji';
            return $newRow;
        }

}