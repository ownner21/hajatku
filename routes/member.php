<?php

Route::get('/', 'Member\MemberController@index')->name('member.home');
Route::get('/login', 'Member\LoginController@showLoginForm')->name('member.login');
Route::post('/login', 'Member\LoginController@login')->name('member.login');
Route::get('/register', 'Member\LoginController@register')->name('member.register');
Route::post('/register', 'Member\LoginController@store')->name('member.register');
Route::post('/logout', 'Member\LoginController@logout')->name('member.logout');

Route::get('/produk', 'Member\ProdukController@index');
Route::post('/produk', 'Member\ProdukController@store')->name('produk.tambah');

Route::post('/produk/gambar', 'Member\ProdukController@storegambar')->name('produk.gambar.tambah');
Route::get('/produk/gambar/delete/{id}', 'Member\ProdukController@hapusgambar');

Route::post('/produk/pengiriman', 'Member\ProdukController@storepengiriman')->name('produk.pengiriman.tambah');
Route::put('/produk/pengiriman/update', 'Member\ProdukController@updatepengiriman')->name('produk.pengiriman.update');
Route::get('/produk/pengiriman/delete/{id}', 'Member\ProdukController@hapuspengiriman');

Route::get('/produk/id/{id_produk}', 'Member\ProdukController@produkid');
Route::get('/produk/edit/{id_produk}', 'Member\ProdukController@edit');
Route::put('/produk/update', 'Member\ProdukController@update')->name('produk.update');
Route::delete('/produk/{id_produk}', 'Member\ProdukController@delete')->name('produk.hapus');

Route::get('/topup', 'Member\TopupController@index');
Route::post('/topup', 'Member\TopupController@store')->name('topup.tambah');

