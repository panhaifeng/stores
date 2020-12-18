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
    <div class="row">
  <div class="col-lg-12"> 
    <div class="widget-container fluid-height clearfix">
      <div class="heading">
        <i class="icon-table"></i><a href="<?php echo U('Storehouse/Index/index');?>">库存查询</a>
        <a href="<?php echo U('Storehouse/Ruku/index');?>" style="margin-left:5%;">原料入库</a> 
	    <a class="btn-primary" href="<?php echo U('Storehouse/Chuku/index');?>" style="margin-left:5%;padding:4px;border-radius:3px">原料出库</a> 
	    <a class="btn btn-sm btn-primary-outline pull-right" href="<?php echo U('Storehouse/Chuku/add');?>"> 
          <i class="icon-plus"></i>新增原料出库 
        </a> 
      </div> 
      <div class="widget-content padded clearfix"> 
      <form action="<?php echo U('Storehouse/Chuku/index');?>" class="form-horizontal" method="post"> 
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
                <td><input class="form-control"  name="key" type="text" placeholder="关键字:编号、名称、规格" value="<?php echo ($key); ?>">
	          <td><button type="submit"  class="btn btn-primary sousuo"><i class="icon-search"></i> 搜索</button></td>
	        </tr>
	      </tbody> 
	    </table> 
	  </form> 
	  </div> 
      <div class="widget-content padded clearfix"> 
        <!-- <table class="table table-bordered table-striped" id="datatable-editable"> -->
        <table class="table table-bordered table-striped"> 
         <thead>
            <th> 出库时间      </th> 
            <th> 出库编号      </th>
            <th> 操作员   </th>
            <th> 编号      </th> 
            <th> 名称      </th>
            <th> 规格      </th>
            <th> 数量      </th> 
            <th> 备注      </th> 
            <th> 操作      </th> 
          </thead> 
          <tbody> 
         	<?php if(is_array($Chuku)): foreach($Chuku as $key=>$v): ?><tr class="newSon2" style="cursor:pointer;"> 
              	<td style="display:none;"><input type="hidden" class="id" id="id" value="<?php echo ($v['id']); ?>"/></td>
                <td><?php echo ($v['chuku_date']); ?></td> 
                <td><?php echo ($v['chuku_code']); ?></td>
                <td><?php echo ($v['creator']); ?></td>
                <td><?php echo ($v['code']); ?></td> 
                <td><?php echo ($v['name']); ?></td> 
                <td><?php echo ($v['norms']); ?></td> 
                <td><?php echo ($v['cnt']); ?></td> 
                <td><?php echo ($v['memo']); ?></td> 
                 <td> 
                 <?php if($v['cpid']==0): ?><div class="action-buttons">
                    <a class="table-actions" href="<?php echo U('Storehouse/Chuku/edit',array('id'=>$v['id']));?>"><i class="icon-pencil"></i></a>
                    <a class="table-actions" data-toggle="modal" href="#myModal<?php echo ($v['id']); ?>"><i class="icon-trash"></i></a> 
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
	                          <a class="btn btn-primary" type="button" href="<?php echo U('Storehouse/Chuku/delect',array('id'=>$v['id']));?>">删除</a>
	                          <button class="btn btn-default-outline" data-dismiss="modal" type="button">取消</button>
	                        </div>
	                   	  </div>
	                    </div>
		              </div>
		              <!-- 模态框结束 --> 
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
<script type="text/javascript"> 
$(function(){
	$('.newSon2').click(function(){
		var id = $(this).find('.id').val();
		var url = "<?php echo U('Storehouse/Cpchuku/getProduct');?>";
		$.ajax({ 
		     type:"POST", //请求方式
		     url:url, //请求路径
		     cache: false,   //(默认: true) 设置为 false 将不缓存此页面。
		     data:"chukuId="+id,  //传参
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

<script type="text/javascript">
    (function ($)
    {
        $.fn.textSearch = function (str, options)
        {
            var defaults =
                {
                    divFlag : true, divStr : " ", markClass : "", markColor : "red", nullReport : true, emptyReport : true,
                    callback : function (test)
                    {
                        return false;
                    }
                };
            var sets = $.extend({}, defaults, options || {}), clStr;
            if (sets.markClass) {
                clStr = "class='" + sets.markClass + "'";
            }
            else {
                clStr = "style='color:" + sets.markColor + ";'";
            }
            //对前一次高亮处理的文字还原
            $("span[rel='mark']", $(this)).each(function ()
            {
                var text = document.createTextNode($(this).text());
                $(this).replaceWith($(text));
            });
            //字符串正则表达式关键字转化
            $.regTrim = function (s)
            {
                var imp = /[\^\.\\\|\(\)\*\+\-\$\[\]\?]/g;
                var imp_c = {};
                imp_c["^"] = "\\^";
                imp_c["."] = "\\.";
                imp_c["\\"] = "\\\\";
                imp_c["|"] = "\\|";
                imp_c["("] = "\\(";
                imp_c[")"] = "\\)";
                imp_c["*"] = "\\*";
                imp_c["+"] = "\\+";
                imp_c["-"] = "\\-";
                imp_c["$"] = "\$";
                imp_c["["] = "\\[";
                imp_c["]"] = "\\]";
                imp_c["?"] = "\\?";
                s = s.replace(imp, function (o)
                {
                    return imp_c[o];
                });
                return s;
            };
            $(this).each(function ()
            {
                var t = $(this);
                str = $.trim(str);
                if (str === "") {
                    if(sets.emptyReport){
                        alert("关键字为空");
                    }
                    return false;
                }
                else
                {
                    //将关键字push到数组之中
                    var arr = [];
                    if (sets.divFlag) {
                        arr = str.split(sets.divStr);
                    }
                    else {
                        arr.push(str);
                    }
                }
                var v_html = t.html();

                //删除注释
                v_html = v_html.replace(/<!--(?:.*)\-->/g, "");
                //将HTML代码支离为HTML片段和文字片段，其中文字片段用于正则替换处理，而HTML片段置之不理
                var tags = /[^<>]+|<(\/?)([A-Za-z]+)([^<>]*)>/g;
                var a = v_html.match(tags), test = 0;
                $.each(a, function (i, c)
                {
                    if (!/<(?:.|\s)*?>/.test(c))
                    {
                        //非标签
                        //开始执行替换
                        $.each(arr, function (index, con)
                        {
                            if (con === "") {
                                return;
                            }
                            var reg = new RegExp($.regTrim(con), "g");
                            if (reg.test(c)) {
                                //正则替换
                                c = c.replace(reg, "♂" + con + "♀");
                                test = 1;
                            }
                        });
                        c = c.replace(/♂/g, "<span rel='mark' " + clStr + ">").replace(/♀/g, "</span>");
                        a[i] = c;
                    }
                });
                //将支离数组重新组成字符串
                var new_html = a?a.join(""):'';
                t.html(new_html);
                if (test === 0 && sets.nullReport) {
                    return false;
                }
                //执行回调函数
                sets.callback(test);
            });
        };
    })(jQuery);

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
            var start_time = year+"-"+month+"-"+01;
            var end_time = year+"-"+month+"-"+last;
            $('#dpd1').val(start_time);
            $('#dpd2').val(end_time);
        }
    }else if(value==3){
        var start_time = year+"-"+01+"-"+1;
        var end_time = year+"-"+12+"-"+last;
        $('#dpd1').val(start_time);
        $('#dpd2').val(end_time);
    }else{
        var end_time = year+"-"+month+"-"+last;
        $('#dpd1').val('2014-01-01');
        $('#dpd2').val(end_time);
    };
 }

 $(function(){
     // 切换模式
     var $quickSwitch = $('#quickSwitch'),
         $quickSubmit = $('#quickSubmit'),
         $quickSearch = $('#quickSearch'),
         $quickOrder  = $('#inlinetype'),
         $trsCopy = $('.rowsData tbody tr').clone(true),
         _rowsObject = [],
         _cacheData = [];

     // 绑定模式切换功能
     $quickSwitch.click(function(){
         var nowType = $(this).data('type');

         if(nowType == 'on'){
             // 当前「开启」，转入正常模式
             closeQuickModel();
             // 恢复初始状态
             recoverTable();

         }else if(nowType = 'off'){
             // 当前「关闭」，转入快捷入库模式
             openQuickModel();
             // 初始化
             initRows();
         }
     });
     // 绑定检索功能
     $quickSearch.click(function(){
         searchInPage();
     });

     // 数据行排序
     $quickOrder.change(function(){
         var type = $quickOrder.val();
         sortRows(type);
     });

     // 绑定数据录入
     $('.rowsData tbody').on('change', '[name="preChuku[]"]', function(){
         var $that = $(this);
         cacheData($that);
     });

     // 绑定提交事件
     $quickSubmit.click(function(){
         // 提交表单
         var url = $(this).data('url'),
             args = [];
         var $checkboxes = $('[name="preChuku[]"]:checked');
         $checkboxes.each(function(){
             args.push({"name":"proId[]", "value":$(this).val()});
             args.push({"name":"proNum[]", "value":''});
         });
         myPost(url,args);
     });
     var myPost = function(url,args){
         var body = $(document.body),
             form = $("<form method='post'></form>"),
             input;
         form.attr({"action":url});
         $.each(args,function(key,value){
             input = $("<input type='hidden'>");
             input.attr("name",value.name);
             input.val(value.value);
             form.append(input);
         });

         form.appendTo(document.body);
         form.submit();
         document.body.removeChild(form[0]);
     };

     function insertSort(arr){
         for(var i =1,j;i<arr.length;i++){
             j=i;
             var v=arr[j],
                 numA = $(arr[j-1]).attr('id')*1,
                 numB = $(v).attr('id')*1;
             while(numA > numB){
                 arr[j] = arr[j-1];
                 j--;
                 if(j == 0){
                     break;
                 }
             }
             $(v).removeClass('ordering');
             arr[j]= v;
         }
         return arr;
     }

     var sortRows = function(type){
         // 将要排序的行打标签「ordering」
         var $rows = $('.rowsData tbody tr').addClass('ordering');

         var $orderTarget = null;


         if(type == 1){
             // 已选置顶
             $orderTarget = $('.rowsData tbody tr.chukuChecked');

             $orderTarget = $(insertSort($orderTarget.toArray()));

             $orderTarget.detach().insertBefore('.rowsData tbody tr.ordering:first');

         }else if(type == 2){
             // 已选置底
             $orderTarget = $('.rowsData tbody tr.chukuChecked');

             $orderTarget = $(insertSort($orderTarget.toArray()));

             $orderTarget.insertAfter('.rowsData tbody tr.ordering:last');

         }else{
             $orderTarget = $('.rowsData tbody tr.ordering');
             var size = $orderTarget.size();
             for(var i =1; i<size;i++){
                 var $tmp =$('.rowsData tbody').find('#'+i).removeClass('ordering');
                 $('.rowsData tbody tr.ordering:first').before($tmp.detach());
             }
             // 最后一个可以忽略不排序
         }
         // 结束排序
         $rows.removeClass('ordering');

         return true;
     };


     var closeQuickModel = function(){
         // 切换按钮样式
         $quickSwitch.find('span').text('开启快捷出库');
         $quickSwitch.data('type', 'off');
         $quickSwitch.find('i').removeClass('icon-eye-open').addClass('icon-eye-close');

         $quickSubmit.hide();
         // 关闭操作栏
         $('.quickColumn').css('display', 'none');
         // 恢复搜索框提交功能
         $('div.quickSearch').hide();
         $('.normalSearch').show();
         $('#exportBtn').show();

         $('span#chukuChengpinNum').data('count', 0).text('0');

     };

     // 打开快捷出库模式
     var openQuickModel = function(){
         // 切换按钮样式
         $quickSwitch.find('span').text('关闭快捷出库');
         $quickSwitch.data('type', 'on');
         $quickSwitch.find('i').removeClass('icon-eye-close').addClass('icon-eye-open');

         $quickSubmit.show();
         // 开启操作栏
         $('.quickColumn').css('display', '');
         // 限制搜索框提交功能，变为本页内检索
         $('div.quickSearch').show();
         $('.normalSearch').hide();
         $('#exportBtn').hide();
     };
     var cacheData = function($that){
         var $countSpan = $('span#chukuChengpinNum'),
             count = $countSpan.data('count');
         count = parseFloat(count)?parseFloat(count):0;
         var id = $that.val();
         var isCheck = $that.parents('td').find('span.checkSpan').text()=='已选'?true:false;

         if($that.is(':checked')){
             // 选中状态
             $that.parents('tr').addClass('chukuChecked');
             $that.parents('td').find('span.checkSpan').text('已选');
             if(!isCheck){
                 count = count + 1;
             }
         }else{
             // 取消选中状态
             $that.parents('tr').removeClass('chukuChecked');
             $that.parents('td').find('span.checkSpan').text('');
             if(isCheck){
                 count = count - 1;
             }
         }
         $countSpan.data('count', count).text(count);

     }

     // 初始化行数据
     var initRows = function(){
         var i = 1;
         $('.rowsData tbody tr').each(function(){
             // 记忆初始化排序, // 记忆初始化样式
             $(this).addClass('initorder').attr('id', i++);
             $(this).find('[name="preChuku[]"]').data('choose', 'false');
         });
     };

     // 还原表
     var recoverTable = function(){
         // 还原样式
         // 还原排序
         $('.rowsData tbody').html($trsCopy.clone(true));
     };

     // 页面内查询
     var searchInPage = function(){
         var searchText = $('[name="inlinekey"]').val();
         // 筛选选中项, 已填写出库数量的不在检索范围内
         $('.rowsData tbody tr').textSearch(searchText, {"emptyReport":false});
         // 重选checkbox

         $('.rowsData tbody tr [name="preChuku[]"]').each(function(){

             var isCheck = $(this).parents('td').find('span.checkSpan').text();

             if('已选'== isCheck ){
                 $(this).parents('td').find('label.checkbox-inline').click();
             }
         });


         $('.rowsData tbody tr:not(.chukuChecked)').each(function(){
             if(searchText){
                 if($(this).find('[rel="mark"]').size()>0){
                     $(this).show();
                 }else{
                     $(this).hide();
                 }
             }else{
                 $(this).show();
             }
         });
     };


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