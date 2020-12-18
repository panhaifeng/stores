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



    <div class="container-fluid main-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="widget-container fluid-height clearfix">
                <div class="heading">
                    <i class="icon-reorder"></i>添加计划
                </div>
                <div class="widget-content padded">
                    <form action="<?php echo U('Profit/Plan/addInsert');?>" id="validate-form" method="post" class="form-horizontal">
                            <input id="id" name="id" type="hidden" value="<?php echo ($Main['id']); ?>"/>
                            <div class="form-group">
                                <fieldset disabled class="col-sm-4">
                                    <div class="form-group">
                                        <label class="control-label col-md-6" for="code">计划编号</label>
                                        <div class="col-md-6">
                                            <input id="code" name="code" class="form-control" placeholder="系统自动生成" type="text" value="<?php echo ($Main['plan_code']); ?>">
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset disabled class="col-sm-3">
                                    <div class="form-group">
                                        <label class="control-label col-md-4" for="creator">操作员</label>
                                        <div class="col-md-8">
                                            <input id="creator" name="creator" class="form-control" placeholder="系统自动生成" type="text" value="<?php echo ($Main['creator']); ?>">
                                        </div>
                                    </div>
                                </fieldset>

                                <label class="control-label col-md-1" for="plan_date">计划时间</label>
                                <div class="col-md-2">
                                    <div class="input-group date datepicker" data-date-autoclose="true" data-date-format="yyyy-mm-dd">
                                      <input id="plan_date" name="plan_date" class="form-control" type="text" value="<?php echo ($Main['plan_date']); ?>">
                                      <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2" for="title">标题</label>
                                <div class="col-md-8">
                                    <input id="title" name="title" class="form-control"  type="text" value="<?php echo ($Main['title']); ?>">
                                </div>

                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2" for="memo">备注</label>
                                <div class="col-xs-6 col-sm-8">
                                    <textarea class="form-control" name="memo" rows="2" id="memo"><?php echo ($Main['memo']); ?></textarea>
                                </div>
                            </div>
                            <!-- 明细部分 -->
                            <div class="heading">
                                <i class="icon-reorder"></i>添加明细&nbsp;&nbsp;&nbsp;
                                <a href="javascript:;" class="addCp"><i class="icon-plus"></i></a>
                            </div>
                            <div class="head" style="margin-top:-1%;">
                                <div class="form-group">
                                    <label class="control-label col-md-3">成品编码</label>
                                    <label class="control-label col-md-2" style="margin-left:6%;">成品名称</label>
                                    <label class="control-label col-md-2">成品颜色</label>
                                    <label class="control-label col-md-2">数量</label>
                                </div>
                            </div>
                            <?php if(is_array($Bills)): foreach($Bills as $key=>$v): ?><div class="form-group product" style="margin-bottom:5px;">
                                <a class="btn btn-sm btn-primary-outline control-label pull-left btnDetailRemove" style="position:absolute;z-index:99;margin-left:5%;" href="javascript:;">
                                  <i class="icon-minus"></i>删除明细
                                </a>
                                 <label class="control-label col-md-2"></label>
                                <div class="col-sm-2">
                                  <div class="input-group">
                                    <input class="form-control" type="text" id="cp_code" value="<?php echo ($v['code']); ?>">
                                    <span class="input-group-btn">
                                        <a id="billSelectcp" class="btn btn-default billSelectcp" type="button" data-toggle="modal" href="#myModalc">请选择</a>
                                    </span>
                                    <input type="hidden" id="cpid" name="cpid[]" value="<?php echo ($v['cpid']); ?>">
                                    <input type="hidden" id="sonId" name="sonId[]" value="<?php echo ($v['id']); ?>">
                                  </div>
                                </div>
                                <div class="col-sm-2">
                                    <input class="form-control" type="text" id="cp_name" value="<?php echo ($v['name']); ?>">
                                </div>
                                <div class="col-sm-2">
                                    <input class="form-control" type="text" id="cp_color" value="<?php echo ($v['color']); ?>">
                                </div>
                                <div class="col-sm-2">
                                    <input class="form-control" type="text" name="num[]" value="<?php echo ($v['num']); ?>">
                                </div>
                            </div><?php endforeach; endif; ?>
                            <div id="contactDiv"></div>
                            <hr>
                            <div class="form-group">
                                <label class="control-label col-md-3"></label>
                                <div class="col-xs-9 col-md-2">
                                    <button class="btn btn-primary" type="submit">保存</button>
                                </div>
                            </div>
                            </form>
                            <!-- 隐藏区域内容 -->
                            <div class="contact2 product">
                                <div class="form-group" style="margin-bottom:5px;">
                                    <a class="btn btn-sm btn-primary-outline pull-left btnDetailRemove" style="position:absolute;z-index:99;margin-left:5%;" href="javascript:;">
                                      <i class="icon-minus"></i>删除明细
                                    </a>
                                    <label class="control-label col-md-2"></label>
                                    <div class="col-sm-2">
                                      <div class="input-group">
                                        <input class="form-control" type="text" id="cp_code" value="">
                                        <span class="input-group-btn">
                                            <a id="billSelectcp" class="btn btn-default billSelectcp" type="button" data-toggle="modal" href="#myModalc">请选择</a>
                                        </span>
                                        <input type="hidden" id="cpid" name="cpid[]" value="">
                                      </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <input class="form-control" type="text" id="cp_name" value="">
                                    </div>
                                    <div class="col-sm-2">
                                        <input class="form-control" type="text" id="cp_color" value="">
                                    </div>
                                    <div class="col-sm-2">
                                        <input class="form-control" type="text" name="num[]" value="">
                                    </div>
                                </div>
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
      <div id="productListcp">
        <div class="form-group">
          <div class="modal-body">
            <div class="col-md-5">
              <div class="input-group">
                <input id="productKeycp" class="form-control" type="text" placeholder="编码、品牌、颜色、型号"><span class="input-group-btn"><button id="searchList2cp" class="btn btn-default" type="button">搜索</button></span></input>
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
        $('.addCp').click(function(){
            _trModel = $('.contact2').eq(0).clone(true);
            $('input,select',_trModel).val('');
            $('#contactDiv').append(_trModel.clone(true));
            $('#contactDiv').find('.contact2').show();
        });
        // 删除明细
        $('.btnDetailRemove').click(function(){
            var sonid = $(this).parents('.product').find('#sonId').val();
            $.post('<?php echo U("Profit/Plan/deleteBill");?>',{id:sonid},function(){
                location.reload();
            })
            $(this).parents('.product').remove();
        });
    });
    //选择产品双击
    function setProduct(id,name,code,color,pid,cnt){
        //将双击项填入表单
        $('.aa').find('#cp_name').val(name);
        $('.aa').find('#cp_code').val(code);
        $('.aa').find('#cp_color').val(color);
        $('.aa').find('#cpid').val(id);
        $('#myModalc').modal('hide');
        $('.product').removeClass('aa');//删除该class
    }
    var renderChenpinpProductTable = function(page, isInit){
        if(isInit){
            $('#productKeycp').val('');
        }
        var name = $('#productKeycp').val(),
            page = page?page:1;

        $.get('<?php echo U("Storehouse/Cpruku/getProductKey");?>', {'p':page,'name':name}, function(data){  //用get方法发送信息到TestAction中的test方法
            var html = "", pageHtml ="";
            if(data && data.list.length>0){
                var name = "";
                var id = "";
                var code = "";
                var kind = "";
                var color = "";

                $.each(data.list,function(){
                    name = this['name'];
                    id = this['id'];
                    code = this['code'];
                    kind = this['kind'];
                    color = this['color'];
                    html += "<tr ondblclick=\"setProduct('"+id+"','"+name.replace(/<[^>].*?>/g,"")+"','"+code+"','"+color+"')\" style=\"cursor:pointer\"><td style='width:200px;'>"+code+"</td><td style='width:200px;'>"+name+"</td><td style='width:200px;'>"+kind+"</td><td style='width:200px;'>"+color+"</td></tr>";
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
    //ajax分页
    function product(id){    //test函数名 一定要和action中的第三个参数一致上面有
        renderChenpinpProductTable(id);
    }
    $(function(e) {
        $('.billSelectcp').click(function(){
            $(this).parents('.product').addClass('aa');//目的是确定哪一个子类
            renderChenpinpProductTable(1, true);
        });
        //搜索
        $('#searchList2cp').click(function(){
            renderChenpinpProductTable(1);
        });
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