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
            <option value="{{$value['id']}}" @if($value->id==$result->type_id) selected @endif>{{$value['name']}}</option>
            @endforeach
          </select>
        </div>
      </div>
     <div class="form-group">
        <div class="label">
          <label>规格名称：</label>
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
          <label>规格项：</label>
        </div>
        <div class="field"> 
          <textarea rows="5" style="width: 246px;" name="item">{{$result->item}}</textarea>
          <div class="tips">一行为一个规格项</div>
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
edit("{{url('admin/spec/'.$id)}}","{{url('admin/spec')}}");
</script>
@endsection