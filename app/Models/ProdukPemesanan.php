<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdukPemesanan extends Model
{
     protected $fillable = [
	    'id_member','id_produk','id_paket','harga_produk','jumlah_produk','total_bayar','waktu_pesan','waktu_bayar','waktu_konfirmasi','status'
    ];
}
