@extends('admin.layout.common')
@section('content')
<body>
<script type="text/javascript" src="/assets/admin/js/ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="/assets/admin/js/ueditor/ueditor.all.js"></script>
<script src="/assets/js/uploadify/jquery.uploadify.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="/assets/js/uploadify/uploadify.css">
<div class="panel admin-panel margin-top">
  <div class="panel-head" id="add"><strong><span class="icon-pencil-square-o"></span>修改文章</strong></div>
  <div class="body-content">
     <form method="post" class="form-x" id="form">
      <div class="form-group">
        <div class="label">
          <label>广告位置：</label>
        </div>
        <div class="field">
          <select name="position" class="input w50">
            <option value="1" @if($result->position==1) selected @endif>首页</option>
            <option value="2" @if($result->position==2) selected @endif>wap首页</option>
            <option value="3" @if($result->position==3) selected @endif>app首页</option>
          </select>
        </div>
      </div>
     
     <div class="form-group">
        <div class="label">
          <label>名称：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50"  name="name" value="{{$result->name}}" data-validate="required:请输入标题" />
          <div class="tips"></div>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label>图片：</label>
        </div>
        <div class="field">
          <input type="text" id="thumb" name="picture" class="input tips" style="width:25%; float:left;"  value="{{$result->picture}}" readonly="readonly" />
          <input id="file_upload" type="file"  value="" style="float:left;">
         
          <div id="picture">
            <img src="{{$result->picture}}" >
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
          <label>广告地址：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" name="url" value="{{$result->url}}" data-validate="member:只能为数字"  />
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
      <input type="hidden" name="_method" value="put">
       {{csrf_field()}}
    </form>
  </div>
</div>
</body>
<script>
$("#submit").on('click',function(){
	$.ajax({
		url :"{{url('admin/ad/'.$ad_id)}}",
		type:'put',
		dataType:'json',
		data:$("#form").serialize(),
		success:function(data)
		{
			if(data.status !='0')
			{
				layer.open({
					  title:'提示',content: data.msg
			    });     
			}else{
				location.href="{{url('admin/ad')}}"
			}
		}
	});
});
var ue = UE.getEditor('container');
<?php $timestamp = time();?>
$(function() {
	$('#file_upload').uploadify({
		'formData'     : {
			'timestamp' : '<?php echo $timestamp;?>',
			'token'     : '<?php echo csrf_token();?>'
		},
		'fileSizeLimit':'2MB',
		'multi': false,
		'buttonText':'上传图片',
		'swf'      : '/assets/js/uploadify/uploadify.swf',
		'uploader' : "{{url('upload')}}",
		'onUploadSuccess' : function(file, data, response) {
			 	var data = eval('(' + data + ')');
				$("#picture").html('<img width="100" height="100" src="'+data.path+'" />');
				$("#thumb").val(data.path);
				
		 }
	});
});
</script>
@endsection