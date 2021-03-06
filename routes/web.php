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
    return view('welcome');
});
//用户模块
//注册页面
Route::get('/register','\App\Http\Controllers\RegisterController@index');
//注册行为
Route::post('/register','\App\Http\Controllers\RegisterController@register');
//登录页面
Route::get('/login','\App\Http\Controllers\LoginController@index');
//登录行为
Route::post('/login','\App\Http\Controllers\LoginController@login');
//登出行为
Route::get('/logout','\App\Http\Controllers\LoginController@logout');
//个人设置页面
Route::get('/user/me/setting','\App\Http\Controllers\UserController@setting');
//设置保存
Route::post('/user/me/setting','\App\Http\Controllers\UserController@settingStore');


//文章模块
//文章列表页
Route::get('/posts','\App\Http\Controllers\PostController@index');

//创建文章
Route::get('/posts/create','\App\Http\Controllers\PostController@create');
//上传图片
Route::get('/posts/image/upload','\App\Http\Controllers\PostController@imageUpload');
//创建逻辑
Route::post('/posts/ajaxCreate','\App\Http\Controllers\PostController@store');
//提交评论
Route::post('/posts/ajaxComment','\App\Http\Controllers\PostController@comment');

//删除文章
Route::get('/posts/delete','\App\Http\Controllers\PostController@delete');

//点赞
Route::get('/posts/{post}/like','\App\Http\Controllers\PostController@like');


//取消点赞
Route::get('/posts/{post}/dislike','\App\Http\Controllers\PostController@dislike');

//编辑文章
Route::get('/posts/{post}/edit','\App\Http\Controllers\PostController@edit');
//编辑逻辑
Route::post('/posts/{post}','\App\Http\Controllers\PostController@update');

//文章详情页
Route::get('/posts/{post}','\App\Http\Controllers\PostController@show');

