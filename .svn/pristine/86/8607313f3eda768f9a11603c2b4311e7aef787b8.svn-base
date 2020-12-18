<?php
    namespace Profit\Model;
    use Think\Model\RelationModel;
    class ProductModel extends RelationModel
    {
        //定义主表名称
        Protected $tableName = 'base_product';

        /**
         * 编号自动生成
         * @param $head 开头  $tblName 表名   $fieldName 字符名
         */
        Public function _getCode($head,$tblName,$fieldName) {
            $map[$fieldName] = array('like',$head.'%');
            $row = M($tblName)->where($map)->field($fieldName)->order($fieldName.' desc')->select();
            $init = $head.'0001';
            if(empty($row[0][$fieldName])) return $init;
            if($init>$row[0][$fieldName]) return $init;
            //自增1
            $max = substr($row[0][$fieldName],-4);
            $pre = substr($row[0][$fieldName],0,-4);
            return $pre .substr(10001+$max,1);
        }
    }