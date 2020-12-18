<?php
namespace Taobao\Controller;
use Think\Controller;
class CommonController extends Controller {
    public function common(){
    	import('Taobao.Util.TopSdk',APP_PATH,'.php');
    	//实例化TopClient类
		$client = new \TopClient(); 
		$client->appkey = "1023084926"; 
		$client->secretKey = "sandbox913a1d0a9034322c053264c57";
		$sessionkey= "610032650c4389d50644b0433757d786eb15339360bd65d3651880349";   //如沙箱测试帐号sandbox_c_1授权后得到的sessionkey
		//实例化具体API对应的Request类
		$req = new \UserSellerGetRequest();
		$req->setFields("nick,user_id,type");
		//$req->setNick("sandbox_c_1");
		//执行API请求并打印结果
		$resp = $client->execute($req,$sessionkey);
		dump($resp);die;
    }
    public function set() {
    	/*测试时，需把test参数换成自己应用对应的值*/
    	$url = 'https://oauth.taobao.com/token';
    	$postfields= array('grant_type'=>'authorization_code',
    			'client_id'=>'23084926',
    			'client_secret'=>'841374d913a1d0a9034322c053264c57',
    			'code'=>'hpRCDCKJq9fWLOS56OarQO8d251633',
    			'redirect_uri'=>'http://ning.tanglaoliu.com');
    	$post_data = '';
    	foreach($postfields as $key=>$value){
    		$post_data .="$key=".urlencode($value)."&";} 
    		$ch = curl_init();
    		curl_setopt($ch, CURLOPT_URL, $url);
    		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    		curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
    		curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
    		//指定post数据
    		curl_setopt($ch, CURLOPT_POST, true);
    		//添加变量
    		curl_setopt($ch, CURLOPT_POSTFIELDS, substr($post_data,0,-1));
    		$output = curl_exec($ch);
    		$httpStatusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    		echo $httpStatusCode;
    		curl_close($ch);
    		var_dump($output);
    }
}