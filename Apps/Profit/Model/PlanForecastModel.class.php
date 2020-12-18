<?php
    namespace Profit\Model;
    use Think\Model\RelationModel;
    class PlanForecastModel extends RelationModel
    {
        //定义主表名称
        Protected $tableName = 'plan_forecast';
        //自动验证
        protected $_validate = array(
            array('date','require','日期必填！'),
            array('user_id','require','负责人必选！'),
        );

        //定义关联关系
        Protected $_link = array(
            'plan_production' =>array(
                'mapping_type' => self::BELONGS_TO,
                'class_name'    =>'plan_production',
                'foreign_key' => 'production_id',
                'mapping_name'=>'plan_production',
            ),
            'plan_forecast_product' =>array(
                'mapping_type' => self::HAS_MANY,
                'class_name'    =>'plan_forecast_product',
                'foreign_key' => 'forecast_id',
                'mapping_name'=>'plan_forecast_product',
            ),
            'plan_forecast_bill' =>array(
                'mapping_type' => self::HAS_MANY,
                'class_name'    =>'plan_forecast_bill',
                'foreign_key' => 'forecast_id',
                'mapping_name'=>'plan_forecast_bill',
            ),
        );
    }
?>
