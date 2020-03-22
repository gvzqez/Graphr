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

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();

Route::get('/', 'DashboardController@index')->name('home');
Route::get('/fonts', 'FontController@index')->name('fonts');
Route::get('/fonts/recent', 'FontController@recent')->name('recent');
Route::get('/fonts/top', 'FontController@top')->name('top');
Route::get('/fonts/{slug}', 'FontController@get')->name('font');
Route::get('/fonts/{slug}/download', 'FontController@download')->name('download');
Route::get('/fonts/author/{slug}', 'AuthorController@get');
Route::get('/fonts/category/{slug}', 'CategoryController@get');
