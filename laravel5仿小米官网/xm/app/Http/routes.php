<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

//监听数据库操作 返回sql语句
Event::listen('illuminate.query',function($query){
//     var_dump($query);
});



//迪迪

    Route::get('/', 'Home\IndexController@index');
    //定义前台help路由
    Route::controller('/help','Home\HelpController');
    //定义购物车路由
    Route::get('/cart','Home\CartController@index');
    Route::get('/cart/ajaxaddcart','Home\CartController@ajaxAddCart');
    Route::controller('/cart','Home\CartController');

Route::group(['middleware'=>'home'],function () {
//确认订单的路由
    Route::get('/order/confirm','Home\OrderController@confirm');
    Route::get('/order/changeStatus','Home\OrderController@changeStatus');
    Route::controller('/order','Home\OrderController');
//定义地址路由
    Route::controller('/address','Home\AddressController');
//定义个人中心路由
    Route::controller('/user','Home\UserController');
});



Route::controller('/login','Home\LoginController');


Route::group(['namespace'=>'Home'],function () {
    Route::get('/list', 'ListController@list_');
    Route::get('/list_search', 'ListController@list_Search');
    Route::get('/detail', 'ListController@detail');
    Route::get('/comment', 'CommentController@comment');

});

Route::group(['namespace'=>'Home','middleware'=>'home'],function () {
    Route::post('/comment/insert', 'CommentController@insert');
});
Route::controller('/admin/login','admin\LoginController');
Route::group(['prefix'=>'admin','namespace'=>'admin','middleware'=>'login'],function (){
    Route::get('/','AdminController@index');
    Route::controller('/user','UserController');
    Route::controller('/cate','CateController');
    Route::controller('/good','GoodsController');
    Route::controller('/sku','SkuController');
    Route::controller('/comment','CommentController');

    //定义后台首页模块路由
    Route::controller('/indexPage','IndexController');
    //定义后台help帮助路由
    Route::controller('/help','HelpController');
    //后台订单路由
    Route::controller('/order','OrderController');

});