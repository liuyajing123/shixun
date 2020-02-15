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

Route::prefix('/admin')->group(function() {
    Route::any('/get_access_token','adminController@access_token');
    Route::get('/admin','adminController@admin');//后台首页
    Route::get('/login','adminController@login');//后台登录
    Route::post('/do_login','adminController@do_login');//登录执行
    Route::get('/upload_video','adminController@upload_video');//视频上传
    Route::any('/do_upload','adminController@do_upload');//上传执行
    Route::get('/cate_add','adminController@cate_add');//分类添加
    Route::post('/do_cate_add','adminController@do_cate_add');//分类添加执行
    Route::get('/cate_list','adminController@cate_list');//分类列表
    Route::get('/delete_cate/{id}','adminController@delete_cate');//分类删除
    Route::get('/update_cate/{id}','adminController@update_cate');//分类修改
    Route::post('/update','adminController@update');//分类修改
    Route::get('/upload_thumb','adminController@upload_video');//轮播图上传
    Route::get('/do_upload_thumb','adminController@do_upload_thumb');//轮播图上传执行
    Route::get('/add_menu','adminController@add_menu');//添加菜单
    Route::post('/create_menu','adminController@create_menu');//添加菜单执行
    Route::get('/list_menu','adminController@list_menu');//菜单列表
    Route::get('/load_menu','adminController@load_menu');//刷新
});

Route::prefix('/mianshi')->group(function(){
    Route::get('/admin','mianshi\testController@admin');//后台管理员登录
    Route::post('do_admin','mianshi\testController@do_admin');//后台管理员登录执行
    Route::get('/admin_add','mianshi\testController@admin_add');//后台添加用户
    Route::post('/do_admin_add','mianshi\testController@do_admin_add');//后台添加前台用户执行
    Route::get('/admin_list','mianshi\testController@admin_list');//后台添加前台用户列表
    Route::get('/login','mianshi\testController@login');//前台登录
    Route::post('/do_login','mianshi\testController@do_login');//前台登录执行
    Route::get('/add','mianshi\testController@add');//面试添加
    Route::post('/do_add','mianshi\testController@do_add');//添加执行
    Route::get('/index','mianshi\testController@index');//面试列表
});