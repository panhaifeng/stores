<?php
/**
 * TOP API: taobao.ruqin.test.one request
 * 
 * @author auto create
 * @since 1.0, 2015.02.03
 */
class RuqinTestOneRequest
{
	/** 
	 * 12
	 **/
	private $errorCode;
	
	/** 
	 * 12
	 **/
	private $errorMessage;
	
	/** 
	 * 简单的用户结构
	 **/
	private $sampleUser;
	
	private $apiParas = array();
	
	public function setErrorCode($errorCode)
	{
		$this->errorCode = $errorCode;
		$this->apiParas["error_code"] = $errorCode;
	}

	public function getErrorCode()
	{
		return $this->errorCode;
	}

	public function setErrorMessage($errorMessage)
	{
		$this->errorMessage = $errorMessage;
		$this->apiParas["error_message"] = $errorMessage;
	}

	public function getErrorMessage()
	{
		return $this->errorMessage;
	}

	public function setSampleUser($sampleUser)
	{
		$this->sampleUser = $sampleUser;
		$this->apiParas["sample_user"] = $sampleUser;
	}

	public function getSampleUser()
	{
		return $this->sampleUser;
	}

	public function getApiMethodName()
	{
		return "taobao.ruqin.test.one";
	}
	
	public function getApiParas()
	{
		return $this->apiParas;
	}
	
	public function check()
	{
		
		RequestCheckUtil::checkNotNull($this->errorMessage,"errorMessage");
		RequestCheckUtil::checkMaxLength($this->errorMessage,10,"errorMessage");
	}
	
	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
