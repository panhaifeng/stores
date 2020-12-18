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


<style type="text/css"> 
.baseul li a {color:#999999; }
.modal-dialog {
    left: 50%;
    padding-bottom: 30px;
    padding-top: 30px;
    right: auto;
    width: 1000px;
}
</style>
    <div class="row">
  <div class="col-lg-12">
    <div class="widget-container fluid-height clearfix">
      <div class="heading">
        <i class="icon-table"></i>收款管理
        <a class="btn btn-sm btn-primary-outline pull-right" href="<?php echo U('Finance/Collection/add');?>">
          <i class="icon-plus"></i>新增收款
        </a>
         <!--<a data-toggle="modal" class="btn btn-sm btn-primary-outline pull-right"  href="#delAll" title="点击后将会把所有的收款清空">清除所有数据</a>-->
        <a class="btn btn-sm btn-primary-outline pull-right" href="<?php echo U('Finance/Collection/index',$arr+array('export'=>1));?>">
        导出数据</a>
      </div>
      <div class="widget-content padded clearfix">
      <form action="<?php echo U('Finance/Collection/index');?>" class="form-horizontal" method="post">
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
               <select class="form-control" name="collection_type">
                 <option value="">选择项目大类</option>
                 <?php if(is_array($collection)): foreach($collection as $key=>$v): ?><option value="<?php echo ($v['id']); ?>" <?php if($pkind == $v['id']): ?>selected="selected"<?php endif; ?> ><?php echo ($v['collection_name']); ?></option><?php endforeach; endif; ?>
               </select>
              </td>
              <td>
               <select class="form-control" name="collection_type2">
                 <option value="">选择项目子类</option>
                 <?php if(is_array($collection2)): foreach($collection2 as $key=>$v): ?><option value="<?php echo ($v['id']); ?>" <?php if($pkind2 == $v['id']): ?>selected="selected"<?php endif; ?> ><?php echo ($v['collection_name']); ?></option><?php endforeach; endif; ?>
               </select>
              </td>
              <td><input class="form-control"  name="company" type="text" placeholder="客户名称" value="<?php echo ($company); ?>"></td>
              <td><input class="form-control"  name="memo" type="text" placeholder="备注" value="<?php echo ($memo); ?>"></td>
              <td><button type="submit"  class="btn btn-primary sousuo"><i class="icon-search"></i> 搜索</button></td>
            </tr>
          </tbody>
        </table>
      </form>
      </div>
      <div class="widget-content padded clearfix">
        <!-- <table class="table table-bordered table-striped" id="datatable-editable"> -->
        <table class="table table-bordered table-hover">
          <thead>
           <tr>
                <th> 收款单号  </th>
                <th> 收款时间  </th>
                <th> 操作员    </th>
                <th> 客户名称  </th>
                <th> 银行账号  </th>
                <th> 项目类型  </th>
                <th> 收款金额  </th>
                <th> 开票金额  </th>
                <!-- <th> 收款类型  </th>  -->
                <th> 备注          </th>
                <th> 操作          </th>
            </tr>
          </thead>
          <tbody>
            <?php if(is_array($money)): foreach($money as $key=>$v): ?><tr class="trRow">
                <td><?php echo ($v['collection_number']); ?></td>
                <td><?php echo ($v['collection_date']); ?></td>
                <td><?php echo ($v['creator']); ?></td>
                <td><?php echo ($v['clientName']); ?></td>
                <td><?php echo ($v['bankname']); ?></td>
                <td><?php echo ($v['son_name']); ?></td>
                <td><?php echo ($v['collection_money']); ?></td>
                <td><?php echo ($v['kaipiao_money']); ?></td>
                <!-- <td><?php echo ($v['collection_type']); ?></td> -->
                <td><?php echo ($v['memo']); ?></td>
                <td>
                  <?php if($v['edit']!=1): ?><div class="action-buttons">
                    <a class="table-actions" href="<?php echo U('Finance/Collection/edit',array('id'=>$v['id'],'bankid'=>$v['bankid']));?>"><i class="icon-pencil" name="cedit"></i></a>
                    <input name="cval" type="hidden" value="<?php echo ($v['item']); ?>">
                    <a class="table-actions" data-toggle="modal" href="#myModal<?php echo ($v['id']); ?>"><i class="icon-trash" title="删除"></i></a>
                    <?php if($v['isKai'] != 1): ?><a class="table-actions" data-toggle="modal" href="#myModalp<?php echo ($v['id']); ?>"><i class="glyphicon glyphicon-credit-card" title="开票"></i></a><?php endif; ?>
                      <!--删除模态框 -->
                      <div class="modal fade" id="myModal<?php echo ($v['id']); ?>">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button aria-hidden="true" class="close" data-dismiss="modal" type="button">&times;</button>
                              <h4 class="modal-title">
                                   注意！
                              </h4>
                            </div>
                            <div class="modal-body">
                              <p>
                                  确认删除吗?删除后将不可恢复！！！
                              </p>
                            </div>
                            <div class="modal-footer">
                              <a class="btn btn-primary" type="button" href="<?php echo U('Finance/Collection/delect',array('id'=>$v['id'],'mid'=>$v['mid'],'collection_money'=>$v['collection_money']));?>">删除</a>
                              <button class="btn btn-default-outline" data-dismiss="modal" type="button">取消</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- 模态框结束 -->
                       <!--开票模态框 -->
                      <div class="modal fade" id="myModalp<?php echo ($v['id']); ?>">
                        <div class="modal-dialog">
                          <form action="<?php echo U('Finance/Collection/kaipiao');?>" class="form-horizontal" method="post">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button aria-hidden="true" class="close" data-dismiss="modal" type="button">&times;</button>
                              <h4 class="modal-title">
                                   开票
                              </h4>
                            </div>
                            <div class="modal-body">
                              <div class="form-group">
                                <div class="col-md-8">
                                  <div class="input-group">
                                    <input id="kaipiao" name="kaipiao_money" class="form-control" placeholder="开票金额" type="text" value="<?php echo ($v['collection_money']); ?>"><span class="input-group-addon">元</span>
                                    <input id="id" name="id" class="form-control" type="hidden" value="<?php echo ($v['id']); ?>">
                                    <input id="mid" name="mid" class="form-control" type="hidden" value="<?php echo ($v['mid']); ?>">
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button class="btn btn-primary" type="submit">确认</button>
                              <button class="btn btn-default-outline" data-dismiss="modal" type="button">取消</button>
                            </div>
                          </div>
                          </form>
                        </div>
                      </div>
                      <!-- 模态框结束 -->
                  </div>
                </td><?php endif; ?>
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
<div class="modal fade" id="delAll">
  <div class="modal-dialog">
    <div class="modal-content">
    <form action="<?php echo U('Finance/Collection/delAll');?>" class="form-horizontal" method="post">
      <div class="modal-header">
        <button aria-hidden="true" class="close" data-dismiss="modal" type="button">&times;</button>
        <h4 class="modal-title">请输入登录密码</h4>
      </div>
      <div class="modal-body">
            <div  class="widget-content padded">
                 <div class="form-group">
                    <label class="control-label col-md-2">密码</label>
                    <div class="col-md-6">
                        <input class="form-control" name="password" placeholder=密码 type="password">
                    </div>
                  </div>
            </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" type="submit">确定</button><button class="btn btn-default-outline" data-dismiss="modal" type="button">取消</button>
      </div>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript"> 
	//转账登记界面
	$('#transfer_save').click(function(){
		var collection_bankid = $('#collection_bankid').val();
		var payment_bankid = $('#payment_bankid').val();
		if(payment_bankid==collection_bankid){
			alert('转出银行和转入银行不能一致');
			return false;
		}
	})
	$('#transfer_memo').val('内部转账');
/****************************************************************/ 
 	
 	//选择客户双击客户操作 
	function setClient2(id,clientName){
		//将双击项填入表单
		$('#clientName').val(clientName);
		$('#clientName2').val(clientName);
		$('#cid').val(id);
		$('#myModalc').modal('hide');
	}

	//选择供应商双击操作 
	function setSupplier(id,supplierName){
		//将双击项填入表单
		$('#supplierName').val(supplierName);
		$('#supplierName2').val(supplierName);
		$('#sid').val(id);
		$('#myModalS').modal('hide');
	}
	//ajax分页 
	function clients(id){    //test函数名 一定要和action中的第三个参数一致上面有
		$.get('<?php echo U("Client/Client/clientAjax");?>', {'p':id}, function(data){  //用get方法发送信息到TestAction中的test方法
     	var clientsHtml =  $('#clients').html();
     	if(data){ 
    		$('#clients').html("");
			var html = "";
			var clientName = "";
			var id = "";
			
			$.each(data.list,function(){
				clientName = this['company'];
				id = this['id'];
				html += "<tr ondblclick=\"setClient2('"+id+"','"+clientName+"')\" style=\"cursor:pointer;\"><td style='width:700px;'>"+clientName+"</td></tr>";
			});
			$('#page2').html(data.page);
			$("#clients").html(html);
		}
		});
	}
	//ajax分页
	function clientss(id){ 
			var company = $('#clientKey2').val(); 
			$.get('<?php echo U("Client/Client/getClientKey");?>', {'p':id,'company':company}, function(data){  //用get方法发送信息到TestAction中的test方法
	     	var clientsHtml =  $('#clients').html();
	     	if(data){ 
	    		$('#clients').html("");
				var html = "";
				var clientName = "";
				var id = "";
				$.each(data.list,function(){
					clientName = this['company'];
					id = this['id'];
					html += "<tr ondblclick=\"setClient('"+id+"','"+clientName.replace(/<[^>].*?>/g,"")+"')\" style=\"cursor:pointer\"><td style='width:700px;'>"+clientName+"</td></tr>";
				});
				$('#page2').html(data.page);
				$("#clients").html(html);
			}
			});
		 }

	//ajax分页 
	function suppliers(id){    //test函数名 一定要和action中的第三个参数一致上面有
		$.get('<?php echo U("Client/Client/clientAjax");?>', {'p':id}, function(data){  //用get方法发送信息到TestAction中的test方法
     	var clientsHtml =  $('#suppliers').html();
     	if(data){ 
    		$('#suppliers').html("");
			var html = "";
			var clientName = "";
			var id = "";
			
			$.each(data.list,function(){
				clientName = this['supplier_name'];
				id = this['id'];
				html += "<tr ondblclick=\"setClient2('"+id+"','"+clientName+"')\" style=\"cursor:pointer;\"><td style='width:700px;'>"+clientName+"</td></tr>";
			});
			$('#page2').html(data.page);
			$("#suppliers").html(html);
		}
		});
	}

	$(function(e) { 
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

		$('#gysSelect').click(function(){
			$.get('<?php echo U("Supplier/Index/supplierAjax");?>', {'p':1}, function(data){  //用get方法发送信息到TestAction中的test方法
	     	var clientsHtml =  $('#suppliers').html();
	     	if(data){ 
	    		$('#suppliers').html("");
				var html = "";
				var clientName = "";
				var id = "";
				$.each(data.list,function(){
					clientName = this['supplier_name'];
					id = this['id'];
					html += "<tr ondblclick=\"setSupplier('"+id+"','"+clientName+"')\" style=\"cursor:pointer;\"><td style='width:500px;'>"+clientName+"</td></tr>";
				});
				$('#page2').html(data.page);
				$("#suppliers").html(html);
			}
			});
	    })
	    //搜索
		$('#searchSuppliers').click(function(){
	    	var company = $('#supplierKey').val(); 
	       	var field = "id,company"; 
			$.get('<?php echo U("Supplier/Index/getSupplierKey");?>', {'p':1,'company':company}, function(data){ 
		     	if(data){ 
		    		$('#suppliers').html("");
					var html = "";
					var clientName = "";
					var id = "";
					$.each(data.list,function(){
						clientName = this['supplier_name'];
						id = this['id'];
						html += "<tr ondblclick=\"setSupplier('"+id+"','"+clientName.replace(/<[^>].*?>/g,"")+"')\" style=\"cursor:pointer\"><td style='width:700px;'>"+clientName+"</td></tr>";
					});
					$('#page2').html(data.page);
					$("#suppliers").html(html);
				}else{
					$("#suppliers").html(" 您好，没有该供应商，请先新增~");
				}
			})
		})
	});

	$(function(){
		$('.mshow').show();
		$('.mhide').hide();
		if($('#isNew').val()==1){
			$('.sonitem').hide();
		}
		$('[name="item"]').change(function(){
			var parent = $('[name="item"]').val();
			var isCollection = $('[name="isCollection"]').val();
			if(isCollection==1){
				url = '<?php echo U("Finance/Collection/getSonId");?>';
			}else{
				url = '<?php echo U("Finance/Payment/getSonId");?>';
			}
			$.post(url,{'parentId':parent,'isCollection':isCollection},function(res){
				if(res){
					//清空原来的option
					$('[name="son"] option[value!=""]').remove();
					//添加新的option
					var options=[];
					if(res[0].kind==1){
						for(var i=0; res[i];i++){ 
							var temp=res[i];
							options.push("<option value='"+temp.id+"'>"+temp.collection_name+"</option>");
						} 
					}else{
						for(var i=0; res[i];i++){ 
							var temp=res[i];
							options.push("<option value='"+temp.id+"'>"+temp.payment_name+"</option>");
						} 
					}
					var option = options.join('');
					$('[name="son"]').append(option);
					$('.sonitem').show();
				}else{
					//清空原来的option
					$('[name="son"] option[value!=""]').remove();
					$('.sonitem').hide();
				} 
			})
		})
	});
	//新增保存，删除
	$(function(){
		$('.Rowcollect').hide();
		$('.Soncollect').hide();
		$('#addrow2').click(function(){
			$('.Rowcollect').show();
			$('[name="newedit"]').hide();
		});
		$('#rowdelect').click(function(){
			$('.Rowcollect').hide();
			window.location.reload();
		});
		$('.newSon').click(function(){
			$('#addson2').show();
			var id = $(this).find('.id').val();
			var kind = $(this).find('.kind').val();
			var aa = $('#sonpid').val('id');
			if(kind==1){
				var url_new = "<?php echo U('Finance/Collection/getSonId');?>"
			}else{
				var url_new = "<?php echo U('Finance/Payment/getSonId');?>"
			} 
			$.ajax({ 
			     type:"POST", //请求方式
			     url:url_new, //请求路径
			     cache: false,   //(默认: true) 设置为 false 将不缓存此页面。
			     data:"parentId="+id,  //传参
			     dataType: "json",   //返回值类型 
			     success:function(res){ 
			       if(res[0]){
						var id = ""; 
						var collection_code = "";
						var collection_name = "";
						var parentId = "";
						var memo = "";
						var html = ""; 
						var exist = "";
						var sonpid = res[0].parentId;
						var kind = res[0].kind;
						$('.newson').remove();
						$.each(res,function(){ 
							id = this['id']; 
							parentId = this['parentId'];
							$('#sonpid').val(parentId);
							if(kind==1){
								code = this['collection_code']; 
								name = this['collection_name']; 
								var href = "./delectcollection/id/"+id+".html";
							}else{
								code = this['payment_code']; 
								name = this['payment_name']; 
								var href = "./delectpayment/id/"+id+".html";
							}
							parentId = this['parentId']; 
							memo = this['memo']; 
							exist = this['exist'];
							if(exist==0){
								html += "<tr class='newson'><td style='display:none;' id='id"+id+"'><input type='hidden' id='sid' value='"+id+"'/><input type='hidden' id='parentId' value='"+parentId+"'/></td><td id='code"+id+"'>"+code+"<input type='hidden' id='scode' name='scode' value='"+code+"' /></td><td id='name"+id+"'>"+name+"<input type='hidden' id='sname' name='sname' value='"+name+"' /></td><td id='memo"+id+"'>"+memo+"<input type='hidden' id='smemo' name='smemo' value='"+memo+"' /></td><td id='edit"+id+"'>"+
								"<div id='sonedit"+id+"' name='newedit' class='action-buttons'>"+ 
								"<span name='sonedit'><a class='table-actions' href='#'><input type='hidden' id='edidson' value='"+id+"'/><input type='hidden' class='kind' id='kind' value='"+kind+"'/><i class='icon-pencil' title='修改'></i></a></span>"+
			                    "<?php if("+exist+"==0): ?><a class='table-actions' data-toggle='modal' href='#myModal"+id+"'><i class='icon-trash' title='删除'></i></a><?php endif; ?>"+
							    "<div class='modal fade' id='myModal"+id+"'> "+ 
				                "    <div class='modal-dialog'>"+
				                "      <div class='modal-content'>"+
				                "        <div class='modal-header'>"+
				                "          <button aria-hidden='true' class='close' data-dismiss='modal' type='button'>&times;</button>"+
				                "          <h4 class='modal-title'>"+
				                "         	   注意！"+
				                "          </h4>"+
				                "        </div>"+
				                "        <div class='modal-body'>"+ 
				                "          <p>"+
				                "        	  确认删除吗?删除后将不可恢复！！！"+ 
				                "          </p>"+ 
				                "        </div>"+ 
				                "        <div class='modal-footer'>"+
				                "          <a class='btn btn-primary' type='button' href='"+href+"'>删除</a>"+
				                "          <button class='btn btn-default-outline' data-dismiss='modal' type='button'>取消</button>"+ 
				                "        </div>"+
				                "   	</div>"+
				                "    </div>"+
					            "</div>"+
			                    "</div> </td></tr>";
							}else{
								html += "<tr class='newson'><td style='display:none;' id='id"+id+"'><input type='hidden' id='sid' value='"+id+"'/><input type='hidden' id='parentId' value='"+parentId+"'/></td><td id='code"+id+"'>"+code+"<input type='hidden' id='scode' name='scode' value='"+code+"' /></td><td id='name"+id+"'>"+name+"<input type='hidden' id='sname' name='sname' value='"+name+"' /></td><td id='memo"+id+"'>"+memo+"<input type='hidden' id='smemo' name='smemo' value='"+memo+"' /></td><td id='edit"+id+"'>"+
								"<div id='sonedit"+id+"' name='newedit' class='action-buttons'>"+ 
								"<span name='sonedit'><a class='table-actions' href='#'><input type='hidden' id='edidson' value='"+id+"'/><input type='hidden' class='kind' id='kind' value='"+kind+"'/><i class='icon-pencil' title='修改'></i></a></span>"+
			                    "</div> </td></tr>";
							}
							 
						});
						$(".Soncollect").after(html);
						$('#addson2').click(function(){
							$('.Soncollect').show();
							$('[name="newedit"]').hide();
						});
						$('#sondelect').click(function(){
							$('.Soncollect').hide();
							window.location.reload();
						});
						//修改
						$('[name="sonedit"]').click(function(){
							$(this).parents('.newson').siblings('.newson').find('[name="newedit"]').hide();
							$('#addson2').hide();
							var id =$(this).find('#edidson').val();
							var kind =$(this).find('#kind').val();
							var code =$(this).parent().parent().siblings('#code'+id).find('#scode').val();
							var name =$(this).parent().parent().siblings('#name'+id).find('#sname').val();
							var memo =$(this).parent().parent().siblings('#memo'+id).find('#smemo').val();
							var parentId =$(this).parent().parent().siblings('#id'+id).find('#parentId').val();
							$("#code"+id).html("<input type='text' id='collection_codes' name='collection_codes' value='"+code+"'/><input type='hidden' id='snewid' name='snewid' value='"+id+"'/><input type='hidden' id='sparentId' name='sparentId' value='"+parentId+"'/><input type='hidden' id='newkind' name='newkind' value='"+kind+"'/>");
							$("#name"+id).html("<input type='text' name='collection_names' id='collection_names' value='"+name+"'/>");
							$("#memo"+id).html("<input type='text' name='newmemos' id='newmemos' value='"+memo+"'/>");
							$("#edit"+id).html("<button class='btn btn-xs btn-primary' id='button"+id+"' type='button'>保存</button>");
							$("#button"+id).click(function(){
								var collection_code = $("#collection_codes").val();
								var collection_name = $("#collection_names").val();
								var memo = $("#newmemos").val();
								var new_parentId = $("#sparentId").val();
								var new_id = $("#snewid").val();
								var new_kind = $("#newkind").val();
								if(new_kind==1){
									$.post("<?php echo U('Finance/Base/collectionInsert');?>",{id:new_id,collection_code:collection_code,collection_name:collection_name,memo:memo},function(res){
										window.location.reload();
									})
								}else{
									$.post("<?php echo U('Finance/Base/paymentInsert');?>",{id:new_id,payment_code:collection_code,payment_name:collection_name,memo:memo},function(res){
										window.location.reload();
									}) 
								}
							})
						})
			    	} else { 
			    		$('.newson').remove();
						$('#addson2').click(function(){
							$('#sonpid').val(res.parentId);
							$('.Soncollect').show();
						});
						$('#sondelect').click(function(){
							$('.Soncollect').hide();
							window.location.reload();
						});
						
			    	}
			     }
			});
		})
	});
	//修改
	$(function(){
		$('[name="rowedit"]').click(function(){
			$('#addrow2').hide();
			$(this).parents(".newSon").siblings(".newSon").find('[name="newedit"]').hide();
			var id =$(this).find('#editid').val();
			var kind =$(this).find('#kind').val();
			var code =$(this).parent().parent().siblings('#code'+id).find('#code').val();
			var name =$(this).parent().parent().siblings('#name'+id).find('#name').val();
			var memo =$(this).parent().parent().siblings('#memo'+id).find('#memo').val();
			$("#code"+id).html("<input type='text' id='collection_code1' name='collection_code1' value='"+code+"'/><input type='hidden' id='newid' name='newid' value='"+id+"'/><input type='hidden' id='newkind' name='newkind' value='"+kind+"'/>");
			$("#name"+id).html("<input type='text' name='collection_name1' id='collection_name1' value='"+name+"'/>");
			$("#memo"+id).html("<input type='text' name='newmemo' id='newmemo' value='"+memo+"'/>");
			$("#rowedit"+id).html("<button class='btn btn-xs btn-primary' id='button"+id+"' type='button'>保存</button>");
			$("#button"+id).click(function(){ 
				var collection_code = $("#collection_code1").val();
				var collection_name = $("#collection_name1").val();
				var memo = $("#newmemo").val();
				var new_id = $("#newid").val();
				var new_kind = $("#newkind").val();
				if(new_kind==1){
					$.post("<?php echo U('Finance/Base/collectionInsert');?>",{id:new_id,collection_code:collection_code,collection_name:collection_name,memo:memo},function(res){
						window.location.reload();
					})
				}else{
					$.post("<?php echo U('Finance/Base/paymentInsert');?>",{id:new_id,payment_code:collection_code,payment_name:collection_name,memo:memo},function(res){
						window.location.reload();
					})
				}
				
			})
		})
	});
	//付款查询搜索
	$('[name="payment_type"]').change(function(){
		var parent = $('[name="payment_type"]').val();
		var url = '<?php echo U("Finance/Payment/getSonId");?>';
		$.post(url,{'parentId':parent},function(res){
			if(res){
				//清空原来的option
				$('[name="payment_type2"] option[value!=""]').remove();
				//添加新的option
				var options=[];
				if(res[0].kind==1){
					for(var i=0; res[i];i++){ 
						var temp=res[i];
						options.push("<option value='"+temp.id+"'>"+temp.collection_name+"</option>");
					} 
				}else{
					for(var i=0; res[i];i++){ 
						var temp=res[i];
						options.push("<option value='"+temp.id+"'>"+temp.payment_name+"</option>");
					} 
				}
				var option = options.join('');
				$('[name="payment_type2"]').append(option);
			}
		})
	});
	
	
	//账户明细表
	$('.mingxi').click(function(){
		var id = $(this).attr('value');
		var timekind = $(this).attr('timekind');
		var begintime = $(this).attr('begintime');
		var endtime = $(this).attr('endtime');
		//查询该账户明细
		$.post("<?php echo U('Finance/Bankcash/mingxiAjax');?>",{'id':id,'timekind':timekind,'begintime':begintime,'endtime':endtime},function(data){
	/* 		$("#myModaWang input[name='id']").val(id);
			$("input[name='user_name']").val(data.user_name);
			$("input[name='user_id']").val(data.user_id);
			$("input[name='real_name']").val(data.real_name);
			$("input[name='telephone']").val(data.telephone);
			$("input[name='email']").val(data.email);
			$("select[name='bid'] option[value='"+data.bid+"']").prop('selected','selected');
			$("select[name='isattend'] option[value='"+data.isattend+"']").prop('selected','selected');
			var groups = [];
			$.each(data.group, function(i, item){ 
				$("select[name='position[]'] option[value='"+item.group_id+"']").attr('selected','selected');
				groups.push(item.group_id);
			});
			$(".select2able").val(groups).trigger("change"); */
			
			$('#mingxi').html("");
			var html = " <tr><th>时间 </th><th>项目类型 </th><th> 客户/供应商名称 </th><th>收入</th><th>支出</th><th>备注</th></tr>";
			var clientName = "";
			var date = "";
			var son_name = "";
			var expense = "";
			var income = "";
			var memo = "";
			var moneyIncom=data.moneyIncome;
			var moneyExpense=data.moneyExpense;
			$.each(data.list,function(i, item){
				clientName=item.clientName ?  item.clientName : '';
				date=item.date ? item.date : '';
				son_name=item.son_name ?  item.son_name : '';
				expense=item.expense ?  item.expense : '';
				income=item.income ?  item.income : '';
				memo=item.memo ?  item.memo : '';
				html += "<tr><td>"+date+"</td><td>"+son_name+"</td><td>"+clientName+"</td><td>"+income+"</td><td>"+expense+"</td><td>"+memo+"</td></tr>";
			});
			html += "<tr><th>合计 </th><th></th><th></th><th>"+moneyIncom+"</th><th>"+moneyExpense+"</th><th></th></tr>"; 
			$("#mingxi").html(html);
		})
		$('#myModaWang').modal();
	});
	
	
	//收款查询搜索
	$('[name="collection_type"]').change(function(){
		var parent = $('[name="collection_type"]').val();
		var url = '<?php echo U("Finance/Collection/getSonId");?>';
		$.post(url,{'parentId':parent},function(res){
			if(res){
				//清空原来的option
				$('[name="collection_type2"] option[value!=""]').remove();
				//添加新的option
				var options=[];
				if(res[0].kind==1){
					for(var i=0; res[i];i++){ 
						var temp=res[i];
						options.push("<option value='"+temp.id+"'>"+temp.collection_name+"</option>");
					} 
				}else{
					for(var i=0; res[i];i++){ 
						var temp=res[i];
						options.push("<option value='"+temp.id+"'>"+temp.payment_name+"</option>");
					} 
				}
				var option = options.join('');
				$('[name="collection_type2"]').append(option);
			}
		})
	});
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
</script>  
	</div>
	<div class="foot-space"></div>
	<div class="footer">
		<div class="pull-left" style="font-size:12px; margin-left:30px;"><span><a href="http://www.eqinfo.com.cn" target="_blank">易奇科技</a> 版权所有 © 2007-<?php echo date('Y');?></span></div>
	</div>
  </body>
</html>