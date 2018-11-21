<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdukPengiriman extends Model
{
     protected $fillable = [
	    'id_produk','id_lokasi','tagihan'
    ];
}
