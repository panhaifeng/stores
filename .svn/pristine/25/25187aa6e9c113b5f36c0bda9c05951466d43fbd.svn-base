<?php
namespace Cache\Controller;
use Common\Controller\CommonController;
class CacheController extends CommonController {

	/**
	 * 清除缓存
	 * @author zhangyan
	 * @2015-01-26
	 */
	Public function cleanCache(){
			//光删除runtime_file还不够，要清空一下Data文件夹中的文件；代码如下：
			$datadir=RUNTIME_PATH."/Data/";   //Data文件的路径；
			$dh = opendir($datadir);
			if ($dh) {     //打开Data文件夹；
				while (($file = readdir($dh)) !== false) {    //遍历Data目录，
					unlink($datadir.$file);                //删除遍历到的每一个文件；
				}
				closedir($dh);
			}
			return true;
		}
		/**
		 * 清空全部缓存信息
		 * @caibin
		 * @2014-05-09
		 */
		public function clearCacheInfo(){
			header("Content-type: text/html; charset=utf-8");
			$cachedirs = array('./Runtime/Cache/');
			//dump($dirs);die;
			@mkdir('Runtime',0777,true);
			foreach($cachedirs as $value) {
				$this->rmdirr($value);
			}
			$this->success('缓存清除成功');
		}
		/**
		 * 清空缓存文件操作
		 * @param unknown $dirname
		 * @return boolean
		 */
		public function rmdirr($dirname) {
			if (!file_exists($dirname)) {
				return false;
			}
			if (is_file($dirname) || is_link($dirname)) {
				return unlink($dirname);
			}
			$dir = dir($dirname);
			if($dir){
				while (false !== $entry = $dir->read()) {
					if ($entry == '.' || $entry == '..') {
						continue;
					}
					//递归
					$this->rmdirr($dirname . DIRECTORY_SEPARATOR . $entry);
				}
			}
			$dir->close();
			return rmdir($dirname);
		}


}