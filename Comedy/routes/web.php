<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('home', 'HomeController@index')->name('home');


Auth::routes();

Route::get('home', 'HomeController@index');

Route::get('memes', 'HomeController@memes');

Route::get('jokes', 'HomeController@jokes');

Route::get('videos', 'HomeController@videos');

Route::get('fashion', 'HomeController@fashion');

Route::post('uploadjoke', 'HomeController@uploadjoke');

Route::post('uploadMeme', 'HomeController@uploadMeme');

Route::post('ajaxUploadMeme', 'HomeController@ajaxUploadMeme');

Route::post('uploadFashion', 'HomeController@uploadFashion');

Route::post('uploadVideos', 'HomeController@uploadVideos');

Route::post('uploadComment', 'HomeController@uploadComment');

Route::post('addLike', 'HomeController@addLike');

Route::post('submit', 'HomeController@submitMeme');