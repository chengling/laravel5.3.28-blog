@extends('admin.layout.common')
@section('content')
<body>
<script type="text/javascript" src="/assets/admin/js/ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="/assets/admin/js/ueditor/ueditor.all.js"></script>
<script src="/assets/js/uploadify/jquery.uploadify.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="/assets/js/uploadify/uploadify.css">
<div class="panel admin-panel margin-top">
  <div class="panel-head" id="add"><strong><span class="icon-pencil-square-o"></span>添加内容</strong></div>
  <div class="body-content">
    <form method="post" class="form-x" id="form">
      <div class="form-group">
        <div class="label">
          <label>文章分类：</label>
        </div>
        <div class="field">
          <select name="cat_id" class="input w50">
            @foreach($list as $value)
            <option value="{{$value['cat_id']}}">{{$value['cat_name']}}</option>
            @endforeach
          </select>
        </div>
      </div>
     
     <div class="form-group">
        <div class="label">
          <label>标题：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" value="" name="title" data-validate="required:请输入标题" />
          <div class="tips"></div>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label>图片：</label>
        </div>
        <div class="field">
          <input type="text" id="thumb" name="thumb" class="input tips" style="width:25%; float:left;"   readonly="readonly" />
          <input id="file_upload" type="file"  value="" style="float:left;">
         
          <div id="picture"></div>
        </div>
      </div>     
      
    <div class="form-group">
          <div class="label">
            <label>其他属性：</label>
          </div>
          <div class="field" style="padding-top:8px;"> 
            	推荐 <input name="attr"  type="radio" value="1" />
            	置顶 <input name="attr"  type="radio" value="2"/> 
          </div>
     </div>
     <div class="form-group">
        <div class="label">
          <label>简介：</label>
        </div>
        <div class="field">
          <textarea class="input" name="description" style=" height:90px;"></textarea>
          <div class="tips"></div>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label>内容：</label>
        </div>
        <div class="field">
         <script id="container" name="content" type="text/plain">
    	 </script>
          <div class="tips"></div>
        </div>
      </div>
     
      <div class="clear"></div>
      <div class="form-group">
        <div class="label">
          <label>排序：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" name="sort_order" value="0"  data-validate="number:排序必须为数字" />
          <div class="tips"></div>
        </div>
      </div>
     <div class="form-group">
        <div class="label">
          <label>是否发布：</label>
        </div>
        <div class="field"> 
          <input type="radio" name="is_publish" value="1"/>是
          <input type="radio" name="is_publish" value="0"/>否
          <div class="tips"></div>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label>发布客户端：</label>
        </div>
        <div class="field"> 
          <input type="radio" name="platform" value="1"/>pc
          <input type="radio" name="platform" value="2"/>wap
          <div class="tips"></div>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label>发布时间：</label>
        </div>
        <div class="field"> 
          <input type="text" class="laydate-icon input w50" name="publish_time" value=""  data-validate="required:日期不能为空" style="padding:10px!important; height:auto!important;border:1px solid #ddd!important;" />
          <div class="tips"></div>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label>作者：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" name="author" value=""  />
          <div class="tips"></div>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label>点击次数：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" name="click" value="" data-validate="member:只能为数字"  />
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
$("#submit").on('click',function(){
	$.ajax({
		url :"{{url('admin/article')}}",
		type:'POST',
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
				location.href="{{url('admin/article')}}"
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