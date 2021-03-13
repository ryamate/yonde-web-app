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
Route::get('/', 'PictureBookController@index')->name('picture_books.index');
Route::resource('/picture_books', 'PictureBookController')->except(['index', 'create'])->middleware('auth');
Route::post('/picture_books/create', 'PictureBookController@create')->name('picture_books.create')->middleware('auth');
Route::get('/search', 'PictureBookController@listSearchedPictureBooks')->name('search');
