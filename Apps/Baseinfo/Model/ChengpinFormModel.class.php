<?php
namespace Baseinfo\Model;
use Think\Model\RelationModel;
class ChengpinFormModel extends RelationModel
{
    //定义主表名称
    Protected $tableName = 'chengpin_form';

    //定义关联关系
    Protected $_link = array(
        'Chengpin' =>array(
            'mapping_type' => self::BELONGS_TO,
            'class_name'    =>'Chengpin',
            'foreign_key' => 'pid',
            'mapping_name'=>'chenpin',
        ),
        'Product'  =>array(
            'mapping_type' => self::BELONGS_TO,
            'class_name'    =>'Product',
            'foreign_key' => 'productId',
            'mapping_name'=>'product',
        )
    );
}
?>