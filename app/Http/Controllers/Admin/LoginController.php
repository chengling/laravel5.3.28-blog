<?php
/**
 * @desc 后台登录相关操作
 * @author chenling
 * @package 
 * @since : 2016-12-21上午9:04:08
 * @final : 2016-12-21上午9:04:08
 */
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Middleware\VerifyCsrfToken;
use App\Http\Model\Admin\Account;
use Illuminate\Support\Facades\Session;
use Illuminate\Session\Store;
use App\Http\Lib\Code;
class LoginController extends BaseController
{
    
	public function login()
	{
		if(session()->get('user'))
		{
			return redirect("admin/index");
		}
		return view('admin/login/login');
	}
	
	
	public function toLogin(Request $request)
	{	
		$data = $request->all();
		$code = session()->get('code');
		if($data['code'] != $code)
		{
			 return back()->with('msg','验证码错误');
		}
		$account = Account::whereRaw("login_name = ?  and disabled=0",[$data['name']])->first(['login_name','account_id','login_password','salt','super','role_id']);
		if(!$account)
		{
			return back()->with('msg','用户名密码错误或者账户被禁用');
		}
		$password = md5($data['password'].$account['salt']);
		if($password != $account['login_password'])
		{
			return back()->with('msg','用户名密码错误或者账户被禁用');
		}
		session()->set('user',$account);
		return redirect('admin/index');
	}
	
	
	public function logout(Store $store)
	{	
		
		session()->set('user',null);
		return redirect("admin/login");
	}
	
	
}
