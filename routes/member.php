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

Route::get('/produk/stok/{id_produk}', 'Member\ProdukController@stokproduk');
Route::post('/produk/stok', 'Member\ProdukController@storestok')->name('stok.tambah');

Route::get('/topup', 'Member\TopupController@index');
Route::post('/topup', 'Member\TopupController@store')->name('topup.tambah');

Route::get('/saldo', 'Member\TopupController@laporan');

Route::get('/paket', 'Member\PaketController@index');
Route::get('/paket/id/{id_paket}', 'Member\PaketController@paketid');
Route::post('/paket', 'Member\PaketController@store')->name('paket.tambah');
Route::put('/paket', 'Member\PaketController@update')->name('paket.update');
Route::delete('/paket/delete/{id}', 'Member\PaketController@delete')->name('paket.hapus');

Route::get('/paket/edit/{id_produk}', 'Member\PaketController@edit');
Route::post('/paket/produk', 'Member\PaketController@storeproduk')->name('paket.produk.tambah');
Route::put('/paket/produk', 'Member\PaketController@updateproduk')->name('paket.produk.update');
Route::get('/paket/produk/delete/{id_produk}', 'Member\PaketController@deleteproduk');

Route::post('/paket/pengiriman', 'Member\PaketController@storepengiriman')->name('paket.pengiriman.tambah');
Route::put('/paket/pengiriman/update', 'Member\PaketController@updatepengiriman')->name('paket.pengiriman.update');
Route::get('/paket/pengiriman/delete/{id}', 'Member\PaketController@hapuspengiriman');

Route::get('/cart', 'Member\CartController@index');
Route::get('/cart/store/produk/{id}', 'Member\CartController@tambahproduk');
Route::get('/cart/remove/{id}', 'Member\CartController@remove');
Route::get('/cart/removeall', 'Member\CartController@removeall');
Route::get('/cart/lunasi', 'Member\CartController@lunasi');

Route::get('/transaksi', 'Member\TransaksiController@index');
Route::get('/transaksi/tracking/{id}', 'Member\TransaksiController@transaksiid');
Route::get('/transaksi/selesai/{id}', 'Member\TransaksiController@selesai');

Route::get('/penjualan', 'Member\PenjualanController@index');
Route::get('/penjualan/tracking/{id}', 'Member\PenjualanController@penjualanid');
Route::get('/penjualan/konfirmasi/{id}', 'Member\PenjualanController@konfirmasi');
Route::get('/penjualan/tidaksiap/{id}', 'Member\PenjualanController@tidaksiap');
Route::get('/penjualan/pengerjaan/{id}', 'Member\PenjualanController@pengerjaan');
Route::get('/penjualan/pengiriman/{id}', 'Member\PenjualanController@pengiriman');
