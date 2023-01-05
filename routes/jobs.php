<?php

Route::get('/logout', 'LoginController@logout')->name('logout');

Route::group(['as' => 'login.', 'prefix' => 'login'], function() {
    Route::get('/', 'LoginController@index')->name('index');
    Route::post('/', 'LoginController@authenticate')->name('authenticate');
});

Route::group(['as' => 'about.'], function() {
    Route::get('/', 'AboutController@index')->name('index');
});

Route::group(['as' => 'track.', 'prefix' => 'track'], function() {
    Route::get('/', 'TrackController@index')->name('index');
    Route::get('/{code}', 'TrackController@view')->name('view');
});

Route::group(['as' => 'listings.'], function() {
    Route::get('/listing/{uid}', 'ListingsController@view')->name('view');

    Route::group(['prefix' => 'listings'], function() {
        Route::get('/', 'ListingsController@index')->name('index');
        Route::post('/apply', 'ListingsController@apply')->name('apply');
    });
});
