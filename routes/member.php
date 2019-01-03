<?php

Route::get('/', 'Member\MemberController@index')->name('member.home');
Route::get('/login', 'Member\LoginController@showLoginForm')->name('member.login');
Route::post('/login', 'Member\LoginController@login')->name('member.login');
Route::get('/register', 'Member\LoginController@register')->name('member.register');
Route::post('/register', 'Member\LoginController@store')->name('member.register');
Route::post('/logout', 'Member\LoginController@logout')->name('member.logout');

Route::get('verify', 'Member\LoginController@verify')->name('signup.verify');

Route::get('/produk', 'Member\ProdukController@index');
Route::post('/produk', 'Member\ProdukController@store')->name('produk.tambah');

Route::post('/produk/gambar/tambah', 'Member\ProdukController@storegambar')->name('produk.gambar.tambah');
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
Route::post('/cart/store', 'Member\CartController@storecart')->name('cart.store');
Route::get('/cart/pengiriman/{type}/{id}', 'Member\CartController@tampilpengiriman');
Route::get('/cart/produkpaket/{id}', 'Member\CartController@tampilprodukpaket');
Route::get('/cart/tagihanpengiriman/{type}/{id_pengiriman}', 'Member\CartController@tampiltagihan');
Route::get('/cart/remove/{id}', 'Member\CartController@remove');
Route::get('/cart/removeall', 'Member\CartController@removeall');
Route::get('/cart/lunasi', 'Member\CartController@lunasi');

Route::get('/transaksi', 'Member\TransaksiController@index');
Route::get('/transaksi/pesan', 'Member\TransaksiController@pesan');
Route::get('/transaksi/konfirmasi', 'Member\TransaksiController@konfirmasi');
Route::get('/transaksi/pengerjaan', 'Member\TransaksiController@pengerjaan');
Route::get('/transaksi/pengiriman', 'Member\TransaksiController@pengiriman');
Route::get('/transaksi/kembali', 'Member\TransaksiController@kembali');
Route::get('/transaksi/selesai', 'Member\TransaksiController@selesai');

Route::get('/transaksi/tracking/{id}', 'Member\TransaksiController@transaksiid');
Route::get('/transaksi/selesai/{id}', 'Member\TransaksiController@konfirmasiselesai');

Route::get('/penjualan', 'Member\PenjualanController@index');
Route::get('/penjualan/pesan', 'Member\PenjualanController@ppesan');
Route::get('/penjualan/konfirmasi', 'Member\PenjualanController@pkonfirmasi');
Route::get('/penjualan/pengerjaan', 'Member\PenjualanController@ppengerjaan');
Route::get('/penjualan/pengiriman', 'Member\PenjualanController@ppengiriman');
Route::get('/penjualan/kembali', 'Member\PenjualanController@pkembali');
Route::get('/penjualan/selesai', 'Member\PenjualanController@pselesai');
Route::get('/penjualan/tracking/{id}', 'Member\PenjualanController@penjualanid');
Route::get('/penjualan/konfirmasi/{id}', 'Member\PenjualanController@konfirmasi');
Route::get('/penjualan/tidaksiap/{id}', 'Member\PenjualanController@tidaksiap');
Route::get('/penjualan/pengerjaan/{id}', 'Member\PenjualanController@pengerjaan');
Route::get('/penjualan/pengiriman/{id}', 'Member\PenjualanController@pengiriman');

Route::get('/kategori/{kategori}', 'Member\MemberController@kategori');
