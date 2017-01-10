@extends('admin.layout.common')
@section('content')
<body>
<div class="panel admin-panel margin-top">
  <div class="panel-head" id="add"><strong><span class="icon-pencil-square-o"></span>修改分类</strong></div>
  <div class="body-content">
    <form method="post" class="form-x" id="form">
      <div class="form-group">
        <div class="label">
          <label>上级分类：</label>
        </div>
        <div class="field">
          <select name="parent_id" class="input w50">
            <option value="0">顶级分类</option>
            @foreach($list as $value)
            <option value="{{$value['id']}}" @if($value['id']==$result['parent_id']) selected @endif >{{$value['name']}}</option>
            @endforeach
          </select>
          <div class="tips">不选择上级分类默认为一级分类</div>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label>商品分类：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" name="name" value="{{$result['name']}}"/>
          <div class="tips"></div>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label>关键字标题：</label>
        </div>
        <div class="field">
          <input type="text" class="input" name="title"  value="{{$result['title']}}" />
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label>分类关键字：</label>
        </div>
        <div class="field">
          <input type="text" class="input" name="keywords" value="{{$result['keywords']}}" />
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label>关键字描述：</label>
        </div>
        <div class="field">
          <input type="text" class="input" name="description" value="{{$result['description']}}"/>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label>排序：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" name="sort_order" value="{{$result['sort_order']}}"  data-validate="number:排序必须为数字" />
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
    </form>
  </div>
</div>
</body>
<script>
edit("{{url('admin/cat/'.$id)}}","{{url('admin/cat')}}");
</script>
@endsection