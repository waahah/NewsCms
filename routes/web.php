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

// 后台
Route::get('/admin/login', 'Admin\UserController@login');
Route::post('/admin/check', 'Admin\UserController@check');
Route::get('/admin/logout', 'Admin\UserController@logout');
Route::get('/admin/index', 'Admin\IndexController@index')->middleware(['Admin']);

// 栏目
Route::prefix('category')->namespace('Admin')->middleware(['Admin'])->group(function () {
    Route::get('', 'CategoryController@index');
    Route::get('add', 'CategoryController@add');
    Route::post('save', 'CategoryController@save');
    Route::get('edit/{id}', 'CategoryController@edit');
    Route::post('delete/{id}', 'CategoryController@delete');
    Route::post('sort', 'CategoryController@sort');
});

// 内容
Route::prefix('content')->namespace('Admin')->middleware(['Admin'])->group(function () {

    Route::get('add', 'ContentController@add');
    Route::post('upload', 'ContentController@upload');
    Route::post('save', 'ContentController@save');
    Route::get('edit/{id}', 'ContentController@edit');
    Route::post('delete/{id}', 'ContentController@delete');
    Route::get('{id?}', 'ContentController@index');
});

// 广告位
Route::prefix('adv')->namespace('Admin')->middleware(['Admin'])->group(function () {
    Route::get('add/{id?}', 'AdvController@add');
    Route::post('save', 'AdvController@save');
    Route::post('delete/{id}', 'AdvController@delete');
    Route::get('', 'AdvController@index');
});

// 广告内容
Route::prefix('advcontent')->namespace('Admin')->middleware(['Admin'])->group(function () {
    Route::get('add/{id?}', 'AdvcontentController@add');
    Route::post('upload', 'AdvcontentController@upload');
    Route::post('save', 'AdvcontentController@save');
    Route::post('delete/{id}', 'AdvcontentController@delete');
    Route::get('', 'AdvcontentController@index');
});

// 首页
Route::get('/', 'IndexController@index');
Route::get('/lists/{id}', 'IndexController@lists');
Route::get('/detail/{id}', 'IndexController@detail');
Route::get('/like/{id}', 'IndexController@like');
Route::get('/comment', 'IndexController@comment');
Route::post('/register', 'UserController@register');
Route::post('/login', 'UserController@login');
Route::get('/logout', 'UserController@logout');


// 设置面包屑导航
Route::name('home')->get('/', 'IndexController@index');
Route::name('category')->get('/lists/{id}', 'IndexController@lists');
Route::name('detail')->get('/detail/{id}', 'IndexController@detail');