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

// -- MENU画面 -- //
Route::prefix('menu')->group(function (){
	Route::get('/', 'MenuController@show')->name('menu.show');
	Route::get('/{url}', 'MenuController@choice')->name('menu.choice')->where('url', '[a-z\-]+');
});

// -- 予約画面 -- //
Route::prefix('reservation')->group(function (){
	Route::get('/', 'ReservationController@show')->name('reservation.show');
	Route::post('/', 'ReservationController@choicePost')->name('reservation.choicePost');
	Route::get('/choice', 'ReservationController@choiceView')->name('reservation.choiceView');
	Route::post('/choice', 'ReservationController@addPost')->name('reservation.addPost');
	Route::get('/user', 'ReservationController@userView')->name('reservation.userView');
	Route::post('/user', 'ReservationController@userPost')->name('reservation.userPost');
	Route::get('/complete', 'ReservationController@completeView')->name('reservation.completeView');
	// v8 v9した場合はルートの書き方変更
	//Route::get('/', [ReservationController::class, 'show']);
});

// -- 予約MENU登録画面はGITHUB上のみ未UP） -- //
// Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function(){
// });

// -- 以下のログイン後の画面はGITHUB上のみ未UP（2021年中にUP予定） -- //
// login画面（Auth::routes();より上に記入） -- //
Route::get('/login', function () {
	return view('auth/login');
});
// 登録ルートなし設定
// 新規ユーザが必要なときはAuth::routes();
Auth::routes([
	'register' => false,
]);
Route::get('/home', 'HomeController@index')->name('home');

// -- TOP_静的画面一覧 -- //
Route::get('/{url?}', 'NavController@show')->name('nav.show')->where('url', '[a-z\-]+');
