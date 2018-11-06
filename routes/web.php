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

// resource 的用法
// Route::resource('test','TestController');
// 名称 连接上方法名
// $url = URL::route('test.index)
// $url = URL::route('test.edit', array('id'=>1))



// 前台功能
Route::get('/home','home\IndexController@index');

    // 会员登录
    Route::get('login/login', 'Home\LoginController@login')->name('Hlogin');
    Route::post('login/dologin', 'Home\LoginController@dologin')->name('dologin');
    // 会员注册
    Route::get('regist/regist', 'Home\RegistController@regist')->name('regist');
    Route::post('regist/doregist', 'Home\RegistController@doregist')->name('doregist');

    // 会员注册发送短信验证码
    Route::get('/sendcode', 'Home\RegistController@sendcode')->name('ajax-send-code');


// *************************************************************************

// 后台功能
Route::get('/admin','Admin\IndexController@index');
// 嵌套页
Route::get('/admin_home','Admin\IndexController@home')->name('home');

    // 登录模块
    Route::get('/index','Admin\LoginController@login')->name('login');
    Route::post('/dologin','Admin\LoginController@dologin')->name('adminlogin');


    // 权限模块
        // 个人信息
        Route::get('/admin_info','Admin\AdminController@info')->name('info');
        // 角色管理
        Route::get('/admin_list','Admin\AdminController@list')->name('list');
        // 权限管理
        Route::get('/admin_privilege','Admin\AdminController@privilege')->name('privilege');
        // 角色管理
        Route::get('/admin_role','Admin\AdminController@role')->name('role');
        // 用户管理
        Route::get('/admin_admin','Admin\AdminController@admin')->name('admin');

        // 有关权限的增删改查
        Route::get('/privilege_add','Admin\AdminController@pri_add')->name('pri_add');
        Route::post('/privilege_doadd','Admin\AdminController@pri_doadd')->name('pri_doadd');
        Route::get('/privilege_del{$id}','Admin\AdminController@pri_delete')->name('privilege_del');
        // Route::get('/privilege_edit{$id}','Admin\AdminController@edit')->name('privilege_edit');
    

    // 会员模块
        // 会员列表（删除和修改）
        Route::get('/member_list','Admin\MemberController@member_list');
            // 编辑用户
            Route::get('/member_list_add{id}','Admin\MemberController@member_list_add')->name('member_list_add');
            Route::post('/member_list_doadd','Admin\MemberController@member_list_doadd');
            // 删除用户
            Route::get('/member_list_del{id}','Admin\MemberController@member_list_del')->name('member_list_del');
            // 禁用会员
            Route::get('/member_stop{id}','Admin\MemberController@member_stop')->name('member_stop');
            // 解禁用户
            Route::get('/member_recover{id}','Admin\MemberController@member_recover')->name('member_recover');


        // 等级管理
        Route::get('/member_charge','Admin\MemberController@member_charge');
        // 会员记录管理
        Route::get('/member_record','Admin\MemberController@member_record');


    // 商品模块
        // 产品管理  增删改查
        Route::resource('/goods_charge','Admin\GoodsController');
            // 商品删除（独立于资源路由）
            Route::get('/goods_del{id}','Admin\GoodsController@goods_del');

        // 品牌管理
        Route::resource('/brand_charge','Admin\BrandsController');
            // 品牌删除（独立于资源路由）
            Route::get('/brand_del{id}','Admin\BrandsController@brand_del'); 
            // 搜索功能
            Route::get('/brand_search','Admin\BrandsController@brand_search'); 
                      
        // 分类管理
        Route::resource('/category_charge','Admin\CategorysController');
            // 分类列表中ajax获取子分类
            Route::get('/ajax_getcat/{parent_id}','Admin\CategorysController@ajax_getcat');
            // 分类删除（独立于资源路由）
            Route::get('/category_del{id}','Admin\CategorysController@category_del');



            


// Route::get('/test',function(){
//     return "hello";
// });






