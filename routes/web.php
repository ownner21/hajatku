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

Route::get('/', 'HomeController@index');
Route::get('/{slug}', 'HomeController@produkid');
Route::get('/kategori/{kategori}', 'MemberController@kategori');

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
