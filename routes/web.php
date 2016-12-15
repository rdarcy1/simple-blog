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

Route::get('/', 'ArticleController@index');

Route::get('articles/page/{page}', 'ArticleController@index')->name('articles.page');
Route::get('articles/{id}/delete', 'ArticleController@confirmDelete')->name('articles.confirmDelete');
Route::resource('articles', 'ArticleController');