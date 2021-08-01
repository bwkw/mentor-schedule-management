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

// Auth認証からregisterを削除
Auth::routes(['register' => false]);

// ホーム
Route::get('/', 'HomeController@index')->middleware('auth');

// 面談に関するルーティング
Route::group(['prefix' => 'meetings', 'middleware' => 'auth'], function(){
    Route::get('/', 'MeetingController@index'); // 面談日時を取得
    Route::post('/', 'MeetingController@store'); // 面談日時を保存   
    Route::get('/register', 'MeetingController@register'); // 面談日時登録ページへの遷移
    Route::delete('/{meeting}', 'MeetingController@delete'); // 面談日時を削除
    Route::get('/{meeting}/edit', 'MeetingController@edit'); // 面談日時編集ページへの遷移
    Route::put('/{meeting}', 'MeetingController@update'); // 面談日時の編集/更新
});

// イベントに関するルーティング
Route::group(['prefix' => 'events', 'middleware' => 'auth'], function(){
    Route::get('/', 'EventController@index'); // イベント日時を取得
    Route::post('/', 'EventController@store'); // イベント日時を保存   
    Route::get('/register', 'EventController@register'); // イベント日時登録ページへの遷移
    Route::delete('/{event}', 'EventController@delete'); // イベント日時を削除
    Route::get('/{event}/edit', 'EventController@edit'); // イベント日時編集ページへの遷移
    Route::put('/{event}', 'EventController@update'); // イベント日時の編集/更新
});
