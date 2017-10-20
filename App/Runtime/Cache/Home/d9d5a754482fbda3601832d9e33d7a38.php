<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>用户注册</title>
	<link rel="stylesheet" href="/Public/resources/Home/style/base.css" type="text/css">
	<link rel="stylesheet" href="/Public/resources/Home/style/global.css" type="text/css">
	<link rel="stylesheet" href="/Public/resources/Home/style/header.css" type="text/css">
	<link rel="stylesheet" href="/Public/resources/Home/style/login.css" type="text/css">
	<link rel="stylesheet" href="/Public/resources/Home/style/footer.css" type="text/css">
	<script type="text/javascript" src="/Public/resources/Home//js/jquery-1.8.3.min.js"></script>
	<script type="text/javascript" src="/Public/layer/layer.js"></script>
    <script type="text/javascript" src="/Public/resources/Home//js/jquery.form.js"></script>
</head>
<body>
	<!-- 顶部导航 start -->
	<div class="topnav">
		<div class="topnav_bd w990 bc">
			<div class="topnav_left">
				
			</div>
			<div class="topnav_right fr">
				<ul>
					<li>您好，欢迎来到京西！[<a href="<?php echo U('user/login');?>">登录</a>] [<a href="<?php echo U('user/register');?>">免费注册</a>] </li>
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
	<div class="login w990 bc mt10 regist">
		<div class="login_hd">
			<h2>用户注册</h2>
			<b></b>
		</div>
		<div class="login_bd">
			<div class="login_form fl">
				<form action="" method="post">
					<ul>
						<li>
							<label for="">用户名：</label>
							<input type="text" class="txt" name="username" />
							<p>3-20位字符，可由中文、字母、数字和下划线组成</p>
						</li>
						<li>
							<label for="">密码：</label>
							<input type="password" class="txt" name="password" />
							<p>6-20位字符，可使用字母、数字和符号的组合，不建议使用纯数字、纯字母、纯符号</p>
						</li>
						<li>
							<label for="">确认密码：</label>
							<input type="password" class="txt" name="password" />
							<p> <span>请再次输入密码</span></p>
						</li>
						<li>
							<label for="">手机号：</label>
							<input type="text" class="txt" name="tel_number" id="tel_number"/>
							<p> <span>请输入手机号</span></p>
						</li>
						<li class="checkcode">
							<label for="">短信验证码：</label>
							<input type="text"  name="telcode" />
							<input type="button"  value="发送验证码" id="send_check_code" style="height: 30px"/>
						</li>
						<li>
							<label for="">&nbsp;</label>
							<input type="checkbox" class="chb" checked="checked" /> 我已阅读并同意《用户注册协议》
						</li>
						<li>
							<label for="">&nbsp;</label>
							<input type="submit" value="" class="login_btn" />
						</li>
					</ul>
				</form>

				
			</div>
			
			<div class="mobile fl">
				<h3>手机快速注册</h3>			
				<p>中国大陆手机用户，编辑短信 “<strong>XX</strong>”发送到：</p>
				<p><strong>1069099988</strong></p>
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
$(function () {
    $('form').submit(function () {
        $(this).ajaxSubmit({
            url:"<?php echo U('regist');?>",
            type:'post',
            dataType:'json',
            success:function (msg) {
//                console(msg);
                if(msg.status==200){
                    layer.msg(msg.msg);
                    setTimeout(function () {
                        location.href=msg.uri;
                    },3000);
                }else{
                    layer.msg(msg.msg);
                }
            }

        })
        return false;
    })
    //手机验证码
    // 绑定点击事件
    $("#send_check_code").click(function () {
        //获取手机号码
        var tel =  $('#tel_number').val();
        //正则验证手机号码
        if((/^1[34578]\d{9}$/.test(tel)))
        {   //ajax发起请求,发送手机验证码
            $.ajax({
                url:"<?php echo U('sendCheckCode');?>",
                data:'phone='+tel,
                type:'post',
                dataType:'json',
                success:function(msg){
                    if(msg.code == 200){
                        layer.msg(msg.info, {icon:6});
                        getTime();
                    }else if(msg.code == 202){
                        layer.msg(msg.info, {icon:5});
                    }
                }
            })
        }else{
            layer.alert('请填写正确手机号', {
                skin: 'layui-layer-molv' //样式类名
                ,closeBtn: 0
            })
        }
    })
    //注册
/*    $("#register_btn").click(function () {
        //获取手机号码
        var tel =  $('#tel_number').val();
        var tpl_checkCode =  $('#tel_checkCode').val();
//          console.log(tel);
        //正则验证手机号码
        $.ajax({
            url:"<?php echo U('tel_register');?>",
            data:'user_tel='+tel+'&codeNum='+tpl_checkCode,
            type:'post',
            dataType:'json',
            success:function(msg){
                if(msg.code == 200){
                    layer.msg(msg.info, {icon:6});
                    backUrl =msg.backUrl;
                    setTimeout( "window.location.href=backUrl",3000);
                }else if(msg.code == 202){
                    layer.msg(msg.info, {icon:5});
                }
            }
        })

    })*/

})
var itime = 59;//定义一个变量，倒计时初始化，从59秒开始
function getTime(){
    if(itime>=0){
        if(itime==0){
            //倒计时变成0时，
            //要清除计时器
            clearTimeout(act);
            //设置按钮为初始状态
            $("#send_check_code").val('重新发送');
            $("#send_check_code").prop("disabled",false);
            itime=59;
        }else{
            //延迟一秒中执行该函数。
            var act =  setTimeout('getTime()',1000);
            //把倒计时的秒显示到按钮中
            $("#send_check_code").val('还剩'+itime+'秒');
            itime=itime-1;
            $("#send_check_code").prop("disabled",true);
        }
    }
}
</script>

</body>
</html>