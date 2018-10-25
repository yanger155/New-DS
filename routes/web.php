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



// 后台功能
Route::get('/admin','Admin\IndexController@index');
// 嵌套页
Route::get('/home','Admin\IndexController@home')->name('home');


Route::get('/index','Admin\LoginController@login')->name('login');
Route::post('/dologin','Admin\LoginController@dologin')->name('adminlogin');