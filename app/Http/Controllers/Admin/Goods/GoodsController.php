<?php
/**
 * @desc 商品管理
 * @author chenling
 * @package 
 * @since : 2016-12-22下午5:25:46
 * @final : 2016-12-22下午5:25:46
 */
namespace App\Http\Controllers\Admin\Goods;

use App\Http\Controllers\Admin\BaseController;
use App\Http\Model\Goods\Goods;
use App\Http\Model\Goods\Type;
use App\Http\Model\Goods\Attr;
use App\Http\Model\Goods\Spec;
use App\Http\Model\Goods\SpecItem;
use App\Http\Model\Goods\Brand;
use App\Http\Model\Goods\Category;
use App\Http\Lib\Category as LibCat;
use Illuminate\Support\Facades\Input;
class GoodsController extends BaseController
{
    
	/**
	* @desc 列表 
	* @access 
	* @param
	* @return
	*/
    public function index()
    {	
    	$data = Goods::orderBy('id','desc')->paginate(10);
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
    	return view('admin.goods.goods.index')->with('data',$data);
    }
    
    /**显示添加页面
    * @desc 
    */
    public function create()
    {	
    	$list = Type::all();
    	
    	$list = Category::all();
    	$libCat = new LibCat();
    	$catList = $libCat->getLevel($list);
    	
    	$brandList = Brand::all();
    	return view('admin.goods.goods.add',['list' => $list,'catList' => $catList,'brandList' => $brandList]);
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
		 $result = Goods::create($data);    	 
    	 if($result)
    	 {
	    	return ['status' => 0];
    	 }
    	 return ['status' => 1,'msg' => '添加分类失败'];
    }
    
    
    
    public function edit($id)
    {	
    	
    	$result = Goods::find($id);
    	$list = Type::all();
    	return view('admin.goods.goods.edit',['result' => $result,'id' => $id,'list' => $list]);
    }
    
    //
    public function update($id)
    {
    	 $data = Input::except('_method','_token');

    	 $result = Goods::where('id',$id)->update($data);
    	 if($result !== false)
    	 {
	    	return ['status' => 0];
    	 }
    	 return ['status' => 1,'msg' => '修改失败'];
    }
    
    //
    public function destroy($id)
    {
    	$count = Goods::where('id',$id)->delete();
    	return ['status' => 0];
    }
}
