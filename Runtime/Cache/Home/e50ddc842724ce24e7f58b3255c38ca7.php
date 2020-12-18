<?php if (!defined('THINK_PATH')) exit();?> 
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo C('SYSTEM_INFO');?>|<?php echo C('USER_SYSTEM_TITLE');?></title>
<link rel="stylesheet" type="text/css" href="/kangpin/Public/login/LoginBetter.css">
  <link type="favicon" rel="shortcut icon" href="/kangpin/Public/favicon.ico" />
</head>
<body>
  <div class="container">
    <div class="header">
      <a href='http://www.eqinfo.com.cn' target="_blank"><div class="logo" style="background-image:url(/kangpin/Public/login/image/logo.png)"></div></a>
      <div class="link">
        <span><?php echo C('SYSTEM_INFO');?></span>
        &nbsp;|&nbsp;
        <span><?php echo C('USER_SYSTEM_TITLE');?></span>
      </div>
    </div>

    <div class="content" id="content" style="background-image:url(<?php echo ($login["bg"]); ?>)">
      <div class="mainInner">
        <div class="rightBox">
          <div class="header_login">
            <div id="common_login" to="kuaijie_form" class="login_btn col-6 text-center active">
            <div class="yaoshi"></div>
            账号密码登陆
            </div>
            <!-- <div id="kuaijie_login" to="qrcode_form" class="login_btn col-6 text-center">快速登陆</div> -->
            <div class="active_bottom">&nbsp;</div>
          </div>
          
          <!-- 密码登陆 -->
          <div class="input input_block" id="kuaijie_form">
            <form action="<?php echo U('Home/Login/login');?>" method="post" autocomplete='off'>
              <div class="uinArea" id="uinArea">
                  <input type="text" class="inputstyle" id="account_input" name="user_name" tabindex="1" placeholder="用户名">
              </div>
              <div class="pwdArea" id="pwdArea">
                  <input type="password" class="inputstyle password" id="pwd_input" name="password" tabindex="2" placeholder="密码">
              </div>
              <div class="verifyArea" id="verifyArea">
                  <input type="text" class="inputstyle verify" id="verify" name="verify" tabindex="3" placeholder="验证码/可以为空">
              </div>
              <button type="submit" id="submit"  style="background-color: <?php echo ($login["btnColor"]); ?>" tabindex="4">登 录</button>
             </form>
          </div>
          <!-- 二维码登陆 -->
          <!-- <div class="input input_hide" id="qrcode_form">
            <div class="login_text">请使用<span style='color:#3481D8'>微信扫一扫</span>登陆</div>
            <div class="br_20">&nbsp;</div>
            <div id="qrcode"><img src="Resource/Image/LoginNew/yiqi.png" /></div>
          </div> -->
          <div>

          </div>
          <div style="display: block;" class="bottom" id="bottom_web">
            <!--<a href="http://wpa.qq.com/msgrd?v=1&uin=<?php echo ($adminQQ); ?>&site=qq&menu=yes" class="link" id="forgetpwd" target="_blank">忘了密码？</a>-->
            <!--<span class="dotted">|</span>-->
            <!--<a target="new" href="http://wpa.qq.com/msgrd?v=1&uin=<?php echo ($contactQQ); ?>&site=qq&menu=yes">意见反馈</a>-->
            <a href="javascript:void(addFavorite());" class="collect link"><img src="/kangpin/Public/images/toolbar/heart.png"/><span>加入收藏</span></a>
            <span class="dotted">|</span>
            <a href="javascript:void(createShortcut());" class="shortcut link"><img src="/kangpin/Public/images/toolbar/link.png"/><span>生成快捷方式</span></a>
          </div>
        </div>
      </div>
    </div>
    <div class="footer">
      <a href="http://www.eqinfo.com.cn" target="_blank">关于易奇</a>
      |
      <span class="link">免费咨询热线:<?php echo C('SERVICE_TEL');?></span>
      |
      <span class="gray">©2007 - <?php echo date('Y');?> EQINFO Inc. All Rights Reserved.</span>
    </div>
  </div>
  <!-- 近期跟新 -->
  <!-- <div class="main">
  <div class="main2"><a href="javascript:" class="bar"></a>
    <ol>
      <li>近期更新的内容：</li>
      <li>近期更新的内容：</li>
      <li>近期更新的内容：</li>
      <li>近期更新的内容：</li>
      <li>近期更新的内容：</li>
      <li>近期更新的内容：</li>
      <li>近期更新的内容：</li>
      <li>近期更新的内容：</li>
    </ol>
  </div>
</div> -->
<!-- 广告 -->
<!-- <TABLE height="29" border="0" cellspacing="0" class=rollboder>
  <TBODY>
  <TR>
    <TD height="22" class=rollleft>
      <DIV class=rollTextMenus>
      <DIV id=rollTextMenu1 style="DISPLAY: block"><STRONG>　相关企业：</STRONG> <A 
      href="http://www.baidu.com" target="_blank">可能涉及到的企业1</A></DIV>
      <DIV id=rollTextMenu2 style="DISPLAY: none"><STRONG>　相关企业：</STRONG> <A 
      href="http://www.eqinfo.com.cn" target="_blank">可能涉及到的企业2</A></DIV>
      <DIV id=rollTextMenu3 style="DISPLAY: none"><STRONG>　相关企业：</STRONG> <A 
      href="http://www.qfc.cn" target="_blank">可能涉及到的企业3</A></DIV>
      <DIV id=rollTextMenu4 style="DISPLAY: none"><STRONG>　相关企业：</STRONG> <A 
      href="http://www.youku.com" target="_blank">可能涉及到的企业4</A></DIV>
      <DIV id=rollTextMenu5 style="DISPLAY: none"><STRONG>　相关企业：</STRONG> <A 
      href="http://www.1905.com" target="_blank">可能涉及到的企业5</A></DIV>
      <DIV id=rollTextMenu6 style="DISPLAY: none"><STRONG>　相关企业：</STRONG> <A 
      href="http://www.cntrades.com" target="_blank">可能涉及到的企业6</A></DIV></DIV></TD>
    <TD class=rollcenter id=pageShow>1/6</TD>
    <TD class=rollright><A title=上一条 href="javascript:rollText(-1);"><IMG src="Resource/Image/last.gif" 
      alt=上一条 width="11" height="11" border="0"></A> <A title=下一条 href="javascript:rollText(1);"><IMG src="Resource/Image/next.gif" 
      alt=下一条 width="11" height="11" border="0"></A></TD>
</TR></TBODY></TABLE>
 -->
<script>
    void function(){
        var sURL = location.href;
        var sTitle = document.title;
        // 加入收藏夹
        addFavorite = function(){
            try
            {
                window.external.addFavorite(sURL, sTitle);
            }
            catch (e)
            {
                try
                {
                    window.sidebar.addPanel(sTitle, sURL, "");
                }
                catch (e)
                {
                    var c = "ctrl";
                    if(navigator.platform.match(/mac/i)){
                        c = "command"
                    }
                    alert("您的浏览器不支持,请使用键盘上\n\n"+c+"+D\n\n进行收藏操作。");
                }
            }
            return false;
        }
        //生成快捷方式
        createShortcut = function(){
            var sname  =  document.title.replace(/\s/ig,'');
            var surl   =	 location.href;
            document.createshortcuts.furl.value = surl;
            document.createshortcuts.fname.value = sname;
            document.createshortcuts.submit();
        }
    }();
</script>
</body>

</html>