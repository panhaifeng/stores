<?php
/**
 * TOP API: taobao.waimai.item.pic.upload request
 * 
 * @author auto create
 * @since 1.0, 2015.02.03
 */
class WaimaiItemPicUploadRequest
{
	/** 
	 * 图片文件字节数组
	 **/
	private $picbytes;
	
	private $apiParas = array();
	
	public function setPicbytes($picbytes)
	{
		$this->picbytes = $picbytes;
		$this->apiParas["picbytes"] = $picbytes;
	}

	public function getPicbytes()
	{
		return $this->picbytes;
	}

	public function getApiMethodName()
	{
		return "taobao.waimai.item.pic.upload";
	}
	
	public function getApiParas()
	{
		return $this->apiParas;
	}
	
	public function check()
	{
		
		RequestCheckUtil::checkNotNull($this->picbytes,"picbytes");
	}
	
	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
