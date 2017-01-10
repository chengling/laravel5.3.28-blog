<?php
/**
 * @desc 商品品牌管理
 * @author chenling
 * @package 
 * @since : 2016-12-22下午5:25:46
 * @final : 2016-12-22下午5:25:46
 */
namespace App\Http\Controllers\Admin\Goods;

use App\Http\Controllers\Admin\BaseController;
use App\Http\Model\Goods\Brand;
use Illuminate\Support\Facades\Input;
class BrandController extends BaseController
{
    
	/**
	* @desc 列表 
	* @access 
	* @param
	* @return
	*/
    public function index()
    {	
    	$data = Brand::orderBy('id','desc')->paginate(10);
    	return view('admin.goods.brand.index')->with('data',$data);
    }
    
    /**显示添加页面
    * @desc 
    */
    public function create()
    {	
    	return view('admin.goods.brand.add');
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
		 $result = Brand::create($data);    	 
    	 if($result)
    	 {
	    	return ['status' => 0];
    	 }
    	 return ['status' => 1,'msg' => '添加品牌失败'];
    }
    
    
    
    public function edit($id)
    {	
    	
    	$result = Brand::find($id);
    	return view('admin.goods.brand.edit',['result' => $result,'id' => $id]);
    }
    
    //
    public function update($id)
    {
    	 $data = Input::except('_method','_token');

    	 $result = Brand::where('id',$id)->update($data);
    	 if($result !== false)
    	 {
	    	return ['status' => 0];
    	 }
    	 return ['status' => 1,'msg' => '修改失败'];
    }
    
    //
    public function destroy($id)
    {
    	$count = Brand::where('id',$id)->delete();
    	return ['status' => 0];
    }
}
