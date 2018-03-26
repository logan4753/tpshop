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
	<article class="page-container">
		<form class="form form-horizontal" id="form_info" action="#" method='post'>
			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>订单号：</label>
				<div class="formControls col-xs-8 col-sm-9">
					<input type="text" class="input-text" name='ordernum' value="<?php echo ($torder['ordernum']); ?>" disabled>
				</div>
			</div>

			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>收件人：</label>
				<div class="formControls col-xs-8 col-sm-9">
					<input type="text" class="input-text" name='recieve' value="<?php echo ($torder['recieve']); ?>" disabled>
				</div>
			</div>

			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>地址：</label>
				<div class="formControls col-xs-8 col-sm-9">
					<input type="text" class="input-text" name='address' value="<?php echo ($torder['address']); ?>" disabled>
				</div>
			</div>

			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>电话：</label>
				<div class="formControls col-xs-8 col-sm-9">
					<input type="text" class="input-text" name='tel' value="<?php echo ($torder['tel']); ?>" disabled>
				</div>
			</div>

			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>下单时间：</label>
				<div class="formControls col-xs-8 col-sm-9">
					<input type="text" class="input-text" name='logintime' value="<?php echo (date('Y-m-d H:i:s',$torder['odate'])); ?>" disabled>
				</div>
			</div>

			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>订单金额：</label>
				<div class="formControls col-xs-8 col-sm-9">
					<input type="text" class="input-text" name='allprice' value="￥<?php echo ($torder['allprice']); ?>" disabled>
				</div>
			</div>

			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>买家留言：</label>
				<div class="formControls col-xs-8 col-sm-9">
					<textarea name="remark" class="textarea" disabled><?php echo ($torder['remark']); ?></textarea>
				</div>
			</div>

			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>
				订单状态：</label>
				<div class="formControls col-xs-8 col-sm-9">
					<input type="text" class="input-text" name='ispay' value="<?php if(($torder["ispay"] == 1) and ($torder["send"] == 1)): ?>未发货<?php elseif($torder["ispay"] == 2): ?>未支付<?php elseif(($torder["send"] == 2) and ($torder["ispay"] == 1)): ?>已发货<?php elseif(($torder["send"] == 3) and ($torder["ispay"] == 1)): ?>已签收<?php endif; ?>"  disabled>
				</div>
			</div>

			<table class="table table-border table-bordered table-bg table-sort">
				<thead>
					<tr>
						<th scope="col" colspan="7">订单商品</th>
					</tr>
					<tr class="text-c">
						<th>商品名</th>
						<th>商品价格</th>
						<th>商品数量</th>
						<th>商品图</th>
					</tr>
				</thead>
				<tbody>
					<?php if(is_array($ordergo)): foreach($ordergo as $key=>$val): ?><tr class="text-c"  id="<?php echo ($val['id']); ?>">
						<td><?php echo ($val['gname']); ?></td>
						<td><?php echo ($val['gprice']); ?></td>
						<td><?php echo ($val['gcount']); ?></td>
						<td><img src="<?php echo ($val['gimage']); ?>" width='40' height='40' ></td>
					</tr><?php endforeach; endif; ?>
				</tbody>
			</table>

			<div class="row cl">
				<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
					<input class="btn btn-primary radius" type="button" onclick="goback()" value="&nbsp;&nbsp;返回&nbsp;&nbsp;">
				</div>
			</div>

		</form>
	</article>
<script type="text/javascript" src="/Public/admin/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/Public/admin/lib/layer/2.4/layer.js"></script> 
<script type="text/javascript" src="/Public/admin/static/h-ui/js/H-ui.js"></script> 
<script type="text/javascript" src="/Public/admin/static/h-ui.admin/js/H-ui.admin.page.js"></script> 
<script type="text/javascript">
function goback(){
	parent.window.location.reload();
	parent.layer.close(index);
}
</script>
</body>
</html>