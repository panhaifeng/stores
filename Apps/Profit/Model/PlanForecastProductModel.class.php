<?php
    namespace Profit\Model;
    use Think\Model\RelationModel;
    class PlanForecastProductModel extends RelationModel
    {
        //定义主表名称
        Protected $tableName = 'plan_forecast_product';
        //自动验证
        protected $_validate = array(
            array('num','require','数量必填！'),
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
            'plan_forecast' =>array(
                'mapping_type' => self::BELONGS_TO,
                'class_name'    =>'plan_forecast',
                'foreign_key' => 'forecast_id',
                'mapping_name'=>'plan_forecast',
            ),
            'product' =>array(
                'mapping_type' => self::BELONGS_TO,
                'class_name'    =>'product',
                'foreign_key' => 'product_id',
                'mapping_name'=>'product',
            ),

        );
    }
?>
