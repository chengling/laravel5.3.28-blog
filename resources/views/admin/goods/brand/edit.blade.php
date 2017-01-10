@extends('admin.layout.common')
@section('content')
<body>
<script src="/assets/js/uploadify/jquery.uploadify.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="/assets/js/uploadify/uploadify.css">
<div class="panel admin-panel margin-top">
  <div class="panel-head" id="add"><strong><span class="icon-pencil-square-o"></span>修改文章</strong></div>
  <div class="body-content">
     <form method="post" class="form-x" id="form">
     
     <div class="form-group">
        <div class="label">
          <label>品牌名称：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50"  name="name" value="{{$result->name}}" data-validate="required:请输入标题" />
          <div class="tips"></div>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label>品牌图片：</label>
        </div>
        <div class="field">
          <input type="text" id="thumb" name="logo" class="input tips" style="width:25%; float:left;"  value="{{$result->logo}}" readonly="readonly" />
          <input id="file_upload" type="file"  value="" style="float:left;">
         
          <div id="picture">
            <img src="{{$result->logo}}" >
          </div>
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
          <label>是否显示：</label>
        </div>
        <div class="field"> 
          <input type="radio" name="is_show" value="1" @if($result->is_show=='1') checked @endif/>是
          <input type="radio" name="is_show" value="0" @if($result->is_show=='0') checked @endif/>否
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
edit("{{url('admin/brand/'.$id)}}","{{url('admin/brand')}}");
upload("thumb");
</script>
@endsection