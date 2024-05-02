<?php

# POST update Page theme setting
Route::post('/theme', 'GuestController@changeTheme')->name('theme');

# GET Articles
Route::prefix('articles')->group(function () {

    # GET article
    Route::get('/{title}', 'GuestController@getArticle');

    Route::view('/thewatcher/bibliography', 'content.thewatcher.bibliography');
    Route::view('/thewatcher/resources', 'content.thewatcher.references');

    Route::view('/highfields/bibliography', 'content.highfields.bibliography');
    Route::view('/highfields/references', 'content.highfields.references');

    # Route::view('/articles/breezeknoll/bibliography', 'content.breezeknoll.bibliography');

    Route::view('/10050cielo/bibliography', 'content.podcast.10050cielo.bibliography');
    Route::view('/3301waverly/bibliography', 'content.podcast.3301waverly.bibliography');
    Route::view('/watts/bibliography', 'content.podcast.watts.bibliography');
    Route::view('/breezeknoll/bibliography', 'content.podcast.breezeknoll.bibliography');
});

Route::view('/about', 'content.about');

Route::view('/research', 'content.research-services');

# GET Podcast Directory
// Route::view('/podcasts', 'content.podcast.directory');

// Route::get('/podcast/{title}', 'GuestController@getPodcast');

Route::get('/ep/{title}', 'GuestController@get')->name('getPodcast');
Route::get('/ep/{title}/references', 'GuestController@references')->name('getReferences');
Route::view('/ep/lindley/references', 'content.lindley.references')->name('lindleyRefs');

Route::get('/podcast/{title}', 'GuestController@getPodcast')->name('podcast');

# REDIRECT
Route::redirect('/thewatcher', '/articles/thewatcher', 301)->name('watcher');
Route::redirect('/highfields', '/articles/highfields', 301)->name('highfields');
Route::redirect('/breezeknoll', '/articles/breezeknoll', 301)->name('breezeknoll');
Route::redirect('/10050cielo', '/articles/10050cielo', 301)->name('10050cielo');
Route::redirect('/3301waverly', '/articles/3301waverly', 301)->name('3301waverly');
Route::redirect('/watts', '/articles/watts', 301)->name('watts');


// Route::view('/', 'content.podcast.directory');

// Route::redirect('/podcasts', '/');
Route::get('/{title}', 'GuestController@getPodcast')->name('getPodcastBySlug');
Route::get('/', 'GuestController@getPodcasts')->name('welcome');
