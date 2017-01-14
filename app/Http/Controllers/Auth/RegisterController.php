<?php

namespace App\Http\Controllers\Auth;

use App\Http\Model\User\Account;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {	
    	$message = ['name.required'=>'用户名不能为空','name.max'=>'用户名最多20个字符','name.unique'=>'用户名被占用',
    	'password.required'=>'密码不能为空','password.min'=>'密码最少6个字符',
    	'password.confirmed' =>'新密码和旧密码不一样'];
        return Validator::make($data, [
            'name' => 'required|max:20|unique:user_account',
            'password' => 'required|min:6|confirmed',
        ],$message);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {	
    	$salt = $this->rand_salt();
        return Account::create([
            'name' => $data['name'],
        	'salt' => $salt,
            'password' => md5($data['password'].$salt),
        		'createtime' => time(),
        		'modified_time' => time()
        ]);
    }
    
    /**
     * @desc随机产生加密串
     * @access
     * @param
     * @return
     */
    public function rand_salt()
    {
    	$str = '1234567890qwertyuiopasdfghjklzxcvbnm';
    	return substr(str_shuffle($str),0,8);
    }
    
    public function register(Request $request)
    {	
    	$data = $request->all();
    	
    	if(strtolower($data['code']) != strtolower(session('code')))
    	{
    		return ['status' =>1,'msg' =>'验证码不正确'];
    	}
    	unset($data['code']);
    	$validator = $this->validator($request->all());
    	if(!$validator->passes())
    	{
    		$msg = $validator->errors()->all();
    		return ['status' =>1,'msg' => $msg[0]];
    	}
    	$this->create($request->all());
    	return ['status' => 0];
    }
}
