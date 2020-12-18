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
.ruku_remove { margin-left:1%;} 
.chuku_remove { margin-left:1%;} 
</style>
    
<div class="container-fluid main-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="widget-container fluid-height clearfix">
                <div class="heading">
                    <i class="icon-reorder"></i>添加入库
                </div>
                <div class="widget-content padded">
                    <form action="<?php echo U('Storehouse/Ruku/addInsert');?>" id="validate-form" method="post" class="form-horizontal">
                            <div class="form-group">
                                <label class="control-label col-md-1 col-md-offset-1" for="ruku_code">入库编号</label>
                                <div class="col-md-2">
                                    <input id="ruku_code" name="ruku_code" readonly="readonly" class="form-control" placeholder="系统自动生成" type="text" value="<?php echo ($Ruku['ruku_code']); ?>">
                                </div>
                                <label class="control-label col-md-1" for="creator">操作人</label>
                                <div class="col-md-2">
                                    <input id="creator" name="creator" class="form-control" readonly="readonly"  placeholder="系统自动生成" type="text" value="<?php echo ($creator); ?>">
                                </div>
                                <label class="control-label col-md-1" for="ruku_date">入库时间</label>
                                <div class="col-md-2">
                                    <div class="input-group date datepicker" data-date-autoclose="true" data-date-format="yyyy-mm-dd">
                                      <input id="ruku_date" name="ruku_date" class="form-control" type="text" value="<?php echo ($date); ?>">
                                      <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                    </div>
                                </div>
                                <!--<label class="control-label col-md-1">供应商名称</label> 	-->
                                <!--<div class="col-xs-6 col-sm-2"> -->
                                  <!--<div class="input-group"> -->
                                    <!--<input class="form-control" type="text" id="supplier_name" name="supplier_name" value="<?php echo ($Ruku['supplier_name']); ?>"><span class="input-group-btn"><a id="supplierSelect" class="btn btn-default" type="button" data-toggle="modal" href="#myModal">请选择</a></span></input>-->
                                    <!--<input type="hidden" id="sid" name="sid" value="<?php echo ($Ruku['sid']); ?>"> -->
                                  <!--</div> -->
                                <!--</div> -->
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2" for="rukuKind">入库类型</label>
                                <div class="col-md-2">
                                    <select class="form-control" tabindex="1" name="rukuKind" id="rukuKind">
                                        <option value="原料入库" <?php if($rukuKind==原料入库): ?>selected="selected"<?php endif; ?>>原料入库</option>
                                        <option value="原料退回" <?php if($rukuKind==原料退回): ?>selected="selected"<?php endif; ?>>原料退回</option>
                                    </select>
                                </div>
                              <!--   <div class="col-md-2">
                                    <input id="rukuKind" name="rukuKind" class="form-control" readonly="readonly"  type="text" value="原料入库">
                                </div> -->
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-2">备注</label>
                                <div class="col-xs-6 col-sm-8">
                                    <textarea class="form-control" name="memo" rows="2"></textarea>
                                </div>
                            </div>
                            <div class="heading">
                                <i class="icon-reorder"></i>添加明细&nbsp;&nbsp;&nbsp;<a href="javascript:;" class="addproduct"><i class="icon-plus"></i></a>
                            </div>
                            <div class="head" style="margin-top:-1%;">
                                <div class="form-group">
                                    <label class="control-label col-md-3" style="margin-left:2%;">产品编码</label>
                                    <label class="control-label col-md-2">产品名称</label>
                                    <label class="control-label col-md-2">产品型号</label>
                                    <label class="control-label col-md-2">入库数量</label>
                                </div>
                            </div>
                            <div class="contact">
                            <div class="form-group product" style="margin-bottom:5px;">
                                <label class="control-label col-md-2"></label>
                                <div class="col-sm-2">
                                  <div class="input-group">
                                    <input class="form-control" type="text" id="product_code" value="<?php echo ($Product['product_code']); ?>"><span class="input-group-btn"><a id="productSelect" class="btn btn-default productSelect" type="button" data-toggle="modal" href="#myModalc">请选择</a></span></input>
                                    <input type="hidden" id="productId" name="productId[]" value="<?php echo ($Ruku['sid']); ?>">
                                    <input type="hidden" id="price" name="price[]" value="">
                                    <input type="hidden" id="money" name="money[]" value="">
                                    <input type="hidden" id="supplierId" name="supplierId[]" value="">
                                  </div>
                                </div>
                                <div class="col-sm-2">
                                    <input class="form-control" type="text" id="product_name" value="<?php echo ($Product['product_name']); ?>">
                                </div>
                                <div class="col-sm-2">
                                    <input class="form-control" type="text" id="product_norms" value="<?php echo ($Product['product_norms']); ?>">
                                </div>
                                <div class="col-sm-2">
                                    <input class="form-control" type="text" name="cnt[]" value="<?php echo ($Ruku['cnt']); ?>">
                                </div>
                            </div>
                            <div class="form-group product" style="margin-bottom:5px;">
                                <a class="ruku_remove btn btn-sm btn-primary-outline pull-left" style="position:absolute;z-index:99;margin-left:5%;" href="javascript:;">
                                  <i class="icon-minus"></i>删除明细
                                </a>
                                <label class="control-label col-md-2"></label>
                                <div class="col-sm-2">
                                  <div class="input-group">
                                    <input class="form-control" type="text" id="product_code" value="<?php echo ($Product['product_code']); ?>"><span class="input-group-btn"><a id="productSelect" class="btn btn-default productSelect" type="button" data-toggle="modal" href="#myModalc">请选择</a></span></input>
                                    <input type="hidden" id="productId" name="productId[]" value="<?php echo ($Ruku['sid']); ?>">
                                    <input type="hidden" id="price" name="price[]" value="">
                                    <input type="hidden" id="money" name="money[]" value="">
                                    <input type="hidden" id="supplierId" name="supplierId[]" value="">
                                  </div>
                                </div>
                                <div class="col-sm-2">
                                    <input class="form-control" type="text" id="product_name" value="<?php echo ($Product['product_name']); ?>">
                                </div>
                                <div class="col-sm-2">
                                    <input class="form-control" type="text" id="product_norms" value="<?php echo ($Product['product_norms']); ?>">
                                </div>
                                <div class="col-sm-2">
                                    <input class="form-control" type="text" name="cnt[]" value="<?php echo ($Ruku['cnt']); ?>">
                                </div>
                            </div>
                            <div class="form-group product" style="margin-bottom:5px;">
                                <a class="ruku_remove btn btn-sm btn-primary-outline pull-left" style="position:absolute;z-index:99;margin-left:5%;" href="javascript:;">
                                  <i class="icon-minus"></i>删除明细
                                </a>
                                <label class="control-label col-md-2"></label>
                                <div class="col-sm-2">
                                  <div class="input-group">
                                    <input class="form-control" type="text" id="product_code" v
                                    alue="<?php echo ($Product['product_code']); ?>"><span class="input-group-btn"><a id="productSelect" class="btn btn-default productSelect" type="button" data-toggle="modal" href="#myModalc">请选择</a></span></input>
                                    <input type="hidden" id="productId" name="productId[]" value="<?php echo ($Ruku['sid']); ?>">
                                    <input type="hidden" id="price" name="price[]" value="">
                                    <input type="hidden" id="money" name="money[]" value="">
                                    <input type="hidden" id="supplierId" name="supplierId[]" value="">
                                  </div>
                                </div>
                                <div class="col-sm-2">
                                    <input class="form-control" type="text" id="product_name" value="<?php echo ($Product['product_name']); ?>">
                                </div>
                                <div class="col-sm-2">
                                    <input class="form-control" type="text" id="product_norms" value="<?php echo ($Product['product_norms']); ?>">
                                </div>
                                <div class="col-sm-2">
                                    <input class="form-control" type="text" name="cnt[]" value="<?php echo ($Ruku['cnt']); ?>">
                                </div>
                            </div>
                            </div>
                            <div id="contactDiv"></div>
                            <hr>
                            <div class="form-group">
                                <label class="control-label col-md-3"></label>
                                <div class="col-xs-9 col-md-2">
                                    <button class="btn btn-primary" type="submit">保存</button>
                                </div>
                            </div>
                            </form>
                            <div class="contact2 product">
                                <div class="form-group" style="margin-bottom:5px;">
                                    <a class="ruku_remove btn btn-sm btn-primary-outline pull-left" style="position:absolute;z-index:99;margin-left:5%;" href="javascript:;">
                                      <i class="icon-minus"></i>删除明细
                                    </a>
                                    <label class="control-label col-md-2"></label>
                                    <div class="col-sm-2">
                                      <div class="input-group">
                                        <input class="form-control" type="text" id="product_code" value="<?php echo ($Product['product_code']); ?>"><span class="input-group-btn"><a id="productSelect" class="btn btn-default productSelect" type="button" data-toggle="modal" href="#myModalc">请选择</a></span></input>
                                        <input type="hidden" id="productId" name="productId[]" value="<?php echo ($Ruku['sid']); ?>">
                                        <input type="hidden" id="price" name="price[]" value="">
                                        <input type="hidden" id="money" name="money[]" value="">
                                        <input type="hidden" id="supplierId" name="supplierId[]" value="">
                                      </div>
                                    </div>
                                    <div class="col-sm-2" >
                                        <input class="form-control" type="text" id="product_name" value="<?php echo ($Product['product_name']); ?>">
                                    </div>
                                    <div class="col-sm-2">
                                        <input class="form-control" type="text" id="product_norms" value="<?php echo ($Product['product_norms']); ?>">
                                    </div>
                                    <div class="col-sm-2">
                                        <input class="form-control" type="text" name="cnt[]" value="<?php echo ($Ruku['cnt']); ?>">
                                    </div>
                                </div>
                            </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- 供应商选择  -->
<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button aria-hidden="true" class="close" data-dismiss="modal" type="button">&times;</button>
        <h4 class="modal-title">
            供应商选择
        </h4>
      </div>
      <div id="supplierList">
        <div class="form-group">
          <div class="modal-body">
            <div class="col-md-5">
              <div class="input-group">
                <input id="supplierKey" class="form-control" type="text" placeholder="供应商名称"><span class="input-group-btn"><button id="searchList" class="btn btn-default" type="button">搜索</button></span></input>
              </div>
            </div>
            <table class="table table-striped ">
              <tbody id="supplier"></tbody>
            </table>
            <div class="pull-right" id="page"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- 产品选择  -->
<div class="modal fade" id="myModalc">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button aria-hidden="true" class="close" data-dismiss="modal" type="button">&times;</button>
        <h4 class="modal-title">
            产品选择
        </h4>
      </div>
      <div id="productList">
        <div class="form-group">
          <div class="modal-body">
            <div class="col-md-5">
              <div class="input-group">
                <input id="productKey" class="form-control" type="text" placeholder="产品名称"><span class="input-group-btn"><button id="searchList2" class="btn btn-default" type="button">搜索</button></span></input>
              </div>
            </div>
            <table class="table table-striped ">
              <tbody id="product"></tbody>
            </table>
            <div class="pull-right" id="page2"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
    //原料入库登记界面
    $(function(){
        $('.contact2').hide();
        //添加明细
        $('.addproduct').click(function(){
            _trModel = $('.contact2').eq(0).clone(true);
                $('input,select',_trModel).val('');
            $('#contactDiv').append(_trModel.clone(true));
            $('#contactDiv').find('.contact2').show();
        });
        $('.ruku_remove').click(function(){
            $(this).parents('.product').remove();
        });

        //自动计算金额
        $("[name='cnt[]']").change(function(){
            var cnt = $(this).val();
            var price = $(this).parents('.form-group').find("[name='price[]']").val();
            if(price==""){
                return false;
            }
            var money = $(this).parents('.form-group').find("[name='money[]']");
            var m = parseFloat((parseFloat(cnt)*parseFloat(price)).toFixed(2));//js格式化数字并保留两位小数
            money.val(m);
        });
        
        //自动计算金额
        $("[name='price[]']").change(function(){
            var price = $(this).val();
            var cnt = $(this).parents('.form-group').find("[name='cnt[]']").val();
            if(cnt==""){
                return false;
            }
            var money = $(this).parents('.form-group').find("[name='money[]']");
            var m = parseFloat((parseFloat(cnt)*parseFloat(price)).toFixed(2));//js格式化数字并保留两位小数
            money.val(m);
        });
        //判断是否填写了数量和金额
        $("[name='money[]']").change(function(){
            var cnt = $(this).parents('.form-group').find("[name='cnt[]']").val();
            var price = $(this).parents('.form-group').find("[name='price[]']").val();
            if(cnt==""||price==""){
                return false;
            }
        })
    });

    var renderProductTable = function(page, isInit){
        if(isInit){
            $('#productKey').val('');
        }
        var name = $('#productKey').val(),
            page = page?page:1;
        $.get('<?php echo U("Storehouse/Ruku/getProductKey");?>', {'p':page,'name':name}, function(data) {  //用get方法发送信息到TestAction中的test方法
            var html = '', pageHtml='';
            if (data && data.list.length>0) {
                $('#product').html("");
                var name = "";
                var id = "";
                var code = "";
                var norms = "";
                var price = "";
                var supplierId = "";

                $.each(data.list, function () {
                    name = this['name'];
                    id = this['id'];
                    code = this['code'];
                    norms = this['norms'];
                    price = this['danjia']+0;
                    supplierId = this['supplierId'];
                    html += "<tr ondblclick=\"setProduct('" + id + "','" + name.replace(/<[^>].*?>/g, "") + "','" + code + "','" + norms + "','"+price+"','"+supplierId+"')\" style=\"cursor:pointer\"><td style='width:200px;'>" + code + "</td><td style='width:200px;'>" + name + "</td><td style='width:200px;'>" + norms + "</td></tr>";
                });
                pageHtml = data.page;
            } else {
                pageHtml = "";
                html =" 您好，没有该产品，请先新增~";
            }
            $('#page2').html(pageHtml);
            $("#product").html(html);
        });
    };
    //选择产品双击
    function setProduct(id,name,code,norms,price,supplierId){
        //将双击项填入表单
        $('.aa').find('#product_name').val(name);
        $('.aa').find('#product_code').val(code);
        $('.aa').find('#product_norms').val(norms);
        $('.aa').find('#productId').val(id);
        $('.aa').find('#price').val(price);
        $('.aa').find('#price').change();
        $('.aa').find('#supplierId').val(supplierId);
        $('#myModalc').modal('hide');
        $('.product').removeClass('aa');//删除该class
    }
    //ajax分页
    function product(id){    //test函数名 一定要和action中的第三个参数一致上面有
        renderProductTable(id);
    }
    $(function(e) {
        $('.productSelect').click(function(){
            $(this).parents('.product').addClass('aa');//目的是确定哪一个子类
            renderProductTable(1, true);
        })
        //搜索
        $('#searchList2').click(function(){
            renderProductTable(1);
        })
    });
</script>

 
<script type="text/javascript">
	//选择供应商双击供应商操作 
	function setSupplier(id,supplierName){
		//将双击项填入表单
		$('#supplier_name').val(supplierName);
		$('#sid').val(id);
		$('#myModal').modal('hide');
	} 
	//ajax分页
	function supplier(id){    //test函数名 一定要和action中的第三个参数一致上面有 
		$.get('<?php echo U("Storehouse/Ruku/supplierAjax");?>', {'p':id}, function(data){  //用get方法发送信息到TestAction中的test方法
     	var supplierHtml =  $('#supplier').html();
     	if(data){ 
    		$('#supplier').html("");
			var html = "";
			var supplier_name = "";
			var id = "";
			
			$.each(data.list,function(){
				supplier_name = this['supplier_name'];
				id = this['id'];
				html += "<tr ondblclick=\"setSupplier('"+id+"','"+supplier_name+"')\" style=\"cursor:pointer;\"><td style='width:700px;'>"+supplier_name+"</td></tr>";
			});
			$('#page').html(data.page);
			$("#supplier").html(html);
		}
		});
	}
	$(function(e) { 
		$('#supplierSelect').click(function(){
			$.get('<?php echo U("Storehouse/Ruku/supplierAjax");?>', {'p':1}, function(data){  //用get方法发送信息到TestAction中的test方法
	     	var supplierHtml =  $('#supplier').html();
	     	if(data){ 
	    		$('#supplier').html("");
				var html = "";
				var supplier_name = "";
				var id = "";
				
				$.each(data.list,function(){
					supplier_name = this['supplier_name'];
					id = this['id'];
					html += "<tr ondblclick=\"setSupplier('"+id+"','"+supplier_name+"')\" style=\"cursor:pointer;\"><td style='width:500px;'>"+supplier_name+"</td></tr>";
				});
				$('#page').html(data.page);
				$("#supplier").html(html);
			}
			});
	    })
	//搜索
	$('#searchList').click(function(){
	    	var supplier_name = $('#supplierKey').val(); 
	       	var field = "id,supplier_name"; 
			$.get('<?php echo U("Storehouse/Ruku/getSupplierKey");?>', {'p':1,'supplier_name':supplier_name}, function(data){  //用get方法发送信息到TestAction中的test方法
		     	if(data){ 
		    		$('#supplier').html("");
					var html = "";
					var supplier_name = "";
					var id = "";
					$.each(data.list,function(){
						supplier_name = this['supplier_name'];
						id = this['id'];
						html += "<tr ondblclick=\"setSupplier('"+id+"','"+supplier_name.replace(/<[^>].*?>/g,"")+"')\" style=\"cursor:pointer\"><td style='width:700px;'>"+supplier_name+"</td></tr>";
					});
					$('#page').html(data.page);
					$("#supplier").html(html);
			}else{
				$("#supplier").html(" 您好，没有该供应商，请先新增~");
			}
		})
	})
});
	
$(function(){
	$('.newSon').click(function(){
		var id = $(this).find('.id').val();
		var url = "<?php echo U('Storehouse/Ruku/getProduct');?>";
		$.ajax({ 
		     type:"POST", //请求方式
		     url:url, //请求路径
		     cache: false,   //(默认: true) 设置为 false 将不缓存此页面。
		     data:"rukuId="+id,  //传参
		     dataType: "json",   //返回值类型 
		     success:function(res){
		    	var id = ""; 
				var code = "";
				var name = "";
				var cnt = "";
				var html = "";
				$.each(res,function(){
					code = this['code']; 
					name = this['name'];
					norms = this['norms'];
					cnt = this['cnt'];
					html += "<tr><td>"+code+"</td><td>"+name+"</td><td>"+norms+"</td><td>"+cnt+"</td></tr>"
				})
				$("#show").html(html);
		     }
		})
	})
}); 
$(function(){
	$('.newSoncp').click(function(){
		var id = $(this).find('.id').val();
		var url = "<?php echo U('Storehouse/Cpruku/getProduct');?>";
		$.ajax({ 
		     type:"POST", //请求方式
		     url:url, //请求路径
		     cache: false,   //(默认: true) 设置为 false 将不缓存此页面。
		     data:"rukuId="+id,  //传参
		     dataType: "json",   //返回值类型 
		     success:function(res){
		    	var id = ""; 
				var code = "";
				var name = "";
				var cnt = "";
				var html = "";
				$.each(res,function(){
					code = this['code']; 
					name = this['name'];
					norms = this['norms'];
					cnt = this['cnt'];
					html += "<tr><td>"+code+"</td><td>"+name+"</td><td>"+norms+"</td><td>"+cnt+"</td></tr>"
				})
				$("#show").html(html);
		     }
		})
	})
}) 
</script>
 
	</div>
	<div class="foot-space"></div>
	<div class="footer">
		<div class="pull-left" style="font-size:12px; margin-left:30px;"><span><a href="http://www.eqinfo.com.cn" target="_blank">易奇科技</a> 版权所有 © 2007-<?php echo date('Y');?></span></div>
	</div>
  </body>
</html>