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
<link type="text/css" rel="stylesheet" href="/Public/home/css/user.css" />
<link type="text/css" rel="stylesheet" href="/Public/home/css/content.css" />
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

<div class="cont user user_4 clearfix">
	<div class="user_menu"> 
        <dl>
            <dt class="colorChange">个人中心</dt>
            <dd><a href="<?php echo U('user/myorder');?>">我的订单</a></dd>
            <dd><a href="<?php echo U('user/mycollect');?>">我的收藏</a></dd>
            <dd><a href="<?php echo U('user/mycoupon');?>">我的优惠券</a></dd>
            <dd class="active"><a href="<?php echo U('user/address');?>">我的收货地址</a></dd>
            <dd><a href="#">商品评价</a></dd>
            <dd><a href="<?php echo U('user/editpwd');?>">修改密码</a></dd>
        </dl>
    </div>

<!--  我的收藏  -->
    <div class="user_right fr">
        <h3 class="user_title">我的收货地址</h3>
        <p class="noInfo"><i class="i_sad">&nbsp;</i>您目前还没有已购买的宝贝，快去逛逛<a href="#">首页</a>吧！</p>
        <div>
			<div class="add_addr_w">
            	<a href="javascript:;" class="add_addr">添加收货地址</a>
                <p>还可以创建8个收货地址</p>
            </div>
            <table>
            	<tr>
                	<th class="longer">收货人</th>
                	<th>地址</th>
                	<th>详细地址</th>
                	<th>邮编</th>
                	<th>手机</th>
                	<th>操作</th>
                	<th>&nbsp;</th>
                </tr>
                <?php if(is_array($myadd)): foreach($myadd as $key=>$vos): ?><tr>
                	<td><?php echo ($vos['recieve']); ?></td>
                	<td><?php echo ($vos['address']); ?></td>
                	<td><?php echo ($vos['addressinfo']); ?></td>
                	<td><?php echo ($vos['postcode']); ?></td>
                	<td><?php echo ($vos['tel']); ?></td>
                    <td><a href="#">编辑</a> <a href="javascript:;" onclick='adddel(this,<?php echo ($vos["id"]); ?>)'>删除</a> </td>
                    <?php if($vos['status'] == 1): ?><td><a href="#" class="default">默认地址</a></td><?php endif; ?>
                </tr><?php endforeach; endif; ?>
            </table>
        </div>
	</div>

<!--  我的收藏 end  -->
</div>
<div class="fixed_shadow_w">
    <div class="fixed_shadow"></div>
    <div class="cancel_address fixed_shadow_c">
        <p class="fixed_shadow_ct"><i class="fixed_close pay_info_close">&nbsp;</i>删除收货人信息</p>
        <p class="cancel_address_m fixed_shadow_cm"><i>&nbsp;</i>您确定要删除该收货地址吗？</p>
        <p class="cancel_address_b fixed_shadow_cb">
            <label class="fixed_iptW"><input type="submit" value="确定" class="fixed_ipt"></label>
            <label class="fixed_iptW"><input type="submit" value="取消" class="fixed_ipt"></label>
        </p>
    </div>
    <div class="operateSucc fixed_shadow_c">
        <p class="fixed_shadow_ct"><i class="fixed_close pay_info_close">&nbsp;</i>提示</p>
        <p class="operateSucc_m fixed_shadow_cm">操作成功！</p>
        <p class="operateSucc_b fixed_shadow_cb">
            <label class="fixed_iptW"><input type="submit" value="确定" class="fixed_ipt"></label>
        </p>
    </div>
    <div class="yhq_exchange fixed_shadow_c">
        <p class="fixed_shadow_ct"><i class="fixed_close pay_info_close">&nbsp;</i>新增收货人信息 </p>
        <p class="yhq_exchange_m fixed_shadow_cm"><i>&nbsp;</i>新增收货地址成功</p>
        <p class="yhq_exchange_b fixed_shadow_cb">
            <label class="fixed_iptW"><input type="submit" value="确定" class="fixed_ipt"></label>
        </p>
    </div>
    <div class="addAddress fixed_shadow_c">
        <p class="fixed_shadow_ct"><i class="fixed_close pay_info_close">&nbsp;</i>新增收货地址</p>
        <div class="addAddress_m fixed_shadow_cm">
        <form method='post' action='<?php echo U("user/addaddress");?>' id='form_info'>
            <table>
                <tr>
                    <th><span class="redStar">*</span> 收货人：</th>
                    <td><input type="text" id='recieve' name='recieve' value=''></td>
                </tr>
                <tr>
                    <th><span class="redStar">*</span> 地址：</th>
                    <td>
                        <select id='pro' name='pro'></select>
                        <select id='city' name='city'></select>
                        <select id='coun' name='coun'></select>
                    </td>
                </tr>
                <tr>
                    <th><span class="redStar">*</span> 详细地址：</th>
                    <td><textarea name='address'></textarea></td>
                </tr>
                <tr>
                    <th><span class="redStar">*</span> 手机：</th>
                    <td><input type="text" name='tel' value=''></td>
                </tr>
                <tr>
                    <th>邮编：</th>
                    <td><input type="text" name='postcode' value=''></td>
                </tr>
            </table>
        </div>
        <p class="addAddress_b fixed_shadow_cb">
            <label class="fixed_iptW"><input type="button" value="确定" onclick='checkform()' class="fixed_ipt"></label>
        </p>
        </form>
    </div>
</div>
<script type="text/javascript" src="/Public/Admin/lib/jquery.validation/1.14.0/jquery.validate.js"></script>

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
function checkform(){
    $.ajax({
        type:"POST",
        url:$('#form_info').attr("action"),
        data:$('#form_info').serialize(),
        dataType:'JSON',
        success:function(result){
            if(result.status == 1){
                window.location.href = "<?php echo U('user/address');?>";
            }
        }
    });
}
function adddel(obj,id){
    var id = id;
    $.post(
        "<?php echo U('user/adddel');?>",
        {id:id},
        function(result){
            if(result.status==1){
                $(obj).parents('tr').remove();
            }
    });
}
$(function(){
    $('.add_addr').click(function(){
        $('.fixed_shadow_w').fadeIn();
        $('.addAddress').fadeIn();
    });
    $('#form_info').validate({
        onfocusout: function(element) { $(element).valid(); },
        rules:{
           recieve:'required',
           address:'required',
           tel:'required'               
        },
        messages:{
            recieve:'收货人不能为空',
            address:'地址不能为空',
            tel:'手机号不能为空'
        },
    });
    $.post(
        "<?php echo U('user/getregion');?>",
        {pid:1},
        function(result){
            var option ='<option>--请选择--</option>';
            $.each(result.region,function(i,n){
                option += '<option value="'+n.region_id+'">'+n.region_name+'</option>';
            });
            $('#pro').append(option);
        });
    $('#pro').change(function(){
        var pid = $(this).val();
        $.post(
            "<?php echo U('user/getregion');?>",
            {pid:pid},
            function(result){
                $('#city option').remove();
                $('#coun option').remove();
                var option = '<option>--请选择--</option>';
                $.each(result.region,function(i,n){
                    option += '<option value="'+n.region_id+'">'+n.region_name+'</option>';
                });
                $('#city').append(option);
            });
    });
    $('#city').change(function(){
        var pid = $(this).val();
        $.post(
            "<?php echo U('user/getregion');?>",
            {pid,pid},
            function(result){
                $('#coun option').remove();
                var option = '<option>--请选择--</option>';
                $.each(result.region,function(i,n){
                    option += '<option value="'+n.region_id+'">'+n.region_name+'</option>';
                });
                $('#coun').append(option);
            })
    })
})
</script>