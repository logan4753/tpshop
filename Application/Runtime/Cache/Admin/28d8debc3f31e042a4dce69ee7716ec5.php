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
	<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 系统设置 <span class="c-gray en">&gt;</span> 权限管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
	<div class="Hui-article">
		<article class="cl pd-20">
			<div class="text-c">
				<form class="Huiform" method="post" action="" target="_self">
					<input type="text" class="input-text" style="width:250px" placeholder="权限名称" id="" name="">
					<button type="submit" class="btn btn-success" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 搜权限节点</button>
				</form>
			</div>
			<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> <a href="javascript:;" onclick="permission_add('添加权限节点','permissionadd','','320')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加权限节点</a></span> <span class="r">共有数据：<strong><?php echo ($count); ?></strong> 条</span> </div>
			<table class="table table-border table-bordered table-bg table-sort">
				<thead>
					<tr>
						<th scope="col" colspan="7">权限节点</th>
					</tr>
					<tr class="text-c">
						<th><input type="checkbox" name="" value=""></th>
						<th>ID</th>
						<th>权限名称</th>
						<th width='550'>控制器/操作名</th>
						<th>操作</th>
					</tr>
				</thead>
				<tbody>
					<?php if(is_array($data)): foreach($data as $key=>$val): ?><tr class="text-c"  id="<?php echo ($val['id']); ?>">
						<td><input type="checkbox" value="<?php echo ($val['id']); ?>" name="id[]"></td>
						<td><?php echo ($val['id']); ?></td>
						<td><?php if($val['switchs'] == 1): ?><img src="/Public/Admin/images/diy_17.gif" ectype="flex" status="open" fieldid="<?php echo ($val['id']); ?>"  onclick="secajax($(this))"><?php else: ?><img src="/Public/Admin/images/diy_09.gif"><?php endif; ?>&nbsp;<span><?php echo ($val['pername']); ?></span></td>
						<td><?php echo ($val['peract']); ?></td>
						<td><a title="编辑" href="javascript:;" onclick="permission_edit('权限编辑','<?php echo U("permission/permissionedit",array("id"=>$val["id"]));?>','','310')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a> <a title="删除" href="javascript:;" onclick='permission_del(this,<?php echo ($val["id"]); ?>)' class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
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
<script type="text/javascript">
/*
	参数解释：
	title	标题
	url		请求的url
	id		需要操作的数据id
	w		弹出层宽度（缺省调默认值）
	h		弹出层高度（缺省调默认值）
*/
/*权限-添加*/
function permission_add(title,url,w,h){
	layer_show(title,url,w,h);
}
/*权限-编辑*/
function permission_edit(title,url,w,h){
	layer_show(title,url,w,h);
}
/*权限-批量删除*/
function datadel(){
	var idObj = $(":checkbox:checked"); //获取全部已经被选中的checkbox
    var id = ''; //接收处理后的部门id的值。组成id1，id2，
    //循环遍历idobj对象，获取其中的每一个的值。
    for(var i = 0;i < idObj.length;i++){
        id = id + idObj[i].value + ',';
    }
    //去掉最后的逗号
    id = id.substring(0,id.length-1);
    //window.location.href="/Admin/Permission/permissiondel/id/" + id;
    layer.confirm('权限删除须谨慎，确认要删除吗？',function(index){
		$.ajax({
			type:"POST",
			url:"<?php echo U('permission/permissiondel');?>",
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
/*权限-删除*/
function permission_del(obj,id){
	if(!id){
		layer.confim('参数错误');
	}
	layer.confirm('权限删除须谨慎，确认要删除吗？',function(index){
		$.ajax({
			type:"POST",
			url:"<?php echo U('permission/permissiondel');?>",
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

//异步请求回来的数据的再次添加异步伸缩行为
function secajax(ob){
    var selfurl = "<?php echo U('permission/getchild');?>";
    var status = $(ob).attr("status");
    var id = $(ob).attr("fieldid");
    var src = $(ob).attr('src');
    if(status == 'open'){
        var src = $(ob).attr('src');
        var pr  = $(ob).parents('td').parent('tr');
        var pid = pr.attr('class');
        var sr  = pr.clone();
        var td2 = sr.find("td:eq(2)");
        td2.prepend("<img class='preimg' src='/Public/Admin/images/vertline.gif'/>").children('span').remove().end().find("img[ectype=flex]").remove();
        var td2html = td2.html();
        $.get(selfurl, {id: id}, function(data){
            if(data){
                var str = '';
                var res = eval('('+data+')');
                for(var i = 0; i < res.length; i++){
                    var src = "";
                    var if_show = "";
                    var add_child = '';
                    if(res[i].switchs){
                       src = "<span style='margin-left:20px;'><img src='/Public/Admin/images/diy_17.gif' ectype='flex' status='open' fieldid="+res[i].id+" onclick='secajax($(this))'> "+res[i].pername+"</span>";
                    }else{
                       src = "<span style='margin-left:20px;'><img src='/Public/Admin/images/diy_09.gif' fieldid='"+res[i].id+"'> "+res[i].pername+"</span>";
                    }
                    var itd2 = src;
                    var itd11 = '/Admin/Permission/permissionedit/id/'+res[i].id;
                    //var itd11 = "<?php echo U('permission/permissionedit',array('id'=>"+res[i].id+"));?>";
                    //console.log(itd12);
                    //var itd3 = "permission_edit('角色编辑','/Admin/Permission/permissionedit/id/"+res[i].id+"','','310')";
                    var itd3 = 'permission_edit("权限编辑","/Admin/Permission/permissionedit/id/'+res[i].id+'","","310")';
                    //console.log(itd3);
                    str += "<tr id='tr_"+res[i].id+"' class='text-c row"+id+" "+pid+"'>";
                    str += "<td><input type='checkbox' value='"+res[i].id+"' name='id[]'></td>";
                    str += "<td>"+res[i].id+"</td>";
                    str += "<td>"+itd2+"</td>";
                    str += "<td>"+res[i].peract+"</td>";                   
                    str += "<td><a title='编辑' href='javascript:;' onclick='"+itd3+"' class='ml-5' style='text-decoration:none'><i class='Hui-iconfont'>&#xe6df;</i></a> <a title='删除' href='javascript:;' onclick='permission_del(this,"+res[i].id+")' class='ml-5' style='text-decoration:none'><i class='Hui-iconfont'>&#xe6e2;</i></a></td></tr>";

                }
            }
                //将组成的字符串添加到点击对象后面
            pr.after(str);
        });
        $(ob).attr('src',src.replace("diy_17","diy_15"));
        $(ob).attr('status','close');
    }
    if(status == "close"){
        $('.row' + id).hide();
        $(ob).attr('src',src.replace("diy_15","diy_17"));
        $(ob).attr('status','open');
    }
}

</script>
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>