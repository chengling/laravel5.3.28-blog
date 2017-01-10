@extends('admin.layout.common')
@section('content')
<body>
<div class="panel admin-panel margin-top">
  <div class="panel-head" id="add"><strong><span class="icon-pencil-square-o"></span>添加类型</strong></div>
  <div class="body-content">
    <form method="post" class="form-x" id="form">
     <div class="form-group">
        <div class="label">
          <label>类型名称：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50"  name="name" data-validate="required:请输入标题" />
          <div class="tips"></div>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label></label>
        </div>
        <div class="field">
          <button class="button bg-main icon-check-square-o" type="button" id="submit"> 提交</button>
        </div>
      </div>
      <input type="hidden" name="_method" value="post">
       {{csrf_field()}}
    </form>
  </div>
</div>
</body>
<script>
add("{{url('admin/goodstype')}}");
</script>
@endsection