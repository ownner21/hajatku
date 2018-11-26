<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
	    'id_pemesan','id_produk','id_paket','id_pengiriman','qty','alamat'
	];
}
