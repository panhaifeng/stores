<?php
    namespace Profit\Model;
    use Think\Model\RelationModel;
    class PlanProductionModel extends RelationModel
    {
        //定义主表名称
        Protected $tableName = 'plan_production';
        //自动验证
        protected $_validate = array(
            array('title','require','标题必填！'),
            array('plan_date','require','日期必填！'),
            array('user_id','require','负责人必选！'),
        );

        //定义关联关系
        Protected $_link = array(
            'plan_production_bill' =>array(
                'mapping_type' => self::HAS_MANY,
                'class_name'    =>'plan_production_bill',
                'foreign_key' => 'production_id',
                'mapping_name'=>'plan_production_bill',
            ),
            'plan_forecast' =>array(
                'mapping_type' => self::HAS_MANY,
                'class_name'    =>'plan_forecast',
                'foreign_key' => 'production_id',
                'mapping_name'=>'plan_forecast',
            ),
        );
    }
?>