<?php
namespace Base\Controller;
use Think\Controller;
class UploadController extends Controller { 
		/**
		 * 初始化
		 * @caibin
		 * @2014-11-03
		 */
		Public function _initialize(){ 
			
		}
		/**
		 * 上传文件
		 * @蔡斌
		 * @2015-01-14
		 */
		public function upload(){
			$upload = new \Think\Upload();// 实例化上传类    
			$upload->maxSize   =     3145728 ;// 设置附件上传大小    
			$upload->exts      =     array('xls','xlsx');// 设置附件上传类型
			$upload->rootPath  =     './'; //保存根路径
			$upload->savePath  =     './Upload/'; // 设置附件上传目录    // 上传文件   
			//$upload->saveName  =     ''; // 设置附件名
			//$upload->subName   =     'Client'; // 设置附件文件夹名
			//$upload->saveExt   =     $data; //设置上传后缀
			//$upload->replace   =     true; //设置上传后缀
			
			$info   =   $upload->upload();
			
			if(!$info) {
				// 上传错误提示错误信息 
				$data['msg'] = $upload->getError();
				$data['status'] = 0;
				return $data;    
			}else{
				// 上传成功 
				$data['msg'] = "上传成功";
				$data['filepath'] = $info['file0']['savepath'].$info['file0']['savename'];
				$data['status'] = 1;
				return $data;
			}
		}
		
		
}