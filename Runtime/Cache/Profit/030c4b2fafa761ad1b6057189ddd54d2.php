<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
	<head>
	<meta charset="utf-8" />
	<title><?php echo C('SYSTEM_INFO');?></title>
	<meta name="description" content="易奇软件" />
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
    <link href="/kangpin/Public/css/fonts-useso-com.css" media="all" rel="stylesheet" type="text/css" />
    <link href="/kangpin/Public/css/bootstrap.min.css" media="all" rel="stylesheet" type="text/css" />
	<link href="/kangpin/Public/css/font-awesome.css" media="all" rel="stylesheet" type="text/css" />
	<link href="/kangpin/Public/css/se7en-font.css" media="all" rel="stylesheet" type="text/css" />
	<link href="/kangpin/Public/css/isotope.css" media="all" rel="stylesheet" type="text/css" />
	<link href="/kangpin/Public/css/jquery.fancybox.css" media="all" rel="stylesheet" type="text/css" />
	<link href="/kangpin/Public/css/fullcalendar.css" media="all" rel="stylesheet" type="text/css" />
	<link href="/kangpin/Public/css/wizard.css" media="all" rel="stylesheet" type="text/css" />
	<link href="/kangpin/Public/css/select2.css" media="all" rel="stylesheet" type="text/css" />
	<link href="/kangpin/Public/css/morris.css" media="all" rel="stylesheet" type="text/css" />
	<link href="/kangpin/Public/css/datatables.css" media="all" rel="stylesheet" type="text/css" />
	<link href="/kangpin/Public/css/datepicker.css" media="all" rel="stylesheet" type="text/css" />
	<link href="/kangpin/Public/css/timepicker.css" media="all" rel="stylesheet" type="text/css" />
	<link href="/kangpin/Public/css/colorpicker.css" media="all" rel="stylesheet" type="text/css" />
	<link href="/kangpin/Public/css/bootstrap-switch.css" media="all" rel="stylesheet" type="text/css" />
	<link href="/kangpin/Public/css/daterange-picker.css" media="all" rel="stylesheet" type="text/css" />
	<link href="/kangpin/Public/css/typeahead.css" media="all" rel="stylesheet" type="text/css" />
	<link href="/kangpin/Public/css/summernote.css" media="all" rel="stylesheet" type="text/css" />
	<link href="/kangpin/Public/css/pygments.css" media="all" rel="stylesheet" type="text/css" />
	<link href="/kangpin/Public/css/style.css" media="all" rel="stylesheet" type="text/css" />
	<link href="/kangpin/Public/css/color/green.css" media="all" rel="alternate stylesheet" title="green-theme" type="text/css" />
	<link href="/kangpin/Public/css/color/orange.css" media="all" rel="alternate stylesheet" title="orange-theme" type="text/css" />
	<link href="/kangpin/Public/css/color/magenta.css" media="all" rel="alternate stylesheet" title="magenta-theme" type="text/css" />
	<link href="/kangpin/Public/css/color/gray.css" media="all" rel="alternate stylesheet" title="gray-theme" type="text/css" />
	<link href="/kangpin/Public/css/extra.css" type="text/css" />
	<link href="/kangpin/Public/css/sweet-alert.css" rel="stylesheet" type="text/css">
  	<link type="favicon" rel="shortcut icon" href="/kangpin/Public/favicon.ico" />
	<!-- 财务基础资料导航栏设置 -->
	<style type="text/css"> 
	.baseul a {color:#999999;}  
 	.baseul a:hover {color:#007aff;} 
 	.baseli {list-style:none} 
	.cache{
	position:absolute;
	left:0px; top:15px; padding:8px 14px;
	}
	.aaaa{
	position:absolute;
	right:0px; top:15px; padding:8px 14px;
	}
	.paymentul a {color:#999999;}  
 	.paymentul a:hover {color:#007aff;} 
 	.paymentli {list-style:none} 
	</style>
	

  </head>
  <body>
    <div class="modal-shiftfix"> 
      <!-- Navigation -->
      <div class="navbar navbar-fixed-top scroll-hide">
        
        <div class="container-fluid main-nav clearfix">
          <div class="nav-collapse">
            <ul class="nav">
             <div class="cache pull-right">
                  <a href="<?php echo U('Cache/Cache/clearCacheInfo');?>">清除缓存</a> 
             </div>
             <!--  <li class="dropdown"><a href="<?php echo U('Memorandum/Index/index');?>">  
                <span aria-hidden="true" class="se7en-forms"></span>订单<b class="caret"></b></a>  
              </li>  --> 
              <li>
                <a href="/kangpin/"><span aria-hidden="true" class="se7en-home"></span>首页</a>
              </li>
                <li>
                    <a href="<?php echo U('Storehouse/Index/kucunSafeReport');?>"><span aria-hidden="true" class="se7en-star"></span>库存警戒消息</a>
                </li>
                <li class="dropdown"><a data-toggle="dropdown" href="#">
                <span aria-hidden="true" class="se7en-home"></span>仓库<b class="caret"></b></a> 	
                <ul class="dropdown-menu"> 
                  <li><a href="<?php echo U('Cangku/Ruku/index');?>"><p>入库管理</p></a></li>
                  <li><a href="<?php echo U('Profit/Plan/index');?>"><p>采购计划</p></a></li>
                  <li><a href="<?php echo U('Storehouse/Index/index');?>"><p>原料仓库</p></a></li> 
                  <li><a href="<?php echo U('Storehouse/Chengpin/index');?>"><p>成品仓库</p></a></li> 
                </ul>
              </li> 
              <li class="dropdown"><a data-toggle="dropdown" href="#">
                <span aria-hidden="true" class="se7en-forms"></span>运营<b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    <li><a href="<?php echo U('Profit/Index/index');?>"><p>利润表</p></a></li>
                    <!--<li><a href="<?php echo U('Profit/Product/index');?>"><p>原料供应表</p></a></li>-->
                  </ul>
              </li>
              <li class="dropdown"><a data-toggle="dropdown" href="#">  
                <span aria-hidden="true" class="se7en-tables"></span>财务<b class="caret"></b></a> 
                <ul class="dropdown-menu"> 
                 <!--  <li><a href="<?php echo U('Finance/Cpost/index');?>"><p>过账管理</p></a></li>   -->
                  <li><a href="<?php echo U('Finance/Collection/index');?>"><p>收款管理</p></a></li>  
                  <li><a href="<?php echo U('Finance/Payment/index');?>"><p>付款管理</p></a></li>  
                  <li><a href="<?php echo U('Finance/Bank/index');?>">内部转账</a></li> 
                  <li><a href="<?php echo U('Finance/Cash/index');?>"><p>现金日报表</p></a></li>  
                  <li><a href="<?php echo U('Finance/Bankcash/index');?>"><p>账户余额表</p></a></li>  
                  <li><a href="<?php echo U('Storehouse/Index/YlReport');?>"><p>原料库存</p></a></li>  
                  <li><a href="<?php echo U('Finance/YfGz/index');?>"><p>原料应付</p></a></li>  
                  <li class="basenav"><a data-toggle="dropdown" href="#">基础资料</a>  
                    <ul class="baseul"> 
                      <li class="baseli"><a href="<?php echo U('Finance/Base/bank');?>"><p class="col-md-12" style="margin-left:-30%;font-size:10px;">银行账户管理</p></a></li>  
	                  <li class="baseli"><a href="<?php echo U('Finance/Base/collection');?>"><p class="col-md-12" style="margin-left:-30%;font-size:10px;">收款项目管理</p></a></li>  
	                  <li class="baseli"><a href="<?php echo U('Finance/Base/payment');?>"><p class="col-md-12" style="margin-left:-30%;font-size:10px;">付款项目管理</p></a></li> 
                    </ul> 
                  </li> 
                </ul> 
              </li>  
              <li class="dropdown"><a data-toggle="dropdown" href="#">  
                <span aria-hidden="true" class="se7en-flag"></span>售后<b class="caret"></b></a>  
                <ul class="dropdown-menu"> 
                  <!-- <li><a href="<?php echo U('Profit/Aftersale/index');?>"><p>售后服务</p></a></li> 
                  <li><a href="<?php echo U('Profit/Review/index');?>"><p>售后服务审核</p></a></li> --> 
                  <li><a href="<?php echo U('Profit/Aftersales/index');?>"><p>售后服务</p></a></li>
                  <li><a href="<?php echo U('Profit/Aftersales/secPage');?>"><p>运营处理</p></a></li>
                  <li><a href="<?php echo U('Profit/Aftersales/thirdPage');?>"><p>品控处理</p></a></li>
                 <!--  <li><a href="<?php echo U('Profit/Aftersales/fourthPage');?>"><p>运营审核</p></a></li> -->
                  <li><a href="<?php echo U('Profit/Aftersales/report');?>"><p>售后报表</p></a></li>
                </ul>
              </li> 
              <li class="dropdown"><a data-toggle="dropdown" href="#"> 
              	<span aria-hidden="true" class="se7en-pages"></span>基础<b class="caret"></b></a> 
              	 <ul class="dropdown-menu"> 
              	  <li><a href="<?php echo U('Auth/Index/index');?>"><p>权限设置</p></a></li> 
                  <?php if($_SESSION[C('ADMIN_AUTH_KEY')] == true): ?><!-- <li><a href="<?php echo U('Tool/Index/index');?>"><p>工具入口</p></a></li>  --><?php endif; ?>
              	  <li class="basenav"><a data-toggle="dropdown" href="#"> 
                                        基础资料</a>  
                  <ul class="baseul"> 
              	    <li class="baseli"><a href="<?php echo U('Client/Client/indexClient');?>"><p class="col-md-12" style="margin-left:-34%;font-size:10px;">客户档案</p></a></li>  
                    <li class="baseli"><a href="<?php echo U('Supplier/Index/index');?>"><p class="col-md-12" style="margin-left:-34%;font-size:10px;">供应商档案</p></a></li> 
                    <li class="baseli"><a href="<?php echo U('Baseinfo/Product/index');?>"><p class="col-md-12" style="margin-left:-34%;font-size:10px;">原料档案</p></a></li>
                    <li class="baseli"><a href="<?php echo U('Baseinfo/Chengpin/index');?>"><p class="col-md-12" style="margin-left:-34%;font-size:10px;">成品档案</p></a></li> 
                  </ul> 
                </ul> 	
              </li> 
              <div class="aaaa pull-right">
              <li class="dropdown user hidden-xs"><a data-toggle="dropdown" id="userinfo" class="dropdown-toggle" href="#">
               <?php echo ($_SESSION['real_name']); ?><b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="JavaScript:;">
                    <i class="icon-user"></i>个人中心</a>
                  </li>
                  <li><a href="<?php echo U('Auth/User/resetPassword');?>">
                    <i class="icon-gear"></i>修改密码</a>
                  </li>
                  <li><a href="<?php echo U('Home/Login/logout');?>">
                    <i class="icon-signout"></i>退出登录</a> 
                  </li>
                </ul>
              </li>
              </div>
             <!--  <li class="dropdown"><a data-toggle="dropdown" href="#">  
                <span aria-hidden="true" class="icon-cog"></span>系统设置<b class="caret"></b></a>
                <ul class="dropdown-menu"> 
                  
                  <li>
                    <a href="<?php echo U('Baseinfo/BaseInfo/baseActiontype');?>">数据字典</a> 
                  </li> 
                </ul>
              </li> -->
            <!--   <li class="dropdown"><a data-toggle="dropdown" href="#">
                <span aria-hidden="true" class="se7en-feed"></span>办公<b class="caret"></b></a>
                 <ul class="dropdown-menu">
                  <li><a href="<?php echo U('Notice/Notice/indexNotice');?>"><p>公告</p></a></li> 
                </ul>
              </li> -->

               <!-- <div class="cache pull-right">
               		<a href="<?php echo U('Cache/Cache/clearCacheInfo');?>" class="btn btn-primary">清除缓存</a> 
               </div> -->
            </ul> 
          </div>
          
        </div>
       
      </div>
      <!-- End Navigation -->
		

		
    <script src="/kangpin/Public/js/jquery-1.10.2.min.js" type="text/javascript"></script>
    <script src="/kangpin/Public/js/jquery-ui.js" type="text/javascript"></script>
    <script src="/kangpin/Public/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="/kangpin/Public/js/raphael.min.js" type="text/javascript"></script>
	<script src="/kangpin/Public/js/selectivizr-min.js" type="text/javascript"></script>
	<script src="/kangpin/Public/js/jquery.mousewheel.js" type="text/javascript"></script>
	<script src="/kangpin/Public/js/jquery.vmap.min.js" type="text/javascript"></script>
	<script src="/kangpin/Public/js/jquery.vmap.sampledata.js" type="text/javascript"></script>
	<script src="/kangpin/Public/js/jquery.vmap.world.js" type="text/javascript"></script>
	<script src="/kangpin/Public/js/jquery.bootstrap.wizard.js" type="text/javascript"></script>
	<script src="/kangpin/Public/js/fullcalendar.min.js" type="text/javascript"></script>
	<script src="/kangpin/Public/js/gcal.js" type="text/javascript"></script>
	<script src="/kangpin/Public/js/jquery.dataTables.min.js" type="text/javascript"></script>
	<script src="/kangpin/Public/js/datatable-editable.js" type="text/javascript"></script>
	<script src="/kangpin/Public/js/jquery.easy-pie-chart.js" type="text/javascript"></script>
	<script src="/kangpin/Public/js/excanvas.min.js" type="text/javascript"></script>
	<script src="/kangpin/Public/js/jquery.isotope.min.js" type="text/javascript"></script>
	<script src="/kangpin/Public/js/isotope_extras.js" type="text/javascript"></script>
	<script src="/kangpin/Public/js/modernizr.custom.js" type="text/javascript"></script>
	<script src="/kangpin/Public/js/jquery.fancybox.pack.js" type="text/javascript"></script>
	<script src="/kangpin/Public/js/select2.js" type="text/javascript"></script>
	<script src="/kangpin/Public/js/styleswitcher.js" type="text/javascript"></script>
	<script src="/kangpin/Public/js/wysiwyg.js" type="text/javascript"></script>
	<script src="/kangpin/Public/js/summernote.min.js" type="text/javascript"></script>
	<script src="/kangpin/Public/js/jquery.inputmask.min.js" type="text/javascript"></script>
	<script src="/kangpin/Public/js/jquery.validate.js" type="text/javascript"></script>
	<script src="/kangpin/Public/js/bootstrap-fileupload.js" type="text/javascript"></script>
	<script src="/kangpin/Public/js/bootstrap-datepicker.js" type="text/javascript"></script>
	<script src="/kangpin/Public/js/bootstrap-timepicker.js" type="text/javascript"></script>
	<script src="/kangpin/Public/js/bootstrap-colorpicker.js" type="text/javascript"></script>
	<script src="/kangpin/Public/js/bootstrap-switch.min.js" type="text/javascript"></script>
	<script src="/kangpin/Public/js/typeahead.js" type="text/javascript"></script>
	<script src="/kangpin/Public/js/daterange-picker.js" type="text/javascript"></script>
	<script src="/kangpin/Public/js/date.js" type="text/javascript"></script>
	<script src="/kangpin/Public/js/morris.min.js" type="text/javascript"></script>
	<script src="/kangpin/Public/js/skycons.js" type="text/javascript"></script>
	<script src="/kangpin/Public/js/fitvids.js" type="text/javascript"></script>
	<script src="/kangpin/Public/js/jquery.sparkline.min.js" type="text/javascript"></script>
	<script src="/kangpin/Public/js/main.js" type="text/javascript"></script> 
	<script src="/kangpin/Public/js/respond.js" type="text/javascript"></script>
	<script src="/kangpin/Public/js/sweet-alert.min.js"></script>
	<script type="text/javascript">
	//财务基础档案导航栏
	$(function(){
		$('.baseul').hide();
		$('.basenav').bind('mouseover',function(){
			$('.baseul').show();
		}).bind('mouseout',function(){
			$('.baseul').hide();
		});
		$('.paymentul').hide();
		$('.paymentnav').bind('mouseover',function(){
			$('.paymentul').show();
		}).bind('mouseout',function(){
			$('.paymentul').hide();
		}) 
	}) 
	</script> 



    <style>
    .datepicker.datepicker-dropdown.dropdown-menu{
        z-index: 1900!important;
    }
</style>
<div class="row">
  <div class="col-lg-12">
    <div class="widget-container fluid-height clearfix">
      <div class="heading">
        <i class="icon-table"></i><a class="btn-primary" href="<?php echo U('Profit/Plan/index');?>" style="padding:4px;border-radius:3px">生产计划查询</a>

        <a class="btn btn-sm btn-primary-outline pull-right" href="<?php echo U('Profit/Plan/add');?>">
          <i class="icon-plus"></i><span>新增</span>
        </a>

        <a class="btn btn-sm btn-primary-outline pull-right" data-toggle="modal" href="#import_plan"><i class="icon-inbox"></i>导入</a>
      </div>
      <div class="widget-content padded clearfix normalSearch">
      <form action="<?php echo U('Profit/Plan/index');?>" class="form-horizontal" method="get">
          <table class="tab search">
              <tbody>
              <tr>
                  <td>
                      <select class="form-control" tabindex="1" name="time_kind" id="time_kind" onchange=dateChange(this.value)>
                          <option value="0" <?php if($time_kind==0): ?>selected="selected"<?php endif; ?>>全部</option>
                          <option value="1" <?php if($time_kind==1): ?>selected="selected"<?php endif; ?>>本月</option>
                          <option value="2" <?php if($time_kind==2): ?>selected="selected"<?php endif; ?>>上月</option>
                          <option value="3" <?php if($time_kind==3): ?>selected="selected"<?php endif; ?>>本年</option>
                      </select>
                  </td>
                  <td>
                      <input class="form-control" data-date-autoclose="true" data-date-format="yyyy-mm-dd" id="dpd1" name="start_time" placeholder="开始时间" type="text" value="<?php echo ($start_time); ?>">
                  </td>
                  <td>
                      <input class="form-control" data-date-autoclose="true" data-date-format="yyyy-mm-dd" id="dpd2" name="end_time" placeholder="结束时间" type="text" value="<?php echo ($end_time); ?>">
                  </td>
                  <td>
                      <input class="form-control" id="title" name="title" placeholder="关键词检索:标题" type="text" value="<?php echo ($title); ?>">
                  </td>
                  <td>
                      <button type="submit"  class="btn btn-primary sousuo"><i class="icon-search"></i> 搜索</button>
                  </td>
              </tr>
              </tbody>
          </table>
      </form>
      </div>
      <div class="widget-content padded clearfix rowsData">
        <!-- <table class="table table-bordered table-striped" id="datatable-editable"> -->
        <table class="table table-bordered table-striped">
         <thead>
            <th> 标题      </th>
            <th> 计划编号      </th>
            <th> 计划时间      </th>
            <th> 负责人      </th>
            <th> 创建时间      </th>
            <th> 所需成品      </th>
            <th> 采购预测     </th>
            <th> 备注      </th>
            <th> 操作          </th>
          </thead>
          <tbody>
            <?php if(is_array($Plans)): foreach($Plans as $key=>$v): ?><tr>
                <td><?php echo ($v['title']); ?></td>
                <td><?php echo ($v['plan_code']); ?></td>
                <td><?php echo ($v['plan_date']); ?></td>
                <td><?php echo ($v['creator']); ?></td>
                <td><?php echo ($v['ctime']); ?></td>
                <td><a href="javascript:;" class="billDetail" data-id="<?php echo ($v['id']); ?>"  data-title="<?php echo ($v['title']); ?>">明细(<?php echo count($v['plan_production_bill']);?>)</a></td>
                <td>
                    <?php if($v['forecast'] != 0): ?><a href="javascript:;" class="forecastDetail" data-id="<?php echo ($v['id']); ?>" data-title="<?php echo ($v['title']); ?>">预测明细(<?php echo ($v['forecast']); ?>)</a>
                        <i class="icon-none">|</i>
                        <a href="javascript:;" class="productDetail" data-id="<?php echo ($v['id']); ?>" data-fid="<?php echo ($v['lastForecastId']); ?>" data-title="<?php echo ($v['title']); ?>">所需原料(<?php echo ($v['productes']); ?>)</a>
                        <i class="icon-none">|</i>
                        <a href="<?php echo U('Profit/Plan/exportForecastProduct', array('id'=>$v['id'], 'fid'=>$v['lastForecastId']));?>" class="exportForecastProduct" data-id="<?php echo ($v['id']); ?>"><span>导出原料信息</span></a>
                        <i class="icon-none">|</i>
                        <a href="<?php echo U('Profit/Plan/exportForecast', array('id'=>$v['id'], 'fid'=>$v['lastForecastId']));?>" class="exportForecast" data-id="<?php echo ($v['id']); ?>"><span>导出采购计划</span></a>
                    <?php else: ?>
                        <a href="javascript:;" class="buildForecast" data-id="<?php echo ($v['id']); ?>">创建采购计划</a><?php endif; ?>
                </td>
                <td><?php echo ($v['memo']); ?></td>
                <td>
                    <?php if($v['edit']!=1): ?><div class="action-buttons">
                            <a class="table-actions" href="<?php echo U('Profit/Plan/edit',array('id'=>$v['id'],'p'=>$nowPage,'title'=>$title,'start_time'=>$start_time,'end_time'=>$end_time,'t_kind'=>$time_kind));?>"><i class="icon-pencil"></i></a>
                            <a class="table-actions" data-toggle="modal" href="#" onclick = "deleteData(<?php echo ($v['id']); ?>,'<?php echo U('Profit/Plan/delete');?>')"><i class="icon-trash"></i></a>
                        </div><?php endif; ?>
                </td>
              </tr><?php endforeach; endif; ?>
          </tbody>
        </table>
        <span>
            <?php echo ($page); ?>
        </span>
      </div>
    </div>
  </div>
</div>

<!-- 明细模态框 -->
<div class="modal fade " id="forecastLogModal" >
    <div class="modal-dialog  modal-lg" style="width:1000px;">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" class="close" data-dismiss="modal" type="button">&times;</button>
                <h4 class="modal-title">
                    <span class="modalTitle"></span>预测记录明细
                    <span class="pull-right">
                <span id="spanInfo"></span>
            </span>
                </h4>
            </div>
            <div class="modal-body" style="min-height:500px;">
                <!-- blank-->
            </div>
        </div>
    </div>
</div>
<!-- 成品生产清单-->
<div class="modal fade " id="billModal" >
    <div class="modal-dialog  modal-lg" style="width:1000px;">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" class="close" data-dismiss="modal" type="button">&times;</button>
                <h4 class="modal-title">
                    <span class="modalTitle"></span>生产计划-成品清单
                    <span class="pull-right">
                <span id="spanInfo"></span>
            </span>
                </h4>
            </div>
            <div class="modal-body" style="min-height:500px;">
                <!-- blank-->
            </div>
        </div>
    </div>
</div>

<!-- 原料清单-->
<div class="modal fade " id="productModal" >
    <div class="modal-dialog  modal-lg" style="width:1000px;">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" class="close" data-dismiss="modal" type="button">&times;</button>
                <h4 class="modal-title">
                    <span class="modalTitle"></span>生产计划-原料清单
                    <span class="pull-right">
                <span id="spanInfo"></span>
            </span>
                </h4>
            </div>
            <div class="modal-body" style="min-height:500px;">
                <!-- blank-->
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="import_plan">
    <div class="modal-dialog">
        <form id="formImport" name="formImport" class="form-horizontal">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" class="close" data-dismiss="modal" type="button">&times;</button>
                    <h4 class="modal-title">生产计划导入</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label col-md-2" for="importTitle">标题</label>
                        <div class="col-md-8">
                            <input id="importTitle" name="title" class="form-control"  type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2" for="importDate">时间</label>
                        <div class="col-md-8">
                            <div class="input-group date datepicker" data-date-autoclose="true" data-date-format="yyyy-mm-dd">
                                <input id="importDate" name="plan_date" class="form-control" type="text">
                                <span class="input-group-addon"><i class="icon-calendar"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2" for="importMemo">备注</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" name="memo" rows="2" id="importMemo"></textarea>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label class="control-label col-md-2" for="plan_date">文件</label>
                        <div class="col-md-10">
                            <div class="fileupload fileupload-new" data-provides="fileupload"><input type="hidden" value="" name="">
                                <div class="input-group">
                                    <div class="form-control">
                                        <i class="icon-file fileupload-exists"></i><span class="fileupload-preview"></span>
                                    </div>
                                    <div class="input-group-btn">
                                        <a class="btn btn-default fileupload-exists" data-dismiss="fileupload" href="#">移除</a><span class="btn btn-default btn-file"><span class="fileupload-new">选择文件</span><span class="fileupload-exists">更改</span><input type="file" name="fileToUpload" id="fileToUpload"  multiple="multiple"/></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group hide" id="progress">
                        <div class="col-md-12">
                            <div class="progress progress-striped active" id="progress_line">
                                <div class="progress-bar progress-bar-success" id="percent" style="width: 0%"><input id="judge" type="hidden" value="chengpin"/></div>
                            </div>
                            <p id="msg"></p>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <a class="btn btn-info" id="download" href="/kangpin/Public/download/生产计划导入模板.xls" target="_blank">下载模板</a>
                    <button class="btn btn-primary" id="import" type="button">上传</button>
                    <button class="btn btn-success" data-dismiss="modal" type="button" >完成</button>
                </div>
        </form>
    </div>
</div>

<script type="text/javascript">
function deleteData(id,url,type) {
	swal({
		  title: "确定要删除吗？",
		  text: "删除后不可恢复！",
		  type: "error",
		  showCancelButton: true,
		  confirmButtonColor: "#DD6B55",
		  confirmButtonText: "删除"
		},
		function(){
			 $.post(url,{'id':id,'type':type},function(data){
					if(data){
						location.reload();
					}else{
						alert('删除失败！');
					}
				})
		});
};
//新增时，锁定负责人选项
$('#sltUid').change(function(){
	$('[name="uid"]').val($(this).val());
});
//种菜额或种菜费用率改变 种菜费用和利润改变
$('#zcMoney,#zcRate').change(function(){
	var zcMoney = $('#zcMoney').val();
	var zcRate = $('#zcRate').val();
	var zcFeiyong = parseFloat(zcMoney*zcRate).toFixed(2);
	$('#zcFeiyong').val(zcFeiyong);
	$('#zcFeiyongShow').text("种菜费用："+zcFeiyong+"");

	getProfitMoney();
});

//选择客户双击客户操作 
function setClient2(id,clientName){
	//将双击项填入表单
	$('#clientName').val(clientName);
	$('#clientName2').val(clientName);
	$('#cid').val(id);
	$('#myModalc').modal('hide');
}

//改变利润
$('#realMoney,#refund,#tgFeiyong,#rate,#ptRate,#ptFeiyong,#proCost,#qtFeiyong').change(function(){
	var realMoney = $('#realMoney').val();
	var refund = $('#refund').val();		//退款额

	//固定费用
	var gdFeiyong = parseFloat((realMoney-refund)*13.8/100).toFixed(3);
	$('#gdFeiyong').val(gdFeiyong);

	
	//平台费用
	var ptRate = $('#ptRate').val();
	var ptFeiyong = parseFloat((realMoney-refund)*ptRate).toFixed(2);
	$('#ptFeiyongShow').text("平台费用："+ptFeiyong+"");
	$('#ptFeiyong').val(ptFeiyong);
	getProfitMoney();
});

function getProfitMoney(){
	var realMoney = $('#realMoney').val(); //销售额
	var refund = $('#refund').val();		//退款额
	var zcFeiyong = $('#zcFeiyong').val(); //种菜费用
	var gdFeiyong = $('#gdFeiyong').val(); //固定费用
	var ptFeiyong = $('#ptFeiyong').val(); //平台费用
	var proCost = $('#proCost').val(); //产品成本

	var tgFeiyong = $('#tgFeiyong').val(); //推广费用
	var qtFeiyong = $('#qtFeiyong').val();  //其他费用
	var rate = $('#rate').val();
	var profitMoney = parseFloat(realMoney-refund-zcFeiyong-gdFeiyong-ptFeiyong-tgFeiyong-proCost-qtFeiyong).toFixed(2);
	$('#profitMoney').val(profitMoney);
}

function dateChange(value){
		var date = new Date();
		var year = parseInt(date.getFullYear());
		var month = parseInt(date.getMonth())+1;
		var last = new Date(year,month,0).getDate();
		if(value==1){
			var start_time = year+"-"+month+"-"+1;
			var end_time = year+"-"+month+"-"+last;
			$('#dpd1').val(start_time);
			$('#dpd2').val(end_time);
		}else if(value==2){
			if(month==1){ 
				var year = year - 1;
				var month = 12;
				var last = new Date(year,12,0).getDate();
				var start_time = year+"-"+month+"-"+1;
				var end_time = year+"-"+month+"-"+last;
				$('#dpd1').val(start_time);
				$('#dpd2').val(end_time);
			}else{
				var month = month - 1;
				var last = new Date(year,month,0).getDate();
				var start_time = year+"-"+month+"-"+1;
				var end_time = year+"-"+month+"-"+last;
				$('#dpd1').val(start_time);
				$('#dpd2').val(end_time);
			}
		}else if(value==3){
			var start_time = year+"-"+1+"-"+1;
			var end_time = year+"-"+12+"-"+last;
			$('#dpd1').val(start_time);
			$('#dpd2').val(end_time);
		}else{
			$('#dpd1').val('');
			$('#dpd2').val('');
		};
	} 
	// 售后服务必填字段
	$(function(){
		$('#aftersale').validate({
	        errorElement: 'span',
	        errorClass: 'help-block',
	        focusInvalid: false,
	        rules: {
	            store: 'required',
	            uid:'required',
	            date:'required',
	            orderId:'required',
	            saleID:'required',
	            saleProblem:'required',
	            handleMessuares:'required'
	        },
	        highlight: function(e) {
	            $(e).closest('.form-group').removeClass('has-info').addClass('has-error');
	        },
	    });

	    $('#aftersales').validate({
	        errorElement: 'span',
	        errorClass: 'help-block',
	        focusInvalid: false,
	        rules: {
	            store: 'required',
	            uid:'required',
	            date:'required',
	            orderId:'required',
	            saleID:'required',
	            saleProblem:'required',
	            handleMessuares:'required'
	        },
	        highlight: function(e) {
	            $(e).closest('.form-group').removeClass('has-info').addClass('has-error');
	        },
	    });

	    $('#aftersalesThird').validate({
	        errorElement: 'span',
	        errorClass: 'help-block',
	        focusInvalid: false,
	        rules: {
	            confirmQc: 'required',
	        },
	        highlight: function(e) {
	            $(e).closest('.form-group').removeClass('has-info').addClass('has-error');
	        },
	    });

	    $('#clientSelect').click(function(){
			$.get('<?php echo U("Client/Client/clientAjax");?>', {'p':1}, function(data){  //用get方法发送信息到TestAction中的test方法
	     	var clientsHtml =  $('#clients').html();
	     	if(data){ 
	    		$('#clients').html("");
				var html = "";
				var clientName = "";
				var id = "";
				
				$.each(data.list,function(){
					clientName = this['company'];
					id = this['id'];
					html += "<tr ondblclick=\"setClient2('"+id+"','"+clientName+"')\" style=\"cursor:pointer;\"><td style='width:500px;'>"+clientName+"</td></tr>";
				});
				$('#page2').html(data.page);
				$("#clients").html(html);
			}
			});
	    })

	    	//搜索
		$('#searchList2').click(function(){
		    	var company = $('#clientKey2').val(); 
		       	var field = "id,company"; 
				$.get('<?php echo U("Client/Client/getClientKey");?>', {'p':1,'company':company}, function(data){  //用get方法发送信息到TestAction中的test方法
			     	if(data){ 
			    		$('#clients').html("");
						var html = "";
						var clientName = "";
						var id = "";
						$.each(data.list,function(){
							clientName = this['company'];
							id = this['id'];
							html += "<tr ondblclick=\"setClient2('"+id+"','"+clientName.replace(/<[^>].*?>/g,"")+"')\" style=\"cursor:pointer\"><td style='width:700px;'>"+clientName+"</td></tr>";
						});
						$('#page2').html(data.page);
						$("#clients").html(html);
				}else{
					$("#clients").html(" 您好，没有该客户，请先新增~");
				}
			})
		})
	});
</script>
<script type="text/javascript">
    $(function(){
        // 生产计划详情
        $('a.billDetail').click(function(){
            var $this = $(this)
                ,url = "<?php echo U('Profit/Plan/showBill');?>"
                ,param = {};
            param.id = $this.data('id');
            param.title = $this.data('title');

            var $myModal = $('#billModal');
            // 填充标题栏的数据
            $myModal.find('#spanInfo').text(param.title);

            // 请求明细数据
            $.get(url, param, function(data){
                var content = '<h3> 未获得数据 </h3>';
                if(data){
                    content =  data;
                }
                $myModal.find('.modal-body').html(content);
                $myModal.find('.memo').tooltip();
            }, 'html');
            $myModal.modal();
        });

        // 所需原料明细
        $('a.productDetail').click(function(){
            var $this = $(this)
                ,url = "<?php echo U('Profit/Plan/showForecastProduct');?>"
                ,param = {};
            param.id = $this.data('id');
            param.fid = $this.data('fid');
            param.title = $this.data('title');

            var $myModal = $('#productModal');
            // 填充标题栏的数据
            $myModal.find('#spanInfo').text(param.title);

            // 请求明细数据
            $.get(url, param, function(data){
                var content = '<h3> 未获得数据 </h3>';
                if(data){
                    content =  data;
                }
                $myModal.find('.modal-body').html(content);
                $myModal.find('.memo').tooltip();
            }, 'html');
            $myModal.modal();
        });

        // 采购计划详情
        $('a.forecastDetail').click(function(){
            var $this = $(this)
                ,url = "<?php echo U('Profit/Plan/showForecastedLog');?>"
                ,param = {};
            param.id = $this.data('id');
            param.title = $this.data('title');

            var $myModal = $('#forecastLogModal');
            // 填充标题栏的数据
            $myModal.find('#spanInfo').text(param.title);

            // 请求明细数据
            $.get(url, param, function(data){
                var content = '<h3> 未获得数据 </h3>';
                if(data){
                    content =  data;
                }
                $myModal.find('.modal-body').html(content);
                $myModal.find('.memo').tooltip();
            }, 'html');
            $myModal.modal();
        });



        // 创建采购计划
        $('a.buildForecast').click(function(){
            var $this = $(this)
                ,url = "<?php echo U('Profit/Plan/buildForecast');?>"
                ,param ={};

            param.id = $this.data('id');

            $.post(url, param, function(data){
                if(data.status == '1') {
                    window.location.href = window.location.href;
                }else{
                    alert(data.msg);
                }
            })
        });

        // 导出采购计划

        // 导入生产计划
        $('#import').click(function(){
            $("#formImport").submit();
        });
        $('#formImport').submit(function(){
            var formdata = new FormData();
            var fileObj = document.getElementById("fileToUpload").files;
            for (var i = 0; i < fileObj.length; i++)
                formdata.append("file" + i, fileObj[i]);
            $.ajax({
                type: 'POST',
                url: "<?php echo U('Client/Client/upload');?>",
                data: formdata,
                /**
                 *必须false才会自动加上正确的Content-Type
                 */
                contentType: false,
                /**
                 * 必须false才会避开jQuery对 formdata 的默认处理
                 * XMLHttpRequest会对 formdata 进行正确的处理
                 */
                processData: false
            }).then(function (data) {
                if(data.status){
                    swal({
                            title: data.msg,
                            text: "点击确定开始导入数据",
                            type: "success",
                            showCancelButton: false,
                            confirmButtonText: '导入'
                        },
                        function(){
                            //重置进度条
                            $('#progress').removeClass('hide');
                            //开始导入
                            send(data.filepath);
                        })
                }else{
                    swal({
                        title: "操作失败！",
                        text: data.msg,
                        type: "error",
                        showCancelButton: false,
                        confirmButtonColor: '#DD6B55',
                        confirmButtonText: '确定'
                    })
                }
            }, function () {
                //failCal
            });
            return false;
        });
        function send(path){
            var percent = document.getElementById("percent");
            var msg = document.getElementById("msg");
            var title = $("#importTitle").val();
            var memo = $("#importMemo").val();
            var date = $("#importDate").val();
            var xhr = new window.XMLHttpRequest();
            if(!window.XMLHttpRequest){
                try {
                    xhr = new window.ActiveXObject("Microsoft.XMLHTTP");
                } catch(e) {}
            }
            var filepath = encodeURIComponent(path);
            var url = "/kangpin/Profit/Plan/import";

            var params = 'file=' + filepath;
                params+= '&title=' + title;
                params+= '&memo=' + memo;
                params+= '&date=' + date;

            xhr.open("post",url);
            xhr.onreadystatechange = function(){
                if(xhr.readyState > 2){
                    var data = xhr.responseText.substr(0,xhr.responseText.length-1);
                    data = data.split("~");
                    var progress = data.pop();
                    var info = progress.substr(1,progress.length-2).split("-");
                    var width = Math.round(info[0]/info[1]*100)+"%"
                    msg.innerHTML = info[2]+width;
                    percent.style.width = width;
                }
                if(xhr.readyState == 4){
                    msg.innerHTML = "导入完成！……100%";
                }
            }
            xhr.setRequestHeader("CONTENT-TYPE","application/x-www-form-urlencoded");
            xhr.send(params);
        }
    });
</script>
<script type="text/javascript">
function deleteData(id,url,type) {
	swal({
		  title: "确定要删除吗？",
		  text: "删除后不可恢复！",
		  type: "error",
		  showCancelButton: true,
		  confirmButtonColor: "#DD6B55",
		  confirmButtonText: "删除"
		},
		function(){
			 $.post(url,{'id':id,'type':type},function(data){
					if(data){
						location.reload();
					}else{
						alert('删除失败！');
					}
				})
		});
};
//新增时，锁定负责人选项
$('#sltUid').change(function(){
	$('[name="uid"]').val($(this).val());
});
//种菜额或种菜费用率改变 种菜费用和利润改变
$('#zcMoney,#zcRate').change(function(){
	var zcMoney = $('#zcMoney').val();
	var zcRate = $('#zcRate').val();
	var zcFeiyong = parseFloat(zcMoney*zcRate).toFixed(2);
	$('#zcFeiyong').val(zcFeiyong);
	$('#zcFeiyongShow').text("种菜费用："+zcFeiyong+"");

	getProfitMoney();
});

//选择客户双击客户操作 
function setClient2(id,clientName){
	//将双击项填入表单
	$('#clientName').val(clientName);
	$('#clientName2').val(clientName);
	$('#cid').val(id);
	$('#myModalc').modal('hide');
}

//改变利润
$('#realMoney,#refund,#tgFeiyong,#rate,#ptRate,#ptFeiyong,#proCost,#qtFeiyong').change(function(){
	var realMoney = $('#realMoney').val();
	var refund = $('#refund').val();		//退款额

	//固定费用
	var gdFeiyong = parseFloat((realMoney-refund)*13.8/100).toFixed(3);
	$('#gdFeiyong').val(gdFeiyong);

	
	//平台费用
	var ptRate = $('#ptRate').val();
	var ptFeiyong = parseFloat((realMoney-refund)*ptRate).toFixed(2);
	$('#ptFeiyongShow').text("平台费用："+ptFeiyong+"");
	$('#ptFeiyong').val(ptFeiyong);
	getProfitMoney();
});

function getProfitMoney(){
	var realMoney = $('#realMoney').val(); //销售额
	var refund = $('#refund').val();		//退款额
	var zcFeiyong = $('#zcFeiyong').val(); //种菜费用
	var gdFeiyong = $('#gdFeiyong').val(); //固定费用
	var ptFeiyong = $('#ptFeiyong').val(); //平台费用
	var proCost = $('#proCost').val(); //产品成本

	var tgFeiyong = $('#tgFeiyong').val(); //推广费用
	var qtFeiyong = $('#qtFeiyong').val();  //其他费用
	var rate = $('#rate').val();
	var profitMoney = parseFloat(realMoney-refund-zcFeiyong-gdFeiyong-ptFeiyong-tgFeiyong-proCost-qtFeiyong).toFixed(2);
	$('#profitMoney').val(profitMoney);
}

function dateChange(value){
		var date = new Date();
		var year = parseInt(date.getFullYear());
		var month = parseInt(date.getMonth())+1;
		var last = new Date(year,month,0).getDate();
		if(value==1){
			var start_time = year+"-"+month+"-"+1;
			var end_time = year+"-"+month+"-"+last;
			$('#dpd1').val(start_time);
			$('#dpd2').val(end_time);
		}else if(value==2){
			if(month==1){ 
				var year = year - 1;
				var month = 12;
				var last = new Date(year,12,0).getDate();
				var start_time = year+"-"+month+"-"+1;
				var end_time = year+"-"+month+"-"+last;
				$('#dpd1').val(start_time);
				$('#dpd2').val(end_time);
			}else{
				var month = month - 1;
				var last = new Date(year,month,0).getDate();
				var start_time = year+"-"+month+"-"+1;
				var end_time = year+"-"+month+"-"+last;
				$('#dpd1').val(start_time);
				$('#dpd2').val(end_time);
			}
		}else if(value==3){
			var start_time = year+"-"+1+"-"+1;
			var end_time = year+"-"+12+"-"+last;
			$('#dpd1').val(start_time);
			$('#dpd2').val(end_time);
		}else{
			$('#dpd1').val('');
			$('#dpd2').val('');
		};
	} 
	// 售后服务必填字段
	$(function(){
		$('#aftersale').validate({
	        errorElement: 'span',
	        errorClass: 'help-block',
	        focusInvalid: false,
	        rules: {
	            store: 'required',
	            uid:'required',
	            date:'required',
	            orderId:'required',
	            saleID:'required',
	            saleProblem:'required',
	            handleMessuares:'required'
	        },
	        highlight: function(e) {
	            $(e).closest('.form-group').removeClass('has-info').addClass('has-error');
	        },
	    });

	    $('#aftersales').validate({
	        errorElement: 'span',
	        errorClass: 'help-block',
	        focusInvalid: false,
	        rules: {
	            store: 'required',
	            uid:'required',
	            date:'required',
	            orderId:'required',
	            saleID:'required',
	            saleProblem:'required',
	            handleMessuares:'required'
	        },
	        highlight: function(e) {
	            $(e).closest('.form-group').removeClass('has-info').addClass('has-error');
	        },
	    });

	    $('#aftersalesThird').validate({
	        errorElement: 'span',
	        errorClass: 'help-block',
	        focusInvalid: false,
	        rules: {
	            confirmQc: 'required',
	        },
	        highlight: function(e) {
	            $(e).closest('.form-group').removeClass('has-info').addClass('has-error');
	        },
	    });

	    $('#clientSelect').click(function(){
			$.get('<?php echo U("Client/Client/clientAjax");?>', {'p':1}, function(data){  //用get方法发送信息到TestAction中的test方法
	     	var clientsHtml =  $('#clients').html();
	     	if(data){ 
	    		$('#clients').html("");
				var html = "";
				var clientName = "";
				var id = "";
				
				$.each(data.list,function(){
					clientName = this['company'];
					id = this['id'];
					html += "<tr ondblclick=\"setClient2('"+id+"','"+clientName+"')\" style=\"cursor:pointer;\"><td style='width:500px;'>"+clientName+"</td></tr>";
				});
				$('#page2').html(data.page);
				$("#clients").html(html);
			}
			});
	    })

	    	//搜索
		$('#searchList2').click(function(){
		    	var company = $('#clientKey2').val(); 
		       	var field = "id,company"; 
				$.get('<?php echo U("Client/Client/getClientKey");?>', {'p':1,'company':company}, function(data){  //用get方法发送信息到TestAction中的test方法
			     	if(data){ 
			    		$('#clients').html("");
						var html = "";
						var clientName = "";
						var id = "";
						$.each(data.list,function(){
							clientName = this['company'];
							id = this['id'];
							html += "<tr ondblclick=\"setClient2('"+id+"','"+clientName.replace(/<[^>].*?>/g,"")+"')\" style=\"cursor:pointer\"><td style='width:700px;'>"+clientName+"</td></tr>";
						});
						$('#page2').html(data.page);
						$("#clients").html(html);
				}else{
					$("#clients").html(" 您好，没有该客户，请先新增~");
				}
			})
		})
	});
</script>
	</div>
	<div class="foot-space"></div>
	<div class="footer">
		<div class="pull-left" style="font-size:12px; margin-left:30px;"><span><a href="http://www.eqinfo.com.cn" target="_blank">易奇科技</a> 版权所有 © 2007-<?php echo date('Y');?></span></div>
	</div>
  </body>
</html>