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
<style>
	#treeDemo span.has-switch{min-width: 0px !important;}
</style>
<body>
	<article class="page-container">
		<form class="form form-horizontal" id="form_info" action="<?php echo U('backuser/useredit');?>" method='post'>
			<div class="row cl">
				<input type="hidden" name='id' value="<?php echo ($row['id']); ?>">
				<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>用户名：</label>
				<div class="formControls col-xs-8 col-sm-9">
					<input type="text" class="input-text" name='username' value="<?php echo ($row['username']); ?>" placeholder="请输入用户名">
				</div>
			</div>

			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>姓名：</label>
				<div class="formControls col-xs-8 col-sm-9">
					<input type="text" class="input-text" name='realname' value="<?php echo ($row['realname']); ?>" placeholder="请输入姓名">
				</div>
			</div>

			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>电话：</label>
				<div class="formControls col-xs-8 col-sm-9">
					<input type="text" class="input-text" name='tel' value="<?php echo ($row['tel']); ?>" placeholder="请输入手机号">
				</div>
			</div>

			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3">所属角色：</label>
				<div class="formControls col-xs-8 col-sm-9">
					<span class="select-box">
						<select class="select" name='role'>
							<option value=''>--请选择--</option>
							<?php if(is_array($data)): foreach($data as $key=>$val): ?><option value='<?php echo ($val["id"]); ?>' <?php if($row['role'] == $val['id']): ?>selected<?php endif; ?> /><?php echo ($val['rolename']); ?></option><?php endforeach; endif; ?>
						</select>
					</span>
				</div>
			</div>

			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>状态：</label>
				<div class="formControls col-xs-8 col-sm-9 skin-minimal">
					<div class="radio-box">
						<input name="status" type="radio" id="status-1" value='1' <?php if($row['status'] == 1): ?>checked<?php endif; ?> />
						<label for="status-1">正常</label>
					</div>
					<div class="radio-box">
						<input type="radio" id="status-2" value='2' name="status" <?php if($row['status'] == 2): ?>checked<?php endif; ?> />
						<label for="status-2">禁用</label>
					</div>
				</div>
			</div>

			<div class="row cl">
				<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
					<input class="btn btn-primary radius" type="button" onclick="checkForm()" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
				</div>
			</div>

		</form>
	</article>
	<script type="text/javascript" src="/Public/admin/lib/jquery/1.9.1/jquery.min.js"></script><script type="text/javascript" src="/Public/admin/lib/layer/2.4/layer.js"></script> 
	<script type="text/javascript" src="/Public/admin/static/h-ui/js/H-ui.js"></script> 
	<script type="text/javascript" src="/Public/admin/static/h-ui.admin/js/H-ui.admin.page.js"></script> 	
	<script type="text/javascript" src="/Public/admin/lib/laypage/1.2/laypage.js"></script>
	<link rel="stylesheet" href="/Public/admin/lib/zTree/css/zTreeStyle/zTreeStyle.css" type="text/css">
	<script type="text/javascript" src="/Public/admin/lib/zTree/js/jquery.ztree.core-3.5.js"></script>
	<script type="text/javascript" src="/Public/admin/lib/zTree/js/jquery.ztree.excheck-3.5.js"></script>
	<script type="text/javascript" src="/Public/admin/lib/zTree/js/jquery.ztree.exedit-3.5.js"></script>
	<script type="text/javascript" src="/Public/admin/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
	<!--请在下方写此页面业务相关的脚本-->
	<script type="text/javascript">

		function checkForm(){
			$.ajax({
				type:"POST",
				url:$('#form_info').attr("action"),
				data:$('#form_info').serialize(),
				dataType:'JSON',
				success:function(result){
					if(result.status == 1){
						parent.window.location.reload();
						var index = parent.layer.getFrameIndex(window.name);
						parent.layer.close(index);
					}
				}
			});
		}
	</script>
</body>
</html>