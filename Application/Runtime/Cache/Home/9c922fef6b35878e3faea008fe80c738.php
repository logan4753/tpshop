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
<link type="text/css" rel="stylesheet" href="/Public/home/css/content.css" />
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
<style type="text/css">
    .listL li a.productName{height: 40px;}
    a:hover{color:red !important;}
</style>
<script src="/Public/home/js/pub.js"></script>
<script src="/Public/home/js/content.js"></script>

<!--头部下方导航-->
<div class="header_b cont">
    <a href="#" alt="" class="fl"><img src="/Public/home/images/u_logo.jpg" width="150" height="62"></a>
    <div class="header_search fl">
        <form method='post' action="<?php echo U('index/getgoods');?>">
            <input type="text" value="<?php if(empty($search)): ?>手机<?php else: echo ($search); endif; ?>" name='search' class="header_text fl" onBlur="if(value==''){value='手机'}" onFocus="if(value=='手机')value='';">
            <input type="submit" value="搜索" class="header_sub fr">
        </form>
    </div>
    <!-- header-购物车  -->
    <div class="header_gwc fr">
        <?php $cartgoods = getcart(); ?>
        <a href="<?php echo U('cart/cartorder');?>" alt="" class="header_gwc_h"><i class="icon_gwc">&nbsp;</i>购物车<i class="i_num"><?php echo ($cartgoods['goodscount']); ?></i><b class="bgfff">&nbsp;</b></a>
        <div class="header_nogoods gwc_list">
            <i>&nbsp;</i>购物车中还没有商品，赶紧选购吧！
        </div>
        <div class="header_goods gwc_list">
            <h6>最新加入的商品</h6>
            <ul>
                <?php if(is_array($cartgoods['goodslist'])): foreach($cartgoods['goodslist'] as $key=>$vo): ?><li>
                    <p class="gwc_r fr">
                        <span class="gwc_price">￥<?php echo ($vo['shopprice']); ?></span><font class="gwc_amount">×<?php echo ($vo['gcount']); ?></font><br/>
                        <a href="#" class="gwc_delete">删除</a>
                    </p>
                    <img src="<?php echo ($vo['image']); ?>" width="49" height="49">
                    <a href="#" title="<?php echo ($vo['goodsname']); ?>"><?php echo ($vo['aname']); ?></a>
                </li><?php endforeach; endif; ?>
            </ul>
            <div class="gwc_total">共<b><?php echo ($cartgoods['goodscount']); ?></b>件商品&nbsp;&nbsp;共计<b>￥<?php echo ($cartgoods['pricesum']); ?></b><a href="<?php echo U('cart/cartorder');?>" class="fr">去结算</a></div>
        </div>
    </div>
    <!-- header-购物车 end  -->
</div>
<div class="nav_w wrap">        
    <div class="nav cont">
        <div class="nav_r fr">
            <a href="<?php echo U('index/index');?>" alt="">首页</a>
            <a href="<?php echo U('index/getgoods',array('cateid'=>1));?>" alt="">家用电器</a>
            <a href="<?php echo U('index/getgoods',array('cateid'=>2));?>" alt="">手机数码</a>
            <a href="<?php echo U('index/getgoods',array('cateid'=>3));?>" alt="">电脑办公</a>
            <a href="<?php echo U('index/getgoods',array('cateid'=>4));?>" alt="">家装家居</a>
            <a href="<?php echo U('index/getgoods',array('cateid'=>5));?>" alt="">服饰内衣</a>
            <a href="<?php echo U('index/getgoods',array('cateid'=>6));?>" alt="">美妆个护</a>
            <a href="<?php echo U('index/getgoods',array('cateid'=>8));?>" alt="">户外运动</a>
            <a href="<?php echo U('index/getgoods',array('cateid'=>9));?>" alt="">食品</a>
        </div>
        <div class="nav_l fl">           
            <h3>全部商品分类<i class="hide">&nbsp;</i></h3>
            <ul class="nav_snav hide">
            <?php $datacat = getcates(); ?>
            <?php if(is_array($datacat)): foreach($datacat as $key=>$val): ?><li><a href="<?php echo U('index/getgoods',array('cateid'=>$val['id']));?>" target="_blank" alt="" onid="<?php echo ($val['id']); ?>"><i>></i><?php echo ($val['catename']); ?></a></li><?php endforeach; endif; ?>
            </ul>
            <?php if(is_array($datacat)): foreach($datacat as $key=>$va): ?><ul class="nav_snav_con">
                <?php if(is_array($va['children'])): foreach($va['children'] as $key=>$v): ?><li>
                        <h6><a href="<?php echo U('index/getgoods',array('cateid'=>$v['id']));?>" target="_blank" alt=""><?php echo ($v['catename']); ?>&nbsp;></a></h6>                             
                        <p>
                            <?php if(is_array($v['children'])): foreach($v['children'] as $key=>$vv): ?><a href="<?php echo U('index/getgoods',array('cateid'=>$vv['id']));?>" target="_blank" alt="" <?php if($vv["ishot"] == 1): ?>class="hot"<?php endif; ?>><?php echo ($vv['catename']); ?></a><?php endforeach; endif; ?>
                        </p>
                    </li><?php endforeach; endif; ?>
            </ul><?php endforeach; endif; ?>
        </div>
    </div>

</div>
<!--头部下方导航   end  -->


<!-- 公共头部  end -->
<!--  content start-->
<!-- select -->

<div class="l_select cont clearfix">
	<p class="site"><a href="<?php echo U('index/index');?>" alt="">首页</a>&nbsp;
    <?php if(empty($search)): if(is_array($catelist)): foreach($catelist as $key=>$val): ?>>&nbsp;<a href="<?php echo U('index/getgoods',array('cateid'=>$val['id']));?>" alt="" <?php if($val['id'] == $cate1['id']): ?>class='current'<?php endif; ?> target='_blank' /><?php echo ($val['catename']); ?></a><?php endforeach; endif; ?>
    <?php else: ?>
        >&nbsp;<a href="#" alt="" class='current' /><?php echo ($search); ?></a><?php endif; ?>
   </p>
	<!-- <div>
    	<dl>
        	<dt><a href="#" alt=""><i>></i>当季流行</a></dt>
            <dd>
            	<span><a href="#" alt="">2016当季新品</a></span>
            	<span><a href="#" alt="">商场同款</a></span>
            	<span><a href="#" alt="">独家首发</a></span>
            	<span><a href="#" alt="">时尚连衣裙</a></span>
            	<span><a href="#" alt="">针织衫</a></span>
            	<span><a href="#" alt="">印花卫衣</a></span>
            	<span><a href="#" alt="">衬衫</a></span>
            	<span><a href="#" alt="">短外套</a></span>
            	<span><a href="#" alt="">短外套</a></span>
            </dd>
            <dd class="more"><span>更多</span></dd>
        </dl>    
    </div> -->
</div>

<div class="l_content cont clearfix">
<!--商品推荐-->
	<div class="sptj fl">
        <h4><a href="#" alt="">商品推荐</a></h4>
        <ul class="listI fl">
            <?php if(is_array($goodsshow)): foreach($goodsshow as $key=>$vcx): ?><li>
                <a href="<?php echo U('index/getdetail',array('id'=>$vcx['id']));?>" alt=""><img src="<?php echo ($vcx['image']); ?>" width="130" height="130" alt=""></a>
                <a href="<?php echo U('index/getdetail',array('id'=>$vcx['id']));?>" alt="" title="<?php echo ($vcx['goodsname']); ?>"><?php echo ($vcx['aname']); ?></a>
                <span class="price">￥<?php echo ($vcx['shopprice']); ?></span> 
            </li><?php endforeach; endif; ?>     
        </ul>
	</div>
    
<!--商品推荐 end -->

	<div class="l_list fr">
    	<div class="l_list_t clearfix">
        	<div class="l_lt_l fl">
            	<span>综合排序<i class="down">&nbsp;</i></span>
            	<span class="border0">人气<i class="up">&nbsp;</i></span>
            	<span>价格<i class="up">&nbsp;</i></span>
            </div>
        	<div class="l_lt_r fr">
            	<b>共<?php echo ($count); ?>件商品</b>
                <b><font>1</font>/11</b>
                <span></span>
                <span class="border0 active"></span>
            </div>
        
        </div>
    	       
        <ul class="listL">
            <?php if(is_array($goods)): foreach($goods as $key=>$val): ?><li>
                    <a href="<?php echo U('index/getdetail',array('id'=>$val['id']));?>" alt="" target='_blank'><img src="<?php echo ($val['image']); ?>" width="195" height="200" ></a>
                    <span class="price">￥<?php echo ($val['shopprice']); ?></span>
                    <a href="<?php echo U('index/getdetail',array('id'=>$val['id']));?>" alt="" target='_blank' title="<?php echo ($val['goodsname']); ?>"><?php echo ($val['aname']); ?></a>
                    <a href="#" alt="" class="comment">已有<b><?php echo ($val['comment']); ?></b>人评价</a>
                    <div class="listL_b"><a  href="javascript:;" cartid="<?php echo ($val['id']); ?>" class="gwc_ad"><i>&nbsp;</i>加入购物车</a><a href="javascript:;" colid="<?php echo ($val['id']); ?>" class="collect">喜欢</a></div>
                </li><?php endforeach; endif; ?>       
        </ul>
        
        <!-- pages -->
    	<div class="pages">
    		<a class="pages_pre" href="#" title="上一页">上一页</a><a  href="#"class="active">1</a><a href="#">2</a><a href="#">3</a><a href="#">4</a><a href="#">5</a><span>…</span><a href="#" class="pages_next" title="下一页">下一页</a><span>共100页，到第<input type="text" class="pages_ipt focusBorder">页</span><label class="pages_btn_w"><input type="submit" value="确定" class="pages_btn"></label>
        </div>
    
    </div>
</div>

<script type="text/javascript" src="/Public/Admin/lib/layer/2.4/layer.js"></script> 
<script type="text/javascript">   
$(function(){
    /*加入收藏*/
    $('.collect').click(function(){
        var userid = "<?php echo session('front.userid'); ?>";
        if(!userid){
            layer.msg('请先进行登录');return;
        }
        var colid = $(this).attr('colid');
        if(!colid){
            layer.msg('参数错误');return;
        }
        $.post(
            "<?php echo U('user/addcol');?>",
            {colid:colid},
            function(result){
                if(result.status == 1){
                    layer.msg('加入收藏成功');return;
                }else if(result.status == 2){
                    layer.msg('该商品已收藏，请勿重复收藏');return;
                }
        });
    });
    /*加入购物车*/
    $('.gwc_ad').on('click',function(){
        var userid = "<?php echo session('front.userid'); ?>";
        if(!userid){
            layer.msg('请先进行登录');return;
        }
        var cartid = $(this).attr('cartid');
        var cartcount = 1;
        $.post(
            "<?php echo U('cart/cartadd');?>",
            {
                cartid:cartid,
                cartcount:cartcount
            },
            function(result){
                if(result.status==1){
                    var cartli = '';
                    $(result.cart.goodslist).each(function(o,i){
                        cartli += "<li><p class='gwc_r fr'><span class='gwc_price'>￥"+i.shopprice;
                        cartli += "</span><font class='gwc_amount'>×"+i.gcount+"</font><br/>";
                        cartli += "<a href='#' class='gwc_delete'>删除</a></p>";
                        cartli += "<img src='"+i.image+"' width='49' height='49'>";
                        cartli += "<a href='#' title='"+i.goodsname+"'>"+i.aname+"</a></li>";
                    });
                    $('.header_goods').children('ul').html(cartli);
                    $('.header_gwc').children('div.header_goods').show();
                     $('.header_gwc').children('div.header_nogoods').hide();
                    $('.gwc_total').children('b:eq(0)').text(result.cart.goodscount);
                    $('.gwc_total').children('b:eq(1)').text('￥'+result.cart.pricesum); 
                    $('.header_gwc_h').children('i:eq(1)').text(result.cart.goodscount);
                }
        });
    })
})
</script>
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