@extends('admin.layout.common')
@section('content')
<link href="/assets/admin/css/jsTree/style.min.css" rel="stylesheet">
<form method="post" action="" id="listform">
  <div class="panel admin-panel">
    <div class="panel-head"><strong class="icon-reorder"> 品牌列表</strong> <a href="" style="float:right; display:none;">添加字段</a></div>
    <div class="padding border-bottom">
      <ul class="search" style="padding-left:10px;">
        <li> <a class="button border-main icon-plus-square-o" href="{{url('admin/brand/create')}}"> 添加品牌</a> </li>
        <li>
          <input type="text" placeholder="请输入搜索关键字" name="keywords" class="input" style="width:250px; line-height:17px;display:inline-block" />
          <a href="javascript:void(0)" class="button border-main icon-search" onclick="changesearch()" > 搜索</a></li>
      </ul>
    </div>
    <table class="table table-hover text-center" >
      <tr>
        <th width="100" style="text-align:left; padding-left:20px;">ID</th>
        <th width="10%">排序</th>
        <th>品牌名称</th>
        <th>品牌logo</th>
        <th>是否显示</th>
        <th width="310">操作</th>
      </tr>
      	@foreach($data as $value)
        <tr>
          <td style="text-align:left; padding-left:20px;"><input type="checkbox" name="id[]" value="" />{{$value->id}}</td>
          <td>{{$value->sort_order}}</td>
          <td><font color="#00CC99">{{$value->name}}</font></td>
          <td width="10%"><img class="index-img" src="{{$value->logo}}"></td>
          <td>@if($value->is_show==1) 是 @else 否  @endif</td>
          <td><div class="button-group"> <a class="button border-main" href="{{url('admin/brand/'.$value['id'].'/edit')}}"><span class="icon-edit"></span> 修改</a> <a class="button border-red" href="javascript:void(0)" onclick="return del_row('{{$value->id}}')"><span class="icon-trash-o"></span> 删除</a> </div></td>
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
<<script type="text/javascript">
function del_row(id)
{
	var url = "{{url('admin/brand')}}"+'/'+id;
	del(url);
}
</script>
</body>
@endsection