@extends('admin.layout.common')
@section('content')
<body>
<script type="text/javascript" src="/assets/admin/js/ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="/assets/admin/js/ueditor/ueditor.all.js"></script>
<script src="/assets/js/uploadify/jquery.uploadify.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="/assets/js/uploadify/uploadify.css">
<div class="panel admin-panel margin-top">
  <div class="panel-head" id="add"><strong><span class="icon-pencil-square-o"></span>添加商品</strong></div>
  <div class="body-content">
	  <ul class="panel-nav">
	  	<li><a href="javascript:;" data-toggle="tongyong">通用信息</a></li>
	  	<li><a href="javascript:;" data-toggle="description">商品描述</a></li>
	  	<li><a href="javascript:;" data-toggle="goodspicture">商品相册</a></li>
	  	<li><a href="javascript:;" data-toggle="spec">商品规格</a></li>
	  	<li><a href="javascript:;" data-toggle="attr">商品属性</a></li>
	  </ul>
    <form method="post" class="form-x" id="form">
    <div id="tongyong">
    
     <div class="form-group">
        <div class="label">
          <label>所属商品分类：</label>
        </div>
        <div class="field">
          <select name="goods[cat_id]" class="input w50">
            <option value="0">选择商品分类</option>
            @foreach($catList as $value)
            <option value="{{$value['id']}}">{{$value['name']}}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label>所属商品品牌：</label>
        </div>
        <div class="field">
          <select name="goods[brand_id]" class="input w50">
            <option value="0">选择品牌</option>
            @foreach($brandList as $value)
            <option value="{{$value['id']}}">{{$value['name']}}</option>
            @endforeach
          </select>
        </div>
      </div>
     <div class="form-group">
        <div class="label">
          <label>商品名称：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50"  name="goods[name]" data-validate="required:请输入标题" />
          <div class="tips"></div>
        </div>
      </div>
     
      <div class="clear"></div>
      <div class="form-group">
        <div class="label">
          <label>排序：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" name="goods[sort_order]" value="0"  data-validate="number:排序必须为数字" />
          <div class="tips"></div>
        </div>
      </div>
        <div class="form-group">
        <div class="label">
          <label>销售价：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50"  name="goods[shop_price]" data-validate="required:请输入标题" />
          <div class="tips"></div>
        </div>
      </div>
        <div class="form-group">
        <div class="label">
          <label>市场价：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50"  name="goods[market_price]" data-validate="required:请输入标题" />
          <div class="tips"></div>
        </div>
      </div>
       <div class="form-group">
        <div class="label">
          <label>成本价：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50"  name="goods[cost_price]" data-validate="required:请输入标题" />
          <div class="tips"></div>
        </div>
      </div>
       <div class="form-group">
        <div class="label">
          <label>佣金：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50"  name="goods[commission]" data-validate="required:请输入标题" value="0"/>
          <div class="tips"></div>
        </div>
      </div>
        <div class="form-group">
        <div class="label">
          <label>商品关键词：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50"  name="goods[keywords]" data-validate="required:请输入标题" />
          <div class="tips"></div>
        </div>
      </div>
        <div class="form-group">
        <div class="label">
          <label>商品简介：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50"  name="goods[brief]" data-validate="required:请输入标题" />
          <div class="tips"></div>
        </div>
      </div>
        <div class="form-group">
        <div class="label">
          <label>库存：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50"  name="goods[store_count]" data-validate="required:请输入标题" />
          <div class="tips"></div>
        </div>
      </div>
        <div class="form-group">
        <div class="label">
          <label>是否包邮：</label>
        </div>
        <div class="field">
			<input type="radio" name="goods[is_free_shipping]" value="0"  checked="checked" />否
            <input type="radio" name="goods[is_free_shipping]" value="1"  />是                 <div class="tips"></div>
        </div>
      </div>
        <div class="form-group">
        <div class="label">
          <label>是否实物：</label>
        </div>
        <div class="field">
 			<input type="radio" name="goods[is_real]" value="0" />否
            <input type="radio" name="goods[is_real]" value="1"  checked="checked"/>是       
             <div class="tips"></div>
        </div>
      </div>
       <div class="form-group">
        <div class="label">
          <label>商品图片：</label>
        </div>
        <div class="field">
          <input type="text" id="original_img" name="goods[original_img]" class="input tips" style="width:25%; float:left;"   readonly="readonly" />
          <input id="file_upload" type="file"  value="" style="float:left;">
         
          <div id="picture"></div>
        </div>
      </div>   
      </div>  
      <div id="description" style="display: none">
      	  <div class="form-group">
	        <div class="label">
	          <label>商品详细描述：</label>
	        </div>
	        <div class="field">
	         <script id="container" name="content[content]" type="text/plain">
    	  	  </script>
	          <div class="tips"></div>
	        </div>
      	</div>
      	
      	 <div class="form-group">
	        <div class="label">
	          <label>wap商品详细描述：</label>
	        </div>
	        <div class="field" >
	         <script id="wap_container" name="content[wap_content]" type="text/plain">
    	  </script>
	          <div class="tips"></div>
	        </div>
      	</div>
      	
      </div>
      <div id="goodspicture" style="display: none">
      	   <div class="form-group">
		        <div class="label">
		          <label>商品相册：</label>
		        </div>
		        <div class="field">
		          <input id="wap_upload" type="file"  value="" style="float:left;">
		         
		          <div id="wap_picture"></div>
		        </div>	
     	 </div>   
      	
      </div>
      <div id="spec" style="display: none">
      	  <div class="label">
          <label>所属商品类型：</label>
        </div>
        <div class="field">
          <select name="goods[goods_type]" class="input w50" onchange="ajaxSpec()">
            <option value="0">选择</option>
            @foreach($typeList as $value)
            <option value="{{$value['id']}}">{{$value['name']}}</option>
            @endforeach
          </select>
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
upload("original_img");
add("{{url('admin/goods')}}");
var ue = UE.getEditor('container');
var wap_ue = UE.getEditor('wap_container');
jQuery(".panel-nav li a").each(function(index){
	$(this).on('click',function(){
		var _attr = $(this).attr('data-toggle');
		jQuery(".panel-nav li a").each(function(){
			var attr = $(this).attr('data-toggle');
			if(attr == _attr)
			{
				$("#"+attr).css({'display':'block'});
			}else{
				$("#"+attr).css({'display':'none'});
			}
		});
	});
});
$('#wap_upload').uploadify({
	'fileSizeLimit':'2MB',
	'multi': true,
	'buttonText':'上传图片',
	'swf'      : '/assets/js/uploadify/uploadify.swf',
	'uploader' : "/upload",
	'onUploadSuccess' : function(file, data, response) {
		 	var data = eval('(' + data + ')');
			$("#wap_picture").append('<div class="upload-picture"><img width="100" height="100" src="'+data.path+'" /><input type="hidden" name="pictures[]" value="'+data.path+'"><a href="javascript:void(0)" onclick="clearPicture(this);">删除</a></div>');
			
	 }
});
function clearPicture(obj)
{	
	$(obj).parent().remove();
}

function ajaxSpec()
{

}
</script>
@endsection