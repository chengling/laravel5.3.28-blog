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
          <label>文章分类：</label>
        </div>
        <div class="field">
          <select name="cat_id" class="input w50">
            @foreach($list as $value)
            <option value="{{$value->cat_id}}" @if($result->cat_id==$value->cat_id) selected @endif>{{$value->cat_name}}</option>
            @endforeach
          </select>
        </div>
      </div>
     
     <div class="form-group">
        <div class="label">
          <label>标题：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" value="{{$result->title}}" name="title" data-validate="required:请输入标题" />
          <div class="tips"></div>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label>图片：</label>
        </div>
        <div class="field">
          <input type="text" id="thumb" name="thumb" class="input tips" style="width:25%; float:left;" value="{{$result->thumb}}"   readonly="readonly" />
          <input id="file_upload" type="file"  value="" style="float:left;">
         
          <div id="picture"><img src="{{$result->thumb}}" with="100" height="100" /></div>
        </div>
      </div>     
      
    <div class="form-group">
          <div class="label">
            <label>其他属性：</label>
          </div>
          <div class="field" style="padding-top:8px;"> 
            	推荐 <input name="attr"  type="radio" value="1" @if($result->attr==1) checked @endif/>
            	置顶 <input name="attr"  type="radio" value="2"  @if($result->attr==2) checked @endif/> 
          </div>
     </div>
     <div class="form-group">
        <div class="label">
          <label>简介：</label>
        </div>
        <div class="field">
          <textarea class="input" name="description" style=" height:90px;">{{$result->description}}</textarea>
          <div class="tips"></div>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label>内容：</label>
        </div>
        <div class="field">
         <script id="container" name="content" type="text/plain">
    	{!! $body->content !!} 
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
          <input type="text" class="input w50" name="sort_order" value="{{$result->sort_order}}"  data-validate="number:排序必须为数字" />
          <div class="tips"></div>
        </div>
      </div>
     <div class="form-group">
        <div class="label">
          <label>是否发布：</label>
        </div>
        <div class="field"> 
          <input type="radio" name="is_publish" value="1"  @if($result->is_publish==1) checked @endif/>是
          <input type="radio" name="is_publish" value="0"  @if($result->is_publish==0) checked @endif/>否
          <div class="tips"></div>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label>发布客户端：</label>
        </div>
        <div class="field"> 
          <input type="radio" name="platform" value="1"  @if($result->platform==1) checked @endif/>pc
          <input type="radio" name="platform" value="2"  @if($result->platform==2) checked @endif/>wap
          <div class="tips"></div>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label>发布时间：</label>
        </div>
        <div class="field"> 
          <input type="text" class="laydate-icon input w50" name="publish_time" value="{{date('Y-m-d H:i',$result->publish_time)}}"  data-validate="required:日期不能为空" style="padding:10px!important; height:auto!important;border:1px solid #ddd!important;" />
          <div class="tips"></div>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label>作者：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" name="author" value="{{$result->author}}"  />
          <div class="tips"></div>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label>点击次数：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" name="click" value="{{$result->click}}" data-validate="member:只能为数字"  />
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
		url :"{{url('admin/article/'.$article_id)}}",
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