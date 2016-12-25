<?php
/**
 * @desc文章前台
 * @author chenling
 * @package 
 * @since : 2016-12-25上午9:58:14
 * @final : 2016-12-25上午9:58:14
 */
namespace App\Http\Controllers\Home\Article;

use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    public function index()
    {
    	return view('home.article.index');
    }
    
    public function clist($cat_id = 0)
    {
    	return view('home.article.list');
    }
    
    public function news($article_id = 0)
    {
    	return view('home.article.news');
    }
}
