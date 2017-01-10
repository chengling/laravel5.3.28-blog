<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::any('/', 'Home\Article\ArticleController@index');
Route::any('/list/{cat_id}', 'Home\Article\ArticleController@clist');
Route::any('/news/{article_id}', 'Home\Article\ArticleController@news');

Route::group(['middleware' => ['web']],function(){
	Route::any('/admin/login', 'Admin\LoginController@login');
	Route::any('/admin/toLogin', 'Admin\LoginController@toLogin');
	Route::any('/admin/logout', 'Admin\LoginController@logout');
	Route::any('/admin/login/code', 'Admin\LoginController@code');
	
});

Route::group(['middleware' => ['web','check.login']],function(){
		Route::any('/admin/index', 'Admin\IndexController@index');
		Route::any('/admin/info', 'Admin\IndexController@info');
		Route::any('/admin/account/index', 'Admin\Account\IndexController@index');
		Route::any('/admin/account/pass', 'Admin\Account\IndexController@pass');
	//	Route::any('/admin/account/role', 'Admin\Account\RoleController@index');
	
		Route::any('/upload', 'UploadController@upload');
		Route::resource('/admin/category', 'Admin\Article\CategoryController');
		Route::resource('/admin/article', 'Admin\Article\ArticleController');
		Route::resource('/admin/link', 'Admin\Site\LinkController');
		Route::resource('/admin/ad', 'Admin\Site\AdController');
		
		Route::resource('/admin/brand', 'Admin\Goods\BrandController');
		Route::resource('/admin/cat', 'Admin\Goods\CategoryController');
		Route::resource('/admin/attr', 'Admin\Goods\AttrController');
		Route::resource('/admin/goodstype', 'Admin\Goods\TypeController');
		Route::resource('/admin/spec', 'Admin\Goods\SpecController');
		Route::resource('/admin/goods', 'Admin\Goods\GoodsController');
		
});