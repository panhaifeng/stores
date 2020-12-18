<?php
namespace Weixin\Controller;
use Weixin\Controller\CommonController;
class ClientPoolController extends CommonController{
	public function index(){
		$map['salesman']='';
		$client=M('client c')
		->join('ykb_client_contact b ON c.id = b.cid')
		->where($map)
		->field("c.company,c.province,c.city,c.area,c.address,b.contact_name,b.telephone")
		->select();
		$this->client=$client;
		$this->display();
		}
		
}
?>