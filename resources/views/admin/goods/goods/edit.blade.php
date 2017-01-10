@extends('admin.layout.common')
@section('content')
<body>
<div class="panel admin-panel margin-top">
  <div class="panel-head" id="add"><strong><span class="icon-pencil-square-o"></span>修改属性</strong></div>
  <div class="body-content">
     <form method="post" class="form-x" id="form">
     
      <div class="form-group">
        <div class="label">
          <label>所属商品类型：</label>
        </div>
        <div class="field">
          <select name="type_id" class="input w50">
            <option value="0">顶级类型</option>
            @foreach($list as $value)
            <option value="{{$value['id']}}" @if($value->id==$result->type_id) selected @endif >{{$value['name']}}</option>
            @endforeach
          </select>
        </div>
      </div>
     <div class="form-group">
        <div class="label">
          <label>属性名称：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50"  name="name" data-validate="required:请输入标题" value="{{$result->name}}" />
          <div class="tips"></div>
        </div>
      </div>
     
      <div class="clear"></div>
      <div class="form-group">
        <div class="label">
          <label>排序：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" name="sort_order" value="{{$result->sort_order}}"  data-validate="number:排序必须为数字" />
          <div class="tips"></div>
        </div>
      </div>
     <div class="form-group">
        <div class="label">
          <label>是否需要检索：</label>
        </div>
        <div class="field"> 
          <input type="radio" name="attr_index" value="0" @if($result->attr_index=='0') checked @endif />否
          <input type="radio" name="attr_index" value="1" @if($result->attr_index=='1') checked @endif />关键字检索
          <input type="radio" name="attr_index" value="2" @if($result->attr_index=='2') checked @endif />范围检索
          <div class="tips"></div>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label></label>
        </div>
        <div class="field">
          <button class="button bg-main icon-check-square-o" type="button" id="edit-submit"> 提交</button>
        </div>
      </div>
      <input type="hidden" name="_method" value="put">
       {{csrf_field()}}
    </form>
  </div>
</div>
</body>
<script>
edit("{{url('admin/attr/'.$id)}}","{{url('admin/attr')}}");
</script>
@endsection