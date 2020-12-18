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
		

		
<style type="text/css">
	/* {margin:0;padding:0;list-style-type:none;} */
	body{color:#666;font:12px/1.5 Arial;}
	/* star */
	#star{position:relative;width:100px;height:24px;}
	#star ul,#star span{float:left;display:inline;height:19px;line-height:19px;}
	#star ul{margin-left:-20px;margin-bottom:-5px;} 
	#star li{float:left;width:24px;cursor:pointer;text-indent:-9999px;background:url(/kangpin/Public/images/star.png) no-repeat;}
	#star strong{color:#f60;padding-left:10px;}
	#star li.on{background-position:0 -28px;}
	#star p{position:absolute;top:20px;width:159px;height:60px;display:none;background:url(/kangpin/Public/images/icon.gif) no-repeat;padding:7px 10px 0;}
	#star p em{color:#f60;display:block;font-style:normal;} 

</style>
    <div class="container-fluid main-content">
	<div class="row">
		<div class="col-lg-12">
			<div class="widget-container fluid-height">
				<div class="heading tabs">
					<i class="icon-sitemap"></i>客户详情
				</div>
				<div class="tab-content padded" id="my-tab-content">
					<table class="table table-bordered table-hover" id="">
						<thead>
							<tr>
								<th colspan="4">基本信息</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class=" text-right well">公司名称:</td>
								<td><?php echo ($client['company']); ?></td>
								<td class="text-right well">行业类型:</td>
								<td><?php echo ($industry_name[$client['industry']]); ?></td>
							</tr>
							<tr>
								<td class="text-right well">信息来源:</td>
								<td class=""><?php echo ($source_name[$client['source']]); ?></td>
								<td class="text-right well">公司规模:</td>
								<td><?php echo ($employee_num[$client['industry_size']]); ?></td>
							</tr>
							<tr>
								<td class="text-right well">业务员:</td>
								<td class=""><?php echo ($sales_name[$client['salesman']]); ?></td>
								<td class="text-right well">创建时间：</td>
								<td><?php echo (date('Y-m-d H:i',$client['ctime'])); ?></td>
							</tr>
							<tr>
								<td class="text-right well">地区:</td>
								<td class=""><?php echo C('province.'.$client['province']);?>
									<?php echo C('city.'.$client['city']);?> <?php echo C('area.'.$client['area']);?></td>
								<td class="text-right well">详细地址：</td>
								<td><?php echo ($client['address']); ?></td>
							</tr>
							<tr>
								<td class="text-right well">备注:</td>
								<td class="" colspan="3"><?php echo ($client['memo']); ?></td>
							</tr>
						</tbody>
					</table>
				</div>
				<div style="height: 40px;"></div>
				<div class="tab-content padded contactDiv" id="my-tab-content">
					<?php if($client['client_contact']): ?><table class="table table-bordered table-hover">
						<thead>
							<tr>
								<th colspan="5">联系人</th>
							</tr>
							<tr>
								<th></th>
								<th>姓名</th>
								<th>职位</th>
								<th>手机号</th>
								<th>邮箱</th>
								<th>其他</th>
							</tr>
						</thead>
						<tbody id="contactlist">
							<?php if(is_array($client['client_contact'])): foreach($client['client_contact'] as $key=>$vo): ?><tr class="trRow">
								<td><a class="table-actions pull-right delectContact" data-toggle="modal" href="javascript:;"><i class="icon-trash"></i></a>
										 <input type="hidden" name="c_id[]"  value="<?php echo ($vo['id']); ?>"/>	
			                       </td>
								<td><?php echo ($vo['contact_name']); ?></td>
								<td><?php echo ($vo['position']); ?></td>
								<td><?php echo ($vo['telephone']); ?></td>
								<td><?php echo ($vo['email']); ?></td>
								<td><?php echo ($vo['contact_memo']); ?></td>
							</tr><?php endforeach; endif; ?>
						</tbody>
					</table>
					<?php else: ?> 暂无联系人信息<?php endif; ?>
				</div>
				<div style="height: 40px;"></div>
				<div class="tab-content padded" id="my-tab-content">
					<?php if($client['client_action']): ?><table class="table table-bordered table-hover">
						<thead>
							<tr>
								<th colspan="5">客户行动</th>
							</tr>
							<tr>
								<th>行动时间</th>
								<th>行动方式</th>
								<th>行动人</th>
								<th>行动备注</th>
							</tr>
						</thead>
						<tbody>
							<?php if(is_array($client['client_action'])): foreach($client['client_action'] as $key=>$vo): ?><tr>
				                <td><?php echo (date('Y-m-d',$vo['contact_time'])); ?></td> 
				                <td><?php echo ($type_name[$vo['contact_type']]); ?></td> 
				                <td><?php echo ($sales_name[$vo['sid']]); ?></td> 
				                <td><?php echo ($vo['memo']); ?></td>
							</tr><?php endforeach; endif; ?>
						</tbody>
					</table>
					<?php else: ?> 暂无行动<?php endif; ?>
				</div>
			</div>
		</div>

	</div>
</div>
</div>



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



<script type="text/javascript">

	 function deleteData(id,url) {
		swal({
			  title: "确定要删除吗？",
			  text: "删除后不可恢复！",
			  type: "error",
			  showCancelButton: true,
			  confirmButtonColor: "#DD6B55",
			  confirmButtonText: "删除"
			},
			function(){
				 $.post(url,{'id':id},function(data){
						if(data){
							location.reload();
						}else{
							alert('删除失败！');
						}
					})
			});
	} 
</script>
<script src="/kangpin/Public/js/bootstrap-contextmenu.js"></script>

<script type="text/javascript">
		//标星
		var num="";
		var nums="" ;
		var i = "";
		var id="";
$(document).ready(function () {     
	//省市县联动
		$('#province').change(function(){
			var province = $(this).children('option:selected').val();
			$.post("<?php echo U('Client/Client/city');?>",{'fatherid':province},function(data){
				var cities = eval(data);
				if(cities){
					$('#city').html("<option value=''>请选择城市</option>");
					$('#area').html("<option value=''>请选择区域</option>");
					for(i=0;i<cities.length;i++){
						$("<option value='"+cities[i]['cityid']+"'>"+cities[i]['city']+"</option>").appendTo("#city");	
		    			}
				}else{
					
				}
			})
		});
		$('#city').change(function(){
			var city = $(this).children('option:selected').val();
			$.post("<?php echo U('Client/Client/area');?>",{'fatherid':city},function(data){
				var area = eval(data);
				if(area){
					$('#area').html("<option value=''>请选择区域</option>");
					for(i=0;i<area.length;i++){
						$("<option value='"+area[i]['areaid']+"'>"+area[i]['area']+"</option>").appendTo("#area");	
		    			}
				}else{
					
				}
			})
		});
		//添加联系人
		$('.addContact').click(function(){
	 		_trModel = $('.contact').eq(0).clone(true);
	 			$('input,select',_trModel).val('');
	 			$('textarea',_trModel).text('');
		 		$('#contactDiv').append(_trModel.clone(true)); 
			})
		//删除联系人
 		$('.deleteContact').click(function(){
 			 var that=$(this).parents('.contact');
 			 var id = $(this).parents('.contact').find('input[type=hidden]').val();
 			 if(id){
	 		   if(!confirm('确认删除吗? 删除后讲不能恢复！')) return false;
 				 $.post("<?php echo U('Client/Client/ajaxDeleteContact');?>",{'id':id},function(data){
 						if(data){
 							that.remove();
 							location.reload(); 
 						}else{
 							alert('删除失败！');
 						}
 					})
 			 }else{
 			 }
 		});	
		//标星
		$('.star li').mouseover(function(){
			nums = $(this).parent().find('li[class=on]').length;
			i = $(this).text();
			$(this).parent().find("li:gt("+i+")").removeClass('on');
			$(this).parent().find("li:lt("+i+")").addClass('on');
		}).mouseleave(function(){
			i = $(this).index();
			$(this).parent().find("li").removeClass('on');
			$(this).parent().find("li:lt("+nums+")").addClass('on');
		}).click(function(){
			nums = $(this).text(); 
			$(this).parent().find("li").removeClass('on');
			$(this).parent().find("li:lt("+nums+")").addClass('on');
			 var id = $(this).parents('span').attr('value');
			 var url = "<?php echo U('Client/Client/ajaxPostLever');?>";
			$.post(url,{'id':id,'level':nums},function(data){
			})
		});
		//验证手机号码
		jQuery.validator.addMethod("telephone", function(value, element) {
		    var regu =/^13[0-9]{1}[0-9]{8}$|15[012356789]{1}[0-9]{8}$|18[012356789]{1}[0-9]{8}$|14[57]{1}[0-9]$/;
		    return this.optional(element) || (regu.test(value));
		}, "请输入正确的手机号码");
		/* //验证身份证号码
		jQuery.validator.addMethod("cardid", function(value, element) {
		    var cardnum =/^\d{6}(18|19|20)?\d{2}(0[1-9]|1[12])(0[1-9]|[12]\d|3[01])\d{3}(\d|X)$/i;
		    return this.optional(element) || (cardnum.test(value));
		}, "请输入正确的身份证号码"); */
		
		//验证
		$("#validate-form").validate({
		       rules: {
					 company: {
						   required: true,
						   company: true
						  },
					  email: {
					   required: true,
					   email: true
					  },
					  telephone: {
					   required: true,
					   telephone: true
					  },
					  cardid: {
					   required: true,
					   cardid: true
					  },
					 },
		       messages: {
					  company: {
						   required: "请输入客户名称",
						   company: "请输入客户名称"
						  },
					  email: {
					   required: "请输入Email地址",
					   email: "请输入正确的email地址"
					  },
					  telephone: {
					   required: "请输入密码",
					   telephone: "请输入正确的手机号码"
					  },
					  cardid: {
					   required: "请输入密码",
					   cardid: "请输入正确的身份证号码"
					  },
		 			},
		   });
		$('#form1').submit(function () {              
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
});
function send(path){
    var percent = document.getElementById("percent");
    var msg = document.getElementById("msg");
    var xhr = new window.XMLHttpRequest();
    if(!window.XMLHttpRequest){
            try {
                xhr = new window.ActiveXObject("Microsoft.XMLHTTP");
            } catch(e) {}
    }
    var filepath = encodeURIComponent(path);
    var url = "/kangpin/Client/Client/import";
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
    xhr.send("file="+filepath);
}
function UpladFile() {   
    $("#form1").submit();      
}  


</script>
	</div>
	<div class="foot-space"></div>
	<div class="footer">
		<div class="pull-left" style="font-size:12px; margin-left:30px;"><span><a href="http://www.eqinfo.com.cn" target="_blank">易奇科技</a> 版权所有 © 2007-<?php echo date('Y');?></span></div>
	</div>
  </body>
</html>