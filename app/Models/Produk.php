<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
	 protected $fillable = [
	    'id_member','id_kategori','nama_produk','slug_produk','deskripsi','lokasi','min_pemesanan','max_pemesanan','harga','kode_produk'
    ];
}
