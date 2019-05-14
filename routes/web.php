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
Route::get('/index','IndexController@index');
//注册页面
Route::get('/reg','RegController@reg');
//注册执行
Route::post('/reg_do','RegController@regdo');
//登录
Route::get('/login','RegController@login');
//注册执行
Route::post('/logindo','RegController@logindo');
