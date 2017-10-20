<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>登录商城</title>
	<link rel="stylesheet" href="/Public/resources/Home/style/base.css" type="text/css">
	<link rel="stylesheet" href="/Public/resources/Home/style/global.css" type="text/css">
	<link rel="stylesheet" href="/Public/resources/Home/style/header.css" type="text/css">
	<link rel="stylesheet" href="/Public/resources/Home/style/login.css" type="text/css">
	<link rel="stylesheet" href="/Public/resources/Home/style/footer.css" type="text/css">
	

	<script type="text/javascript" src="/Public/resources/Home/js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="/Public/layer/layer.js"></script>
    <script type="text/javascript" src="/Public/resources/Home/js/jquery.form.js"></script>
     <script type="text/javascript" src="/Public/resources/Home/js/mootools-1.3.js"></script>
    <script type="text/javascript" src="/Public/resources/Home/js/LightFace.js"></script>
    <script type="text/javascript" src="/Public/resources/Home/js/LightFace.IFrame.js"></script>

   
	<script type="text/javascript">
		var childWindow;
        function toQzoneLogin()
        {
            childWindow = window.open("<?php echo U('qqOAuth');?>","TencentLogin","width=450,height=320,menubar=0,scrollbars=1, resizable=1,status=1,titlebar=0,toolbar=0,location=1");
        }
        function closeChildWindow()
        {
            childWindow.close();
        }

	</script>
  
</head>
<body>
	<!-- 顶部导航 start -->
	<div class="topnav">
		<div class="topnav_bd w990 bc">
			<div class="topnav_left">
				
			</div>
			<div class="topnav_right fr">
				<ul>
					<li>您好，欢迎来到京西！[<a href="<?php echo U('user/login');?>">登录</a>] [<a href="<?php echo U('user/regist');?>">免费注册</a>] </li>
					<li class="line">|</li>
					<li>我的订单</li>
					<li class="line">|</li>
					<li>客户服务</li>

				</ul>
			</div>
		</div>
	</div>
	<!-- 顶部导航 end -->
	
	<div style="clear:both;"></div>

	<!-- 页面头部 start -->
	<div class="header w990 bc mt15">
		<div class="logo w990">
			<h2 class="fl"><a href="../Index/index.html"><img src="/Public/resources/Home/images/logo.png" alt="京西商城"></a></h2>
		</div>
	</div>
	<!-- 页面头部 end -->
	
	<!-- 登录主体部分start -->
	<div class="login w990 bc mt10">
		<div class="login_hd">
			<h2>用户登录</h2>
			<b></b>
		</div>
		<div class="login_bd">
			<div class="login_form fl">
				<form action="" method="post">
					<ul>
						<li>
							<label for="">用户名：</label>
							<input type="text" class="txt" name="username" id="username"/>
						</li>
						<li>
							<label for="">密码：</label>
							<input type="password" class="txt" name="password"  id="passwoed"/>
							<a href="">忘记密码?</a>
						</li>
						<li class="checkcode">
							<label for="">验证码：</label>
							<input type="text"  name="checkcode"  id="checkcode"/>
							<img src="<?php echo U('code');?>" alt="换一张" onclick="this.src='/Home/User/code/'+Math.random()"/>
							<span>看不清？<a href="" >换一张</a></span>
						</li>
						<li>
							<label for="">&nbsp;</label>
							<input type="checkbox" class="chb"  /> 保存登录信息
						</li>
						<li>
							<label for="">&nbsp;</label>
							<input type="submit" value="" class="login_btn" id='login_btn'/>
						</li>
					</ul>
				</form>

				<div class="coagent mt15">
					<dl>
						<dt>使用合作网站登录商城：</dt>
						<dd class="qq"><a href="" onclick='toQzoneLogin()'><span></span>QQ</a></dd>
						<dd class="weibo"><a href=""><span></span>新浪微博</a></dd>
						<dd class="yi"><a href=""><span></span>网易</a></dd>
						<dd class="renren"><a href=""><span></span>人人</a></dd>
						<dd class="qihu"><a href=""><span></span>奇虎360</a></dd>
						<dd class="baidu"><a href="" id="loginwithbaidu"><span></span>百度</a></dd>
						<dd class="douban"><a href=""><span></span>豆瓣</a></dd>
					</dl>
				</div>
			</div>
			
			<div class="guide fl">
				<h3>还不是商城用户</h3>
				<p>现在免费注册成为商城用户，便能立刻享受便宜又放心的购物乐趣，心动不如行动，赶紧加入吧!</p>

				<a href="regist.html" class="reg_btn">免费注册 >></a>
			</div>

		</div>
	</div>
	<!-- 登录主体部分end -->

	<div style="clear:both;"></div>
	<!-- 底部版权 start -->
	<div class="footer w1210 bc mt15">
		<p class="links">
			<a href="">关于我们</a> |
			<a href="">联系我们</a> |
			<a href="">人才招聘</a> |
			<a href="">商家入驻</a> |
			<a href="">千寻网</a> |
			<a href="">奢侈品网</a> |
			<a href="">广告服务</a> |
			<a href="">移动终端</a> |
			<a href="">友情链接</a> |
			<a href="">销售联盟</a> |
			<a href="">京西论坛</a>
		</p>
		<p class="copyright">
			 © 2005-2013 京东网上商城 版权所有，并保留所有权利。  ICP备案证书号:京ICP证070359号 
		</p>
		<p class="auth">
			<a href=""><img src="/Public/resources/Home/images/xin.png" alt="" /></a>
			<a href=""><img src="/Public/resources/Home/images/kexin.jpg" alt="" /></a>
			<a href=""><img src="/Public/resources/Home/images/police.jpg" alt="" /></a>
			<a href=""><img src="/Public/resources/Home/images/beian.gif" alt="" /></a>
		</p>
	</div>
	<!-- 底部版权 end -->
  <script type="text/javascript">
//      $(function () {
          //实现使用jQueryForm实现表单提交
          $('form').submit(function(){
              //具体实现使用jqueryForm的方式ajax提交
              $(this).ajaxSubmit({
                  url:"<?php echo U('login');?>",//指定表单的提交地址
                  type:'post',//表示具体的请求类型 post/get
                  dataType:'json',//指定数据交互格式
                  success:function(msg){
                      if(msg.status==200){
                          //表示提交注册成功
                          layer.msg(msg.msg);
//                          console.log(msg.uri);
                          setTimeout(function () {
                              location.href=msg.uri;
                          },3000);
                      }else{
                          layer.msg(msg.msg);
                      }
                  }
              });
              //阻止当前的表单默认的提交
              return false;
          });
//      });
 
//
            
//  $(function () {
 /* $('#login_btn').click(function () {
      var data={
          username:$('#username').val(),
          password : $('#password').val(),
          checkcode:$('#checkcode').val()
      }
      $.ajax({
          url:"<?php echo U('login');?>",
          data:data,
          type:'post',
          dataType:'json',
          success:function (msg) {
              if(msg.status==200){
                  location.href='/';
              }else{
                  layer.msg(msg.msg);
              }

          }
      })
  })*/
//  })
//$('#loginwithbaidu').click(function () {
//    $.ajax({
//        url:"<?php echo U('bdLogin');?>",
//        type:'get',
//        success:function (msg) {
        document.id('loginwithbaidu').addEvent('click',function() {
            //获得窗口的垂直位置
            var iTop = (window.screen.availHeight-30-320)/2;
            //获得窗口的水平位置
            var iLeft = (window.screen.availWidth-10-500)/2;
            window.open(<?php echo ($bdLogin); ?>, 'newwindow',
                'height=320, width=500, top=' + iTop + ', left=' + iLeft +
                ', toolbar=no, menubar=no, ' +
                'scrollbars=no, resizable=no, location=no, status=no');
        });
//        }
//    })
//
//})


    </script>


</body>
</html>