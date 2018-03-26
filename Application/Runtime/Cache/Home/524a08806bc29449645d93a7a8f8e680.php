<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>千纸鹤商城</title>
<link rel="stylesheet" href="/Public/home/css/pub.css"/>
<link rel="stylesheet" href="/Public/home/css/log.css"/>
<link rel="stylesheet" href="/Public/home/css/color.css"/>
<script src="/Public/home/js/jquery.min.js"></script>
<style>
    .hidethis{display:none !important;}
</style>

</head>

<body>
<!--header-->
<div class="zg-header cont clearfix">
    <a href="#" target="_blank" class="zg-header-logo fl"><img src="/Public/home/images/u_logo.jpg" width='150' height='60' alt="小H商城"/></a>
    <span class="zg-header-title fl">欢迎注册</span>
</div>
<!--header-->

<div class="signUp_w">
	<div class="signUp signUp_1">
    	<h1>注册帐号</h1>
    	<form id='form_res' method='post' action="<?php echo U('login/register');?>">
        	<div class="ipt_mail_w">
                <div class="ipt_mail_c clearfix">
                    <b class="ipt_mail_iw"><i class="ipt_mail_i"></i></b>
                    <input type="text" id='username' name='username' value='' placeholder="请输入邮箱" class="ipt_mail">
                </div>
                <!-- <p class="error_info">请输入邮箱/邮箱已注册/邮箱格式错误</p> -->
            </div>
        	<div class="ipt_password_w">
                <div class="ipt_password_c clearfix">
                    <b class="ipt_mail_iw"><i class="ipt_password_i"></i></b>
                    <input type="password" id='password' name='password' value="" placeholder="密码" class="ipt_password ipt_password">
                </div>
                <!-- <p class="error_info">请输入密码/密码格式为6-20位字母数组组合</p> -->
            </div>
        	<div class="ipt_code_w">
                <div class="ipt_code_c">
                    <input type="text" placeholder="验证码" name='showcode' value='' class="ipt_code" style="width:190px;margin-right:0 !important;">
                    <img src="<?php echo U('login/showcode');?>" width="79" height="36"><a id="blind" href="javascript:;" style='font-size:14px;'>看不清,换一张</a>
                </div>
                <!-- <p class="error_info">请输入验证码</p> -->
            </div>
        	<input type="button" onclick='checkform()' value="注册" class="nextStep">
        </form>
    	<p class="login">已有帐号<a href="<?php echo U('login/login');?>">去登录</a></p>
    </div>
    <div class="signUp signUp_2 hidethis">
        <p>恭喜您注册成功！</p>
        <form>
            <a href='<?php echo U("login/login");?>' class='nextStep'>进入</a>       
        </form>        
    </div>
</div>

<!--footer-->
<div class="zg-footer-box">
    <p>Copyright © 2010-2016 小H商城 版权所有 保留一切权利</p>
    <p>京ICP备10218183号 京ICP证161188号 京公网安备 11010802020593号 出版物经营许可证新出发京批字第直130052号</p>
</div>
<!--footer-->

<script type="text/javascript" src="/Public/Admin/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
<script type="text/javascript" src="/Public/Admin/lib/layer/2.4/layer.js"></script>  
<script src="/Public/home/js/pub.js"></script>
<script type="text/javascript">
/*验证码刷新*/
$("#blind").click(function(){
    $(this).prev().attr('src',$(this).prev().attr('src'));
});
function checkform(){
    if($("input[name='username']").val() == ''){
        layer.msg('请输入用户名');
        return false;
    }else if($("input[name='password']").val() == ''){
        layer.msg('请输入密码');
        return false;
    }else if($("input[name='showcode']").val() == ''){
        layer.msg('请输入验证码');
        return false;
    }
    $.ajax({
        type:"POST",
        url:$('#form_res').attr("action"),
        data:$('#form_res').serialize(),
        dataType:'JSON',
        success:function(result){
            if(result.status == 1){
                $('div.signUp_1').addClass('hidethis');
                $('div.signUp_2').removeClass('hidethis');
            }
        }
    });
}
    
</script>
</body>
</html>