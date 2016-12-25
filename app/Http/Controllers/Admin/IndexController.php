<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests;

class IndexController extends BaseController
{
    //
    public function index()
    {
    	return view('admin/index');
    }
    
    
    public function info()
    {
    	return view('admin.info');
    }
}
