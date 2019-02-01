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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


//註冊路由-使用者-使用路由群組

Route::group(['prefix'=>'user'],function(){
    //使用者驗證
    Route::group(['prefix'=>'auth'],function(){

        //[ 註冊功能 ]

        //使用者註冊頁面
        Route::get('/sign-up','UserAuthController@signUpPage');
        //使用者資料新增
        Route::post('/sign-up','UserAuthController@signUpProcess');
        //--------------------------------------------------------------------------------------------------

        //[登入功能]

        //使用者登入頁面
        Route::get('/sign-')

        //使用者登入處理


        //使用者登出

        
        
        //--------------------------------------------------------------------------------------------------







    });



});