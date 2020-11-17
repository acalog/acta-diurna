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
    Route::get('/upload', 'FileController@create')->name('upload.show');

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
    Route::view('/panel', 'content.panel.index')->name('panel');

    # Watch Media Routes
    Route::prefix('watch')->group(function () {
        # GET watch video file
        Route::get('{hash}', 'MediaController@watch')->name('watch');

        # POST update view count
        Route::post('view', 'MediaController@addView');
    });

    # GET all videos by User
    Route::get('/videos/user', 'MediaController@getVideosByUser');

    # GET all videos associated with a tag
    Route::get('/videos/tag/{tag}', 'MediaController@getVideosByTag');

    # GET all videos associated with a tag
    Route::get('/tag/{tag}', 'TagController@videosByTag')->name('videosByTag');

    # GET homepage
    Route::get('/home', 'HomeController@index')->name('home');
});

# Authentication Routes
Auth::routes();

# Comment Routes
Route::resource('comments', 'CommentController');

# POST update Page theme setting
Route::post('/theme', 'GuestController@changeTheme')->name('theme');

# GET article
Route::get('/articles/{title}', 'GuestController@getArticle');

# GET About
Route::view('/about', 'content.about');

# GET TheWatcher bibliography
Route::view('/articles/thewatcher/bibliography', 'content.thewatcher.bibliography');
Route::view('/articles/thewatcher/resources', 'content.thewatcher.references');


# REDIRECT
Route::redirect('/thewatcher', '/articles/thewatcher', 301)->name('watcher');
Route::redirect('/highfields', '/articles/highfields', 301)->name('highfields');


# REDIRECT landing page to The Watchers
Route::redirect('/', '/highfields', 301)->name('home');

# REDIRECT away from register page
Route::redirect('/register', '/thewatcher', 301);
