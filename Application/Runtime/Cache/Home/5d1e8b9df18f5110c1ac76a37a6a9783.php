<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>千纸鹤商城</title>
<link type="text/css" rel="stylesheet" href="/Public/home/css/pub.css" />
<link type="text/css" rel="stylesheet" href="/Public/home/css/index.css" />
<link type="text/css" rel="stylesheet" href="/Public/home/css/color.css" />
<script src="/Public/home/js/jquery.min.js"></script>
</head>
<body>

<!-- 公共头部 -->
<!--头部-->
<div class="header_w wrap">
	<div class="header cont">
    	<div class="fl">       	
            <?php if(empty($_SESSION['front']['userid'])): ?><font>欢迎来小H商城</font>
                <a href="<?php echo U('Login/login');?>" target="_blank" >请登录</a><span></span>
                <a href="<?php echo U('Login/register');?>" target="_blank" alt="">免费注册</a>
            <?php else: ?>
                <a href="<?php echo U('user/userinfo');?>" target="_blank" alt="">小H欢迎您:&nbsp;<?php echo ($_SESSION['front']['username']); ?></a><?php endif; ?>
        </div>
        <div class="fr header_r">
        	<a href="<?php echo U('user/myorder');?>" target="_blank" alt="">我的订单</a><span></span>
            <a href="#" target="_blank" alt="" class="moblieApp">移动APP</a><span></span>
            <a href="#" target="_blank" alt="">网站地图</a><span></span>
            <?php if(!empty($_SESSION['front']['userid'])): ?><a href="<?php echo U('Login/logout');?>" target="_blank" alt="" class="paddingR0">退出</a><?php endif; ?>
            <div class="mobileApp_QR">
            	<img src="/Public/home/images/mobileApp_QR.jpg" width="140" height="141" >
                <a href="#" target="_blank" class="iphone"><i></i>iphone下载</a>
                <a href="#" target="_blank" class="android"><i></i>Android下载</a>
            </div>
        </div>
    </div>
</div>

<!--头部 end -->
<link type="text/css" rel="stylesheet" href="/Public/home/css/content.css" />


<div class="order_head_info cont clearfix">
	<a href="#" alt="" class="fl"><img src="/Public/home/images/u_logo.jpg" width="150" height="60"></a><span class="header_title">结算页</span>
	<div class="order_pro clearfix">
    	<span class="pro_pre"><b>1</b>我的购物车</span>
    	<span class="pro_pre"><b>2</b>提交订单</span>
    	<span class="pro_active"><b>3</b>订单提交成功</span>
    </div>
</div>

<!--付款-->
<div class="order_step3 cont">
	<div class="order3_h clearfix">
    	<div class="order3_hl fl">
        	<!-- <img class="fl" src="/Public/home/images/good_s.jpg" width="66" height="66" alt=""> -->
            <p class="order3_p1">订单提交成功，请您尽快付款！</p>
            <p class="order3_p2">订单号：<span><?php echo ($neworder['ordernum']); ?></span><br/>请在24小时内完成支付，否则订单会自动取消</p>
        </div>
        <p class="order3_hr fr">支付金额：<font class="price">￥<?php echo ($neworder['allprice']); ?></font></p>
    </div>
    <div class="order3_c">
        <ul class="zgright-nav-ul fl order3_tabNav">
            <li><a href="#" class="active">储蓄卡</a></li>
            <li><a href="#">信用卡</a></li>
            <li><a href="#">支付宝</a></li>
            <li><a href="#">微信支付</a></li>
        </ul>
    	<div class="order3_tabC" style="display:block;">
        	<ul class="clearfix">
            	<li><img src="/Public/home/images/order3_bank1.jpg" width="226" height="56" alt=""></li>
            	<li><img src="/Public/home/images/order3_bank2.jpg" width="226" height="56" alt=""></li>
            	<li><img src="/Public/home/images/order3_bank3.jpg" width="226" height="56" alt=""></li>
            	<li><img src="/Public/home/images/order3_bank4.jpg" width="226" height="56" alt=""></li>
            	<li><img src="/Public/home/images/order3_bank5.jpg" width="226" height="56" alt=""></li>
            	<li><img src="/Public/home/images/order3_bank6.jpg" width="226" height="56" alt=""></li>
            	<li><img src="/Public/home/images/order3_bank7.jpg" width="226" height="56" alt=""></li>
            	<li><img src="/Public/home/images/order3_bank8.jpg" width="226" height="56" alt=""></li>
            	<li><img src="/Public/home/images/order3_bank9.jpg" width="226" height="56" alt=""></li>
            	<li><img src="/Public/home/images/order3_bank10.jpg" width="226" height="56" alt=""></li>
            	<li><img src="/Public/home/images/order3_bank11.jpg" width="226" height="56" alt=""></li>
            	<li class="moreBank"><a href="#">更多银行</a></li>
            </ul>
        	<a href="javascript:void(0);" class="hover_btn2">立即支付</a>
        </div>
    	<div class="order3_tabC">
        	<ul class="clearfix">
            	<li><img src="/Public/home/images/order3_bank7.jpg" width="226" height="56" alt=""></li>
            	<li><img src="/Public/home/images/order3_bank8.jpg" width="226" height="56" alt=""></li>
            	<li><img src="/Public/home/images/order3_bank9.jpg" width="226" height="56" alt=""></li>
            	<li><img src="/Public/home/images/order3_bank10.jpg" width="226" height="56" alt=""></li>
            	<li><img src="/Public/home/images/order3_bank11.jpg" width="226" height="56" alt=""></li>
            	<li class="moreBank"><a href="#">更多银行</a></li>
            </ul>
        	<a href="javascript:void(0);" class="hover_btn2">立即支付</a>
        </div>
    	<div class="order3_tabC">
        	<ul class="clearfix">
            	<li><img src="/Public/home/images/order3_bank_zfb.jpg" width="226" height="56" alt=""></li>
            </ul>
        	<a href="javascript:;" class="hover_btn2">立即支付</a>
        </div>
    	<div class="order3_tabC order2_pay_wx clearfix">
			<img src="/Public/home/images/order3_wx_QR.jpg" width="192" height="192" alt="">
            <p><i class="order2_wx_icon">&nbsp;</i>请使用微信扫描<br/>二维码以完成支付</p>
        </div>
    </div>

</div>

<!-- 支付提醒 -->
<div class="pay_info_W fixed_shadow_w">
	<div class="fixed_shadow pay_info_shadow"></div>
	<div class="fixed_shadow_c pay_info">
    	<p class="pay_info_t fixed_shadow_ct"><i class="fixed_close pay_info_close">&nbsp;</i>支付提示</p>
    	<p class="pay_info_m fixed_shadow_cm">请您在新打开的网上银行收银台进行支付</p>
        <p class="pay_info_b"><span class="pay_finished">已完成支付</span><a href="javascript:void(0);" class="changeMethod">选择其他方式</a></p>
    </div>
</div>

<!-- footer  -->

<div class="footer_w wrap">
	<div class="footer cont clearfix">
    	<dl>
        	<dt><a href="#" target="_blank" alt="">购物指南</a></dt>
            <dd><a href="#" target="_blank" alt="">购物流程</a></dd>
            <dd><a href="#" target="_blank" alt="">支付方式</a></dd>
            <dd><a href="#" target="_blank" alt="">配送方式</a></dd>
        </dl>    
    	<dl>
        	<dt><a href="#" target="_blank" alt="">售后服务</a></dt>
            <dd><a href="#" target="_blank" alt="">售后政策</a></dd>
            <dd><a href="#" target="_blank" alt="">价格保护</a></dd>
            <dd><a href="#" target="_blank" alt="">退款说明</a></dd>
            <dd><a href="#" target="_blank" alt="">返修/退换货</a></dd>
            <dd><a href="#" target="_blank" alt="">取消订</a></dd>
        </dl>
    	<dl>    
        	<dt><a href="#" target="_blank" alt="">配送方式</a></dt>
            <dd><a href="#" target="_blank" alt="">上门自提</a></dd>
            <dd><a href="#" target="_blank" alt="">211限时达</a></dd>
            <dd><a href="#" target="_blank" alt="">配送服务查询</a></dd>
            <dd><a href="#" target="_blank" alt="">配送费收取标准</a></dd>
            <dd><a href="#" target="_blank" alt="">海外配送</a></dd>
        </dl>
    	<dl>  
        	<dt><a href="#" target="_blank" alt="">支付方式 </a></dt>
            <dd><a href="#" target="_blank" alt="">网上支付</a></dd>
            <dd><a href="#" target="_blank" alt="">支付宝支付</a></dd>
            <dd><a href="#" target="_blank" alt="">邮局汇款</a></dd>
        </dl>     
    	<dl>   
        	<dt><a href="#" target="_blank" alt="">用户帮助</a></dt>
            <dd><a href="#" target="_blank" alt="">免费注册</a></dd>
            <dd><a href="#" target="_blank" alt="">找回密码</a></dd>
            <dd><a href="#" target="_blank" alt="">常见问题</a></dd>
            <dd><a href="#" target="_blank" alt="">优惠券使用</a></dd>
        </dl>  
    </div>
</div>
<p class="copyright">Copyright © 2010-2016 小H商城 版权所有 保留一切权利<br/>京ICP备10218183号 京ICP证161188号 京公网安备 11010802020593号 出版物经营许可证新出发京批字第直130052号</p>

<script src="/Public/home/js/index.js"></script>
</body>
</html>

<script src="/Public/home/js/pub.js"></script>
<script src="/Public/home/js/content.js"></script>
<script type="text/javascript">
$(function(){
    $('.hover_btn2').click(function(){
        var ordernum = $('p.order3_p2 span').text();
        $.post(
            "<?php echo U('cart/dopay');?>",
            {ordernum:ordernum},
            function(result){
                if(result.status == 1){
                    window.location.href = "<?php echo U('user/myorder');?>";
                }
            });
    })
})
</script>