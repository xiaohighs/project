<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	return view('home.index');
});

Route::get('/admin/login','LoginController@login');
Route::post('/admin/login','LoginController@dologin');
Route::get('/articles', 'ArticleController@articleList');

//前台的注册
Route::get('/signup', 'UserController@signup');
Route::post('/signup', 'UserController@dosign');
Route::get('/message', 'CommonController@message');

Route::get('/confirm/{id}', 'UserController@confirm');

//后台路由组
Route::group(['middleware'=>'login'], function(){
	//后台首页
	Route::get('/admin','AdminController@index');

	//用户管理
	Route::resource('user','UserController');

	//文章管理
	Route::resource('article','ArticleController');

	//分类管理
	Route::resource('cate','CateController');
});