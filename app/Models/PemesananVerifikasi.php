<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PemesananVerifikasi extends Model
{
     protected $fillable = [
     	'id_pemesan','id_penjual','nomor_invoice','nama_produk','harga_satuan','kapasitas','total_bayar','waktu_pemesanan','waktu_pembayaran','waktu_konfirmasi_penjual','waktu_pengiriman','waktu_penerimaan','status'
	    
    ];
    public $timestamps = false;
}
