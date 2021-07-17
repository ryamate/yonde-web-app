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

Route::get('/', 'HomeController@home')->name('home');
Route::get('/about', 'HomeController@about')->name('about');
Route::get('/privacy', 'HomeController@privacy')->name('privacy');
Route::get('/terms', 'HomeController@terms')->name('terms');

Route::prefix('contact')->name('contact.')->group(function () {
    Route::get('/', 'ContactController@show')->name('show');
    Route::post('/', 'ContactController@post')->name('post');
    Route::get('/confirm', 'ContactController@confirm')->name('confirm');
    Route::post('/confirm', 'ContactController@send')->name('send');
    Route::get('/thanks', 'ContactController@complete')->name('complete');
});

Auth::routes(['verify' => true]);
Route::prefix('login')->name('login.')->group(function () {
    Route::get('/guest', 'Auth\LoginController@guestLogin')->name('guest');
    Route::get('/{provider}', 'Auth\LoginController@redirectToProvider')->name('{provider}');
    Route::get('/{provider}/callback', 'Auth\LoginController@handleProviderCallback')->name('{provider}.callback');
});

Route::prefix('register')->name('register.')->group(function () {
    Route::get('/invited/{token}', 'Auth\RegisterController@showInvitedUserRegistrationForm')->name('invited.{token}');
    Route::post('/invited', 'Auth\RegisterController@registerInvitedUser')->name('invited');
    Route::get('/{provider}', 'Auth\RegisterController@showProviderUserRegistrationForm')->name('{provider}');
    Route::post('/{provider}', 'Auth\RegisterController@registerProviderUser')->name('{provider}');
});

Route::get('/email/verified', 'Auth\VerificationController@verified');

Route::resource('/picture_books', 'PictureBookController')->except(['index', 'edit', 'destroy', 'update', 'show'])->middleware('auth');
Route::prefix('picture_books')->name('picture_books.')->group(function () {
    Route::get('/search_bookshelf', 'PictureBookController@searchBookshelf')->name('search_bookshelf');
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

Route::resource('/read_records', 'ReadRecordController')->middleware('auth');

Route::prefix('users')->name('users.')->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('/edit', 'UserController@edit')->name('edit');
        Route::post('/update', 'UserController@update')->name('update');
        Route::get('/setting_profile', 'UserController@settingProfile')->name('setting_profile');
        Route::get('/{name}', 'UserController@index')->name('index');
        Route::get('/{name}/read_record', 'UserController@readRecord')->name('read_record');
        Route::get('/{name}/likes', 'UserController@likes')->name('likes');
        Route::get('/{name}/liked', 'UserController@liked')->name('liked');
        Route::get('/{name}/followings', 'UserController@followings')->name('followings');
        Route::get('/{name}/followers', 'UserController@followers')->name('followers');
    });
});

Route::prefix('tags')->name('tags.')->group(
    function () {
        Route::get('/{name}', 'TagController@show')->name('show');
    }
);

Route::prefix('families')->name('families.')->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('/edit', 'FamilyController@edit')->name('edit');
        Route::post('/update', 'FamilyController@update')->name('update');
        Route::get('/setting', 'FamilyController@setting')->name('setting');
        Route::get('/{name}', 'FamilyController@index')->name('index');
        Route::get('/{name}/bookshelf', 'FamilyController@bookshelf')->name('bookshelf');
        Route::get('/{name}/curious', 'FamilyController@booksCurious')->name('curious');
        Route::get('/{name}/read', 'FamilyController@booksRead')->name('read');
        Route::get('/{name}/read_record', 'FamilyController@readRecord')->name('read_record');
        Route::get('/{name}/{picture_book}', 'FamilyController@show')->name('show');
        Route::put('/{name}/follow', 'FamilyController@follow')->name('follow');
        Route::delete('/{name}/follow', 'FamilyController@unfollow')->name('unfollow');
    });
});

Route::prefix('children')->name('children.')->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('/create', 'ChildController@create')->name('create');
        Route::post('/store', 'ChildController@store')->name('store');
        Route::get('/{id}', 'ChildController@show')->name('show');
        Route::delete('/{id}', 'ChildController@destroy')->name('destroy');
        Route::get('/{id}/edit', 'ChildController@edit')->name('edit');
        Route::post('/{id}/update', 'ChildController@update')->name('update');
    });
});

Route::get('invite', 'InviteController@showLinkRequestForm')->name('invite')->middleware('auth');
Route::post('invite', 'InviteController@sendInviteFamilyEmail')->name('invite.email')->middleware('auth');
