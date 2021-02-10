<?php

Route::resource('categories', 'Categories\CategoryController');
Route::resource('posts', 'Posts\PostController');
Route::resource('posts/{post}/comments', 'Comments\CommentController');