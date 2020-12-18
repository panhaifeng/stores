<?php
namespace Storehouse\Controller;
use Common\Controller\CommonController;
class ChengpinController extends CommonController {

    /**
     * 库存查询
     * @author xuli
     * 2015-1-27
     */
    public function index(){
        $conditions = I('param.');
        if($conditions['start_time'] != NULL && $conditions['end_time'] != NULL){
            $time[0] = strtotime($conditions['start_time']);
            $time[1] = strtotime($conditions['end_time']);
            $map['dateFasheng'] = array('between',array($time[0],$time[1]));
            $this->start_time = $conditions['start_time'];
            $this->end_time = $conditions['end_time'];

            $arr['start_time'] = $this->start_time;
            $arr['end_time'] = $this->end_time;
        }else{
            //TODO:需优化！太难看了，虽然功能OK了
            if($conditions['time_kind'] !=NULL){

            }else{
                $time[0] = strtotime(date('Y-m-1'));
                $time[1] = strtotime(date("Y-m-d"));
                $map['dateFasheng'] = array('between',array($time[0],$time[1]));
                $this->start_time = date('Y-m-1');
                $this->end_time = date("Y-m-d");

                $arr['start_time'] = $this->start_time;
                $arr['end_time'] = $this->end_time;
            }
        }
        if($conditions['time_kind'] !=NULL){
            $this->time_kind = $conditions['time_kind'];
        }else{
            $this->time_kind = 1;
        }
        $arr['time_kind'] = $this->time_kind;


        if($conditions['key']!=NULL){
            $map['key'] = $conditions['key'];
            $this->key = $map['key'];
        }
        $arr['key'] = $this->key;

        //期初库存
        $initSql = "select 
                    (IFNULL(sum(a.initCnt),0) + IFNULL(sum(a.cntRuku),0) - IFNULL(sum(a.cntChuku),0)) as initKucun,
                    null as cntChuku, 
                    null as cntRuku, 
                    a.proId  
                from (
                    select 
                    null as initCnt,
                    null as cntChuku,
                    sum(x.cntFasheng) as cntRuku,
                    x.proId as proId
                    from ykb_cp_kucun x 
                    where x.kind in ('生产入库','外购入库') and x.dateFasheng<'{$time[0]}' group by x.proId 

                    UNION

                    select 
                    null as initCnt,
                    sum(-x.cntFasheng) as cntChuku,
                    null as cntRuku,
                    x.proId as proId
                    from ykb_cp_kucun x
                    where x.kind = '出库' and x.dateFasheng<'{$time[0]}' group by x.proId
                     ) as a group by a.proId";

        //本期发生
        $bqSql = "
            select 
            null as initKucun,
            sum(a.cntChuku) as cntChuku,
            sum(a.cntRuku) as cntRuku,
            a.proId
            from (
                select 
                null as initKucun,
                null as cntChuku,	
                sum(x.cntFasheng) as cntRuku,	
                x.proId as proId
                from ykb_cp_kucun x 
                where x.kind in ('生产入库','外购入库') and x.dateFasheng>='{$time[0]}' and x.dateFasheng<='{$time[1]}' group by x.proId

                UNION

                select 
                null as initKucun,
                sum(-x.cntFasheng) as cntChuku,
                null as cntRuku,
                x.proId as proId
                from ykb_cp_kucun x 
                where x.kind = '出库' and x.dateFasheng>='{$time[0]}' and x.dateFasheng<='{$time[1]}' group by x.proId
                 ) as a 
                 
                 
             group by a.proId";

        $whereSql = isset($map['key'])?"( p.code like '%{$map['key']}%'
             or p.kind like '%{$map['key']}%'
             or p.name like '%{$map['key']}%'
             or p.norms like '%{$map['key']}%' )":' 1 ';
        //整合SQL
        $sql = "select 
             a.proId,
             round(IFNULL(sum(a.initKucun),0),2) as initKucun,
             round(sum(a.cntRuku),2) as cntRuku,
             round(sum(a.cntChuku),2) as cntChuku,
             round((IFNULL(sum(a.initKucun),0)+IFNULL(sum(a.cntRuku),0)-IFNULL(sum(a.cntChuku),0)),2) as cnt,
             p.code, 
             p.kind, 
             p.name,
             p.color,
             p.norms
             from(
                  $initSql UNION $bqSql 
             ) as a 
             left join ykb_chengpin_product p on a.proId=p.id 
             where a.proId <> 0 and {$whereSql} 
             group by a.proId
             having round((IFNULL(sum(a.initKucun),0)+IFNULL(sum(a.cntRuku),0)-IFNULL(sum(a.cntChuku),0)),2)<>0
             order by a.proId";
        // dump($sql);die;
        $Model = M();
        $rows=$Model->query($sql);


        foreach ($rows as & $row){
            $row['initKucun'] = round($row['initKucun'], 0);
            $row['cntRuku'] = round($row['cntRuku'], 0);
            $row['cntChuku'] = round($row['cntChuku'], 0);
            $row['cnt'] = round($row['cnt'], 0);
        }

        //导出
        if($conditions['export']==1){
            $rowset = array();
            foreach ($rows as $row){
                $rowset[] = array(
                    'code' => $row['code'],
                    'kind' => $row['kind'],
                    'name' => $row['name'],
                    'norms'=> $row['norms'],
                    'color'=> $row['color'],
                    'initKucun'=> $row['initKucun'],
                    'cntRuku'=>$row['cntRuku'],
                    'cntChuku'=>$row['cntChuku'],
                    'cnt'   => $row['cnt'],
                );
            }
            $filename=date('Y-m-d',time()).'成品库存导出';
            $this->exportexcel($rowset,array('成品编码','成品类型','成品名称','成品规格','期初数量','本期入库','本期出库','期末库存'),$filename);
            exit;
        }
        $this->Kucun = $rows;
        $this->arr = $arr;
        $this->display();
    }


}
?>