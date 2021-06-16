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

Auth::routes();

// ホーム
Route::get('/', 'HomeController@index');

// ミーティング日時を取得
Route::get('/meetings', 'MeetingController@index');

// ミーティング日時を保存
Route::post('/meetings', 'MeetingController@store');

// ミーティング日時登録ページ
Route::get('/meetings/register', 'MeetingController@register');

// イベント日時を取得
Route::get('/events', 'EventController@index');

// イベント日時を保存
Route::post('/events', 'EventController@store');

// イベント登録ページ
Route::get('/events/register', 'EventController@register');