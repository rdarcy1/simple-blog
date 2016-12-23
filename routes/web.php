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

// Show articles index as homepage
Route::get('/', 'ArticleController@index');

// Articles routing
Route::resource('articles', 'ArticleController');
// Article index pagination
Route::get('articles/page/{page}', 'ArticleController@index')->name('articles.page');
// Article confirm delete
Route::get('articles/{article}/delete', 'ArticleController@confirmDelete')->name('articles.confirmDelete');

// Authentication routes
Auth::routes();

// Home route
Route::get('/home', 'HomeController@index');
