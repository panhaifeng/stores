<?php
    namespace Profit\Model;
    use Think\Model\RelationModel;
    class PlanProductionBillModel extends RelationModel
    {
        //定义主表名称
        Protected $tableName = 'plan_production_bill';
        //自动验证
        protected $_validate = array(
            array('production_id','require','关联计划必填！'),
            array('cpid','require','管理成品必填！'),
            array('num','require','计划数量必填！'),
        );

        //定义关联关系
        Protected $_link = array(
            'plan_production' =>array(
                'mapping_type' => self::BELONGS_TO,
                'class_name'    =>'plan_production',
                'foreign_key' => 'production_id',
                'mapping_name'=>'plan_production',
            ),
            'chengpin_product' =>array(
                'mapping_type' => self::BELONGS_TO,
                'class_name'    =>'chengpin_product',
                'foreign_key' => 'cpid',
                'mapping_name'=>'chengpin_product',
            ),
        );
    }
?>