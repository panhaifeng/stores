<?php
namespace Weixin\Controller;
use Weixin\Controller\CommonController;
class ClientController extends CommonController{
	public function index(){
		$map['c.salesman']=$_SESSION['uid'];
		$client=M('client c')
		->join('ykb_client_contact b ON c.id = b.cid')
		->where($map)
		->field("c.id,c.company,c.province,c.city,c.area,c.address,b.contact_name,b.telephone")
		->select();
		$this->client=$client;
		$this->display();
		}
	public function clientView(){
		$map['id']=I('get.');
		$client=M('client c')
		->join('ykb_client_contact b ON c.id = b.cid')
		->where($map)
		->field("c.id,c.company,c.province,c.city,c.area,c.address,b.contact_name,b.telephone")
		->select();
	}	
		
}
?>