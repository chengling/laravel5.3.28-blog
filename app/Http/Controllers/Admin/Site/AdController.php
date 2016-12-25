<?php
/**
 * @desc 广告和banner管理
 * @author chenling
 * @package 
 * @since : 2016-12-22下午5:25:46
 * @final : 2016-12-22下午5:25:46
 */
namespace App\Http\Controllers\Admin\Site;

use App\Http\Controllers\Admin\BaseController;
use App\Http\Model\Article\Category;
use App\Http\Model\Site\Ad;
use Illuminate\Support\Facades\Input;
class AdController extends BaseController
{
    
	/**
	* @desc 列表 
	* @access 
	* @param
	* @return
	*/
    public function index()
    {	
    	$data = Ad::orderBy('ad_id','desc')->paginate(10);
    	return view('admin.site.ad_index')->with('data',$data);
    }
    
    /**显示添加页面
    * @desc 
    */
    public function create()
    {	
    	return view('admin.site.ad_add');
    }
    
    /**
    * @desc创建广告
    * @access 
    * @param
    * @return
    */
    public function store()
    {	
    	 $data = Input::except('_method','_token');
		 $result = Ad::create($data);    	 
    	 if($result)
    	 {
	    	return ['status' => 0];
    	 }
    	 return ['status' => 1,'msg' => '添加广告失败'];
    }
    
    
    
    public function edit($ad_id)
    {	
    	
    	$result = Ad::find($ad_id);
    	return view('admin.site.ad_edit',['result' => $result,'ad_id' => $ad_id]);
    }
    
    //
    public function update($ad_id)
    {
    	 $data = Input::except('_method','_token');

    	 $result = Ad::where('ad_id',$ad_id)->update($data);
    	 if($result !== false)
    	 {
	    	return ['status' => 0];
    	 }
    	 return ['status' => 1,'msg' => '修改失败'];
    }
    
    //
    public function destroy($ad_id)
    {
    	$count = Ad::where('ad_id',$ad_id)->delete();
    	return ['status' => 0];
    }
}
