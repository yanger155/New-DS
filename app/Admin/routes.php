<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');

    // 这里的brand是你访问的路径，我的路径是http://localhost/admin/brand，BrandController是你的控制器名称，使用的resource就已经包含了增删改查等功能，所以这一个页面只写一个路由就可以了
    $router->resource('/brand', 'BrandController');

});
