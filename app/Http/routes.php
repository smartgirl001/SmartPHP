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

Route::get('/', 'HomeController@index');


//文章详情
Route::get('article/{id}', 'ArticleController@show');

//评论
Route::post('comment/store', 'CommentController@store');

//分类浏览
Route::get('category/{id}','ArticleController@index');


// 单独拿出来避免middleware无限重定向
Route::match(['get','post'], '/admin/login', ['as' => 'admin::login', 'uses' => 'Admin\AuthController@login']);

/**
 *
 * Admin routes
 */
// 单独拿出来避免middleware无限重定向
Route::match(['get','post'], '/admin/login', ['as' => 'admin::login', 'uses' => 'Admin\AuthController@login']);

Route::group(['prefix' => 'admin', 'as' => 'admin::','middleware' => 'admin.auth', 'namespace' => 'Admin'], function () {

    Route::get('/', 'IndexController@index');
    Route::get('/start', 'IndexController@start');

    Route::get('/logout', ['as' => 'logout', 'uses' => 'AuthController@logout']);

    // 个人资料
    Route::match(['get', 'post'], 'profile',['as' => 'profile', 'uses' => 'AdminController@profile']);
    // 修改密码
    Route::match(['get', 'post'], 'changepwd', ['as' => 'changepwd', 'uses' => 'AdminController@changepwd']);

    // 管理员
    Route::match(['get', 'post'], 'manager/create', ['as' => 'manager.create', 'uses' => 'AdminController@create']);
    Route::get('manager/list',['as' => 'manager.list', 'uses' => 'AdminController@get_list']);
    Route::match(['get', 'post'], 'manager/{id}',['as' => 'manager.edit', 'uses' => 'AdminController@edit']);
    Route::get('manager/delete/{id}',['as' => 'manager.delete', 'uses' => 'AdminController@destroy']);

    // 管理组
    Route::match(['get', 'post'], 'group/create',['as' => 'group.create', 'uses' => 'GroupController@create']);
    Route::get('group/list',['as' => 'group.list', 'uses' => 'GroupController@get_list']);
    Route::match(['get', 'post'], 'group/{id}',['as' => 'group.edit', 'uses' => 'GroupController@edit']);
    Route::get('group/delete/{id}',['as' => 'group.delete', 'uses' => 'GroupController@destroy']);

    //文章
    //Route::resource('article', 'ArticleController');
    Route::get('article/index','ArticleController@index');
    Route::get('article/create','ArticleController@create');
    Route::get('article/edit/{id}','ArticleController@edit');

    //图片
    Route::get('picture/index','PictureController@index');
    Route::get('picture/create','PictureController@create');
    Route::get('picture/show/{id}','PictureController@show');

    //产品管理
    Route::get('product/index','ProductController@index');
    Route::get('product/create','ProductController@create');

    Route::get('product/brand','ProductController@brand');
    Route::get('product/category','ProductController@category');
    Route::get('product/addCategory','ProductController@addCategory');


});
