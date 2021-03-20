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
Route::resource('/picture_books', 'PictureBookController')->except(['index', 'edit', 'destroy', 'update'])->middleware('auth');
Route::get('/search', 'PictureBookController@search')->name('search');
Route::get('/picture_books/{stored_picture_book}/edit', 'PictureBookController@edit')->name('picture_books.edit')->middleware('auth');
Route::get('/picture_books/{stored_picture_book}', 'PictureBookController@destroy')->name('picture_books.destroy')->middleware('auth');
Route::match(['put', 'patch'], '/picture_books/{stored_picture_book}', 'PictureBookController@update')->name('picture_books.update')->middleware('auth');
