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

/*Route::group(['prefix' => 'admin'], function(){
  Route::get('news/create', 'Admin\NewsController@add')->middleware('auth');
  Route::get('profile/create', 'Admin\ProfileController@add')->middleware('auth');
  Route::get('profile/edit', 'Admin\ProfileController@edit')->middleware('auth');

});*/

//以下14章追記
Route::group(['prefix' => 'admin', 'middleware'=> 'auth'], function(){
  Route::get('news/create', 'Admin\NewsController@add');
  Route::post('news/create','Admin\NewsController@create');
  Route::get('news', 'Admin\NewsController@index');
  Route::get('news/edit', 'Admin\NewsController@edit');
  Route::post('news/edit', 'Admin\NewsController@update');
  Route::get('news/delete', 'Admin\NewsController@delete');
});
//prefix->は、無名関数functionの中のURLをadminにしている
//上のグループに入れるときは->middleware authを末尾につけないとダメっぽい
//Profileはprofileでグループを分けたほうがわかりやすいかもしれない。
//Routepostはここでは、create.blade.phpにformactionとmethod postがある。getと違ってフォームアクションでポストと書かないとダメっぽい
//データが送信されると、（送信ボタンなどで）ルートが発動して、コントローラーのクリエエイトアクションに飛ばされる。
//これは通常のページの表示にはGETを受け取り、フォームを送信したときに受け取る場合にはPOSTを受け取るように指定しています。

Route::group(['prefix' => 'admin', 'middleware'=> 'auth'], function(){
  Route::get('profile/create', 'Admin\ProfileController@add');
  Route::get('profile/edit', 'Admin\ProfileController@edit');
  Route::post('profile/create','Admin\ProfileController@create');//課題１４－３
  Route::post('profile/edit', 'Admin\ProfileController@update');//課題１４－６
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'NewsController@index');
