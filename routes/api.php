<?php

Route::resource('categories', 'Categories\CategoryController');
Route::resource('posts', 'Posts\PostController');
Route::resource('posts/{post}/comments', 'Comments\CommentController');

Route::group(['prefix' => 'auth'], function () {
    Route::post('register', 'Auth\RegisterController@action');
    Route::post('login', 'Auth\LoginController@action');
    Route::post('logout', 'Auth\LoginController@logout');
    Route::get('me', 'Auth\MeController@action');
    Route::put('settings/profile', 'Users\ProfileController@update');
});
