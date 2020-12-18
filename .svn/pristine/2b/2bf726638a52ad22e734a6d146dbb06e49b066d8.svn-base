<?php
namespace Base\Controller;
use Think\Controller;
class ImportController extends Controller { 
		/**
		 * 初始化
		 * @caibin
		 * @2014-11-03
		 */
		Public function _initialize(){ 
			
		}
		/**
		 * 读取EXCEL文件，返回读取数组
		 * @蔡斌
		 * @2015-01-14
		 */
		public function import($filepath){
			Vendor("PHPExcel.PHPExcel.IOFactory");
			//设定缓存模式为经gzip压缩后存入cache（还有多种方式请百度）
			$cacheMethod = \PHPExcel_CachedObjectStorageFactory::cache_in_memory_gzip;
			$cacheSettings = array();
			\PHPExcel_Settings::setCacheStorageMethod($cacheMethod,$cacheSettings);
			$objPHPExcel = new \PHPExcel();
			//读入上传文件
			$objPHPExcel = \PHPExcel_IOFactory::load($filepath);
			//内容转换为数组
			$indata = $objPHPExcel->getActiveSheet()->toArray();
			unset($indata[0]);
			return $indata;
		}
}