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

 
Route::get('/', 'PagesController@index');

Route::get('/about', 'PagesController@about');

  Route::get('/name', 'PagesController@index');

  Route::resource('posts', 'PostsController');

  Route::get('/prolanguage', 'PagesController@proLanguage');
Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('home');


Route::get('get-file', 'CloudderController@getFile');
Route::post('upload-file', ['as'=>'upload-file','uses'=>'CloudderController@uploadFile']);