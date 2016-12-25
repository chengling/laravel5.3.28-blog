@extends('admin.layout.common')
@section('content')
<body style="background-color:#f2f9fd;">
<div class="header bg-main">
  <div class="logo margin-big-left fadein-top">
    <h1><img src="/assets/admin/images/y.jpg" class="radius-circle rotate-hover" height="50" alt="" />后台管理中心</h1>
  </div>
  <div class="head-l"><a class="button button-little bg-green" href="" target="_blank"><span class="icon-home"></span> 前台首页</a> &nbsp;&nbsp;<a href="##" class="button button-little bg-blue"><span class="icon-wrench"></span> 清除缓存</a> &nbsp;&nbsp;<a class="button button-little bg-red" href="{{url('admin/logout')}}"><span class="icon-power-off"></span> 退出登录</a> </div>
</div>
<div class="leftnav">
  <div class="leftnav-title"><strong><span class="icon-list"></span>菜单列表</strong></div>
  <h2><span class="icon-user"></span>基本设置</h2>
  <ul style="display:block">
    <li><a href="{{url('admin/info')}}" target="right"><span class="icon-caret-right"></span>网站设置</a></li>
    <li><a href="{{url('admin/ad')}}" target="right"><span class="icon-caret-right"></span>广告管理</a></li>  
    <li><a href="{{url('admin/link')}}" target="right"><span class="icon-caret-right"></span>友情链接</a></li>   
  </ul> 
  <h2><span class="icon-user"></span>管理员</h2>
  <ul>
    <li><a href="{{url('admin/account/index')}}" target="right"><span class="icon-caret-right"></span>修改密码</a></li>
	<li><a href="{{url('admin/account/index')}}" target="right"><span class="icon-caret-right"></span>管理员</a></li>
	<li><a href="{{url('admin/account/role')}}" target="right"><span class="icon-caret-right"></span>角色</a></li>
  </ul>
  <h2><span class="icon-pencil-square-o"></span>内容管理</h2>
  <ul>
    <li><a href="{{url('admin/category')}}" target="right"><span class="icon-caret-right"></span>栏目管理</a></li>
    <li><a href="{{url('admin/article')}}" target="right"><span class="icon-caret-right"></span>文章管理</a></li>
  </ul>  
</div>
<script type="text/javascript">
$(function(){
  $(".leftnav h2").click(function(){
	  $(this).next().slideToggle(200);	
	  $(this).toggleClass("on"); 
  })
  $(".leftnav ul li a").click(function(){
	    $("#a_leader_txt").text($(this).text());
  		$(".leftnav ul li a").removeClass("on");
		$(this).addClass("on");
  })
});
</script>
<ul class="bread">
  <li><a href="{{url('admin/info')}}" target="right" class="icon-home"> 首页</a></li>
  <li><a href="##" id="a_leader_txt">网站信息</a></li>
  <li><b>当前语言：</b><span style="color:red;">中文</php></span>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;切换语言：<a href="##">中文</a> &nbsp;&nbsp;<a href="##">英文</a> </li>
</ul>
<div class="admin">
  <iframe scrolling="auto" rameborder="0" src="{{url('admin/info')}}" name="right" width="100%" height="100%"></iframe>
</div>
<div style="text-align:center;">
<p>来源:<a href="http://www.mycodes.net/" target="_blank">源码之家</a></p>
</div>
</body>
@endsection