<?php
/**
 * @desc 商品属性管理
 * @author chenling
 * @package 
 * @since : 2016-12-22下午5:25:46
 * @final : 2016-12-22下午5:25:46
 */
namespace App\Http\Controllers\Admin\Goods;

use App\Http\Controllers\Admin\BaseController;
use App\Http\Model\Goods\Attr;
use App\Http\Model\Goods\Type;
use Illuminate\Support\Facades\Input;
class AttrController extends BaseController
{
    
	/**
	* @desc 列表 
	* @access 
	* @param
	* @return
	*/
    public function index()
    {	
    	$data = Attr::orderBy('id','desc')->paginate(10);
    	$list = Type::all()->toArray();
		
    	$typeList = array();
    	foreach($list as $key => $value)
    	{
    		$typeList[$value['id']] = $value['name'];
    	}
    	foreach($data as $key => $value)
    	{
    		$value['type_name'] = $typeList[$value['type_id']];
    		$data[$key] = $value;
    	}
    	return view('admin.goods.Attr.index')->with('data',$data);
    }
    
    /**显示添加页面
    * @desc 
    */
    public function create()
    {	
    	$list = Type::all();
    	return view('admin.goods.Attr.add',['list' => $list]);
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
		 $result = Attr::create($data);    	 
    	 if($result)
    	 {
	    	return ['status' => 0];
    	 }
    	 return ['status' => 1,'msg' => '添加分类失败'];
    }
    
    
    
    public function edit($id)
    {	
    	
    	$result = Attr::find($id);
    	$list = Type::all();
    	return view('admin.goods.Attr.edit',['result' => $result,'id' => $id,'list' => $list]);
    }
    
    //
    public function update($id)
    {
    	 $data = Input::except('_method','_token');

    	 $result = Attr::where('id',$id)->update($data);
    	 if($result !== false)
    	 {
	    	return ['status' => 0];
    	 }
    	 return ['status' => 1,'msg' => '修改失败'];
    }
    
    //
    public function destroy($id)
    {
    	$count = Attr::where('id',$id)->delete();
    	return ['status' => 0];
    }
}
