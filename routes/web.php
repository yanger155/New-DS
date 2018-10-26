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

// Route::get('/', function () {
//     return view('home.index.index');
// });

// 前台功能
Route::get('/home','home\IndexController@index');

Route::get('login/login', 'Home\LoginController@login')->name('login');
Route::post('login/dologin', 'Home\LoginController@dologin')->name('dologin');

Route::get('regist/regist', 'Home\RegistController@regist')->name('regist');
Route::post('regist/doregist', 'Home\RegistController@doregist')->name('doregist');

// 发送短信验证码
Route::get('/sendcode', 'Home\RegistController@sendcode')->name('ajax-send-code');


// *************************************************************************

// 后台功能
Route::get('/admin','Admin\IndexController@index');
// 嵌套页
Route::get('/home','Admin\IndexController@home')->name('home');


// 登录模块
Route::get('/index','Admin\LoginController@login')->name('login');
Route::post('/dologin','Admin\LoginController@dologin')->name('adminlogin');


// 权限模块
// 个人信息I
Route::get('/admin_info','Admin\AdminController@info')->name('info');
// 角色管理
Route::get('/admin_list','Admin\AdminController@list')->name('list');
// 权限管理
Route::get('/admin_privilege','Admin\AdminController@privilege')->name('privilege');
// 角色管理
Route::get('/admin_role','Admin\AdminController@role')->name('role');
// 用户管理
Route::get('/admin_admin','Admin\AdminController@admin')->name('admin');





Route::get('/privilege_add','Admin\AdminController@pri_add')->name('pri_add');
Route::post('/privilege_doadd','Admin\AdminController@pri_doadd')->name('pri_doadd');
Route::get('/privilege_del{$id}','Admin\AdminController@pri_delete')->name('privilege_del');
// Route::get('/privilege_edit{$id}','Admin\AdminController@edit')->name('privilege_edit');





// 商品模块
Route::get('/goods','Admin\GoodsController@index');
Route::get('/goods/create','Admin\GoodsController@create');
Route::post('/goods/insert','Admin\GoodsController@insert');
Route::get('/goods/edit{$id}','Admin\GoodsController@edit');
Route::post('/goods/update{$id}','Admin\GoodsController@update');
Route::get('/goods/delete{$id}','Admin\GoodsController@delete');


// 文章模块
Route::get('/articles','Admin\ArticlesController@index');
Route::get('/articles/create','Admin\ArticlesController@create');
Route::post('/articles/insert','Admin\ArticlesController@insert');
Route::get('/articles/edit{$id}','Admin\ArticlesController@edit');
Route::post('/articles/update{$id}','Admin\ArticlesController@update');
Route::get('/articles/delete{$id}','Admin\ArticlesController@delete');