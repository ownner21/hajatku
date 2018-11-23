<?php

Route::get('/', 'Admin\AdminController@index')->name('admin.home');
Route::get('/login', 'Admin\LoginController@showLoginForm')->name('admin.login');
Route::post('/login', 'Admin\LoginController@login')->name('admin.login');
Route::post('/logout', 'Admin\LoginController@logout')->name('admin.logout');

Route::get('/kategori', 'Admin\KategoriController@index');
Route::post('/kategori', 'Admin\KategoriController@store')->name('kategori.tambah');
Route::put('/kategori/update', 'Admin\KategoriController@update')->name('kategori.update');
Route::delete('/kategori/{id}', 'Admin\KategoriController@delete')->name('kategori.hapus');

Route::get('/lokasi', 'Admin\LokasiController@index');
Route::post('/lokasi', 'Admin\LokasiController@store')->name('lokasi.tambah');
Route::put('/lokasi/update', 'Admin\LokasiController@update')->name('lokasi.update');
Route::delete('/lokasi/{id}', 'Admin\LokasiController@delete')->name('lokasi.hapus');

Route::get('/member', 'Admin\MemberController@index');
Route::get('/member/blok/{id}', 'Admin\MemberController@blok');
Route::get('/member/aktif/{id}', 'Admin\MemberController@aktif');

Route::get('/topup', 'Admin\TopupController@index');
Route::put('/topup/lunas/{id}', 'Admin\TopupController@lunas')->name('topup.konfirmasi');
Route::put('/topup/gagal/{id}', 'Admin\TopupController@gagal')->name('topup.gagal');

Route::get('/transaksi', 'Admin\TransaksiController@index');
