<?php
namespace Weixin\Controller;
use Think\Controller;
class IndexController extends Controller {
	
    public function index(){
    	/* echo $this->getDistance("31.686858", "119.974641","31.682974","119.964043");
    	$a = $this->getgps(); */
    }
    /**
     * 计算两个地理位置之间的距离
     * @param unknown $lat_a
     * @param unknown $lng_a
     * @param unknown $lat_b
     * @param unknown $lng_b
     * @return number
     */
    function getDistance($lat_a, $lng_a, $lat_b, $lng_b) {
    	//R是地球半径（米）
    	$R = 6366000;
    	$pk = doubleval(180 / 3.14169);
    
    	$a1 = doubleval($lat_a / $pk);
    	$a2 = doubleval($lng_a / $pk);
    	$b1 = doubleval($lat_b / $pk);
    	$b2 = doubleval($lng_b / $pk);
    
    	$t1 = doubleval(cos($a1) * cos($a2) * cos($b1) * cos($b2));
    	$t2 = doubleval(cos($a1) * sin($a2) * cos($b1) * sin($b2));
    	$t3 = doubleval(sin($a1) * sin($b1));
    	$tt = doubleval(acos($t1 + $t2 + $t3));
    
    	return round($R * $tt);
    }
    /**
     * GPS转百度坐标
     * @param 经度 $lats
     * @param 纬度 $lngs
     * @return multitype:string
     */
    function getgps($lats,$lngs)
    {
    	$lat="31.682974";
    	$lng="119.964043";
    	$c=file_get_contents("http://api.map.baidu.com/ag/coord/convert?from=0&to=4&x=$lng&y=$lat");
    	$arr=(array)json_decode($c);
    	if(!$arr['error'])
    	{
    		$lat=base64_decode($arr['y']);
    		$lng=base64_decode($arr['x']);
    	}
    	return array($lat,$lng);
    }
    /**
     * 同步用户信息
     * @蔡斌
     * 临时方法
     */
    public function add_user(){
    	$userlist = $this->getUsers();
    	foreach ($userlist as & $v){
    		$temp = "";
    		$v = (array)$v;
    		$temp['user_name'] = $v['userid'];
    		$temp['real_name'] = $v['name'];
    		$temp['password'] = md5($v['userid']);
    		M('user')->add($temp);
    	}
    }
    /**
     * 获取通讯录
     * @caibin
     * @2014-12-29
     */
    public function getUsers(){
    	$appID = "wx691da5348c1ab177";
    	$appsecret = "OlcECN9rs8iMM2bZgwrPlY6EJZ_0rY9ZNWpWbWyOcnw0PYSgBJF51iduiXpltox6";
    	$token = "";
    	$access_token = get_access_token($appID,$appsecret,$token);
    	//查询详细信息
    	//$url = "https://qyapi.weixin.qq.com/cgi-bin/user/list?access_token=".$access_token."&department_id=1&fetch_child=1&status=0";
    	//查询基本信息
    	$url = "https://qyapi.weixin.qq.com/cgi-bin/user/simplelist?access_token=".$access_token."&department_id=1&fetch_child=1&status=0";
    	$ch = curl_init();
    	curl_setopt($ch, CURLOPT_URL, $url);
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    	$user = json_decode(curl_exec($ch));
    	curl_close($ch);
    	return $user->userlist;
    }
}