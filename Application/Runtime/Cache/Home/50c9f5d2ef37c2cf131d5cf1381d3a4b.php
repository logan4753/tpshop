<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>小H商城</title>
    <link rel="stylesheet" href="/Public/home/css/pub.css"/>
    <link rel="stylesheet" href="/Public/home/css/log.css"/>
    <link rel="stylesheet" href="/Public/home/css/color.css"/>
    <script src="/Public/home/js/jquery.min.js"></script>
    <script type="text/javascript" src="/Public/admin/lib/laypage/1.2/laypage.js"></script>
</head>
<body>
<!--header-->
<div class="zg-header cont clearfix">
    <a href="#" target="_blank" class="zg-header-logo fl"><img src="/Public/home/images/u_logo.jpg" width='150' height='60' alt="小H商城"/></a>
    <span class="zg-header-title fl">欢迎登陆</span>
</div>
<!--header-->
<!--banner-->
<div class="zg-banner">
    <div class="zg-banner-box cont">
        <div class="zg-banner-img">
            <img src="/Public/home/images/login_baner1.jpg" alt="" width="800" height="81"/>
            <img src="/Public/home/images/login_baner2.jpg" alt="" width="800" height="85"/>
            <img src="/Public/home/images/login_baner3.jpg" alt="" width="800" height="121"/>
            <img src="/Public/home/images/login_baner4.jpg" alt="" width="800" height="163"/>
        </div>
        <div class="zg-register">
            <div class="zg-register-top">
                <h3>登录</h3>
                <form id='form_info' class="form form-horizontal" action="<?php echo U('login/login');?>" method="post" onsubmit="return checkLogin();">
                    <div class="ipt_mail_w">
                        <div class="ipt_mail_c clearfix">
                            <b class="ipt_mail_iw"><i class="ipt_mail_i"></i></b>
                            <input type="text" placeholder="请输入邮箱" class="ipt_mail" name="username">
                        </div>
                    </div>
                    <div class="ipt_password_w">
                        <div class="ipt_password_c clearfix">
                            <b class="ipt_mail_iw"><i class="ipt_password_i"></i></b>
                            <input type="password" value="" placeholder="密码" class="ipt_password ipt_password" name='userpwd'>
                        </div>
                    </div>
                    <div class="ipt_code_w">
                        <div class="ipt_code_c">
                            <input type="text" placeholder="验证码" class="ipt_code" style="width:110px;margin-right:0 !important;" name='usercode'>
                            <img src="<?php echo U('login/showcode');?>" width="69" height="36">
                            <a id="blind" href="javascript:;">看不清,换一张</a>
                        </div>
                    </div>
                    <input type="submit" value="登录" class="nextStep">
                </form>
                <div class="zg-txt clearfix">
                    <label class="signIn_autoM"><i class="checked"></i>自动登录<input type="checkbox" id="order3_all"></label>
                    <a href="<?php echo U('login/findpwd');?>" class="forget fr">忘记密码？</a>
                </div>
            </div>
            <div class="zg-promptly-register clearfix">
                <a href="#" target="_blank" class="QQ"><i>&nbsp;</i>QQ</a>
                <a href="#" target="_blank" class="wb"><i>&nbsp;</i>微博</a>
                <a href="#" target="_blank" class="wx"><i>&nbsp;</i>微信</a>
                <a href="<?php echo U('login/register');?>" target="_blank" class="txt">立即注册</a>
            </div>
        </div>
    </div>
</div>
<!--banner-->

<!--footer-->
<div class="zg-footer-box">
    <p>Copyright © 2010-2016 小H商城 版权所有 保留一切权利</p>
    <p>京ICP备10218183号 京ICP证161188号 京公网安备 11010802020593号 出版物经营许可证新出发京批字第直130052号</p>
</div>
<!--footer-->
<script src="/Public/home/js/pub.js"></script>
<script src="/Public/home/js/content.js"></script>

<script type="text/javascript">
    $("#blind").click(function(){
        $(this).prev().attr('src',$(this).prev().attr('src'));
    });
    function checkLogin(){
            if($("input[name='username']").val() == ''){
                layer.msg('请输入用户名');
                return false;
            }
            if($("input[name='userpwd']").val() == ''){
                layer.msg('请输入密码');
                return false;
            }
            if($("input[name='usercode']").val() == ''){
                layer.msg('请输入验证码');
                return false;
            }
        }
</script>
</body>
</html>