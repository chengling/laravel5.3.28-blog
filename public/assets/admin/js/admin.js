 function msg(msg,status)
{
	layer.open({
		  content: msg,
		  yes: function(index, layero){
			    //do something
			    layer.close(index); //如果设定了yes回调，需进行手工关闭
		  }
	});
}