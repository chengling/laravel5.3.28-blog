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
	  	<li><a href="javascript:;" data-toggle="tab-tongyong">通用信息</a></li>
	  	<li><a href="javascript:;" data-to>商品描述</a></li>
	  	<li><a href="javascript:;">商品信息</a></li>
	  	<li><a href="javascript:;">商品规格</a></li>
	  	<li><a href="javascript:;">商品属性</a></li>
	  </ul>
    <form method="post" class="form-x" id="form">
     <div class="form-group">
        <div class="label">
          <label>所属商品分类：</label>
        </div>
        <div class="field">
          <select name="cat_id" class="input w50">
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
          <select name="bran_id" class="input w50">
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
          <input type="text" class="input w50"  name="name" data-validate="required:请输入标题" />
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
          <label>销售价：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50"  name="shop_price" data-validate="required:请输入标题" />
          <div class="tips"></div>
        </div>
      </div>
        <div class="form-group">
        <div class="label">
          <label>市场价：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50"  name="market_price" data-validate="required:请输入标题" />
          <div class="tips"></div>
        </div>
      </div>
       <div class="form-group">
        <div class="label">
          <label>成本价：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50"  name="cost_price" data-validate="required:请输入标题" />
          <div class="tips"></div>
        </div>
      </div>
       <div class="form-group">
        <div class="label">
          <label>佣金：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50"  name="commission" data-validate="required:请输入标题" />
          <div class="tips"></div>
        </div>
      </div>
        <div class="form-group">
        <div class="label">
          <label>商品关键词：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50"  name="keywords" data-validate="required:请输入标题" />
          <div class="tips"></div>
        </div>
      </div>
        <div class="form-group">
        <div class="label">
          <label>商品简介：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50"  name="brief" data-validate="required:请输入标题" />
          <div class="tips"></div>
        </div>
      </div>
        <div class="form-group">
        <div class="label">
          <label>库存：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50"  name="store_count" data-validate="required:请输入标题" />
          <div class="tips"></div>
        </div>
      </div>
        <div class="form-group">
        <div class="label">
          <label>是否包邮：</label>
        </div>
        <div class="field">
			<input type="radio" name="is_free_shipping" value="0"  checked="checked" />否
            <input type="radio" name="is_free_shipping" value="1"  />是                 <div class="tips"></div>
        </div>
      </div>
        <div class="form-group">
        <div class="label">
          <label>是否实物：</label>
        </div>
        <div class="field">
 			<input type="radio" name="is_real" value="0" />否
            <input type="radio" name="is_real" value="1"  checked="checked"/>是       
             <div class="tips"></div>
        </div>
      </div>
       <div class="form-group">
        <div class="label">
          <label>商品图片：</label>
        </div>
        <div class="field">
          <input type="text" id="thumb" name="thumb" class="input tips" style="width:25%; float:left;"   readonly="readonly" />
          <input id="file_upload" type="file"  value="" style="float:left;">
         
          <div id="picture"></div>
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
upload("thumb");
add("{{url('admin/attr')}}");
</script>
@endsection