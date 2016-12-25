@extends('admin.layout.common')
@section('content')
<link href="/assets/admin/css/jsTree/style.min.css" rel="stylesheet">
<form method="post" action="" id="listform">
  <div class="panel admin-panel">
    <div class="panel-head"><strong class="icon-reorder"> 内容列表</strong> <a href="" style="float:right; display:none;">添加字段</a></div>
    <div class="padding border-bottom">
      <ul class="search" style="padding-left:10px;">
        <li> <a class="button border-main icon-plus-square-o" href="{{url('admin/category/create')}}"> 添加分类</a> </li>
        <li>
          <input type="text" placeholder="请输入搜索关键字" name="keywords" class="input" style="width:250px; line-height:17px;display:inline-block" />
          <a href="javascript:void(0)" class="button border-main icon-search" onclick="changesearch()" > 搜索</a></li>
      </ul>
    </div>
	<div id="using_json">
                        
    </div>
    <table class="table table-hover text-center" style="width: 80%;display: inline-table;float: right">
      <tr>
        <th width="100" style="text-align:left; padding-left:20px;">ID</th>
        <th width="10%">排序</th>
        <th>图片</th>
        <th>名称</th>
        <th width="310">操作</th>
      </tr>
      	@foreach($data['list'] as $value)
        <tr>
          <td style="text-align:left; padding-left:20px;"><input type="checkbox" name="id[]" value="" />
           {{$value->cat_id}}</td>
          <td>{{$value->sort_order}}</td>
          <td width="10%"><img src="{{$value->thumb}}" alt="" width="70" height="50" /></td>
          <td><font color="#00CC99">{{$value->cat_name}}</font></td>
          <td><div class="button-group"> <a class="button border-main" href="{{url('admin/category/'.$value['cat_id'].'/edit')}}"><span class="icon-edit"></span> 修改</a> <a class="button border-red" href="javascript:void(0)" onclick="return del({{$value['cat_id']}})"><span class="icon-trash-o"></span> 删除</a> </div></td>
        </tr>
        @endforeach
      <tr>
        <td colspan="8"><div class="pagelist"> <a href="">上一页</a> <span class="current">1</span><a href="">2</a><a href="">3</a><a href="">下一页</a><a href="">尾页</a> </div></td>
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
function del(cat_id){
	if(confirm("您确定要删除吗?")){
		$.ajax({
			url :"{{url('admin/category')}}"+'/'+cat_id,
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
					location.href="{{url('admin/category')}}"
				}
			}
		});
	}
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

var tree = <?php  echo $data['tree'] ?>;
$(function(){
	   $("#using_json").jstree(
		   {	
			   "core":{"data":tree},
			   "plugins" : ["conditionalselect"],
			   "conditionalselect":function(e,data){
				   if(data.type=='contextmenu')
				   {
					   return false;
				   }
				   var id=e.id;
	               location.href='/content-category/index?id='+id;
	        	}
		   }
	);
});
</script>
</body>
@endsection