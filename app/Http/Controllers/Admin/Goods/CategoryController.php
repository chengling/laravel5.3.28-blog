<?php
/**
 * @desc 商品分类处理
 * @author chenling
 * @package 
 * @since : 2016-12-22下午5:25:46
 * @final : 2016-12-22下午5:25:46
 */
namespace App\Http\Controllers\Admin\Goods;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\BaseController;
use App\Http\Model\Article\Category as ArticleCat;
use App\Http\Model\Goods\Category;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
class CategoryController extends BaseController
{
    
	/**
	* @desc 列表 
	* @access 
	* @param
	* @return
	*/
    public function index()
    {
    	$data['list'] = Category::all();
    	$cateModel = new ArticleCat();
    	$tree = $cateModel->getTree($data['list']);
    	$data['tree'] = json_encode($tree);
    	return view('admin.goods.category.index')->with('data',$data);
    }
    
    //
    public function create()
    {	
    	$list = Category::all();
    	$cateModel = new ArticleCat();
    	$cateList = $cateModel->getLevel($list);
    	return view('admin.goods.category.add',['list' => $cateList]);
    }
    
    //
    public function store()
    {	
    	 $data = Input::except('_method');
    	 
    	 $rules = [
    	 'name'=>'required',
    	 ];
    	 
    	 $message = [
    	 'name.required'=>'分类名称不能为空！',
    	 ];
		 $validator = Validator::make($data,$rules,$message);    	 
    	 if(!$validator->passes())
    	 {	
    	 	$msg = $validator->errors()->all();
    	 	return ['status' => 1,'msg' => $msg[0]];
    	 }
    	 $result = Category::create($data);
    	 if($result)
    	 {
    	 	return ['status' => 0];
    	 }
    	 return ['status' => 1,'msg' => '添加分类失败'];
    }
    
    //
    public function show()
    {
    	 
    }
    
    //
    public function edit($id)
    {	
    	$list = Category::all();
    	$cateModel = new ArticleCat();
    	$cateList = $cateModel->getLevel($list);
    	
    	$result = Category::find($id);
    	return view('admin.goods.category.edit',['list' => $cateList,'result' => $result,'id' => $id]);
    }
    
    //
    public function update($id)
    {
    	 $data = Input::except('_method');
    	 $result = Category::where('id',$id)->update($data);
    	 if($result !==false)
    	 {
    	 	return ['status' => 0];
    	 }
    	 return ['status' => 1,'msg' =>'修改成功'];
    }
    
    //
    public function destroy($id)
    {
    	$count = Category::where('parent_id',$id)->count();
    	if($count)
    	{
    		return ['status' =>1, 'msg' =>'该分类下有子分类，不有删除'];
    	}
    	Category::where('id',$id)->delete();
    	return ['status' => 0];
    }
}
