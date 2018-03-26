<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="renderer" content="webkit|ie-comp|ie-stand">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
	<meta http-equiv="Cache-Control" content="no-siteapp" />
	<!--[if lt IE 9]>
	<script type="text/javascript" src="/Public/Admin/lib/html5shiv.js"></script>
	<script type="text/javascript" src="/Public/Admin/lib/respond.min.js"></script>
	<![endif]-->
	<link href="/Public/Admin/static/h-ui/css/H-ui.min.css" rel="stylesheet" type="text/css" />
	<link href="/Public/Admin/static/h-ui.admin/css/H-ui.login.css" rel="stylesheet" type="text/css" />
	<link href="/Public/Admin/static/h-ui.admin/css/style.css" rel="stylesheet" type="text/css" />
	<link href="/Public/Admin/lib/Hui-iconfont/1.0.8/iconfont.css" rel="stylesheet" type="text/css" />
	<!--[if IE 6]>
	<script type="text/javascript" src="/Public/Admin/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
	<script>DD_belatedPNG.fix('*');</script>
	<![endif]-->
	<title>千纸鹤商城后台登录</title>
	<meta name="keywords" content="千纸鹤商城后台登录">
	<meta name="description" content="千纸鹤商城后台登录">
</head>
<body>
	<div class="header"></div>
	<div class="loginWraper">
		<div id="loginform" class="loginBox">
			<form id='form_info' class="form form-horizontal" action="<?php echo U('admin/login');?>" method="post" onsubmit="return checkLogin();">
				<div class="row cl">
					<label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60d;</i></label>
					<div class="formControls col-xs-8">
						<input type="text" placeholder="用户名" name="username" class="input-text size-L">
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60e;</i></label>
					<div class="formControls col-xs-8">
						<input type="password" placeholder="密码" name="userpwd" class="input-text size-L">
					</div>
				</div>
				<div class="row cl">
					<div class="formControls col-xs-8 col-xs-offset-3">
						<input class="input-text size-L" type="text" placeholder="请输入验证码" name="usercode" style="width:150px;">
						<img src="<?php echo U('admin/showcode');?>" width="100" height="43">
						<a id="blind" href="javascript:;">看不清，换一张</a>
					</div>
				</div>
				<div class="row cl">
					<div class="formControls col-xs-8 col-xs-offset-3">
						<input name="" type="submit" class="btn btn-success radius size-L" value="&nbsp;登&nbsp;&nbsp;&nbsp;&nbsp;录&nbsp;">
						<input name="" type="reset" class="btn btn-default radius size-L" value="&nbsp;取&nbsp;&nbsp;&nbsp;&nbsp;消&nbsp;">
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="footer">Copyright &copy;千纸鹤 mingjian</div>
	<script type="text/javascript" src="/Public/Admin/lib/jquery/1.9.1/jquery.min.js"></script> 
	<script type="text/javascript" src="/Public/Admin/static/h-ui/js/H-ui.min.js"></script>
	<script type="text/javascript" src="/Public/Admin/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
	<script type="text/javascript" src="/Public/Admin/lib/layer/2.4/layer.js"></script> 
	<script type="text/javascript">
		//刷新验证码
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