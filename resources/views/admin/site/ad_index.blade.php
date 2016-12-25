@extends('admin.layout.common')
@section('content')
<link href="/assets/admin/css/jsTree/style.min.css" rel="stylesheet">
<form method="post" action="" id="listform">
  <div class="panel admin-panel">
    <div class="panel-head"><strong class="icon-reorder"> 广告列表</strong> <a href="" style="float:right; display:none;">添加字段</a></div>
    <div class="padding border-bottom">
      <ul class="search" style="padding-left:10px;">
        <li> <a class="button border-main icon-plus-square-o" href="{{url('admin/ad/create')}}"> 添加广告</a> </li>
        <li>
          <input type="text" placeholder="请输入搜索关键字" name="keywords" class="input" style="width:250px; line-height:17px;display:inline-block" />
          <a href="javascript:void(0)" class="button border-main icon-search" onclick="changesearch()" > 搜索</a></li>
      </ul>
    </div>
    <table class="table table-hover text-center" >
      <tr>
        <th width="100" style="text-align:left; padding-left:20px;">ID</th>
        <th width="10%">排序</th>
        <th>广告名称</th>
        <th>广告图片</th>
        <th>广告位置</th>
        <th>是否显示</th>
        <th width="310">操作</th>
      </tr>
      	@foreach($data as $value)
        <tr>
          <td style="text-align:left; padding-left:20px;"><input type="checkbox" name="id[]" value="" />{{$value->article_id}}</td>
          <td>{{$value->sort_order}}</td>
          <td><font color="#00CC99">{{$value->name}}</font></td>
          <td width="10%"><img with="100" height="100" src="{{$value->picture}}"></td>
          <td>首页</td>
          <td>@if($value->is_delete==1) 是 @else 否  @endif</td>
          <td><div class="button-group"> <a class="button border-main" href="{{url('admin/ad/'.$value['ad_id'].'/edit')}}"><span class="icon-edit"></span> 修改</a> <a class="button border-red" href="javascript:void(0)" onclick="return del({{$value->ad_id}})"><span class="icon-trash-o"></span> 删除</a> </div></td>
        </tr>
        @endforeach
      <tr>
        <td colspan="8"><div class="pagelist"> 
        {{$data->links()}} 
        </div></td>
      </tr>
    </table>
  </div>
</form>
<script src="/assets/admin/js/jsTree/jstree.min.js"></script>
<script type="text/javascript">
//搜索
function changesearch(){	
		
}

//单个删除
function del(article_id){
	layer.confirm("您确定要删除吗?",function(){
		$.ajax({
			url :"{{url('admin/ad')}}"+'/'+article_id,
			type:'delete',
			dataType:'json',
			data:{_method:'delete'},
			success:function(data)
			{
				if(data.status !='0')
				{
					layer.open({
						  title:'提示',content: data.msg
				    });     
				}else{
					location.href= location.href;
				}
			}
		});
	});
}
//全选
$("#checkall").click(function(){ 
  $("input[name='id[]']").each(function(){
	  if (this.checked) {
		  this.checked = false;
	  }
	  else {
		  this.checked = true;
	  }
  });
})

//批量删除
function DelSelect(){
	var Checkbox=false;
	 $("input[name='id[]']").each(function(){
	  if (this.checked==true) {		
		Checkbox=true;	
	  }
	});
	if (Checkbox){
		var t=confirm("您确认要删除选中的内容吗？");
		if (t==false) return false;		
		$("#listform").submit();		
	}
	else{
		alert("请选择您要删除的内容!");
		return false;
	}
}
</script>
</body>
@endsection