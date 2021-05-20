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
})->name('user.login');


Route::get('users/commonHeader','UserController@commonHeader')->name('user.commonHeader');

Route::get('post/postlist','PostController@postlist')->name('post.postlist');
Route::get('post/searchPost','PostController@searchPost')->name('post.searchPost');
Route::get('post/create','PostController@create')->name('post.create');
Route::get('post/export','PostController@export')->name('post.export');
Route::get('post/{post}/editpost','PostController@editpost')->name('post.editpost');
Route::post('users/testuser','UserController@testuser')->name('user.testuser');
Route::post('post/createpost','PostController@createpost')->name('post.createpost');
Route::post('post/confirmPost','PostController@confirmPost')->name('post.confirmPost');
Route::post('post/confirmeditpost','PostController@confirmeditpost')->name('post.confirmeditpost');
Route::put('post/updatepost','PostController@updatepost')->name('post.updatepost');
Route::delete('post/{post}','PostController@deletepost')->name('post.deletepost');
Route::get('post/importCSV','PostController@importCSV')->name('post.importCSV');
Route::post('post/importfile','PostController@importfile')->name('post.importfile');


Route::get('users/','UserController@index')->name('user.index');
Route::get('user/searchUser','UserController@searchUser')->name('user.searchUser');






