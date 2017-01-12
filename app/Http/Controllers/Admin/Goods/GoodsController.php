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
use App\Http\Model\Goods\Image;
use App\Http\Model\Goods\Content;
use App\Http\Model\Goods\Brand;
use App\Http\Model\Goods\Category;
use App\Http\Lib\Category as LibCat;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
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
    	$bList = Brand::all()->toArray();
		$cList = Category::all()->toArray();
    	$brandList = [];
    	$catList= [];
    	foreach($bList as $key => $value)
    	{
    		$brandList[$value['id']] = $value['name'];
    	}
    	foreach($cList as $key => $value)
    	{
    		$catList[$value['id']] = $value['name'];
    	}
    	foreach($data as $key => $value)
    	{
    		$value['cat_name'] = $catList[$value['cat_id']];
    		$value['brand_name'] = $brandList[$value['brand_id']];
    		$data[$key] = $value;
    	}
    	return view('admin.goods.goods.index')->with('data',$data);
    }
    
    /**显示添加页面
    * @desc 
    */
    public function create()
    {	
    	$typeList = Type::all();
    	
    	$list = Category::all();
    	$libCat = new LibCat();
    	$catList = $libCat->getLevel($list);
    	
    	$brandList = Brand::all();
    	return view('admin.goods.goods.add',['typeList' => $typeList,'catList' => $catList,'brandList' => $brandList]);
    }
    
    /**
    * @desc创建广告
    * @access 
    * @param
    * @return
    */
    public function store(Request $request)
    {	
    	$goods = $request->get('goods');
    	if(!$goods['name'] || !$goods['goods_type'] || !$goods['brand_id']||!$goods['cat_id'])
    	{
    		return ['status' =>1,'msg' =>'输入信息不完整'];
    	}
    	$goodsModel = new Goods();
    	foreach($goods as $key => $value)
    	{
    		$goodsModel->$key = $value;
    	} 
    	$result = $goodsModel->save();
    	
    	$pictures =$request->get('pictures');
    	if($pictures && is_array($pictures))
    	{
    		foreach($pictures as $pic)
    		{
    			$imageModel = new Image();
    			$imageModel->url = $pic;
    			$imageModel->goods_id = $goodsModel->id;
    			$imageModel->save();
    		}
    	}
    	$content = $request->get('content');
    	if($content)
    	{
    		$contentModel = new Content();
    		foreach($content as $key => $value)
    		{
    			$contentModel->$key = $value;
    		}
    		$contentModel->goods_id = $goodsModel->id;
    		$contentModel->save();
    		
    	}
    	if($result)
    	{
	    	return ['status' => 0];
    	}
    	return ['status' => 1,'msg' => '添加商品失败'];
    }
    
    
    
    public function edit($id)
    {	
    	
    	$result = Goods::find($id);
    	$list = Type::all();
    	
    	$typeList = Type::all();
    	 
    	$list = Category::all();
    	$libCat = new LibCat();
    	$catList = $libCat->getLevel($list);
    	 
    	$brandList = Brand::all();
    	$content= Content::where('goods_id','=',$id)->first();
    	$pictures = Image::where('goods_id','=',$id)->get();
    	return view('admin.goods.goods.edit',['result' => $result,'id' => $id,'typeList' => $typeList,'catList' => $catList,'brandList' => $brandList,'content' => $content,'pictures'=>$pictures]);
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
    	Image::where('goods_id','=',$id)->delete();
    	Content::where('goods_id','=',$id)->delete();
    	return ['status' => 0];
    }
}
