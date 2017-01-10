<?php
/**
 * @desc 文章处理
 * @author chenling
 * @package 
 * @since : 2016-12-22下午5:25:46
 * @final : 2016-12-22下午5:25:46
 */
namespace App\Http\Controllers\Admin\Article;

use App\Http\Controllers\Admin\BaseController;
use App\Http\Model\Article\Category;
use App\Http\Model\Article\Article;
use App\Http\Model\Article\ArticleBody;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
class ArticleController extends BaseController
{
    
	/**
	* @desc 列表 
	* @access 
	* @param
	* @return
	*/
    public function index()
    {	
    	$data = Article::orderBy('add_time','desc')->paginate(10);
    	return view('admin.article.article.index')->with('data',$data);
    }
    
    /**显示添加页面
    * @desc 
    */
    public function create()
    {	
    	$list = Category::all();
    	$cateModel = new Category();
    	$cateList = $cateModel->getLevel($list);
    	return view('admin.article.article.add',['list' => $cateList]);
    }
    
    /**
    * @desc创建文章 
    * @access 
    * @param
    * @return
    */
    public function store()
    {	
    	 $data = Input::except('_method','_token');
    	 $content = $data['content'];
    	 
    	 unset($data['content']);
    	 $data['add_time'] = time();
		 $data['publish_time'] = 0;
		 if(!$data['cat_id'])
		 {
		 	return ['status' => 1,'msg' =>'请选择栏目'];
		 }
		 $articleModel = new Article();
		 foreach($data as $key => $value)
		 {
		 	$articleModel->$key = $value;
		 }
		 $result = $articleModel->save();
    	 if($result)
    	 {
	    	$body = ['content' => $content,'article_id' => $articleModel->id];
    	 	ArticleBody::create($body);
	    	return ['status' => 0];
    	 }
    	 return ['status' => 1,'msg' => '添加文章失败'];
    }
    
    
    
    public function edit($id)
    {	
    	$list = Category::all();
    	$cateModel = new Category();
    	$cateList = $cateModel->getLevel($list);
    	
    	$result = Article::find($id);
    	$body = ArticleBody::where('id',$id)->first();
    	return view('admin.article.article.edit',['list' => $cateList,'result' => $result,'id' => $id,'body' => $body]);
    }
    
    //
    public function update($id)
    {
    	 $data = Input::except('_method','_token');
    	 $content = $data['content'];
    	 
    	 unset($data['content']);
		 $data['publish_time'] = strtotime($data['publish_time']);
		 if(!$data['cat_id'])
		 {
		 	return ['status' => 1,'msg' =>'请选择栏目'];
		 }
		 $result = Article::where('id',$id)->update($data);
    	 if($result !==false)
    	 {
	    	$body = ['content' => $content];
	    	ArticleBody::where('article_id',$id)->update($body);
	    	return ['status' => 0];
    	 }
    	 return ['status' => 1,'msg' => '修改文章失败'];
    }
    
    //
    public function destroy($id)
    {
    	$count = Article::where('id',$id)->delete();
    	ArticleBody::where('id',$id)->delete();
    	return ['status' => 0];
    }
}
