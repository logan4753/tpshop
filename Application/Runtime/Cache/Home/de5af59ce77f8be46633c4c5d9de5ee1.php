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
                <a href="<?php echo U('user/userinfo');?>" target="_blank" alt="">小H欢迎您： <?php echo ($_SESSION['front']['username']); ?></a><?php endif; ?>
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
<script type="text/javascript" src="/Public/Admin/lib/layer/2.4/layer.js"></script> 
<script src="/Public/home/js/pub.js"></script>
<script src="/Public/home/js/content.js"></script>

<!--头部 end -->

<div class="order_head_info cont clearfix">
	<a href="#" alt="" class="fl"><img src="/Public/home/images/u_logo.jpg" width="150" height="60"></a><span class="header_title">购物车</span>
	<div class="order_pro clearfix">
    	<span class="pro_pre"><b>1</b>我的购物车</span>
    	<span class="pro_active"><b>2</b>提交订单</span>
    	<span class="pro_next"><b>3</b>订单提交成功</span>
    </div>
</div>

<!--购物车清单-->
<div class="order1_c cont">
	<form>
    <!-- 购物车清单内容 -->
	<dl>                                                                                                                                                   
    	<dt>
        	<span class="order1_h1"><label class="order1_checkbox order1_checkbox_total"><i></i>全选<input type="checkbox" id="order3_all"></label></span>
        	<span class="order1_h2">商品</span>
        	<span class="order1_h3">单价</span>
        	<span class="order1_h4">购买数量</span>
        	<span class="order1_h5">小计</span>
        	<span class="order1_h6">操作</span>
        </dt>
        <?php if(is_array($goodslist)): foreach($goodslist as $key=>$val): ?><dd class="active" gid="<?php echo ($val['goodsid']); ?>">
        	<span class="order1_d1"><label class="order1_checkbox"><i <?php if($val['status'] == 1): ?>class="checked"<?php endif; ?> /></i><input type="checkbox" id="order3_all" checked></label></span>
        	<span class="order1_d2">
                <div class="list_goods fl">
                    <a href="#"><img src="<?php echo ($val['image']); ?>" width="66" height="66"></a>
                    <p class="list_goods_name"><a href="#" title="<?php echo ($val['goodsname']); ?>"><?php echo ($val['aname']); ?></a></p>
                    <p class="list_goods_details"><span>颜色：红</span><span>型号：V1</span></p>
                </div>
            </span>
            <span class="order1_d3 order1_h3">￥<?php echo ($val['shopprice']); ?></span>
            <span class="order1_d4 order1_h4"><div class="amount_change" nid="<?php echo ($val['goodsid']); ?>"><b class="minus" onclick='minus(this,<?php echo ($val["goodsid"]); ?>)'>-</b><input type="text" value="<?php echo ($val['gcount']); ?>" disabled></input><b class='plusnum' onclick='plus(this,<?php echo ($val["goodsid"]); ?>)'>+</b></div></span>
            <span class="order1_d5 order1_h5"><font class="gwc_price"><?php echo ($val['gcount']*$val['shopprice']); ?></font></span>
            <span class="order1_h6 order1_d6"><a href="javascript:;" onclick="goodsdel(this,<?php echo ($val['goodsid']); ?>)">删除</a><a href="#">移入收藏夹</a></span>
        </dd><?php endforeach; endif; ?>
    </dl>
    <!-- 购物车结算 -->
    <div class="order1_balance clearfix">
    	<div class="fl"><span class="order1_h1"><label class="order1_checkbox order1_checkbox_total"><i></i>全选<input type="checkbox" id="order3_all"></label></span><a href="#">删除选中的商品</a></div>
    	<div class="fr order1_bar">
        	<span class="order1_barl fl">已选择<em class="colorB11"><?php echo ($goodscount); ?></em>件商品</span>
            <p class="fr">
            	<span>总价：￥<?php echo ($pricesum); ?></span>
                <span>优惠：￥0.00</span>
                <span>合计：<font class="price">￥<?php echo ($pricesum); ?></font></span>
            </p>
        </div>
    </div>
    <div class="order1_b"><a href="<?php echo U('index/index');?>" class="hover_btn1">继续购物</a><a href="<?php echo U('cart/ordersale');?>" class="hover_btn2">提交订单</a></div>
    </form>
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

<script type="text/javascript">
/*购物车商品-状态修改*/
$(function(){
    $('input').click(function(){
        var doid = $(this).parents('dd').attr('gid');
        var nclass = $(this).prev('i').attr('class');
        if(nclass == 'checked'){
            $.post(
                "<?php echo U('cart/number');?>",
                {id:doid,act:"uncheck"},
                function(result){
                    if(result.status==1){
                        $('div.order1_balance').children('div:eq(1)').children('span:eq(0)').children('em').text(result.gcount);
                        $('div.order1_balance').children('div:eq(1)').children('p.fr').children('span:eq(0)').text('总价：￥'+result.pricesum);
                        $('div.order1_balance').children('div:eq(1)').children('p.fr').children('span:eq(2)').children('font').text('￥'+result.pricesum);
                    }
                });
        }else if(!nclass){
            $.post(
                "<?php echo U('cart/number');?>",
                {id:doid,act:"docheck"},
                function(result){
                    if(result.status==1){
                        $('div.order1_balance').children('div:eq(1)').children('span:eq(0)').children('em').text(result.gcount);
                        $('div.order1_balance').children('div:eq(1)').children('p.fr').children('span:eq(0)').text('总价：￥'+result.pricesum);
                        $('div.order1_balance').children('div:eq(1)').children('p.fr').children('span:eq(2)').children('font').text('￥'+result.pricesum);
                    }
                });
        }
    })
})
/*购物车商品-数量增加*/
function plus(obj,id){
    var id = id;
    var number = $(obj).prev('input').val();
    if(number>=50){
        layer.msg('商品数量不能大于50');return;
    }
    $.post(
        "<?php echo U('cart/number');?>",
        {id:id,act:'plus'},
        function(result){
            if(result.status==1){
                $(result.goodslist).each(function(i,o){
                    if(o.goodsid == id){
                        $(obj).prev('input').val(o.gcount);
                        var theprice = (o.gcount*o.shopprice);
                        $(obj).parents('span.order1_d4').next('span.order1_d5').children('font').text(theprice);
                    }
                })                  
                $('div.order1_balance').children('div:eq(1)').children('span:eq(0)').children('em').text(result.gcount);
                $('div.order1_balance').children('div:eq(1)').children('p.fr').children('span:eq(0)').text('总价：￥'+result.pricesum);
                $('div.order1_balance').children('div:eq(1)').children('p.fr').children('span:eq(2)').children('font').text('￥'+result.pricesum);
            }
        });
    return;
}
/*购物车商品-数量减少*/
function minus(obj,id){
    var id = id;
    var number = $(obj).next('input').val();
    if(number<=1){
        layer.msg('商品数量不能少于1');return;
    }
    $.post(
        "<?php echo U('cart/number');?>",
        {id:id,act:'minus'},
        function(result){
            if(result.status==1){
                $(result.goodslist).each(function(i,o){
                    if(o.goodsid == id){
                        $(obj).next('input').val(o.gcount);
                        var theprice = o.gcount*o.shopprice;
                        $(obj).parents('span.order1_d4').next('span.order1_d5').children('font').text(theprice);
                    }
                })                  
                $('div.order1_balance').children('div:eq(1)').children('span:eq(0)').children('em').text(result.gcount);
                $('div.order1_balance').children('div:eq(1)').children('p.fr').children('span:eq(0)').text('总价：￥'+result.pricesum);
                $('div.order1_balance').children('div:eq(1)').children('p.fr').children('span:eq(2)').children('font').text('￥'+result.pricesum);
            }
        });
    return;
}
/*购物车商品-删除*/
function goodsdel(obj,id){
    if(!id){
        layer.confim('参数错误');
    }
    $.post(
        "<?php echo U('cart/goodsdel');?>",
        {id:id},
        function(result){
            if(result.status==1){                    
                var balance = $(obj).parents('dl').next('div').children('div:eq(1)');
                $(balance).children('span:eq(0)').children('em').text(result.goodscount);
                $(balance).children('p').children('span:eq(0)').text('总价：￥'+result.pricesum);
                $(balance).children('p').children('span:eq(2)').children('font').text('￥'+result.pricesum);
                $(obj).parents('dd').remove();
            }                
        });    
}
</script>