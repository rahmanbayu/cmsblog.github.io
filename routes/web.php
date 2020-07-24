<?php

use Illuminate\Support\Facades\Route;


Route::get('/', 'BlogController@index')->name('/');
Route::get('category/{category}', 'BlogController@category')->name('blog.category');
Route::get('tag/{tag}', 'BlogController@tag')->name('blog.tag');
Route::get('blog/{post}/show', 'BlogController@show')->name('blog.show');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth'])->group(function () {
    Route::resource('categories', 'CategoryController');
    Route::resource('posts', 'PostController');
    Route::get('post/trashed', 'PostController@trashed')->name('posts.trashed');
    Route::patch('post/trashed/{slug}/restore', 'PostController@restore')->name('posts.restore');
    Route::resource('tags', 'TagController');

    Route::get('profile', 'UserController@profile')->name('profile.edit');
    Route::put('profile', 'UserController@update')->name('profile.update');
});
