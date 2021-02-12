<?php

Route::resource('categories', 'Categories\CategoryController');
Route::resource('posts', 'Posts\PostController');

Route::get('users', 'Users\UserController@index');

Route::post('posts/{post}/comments', 'Comments\CommentController@store');

Route::group(['prefix' => 'auth'], function () {
    Route::post('register', 'Auth\RegisterController@action');
    Route::post('login', 'Auth\LoginController@action');
    Route::post('logout', 'Auth\LoginController@logout');
    Route::get('me', 'Auth\MeController@action');
    Route::put('settings/profile', 'Users\ProfileController@update');
});
