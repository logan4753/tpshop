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
	<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 系统设置 <span class="c-gray en">&gt;</span> 用户管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
	<div class="Hui-article">
		<article class="cl pd-20">
			<div class="text-c">
				<form class="Huiform" method="post" action="<?php echo U('backuser/userlist');?>" target="_self">
					<input type="text" class="input-text" style="width:200px" placeholder="用户名" id="" name="username" <?php if(!empty($params['username'])): ?>value="<?php echo ($params['username']); ?>"<?php endif; ?> >
					<input type="text" class="input-text" style="width:200px" placeholder="姓名" id="" name="realname" <?php if(!empty($params['realname'])): ?>value="<?php echo ($params['realname']); ?>"<?php endif; ?> >
					<input type="text" class="input-text" style="width:200px" placeholder="角色名" id="" name="rolename" <?php if(!empty($params['rolename'])): ?>value="<?php echo ($params['rolename']); ?>"<?php endif; ?> >
					<button type="submit" class="btn btn-success" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 搜索用户</button>
				</form>
			</div>
			<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> <a href="javascript:;" onclick="user_add('添加用户','useradd','','')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加用户</a></span> <span class="r">共有数据：<strong><?php echo ($count); ?></strong> 条</span> </div>
			<table class="table table-border table-bordered table-bg table-sort">
				<thead>
					<tr class="text-c">
						<th><input type="checkbox" name="" value=""></th>
						<th>ID</th>
						<th>用户名</th>
						<th>姓名</th>
						<th>电话</th>
						<th>角色</th>
						<th>状态</th>
						<th>操作</th>
					</tr>
				</thead>
				<tbody>
					<?php if(is_array($data)): foreach($data as $key=>$val): ?><tr class="text-c">
						<td><input type="checkbox" value="<?php echo ($val['id']); ?>" name="id[]"></td>
						<td><?php echo ($val['id']); ?></td>
						<td><?php echo ($val['username']); ?></td>
						<td><?php echo ($val['realname']); ?></td>
						<td><?php echo ($val['tel']); ?></td>
						<td><?php echo ($rolelist[$val['role']]); ?></td>
						<td><a onclick="changeStatus(this)" data-id="<?php echo ($val['id']); ?>"><?php if($val['status'] == 1): ?><span class="label label-success radius">启用</span><?php else: ?><span class="label radius">禁用</span><?php endif; ?></a></td>
						<td><a title="编辑" href="javascript:;" onclick="user_edit('角色编辑','<?php echo U("backuser/useredit",array("id"=>$val["id"]));?>','','')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a>  <a title="删除" href="javascript:;" onclick="user_del(this,<?php echo ($val['id']); ?>)" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
					</tr><?php endforeach; endif; ?>
					<tr class="text-c">
						<td colspan='8'><div class='pages'><?php echo ($show); ?></div></td>
					</tr>
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
<script type="text/javascript">
/*
	参数解释：
	title	标题
	url		请求的url
	id		需要操作的数据id
	w		弹出层宽度（缺省调默认值）
	h		弹出层高度（缺省调默认值）
*/
/*用户-添加*/
function user_add(title,url,w,h){
	layer_show(title,url,w,h);
}
/*用户-编辑*/
function user_edit(title,url,w,h){
	layer_show(title,url,w,h);
}

/*用户-删除*/
function user_del(obj,id){
	if(!id){
		layer.confim('参数错误');
	}
	layer.confirm('用户删除须谨慎，确认要删除吗？',function(index){
		$.ajax({
			type:"POST",
			url:"<?php echo U('backuser/userdel');?>",
			data:{"id":id},
			dataType:'JSON',
			success:function(result){
				if(result.status == 1){
					$(obj).parents("tr").remove();
					layer.msg('已删除!',{icon:1,time:1000});
				}
			}
		})

	});
}
/*角色-批量删除*/
function datadel(){
	var idObj = $(":checkbox:checked"); //获取全部已经被选中的checkbox
    var id = ''; //接收处理后的部门id的值。组成id1，id2，
    //循环遍历idobj对象，获取其中的每一个的值。
    for(var i = 0;i < idObj.length;i++){
        id = id + idObj[i].value + ',';
    }
    //去掉最后的逗号
    id = id.substring(0,id.length-1);
    console.log(id);
    layer.confirm('权限删除须谨慎，确认要删除吗？',function(index){
		$.ajax({
			type:"POST",
			url:"<?php echo U('backuser/userdel');?>",
			data:{"id":id},
			dataType:'JSON',
			success:function(result){
				if(result.status == 1){
					$(":checkbox:checked").parent('td').parent("tr").remove();
					layer.msg('已删除!',{icon:1,time:1000});
				}
			}
		})

	});
}
/*用户-修改状态*/
function changeStatus(obj){
		var id = $(obj).attr('data-id');
		if(id == ''){
			alert('参数错误');
			return false;
		}
		$.post('<?php echo U("backuser/userstatus");?>',{id:id,type:"status"},function(result){
			if(result.status !=1){
				alert(result.info);
				return false;
			}
			if(result.data == 1){
				$(obj).html("<span class='label label-success radius'>启用</span>")
			}else{
				$(obj).html("<span class='label radius'>禁用</span>")
			}
		});
	}
</script>
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>