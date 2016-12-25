<?php
/**
 * @desc 友情链接
 * @author chenling
 * @package 
 * @since : 2016-12-22下午5:25:46
 * @final : 2016-12-22下午5:25:46
 */
namespace App\Http\Controllers\Admin\Site;

use App\Http\Controllers\Admin\BaseController;
use App\Http\Model\Article\Category;
use App\Http\Model\Site\Link;
use Illuminate\Support\Facades\Input;
class LinkController extends BaseController
{
    
	/**
	* @desc 列表 
	* @access 
	* @param
	* @return
	*/
    public function index()
    {	
    	$data = Link::orderBy('link_id','desc')->paginate(10);
    	return view('admin.site.link_index')->with('data',$data);
    }
    
    /**显示添加页面
    * @desc 
    */
    public function create()
    {	
    	return view('admin.site.link_add');
    }
    
    /**
    * @desc添加友情链接
    * @access 
    * @param
    * @return
    */
    public function store()
    {	
    	 $data = Input::except('_method','_token');
		 $result = Link::create($data);
    	 if($result)
    	 {
	    	return ['status' => 0];
    	 }
    	 return ['status' => 1,'msg' => '添加文章失败'];
    }
    
    
    
    public function edit($link_id)
    {	
    	$result = Link::find($link_id);
    	return view('admin.site.link_edit',['result' => $result,'link_id' => $link_id]);
    }
    
    //
    public function update($link_id)
    {
    	 $data = Input::except('_method','_token');
		 $result = Link::where('link_id',$link_id)->update($data);
    	 if($result !== false)
    	 {
	    	return ['status' => 0];
    	 }
    	 return ['status' => 1,'msg' => '修改失败'];
    }
    
    //
    public function destroy($link_id)
    {
    	$count = Link::where('link_id',$link_id)->delete();
    	return ['status' => 0];
    }
}
