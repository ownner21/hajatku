<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StokProduk extends Model
{
    protected $fillable = [
	    'id_produk','stok_awal','debit','kredit','stok_akhir','keterangan'
	];
}
