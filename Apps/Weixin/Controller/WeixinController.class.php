<?php
namespace Weixin\Controller;
use Think\Controller;
use Weixin\Service\Varify;
class WeixinController extends Controller{
	public function index(){
		$wechatObj = new Varify();
		
		//公众号服务器数据
		$sReqMsgSig = $sVerifyMsgSig = $_GET['msg_signature'];
		$sReqTimeStamp = $sVerifyTimeStamp = $_GET['timestamp'];
		$sReqNonce = $sVerifyNonce = $_GET['nonce'];
		$sReqData = file_get_contents("php://input");;
		$sVerifyEchoStr = $_GET['echostr'];
		//测试数据
		/* $sVerifyMsgSig = "5c45ff5e21c57e6ad56bac8758b79b1d9ac89fd3";
		$sVerifyTimeStamp = "1409659589";
		$sVerifyNonce = "263014780";
		$sVerifyEchoStr = "P9nAzCzyDtyTWESHep1vC5X9xho/qYX3Zpb4yKa9SKld1DsH3Iyt3tP3zNdtp+4RPcs8TgAE7OaBO+FZXvnaqQ=="; */
		
		if ($sVerifyEchoStr) {
			$wechatObj->valid($sVerifyMsgSig,$sVerifyTimeStamp,$sVerifyNonce, $sVerifyEchoStr);
		}
		//回调模式需要打开此接口
		/* else{
			$wechatObj->responseMsg($sReqMsgSig, $sReqTimeStamp, $sReqNonce, $sReqData);
		} */
	}	
}
?>