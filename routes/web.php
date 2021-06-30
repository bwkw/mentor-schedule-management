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
Auth::routes();

// ホーム
Route::get('/', 'HomeController@index');

// 面談日時を取得
Route::get('/meetings', 'MeetingController@index');

// 面談日時を保存
Route::post('/meetings', 'MeetingController@store');

// 面談日時登録ページ
Route::get('/meetings/register', 'MeetingController@register');

// 面談日時を削除
Route::delete('/meetings/{meeting}', 'MeetingController@delete');

// 面談日時の編集ページへ
Route::get('/meetings/{meeting}/edit', 'MeetingController@edit');

// 面談日時の編集/更新
Route::put('/meetings/{meeting}', 'MeetingController@update');

// イベント日時を取得
Route::get('/events', 'EventController@index');

// イベント日時を保存
Route::post('/events', 'EventController@store');

// イベント登録ページ
Route::get('/events/register', 'EventController@register');

// イベント日時を削除
Route::delete('/events/{event}', 'EventController@delete');

// イベント日時の編集ページへ
Route::get('/events/{event}/edit', 'EventController@edit');

// イベント日時の編集/更新
Route::put('/events/{event}', 'EventController@update');