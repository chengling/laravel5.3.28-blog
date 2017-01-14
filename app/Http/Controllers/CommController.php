<?php
/**
 * @desc前台后共用控制器
 * @author chenling
 * @package 
 * @since : 2017-1-14上午11:34:14
 * @final : 2017-1-14上午11:34:14
 */
namespace App\Http\Controllers;
use App\Http\Lib\Code;

class CommController extends Controller
{	
	/**
	* @desc 验证码 
	* @access 
	* @param
	* @return
	*/
	public function  code(){
		$code = new Code();
		$code->code();
	}
}