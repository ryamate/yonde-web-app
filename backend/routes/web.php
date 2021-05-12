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
Route::prefix('login')->name('login.')->group(function () {
    Route::get('/{provider}', 'Auth\LoginController@redirectToProvider')->name('{provider}');
    Route::get('/{provider}/callback', 'Auth\LoginController@handleProviderCallback')->name('{provider}.callback');
});
Route::prefix('register')->name('register.')->group(function () {
    Route::get('/{provider}', 'Auth\RegisterController@showProviderUserRegistrationForm')->name('{provider}');
    Route::post('/{provider}', 'Auth\RegisterController@registerProviderUser')->name('{provider}');
});
Route::get('/', 'PictureBookController@home')->name('picture_books.home');
Route::get('/about', 'PictureBookController@about')->name('picture_books.about');
Route::get('/picture_books', 'PictureBookController@index')->name('picture_books.index');
Route::resource('/picture_books', 'PictureBookController')->except(['index', 'edit', 'destroy', 'update', 'show'])->middleware('auth');
Route::get('/picture_books/search', 'PictureBookController@search')->name('picture_books.search');
Route::get('/picture_books/{stored_picture_book}/edit', 'PictureBookController@edit')->name('picture_books.edit')->middleware('auth');
Route::delete('/picture_books/{stored_picture_book}', 'PictureBookController@destroy')->name('picture_books.destroy')->middleware('auth');
Route::match(['put', 'patch'], '/picture_books/{stored_picture_book}', 'PictureBookController@update')->name('picture_books.update')->middleware('auth');
Route::get('/picture_books/{stored_picture_book}', 'PictureBookController@show')->name('picture_books.show');

Route::prefix('picture_books')->name('picture_books.')->group(function () {
    Route::put('/{stored_picture_book}/like', 'PictureBookController@like')->name('like')->middleware('auth');
    Route::delete('/{stored_picture_book}/like', 'PictureBookController@unlike')->name('unlike')->middleware('auth');
});

Route::prefix('users')->name('users.')->group(function () {
    Route::get('/edit', 'UserController@edit')->name('edit');
    Route::post('/update', 'UserController@update')->name('update');
    Route::get('/{yonde_id}/setting_profile', 'UserController@showSettingProfile')->name('show_setting_profile');
    Route::get('/{yonde_id}', 'UserController@show')->name('show');
    Route::get('/{yonde_id}/likes', 'UserController@likes')->name('likes');
    Route::get('/{yonde_id}/followings', 'UserController@followings')->name('followings');
    Route::get('/{yonde_id}/followers', 'UserController@followers')->name('followers');
    Route::middleware('auth')->group(function () {
        Route::put('/{yonde_id}/follow', 'UserController@follow')->name('follow');
        Route::delete('/{yonde_id}/follow', 'UserController@unfollow')->name('unfollow');
    });
});
Route::get('/tags/{name}', 'TagController@show')->name('tags.show');
