<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdukPemesanan extends Model
{
     protected $fillable = [
	    'id_member','id_penjual','nama_produk','nama_paket','produk','harga','qty','total_bayar','waktu_pesan','waktu_konfirmasi','waktu_kembali','waktu_selesai','status','waktu_pengerjaan','waktu_Pengiriman','id_lokasi','biaya_kirim', 'alamat'
    ];
    public $timestamps = false;
}
