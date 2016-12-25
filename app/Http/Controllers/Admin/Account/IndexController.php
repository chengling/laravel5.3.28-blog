<?php
/**
 * @desc 管理员修改
 * @package 
 * @since : 2016-12-21下午1:20:18
 * @final : 2016-12-21下午1:20:18
 */
namespace App\Http\Controllers\Admin\Account;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use App\Http\Model\Admin\Account;
use App\Http\Controllers\Admin\BaseController;
class IndexController extends BaseController
{
    public function index()
    {	
    	$login_name = session()->get('user');
    	$data = ['user' =>$login_name];
    	return view('admin.account.index',$data);
    }
    
    /**
    * @desc修改密码 
    * @access 
    * @param
    * @return
    */
    public function pass(Request $request)
    {
    	$data = $request->all();
    	$rules = [
                'newpass'=>'required|between:8,20|confirmed',
            ];
    	$message = [
	    	'newpass.required'=>'新密码不能为空！',
	    	'newpass.between'=>'新密码必须在6-20位之间！',
	    	'newpass.confirmed'=>'新密码和确认密码不一致！',
    	];
    	
    	$validator = Validator::make($data,$rules,$message);
    	if(!$validator->passes())
    	{	
    		return back()->withErrors($validator);
    	}
    	$user = session()->get('user');
    	$account = Account::find($user['account_id']);
    	$password = md5($data['mpass'].$account['salt']);
    	
    	if($password != $account['login_password'])
    	{	
    		return back()->with("errors","原密码不正确");
    	}
    	$newPass = md5($data['newpass'].$account['salt']);
    	$account->login_password = $newPass;
    	$account->save();
    	return back()->with('errors',"密码修改成功");
    }
}
