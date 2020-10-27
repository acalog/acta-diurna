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

Route::group(['middleware' => 'auth'], function () {

    # GET upload file(s) page
    Route::get('/upload', 'FileController@create');

    # POST: upload new file
    Route::post('/process', 'FileController@store')->name('upload');

    # POST save new post
    Route::post('/post', 'PostController@store')->name('post.store');

    # Tags admin actions
    Route::prefix('tags')->group(function () {
        # GET Re-calculate tag weights
        Route::get('weight', 'TagController@weight')->name('weight');

        # GET Remove blacklisted tags
        Route::get('prune', 'TagController@cleanUpTags')->name('prune');
    });

    # Admin Panel
    Route::get('/panel', function () {
        return view('content.panel.index');
    });

    # GET homepage
    Route::get('/home', 'HomeController@index')->name('home');
});

Route::prefix('watch')->group(function () {
    # GET watch video file
    Route::get('{hash}', 'MediaController@watch')->name('watch');

    # POST update view count
    Route::post('view', 'MediaController@addView');
});

# GET all videos associated with a tag
Route::get('/tag/{tag}', 'TagController@videosByTag')->name('videosByTag');

# Authentication Routes
Auth::routes();

# POST update Page theme setting
Route::post('/theme', 'GuestController@changeTheme')->name('theme');

# GET The Watchers page
Route::get('/thewatchers', function () {
    return view('content.watchers');
});

# GET Redirect landing page to The Watchers
Route::redirect('/', '/thewatchers', 301);

# GET landing page
// Route::get('/', 'GuestController@index');
