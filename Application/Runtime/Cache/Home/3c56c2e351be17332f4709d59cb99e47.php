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

<p class="site cont">
    <?php if(is_array($catelist)): foreach($catelist as $key=>$val): ?><a href="<?php echo U('index/getgoods',array('cateid'=>$val['id']));?>" alt=""><?php echo ($val['catename']); ?></a>&nbsp;>&nbsp;<?php endforeach; endif; ?>
    <a href="<?php echo U('index/getgoods',array('search'=>$brand['brandname']));?>" alt=""><?php echo ($brand['brandname']); ?></a>&nbsp;>&nbsp;
    <a href="#" alt=""><?php echo ($goodsrow['goodsname']); ?></a>
</p>

<div class="s_main1 cont clearfix">
	<div class="s_m1r fr">
    	<h1><?php echo ($goodsrow['goodsname']); ?></h1>
    	<!-- <p class="s_m1r_p1">
            <span class="colorChange">【11.11提前抢】</span>雾霾强势来袭，别怕！京东陪你对抗雾霾！
            <a href="#" target="_blank" class="colorChange">点击查看活动详情！</a>
        </p> -->
        <div class="s_m1r_div1"> 
       		<em class="s_m1_collect"><i class="star_w">&nbsp;</i>收藏</em>
        	<p class="s_m1_price">
                <span>售&nbsp;&nbsp;价</span>
                <strong><?php echo ($goodsrow['shopprice']); ?></strong>
                <font><i></i>降价通知</font>
            </p>
        	<p class="s_m1_assess">
                <span>累计评价</span>&nbsp;
                <a href="#"><?php echo ($goodsrow['comment']); ?></a>
            </p>
        	<p class="s_m1_carriage">
                <span>运&nbsp;&nbsp;费</span>&nbsp;
                <b><?php if($goodsrow['isfree'] == 1): ?>包邮<?php else: echo ($goodsrow['carriage']); endif; ?></b>
            </p>
        </div>
        <div class="s_m1r_div2">
        	<!-- <div class="s_m1_size s_m1r_divC">
            	<span>选择型号</span>
            	<a href="#" class="active"><font>S</font><i></i></a><a href="#"><font>M</font><i></i></a><a href="#"><font>L</font><i></i></a><a href="#"><font>XL</font><i></i></a><a href="#"><font>XXL</font><i></i></a>
            </div> -->
        	<div class="s_m1_amount">
            	<span>购买数量</span>
                <div class="amount_change"><b class="invalid">-</b><input type="text" value="1"></input><b class="">+</b></div>
            </div>
        </div>
        <div class="s_m1r_div3">
        	<a href="javascript:;" adid="<?php echo ($goodsrow['id']); ?>" class="addGoods"><i>&nbsp;</i>加入购物车</a>
        	<a href="#" target="_blank" class="buyGoods">立即购买</a>
        </div>
    </div>
    
    <!-- 放大镜  -->
    
    <div class="imgBox fl" id="imgBox">  
        <div class="smallImg" id="small-box">
            <div class="mark" id="mark"></div>   
            <div class="float-box" id="float-box"></div>   
            <img src="<?php echo ($image[0]); ?>">
            <div class="i_magnifier"><i class="i_shadow"></i><i>&nbsp;</i></div>
        </div>
        <div class="big_box" id="big-box"><img src="<?php echo ($image[0]); ?>"/></div>  
        <div class="allImg_w">
        	<span class="d_pre"><i>&nbsp;</i></span>
            <div class="allImg">
                <ul>
                    <?php if(is_array($image)): $k = 0; $__LIST__ = $image;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><li class="current"><a href="#" target="_blank"><img src="<?php echo ($vo); ?>" /></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </div>
            <span class="d_next"><i>&nbsp;</i></span>
        </div>
	</div> 
    
    <!-- 放大镜 end  -->
</div>
<div class="sucess_tips">
	<div class="shadow"></div>
    <div class="sucess_tips_c">
        <i>&nbsp;</i>商品已成功加入购物车！
        <a href="#" target="_blank">去结算</a>
    </div>
</div>


<div class="cont s_main2 clearfix">
	<!--商品推荐-->
	<div class="sptj fl">
        <h4><a href="#" alt="">商品推荐</a></h4>
        <ul class="listI fl">
            <li>
                <a href="#" alt=""><img src="" width="130" height="130" alt=""></a>
                <a href="#" alt="">海信（Hisense)<br/>LED55EC760UC 55英寸曲面</a>
                <span class="price">￥4999.00</span> 
            </li>
            <li>
                <a href="#" alt=""><img src="" width="130" height="130" alt=""></a>
                <a href="#" alt="">海信（Hisense)<br/>LED55EC760UC 55英寸曲面</a>
                <span class="price">￥4999.00</span> 
            </li>
        
        </ul>
	</div>
    
<!--商品推荐 end -->
	<div class="s_m2_r fr">
        <div class="tabBar" id="tabBar">
            <div class="fixed_bg_t"></div>
            <ul class="s_m2_rt_h">
                <li class="active"><a href="javascript:;">商品介绍</a></li>
                <li><a href="javascript:;">商品评价<span class="colorB11">(7000+)</span></a></li>
                <li><a href="javascript:;">售后保障</a></li>
                <li class="addGoods"><a href="#" target="_blank"><i>&nbsp;</i>加入购物车</a></li>
            </ul>
            <div class="fixed_bg_b"></div>
        </div>

        
        <!-- 商品详情 -->

        <div class="s_m2_r_content s_details">
            <?php echo htmlspecialchars_decode($goodsrow['info']);?>
        </div>
        <!-- 商品详情 end -->
        
        <!-- 商品评价 -->
        <div class="s_m2_r_content s_review">
        	<div class="s_review_sum clearfix">
            	<span class="s_review_sl fl">98%</span>
                <ul class="s_review_sm fl">
                	<li class="good"><font>好评(95%)</font><span><i>&nbsp;</i></span></li>
                	<li class="common"><font>中评(3%)</font><span><i>&nbsp;</i></span></li>
                	<li class="bad"><font>差评(2%)</font><span><i>&nbsp;</i></span></li>
                </ul>
				<a href="#" class="s_review_evalute fr">我要评价</a>
            </div>
            <div class="s_review_tab">
            	<span class="active">全部评价</span>
            	<span>好评</span>
            	<span>中评</span>
            	<span>差评</span>
            </div>
            
            <div class="s_review_tabDiv" style="display:block">
                <div class="s_review_c">
                    <div class="s_review_cl fl">
                        <span class="review_star"></span>
                        <p>上身是针织的，腰围跟雪纺连接处是牛筋的，弹性很大，所以穿起来很轻松，也很舒服。 做工非常好，我仔细看下几遍，没发现有问题 跟图片一样，没有色差 客服很耐心，对他们的服务很满意</p>
                    </div>
                    <div class="s_review_cr fr">
                    	<span>漂***草（匿名）</span>
                        <span class="review_date">2016-10-16 23:13</span>
                    </div>
                </div>
                <div class="s_review_c">
                    <div class="s_review_cl fl">
                        <span class="review_star review_star1"></span>
                        <p>上身是针织的，腰围跟雪纺连接处是牛筋的，弹性很大，所以穿起来很轻松，也很舒服。 做工非常好，我仔细看下几遍，没发现有问题 跟图片一样，没有色差 客服很耐心，对他们的服务很满意</p>
                        <ul class="review_img">
                        	<li class="active"><img src="/Public/home/images/details_m2.jpg" width="46" height="46"><i>&nbsp;</i></li>
                        	<li><img src="/Public/home/images/details_m1.jpg" width="46" height="46"><i>&nbsp;</i></li>
                        	<li><img src="/Public/home/images/details_m3.jpg" width="46" height="46"><i>&nbsp;</i></li>
                        	<li><img src="/Public/home/images/details_m2.jpg" width="46" height="46"><i>&nbsp;</i></li>
                        </ul>
                        <div class="review_img_l">
                        	<img src="">
                        </div>
                    </div>
                    <div class="s_review_cr fr">
                    	<span>漂***草（匿名）</span>
                        <span class="review_date">2016-10-16 23:13</span>
                    </div>
                </div>
                <div class="s_review_c">
                    <div class="s_review_cl fl">
                        <span class="review_star review_star4"></span>
                        <p>上身是针织的，腰围跟雪纺连接处是牛筋的，弹性很大，所以穿起来很轻松，也很舒服。 做工非常好，我仔细看下几遍，没发现有问题 跟图片一样，没有色差 客服很耐心，对他们的服务很满意</p>
                    </div>
                    <div class="s_review_cr fr">
                    	<span>漂***草（匿名）</span>
                        <span class="review_date">2016-10-16 23:13</span>
                    </div>
                </div>
                
                <!-- pages -->
                <div class="pages pagesR">
                    <a class="pages_pre" href="#" title="上一页">上一页</a><a  href="#"class="active">1</a><a href="#">2</a><a href="#">3</a><a href="#">4</a><a href="#">5</a><span>…</span><a href="#" class="pages_next" title="下一页">下一页</a>
                </div>
            </div>
            <div class="s_review_tabDiv">
                <div class="s_review_c">
                    <div class="s_review_cl fl">
                        <span class="review_star review_star5"></span>
                        <p>上身是针织的，腰围跟雪纺连接处是牛筋的，弹性很大，所以穿起来很轻松，也很舒服。 做工非常好，我仔细看下几遍，没发现有问题 跟图片一样，没有色差 客服很耐心，对他们的服务很满意</p>
                    </div>
                    <div class="s_review_cr fr">
                    	<span>漂***草（匿名）</span>
                        <span class="review_date">2016-10-16 23:13</span>
                    </div>
                </div>
                <div class="s_review_c">
                    <div class="s_review_cl fl">
                        <span class="review_star review_star5"></span>
                        <p>上身是针织的，腰围跟雪纺连接处是牛筋的，弹性很大，所以穿起来很轻松，也很舒服。 做工非常好，我仔细看下几遍，没发现有问题 跟图片一样，没有色差 客服很耐心，对他们的服务很满意</p>
                        <ul class="review_img">
                        	<li class="active"><img src="/Public/home/images/details_m2.jpg" width="46" height="46"><i>&nbsp;</i></li>
                        	<li><img src="/Public/home/images/details_m1.jpg" width="46" height="46"><i>&nbsp;</i></li>
                        	<li><img src="/Public/home/images/details_m3.jpg" width="46" height="46"><i>&nbsp;</i></li>
                        	<li><img src="/Public/home/images/details_m2.jpg" width="46" height="46"><i>&nbsp;</i></li>
                        </ul>
                        <div class="review_img_l">
                        	<img src="">
                        </div>
                    </div>
                    <div class="s_review_cr fr">
                    	<span>漂***草（匿名）</span>
                        <span class="review_date">2016-10-16 23:13</span>
                    </div>
                </div>
                <div class="s_review_c">
                    <div class="s_review_cl fl">
                        <span class="review_star review_star4"></span>
                        <p>上身是针织的，腰围跟雪纺连接处是牛筋的，弹性很大，所以穿起来很轻松，也很舒服。 做工非常好，我仔细看下几遍，没发现有问题 跟图片一样，没有色差 客服很耐心，对他们的服务很满意</p>
                    </div>
                    <div class="s_review_cr fr">
                    	<span>漂***草（匿名）</span>
                        <span class="review_date">2016-10-16 23:13</span>
                    </div>
                </div>
                <div class="s_review_c">
                    <div class="s_review_cl fl">
                        <span class="review_star review_star4"></span>
                        <p>上身是针织的，腰围跟雪纺连接处是牛筋的，弹性很大，所以穿起来很轻松，也很舒服。 做工非常好，我仔细看下几遍，没发现有问题 跟图片一样，没有色差 客服很耐心，对他们的服务很满意</p>
                    </div>
                    <div class="s_review_cr fr">
                    	<span>漂***草（匿名）</span>
                        <span class="review_date">2016-10-16 23:13</span>
                    </div>
                </div>
                <div class="s_review_c">
                    <div class="s_review_cl fl">
                        <span class="review_star review_star4"></span>
                        <p>上身是针织的，腰围跟雪纺连接处是牛筋的，弹性很大，所以穿起来很轻松，也很舒服。 做工非常好，我仔细看下几遍，没发现有问题 跟图片一样，没有色差 客服很耐心，对他们的服务很满意</p>
                    </div>
                    <div class="s_review_cr fr">
                    	<span>漂***草（匿名）</span>
                        <span class="review_date">2016-10-16 23:13</span>
                    </div>
                </div>
                
                <!-- pages -->
                <div class="pages pagesR">
                    <a class="pages_pre" href="#" title="上一页">上一页</a><a  href="#"class="active">1</a><a href="#">2</a><a href="#">3</a><a href="#">4</a><a href="#">5</a><span>…</span><a href="#" class="pages_next" title="下一页">下一页</a>
                </div>
            </div>
            <div class="s_review_tabDiv">
                <div class="s_review_c">
                    <div class="s_review_cl fl">
                        <span class="review_star review_star2"></span>
                        <p>上身是针织的，腰围跟雪纺连接处是牛筋的，弹性很大，所以穿起来很轻松，也很舒服。 做工非常好，我仔细看下几遍，没发现有问题 跟图片一样，没有色差 客服很耐心，对他们的服务很满意</p>
                    </div>
                    <div class="s_review_cr fr">
                    	<span>漂***草（匿名）</span>
                        <span class="review_date">2016-10-16 23:13</span>
                    </div>
                </div>
                <div class="s_review_c">
                    <div class="s_review_cl fl">
                        <span class="review_star review_star3"></span>
                        <p>上身是针织的，腰围跟雪纺连接处是牛筋的，弹性很大，所以穿起来很轻松，也很舒服。 做工非常好，我仔细看下几遍，没发现有问题 跟图片一样，没有色差 客服很耐心，对他们的服务很满意</p>
                    </div>
                    <div class="s_review_cr fr">
                    	<span>漂***草（匿名）</span>
                        <span class="review_date">2016-10-16 23:13</span>
                    </div>
                </div>
                
                <!-- pages -->
                <div class="pages pagesR">
                    <a class="pages_pre" href="#" title="上一页">上一页</a><a  href="#"class="active">1</a><a href="#">2</a><a href="#">3</a><a href="#">4</a><a href="#">5</a><span>…</span><a href="#" class="pages_next" title="下一页">下一页</a>
                </div>
            </div>
            <div class="s_review_tabDiv">
                <div class="s_review_c">
                    <div class="s_review_cl fl">
                        <span class="review_star review_star1"></span>
                        <p>上身是针织的，腰围跟雪纺连接处是牛筋的，弹性很大，所以穿起来很轻松，也很舒服。 做工非常好，我仔细看下几遍，没发现有问题 跟图片一样，没有色差 客服很耐心，对他们的服务很满意</p>
                    </div>
                    <div class="s_review_cr fr">
                    	<span>漂***草（匿名）</span>
                        <span class="review_date">2016-10-16 23:13</span>
                    </div>
                </div>
                <div class="s_review_c">
                    <div class="s_review_cr fr">
                    	<span>漂***草（匿名）</span>
                        <span class="review_date">2016-10-16 23:13</span>
                    </div>
                </div>
                <div class="s_review_c">
                    <div class="s_review_cl fl">
                        <span class="review_star review_star1"></span>
                        <p>上身是针织的，腰围跟雪纺连接处是牛筋的，弹性很大，所以穿起来很轻松，也很舒服。 做工非常好，我仔细看下几遍，没发现有问题 跟图片一样，没有色差 客服很耐心，对他们的服务很满意</p>
                    </div>
                    <div class="s_review_cr fr">
                    	<span>漂***草（匿名）</span>
                        <span class="review_date">2016-10-16 23:13</span>
                    </div>
                </div>
                
                <!-- pages -->
                <div class="pages pagesR">
                    <a class="pages_pre" href="#" title="上一页">上一页</a><a  href="#"class="active">1</a><a href="#">2</a><a href="#">3</a><a href="#">4</a><a href="#">5</a><span>…</span><a href="#" class="pages_next" title="下一页">下一页</a>
                </div>
            </div>
        
        </div>
        <!-- 商品评价 end -->
        
        <!-- 售后保障 -->
        <div class="s_m2_r_content s_after_sale">
            <?php echo htmlspecialchars_decode($goodsrow['service']);?>
        </div>
        <!-- 售后保障 end -->

    </div>
</div>
<script src="/Public/home/js/pub.js"></script>
<script src="/Public/home/js/content.js"></script>
<script type="text/javascript" src="/Public/Admin/lib/layer/2.4/layer.js"></script>
<script type="text/javascript">
$(function(){
    var userid = "<?php echo session('front.userid'); ?>";
    if(!userid){
        layer.msg('请先进行登录');return;
    }
    var adids = $('a.addGoods');
    var chang = $('div.amount_change');
    var count = $(chang).children('input');
    $(count).blur(function(){
        if(isNaN(count.val())){
            layer.msg('商品数量必须为数字', {icon:5,time:1000});return;
        }
        if(count.val()>50){           
            layer.msg('商品数量不能大于50', {icon:5,time:1000});return;
        }else if(count.val()==50){
            $(chang).children('b:eq(1)').addClass('invalid');
            $(chang).children('b:eq(0)').removeClass('invalid');
        }else if(count.val()<1){
            layer.msg('商品数量不能小于1', {icon:5,time:1000});return;
        }else if(count.val()==1){
            $(chang).children('b:eq(0)').addClass('invalid');
            $(chang).children('b:eq(1)').removeClass('invalid');            
        }else if(1<count.val()<50){
            $(chang).children('b:eq(0)').removeClass('invalid');
            $(chang).children('b:eq(1)').removeClass('invalid');
        }
    });
    $(chang.children('b:eq(0)')).click(function(){
        var ncount = count.val();
        if(2<=count.val()){
            $(chang).children('b:eq(1)').removeClass('invalid');
            $(chang).children('b:eq(0)').removeClass('invalid');
            nncount = --ncount;
            count.val(nncount);
        }else if(count.val()<2){
            $(chang).children('b:eq(1)').removeClass('invalid');
            $(chang).children('b:eq(0)').addClass('invalid');
            layer.msg('商品数量不能小于1', {icon:5,time:1000});
            return;
        }
    });
    $(chang.children('b:eq(1)')).click(function(){
        var ncount = count.val();
        if(count.val()<50){
            $(chang).children('b:eq(0)').removeClass('invalid');
            $(chang).children('b:eq(1)').removeClass('invalid');
            nccount = ++ncount;
            count.val(nccount);
        }else if(count.val()>=50){
            $(chang).children('b:eq(0)').removeClass('invalid');
            $(chang).children('b:eq(1)').addClass('invalid');
            layer.msg('商品数量不能大于50', {icon:5,time:1000});
            return;
        }
    });
    $(adids).on('click',function(){
        var id = $(adids).attr('adid');
        var thecount = count.val();
        $.post(
            "<?php echo U('cart/cartadd');?>",
            {'cartid':id,'cartcount':thecount},
            function(result){
                if(result.status == 1){
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
    });
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