<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Project : Bulletin Board
| Description : "This page contains users routes, post routes and csv routes toward controllers"
|
*/

Route::get('/', function () {
    return view('user/login');
});

Route::get('users/','UserController@index')->name('user.index');
Route::get('users/commonHeader','UserController@commonHeader')->name('user.commonHeader');
Route::post('users/testuser','UserController@testuser')->name('user.testuser');
Route::get('post/postlist','PostController@postlist')->name('post.postlist');



