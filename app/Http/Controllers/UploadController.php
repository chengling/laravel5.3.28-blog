<?php
/**
 * @desc文件上传
 * @author chenling
 * @package 
 * @since : 2016-12-23下午7:00:56
 * @final : 2016-12-23下午7:00:56
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
class UploadController extends Controller
{
    
	
	public function upload()
	{	
		$uploadPath = base_path().'/public/uploads/'.date('Y/m').'/';
		$file =Input::file('Filedata');
	    if($file -> isValid())
	    {
            $entension = $file -> getClientOriginalExtension(); //上传文件的后缀.
            $newName = date('YmdHis').mt_rand(100,999).'.'.$entension;
            $path = $file -> move($uploadPath,$newName);
            $filePath = str_replace(base_path().'/public', '', $uploadPath);
            $filePath.=$newName;
            return ['status' => 0,'path' => $filePath];
        }else
        {
        	return ['status' => 1,'msg' =>'文件校验失败'];
        }
	}
}
