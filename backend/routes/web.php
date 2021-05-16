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
Route::prefix('picture_books')->name('picture_books.')->group(function () {
    Route::get('/search', 'PictureBookController@search')->name('search');
    Route::get('/{picture_book}', 'PictureBookController@show')->name('show');
    Route::middleware('auth')->group(function () {
        Route::delete('/{picture_book}', 'PictureBookController@destroy')->name('destroy');
        Route::get('/{picture_book}/edit', 'PictureBookController@edit')->name('edit');
        Route::match(['put', 'patch'], '/{picture_book}', 'PictureBookController@update')->name('update');
        Route::put('/{picture_book}/like', 'PictureBookController@like')->name('like');
        Route::delete('/{picture_book}/like', 'PictureBookController@unlike')->name('unlike');
    });
});

Route::prefix('users')->name('users.')->group(function () {
    Route::get('/edit', 'UserController@edit')->name('edit');
    Route::post('/update', 'UserController@update')->name('update');
    Route::get('/{yonde_id}/setting_profile', 'UserController@showSettingProfile')->name('show_setting_profile');
    Route::get('/{yonde_id}', 'UserController@show')->name('show');
    Route::get('/{yonde_id}/bookshelf', 'UserController@bookshelf')->name('bookshelf');
    Route::get('/{yonde_id}/likes', 'UserController@likes')->name('likes');
    Route::get('/{yonde_id}/followings', 'UserController@followings')->name('followings');
    Route::get('/{yonde_id}/followers', 'UserController@followers')->name('followers');
    Route::middleware('auth')->group(function () {
        Route::put('/{yonde_id}/follow', 'UserController@follow')->name('follow');
        Route::delete('/{yonde_id}/follow', 'UserController@unfollow')->name('unfollow');
    });
});
Route::get('/tags/{name}', 'TagController@show')->name('tags.show');
