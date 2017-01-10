/**文件上传 id 文件表单隐藏id*/
function upload(id)
{
	$('#file_upload').uploadify({
		'fileSizeLimit':'2MB',
		'multi': false,
		'buttonText':'上传图片',
		'swf'      : '/assets/js/uploadify/uploadify.swf',
		'uploader' : "/upload",
		'onUploadSuccess' : function(file, data, response) {
			 	var data = eval('(' + data + ')');
				$("#picture").html('<img width="100" height="100" src="'+data.path+'" />');
				$("#"+id).val(data.path);
				
		 }
	});
}


/*单个删除*/
function del(url){
	layer.confirm("您确定要删除吗?",function(){
		$.ajax({
			url :url,
			type:'delete',
			dataType:'json',
			data:{_method:'delete'},
			success:function(data)
			{
				if(data.status !='0')
				{
					layer.open({
						  title:'提示',content: data.msg
				    });     
				}else{
					location.href= location.href;
				}
			}
		});
	});
}

/*执行添加*/
function add(url)
{
	$("#submit").on('click',function(){
		$.ajax({
			url :url,
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
					location.href= url;
				}
			}
		});
	});
}
/*执行修改*/
function edit(url,location_url)
{
	$("#edit-submit").on('click',function(){
		$.ajax({
			url :url,
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
					location.href= location_url;
				}
			}
		});
	});
}
