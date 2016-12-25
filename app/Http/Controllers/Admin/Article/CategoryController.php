<?php
/**
 * @desc 文章分类处理
 * @author chenling
 * @package 
 * @since : 2016-12-22下午5:25:46
 * @final : 2016-12-22下午5:25:46
 */
namespace App\Http\Controllers\Admin\Article;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\BaseController;
use App\Http\Model\Article\Category;
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
    	$cateModel = new Category();
    	$tree = $cateModel->getTree($data['list']);
    	$data['tree'] = json_encode($tree);
    	return view('admin.article.category_index')->with('data',$data);
    }
    
    //
    public function create()
    {	
    	$list = Category::all();
    	$cateModel = new Category();
    	$cateList = $cateModel->getLevel($list);
    	return view('admin.article.category_add',['list' => $cateList]);
    }
    
    //
    public function store()
    {	
    	 $data = Input::except('_method');
    	 
    	 $rules = [
    	 'cat_name'=>'required',
    	 ];
    	 
    	 $message = [
    	 'cat_name.required'=>'分类名称不能为空！',
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
    public function edit($cat_id)
    {	
    	$list = Category::all();
    	$cateModel = new Category();
    	$cateList = $cateModel->getLevel($list);
    	
    	$result = Category::find($cat_id);
    	return view('admin.article.category_edit',['list' => $cateList,'result' => $result,'cat_id' => $cat_id]);
    }
    
    //
    public function update($cat_id)
    {
    	 $data = Input::except('_method');
    	 $result = Category::where('cat_id',$cat_id)->update($data);
    	 if($result !==false)
    	 {
    	 	return ['status' => 0];
    	 }
    	 return ['status' => 1,'msg' =>'修改成功'];
    }
    
    //
    public function destroy($cat_id)
    {
    	$count = Category::where('parent_id',$cat_id)->count();
    	if($count)
    	{
    		return ['status' =>1, 'msg' =>'该分类下有子分类，不有删除'];
    	}
    	Category::where('cat_id',$cat_id)->delete();
    	return ['status' => 0];
    }
}
