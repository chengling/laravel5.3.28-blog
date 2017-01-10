<?php
/**
 * @desc 商品类型管理
 * @author chenling
 * @package 
 * @since : 2016-12-22下午5:25:46
 * @final : 2016-12-22下午5:25:46
 */
namespace App\Http\Controllers\Admin\Goods;

use App\Http\Controllers\Admin\BaseController;
use App\Http\Model\Goods\Type;
use Illuminate\Support\Facades\Input;
class TypeController extends BaseController
{
    
	/**
	* @desc 列表 
	* @access 
	* @param
	* @return
	*/
    public function index()
    {	
    	$data = Type::orderBy('id','desc')->paginate(10);
    	return view('admin.goods.Type.index')->with('data',$data);
    }
    
    /**显示添加页面
    * @desc 
    */
    public function create()
    {	
    	return view('admin.goods.Type.add');
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
		 $result = Type::create($data);    	 
    	 if($result)
    	 {
	    	return ['status' => 0];
    	 }
    	 return ['status' => 1,'msg' => '添加类型失败'];
    }
    
    
    
    public function edit($id)
    {	
    	
    	$result = Type::find($id);
    	return view('admin.goods.Type.edit',['result' => $result,'id' => $id]);
    }
    
    //
    public function update($id)
    {
    	 $data = Input::except('_method','_token');

    	 $result = Type::where('id',$id)->update($data);
    	 if($result !== false)
    	 {
	    	return ['status' => 0];
    	 }
    	 return ['status' => 1,'msg' => '修改失败'];
    }
    
    //
    public function destroy($id)
    {
    	$count = Type::where('id',$id)->delete();
    	return ['status' => 0];
    }
}
