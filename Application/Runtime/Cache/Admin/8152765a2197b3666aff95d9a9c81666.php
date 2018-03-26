<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<meta name="renderer" content="webkit|ie-comp|ie-stand">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
	<meta http-equiv="Cache-Control" content="no-siteapp" />
	<link rel="Bookmark" href="favicon.ico" >
	<link rel="Shortcut Icon" href="favicon.ico" />
	<!--[if lt IE 9]>
	<script type="text/javascript" src="./lib/html5.js"></script>
	<script type="text/javascript" src="./lib/respond.min.js"></script>
	<![endif]-->
	<link rel="stylesheet" type="text/css" href="/Public/Admin/static/h-ui/css/H-ui.min.css" />
	<link rel="stylesheet" type="text/css" href="/Public/Admin/static/h-ui.admin/css/H-ui.admin.css" />
	<link rel="stylesheet" type="text/css" href="/Public/Admin/lib/Hui-iconfont/1.0.8/iconfont.css" />
	<link rel="stylesheet" type="text/css" href="/Public/Admin/static/h-ui.admin/skin/default/skin.css" id="skin" />
	<link rel="stylesheet" type="text/css" href="/Public/Admin/static/h-ui.admin/css/style.css" />
	<!--[if IE 6]>
	<script type="text/javascript" src="http://lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js" ></script>
	<script>DD_belatedPNG.fix('*');</script>
	<![endif]-->
	<title>千纸鹤商城后台</title>
	<meta name="keywords" content="实惠购商城后台">
	<meta name="description" content="实惠购商城后台">
	<style type="text/css">
		.pages{float: right;}
		.pages a,.pages span {display:inline-block;padding:4px 7px;margin:0 3px;border:1px solid #D5D4D4;-webkit-border-radius:1px;-moz-border-radius:1px;border-radius:1px;}
		.pages a,.pages li{display:inline-block;list-style: none;text-decoration:none; color:#077ee3;}
		.pages a:hover{border-color:#077ee3;background:#077ee3;color:#FFF;}
		.pages span.current{background:#077ee3;color:#FFF;font-weight:700;border-color:#077ee3;}
		.pages li{margin-left:10px;margin-right:10px;}
	</style>
</head>
<body>
<header class="navbar-wrapper">
	<div class="navbar navbar-fixed-top">
		<div class="container-fluid cl"> <a class="logo navbar-logo f-l mr-10 hidden-xs" href="/aboutHui.shtml">crane.admin</a> <a class="logo navbar-logo-m f-l mr-10 visible-xs" href="/aboutHui.shtml">H-ui</a> 
			<span class="logo navbar-slogan f-l mr-10 hidden-xs">v3.0</span> 
			<a aria-hidden="false" class="nav-toggle Hui-iconfont visible-xs" href="javascript:;">&#xe667;</a>
			<nav id="Hui-userbar" class="nav navbar-nav navbar-userbar hidden-xs">
				<ul class="cl">
					<li><?php echo ($_SESSION['back']['userrolename']); ?>&nbsp;&nbsp;</li>
					<li class="dropDown dropDown_hover"> <a href="#" class="dropDown_A"><?php echo ($_SESSION['back']['username']); ?> <i class="Hui-iconfont">&#xe6d5;</i></a>
						<ul class="dropDown-menu menu radius box-shadow">
							<li><a href="<?php echo U('admin/logout');?>">退出</a></li>
						</ul>
					</li>
					<li id="Hui-skin" class="dropDown right dropDown_hover"> <a href="javascript:;" class="dropDown_A" title="换肤"><i class="Hui-iconfont" style="font-size:18px">&#xe62a;</i></a>
						<ul class="dropDown-menu menu radius box-shadow">
							<li><a href="javascript:;" data-val="default" title="默认（黑色）">默认（黑色）</a></li>
							<li><a href="javascript:;" data-val="blue" title="蓝色">蓝色</a></li>
							<li><a href="javascript:;" data-val="green" title="绿色">绿色</a></li>
							<li><a href="javascript:;" data-val="red" title="红色">红色</a></li>
							<li><a href="javascript:;" data-val="yellow" title="黄色">黄色</a></li>
							<li><a href="javascript:;" data-val="orange" title="橙色">橙色</a></li>
						</ul>
					</li>
				</ul>
			</nav>
		</div>
	</div>
</header>
<aside class="Hui-aside">
	<div class="menu_dropdown bk_2">
		<?php $datas = getPermission(); ?>
		<?php if(is_array($datas)): foreach($datas as $key=>$val): ?><dl>
			<dt><i class="Hui-iconfont">&#xe63c;</i> <?php echo ($val['pername']); ?><i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<?php if(is_array($val['child'])): foreach($val['child'] as $key=>$v): ?><li><a id="<?php echo ($v['per_act']); ?>" href="<?php echo ($v['perurl']); ?>" title="<?php echo ($v['pername']); ?>"><?php echo ($v['pername']); ?></a></li><?php endforeach; endif; ?>
				</ul>
			</dd>
		</dl><?php endforeach; endif; ?>
	</div>
</aside>
<div class="dislpayArrow hidden-xs"><a class="pngfix" href="javascript:void(0);" onClick="displaynavbar(this)"></a></div>
<section class="Hui-article-box">
	<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 商品管理 <span class="c-gray en">&gt;</span> 订单管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
	<div class="Hui-article">
		<article class="cl pd-20">
			<div class="text-c">
				<form class="Huiform" method="post" action="" target="_self">
					<input type="text" class="input-text" style="width:250px" placeholder="用户名" id="" name="catename">
					<button type="submit" class="btn btn-success" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 搜索订单</button>
				</form>
			</div>
			<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a></span> <span class="r">共有数据：<strong><?php echo ($count); ?></strong> 条</span> </div>
			<table class="table table-border table-bordered table-bg table-sort">
				<thead>
					<tr>
						<th scope="col" colspan="7">订单列表</th>
					</tr>
					<tr class="text-c">
						<th><input type="checkbox" name="" value=""></th>
						<th>ID</th>
						<th>用户</th>
						<th>订单号</th>
						<th>收货人</th>
						<th>订单金额</th>
						<th>订单状态</th>
						<th>下单时间</th>
						<th>状态</th>
						<th>操作</th>
					</tr>
				</thead>
				<tbody>
					<?php if(is_array($orderlists)): foreach($orderlists as $key=>$val): ?><tr class="text-c"  id="<?php echo ($val['id']); ?>">
						<td><input type="checkbox" value="<?php echo ($val['id']); ?>" name="id[]"></td>
						<td><?php echo ($val['id']); ?></td>
						<td><?php echo ($val['username']); ?></td>
						<td><?php echo ($val['ordernum']); ?></td>
						<td><?php echo ($val['recieve']); ?></td>
						<td><?php echo ($val['allprice']); ?></td>
						<td><?php if($val['ispay'] == 2): ?>未支付<?php elseif(($val['send'] == 1) and ($val['ispay'] == 1)): ?>未发货<?php elseif(($val['send'] == 2) and ($val['ispay'] == 1)): ?>已发货<?php elseif(($val['send'] == 3) and ($val['ispay'] == 1)): ?>已签收<?php endif; ?></td>
						<td><?php echo (date('Y-m-d H:i:s',$val['odate'])); ?></td>
						<td><a onclick="changeStatus(this)" data-id="<?php echo ($val['id']); ?>"><?php if($val['status'] == 1): ?><span class="label label-success radius">正常</span><?php else: ?><span class="label radius">取消</span><?php endif; ?></a></td>
						<td><a title="详情" href="javascript:;" onclick="order_info('订单详情','<?php echo U("order/orderinfo",array("id"=>$val["id"]));?>','','660')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe695;</i></a>&nbsp;<a title="编辑" href="javascript:;" onclick="order_edit('订单编辑','<?php echo U("order/orderedit",array("id"=>$val["id"]));?>','','600')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a></td>
					</tr><?php endforeach; endif; ?>
				</tbody>
			</table>
		</article>
	</div>
</section>

<script type="text/javascript" src="/Public/Admin/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/Public/Admin/lib/layer/2.4/layer.js"></script> 
<script type="text/javascript" src="/Public/Admin/static/h-ui/js/H-ui.js"></script> 
<script type="text/javascript" src="/Public/Admin/static/h-ui.admin/js/H-ui.admin.page.js"></script> 
<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/Public/Admin/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">
	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});
	var onact = '<?php echo ($onact); ?>';
	$("#"+onact).parent().addClass("current");
	$("#"+onact).parent().parent().parent().show();
	$("#"+onact).parent().parent().parent().prev("dt").addClass("selected");
</script>
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>
<script type="text/javascript">
/*订单-详情*/
function order_info(title,url,w,h){
	layer_show(title,url,w,h);
}
/*订单-编辑*/
function order_edit(title,url,w,h){
	layer_show(title,url,w,h);
}
/*订单-状态*/
function changeStatus(obj){
	var id = $(obj).attr('data-id');
	if(id == ''){
		alert('参数错误');
		return false;
	}
	$.post('<?php echo U("order/orderstatus");?>',{id:id,type:"status"},function(result){
		if(result.status !=1){
			alert(result.info);
			return false;
		}
		if(result.data == 1){
			$(obj).html("<span class='label label-success radius'>正常</span>")
		}else{
			$(obj).html("<span class='label radius'>取消</span>")
		}
	});
}
</script>